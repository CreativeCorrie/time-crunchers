<?php
namespace Edu\Cnm\Timecrunchers;

require_once ("autoloader.php");
/**
 * user is our smaller employees in a company
 *
 * a user is given access and is able to check a shift, create a password, input their information
 * @author Denzyl Fontaine
 */

class User {
	/**
	 * id for the user is userId, this is the primary key
	 *
	 * @var int $userId ;
	 */
	private $userId;
	/**
	 *userCompanyId
	 * @var int $userCompanyId
	 */
	private $userCompanyId;
	/**
	 * userAccessId
	 * @var int $userAccessId
	 */
	private $userAccessId;
	/**
	 * userPhone
	 * @var string $userPhone
	 */
	private $userPhone;
	/**
	 * userFirstName
	 * @var string $userFirstName
	 */
	private $userFirstName;
	/**
	 * userLastName
	 * @var string $userLastName
	 */
	private $userLastName;
	/**
	 * userCrewId
	 * @var string $userCrewId
	 */
	private $userCrewId;
	/**
	 * userEmail
	 * @var string $userEmail
	 */
	private $userEmail;
	/**
	 * userActivation
	 * @var int $userActivaiton
	 */
	private $userActivaion;
	/**
	 * userHash
	 * @var int $userHash
	 */
	private $userHash;
	/**
	 * userSalt
	 * @var int $userSalt
	 */
	private $userSalt;

	/**
	 * @param int|null $newUserId id of this user or null if new user
	 * @param int|null $newCompanyId id of the company or null if new user
	 * @param int|null $newAccessId id of the access or null if new user
	 * @param string $newUserPhone string containing user phone number
	 * @param string $newUserFirstName string containing user first name
	 * @param string $newUserLastName string containing user last name
	 * @param int|null $newUserCrewId id of the crew or null if new crew
	 * @param string $newUserEmail string containing user email
	 * @param int|null $newUserActivation containing user activation info
	 * @param int|null $newUserHash containing user password info
	 * @param int|null $newUserSalt containing user password info
	 *
	 * @throws \InvalidArgumentException if the data types are not valid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @thorws \Exception if some other exception occurs
	 **/

