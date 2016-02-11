<?php
namespace Edu\Cnm\Timecrunchers\Request;

use Edu\Cnm\Timecrunchers\{User, Request};

// grab the project test parameters
require_once("TimecrunchersTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoloader.php");

/**
 * Full PHPUnit test for the Tweet class
 *
 * This is a complete PHPUnit test of the Tweet class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Request
 * @author Samuel Van Chandler <samuelvanchandler@gmail.com>
 **/
class RequestTest extends TimecrunchersTest {
	/**
	 * content of the requestor text
	 * @var string $VALID_REQUESTREQUESTORTEXT
	 **/
	protected $VALID_REQUESTREQUESTORTEXT = "PHPUnit test passing";
	/**
	 * content of the  requestor text
	 * @var string $VALID_REQUESTREQUESTORTEXT
	 **/
	protected $VALID_REQUESTREQUESTORTEXT2 = "PHPUnit test passing";
	/**
	 * content of the admin text
	 * @var string $VALID_REQUESTADMINTEXT
	 **/
	protected $VALID_REQUESTADMINTEXT = "PHPUnit test passing";
	/**
	 * timestamp of the Request; this starts as null and is assigned later
	 * @var /DateTime $VALID_REQUESTTIMESTAMP
	 **/
	protected $VALID_REQUESTTIMESTAMP = null;
	/**
	 * timestamp of the Request; this starts as null and is assigned later
	 * @var /DateTime $VALID_REQUESTACTIONTIMESTAMP
	 **/
	protected $VALID_REQUESTACTIONTIMESTAMP = null;
	/**
	 * UserId that made the Request; this is for foreign key relations
	 * @var $requestor
	 **/
	protected $requestor = null;
	/**
	 * AdminId that Approves the Request; this is for foreign key relations
	 * @var  $admin
	 **/
	protected $admin = null;
	/**
	 * Admin true/false approval/denial of request
	 * @var  $requestApprove
	 **/
	protected $requestApprove = null;

	/**
	 * create dependent objects before running each test
	 **/
	public final function setUp() {
		// run the default setUp() method first
		parent::setUp();

		// create and insert a Users to own the test Request
		$this->requestor = new User(null, null, null, null, "+12125551212", "Johnny", "Requestorman","test@phpunit.de","123","password","456");
		$this->requestor->insert($this->getPDO());

		$this->admin = new User(null, null, null, null, "+11215552121", "Suzy", "Hughes","test2@phpunit.de","321","passw0rd","654");
		$this->admin->insert($this->getPDO());


		// calculate the date (just use the time the unit test was setup...)
		$this->VALID_REQUESTTIMESTAMP = new \DateTime();
		$this->VALID_REQUESTACTIONTIMESTAMP = new \DateTime();
	}

	/**
	 * test inserting a valid Request and verify that the actual mySQL data matches
	 **/
	public function testInsertValidRequest() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("request");

