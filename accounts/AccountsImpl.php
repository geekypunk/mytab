<?php

include_once 'database/MySQLConnection.php';
include_once 'config/config.php.inc';
include_once 'AccountsInterface.php';
/**
 * This class implements AccountsInterface, the necessary methods for the functioning of the integrated third party accounts and/or universoty
 * accounts.
 */
class AccountsImpl implements AccountsInterface
{
    private $database;
	public function __construct()
	{
		$this->database = new Database();
		
	}
	
	/**
	 * function to delete the account
	 * @param string $username user-name of the user
	 * @param string $accId account id of the user
	 * @return string
	 */
	public function delete_account($username,$accId)
	{
		$sql = "Delete from user_accounts where login_user_id= :username and acc_id= :accId ";
		$this->database->query($sql);
		$this->database->bind(':username', $username );
		$this->database->bind(':accId', $accId );
		$this->database->execute();
		$to      = $username;
		$email_from = "admin@www.mytab.org";
	    $full_name = 'MyTab Customer Service';
	    $from_mail = $full_name.'<'.$email_from.'>';
		$from = $from_mail;
		$subject = 'Account deleted!';
		$message = '<html>
					<body>
					<img src="https://www.mytab.org/resources/images/newLogoEmail.jpg"/>
						<h3>Hi '.$_SESSION['firstname'].' </h3>
						<div> An account by name "'.$accId.'" has been deleted from your account! If this change was unintended, please reply back to this email</div>
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

	/**
	 * function to get the account details
	 * @param string $username user-name of the user
	 * @param string $accountid account-id of the user
	 * @return string
	 */
	public function get_acc_details($username,$accountid)
	{
		$sql = "SELECT user_name,AES_DECRYPT(password, 'mytab_sec_passwd') as password from user_accounts where login_user_id = :login_user_id and acc_id= :acc_id ";
		$this->database->query($sql);
		$this->database->bind(':login_user_id', $username );
		$this->database->bind(':acc_id', $accountid);
		$column = $this->database->single();
		if($this->database->rowCount() > 0)
			return $column['user_name'].'|'.$column['password'];
		else
			return "NotFound";
	}

    /**
     * Function for logging into third party account
     * @param $accId
     * @param $email
     * @return string
     */
    public function login($accId,$email){
        $sql = "SELECT user_name, password, AES_DECRYPT(password, 'mytab_sec_passwd') AS passwd from user_accounts where login_user_id= :email and acc_id= :accId";
        $this->database->query($sql);
        $this->database->bind(':email',$email);
        $this->database->bind(':accId',$accId);
        $this->database->execute();
        $column = $this->database->single();
        return $column['user_name']."|".$column['passwd'];
    }
    /**
     * account signup function
     * @param string $accId account-id of the user
     * @param string $email email-id of the user
     * @param string $newUsername new user-name
     * @return string
     */
	public function signup($accId,$email,$newUsername)
	{
		$sql="INSERT INTO user_accounts(acc_id,login_user_id,user_name,password,account_added_time) VALUES ( :accId, :email, :newUsername,AES_ENCRYPT('$_POST[signup_password]', 'mytab_sec_passwd'),now());";
		
	    $this->database->query($sql);
	    $this->database->bind(':email',$email);
	    $this->database->bind(':accId',$accId);
	    $this->database->bind(':newUsername',$newUsername);
	    $this->database->execute();;
		
		$to      = $email;
		$email_from = "admin@www.mytab.org";
	    $full_name = 'MyTab Customer Service';
	    $from_mail = $full_name.'<'.$email_from.'>';
		$from = $from_mail;
		$subject = 'New Account added!';
		$message = '<html>
					<body>
					<img src="https://www.mytab.org/resources/images/newLogoEmail.jpg"/>
						<h3>Hi '.$_SESSION['firstname'].' </h3>
						<div> A new account by name "'.$_POST['account'].'" has been added to your account! If this change was unintended, please reply back to this email</div>
					</body>
					</html>';
		$headers = "" .
	           "Reply-To:" . $from . "\r\n" .
	           "From:" . $from . "\r\n" .
	           "X-Mailer: PHP/" . phpversion();
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";  
		mail($to, $subject, $message,$headers,'-f admin@www.mytab.org');
	
		return "success: ".$_POST['email'];
	}
	
	/**
	 * function to update the user account credentials
	 * @param string $newUsername new user-name of the user
	 * @param string $newPassword new password of the user
	 * @param string $username old user-name of the user
	 * @param string $accId account-id of the user
	 * @return string
	 */

	public function update($newUsername,$newPassword,$username,$accId)
	{
		$sql = "UPDATE user_accounts SET user_name= :newUsername , password = AES_ENCRYPT(:newPassword, 'mytab_sec_passwd') where login_user_id = :username and acc_id= :accId";

		try{
		    $this->database->query($sql);
		    $this->database->bind(':newUsername',$newUsername);
		    $this->database->bind(':username',$username);
		    $this->database->bind(':newPassword',$newPassword);
		    $this->database->bind(':accId',$accId);
		    $this->database->execute();
			
			$to = $username;
			$email_from = "admin@www.mytab.org";
		    $full_name = 'MyTab Customer Service';
		    $from_mail = $full_name.'<'.$email_from.'>';
			$from = $from_mail;
			$subject = 'Account Updated!';
			$message = '<html>
						<body>
						<img src="https://www.mytab.org/resources/images/newLogoEmail.jpg"/>
							<h3>Hi '.$_SESSION['firstname'].' </h3>
							<div> A new account by name "'.$accId.'" has been updated in your account! If this change was unintended, please reply back to this email</div>
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
		catch(Exception $e)
		{
		    return 'Error : '.$e->getMessage();
		}

	}

	/**
	 * function to update third party user account
	 * @param string $email email-id of the user
	 * @return string
	 */
	
	public function update_accounts($email)
	{
		$sql = "SELECT acc_id from user_accounts where login_user_id= :email";
	    $this->database->query($sql);
	    $this->database->bind(':email',$email);
	    $this->database->execute();
	    $accounts = $this->database->resultSet();

	    foreach($accounts as $row) {
	   		 echo $row['acc_id'].',';
		}
		session_start();
		return "|".$_SESSION['loggedinAccounts'];
	    
	}
}

