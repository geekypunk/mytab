<?php

include_once 'database/MySQLConnection.php';
include_once 'accounts/AccountsImpl.php';

session_start();

$newUsername = $_POST['new_username'];
$newPassword = $_POST['new_password'];
$username = $_POST['username'];
$accId = $_POST['accountid'];

$accountsImpl = new AccountsImpl();
echo $accountsImpl->update($newUsername,$newPassword,$username,$accId);