	public function __construct(int $newUserId = null, int $newCompanyId = null, int $newAccessId = null, string $newUserPhone, string $newUserFirstName, string $newUserLastName, int $newUserCrewId = null, string $newUserEmail, int $newUserActivation = null, int $newUserHash = null, int $newUserSalt = null) {
		try {
			$this->setUserId($newUserId);
			$this->setUserCompanyId($newCompanyId);
			$this->setUserAccessId($newAccessId);
			$this->setUserPhone($newUserPhone);
			$this->setUserFirstName($newUserFirstName);
			$this->setUserLastName($newUserLastName);
			$this->setUserCrewId($newUserCrewId);
			$this->setUserEmail($newUserEmail);
			$this->setUserActivation($newUserActivation);
			$this->setUserHash($newUserHash);
			$this->setUserSalt($newUserHash);
		} catch(\InvalidArgumentException $invalidArgument) {
			//rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			//rethrow exception to caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			//rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			//rethrow regular exception to caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for user id
	 *
	 * @return int|null value of user id
	 */
	public function getUserId() {
		return ($this->userId);
	}

	/**
	 * mutator method for user id
	 *
	 * @param int|null $newUserId new value for user id
	 * @throws \RangeException if $newUserId is not positive
	 * @throws \TypeError if $newUserId  is not an integer
	 **/
	public function setUserId(int $newUserId = null) {
		//base case: if the user is null, this is a new user without a mySQL assigned id. (yet)
		if($newUserId === null) {
			$this->userId = null;
			return;
		}

		//verify user id is positive
		if($newUserId <= 0) {
			throw(new \RangeException("user id is not positive"));
		}

		//convert and store user id
		$this->userId = $newUserId;
	}

	/**
	 * accessor method for companyId
	 *
	 * @return int|null value of company id
	 */
	public function getUserCompanyId() {
		return ($this->userCompanyId);
	}

	/**
	 * mutator method for company id
	 *
	 * @param int|null $newUserCompanyId new value for company id
	 * @param \RangeException if $newUserCompanyId is not positive
	 * @param \TypeError if $newUserCompanyId is not an integer
	 **/
	public function setCompanyId(int $newUserCompanyId = null) {
		//base case: if the company is null, this is a new company id
		if($newUserCompanyId === null) {
			$this->userCompanyId = null;
			return;
		}

		//verify company id is positive
		if($newUserCompanyId <= 0) {
			throw(new \RangeException("users company id is not positive"));
		}

		//convert and store company id
		$this->userCompanyId = $newUserCompanyId;
	}

	/**
	 * accessor method for access id
	 *
	 * @return int|null $newAccessId
	 */
	public function getUserAccessId() {
		return ($this->userAccessId);
	}

	/**
	 * mutator method for access id
	 *
	 * @param int|null $newUserAccessId new value for access id
	 * @param \RangeException if $newUserAccessId is not positive
	 * @param \TypeError if $newUserAccessId is not an integer
	 **/
	public function setUserAccessId(int $newUserAccessId = null) {
		//base case: if Access id is null, this is first time accessing
		if($newUserAccessId === null) {
			$this->userAccessId = null;
			return;
		}
		//verify company id is positive
		if($newUserAccessId <= 0) {
			throw(new \RangeException("access id is not positive"));
		}

		//convert and store access id
		$this->userAccessId = $newUserAccessId;
	}

	/**
	 * accessor method for user phone
	 *
	 * @return string $newUserPhone
	 **/
	public function getUserPhone() {
		return ($this->userPhone);
	}

	/**
	 * mutator method for user phone
	 *
	 * @param string $newUserPhone string of users phone number
	 * @param \InvalidArgumentException if $newUserPhone is not a string
	 * @param \RangeException if $newUserPhone is > 32
	 * @param \TypeError if $newUserPhone is not a string
	 */
	public function setUserPhone(string $newUserPhone) {
		//verify userPhone is secure
		$newUserPhone = trim($newUserPhone);
		$newUserPhone = Filter_var($newUserPhone, FILTER_SANITIZE_STRING);
		if(empty($newUserPhone) === true) {
			throw(new \InvalidArgumentException("user phone is empty or not secure"));
		}

		//verify user phone will fit in the database
		if(strlen($newUserPhone) > 32) {
			throw(new \RangeException("user phone too large"));
		}

		//store the user phone
		$this->userPhone = $newUserPhone;
	}

	/**
	 *accessor for user first name
	 *
	 * @return string $newUserFirstName
	 */
	public function getUserFirstName() {
		return ($this->userFirstName);
	}

	/**
	 * mutator method for user first name
	 *
	 * @param string $newUserFirstName string of users first name
	 * @param \InvalidArgumentException if $newUserFirstName is not a string
	 * @param \RangeException if $newUserFirstName is > 32
	 * @param \TypeError if $newUserFirstName is not a string
	 */
	public function setUserFirstName(string $newUserFirstName) {
		//verify userFirstName is secure
		$newUserFirstName = trim($newUserFirstName);
		$newUserFirstName = Filter_var($newUserFirstName, FILTER_SANITIZE_STRING);
		if(empty($newUserFirstName) === true) {
			throw(new \InvalidArgumentException("user first name is empty or not secure"));
		}

		//verify user first name will fit in database.
		if(strlen($newUserFirstName) > 32) {
			throw(new \RangeException("user first name too large"));
		}

		//store the user first name
		$this->userFirstName = $newUserFirstName;
	}

	/**
	 * accessor for user last name
	 *
	 * @return string $newUserLastName
	 */
	public function getUserLastName() {
		return ($this->userLastName);
	}

	/**
	 * mutator method for the user last name
	 *
	 * @param string $newUserLastName string of users last name
	 * @param \InvalidArgumentException if $newUserLastName is not a string
	 * @param \RangeException if $newUserLastName is > 32
	 * @param \TypeError if $newUserLastName is not a string
	 */
	public function setUserLastName(string $newUserLastName) {
		//verify userFirstName is secure
		$newUserLastName = trim($newUserLastName);
		$newUserLastName = Filter_var($newUserLastName, FILTER_SANITIZE_STRING);
		if(empty($newUserLastName) === true) {
			throw(new \InvalidArgumentException("user first name is empty or not secure"));
		}

		//verify user first name will fit in database.
		if(strlen($newUserLastName) > 32) {
			throw(new \RangeException("user first name too large"));
		}

		//store the user first name
		$this->userLastName = $newUserLastName;
	}

	/**
	 * accessor for user crew id
	 *
	 * @return int $newCrewId
	 */
	public function getUserCrewId() {
		return ($this->userCrewId);
	}

	/**
	 * mutator for user crew id
	 *
	 * @param int|null $newUserCrewId new value for crew id
	 * @param \RangeExcemption if user crew id is not positive
	 * @param \TypeError if $newCrewId is not an integer
	 */
	public function setUserCrewId(int $newUserCrewId = null) {
		//apply filter to input
		if($newUserCrewId === null) {
			$this->userCrewId = null;
			return;
		}

		//verify the crew id is positive
		if($newUserCrewId <= 0) {
			throw(new \RangeException("crew id is not positive"));
		}

		//convert and store the crew id
		$this->userCrewId = $newUserCrewId;
	}

	/**
	 * accessor method user email
	 *
	 * @return string $newUserEmail
	 */
	public function getUserEmail() {
		return ($this->userEmail);
	}

	/**
	 * mutator method for user email
	 *
	 * @param string $newUserEmail string of users email info
	 * @param \InvalidArgumentException if $newUserEmail is not a string
	 * @param \RangeException if $newUserEmail is out of range
	 * @param \TypeError is $newUserEmail is not a string
	 */
	public function setUserEmail(string $newUserEmail) {
		//verify the User email is secure
		$newUserEmail = trim($newUserEmail);
		$newUserEmail = filter_var($newUserEmail, FILTER_SANITIZE_STRING);
		if(empty($newUserEmail) === true) {
			throw(new \InvalidArgumentException("user email is not secure"));
		}

		//verify the user email will fit in the database
		if(strlen($newUserEmail) > 32) {
			throw(new \RangeException("user email to long"));
		}

		//store the user email
		$this->userEmail = $newUserEmail;
		}

	/**
	 * accessor method user activation
	 *
	 * @return int|null $newUserActivation
	 */
	public function getUseractivation() {
		return ($this->userActivation);
	}

	/**
	 * mutator method for user activation
	 *
	 * @param int|null for $newUserActivation
	 * @param \RangeException if $newRangeException is > 32
	 * @param \TypeError if $newUserActivation is not an int
	 */
	public function setUserActivation(int $newUserActivation = null) {
		//apply the filter to the input
		if($newUserActivation === null) {
			$this->userActivation = null;
			return;
		}

		//verify user activation is positive
		if($newUserActivation <= 0) {
			throw(new \RangeException("user activation to large"));
		}

		//convert and store user activation
		$this->userActivation = $newUserActivation;
	}

	/**
	 * accessor method for user hash
	 *
	 * @return int|null for $newUserHash
	 */
	public function getUserHash() {
		return ($this->userHash);
	}

	/**
	 * mutator method for user hash
	 *
	 * @param int|null for $newUserHash
	 * @param \RangeException if $newUserHash is > 128
	 * @param \TypeError if $newUserHash is not an int
	 */
	public function setUserHash(int $newUserHash = null) {
		//apply filter to the input
		if($newUserHash === null) {
			$this->userHash = null;
			return;
		}

		//verify user hash is positive
		if($newUserHash <= 0) {
			throw(new \RangeException("use hash is too long"));
		}

		//convert and store user activation
		$this->userHash = $newUserHash;
	}

	/**
	 * accessor method for user salt
	 *
	 * @returns int|null for $newUserSalt
	 */
	public function getUserSalt() {
		return ($this->userSalt);
	}

	/**
	 * mutator method for user salt
	 *
	 * @param int|null for $newUserSalt
	 * @param \RangeException if $newUserSalt is > 64
	 * @param \TypeError if $newUserSalt is not an int
	 */
	public function setUserSalt(int $newUserSalt = null) {
		//apply filter to the input
		if($newUserSalt === null) {
			$this->userSalt = null;
			return;
		}

		//verify that user salt is positive
		if($newUserSalt <= 0) {
			throw(new \RangeException("user salt is too long"));
		}

		//convert and store user salt
		$this->userSalt = $newUserSalt;
	}


	/**
	 * inserts this User into mySQL
	 *
	 * @param \pdo $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
	//enforce Userid is null
	if($this->userId !== null) {
			throw(new \PDOException("not a new user"));
	}

	//create quarry template
	$query = "insert into user(userId, userCompanyId, userAccessId, userPhone, userFirstName, userLastName, userCrewId,userEmail, userActivation, userHash, userSalt)";
	$statement = $pdo->prepare($query);

	//bind the memeber variables to the place holders in the template
	$parameters = ["userId" =>$this->userId, "userCompanyId" =>$this->userCompanyId, "userAccessId" =>$this->userAccessId, "userPhone" =>$this->userPhone, "userFirstName" =>$this->userFirstName, "userLastName" =>$this->userLastName, "userCrewId" =>$this->userCrewId, "userEmail" =>$this->userEmail, "userActivation" =>$this->userActivation, "userHash" =>$this->userHash, "userSalt" =>$this->userSalt];
	$statement->execute($parameters);

	//update the null userId with the what mySQL just gave us
	$this->userId = intval($pdo->lastInsertId());
}

/**
 * deletes the user from mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @param \PDOExeption when mySQL related errors occur
 * @param \TypeError if $pdo is not a PDO connection object
 */

	public function update(\PDO $pdo) {
	//enforce the the userId is not null (tldr don't delete a user that is not yet inserted)
	if($this->userId === null) {
		throw(new \PDOException("unable to delete a user that does not exist"));
	}

	//create query template
	$query = "DELETE FROM user WHERE userId = :userId";
	$statement = $pdo->prepare($query);

	// bind the member variables to the place holder in the template
	$parameters = ["userId" => $this->userId];
	$statement->execute($parameters);
}

/**
 * updates this user in mySQL
 *
 * @param \PDO $pdo PDO connection to object
 * @throws \PDOException when mySQL related errors occurs
 * @throws \TypeError if $pdo is not a PDO connection object
 */

	public function update(\PDO $pdo) {
	//enforce the userId is not null
	if($this->userId === null) {
		throw(new \PDOException("unable to update a user that does not exist"));
	}

	//create query template
	$query = "UPDATE user SET userId = :";
	$statement = $pdo->prepare($query);

	//bind the member variables to the place holders in the template
	$parameters = ["userId" => $this->userId, "user"];
	$statement->execute($parameters)
}

/**
 * gets the user by user id
 *
 * @param \PDO $pdo PDO connection object
 * @param int $userId user id to search for
 * @return user|null user found or null if not found
 * @throws \PDOException when mySQL related errors occurs
 * @throws \TypeError when variables are not the correct content type
 */

	public static function getUserId(\PDO $pdo, int userId) {
		//sanitize the user id vefore searching
		if($userId <= 0) {
			throw(new \PDOException("tweet is not positive"));
		}

		//create query template
		$query = "SELECT userId, companyId, accessId, userPhone, userFirstName, userLastName, userCrewId, 		userEmail, userActivation, userHash, userSalt";
		$statement = $pdo->prepare($query);

		//bind the userId to place a holder in template
		$parameters = array("userId" => $userId);
		$statement->exectute($parameters);

		//grab the tweet from mySQL
		try {
			$tweet = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statemtent->fetch();
			if($row !== false) {
				$user = new User($row["userId"], $row["companyId"], $row["accessId"], $row["userPhone"], 		$row["userFirstName"], $row["userLastName"], $row["userCrewId"], $row["userEmail"], $row[userActivation], 		$row["userHash"], $row["userSalt"]);
		}
		} catch(\Exception $excetion) {
			//if the row couldn't be converted, rethow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($user);
}

/**
 * gets user by company id
 *
 * @param \PDO $pdo connection object
 * @param  int $companyId comonay id to search for
 * @return user|null user found or null if not found
 * @throws \PDOException when mySQL related error codes
 * @throws \TypeError whe variables are not the correct type content type
 **/
	public static function getCompanyId(\PDO $pdo, int companyId) {
	if(companyId <= 0) {
		throw(new \PDOException("company is not positive"));
	}

	//create query template
	$query = "SELECT userId, companyId, accessId, userPhone, userFirstName, userLastName, userCrewId, 		userEmail, userActivation, userHash, userSalt";
	$statement = $pdo->prepare($query);

	//bind the userId to place a holder in template
	$parameters = array("companyId" => $companyId);
	$statement->execute($parameters);

	//grab the company from mySQL
	try {
		$tweet = null;
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		$row = $statement->fetch();
		if($row !== false) {
			$company = new company($row["userId"], $row["companyId"], $row["accessId"], $row["userPhone"], $row["userFirstName"], $row["userLastName"], $row["userCrewId"], $row["userEmail"], $row[userActivation], $row["userHash"], $row["userSalt"]);
		}
	} catch(\Exception $exception) {
		//if the row couldn't be converted, rethrow it
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}
	return ($company);
}

/**
 * gets all users
 *
 * @param \PDO $pdo PDO connection object
 * @return \splFixedArray splFixedArray of users found or null if not found
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when variables are not the correct data type
 */

public static function getAllUsers(\PDO $pdo) {
	//create query update
	$query = "SELECT userId, companyId, accessId, userPhone, userFirstName, userLastName, userCrewId, 		userEmail, userActivation, userHash, userSalt";
	$statement = $pdo->prepare($query);
	$statement->execute();

	//build an array of user
	$users = new \SPLFixedArray($statement->fetch());
	$statement->setFetchMode(\PDO::FETCH_ASSOC);
	while(($row = $statement->fetch()) !== false) {
		try {
			$user = new company($row["userId"], $row["companyId"], $row["accessId"], $row["userPhone"], 		$row["userFirstName"], $row["userLastName"], $row["userCrewId"], $row["userEmail"], $row[userActivation], 		$row["userHash"], $row["userSalt"]);
			$users[$users->key()] = $users;
			$users->next();
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
	}
	return ($users);
}