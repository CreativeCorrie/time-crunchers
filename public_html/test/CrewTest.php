<?php
namespace Edu\Cnm\Timecrunchers\Test;

use Edu\Cnm\Timecrunchers\Crew;
use Edu\Cnm\Timecrunchers\Company;

// grab the project test parameters
require_once("TimecrunchersTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoloader.php");

/**
 * Full PHPUnit test for the Crew class
 *
 * This is a complete PHPUnit test of the Crew class. It is complete because *ALL* my SQL/PDO enabled methods are tested for both invalid and valid inputs.
 *
 * @see Crew
 * @author Dylan McDonald<dmcdonald21@cnm.edu>
 * @author Corrie Hooker<creativecorrie@gmail.com> <Team Collaboration: TimeCrunchers>
 * 
 **/
class CrewTest extends TimecrunchersTest {

	/**
	 * location of the Crew
	 * @var string $VALID_CREWLOCATION
	 **/
	PROTECTED $VALID_CREWLOCATION = "PHPUnit test passing";

	/**
	 * location of the updated Crew
	 * @var string $VALID_CREWLOCATION2
	 **/
	protected  $VALID_CREWLOCATION2 = "PHPUnit test still passing";
	/**
	 * timestamp of the Crew; this starts as nuLL and is assigned Later
	 * @var \DateTime $VALID_CREWDATE
	 **/
	protected $VALID_CREWDATE = null;
	/**
	 * Profile that created the Crew; this is for foreign key relations
	 * @var Company $VALID_COMPANY
	 **/
	protected $VALID_COMPANY = null;

	/**
	 *create dependent objects before running each test
	 **/
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();

		//create and insert a Company to own the test Crew
		$this->company = new Company(null, "Kitty Scratchers", "1600 Pennsylvania Ave NW", "Senator's Palace", "Senator Arlo", "WA", "Felis Felix", "20500", "+12125551212", "kitty@aol.com", "www.kitty.com");
		$this->company->insert($this->getPDO());

