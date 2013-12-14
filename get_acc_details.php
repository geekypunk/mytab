<?php
 
include_once 'database/MySQLConnection.php';
include_once 'accounts/AccountsImpl.php';

$username = $_GET['username'];

$accountid = $_GET['accountid'];

$accountsImpl = new AccountsImpl();
echo $accountsImpl->get_acc_details($username,$accountid);



