<?php
namespace Edu\Cnm\Timecrunchers;

require_once("autoloader.php");


/**
 * Request Class for TimeCrunchers
 *
 * Request allows a user to make a schedule request, comment on the request. Then receive
 * administrator approval/disapproval through a boolean method and admin comment.
 *
 * @author Samuel Van Chandler <samuelvanchandler@gmail.com>
 **/
class Request implements \JsonSerializable {
	use ValidateDate;
	/**
	 * id for a Request, primary key
	 * @var int $requestId
	 */
	private $requestId;
	/**
	 * userId of requestor
	 * @var int $requestRequestorId
	 */
	private $requestRequestorId;
	/**
	 * userId of administrator preforming requestApprove
	 * @var int $requestAdminId
	 */
	private $requestAdminId;
	/**
	 * time that the request was made
	 * @var \DateTime $requestTimeStamp.
	 */
	private $requestTimeStamp;
	/**
	 * time that the requestApprove was commit
	 * @var \DateTime $requestActionTimeStamp.
	 */
	private $requestActionTimeStamp;
	/**
	 * boolean return of administrator approve/deny
	 * of user schedule request.
	 * @var int $requestApprove
	 */
	private $requestApprove;
	/**
	 * text user enters to explain an instance of Request.
	 * @var string requestRequestorText
	 */
	private $requestRequestorText;
	/**
	 * text administrator enters to explain $requestApprove decision.
	 * @var string $requestAdminText
	 */
	private $requestAdminText;

	/**
	 * constructor for Request
	 * @param int|null $newRequestId -id of the Request
	 * @param int $newRequestRequestorId -id of user making request
	 * @param int $newRequestAdminId -id of admin approving user's request
	 * @param int|null $newRequestTimeStamp -time that user made the request
	 * @param \DateTime|string|null $newRequestActionTimeStamp -time that admin approved user's request
	 * @param boolean $newRequestApprove -boolean return of admin's response to user's request
	 * @param string $newRequestRequestorText -string containing user's request explanation
	 * @param string $newRequestAdminText -string containing admin's comment to user's request
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(int $newRequestId = null, int $newRequestRequestorId = null, int $newRequestAdminId = null,
										 int $newRequestTimeStamp = null, $newRequestActionTimeStamp = null,
										 bool $newRequestApprove = false, string $newRequestRequestorText, string $newRequestAdminText) {
		try {
			$this->setRequestId($newRequestId);
			$this->setRequestRequestorId($newRequestRequestorId);
			$this->setRequestAdminId($newRequestAdminId);
			$this->setRequestTimeStamp($newRequestActionTimeStamp);
			$this->setRequestActionTimeStamp($newRequestActionTimeStamp);
			$this->setRequestApprove($newRequestApprove);
			$this->setRequestRequestorText($newRequestRequestorText);
			$this->setRequestAdminText($newRequestAdminText);
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
			// rethrow the exception to the caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for request id
	 *
	 * @return int|null value of request id
	 */
	public function getRequestId() {
		return($this->requestId);
	}
	/**
	 * mutator method for request id
	 *
	 * @param int|null $newRequestId new value of request id
	 * throws \RangeException if $newRequestId is not positive
	 * throws\TypeError if $newRequestId is not an integer
	 */
	public function setRequestId(int $newRequestId = null) {
		//base case: if the request id is null, creates a new request without sql id... yet
		if($newRequestId === null) {
				$this->requestId = null;
			return;
		}
		//verify the request id is positive
		if($newRequestId <= 0) {
			throw(new \RangeException("request id is not positive"));
		}
		//convert and store request id
		$this->requestId = $newRequestId;
	}

