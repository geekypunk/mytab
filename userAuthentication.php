<?php

include_once 'security/PasswordHash.php';
include_once 'database/LoginDBImpl.php';

$password = trim($_POST['password']);
$t_hasher = new PasswordHash(8, FALSE);
$encryptPass = $t_hasher->HashPassword(trim($_POST['password']));

$username = $_POST['username'];
$dbImpl = new LoginDBImpl();
echo $dbImpl->authorize($username,$password,$t_hasher);


