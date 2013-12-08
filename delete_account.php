<?php
 
include 'database/MySQLConnection.php';
session_start();

$currentTime = time();
$username = $_POST['username'];
$accId = $_POST['accountid'];
$database = new Database();


$sql = "Delete from user_accounts where login_user_id= :username and acc_id= :accId ";
$database->query($sql);
$database->bind(':username', $username );
$database->bind(':accId', $accId );
$database->execute();


/*Send account deletion email*/
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
	
echo "success";
return true;


?>