<?php
namespace Edu\Cnm\Timecrunchers\test;

use Edu\Cnm\Timecrunchers\{};

//grab test parameters
require_once("TimecrunchersTest.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/php/classes/autoloader.php");

/**
 * Full PHPUnit test for the user class
 *
 * This is a complete PHPUnit test of the user class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see user
 * @author Denzyl Fontaine>
 **/
class UserTesT extends TimecrunchersTest {
	/**
	 * content of user
	 * @var string $VALID_USERCONTENT
	 */
	protected $VALID_USERCONTENT = "PHPUnit test passing";
	/**
	 * content of updated user
	 * @var string $VALID_USERCONTENT2
	 */
	protected $VALID_USERCONTENT2 = "PHPUnit test still passing";
	/**
	 * profile that created the user, this is for foreign key
	 * @var userCompanyId
	 */

}
