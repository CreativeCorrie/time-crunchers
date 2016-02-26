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
 //enclose optionals in if block
	$requestApprove = filter_input(INPUT_GET, "requestApprove", FILTER_VALIDATE_BOOLEAN);
	$requestRequestorText = filter_input(INPUT_GET, "requestRequestorText", FILTER_SANITIZE_STRING);
	$requestAdminText = filter_input(INPUT_GET, "requestAdminText", FILTER_SANITIZE_STRING);
	if(empty($requestTimeStamp) === true){

	}
	if($method === "PUT") {
		if(Access::isAdminLoggedIn() === true) {
			// adminy thingz herez
		} else {
			throw(new RuntimeException("Must be an Administrator to access."));
		}
	}


	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id not found", 405));
	}

	//handle all RESTful calls to request, get some or all requests
	if($method === "GET") {
		//set an XSRF cookie on get requests
		setXsrfCookie("/");

		//get the request based on the given field
		if(empty($id) === false) {
			$reply->data = Request::getRequestByRequestId($pdo, $id);

	//verify admin and verify object not empty
	//if the session belongs to an admin, allow post, put, and delete methods
	// TODO userAccess is a string, will need updating
	if(empty($_SESSION["user"]) === false && $_SESSION["user"]->userAccessId() === true) {
		if($method === "PUT" || $method === "POST") {
			verifyXsrf();
			$requestContent = file_get_contents("php://input");
			$requestObject = json_decode($requestContent);
			//make sure all fields are present, in order to prevent database issues
			if(empty($requestObject->requetTimeStamp) === true) {
				$requestObject->requestTimeStamp = null;
			}
			if(empty($requestObject->requetActionTimeStamp) === true) {
				$requestObject->requestActionTimeStamp = null;
			}
			if(empty($requestObject->requestApprove) === true) {
				$requestObject->requestApprove = false; //if empty, admin hasn't approved yet
			}
			if(empty($requestObject->requestRequestorText) === true) {
				throw(new InvalidArgumentException("Requestor Text cannot be empty", 405));
			}
			if(empty($requestObject->requestAdminText) === true) {
				throw(new InvalidArgumentException("Admin Text cannot be empty", 405));
			}

			//perform the actual put or post
			if($method === "PUT") {
				$request = Request::getRequestByRequestId($pdo, $id);
				if(request === null) {
					throw(new RuntimeException("Request does not exist", 404));
				}
				$request = Request::getRequestByRequestId($pdo, $id);
				$request->setRequestTimeStamp($requestObject->requestTimeStamp);
				$request->setRequestActionTimeStamp($requestObject->requestActionTimeStamp);
				$request->setRequestRequestorText($requestObject->requestRequestorText);
				$request->setRequestAdminText($requestObject->requetAdminText);
				$request->update($pdo);
				//if this isn't supposed to be an admin, take away the temporary admin access
				$security = User::getUserByUserId($pdo, $_SESSION["user"]->getUserId());
				if($security->getUserAccessId() === false) {
					$_SESSION["user"]->setUserAccessId(false);
				}
				$reply->message = "Request updated successfully";
			} elseif($method === "POST") {
				//create new request
				$request = new Request(null, $_SESSION["user"]->getRequestorUserId(), $_SESSION["user"]->getAdminId(), $requestObject->requestTimestamp,
					$requestObject->requestActionTimeStamp, $requestObject->requestActionTimeStamp, $requestObject->requestApprove,
					$requestObject->requestRequestorText, $requestObject->requestRequestorAdminText);
				$request->insert($pdo);
				$reply->message = "Request submitted successfully";
			}
		} elseif($method === "DELETE") {
			$request = Request::getRequestByRequestId($pdo, $id);
			if($request === null) {
				throw(new RuntimeException("Request does not exist", 404));
			}
			$request->delete($pdo);
			$deletedObject = new stdClass();
			$deletedObject->requestId = $id;
			$reply->message = "Request deleted successfully";
		}
	} else {
		//if not an admin and attempting a method other than get, throw an exception
		if((empty($method) === false) && ($method !== "GET")) {
			throw(new RangeException("administrator only privilege", 401));
		}
	}
		catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);

