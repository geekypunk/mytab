<?php
 
include 'database/MySQLConnection.php';

$username = $_POST['username'];
$database = new Database();
$sql = "SELECT count(*) as user_count from user_data where email= :email";
$database->query($sql);
$database->bind(':email', $username );
$column = $database->single();

if($column['user_count']==1){
	echo "exists";
	return true;
}
else{
	echo "notexists";
	return true;
}

?>