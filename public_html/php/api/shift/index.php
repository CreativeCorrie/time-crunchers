<?php

require_once(dirname(dirname(__DIR__)) . "/classes/autoloader.php");
require_once(dirname(dirname(__DIR__)) . "/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Timecrunchers\Crew;

/**
 * controller/api for the shift class
 *
 * @author Corrie Hooker <creativecorrie@gmail.com>
 **/

//verify the xsrf challenge
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the mySQL connection
	$pdo = connectToEncrytedMySQL("/etc/apache2/capstone-mysql/timecrunch.ini");

	//if the shift session is empty, the user is not logged in, throw an exception
	if(empty($_SESSION["shift"]) === true) {
		setXsrfCookie("/");
		throw(new RuntimeException("Please log-in or sign up", 401));
	}

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative, 405"));
	}
	//sanitize and trim the other fields
	$shiftId = filter_input(INPUT_GET, "shiftId", FILTER_VALIDATE_INT);
	$ShiftUserId = filter_input(INPUT_GET, "shiftUserId", FILTER_VALIDATE_INT);
	$shiftCrewId = filter_input(INPUT_GET, "shiftCrewId", FILTER_VALIDATE_INT);
	$ShiftRequestId = filter_input(INPUT_GET, "shiftRequestId", FILTER_VALIDATE_INT);
	$shiftStartTime = filter_input(INPUT_GET, "shiftStartTime", FILTER_SANITIZE_STRING);
	$shiftDuration = filter_input(INPUT_GET, "shiftDuration", FILTER_SANITIZE_STRING);
	$shiftDate = filter_input(INPUT_GET, "shiftDate", FILTER_SANITIZE_STRING);
	$shiftDelete = filter_input(INPUT_GET, "shiftDelete", FILTER_SANITIZE_STRING);

	//handle REST calls , while only allowing administrators access to database-modifying methods
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie("/");

		//get the shift based on the given field
		if(empty($id) === false) {
			$reply->data = Shift::getShiftByShiftId($pdo, $id);

		} else if(empty($shiftUserId) === false) {
			$reply->data = Shift::getShiftByShiftUserId($id)->toArray();

		} else if(empty($shiftCrewId) === false) {
			$reply->data = Crew::getShiftByShiftCrewId($id)->toArray();

		} else if(empty($shiftRequestId) === false) {
			$reply->data = Crew::getShiftByShiftRequestId($id)->toArray();


		} else {
			$reply->data = Shift::getAllShifts($pdo)->toArray();
		}
	}
	//if the session belongs to an admin, allow post, put and delete methods
	if(empty($_SESSION["shift"]) === false && $_SESSION["shift"]->getShiftIsAdmin() === true) {

		if($method === "PUT" || $method === "POST") {
			verifyXsrf();
			$requestContent = file_get_contents("php://input");
			$requestObject = json_decode($requestContent);

			//make sure all fields are present, in order to prevent database issues
			if(empty($requestObject->shiftUserId) === true) {
				throw(new \InvalidArgumentException ("Shift user id cannot be empty, 405"));
			}
			if(empty($requestObject->shiftCrewId) === true) {
				throw(new \InvalidArgumentException ("Shift crew cannot be empty", 405));
			}
			if(empty($requestObject->shiftRequestId) === true) {
				throw(new \InvalidArgumentException ("Shift request id cannot be empty, 405"));
			}
			if(empty($requestObject->shiftStartTime) === true) {
				throw(new \InvalidArgumentException ("Shift start time cannot be empty", 405));
			}
			if(empty($requestObject->shiftDuration) === true) {
				throw(new \InvalidArgumentException ("Shift duration cannot be empty, 405"));
			}
			if(empty($requestObject->shiftDate) === true) {
				throw(new \InvalidArgumentException ("Shift date cannot be empty", 405));
			}
			if(empty($requestObject->shiftDelete) === true) {
				$requestObject->shiftDelete = null;
			}


			//perform the actual put or post
			if($method === "PUT") {
				$shift = Shift::getShiftByShiftId($pdo, $id);
				if($shift === null) {
					throw(new RuntimeException("Shift does not exist", 404));
				}

				$shift = new Shift($id, $requestObject->shiftUserId, $requestObject->shiftCrewId), $requestObject->shiftRequestId, $requestObject->shiftStartTime, $requestObject->shiftDuration, $requestObject->shiftDate, $requestObject->shiftDelete);

				$shift->update($pdo);

				$reply->message = "Shift updated OK";


			} elseif($method === "POST") {
				$shift = new Shift($id, $requestObject->shiftUserId, $requestObject->shiftCrewId), $requestObject->shiftRequestId, $requestObject->shiftStartTime, $requestObject->shiftDuration, $requestObject->shiftDate, $requestObject->shiftDelete);
				$shift->insert($pdo);

				$reply->message = "Shift created OK";
			}

		} else if($method === "DELETE") {
			verifyXsrf();

			$shift = Shift::getShiftByShiftId($pdo, $id);
			if($shift === null) {
				throw(new \RuntimeException("Shift does not exist, 404"));
			}

			$shift->delete($pdo);
			$deleteObject = new \stdClass();
		}
		$deleteObject->ShiftId = $id;

		$reply->message = "Shift deleted OK";
	} else {
		//if not an admin, and attempting a method other than get, throw an exception
		if((empty($method) === false) && ($method !== "GET")) {
			throw(new \RuntimeException("Only administrators are allowed to modify entries", 401));
		}
	}

	//send exception back to the caller
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);