<!-- Navigation Header -->
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="resources/css/head.css" />
		<script type="text/javascript" src="resources/js/accounts/constants.js"></script>
		<script type="text/javascript" src="resources/js/utils.js"></script>
		<script type="text/javascript" src="resources/js/jquery.js"></script>
		<script type="text/javascript" src="resources/js/lightbox.js"></script>
		<link href="resources/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
		<script src="resources/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript" src="resources/js/AccountsNavigator.js"></script>
	</head>
	
	<body>	
		<!--  Add Google Analytics Tracking -->
		<?php include_once("analyticstracking.php")?>
		
		<!--  Redirect to login page if user hasn't logged in -->
	 	<?php
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
		
		<!--  Stores current account index -->
		<input type="hidden" value="0" id="current" />
		
		<!-- Stores list of logged in accounts as comma separated  -->
		<input type="hidden" id="activeAccounts" />
		
		<!--  Navigation table -->
		<table id="tableHeader" style="width: 100%;" class="background">
			<tr id="header" class="background">
				<td id="home" style="padding-left: 20px;" class="background">
					<a href="#" onclick="changeMainFrame('home');"><b>Home</b></a></td>
				<td id="settings" style="text-align: right; width: 5%; padding-right: 30px;" class="background">
					<a href="#" onclick="changeMainFrame('settings');"><b>Settings</b></a>
				</td>
				<td id="logout" 
					style="text-align: right; width: 10%; padding-right: 20px;"
					class="background"><a href="#" onclick='logoutFromAllAccounts()'><b>Log Out</b>
				</td>
			</tr>
		</table>			
	</body>
</html>