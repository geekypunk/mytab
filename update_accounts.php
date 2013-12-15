<!-- Update 3rd party account credentials -->
<?php

include_once 'database/MySQLConnection.php';
include_once 'accounts/AccountsImpl.php';

$email = $_POST['email'];

$accountsImpl = new AccountsImpl();
echo $accountsImpl->update_accounts($email);



	


