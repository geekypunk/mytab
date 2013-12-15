<!-- Mails an random password to user -->
<?php


include_once 'database/MySQLConnection.php';
include_once 'database/LoginDBImpl.php';
require 'security/PasswordHash.php';

$email = $_POST['username'];
$firstname=strtolower($_POST['firstname']);
$lastname=strtolower($_POST['lastname']);
$newPassword = randomPassword();
$t_hasher = new PasswordHash(8, FALSE);
$encryptPass = $t_hasher->HashPassword($newPassword);

/**
 * function to generate a random password
 * @return string 
 */

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    
	$pass = array(); 
    $alphaLength = strlen($alphabet) - 1; 
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

$dbImpl = new LoginDBImpl();
echo $dbImpl->forgotPassword($email,$firstname,$lastname,$newPassword,$encryptPass);

