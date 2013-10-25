<?php
	session_start();
	session_destroy();
	header("Location: ../beta2/index.php");
?>