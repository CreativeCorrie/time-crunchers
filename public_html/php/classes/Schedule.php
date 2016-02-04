<?php
namespace Edu\Cnm\Timecrunchers;

require_once("autoload.php");

/**
 * @author Elaine Thomas <enajera2@cnm.edu>
 * @version 2.0.0
 **/
class Schedule implements \JsonSerializable {
	use ValidateDate;
	/**
	 * id for this Schedule; this is the primary key
	 * @var int $scheduleId
	 **/
	private $scheduleId;
	/**
	 * id of the crew this schedule is assigned to; this is a foreign key
	 * @var int $scheduleCrewId
	 **/
	private $scheduleCrewId;
	/**
	 * actual start date when schedule begins; 14 day interval
	 * @var \DateTime $scheduleStartDate
	 **/

	/**
	 * constructor for this Schedule
	 *
	 * @param int|null $newScheduleId id of this Schedule or null if a new Schedule
	 * @param int $newScheduleId id of the Profile that sent this Tweet
	 * @param \DateTime|string|null $scheduleStartDate date 14 day interval schedule starts or null if set to current date and time
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newScheduleId = null, int $newScheduleCrewId, $newScheduleStartDate = null) {
		try {
			$this->setScheduleId($newScheduleId);
			$this->setScheduleCrewId($newScheduleId);
			$this->setScheduleStartDate($newScheduleStartDate);
		} catch(\InvalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			// rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			// rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			// rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for tweet id
	 *
	 * @return int|null value of tweet id
	 **/
	public function getTweetId() {
		return($this->tweetId);
	}

	/**
	 * mutator method for tweet id
	 *
	 * @param int|null $newTweetId new value of tweet id
	 * @throws \RangeException if $newTweetId is not positive
	 * @throws \TypeError if $newTweetId is not an integer
	 **/
	public function setTweetId(int $newTweetId = null) {
		// base case: if the tweet id is null, this a new tweet without a mySQL assigned id (yet)
		if($newTweetId === null) {
			$this->tweetId = null;
			return;
		}

		// verify the tweet id is positive
		if($newTweetId <= 0) {
			throw(new \RangeException("tweet id is not positive"));
		}

		// convert and store the tweet id
		$this->tweetId = $newTweetId;
	}

	/**
	 * accessor method for profile id
	 *
	 * @return int value of profile id
	 **/
	public function getProfileId() {
		return($this->profileId);
	}

	/**
	 * mutator method for profile id
	 *
	 * @param int $newProfileId new value of profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newProfileId is not an integer
	 **/
	public function setProfileId(int $newProfileId) {
		// verify the profile id is positive
		if($newProfileId <= 0) {
			throw(new \RangeException("profile id is not positive"));
		}

		// convert and store the profile id
		$this->profileId = $newProfileId;
	}

	/**
	 * accessor method for tweet content
	 *
	 * @return string value of tweet content
	 **/
	public function getTweetContent() {
		return($this->tweetContent);
	}

	/**
	 * mutator method for tweet content
	 *
	 * @param string $newTweetContent new value of tweet content
	 * @throws \InvalidArgumentException if $newTweetContent is not a string or insecure
	 * @throws \RangeException if $newTweetContent is > 140 characters
	 * @throws \TypeError if $newTweetContent is not a string
	 **/
	public function setTweetContent(string $newTweetContent) {
		// verify the tweet content is secure
		$newTweetContent = trim($newTweetContent);
		$newTweetContent = filter_var($newTweetContent, FILTER_SANITIZE_STRING);
		if(empty($newTweetContent) === true) {
			throw(new \InvalidArgumentException("tweet content is empty or insecure"));
		}

		// verify the tweet content will fit in the database
		if(strlen($newTweetContent) > 140) {
			throw(new \RangeException("tweet content too large"));
		}

		// store the tweet content
		$this->tweetContent = $newTweetContent;
	}

	/**
	 * accessor method for tweet date
	 *
	 * @return \DateTime value of tweet date
	 **/
	public function getTweetDate() {
		return($this->tweetDate);
	}

