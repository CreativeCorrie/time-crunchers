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
	 * shiftuserId, to identify the user
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
 * shiftTime, identifies the start time of a shift
 * @var int shiftTime
 **/
	private $shiftStartTime;

	/**
	 * shiftTime, identifies the duration time of a shift
	 * @var int shiftTime
	 **/
	private $shiftDuration;

	/**
	 *shiftDay, identifies the day of shift
	 * @var int shiftDay
	 *this may be a timestamp?
	 **/
	private $shiftDate;

	/**
	 *shiftDeleted, identifies or an action for un-needed shifts
	 * this is a soft delete
	 * @var int shiftDeleted
	 **/
	private $shiftDelete;

	/**
	 * constructor for shift
	 *
	 * @param int|null $newShiftId id of crew or null if a new shift
	 * @param int$newShiftUserId of the user who initialized this shift
	 * @param int$newShiftCrewId of the crew assigned to this shift
	 * @param int$newShiftRequestId of the request for time off(on) in the shift
	 * @param $newShiftTime of the time for the shift
	 * @param  $newShiftDate of the date fo the shift
	 * @param boolean $newShiftDelete of the boolean return of a soft deleted shift
	 * @throws \InvalidArgumentException if data types are ot valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \typeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newShiftId = null, int $newShiftUserId = null, int $newShiftCrewId = null, int $newShiftRequestId = null, int $newShiftTime = null, int $newShiftDate = null, bool $newShiftDelete = 0) {
		try{
			$this->setShiftId($newShiftId);
			$this->setShiftUserId($newShiftUserId);
			$this->setShiftCrewId($newShiftCrewId);
			$this->setShiftRequestId($newShiftRequestId);
			$this->setShiftStartTime($newShiftTime);
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
			throw (new  \TypeError($typeError->getMessage(), 0, $typeError));
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
		//verify the shift id is valid
		$newShiftId = filter_var($newShiftId, FILTER_VALIDATE_INT);
		if($newShiftId === false) {
			throw(new \UnexpectedValueException("shift id is not a valid integer"));
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
	public function setShiftStartTime($newShiftStartTime = null) {
		//base case: if the time is null, use the current time
		if($newShiftStartTime === null) {
			$this->shiftStartTime = new \DateTime();
			return;
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
	public function getShiftDurationt() {
		return($this->shiftDuration);
	}
	/**
	 * mutator method for shift start time
	 *
	 * @param \DateTime|string|null $newShiftDuration shift time as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newShiftDuration is not a valid object or string
	 * @throws \RangeException if $newShiftDuration is a time that does not exist
	 **/
	public function setShiftDuration($newShiftDuration = null) {
		//base case: if the time is null, use the current time
		if($newShiftDuration === null) {
			$this->shiftDuration = new \DateTime();
			return;
		}
		//store the shift time
		try{
			$newShiftDuratione = self::validateTime($newShiftDuration);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
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
			$this->shiftDate = new \DateTime();
			return;
		}
		//store the shift date
		try{
			$newShiftDate = ValidateDate::validateTime($newShiftDate);
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
	 **/
	public function insert(\PDO $pdo) {
		//enforce the shiftId is null (i.e., don't insert a crew that already exists)
		if($this->shiftCrewId !== null) {
			throw(new  \PDOException("not a new shift"));
		}

		//create query template
		$query = "INSERT INTO shift (shiftUserId, shiftCrewId, shiftRequestId, shiftTime, shiftDate, shiftDelete) VALUES(:shiftUserId, :shiftCrewId, :shiftRequestId, :shiftTime, :shiftDate, :shiftdelete)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["shiftUserId" => $this->shiftUserId, "shiftCrewId" => $this->shiftCrewId, "shiftRequestId" => $this->shiftRequestId, "shiftTime" => $this->shiftStartTime, "shiftDate" => $this->shiftDate,
                     "shiftDelete" => $this->shiftDelete];
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
		$this->shiftDelete=1;
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
		$query = "UPDATE shift SET shiftUserId = :shiftUserId, shiftCrewId = :shiftCrewId, shiftRequestId = :shiftRequestId, shiftTime = :shiftTime, shiftDate = :shiftDate, shiftDelete = :shiftDelete WHERE shiftId = :shiftId";
		$statement = $pdo->Prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["shiftUserId" => $this->shiftUserId, "shiftCrewId" => $this->shiftCrewId, "shiftRequestId" => $this->shiftRequestId, "shiftTime" => $this->shiftStartTime, "shiftDate" => $this->shiftDate, "shiftDelete" => $this->shiftDelete];
		$statement->execute($parameters);
	}

	/**
	 * gets the Shift by shiftId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $shiftId shift is to search for
	 * @return Shift|null Shift found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @hrows \TypeError when variable are not the correct data type
	 **/
	public static function getShiftByShiftId(\PDO $pdo, int $shiftId) {
		//sanitize the shiftId before searching
		if($shiftId <=0) {
			throw(new \PDOException("shift id is not positive"));
		}

		//create query template
		$query = "SELECT shiftId, shiftUserId, shiftCrewId, ShiftRequestId, shiftTime, shiftDate, shiftDelete FROM shift WHERE shiftId = :shiftId";
		$statement = $pdo->prepare($query);

		//bind the shift id to the place holder in the template
		$parameters = array("shiftId => $shiftId");
		$statement->execute($parameters);

		//grab the shift from mySQL
		try {
			$shift = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$shift = new Shift($row["shiftId"], $row["shiftUserId"], $row["shiftCrewId"], $row["shiftRequestId"], $row ["shiftTime"], $row["shiftDate"], $row["shiftDelete"]);
				}
			} catch(\Exception $exception) {
				//if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			return($shift);
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