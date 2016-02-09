<?php
namespace Edu\Cnm\Timecrunchers\test;


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
		$schedule->setTweetContent($this->VALID_TWEETCONTENT2);
		$tweet->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTweet = Tweet::getTweetByTweetId($this->getPDO(), $tweet->getTweetId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_TWEETCONTENT2);
		$this->assertEquals($pdoTweet->getTweetDate(), $this->VALID_TWEETDATE);
	}

	/**
	 * test updating a Tweet that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidTweet() {
		// create a Tweet with a non null tweet id and watch it fail
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->update($this->getPDO());
	}

	/**
	 * test creating a Tweet and then deleting it
	 **/
	public function testDeleteValidTweet() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tweet");

		// create a new Tweet and insert to into mySQL
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
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
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->delete($this->getPDO());
	}

	/**
	 * test inserting a Tweet and regrabbing it from mySQL
	 **/
	public function testGetValidTweetByTweetId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("tweet");

		// create a new Tweet and insert to into mySQL
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoTweet = Tweet::getTweetByTweetId($this->getPDO(), $tweet->getTweetId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_TWEETCONTENT);
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
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Tweet::getTweetByTweetContent($this->getPDO(), $tweet->getTweetContent());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Dmcdonald21\\DataDesign\\Tweet", $results);

		// grab the result from the array and validate it
		$pdoTweet = $results[0];
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_TWEETCONTENT);
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
		$tweet = new Tweet(null, $this->profile->getProfileId(), $this->VALID_TWEETCONTENT, $this->VALID_TWEETDATE);
		$tweet->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$results = Tweet::getAllTweets($this->getPDO());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("tweet"));
		$this->assertCount(1, $results);
		$this->assertContainsOnlyInstancesOf("Edu\\Cnm\\Dmcdonald21\\DataDesign\\Tweet", $results);

		// grab the result from the array and validate it
		$pdoTweet = $results[0];
		$this->assertEquals($pdoTweet->getProfileId(), $this->profile->getProfileId());
		$this->assertEquals($pdoTweet->getTweetContent(), $this->VALID_TWEETCONTENT);
		$this->assertEquals($pdoTweet->getTweetDate(), $this->VALID_TWEETDATE);
	}
}