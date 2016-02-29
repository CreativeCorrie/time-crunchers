<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Timecrunchers\Activation;

/**
 * controller/api for activation
 *
 * @author Denzyl Fontaine
 */

//verify the xsrf challenge
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//Grab MySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/time-crunchers.ini");
	//determine which http method was used

	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];


	//handle REST calls, while allowing administrators to access database modifying methods
	if($method === "GET") {
		//set Xsrf cookie
		setXsrfcookie("/");
	}

		//get the Activation based on the given field
		$emailActivation = filter_input(INPUT_GET, "emailActivation", FILTER_VALIDATE_STRING);
		$email = filter_input(INPUT_GET, "employeeEmail", FILER_VALIDATE_EMAIL);
		if($emailActivation === false || $email === false) {
			throw(new \RangeException ("email activation or username cannot be empty"));
		}

		$user = User::getUserByUserEmail($pdo, $email);

		if($emailActivation !== $user->getUserActivation) {
			throw(new \InvalidArgumentException ("activation code does not match"));
		}

		$user->setEmailActivation(NULL);
		$user->update();
		$reply->message = "successful activation!";

	} catch(Exception $exception) {
		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();
	}  catch (\TypeError $typeError) {
		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();
	}
echo json_encode($reply);