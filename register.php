<?php
 /**
 * Handles registration
 */
 
include_once 'utils.php.inc';
include_once 'database/LoginDBImpl.php';
include_once 'security/MyTabSecurityImpl.php';

$email = $_POST['email'];
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];	
$t_hasher = new MyTabSecurityImpl();
$encrpytPass = $t_hasher->generateHash(trim($_POST['password']));

$dbImpl = new LoginDBImpl();
echo $dbImpl->register($email, $firstName, $lastName, $encrpytPass);

?>