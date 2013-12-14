<?php


include_once 'MySQLConnection.php';
include_once 'LoginDBInterface.php';

/**
 * This class implements methods to handle various  workflows related to the management of MyTab account
 * The workflows are  registering, logging in, forget password workflow and user verification worlflow
 *
 */
class LoginDBImpl implements LoginDBInterface{
    
    /**
	* constructor to create the database object
	* @return void
    */

    private $database;
	public function __construct()
	{
	
		$this->database = new Database();
		
	}
	
	/**
	* register function for the form	
	* @param string $email email-id of the user
	* @param string $firstName first-name of the user
	* @param string $lastName last-name of the user
	* @param mixed $encryptPass encrypted password
	* @return string
	* 	
	*/
	public function register($email, $firstName, $lastName, $encryptPass)
	{
		
		$sql = "SELECT count(*) as user_count from user_data where email= :email";
        $this->database->query($sql);
        $this->database->bind(':email',$email);
        $this->database->execute();
		$column = $this->database->single();
		if($column['user_count']==1){
			return "userexists";
		}
		else{
		
	    $sql="INSERT INTO user_data VALUES ( :email , :email2 , :firstname , :lastname , :encryptPass ,0,time(),time()) ";
            $this->database->query($sql);
            $this->database->bind(':email',$email);
            $this->database->bind(':email2',$email);
            $this->database->bind(':firstname',$firstName);
            $this->database->bind(':lastname',$lastName);
            $this->database->bind(':encryptPass',$encryptPass) ;

            $this->database->execute();

			$accessToken = md5(uniqid($email, true));
			$accessTokenUrl = generateAccessTokenLink($_POST['email'],$accessToken);
			$sql="INSERT INTO authentication VALUES ( :email, :accessToken) ";
            $this->database->query($sql);
            $this->database->bind(':email',$email);
            $this->database->bind(':accessToken',$accessToken);
            $this->database->execute();
			
			$to      = $email;
			$email_from = "admin@www.mytab.org";
			$full_name = 'MyTab Customer Service';
			$from_mail = $full_name.'<'.$email_from.'>';
			$from = $from_mail;
			$subject = 'Verify your account!';
			$message = '<html>
						<body>
						<img src="https://www.mytab.org/resources/images/newLogoEmail.jpg"/>
							<h3>Hi '.$firstName.' and welcome to MyTab</h3>
							<div> <a href="'.$accessTokenUrl.'">Click this</a> link to verify your account. </div>
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
		

	}
	
	/**
	* check login function for logging into MyTab account
	* @param string $username user-name 
	* @return string
	* 	
	*/
	public function checklogin($username)
	{
		$sql = "SELECT count(*) as user_count from user_data where email= :email";
        $this->database->query($sql);
        $this->database->bind(':email', $username );
		$column = $this->database->single();

		if($column['user_count']==1){
			return "exists";
		}
		else{
			return "notexists";
		}
	}

	/**
	* authorize function for the form	
	* @param string $username user-name
	* @param string $password user-password
	* @param PasswordHash $t_hasher hash-function for the password
	* @return string
	* 	
	*/
	public function authorize($username,$password,$t_hasher)
	{
		$sql = "SELECT first_name,authenticated as authBit,password from user_data where email= :email";


        $this->database->query($sql);
        $this->database->bind(':email', $username );
		//$database->bind(':password', $encryptPass);
		$column = $this->database->single();

		if ($t_hasher->CheckPassword($password , $column['password']))
		{
			if ($column['authBit'])
			{
				//User is now logged in
				session_start();
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['firstname'] = $column['first_name'];
				session_write_close();
				return "success";
			}
		    
		    else
		    {
		    return "verify";
		    }

		}

		else
		{
		  header("Location: index.php");
		  return "invalid";
		}

	}

	/**
	* forget-password function for the form	
	* @param string $email email-id of the user
	* @param string $firstname first name of the user
	* @param string $lastname last name of the user
	* @param string $newPassword new password to be used
	* @param string $encryptPass encrypted password
	* @return string
	* 	
	*/
	public function forgotPassword($email,$firstname,$lastname,$newPassword,$encryptPass)
	{
		$sql = "SELECT count(*) as user_count from user_data where first_name= :firstname and last_name= :lastname and email= :email ";
        $this->database->query($sql);
        $this->database->bind(':firstname', $firstname );
        $this->database->bind(':lastname', $lastname);
        $this->database->bind(':email', $email );
		$column = $this->database->single();

		if($column['user_count']==1){
			$sql = "UPDATE user_data set password = :newPassword where email = :email";
            $this->database->query($sql);
            $this->database->bind(':newPassword', $encryptPass);
            $this->database->bind(':email', $email);

            $this->database->execute();

			/*Send password change email*/	
			$to      = $email;
			$email_from = "admin@www.mytab.org";
		    $full_name = 'MyTab Customer Service';
		    $from_mail = $full_name.'<'.$email_from.'>';
			$from = $from_mail;
			$subject = 'MyTab - New Password Request';
			$message = 'Your new password for the id '.$email.' is '.$newPassword;
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
		return "invalid";
		
		}

	}

	/**
	* verification function for the form	
	* @param string $email email-id of the user
	* @return string
	* 	
	*/
	public function verify($email)
	{
		$sql = "SELECT count(*) as user_count from user_data where email= :email";
        $this->database->query($sql);
        $this->database->bind(':email',$email);
        $this->database->execute();
		$column =$this->database->single();

		if($column['user_count']==1){
			session_start();
			$_SESSION['username'] = $email;
			$sql = "UPDATE user_data SET authenticated=1 where email= :email ";
            $this->database->query($sql);
            $this->database->bind(':email',$email);
            $this->database->execute();
			$sql = "SELECT first_name from user_data where email= :email";
            $this->database->query($sql);
            $this->database->bind(':email',$email);
            $this->database->execute();
		    $column = $this->database->single();
			$_SESSION['firstname'] = $column['first_name'];
			session_write_close();
			header("Location: frame.html");

		}
		else{

			header("Location: index.php");
		}
		return "";
	}
	
}




