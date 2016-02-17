<?php
namespace Edu\Cnm\Timecrunchers\Test;

use Edu\Cnm\Timecrunchers\Request;
use Edu\Cnm\Timecrunchers\User;
use Edu\Cnm\Timecrunchers\Company;
use Edu\Cnm\Timecrunchers\Crew;
use Edu\Cnm\Timecrunchers\Access;


// grab the project test parameters
require_once("TimecrunchersTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoloader.php");

/**
 * Full PHPUnit test for the Tweet class
 *
 * This is a complete PHPUnit test of the Request class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Request
 * @author Samuel Van Chandler <samuelvanchandler@gmail.com>
 **/
class RequestTest extends TimecrunchersTest {
	/**
	 * content of the requestor text
	 * @var string $VALID_REQUESTREQUESTORTEXT
	 **/
	protected $VALID_REQUESTREQUESTORTEXT = "PHPUnit test passing";
	/**
	 * content of the  requestor text
	 * @var string $VALID_REQUESTREQUESTORTEXT
	 **/
	protected $VALID_REQUESTREQUESTORTEXT2 = "PHPUnit test passing";
	/**
	 * content of the admin text
	 * @var string $VALID_REQUESTADMINTEXT
	 **/
	protected $VALID_REQUESTADMINTEXT = "PHPUnit test passing";
	/**
	 * timestamp of the Request; this starts as null and is assigned later
	 * @var /DateTime $VALID_REQUESTTIMESTAMP
	 **/
	protected $VALID_REQUESTTIMESTAMP = null;
	/**
	 * timestamp of the Request; this starts as null and is assigned later
	 * @var /DateTime $VALID_REQUESTACTIONTIMESTAMP
	 **/
	protected $VALID_REQUESTACTIONTIMESTAMP = null;
	/**
	 * Company ; this is for foreign key relations
	 * @var $company
	 **/
	protected $company = null;
	/**
	 * Crew ; this is for foreign key relations
	 * @var Crew $crew
	 **/
	protected $crew = null;
	/**
	 * Access; this is for foreign key relations
	 * @var Access $access
	 **/
	protected $access = null;
	/**
	 * UserId that made the Request; this is for foreign key relations
	 * @var User $requestor
	 **/
	protected $requestor = null;
	/**
	 * AdminId that Approves the Request; this is for foreign key relations
	 * @var  User $admin
	 **/
	protected $admin = null;
	/**
	 * Admin true/false approval/denial of request
	 * @var  Request $requestApprove
	 **/
	protected $requestApprove = false;

	/**
	 * create dependent objects before running each test
	 */
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		$password = "abc123";
		$activation = bin2hex(random_bytes(16));
		$salt = bin2hex(random_bytes(32));
		$hash = hash_pbkdf2("sha512", $password, $salt, 262144);

		// creates and inserts Company to sql for User foreign key relations
		$this->company = new Company(null,"Taco B.","404 Taco St.","suite:666","Attention!!","NM","Burque","87106","5055551111","tb@hotmail.com","www.tocobell.com");
		$this->company->insert($this->getPDO());

		// creates and inserts Crew to sql for User foreign key relations
		$this->crew = new Crew(null, $this->company->getCompanyId(), "the moon");
		$this->crew->insert($this->getPDO());


		// creates and inserts Access to sql for User foreign key relations
		$this->access = new Access(null,"requestor or admin");
		$this->access->insert($this->getPDO());

		// create and insert a User to own the test Request
		$this->requestor = new User(null, $this->company->getCompanyId(),$this->crew->getCrewId(),$this->access->getAccessId(), "5551212", "Johnny", "Requestorman","test@phpunit.de", $activation, $hash, $salt);
		$this->requestor->insert($this->getPDO());

		$this->admin = new User(null ,$this->company->getCompanyId(),$this->crew->getCrewId(), $this->access->getAccessId(), "5552121", "Suzy", "Hughes","test2@phpunit.de", $activation, $hash, $salt);
		$this->admin->insert($this->getPDO());


