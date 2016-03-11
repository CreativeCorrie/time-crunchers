<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once dirname(dirname(__DIR__)) . "/lib/sendEmail.php";
use Edu\Cnm\Timecrunchers\User;
use Edu\Cnm\Timecrunchers\Access;

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
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/timecrunch.ini");

//	//if the user session is empty, user is not logged in, throw an exception
//	if(empty($_session["user"]) === true)
//		verifyXsrf();
//		throw(new RuntimeException("please login and set up", 401));
//	}

	//determine which http has used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];
	$reply->method=$method;


	//sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be negative or empty", 405));
	}
	//sanitize and trim other fields
	$userCompanyId = filter_input(INPUT_GET, "userCompanyId", FILTER_VALIDATE_INT);
	$userCrewId = filter_input(INPUT_GET, "userCrewId", FILTER_VALIDATE_INT);
	$userAccessId = filter_input(INPUT_GET, "userAccessId", FILTER_VALIDATE_INT);
	$userPhone = filter_input(INPUT_GET, "userPhone", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userFirstName = filter_input(INPUT_GET, "userFirstName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userLastName = filter_input(INPUT_GET, "userLastName", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$userEmail = filter_input(INPUT_GET, "userEmail", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);



	//handle rest calls, while only allowing admins to access database-modifying methods
	if($method === "GET") {
		//set xsrf-cookie
		setXsrfCookie("/");
		//get the user based on the given
		if(empty($id) === false) {
			$user = User::getUserByUserId($pdo, $id);
			if($user !== null) { //&& $user->getUserId() === $_SESSION["user"]->getUserId()) {
				$reply->data = $user;
			}
		} else if(empty($userEmail) === false) {
			$user = User::getUserByUserEmail($pdo, $userEmail);
			if($user !== null) {
				$reply->data = $user;
			}
		} else if(empty($userActivation) === false) {
			$user = User::getUserByUserActivation($pdo, $id);
			if($user !== null) {
				$reply->data = $user;
			}
		} else {
			$users = User::getAllUsers($pdo);
			$reply->data = $users;
		}
	}
	//if the session belongs to an admin, allow post, put, and delete methods
	if(empty($_SESSION["user"]) === false) {

			if(true === true) {

				if($method === "PUT" || $method === "POST") {
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
					if(empty($requestObject->userEmail) === true) {
						throw(new InvalidArgumentException ("userEmail cannot be empty", 405));
					}

					//perform the actual put or post
					if($method === "PUT") {


						$user = User::getUserByUserId($pdo, $id);
						if($user === null) {
							throw(new RuntimeException("user does not exist", 404));
						}
						$user->setUserEmail(filter_var($requestObject->userEmail, FILTER_SANITIZE_EMAIL));
						$user->setUserPhone($requestObject->userPhone);
						$user->setUserFirstName($requestObject->userFirstName);
						$user->setUserLastName($requestObject->userLastName);


						//if there's a password hash it and set it
						if(isset($requestObject->userPassword) === true && isset($requestObject->confirmPassword) === true) {

							if($requestObject->userPassword !== $requestObject->confirmPassword) {
								throw (new \RangeException("password and confirmPassword do not match"));
							} else {
								$hash = hash_pbkdf2("sha512", $requestObject->userPassword, $user->getUserSalt(), 262144);
								$user->setUserHash($hash);
							}
						}

						$user->update($pdo);
						$reply->message="User updated successfully.";


					} else if($method === "POST") {
						$password = bin2hex(random_bytes(32));
						$salt = bin2hex(random_bytes(32));
						$hash = hash_pbkdf2("sha512", $password, $salt, 262144);
						$emailActivation = bin2hex(random_bytes(16));
						//create new user
						$user = new User(null, $_SESSION["company"]->getCompanyId(), $requestObject->userCrewId, $requestObject->userAccessId, $requestObject->userPhone, $requestObject->userFirstName, $requestObject->userLastName, $requestObject->userEmail, $emailActivation, $hash, $salt);
						$user->insert($pdo);

						//building the activation link that can travel to another server and still work. This is the link that will be clicked to confirm the account.
						$basePath = dirname($_SERVER["SCRIPT_NAME"], 4);
						$urlglue = $basePath . "/activation/?emailActivation=" . $user->getUserActivation();
						$confirmLink = "https://" . $_SERVER["SERVER_NAME"] . $urlglue;
						$messageSubject = "This is an important message about your account activation.";
						$message = <<< EOF
<h1>You've been registered for the Timecrunchers Scheduling!</h1>
<p>Visit the following URL to set a new password and complete the registration process: </p>
<p><a href="$confirmLink">$confirmLink</a></p>
EOF;

						$response = sendEmail($user->getUserEmail(), $user->getUserFirstName(), $user->getUserLastName(), $messageSubject, $message);
						if($response === "Email sent.") {
							$reply->message = "sign up was successful, please check your email for activation message.";
						}

						/**
						 * the send method returns the number of recipients that accepted the Email
						 * so, if the number attempted is not the number accepted, this is an Exception
						 **/


					}
				}else if ($method === "DELETE") {
						$reply->debug="delete started";
						$user = User::getUserByUserId($pdo, $id);
						if($user === null) {
							throw(new RuntimeException("User does not exist", 404));
						}

						$user->delete($pdo);
						$deletedObject = new stdClass();
						$deletedObject->crewId = $id;

						$reply->message = "Crew deleted OK";
					}

					else {
						//if not an admin, and attempting a method other than get, throw an exception
						if((empty($method) === false) && ($method !== "GET")) {
							throw(new RuntimeException ("only admins can change database entries", 401));
						}
				}
			}
	}
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(\TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);