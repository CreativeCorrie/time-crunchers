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
	$pdo = connecToEncrytedMySQL();

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
	userCompanyId = filter_input(INPUT_GET, userCompanyId, FILTER_VALIDATE_INT);
	userCrewId = filter_input(INPUT_GET, userCrewId, FILTER_VALIDATE_INT);
	userAccessId = filter_input(INPUT_GET, userCrewId, FILTER_VALIDATE_INT);
	userPhone = filter_input(INPUT_GET, userPhone, FILTER_SANITIZE_STRING);
	userFirstName = filter_input(INPUT_GET, userFirstName, FILTER_SANITIZE_STRING);
	UserLastName = filter_input(INPUT_GET, userLastName, FILTER_SANITIZE_STRING);
	userEmail = filter_input(INPUT_GET, userEmail, FILTER_SANITIZE_STRING);

}