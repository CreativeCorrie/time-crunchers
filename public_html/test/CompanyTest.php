<?php
namespace Edu\Cnm\Timecrunchers\Test;

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
class CompanyTest extends TimeCrunchersTest {
	/**
	 * content of the Company name
	 * @var string $VALID_COMPANYNAME
	 **/
	protected $VALID_COMPANYNAME = "PHPUnit test passing";
	/**
	 * content of the updated Company name
	 * @var string $VALID_COMPANYNAME2
	 **/
	protected $VALID_COMPANYNAME2= "PHPUnit test still passing";
	/**
	 * content of the Company attn, optional
	 * @var string $VALID_COMPANYATTN
	 **/
	protected $VALID_COMPANYATTN = "PHPUnit test passing";
	/**
	 * content of the updated Company attn, optional
	 * @var string $VALID_COMPANYNATTN2
	 **/
	protected $VALID_COMPANYATTN2 = "PHPUnit test still passing";
	/**
	 * content of the Company address 1
	 * @var string $VALID_COMPANYADDRESS1
	 **/
	protected $VALID_COMPANYADDRESS1 = "PHPUnit test passing";
	/**
	 * content of the updated address 1
	 * @var string $VALID_COMPANYADDRESS12
	 **/
	protected $VALID_COMPANYADDRESS12 = "PHPUnit test still passing";
	/**
	 * content of the Company address 2 (2nd line optional)
	 * @var string $VALID_COMPANYADDRESS2
	 **/
	protected $VALID_COMPANYADDRESS2 = "PHPUnit test passing";
	/**
	 * content of the updated Company phone number
	 * @var string $VALID_COMPANYADDRESS22
	 **/
	protected $VALID_COMPANYADDRESS22 = "PHPUnit test still passing";
	/**
	 * content of the Company state
	 * @var string $VALID_COMPANYSTATE
	 **/
	protected $VALID_COMPANYSTATE = "PHPUnit test passing";
	/**
	 * content of the updated Company state
	 * @var string $VALID_COMPANYSTATE2
	 **/
	protected $VALID_COMPANYSTATE2 = "PHPUnit test still passing";
	/**
	 * content of the Company city
	 * @var string $VALID_COMPANYCITY
	 **/
	protected $VALID_COMPANYCITY = "PHPUnit test passing";
	/**
	 * content of the updated Company city
	 * @var string $VALID_COMPANYCITY2
	 **/
	protected $VALID_COMPANYCITY2 = "PHPUnit test still passing";
	/**
	 * content of the Company zip
	 * @var string $VALID_COMPANYZIP
	 **/
	protected $VALID_COMPANYZIP = "PHPUnit test passing";
	/**
	 * content of the updated Company zip
	 * @var string $VALID_COMPANYZIP2
	 **/
	protected $VALID_COMPANYZIP2 = "PHPUnit test still passing";
	/**
	 * content of the Company phone number
	 * @var string $VALID_COMPANYPHONE
	 **/
	protected $VALID_COMPANYPHONE = "PHPUnit test passing";
	/**
	 * content of the updated Company phone number
	 * @var string $VALID_COMPANYNAME2
	 **/
	protected $VALID_COMPANYPHONE2 = "PHPUnit test still passing";
	/**
	 * content of the Company email
	 * @var string $VALID_COMPANYEMAIL
	 **/
	protected $VALID_COMPANYEMAIL = "PHPUnit test passing";
	/**
	 * content of the updated Company email
	 * @var string $VALID_COMPANYEMAIL2
	 **/
	protected $VALID_COMPANYEMAIL2 = "PHPUnit test still passing";
	/**
	 * content of the Company URL
	 * @var string $VALID_COMPANYURL
	 **/
	protected $VALID_COMPANYURL = "PHPUnit test passing";
	/**
	 * content of the updated Company URL
	 * @var string $VALID_COMPANYURL2
	 **/
	protected $VALID_COMPANYURL2 = "PHPUnit test still passing";

