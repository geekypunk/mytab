<!-- Login Page -->

<!-- Initialize the session -->
<?php
	ob_start();
	session_start();
	
	//Redirect to home page if user has already logged in -->
	if(isset($_SESSION['username'])) 
	{
?>
	<script>
		window.open("home.html","_parent");
	</script>
<?php
		exit("");
	}
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

		<!-- Specify character set -->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 

		<!-- Description for search results -->
		<meta name="description" content="Manage all your student accounts at one place. A website developed for Cornell University Students"/>
		<meta name="keywords" content="mytab,cornell, mytab cornell, password manager, cornell accounts"/>
		<meta name="google-site-verification" content="qwaQAgTc3Z2i23Y_vC6B3r_jCeD3Hx-0trUDamqBBnc" />

		<!-- Include resources -->
		<link rel="icon" type="image/png" href="resources/images/tabLogo.png" />
		
		<link rel="stylesheet" href="resources/css/style.css" type="text/css" />
		<link rel="stylesheet" href="resources/css/ui-lightness/jquery-ui-1.10.3.custom.css">
		<link rel="stylesheet" href="resources/css/index.css">
		
		<script type="text/javascript" src="resources/js/jquery.js"></script>
		<script type="text/javascript" src="resources/js/cufon-yui.js"></script>
		<script type="text/javascript" src="resources/js/Calibri_400.font.js"></script>
		<script type="text/javascript" src="resources/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="resources/js/jquery-ui-1.10.3.custom.js"></script>
		<script type="text/javascript" src="resources/js/index.js"></script>
	</head>
	<body>
		
		
		<!-- Include Google Analytics tracker -->
		<?php include_once("analyticstracking.php") ?>	
		
		<!-- Login Page Header -->
		<div class="wrapper">    
			<div id="header">
				<table style="float:left">
					<tr>
						<td><img border="0" src="resources/images/newLogo.jpg" alt="" style="height:95px;width:180px"></td>
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
										<input type="password" name="password" id="password"/><br/>
										<div id="forgotPass"><a href="#">Forgot password?</a></div>
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
				
		<!-- Registration form -->
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
					By clicking Create account, you agree to our 
					<a href="#" id="terms">Terms</a> and that you have read our 
					<a href="#" id="data">Data Use Policy</a>, including our 
					<a href="#" id="cookie">Cookie Use</a><br/><br/>
				</div>	
				<div class="buttons">
					<input class="orangebutton" type="submit" value="Create account" id="registerButton"/>
				</div>			
			</form>

			<!-- Forgot password form -->
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
			
			<!-- Message dialog -->
			<div id="message">
				<div id="dialog-content"></div>
			</div>			
		</div>	
		
		<!-- Footer -->
		<div id="footer" class="link">
			© 2013 MyTab Inc. All rights reserved 
			<a href="#" id="about">About</a> 
			<a href="#" id="contact">Contact</a> 
			<a href="#" id="terms1">Terms</a>
		</div>
	</body>
</html>