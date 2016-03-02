<?php
namespace Edu\Cnm\Timecrunchers;

require_once("autoloader.php");

/**
 * user is our smaller employees in a company
 *
 * a user is given access and is able to check a shift, create a password, input their information
 * @author Denzyl Fontaine
 */
class User implements \JsonSerializable {
	use InjectCompanyId;
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
	 * userCrewId
	 * @var int $userCrewId
	 */
	private $userCrewId;
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
	 * userEmail
	 * @var string $userEmail
	 */
	private $userEmail;
	/**
	 * userActivation
	 * @var string $userActivation
	 */
	private $userActivation;
	/**
	 * userHash
	 * @var string $userHash
	 */
	private $userHash;
	/**
	 * userSalt
	 * @var string $userSalt
	 */
	private $userSalt;

	/**
	 * @param int|null $newUserId id of this user or null if new user
	 * @param int|null $newUserCompanyId id of the company or null if new user
	 * @param int|null $newUserCrewId id of the crew or null if new crew
	 * @param int|null $newUserAccessId id of the access or null if new user
	 * @param string $newUserPhone string containing user phone number
	 * @param string $newUserFirstName string containing user first name
	 * @param string $newUserLastName string containing user last name
	 * @param string $newUserEmail string containing user email
	 * @param string $newUserActivation containing user activation info
	 * @param string $newUserHash containing user password info
	 * @param string $newUserSalt containing user password info
	 * @throws \InvalidArgumentException if the data types are not valid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newUserId = null, int $newUserCompanyId, int $newUserCrewId, int $newUserAccessId, string $newUserPhone, string $newUserFirstName, string $newUserLastName, string $newUserEmail, string $newUserActivation, string $newUserHash, string $newUserSalt) {
		try {
			$this->setUserId($newUserId);
			$this->setUserCompanyId($newUserCompanyId);
			$this->setUserCrewId($newUserCrewId);
			$this->setUserAccessId($newUserAccessId);
			$this->setUserPhone($newUserPhone);
			$this->setUserFirstName($newUserFirstName);
			$this->setUserLastName($newUserLastName);
			$this->setUserEmail($newUserEmail);
			$this->setUserActivation($newUserActivation);
			$this->setUserHash($newUserHash);
			$this->setUserSalt($newUserSalt);
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
	public function setUserCompanyId(int $newUserCompanyId = null) {
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
	 * @param \RangeException if user crew id is not positive
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
	 * @return string $newUserActivation
	 */
	public function getUserActivation() {
		return ($this->userActivation);
	}

