<!doctype html>
 
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Account Settings</title>
  <link href="resources/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
 <script type="text/javascript" src="resources/js/jquery-1.9.1.js"></script>   
  <script type="text/javascript" src="resources/js/jquery-ui-1.10.3.custom.min.js"></script> 

  <script type="text/javascript" src="resources/jquery.validate.min.js"></script>
  <style>

    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 {margin-top: 2em; margin-left: 2em;margin-bottom: 1em; font-size: 1em}
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; margin-left: 2em; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left;}
	.cus-button{margin-left: 2em; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
  </style>
  <script>
  $(function() {
  // $('#settingsForm').validate();     body { font-size: 62.5%; }
  <?php session_start(); ?>
					$.ajax({
		       			type: "POST",
		       			url: 'getAccountDetails.php',
		       		data: {
               			email : "<?php echo $_SESSION['username']?>",
        	   			},
		       		success: function(data)
		       		{
                        arr = data.split("|");
						$('#username').val(arr[0]);
						$('#user_name').html(arr[0]);
						$('#first_name').html(arr[1]);
						$('#last_name').html(arr[2]);
						$( "#firstname" ).val( arr[1] );
						$( "#lastname" ).val( arr[2] );						       		
					}
		   			})
					
   $("#settingsForm").validate({
			rules: {
				firstname: { required: true, maxlength: 20    },
				lastname: { required: true, maxlength: 20    },
				password: {    required: true, pwcheck: true, minlength: 6  }			   
			},
			messages: {
				firstname: {required: "Please enter your firstname.", 
				maxlength: "Length must not exceed 20 characters"},
				lastname:{required: "Please enter your lastname.",
				maxlength: "Length must not exceed 20 characters"},
				password: {required: "Please enter your password." ,
				pwcheck:"must contain at least 1digit. ",
				minlength: "Length must be at least 6 characters"}
			},
			submitHandler: function() {

				var request = $.ajax({
					url: "update_credentials.php",
					type: "POST",
					data: {
						username: $('#username').val(),
						password: $("#password").val(),
						firstname: $("#firstname").val(),
						lastname: $("#lastname").val()               		
					},
					dataType: "html"
			});
 
			request.done(function( data ) {
				if (data == 'success') {

					$( "#success-message" ).dialog( "open" );
					$("#dialog-form").closest('.ui-dialog-content').dialog('close');
					$('#user_name').html($('#username').val());
					$('#first_name').html($("#firstname").val());
					$('#last_name').html($("#lastname").val());
					
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
	 
		$.validator.addMethod("pwcheck", function(value) {
			return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these 
			&& /\d/.test(value) // has a digit
		});
		
		$( "#success-message" ).dialog({
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
		
    $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 430,
      width: 350,
      modal: true,
      buttons: {
        "Change": function() {
          $('#settingsForm').submit();
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
		$("label[for='firstname']").remove();
	  	$("label[for='lastname']").remove();
	 	 $("label[for='password']").remove();
      }
    });
 
    $( "#create-user" )
      .button()
      .click(function() {

	   $.ajax({
		       type: "POST",
		       url: 'getAccountDetails.php',
		       data: {
               	  email : "<?php echo $_SESSION['username']?>",
        	   	  },
		       success: function(data)
		       {
                     arr = data.split("|");
				$( "#firstname" ).val( arr[1] );
				$( "#lastname" ).val( arr[2] );
				$( "#password" ).val('');
			  }
		})
        $( "#dialog-form" ).dialog( "open" );
      });
  });
  </script>
</head>
<body>
 
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
<button id="create-user" class="cus-button">Change Credentials</button>

<div id="success-message" title="Success">The credentials are updated successfully!</div>
 
</body>
</html>