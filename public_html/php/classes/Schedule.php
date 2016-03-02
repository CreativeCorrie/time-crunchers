<?php
namespace Edu\Cnm\Timecrunchers;

require_once ("autoloader.php");
/**
 * Schedule, a collection of work shifts
 *
 *A Schedule refers to a 14 day collection of shifts
 *A Schedule is an entity assigned to a crew
 *
 * @author Dylan McDonald<dmcdonald21@cnm.edu>
 * @author Elaine Thomas<enajera2@cnm.edu>
 * @version 0.0.x
 *
 **/

class Schedule implements \JsonSerializable {
	use InjectCompanyId, ValidateDate;
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
	private $scheduleStartDate;

	/**
	 * constructor for this Schedule
	 *
	 * @param int|null $newScheduleId id of this Schedule or null if a new Schedule
	 * @param int $newScheduleCrewId id of the Crew this schedule belongs to, foreign key
	 * @param \DateTime $newScheduleStartDate start date for this schedule
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newScheduleId = null, int $newScheduleCrewId, $newScheduleStartDate = null) {
		try {
			$this->setScheduleId($newScheduleId);
			$this->setScheduleCrewId($newScheduleCrewId);
			$this->setScheduleStartDate($newScheduleStartDate);
		} catch(\InvalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			// rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			// rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for schedule id
	 * @return int value of schedule id
	 **/
	public function getScheduleId() {
		return ($this->scheduleId);
	}

	/**
	 * Mutator method for schedule id
	 * @param int $newScheduleId of new schedule
	 * @throws \InvalidArgumentException if schedule id is not an integer
	 * @throws \RangeException if schedule id is negative
	 **/
	public function setScheduleId(int $newScheduleId = null) {
		//If schedule id does not exist it is new, give new id
		if($newScheduleId === null) {
			$this->scheduleId = null;
			return;
		}
		//verify schedule id is a valid integer
		$newScheduleId = filter_var($newScheduleId, FILTER_VALIDATE_INT);

		if($newScheduleId === false) {
			throw(new \InvalidArgumentException("schedule id is not an integer"));
		}

		//throws range exception if schedule id is not a positive integer
		if($newScheduleId <= 0) {
			throw(new \RangeException("schedule id must be positive"));
		}

		//convert and store the schedule id
		$this->scheduleId = intval($newScheduleId);
	}

	/**
	 * accessor method for crew id this Schedule is assigned to
	 * @return int value of crew schedule id
	 **/
	public function getScheduleCrewId() {
		return ($this->scheduleCrewId);
	}

	/**
	 * mutator method for crew id this Schedule is assigned to
	 * @param int $newScheduleCrewId new value of id for crew this schedule is assigned to
	 * @throws \InvalidArgumentException if crew id is not an integer
	 * @throws \RangeException if $newScheduleCrewId is not positive
	 **/
	public function setScheduleCrewId(int $newScheduleCrewId) {
		//validate crew id
		$newScheduleCrewId = filter_var($newScheduleCrewId, FILTER_VALIDATE_INT);

		//throws exception if crew id is not a valid integer
		if($newScheduleCrewId === false) {
			throw(new \InvalidArgumentException ("crew id is not an integer"));
		}

		// verify the schedule crew id is positive
		if($newScheduleCrewId <= 0) {
			throw(new \RangeException("scheduled crew id is not positive"));
		}

		// convert and store the scheduled crew id
		$this->scheduleCrewId = $newScheduleCrewId;
	}

	/**
	 * accessor method for schedule start date
	 *
	 * @return \DateTime value of schedule start date
	 **/
	public function getScheduleStartDate() {
		return ($this->scheduleStartDate);
	}

