<?php

include 'database/MySQLConnection.php';

session_start();
$currentTime = time();
$db = new Database();

$accId = $_POST['account'];
$email = $_POST['email'];
$newUsername = $_POST['signup_username'];
if(isset($_POST['login']) && $_POST['login'] === 'true')
{
	$sql = "SELECT user_name, password, AES_DECRYPT(password, 'mytab_sec_passwd') AS passwd from user_accounts where login_user_id= :email and acc_id= :accId";
    $db->query($sql);
    $db->bind(':email',$email);
    $db->bind(':accId',$accId);
    $db->execute();
   	$column = $db->single();
	echo $column['user_name']."|".$column['passwd'];
    return true;     

}

	
	
	$sql="INSERT INTO user_accounts(acc_id,login_user_id,user_name,password,account_added_time) VALUES ( :accId, :email, :newUsername,AES_ENCRYPT('$_POST[signup_password]', 'mytab_sec_passwd'),now());";

    $db->query($sql);
    $db->bind(':email',$email);
    $db->bind(':accId',$accId);
    $db->bind(':newUsername',$newUsername);
    $db->execute();;
	
	
	/*Send account addition email*/
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
	
	echo "success: ".$_POST['email'];
	return true;



?>