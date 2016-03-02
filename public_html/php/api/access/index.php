<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Timecrunchers\Access;


/**
 * Controller/API for the Access class
 *
 * @author Denzyl Fontaine
 **/

//verify the XSRF challenge
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the mySQL
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/timecrunch.ini");

	//if the access session is empty, the user is not logged in, throw an exception
	if(empty($_SESSION["user"]) === true) {
		setXsrfCookie("/");
		throw(new RunTimeException("Please log-in or sign up", 401));
	}

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}

	//sanitize and trim other fields
	// this is an optional field - wrap it in an if
	$accessName = filter_input(INPUT_GET, "accessName", FILTER_SANITIZE_STRING);

	//handle REST calls, while only allowing administrators to access database-modifying methods
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie("/");

		//get the Access based on the given field
		if(empty($id) === false) {
			$access = Access::getAccessByAccessId($pdo, $id);
			// this is for restricting by company - remember is access is wide open
			// however keep this stuff for other APIs :D
			if($access !== null) {  //TODO: I removed this from after null:  && $access->getAccessId() === $_SESSION["access"]->getAccessId()
				$reply->data = $access;
			}
		} else if(empty($id) === false) {
			$access = Access::getAccessByAccessName($pdo, $accessName);
			if($access !== null) {  //TODO: I removed this from after null:  && $access->getAccessId() === $_SESSION["access"]->getAccessId()
				$reply->data = $reply;
			}
		} else {
			$access = Access::getAllAccess($pdo);
			if($accessors !== null) {
				$reply->data = $accessors;
				//TODO: this was the line after the above if $reply->data = Access::getAccessByAccessId($pdo, $_SESSION["access"]->getAccessId())->toArray();
			}
		}

		//if the session belongs to an admin, allow post, put and delete methods
		if(Access::isAdminLoggedIn() === true) {
			if($method === "PUT" || $method === "POST") {

				verifyXsrf();
				$requestContent = file_get_contents("php://input");
				$requestObject = json_decode($requestContent);

				//make sure all fields are present, in order to fix database issues
				if(empty($requestObject->accessName) === true) {
					throw(new InvalidArgumentException ("accessName cannot be null", 405));
				}

				//perform put or post
				if($method === "PUT") {
					$access = Access::getAccessByAccessId($pdo, $id);
					if($access === null) {
						throw(new RuntimeException("access does not exist", 404));
					}

					$access = new Access($id, $requestObject->accessName);
					$access->update($pdo);

					$reply->message = "Access updated ok";

					//check to make sure a non-admin is only attempting to edit themselves
					//if not, take their temp access and throw an exception
					//TODO: not sure if we need this line here: $security = Access::getAccessByAccessId($pdo, $_SESSION["access"]->getAccessId());
					// use the example from Slack to determine admins

				} else if($method === "POST") {
					//TODO: I'm pretty sure this has already been done above: if(Access::isAdminLoggedIn() === true) {
					// adminy thingz here
//					} else {
//						throw(new RuntimeException("Must be an Administrator to access."));
//					}
//				}
					$access = new Access(null, $requestObject->accessName);
					$access->insert($pdo);

					$reply->message = "Access created OK";
				}
			}
		} else {
			throw (new RuntimeException("Must be an administrator to gain access."));
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