	/**
	 * mutator method for schedule start date
	 *
	 * @param \DateTime $newScheduleStartDate schedule start date as a DateTime object or string
	 * @throws \InvalidArgumentException if $newScheduleStartDate is not a valid object or string
	 * @throws \RangeException if $newScheduleStartDate is a date that does not exist
	 **/
		public function setScheduleStartDate($newScheduleStartDate = null) {
			//If date is null, set current time and date
			if($newScheduleStartDate === null) {
				$this->scheduleStartDate = new \DateTime();
				return;
			}

		// store the schedule start date
		try {
			$newScheduleStartDate = $this->validateDate($newScheduleStartDate);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->scheduleStartDate = $newScheduleStartDate;
	}

	/**
	 * inserts this Schedule into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// enforce the scheduleId is null (i.e., don't insert a schedule that already exists)
		if($this->scheduleId !== null) {
			throw(new \PDOException("not a new schedule"));
		}

		// create query template
		$query = "INSERT INTO schedule(scheduleCrewId, scheduleStartDate) VALUES(:scheduleCrewId, :scheduleStartDate)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedDate = $this->scheduleStartDate->format("Y-m-d H:i:s");
		$parameters = ["scheduleCrewId" => $this->scheduleCrewId, "scheduleStartDate" => $formattedDate];
		$statement->execute($parameters);

		// update the null scheduleId with what mySQL just gave us
		$this->scheduleId = intval($pdo->lastInsertId());
	}

	/**
	 * updates this Schedule in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		// enforce the scheduleId is not null (i.e., don't update a schedule that hasn't been inserted)
		if($this->scheduleId === null) {
			throw(new \PDOException("unable to update a schedule that does not exist"));
		}

		// create query template
		$query = "UPDATE schedule SET scheduleCrewId = :scheduleCrewId, scheduleStartDate = :scheduleStartDate
					 WHERE scheduleId = :scheduleId
					 AND schedule.scheduleCrewId IN (SELECT crewId FROM crew WHERE crewCompanyId = :companyId)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedDate = $this->scheduleStartDate->format("Y-m-d H:i:s");
		$parameters = ["scheduleCrewId" => $this->scheduleCrewId, "scheduleStartDate" => $formattedDate, "scheduleId" => $this->scheduleId, "companyId" => self::injectCompanyId()];
		$statement->execute($parameters);
	}

	/**
	 * deletes this Schedule from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		// enforce the scheduleId is not null (i.e., don't delete a schedule that hasn't been inserted)
		if($this->scheduleId === null) {
			throw(new \PDOException("unable to delete a schedule that does not exist"));
		}

		// create query template
		$query = "DELETE FROM schedule
					 WHERE scheduleId = :scheduleId
					 AND schedule.scheduleCrewId IN (SELECT crewId FROM crew WHERE crewCompanyId = :companyId)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["scheduleId" => $this->scheduleId, "companyId" => self::injectCompanyId()];
		$statement->execute($parameters);
	}

	/**
	 * Gets schedule by scheduleId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $scheduleId id to search for
	 * @return Schedule or null if not found
	 * @throws \PDOException when MySQL-related error occurs
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getScheduleByScheduleId(\PDO $pdo, int $scheduleId) {
		//Sanitize the schedule id first
		if($scheduleId <= 0) {
			throw(new \PDOException("schedule id must be positive"));
		}

		//Create query template
		$query = "SELECT scheduleId, scheduleCrewId, scheduleStartDate
					 FROM schedule
					 WHERE scheduleId = :scheduleId
					 AND scheduleCrewId IN (SELECT crewId FROM crew WHERE crewCompanyId = :companyId)";
		$statement = $pdo->prepare($query);

		//Bind the schedule id to the place holder in the template
		$parameters = array("scheduleId" => $scheduleId, "companyId" => self::injectCompanyId());
		$statement->execute($parameters);

		//grab schedule from MySQL
		try {
			$schedule = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$schedule = new Schedule($row["scheduleId"], $row["scheduleCrewId"], $row["scheduleStartDate"]);
			}
		} catch(\Exception $exception) {
			//if the row couldn't be converted
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($schedule);
	}

	/**
	 *function to retrieve schedules by scheduleCrewId
	 *
	 * @param \PDO $pdo PDO is a connection object
	 * @param int $scheduleCrewId - scheduleCrewId for schedules to be viewed
	 * @return \SplFixedArray SplFixedArray with all schedules found
	 * @throw  \PDOException with mysql related errors
	 **/
	public static function getScheduleByScheduleCrewId(\PDO $pdo, int $scheduleCrewId) {
		// sanitize the schedule crew id before searching
		if($scheduleCrewId <= 0) {
			throw(new \PDOException("schedule crew id is not positive"));
		}

		// prepare and execute query
		$query = "SELECT scheduleId, scheduleCrewId, scheduleStartDate
		          FROM schedule
		          WHERE scheduleCrewId = :scheduleCrewId
		          AND schedule.scheduleCrewId IN (SELECT crewId FROM crew WHERE crewCompanyId = :companyId)";
		$statement = $pdo->prepare($query);
		$parameters = array("scheduleCrewId" => $scheduleCrewId, "companyId" => self::injectCompanyId());
		$statement->execute($parameters);

		// grab the schedule from mySQL
		try {
			$schedule = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$schedule = new Schedule($row["scheduleId"], $row["scheduleCrewId"], $row["scheduleStartDate"]);
			}
		} catch(\Exception $exception) {

			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($schedule);
	}

	/**
	* gets the Schedule by scheduleStartDate
	*
	* @param \PDO $pdo PDO connection object
	* @param \DateTime $scheduleStartDate schedule content to search for
	* @return \SplFixedArray SplFixedArray of Schedules found
	* @throws \PDOException when mySQL related errors occur
	* @throws \TypeError when variables are not the correct data type
	**/
	public static function getScheduleByScheduleStartDate(\PDO $pdo, \DateTime $scheduleStartDate) {
		// verify the start date before searching
		if(empty($scheduleStartDate) === true) {
			throw(new \PDOException("schedule start date invalid"));
		}

		// create query template
		$query = "SELECT scheduleId, scheduleCrewId, scheduleStartDate
				    FROM schedule
				    WHERE schedule.scheduleStartDate = :scheduleStartDate
				    AND schedule.scheduleCrewId IN (SELECT crewId FROM crew WHERE crewCompanyId = :companyId)";
		$statement = $pdo->prepare($query);

		// bind the schedule start date to the place holder in the template
		$date=$scheduleStartDate->format("Y-m-d");
		$parameters = array("scheduleStartDate" => $date, "companyId" => self::injectCompanyId());
		$statement->execute($parameters);

		// build an array of schedules
		$schedules = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$schedule = new Schedule($row["scheduleId"], $row["scheduleCrewId"], $row["scheduleStartDate"]);
				$schedules[$schedules->key()] = $schedule;
				$schedules->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($schedules);
	}

	/**
	 * gets all Schedules
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Schedules found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllSchedules(\PDO $pdo) {
		// create query template
		$query = "SELECT scheduleId, scheduleCrewId, scheduleStartDate
					 FROM schedule
					 WHERE schedule.scheduleCrewId
					 IN (SELECT crewId FROM crew WHERE crewCompanyId = :companyId)";
		$statement = $pdo->prepare($query);
		$parameters = ["companyId" => self::injectCompanyId()];
		$statement->execute($parameters);

		// build an array of schedules
		$schedules = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$schedule = new Schedule($row["scheduleId"], $row["scheduleCrewId"], $row["scheduleStartDate"]);
				$schedules[$schedules->key()] = $schedule;
				$schedules->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($schedules);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["scheduleStartDate"] = intval($this->scheduleStartDate->format("U")) * 1000;
		return ($fields);
	}
}