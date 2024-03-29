/** CCNet Account **/
function ccnet()
{		
	//Create a form if not existing already
	if(document.getElementById('ccnet_loginform') == null || document.getElementById('ccnet_loginform') == 'undefined')
	{
		form = document.createElement("form");
		form.method = 'POST';
		form.action = 'https://cornell-students.experience.com/experience/login';
		form.id = "ccnet_loginform";
		form.target = 'invisible'
		var email = document.createElement("input");
		email.id = "username";
		email.name = "username";
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
		account: "ccnet",
		login: 'true'
		},
	success: function(data)
	{				
		data = data.trim();
		arr = data.split("|");
		$("#username").val(arr[0]);
		$("#password").val(arr[1]);
		form.submit();		       		
	}
});										
}	