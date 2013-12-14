<?php

include_once 'database/MySQLConnection.php';
include_once 'accounts/AccountsImpl.php';

session_start();
$currentTime = time();
$accountsImpl = new AccountsImpl();
if(isset($_POST['login']) && $_POST['login'] === 'true'){
    $accId = $_POST['account'];
    $email = $_POST['email'];
    echo $accountsImpl->login($accId,$email);
}else{
    $accId = $_POST['account'];
    $email = $_POST['email'];
    $newUsername = $_POST['signup_username'];
    echo $accountsImpl->signup($accId,$email,$newUsername);
}



	
