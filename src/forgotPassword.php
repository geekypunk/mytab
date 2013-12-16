<?php
/**
* Mails an random password to user
*/

include_once 'database/MySQLConnection.php';
include_once 'database/LoginDBImpl.php';
require 'security/MyTabSecurityImpl.php';

$email = $_POST['username'];
$newPassword = randomPassword();
$t_hasher = new MyTabSecurityImpl();
$encryptPass = $t_hasher->generateHash($newPassword);

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
echo $dbImpl->forgotPassword($email,$newPassword,$encryptPass);

?>