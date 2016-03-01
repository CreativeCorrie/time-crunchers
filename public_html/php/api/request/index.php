<?php
/**
 * This is a first draft, created using BreadBasket's listing api
 * @see https://github.com/brbrown59/bread-basket/blob/master/public_html/php/api/listing/index.php
 *
 * REQUEST API for request class
 * @author Sam Chandler <samuelvanchandler@gmail.com>
 *
 */

//grab the class under scrutiny
require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Timecrunchers\Request;
use Edu\Cnm\Timecrunchers\User;
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

	//sanitize the id
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//sanitize and trim the other fields
	$requestRequestorId = filter_input(INPUT_GET, "requestRequestorId", FILTER_VALIDATE_INT);
	$requestAdminId = filter_input(INPUT_GET, "requestAdminId", FILTER_VALIDATE_INT);
	$requestTimeStamp = filter_input(INPUT_GET, "requestTimeStamp", FILTER_SANITIZE_STRING);
	$requestActionTimeStamp = filter_input(INPUT_GET, "requestActionTimeStamp", FILTER_SANITIZE_STRING);
	$requestApprove = filter_input(INPUT_GET, "requestApprove", FILTER_VALIDATE_BOOLEAN);
	$requestRequestorText = filter_input(INPUT_GET, "requestRequestorText", FILTER_SANITIZE_STRING);
	$requestAdminText = filter_input(INPUT_GET, "requestAdminText", FILTER_SANITIZE_STRING);

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
	}
		//make sure the id is valid for methods that require it
		if(($method === "POST") && (empty($id) === true || $id < 0)) {
			throw(new InvalidArgumentException("id not found", 405));
		}
		if($method === "POST") {
			//create new request
			$request = new Request(null, $requestObject->requestRequestorId, $requestRequestorId,
				$requestObject->requestTimestamp, $requestObject->requestActionTimeStamp, $requestObject->requestActionTimeStamp,
				$requestObject->requestApprove, $requestObject->requestRequestorText, $requestObject->requestRequestorAdminText);
			$request->insert($pdo);
			$reply->message = "Request submitted successfully";
		}
	if($method === "PUT" || $method = "DELETE") {
		if(Access::isAdminLoggedIn() === true) {
			if($method === "PUT" || $method === "DELETE") {

				verifyXsrf();
				$requestContent = file_get_contents("php://input");
				$requestObject = json_decode($requestContent);

				//make sure all fields are present, in order to prevent database issues
				if(empty($requestObject->requestApprove) === true) {
					throw(new InvalidArgumentException ("Must Approve/Deny this request", 405));
				}
				//perform the actual put or post
				if($method === "PUT") {
					$request = Request::getRequestByRequestId($pdo, $id);
					if($request === null) {
						throw(new RuntimeException("Request does not exist", 404));
					}
					$request = Request::getRequestByRequestId($pdo, $id);
					$request->setRequestTimeStamp($requestObject->requestTimeStamp);
					$request->setRequestActionTimeStamp($requestObject->requestActionTimeStamp);
					$request->setRequestApprove($requestObject->requestApprove);
					$request->setRequestRequestorText($requestObject->requestRequestorText);
					$request->setRequestAdminText($requestObject->requetAdminText);
					$request->update($pdo);
					$reply->message = "Request updated successfully";
				} elseif ($method === "DELETE") {
					$request = Request::getRequestByRequestId($pdo, $id);
					if($request === null) {
						throw(new RuntimeException("Request does not exist", 404));
					}
					$request->delete($pdo);
					$deletedObject = new stdClass();
					$deletedObject->requestId = $id;
					$reply->message = "Request deleted successfully";
				}
			}
		}
	}
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}
//this is the end of the try block
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);