		// create a new Request and insert to into mySQL
		$request = new Request(null, $this->requestor->getUserId(), $this->admin->getUserId(),  $this->VALID_REQUESTTIMESTAMP,
			$this->VALID_REQUESTACTIONTIMESTAMP, $this->requestApprove, $this->VALID_REQUESTADMINTEXT, $this->VALID_REQUESTACTIONTIMESTAMP);
		$request->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoRequest = Request::getRequestByRequestId($this->getPDO(), $request->getRequestId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("request"));
		$this->assertEquals($pdoRequest->getUserId(), $this->requestor->getUserId());
		$this->assertEquals($pdoRequest->getUserId(), $this->admin->getUserId());
		$this->assertEquals($pdoRequest->getRequestTimeStamp(), $this->VALID_REQUESTTIMESTAMP);
		$this->assertEquals($pdoRequest->getRequestActionTimeStamp(), $this->VALID_REQUESTACTIONTIMESTAMP);
		$this->assertEquals($pdoRequest->getRequestApprove(), $this->requestApprove);
		$this->assertEquals($pdoRequest->getRequestRequestorText(), $this->VALID_REQUESTREQUESTORTEXT);
		$this->assertEquals($pdoRequest->getRequestAdminText(), $this->VALID_REQUESTADMINTEXT);
	}

	/**
	 * test inserting a Request that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidRequest() {
		// create a Request with a non null request id and watch it fail
		$request = new Request(TimeCrunchersTest::INVALID_KEY, $this->requestor->getUserId(), $this->admin->getUserId(),  $this->VALID_REQUESTTIMESTAMP,
			$this->VALID_REQUESTACTIONTIMESTAMP, $this->requestApprove, $this->VALID_REQUESTADMINTEXT, $this->VALID_REQUESTACTIONTIMESTAMP);
		$request->insert($this->getPDO());
	}

	/**
	 * test inserting a Request, editing it, and then updating it
	 **/
	public function testUpdateValidRequest() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("request");

		// create a new Request and insert into mySQL
		$request = new Request(null, $this->requestor->getUserId(), $this->admin->getUserId(),  $this->VALID_REQUESTTIMESTAMP,
			$this->VALID_REQUESTACTIONTIMESTAMP, $this->requestApprove, $this->VALID_REQUESTADMINTEXT, $this->VALID_REQUESTACTIONTIMESTAMP);
		$request->insert($this->getPDO());

		// edit the Request and update it in mySQL
		$request->setRequestRequestorText($this->VALID_REQUESTREQUESTORTEXT2);
		$request->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoRequest = Request::getRequestByRequestId($this->getPDO(), $request->getRequestId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("request"));
		$this->assertEquals($pdoRequest->getUserId(), $this->requestor->getUserId());
		$this->assertEquals($pdoRequest->getUserId(), $this->admin->getUserId());
		$this->assertEquals($pdoRequest->getRequestTimeStamp(), $this->VALID_REQUESTTIMESTAMP);
		$this->assertEquals($pdoRequest->getRequestActionTimeStamp(), $this->VALID_REQUESTACTIONTIMESTAMP);
		$this->assertEquals($pdoRequest->getRequestApprove(), $this->requestApprove);
		$this->assertEquals($pdoRequest->getRequestRequestorText(), $this->VALID_REQUESTREQUESTORTEXT2);
		$this->assertEquals($pdoRequest->getRequestAdminText(), $this->VALID_REQUESTADMINTEXT);
	}

	/**
	 * test updating a Request that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidRequest() {
		// create a Request with a non null tweet id and watch it fail
		$request = new Request(TimeCrunchersTest::INVALID_KEY, $this->requestor->getUserId(), $this->admin->getUserId(),  $this->VALID_REQUESTTIMESTAMP,
			$this->VALID_REQUESTACTIONTIMESTAMP, $this->requestApprove, $this->VALID_REQUESTADMINTEXT, $this->VALID_REQUESTACTIONTIMESTAMP);
		$request->update($this->getPDO());
	}

	/**
	 * test creating a Request and then deleting it
	 **/
	public function testDeleteValidRequest() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("request");

		// create a new Tweet and insert to into mySQL
		$request = new Request(null, $this->requestor->getUserId(), $this->admin->getUserId(),  $this->VALID_REQUESTTIMESTAMP,
			$this->VALID_REQUESTACTIONTIMESTAMP, $this->requestApprove, $this->VALID_REQUESTADMINTEXT, $this->VALID_REQUESTACTIONTIMESTAMP);
		$request->insert($this->getPDO());

		// delete the Tweet from mySQL
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("request"));
		$request->delete($this->getPDO());

		// grab the data from mySQL and enforce the Tweet does not exist
		$pdoRequest = Request::getRequestByRequestId($this->getPDO(), $request->getRequestId());
		$this->assertNull($pdoRequest);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("request"));
	}

	/**
	 * test deleting a Request that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidRequest() {
		// create a Request and try to delete it without actually inserting it
		$request = new Request(null, $this->requestor->getUserId(), $this->admin->getUserId(),  $this->VALID_REQUESTTIMESTAMP,
			$this->VALID_REQUESTACTIONTIMESTAMP, $this->requestApprove, $this->VALID_REQUESTADMINTEXT, $this->VALID_REQUESTACTIONTIMESTAMP);
		$request->delete($this->getPDO());
	}

	/**
	 * test inserting a Request and regrabbing it from mySQL
	 **/
	public function testGetValidTweetByTweetId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("request");

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