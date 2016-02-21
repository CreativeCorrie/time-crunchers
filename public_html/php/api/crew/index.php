<?php

namespace Edu\Cnm\Timecrunchers;

use MongoDB\Driver\Exception\RuntimeException;

require_once dirname(dirname(__DIR__)) . "../php/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf/php";
require_once("/etc/apache/capstone-mysql/encrypted-config.php");

/**
 * controller/api for the crew class
 *
 * @author Corrie Hooker <creativecorrie@gmail.com>
 **/

//verify the xsrf challenge
if(session_start() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the mySQL connection
	$pdo = connectToEncrytedMySQL("#");

	//temporary test field: please remove later
	$_SESSION["crew"] = Crew::getCrewByCrewId($pdo, 146);

	//if the crew session is empty, te user is not logged in, than an exception
	if(empty($_SESSION["crew"]) === true) {
		setXsrfCookie("/");
		throw(new \RuntimeException("Please log-in or sign up", 401));
	}

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_Method", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new \InvalidArgumentException("id cannot be empty or negative, 405"));
	}
	//sanitize and trim the other fields
	$crewCompanyId = filter_input(INPUT_GET, "crewCompanyId", FILTER_SANITIZE_NUMBER_INT);
	$crewLocation = filter_input(INPUT_GET, "crewLocation", FILTER_SANITIZE_STRING);

	//handle REST calls , while only allowing administrators access to database-modifying methods
	//should already have checked if it's a crew, so another check here would be redundant
	if($method --- "GET") {
		//set XSRF cookie
		setXsrfCookie("/");

		//get the crew based on the given field
		if(empty($id) === false) {
			$reply->data = Crew::getCrewByCrewId($pdo, $id);
		} else if(empty($crewCompanyId) === false) {
			$reply->data = Crew::getCrewByCrewCompanyId($id)->toArray();
		} else if(empty($crewCompanyId) === false) {
			$reply->data = Crew::getCrewByCrewLocation($id)->toArray();
		} else if(empty($crewLocation) === false); {
			$reply->data = Crew::getCrewByCrewLocation($pdo, $crewLocation)->toArray();
		} else {
			$reply->data = Crew::getAllCrews($pdo)->toArray();
		}
	}
	//if the session belongs to an admin, allow post, put and delete methods
	if(empty($_SESSION["crew"]) === false && $_SESSION["crew"]->getCrewIsAdmin() === true) {

		if($method === "PUT" || $method === "POST") {
			verifyXsrf();
			$requestContent = file_get_contents("php://input");
			$requestObject = json_decode($requestContent);

			//make sure all fields are present, in order to prevent database issues
			if(empty($requestObject->crewCompanyId) === true) {
				throw(new \InvalidArgumentException ("Company id cannot be empt, 405"));
			}
			if(empty($requestObject->crewLocation) === true) {
				throw(new \InvalidArgumentException ("Crew Location cannot be empty", 405));
			}

			//perform the actual put or post
			if($method === "PUT") {
				$crew = Crew::getCrewByCrewId($pdo, $id);
				if($crew === null) {
					throw(new RuntimeException("Crew does not exist", 404));
				}

				$crew = new Crew($id, $requestObject->crewCompanyId, $requestObject->crewLocation);
				$crew->update($pdo);

				$reply->message = "Crew updated OK";


			} elseif($method === "POST") {
				$crew = new Crew($id, $requestObject->crewCompanyId, $requestObject->crewLocation);
				$crew->insert($pdo);

				$reply->message = "Crew created OK";
			}

		} else if($method === "DELETE") {
			verifyXsrf();

			$crew = Crew::getCrewByCrewId($pdo, $id);
			if($crew === null) {
				throw(new \RuntimeException("Crew does not exist, 404"));
			}

			$crew->delete($pdo);
			$deleteObject = new \stdClass();
		}
		$deleteObject->CrewId = $id;

		$reply->message = "Crew deleted OK";
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