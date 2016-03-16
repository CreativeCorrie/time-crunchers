<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
require_once dirname(dirname(__DIR__)) . "/lib/sendEmail.php";

use Edu\Cnm\Timecrunchers\User;
use Edu\Cnm\Timecrunchers\Company;
use Edu\Cnm\Timecrunchers\Crew;
use Edu\Cnm\Timecrunchers\Access;


/**
 * Controller/API to handle sign up for TimeCrunch
 *
 * @author Elaine Thomas <el41net@el41net.com>
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
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/timecrunch.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// perform the actual put or post
	if($method === "POST") {

		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		//check that the user fields that are required have been sent
		if(empty($requestObject->userFirstName) === true) {
			throw(new InvalidArgumentException ("Must fill in first name."));
		} else {
			$userFirstName = filter_var($requestObject->userFirstName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		}

		if(empty($requestObject->userLastName) === true) {
			throw(new InvalidArgumentException ("Must fill in last name."));
		} else {
			$userLastName = filter_var($requestObject->userLastName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		}

		if(empty($requestObject->userEmail) === true) {
			throw(new InvalidArgumentException ("Must fill in email address."));
		} else {
			$userEmail = filter_var($requestObject->userEmail, FILTER_SANITIZE_EMAIL);
		}

		//if(empty($requestObject->password) === true) {
		//throw(new InvalidArgumentException ("Must fill in password."));
		//} else {
		//	$password = filter_var($requestObject->password, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		//}

//		if(empty($requestObject->verifyPassword) === true) {
		//		throw(new InvalidArgumentException ("Please verify password."));
		//} else {
		//$verifyPassword = filter_var($requestObject->verifyPassword, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		//}

		if(empty($requestObject->userPhone) === true) {
			throw(new InvalidArgumentException ("Must fill in userPhone number."));
		} else {
			$userPhone = filter_var($requestObject->userPhone, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		}

		if(empty($requestObject->companyName) === false) {

			$companyName = filter_var($requestObject->companyName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

			if(empty($requestObject->companyAddress1) === true) {
				throw(new InvalidArgumentException ("Must fill in company address line 1."));
			} else {
				$companyAddress1 = filter_var($requestObject->companyAddress1, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			}

			if(empty($requestObject->companyState) === true) {
				throw(new InvalidArgumentException ("Must fill in state."));
			} else {
				$companyState = filter_var($requestObject->companyState, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			}

			if(empty($requestObject->companyCity) === true) {
				throw(new InvalidArgumentException ("Must fill in city."));
			} else {
				$companyCity = filter_var($requestObject->companyCity, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			}

			if(empty($requestObject->companyZip) === true) {
				throw(new InvalidArgumentException ("Must fill in zip code."));
			} else {
				$companyZip = filter_var($requestObject->companyZip, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			}

			//if(empty($requestObject->companyPhone) === true) {
			//throw(new InvalidArgumentException ("Must fill in phone number."));
//		} else {
			//		$companyPhone = filter_var($requestObject->companyPhone, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			//}

			if(empty($requestObject->companyEmail) === true) {
				throw(new InvalidArgumentException ("Must fill in company email address."));
			} else {
				$companyEmail = filter_var($requestObject->companyEmail, FILTER_SANITIZE_EMAIL);
			}

			//these fields are not required so the fields are empty so be it
			if(empty($requestObject->companyAddress2) !== true) {
				$companyAddress2 = filter_var($requestObject->companyAddress1, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			} else {
				$companyAddress2 = null;
			}

			if(empty($requestObject->companyAttn) !== true) {
				$companyAttn = filter_var($requestObject->companyAttn, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			} else {
				$companyAttn = null;
			}

			if(empty($requestObject->companyUrl) !== true) {
				$companyUrl = filter_var($requestObject->companyUrl, FILTER_SANITIZE_URL);
			} else {
				$companyUrl = null;
			}

//		if($password !== $verifyPassword) {
//			throw(new InvalidArgumentException ("Password and verify password must match."));
//		}
			//create a new company for the user
			$company = new Company(null, $companyAttn, $companyName, $companyAddress1, $companyAddress2, $companyCity, $companyState, $companyZip, "111-111-1111", $companyEmail, $companyUrl);
			$company->insert($pdo);
		}

		//create a new crew for the user
		$crew = new Crew(null, $company->getCompanyId(), "");
		$crew->insert($pdo);


		//create new user
		//create password salt, hash and activation code
		$activation = bin2hex(random_bytes(16));
		$salt = bin2hex(random_bytes(32));
		$hash = hash_pbkdf2("sha512", "password", $salt, 262144);

		$user = new User (null, $company->getCompanyId(), $crew->getCrewId(), Access::ADMIN, $userPhone, $userFirstName, $userLastName, $userEmail, $activation, $hash, $salt);
		$user->insert($pdo);

		$messageSubject = "Time Crunch Account Activation";

		//building the activation link that can travel to another server and still work. This is the link that will be clicked to confirm the account.
		// FIXME: make sure URL is /public_html/activation/$activation
		$basePath = dirname($_SERVER["SCRIPT_NAME"], 4);
		$urlglue = $basePath . "/activation/" . $activation;
		$confirmLink = "https://" . $_SERVER["SERVER_NAME"] . $urlglue;
		$message = <<< EOF
<h2>Welcome to the Time Crunch schedule management application.</h2>
<p>Visit the following URL to set a new password and complete the registration process: </p>
<p><a href="$confirmLink">$confirmLink</a></p>
EOF;

		$response = sendEmail($userEmail, $userFirstName, $userLastName, $messageSubject, $message);
		if($response === "Email sent.") {
			$reply->message = "Sign up was successful, please check your email for activation message.";
		}
	} else {
		throw(new InvalidArgumentException("Error sending email."));
	}

} catch(\Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
} catch(\TypeError $typeError) {
	$reply->status = $typeError->getCode();
	$reply->message = $typeError->getMessage();
}
header("Content-type: application/json");
echo json_encode($reply);
