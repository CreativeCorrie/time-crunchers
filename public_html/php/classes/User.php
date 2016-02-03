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
	 */

	public function __construct(int $newUserId = null, int $newCompanyId = null, int $newAccessId = null, string $newUserPhone, string $newUserFirstName, string $newUserLastName, int $newUserCrewId = null, string $newUserEmail, int $newUserActivation = null, int $newUserHash = null, int $newUserSalt = null) {
		{
			try {
				$this->setUserId($newUserId);
				$this->setCompanyId($newCompanyId);
				$this->setAccessId($newAccessId);
				$this->setUserPhone($newUserPhone);
				$this->setUserFirstName($newUserFirstName);
				$this->setUserLastName($newUserLastName);
			}
		}
	}
}