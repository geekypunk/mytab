<?php
 
include 'utils.php.inc';
include 'database/MySQLConnection.php';
include 'security/PasswordHash.php';

$email = $_POST['email'];
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$currentTime = time();
$t_hasher = new PasswordHash(8, FALSE);
$encrpytPass = $t_hasher->HashPassword(trim($_POST['password']));

$db = new Database();

$sql = "SELECT count(*) as user_count from user_data where email= :email";
$db->query($sql);
$db->bind(':email',$email);
$db->execute();
$column = $db->single();
if($column['user_count']==1){
	echo "userexists";
	exit();
}else{
	
	$sql="INSERT INTO user_data VALUES ( :email , :email2 , :firstname , :lastname , :encrpytPass ,0,$currentTime,$currentTime) ";
    $db->query($sql);
    $db->bind(':email',$email);
    $db->bind(':email2',$email);
    $db->bind(':firstname',$firstName);
    $db->bind(':lastname',$lastName);
    $db->bind(':encrpytPass',$encrpytPass) ;

    $db->execute();

	$accessToken = md5(uniqid($email, true));
	$accessTokenUrl = generateAccessTokenLink($_POST['email'],$accessToken);
	$sql="INSERT INTO authentication VALUES ( :email, :accessToken) ";
    $db->query($sql);
    $db->bind(':email',$email);
    $db->bind(':accessToken',$accessToken);
	$db->execute();

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

	echo "success";
}

?>