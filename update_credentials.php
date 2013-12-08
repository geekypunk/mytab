<?php
 

session_start();
include 'database/MySQLConnection.php';
include 'security/PasswordHash.php';
$currentTime = time();
$t_hasher = new PasswordHash(8, FALSE);
$encrpytPass = $t_hasher->HashPassword(trim($_POST['password']));

$username = $_POST['username'];
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$db = new Database();

$sql = "SELECT count(*) as count from user_data where email= :email";
$db->query($sql);
$db->bind(':email',$username);
$db->execute();
$column = $db->single();

if($column['count']==1){
	/* Reset the firstname in session variable*/
	$_SESSION['firstname'] = $_POST['firstname'];
	$sql = "UPDATE user_data SET first_name= :firstname , last_name= :lastname , password= :encrpytPass where email = :username";
    $db->query($sql);
    $db->bind(':username',$username);
    $db->bind(':firstname',$firstname);
    $db->bind(':lastname',$lastname);
    $db->bind(':encrpytPass',$encrpytPass);
    $db->execute();


	/*Send main account updation email*/
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
	
	echo "success";
	return true;
}
else{
    echo "notexists";
    return true;
}

