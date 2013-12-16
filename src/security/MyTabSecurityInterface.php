<?php
/**
 * This interface abstracts out the hashing scheme used by MyTab
 */
interface MyTabSecurityInterface
{
    public function generateHash($password);
    public function checkHash($password, $stored_hash);
}