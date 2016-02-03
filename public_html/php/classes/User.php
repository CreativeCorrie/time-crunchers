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
	 *
	 */
}