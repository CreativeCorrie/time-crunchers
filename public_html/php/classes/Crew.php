<?php
/**
 * Crew style for Timecrunchers
 *
 * This crew style is for data collection and storage for TimeCrunchers
 * This can be extended to include more information on crews for TimeCrunchers
 *
 * @author Corrie Hooker <creativecorrie@gmail.com> <Team Collaboration: TimeCrunchers>
 **/
 class Crew {

	 /**id for crew; this is the primary key.
	  * @var int crewId
	  **/
	 private $crewId;

	 /**id for the location or store
	  * @var int crewLocation
	  **/
	 private $crewLocation;

	 /**id for the companyId
	  * @var string crewCompanyId
	  **/
	 private $crewCompanyId;

	 /**
	  * constructor for crews
	  *
	  * @param int|null $newCrewId id of crew or null if a new crew
	  * @param string $newCrewLocation string of location for the crew
	  * @param int$newCrewCompanyId of the Company that initialized this crew
	  * @throws \InvalidArgumentException if data types are not valid
	  * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	  * @throws \typeError if data types violate type hints
	  * @throws \Exception if some other exception occurs
	  **/
	 public function __construct(int $newCrewId = null, string $newCrewLocation, int $newCrewCompanyId = null) {
		 try {
			 $this->setCrewId($newCrewId);
			 $this->setCrewLocation($newCrewLocation);
			 $this->setCrewCompanyId($newCrewCompanyId);
		 } catch(\InvalidArgumentException $invalidArgument) {
			 //rethrow the exception to the caller
			 throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		 } catch(\RangeException $range) {
			 //rethrow he exception to the caller
			 throw(new \RangeException($range->getMessage(), 0, $range));
		 } catch(\TypeError $typeError) {
			 //rethrow the exception to the caller
			 throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		 } catch(\Exception $exception) {
			 //rethrow the exception to the caller
			 throw(new \Exception($exception->getMessage(), 0, $exception));
		 }
	 }


	 /**accessor method for crew id
	  *
	  * @return int value of crew id
	  **/
	 public function getCrewId() {
		 return ($this->crewId);
	 }
	 /**
	  * Mutator method for cew id
	  *
	  * @param int $newCrewId new value of crew id
	  * @throws UnexpectedValueException if $newCrewId is not an integer
	  **/
	 public function setCrewId(int $newCrewId) {
		 //verify the course id is valid
		 $newCrewId = filter_var($newCrewId, FILTER_VALIDATE_INT);
		 if($newCrewId === false) {
			 throw(new UnexpectedValueException("crew id is not a valid integer"));
		 }
		 //convert and store the crew id
		 $this->crewId = intval($newCrewId);
	 }
	/**
	 * accessor method for location
	 *
	 * @return string of location
	 **/
	 public function getCrewLocation() {
		 return ($this->crewLocation);
	 }
	 /**
	  * Mutator method for location
	  * @param string $newCrewLocation new value of copy
	  * @throws InvalidArgumentException if copy is only non sanitized values
	  * @throws RangeException if copy will not fit in the database
	  * @throws \TypeError if $newCrewLocation is not a string
	  **/
	 public function setCrewLocation(string $newCrewLocation) {
		 //verify the location is secure
		 $newCrewLocation = trim($newCrewLocation);
		 $newCrewLocation = filter_var($newCrewLocation, FILTER_SANITIZE_STRING);
		 		 //Exception if only non-sanitized values
		 if($newCrewLocation === false) {
			 throw(new InvalidArgumentException("location is not secure"));
		 }
		 //Exception if input will not fit int he database
		 if(strlen($newCrewLocation) > 255) {
			 throw(new RangeException("content is too large"));
		 }
		 //convert and store the location
		 $this->crewLocation = $newCrewLocation;
	 }
	 /**
	  * accessor method for crewCompanyId
	  *
	  * @return int value of crewCompanyId
	  **/
	 public function getCrewCompanyId() {
		 return ($this->crewCompanyId);
	 }
	 /**
	  * mutator method for crew company i
	  *
	  * @param int $newCrewCompanyId new value of crew company id
	  * @throws UnexpectedValueException if $newCrewCompanyId is not an integer.
	  **/
	 public function setCrewCompanyId($newCrewCompanyId) {
		 //verify the profile id is valid
		 $newCrewCompanyId = filter_var($newCrewCompanyId, FILTER_VALIDATE_INT);
		 if($newCrewCompanyId === false) {
			 throw(new UnexpectedValueException("crew company id is not a valid integer"));
		 }
		 //convert and store the profile id
		 $this->crewCompanyId = intval($newCrewCompanyId);
	 }

	 /**
	  * inserts crew into mySQL
	  *
	  * @param \PDO $pdo PDO connection object
	  * @thros \PDOException when mySQL related errors occur
	  * @throws \TypeError if $pdo is not a PDO connection object
	  **/
	 public function insert(\PDO $pdo) {
		 //enforce the crewId is null (i.e., don't insert a crew that already exists)
		 if($this->crewId !== null) {
			 throw(new  \PDOException("not a new crew"));
		 }
		 //create query template
		 $query = "INSERT INTO crew(crewId, crewLocation, crewCompanyId)VALUES (:crewId, :crewLocation, :crewCompanyId)";
		 $statement = $pdo->prepare($query);

		 //bind the member variables to the place holders in the template
		 $parameters = ["crewId" => $this->crewId, "crewLocation" => $this->crewLocation, "crewCompanyId" => $this->crewCompanyId];
		 $statement->execute($parameters);

		 //update the null crewId with what mySQL just gave us
		 $this->crewId = intval($pdo->lastInsertId());
	 }
 }