		//calculate the date(just use the time the unit test was setup...)
		$this->VALID_CREWDATE = new  \DateTime();
	}

	/**
	 * test inserting a valid Crew and verify that the actual mySQL date matches
	 **/
	public  function testInsertValidCrew($crew) {
		//count the number of rows and save it for later
		$numRows = $this->getConection()->getRowCount("crew");

		//create a new Crew and insert to into mySQL
		$crew->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoCrew = Crew::getCrewByCrewId($this->getPDO(), $crew->getCrewId());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("crew"));
		$this->assertEquals($pdoCrew->getCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoCrew->getCrewLocation(), $this->VALID_CREWLOCATION);
	}
	/**
	 * test inserting a Crew that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidCrew() {
		//create a Crew with anon null crew id and watch it fail
		$crew = new Crew(TimecrunchersTest::INVALID_KEY, $this->company->getCompanyId(), $this->VALID_CREWLOCATION, $this->VALID_CREWDATE);
		$crew->insert($this->getPDO());
	}

	/**
	 * test inserting a Crew, editing it and then updating i
	 **/
	public function testUpdateValidCrew() {
		//count the  number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("crew");

		//create a new Crew and insert to into mySQL
		$crew = new Crew(null, $this->company->getCompanyId(), $this->VALID_CREWLOCATION, $this->VALID_CREWDATE);
		$crew->insert($this->getPDO());

		//edit the Crew and update it in mySQL
		$crew->setCrewLocation($this->VALID_CREWLOCATION2);
		$crew->update($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoCrew = Crew::getCrewByCrewId($this->getPDO(), $crew->getCrewId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("crew"));
		$this->assertEquals($pdoCrew->getCrewCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoCrew->getCrewLocation(), $this->VALID_CREWLOCATION2);
		$this->assertEquals($pdoCrew->getCrewDate(), $this->VALID_CREWDATE);
	}
	/**
	 * test updating a Crew that already exists
	 *
	 * @expectedException \PDOException
	 **/
	public function testUpdateInvalidCrew() {
		//create a Crew with a non null crew id and watch it fail
		$crew = new Crew(null, $this->company->getCompanyId(), $this->VALID_CREWLOCATION, $this->VALID_CREWDATE);
		$crew->update($this->getPDO());
	}

	/**
	 * test creating a Crew and then deleting it
	 **/
	public function testDeleteValidCrew() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("crew");

		//create a new Crew and insert it into mySQL
		$crew = new Crew(null, $this->company->getCompanyId(), $this->VALID_CREWLOCATION, $this->VALID_CREWDATE);
		$crew->insert($this->getPDO());
		//delete the Crew from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("crew"));
		$crew->delete($this->getPDO());

		//grab the date from mySQL and enforce the Crew does not exist
		$pdoCrew = Crew::getCrewByCrewId($this->getPDO(), $crew->getCrewId());
		$this->assertNull($pdoCrew);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("crew"));
	}
	/**
	 * test deleting a Crew that does not exist
	 *
	 * @expectedException \PDOException
	 **/
	public function testDeleteInvalidCrew() {
		//create a Crew and try to delete it without actually inserting it
		$crew = new Crew(null, $this->company->getCompanyId(), $this->VALID_CREWLOCATION, $this->VALID_CREWDATE);
		$crew->delete($this->getPDO());
	}
	/**
	 * test inserting a Crew and regrabbing it form mySQL
	 **/
	public function testGetValidCrewByCrewId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("crew");

		//create a new Crew and insert it into mySQL
		$crew = new Crew(null, $this->company->getCompanyId(), $this->VALID_CREWLOCATION, $this->VALID_CREWDATE);

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoCrew = Crew::getCrewByCrewId($this->getPDO(), $crew->getCrewId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("crew"));
		$this->assertEquals($pdoCrew->getCrewCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoCrew->getCrewDate(), $this->VALID_CREWDATE);
	}
	/**
	 * test grabbing a Crew taht does not exist
	 **/
	public function testGetInvalidCrewByCrewID () {
		//grab a profile id that exceeds the maximum allowable profileid
		$crew = Crew::getCrewByCrewId($this->getPDO(), TimecrunchersTest::INVALID_KEY);
		$this->assertNull($crew);
	}
	/**
	 * test grabbinga  Crew by crew location
	 **/
	public function testGetValidCrewByCrewLocation() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("crew");

		//create a new Crew and insert it into mySQL
		$crew = new Crew(null, $this->company->getCompanyId(), $this->VALID_CREWLOCATION, $this->VALID_CREWDATE);
		$crew->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Crew::getCrewByCrewId($this->getPDO(), $crew->getCrewLocation());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("crew"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\vhooker\\TimecrunchersTest\\Crew", $results);

		//grab the result fromthe array and validate it
		$pdoCrew = $results[0];
		$this->assertEquals($pdoCrew->getCrewLocation(), $this->VALID_CREWLOCATION);
		$this->assertEquals($pdoCrew->getCrewDate(), $this->VALID_CREWDATE);
	}
	/**
	 * test grabbing a Crew by a location that does not exist
	 **/
	public function testGetInvalidCrewByCrewLocation() {
		//grab a company id that exceeds the maximum allowable company id
		$crew = Crew::getCrewByCrewLocation($this->getPDO(), "nobody ever went here");
		$this->assertCount(0, $crew);
	}
	/**
	 * test grabbing all Crews
	 **/
	public function testGetallValidCrews() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowcount("crew");

		//create a new Crew and insert it into mySQL
		$crew = new Crew(null, $this->company->getCompanyId(), $this->VALID_CREWLOCATION, $this->VALID_CREWDATE);
		$crew->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Crew::getAllCrews($this->getPDO());
		$this->assertEquals($numRows +1, $this->getConnection()->getRowCount("crew"));
		$this->assertCount(1, $results);
		$this->assertContainsONlyInstancesOf("Edu\\Cnm\\Vhooker\\TimecrunchersTest\\Crew", $results);
		//grab the result fromt eh array and validate it
		$pdoCrew = $results[0];
		$this->assertEquals($pdoCrew->getCompanyId(), $this->company->getCompanyId());
		$this->assertEquals($pdoCrew->getCrewLocation(), $this->VALID_CREWLOCATION);
		$this->assertEqulas($pdoCrew->getCrewDate(), $this->VALID_CREWDATE);
	}
}