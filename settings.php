<!doctype html>
<!-- Settings page --> 
<?php
	
	session_start ();
?>
<html lang="en">
	<head>
	  <meta charset="utf-8" />
	  <title>Account Settings</title>
	  
	  <!-- Resources -->
	  <link href="resources/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
	  <link href="resources/css/settings.css" rel="stylesheet">

	  <script type="text/javascript" src="resources/js/jquery.js"></script>
	  <script type="text/javascript" src="resources/js/jquery-ui-1.10.3.custom.min.js"></script>
	  <script type="text/javascript" src="resources/js/jquery.validate.min.js"></script>	     
	  <script type="text/javascript" src="resources/js/settings.js"></script>   
	  
	
</head>
	<body>		
		<!-- Change credentials div -->
		<div id="dialog-form" title="Change Credentials">
			<p class="validateTips">All form fields are required.</p> 
			<form name="settingsForm" id="settingsForm">
				<fieldset>
					<input type="hidden" name="username" id="username" class="text ui-widget-content ui-corner-all" />
					<label for="name">First Name*</label>
					<input type="text" name="firstname" id="firstname" class="text ui-widget-content ui-corner-all" />
					<label for="name">Last Name*</label>
					<input type="text" name="lastname" id="lastname" class="text ui-widget-content ui-corner-all" />
					<label for="pass">Password*</label>
					<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
				</fieldset>
			</form>
		</div>
		
		<!-- Show account details -->
		<div id="users-contain" class="ui-widget">
			  <h1>General Account Settings</h1>
			  <table id="users" class="ui-widget ui-widget-content">
				<tbody>
				  <tr>
					<td>User Name</td>
					<td id="user_name"></td>
				  </tr>
				  <tr>
					<td>First Name</td>
					<td id="first_name"></td>
				  </tr>
				  <tr>
					<td>Last Name</td>
					<td id="last_name"></td>
				  </tr>
				</tbody>
			  </table>
		</div>
		<button id="create-user" role="button" class="cus-button ui-button ui-close-button ui-state-default ui-corner-all ui-button-text-only">Change Credentials</button>
		
		<!-- Success message -->
		<div id="success-message" title="Success">The credentials are updated successfully!</div> 
		
		<input type='hidden' value="<?php echo $_SESSION['username']?>" id='email'/>
	</body>
</html>