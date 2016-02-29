<?php
namespace Edu\Cnm\Timecrunchers;
/**
 * Class InjectCompanyId this the trait to be used to gain access to the company Id
 * @package Edu\Cnm\Timecrunchers
 */
trait InjectCompanyId {


	public static function injectCompanyId() {
		if(session_status() !== PHP_SESSION_ACTIVE) {
			session_start();
		}

		if(empty($_SESSION["company"]) === true) {
			throw(new \RuntimeException("This session is closed"));
		}

		return($_SESSION["company"]->getCompanyId());
	}
}



