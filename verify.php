<?php

include 'database/MySQLConnection.php';

$email = $_GET['login'];
$database = new Database();
$sql = "SELECT count(*) as user_count from user_data where email= :email";
$database->query($sql);
$database->bind(':email',$email);
$database->execute();
$column =$database->single();

if($column['user_count']==1){
	session_start();
	$_SESSION['username'] = $email;
	$sql = "UPDATE user_data SET authenticated=1 where email= :email ";
    $database->query($sql);
    $database->bind(':email',$email);
    $database->execute();
	$sql = "SELECT first_name from user_data where email= :email";
    $database->query($sql);
    $database->bind(':email',$email);
    $database->execute();
    $column = $database->single();
	$_SESSION['firstname'] = $column['first_name'];
	session_write_close();
	header("Location: frame.html");

}
else{

	header("Location: index.php");
}

