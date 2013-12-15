/** This is a developer's guide. DO NOT DELETE **/

To add a new 3rd party account in MyTab
---------------------------------------
1) Add an entry in accounts table
2) Add a specific AccountRenderer if the behavior is different from default account renderer. This should have a method named same as the account with similar implementation as other account renderers. Changes will be mainly for the form URL, id and name for user name and password fields.
3) Add an image for the account with the same name as the account in resources/images folder
4) Update the following constants defined in resources/js/accounts/constants.js
	i. Add URL entry
	ii. Add logoutURL entry
        iii. Add map entry for length of the image
        iv. Add the account name to exceptions, if the account has issues opening in the same tab.
------------------------------------------------------------------------------------------------------

To provide support for different institution
-------------------------------------------
1) Create a new database with same set of tables.
2) Populate the accounts table with the supported accounts
3) Repeat the steps to add 3rd party account.
4) Update the defaultAccountRenderer field in resources/js/accounts/constants.js.
