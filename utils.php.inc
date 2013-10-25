<?php

function getDBConnection(){
	
	$con = mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	if($con == FALSE)
	{
	    echo 'Cannot connect to database' . mysql_error();
	}
	else
	{
	   
	}
	mysql_select_db(DB_DATABASE, $con);
	return $con;

}

function executeSQL($sql,$con){

	
	if (!mysql_query($sql, $con))
	{
    	die('Error: ' . mysql_error());
	}

}
function generateRandomAccessToken(){

	$token = md5(uniqid(mt_rand(), true));
	return $token;

}
function generateAccessTokenLink($id,$accessToken){


	$url = URL."verify.php?login=$id&accessToken=".$accessToken;
	return $url;

}
?>