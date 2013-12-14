<?php

include_once 'database/MySQLConnection.php';
include_once 'database/LoginDBImpl.php';

$email = $_GET['login'];

$dbImpl = new LoginDBImpl();
echo $dbImpl->verify($email);


