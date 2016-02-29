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

try {
	//Handle REST calls
	if($method === "GET") {
		//Set xsrf cookie
		setXsrfCookie("/");

		//Get Company based on given field
		if(empty($id) === false) {
			$activation = Activation::getUserActivationByUserActivation($pdo, $id);
			if($activation !== null) {
				$reply->data = $activation;
			}
		} else {
			$activations = Activation::getAllActivations($pdo);
			if($activations !== null) {
				$reply->data = $activations;
			}
		}
	}
}
