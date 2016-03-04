<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Timecrunchers\User;
use EDU\Cnm\Timecrunchers\Company;


/**
 * controller/api for login
 *
 * @author Denzyl Fontaine
 **/

//start session
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the mysql statement
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/timecrunch.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// perform the actual put or post
	if($method === "POST") {

		verifyXsrf();

		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		// check that the necessary fields have been sent and filter
		if(empty($requestObject->userPassword) === true) {
			throw(new InvalidArgumentException ("must enter a password", 405));
		} else {
			$password = filter_var($requestObject->userPassword, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		}

		if(empty($requestObject->userEmail) === true) {
			throw(new InvalidArgumentException ("email cannot be empty", 405));
		} else {
			$email = filter_var($requestObject->userEmail, FILTER_SANITIZE_EMAIL);
		}

		// create user
		$user = User::getUserByUserEmail($pdo, $email);

		if(empty($user)) {
			throw (new InvalidArgumentException("invalid email address"));
		}

		// hash for $password
		$hash =  hash_pbkdf2("sha512", $password, $user->getUserSalt(), 262144);

		// verify hash is correct
		if($hash !== $user->getUserHash()) {
			throw(new \InvalidArgumentException("password or username is incorrect"));
		}

		// grabbing company from database and put company and user in the session
		$company = Company::getCompanyByCompanyId($pdo, $user->getUserCompanyId());
		$_SESSION["company"] = $company;
		$_SESSION["user"] = $user;

		$reply->message = "login was successful";


	} else {
		throw(new \Exception("Invalid HTTP method"));
	}
	} catch(\Exception $exception) {
			$reply->status = $exception->getCode();
			$reply->message = $exception->getMessage();
	} catch (\TypeError $typeError) {
			$reply->status = $exception->getCode();
			$reply->message = $exception->getMessage();
	}

header("Content-type: application/json");
echo json_encode($reply);