	/**
	 * accessor method for requestor id
	 *
	 * @return int value of requestor's id
	 */
	public function getRequestRequestorId() {
		return($this->requestRequestorId);
	}
	/**
	 * mutator method for requestor's id
	 *
	 * @param int $newRequestRequestorId userId of requestor
	 * throws \RangeException if $newRequestRequestorId is not positive
	 * throws\TypeError if $newRequestRequestorId is not an integer
	 **/
	public function setRequestRequestorId($newRequestRequestorId) {
		//verify the requestRequestorId is positive
		if($newRequestRequestorId <= 0) {
			throw(new \RangeException("requestor id is not positive"));
		}
		//convert and store requestRequestorId
		$this->requestRequestorId = $newRequestRequestorId;
	}
	/**
	 * accessor method for request admin id
	 *
	 * @return int value of request admin id
	 */
	public function getRequestAdminId() {
		return($this->requestAdminId);
	}
	/**
	 * mutator method for admin id
	 *
	 * @param int $newRequestAdminId new value of admin id
	 * throws \RangeException if $newRequestAdminId is not positive
	 */
	public function setRequestAdminId($newRequestAdminId) {
		// verify variable is positive
		if($newRequestAdminId <= 0) {
			throw(new \RangeException("administrator id is not positive"));
		}
		$this->requestAdminId = $newRequestAdminId;
	}
	/**
	 * accessor method for request time stamp
	 *
	 * @return \DateTime value of request time stamp
	 */
	public function getRequestTimeStamp() {
		return ($this->requestTimeStamp);
	}
	/**
	 * mutator method for request time stamp
	 *
	 * @param \DateTime $newRequestTimeStamp time of request
	 * @throws \InvalidArgumentException if $newRequestTimeStamp is not a valid object or string
	 * @throws \RangeException if $newRequestTimeStamp is a date that does not exist
	 */
	public function setRequestTimeStamp($newRequestTimeStamp = null) {
		// base case: if the date is null, use the current date and time
		if($newRequestTimeStamp === null) {
			$this->requestTimeStamp = new \DateTime();
			return;
		}
		// store request date
		try {
			$newRequestTimeStamp = $this->validateDate($newRequestTimeStamp);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->requestTimeStamp = $newRequestTimeStamp;
	}
	/**
	 * accessor method for action time stamp
	 *
	 * @return \DateTime value of action time stamp
	 */
	public function getRequestActionTimeStamp() {
		return ($this->requestActionTimeStamp);
	}
	/**
	 * mutator method for request action time stamp
	 *
	 * @param \DateTime $newRequestActionTimeStamp time of request approval/denial
	 * @throws \InvalidArgumentException if $newRequestActionTimeStamp is not a valid object or string
	 * @throws \RangeException if $newRequestActionTimeStamp is a date that does not exist
	 */
	public function setRequestActionTimeStamp($newRequestActionTimeStamp) {
		// base case: if the date is null, use the current date and time
		if($newRequestActionTimeStamp === null){
			$this->requestActionTimeStamp = new \DateTime();
			return;
		}
		//store the actiontimestamp
		try {
			$newRequestActionTimeStamp = $this->validateDate($newRequestActionTimeStamp);
		} catch(\InvalidArgumentException $invalidArgument) {
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range) {
			throw(new \RangeException($range->getMessage(), 0, $range));
		}
		$this->requestActionTimeStamp = $newRequestActionTimeStamp;
	}
	/**
	 * accessor method for request approval
	 *
	 * @return boolean value of request approval
	 */
	public function getRequestApprove() {
		return ($this->requestApprove);
	}

	/**
	 * mutator method for request approval
	 * @param $newRequestApprove
	 */
	public function setRequestApprove($newRequestApprove) {
		if(is_bool($newRequestApprove) === false) {
			throw(new \InvalidArgumentException("not a boolean"));
		}
		$this->requestApprove = $newRequestApprove;
	}
	/**
	 * accessor method for requestor text
	 *
	 * @return string value of requestor text
	 */
	public function getRequestRequestorText() {
		return ($this->requestRequestorText);
	}

	/**
	 * mutoator method fro requestor text
	 * @param string $newRequestRequestorText
	 */
	public function setRequestRequestorText(string $newRequestRequestorText) {
		$newRequestRequestorText = trim($newRequestRequestorText);
		$newRequestRequestorText = filter_var($newRequestRequestorText, FILTER_SANITIZE_STRING);
		if(strlen($newRequestRequestorText) > 255) {
			throw(new \RangeException("comment too large, 255 characters or less please"));
		}
		$this->requestRequestorText = $newRequestRequestorText;
	}
	/**
	 * accessor method for admin text
	 *
	 * @return string value of admin text
	 */
	public function getRequestAdminText() {
		return ($this->requestAdminText);
	}

	/**
	 * mutator method for request admin text
	 * @param string $newRequestAdminText
	 */
	public function setRequestAdminText(string $newRequestAdminText) {
		$newRequestAdminText = trim($newRequestAdminText);
		$newRequestAdminText = filter_var($newRequestAdminText, FILTER_SANITIZE_STRING);
		if(strlen($newRequestAdminText) > 255) {
			throw(new \RangeException("comment too large, 255 character or less pleas"));
		}
		$this->requestAdminText = $newRequestAdminText;
	}

	public function insert(\PDO $pdo) {
		//enforce the requestId is null
		if($this->requestId !== null) {
			throw(new \PDOException("not a new request"));
		}
		// create query temaplate
		$query = "INSERT INTO request(requestRequestorId,requestAdminId,requestTimeStamp,
			requestActionTimeStamp,requestApprove,requestRequestorText,requestAdminText) VALUES(:requestRequestorId,
			:requestAdminId,:requestTimeStamp,:requestActionTimeStamp,:requestApprove,:requestRequestorText,
			:requestAdminText)";
		$statement = $pdo->prepare($query);

		//bind the member variable to the place holders
		$formattedDate=$this->requestTimeStamp->format("Y-m-d H:i:s");
		$parameters=["requestRequestorId"=>$this->requestRequestorId,"requestAdminId"=>$this->requestAdminId,
			"requestTimeStamp"=>$formattedDate,"requestActionTimeStamp"=>$this->requestActionTimeStamp,
			"requestApprove"=>$this->requestApprove,"requestRequestorText"=>$this->requestRequestorText,
			"requestAminText"=>$this->requestAdminText];
		$statement->execute($parameters);
		$this->requestId=intval($pdo->lastInsertId());
	}

