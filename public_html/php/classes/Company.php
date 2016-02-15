<?php
namespace Edu\Cnm\Timecrunchers;

require_once ("autoloader.php");


/**
 * Company, a business
 *
 *A Company refers to a business customer using the Timecrunchers application
 *A Company is an entity with many crews and employees
 *
 * @author Dylan McDonald<dmcdonald21@cnm.edu>
 * @author Elaine Thomas<enajera2@cnm.edu>
 *@version 2.0.0
 **/
class Company {
	/**
	 * id for this Company; this is the primary key
	 * @var int $companyId
	 **/
	private $companyId;
	/**
	 * optional attention line to direct communication
	 * @var string $companyAttn
	 */
	private $companyAttn;
	/**
	 *company name supplied by the business customer
	 *@var string $companyName
	 **/
	private $companyName;
	/**
	 * company address line 1
	 * @var string $companyAddress1
	 */
	private $companyAddress1;
	/**
	 * company address line 2
	 * @var string $companyAddress2
	 */
	private $companyAddress2;
	/**
	 * name of state where company business is located
	 * @var string $companyState
	 */
	private $companyCity;
	/**
	 * name of city where company business is located
	 * @var string $companyCity
	 */
	private $companyState;
	/**
	 * zip code for company business
	 * @var string $companyZip
	 */
	private $companyZip;
	/**
	 * phone number for company business
	 * @var string $companyPhone
	 */
	private $companyPhone;
	/**
	 * email address for company business
	 * @var string $companyEmail
	 */
	private $companyEmail;
	/**
	 * url for company business website
	 * @var string $companyUrl
	 */
	private $companyUrl;

