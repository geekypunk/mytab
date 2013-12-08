<?php

include 'database/MySQLConnection.php';


$md5pass = md5($_POST['password']);
$username = $_POST['username'];
$database = new Database();
$sql = "SELECT count(*) as user_count,authenticated as authBit from user_data where email= :email and password=:password";


$database->query($sql);
$database->bind(':email', $username );
$database->bind(':password', $md5pass);
$column = $database->single();
//echo $column['user_count']."\n";
//echo "authBit ".$column['authBit']."\n";
if ($column['user_count'] == 1)
{

	if ($column['authBit'] == 1)
	{

		//User is now logged in
		session_start();
		$_SESSION['username'] = $_POST['username'];
		$sql = "SELECT first_name from user_data where email= :email and password=:password";
		$database->query($sql);
		$database->bind(':email', $username );
		$database->bind(':password', $md5pass);
		$column = $database->single();

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

