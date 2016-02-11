<?php
namespace Edu\Cnm\Timecrunchers\test;

use Edu\Cnm\Timecrunchers\{Company, Access, Crew};

//grab test parameters
require_once("TimecrunchersTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoloader.php");

/**
 * Full PHPUnit test for the user class
 *
 * This is a complete PHPUnit test of the user class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see user
 * @author Denzyl Fontaine>
 **/
class UserTesT extends TimecrunchersTest {
	/**
	 * content of user
	 * @var string $VALID_USERCONTENT
	 */
	protected $VALID_USERFIRSTNAME = "PHPUnit test passing";
	/**
	 * content of updated user
	 * @var string $VALID_USERCONTENT2
	 */
	protected $VALID_USERFIRSTNAME2 = "PHPUnit test still passing";
	/**
	 * profile that created the user, this is for foreign key
	 * @var userCompanyId
	 */
	protected $userCompanyId = null;

	/**
	 * create dependent objects before running each test
	 */
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();

		//create and insert a profile to own the test user
		$this->user = new Profile(null,  "@phpunit", "test@phpunit.de", "+12125551212");
	}


}
