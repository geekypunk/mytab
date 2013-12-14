<?php
 

session_start();
include_once 'database/MySQLConnection.php';
include_once 'security/PasswordHash.php';
include_once 'useraccount/MyTabAccountImpl.php';

$currentTime = time();
$t_hasher = new PasswordHash(8, FALSE);
$encryptPass = $t_hasher->HashPassword(trim($_POST['password']));

$username = $_POST['username'];
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];

$accountImpl = new MyTabAccountImpl();
echo $accountImpl->update_credentials($username,$firstName,$lastName,$encryptPass);
