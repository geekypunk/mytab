<?php
/**
 * Interface for Third party account handling integrated in MyTab Account
 */
interface AccountsInterface
{
	public function delete_account($username,$accId);
	public function get_acc_details($username,$accountid);
	public function signup($accId,$email,$newUsername);
	public function update($newUsername,$newPassword,$username,$accId);
	public function update_accounts($email);
}


