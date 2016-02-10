<?php
namespace Edu\Cnm\Timecrunchers\Test;

use Edu\Cnm\Timecrunchers\Company;

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
	 * content of the Crew
	 * @var string $VALID_CREWCONTENT
	 **/
	PROTECTED $VALID_CREWCONTENT = "PHPUnit test passing";
	/**
	 * content of the updated Crew
	 * @var string $VALID_CREWCONTENT2
	 **/
	protected  $VALID_CREWCONTENT2 = "PHPUnit tes still passing";
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
		$this->company = new Company(null, "@phpunit", "test@phpunit.de", )
	}
}