	/**
	 * mutator method for tweet date
	 *
	 * @param \DateTime|string|null $newTweetDate tweet date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newTweetDate is not a valid object or string
	 * @throws \RangeException if $newTweetDate is a date that does not exist
	 **/
	public function setTweetDate($newTweetDate = null) {
		// base case: if the date is null, use the current date and time
		if($newTweetDate === null) {
			$this->tweetDate = new \DateTime();
			return;
		}

		// store the tweet date
		try {
			$newTweetDate = $this->validateDate($newTweetDate);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->tweetDate = $newTweetDate;
	}

	/**
	 * inserts this Tweet into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// enforce the tweetId is null (i.e., don't insert a tweet that already exists)
		if($this->tweetId !== null) {
			throw(new \PDOException("not a new tweet"));
		}

		// create query template
		$query = "INSERT INTO tweet(profileId, tweetContent, tweetDate) VALUES(:profileId, :tweetContent, :tweetDate)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedDate = $this->tweetDate->format("Y-m-d H:i:s");
		$parameters = ["profileId" => $this->profileId, "tweetContent" => $this->tweetContent, "tweetDate" => $formattedDate];
		$statement->execute($parameters);

		// update the null tweetId with what mySQL just gave us
		$this->tweetId = intval($pdo->lastInsertId());
	}


	/**
	 * deletes this Tweet from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		// enforce the tweetId is not null (i.e., don't delete a tweet that hasn't been inserted)
		if($this->tweetId === null) {
			throw(new \PDOException("unable to delete a tweet that does not exist"));
		}

		// create query template
		$query = "DELETE FROM tweet WHERE tweetId = :tweetId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["tweetId" => $this->tweetId];
		$statement->execute($parameters);
	}

	/**
	 * updates this Tweet in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		// enforce the tweetId is not null (i.e., don't update a tweet that hasn't been inserted)
		if($this->tweetId === null) {
			throw(new \PDOException("unable to update a tweet that does not exist"));
		}

		// create query template
		$query = "UPDATE tweet SET profileId = :profileId, tweetContent = :tweetContent, tweetDate = :tweetDate WHERE tweetId = :tweetId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedDate = $this->tweetDate->format("Y-m-d H:i:s");
		$parameters = ["profileId" => $this->profileId, "tweetContent" => $this->tweetContent, "tweetDate" => $formattedDate, "tweetId" => $this->tweetId];
		$statement->execute($parameters);
	}

	/**
	 * gets the Tweet by content
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $tweetContent tweet content to search for
	 * @return \SplFixedArray SplFixedArray of Tweets found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getTweetByTweetContent(\PDO $pdo, string $tweetContent) {
		// sanitize the description before searching
		$tweetContent = trim($tweetContent);
		$tweetContent = filter_var($tweetContent, FILTER_SANITIZE_STRING);
		if(empty($tweetContent) === true) {
			throw(new \PDOException("tweet content is invalid"));
		}

		// create query template
		$query = "SELECT tweetId, profileId, tweetContent, tweetDate FROM tweet WHERE tweetContent LIKE :tweetContent";
		$statement = $pdo->prepare($query);

		// bind the tweet content to the place holder in the template
		$tweetContent = "%$tweetContent%";
		$parameters = array("tweetContent" => $tweetContent);
		$statement->execute($parameters);

		// build an array of tweets
		$tweets = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$tweet = new Tweet($row["tweetId"], $row["profileId"], $row["tweetContent"], $row["tweetDate"]);
				$tweets[$tweets->key()] = $tweet;
				$tweets->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($tweets);
	}

	/**
	 * gets the Tweet by tweetId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $tweetId tweet id to search for
	 * @return Tweet|null Tweet found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getTweetByTweetId(\PDO $pdo, int $tweetId) {
		// sanitize the tweetId before searching
		if($tweetId <= 0) {
			throw(new \PDOException("tweet id is not positive"));
		}

		// create query template
		$query = "SELECT tweetId, profileId, tweetContent, tweetDate FROM tweet WHERE tweetId = :tweetId";
		$statement = $pdo->prepare($query);

		// bind the tweet id to the place holder in the template
		$parameters = array("tweetId" => $tweetId);
		$statement->execute($parameters);

		// grab the tweet from mySQL
		try {
			$tweet = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$tweet = new Tweet($row["tweetId"], $row["profileId"], $row["tweetContent"], $row["tweetDate"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($tweet);
	}

	/**
	 * gets all Tweets
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Tweets found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllTweets(\PDO $pdo) {
		// create query template
		$query = "SELECT tweetId, profileId, tweetContent, tweetDate FROM tweet";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of tweets
		$tweets = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$tweet = new Tweet($row["tweetId"], $row["profileId"], $row["tweetContent"], $row["tweetDate"]);
				$tweets[$tweets->key()] = $tweet;
				$tweets->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($tweets);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["tweetDate"] = intval($this->tweetDate->format("U")) * 1000;
		return($fields);
	}
}