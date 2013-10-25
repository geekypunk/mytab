<?php
include 'config.php.inc';
include 'utils.php.inc';


$con =  getDBConnection();
$md5pass = md5($_POST['password']);
$sql = "SELECT count(*) from user_data where email='$_POST[username]' and password='$md5pass'";
//echo $sql."<br/>";
$result = mysql_query($sql,$con);
$row = mysql_fetch_array($result); 
if( $row[0] == 1 )
{
    
    $sql = "SELECT authenticated from user_data where email='$_POST[username]' and password='$md5pass'";
    //echo $sql."<br/>";
	$result = mysql_query($sql,$con);
	$row = mysql_fetch_array($result); 
	if($row[0] == 1){
		//User is now logged in
		session_start();
		$_SESSION['username'] = $_POST['username'];
		$sql = "SELECT first_name from user_data where email='$_POST[username]' and password='$md5pass'";
    	//echo $sql."<br/>";
		$result = mysql_query($sql,$con);
		$row = mysql_fetch_array($result); 
		$_SESSION['firstname'] = $row[0];
		session_write_close();
		echo "success";
		return true;
	}else{
		echo "verify";
		return true;
	}
    	
}else{
	echo "invalid";
	return true;

	header("Location: ../beta2/index.php");
}
?>