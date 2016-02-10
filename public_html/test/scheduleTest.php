<?php
namespace Edu\Cnm\Timecrunchers\Test;


use Edu\Cnm\Timecrunchers\{ScheduleCrewId, Schedule};

// grab the project test parameters
require_once("ScheduleTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoloader.php");

/**
 * Full PHPUnit test for the Schedule class
 *
 * This is a complete PHPUnit test of the Schedule class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Schedule
 * @author Elaine Thomas <enajera2@cnm.edu>
 **/
class ScheduleTest extends TimecrunchersTest {
	/**
	 * content of the Schedule
	 * @var string $VALID_SCHEDULECONTENT
	 **/
	protected $VALID_SCHEDULECONTENT = "PHPUnit test passing";
	/**
	 * content of the updated Schedule
	 * @var string $VALID_SCHEDULECONTENT2
	 **/
	protected $VALID_SCHEDULECONTENT2 = "PHPUnit test still passing";
	/**
	 * timestamp of the Schedule
	 * @var DateTime $VALID_SCHEDULEDATE
	 **/
	protected $VALID_SCHEDULEDATE = null;
	/**
	 * Id for Crew that Schedule is attached to; this is for foreign key relations
	 * @var scheduleCrewId profile
	 **/
	protected $profile = null;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// create and insert a ScheduleCrewId to own the test Schedule
		$this->schedule = new ScheduleCrewId(null);
		$this->schedule->insert($this->getPDO());

