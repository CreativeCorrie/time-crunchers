<?php
// namespace Edu\Cnm\Timecruncher\DataDesign;

// require_once ("autoload.php");


/**
 * Company, a business
 *
 *A Company refers to a business customer using the Timecrunchers application
 *A Company is an entity with many crews and employees
 *
 *@author Elaine Thomas <enajera2@cnm.edu>
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
	 * @param int $newProductId id of this RamChip or null if a new RamChip
	 * @param string $newProductName string containing the product name
	 * @param string $newManufacturerName
	 * @param string $newModelName string containing the product name
	 * @param double $newPrice current sale price of product
	 * @throws InvalidArgumentException if data types are not valid
	 * @throws RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws Exception if some other exception is thrown
	 **/
	public function __construct($newProductId, $newProductName, $newManufacturerName, $newModelName, $newPrice = null) {
		try {
			$this->setProductId($newProductId);
			$this->setProductName($newProductName);
			$this->setManufacturerName($newManufacturerName);
			$this->setModelName($newModelName);
			$this->setPrice($newPrice);
		} catch(InvalidArgumentException $invalidArgument) {
			// rethrow the exception to the caller
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range) {
			// rethrow the exception to the caller
			throw(new RangeException($range->getMessage(), 0, $range));
		} catch(Exception $exception) {
			// rethrow generic exception
			throw(new Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 *accessor method for product id
	 *
	 *@return int value of product id
	 **/
	public function getProductId () {
		return($this->productId);
	}

	/**
	 * mutator method for product id
	 *
	 * @param int $newProductId new value of product id
	 * @throws InvalidArgumentException if product id is not an integer
	 * @throws RangeException if product id is negative
	 **/
	public function setProductId($newProductId) {
		// base case: if the product id is null, this is a new product without a mySQL assigned id (yet)
		if($newProductId === null) {
			$this->productId = null;
			return;
		}

		// verify the product id is valid
		$newProductId = filter_var($newProductId, FILTER_VALIDATE_INT);
		if($newProductId === false) {
			throw(new InvalidArgumentException("product id is not a valid integer"));
		}

		//verify the product id is positive
		if($newProductId <= 0) {
			throw(new RangeException ("product id is not positive"));
		}

		//convert and store the product id
		$this->productId = intval($newProductId);
	}

	/**
	 * accessor method for product name content
	 *
	 * @return string value of product name content
	 **/
	public function getProductName() {
		return($this->productName);
	}

	/**
	 * mutator method for product name
	 *
	 * @param string $newProductName new name
	 * @throws InvalidArgumentException if $newProductName is not a string or insecure
	 * @throws RangeException if $newProductName is > 128 characters
	 **/
	public function setProductName($newProductName) {
		// verify the product name content is secure
		$newProductName = trim($newProductName);
		$newProductName = filter_var($newProductName, FILTER_SANITIZE_STRING);
		if(empty($newProductName) === true) {
			throw(new InvalidArgumentException("product name content is empty or insecure"));
		}

		// verify the product name will fit in the database
		if(strlen($newProductName) > 128) {
			throw(new RangeException("product name content too large"));
		}

		// store the product name content
		$this->productName = $newProductName;
	}

	/**
	 * accessor method for manufacturer name content
	 *
	 * @return string value manufacturer name
	 **/
	public function getManufacturerName() {
		return($this->manufacturerName);
	}

	/**
	 * mutator method for manufacturer name
	 *
	 * @param string $newManufacturerName
	 * @throws InvalidArgumentException if $newManufacturerName is not a string or insecure
	 * @throws RangeException if $newManufacturerName is > 128 characters
	 **/
	public function setManufacturerName($newManufacturerName) {
		// verify the manufacturer name content is secure
		$newManufacturerName = trim($newManufacturerName);
		$newManufacturerName = filter_var($newManufacturerName,FILTER_SANITIZE_STRING);
		if(empty($newManufacturerName) === true) {
			throw(new InvalidArgumentException("manufacturer name content is empty or insecure"));
		}

		// verify the manufacturer name content will fit in the database
		if(strlen($newManufacturerName) > 128) {
			throw(new RangeException("manufacturer name content too large"));
		}

		// store the manufacturer name content
		$this->manufacturerName = $newManufacturerName;
	}

	/**
	 * accessor method for model name content
	 *
	 * @return string value model name
	 **/
	public function getModelName() {
		return($this->modelName);
	}

	/**
	 * mutator method for model name
	 *
	 * @param string $newModelName
	 * @throws InvalidArgumentException if $newModelName is not a string or insecure
	 * @throws RangeException if $newModelName is > 128 characters
	 **/

	public function setModelName($newModelName) {
		// verify the product name content is secure
		$newModelName = trim($newModelName);
		$newModelName = filter_var($newModelName,FILTER_SANITIZE_STRING);
		if(empty($newModelName) === true) {
			throw(new InvalidArgumentException("model name content is empty or insecure"));
		}

		// verify the model name content will fit in the database
		if(strlen($newModelName) > 128) {
			throw(new RangeException("model name content too large"));
		}

		// store the model name content
		$this->modelName = $newModelName;
	}

	/**
	 * accessor method for price value
	 *
	 * @return double price value
	 **/
	public function getPrice() {
		return($this->price);
	}

	/**
	 * mutator method for RamChip price
	 *
	 * @param double $newPrice new price of RamChip
	 * @throws InvalidArgumentException if $newPrice is not a double
	 * @throws RangeException if $newPrice is not positive
	 **/
	public function setPrice($newPrice) {
		// verify the price value is valid
		$newPrice = filter_var($newPrice, FILTER_VALIDATE_INT);
		if($newPrice === false) {
			throw(new InvalidArgumentException("price value is not a valid integer"));
		}

		// verify the price value is positive
		if($newPrice <= 0) {
			throw(new RangeException("price value cannot be negative"));
		}

		// convert and store the price value
		$this->price = doubleval($newPrice);
	}

	/**
	 * inserts this RamChip into mySQL
	 *
	 * @param PDO $pdo PDO connection object
	 * @throws PDOException when mySQL related errors occur
	 **/
	public function insert(PDO $pdo) {
		// enforce the productId is null (i.e., don't insert a product id that already exists)
		if($this->productId !== null) {  //**IT NEEDS TO NOT EXIST!!
			throw(new PDOException("not a new ram chip"));
			//DO NOT INSERT THE SAME KEY TWICE
		}

		// create query template
		$query	 = "INSERT INTO ramChip(productName, manufacturerName, modelName, price ) VALUES(:productName, :manufacturerName, :modelName, :price)";
		$statement = $pdo->prepare($query);
		//THERE IS NO PRIMARY KEY HERE BC WE ARE GOING TO INSERT IT

		// bind the member variables to the place holders in the template
		$parameters = array("productName" => $this->productName, "manufacturerName" => $this->manufacturerName, "modelName" => $this->modelName, "price" => $this->price);
		$statement->execute($parameters); //EXECUTE IS THE LIVE STEP TO THE DATABASE

		// update the null productId with what mySQL just gave us
		$this->productId = doubleval($pdo->lastInsertId()); //this permanently resolves the "EXISTENTIAL PROBLEM"
	}

	/**
	 * deletes this RamChip from mySQL
	 *
	 * @param PDO $pdo PDO connection object
	 * @throws PDOException when mySQL related errors occur
	 **/
	public function delete(PDO $pdo) {
		// enforce the productId is not null (i.e., don't delete a ram chip that hasn't been inserted)
		if($this->productId === null) {  //**IT NEEDS TO BE SURE IT DOES EXIST
			throw(new PDOException("unable to delete a ram chip that does not exist"));
		}

		// create query template
		$query	 = "DELETE FROM ramChip WHERE productId = :productId";  //WITHOUT THE WHERE CLAUSE IT WILL DELETE ALL TWEETS
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = array("productId" => $this->productId);
		$statement->execute($parameters);
	}

	/**
	 * updates this RamChip in mySQL
	 *
	 * @param PDO $pdo PDO connection object
	 * @throws PDOException when mySQL related errors occur
	 **/
	public function update(PDO $pdo) {
		// enforce the productId is not null (i.e., don't update a ram chip that hasn't been inserted)
		if($this->productId === null) {
			throw(new PDOException("unable to update a ram chip that does not exist"));
		}

		// create query template  **IF THERE IS NO WHERE CLAUSE IT WILL UPDATE THE WHOLE THING
		$query	 = "UPDATE ramChip SET productId = :productId, productName = :productName, manufacturerName = :manufacturerName, modelName = :modelName, price = :price WHERE productId = :productId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$parameters = array("productName" => $this->productName, "manufacturerName" => $this->manufacturerName, "modelName" => $this->modelName, "price" => $this->price);
		$statement->execute($parameters);
	}

	/**
	 * gets the RamChip by product name
	 *
	 * @param PDO $pdo PDO connection object
	 * @param string $productName product name to search for
	 * @return SplFixedArray all RamChipS found for this name
	 * @throws PDOException when mySQL related errors occur
	 **/
	public static function getRamChipByProductName(\PDO $pdo, string $productName) {
		// sanitize the description before searching
		$productName = trim($productName);
		$productName = filter_var($productName, FILTER_SANITIZE_STRING);
		if(empty($productName) === true) {
			throw(new \PDOException("product name is invalid"));
		}

		// create query template
		$query	 = "SELECT productId, productName, manufacturerName, modelName, price FROM ramChip WHERE productName LIKE :productName";
		$statement = $pdo->prepare($query);

		// bind the product name to the place holder in the template
		$productName = "%$productName%";
		$parameters = array("productName" => $productName);
		$statement->execute($parameters);

		// build an array of  ram chips
		$ramChips = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$ramChip = new RamChip($row["productId"], $row["productName"], $row["manufacturerName"], $row["modelName"], $row["price"]);
				$ramChips[$ramChips->key()] = $ramChip;
				$ramChips->next();
			} catch(Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($ramChips);
	}

	/**
	 * gets the RamChip by productId
	 *
	 * @param PDO $pdo PDO connection object
	 * @param int $productId product id to search for
	 * @return mixed RamChip found or null if not found
	 * @throws PDOException when mySQL related errors occur
	 **/
	public static function getRamChipByProductId(PDO $pdo, $productId) {
		// sanitize the productId before searching
		$productId = filter_var($productId, FILTER_VALIDATE_INT);
		if($productId === false) {
			throw(new PDOException("product id is not an integer"));
		}
		if($productId <= 0) {
			throw(new PDOException("product id is not positive"));
		}

		// create query template
		$query	 = "SELECT productId, productName, manufacturerName, modelName, price FROM ramChip WHERE productId = :productId";
		$statement = $pdo->prepare($query);

		// bind the product id to the place holder in the template
		$parameters = array("productId" => $productId);
		$statement->execute($parameters);

		// grab the ram chip from mySQL

		try {
			$ramChip = null;
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$row   = $statement->fetch();
			if($row !== false) {
				$ramChip = new RamChip($row["productId"], $row["productName"], $row["manufacturerName"], $row["modelName"], $row["price"]);
			}
		} catch(Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return($ramChip);
	}

	/**
	 * gets all ram chips
	 *
	 * @param PDO $pdo PDO connection object
	 * @return SplFixedArray all RamChips found
	 * @throws PDOException when mySQL related errors occur
	 **/
	public static function getAllRamChips(\PDO $pdo) {
		// create query template
		$query = "SELECT productId, productName, manufacturerName, modelName, price FROM ramChip";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of ram chips
		$ramChips = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$ramChip = new RamChip($row["productId"], $row["productName"], $row["manufacturerName"], $row["modelName"], $row["price"]);
				$ramChips[$ramChips->key()] = $ramChip;
				$ramChip->next();
			} catch(Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($ramChips);
	}
}