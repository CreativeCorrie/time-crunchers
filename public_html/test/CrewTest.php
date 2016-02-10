<?php
namespace Edu\Cnm\Timecrunchers\Test;

use Edu\Cnm\Timecrunchers\Company;
use Edu\Cnm\Timecrunchers\Crew;

//grab the project test parameters
require_once ("TimecrunchersTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "php/classes/autoloader.php");

/**
 * FuLL PHPUnit test for the Crew class
 *
 * This is a complete PHPUnit test of the Crew class. It is complete because *ALL* my SQL/PDO enabled methods are tested for both invalid and valid inputs.
 *
 * @see Crew
 * @author Corrie Hooker<creativecorrie@gmail.com> <Team Collaboration: TimeCrunchers>
 **/
class CrewTest extends TimecrunchersTest {
	/**
	 * location of the Crew
	 * @var string $VALID_CREWLOCATION
	 **/
	PROTECTED $VALID_CREWLOCATIONT = "PHPUnit test passing";
	/**
	 * location of the updated Crew
	 * @var string $VALID_CREWLOCATION2
	 **/
	protected  $VALID_CREWLOCATION2 = "PHPUnit tes still passing";
	/**
	 * timestamp of the Crew; this starts as nuLL and is assigned Later
	 * @var \DateTime $VALID_CREWDATE
	 **/
	protected $VALID_CREWDATE = null;
	/**
	 * Profile that created the Crew; this is for foreign key relations
	 * @var Company company
	 **/
	protected $company = null;

	/**
	 *create dependent objects before running each test
	 **/
	public final function setUp() {
		//run the default setUp() method first
		parent::setUp();

		//create and insert a Company to own the test Crew
		$this->company = new Company(null, "@phpunit", "test@phpunit.de", "+12125551212");
		$this->company->insert($this->getPDO());

		//calculate the date(just use the time the unit test was setup...)
		$this->VALID_CREWDATE = new  \DateTime();
	}

	/**
	 * test inserting a valid Crew and verify that the actual mySQL date matches
	 **/
	public  function testInsertValidCrew() {
		//count the number of rows and save it for later
		$numRows = $this->getConection()->getRowCount("crew");

		//create a new Crew and insert to into mySQL
		$crew->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoCrew = Crew::getCrewByCrewId($this->getPDO(), $crew->>getCrewId());
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
		$crew = new Crew(TimecrunchersTest::INVALID_KEY, $this->company->getCompanyId(), $this->VALID_CREWLOCATIONT, $this->VALID_CREWDATE);
		$crew->insert($this->getPDO());
	}

	/**
	 * test inserting a Crew, editing it and then updating it
	 **/
}