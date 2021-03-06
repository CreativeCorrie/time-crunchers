<?php
namespace Edu\Cnm\Timecrunchers\Test;

//name the classes not the foreign keys
use Edu\Cnm\Timecrunchers\Access;


//grab test parameters
require_once("TimecrunchersTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoloader.php");

/**
 * Full PHPUnit test for the user class
 *
 * This is a complete PHPUnit test of the access class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see access
 * @author Denzyl Fontaine>
 **/
class AccessTest extends TimeCrunchersTest {
	/**
	 * content of the access
	 * @var string $VALID_ACCESSNAME
	 **/
	protected $VALID_ACCESSNAME = "PHPUnit test passing";
	/**
	 * content of updated access
	 * @var string $VALID_ACCESSNAME2
	 **/
	protected $VALID_ACCESSNAME2 = "PHPUnit test passing";

	/**
	 * test inserting a valid access and verify that the actual mySQL data matches
	 */
	public function testInsertValidAccess() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("access");

		//create a new Access and insert into mySQL
		$access = new Access(null, $this->VALID_ACCESSNAME);
		$access->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoAccess = Access::getAccessByAccessId($this->getPDO(), $access->getAccessId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("access"));
		$this->assertEquals($pdoAccess->getAccessName(), $this->VALID_ACCESSNAME);
	}

	/**
	 * test inserting access that already exists
	 *
	 * @expectedException \PDOException
	 */
	public function testInsertInvalidAccess() {
		//create a User with a non null access id and watch it fail
		$access = new Access(TimeCrunchersTest::INVALID_KEY, $this->VALID_ACCESSNAME);
		$access->insert($this->getPDO());
	}

	/**
	 * test inserting access, editing it and updating it
	 **/
	public function testUpdateValidAccess() {
		//count the rows and save for later
		$numRows = $this->getConnection()->getRowCount("access");

		//create a new access and insert it into mySQL
		$access = new Access(null, $this->VALID_ACCESSNAME);
		$access->insert($this->getPDO());

		//edit the Access and update it in mySQL
		$access->setAccessName($this->VALID_ACCESSNAME2);
		$access->update($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoAccess = Access::getAccessByAccessId($this->getPDO(), $access->getAccessId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("access"));
		$this->assertEquals($pdoAccess->getAccessName(), $this->VALID_ACCESSNAME2);
	}

	/**
	 * test updating an access that already exists
	 *
	 * @expectedException \PDOException
	 */
	public function testUpdateInvalidAccess() {
		//create an access with a non null access id and watch it fail
		$access = new Access(null, $this->VALID_ACCESSNAME);
		$access->update($this->getPDO());
	}

	/**
	 * test creating an access and then deleting it
	 */
	public function testDeleteValidAccess() {
		//count the number of rows and save it later
		$numRows = $this->getConnection()->getRowCount("access");

		//create new access and insert it into mySQL
		$access = new Access(null, $this->VALID_ACCESSNAME);
		$access->insert($this->getPDO());

		//delete the access from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("access"));
		$access->delete($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoAccess = Access::getAccessByAccessId($this->getPDO(), $access->getAccessId());
		$this->assertNull($pdoAccess);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("access"));
	}

	/**
	 * test deleting a access that does not exist
	 *
	 * @expectedException \PDOException
	 */
	public function testDeleteInvalidAccess() {
		//create access and try to delete without actually inserting it
		$access = new Access(null, $this->VALID_ACCESSNAME);
		$access->delete($this->getPDO());
	}

	/**
	 * test inserting access and regrabbing it from mySQL
	 **/
	public function testGetValidAccessByAccessId() {
		//count the number of row and save it for later
		$numRows = $this->getConnection()->getRowCount("access");

		//create a new access and insert into mySQL
		$access = new Access(null, $this->VALID_ACCESSNAME);
		$access->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoAccess = Access::getAccessByAccessId($this->getPDO(), $access->getAccessId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("access"));
		$this->assertEquals($pdoAccess->getAccessName(), $this->VALID_ACCESSNAME);
	}

	/**
	 * test grabbing Access by content that does not exist
	 */
	public function testGetInvalidAccessByAccessId() {
		//grab a user id that exceeds the maximum allowable profile id
		$access = Access::getAccessByAccessId($this->getPDO(), TimeCrunchersTest::INVALID_KEY);
		$this->assertNull($access);
	}

	/**
	 * test grabbing access by access name
	 **/
	public function testGetValidAccessByAccessName() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("access");

		//create a new access and insert into mySQL
		$access = new Access(null, $this->VALID_ACCESSNAME);
		$access->insert($this->getPDO());

		//var_dump($access);

		//grab the data form mySQL and enforce the fields match our expectations
		$results = Access::getAccessByAccessName($this->getPDO(), $access->getAccessName());

		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("access"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Timecrunchers\\access", $results);

		//grab the result from the array and validate it
		$pdoAccess = $results[0];
		$this->assertEquals($pdoAccess->getAccessName(), $this->VALID_ACCESSNAME);
	}

	/**
	 * test grabbing access by name that does not exist
	 **/
	public function testGetInvalidAccessByAccessName() {
		// grab a user id that exceeds the maximum allowable user id
		$access = Access::getAccessByAccessName($this->getPDO(), "nobody was ever given this access");
		$this->assertCount(0, $access);
	}

	/**
	 * test grabbing all access
	 **/
	public function testGetAllValidAccess() {
		//count all the rows and save it for later
		$numRows = $this->getConnection()->getRowCount("access");

		//create a new access and insert into mySQL
		$access = new Access(null, $this->VALID_ACCESSNAME);
		$access->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$results = Access::getAllAccess($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("access"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Timecrunchers\\Access", $results);

		//grab the result from the array and validate it
		$pdoAccess = $results[0];
		$this->assertEquals($pdoAccess->getAccessName(), $this->VALID_ACCESSNAME);
	}
}
