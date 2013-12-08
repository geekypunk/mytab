<?php


include 'database/MySQLConnection.php';
require 'security/PasswordHash.php';

$email = $_POST['username'];

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


$database = new Database();
$firstname=strtolower($_POST['firstname']);
$lastname=strtolower($_POST['lastname']);


$sql = "SELECT count(*) as user_count from user_data where first_name= :firstname and last_name= :lastname and email= :email ";
$database->query($sql);
$database->bind(':firstname', $firstname );
$database->bind(':lastname', $lastname); 
$database->bind(':email', $email );
$column = $database->single();

$newPassword = randomPassword();
$t_hasher = new PasswordHash(8, FALSE);
$encrpytPass = $t_hasher->HashPassword($newPassword);

if($column['user_count']==1){
	$sql = "UPDATE user_data set password = :newPassword where email = :email";
	$database->query($sql);
	$database->bind(':newPassword', $encrpytPass);
	$database->bind(':email', $email); 

	$database->execute();

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

	echo "success";

return true;
}
else{
echo "invalid";
return true;
}

