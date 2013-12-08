<?php
function IsNullOrEmptyString($question){
    return (!isset($question) || trim($question)==='');
}
session_start();
$accountName = $_POST['account'];

if ( !IsNullOrEmptyString($accountName) && strpos($_SESSION['loggedinAccounts'], $accountName) === FALSE)
{
		if($_SESSION['loggedinAccounts'] === '')
		{
			$_SESSION['loggedinAccounts'] = $accountName;
		}
		else
		{
			$_SESSION['loggedinAccounts'] = $_SESSION['loggedinAccounts'].",".$accountName;
		}
	
}
else
{
	if( isset($_POST['delete']) )
	{				
		$_SESSION['loggedinAccounts'] = str_replace($accountName.",", '', $_SESSION['loggedinAccounts']);
		$_SESSION['loggedinAccounts'] = str_replace($accountName, '', $_SESSION['loggedinAccounts']);
	}
}
echo $_SESSION['loggedinAccounts'];
					
?>