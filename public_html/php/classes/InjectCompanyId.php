<?php
namespace Edu\Cnm\Timecrunchers;
/**
 * Class InjectCompanyId this the trait to be used to gain access to the company Id
 * @package Edu\Cnm\Timecrunchers
 */
trait InjectCompanyId {

	private $injectedId = null;

	public function injectCompanyId() {

		if(session_status() !== PHP_SESSION_ACTIVE) {
			session_start();
		}

		if(empty($_SESSION["company"]) === true) {
			throw(new \RuntimeException("This session is closed"));
		}

	$this->injectedId = $_SESSION["company"]->getCompanyId();
	}
}



