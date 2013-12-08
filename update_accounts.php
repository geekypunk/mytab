<?php

include 'database/MySQLConnection.php';


$currentTime = time();
$email = $_POST['email'];
$db = new Database();



	$sql = "SELECT acc_id from user_accounts where login_user_id= :email";
    $db->query($sql);
    $db->bind(':email',$email);
    $db->execute();
    $accounts = $db->resultSet();

    foreach($accounts as $row) {
   		 echo $row['acc_id'].',';
	}
	session_start();
	echo "|".$_SESSION['loggedinAccounts'];
	return true;    


