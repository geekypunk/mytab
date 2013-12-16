MyTab Developer Guide
======================

Online direct login and password manager, currently serving Cornell University

Website URL: https://mytab.org

Supported Browsers : Chrome, Mozilla Firefox

Supported Devices: Desktop/Laptop computers

Please find the locations of final deliverables
================================================


1) A feasibility study - /documentDeliverables/Reports/FeasibilityStudy.pdf

2) Requirements analysis and specification - /documentDeliverables/Reports/RequirementAnalysis.pdf

3) System and program design - /documentDeliverables/Reports/System&ProgramDesign.pdf

4) User interface design - /documentDeliverables/Reports/UI Design.pdf

5) Test plan, test examples, and results - /documentDeliverables/Reports/TestPlan&Results.pdf

6) Source code - /src

7) Source code Documentation - /documentDeliverables/codeDocumentation/index.html

8) License document - /documentDeliverables/license

9) System administrator guide & developer guide - /Developer_Guide.txt

10) A short report summarizing the final presentation - /documentDeliverables/Reports/ShortReport-Final presentation.pdf



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

1) PHP >5.3

2) MySQL > 5.3

3) Apache web server > 2.1


Please look in /RecommendedConfigurations for httpd.conf setting for Apache webserver and php.ini for php configuration.

Install instructions
=======================

1) Run mytab.sql in your database server

2) Copy the src folder into the document root of your webserver.

3) Edit the config.php.inc in /src/config folder to reflect your database credentials

4) Voila!

