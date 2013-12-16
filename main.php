<?php
/**
* Home Page of MyTab
* Initialize session 
*/
	ob_start ();
	session_start ();
	if (! isset ( $_SESSION ['username'] )) {
?>
	<script>
		window.open("index.php","_parent");
	</script>
<?php
	    exit ( "" );
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MyTab Home page</title>
		<!-- ===================================================================== -->
		<!-- META TAGS -->
		<!-- ===================================================================== -->

		<!-- Specify character set -->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<!-- Description for search results -->
		<meta name="description"
			content="Manage all your student accounts at one place. A website developed for Cornell University Students" />
		<meta name="keywords"
			content="mytab,cornell, mytab cornell, password manager, cornell accounts" />
		<meta name="google-site-verification"
			content="qwaQAgTc3Z2i23Y_vC6B3r_jCeD3Hx-0trUDamqBBnc" />
			
		<!-- Resources -->
		<link rel="stylesheet" type="text/css" href="resources/css/demo.css">
		<link rel="stylesheet" type="text/css" href="resources/css/style6.css">
		<link rel="stylesheet" type="text/css" href="resources/css/lightbox.css">
		<link rel="stylesheet" href="resources/css/ui-lightness/jquery-ui-1.10.3.custom.css">
		
		<script type="text/javascript" src="resources/js/accounts/constants.js"></script>
		<script type="text/javascript" src="resources/js/jquery.js"></script>
		<script type="text/javascript" src="resources/js/lightbox.js"></script>
		<script type="text/javascript" src="resources/js/utils.js"></script>
		<script type="text/javascript" src="resources/js/cufon-yui.js"></script>
		<script type="text/javascript" src="resources/js/Calibri_400.font.js"></script>
		<script type="text/javascript" src="resources/js/jquery.lightbox_me.js"></script>
		<script type="text/javascript" src="resources/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="resources/js/main.js"></script>
		<script type="text/javascript" src="resources/js/AccountsNavigator.js"></script>
		
		<!-- Add the accounts here -->		
		<script type="text/javascript" src="resources/js/accounts/AccountRenderer.js"></script>
		<script type="text/javascript" src="resources/js/accounts/PiazzaAccountRenderer.js"></script>
		<script type="text/javascript" src="resources/js/accounts/CCNetAccountRenderer.js"></script>
		<script type="text/javascript" src="resources/js/accounts/CornellSingleSignOnAccountRenderer.js"></script>
		<script type="text/javascript" src="resources/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript" src="resources/js/cufon-yui.js"></script>
	</head>
	<body>
	
		<!-- Add google analytics tracking -->
		<?php include_once("analyticstracking.php")?>
		
		<!-- Message Dialog -->
		<div id="message">
			<div id="dialog-content"></div>
		</div>
		
		<!-- Show greetings -->
		<div id="greetings">
		
			<!-- Redirect to login page if user has not logged in yet -->
			<?php
				
				if (! isset ( $_SESSION ['loggedinAccounts'] )) {
					$_SESSION ['loggedinAccounts'] = '';
				}
				echo "<h1 class='greetings'><span></span>Hi $_SESSION[firstname]!</h1>";
			?>
		</div>
		
		<!-- Message dialog -->
		<div id="message">
			<div id="dialog-content"></div>
		</div>	
			
		<!-- Current user -->
		<input type='hidden' id='email' value="<?php echo $_SESSION['username']?>"/>
		
		<!-- Track the selected account -->
		<input type="hidden" id="accountSelected" value="" />
		
		<!-- Will be dynamically updated on adding accounts -->
		<div id="accountsDiv"></div>
		<div id="lightboxDiv"></div>
	
		<!-- Add account form -->
		<div id="sign_up" style="display: none">
			<h3 id="see_id" class="sprited">Can I see some ID?</h3>
			<span id="signUpText">Please sign in using the form below</span>
			<div id="sign_up_form">
				<form method="POST" id="signup_form" name="signup_form">
					<label><strong>Username:</strong> <input class="sprited"
						"text" name="signup_username" id="signup_username" /></label> <label><strong>Password:</strong>
						<input class="sprited" type="password" id="signup_password"
						name="signup_password" /></label>
					<div id="actions">
						<a class="close form_button sprited" id="cancel" href="#"
							onclick="removeThumbnail()">Cancel</a> <a
							class="form_button sprited" id="log_in" href="#">Add Account</a>
					</div>
				</form>
			</div>		
		</div>
		
		<!-- Edit Account Form -->
		<div id="editForm" style="display: none">
			<h3 id="see_edit_id">Edit your credentials</h3>
			<div id="edit_up_Form">
				<form method="POST" id="signup_form" name="signup_form">
					<label><strong>Username:</strong> <input class="sprited"
						"text" name="edit_username" id="edit_username" /></label> <label><strong>Password:</strong>
						<input class="sprited" type="password" id="edit_password"
						name="edit_password" /></label>
					<div id="actions">
						<a class="close form_button sprited" id="cancel" href="#">Cancel</a>
						<a class="form_button sprited_update" id="log_in" href="#"
							onclick="editCredentials($('#edit_username').val(),$('#edit_password').val());">Update</a>
					</div>
				</form>
			</div>
		</div>
		
		<!-- Central Button -->
		<div id="button-wrapper" class="buttonDiv">
			<a href="#" onclick="lightbox()" class="a-btn" id="a-btn"> <span></span>
				<span>Get Started</span> <span>Add account</span>
			</a>
		</div>
	
		<!-- Invisible frame for controlling form submission. The account frames are shown, on 'onload' event of this frame -->
		<iframe id="invisible" name="invisible" style="visibility: hidden" />
	
	</body>
</html>