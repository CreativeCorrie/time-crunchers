<?php


require_once(dirname(dirname(__DIR__)) . "/classes/autoloader.php");
require_once(dirname(dirname(__DIR__)) . "/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Timecrunchers\Crew;
use Edu\Cnm\Timecrunchers\Access;

/**
 * controller/api for the crew class
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
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/timecrunch.ini");


//	if the crew session is empty, the user is not logged in, throw an exception
	if(empty($_SESSION["user"]) === true) {
		setXsrfCookie("/");
		throw(new RuntimeException("Please log-in or sign up", 401));
	}

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];
	$reply->method = $method;
	//sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}
	//sanitize and trim the other fields
	$crewCompanyId = filter_input(INPUT_GET, "crewCompanyId", FILTER_VALIDATE_INT);
	$crewLocation = filter_input(INPUT_GET, "crewLocation", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

	//handle REST calls , while only allowing administrators access to database-modifying methods
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie("/");

		//get the crew based on the given field
		if(empty($id) === false) {
			$crew = Crew::getCrewByCrewId($pdo, $id);
			if($crew !== null && $crew->getCrewId() === $_SESSION["user"]->getUserCrewId()) {
				$reply->data = $crew;
			}
		} else if(empty($crewCompanyId) === false) {
			$crew = Crew::getCrewByCrewCompanyId($pdo, $crewCompanyId);
			if($crew !== null && $crew->getCrewId() === $_SESSION["user"]->getUserCrewId()) {
				$reply->data = $crew;
			}
		} else if(empty($crewLocation) === false) {
			$crew = Crew::getCrewByCrewLocation($pdo, $crewLocation);
			if($crew !== null && $crew->getCrewId() === $_SESSION["user"]->getUserCrewId()) {
				$reply->data = $crew;
			}
		}
	} else if($method === "PUT" || $method === "POST" || $method === "DELETE") {

		//	block non-admin users from doing admin-only tasks

		if(Access::isAdminLoggedIn() === true) {

			if($method === "PUT" || $method === "POST") {


					verifyXsrf();
				$requestContent = file_get_contents("php://input");
				$requestObject = json_decode($requestContent);

				if(empty($requestObject->crewCompanyId) === true) {
					throw(new InvalidArgumentException ("Crew company id cannot be empty", 405));
				}
				if(empty($requestObject->crewLocation) === true) {
					throw(new InvalidArgumentException ("Crew Location cannot be empty", 405));
				}

				//perform the actual put or post
				if($method === "PUT") {
					$crew = Crew::getCrewByCrewId($pdo, $id);
					if($crew === null) {
						throw(new RuntimeException("Crew does not exist", 404));
					}
					$crew->setCrewLocation($requestObject->crewLocation);
					$crew->update($pdo);
					$reply->message = "Crew updated OK";
				} else if($method === "POST") {
					$crew = new Crew(null, $requestObject->crewCompanyId, $requestObject->crewLocation);
					$crew->insert($pdo);
					$reply->message = "Crew created OK";
				}

			} else if($method === "DELETE") {
				verifyXsrf();

				$crew = Crew::getCrewByCrewId($pdo, $id);
				if($crew === null) {
					throw(new RuntimeException("Crew does not exist", 404));
				}

				$crew->delete($pdo);
				$deletedObject = new stdClass();
				$deletedObject->crewId = $id;

				$reply->message = "Crew deleted OK";
			}
		} else {
			//if not an admin, and attempting a method other than get, throw an exception
			if((empty($method) === false) && ($method !== "GET")) {
				throw(new RuntimeException("Only administrators are allowed to modify entries", 401));
			}
		}
		//send exception back to the caller
	}
} catch
(Exception $exception) {
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
