<?php
namespace Edu\Cnm\Timecrunchers\Test;

//name the classes not the foreign key
use Edu\Cnm\Timecrunchers\Company;
use Edu\Cnm\Timecrunchers\Crew;
use Edu\Cnm\Timecrunchers\Schedule;

// grab the project test parameters
require_once("TimecrunchersTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoloader.php");

/**
 * Full PHPUnit test for the Schedule class
 * This is a complete PHPUnit test of the Schedule class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Schedule
 * @author Dylan McDonald<dmcdonald21@cnm.edu>
 * @author Elaine Thomas<enajera2@cnm.edu>
 **/
class ScheduleTest extends TimeCrunchersTest {
	/**
	 * Crew that Schedule is attached to; this is for foreign key relations
	 * @var Crew $crew
	 **/
	protected $crew = null;
	/**
	 * Company that Schedule is attached to; this is for foreign key relations
	 * @var Company $company
	 **/
	protected $company = null;
	/**
	 * start day of Schedule
	 * @var \DateTime $VALID_SCHEDULESTARTDATE
	 **/
	protected $VALID_SCHEDULESTARTDATE = null;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// create and insert a Company to test Schedule
		$this->company = new Company(null, "Kitty Scratchers", "1600 Pennsylvania Ave NW", "Senator's Palace", "Senator Arlo", "WA", "Felis Felix", "20500", "+12125551212", "kitty@aol.com", "www.kitty.com");
		$this->company->insert($this->getPDO());

		// create and insert a Crew to own the test Schedule
		$this->crew = new Crew(null, $this->company->getCompanyId(), "Taco Bell");
		$this->crew->insert($this->getPDO());

