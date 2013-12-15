<?php
/**
 * This is the code that logs user out of mytab
 */
 
	session_start();
	session_destroy();
	header("Location: index.php");
?>
