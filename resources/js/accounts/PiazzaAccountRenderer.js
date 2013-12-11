/** Piazza Account **/
function piazza()
{		
	//Create a form if not existing already
	if(document.getElementById('piazza_loginform') == null || document.getElementById('piazza_loginform') == 'undefined')
	{
		form = document.createElement("form");
		form.method = 'POST';
		form.action = 'https://piazza.com/class';
		form.id = "piazza_loginform";
		form.target = 'invisible'
		var email = document.createElement("input");
		email.id = "email_field";
		email.name = "email";
		email.type = "hidden";
		var password = document.createElement("input");
		password.id = "password_field";
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
		account: "piazza",
		login: 'true'
		},
	success: function(data)
	{				
		arr = data.split("|");
		$("#email_field").val(arr[0]);
		$("#password_field").val(arr[1]);
		$("#piazza_loginform").submit();		       		
	}
	});										
}	