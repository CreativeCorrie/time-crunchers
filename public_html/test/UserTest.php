<?php
namespace Edu\Cnm\Timecrunchers\test;

use Edu\Cnm\Timecrunchers\{Company, Access, Crew};
/**
use Edu\Cnm\Timecrunchers\Company;
use Edu\Cnm\Timecrunchers\Access;
use Edu\Cnm\Timecrunchers\Crew;
**/

//grab test parameters
require_once("TimecrunchersTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoloader.php");


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
	 * password of the user
	 * @var string $VALID_PASSWORD
	 */
	protected $VALID_PASSWORD = "abc123";
	/**
	 *
	 * @var mixed
	 */
	protected $VALID_HASH = null;
	/**
	 *
	 * @var string $VALID_SALT
	 */
	protected $VALID_SALT = null;

	/**
	 * company that created the user, this is for foreign key
	 * @var $company
	 */
	protected $company = null;
	/**
	 * access given to the user
	 * @var $access
	 */
	protected $access = null;
	/**
	 * crew the user is assgined to
	 * @var $crew
	 */
	protected $crew = null;
	/**
	 * create dependent objects before running each test
	 */
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();

		$this->VALID_SALT = bin2hex(random_bytes(16));
		$this->VALID_HASH = hash_pbkdf2("sha512", $this->VALID_PASSWORD, $this->VALID_SALT, 262144);

		//create and insert company access and crew to own the test user
		// TODO: new company, access, crew
		$this->company = new Company(null, $this->company->getCompanyId(), "Kitty Scratchers", "1600 Pennsylvania Ave NW", "Senator's Palace", "Senator Arlo", "WA", "Felis Felix", "20500", "5055551212", "kitty@aol.com", "www.kitty.com");
		$this->company->insert($this->getPDO());

		$this->access = new Access(null, $this->company->getCompanyId(), "employee");
		$this->access->insert($this->getPDO());

		$this->crew = new Crew(null, $this->comapny->getCompanyId(), "Albuquerque");
		$this->crew->insert($this->getPDO());

	}

	/**
	 * test inserting a valid user and verify that the actual mySQL data matches
	 **/
	public function testInsertValidUser() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		//create a new user and insert it into mySQL
		$user = new User(null, $this->company->getCompanyId());
		$user->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectation
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
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
		//create a user and try to delete without actually inserting it
		$user = new User(null, $this->user->getUserId(), $this->VALID_USERFIRSTNAME);
		$user->delete($user->getPDO());
	}

	/**
	 * test inserting a Tweet and regrabbing it from mySQL
	 **/
	public function testGetValidUserByUserId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		//create a new $user and insert into mySQL
		$user = new User(null, $this->user->getUserId, $this->VALID_USERFIRSTNAME);
		$user->insert($this->getPDO());

		//grab from the mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserId(), $this->user->getUserId("user"));
		$this->assertEquals($pdoUser->getUserFirstName(), $this->user->getUserFirstName);
	}

	/**
	 * test grabbing a Tweet that does not exist
	 **/
	public function testGetInvalidUserByUserId() {
		//grab a user id that exceeds the maximum allowable user id
		$user = User::getUserByUserId($this->getPDO(),TimeCrunchersTest::INVALID_KEY);
		$this->assertNull($user);
	}

	/**
	 * test grabbing a user by user first Name
	 **/
	public function testGetValidUserByUserFirstName() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		//create a new user and insert into mySQL
		$user = new User(null, $this->user->getUserId(), $this->VALID_USERFIRSTNAME);
		$user->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = User::getUserByUserFirstName($this->getPDO(), $user->getUserFirstName());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Timecrunhcers\\User", $results);

		//grab the result from the array and validate it
		$pdoUser = $results[0];
		$this->assertEquals($pdoUser->getUserId(), $this->user->getUserId());
		$this->assertEquals($pdoUser->getUserFirstName(), $this->VALID_USERFIRSTNAME);
	}

	/**
	 * test grabbing a user by first name that does not exist
	 */
	public function testGetInvalidUserByUserFirstName() {
		//grab a user id that exceeds the maximum allowable user id
		$user = User::getUserByUserFirstName($this->getPDO(), "nobody is a user");
		$this->assertCount(0, $user);
	}

	/**
	 * test grabbing all users
	 */
	public function testGetAllValidUsers() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		//create a new User and insert into mySQL
		$user = new User(null, $this->user->geUserId(), $this->VALID_USERFIRSTNAME);
		$user->insert($this->getPDO());

		//grab the data for mySQL and enforce the field match our expectations
		$results = User::getAllUsers($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertCount(1, $results);
		$this->assertContainOnlyInstancesOf("Edu\\Cnm\\Timecrunchers\\User", $results);

		//grab the result from the array and validate it
		$pdoUser = $results[0];
		$this->assertequals($pdoUser->getUserId(), $this->user->getUserId());
		$this->assertEquals($pdoUser->getUserFirstName(), $this->VALID_USERFIRSTNAME);
	}
}
