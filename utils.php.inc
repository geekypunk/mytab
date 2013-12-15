<!-- Utility methods -->
<?php

/**
 * function to link the generated access token to the url
 * @param string $id user-id
 * @param string $accessToken access-token
 * @return string  
 */
function generateAccessTokenLink($id,$accessToken){
	$url = "https://www.mytab.org/"."verify.php?login=$id&accessToken=".$accessToken;
	return $url;
}
