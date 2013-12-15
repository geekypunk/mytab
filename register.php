<!-- Handles registration -->
<?php
 
	include_once 'utils.php.inc';
	include_once 'database/LoginDBImpl.php';
	include_once 'security/PasswordHash.php';

	$email = $_POST['email'];
	$firstName = $_POST['firstname'];
	$lastName = $_POST['lastname'];	
	$t_hasher = new PasswordHash(8, FALSE);
	$encrpytPass = $t_hasher->HashPassword(trim($_POST['password']));
	
	$dbImpl = new LoginDBImpl();
	echo $dbImpl->register($email, $firstName, $lastName, $encryptPass);

