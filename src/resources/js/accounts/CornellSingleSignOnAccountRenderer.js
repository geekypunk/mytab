/** Cornell Single Sign-on Account **/
function cornellsso(accountName)
{	//Create a form if not existing already
	if(document.getElementById('cornellsso_loginform') == null || document.getElementById('cornellsso_loginform') == 'undefined')
	{
		form = document.createElement("form");
		form.method = 'POST';
		form.action = 'https://web4.login.cornell.edu/loginAction?SID=202963FFC9A1F9B5&WAK0Service=http/selfservice.adminapps.cornell.edu@CIT.CORNELL.EDU&WAK2Name=&WAK0Realms=CIT.CORNELL.EDU,GUEST.CORNELL.EDU&ReturnURL=https://selfservice.adminapps.cornell.edu/psc/cuselfservice/EMPLOYEE/HRMS/c/202963FFC9A1F9B5/cuwal2.c0ntinue&VerP=2&VerC=2.2.1.201/idmbuild@fox05.serverfarm.cornell.edu/RedHat5-64bit-201/2.0.63&VerS=Apache/2.0.64%20%20Unix%20%20DAV/2%2020131013-1057&VerO=Linux%20sf-psleg-023.serverfarm.cornell.edu%202.6.18-348.3.1.el5%20%231%20SMP%20Tue%20Mar%205%2013:19:32%20EST%202013%20x86_64%20x86_64%20x86_64%20GNU/Linux%20Red%20Hat%20Enterprise%20Linux%20Server%20release%205.9%20%20Tikanga%20&Accept=K2&WANow=1381902876&WAK2Flags=0&WAreason=1 HTTP/1.1';
		form.id = "ccnet_loginform";
		form.target = 'invisible'
		var email = document.createElement("input");
		email.id = "netid";
		email.name = "netid";
		email.type = "hidden";
		var password = document.createElement("input");
		password.id = "password";
		password.name = "password";
		password.type = "hidden";
		form.appendChild(email);
		form.appendChild(password);
		document.body.appendChild(form);
	}
	
	//Submit the form
   	$.ajax({
		type: "POST",
		url: 'signup.php',
	data: {
		email : $("#email").val(),
		account: accountName,
		login: 'true'
		},
	success: function(data)
	{	
		data = data.trim();
		arr = data.split("|");
		$("#netid").val(arr[0]);
		$("#password").val(arr[1]);
		form.submit();		       		
	}
});										
}	