		// calculate the date (just use the time the unit test was setup...)
		$this->VALID_SCHEDULESTARTDATE = new \DateTime();
	}

	/**
	 * Test inserting a valid schedule and verify that the actual MySQL data matches
	 **/

	public function testInsertValidSchedule() {
		//Count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("schedule");

		//Create a new Schedule and insert into MySQL
		$schedule = new Schedule (null, $this->crew->getCrewId(), $this->VALID_SCHEDULESTARTDATE);
		$schedule->insert($this->getPDO());

		//Grab data from MySQL and enforce fields match expectations
		$pdoSchedule = Schedule::getScheduleByScheduleId($this->getPDO(), $schedule->getScheduleId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("schedule"));
		$this->assertEquals($pdoSchedule->getScheduleCrewId(), $this->crew->getCrewId());
		$this->assertEquals($pdoSchedule->getScheduleStartDate(), $this->VALID_SCHEDULESTARTDATE);
	}

	/**
	 * test inserting a Schedule that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidSchedule() {
		// create a Schedule with a non null schedule id and watch it fail
		$schedule = new Schedule(TimecrunchersTest::INVALID_KEY, $this->crew->getCrewId(), $this->VALID_SCHEDULESTARTDATE);
		$schedule->insert($this->getPDO());
	}

	/**
	 * test inserting a Schedule, editing it, and then updating it
	 **/
	public function testUpdateValidSchedule() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("schedule");

		// create a new Schedule and insert into mySQL
		$schedule = new Schedule(null, $this->crew->getCrewId(), $this->VALID_SCHEDULESTARTDATE);
		$schedule->insert($this->getPDO());

		// edit the Schedule and update it in mySQL
		$schedule->setScheduleStartDate($this->VALID_SCHEDULESTARTDATE);
		$schedule->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSchedule = Schedule::getScheduleByScheduleId($this->getPDO(), $schedule->getScheduleId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("schedule"));
		$this->assertEquals($pdoSchedule->getScheduleCrewId(), $this->crew->getCrewId());
		$this->assertEquals($pdoSchedule->getScheduleStartDate(), $this->VALID_SCHEDULESTARTDATE);
	}

	/**
	 * test updating a Schedule that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidSchedule() {
		// create a Schedule with a non null schedule id and watch it fail
		$schedule = new Schedule(null, $this->crew->getCrewId(), $this->VALID_SCHEDULESTARTDATE);
		$schedule->update($this->getPDO());
	}

	/**
	 * test creating a Schedule and then deleting it
	 **/
	public function testDeleteValidSchedule() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("schedule");

		// create a new Schedule and insert to into mySQL
		$schedule = new Schedule(null, $this->crew->getCrewId(), $this->VALID_SCHEDULESTARTDATE);
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
		$schedule = new Schedule(null, $this->crew->getCrewId(), $this->VALID_SCHEDULESTARTDATE);
		$schedule->delete($this->getPDO());
	}

	/**+
	 * test inserting a Schedule and re-grabbing it from mySQL
	 **/
	public function testGetValidScheduleByScheduleId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("schedule");

		// create a new Schedule and insert to into mySQL
		$schedule = new Schedule(null, $this->crew->getCrewId(), $this->VALID_SCHEDULESTARTDATE);
		$schedule->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSchedule = Schedule::getScheduleByScheduleId($this->getPDO(), $schedule->getScheduleId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("schedule"));
		$this->assertEquals($pdoSchedule->getScheduleCrewId(), $this->crew->getCrewId());
		$this->assertEquals($pdoSchedule->getScheduleStartDate(), $this->VALID_SCHEDULESTARTDATE);
	}

	/**
	 * test grabbing a Schedule that does not exist
	 **/
	public function testGetInvalidScheduleByScheduleId() {
		// grab a crew id that exceeds the maximum allowable scheduleCrew id
		$schedule = Schedule::getScheduleByScheduleId($this->getPDO(), TimeCrunchersTest::INVALID_KEY);
		$this->assertNull($schedule);
	}

	/**
	 * test grabbing a Schedule by schedule start date
	 **/
	public function testGetScheduleByScheduleStartDate() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("schedule");

		// create a new Schedule and insert into mySQL
		$schedule = new Schedule(null, $this->crew->getCrewId(), $this->VALID_SCHEDULESTARTDATE);
		$schedule->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Schedule::getScheduleByScheduleStartDate($this->getPDO(), $schedule->getScheduleStartDate());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("schedule"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Timecrunchers\\Schedule", $results);

		//get data from database and ensure fields match our expectations
		$results = Schedule::getScheduleByScheduleStartDate($this->getPDO(), $schedule->getScheduleStartDate());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount ("schedule"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf ("Edu\\Cnm\\Timecrunchers\\Schedule", $results);

		// grab the result from the array and validate it
		$pdoSchedule = $results[0];
		$this->assertEquals($pdoSchedule->getScheduleCrewId(), $this->crew->getCrewId());
		$this->assertEquals($pdoSchedule->getScheduleStartDate(), $this->VALID_SCHEDULESTARTDATE);
	}

	/**
	 * test grabbing a Schedule by schedule start date that does not exist
	 **/
	public function testGetInvalidScheduleByScheduleStartDate() {
		// grab a schedule by an invalid start date
		$schedule = Schedule::getScheduleByScheduleStartDate($this->getPDO(), $this->VALID_SCHEDULESTARTDATE);
		$this->assertCount(1, $schedule);
	}

	/**
	 * test grabbing all Schedules
	 **/
	public function testGetAllValidSchedules() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("schedule");

		// create a new Schedule and insert to into mySQL
		$schedule = new Schedule(null, $this->crew->getCrewId(), $this->VALID_SCHEDULESTARTDATE);
		$schedule->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Schedule::getAllSchedules($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("schedule"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Timecrunchers\\Schedule", $results);

		// grab the result from the array and validate it
		$pdoSchedule = $results[0];
		$this->assertEquals($pdoSchedule->getScheduleCrewId(), $this->crew->getCrewId());
		$this->assertEquals($pdoSchedule->getScheduleStartDate(), $this->VALID_SCHEDULESTARTDATE);
	}
}