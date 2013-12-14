<?php
 
include_once 'database/MySQLConnection.php';

$username = $_POST['username'];
$dbImpl = new LoginDBImpl();
echo $dbImpl->checklogin($username);


