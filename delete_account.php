<?php
/**
* Delete 3rd party account added by the user
*/

include_once 'database/MySQLConnection.php';
include_once 'accounts/AccountsImpl.php';

session_start();

$currentTime = time();
$username = $_POST['username'];
$accId = $_POST['accountid'];

$accountsImpl = new AccountsImpl();
echo $accountsImpl->delete_account($username,$accId);
