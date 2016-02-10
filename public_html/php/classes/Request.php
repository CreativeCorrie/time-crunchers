<?php
namespace Edu\Cnm\timecrunchers;

require_once("autoload.php");

/**
 * Request Class for TimeCrunchers
 *
 * Request allows a user to make a schedule request, comment on the request. Then receive
 * administrator approval/disapproval through a boolean method and admin comment.
 *
 * @author Samuel Van Chandler <samuelvanchandler@gmail.com>
 **/
class Request implements \JsonSerializable{

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
	 * @var timestamp $requestTimeStamp.
	 */
	private $requestTimeStamp;
	/**
	 * time that the requestApprove was commit
	 * @var string $requestActionTimeStamp.
	 */
	private $requestActionTimeStamp;
	/**
	 * boolean return of administrator approve/deny
	 * of user schedule request.
	 * @var tinyint $requestApprove
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
	 * @throws
	 */
	public function __construct(int $newRequestId = null, int $newRequestRequestorId, int $newRequestAdminId,
										 int $newRequestTimeStamp = null, $newRequestActionTimeStamp = null,
										 bool $newRequestApprove = 0, string $newRequestRequestorText, $newRequestAdminText) {
		try {
			$this->setRequestId($newRequestId);
			$this->setRequestRequestorId($newRequestRequestorId);
			$this->setRequestAdminId($newRequestAdminId);
			$this->setRequestTimeStamp($newRequestActionTimeStamp);
			$this->setRequestActionTimeStamp($newRequestActionTimeStamp);
			$this->setRequestApprove($newRequestApprove);
			$this->setRequestRequestorText($newRequestRequestorText);
			$this->setRequestAdminText($newRequestAdminText);
		} catch
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
		if($newRequestId === null) {
				$this->requestId = null;
			return;
		}
		if($newRequestId <= 0) {
			throw(new \RangeException("request id is not positive"));
		}
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
	 * @param int $newRequestRequestorId userId of person making request
	 *
	 */
	public function setRequestRequestorId($newRequestRequestorId) {
		if($newRequestRequestorId <= 0) {
			throw(new \RangeException("requestor id is not poitive"));
		}
		$this->requestRequestorId = $newRequestRequestorId;
	}

	public function getRequestAdminId() {
		return($this->requestAdminId);
	}
	public function setRequestAdminId($newRequestAdminId) {
		if($newRequestAdminId <= 0) {
			throw(new \RangeException("administrator id is not positive"));
		}
		$this->requestAdminId = $newRequestAdminId;
	}

	public function getRequestTimeStamp() {
		return ($this->requestTimeStamp);
	}
	public function setRequestTimeStamp($newRequestTimeStamp) {
		if($newRequestTimeStamp === null) {
			$this->requestTimeStamp = new \DateTime();
			return;
		}
		$this->requestTimeStamp = $newRequestTimeStamp;
	}

	public function getRequestActionTimeStamp() {
		return ($this->requestActionTimeStamp);
	}
	public function setRequestActionTimeStamp($newRequestActionTimeStamp) {
		if($newRequestActionTimeStamp === null){
			$this->requestActionTimeStamp = new \DateTime();
			return;
		}
		$this->requestActionTimeStamp = $newRequestActionTimeStamp;
	}

	public function getRequestApprove() {
		return ($this->requestApprove);
	}
	public function setRequestApprove($newRequestApprove) {
		if(is_bool($newRequestApprove) === false) {
			throw(new \InvalidArgumentException("not a boolean"));
		}
		$this->requestApprove = $newRequestApprove;
	}

	public function getRequestRequestorText() {
		return ($this->newRequestRequestorText);
	}
	public function setRequestRequestorText(string $newRequestRequestorText) {
		$newRequestRequestorText = trim($newRequestRequestorText);
		$newRequestRequestorText = filter_var($newRequestRequestorText, FILTER_SANITIZE_STRING);
		if(strlen($newRequestRequestorText) > 255) {
			throw(new \RangeException("comment too large, 255 characters or less please"));
		}
		$this->requestRequestorText = $newRequestRequestorText;
	}

	public function getRequestAdminText() {
		return ($this->requestAdminText);
	}
	public function setRequestAdminText(string $newRequestAdminText) {
		$newRequestAdminText = trim($newRequestAdminText);
		$newRequestAdminText = filter_var($newRequestAdminText, FILTER_SANITIZE_STRING);
		if(strlen($newRequestAdminText) > 255) {
			throw(new \RangeException("comment too large, 255 character or less pleas"));
		}
		$this->requestAdminText = $newRequestAdminText;
	}

	public function insert(\PDO $pdo) {
		if($this->requestId !== null) {
			throw(new \PDOException("not a new request"));
		}
		$query = "INSERT INTO request(requestRequestorId,requestAdminId,requestTimeStamp,
			requestActionTimeStamp,requestApprove,requestRequestorText,requestAdminText) VALUES(:requestRequestorId,
			:requestAdminId,:requestTimeStamp,:requestActionTimeStamp,:requestApprove,:requestRequestorText,
			:requestAdminText)";
		$statement = $pdo->prepare($query);
		$formattedDate=$this->requestTimeStamp->format("Y-m-d H:i:s");
		$parameters=["requestRequestorId"=>$this->requestRequestorId,"requestAdminId"=>$this->requestAdminId,
			"requestTimeStamp"=>$this->requestTimeStamp,"requestActionTimeStamp"=>$this->requestActionTimeStamp,
			"requestApprove"=>$this->requestApprove,"requestRequestorText"=>$this->requestRequestorText,
			"requestAminText"=>$this->requestAdminText];
		$statement->execute($parameters);
		$this->requestId=intaval($pdo->lastInserId());
	}

	public function delete(\PDO $pdo) {
		if($this->requestId===null){
			throw(new \PDOException("can't delete, request does not exits"));
		}
		$query = "DELETE FROM request WHERE requestId = :requestId";
		$statement=$pdo->perpare($query);
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
		"requestTimeStamp" => $this->requestTimeStamp];
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
				throw(new \PDOException($exception->getMessage(),0,$exception);
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
		$fields["tweetDate"] = intval($this->requestActionTimeStamp->format("U")) * 1000;
		return($fields);
	}




}

