<?php

include 'database/MySQLConnection.php';
session_start();

$currentTime = time();
$newUsername = $_POST['new_username'];
$newPassword = $_POST['new_password'];
$username = $_POST['username'];
$accId = $_POST['accountid'];
$db = new Database();

$sql = "UPDATE user_accounts SET user_name= :newUsername , password = AES_ENCRYPT(':newPassword', 'mytab_sec_passwd') where login_user_id = :username and acc_id= :accId";

try{
    $db->query($sql);
    $db->bind(':newUsername',$newUsername);
    $db->bind(':username',$username);
    $db->bind(':newPassword',$newPassword);
    $db->bind(':accId',$accId);
    $db->execute();
	
	
/*Send account updation email*/
	$to      = $username;
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
	
	echo "success";
	return true;
}
catch(Exception $e)
{
    echo 'Error : '.$e->getMessage();
	return true;
}




?>