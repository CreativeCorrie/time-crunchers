<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "lib/xsrf.php";
require_once("/etc/apache2/Timecrunchers-mysql/encryption-config.php");
require_once(dirname(dirname(dirname(dirname(__DIR__)))) . "vendor/autolader.php");

use Edu\Cnm\Timecrunchers\Company;
use Edu\Cnm\Timecrunchers\Crew;
use Edu\Cnm\Timecrunchers\User;

/**
 * controller/api for user class
 *
 * @author Denzyl Fontaine
 */

//verify xsrf challenge
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare a empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the sql connection
	$pdo = connectToEncrytedMySQL();

	//if the user session is empty, user is not logged in, throw an exception
	if(empty($_session["volunteer"]) === true) {
		setXsrfCookie("/");
		throw(new RuntimeException("please login and set up", 401));
	}

	//determine which http has used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize inputs
	$id = filter_input(INPUT_GET, "ID", FILTER_VALIDATE_INT);
	//make sure the id is valid for methods that require it
	if(($method === "DELETE" ||$method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be negative or empty", 405));
	}
	//sanitize and trim other fields
	userCompanyId = filter_input(INPUT_GET, "userCompanyId", FILTER_VALIDATE_INT);
	userCrewId = filter_input(INPUT_GET, "userCrewId", FILTER_VALIDATE_INT);
	userAccessId = filter_input(INPUT_GET, "userAccessId", FILTER_VALIDATE_INT);
	userPhone = filter_input(INPUT_GET, "userPhone", FILTER_SANITIZE_STRING);
	userFirstName = filter_input(INPUT_GET, "userFirstName", FILTER_SANITIZE_STRING);
	UserLastName = filter_input(INPUT_GET, "userLastName", FILTER_SANITIZE_STRING);
	userEmail = filter_input(INPUT_GET, "userEmail", FILTER_SANITIZE_STRING);
	userActivation = filter_input(INPUT_GET, "userActivation", FILTER_SANITIZE_STRING);
	userHash = filter_input(INPUT_GET, "userActivation", FILTER_SANITIZE_STRING);
	userSalt = filter_input(INPUT_GET, "userSalt", FILTER_SANITIZE_STRING);

	//handle rest calls, while only allowing admins to access database-modifying methods
	if($method === GET) {
		//set xsrf-cookie
		setXsrfCookie("/");

		//get the user based on the given
		if(empty($id) === false) {
			$user = User::getUserByUserId($pdo, $id);
			if(user !== null && $user->getAccessId() === $_SESSION["access"]->getAccessId()) {
				$reply->data = $user;
			}
		} else if(empty )















				if($method === "POST" || $method === "POST") {
					verifyXsrf();
					$requestContent = file_get_contents("php://input");
					$requestObject = json_decode($requestContent);

					//make sure all fields are present, in order to prevent database issues
					if(empty($requestObject->userCompanyId) === true) {
						throw(new InvalidArgumentException ("userCompanyId cannot be empty", 405));
					}
					if(empty($requestObject->userAccessId) === true) {
						throw(new InvalidArgumentException ("userAccessId cannot be empty", 405));
					}
					if(empty($requestObject->userCrewId) === true) {
						throw(new InvalidArgumentException ("userCrewId cannot be empty", 405));
					}
					if(empty($requestObject->userPhone) === true) {
						throw(new InvalidArgumentException ("userPhone cannot be empty", 405));
					}
					if(empty($requestObject->userFirstName) === true) {
						throw(new InvalidArgumentException ("userFirstName cannot be empty", 405));
					}
					if(empty($requestObject->userLastName) === true) {
						throw(new InvalidArgumentException ("userLastName cannot be empty", 405));
					}
					if(empty($requestObject->userActivation) === true) {
						throw(new InvalidArgumentException ("userActivation cannot be empty", 405));
					}
					if(empty($requestObject->userHash) === true) {
						throw(new InvalidArgumentException ("userHash cannot be empty", 405));
					}
					if(empty($requestObject->userSalt) === true) {
						throw(new InvalidArgumentException ("userSalt", 405));
					}

				}
			}
		}
	}

}