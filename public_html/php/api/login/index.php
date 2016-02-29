<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
use Edu\Cnm\Timecrunchers\Login;
use Edu\Cnm\Timecrunchers\User;

try {
	if($method === "POST") {
		//if they shouldn't have admin access to this method, kill the temp access and boot them
		//check by retrieving their original login from the DB and checking
		$security = Login::getLoginByLogin($pdo, $_SESSION["login"]->get...???);
		if($security->getLoginIsAdmin() === false) {
			$_SESSION["login"]->setLoginIsAdmin(false);
			throw(new RuntimeException("access denied", 403));
		}

		//create new user
		$user = new User($id, $_SESSION["user"]->getUserId, $requestObject->userCompanyId, $requestObject->userCrewId,
			$requestObject->userAccessId, $requestObject->userPhone, $requestObject->userFirstName, $requestObject->userLastName, $requestObject->userEmail, $requestObject->userActivation, $requestObject->userHash, $requestObject->userSalt);
		$user->insert($pdo);

		$reply->message = "user created okay";
		//compose and send the email for confirmation and setting a new password
				// create Swift message
			$swiftMessage = Swift_Message::newInstance();

		// attach the sender to the message
				// this takes the form of an associative array where the Email is the key for the real name
				$swiftMessage->setFrom(["timecrunchers@gmail.com" => "time crunchers"]);
				/**
				 * attach the recipients to the message
				 * notice this an array that can include or omit the the recipient's real name
				 * use the recipients' real name where possible; this reduces the probability of the Email being marked as spam
				 **/
				$recipients = [$requestObject->userEmail];
				$swiftMessage->setTo($recipients);
				// attach the subject line to the message
				$swiftMessage->setSubject("Please confirm your Bread Basket account");

				/**
				 * attach the actual message to the message
				 * here, we set two versions of the message: the HTML formatted message and a special filter_var()ed
				 * version of the message that generates a plain text version of the HTML content
				 * notice one tactic used is to display the entire $confirmLink to plain text; this lets users
				 * who aren't viewing HTML content in Emails still access your links
				 */

				//building the activation link that can travel to another server and still work. This is the link that will be clicked to confirm the account.
				$basePath = $_SERVER["SCRIPT NAME"];

				for($i = 0; $i < 3; $i++) {
					$lastSlash = strrpos($basePath, "/");
					$basePath = substr($basePath, 0, $lastSlash);
				}
					$urlglue = $basePath . "/controllers/email-confirmation?emailActivation=" . $user->getUserEmailActivation();
					$confirmLink = "https://" . $_SERVER["SERVER_NAME"] . $urlglue;
					$message = <<< EOF
<h1>You've been registered for the Timecrunchers Scheduling!</h1>
<p>Visit the following URL to set a new password and complete the registration process: </p>
<a href="$confirmLink">$confirmLink</a></p>
EOF;
				$swiftMessage->setBody($message, "text/html");
				$swiftMessage->addPart(html_entity_decode(filter_var($message, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)), "text/plain");

				/**
				 * send the Email via SMTP; the SMTP server here is configured to relay everything upstream via CNM
				 * this default may or may not be available on all web hosts; consult their documentation/support for details
				 * SwiftMailer supports many different transport methods; SMTP was chosen because it's the most compatible and has the best error handling
				 * @see http://swiftmailer.org/docs/sending.html Sending Messages - Documentation - SwitftMailer
				 **/
				$smtp = Swift_SmtpTransport::newInstance("localhost", 25);
				$mailer = Swift_Mailer::newInstance($smtp);
				$numSent = $mailer->send($swiftMessage, $failedRecipients);
				/**
				 * the send method returns the number of recipients that accepted the Email
				 * so, if the number attempted is not the number accepted, this is an Exception
				 **/
				if($numSent !== count($recipients)) {
					//the $failedRecipients parameter passed in the send() method now contains contains an array of the Emails that failed
					throw(new RuntimeException("unable to send email", 404));
				}
			}
}