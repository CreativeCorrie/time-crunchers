<?php
namespace Edu\Cnm\Timecrunchers\Test;

use Edu\Cnm\Timecrunchers\Shift;
use Edu\Cnm\Timecrunchers\User;
use Edu\Cnm\Timecrunchers\Request;
use Edu\Cnm\Timecrunchers\Company;
use Edu\Cnm\Timecrunchers\Crew;
use Edu\Cnm\Timecrunchers\Access;

// grab the project test parameters
require_once("TimecrunchersTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoloader.php");

/**
 * Full PHPUnit test for the Shift class
 *
 * This is a complete PHPUnit test of the Shift class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Shift
 * @author Dylan McDonald<dmcdonald21@cnm.edu>
 * @@author Corrie Hooker<creativecorrie@gmail.com> <Team Collaboration: TimeCrunchers>
 **/
class ShiftTest extends TimeCrunchersTest {

	/**
	 * Company ; this is for foreign key relations
	 * @var $company
	 **/
	protected $company = null;

	/**
	 * User that shift is attached to; this is for foreign key relations
	 * @var \Edu\Cnm\Timecrunchers\User requestor
	 **/
	protected $requestor = null;

	/**
	 * Admin that shift is attached to; this is for foreign key relations
	 * @var \Edu\Cnm\Timecrunchers\User admin
	 **/
	protected $admin = null;

	/**
	 * crewId that shift is attached to; this is for foreign key relations
	 * @var \Edu\Cnm\Timecrunchers\Crew crew
	 **/
	protected $crew = null;

	/**
	 * requestId that shift is attached to; this is for foreign key relations
	 * @var \Edu\Cnm\Timecrunchers\Request request
	 **/
	protected $request = null;

	/**
	 * Access; this is for foreign key relations
	 * @var Access $access
	 **/
	protected $access = null;

	/**
	 * start time of a Shift
	 * @var \DateTime $VALID_SHIFTSTARTTIME
	 **/
	protected $VALID_SHIFTSTARTTIME = "02:02:02";
	/**
	 * start time of a Shift
	 * @var \DateTime $VALID_SHIFTSTARTTIME2
	 **/
	protected $VALID_SHIFTSTARTTIME2 = "02:03:05";

	/**
	 * duration of a Shift (stored in seconds)
	 * @var int $VALID_SHIFTDURATION
	 **/
	protected $VALID_SHIFTDURATION = 42;

	/**
	 * Date of a Shift
	 * @var \DateTime $VALID_SHIFTDATE
	 **/
	protected $VALID_SHIFTDATE = "2016-02-15";

	/**
	 * Boolean true/false to soft delete a shift
	 * @var boolean $VALID_SHIFTDELETE
	 **/
	protected $VALID_SHIFTDELETE = false;

	/**
	 *create dependent objects before running each test
	 **/
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();
// ***********************
		$password = "abc123";
		$activation = bin2hex(random_bytes(16));
		$salt = bin2hex(random_bytes(32));
		$hash = hash_pbkdf2("sha512", $password, $salt, 262144);

		// creates and inserts Company to sql for User foreign key relations
		$this->company = new Company(null, "Taco B.", "404 Taco St.", "suite:666", "Attention!!", "NM", "Burque", "87106", "5055551111", "tb@hotmail.com", "www.tocobell.com");
		$this->company->insert($this->getPDO());

		// creates and inserts Access to sql for User foreign key relations
		$this->access = new Access(null, "requestor or admin");
		$this->access->insert($this->getPDO());

		// create and insert a Crew to own the test Schedule
		$this->crew = new Crew(null, $this->company->getCompanyId(), "Burque");
		$this->crew->insert($this->getPDO());

//*****************
		//create and insert a User to test Shift
		$this->requestor = new User(null, $this->company->getCompanyId(), $this->crew->getCrewId(), $this->access->getAccessId(), "5551212", "Johnny", "Requestorman", "test1@phpunit.de", $activation, $hash, $salt);
		$this->requestor->insert($this->getPDO());

		//create and insert a User to test Shift
		$this->admin = new User(null, $this->company->getCompanyId(), $this->crew->getCrewId(), $this->access->getAccessId(), "5551212", "Dave", "Adminman", "test2@phpunit.de", $activation, $hash, $salt);
		$this->admin->insert($this->getPDO());

