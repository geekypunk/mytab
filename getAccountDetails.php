<!-- Retrieves MyTab account details -->
<?php
 
include_once 'database/MySQLConnection.php';
include_once 'useraccount/MyTabAccountImpl.php';


$email = $_POST['email'];

$AccountImpl = new MyTabAccountImpl();
echo $AccountImpl->getAccountDetails($email);
