<?php
/**
 * Interface for handling workflows related to MyTab master account
 */
interface MyTabAccountInterface
{
	public function getAccountDetails($email);
	public function update_credentials($username,$firstName,$lastName,$encryptPass);
	public function getSupportedThirdPartyAccounts();
}