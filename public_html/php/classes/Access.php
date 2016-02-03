<?php
namespace Edu\Cnm\Timecrunchers;

require_once("autoload.php");

/**
 * Access, is what is going to decide what actions you allowed to make on the site
 *
 *Access is given to the user
 *
 *@author Denzyl Fontaine
 **/

class Access implements \JsonSerializable {
	/**
	 * id for Access is accessId ; this is the primary key
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
	 * @param int|null $newAccessId of...
	 * @param string $newAccessName
	 */
public function __construct(int $newAccessId = null, string $newAccessName){
	try{
		$this->setAccessId($newAccessId);
		$this->setAccessName($newAccessName);
	} catch(\InvalidArgumentException $invalidArgment) {
		//rethrow the exception to the caller
		throw(new \InvalidArgumentException($invalidArgment->getMessage(), 0,$invalidArgment));
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
		return(this->accessId);
	}

	/**
	 * mutator method for access id
	 *
	 * @param int|null $newAccessId
	 * @throws \RangeException if $newAccessId is not postive
	 * @throws \InvalidArgumentException if $newAccessId is not an integer
	 */
	public function setAccessId(int $newAccessId = null) {
		//first apply the filter to the input.
		if($newAccessId === null) {
			$this->accessId = null;
			return;
		}
		// verify the access id is positive
	}
}
