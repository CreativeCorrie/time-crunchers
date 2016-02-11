<?php
namespace Edu\Cnm\Timecrunchers\test;

use Edu\Cnm\Timecrunchers\{Company, Access, Crew};
use Edu\Cnm\Timcrunchers\Test\DataDesignTest;

$password = "abc123";
$salt = bin2hex(random_bytes(16));
$hash = hash_pbkdf2("sha512", $password, $salt, 262144);

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
class UserTest extends TimecrunchersTest {
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
		$this->user = new User(null,  "@phpunit", "test@phpunit.de", "+12125551212");
		$this->user->insert($this->getPDO());
	}

	/**
	 * test inserting a valid user and verify that the actual mySQL data matches
	 **/
	public function testInsertValidUser() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		//create a new user and insert it into mySQL
		$user = new User(null, $this->user->getUserId(), $this->VALID_USERFIRSTNAME);
		$user->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectation
		$pdoUser = User::getUserByUserId($this->$PDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $this->user->getUserId());
		$this->assertEquals($pdoUser->getUserFirstName(), $this->VALID_USERFIRSTNAME);
	}

	/**
	 * test inserting a User that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidUser() {
		//create new user with a null user Id and watch it fail
		$user = new User(DataDesignTest::INVALID_KEY, $this->user->getUserId(), $this->VAL_USERFIRSTNAME);
		$user->$this->insert($this->getPDO());
	}

	/**
	 * test inserting a User, editing it, and then updating it
	 **/
	public function testUpdateValidUser() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		//create a new user and insert it into mySQL
		$user = new User(null, $this->user->getUserId(), $this->VALID_USERFIRSTNAME);
		$user->insert($this->getPDO());

		//edit the user and update it in mySQL
		$user->setUserFirstName($this->VALID_USERFIRSTNAME2);
		$user->update($this->PDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserbyUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertEquals($pdoUser->userId(), $this->user->userId());
		$this->assertEquals($pdoUser->getUserFirstName(), $this->VALID_USERFIRSTNAME2);
	}

	/**
	 * test updating a Tweet that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidUser() {
		//create tweet with a non null userid and watch it fail
		$user = new User(null, $this->user->getUserId(), $this->VALID_USERFIRSTNAME);
		$user->update($this->getPDO());
	}

	/**
	 * test creating a Tweet and then deleting it
	 **/
	public function testDeleteValidUser() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		//create a new user and insert into mySQL
		$user = new User(null, $this->user->userId(), $this->VALID_USERFIRSTNAME);
		$user->insert($this->getPDO());

		//delete the user from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$user->delete($this->getPDO());

		//grab the data from mySQL and enforce the user does not exist
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertNull($pdoUser);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("user"));
	}

	/**
	 * test deleting a Tweet that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidUser() {
		//create
	}

}