	/**
	 * mutator method for user activation
	 *
	 * @param string $newUserActivation string of users activation
	 * @param \RangeException if $newRangeException is not = 32
	 * @param \TypeError if $newUserActivation is not a string
	 */
	public function setUserActivation(string $newUserActivation) {
		//verify $userActivation is secure
		$newUserActivation = strtolower(trim($newUserActivation));

		//make sure that user activation cannot be null
		if(ctype_xdigit($newUserActivation) === false) {
			throw(new \RangeException("user activation cannot be null"));
		}
		//make sure user activation =  32
		if(strlen($newUserActivation) !== 32) {
			throw(new \RangeException("user activation must be 32"));
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
	 * @param string $newUserHash string of user hash
	 * @param \InvalidArgumentException if $newUserHash is not a string
	 * @param \RangeException if $newUserHash = 128
	 * @param \TypeError if $newUserHash is not a string
	 */
	public function setUserHash(string $newUserHash) {
		//verification that $userHash is secure
		$newUserHash = strtolower(trim($newUserHash));

		//make sure that user activation cannot be null
		if(ctype_xdigit($newUserHash) === false) {
			throw(new \RangeException("user hash cannot be null"));
		}
		//make sure user activation =  128
		if(strlen($newUserHash) !== 128) {
			throw(new \RangeException("user hash has to be 128"));
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
	 * @param string $newUserSalt string of user salt
	 * @param \InvalidArgumentException if user salt is not a string
	 * @param \RangeException if $newUserSalt = 64
	 * @param \TypeError if $newUserSalt is not a string
	 */
	public function setUserSalt(string $newUserSalt) {
		//verification that $userSalt is secure
		$newUserSalt = strtolower(trim($newUserSalt));

		//make sure that user activation cannot be null
		if(ctype_xdigit($newUserSalt) === false) {
			throw(new \RangeException("user salt cannot be null"));
		}
		//make sure user activation =  64
		if(strlen($newUserSalt) !== 64) {
			throw(new \RangeException("user salt has to be 64"));
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
		//enforce userId is null
		if($this->userId !== null) {
			throw(new \PDOException("not a new user"));
		}

		//create query template
		$query = "INSERT INTO user(userCompanyId, userCrewId, userAccessId, userPhone, userFirstName, userLastName, userEmail, userActivation, userHash, userSalt) VALUES(:userCompanyId, :userCrewId, :userAccessId, :userPhone, :userFirstName, :userLastName,:userEmail, :userActivation, :userHash, :userSalt)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["userCompanyId" => $this->userCompanyId, "userCrewId" => $this->userCrewId, "userAccessId" => $this->userAccessId, "userPhone" => $this->userPhone, "userFirstName" => $this->userFirstName, "userLastName" => $this->userLastName, "userEmail" => $this->userEmail, "userActivation" => $this->userActivation, "userHash" => $this->userHash, "userSalt" => $this->userSalt];
		$statement->execute($parameters);

		//update the null userId with the what mySQL just gave us
		$this->userId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes the user from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param \PDOException when mySQL related errors occur
	 * @param \TypeError if $pdo is not a PDO connection object
	 */
	public function delete(\PDO $pdo) {
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
		$query = "UPDATE user SET userId = :userId, userCompanyId = :userCompanyId, userCrewId = :userCrewId, userAccessId = :userAccessId, userPhone = :userPhone, userFirstName = :userFirstName, userLastName = :userLastName, userEmail = :userEmail, userActivation = :userActivation, userHash = :userHash, userSalt = :userSalt";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["userId" => $this->userId, "userCompanyId" => $this->userCompanyId, "userCrewId" => $this->userCrewId, "userAccessId" => $this->userAccessId, "userPhone" => $this->userPhone, "userFirstName" => $this->userFirstName, "userLastName" => $this->userLastName, "userEmail" => $this->userEmail, "userActivation" => $this->userActivation, "userHash" => $this->userHash, "userSalt" => $this->userSalt];
		$statement->execute($parameters);
	}

	/**
	 * gets the user by Email
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $userEmail access content to search for
	 * @return \User user obbject
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 */
	public static function getUserByUserEmail(\PDO $pdo, string $userEmail) {
		//sanitize the description before searching
		$userEmail = trim($userEmail);
		$userEmail = filter_var($userEmail, FILTER_SANITIZE_EMAIL);
		if(empty($userEmail) === true) {
			throw(new \PDOException("user email invalid"));
		}
		//create query template
		$query = "SELECT userId, userCompanyId, userCrewId, userAccessId, userPhone, userFirstName, userLastName, userEmail, userActivation, userHash, userSalt FROM user WHERE userEmail = :userEmail";
		$statement = $pdo->prepare($query);
		//bind users with place holder in the template
		//$userEmail = "%$userEmail%";
		$parameters = array("userEmail" => $userEmail);
		$statement->execute($parameters);
		try {
			$user = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$user = new User($row["userId"], $row["userCompanyId"], $row["userCrewId"], $row["userAccessId"], $row["userPhone"], $row["userFirstName"], $row["userLastName"], $row["userEmail"], $row["userActivation"], $row["userHash"], $row["userSalt"]);
			}
		} catch(\Exception $exception) {
			//if row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($user);
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

	public static function getUserByUserId(\PDO $pdo, int $userId) {
		//sanitize the user id before searching
		if($userId <= 0) {
			throw(new \PDOException("userId is not positive"));
		}

		//create query template
		$query = "SELECT userId, userCompanyId, userCrewId, userAccessId, userPhone, userFirstName, userLastName, userEmail, userActivation, userHash, userSalt
						FROM user
						WHERE userId LIKE :userId
						AND userId IN (SELECT userId FROM user WHERE userCompanyId = :companyId)";
		$statement = $pdo->prepare($query);
		//bind the userId to place a holder in template
		$parameters = ["userId" => $userId,  "companyId" => self::injectCompanyId()];
		$statement->execute($parameters);
		//grab the user from mySQL
		try {
			$user = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$user = new User($row["userId"], $row["userCompanyId"], $row["userCrewId"], $row["userAccessId"], $row["userPhone"], $row["userFirstName"], $row["userLastName"], $row["userEmail"], $row["userActivation"], $row["userHash"], $row["userSalt"]);
			}
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($user);
	}
	/**
	 * gets the User by userActivation
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param  string $userActivation user Activation content to search for
	 * @return \SplFixedArray SplFixedArray of users found
	 * @return User|null User found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getUserByUserActivation(\PDO $pdo, string $userActivation) {
		// sanitize the description before searching
		$userActivation = trim($userActivation);
		$userActivation = filter_var($userActivation, FILTER_SANITIZE_STRING);
		if(empty($userActivation) === true) {
			throw(new \PDOException("user activation content is invalid"));
		}
		// create query template
		$query = "SELECT userId, userCompanyId, userCrewId, userAccessId, userPhone, userFirstName, userLastName, userEmail, userActivation, userHash, userSalt
						FROM user
						WHERE userActivation LIKE :userActivation
						AND userActivation IN (SELECT userId FROM user WHERE userCompanyId = :companyId)";
		$statement = $pdo->prepare($query);
		// bind the company name content to the place holder in the template
		$parameters = ["userActivation" => $userActivation, "companyId" => self::injectCompanyId()];
		$statement->execute($parameters);
		// build an array of userActivations
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		$row = $statement->fetch();
		try {
			$user = new User($row["userId"], $row["userCompanyId"], $row["userCrewId"], $row["userAccessId"], $row["userPhone"], $row["userFirstName"], $row["userLastName"], $row["userEmail"], $row["userActivation"], $row["userHash"], $row["userSalt"]);
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($user);
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
		$query = "SELECT userId, userCompanyId, userCrewId, userAccessId, userPhone, userFirstName, userLastName, userEmail, userActivation, userHash, userSalt
						FROM user
						WHERE user.userId
						IN (SELECT userId FROM user WHERE userCompanyId = :companyId)";
		$statement = $pdo->prepare($query);
		$parameters = ["companyId" => self::injectCompanyId()];
		$statement->execute($parameters);

		//build an array of user
		$users = new \SPLFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$user = new User($row["userId"], $row["userCompanyId"], $row["userCrewId"], $row["userAccessId"], $row["userPhone"], $row["userFirstName"], $row["userLastName"], $row["userEmail"], $row["userActivation"], $row["userHash"], $row["userSalt"]);
				$users[$users->key()] = $user;
				$users->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($users);
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