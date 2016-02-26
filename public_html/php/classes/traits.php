<?php
namespace Edu\Cnm\Timecrunchers;

$this->injectedId = null;

trait injCompanyId {

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



