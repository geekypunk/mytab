<?php
include 'config.php.inc';
include 'utils.php.inc';


$con =  getDBConnection();
$sql = "SELECT count(*) from authentication where login_id='$_GET[login]' and access_token='$_GET[accessToken]'";
$result = mysql_query($sql,$con);
$row = mysql_fetch_array($result); 
if($row[0]==1){
	session_start();
	$_SESSION['username'] = $_GET['login'];
	$sql = "UPDATE user_data SET authenticated=1 where email='$_GET[login]' ";
	mysql_query($sql,$con);
	$sql = "SELECT first_name from user_data where email='$_GET[login]'";
    $result = mysql_query($sql,$con);
	$row = mysql_fetch_array($result); 
	$_SESSION['firstname'] = $row[0];
	session_write_close();
	header("Location: frame.html");

}else{

	header("Location: login.php");
}


?>