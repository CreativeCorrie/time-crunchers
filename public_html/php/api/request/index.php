<?php
/**
 ** REQUEST API for request class
 * @author Sam Chandler <samuelvanchandler@gmail.com>
 */

//grab the class under scrutiny
require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Timecrunchers\Request;
use Edu\Cnm\Timecrunchers\Access;


//start the session and create a XSRF token
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the mySQL connection
	$pdo = connectToEncryptedMySql("/etc/apache2/capstone-mysql/timecrunch.ini");

	//if the user session is empty, the user is not logged in, throw an exception
	if(empty($_SESSION["user"]) === true) {
		setXsrfCookie("/");
		throw(new RuntimeException("Please log-in or sign up", 401));
	}
	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];
	$reply->method = $method;

	//sanitize the id
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//Handle REST calls
	if($method === "GET") {
		//Set XSRF cookie
		setXsrfCookie("/");
		//Get Request based on given field
		if(empty($id) === false) {
			$request = Request::getRequestByRequestId($pdo, $id);
			if($request !== null) {
				$reply->data = $request;
			}
		} else {
			$request = Request::getAllRequests($pdo);
			if($request !== null) {
				$reply->data = $request;
			}
		}
	} elseif($method === "PUT" || $method === "POST") {
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);
		verifyXsrf();
		if($method === "POST") {
			//create new request
			$request = new Request(null, $_SESSION["user"]->getUserId(), null, new DateTime(), null, false, $requestObject->requestRequestorText, "");
			$request->insert($pdo);
			$reply->message = "Request submitted successfully";
		}
		if(Access::isAdminLoggedIn() === true) {
			if($method === "PUT") {
				//make sure all fields are present, in order to prevent database issues
				if(empty($requestObject->requestApprove) === true) {
					throw(new InvalidArgumentException ("Must Approve/Deny this request", 405));
				}
				$request = Request::getRequestByRequestId($pdo, $id);
				if($request === null) {
					throw(new RuntimeException("Request does not exist", 404));
				}
				$request->setRequestAdminId($_SESSION["user"]->getUserId());
				$request->setRequestApprove((boolean)$requestObject->requestApprove);
				$request->setRequestActionTimeStamp(new DateTime());
				$request->setRequestAdminText($requestObject->requestAdminText);
				$request->update($pdo);
				$reply->message = "Request updated successfully";
			}
		}
	} elseif($method === "DELETE") {
		verifyXsrf();
		$request = Request::getRequestByRequestId($pdo, $id);
		if($request === null) {
			throw(new RuntimeException("Request does not exist", 404));
		}
		$request->delete($pdo);
		$deletedObject = new stdClass();
		$deletedObject->requestId = $id;
		$reply->message = "Request deleted successfully";
	} else {
		throw(new RuntimeException("Must be an Administrator"));
	}
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);

