<?php
/**
 * Interface for basic workflow involving MyTab account management
 */
interface LoginDBInterface
{
	public function register($email, $firstName, $lastName, $encryptPass);
	public function verify($email);
	public function authorize($username,$password,$t_hasher);
	public function forgotPassword($email,$newPassword,$encrpytPass);
	public function checklogin($username);
}
?>