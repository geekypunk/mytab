<?php
 
	include 'utils.php.inc';

	$db = new PDO('mysql:host=localhost;dbname=mytab', 'root', '');

	$sql = "SELECT acc_id,name FROM accounts ORDER BY id";
	$stmt = $db->query($sql); 

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
   		 echo $row['acc_id'].','.$row['name'].'|';
	}
	
	return true;
?>