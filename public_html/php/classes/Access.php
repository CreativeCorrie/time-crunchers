<?php
namespace Edu\Cnm\Timecrunchers;

require_once("autoloader.php");
/**
 * Access, is what is going to decide what actions you allowed to make on the site
 *
 *Access is given to the user
 *
 *@author Denzyl Fontaine
 **/

class Access {
	/**
	 * id for access is accessId ; this is the primary key
	 * @var int $accessId
	 */
	private $accessId;
	/**
	 * accessName
	 * @var string $accessName
	 */
	private $accessName;

	/**
	 * constructor
	 * @param int|null $newAccessId of the user or null if a new user
	 * @param string $newAccessName containing actual access data
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/

public function __construct(int $newAccessId = null, string $newAccessName){
	try{
		$this->setAccessId($newAccessId);
		$this->setAccessName($newAccessName);
	} catch(\InvalidArgumentException $invalidArgument) {
		//rethrow the exception to the caller
		throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0,$invalidArgument));
	} catch(\RangeException $range) {
		//rethrow exception to caller
		throw(new \RangeException($range->getMessage(), 0, $range));
	} catch(\Exception $exception) {
		//rethrow regular exception to caller
		throw(new \Exception($exception->getMessage(), 0, $exception));
	}
}

	/**
	 * accessor method for access id
	 *
	 * @return int value of tweet id
	 **/
	public function getAccessId() {
		return($this->accessId);
	}

	/**
	 * mutator method for access id
	 *
	 * @param int|null $newAccessId new value for access id
	 * @throws \RangeException if $newAccessId is not postive
	 * @throws \TypeError if $newAccessId is not an integer
	 */
	public function setAccessId(int $newAccessId = null) {
		//first apply the filter to the input.
		if($newAccessId === null) {
			$this->accessId = null;
			return;
		}

		// verify the access id is positive
		if($newAccessId <= 0) {
			throw(new \RangeException("access id is not positive"));
		}

		//convert and store the tweet id
		$this->accessId = $newAccessId;
	}


/**
 * accessor method for accessName
 *
 * @return string of access name
 */
	public function getAccessName() {
	return($this->accessName);
}

/**
 * mutator method for access name
 *
 * @param string$newAccessName new value for access name
 * @throws \InvalidArgumentException if new$AccessName is not a string or insecure
 * @throws \RangeException if $newAccessName is >32
 * @throws \TypeError if $newAccessName is not a string
 */
	public function setAccessName(string $newAccessName) {
		//verify the access name is secure
		$newAccessName = trim($newAccessName);
		$newAccessName = filter_var($newAccessName, FILTER_SANITIZE_STRING);
		if(empty($newAccessName) === true) {
			throw(new \InvalidArgumentException("access name is empty or not secure"));
		}

		//verify the access name will fit in the database
		if(strlen($newAccessName) > 32) {
			throw(new \RangeException("access name too large"));
		}

		//store the access name
		$this->accessName = $newAccessName;
	}
}