	/**
	 *constructor for Company
	 *
	 * @param int|null $newCompanyId id of this Company or null if a new Company
	 * @param string $newCompanyAttn string containing optional attention line
	 * @param string $newCompanyName string containing the company name
	 * @param string $newCompanyAddress1 string containing company address line 1
	 * @param string $newCompanyAddress2 string containing company address line 2
	 * @param string $newCompanyCity string containing name of city where company is located
	 * @param string $newCompanyState string containing name of state where company is located
	 * @param string $newCompanyZip string containing zip code for company address
	 * @param string $newCompanyPhone string containing zip code for company address
	 * @param string $newCompanyEmail string containing email address for company
	 * @param string $newCompanyUrl string containing URL for company website
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception is thrown
	 **/
	public function __construct(int $newCompanyId = null, string $newCompanyAttn, string $newCompanyName, string $newCompanyAddress1, string $newCompanyAddress2, string $newCompanyCity, string $newCompanyState, string $newCompanyZip, string $newCompanyPhone, string $newCompanyEmail, string $newCompanyUrl) {
		try {
			$this->setCompanyId($newCompanyId);
			$this->setCompanyName($newCompanyName);
			$this->setCompanyAddress1($newCompanyAddress1);
			$this->setCompanyAddress2($newCompanyAddress2);
			$this->setCompanyAttn($newCompanyAttn);
			$this->setCompanyState($newCompanyState);
			$this->setCompanyCity($newCompanyCity);
			$this->setCompanyZip($newCompanyZip);
			$this->setCompanyPhone($newCompanyPhone);
			$this->setCompanyEmail($newCompanyEmail);
			$this->setCompanyUrl($newCompanyUrl);
		} catch(\InvalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			// rethrow the exception to the caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError) {
			// rethrow the exception to the caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception) {
			// rethrow generic exception
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 *accessor method for company id
	 *
	 *@return int value of company id
	 **/
	public function getCompanyId () {
		return($this->companyId);
	}

	/**
	 * mutator method for company id
	 *
	 * @param int $newCompanyId new value of company id
	 * @throws \RangeException if $newCompanyId is not positive
	 * @throws \InvalidArgumentException if $newCompanyId is not an integer
	 **/
	public function setCompanyId(int $newCompanyId = null) {
		// base case: if the company id is null, this is a new company without a mySQL assigned id (yet)
		if($newCompanyId === null) {
			$this->companyId = null;
			return;
		}
		//Filter int
		$newCompanyId = filter_var($newCompanyId, FILTER_VALIDATE_INT);

		//Throw type error if Company id is not valid integer

		if($newCompanyId === false) {
			throw(new \InvalidArgumentException("company id is not an integer"));
		}
		// verify the company id is positive
		if($newCompanyId <= 0) {
			throw(new \RangeException("company id is not positive"));
		}

		//convert and store the company id
		$this->companyId = $newCompanyId;
	}

	/**
	 * accessor method for company name content
	 *
	 * @return string value of company name content
	 **/
	public function getCompanyName() {
		return($this->companyName);
	}

	/**
	 * mutator method for company name
	 *
	 * @param string $newCompanyName new company name
	 * @throws \InvalidArgumentException if $newCompanyName is not a string or insecure
	 * @throws \RangeException if $newCompanyName is > 128 characters
	 * @throws \TypeError if $newCompanyName is not a string
	 **/
	public function setCompanyName(string $newCompanyName) {
		// verify the company name content is secure
		$newCompanyName = trim($newCompanyName);
		$newCompanyName = filter_var($newCompanyName, FILTER_SANITIZE_STRING);
		if(empty($newCompanyName) === true) {
			throw(new \InvalidArgumentException("company name content is empty or insecure"));
		}
		// verify the company name will fit in the database
		if(strlen($newCompanyName) > 128 ) {
			throw(new \RangeException("company name content too large"));
		}

		// store the company name content
		$this->companyName = $newCompanyName;
	}

	/**
	 * accessor method for company address line 1
	 *
	 * @return string value of company address line 1 content
	 **/
	public function getCompanyAddress1() {
		return($this->companyAddress1);
	}

	/**
	 * mutator method for company address
	 *
	 * @param string $newCompanyAddress1 new company's address line 1
	 * @throws \InvalidArgumentException if $newCompanyAddress1 is not a string or insecure
	 * @throws \RangeException if $newCompanyAddress1 is > 128 characters
	 * @throws \TypeError if $newCompanyAddress1 is not a string
	 **/
	public function setCompanyAddress1(string $newCompanyAddress1) {
		// verify the company address line 1 content is secure
		$newCompanyAddress1 = trim($newCompanyAddress1);
		$newCompanyAddress1 = filter_var($newCompanyAddress1, FILTER_SANITIZE_STRING);
		if(empty($newCompanyAddress1) === true) {
			throw(new \InvalidArgumentException("company address line 1 content is empty or insecure"));
		}
		// verify the company address line 1 will fit in the database
		if(strlen($newCompanyAddress1) > 128) {
			throw(new \RangeException("company address line 1 content too large"));
		}

		// store the company name content
		$this->companyAddress1 = $newCompanyAddress1;
	}

	/**
	 * accessor method for optional company address line 2
	 *
	 * @return string company address line 2 content
	 **/
	public function getCompanyAddress2() {
		return($this->companyAddress2);
	}

	/**
	 * mutator method for optional company address line 2
	 *
	 * @param string $newCompanyAddress2 new optional company address line 2
	 * @throws \InvalidArgumentException if $newCompanyAddress2 is not a string or insecure
	 * @throws \RangeException if $newCompanyAddress2 is > 128 characters
	 * @throws \TypeError if $newCompanyAddress2 is not a string
	 **/
	public function setCompanyAddress2(string $newCompanyAddress2) {
		// verify the company address line 2 content is secure
		$newCompanyAddress2 = trim($newCompanyAddress2);
		$newCompanyAddress2 = filter_var($newCompanyAddress2, FILTER_SANITIZE_STRING);

		// verify the company address line 2 will fit in the database
		if(strlen($newCompanyAddress2) > 128) {
			throw(new \RangeException("company address line 2 content too large"));
		}

		// store the company attn content
		$this->companyAddress2 = $newCompanyAddress2;
	}
	/**
	 * accessor method for company attn content
	 *
	 * @return string value of company attn content
	 **/
	public function getCompanyAttn() {
		return($this->companyAttn);
	}

	/**
	 * mutator method for company attn
	 *
	 * @param string $newCompanyAttn new optional attn line
	 * @throws \InvalidArgumentException if $newCompanyAttn is not a string or insecure
	 * @throws \RangeException if $newCompanyAttn is > 128 characters
	 * @throws \TypeError if $newCompanyAttn is not a string
	 **/
	public function setCompanyAttn(string $newCompanyAttn) {
		// verify the company attn content is secure
		$newCompanyAttn = trim($newCompanyAttn);
		$newCompanyAttn = filter_var($newCompanyAttn, FILTER_SANITIZE_STRING);

		// verify the company attn will fit in the database
		if(strlen($newCompanyAttn) > 128) {
			throw(new \RangeException("company attn content too large"));
		}

		// store the company attn content
		$this->companyAttn = $newCompanyAttn;
	}



	/**
	 * accessor method for state where company is located
	 *
	 * @return string state where company is located
	 **/
	public function getCompanyState() {
		return($this->companyState);
	}

	/**
	 * mutator method for state where company is located
	 *
	 * @param string $newCompanyState new state where company is located
	 * @throws \InvalidArgumentException if $newCompanyState is not a string or insecure
	 * @throws \RangeException if $newCompanyState is > 128 characters
	 * @throws \TypeError if $newCompanyState is not a string
	 **/
	public function setCompanyState(string $newCompanyState) {
		// verify the company state content is secure
		$newCompanyState = trim($newCompanyState);
		$newCompanyState = filter_var($newCompanyState, FILTER_SANITIZE_STRING);
		if(empty($newCompanyState) === true) {
			throw(new \InvalidArgumentException("company state content is empty or insecure"));
		}
		// verify the company state content will fit in the database
		if(strlen($newCompanyState) > 128) {
			throw(new \RangeException("company state content too large"));
		}

		// store the company state content
		$this->companyState = $newCompanyState;
	}

	/**
	 * accessor method for city where company is located
	 *
	 * @return string city where company is located
	 **/
	public function getCompanyCity() {
		return($this->companyCity);
	}

	/**
	 * mutator method for city where company is located
	 *
	 * @param string $newCompanyCity new city where company is located
	 * @throws \InvalidArgumentException if $newCompanyCity is not a string or insecure
	 * @throws \RangeException if $newCompanyCity is > 128 characters
	 * @throws \TypeError if $newCompanyCity is not a string
	 **/
	public function setCompanyCity(string $newCompanyCity) {
		// verify the company city content is secure
		$newCompanyCity = trim($newCompanyCity);
		$newCompanyCity = filter_var($newCompanyCity, FILTER_SANITIZE_STRING);
		if(empty($newCompanyCity) === true) {
			throw(new \InvalidArgumentException("company city content is empty or insecure"));
		}
		// verify the company city content will fit in the database
		if(strlen($newCompanyCity) > 128) {
			throw(new \RangeException("company city content too large"));
		}

		// store the company name content
		$this->companyCity = $newCompanyCity;
	}

	/**
	 * accessor method for zip code where company is located
	 *
	 * @return string zip code where company is located
	 **/
	public function getCompanyZip() {
		return($this->companyZip);
	}

	/**
	 * mutator method for zip code where company is located
	 *
	 * @param string $newCompanyZip new zip code where company is located
	 * @throws \InvalidArgumentException if $newCompanyZip is not a string or insecure
	 * @throws \RangeException if $newCompanyZip is > 128 characters
	 * @throws \TypeError if $newCompanyZip is not a string
	 **/
	public function setCompanyZip(string $newCompanyZip) {
		// verify the company zip content is secure
		$newCompanyZip = trim($newCompanyZip);
		$newCompanyZip = filter_var($newCompanyZip, FILTER_SANITIZE_STRING);
		if(empty($newCompanyZip) === true) {
			throw(new \InvalidArgumentException("company zip code content is empty or insecure"));
		}
		// verify the company zip code content will fit in the database
		if(strlen($newCompanyZip) > 128) {
			throw(new \RangeException("company zip code content too large"));
		}

		// store the company zip code content
		$this->companyZip = $newCompanyZip;
	}

	/**
	 * accessor method for company phone number
	 *
	 * @return string company phone number
	 **/
	public function getCompanyPhone() {
		return($this->companyZip);
	}

	/**
	 * mutator method for company phone number
	 *
	 * @param string $newCompanyPhone new company phone number
	 * @throws \InvalidArgumentException if $newCompanyPhone is not a string or insecure
	 * @throws \RangeException if $newCompanyPhone is > 128 characters
	 * @throws \TypeError if $newCompanyPhone is not a string
	 **/
	public function setCompanyPhone(string $newCompanyPhone) {
		// verify the company phone content is secure
		$newCompanyPhone = trim($newCompanyPhone);
		$newCompanyPhone = filter_var($newCompanyPhone, FILTER_SANITIZE_STRING);
		if(empty($newCompanyPhone) === true) {
			throw(new \InvalidArgumentException("company phone content is empty or insecure"));
		}
		// verify the company phone content will fit in the database
		if(strlen($newCompanyPhone) > 128) {
			throw(new \RangeException("company phone content too large"));
		}

		// store the company phone content
		$this->companyPhone = $newCompanyPhone;
	}

	/**
	 * accessor method for company email address
	 *
	 * @return string company email address
	 **/
	public function getCompanyEmail() {
		return($this->companyZip);
	}

	/**
	 * mutator method for company email address
	 *
	 * @param string $newCompanyEmail new company email address
	 * @throws \InvalidArgumentException if $newCompanyEmail is not a string or insecure
	 * @throws \RangeException if $newCompanyEmail is > 128 characters
	 * @throws \TypeError if $newCompanyEmail is not a string
	 **/
	public function setCompanyEmail(string $newCompanyEmail) {
		// verify the company email address content is secure
		$newCompanyEmail = trim($newCompanyEmail);
		$newCompanyEmail = filter_var($newCompanyEmail, FILTER_SANITIZE_EMAIL);
		if(empty($newCompanyEmail) === true) {
			throw(new \InvalidArgumentException("company email content is empty or insecure"));
		}
		// verify the company email content will fit in the database
		if(strlen($newCompanyEmail) > 128) {
			throw(new \RangeException("company email content too large"));
		}

		// store the company email content
		$this->companyEmail = $newCompanyEmail;
	}

	/**
	 * accessor method for company email address
	 *
	 * @return string company email address
	 **/
	public function getCompanyUrl() {
		return($this->companyUrl);
	}

	/**
	 * mutator method for company URL
	 *
	 * @param string $newCompanyUrl new company URL
	 * @throws \InvalidArgumentException if $newCompanyUrl is not a string or insecure
	 * @throws \RangeException if $newCompanyUrl is > 128 characters
	 * @throws \TypeError if $newCompanyUrl is not a string
	 **/
	public function setCompanyUrl(string $newCompanyUrl) {
		// verify the company URL address content is secure
		$newCompanyUrl = trim($newCompanyUrl);
		$newCompanyUrl = filter_var($newCompanyUrl, FILTER_SANITIZE_URL);
		if(empty($newCompanyUrl) === true) {
			throw(new \InvalidArgumentException("company URL content is empty or insecure"));
		}
		// verify the company url content will fit in the database
		if(strlen($newCompanyUrl) > 128) {
			throw(new \RangeException("company url content too large"));
		}

		// store the company url content
		$this->companyUrl = $newCompanyUrl;
	}


	/**
	 * inserts this Company into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) {
		// enforce the companyId is null (i.e., don't insert a company that already exists)
		if($this->companyId !== null) {
			throw(new \PDOException("not a new company"));
		}

		// create query template
		$query = "INSERT INTO company (companyAttn, companyName, companyAddress1, companyAddress2, companyCity, companyState, companyZip, companyPhone, companyEmail, companyUrl) VALUES(:companyAttn, :companyName, :companyAddress1, :companyAddress2, :companyCity, :companyState, :companyZip, :companyPhone, :companyEmail, :companyUrl)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["companyAttn" => $this->companyAttn, "companyName" => $this->companyName, "companyAddress1" => $this->companyAddress1, "companyAddress2" => $this->companyAddress2, "companyCity" => $this->companyCity, "companyState" => $this->companyState, "companyZip" => $this->companyZip, "companyPhone" => $this->companyPhone, "companyEmail" => $this->companyEmail, "companyUrl" => $this->companyUrl];
		$statement->execute($parameters);

		// update the null companyId with what mySQL just gave us
		$this->companyId = intval($pdo->lastInsertId());
	}


	/**
	 * deletes this Company from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) {
		// enforce the companyId is not null (i.e., don't delete a company that hasn't been inserted)
		if($this->companyId === null) {
			throw(new \PDOException("unable to delete a company that does not exist"));
		}

		// create query template
		$query = "DELETE FROM company WHERE companyId = :companyId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["companyId" => $this->companyId];
		$statement->execute($parameters);
	}

	/**
	 * updates this Company in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) {
		// enforce the companyId is not null (i.e., don't update a company that hasn't been inserted)
		if($this->companyId === null) {
			throw(new \PDOException("unable to update a company that does not exist"));
		}

		// create query template
		$query = "UPDATE company SET companyAttn = :companyAttn, companyName = :companyName, companyAddress1 = :companyAddress1, companyAddress2 = :companyAddress2, companyCity = :companyCity, companyState = :companyState, companyZip = :companyZip, companyPhone = :companyPhone, companyEmail = :companyEmail, companyUrl = :companyUrl WHERE companyId = :companyId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = ["companyAttn" => $this->companyAttn, "companyName" => $this->companyName, "companyAddress1" => $this->companyAddress1, "companyAddress2" => $this->companyAddress2, "companyCity" => $this->companyCity, "companyState" => $this->companyState, "companyZip" => $this->companyZip, "companyPhone" => $this->companyPhone, "companyEmail" => $this->companyEmail, "companyUrl" => $this->companyUrl, "companyId" => $this->companyId];
		$statement->execute($parameters);
	}

	/**
	 * gets the Tweet by company name
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $companyName company content to search for
	 * @return \SplFixedArray SplFixedArray of Companies found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getCompanyByCompanyName(\PDO $pdo, string $companyName) {
		// sanitize the description before searching
		$companyName = trim($companyName);
		$companyName = filter_var($companyName, FILTER_SANITIZE_STRING);
		if(empty($companyName) === true) {
			throw(new \PDOException("company name content is invalid"));
		}

		// create query template
		$query = "SELECT companyId, companyAttn, companyName, companyAddress1, companyAddress2, companyCity, companyState, companyZip, companyPhone, companyEmail, companyUrl FROM company WHERE companyName LIKE :companyName";
		$statement = $pdo->prepare($query);

		// bind the company name content to the place holder in the template
		$companyName = "%$companyName%";
		$parameters = array("companyName" => $companyName);
		$statement->execute($parameters);

		// build an array of companies
		$companies = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$company = new Company($row["companyId"], $row["companyAttn"], $row["companyName"], $row["companyAddress1"], $row["companyAddress2"], $row["companyCity"], $row["companyState"], $row["companyZip"], $row["companyPhone"], $row["companyEmail"], $row["companyUrl"]);
				$companies[$companies->key()] = $company;
				$companies->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($companies);
	}

	/**
	 * gets the Company by companyId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param int $companyId company id to search for
	 * @return Company|null Company found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getCompanyByCompanyId(\PDO $pdo, int $companyId) {
		// sanitize the companyId before searching
		if($companyId <= 0) {
			throw(new \PDOException("company id is not positive"));
		}

		// create query template
		$query = "SELECT companyId, companyAttn, companyName, companyAddress1, companyAddress2, companyCity, companyState, companyZip, companyPhone, companyEmail, companyUrl FROM company WHERE companyId = :companyId";
		$statement = $pdo->prepare($query);

		// bind the company id to the place holder in the template
		$parameters = array("companyId" => $companyId);
		$statement->execute($parameters);

		// grab the company from mySQL
		try {
			$company = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$company = new Company($row["companyId"], $row["companyAttn"], $row["companyName"], $row["companyAddress1"], $row["companyAddress2"], $row["companyCity"], $row["companyState"], $row["companyZip"], $row["companyPhone"], $row["companyEmail"], $row["companyUrl"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($company);
	}

	/**
	 * gets all Companies
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Companies found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllCompanies(\PDO $pdo) {
		// create query template
		$query = "SELECT companyId, companyAttn, companyName, companyAddress1, companyAddress2, companyCity, companyState, companyZip, companyPhone, companyEmail, companyUrl FROM company";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of companies
		$companies = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$company = new Company($row["companyId"], $row["companyAttn"], $row["companyName"], $row["companyAddress1"], $row["companyAddress2"], $row["companyCity"], $row["companyState"], $row["companyZip"], $row["companyPhone"], $row["companyEmail"], $row["companyUrl"]);
				$companies[$companies->key()] = $company;
				$companies->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($companies);
	}


}