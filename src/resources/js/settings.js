/** All JavaScript functions for settings page **/
$(document).ready(function() {
			
			/** Populate account details" **/
			$.ajax({
			type: "POST",
			url: 'getAccountDetails.php',
				data: {
					email : $('#email').val(),
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
			});
				
		/** Settings Form Validation and submission **/
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
						username: $('#username').val().trim(),
						password: $("#password").val(),
						firstname: $("#firstname").val(),
						lastname: $("#lastname").val()               		
					},
					dataType: "html"
			}); 
			request.done(function( data ) {
				data = data.trim();
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
	
	/** password checker **/
	$.validator.addMethod("pwcheck", function(value) {
		return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these 
				&& /\d/.test(value) // has a digit
		});
	
	/** Success message dialog **/
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
	
	/** Update account details dialog **/
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

	/** Show Edit dialog **/
	$( "#create-user" )
	  .click(function() {
		   $.ajax({
				   type: "POST",
				   url: 'getAccountDetails.php',
				   data: {
					  email : $('#email').val(),
					  },
				   success: function(data)
				   {
						data = data.trim();
						arr = data.split("|");
						$( "#firstname" ).val( arr[1] );
						$( "#lastname" ).val( arr[2] );
						$( "#password" ).val('');
					}
				});
				$( "#dialog-form" ).dialog( "open" );
		});
});
	