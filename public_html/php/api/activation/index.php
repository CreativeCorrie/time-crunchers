<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Timecrunchers\Activation;
use Edu\Cnm\Timecrunchers\User;

/**
 * controller/api for activation
 *
 * @author Denzyl Fontaine
 */

//verify the xsrf challenge
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}


try {
	//Grab MySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/time-crunchers.ini");
	//determine which http method was used

	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];


	//handle REST calls, while allowing administrators to access database modifying methods
	if($method === "GET") {
		//set Xsrf cookie
		setXsrfcookie("/");


		//get the Activation based on the given field
		$emailActivation = filter_input(INPUT_GET, "emailActivation", FILTER_SANITIZE_STRING);

		if(empty($emailActivation)) {
			throw(new \RangeException ("No Activation Code"));
		}

		$user = User::getUserByUserActivation($pdo, $emailActivation);

		if(empty($user)) {
			throw(new \InvalidArgumentException ("no user for activation code"));
		}

		$user->setEmailActivation(NULL);
		$user->update();

		// ToDo:  send user to login page

	} else {
		throw(new \Exception("Invalid HTTP method"));
	}
	} catch(Exception $exception) {
		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();
	}  catch (\TypeError $typeError) {
		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();
	}

