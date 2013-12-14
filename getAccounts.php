<?php
 
	include_once 'utils.php.inc';
    include_once 'database/MySQLConnection.php';
	/**
 * This is the connection string to connect to the MySQL database server
     *
 */
	$database = new Database();


	/**
 * This provides the query to be fired in
 */
	$sql = "SELECT acc_id,name FROM accounts ORDER BY id";
    $database->query($sql);
	/**
 * This is where the query in $sql variable gets executed
 */
    $accounts = $database->resultSet();

    foreach($accounts as $row) {
   		 echo $row['acc_id'].','.$row['name'].'|';
	}
	
	return true;
