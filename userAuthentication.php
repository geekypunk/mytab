<?php
/**
* <!-- Authenticate user -->
*/

include_once 'security/MyTabSecurityImpl.php';
require_once 'database/LoginDBImpl.php';

$password = trim($_POST['password']);
$t_hasher = new MyTabSecurityImpl();
$username = $_POST['username'];
$dbImpl = new LoginDBImpl();
echo $dbImpl->authorize($username,$password,$t_hasher);

?>


