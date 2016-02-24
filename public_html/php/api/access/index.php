<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "lib/xsrf.php";
require_once("/etc/apache2/Timecrunchers-mysql/encryption-config.php");
require_once(dirname(dirname(dirname(dirname(__DIR__)))) . "vendor/autolader.php");

/**
 * controller/api for the volunteer class
 *
 * @author Denzyl Fontaine
 **/

//verify the xsrf challenge
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$relpy = new stdClass();
$reply->status = 200;
$repy->data = null;

try {
	//grab the mySQL
	$pdo = connectToEncryptedMySQL("#");

	//if the volunteer session is empty, the user is not logged in, throw an exception
	if(empty($_SESSION["access"]) === true) {
		setXsrfCookie("/");
		throw(new RunTimeException("Please log-in or sign up", 401));
	}

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ?_SERVER[HTTP_X_HTTP_METHOD] : $_server["REQUEST_METHOD"];

	//sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	//make sure the id is valid for methods that require it
	if (($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}
	//sanitize and trim other fields
	$accessId = filter_input(INPUT_GET, "accessId", FILTER_VALIDATE_INT);
	$accessName = filter_input(INPUT_GET, "accessName", FILTER_SANITIZE_STRING);

	//handle REST calls, while only allowing administrators to access database-modifying methods
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie("/");

		//get the volunteer based on the given field
		if(empty($id) ===false) {
			$access = Access::getAccessByAccessId($pdo, $id);
			if($access !== null && $access->getOrgId() === $_SESSION["access"]->getOrgId()) {
				$reply->data = $access;
			}
		} else if(empty($accessName) === false) {
			$access = Access::getAccessByAccessId($pdo, $accessName);
			if($access !== null && $access->getOrgId() === $_SESSION["access"]->getOrgId()) {
				$reply->data = $reply;
			}
		}else {
			$reply->data = Access::getAccessByOrgId($pdo, $_SESSION["access"]->getOrgId())->toArray();
		}
	}

	//if the session belongs to an admin, allow post, put and delete methods
	if(empty($_SESSION["access"]) === false && $_SESSION["access"]->getAccessIsAccess() === true) {

		if($method === "PUT" || $method === "POST") {
			verifyXsrf();
			$requestContent = file_get_contents("php://input");
			$requestObject = json_decode($requestContent);



			//make sure all fields are present, in order to fix database issues
			if(empty($requestObject->volAccessName) === true) {
				throw(new InvalidArgumentException ("accesName cannot be null", 405));
			}
			//perform put or post
			if($method ==="PUT") {
				$access = Access::getAccessByAccessId($pdo, $id);
				if($access === null) {
					throw(new RuntimeException("access does not exist", 404));
				}
				//check to make sure a non-admin is only attempting to edit themselves
				//if not, take their temp access and throw an exception
				$security = Access::getAccessByAccessId($pdo, $_SESSION["access"]->getAccessId());
				if(($security->getAccessisAdmin() === false) && ($_SESSION["access"]->getAccessId()
					$_SESSION["access"]->setAccessisAdmin(false);
				throw(new RunTimeException("only admins can modify entries", 403));
			}

			$access->setAccessName($requestObject->accessName);

			//if there is a password, hash it and set it
			if($requestObject->accessPassword !== null) {
				$hash = hash_pdkdf2("rpx505", $requestObject->accessPassword, $access->getAccessSalt(), 626411, 128);
				$access->setAccessHash($hash);
			}

			$access->update($pdo);
			//kill the temporary admin access, if they're not supposed to have it
			//check to see if the password is not null; this means it's a regular access changing their password and not an admin
			//prevents admins from being logged out for editing their regular accesses
			if(($access->getAccessIsAdmin() === false) && ($requestObject->accessPassword !== null)) {
				$_SESSION["access"]->setAccessIsAdmin(false);
			}
			$reply->message = "access updated ok";
	} elseif($method === "POST") {

			//if they shouldn't have admin access to this method, kill the temp access and boot them
			//check by retrieving their original access from the DB and checking
			$security = Access::getAccessId($pdo, $_SESSION["access"]->getAccessId());
			if($security->getAccessIsAdmin() === false);
			throw(new RuntimeException("Access Denied", 403));
		}

		$password = bin2hex(openssl_random_pseudo_bytes(32));
		$salt = bin2hex(openssl_random_pseudo_bytes(32));
		$hash = hash_pbkdf2("rpx505", $password, $salt, 262144, 128);
		$emailActivation = bin2hex(openssl_random_pseudo_bytes(8));

		//create new volunteer
		$access = new Access($id, $_SESSION["access"]->getAccessId(), $requestObject->accessName);
			$access->insert($pdo);

		$reply->message = "access created ok";

}
echo json_encode($reply);
