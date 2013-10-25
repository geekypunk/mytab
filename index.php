<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>MyTab</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="../beta2/resources/style.css" type="text/css" />
	<script type="text/javascript" src="../beta2/resources/jquery.js"></script> 
	<script type="text/javascript" src="../beta2/resources/cufon-yui.js"></script>
	<script type="text/javascript"  src="../beta2/resources/Calibri_400.font.js"></script>
	<script type="text/javascript">  
    	
    	Cufon.set('fontSize', '17px').replace('#forgotPass,.formtitle,.login_inputtext,.inputtext');
    	Cufon.set('fontSize', '15px').replace('.tocCheckbox');
    	Cufon.set('fontSize', '17px').replace('#footer');
    	
	</script>
	<script>
		$(document).ready(function() {

		  $('#loginForm').submit(function(e) {
		    e.preventDefault();
		    $.ajax({
		       type: "POST",
		       url: '../beta2/auth.php',
		       data: {
               		username: $("#username").val(),
               		password: $("#password").val()
        	   },
		       success: function(data)
		       {
		       	  
		          if (data === 'success') {

		            window.location.reload();
		          }
		          else if(data === 'verify'){
		            alert('Check email for verification');
		          }
		          else if(data === 'invalid'){
		            alert('Invalid credentials');
		          }
		       }
		   });
		   return false;
		 });
		  $('#forgotPass').click(function(e) {
		    e.preventDefault();
		    alert("Forgot Password!");
		    /*$.ajax({
		       type: "POST",
		       url: '../beta2/auth.php',
		       data: {
               		username: $("#username").val(),
               		password: $("#password").val()
        	   },
		       success: function(data)
		       {
		       	  
		          if (data === 'success') {

		            window.location.reload();
		          }
		          else if(data === 'verify'){
		            alert('Check email for verification');
		          }
		          else if(data === 'invalid'){
		            alert('Invalid credentials');
		          }
		       }
		   });
		   return false;*/
		});
		$('#registerForm').submit(function(e) {
		    e.preventDefault();
			$.ajax({
		       type: "POST",
		       url: '../beta2/register.php',
		       data: {
               		email: $("#registeremail").val(),
               		password: $("#registerpassword").val(),
               		firstname: $("#registerfirstname").val(),
               		lastname: $("#registerlastname").val()
               		
        	   },
		       success: function(data)
		       {

		       	  //alert(data);
		          if (data === 'success') {

		            alert("Almost done! Check your email for email verification link");
		          }
		          else if(data==='userexists'){

		          	alert("Email already registered!");
		          }
		          
		       }
		   })
		   return false;
		});
		
	/*End of document.ready func*/	
	});
	</script>
</head>

<?php
session_start();
if(isset($_SESSION['username'])) 
{
	header("Location: ../beta2/frame.html");
}

?>
<body>
	
	<div class="wrapper">
    
    <div id="header">
<table style="float:left">
<tr>
<td><img border="0" src="../beta2/resources/images/newLogo.png" alt="" style="margin-left:10px";"margin-top:0px"></td>
<!--<td><h1 style="margin-bottom:0;">My Tab</h1></td> !-->
</tr>
</table>
<form id ="loginForm" name="loginForm" method="POST">
	<table style="float:right; margin-top:-15px">
	<tr>
	<td>

	<div class="login_input">
					<div class="login_inputtext">Username: </div>
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
				By clicking Create account, you agree to our <a href="#">Terms</a> and that you have read our <a href="#">Data Use Policy</a>, including our <a href="#">Cookie Use</a><br/><br/>
			</div>	
			<div class="buttons">

				<input class="orangebutton" type="submit" value="Create account" id="registerButton"/>

			</div>

			
		</form>

		<!--<div class="link">Designed by <a href="http://hostclipse.com">Hostclipse</a> design team.</div> !-->
		
	</div>	
<div id="footer" class="link">© 2013 MyTab Inc. All rights reserved <a href="#">About</a> <a href="#">Contact</a> <a href="#">Terms</a></div>

</body>
</html>