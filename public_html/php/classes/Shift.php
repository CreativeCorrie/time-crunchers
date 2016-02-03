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
	 * this is a foreign key
	 **/
	private $shiftCrewId;

	/**
	 * shiftTime, identifies the time of a shift
	 **/
	private $shiftTime;

	/**
	 *shiftDay, identifies the day of shift
	 *this may be a timestamp?
	 **/
	private $shiftDay;

	/**
	 *shiftDeleted, identifies or an action for un-needed shifts
	 * this is a soft delete
	 **/
	private $shiftDeleted;

	/**
	 * shiftRequestId, identifies shift requests
	 * this is a foreign key
	 **/
	private $shiftRequestId;

	/**
	 * accessor method for shift id
	 *
	 * @return int value of shiftId
	 **/
	public f
}