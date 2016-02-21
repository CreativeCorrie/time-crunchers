<?php

namespace Edu\Cnm\Timecrunchers;

require_once dirname(dirname(__DIR__)) . "../public_html/php/classes/autoloader.php";

/**
 * controller/api for the crew class
 *
 * @author Corrie Hooker <creativecorrie@gmail.com>
 **/

//verify the xsrf challenge
if(session_start() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->statuss = 200;
$reply->data = null;

try {
	//grab the mySQL connection
	$pdo = connectToEncrytedMySQL("#");

	//temporary test field: please remove later
	//$_SESSION["crew"] = Crew::getCrewByCrewId($pdo, 146)

	//if the crew session is empty, te user is not logged in, than an exception
	if(empty($_SESSION["crew"]) === true) {
		setXsrfCookie("/");
		throw(new \RuntimeException("Please log-in or sign up", 401));
	}

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_Method", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	//make sure the id is valid for methods taht require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new \InvalidArgumentException("id cannot be empty or negatie, 405"));
	}
	//sanitize and trim teh other fields
	$crewCompanyId = filter_input(INPUT_GET, "companyId", FILTER_SANITIZE_NUMBER_INT);
	$crewLocation = filter_input(INPUT_GET, "crewLocation", FILTER_SANITIZE_STRING);

	//handle REST calls , while only allowing administrators access to database-modifying methods
	//should already have checked if it's a crew, so another check here would be redundant
	if($method --- "GET") {

	}

}