		// calculate the date (just use the time the unit test was setup...)
		$this->VALID_REQUESTTIMESTAMP = new \DateTime();
		$this->VALID_REQUESTACTIONTIMESTAMP = new \DateTime();
	}

	/**
	 * test inserting a valid Request and verify that the actual mySQL data matches
	 **/
	public function testInsertValidRequest() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("request");

		// create a new Request and insert to into mySQL
		$request = new Request(null, $this->requestor->getUserId(), $this->admin->getUserId(),  $this->VALID_REQUESTTIMESTAMP,
			$this->VALID_REQUESTACTIONTIMESTAMP, $this->requestApprove, $this->VALID_REQUESTREQUESTORTEXT, $this->VALID_REQUESTADMINTEXT);
		$request->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoRequest = Request::getRequestByRequestId($this->getPDO(), $request->getRequestId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("request"));
		$this->assertEquals($pdoRequest->getRequestRequestorId(), $this->requestor->getUserId());
		$this->assertEquals($pdoRequest->getRequestAdminId(), $this->admin->getUserId());
		$this->assertEquals($pdoRequest->getRequestTimeStamp(), $this->VALID_REQUESTTIMESTAMP);
		$this->assertEquals($pdoRequest->getRequestActionTimeStamp(), $this->VALID_REQUESTACTIONTIMESTAMP);
		$this->assertEquals($pdoRequest->getRequestApprove(), $this->requestApprove);
		$this->assertEquals($pdoRequest->getRequestRequestorText(), $this->VALID_REQUESTREQUESTORTEXT);
		$this->assertEquals($pdoRequest->getRequestAdminText(), $this->VALID_REQUESTADMINTEXT);
	}

	/**
	 * test inserting a Request that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidRequest() {
		// create a Request with a non null request id and watch it fail
		$request = new Request(TimeCrunchersTest::INVALID_KEY, $this->requestor->getUserId(), $this->admin->getUserId(),  $this->VALID_REQUESTTIMESTAMP,
			$this->VALID_REQUESTACTIONTIMESTAMP, $this->requestApprove, $this->VALID_REQUESTREQUESTORTEXT, $this->VALID_REQUESTADMINTEXT);
		$request->insert($this->getPDO());
	}

	/**
	 * test inserting a Request, editing it, and then updating it
	 **/
	public function testUpdateValidRequest() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("request");

		// create a new Request and insert into mySQL
		$request = new Request(null, $this->requestor->getUserId(), $this->admin->getUserId(),  $this->VALID_REQUESTTIMESTAMP,
			$this->VALID_REQUESTACTIONTIMESTAMP, $this->requestApprove, $this->VALID_REQUESTREQUESTORTEXT, $this->VALID_REQUESTADMINTEXT);
		$request->insert($this->getPDO());

		// edit the Request and update it in mySQL
		$request->setRequestRequestorText($this->VALID_REQUESTREQUESTORTEXT2);
		$request->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoRequest = Request::getRequestByRequestId($this->getPDO(), $request->getRequestId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("request"));
		$this->assertEquals($pdoRequest->getRequestRequestorId(), $this->requestor->getUserId());
		$this->assertEquals($pdoRequest->getRequestAdminId(), $this->admin->getUserId());
		$this->assertEquals($pdoRequest->getRequestTimeStamp(), $this->VALID_REQUESTTIMESTAMP);
		$this->assertEquals($pdoRequest->getRequestActionTimeStamp(), $this->VALID_REQUESTACTIONTIMESTAMP);
		$this->assertEquals($pdoRequest->getRequestApprove(), $this->requestApprove);
		$this->assertEquals($pdoRequest->getRequestRequestorText(), $this->VALID_REQUESTREQUESTORTEXT2);
		$this->assertEquals($pdoRequest->getRequestAdminText(), $this->VALID_REQUESTADMINTEXT);
	}

	/**
	 * test updating a Request that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidRequest() {
		// create a Request with a non null request id and watch it fail
		$request = new Request(TimeCrunchersTest::INVALID_KEY, $this->requestor->getUserId(), $this->admin->getUserId(),  $this->VALID_REQUESTTIMESTAMP,
			$this->VALID_REQUESTACTIONTIMESTAMP, $this->requestApprove, $this->VALID_REQUESTREQUESTORTEXT, $this->VALID_REQUESTADMINTEXT);
		$request->update($this->getPDO());
	}

	/**
	 * test creating a Request and then deleting it
	 **/
	public function testDeleteValidRequest() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("request");

		// create a new Request and insert to into mySQL
		$request = new Request(null, $this->requestor->getUserId(), $this->admin->getUserId(),  $this->VALID_REQUESTTIMESTAMP,
			$this->VALID_REQUESTACTIONTIMESTAMP, $this->requestApprove, $this->VALID_REQUESTREQUESTORTEXT, $this->VALID_REQUESTADMINTEXT);
		$request->insert($this->getPDO());

		// delete the Request from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("request"));
		$request->delete($this->getPDO());

		// grab the data from mySQL and enforce the Request does not exist
		$pdoRequest = Request::getRequestByRequestId($this->getPDO(), $request->getRequestId());
		$this->assertNull($pdoRequest);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("request"));
	}

	/**
	 * test deleting a Request that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidRequest() {
		// create a Request and try to delete it without actually inserting it
		$request = new Request(null, $this->requestor->getUserId(), $this->admin->getUserId(),  $this->VALID_REQUESTTIMESTAMP,
			$this->VALID_REQUESTACTIONTIMESTAMP, $this->requestApprove, $this->VALID_REQUESTREQUESTORTEXT, $this->VALID_REQUESTADMINTEXT);
		$request->delete($this->getPDO());
	}

	/**
	 * test inserting a Request and regrabbing it from mySQL
	 **/
	public function testGetValidRequestByRequestId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("request");

		// create a new Request and insert to into mySQL
		$request = new Request(null, $this->requestor->getUserId(), $this->admin->getUserId(),  $this->VALID_REQUESTTIMESTAMP,
			$this->VALID_REQUESTACTIONTIMESTAMP, $this->requestApprove, $this->VALID_REQUESTREQUESTORTEXT, $this->VALID_REQUESTADMINTEXT);
		$request->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoRequest = Request::getRequestByRequestId($this->getPDO(), $request->getRequestId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("request"));
		$this->assertEquals($pdoRequest->getRequestRequestorId(), $this->requestor->getUserId());
		$this->assertEquals($pdoRequest->getRequestAdminId(), $this->admin->getUserId());
		$this->assertEquals($pdoRequest->getRequestTimeStamp(), $this->VALID_REQUESTTIMESTAMP);
		$this->assertEquals($pdoRequest->getRequestActionTimeStamp(), $this->VALID_REQUESTACTIONTIMESTAMP);
		$this->assertEquals($pdoRequest->getRequestApprove(), $this->requestApprove);
		$this->assertEquals($pdoRequest->getRequestRequestorText(), $this->VALID_REQUESTREQUESTORTEXT2);
		$this->assertEquals($pdoRequest->getRequestAdminText(), $this->VALID_REQUESTADMINTEXT);
	}

	/**
	 * test grabbing a Request that does not exist
	 **/
	public function testGetInvalidRequestsByRequestId() {
		// grab a profile id that exceeds the maximum allowable profile id
		$request = Request::getRequestByRequestId($this->getPDO(), TimeCrunchersTest::INVALID_KEY);
		$this->assertNull($request);
	}
	/**
	 * test grabbing all Requests
	 **/
	public function testGetAllValidRequests() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("request");

		// create a new Request and insert to into mySQL
		$request = new Request(null, $this->requestor->getUserId(), $this->admin->getUserId(),  $this->VALID_REQUESTTIMESTAMP,
			$this->VALID_REQUESTACTIONTIMESTAMP, $this->requestApprove, $this->VALID_REQUESTREQUESTORTEXT, $this->VALID_REQUESTADMINTEXT);
		$request->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Request::getAllRequests($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("request"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\TimeCrunchers\\Request", $results);

		// grab the result from the array and validate it
		$pdoRequest = $results[0];
		$this->assertEquals($pdoRequest->getRequestRequestorId(), $this->requestor->getUserId());
		$this->assertEquals($pdoRequest->getRequestAdminId(), $this->admin->getUserId());
		$this->assertEquals($pdoRequest->getRequestTimeStamp(), $this->VALID_REQUESTTIMESTAMP);
		$this->assertEquals($pdoRequest->getRequestActionTimeStamp(), $this->VALID_REQUESTACTIONTIMESTAMP);
		$this->assertEquals($pdoRequest->getRequestApprove(), $this->requestApprove);
		$this->assertEquals($pdoRequest->getRequestRequestorText(), $this->VALID_REQUESTREQUESTORTEXT2);
		$this->assertEquals($pdoRequest->getRequestAdminText(), $this->VALID_REQUESTADMINTEXT);
	}
}