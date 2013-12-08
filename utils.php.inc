<?php

function generateAccessTokenLink($id,$accessToken){


	$url = "https://www.mytab.org/"."verify.php?login=$id&accessToken=".$accessToken;
	return $url;

}
