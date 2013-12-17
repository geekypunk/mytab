MyTab Developer Guide
======================

*Online direct login and password manager, currently serving Cornell University*

__Website URL__: https://mytab.org

__Supported Browsers__ : Chrome version 25 and above, Mozilla Firefox version 25 and above

__Supported Devices__: Desktop/Laptop computers

Location of Deliverables
================================================


1) __Feasibility study__ - /documentDeliverables/Reports/FeasibilityStudy.pdf

2) __Requirements analysis and specification__ - /documentDeliverables/Reports/RequirementAnalysis.pdf

3) __System and program design__ - /documentDeliverables/Reports/System&ProgramDesign.pdf

4) __User interface design__ - /documentDeliverables/Reports/UI Design.pdf

5) __Test plan, test examples, and results__ - /documentDeliverables/Reports/TestPlan&Results.pdf

6) __Source code__ - /src

7) __Source code Documentation__ - /documentDeliverables/codeDocumentation/index.html. This was generated using PHPdoc 	    framework. Please refer http://www.phpdoc.org/
	
8) __License documents__ - /documentDeliverables/license

9) __System administrator guide & developer guide__ - /Developer_Guide.txt

10) __User Manual__ - /documentDeliverables/Reports/UserManual.pdf

11) __Presentations__ - /documentDeliverables/Presentations

12) __Test Cases__ - /documentDeliverables/Test Cases


To add a new 3rd party account in MyTab
==========================================

1) Add an entry in accounts table

2) Add a specific AccountRenderer if the behavior is different from default account renderer. This should have a method named same as the account with similar implementation as other account renderers. Changes will be mainly for the form URL, id and name for user name and password fields.

3) Add an image for the account with the same name as the account in resources/images folder

4) Update the following constants defined in resources/js/accounts/constants.js

	i. Add URL entry
	
	ii. Add logoutURL entry
	
	iii. Add map entry for length of the image
	
	iv. Add the account name to exceptions, if the account has issues opening in the same tab.
        
        


To provide support for different institution
==================================================
1) Create a new database with same set of tables.

2) Populate the accounts table with the supported accounts

3) Repeat the steps to add 3rd party account.

4) Update the defaultAccountRenderer field in resources/js/accounts/constants.js.


Recommended Configuration
=======================

Miminimum requirement for a system where MyTab can be installed are(minimum versions have been indicated)

1) PHP version 5.3 and above. A list of required extension can be found in  /RecommendedConfigurations/phpExtensions

2) MySQL  5.3 and above

3) Apache web server version 2.1 and above


Please look in /RecommendedConfigurations for httpd.conf setting for Apache webserver and php.ini for php configuration.

Install instructions
=======================

1) Run mytab.sql in your database server

2) Copy the src folder into the document root of your webserver.

3) Edit the config.php.inc in /src/config folder to reflect your database credentials

4) Voila!