		// calculate the date (just use the time the unit test was setup...)
		$this->VALID_SCHEDULEDATE = new \DateTime();
	}

	/**
	 * test inserting a valid Schedule and verify that the actual mySQL data matches
	 **/
	public function testInsertValidSchedule() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("schedule");

		// create a new Schedule and insert to into mySQL
		$schedule = new Schedule(null, $this->scheduleCrewId->getScheduleCrewId(), $this->VALID_SCHEDULECONTENT, $this->VALID_SCHEDULEDATE);
		$schedule->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSchedule = Schedule::getScheduleByScheduleId($this->getPDO(), $schedule->getScheduleId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("schedule"));
		$this->assertEquals($pdoSchedule->getScheduleCrewId(), $this->profile->getScheduleCrewId());
		$this->assertEquals($pdoSchedule->getScheduleStart(), $this->VALID_SCHEDULEDATE);
	}

	/**
	 * test inserting a Schedule that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidSchedule() {
		// create a Schedule with a non null schedule id and watch it fail
		$schedule = new Schedule (  TimecrunchersTest::INVALID_KEY, $this->scheduleCrewId->getScheduleCrewId(), $this->VALID_SCHEDULECONTENT, $this->VALID_SCHEDULEDATE);
		$schedule->insert($this->getPDO());
	}

	/**
	 * test inserting a Schedule, editing it, and then updating it
	 **/
	public function testUpdateValidSchedule() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("schedule");

		// create a new Schedule and insert to into mySQL
		$schedule = new Schedule(null, $this->scheduleCrewId->scheduleCrewId(), $this->VALID_SCHEDULECONTENT, $this->VALID_SCHEDULEDATE);
		$schedule->insert($this->getPDO());

		// edit the Schedule and update it in mySQL
		$schedule->setScheduleContent($this->VALID_SCHEDULECONTENT2);
		$schedule->update($this->getPDO());

		// I MAY HAVE AN ISSUE HERE ?!? with placement of variables
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSchedule = Schedule::getScheduleByScheduleId($this->getPDO(), $schedule->getScheduleId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("schedule"));
		$this->assertEquals($pdoSchedule->getScheduleCrewId(), $this->scheduleStartDate->getScheduleCrewId());
		$this->assertEquals($pdoSchedule->getScheduleDate(), $this->VALID_SCHEDULEDATE);
	}

	/**
	 * test updating a Schedule that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidSchedule() {
		// create a Schedule with a non null schedule id and watch it fail
		$schedule = new Schedule(null, $this->scheduleCrewId->getScheduleCrewId(), $this->VALID_SCHEDULECONTENT, $this->VALID_SCHEDULEDATE);
		$schedule->update($this->getPDO());
	}

	/**
	 * test creating a Schedule and then deleting it
	 **/
	public function testDeleteValidSchedule() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("schedule");

		// create a new Schedule and insert to into mySQL
		$schedule = new Schedule(null, $this->scheduleCrewId->getScheduleCrewId(), $this->VALID_SCHEDULECONTENT, $this->VALID_SCHEDULEDATE);
		$schedule->insert($this->getPDO());

		// delete the Schedule from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("schedule"));
		$schedule->delete($this->getPDO());

		// grab the data from mySQL and enforce the Schedule does not exist
		$pdoSchedule = Schedule::getScheduleByScheduleId($this->getPDO(), $schedule->getScheduleId());
		$this->assertNull($pdoSchedule);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("schedule"));
	}

	/**
	 * test deleting a Schedule that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidSchedule() {
		// create a Schedule and try to delete it without actually inserting it
		$schedule = new Schedule(null, $this->scheduleCrewId->getSceduleCrewId(), $this->VALID_SCHEDULECONTENT, $this->VALID_SCHEDULEDATE);
		$schedule->delete($this->getPDO());
	}

	/**+
	 * test inserting a Schedule and regrabbing it from mySQL
	 **/
	public function testGetValidScheduleByScheduleId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("schedule");

		// create a new Schedule and insert to into mySQL
		$schedule = new Schedule(null, $this->scheduleCrewId->getScheduleCrewId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$schedule->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSchedule = Schedule::getScheduleByScheduleId($this->getPDO(), $schedule->getScheduleId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("schedule"));
		$this->assertEquals($pdoSchedule->getScheduleCrewId(), $this->scheduleCrewId->getScheduleCrewId());
		$this->assertEquals($pdoSchedule->getScheduleStartDate(), $this->VALID_SCHEDULEDATE);
	}

	/**
	 * test grabbing a Schedule that does not exist
	 **/
	public function testGetInvalidScheduleByScheduleId() {
		// grab a scheduleCrewId id that exceeds the maximum allowable scheduleCrew id
		$schedule = Schedule::getScheduleByScheduleId($this->getPDO(), TimecrunchersTest::INVALID_KEY);
		$this->assertNull($schedule);
	}

	/**
	 * test grabbing a Schedule by schedule start date
	 **/
	public function testGetValidScheduleByScheduleStartDate() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("schedule");

		// create a new Schedule and insert to into mySQL
		$schedule = new Schedule(null, $this->scheduleCrewId->getScheduleStartDate(), $this->VALID_SCHEDULECONTENT, $this->VALID_SCHEDULEDATE);
		$schedule->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Schedule::getScheduleByScheduleStartDate($this->getPDO(), $schedule->getScheduleStartDate());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("schedule"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Timecrunchers\\Schedule", $results);

		// grab the result from the array and validate it
		$pdoSchedule = $results[0];
		$this->assertEquals($pdoSchedule->getScheduleCrewId(), $this->scheduleCrewId->getScheduleStartDate());
		$this->assertEquals($pdoSchedule->getScheduleDate(), $this->VALID_SCHEDULEDATE);
	}

	/**
	 * test grabbing a Schedule by schedule start date that does not exist
	 **/
	public function testGetInvalidScheduleByScheduleStartDate() {
		// grab a schedule start id that exceeds the maximum allowable schedule start id
		$schedule = Schedule::getScheduleByScheduleStartDate($this->getPDO(), "nobody ever created this");
		$this->assertCount(0, $schedule);
	}

	/**
	 * test grabbing all Schedules
	 **/
	public function testGetAllValidSchedules() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("schedule");

		// create a new Schedule and insert to into mySQL
		$schedule = new Schedule(null, $this->scheduleCrewId->getScheduleCrewId(), $this->VALID_SCHEDULECONTENT, $this->VALID_SCHEDULEDATE);
		$schedule->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Schedule::getAllSchedules($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("schedule"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Timecrunchers\\Schedule", $results);

		// grab the result from the array and validate it
		$pdoSchedule = $results[0];
		$this->assertEquals($pdoSchedule->getScheduleCrewId(), $this->scheduleId->getScheduleCrewId());
		$this->assertEquals($pdoSchedule->getScheduleStartDate(), $this->VALID_SCHEDULEDATE);
	}
}