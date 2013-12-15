<?php

include_once 'config/config.php.inc';
include_once 'database/MySQLConnection.php';
include_once 'MyTabAccountInterface.php';
require 'security/PasswordHash.php';

/**
 * This class implements MyTabAccountInterface, contains methods to handle account action related to MyTab master account
 */
class MyTabAccountImpl implements MyTabAccountInterface
{
    private $database;
	public function __construct()
	{
		$this->database = new Database();
	}

	/**
	* function to get the user account details, 	
	* takes the user email as parameter and returns the account details of the user
	*
	* @param string $email email-id of the user
	* 
	* @return string
	* 	
	*/
	public function getAccountDetails($email)
	{
		$sql = "SELECT first_name,last_name from user_data where email= :email";
	    $this->database->query($sql);
	    $this->database->bind(':email', $email );
	    $this->database->execute();
		$column = $this->database->single();
		return $email."|".$column['first_name']."|".$column['last_name'] ;
		
	}

	/**
	* function to update the user credentials	
	* @param string $username user-name
	* @param string $firstName first-name
	* @param string $lastName last-name
	* @param mixed $encryptPass encrypted-password
	* @return string
	* 	
	*/
	public function update_credentials($username,$firstName,$lastName,$encryptPass)
	{
		
		$sql = "SELECT count(*) as count from user_data where email= :email";
		$this->database->query($sql);
		$this->database->bind(':email',$username);
		$this->database->execute();
		$column = $this->database->single();

		if($column['count']==1){

			$_SESSION['firstname'] = $_POST['firstname'];
			$sql = "UPDATE user_data SET first_name= :firstname , last_name= :lastname , password= :encrpytPass where email = :username";
		    $this->database->query($sql);
		    $this->database->bind(':username',$username);
		    $this->database->bind(':firstname',$firstName);
		    $this->database->bind(':lastname',$lastName);
		    $this->database->bind(':encrpytPass',$encryptPass);
		    $this->database->execute();


			$to      = $username;
			$email_from = "admin@www.mytab.org";
		    $full_name = 'MyTab Customer Service';
		    $from_mail = $full_name.'<'.$email_from.'>';
			$from = $from_mail;
			$subject = 'MyTab credentials updated';
			$message = '<html>
						<body>
						<img src="https://www.mytab.org/resources/images/newLogoEmail.jpg"/>
							<h3>Hi '.$_SESSION['firstname'].' </h3>
							<div> You have updated you MyTab account credentials!. If this change was unintended, please reply back to this email</div>
						</body>
						</html>';
			$headers = "" .
		           "Reply-To:" . $from . "\r\n" .
		           "From:" . $from . "\r\n" .
		           "X-Mailer: PHP/" . phpversion();
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";  
			mail($to, $subject, $message,$headers,'-f admin@www.mytab.org');
			
			return "success";
			
		}
		else{
		    return "notexists";
		    
		}
	}
	
	public function getSupportedThirdPartyAccounts(){
		$sql = "SELECT acc_id,name FROM accounts ORDER BY id";
		$this->database->query($sql);
		/**
		* This is where the query in $sql variable gets executed
		*/
		$accounts =  $this->database->resultSet();

		foreach($accounts as $row) {
			echo $row['acc_id'].','.$row['name'].'|';
		}
	
	}


}

