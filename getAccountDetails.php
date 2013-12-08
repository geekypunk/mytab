<?php
 
include 'database/MySQLConnection.php';
$email = $_POST['email'];
$db = new Database();

	$sql = "SELECT first_name,last_name from user_data where email= :email";
    $db->query($sql);
    $database->bind(':email', $email );
    $db->execute();
	$column = $db->single();
	echo $email."|".$column['first_name']."|".$column['last_name'] ;
	return true;