	public function delete(\PDO $pdo) {
		if($this->requestId===null){
			throw(new \PDOException("can't delete, request does not exits"));
		}
		$query = "DELETE FROM request WHERE requestId = :requestId";
		$statement=$pdo->prepare($query);
		$parameters=["requestId" => $this->requestId];
		$statement->execute($parameters);
	}

	public function update(\PDO $pdo) {
		if($this->requestId===null){
			throw(new \PDOException("can't update, request doesn't exist"));
		}
		$query = "UPDATE request SET requestRequestorId = :requestRequestorId, requestRequestorText =
			:requestRequestorId, requestRequestorText = :requestRequestorText, requestTimeStamp = :requestTimeStamp WHERE requestId = :requestId";
		$statement = $pdo->prepare($query);

		//binding member variables to the place holders in the template
		$formattedDate = $this->requestTimeStamp->format("Y-m-d H:i:s");
		$parameters = ["requestRequestorID" => $this->requestRequestorId,"requestRequestorText" => $this->requestRequestorText,
		"requestTimeStamp" => $formattedDate];
		$statement->execute($parameters);
	}

	public static function getRequestByRequestId(\PDO $pdo, int $requestId) {
		//sanitize the requestId
		if($requestId <= 0) {
			throw(new \PDOException("requestId isn not a positive number"));
		}
		// create query template
		$query = "SELECT requestId, requestRequestorId, requestAdminId,requestTimeStamp ,requestActionTimeStamp
		,requestApprove ,requestRequestorText ,requestAdminText from request WHERE requestId = :requestId";
		$statement = $pdo->prepare($query);

		// bind the request id to the place holder in template
		$parameters = array("requestId" => $requestId);
		$statement ->execute($parameters);

		// grabs the request from mysql
		try {
			$request = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);

			$row = $statement->fetch();
			if($row !== false) {
				$request = new Request($row["requestId"], $row["requestRequestorId"], $row["requestAdminId"],
					$row["requestTimeStamp"], $row["requetActionTimeStamp"], $row["requestApprove"],
					$row["requestRequestorText"], $row["requestAdminText"]);
			}
		} catch(\Exception $exception) {
			// if row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(),0,$exception));
		}
		return($request);
	}

	public static function getAllRequests(\PDO $pdo) {
		// create query template
		$query = "SELECT requestId, requestRequestorId, requestAdminId,requestTimeStamp ,requestActionTimeStamp
		,requestApprove ,requestRequestorText ,requestAdminText FROM request";
		$statement= $pdo->prepare($query);
		$statement->execute();

		//build an array of requests
		$requests = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row=$statement->fetch()) !== false) {
			try {
				$request = new Request($row["requestId"], $row["requestRequestorId"], $row["requestAdminId"],
					$row["requestTimeStamp"], $row["requetActionTimeStamp"], $row["requestApprove"],
					$row["requestRequestorText"], $row["requestAdminText"]);
				$requests[$requests->key()] = $request;
				$requests->next();
			} catch(\Exception $exception) {
				//if row couldn't be converted then throw it
				throw(new \PDOException($exception->getMessage(),0,$exception));
			}
		}
		return ($requests);
		}
	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["requestDate"] = intval($this->requestTimeStamp->format("U")) * 1000;
		return($fields);
	}
}

