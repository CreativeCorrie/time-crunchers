<?php
namespace Edu\Cnm\Timecrunchers;

require_once("autoloader.php");

/**
 * Access, is what is going to decide what actions you allowed to make on the site
 *
 *Access is given to the user
 *
 * @author Denzyl Fontaine
 **/
class Access implements \JsonSerializable {
	/**
	 * constant to symbolically refer to administrative access
	 */
	const ADMIN = 1;

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

	public function __construct(int $newAccessId = null, string $newAccessName) {
		try {
			$this->setAccessId($newAccessId);
			$this->setAccessName($newAccessName);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
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
	 * @return int value of accessId
	 **/
	public function getAccessId() {
		return ($this->accessId);
	}

	/**
	 * mutator method for access id
	 *
	 * @param int|null $newAccessId new value for access id
	 * @throws \RangeException if $newAccessId is not positive
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

		//convert and store the access id
		$this->accessId = $newAccessId;
	}


	/**
	 * accessor method for accessName
	 *
	 * @return string of access name
	 */
	public function getAccessName() {
		return ($this->accessName);
	}

	/**
	 * mutator method for access name
	 *
	 * @param string $newAccessName new value for access name
	 * @throws \InvalidArgumentException if new$AccessName is not a string or insecure
	 * @throws \RangeException if $newAccessName is > 32
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

	/**
	 * inserts access into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) {
		//enforce access id is null
		if($this->accessId !== null) {
			throw(new \PDOException("not new access"));
		}

		//create query type
		$query = "INSERT INTO access(accessName) VALUES(:accessName)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["accessName" => $this->accessName];
		$statement->execute($parameters);

		//update the null access id with what my sqlj ust gave us
		$this->accessId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this access from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function delete(\PDO $pdo) {
		//enforce the accessId is not null
		if($this->accessId === null) {
			throw(new \PDOException("cannot delete access that does not exist"));
		}

		//create query template
		$query = "DELETE FROM access WHERE accessId = :accessId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the placeholders in tht template
		$parameters = ["accessId" => $this->accessId];
		$statement->execute($parameters);
	}

	/**
	 * updates accessId in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function update(\PDO $pdo) {
		//enforce accessId is not null
		if($this->accessId === null) {
			throw(new \PDOException("unable to update access that does not exist"));
		}

		//create query template
		$query = "UPDATE access SET accessId = :accessId, accessName = :accessName";
		$statement = $pdo->prepare($query);

		//bind the member variables to the placeholders in tht template
		$parameters = ["accessId" => $this->accessId, "accessName" => $this->accessName];
		$statement->execute($parameters);
	}

	/**
	 * gets the access by accessName
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $accessName access content to search for
	 * @return \SplFixedArray SplFixedArray of accessors found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public function getAccessByAccessName(\PDO $pdo, string $accessName) {
		//sanitize the description before searching
		$accessName = trim($accessName);
		$accessName = filter_var($accessName, FILTER_SANITIZE_STRING);
		if(empty($accessName) === true) {
			throw(new \PDOException("accessName is invalid"));
		}

		//create query template
		$query = "SELECT accessId, accessName FROM access WHERE accessName LIKE :accessName";
		$statement = $pdo->prepare($query);

		//bind the accessName to the place holder template
		$accessName = "%$accessName%";
		$parameters = array("accessName" => $accessName);
		$statement->execute($parameters);

		//build an array of access
		$accessors = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
				try {
					$access = new Access($row["accessId"], $row["accessName"]);
					$accessors[$accessors->key()] = $access;
					$accessors->next();
				} catch(\exception $exception) {
					//if row couldn't be converted, rethrow it
					throw(new \PDOException($exception->getMessage(), 0, $exception));
				}
			}
			return ($accessors);
	}

	/**
	 * gets access by accessId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $accessId access id to search for
	 * @return int|null access found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public function getAccessByAccessId(\PDO $pdo, int $accessId) {
		//sanitize the accessId before searching
		if($accessId <= 0) {
			throw(new \PDOException("accessId is not positive"));
		}

		//create query template
		$query = "SELECT accessId, accessName FROM access WHERE accessId = :accessId";
		$statement = $pdo->prepare($query);

		//bind the accessId to the place holder template
		$parameters = array("accessId" => $accessId);
		$statement->execute($parameters);

		//grab the access from mySQL
		try {
			$access = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$access = new ACCESS($row["accessId"], $row["accessName"]);
			}
		} catch(\Exception $exception) {
			//if row couldn't be converted, then rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($access);
	}

	/**
	 * gets all accessors
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of accessors found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public function getAllAccess(\PDO $pdo) {
		//create query template
		$query = "SELECT accessId, accessName FROM access";
		$statement = $pdo->prepare($query);
		$statement->execute();

		//build an array of access
		$accessors = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$access = new Access($row["accessId"], $row["accessName"]);
				$accessors[$accessors->key()] = $access;
				$accessors->next();
			} catch(\Exception $exception) {
				//if the row couldn't be converted, then rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($accessors);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}