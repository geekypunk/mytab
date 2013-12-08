<?php
    ob_start();
    session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html itemscope="" itemtype="http://schema.org/WebPage" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- ===================================================================== -->
  	<!-- PAGE TITLE -->
  	<!-- ===================================================================== -->
 	<title>Welcome to MyTab - Login</title>

	<!-- ===================================================================== -->
  	<!-- META TAGS -->
  	<!-- ===================================================================== -->

  	<!-- Forces page to render at the client device's width. -->
  	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

  	<!-- Specify character set -->
  	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 

  	<!-- Description for search results -->
	<meta name="description" content="Manage all your student accounts at one place. A website developed for Cornell University Students"/>
	<meta name="keywords" content="mytab,cornell, mytab cornell, password manager, cornell accounts"/>
	<meta name="google-site-verification" content="qwaQAgTc3Z2i23Y_vC6B3r_jCeD3Hx-0trUDamqBBnc" />

	<link rel="icon" type="image/png" href="resources/images/tabLogo.png" />
	<link rel="stylesheet" href="resources/style.css" type="text/css" />
	<link href="resources/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
	<script type="text/javascript" src="resources/jquery.js"></script>
	<script type="text/javascript" src="resources/cufon-yui.js"></script>
	<script type="text/javascript"  src="resources/Calibri_400.font.js"></script>
	<script type="text/javascript" src="resources/jquery.validate.min.js"></script>
 	<script src="resources/js/jquery-ui-1.10.3.custom.js"></script>

	<style>
  input.text { margin-bottom:6px; width:95%; padding: .1em; }
  fieldset { padding:0; border:0; margin-top:25px; }
  .ui-dialog .ui-state-error { padding: .3em; }
  .validateTips { border: .5px solid transparent; padding: 0.1em; }
	
</style>
	<script type="text/javascript">  
    	
    	Cufon.set('fontSize', '17px').replace('#forgotPass,.formtitle,.login_inputtext,.inputtext');
    	Cufon.set('fontSize', '15px').replace('.tocCheckbox');
    	Cufon.set('fontSize', '17px').replace('#footer');
    	
	</script>
	<script>

		var debugFlag = false;
		$(document).ready(function() {
			var name = $( "#firstname" ),
			email = $( "#userid" ),
			lastname = $( "#lastname" ),
			allFields = $( [] ).add( name ).add( email ).add( lastname );
			$( "#dialog-form" ).dialog({
				autoOpen: false,
				height: 400,
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
	$("#forgotForm").validate({
			rules: {
				userid:{required: true, email: true    },
				firstname: { required: true    },
				lastname: { required: true     }
						   
			},
			messages: {
				userid: { required: "Please enter your username.", email : "Username should be of form me@ex.com." },
				firstname: "Please enter your firstname.",
				lastname: "Please enter your lastname."
			},
			submitHandler: function() {
				var request = $.ajax({
					url: "forgot.php",
					type: "POST",
					data: {
						firstname: $("#firstname").val(),
						username: $("#userid").val(),
						lastname: $("#lastname").val()
               		
					},
					dataType: "html"
			});
 
			request.done(function( data ) {
				//alert(data);
				if (data === 'success') {

					$("#dialog-content").text("An email with new password is sent to your mail id.");
					$( "#message" ).dialog( "open" );
					$( "#message" ).dialog('option', 'title', 'Reset Password' );
					$("#dialog-form").closest('.ui-dialog-content').dialog('close');
		        }
				else if (data == 'invalid'){
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
				alert( "Request failed: " + textStatus );
			});
			}
		});
		
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
						email: $("#registeremail").val(),
						password: $("#registerpassword").val(),
						firstname: $("#registerfirstname").val(),
						lastname: $("#registerlastname").val()
               		
					},
					dataType: "html"
			});
 
			request.done(function( data ) {
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
				  alert("In else case - php code error");
				  }
			});
 
			request.fail(function( jqXHR, textStatus ) {
				alert( "Request failed: " + textStatus );
			});
			}
		});
	 
		$.validator.addMethod("pwcheck", function(value) {
			return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these 
			&& /\d/.test(value) // has a digit
		});
		
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
               		username: $("#username").val(),
               		password: $("#password").val()
        	   },
		       success: function(data)
		       {
					if(debugFlag)
						alert(data);
		          if (data === 'success') {

		            window.location.reload();
		          }
		          else if(data === 'verify'){
		            $("#dialog-content").text("You are registered user. Please check your email for verification.");
					$( "#message" ).dialog( "open" );
					$( "#message" ).dialog('option', 'title', 'Verification' );
					//e.preventDefault();
		          }
		          else if(data === 'invalid'){
					$("#dialog-content").text("The credentials provided are not valid. Please recheck your username and password.");
					$( "#message" ).dialog( "open" );
					$( "#message" ).dialog('option', 'title', 'Invalid Credentials' );
					//e.preventDefault();

		          }
		       }
		   });
		   return false;
		 /*});*/
		 }
		});
		
	
      $('#forgotPass').click(function(e) {
		    e.preventDefault();
        $( "#dialog-form" ).dialog( "open" );
      });
	  
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
	  
	/*End of document.ready func*/	
	});
	</script>
