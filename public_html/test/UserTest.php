<?php
namespace Edu\Cnm\Timecrunchers\test;

use Edu\Cnm\Timecrunchers\User;
use Edu\Cnm\Timecrunchers\Company;
use Edu\Cnm\Timecrunchers\Crew;
use Edu\Cnm\Timecrunchers\Access;

//grab test parameters
require_once("TimecrunchersTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoloader.php");


class UserTest extends TimeCrunchersTest {
	/**
	 * company that created the user, this is for foreign key relations
	 * @var \Edu\Cnm\Timecrunchers\Company company
	 */
	protected $company = null;
	/**
	 * crew the user is assigned to, this is for foreign key relations
	 * @var \Edu\Cnm\Timecrunchers\Crew crew
	 */
	protected $crew = null;
	/**
	 * access the user is assigned, this is the foreign key relations
	 *@var \Edu\Cnm\Timecrunchers\Access access
	 */
	protected $access = null;
	/**
	 * content of userPhone
	 * @var string userPhone
	 **/
	protected $VALID_USERPHONE = "PHPUnit test is passing";
	/**
	 * content of userFirstName
	 * @var string $VALID_USERFIRSTNAME
	 **/
	protected $VALID_USERFIRSTNAME = "PHPUnit test passing";
	/**
	 * content of updated userFirstname
	 * @var string $VALID_USERCONTENT2
	 */
	protected $VALID_USERFIRSTNAME2 = "PHPUnit test still passing";
	/**
	 * content of userLastName
	 * @var string $VALID_USERLASTNAME
	 **/
	protected $VALID_USERLASTNAME = "PHPUnit test is passing";
	/**
	 * content of userEmail
	 * @var string $VALID_USEREMAIL
	 **/
	protected $VALID_USEREMAIL = "PHPUnit test is passing";
	/**
	 * password of the user
	 * @var string $VALID_ACTIVATION
	 */
	protected $VALID_USERACTIVATION = null;
	/**
	 * hash used to encrypt user info
	 * @var mixed
	 */
	protected $VALID_USERHASH = null;
	/**
	 * salt used to encrypt hash
	 * @var string $VALID_SALT
	 */
	protected $VALID_USERSALT = null;

	/**
	 * create dependent objects before running each test
	 */
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();

		//this is for the hash & salt
		$password = "abc123";
		$this->VALID_USERACTIVATION = bin2hex(random_bytes(16));
		$this->VALID_USERSALT = bin2hex(random_bytes(32));
		$this->VALID_USERHASH = hash_pbkdf2("sha512", $password, $this->VALID_USERSALT, 262144);

		//create and insert a new company to own the crew the user belongs to
		$this->company = new Company(null, "Taco B.","404 Taco St.","suite:666","Attention!!","NM","Burque","87106","5055551111","tb@hotmail.com","www.tocobell.com");
		$this->company->insert($this->getPDO());

		// create and insert a crew to own the test Schedule
		$this->crew = new Crew(null, $this->company->getCompanyId(), "Taco Bell");
		$this->crew->insert($this->getPDO());

