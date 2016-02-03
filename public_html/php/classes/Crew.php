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
	 /**id for crew; this is the primary key.**/
	 private $crewId;
	 /**id for the location or store**/
	 private $crewLocation;
	 /**id for the companyId.**/
	 private $crewComapanyId;
	 /**id for the crew**/

	 /**accessor method for crew id
	  *
	  * @return int value of crew id
	  **/
	 public function getCrewId() {
		 return ($this->crewId);
	 }
	 /**
	  * mutator metod for cew id
	  *
	  * @param int $newCrewId new value of crew id
	  * @throws UnexpectedValueException if $newCrewId is not an integer
	  **/
	 public function setCrewId($crewId) {
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
	  **/
	 public function setCrewLocation($crewLocation) {
		 $newCrewLocation = filter_var($newCrewLocation, FILTER_VALIDATE_INT);
		 //Exception if only non-santized values
		 if($newCrewLocation === false) {
			 throw(new InvalidArgumentException("location is not a valid string"));
		 }
		 //Exception if input will not fit int he database
		 if(strlen($newCrewLocation) > 32) {
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
	 public function getCrewComapanyId() {
		 return ($this->crewComapanyId);
	 }
	 /**
	  * mutator method for crew company i
	  *
	  * @param int $newCrewCompanyId new value of crew company id
	  * @throws UnexpectedValueException if $newCrewCompanyId is not an integer.
	  **/
	 public function setCrewComapanyId($newCrewComapanyId) {
		 //verify the profile id is valid
		 $newCrewComapanyId = filter_var($newCrewComapanyId, FILTER_VALIDATE_INT);
		 if($newCrewComapanyId === false) {
			 throw(new UnexpectedValueException("crew company id is not a valid integer"));
		 }
		 //convert and store the profile id
		 $this->crewComapanyId = intval($newCrewComapanyId);
	 }
 }