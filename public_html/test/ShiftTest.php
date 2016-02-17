<?php
namespace Edu\Cnm\Timecrunchers\Test;

use Edu\Cnm\Timecrunchers\User;
use Edu\Cnm\Timecrunchers\Crew;
use Edu\Cnm\Timecrunchers\Request;

//grab the project test parameters
require_once ("TimecrunchersTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "php/classes/autoloader.php");

/**
 * Full PHPUnit test for the Shift class
 *
 * This is a compplete PHPUnit tes of the Shift class. It is complee because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Shift
 * @author Dylan McDonald<dmcdonald21@cnm.edu>
 * @@author Corrie Hooker<creativecorrie@gmail.com> <Team Collaboration: TimeCrunchers>
 **/
class ShiftTest extends TimecrunchersTest {

	/**
	 * userId that shift is attached to; this is for foreign key relations
	 * @var \Edu\Cnm\Timecrunchers\User user
	 **/
	protected $user = null;

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
	 * start time of a Shift
	 * @var \DateTime $VALID_SHIFTSTARTTIME
	 **/
	protected $VALID_SHIFTSTARTTIME = null;

	/**
	 * duration of a Shift
	 * @var int $VALID_SHIFTDURATION
	 **/
	protected $VALID_SHIFTDURATION = "PHPUnit test passing";

	/**
	 * Date of a Shift
	 * @var \DateTime $VALID_SHIFTDATE
	 **/
	protected $VALID_SHIFTDATE = null;

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

		//create and insert a User to test Shift
		$this->user = new User(null, $this->user->getuserId(), "Talia");
		$this->user->insert($this->getPDO());

		//create and insert a Crew to test Shift
		$this->crew = new Crew(null, $this->crew->getCrewId(), "Taco Bell");
		$this->crew->insert($this->getPDO());

		//create and insert a Request to test Shift
		$this->request = new Crew(null, $this->request->getRequestId());
		$this->request->insert($this->getPDO());

		//calculate the date (just use the time the unit test was setup...)
		$this->VALID_SHIFTDATE = new \DateTime();
	}
	/**
	 *test inserting a valid Shift and verify that the actual mySQL date matches
	 **/
	public function testInsertValidShift() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("shift");

		//create a new Shift and insert to into mySQL
		$shift = new Shift(null, $this->shfit->getShiftId(), $this->VALID_SHIFTSTARTTIME);
		$shift->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoShift = Shift::getShiftByShiftId($this->getPDO(), $shift->getShiftId());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("user"));
		$this->assertEquals($pdoShift->getShiftUserId(), $this->user->getUserId());
		$this->assertEquals($pdoShift->getShiftCrewId(), $this->crew->getCrewId());
		$this->assertEquals($pdoShift->getShiftAccessId(), $this->access->getAccessId);
		$this->assertEquals($pdoShift->getShiftStartTime(), $this->VALID_SHIFTSTARTTIME);
		$this->assertEquals($pdoShift->getShiftDuration(), $this-> VALID_SHIFTDURATION);
		$this->assertEquals($pdoShift->getShiftDate(), $this-> VALID_SHIFTDATE);
		$this->assertEquals($pdoShift->getShiftDelete(), $this->VALID_SHIFTDELETE);
	}
	/**
	 *test inserting a Shift that already exists
	 *
	 *@expectedException PDOException
	 **/
	public function testInsertInvalidShift() {
		// create a Shift with a non null shift id and watch it fail
		$shift = new Shift(TimeCrunchersTest::INVALID_KEY, $this->VALID_SHIFTSTARTTIME, $this->VALID_SHIFTDURATION, $this->VALID_SHIFTDATE, $this->VALID_SHIFTDELETE);
		$this->insert($this->getPDO());
	}

	/**
	 * test inserting a Shift, editing it, and then updating it
	 **/
	public function testUpdateValidShift() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("shift");

		//create a new Shift and insert to into mySQL
		$shift = new Shift(null, $this->user->getUserId(), $this->crew->getCrewId(), $this->request->getRequestId(), $this->VALID_SHIFTSTARTTIME, $this->VALID_SHIFTDURATION, $this->VALID_SHIFTDATE, $this->VALID_SHIFTDELETE);
		$shift->insert($this->getPDO());

		//edit the Shift and update it in mySQL
		$shift->setShiftStartTime($this->VALID_SHIFTSTARTTIME);
		$shift->update($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoShift = Shift::getShiftByShiftId($this->getPDO(), $shift->getShiftId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("shift"));
		$this->assertEquals($pdoShift->getShiftUserId(), $this->user->getUserId());
		$this->assertEquals($pdoShift->getShiftCrewId(), $this->crew->getCrewId());
		$this->assertEquals($pdoShift->getShiftAccessId(), $this->access->getAccessId);
		$this->assertEquals($pdoShift->getShiftStartTime(), $this->VALID_SHIFTSTARTTIME);
		$this->assertEquals($pdoShift->getShiftDuration(), $this-> VALID_SHIFTDURATION);
		$this->assertEquals($pdoShift->getShiftDate(), $this-> VALID_SHIFTDATE);
		$this->assertEquals($pdoShift->getShiftDelete(), $this->VALID_SHIFTDELETE);
	}
	/**
	 *test updating a Shift that already exists
	 *
	 *@expectedException PDOException
	 **/
	public function testUpdateInvalidShift() {
		//create a Shift with a non null shift id and watch it fail
		$shift = new Shift(null, $this->user->getUserId(), $this->crew->getCrewId(), $this->request->getRequestId(), $this->VALID_SHIFTSTARTTIME, $this->VALID_SHIFTDURATION, $this->VALID_SHIFTDATE, $this->VALID_SHIFTDELETE);
		$shift->insert($this->getPDO());
	}
	/**
	 *test creating a Shift and then deleting it
	 **/
	public function testDeleteValidShift() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("shift");

		//create a new Shift and insert to into mySQL
		$shift = new Shift(null, $this->user->getUserId(), $this->crew->getCrewId(), $this->request->getRequestId(), $this->VALID_SHIFTSTARTTIME, $this->VALID_SHIFTDURATION, $this->VALID_SHIFTDATE, $this->VALID_SHIFTDELETE);
		$shift->insert($this->getPDO());

		//delete the Shift and update it in mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("shift"));
		$shift->delete($this->getPDO());

		//grab the data from mySQL and enforce the Shift does not exist
		$pdoShift = Shift::getShiftByShiftId($this->getPDO(), $shift->getShiftId());
		$this->assertNull($pdoShift);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("shift"));
	}


}