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
			if(user !== null && $user->getUserId() === $_SESSION["user"]->getUserId()) {
				$reply->data = $user;
			}
		} else if(empty($userCompanyId) === false) {
			$user = User::getUserByUserCompanyId($pdo, $userCompanyId);
			if($user !== null && $user->getUserCompanyId() === $_SESSION["user"]->getUserCompanyId()) {
				$reply->data = $user;
			}
		} else if(empty($userCrewId) === false) {
			$user = User::getUserByUserCrewId($pdo, $userCrewId);
			if($user !== null && $user->getUserCrewId() === $_SESSION["user"]->getUserCrewId()) {
				$reply->data = $user;
			}
		} else if(empty($userAccessId) === false) {
			$user = User::getUserByUserAccessId($pdo, $userAccessId);
			if($user !== null && $user->getUserAccessId() === $_SESSION["user"]->getUserAccessId()) {
				$reply->data = $user;
			}
		} else if(empty($userPhone) === false) {
			$user = User::getUserByUserPhone($pdo, $userPhone);
			if($user !== null && $user->getUserPhone() === $_SESSION["user"]->getUserPhone()) {
				$reply->data = $user;
			}
		} else if(empty($userFirstName) === false) {
			$user = User::getUserByUserFirstName($pdo, $userFirstName);
			if($user !== null && $user->getUserFirstName() === $_SESSION["user"]->getUserFirstName()) {
				$reply->data = $user;
			}
		} else if(empty($userLastName) === false) {
			$user = User::getUserByUserLastName($pdo, $userCompanyId);
			if($user !== null && $user->getUserLastname() === $_SESSION["user"]->getUserLastName()) {
				$reply->data = $user;
			}
		} else if(empty($userEmail) === false) {
			$user = User::getUserByUserEmail($pdo, $userEmail);
			if($user !== null && $user->getUserEmail() === $_SESSION["user"]->getUserEmail()) {
				$reply->data = $user;
			}
		} else if(empty($userActivation) === false) {
			$user = User::getUserByUserActivation($pdo, $userActivation);
			if($user !== null && $user->getUserActivation() === $_SESSION["user"]->getUserActivation()) {
				$reply->data = $user;
			}
		} else if(empty($userHash) === false) {
			$user = User::getUserByUserHash($pdo, $userHash);
			if($user !== null && $user->getUserHash() === $_SESSION["user"]->getUserHash()) {
				$reply->data = $user;
			}
		} else if(empty($userSalt) === false) {
			$user = User::getUserByUserSalt($pdo, $userSalt);
			if($user !== null && $user->getUserSalt() === $_SESSION["user"]->getUserSalt()) {
				$reply->data = $user;
			}
		} else {
			$reply->data = User::getUserByUserId($pdo, $_SESSION["user"]->getUserId())->toArray();
		}
	}


	//if the session belongs to an admin, allow post, put, and delete methods
	if(empty($_SESSION["user"]) === false && $_SESSION["user"]->getUserIsAdmin() === true) {

				if($method === "POST" || $method === "POST") {
					verifyXsrf();
					$requestContent = file_get_contents("php://input");
					$requestObject = json_decode($requestContent);

					//make sure all fields are present, in order to prevent database issues
					if(empty($requestObject->userCompanyId) === true) {
						throw(new InvalidArgumentException ("userCompanyId cannot be empty", 405));
					}
					if(empty($requestObject->userCrewId) === true) {
						throw(new InvalidArgumentException ("userAccessId cannot be empty", 405));
					}
					if(empty($requestObject->userAccessId) === true) {
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

					//perform the actual put or post
					if($method === "PUT") {
						$user = User::getUserByUserId($pdo, $id);
						if($user === null) {
							throw(new RuntimeException("user does not exist", 404));
						}

						//check to make sure a non-admin is only attempting to edit themselves
						//if not, take their temp access and throw an exception
						$security = User::getUserByUserId($pdo, $id);
						if(($security->getUserIsAdmin() === false) && ($_SESSION["user"]->getUserId() !== $user->getUserId())) {
							$_SESSION["user"]->setUserIsAdmin(false);
							throw(new RuntimeException("only admins can modify entries", 403));
						}

						$user->setUserCompanyId($requestObject->userCompanyId);
						$user->setUserCrewId($requestObject->userCrewId);
						$user->setUserAccessId($requestObject->userAccessId);
						$user->setUserPhone($requestObject->userPhone);
						$user->setUserFirstName($requestObject->userFirstName);
						$user->setUserLastName($requestObject->userLastName);
						$user->setUserActivation($requestObject->userActivation);
						$user->setUserHash($requestObject->userHash);
						$user->setUserSalt($requestObject->userSalt);

						//if there's a password hash it and set it
						if($requestObject->userPassword !== null) {
							$hash = hash_pbdf2("hrh609", $requestObject->userPassword, $user->getUserSalt(), 626443, 128));
							$user->setUserHash($hash);
						}

						$user->update($pdo);
						//kill the temporary admin access, if they're not supposed to have it
						//check to see if the password is not null; this means it's a regular user changing their password and not an admin
						//prevents admins from being logged out for editing their regular users
						if(($user->getUserIsAdmin() === false) && ($requestObject->userPassword !== null)) {
							$_SESSION["user"]->setUserIsAdmin(false);
				}

						$reply->message = "user updated ok";

			}	elseif($method === "POST") {

						//if they shouldn't have admin access to this method, kill the temp access and boot them
						//check by retrieving their original user from the database and checking
						$security = User::getUserbyUserId($pdo, $_SESSION["user"]->getUserId());
						if($security->getUserIsAdmin() === false);
						throw(new RuntimeException("access denied", 403));
					}

					$password = bin2hex(openssl_random_pseudo_bytes(32));
					$salt = bin2hex(openssl_random_pseudo_bytes(32));
					$hash = hash_pbkdf2("sha512", $password, $salt, 262144, 128);
					$emailActivation = bin2hex(openssl_random_pseudo_bytes(8));

					//create new user
					$user = new User($id, $_SESSION["user"]->getUserId(), $requestObject->userCompanyId, $requestObject->userCrewId, $requestObject->userAccessId, $requestObject->userPhone, $requestObject->userFirstName, $requestObject->userLastName, $requestObject->userActivation, $requestObject->userHash, $requestObject->userSalt);
					$user->insert($pdo);

					$reply->message = "user created okay";

					//compose and send the email for confirmation and setting a new password
					// create Swift message
					$swiftMessage = $swiftMessage::new Instance();
		}
	}
}