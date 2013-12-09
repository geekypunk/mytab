<?php

include 'database/MySQLConnection.php';
include 'security/PasswordHash.php';

$password = trim($_POST['password']);
$t_hasher = new PasswordHash(8, FALSE);
$encrpytPass = $t_hasher->HashPassword(trim($_POST['password']));

$username = $_POST['username'];
$database = new Database();
$sql = "SELECT first_name,authenticated as authBit,password from user_data where email= :email";


$database->query($sql);
$database->bind(':email', $username );
//$database->bind(':password', $encrpytPass);
$column = $database->single();

if ($t_hasher->CheckPassword($password , $column['password']))
{

	if ($column['authBit'])
	{
		//User is now logged in
		session_start();
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['firstname'] = $column['first_name'];
		session_write_close();
		echo "success";
		return true;
	}
  else
  {
    echo "verify";
    return true;
  }

}

else
{
  echo"invalid";
  return true;

  header("Location: index.php");
}

