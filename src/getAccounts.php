<?php
 /**
 * Retrieves all 3rd party accounts
 */
 
include_once 'useraccount/MyTabAccountImpl.php';

$AccountImpl = new MyTabAccountImpl();
echo $AccountImpl->getSupportedThirdPartyAccounts();

return true;
