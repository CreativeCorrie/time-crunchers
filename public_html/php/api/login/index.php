<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Timecrunchers\Login;
use Edu\Cnm\Timecrunchers\User;

/**
 * controller/api for the index class
 *
 * @author Denzyl Fontaine
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
	//grab the mysql statement
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/time-crunchers.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// perform the actual put or post
	if($method === "POST") {

		$password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_STRING);
		$email = filter_input(INPUT_POST, "employeeEmail", FILER_VALIDATE_EMAIL);
		if($password === false || $email === false) {
			throw(new \RangeException ("password or username cannot be empty"));
		}

		$user = User::getUserByUserEmail($pdo, $email);
		$company = Company::getCompanyByCompanyId($pdo, $user->getUserCompanyId);

		$hash =  hash_pbkdf2("sha512", $password, $user->getUserSalt, 262144);

		if($hash !== $user->getUserHash) {
			throw(new \InvalidArgumentException("password or usernameis incorrect"));
		}

		start_session();
		$_SESSION["company"] = $company;

		$reply->message = "login was successful";
	}
} catch(\Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch (\TypeError $typeError) {
		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();
}
echo json_encode($reply);
