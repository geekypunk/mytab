//Enable for debugging
/** All JS functions related to login and registration **/

var debugFlag = false;

/** Font settings **/
Cufon.set('fontSize', '17px').replace('#forgotPass,.formtitle,.login_inputtext,.inputtext');
Cufon.set('fontSize', '15px').replace('.tocCheckbox');
Cufon.set('fontSize', '17px').replace('#footer');

$(document).ready(function() {
	/** Clear labels in form **/
	var name = $( "#firstname" ),
	email = $( "#userid" ),
	lastname = $( "#lastname" ),
	allFields = $( [] ).add( name ).add( email ).add( lastname );
	$( "#dialog-form" ).dialog({
		autoOpen: false,
		height: 220,
		width: 450,
		modal: true,
		buttons: {
			"Submit": function() {
			$('#forgotForm').submit(); 
			},
			Cancel: function() {
			$( this ).closest('.ui-dialog-content').dialog( "close" );
			}
		},
		close: function() {
			$("label[for='firstname']").remove();
			$("label[for='lastname']").remove();
			$("label[for='userid']").remove();
			$("#firstname").val("");
			$("#lastname").val("");
			$("#userid").val("");
		}
	});

	/** Forgot password form validation and submission **/
	$("#forgotForm").validate({
		rules: {
			userid:{required: true, email: true    }
			//firstname: { required: true    },
			//lastname: { required: true     },
					   
		},
		messages: {
			userid: { required: "Please enter your username.", email : "Username should be of form me@ex.com." },
			//firstname: "Please enter your firstname.",
			//lastname: "Please enter your lastname."
		},
		submitHandler: function() {
			var request = $.ajax({
				url: "forgotPassword.php",
				type: "POST",
				data: {
					//firstname: $("#firstname").val(),
					username: $("#userid").val()
					//lastname: $("#lastname").val()
				
				},
				dataType: "html"
			});
			request.done(function( data ) {
				data = data.trim();
				if(debugFlag)
					alert(data);
				if (data === 'success') {			
					$("#dialog-content").text("An email with new password is sent to your mail id.");
					$( "#message" ).dialog( "open" );
					$( "#message" ).dialog('option', 'title', 'Reset Password' );
					$("#dialog-form").closest('.ui-dialog-content').dialog('close');
				}
				else if (data === 'invalid'){
					$("#dialog-content").text("The credentials are not valid. Please try again with valid credentials.");
					$( "#message" ).dialog( "open" );
					$( "#message" ).dialog('option', 'title', 'Invalid Credentials' );
					$("#dialog-form").closest('.ui-dialog-content').dialog('close');
				}
				  else{
					alert("error in php code");
				}
			});
			request.fail(function( jqXHR, textStatus ) {
				alert( "Request failed: " + textStatus + jqXHR.responseText);
			});
		}
	});

	/** Dialog to show messages **/
	$( "#message" ).dialog({
				modal: true,
				autoOpen: false,
				height: 200,
				width: 450,
				buttons: {
					Ok: function() {
						$( this ).dialog( "close" );
					}
				}
	});

	/** Register form validation and submission **/
	$("#registerForm").validate({
		rules: {
			registerfirstname: { required: true    },
			registerlastname: { required: true     },
			registeremail: { required: true ,email: true     },
			registerpassword: {    required: true, pwcheck: true, minlength: 6, maxlength : 20 }			   
		},
		messages: {
			registerfirstname: "Please enter your firstname.",
			registerlastname: "Please enter your lastname.",
			registeremail: "Please enter your email.",
			registerpassword: {required: "Please enter your password." ,
			pwcheck:"must contain at least 1digit. ",
			minlength: "Length must be at least 6 characters",
			maxlength: "Max length allowed is 20 characters"}
		},
		submitHandler: function() {
			var request = $.ajax({
				url: "register.php",
				type: "POST",
				data: {
				
					//Encode user input to prevent Cross-site attack
					email: encodeURI($("#registeremail").val()),
					password: encodeURI($("#registerpassword").val()),
					firstname: encodeURI($("#registerfirstname").val()),
					lastname: encodeURI($("#registerlastname").val())
				
				},
				dataType: "html"
			});
			request.done(function( data ) {
				data = data.trim();
				if(debugFlag)
					alert(data);
				if (data === 'success') {
					$("#dialog-content").text("Almost done! Check your email for email verification link.");
					$( "#message" ).dialog( "open" );
					$( "#message" ).dialog('option', 'title', 'Registered Successfully' );
					
				}
				else if(data==='userexists'){
					$("#dialog-content").text("User already exists!");
					$( "#message" ).dialog( "open" );
					$( "#message" ).dialog('option', 'title', 'Registerion Error' );
				}
				else{
				  alert(data);
				}
			});
			request.fail(function( jqXHR, textStatus ) {
				alert( "Request failed: " + textStatus );
			});
		}
	});

	/** Validation for password **/
	$.validator.addMethod("pwcheck", function(value) {
		return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these 
			&& /\d/.test(value) // has a digit
	});

	/** Login form submission and validation **/
	$("#loginForm").validate({
		rules: {
			username: { required: true , email:true   },
			password: { required: true     }
			},
		messages: {
			username: {required: "Please enter username.", email: "invalid email id."},
			password: "Please enter password."
			},
		submitHandler: function() {
			$.ajax({
			   type: "POST",
			   url: 'userAuthentication.php',
			   data: {
			   
					//Encode to prevent XSS attack
					username: encodeURI($("#username").val()),
					password: encodeURI($("#password").val())
			   },
			   success: function(data)
			   {
				  data = data.trim();
				  if(debugFlag)
					alert(data);  	
				  if (data === 'success') {
					window.location.reload();
				  }
				  else if(data === 'verify'){
					$("#dialog-content").text("You are registered user. Please check your email for verification.");
					$( "#message" ).dialog( "open" );
					$( "#message" ).dialog('option', 'title', 'Verification' );
				  }
				  else if(data === 'invalid'){					
					$("#dialog-content").text("The credentials provided are not valid. Please recheck your username and password.");
					$( "#message" ).dialog( "open" );
					$( "#message" ).dialog('option', 'title', 'Invalid Credentials' );
				  }
			   }
                        
			});
			return false;
		}
	});

	/** Show Forgot Password Dialog **/
	$('#forgotPass').click(function(e) {
		e.preventDefault();
		$( "#dialog-form" ).dialog( "open" );
	});

	/** Show terms dialog **/
	$('#terms').click(function(e) {
		e.preventDefault();
		var $dialog = $('<div></div>')
			.html('<iframe style="border: 0px; " src="terms.html" width="100%" height="100%"></iframe>')
			.dialog({
			autoOpen: false,
			modal: true,
			height: 625,
			width: 500,
			title: "Terms"
			});
		$dialog.dialog('open');
	});
	$('#terms1').click(function(e) {
		e.preventDefault();
		var $dialog = $('<div></div>')
			.html('<iframe style="border: 0px; " src="terms.html" width="100%" height="100%"></iframe>')
			.dialog({
			autoOpen: false,
			modal: true,
			height: 625,
			width: 500,
			title: "Terms"
			});
		$dialog.dialog('open');
	});

	/** Show About dialog **/
	$('#about').click(function(e) {
		e.preventDefault();
		var $dialog = $('<div></div>')
		   .html('<iframe style="border: 0px; " src="about.html" width="100%" height="100%"></iframe>')
		   .dialog({
			   autoOpen: false,
			   modal: true,
			   height: 625,
			   width: 500,
			   title: "About"
			});
		$dialog.dialog('open');
	});

	/** Show Contact dialog **/
	$('#contact').click(function(e) {
	e.preventDefault();
		var $dialog = $('<div></div>')
		   .html('<iframe style="border: 0px; " src="contact.html" width="100%" height="100%"></iframe>')
		   .dialog({
			   autoOpen: false,
			   modal: true,
			   height: 625,
			   width: 500,
			   title: "Contact"
			});
		$dialog.dialog('open');
	});

	/** Show cookie use dialog **/
	$('#cookie').click(function(e) {
		e.preventDefault();
		var $dialog = $('<div></div>')
		   .html('<iframe style="border: 0px; " src="cookieUse.html" width="100%" height="100%"></iframe>')
		   .dialog({
			   autoOpen: false,

			   modal: true,
			   height: 625,
			   width: 500,
			   title: "Cookie Use Policy of MyTab"
		   });
		$dialog.dialog('open');
	});

	/** Show data use dialog **/
	$('#data').click(function(e) {
		e.preventDefault();
		var $dialog = $('<div></div>')
		   .html('<iframe style="border: 0px; " src="dataUse.html" width="100%" height="100%"></iframe>')
		   .dialog({
			   autoOpen: false,
			   modal: true,
			   height: 625,
			   width: 500,
			   title: "Data Use Policy of MyTab"
		   });
		$dialog.dialog('open');
	});
});
