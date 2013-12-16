--Utility file to delete a user
delete from authentication where login_id='xyz@gmail.com';
delete from user_accounts where login_user_id='xyz@gmail.com';
delete from user_data where login_user_id='xyz@gmail.com';