</head>

<?php 
					
					
	if(isset($_SESSION['username'])) 
	{
	?>
	<script>
		window.open("frame.html","_parent");
	</script>
	<?php
		exit("");
	}
	?>
<body>
<?php include_once("analyticstracking.php") ?>
	
	<div class="wrapper">
    
    <div id="header">
<table style="float:left">
<tr>
<td><img border="0" src="resources/images/newLogo.jpg" alt="" style="height:95px;width:180px"></td>
<!--<td><h1 style="margin-bottom:0;">My Tab</h1></td> !-->
</tr>
</table>
<form id ="loginForm" name="loginForm" method="POST">
	<table style="float:right; margin-top:-15px">
	<tr>
	<td>

	<div class="login_input">
					<div class="login_inputtext">Username/Email: </div>
					<div class="login_inputcontent">

						<input type="text" name="username" id="username"/>

					</div>
				</div>
	         
	</td>
	<td>
	<div class="login_input">
					<div class="login_inputtext">Password: </div>
					<div class="login_inputcontent">

						<input type="password" name="password" id="password"/>
						<br/><div id="forgotPass"><a href="#">Forgot password?</a></div>

					</div>
	</div>
	
	</td>
	<td>
	<div class="login_buttons">

			<input class="login_orangebutton" type="submit" value="Login" />
	</div>
	</td>
	</tr>
	</table>
</form>

</div>
<br/><br/>
	
		<form class="form2"  method="POST" name="registerForm" id="registerForm">

			<div class="formtitle">Register</div>

			<div class="input">
				<div class="inputtext">First Name: </div>
				<div class="inputcontent">

					<input type="text" name="registerfirstname" id="registerfirstname"/>

				</div>
			</div>

			<div class="input">
				<div class="inputtext">Last Name: </div>
				<div class="inputcontent">

					<input type="text" name="registerlastname" id="registerlastname"/>

				</div>
			</div>

			<div class="input">
				<div class="inputtext">Email: </div>
				<div class="inputcontent">

					<input type="text" name="registeremail" id="registeremail"/>

				</div>
			</div>
            
            <div class="input nobottomborder">
				<div class="inputtext">Password: </div>
				<div class="inputcontent">

					<input type="password" name="registerpassword" id="registerpassword"/>

				</div>
			</div>

			<div class="tocCheckbox">
				By clicking Create account, you agree to our <a href="#" id="terms">Terms</a> and that you have read our <a href="#" id="data">Data Use Policy</a>, including our 
<a href="#" id="cookie">Cookie Use</a><br/><br/>
			</div>	
			<div class="buttons">

				<input class="orangebutton" type="submit" value="Create account" id="registerButton"/>

			</div>			
		</form>

<div id="dialog-form" title="Forgot Password ">
<div id="content" > </div>
  <p class="validateTips">All form fields are required.</p>
  <form name="forgotForm" id="forgotForm">
  <fieldset>
	<label for="name">User Name *</label>
    <input type="text" name="userid" id="userid" class="text ui-widget-content ui-corner-all" /><br/>
    <label for="name">First Name *</label>
    <input type="text" name="firstname" id="firstname" class="text ui-widget-content ui-corner-all" /><br/>
	<label for="name">Last Name *</label>
    <input type="text" name="lastname" id="lastname" class="text ui-widget-content ui-corner-all" /><br/>
  </fieldset>
  </form>
</div>
<div id="message"><div id="dialog-content"></div></div>
		
	</div>	
<div id="footer" class="link">© 2013 MyTab Inc. All rights reserved <a href="#" id="about">About</a> <a href="#" id="contact">Contact</a> <a href="#" id="terms1">Terms</a></div>

</body>
</html>