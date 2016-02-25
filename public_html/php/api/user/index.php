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
	$pdo = connect to the
}