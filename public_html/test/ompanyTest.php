<?php
namespace Edu\Cnm\Timecrunchers\Test;

use Edu\Cnm\Timecrunchers\{Profile, Tweet};

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
	 * @var string $VALID_COMPANYCONTENT
	 **/
	protected $VALID_COMPANYCONTENT = "PHPUnit test passing";
	/**
	 * content of the updated Company
	 * @var string $VALID_COMPANYCONTENT2
	 **/
	protected $VALID_COMPANYCONTENT2 = "PHPUnit test still passing";

	/**
	 * I'M NOT SURE IF I NEED THIS  **
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

		// create a new Company and insert to into mySQL
		$company = new Company(null, $this->profile->getProfileId(), $this->VALID_COMPANYCONTENT, $this->VALID_TWEETDATE);
		$company->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTweet = Tweet::getTweetByTweetId($this->getPDO(), $company->getTweetId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("company"));
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_COMPANYCONTENT);
		$this->assertEquals($pdoTweet->getTweetDate(), $this->VALID_TWEETDATE);
	}

	/**
	 * test inserting a Tweet that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidTweet() {
		// create a Tweet with a non null tweet id and watch it fail
		$tweet = new Tweet(DataDesignTest::INVALID_KEY, $this->profile->getProfileId(), $this->VALID_COMPANYCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());
	}

	/**
	 * test inserting a Tweet, editing it, and then updating it
	 **/
	public function testUpdateValidTweet() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tweet");

		// create a new Tweet and insert to into mySQL
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_COMPANYCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());

		// edit the Tweet and update it in mySQL
		$tweet->setTweetContent($this->VALID_COMPANYCONTENT2);
		$tweet->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTweet = Tweet::getTweetByTweetId($this->getPDO(), $tweet->getTweetId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_COMPANYCONTENT2);
		$this->assertEquals($pdoTweet->getTweetDate(), $this->VALID_TWEETDATE);
	}

	/**
	 * test updating a Tweet that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidTweet() {
		// create a Tweet with a non null tweet id and watch it fail
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_COMPANYCONTENT, $this->VALID_TWEETDATE);
		$tweet->update($this->getPDO());
	}

	/**
	 * test creating a Tweet and then deleting it
	 **/
	public function testDeleteValidTweet() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tweet");

		// create a new Tweet and insert to into mySQL
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_COMPANYCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());

		// delete the Tweet from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$tweet->delete($this->getPDO());

		// grab the data from mySQL and enforce the Tweet does not exist
		$pdoTweet = Tweet::getTweetByTweetId($this->getPDO(), $tweet->getTweetId());
		$this->assertNull($pdoTweet);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("tweet"));
	}

	/**
	 * test deleting a Tweet that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidTweet() {
		// create a Tweet and try to delete it without actually inserting it
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_COMPANYCONTENT, $this->VALID_TWEETDATE);
		$tweet->delete($this->getPDO());
	}

	/**
	 * test inserting a Tweet and regrabbing it from mySQL
	 **/
	public function testGetValidTweetByTweetId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tweet");

		// create a new Tweet and insert to into mySQL
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_COMPANYCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTweet = Tweet::getTweetByTweetId($this->getPDO(), $tweet->getTweetId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_COMPANYCONTENT);
		$this->assertEquals($pdoTweet->getTweetDate(), $this->VALID_TWEETDATE);
	}

	/**
	 * test grabbing a Tweet that does not exist
	 **/
	public function testGetInvalidTweetByTweetId() {
		// grab a profile id that exceeds the maximum allowable profile id
		$tweet = Tweet::getTweetByTweetId($this->getPDO(), DataDesignTest::INVALID_KEY);
		$this->assertNull($tweet);
	}

	/**
	 * test grabbing a Tweet by tweet content
	 **/
	public function testGetValidTweetByTweetContent() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tweet");

		// create a new Tweet and insert to into mySQL
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_COMPANYCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Tweet::getTweetByTweetContent($this->getPDO(), $tweet->getTweetContent());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Dmcdonald21\\DataDesign\\Tweet", $results);

		// grab the result from the array and validate it
		$pdoTweet = $results[0];
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_COMPANYCONTENT);
		$this->assertEquals($pdoTweet->getTweetDate(), $this->VALID_TWEETDATE);
	}

	/**
	 * test grabbing a Tweet by content that does not exist
	 **/
	public function testGetInvalidTweetByTweetContent() {
		// grab a profile id that exceeds the maximum allowable profile id
		$tweet = Tweet::getTweetByTweetContent($this->getPDO(), "nobody ever tweeted this");
		$this->assertCount(0, $tweet);
	}

	/**
	 * test grabbing all Tweets
	 **/
	public function testGetAllValidTweets() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tweet");

		// create a new Tweet and insert to into mySQL
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_COMPANYCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Tweet::getAllTweets($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Dmcdonald21\\DataDesign\\Tweet", $results);

		// grab the result from the array and validate it
		$pdoTweet = $results[0];
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_COMPANYCONTENT);
		$this->assertEquals($pdoTweet->getTweetDate(), $this->VALID_TWEETDATE);
	}
}