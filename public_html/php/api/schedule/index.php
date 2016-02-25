<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Timecrunchers\Schedule;
use Edu\Cnm\Timecrunchers\Access;


/**
 * Controller/API for Schedule Class
 *
 * @author Elaine Thomas <el41net@gmail.com>
 **/

//Verify XSRF Challenge
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//Prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//Grab MySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/time-cruncher.ini");

	//Determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//Sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//Make sure ID is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("ID cannot be empty or negative", 405));
	}

	//Sanitize and trim other fields
	$scheduleCrewId = filter_input(INPUT_GET, "scheduleCrewId", FILTER_VALIDATE_INT);
	$scheduleStartDate = filter_input(INPUT_GET, "scheduleStartDate", FILTER_SANITIZE_STRING);

	//Handle REST calls
	if($method === "GET") {
		//Set XSRF cookie
		setXsrfCookie("/");

		//Get Schedule based on given field
		if(empty($id) === false) {
			$schedule = Schedule::getScheduleByScheduleId($pdo, $id);
			if($schedule !== null) {
				$reply->data = $schedule;
			}
		} else if(empty($scheduleAddress1) === false) {
			$schedule = Schedule::getScheduleByScheduleCrewId($pdo, $scheduleCrewId);
			if($schedule !== null) {
				$reply->data = $schedule;
			}
		} else {
			$schedules = Schedule::getAllSchedules($pdo);
			if($schedules !== null) {
				$reply->data = $schedules;
			}
		}

		//	block non-admin users from doing admin-only tasks
		if($method === "PUT") {
			if(Access::isAdminLoggedIn() === true) {
				// adminy thingz herez
			} else {
				throw(new RuntimeException("Must be an Administrator to access."));
			}
		}

		//if the session belongs to an admin, allow post, put, and delete methods
		if(empty($_SESSION["user"]) === false && $_SESSION["user"]->getUserIsAdmin() === true) {

			if($method === "PUT" || $method === "POST") {

				verifyXsrf();
				$requestContent = file_get_contents("php://input");
				$requestObject = json_decode($requestContent);

				//make sure all fields are present, in order to prevent database issues
				if(empty($requestObject->scheduleCrewId) === true) {
					throw(new InvalidArgumentException ("crew ID for this schedule cannot be empty", 405));
				}
				if(empty($requestObject->scheduleStartDate) === true) {
					throw(new InvalidArgumentException ("please input schedule start date", 405));
				}

				//perform the actual put or post
				if($method === "PUT") {
					$schedule = Schedule::getScheduleByScheduleId($pdo, $id);
					if($schedule === null) {
						throw(new RuntimeException("Schedule does not exist", 404));
					}

					$schedule = new Schedule($id, $requestObject->scheduleCrewId, $requestObject->scheduleStartDate);
					$schedule->update($pdo);

					$reply->message = "Schedule updated OK";

				} else if($method === "POST") {
					$schedule = new Schedule(null, $requestObject->scheduleCrewId, $requestObject->scheduleStartDate);
					$schedule->insert($pdo);

					$reply->message = "Schedule created OK";
				}
			}

		} else if($method === "DELETE") {
			verifyXsrf();

			$schedule = Schedule::getScheduleByScheduleId($pdo, $id);
			if($schedule === null) {
				throw(new RuntimeException("Schedule does not exist", 404));
			}

			$schedule->delete($pdo);
			$deletedObject = new stdClass();
			$deletedObject->scheduleId = $id;

			$reply->message = "Schedule deleted OK";
		}
	} else {
		//if not an admin, and attempting a method other than get, throw an exception
		if((empty($method) === false) && ($method !== "GET")) {
			throw(new RuntimeException("Only administrators are allowed to modify entries", 401));
		}
	}

	//send exception back to the caller
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
//this is the end of the try block

header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);
