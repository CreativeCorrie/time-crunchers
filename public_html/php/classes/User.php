<?php
namespace Edu\Cnm\Timecrunchers;

require_once("autoloader.php");
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
	 * @var int $userId;
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
		{
			try {
				$this->setUserId($newUserId);
				$this->setCompanyId($newCompanyId);
				$this->setAccessId($newAccessId);
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
		public function getCompanyId() {
			return ($this->companyId);
		}

		/**
		 * mutator method for company id
		 *
		 * @param int|null $newCompanyId new value for company id
		 * @param \RangeException if $newCompanyId is not positive
		 * @param \TypeError if $newCompanyId is not an integer
		 **/
		public function setCompanyId(int $newCompanyId = null) {
			//base case: if the company is null, this is a new company id
			if($newCompanyId === null) {
				$this->companyId = null;
				return;
			}

			//verify company id is positive
			if($newCompanyId <= 0) {
				throw(new \RangeException("company id is not positive"));
			}

			//convert and store company id
			$this->companyId = $newCompanyId;
		}

		/**
		 * accessor method for access id
		 *
		 * @return int|null $newAccessId
		 */
		public function getAccessId() {
			return ($this->accessId);
		}

		/**
		 * mutator method for access id
		 *
		 * @param int|null $newAccessId new value for access id
		 * @param \RangeException if $newAccessId is not positive
		 * @param \TypeError if $newAccessId is not an integer
		 **/
		public function setAccessId(int $newAccessId = null) {
			//base case: if Access id is null, this is first time accessing
			if($newAccessId === null) {
				$this->accessId = null;
				return;
			}
				//verify company id is positive
				if($newAccessId <= 0) {
					throw(new \RangeException("access id is not positive"));
			}

			//convert and store access id
			$this->accessId = $newAccessId;
		}

		/**
		 * accessor method for user phone
		 *
		 *@return string $newUserPhone
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
		 * @param int|null $newCrewId new value for crew id
		 * @param \RangeExcemption if user crew id is not positive
		 * @param \TypeError if $newCrewId is not an integer
		 */
		public function setUserCrewId(int $newUserCrewId = null){
			//apply filter to input
			 if($newCrewId === null) {
				 $this->crewId = null;
				 return;
			 }

			//verify the crew id is positive
			if($newCrewId <= 0) {
				throw(new \RangeException("crew id is not positive"));
			}

			//convert and store the crew id
			$this->crewId = $newUserCrewId;
		}

		/**
		 * accessor method user email
		 *
		 * @return string $newUserEmail
		 */
		public function getUserEmail() {
			return($this->userEmail);
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
			$newUserEmail = trim($newUseremail);
			$newUserEmail = filter_var($newUserEmail, FILTER_SANITIZE_STRING);
			if(empty($newUserEmail) === true) {
				throw(new \InvalidArgumentException("user email is not secure"));
			}

			//verify the user email will fit in the database
			if(strlen($newUserEmail) > 32) {
				throw(new \RangeException("user email to long"));
			}

			//store the user email
			$this->userEmail = $newUserEmail
		}

		/**
		 * accessor method user activation
		 *
		 * @return int|null $newUserActivation
		 */
		public function getUseractivation() {
			return($this->userActivatin);
		}

		/**
		 * mutator method for user activation
		 *
		 * @param int|null for $newUserActivation
		 * @param \RangeException if $newRangeException is > 32
		 * @param \TypeError if $newUserActivation is not an int
		 */
		public function setUserActivation(int $newUserActivation = null)
	}
}