	/**
	 *
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

		// create a new Company and insert into mySQL - put in all of the things from the constructor
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYADDRESS1, $this->VALID_COMPANYADDRESS2, $this->VALID_COMPANYATTN, $this->VALID_COMPANYSTATE, $this->VALID_COMPANYCITY, $this->VALID_COMPANYZIP, $this->VALID_COMPANYPHONE, $this->VALID_COMPANYEMAIL, $this->VALID_COMPANYURL);
		$company->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoSchedule = Company::getCompanyByCompanyId($this->getPDO(), $company->getCompanyId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("company"));
		$this->assertEquals($pdoSchedule->getCompanyId(), null);
		$this->assertEquals($pdoSchedule->getCompanyName(), $this->VALID_COMPANYNAME);
		$this->assertEquals($pdoSchedule->getCompanyName(), $this->VALID_COMPANYNAME2);
	}

	/**
	 * test inserting a Company that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidCompany() {
		// create a Company with a non null company id and watch it fail
		$company = new Company(TimeCrunchersTest::INVALID_KEY, $this->VALID_COMPANYNAME, $this->VALID_COMPANYADDRESS1, $this->VALID_COMPANYADDRESS2, $this->VALID_COMPANYATTN, $this->VALID_COMPANYSTATE, $this->VALID_COMPANYCITY, $this->VALID_COMPANYZIP, $this->VALID_COMPANYPHONE, $this->VALID_COMPANYEMAIL, $this->VALID_COMPANYURL);
		$company->insert($this->getPDO());
	}

	/**
	 * test inserting a Company, editing it, and then updating it
	 **/
	public function testUpdateValidCompany() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("company");

		// create a new Company and insert to into mySQL
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYADDRESS1, $this->VALID_COMPANYADDRESS2, $this->VALID_COMPANYATTN, $this->VALID_COMPANYSTATE, $this->VALID_COMPANYCITY, $this->VALID_COMPANYZIP, $this->VALID_COMPANYPHONE, $this->VALID_COMPANYEMAIL, $this->VALID_COMPANYURL);
		$company->insert($this->getPDO());

		// edit the Company and update it in mySQL
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
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYADDRESS1, $this->VALID_COMPANYADDRESS2, $this->VALID_COMPANYATTN, $this->VALID_COMPANYSTATE, $this->VALID_COMPANYCITY, $this->VALID_COMPANYZIP, $this->VALID_COMPANYPHONE, $this->VALID_COMPANYEMAIL, $this->VALID_COMPANYURL);
		$company->update($this->getPDO());
	}

	/**
	 * test creating a Company and then deleting it
	 **/
	public function testDeleteValidCompany() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("company");

		// create a new Company and insert to into mySQL
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYADDRESS1, $this->VALID_COMPANYADDRESS2, $this->VALID_COMPANYATTN, $this->VALID_COMPANYSTATE, $this->VALID_COMPANYCITY, $this->VALID_COMPANYZIP, $this->VALID_COMPANYPHONE, $this->VALID_COMPANYEMAIL, $this->VALID_COMPANYURL);
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
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYADDRESS1, $this->VALID_COMPANYADDRESS2, $this->VALID_COMPANYATTN, $this->VALID_COMPANYSTATE, $this->VALID_COMPANYCITY, $this->VALID_COMPANYZIP, $this->VALID_COMPANYPHONE, $this->VALID_COMPANYEMAIL, $this->VALID_COMPANYURL);
		$company->delete($this->getPDO());
	}

	/**
	 * test inserting a Company and re-grabbing it from mySQL
	 **/
	public function testGetValidCompanyByCompanyId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("company");

		// create a new Company and insert to into mySQL
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYADDRESS1, $this->VALID_COMPANYADDRESS2, $this->VALID_COMPANYATTN, $this->VALID_COMPANYSTATE, $this->VALID_COMPANYCITY, $this->VALID_COMPANYZIP, $this->VALID_COMPANYPHONE, $this->VALID_COMPANYEMAIL, $this->VALID_COMPANYURL);
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
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYADDRESS1, $this->VALID_COMPANYADDRESS2, $this->VALID_COMPANYATTN, $this->VALID_COMPANYSTATE, $this->VALID_COMPANYCITY, $this->VALID_COMPANYZIP, $this->VALID_COMPANYPHONE, $this->VALID_COMPANYEMAIL, $this->VALID_COMPANYURL);
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
	 * test grabbing all Company
	 **/
	public function testGetAllValidCompanies() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("company");

		// create a new Company and insert to into mySQL
		$company = new Company(null, $this->VALID_COMPANYNAME, $this->VALID_COMPANYADDRESS1, $this->VALID_COMPANYADDRESS2, $this->VALID_COMPANYATTN, $this->VALID_COMPANYSTATE, $this->VALID_COMPANYCITY, $this->VALID_COMPANYZIP, $this->VALID_COMPANYPHONE, $this->VALID_COMPANYEMAIL, $this->VALID_COMPANYURL);
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
}