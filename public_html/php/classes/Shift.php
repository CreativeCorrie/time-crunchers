<?php

namespace Edu\Cnm\Timecrunchers;

require_once ("autoloader.php");
/**
 * Shift style for TimeCrunchers
 *
 * This crew style is for data collection and storage for TimeCrunchers
 * This can be extended to include more information on shifts for TimeCrunchers
 * This is a weak entity
 *
 * @author Dylan McDonald<dmcdonald21@cnm.edu>
 * @author Corrie Hooker <creativecorrie@gmail.com> <Team Collaboration: TimeCrunchers>
 **/

class Shift implements \JsonSerializable {
	use ValidateDate;
	/**
	 * id for shift this is the primary key
	 * @var int $shiftId
	 **/
	private $shiftId;

	/**
	 * shiftUserId, to identify the user
	 * @var int $shiftUserId
	 **/
	private $shiftUserId;

	/**
	 * shiftCrewId, to identify the crew
	 * @var int shiftCrewId
	 * this is a foreign key
	 **/
	private $shiftCrewId;

	/**
	 * shiftRequestId, identifies shift requests
	 * @var int shiftRequestId
	 * this is a foreign key
	 **/
	private $shiftRequestId;

	/**
 * shiftStartTime, identifies the start time of a shift
 * @var int shiftStartTime
 **/
	private $shiftStartTime;

	/**
	 * shiftDuration, identifies the duration time of a shift
	 * @var int shiftDuration
	 **/
	private $shiftDuration;

	/**
	 *shiftDate, identifies the day of shift
	 * @var int shiftDate
	 *this may be a timestamp?
	 **/
	private $shiftDate;

	/**
	 *shiftDelete, identifies or an action for un-needed shifts
	 * this is a soft delete
	 * @var int shiftDelete
	 **/
	private $shiftDelete;

	/**
	 * constructor for shift
	 *
	 * @param int|null $newShiftId id of crew or null if a new shift
	 * @param int $newShiftUserId of the user who initialized this shift
	 * @param int $newShiftCrewId of the crew assigned to this shift
	 * @param int $newShiftRequestId of the request for time off(on) in the shift
	 * @param string $newShiftStartTime of the time a shift starts
	 * @param int $newShiftDuration of the duration of the shift
	 * @param string $newShiftDate of the time of the shift
	 * @param boolean $newShiftDelete of the boolean return of a soft deleted shift
	 * @throws \InvalidArgumentException if data types are ot valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \typeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct($newShiftId, int $newShiftUserId, int $newShiftCrewId, int $newShiftRequestId, string $newShiftStartTime, int $newShiftDuration, string $newShiftDate, bool $newShiftDelete = false) {
		try{
			$this->setShiftId($newShiftId);
			$this->setShiftUserId($newShiftUserId);
			$this->setShiftCrewId($newShiftCrewId);
			$this->setShiftRequestId($newShiftRequestId);
			$this->setShiftStartTime($newShiftStartTime);
			$this->setShiftDuration($newShiftDuration);
			$this->setShiftDate($newShiftDate);
			$this->setShiftDelete($newShiftDelete);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow the exception to the caller
			throw(new  \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			//rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow the exception to the caller
			throw (new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			//rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}


	/**
	 * accessor method for shift id
	 * this is the primary key
	 *
	 * @return int value of shiftId
	 **/
	public function getShiftId() {
		return($this->shiftId);
	}
	/**
	 * Mutator method for shift id
	 *
	 * @param int $newShiftId new value of shift id
	 * @throws \UnexpectedValueException if $newShiftId is ot an integer
	 **/
	public function setShiftId($newShiftId) {
		if($newShiftId === null) {
			$this->shiftId = null;
			return;
		}
		if($newShiftId < 0 ) {
			throw(new \OutOfRangeException("shift id needs to be positive"));
			}
		//convert and store the shift id
		$this->shiftId = intval($newShiftId);
	}
	/**
	 * accessor method for shift user id
	 * this is a foreign key
	 *
	 * @return int value of shift user id
	 */
	public function getShiftUserId() {
		return($this->shiftUserId);
	}

