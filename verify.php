<?php
/**
* Verify the user's email id entered upon registration by generating a mail
*/

include_once 'database/MySQLConnection.php';
include_once 'database/LoginDBImpl.php';

$email = $_GET['login'];

$dbImpl = new LoginDBImpl();
echo $dbImpl->verify($email);


