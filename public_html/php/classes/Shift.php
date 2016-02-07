<?php
/**
 * Shift style for TimeCrunchers
 *
 * This crew style is for data collection and storage for TimeCrunchers
 * This can be extended to include more information on shifts for TimeCrunchers
 * This is a weak entity
 *
 * @author Corrie Hooker <creativecorrie@gmail.com> <Team Collaboration: TimeCrunchers>
 **/

class Shift {
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
	 * shiftTime, identifies the time of a shift
	 * @var int shiftTime
	 **/
	private $shiftTime;

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
	 * @param int$newhiftRequestId of the request for time off(on) in the shift
	 * @param \DateTime $newShiftTime of the time for the shift
	 * @param \DateTime $newShiftDate of the date fo the shift
	 * @param boolean $newShiftDelete of the boolean return of a soft deleted shift
	 * @throws \InvalidArgumentException if data types are ot valid
	 * @throws \RangeException if data values are out of boutnds (e.g., strings too long, negative integers)
	 * @throws \typeerror if data tpes violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newShiftId = null, int $newShiftUserId = null, int $newShiftCrewId = null, int $newShiftRequestId = null, int $newShiftTime = null, int $newShiftDate = null, bool $newShiftDelete = 0) {
		try{
			$this->setShiftId($newShiftId);
			$this->setShiftUserId($newShiftUserId);
			$this->setShiftCrewId($newShiftCrewId);
			$this->setShiftRequestId($newShiftRequestId);
			$this->setShiftTime($newShiftTime);
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
	 * @throws UnexpectedValueException if $newShiftId is ot an integer
	 **/
	public function setShiftId($newShiftId) {
		//verify the shift id is valid
		$newShiftId = filter_var($newShiftId, FILTER_VALIDATE_INT);
		if($newShiftId === false) {
			throw(new UnexpectedValueException("shift id is not a valid integer"));
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
	 * @throws UnexpectedValueException if $newShiftUserId is not an integer
	 **/
	public function setShiftUserId($newShiftUserId) {
		//verify the shift user id is valid
		$newShiftUserId = filter_var($newShiftUserId, FILTER_VALIDATE_INT);
		if($newShiftUserId === false) {
			throw(new UnexpectedValueException("user id is not a valid integer"));
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
	 * @throws UnexpectedValueException if $newShiftCrewId is not an integer
	 **/
	public function setShiftCrewId($newShiftCrewId) {
		//verify the shift crew id is valid
		$newShiftCrewId = filter_var($newShiftCrewId, FILTER_VALIDATE_INT);
		if($newShiftCrewId === false) {
			throw (new UnexpectedValueException("shift crew id is not a valid integer"));
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
	 * @throws UnexpectedValueException if $newShiftRequestId is not an integer
	 **/
	public function setShiftRequestId($newShiftRequestId) {
		//verify the shift request id is valid
		$newShiftRequestId = filter_var($newShiftRequestId, FILTER_VALIDATE_INT);
		if($newShiftRequestId === false) {
			throw  (new UnexpectedValueException("shift request id is not a valid integer"));
		}
		//convert and store the shift crew id
		$this->shiftRequestId = intval($newShiftRequestId);
	}
	/**
	 * accessor method for shift time
	 *
	 * @return \DateTime value of shift time
	 **/
	public function getShiftTime() {
		return($this->shiftTime);
	}
	/**
	 * mutator method for shift time
	 *
	 * @param \DateTime|string|null $newShiftTime shift time as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newShiftTime is not a valid object or string
	 * @throws \RangeException if $newShiftTime is a time that does not exist
	 **/
	public function setShiftTime($newShiftTime = null) {
		//base case: if the time is ull, use the current time
		if($newShiftTime === null) {
			$this->shiftTime = new \DateTime();
			return;
		}
		//store the shift time
		try{
			$newShiftTime = $this->validateShiftTime($newShiftTime);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->shiftTime = $newShiftTime;
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
			$newShiftDate = $this->validateShiftDate($newShiftDate);
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
	 * @throws UnexpectedValueException if $newShiftDelete === false
	 **/
	public function setShiftDelete($newShiftDelete) {
		if(is_bool($newShiftDelete) === false) {
			throw(new \InvalidArgumentException("not a boolean"));
		}
		$this->shiftDelete = $newShiftDelete;
	}
}