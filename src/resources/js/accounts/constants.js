/** Co-ordinates for hexagonal layout **/
var coordinates={};
//coordinates=[400,50, 650,50, 300,250, 750,225,400,450, 650,450];
coordinates['blackboard'] = '400,450';
coordinates['ccnet'] = '650,50';
coordinates['cms'] = '400,50';
coordinates['piazza'] = '300,250';
coordinates['studentcenter'] = '650,450';
coordinates['gannett'] = '750,225';

/** X-Pos for close image. Varies based on the length of the image **/
var map = {};
map['blackboard'] = 213;
map['ccnet'] = 168;
map['cms'] = 212;
map['piazza'] = 218;
map['studentcenter'] = 206;
map['gannett'] = 178;

/** Default Account renderer used, if a specific one is not found **/
var defaultAccountRenderer = 'cornellsso';

/** Accounts which cannot be opened in the same frame on logging in **/
var accountExceptions = ['blackboard'];

/** URLs for the accounts **/
var urls = {};
urls["piazza"] = "https://piazza.com/class";
urls["cms"] = "https://cms.csuglab.cornell.edu/web/auth/?action=loginview";
urls["studentcenter"] = "http://studentcenter.cornell.edu";
urls["home"]= "main.php";
urls["gannett"] = "https://mygannett.gannett.cornell.edu";
urls["blackboard"] = "https://blackboard.cornell.edu/webapps/portal/execute/tabs/tabAction?tab_tab_group_id=_1_1";
urls["ccnet"] = "https://cornell-students.experience.com/stu/home";
urls["settings"] = "dialog.php";

/** Logout URLs for individual accounts **/
var logoutUrls = {};
logoutUrls["piazza"] = "https://piazza.com/logout";
logoutUrls["cms"] = "https://cms.csuglab.cornell.edu/web/auth/?action=signout";
logoutUrls["studentcenter"] = "https://cms.csuglab.cornell.edu/web/auth/?action=signout";
logoutUrls["gannett"] = "https://mygannett.gannett.cornell.edu/mygannett/Local/cust_logout.html";
logoutUrls["blackboard"] = "https://blackboard.cornell.edu/webapps/login/?action=logout";
logoutUrls["ccnet"] = "https://cornell-students.experience.com/er/security/logout.jsp";