		//create and insert a Request to test Shift
		$this->request = new Request(null, $this->requestor->getUserId(), $this->admin->getUserId(), null, null, false, "I can haz time off nao, plz?", "Yes, and bring me a sandwich.");
		$this->request->insert($this->getPDO());
	}

	/**
	 *test inserting a valid Shift and verify that the actual mySQL date matches
	 **/
	public function testInsertValidShift() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("shift");

		//create a new Shift and insert to into mySQL
		$shift = new Shift(null, $this->requestor->getUserId(), $this->crew->getCrewId(), $this->request->getRequestId(),
			$this->VALID_SHIFTSTARTTIME, $this->VALID_SHIFTDURATION, $this->VALID_SHIFTDATE, $this->VALID_SHIFTDELETE);
		echo $shift->getShiftId();
		$shift->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoShift = Shift::getShiftByShiftId($this->getPDO(), $shift->getShiftId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("shift"));
		$this->assertEquals($pdoShift->getShiftUserId(), $this->requestor->getUserId());
		$this->assertEquals($pdoShift->getShiftCrewId(), $this->crew->getCrewId());
		$this->assertEquals($pdoShift->getShiftRequestId(), $this->request->getRequestId());
		$this->assertEquals($pdoShift->getShiftStartTime(), $this->VALID_SHIFTSTARTTIME);
		$this->assertEquals($pdoShift->getShiftDuration(), $this->VALID_SHIFTDURATION);
		$this->assertEquals($pdoShift->getShiftDate()->format("Y-m-d"), $this->VALID_SHIFTDATE);
		$this->assertEquals($pdoShift->getShiftDelete(), $this->VALID_SHIFTDELETE);
	}

	/**
	 *test inserting a Shift that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testInsertInvalidShift() {
		// create a Shift with a non null shift id and watch it fail
		$shift = new Shift(TimeCrunchersTest::INVALID_KEY, $this->requestor->getUserId(), $this->crew->getCrewId(), $this->request->getRequestId(), $this->VALID_SHIFTSTARTTIME, $this->VALID_SHIFTDURATION, $this->VALID_SHIFTDATE, $this->VALID_SHIFTDELETE);
		// inserts this shift
		$shift->insert($this->getPDO());
	}

	/**
	 *test inserting a Shift, editing it, and then updating it
	 **/
	public function testUpdateValidShift() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("shift");

		//create a new Shift and insert to into mySQL
		$shift = new Shift(null, $this->requestor->getUserId(), $this->crew->getCrewId(), $this->request->getRequestId(), $this->VALID_SHIFTSTARTTIME, $this->VALID_SHIFTDURATION, $this->VALID_SHIFTDATE, $this->VALID_SHIFTDELETE);
		$shift->insert($this->getPDO());

		//edit the Shift and update it in mySQL
		$shift->setShiftStartTime($this->VALID_SHIFTSTARTTIME2);
		$shift->update($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoShift = Shift::getShiftByShiftId($this->getPDO(), $shift->getShiftId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("shift"));
		$this->assertEquals($pdoShift->getShiftUserId(), $this->requestor->getUserId());
		$this->assertEquals($pdoShift->getShiftCrewId(), $this->crew->getCrewId());
		$this->assertEquals($pdoShift->getShiftRequestId(), $this->request->getRequestId());
		$this->assertEquals($pdoShift->getShiftStartTime(), $this->VALID_SHIFTSTARTTIME2);
		$this->assertEquals($pdoShift->getShiftDuration(), $this->VALID_SHIFTDURATION);
		$this->assertEquals($pdoShift->getShiftDate()->format("Y-m-d"), $this->VALID_SHIFTDATE);
		$this->assertEquals($pdoShift->getShiftDelete(), $this->VALID_SHIFTDELETE);
	}

	/**
	 *test updating a Shift that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testUpdateInvalidShift() {
		//create a Shift with a non null shift id and watch it fail
		$shift = new Shift(null, $this->requestor->getUserId(), $this->crew->getCrewId(), $this->request->getRequestId(), $this->VALID_SHIFTSTARTTIME, $this->VALID_SHIFTDURATION, $this->VALID_SHIFTDATE, $this->VALID_SHIFTDELETE);
		$shift->update($this->getPDO());
	}

	/**
	 *test creating a Shift and then deleting it
	 **/
	public function testDeleteValidShift() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("shift");

		//create a new Shift and insert to into mySQL
		$shift = new Shift(null, $this->requestor->getUserId(), $this->crew->getCrewId(), $this->request->getRequestId(), $this->VALID_SHIFTSTARTTIME, $this->VALID_SHIFTDURATION, $this->VALID_SHIFTDATE, $this->VALID_SHIFTDELETE);
		$shift->insert($this->getPDO());

		//delete the Shift and update it in mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("shift"));
		$shift->delete($this->getPDO());

		//grab the data from mySQL and enforce the Shift does not exist
		$pdoShift = Shift::getShiftByShiftId($this->getPDO(), $shift->getShiftId());
		$this->assertTrue($pdoShift->getShiftDelete());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("shift"));
	}

	/**
	 *test deleting a Shift that does not exist
	 *
	 * @expectedException \PDOException
	 **/
	public function testDeleteInvalidShift() {
		// create a Shift and try to delete it without actually inserting it
		$shift = new Shift(null, $this->requestor->getUserId(), $this->crew->getCrewId(), $this->request->getRequestId(), $this->VALID_SHIFTSTARTTIME, $this->VALID_SHIFTDURATION, $this->VALID_SHIFTDATE, $this->VALID_SHIFTDELETE);
		$shift->delete($this->getPDO());
	}

	/**
	 *test inserting a Shift, and re-grabbing it from mySQL
	 **/
	public function testGetValidShiftByShiftID() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("shift");

		//create a new Shift and insert to into mySQL
		$shift = new Shift(null, $this->requestor->getUserId(), $this->crew->getCrewId(), $this->request->getRequestId(), $this->VALID_SHIFTSTARTTIME, $this->VALID_SHIFTDURATION, $this->VALID_SHIFTDATE, $this->VALID_SHIFTDELETE);
		$shift->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoShift = Shift::getShiftByShiftId($this->getPDO(), $shift->getShiftId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("shift"));
		$this->assertEquals($pdoShift->getShiftUserId(), $this->requestor->getUserId());
		$this->assertEquals($pdoShift->getShiftCrewId(), $this->crew->getCrewId());
		$this->assertEquals($pdoShift->getShiftRequestId(), $this->request->getRequestId());
		$this->assertEquals($pdoShift->getShiftStartTime(), $this->VALID_SHIFTSTARTTIME);
		$this->assertEquals($pdoShift->getShiftDuration(), $this->VALID_SHIFTDURATION);
		$this->assertEquals($pdoShift->getShiftDate()->format("Y-m-d"), $this->VALID_SHIFTDATE);
		$this->assertEquals($pdoShift->getShiftDelete(), $this->VALID_SHIFTDELETE);
	}

	/**
	 *test grabbing a Shift by a start time that does not exist
	 **/
	public function testGetInvalidShiftByShiftId() {
		// grab a shift id that exceeds the maximum allowable shift start time
		$shift = shift::getShiftByShiftId($this->getPDO(), TimeCrunchersTest::INVALID_KEY);
		$this->assertNull($shift);
	}

	/**
	 *test grabbing a shift by shiftStartTime
	 **/
	public function testGetValidShiftByShiftStartTime() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("shift");

		//create a new Shift and insert to into mySQL
		$shift = new Shift(null, $this->requestor->getUserId(), $this->crew->getCrewId(), $this->request->getRequestId(), $this->VALID_SHIFTSTARTTIME, $this->VALID_SHIFTDURATION, $this->VALID_SHIFTDATE, $this->VALID_SHIFTDELETE);
		$shift->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoShift = Shift::getShiftByShiftId($this->getPDO(), $shift->getShiftId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("shift"));
		$this->assertEquals($pdoShift->getShiftUserId(), $this->requestor->getUserId());
		$this->assertEquals($pdoShift->getShiftCrewId(), $this->crew->getCrewId());
		$this->assertEquals($pdoShift->getShiftRequestId(), $this->request->getRequestId());
		$this->assertEquals($pdoShift->getShiftStartTime(), $this->VALID_SHIFTSTARTTIME);
		$this->assertEquals($pdoShift->getShiftDuration(), $this->VALID_SHIFTDURATION);
		$this->assertEquals($pdoShift->getShiftDate()->format("Y-m-d"), $this->VALID_SHIFTDATE);
		$this->assertEquals($pdoShift->getShiftDelete(), $this->VALID_SHIFTDELETE);
	}

	/**
	 *test grabbing all shifts
	 **/
	public function testGetAllValidShifts() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("shift");

		//create a new Shift and insert it into mySQL
		$shift = new Shift(null, $this->requestor->getUserId(), $this->crew->getCrewId(), $this->request->getRequestId(), $this->VALID_SHIFTSTARTTIME, $this->VALID_SHIFTDURATION, $this->VALID_SHIFTDATE, $this->VALID_SHIFTDELETE);
		$shift->insert($this->getPDO());
		$this->AssertEquals($numRows + 1, $this->getConnection()->getRowCount("shift"));

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoShifts = Shift::getAllShifts($this->getPDO());


		//grab the result from the array and validate it
		foreach($pdoShifts as $pdoShift) {
			if($pdoShift->getShiftId() === $shift->getShiftId()) {
				$this->assertEquals($pdoShift->getShiftUserId(), $this->requestor->getUserId());
				$this->assertEquals($pdoShift->getShiftCrewId(), $this->crew->getCrewId());
				$this->assertEquals($pdoShift->getShiftRequestId(), $this->request->getRequestId());
				$this->assertEquals($pdoShift->getShiftStartTime(), $this->VALID_SHIFTSTARTTIME);
				$this->assertEquals($pdoShift->getShiftDuration(), $this->VALID_SHIFTDURATION);
				$this->assertEquals($pdoShift->getShiftDate()->format("Y-m-d"), $this->VALID_SHIFTDATE);
				$this->assertEquals($pdoShift->getShiftDelete(), $this->VALID_SHIFTDELETE);
			}
		}
	}
}