<?php
include 'config.php.inc';
include 'utils.php.inc';


$currentTime = time();
$encrpytPass = md5(trim($_POST['password']));
$con = getDBConnection();

$sql = "SELECT count(*) from user_data where email='$_POST[email]'";
$result = mysql_query($sql,$con);
$row = mysql_fetch_array($result); 
if($row[0]==1){
	echo "userexists";
	exit();
}else{
	
	$sql="INSERT INTO user_data VALUES ('$_POST[email]','$_POST[email]','$_POST[firstname]','$_POST[lastname]','$encrpytPass',0,$currentTime,$currentTime) ";
	
	executeSQL($sql,$con);

	$accessToken = generateRandomAccessToken();
	$accessTokenUrl = generateAccessTokenLink($_POST['email'],$accessToken);
	$sql="INSERT INTO authentication VALUES ('$_POST[email]','$accessToken') ";
	
	executeSQL($sql,$con);

	$to      = $_POST['email'];
	$subject = 'Verify your account!';
	$message = 'Click this link to verify you account '.$accessTokenUrl;
	$headers = 'From: localhost' . "\r\n" .
	    'Reply-To: localhost' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message,$headers);

	echo "success";
}
mysql_close($con);
?>