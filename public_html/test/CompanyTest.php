<?php
namespace Edu\Cnm\Timecrunchers\Test;

use Edu\Cnm\Timecrunchers\{Profile, Tweet};
use Edu\Cnm\Timecrunchers\Company;

// grab the project test parameters
require_once("TimecrunchersTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoloader.php");

/**
 * Full PHPUnit test for the Company class
 *
 * This is a complete PHPUnit test of the Company class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Company
 * @author Elaine Thomas<enajera2@cnm.edu>
 **/
class CompanyTest extends TimecrunchersTest {
	/**
	 * content of the Company
	 * @var string $VALID_COMPANYNAME
	 **/
	protected $VALID_COMPANYNAME = "PHPUnit test passing";
	/**
	 * content of the updated Company
	 * @var string $VALID_COMPANYNAME2
	 **/
	protected $VALID_COMPANYNAME2 = "PHPUnit test still passing";

	/**
	 * I DON'T THINK I NEED THIS  **
	 * create dependent objects before running each test

	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// create and insert a Profile to own the test Tweet
		$this->profile = new Profile(null, "@phpunit", "test@phpunit.de", "+12125551212");
		$this->profile->insert($this->getPDO());

		// calculate the date (just use the time the unit test was setup...)
		$this->VALID_TWEETDATE = new \DateTime();
	}
**/

	/**
	 * test inserting a valid Company and verify that the actual mySQL data matches
	 **/
	public function testInsertValidCompany() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("company");

		// create a new Company and insert into mySQL
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYNAME2);
		$company->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSchedule = Company::getCompanyByCompanyId($this->getPDO(), $company->getCompanyId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("company"));
		$this->assertEquals($pdoSchedule->getScheduleId());
		$this->assertEquals($pdoSchedule->getCompanyName(), $this->VALID_COMPANYNAME);
		$this->assertEquals($pdoSchedule->getCompanyName(), $this->VALID_COMPANYNAME2);
	}

	/**
	 * test inserting a Tweet that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidCompany() {
		// create a Company with a non null company id and watch it fail
		$company = new Company(TimecrunchersTest::INVALID_KEY, $this->VALID_COMPANYNAME, $this->VALID_COMPANYNAME2);
		$company->insert($this->getPDO());
	}

	/**
	 * test inserting a Company, editing it, and then updating it
	 **/
	public function testUpdateValidCompany() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("company");

		// create a new Company and insert to into mySQL
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYNAME2);
		$company->insert($this->getPDO());

		// edit the Tweet and update it in mySQL
		$company->setCompanyName($this->VALID_COMPANYNAME2);
		$company->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoCompany = Company::getCompanyByCompanyId($this->getPDO(), $company->getCompanyId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("company"));
		$this->assertEquals($pdoCompany->getCompanyName(), $this->VALID_COMPANYNAME2);
	}

	/**
	 * test updating a Schedule that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidCompany() {
		// create a Company with a non null company id and watch it fail
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYNAME2);
		$company->update($this->getPDO());
	}

	/**
	 * test creating a Company and then deleting it
	 **/
	public function testDeleteValidCompany() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("company");

		// create a new Company and insert to into mySQL
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYNAME2);
		$company->insert($this->getPDO());

		// delete the Company from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("company"));
		$company->delete($this->getPDO());

		// grab the data from mySQL and enforce the Company does not exist
		$pdoCompany = Company::getCompanyByCompanyId($this->getPDO(), $company->getCompanyId());
		$this->assertNull($pdoCompany);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("company"));
	}

	/**
	 * test deleting a Company that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidCompany() {
		// create a Company and try to delete it without actually inserting it
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYNAME2);
		$company->delete($this->getPDO());
	}

	/**
	 * test inserting a Company and re-grabbing it from mySQL
	 **/
	public function testGetValidCompanyByCompanyId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("company");

		// create a new Company and insert to into mySQL
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYNAME2);
		$company->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoCompany = Company::getCompanyByCompanyId($this->getPDO(), $company->getCompanyId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("company"));
		$this->assertEquals($pdoCompany->getCompanyName(), $this->VALID_COMPANYNAME2);
	}

	/**
	 * test grabbing a Company by a name that does not exist
	 **/
	public function testGetInvalidCompanyByCompanyName() {
		// grab a company id that exceeds the maximum allowable company id
		$company = Company::getCompanyByCompanyName($this->getPDO(), "this company does not exist");
		$this->assertCount(0, $company);
	}

	/**
	 * test grabbing a Company by company name
	 **/
	public function testGetValidCompanyByCompanyName() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("company");

		// create a new Company and insert to into mySQL
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYNAME2);
		$company->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Company::getCompanyByCompanyName($this->getPDO(), $company->getCompanyName());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("company"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Timecrunchers\\Company", $results);

		// grab the result from the array and validate it
		$pdoCompany = $results[0];
		$this->assertEquals($pdoCompany->getCompanyName(), $this->VALID_COMPANYNAME);
		$this->assertEquals($pdoCompany->getCompanyName(), $this->VALID_COMPANYNAME2);
	}

	/**
	 * test grabbing a Company by a name that does not exist
	 **/
	public function testGetInvalidCompanyByCompanyName() {
		// grab a company name that nobody likes cause why not
		$company = Company::getCompanyByCompanyName($this->getPDO(), "This company does not exits yet");
		$this->assertCount(0, $company);
	}

	/**
	 * test grabbing all Company
	 **/
	public function testGetAllValidCompanies() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("company");

		// create a new Company and insert to into mySQL
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYNAME2);
		$company->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Company::getCompanyByCompanyName($this->getPDO(), $company->getCompanyName());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("company"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Timecrunchers\\Company", $results);

		// grab the result from the array and validate it
		$pdoCompany = $results[0];
		$this->assertEquals($pdoCompany->getCompanyName(), $this->VALID_COMPANYNAME;
		$this->assertEquals($pdoCompany->getCompanyName(), $this->VALID_COMPANYNAME2;
	}
}