	/**mutator method for shift user id
	 *
	 * @param int $newShiftUserId new value of shift user id
	 * @throws \UnexpectedValueException if $newShiftUserId is not an integer
	 **/
	public function setShiftUserId($newShiftUserId) {
		//verify the shift user id is valid
		$newShiftUserId = filter_var($newShiftUserId, FILTER_VALIDATE_INT);
		if($newShiftUserId === false) {
			throw(new \UnexpectedValueException("user id is not a valid integer"));
		}
		//convert and store the shift user id
		$this->shiftUserId = intval($newShiftUserId);
	}

	/**
	 * accessor method for shift crew id
	 * this is a foreign key
	 *
	 * @return int value of shift crew id
	 **/
	public function getShiftCrewId() {
		return($this->shiftCrewId);
	}
	/**
	 * mutator method for shift crew id
	 *
	 * @param int $newShiftCrewId new value of shift crew id
	 * @throws \UnexpectedValueException if $newShiftCrewId is not an integer
	 **/
	public function setShiftCrewId($newShiftCrewId) {
		//verify the shift crew id is valid
		$newShiftCrewId = filter_var($newShiftCrewId, FILTER_VALIDATE_INT);
		if($newShiftCrewId === false) {
			throw (new \UnexpectedValueException("shift crew id is not a valid integer"));
		}
		//convert and store the shift crew id
		$this->shiftCrewId = intval($newShiftCrewId);
	}
	/**
	 * accessor method for shift request id
	 * this is a foreign key
	 *
	 * @return int value of shift request id
	 **/
	public function getShiftRequestId() {
		return($this->shiftRequestId);
	}
	/**
	 * mutator method for shift request id
	 *
	 * @param int	$newShiftRequestId new value of shift request id
	 * @throws \UnexpectedValueException if $newShiftRequestId is not an integer
	 **/
	public function setShiftRequestId($newShiftRequestId) {
		//verify the shift request id is valid
		$newShiftRequestId = filter_var($newShiftRequestId, FILTER_VALIDATE_INT);
		if($newShiftRequestId === false) {
			throw  (new \UnexpectedValueException("shift request id is not a valid integer"));
		}
		//convert and store the shift crew id
		$this->shiftRequestId = intval($newShiftRequestId);
	}
	/**
 * accessor method for shift start time
 *
 * @return \DateTime value of time a shift starts
 **/
	public function getShiftStartTime() {
		return($this->shiftStartTime);
	}
	/**
	 * mutator method for shift start time
	 *
	 * @param \DateTime|string|null $newShiftStartTime shift time as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newShiftStartTime is not a valid object or string
	 * @throws \RangeException if $newShiftStartTime is a time that does not exist
	 **/
	public function setShiftStartTime($newShiftStartTime) {
		//base case: if the time is null, use the current time
		if($newShiftStartTime === null) {
			throw (new \RangeException("can't create a shift without a time"));
		}
		//store the shift time
		try{
			$newShiftStartTime = self::validateTime($newShiftStartTime);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->shiftStartTime = $newShiftStartTime;
	}
	/**
	 * accessor method for shift duration time
	 *
	 * @return \DateTime value of the duration of a shift
	 **/
	public function getShiftDuration() {
		return($this->shiftDuration);
	}
	/**
	 * mutator method for shift duration
	 *
	 * @param int $newShiftDuration shift time as a DateTime object or string (or null to load the current time)
	 * @throws \RangeException if $newShiftDuration is a time that does not exist
	 * @throws \RangeException if $newShiftDuration is not more than 0
	 **/
	public function setShiftDuration(int $newShiftDuration) {
		//base case: if the time is null, use the current time
		if($newShiftDuration === null) {
			throw (new \RangeException("can't create shift without an end time"));
		}
		if($newShiftDuration <= 0) {
			throw (new \RangeException("can't create shift with a 0 or negative duration"));
		}
		$this->shiftDuration = $newShiftDuration;
	}
	/**
	 * accessor method for shift date
	 *
	 * @return \DateTime value of shift date
	 **/
	public function getShiftDate() {
		return($this->shiftDate);
	}
	/**
	 * mutator method for shift date
	 *
	 * @param \DateTime|string|null $newShiftDate shift date as a DateTime object of string (of null to load the current time)
	 * @throws \InvalidArgumentException if $newShiftDate is not a valid object or string
	 * @throws \RangeException if $newShiftDate is a date that does not exist
	 **/
	public function setShiftDate($newShiftDate = null) {
		//base case: if the date is null, use the current date
		if($newShiftDate === null) {
			throw (new \RangeException("can't create a shift without a date"));
		}
		//store the shift date
		try{
			$newShiftDate = self::validateDate($newShiftDate);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		}catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->shiftDate = $newShiftDate;
	}
	/**
	 * accessor method for shift delete
	 * this is the for a soft delete
	 * this is a boolean
	 *
	 * @return int value of shift delete
	 **/
	public function getShiftDelete() {
		return($this->shiftDelete);
	}

	/**
	 * mutator method for shift delete
	 *
	 * @param int $newShiftDelete new value of shift delete
	 * @throws \UnexpectedValueException if $newShiftDelete === false
	 **/
	public function setShiftDelete($newShiftDelete) {
		if(is_bool($newShiftDelete) === false) {
			throw(new \InvalidArgumentException("not a boolean"));
		}
		$this->shiftDelete = $newShiftDelete;
	}
	/**
	 * inserts this Shift into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySLQ related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 * @format to re-format the shift date
	 **/
	public function insert(\PDO $pdo) {
		//enforce the shiftId is null (i.e., don't insert a crew that already exists)
		if($this->shiftId !== null) {
			throw(new \PDOException("not a new shift"));
		}

		//create query template
		$query = "INSERT INTO shift (shiftUserId, shiftCrewId, shiftRequestId, shiftStartTime, shiftDuration, shiftDate, shiftDelete)
                VALUES(:shiftUserId, :shiftCrewId, :shiftRequestId, :shiftStartTime, :shiftDuration, :shiftDate, :shiftDelete)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["shiftUserId"    => $this->shiftUserId,
							"shiftCrewId"    => $this->shiftCrewId,
							"shiftRequestId" => $this->shiftRequestId,
							"shiftStartTime" => $this->shiftStartTime,
							"shiftDuration"  => $this->shiftDuration,
							"shiftDate"      => $this->shiftDate->format("Y:m:d"),
                     "shiftDelete"    => $this->shiftDelete];
		$statement->execute($parameters);

		//update the null shiftId with what mySQL just gave us
		$this->shiftId = intval($pdo->lastInsertId());
	}
	/**
	 *deletes this shift from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		//enforce the shift is not null (i.e., don't delete a shift that has't been inserted)
		if($this->shiftId === null) {
			throw(new \PDOException("unable to delete a shift that does not exist"));
		}
		$this->shiftDelete = 0;
		$this->update($pdo);
	}
	/**
	 * updates this Shift in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		//enforce the shiftId is not null (i.e., don't update a shift that hasn't been inserted)
		if($this->shiftId === null) {
			throw(new \PDOException("unable to update a shift that does not exist"));
		}
		//create query template
		$query = "UPDATE shift SET shiftUserId = :shiftUserId, shiftCrewId = :shiftCrewId, shiftRequestId = :shiftRequestId, shiftStartTime = :shiftStartTime, shiftDuration = :shiftDuration, shiftDate = :shiftDate, shiftDelete = :shiftDelete WHERE shiftId = :shiftId";
		$statement = $pdo->Prepare($query);

		//bind the member variables to the place holders in the template
		$sDate = $this->shiftDate->format("Y-m-d");
		$parameters = ["shiftUserId" => $this->shiftUserId, "shiftCrewId" => $this->shiftCrewId, "shiftRequestId" => $this->shiftRequestId, "shiftStartTime" => $this->shiftStartTime, "shiftDuration" => $this->shiftDuration, "shiftDate" => $sDate, "shiftDelete" => $this->shiftDelete, "shiftId" =>$this->shiftId];
		$statement->execute($parameters);
	}

	/**
	 * gets the Shift by shiftId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $shiftId shift is to search for
	 * @return Shift|null Shift found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variable are not the correct data type
	 **/
	public static function getShiftByShiftId(\PDO $pdo,int $shiftId) {
		//sanitize the shiftId before searching
		if($shiftId <= 0) {
			throw(new \PDOException("shift id is not positive"));
		}

		//create query template
		$query = "SELECT shiftId, shiftUserId, shiftCrewId, shiftRequestId, shiftStartTime, shiftDuration, shiftDate, shiftDelete FROM shift WHERE shiftId = :shiftId";
		$statement = $pdo->prepare($query);

		//bind the shift id to the place holder in the template
		$parameters = array("shiftId" => $shiftId);
		$statement->execute($parameters);

		//grab the shift from mySQL
		try {
			$shift = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$shift = new Shift($row["shiftId"], $row["shiftUserId"], $row["shiftCrewId"], $row["shiftRequestId"], $row ["shiftStartTime"], $row ["shiftDuration"], $row["shiftDate"], $row["shiftDelete"]);
				}
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			return($shift);
		}
	/**
	 *function to retrieve shifts by shiftUserId
	 *
	 * @param \PDO $pdo PDO is a connection object
	 * @param int $shiftUserId - shiftUserId for shifts to be viewed
	 * @return SplFixedArray SplFixedArray with all shifts found
	 * @throw  PDOException with mysql related errors
	 **/
	public static function getShiftByShiftUserId(\PDO $pdo, int $shiftUserId) {

		// prepare and execute query
		$query = "SELECT shiftId, shiftUserId, shiftCrewId, shiftRequestId, shiftStartTime, shiftDuration, shiftDate, shiftDelete
		          FROM shift WHERE shiftUserId = :shiftUserId";
		$statement = $pdo->prepare($query);
		$parameters = array("shiftUserId" => $shiftUserId);
		$statement->execute($parameters);

		// build an array of shifts
		$shifts = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);

		while(($row = $statement->fetch()) !== false) {
			try {
				$shift = new Shift($row["shiftId"], $row["shiftUserId"], $row["shiftCrewId"], $row["shiftRequestId"],
										 $row["shiftStartTime"], $row["shiftDuration"], $row["shiftDate"], $row["shiftDelete"]);
				$shifts[$shifts->key()] = $shift;
				$shifts->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $shifts;
	}
	/**
	 * getShiftByDateRange get all the shifts for each day of the submitted range
	 * The Other While loop cycles through the date range
	 * @param \PDO $pdo is a connection object
	 * @param \DateTime $startDate
	 * @param \DateTime $endDate
	 * @param int $companyId
	 * @return \PDO grabs the date range
	 **/

	public static function getShiftsByDateRange(\PDO $pdo, \DateTime $startDate, \DateTime $endDate, int $companyId) {
		  if ($endDate < $startDate) {
			 throw (new \RangeException("end date cannot be less than start date"));
		 }

		$sDate = $startDate->format("Y-m-d");
		$eDate = $endDate->format("Y-m-d");

			// prepare and execute query
			$query = "SELECT shiftId, shiftUserId, shiftCrewId, shiftRequestId, shiftStartTime, shiftDuration, shiftDate, shiftDelete
						 FROM shift
						 WHERE shiftDate >= :startDate AND shift.shiftDate<= :endDate
						 AND shift.shiftCrewId IN (SELECT crewId FROM crew WHERE crewCompanyId = :companyId)";
			$statement = $pdo->prepare($query);

			// prepare the date
			$parameters = array("startDate" => $sDate,
										"endDate" => $eDate,
										"companyId" => $companyId);
			$statement->execute($parameters);

			// build an array of shifts
			$shifts = new \SplFixedArray($statement->rowCount());
			$statement->setFetchMode(\PDO::FETCH_ASSOC);

			// pull shifts for each day in the range
			while(($row = $statement->fetch()) !== false) {
				try {
					$shift = new Shift($row["shiftId"], $row["shiftUserId"], $row["shiftCrewId"], $row["shiftRequestId"],
											 $row["shiftStartTime"], $row["shiftDuration"], $row["shiftDate"], $row["shiftDelete"]);
					$shifts[$shifts->key()] = $shift;
					$shifts->next();
				} catch(\Exception $exception) {
					// if the row couldn't be converted, rethrow it
					throw(new \PDOException($exception->getMessage(), 0, $exception));
				}
			} //While Loop

		return($shifts);

	}  // getShiftByDateRange

	/**
	 * gets all Shifts
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Shifts found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllShifts(\PDO $pdo) {
		// create query template
		$query = "SELECT shiftId, shiftUserId, shiftCrewId, shiftRequestId, shiftStartTime, shiftDuration, shiftDate, shiftDelete FROM shift";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of shifts
		$shifts = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$shift = new shift($row["shiftId"], $row["shiftUserId"], $row["shiftCrewId"], $row["shiftRequestId"], $row["shiftStartTime"], $row["shiftDuration"], $row["shiftDate"], $row["shiftDelete"]);
				$shifts[$shifts->key()] = $shift;
				$shifts->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($shifts);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["shiftDate"] = intval($this->shiftDate->format("U")) * 1000;
		return($fields);
	}
}