		// create and insert Access that is attached to the user
		$this->access = new Access(null, "requestor or admin");
		$this->access->insert($this->getPDO());
	}

	/**
	 * test inserting a valid user and verify that the actual mySQL data matches
	 **/
	public function testInsertValidUser() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		//create a new User and insert it into mySQL
		$user = new User(null, $this->company->getCompanyId(), $this->crew->getCrewId(), $this->access->getAccessId(), $this->VALID_USERPHONE, $this->VALID_USERFIRSTNAME, $this->VALID_USERLASTNAME, $this->VALID_USEREMAIL, $this->VALID_USERACTIVATION, $this->VALID_USERHASH, $this->VALID_USERSALT);
		$user->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectation
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoUser->getUserCrewId(), $this->crew->getCrewId());
		$this->assertEquals($pdoUser->getUserAccessId(), $this->access->getAccessId());
		$this->assertSame($pdoUser->getUserPhone(), $this->VALID_USERPHONE);
		$this->assertSame($pdoUser->getUserFirstName(), $this->VALID_USERFIRSTNAME);
		$this->assertSame($pdoUser->getUserLastName(), $this->VALID_USERLASTNAME);
		$this->assertSame($pdoUser->getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertEquals($pdoUser->getUserActivation(), $this->VALID_USERACTIVATION);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_USERHASH);
		$this->assertEquals($pdoUser->getUserSalt(), $this->VALID_USERSALT);
	}

	/**
	 * test inserting a User that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidUser() {
		//create new user with a null user Id and watch it fail
		$user = new User(TimeCrunchersTest::INVALID_KEY, $this->company->getCompanyId(), $this->crew->getCrewId(),$this->access->getAccessId(), $this->VALID_USERPHONE, $this->VALID_USERFIRSTNAME, $this->VALID_USERLASTNAME, $this->VALID_USEREMAIL, $this->VALID_USERACTIVATION, $this->VALID_USERHASH, $this->VALID_USERSALT);
		$user->insert($this->getPDO());
	}

	/**
	 * test inserting a User, editing it, and then updating it
	 **/
	public function testUpdateValidUser() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		//create a new user and insert it into mySQL
		$user = new User(null, $this->company->getCompanyId(), $this->crew->getCrewId(), $this->access->getAccessId(), $this->VALID_USERPHONE, $this->VALID_USERFIRSTNAME, $this->VALID_USERLASTNAME, $this->VALID_USEREMAIL, $this->VALID_USERACTIVATION, $this->VALID_USERHASH, $this->VALID_USERSALT);
		$user->insert($this->getPDO());

		//edit the user and update it in mySQL
		$user->setUserPhone($this->VALID_USERPHONE);
		$user->setUserFirstName($this->VALID_USERFIRSTNAME);
		$user->setUserLastName($this->VALID_USERLASTNAME);
		$user->setUserEmail($this->VALID_USEREMAIL);
		$user->setUserActivation($this->VALID_USERACTIVATION);
		$user->setUserHash($this->VALID_USERHASH);
		$user->setUserSalt($this->VALID_USERSALT);
		$user->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserbyUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoUser->getUserCrewId(), $this->crew->getCrewId());
		$this->assertEquals($pdoUser->getUserAccessId(), $this->access->getAccessId());
		$this->assertSame($pdoUser->getUserPhone(), $this->VALID_USERPHONE);
		$this->assertSame($pdoUser->getUserFirstName(), $this->VALID_USERFIRSTNAME2);
		$this->assertSame($pdoUser->getUserLastName(), $this->VALID_USERLASTNAME);
		$this->assertSame($pdoUser->getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertEquals($pdoUser->getUserActivation(), $this->VALID_USERACTIVATION);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_USERHASH);
		$this->assertEquals($pdoUser->getUserSalt(), $this->VALID_USERSALT);
	}

	/**
	 * test updating a Tweet that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidUser() {
		//create tweet with a non null userId and watch it fail
		$user = new User(null, $this->company->getCompanyId(), $this->crew->getCrewId(), $this->access->getAccessId(), $this->VALID_USERPHONE, $this->VALID_USERFIRSTNAME, $this->VALID_USERLASTNAME, $this->VALID_USEREMAIL, $this->VALID_USERACTIVATION, $this->VALID_USERHASH, $this->VALID_USERSALT);
		$user->update($this->getPDO());
	}

	/**
	 * test creating a Tweet and then deleting it
	 **/
	public function testDeleteValidUser() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		//create a new user and insert into mySQL
		$user = new User(null, $this->company->getCompanyId(), $this->crew->getCrewId(), $this->access->getAccessId(), $this->VALID_USERPHONE, $this->VALID_USERFIRSTNAME, $this->VALID_USERLASTNAME, $this->VALID_USEREMAIL, $this->VALID_USERACTIVATION, $this->VALID_USERHASH, $this->VALID_USERSALT);
		$user->insert($this->getPDO());

		//delete the user from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$user->delete($this->getPDO());

		//grab the data from mySQL and enforce the user does not exist
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertNull($pdoUser);
	}

	/**
	 * test deleting a Tweet that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidUser() {

		//create a user and try to delete without actually inserting it
		$user = new User(null, $this->company->getCompanyId(), $this->crew->getCrewId(), $this->access->getAccessId(), $this->VALID_USERPHONE, $this->VALID_USERFIRSTNAME, $this->VALID_USERLASTNAME, $this->VALID_USEREMAIL, $this->VALID_USERACTIVATION, $this->VALID_USERHASH, $this->VALID_USERSALT);
		$user->delete($user->getPDO());
	}

	/**
	 * test inserting a Access and regrabbing it from mySQL
	 **/
	public function testGetValidUserByUserId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		//create a new $user and insert into mySQL
		$user = new User(null, $this->company->getCompanyId(), $this->crew->getCrewId(), $this->access->getAccessId(), $this->VALID_USERPHONE, $this->VALID_USERFIRSTNAME, $this->VALID_USERLASTNAME, $this->VALID_USEREMAIL, $this->VALID_USERACTIVATION, $this->VALID_USERHASH, $this->VALID_USERSALT);
		$user->insert($this->getPDO());

		//grab from the mySQL and enforce the fields match our expectations
		$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoUser->getUserCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoUser->getUserCrewId(), $this->crew->getCrewId());
		$this->assertEquals($pdoUser->getUserAccessId(), $this->access->getAccessId());
		$this->assertSame($pdoUser->getUserPhone(), $this->VALID_USERPHONE);
		$this->assertSame($pdoUser->getUserFirstName(), $this->VALID_USERFIRSTNAME);
		$this->assertSame($pdoUser->getUserLastName(), $this->VALID_USERLASTNAME);
		$this->assertSame($pdoUser->getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertEquals($pdoUser->getUserActivation(), $this->VALID_USERACTIVATION);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_USERHASH);
		$this->assertEquals($pdoUser->getUserSalt(), $this->VALID_USERSALT);
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
	 * test grabbing a user by userEmail
	 **/
	public function testGetValidUserByUserEmail() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		//create a new user and insert into mySQL
		$user = new User(null, $this->company->getCompanyId(), $this->crew->getCrewId(), $this->access->getAccessId(), $this->VALID_USERPHONE, $this->VALID_USERFIRSTNAME, $this->VALID_USERLASTNAME, $this->VALID_USEREMAIL, $this->VALID_USERACTIVATION, $this->VALID_USERHASH, $this->VALID_USERSALT);
		$user->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = User::getUserByUserEmail($this->getPDO(), $user->getUserEmail());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Timecrunhcers\\User", $results);

		//grab the result from the array and validate it
		$pdoUser = $results[0];
		$this->assertEquals($pdoUser->getUserCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoUser->getUserCrewId(), $this->crew->getCrewId());
		$this->assertEquals($pdoUser->getUserAccessId(), $this->access->getAccessId());
		$this->assertSame($pdoUser->getUserPhone(), $this->VALID_USERPHONE);
		$this->assertSame($pdoUser->getUserFirstName(), $this->VALID_USERFIRSTNAME);
		$this->assertSame($pdoUser->getUserLastName(), $this->VALID_USERLASTNAME);
		$this->assertSame($pdoUser->getUserEmail(), $this->VALID_USEREMAIL);
		$this->assertEquals($pdoUser->getUserActivation(), $this->VALID_USERACTIVATION);
		$this->assertEquals($pdoUser->getUserHash(), $this->VALID_USERHASH);
		$this->assertEquals($pdoUser->getUserSalt(), $this->VALID_USERSALT);
	}

	/**
	 * test grabbing a user by first name that does not exist
	 */
	public function testGetInvalidUserByUserEmail() {
		//grab a user id that exceeds the maximum allowable user id
		$user = User::getUserByUserEmail($this->getPDO(), "nobody is a user");
		$this->assertCount(0, $user);
	}

	/**
	 * test grabbing all users
	 */
	public function testGetAllValidUsers() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("user");

		//grab the data for mySQL and enforce the field match our expectations
		$results = User::getAllUsers($this->getPDO());
		$this->assertEquals($numRows, $results->count());
	}
}
