<html>
<head>
<link rel="stylesheet" type="text/css" href="resources/head.css"/>
<script type="text/javascript" src="resources/utils.js"></script>
 <script type="text/javascript" src="resources/jquery.js"></script>   
	<script type="text/javascript" src="resources/lightbox.js"></script> 
	<link href="resources/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
	<script src="resources/js/jquery-1.9.1.js"></script>
	<script src="resources/js/jquery-ui-1.10.3.custom.js"></script>
	<script>
	$(function() {
	
	$( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 300,
      width: 350,
      modal: true,
      buttons: {
        "Create an account": function() {
          //$('#settingsForm').submit();
		  $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
	
    
    $( "#settings" ).click(function() {
       changeMainFrame('settings');
		//parent.frame2.
		//window.parent.find( "#dialog-form" ).dialog( "open" );
      });
  });
	</script>
</head>

 <body>
<?php include_once("analyticstracking.php") ?>
 <?php
 session_start();
					if(!isset($_SESSION['username'])) 
					{
					?>
					<script>
						window.open("index.php","_parent");
					</script>
					<?php
					    exit("");
					}
      ?>
	<input type="hidden" value="0" id="current"/>
	<input type="hidden"  id="activeAccounts"/>
<table id="tableHeader" style="width:100%;" class="background">
<tr id="header" class="background">
	<!--<td><img border="0" src="resources/images/ss.png" alt="" style="margin-left:10px";"margin-top:10px"></td>-->
	<td id="home" style="padding-left:20px;" class="background">
		<a href="#" onclick= "changeMainFrame('home');"><b>Home</b></a>	
	</td>	
	<td  id= "settings" style="text-align:right;width:5%;padding-right:30px;" class="background">
		<a href="#" ><b>Settings</b></a>	
	</td>
	<td  id= "logout" style="text-align:right;width:5%;padding-right:20px;" class="background">
		<a href="logout.php" target="_parent"><b>Logout</b></a>	
	</td>
</tr>
</table>
<div id="dialog-form" title="Create new user">
  <p class="validateTips">All form fields are required.</p>
 
  <form>
  <fieldset>
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
    <label for="email">Email</label>
    <input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" />
    <label for="password">Password</label>
    <input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
  </fieldset>
  </form>
</div>
</body>
</html>