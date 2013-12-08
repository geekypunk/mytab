<?php
 
include 'database/MySQLConnection.php';

$username = $_GET['username'];
$accountid = $_GET['accountid'];
$database = new Database();

$sql = "SELECT user_name,AES_DECRYPT(password, 'mytab_sec_passwd') as password from user_accounts where login_user_id = :login_user_id and acc_id= :acc_id ";
$database->query($sql);
$database->bind(':login_user_id', $username );
$database->bind(':acc_id', $accountid);
$column = $database->single();
if($database->rowCount() > 0)
	echo $column['user_name'].'|'.$column['password'];
else
	echo "NotFound";
?>