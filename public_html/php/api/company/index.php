<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(dirname(__DIR__))) . "php/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Timecrunchers\Company;



/**
 * Controller/API for Company Class
 *
 * @author Elaine Thomas <el41net@gmail.com>
 **/

//Verify XSRF Challenge
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//Prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//Grab MySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/time-crunchers.ini");

	//Determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//Sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

	//Make sure ID is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("ID cannot be empty or negative", 405));
	}

	//Sanitize and trim other fields
	$companyName = filter_input(INPUT_GET, "companyName", FILTER_SANITIZE_STRING);
	$companyAddress1 = filter_input(INPUT_GET, "companyAddress1", FILTER_SANITIZE_STRING);
	$companyAddress2 = filter_input(INPUT_GET, "companyAddress2", FILTER_SANITIZE_STRING);
	$companyAttn = filter_input(INPUT_GET, "companyAttn", FILTER_SANITIZE_STRING);
	$companyState = filter_input(INPUT_GET, "companyState", FILTER_SANITIZE_STRING);
	$companyCity = filter_input(INPUT_GET, "companyCity", FILTER_SANITIZE_STRING);
	$companyZip = filter_input(INPUT_GET, "companyZip", FILTER_SANITIZE_STRING);
	$companyPhone = filter_input(INPUT_GET, "companyPhone", FILTER_SANITIZE_STRING);
	$companyEmail = filter_input(INPUT_GET, "companyEmail", FILTER_SANITIZE_STRING);
	$companyUrl = filter_input(INPUT_GET, "companyUrl", FILTER_SANITIZE_STRING);

	//Handle REST calls
	if($method === "GET") {
		//Set XSRF cookie
		setXsrfCookie("/");

		//Get Company based on given field
		if(empty($id) === false) {
			$company = Company::getCompanyByCompanyId($pdo, $id);
			if($company !== null) {
				$reply->data = $company;
			}
		} else if(empty($companyAddress1) === false) {
			$company = Company::getCompanyByCompanyName($pdo, $companyAddress1);
			if($company !== null) {
				$reply->data = $company;
			}
		} else {
			$companies = Company::getAllCompanies($pdo);
			if($companies !== null) {
				$reply->data = $companies;
			}
		}

		//if the session belongs to an admin, allow post, put, and delete methods
		if(empty($_SESSION["user"]) === false && $_SESSION["user"]->getUserIsAdmin() === true) {

			if($method === "PUT" || $method === "POST") {

				verifyXsrf();
				$requestContent = file_get_contents("php://input");
				$requestObject = json_decode($requestContent);

				//make sure all fields are present, in order to prevent database issues
				if(empty($requestObject->companyName) === true) {
					throw(new InvalidArgumentException ("company name cannot be empty", 405));
				}
				if(empty($requestObject->companyAddress1) === true) {
					throw(new InvalidArgumentException ("company address cannot be empty", 405));
				}
				if(empty($requestObject->companyAddress2) === true) {
					$requestObject->companyAddress2 = null;
				}
				if(empty($requestObject->companyAttn) === true) {
					$requestObject->companyAttn = null;
				}
				if(empty($requestObject->companyState) === true) {
					throw(new InvalidArgumentException ("company state cannot be empty", 405));
				}
				if(empty($requestObject->companyCity) === true) {
					throw(new InvalidArgumentException ("company city cannot be empty", 405));
				}
				if(empty($requestObject->companyZip) === true) {
					throw(new InvalidArgumentException ("company phone cannot be empty", 405));
				}
				if(empty($requestObject->companyPhone) === true) {
					throw(new InvalidArgumentException ("company city cannot be empty", 405));
				}
				if(empty($requestObject->companyEmail) === true) {
					throw(new InvalidArgumentException ("company email cannot be empty", 405));
				}
				if(empty($requestObject->companyUrl) === true) {
					$requestObject->companyUrl = null;
				}

				//perform the actual put or post
				if($method === "PUT") {
					$company = Company::getCompanyByCompanyId($pdo, $id);
					if($company === null) {
						throw(new RuntimeException("Company does not exist", 404));
					}

					$company = new Company($id, $requestObject->companyName, $requestObject->companyAddress1, $requestObject->companyAddress2, $requestObject->companyAttn, $requestObject->companyState, $requestObject->companyCity, $requestObject->companyZip, $requestObject->companyPhone, $requestObject->companyEmail,
						$requestObject->companyUrl);
					$company->update($pdo);

					$reply->message = "Company updated OK";

				} else if($method === "POST") {
					$company = new Company(null, $requestObject->companyName, $requestObject->companyAddress1, $requestObject->companyAddress2, $requestObject->companyAttn, $requestObject->companyState, $requestObject->companyCity, $requestObject->companyZip, $requestObject->companyPhone, $requestObject->companyEmail,
						$requestObject->companyUrl);
					$company->insert($pdo);

					$reply->message = "Company created OK";
				}}

			} else if($method === "DELETE") {
				verifyXsrf();

				$company = Company::getCompanyByCompanyId($pdo, $id);
				if($company === null) {
					throw(new RuntimeException("Company does not exist", 404));
				}

				$company->delete($pdo);
				$deletedObject = new stdClass();
				$deletedObject->companyId = $id;

				$reply->message = "Company deleted OK";
			}
		} else {
			//if not an admin, and attempting a method other than get, throw an exception
			if((empty($method) === false) && ($method !== "GET")) {
				throw(new RuntimeException("Only administrators are allowed to modify entries", 401));
			}
		}

		//send exception back to the caller
	}

catch
	(Exception $exception) {
		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();
	}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);
