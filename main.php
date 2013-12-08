<?php
	ob_start();
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>

       <title>MyTab Home page</title>
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
       <link rel="stylesheet" type="text/css" href="resources/demo.css">
       <link rel="stylesheet" type="text/css" href="resources/style6.css">
	<link rel="stylesheet" type="text/css" href="resources/lightbox.css">


	</head>		
    <body onload="updateActiveAccounts()">
	<?php include_once("analyticstracking.php") ?>
	<div id="message"><div id="dialog-content"></div></div>

	<form class="form-horizontal" id="piazza_loginform" method="post" action="https://piazza.com/class" target="invisible">
			  <input type="hidden" class="input-block-level" id="email_field" name="email"/>
              <input type="hidden" class="input-block-level" id="password_field" name="password"/>
	</form>
	<form id="ccnet" method="post" action="https://cornell-students.experience.com/experience/login" target="invisible">
		<input class="inputText" type="hidden" name="username" id="username" />
		<input class="inputPassword" type="hidden" name="password"  id="password"/>
	</form>
	<form  id="cornellsso" method="post" target="invisible" action="https://web4.login.cornell.edu/loginAction?SID=202963FFC9A1F9B5&WAK0Service=http/selfservice.adminapps.cornell.edu@CIT.CORNELL.EDU&WAK2Name=&WAK0Realms=CIT.CORNELL.EDU,GUEST.CORNELL.EDU&ReturnURL=https://selfservice.adminapps.cornell.edu/psc/cuselfservice/EMPLOYEE/HRMS/c/202963FFC9A1F9B5/cuwal2.c0ntinue&VerP=2&VerC=2.2.1.201/idmbuild@fox05.serverfarm.cornell.edu/RedHat5-64bit-201/2.0.63&VerS=Apache/2.0.64%20%20Unix%20%20DAV/2%2020131013-1057&VerO=Linux%20sf-psleg-023.serverfarm.cornell.edu%202.6.18-348.3.1.el5%20%231%20SMP%20Tue%20Mar%205%2013:19:32%20EST%202013%20x86_64%20x86_64%20x86_64%20GNU/Linux%20Red%20Hat%20Enterprise%20Linux%20Server%20release%205.9%20%20Tikanga%20&Accept=K2&WANow=1381902876&WAK2Flags=0&WAreason=1 HTTP/1.1" enctype="application/x-www-form-urlencoded">
			<input spellcheck="false" type="hidden" name="netid" id="netid" value=""/>
            <input name="password" type="hidden" id="password" value=""/>
            <select type="hidden" id="realm" name="realm" value="CIT.CORNELL.EDU" style="visibility:hidden;"/>
	</form>
	<form name="NetPay" method="post" action="https://bosebill.salliemae.com/NetPay/EBPP/SYR/Tuition+and+Fees/313/EBPP.aspx" id="NetPay">
		<input name="PageTemplate$ebppLogin$ebppLoginFeatureControl$userNameTextBox" type="hidden" maxlength="50" id="PageTemplate_ebppLogin_ebppLoginFeatureControl_userNameTextBox" tabindex="1" class="short" />
		<input name="PageTemplate$ebppLogin$ebppLoginFeatureControl$passwordTextBox" type="hidden" maxlength="20" id="PageTemplate_ebppLogin_ebppLoginFeatureControl_passwordTextBox" tabindex="2" class="short" />
	</form>
		
	 <form name="aspnetForm" method="post" action="https://store.cornell.edu/signin.aspx" id="aspnetForm">
		<input name="ctl00$PageContent$ctl00$ctrlLogin$UserName" type="hidden" vcard_name="vCard.Email" maxlength="100" size="30" id="ctl00_PageContent_ctl00_ctrlLogin_UserName" />
		<input name="ctl00$PageContent$ctl00$ctrlLogin$Password" type="hidden" maxlength="50" size="30" id="ctl00_PageContent_ctl00_ctrlLogin_Password" />
	</form>
	
	<script type="text/javascript" src="resources/jquery.js"></script>   
	<script type="text/javascript" src="resources/jquery-migrate-1.2.1.js"></script>
	<script type="text/javascript" src="resources/lightbox.js"></script>  
	<script type="text/javascript" src="resources/utils.js"></script>  
	<script type="text/javascript" src="resources/cufon-yui.js"></script>
	<script type="text/javascript"  src="resources/Calibri_400.font.js"></script>
	<script type="text/javascript"  src="resources/jquery.lightbox_me.js"></script>
	<script type="text/javascript" src="resources/jquery.validate.min.js"></script>
	
	<script type="text/javascript">  
		$(document).ready(function() {
			Cufon.replace('div#greetings,b,span');
		});
   
    	
	</script>
				<div id="greetings">
					<?php 
					
					
					if(!isset($_SESSION['username'])) 
					{
					?>
					<script>
						window.open("index.php","_parent");
					</script>
					<?php
					    exit("");
					}
					if(!isset($_SESSION['loggedinAccounts'])) 
					{
						$_SESSION['loggedinAccounts']= '';
					}

					echo "<h1><span></span>Hi $_SESSION[firstname]!</h1>";
					
					?>

				</div>
                <input type="hidden" id="accountSelected" value=""/>
				<div id="accountsDiv"></div>
				<div id="lightboxDiv"></div>
				<div id="sign_up"  style="display: none">
               		<h3 id="see_id" class="sprited" >Can I see some ID?</h3>
                	<span id="signUpText">Please sign in using the form below</span>
	                <div id="sign_up_form">
                          <form method="POST" id="signup_form" name="signup_form"> 
	                    <label><strong>Username:</strong> <input class="sprited" "text" name="signup_username" id="signup_username" /></label>
	                    <label><strong>Password:</strong> <input class="sprited" type="password" id="signup_password" name="signup_password" /></label>
	                    <div id="actions">
	                        <a class="close form_button sprited" id="cancel" href="#" onclick="removeThumbnail()">Cancel</a>
	                        <a class="form_button sprited" id="log_in" href="#">Add Account</a>
	                    </div>
                           </form>
	                </div>
	                <!--
                	<h3 id="left_out" class="sprited">Feeling left out?</h3>
                	<span>Don't be sad, just <a href="#">click here</a> to sign up!</span>-->
                	<!--<a id="close_x" class="close sprited" href="#">close</a>-->
            	</div>
				<div id="editForm"  style="display: none">
               		<h3 id="see_edit_id">Edit your credentials</h3>
                    <div id="edit_up_Form">
                          <form method="POST" id="signup_form" name="signup_form"> 
	                    <label><strong>Username:</strong> <input class="sprited" "text" name="edit_username" id="edit_username" /></label>
	                    <label><strong>Password:</strong> <input class="sprited" type="password" id="edit_password" name="edit_password" /></label>
	                    <div id="actions">
	                        <a class="close form_button sprited" id="cancel" href="#">Cancel</a>
	                        <a class="form_button sprited_update" id="log_in" href="#" onclick="editCredentials($('#edit_username').val(),$('#edit_password').val());">Update</a>
	                    </div>
                           </form>
	                </div>
	                <!--
                	<h3 id="left_out" class="sprited">Feeling left out?</h3>
                	<span>Don't be sad, just <a href="#">click here</a> to sign up!</span>-->
                	<!--<a id="close_x" class="close sprited" href="#">close</a>-->
            	</div>
				<div id="button-wrapper" class="buttonDiv">
					<a href="#" onclick="lightbox()" class="a-btn" id="a-btn">
					    <span></span>
						<span>Get Started</span>	
                        <span>Add account</span>
					</a>
				</div>
				
				<script>
				
				function addHeader(imgName)
				{
				$.ajax({
				    type: "POST",
					url: 'track_logged_in_accounts.php',
					data: {
                            	account: imgName
        	   			},
					    success: function(data) {	
					    }
					});
			        
					var row = getDocumentOfFrame(parent.frame1).getElementById("header");
					var lastChild = getDocumentOfFrame(parent.frame1).getElementById("settings");
					
					for(i=0; i< row.cells.length; i++)
					{
						if(row.cells[i].id == imgName)
						{
							return;
						}
					}
					var newCell = document.createElement("td");
					newCell.id = imgName;
					newCell.innerHTML = '<a href="javascript:changeMainFrame(\''+
					imgName +'\',' + (row.cells.length - 2) + ')"><b>'+
					toTitleCase(imgName) + '</b></a>';
					//newCell.style.width = '10%';
					row.insertBefore(newCell, lastChild);

				}
				function cornellsso(imgName)
				{	
 
					getDocumentOfFrame(parent.leftframe).getElementById('leftArrow').style.visibility = "visible";

					getDocumentOfFrame(parent.rightframe).getElementById('rightArrow').style.visibility = "visible";
					
					var row = getDocumentOfFrame(parent.frame1).getElementById("header");
					var lastChild = getDocumentOfFrame(parent.frame1).getElementById("logout");
					found = false;
					for(i=0; i< row.cells.length; i++)
					{
						if(row.cells[i].id == imgName)
						{
							getDocumentOfFrame(parent.frame1).getElementById('current').value = i;
							found = true;
							break;
						}
					}
					if(!found)
						getDocumentOfFrame(parent.frame1).getElementById('current').value = row.cells.length - 2;
				    var iframe = document.getElementById('invisible');
				    iframe.setAttribute("onload", "loadPage('" + imgName + "')");
				    var form = document.getElementById('cornellsso');
					$.ajax({
		       			type: "POST",
		       			url: 'signup.php',
		       		data: {
               			email : "<?php echo $_SESSION['username']?>",
                            	account: imgName,
                                   login: 'true'
        	   			},
		       		success: function(data)
		       		{
                       		 arr = data.split("|");
		         		form["netid"].value = arr[0];
						form["password"].value= arr[1];
						form.submit();
             
	       		
					}
		   			});
 
				}
				
				/*function bursar()
				{		
					getDocumentOfFrame1().getElementById('current').value = document.getElementById('divbursar').className;					
					parent.frame2.location = "http://localhost:8080/blackboard.html";
					//alert(p3arent.frame2.document.location);
				       var form = document.getElementById("NetPay");
					document.getElementById("PageTemplate_ebppLogin_ebppLoginFeatureControl_userNameTextBox").value = "";
					document.getElementById("PageTemplate_ebppLogin_ebppLoginFeatureControl_passwordTextBox").value = "";
					form.submit(); 
				} */ 

				function ccnet()
				{
					getDocumentOfFrame(parent.leftframe).getElementById('leftArrow').style.visibility = "visible";
					getDocumentOfFrame(parent.rightframe).getElementById('rightArrow').style.visibility = "visible";
					var row = getDocumentOfFrame(parent.frame1).getElementById("header");
					var lastChild = getDocumentOfFrame(parent.frame1).getElementById("logout");
					found = false;
					for(i=0; i< row.cells.length; i++)
					{
						if(row.cells[i].id == 'ccnet')
						{
							getDocumentOfFrame(parent.frame1).getElementById('current').value = i;
							found = true;
							break;
						}
					}
					var iframe = document.getElementById('invisible');				
					iframe.setAttribute("onload", "loadPage('ccnet')");

					if(!found)
						getDocumentOfFrame(parent.frame1).getElementById('current').value = row.cells.length - 2;
					var form = document.getElementById("ccnet");
					$.ajax({
		       			type: "POST",
		       			url: 'signup.php',
		       		data: {
               			email : "<?php echo $_SESSION['username']?>",
                            	account: "ccnet",
                                   login: 'true'
        	   			},
		       		success: function(data)
		       		{						 
                        			arr = data.split("|");
		         			form["username"].value = arr[0];
						form["password"].value= arr[1];
						form.submit();
    		
					}
		   			});	


					
				}
				
				function piazza()
				{
					getDocumentOfFrame(parent.leftframe).getElementById('leftArrow').style.visibility = "visible";
					getDocumentOfFrame(parent.rightframe).getElementById('rightArrow').style.visibility = "visible";
					var row = getDocumentOfFrame(parent.frame1).getElementById("header");
					var lastChild = getDocumentOfFrame(parent.frame1).getElementById("logout");
					found = false;
					for(i=0; i< row.cells.length; i++)
					{
						if(row.cells[i].id == 'piazza')
						{						    
							getDocumentOfFrame(parent.frame1).getElementById('current').value = i;
							found = true;
							break;
						}
					}
					var iframe = document.getElementById('invisible');
				
					iframe.setAttribute("onload", "loadPage('piazza')");
					if(!found)
						getDocumentOfFrame(parent.frame1).getElementById('current').value = row.cells.length - 2;
					var form = document.getElementById("piazza_loginform");
 					$.ajax({
		       			type: "POST",
		       			url: 'signup.php',
		       		data: {
               			email : "<?php echo $_SESSION['username']?>",
                            	account: "piazza",
                                   login: 'true'
        	   			},
		       		success: function(data)
		       		{						
                                   arr = data.split("|");
		         		document.getElementById("email_field").value = arr[0];
						document.getElementById("password_field").value = arr[1];
						form.submit();		       		
					}
		   			});										
				}
				
				
				function updateActiveAccounts()
				{	
   							getDocumentOfFrame(parent.leftframe).getElementById('leftArrow').style.visibility = "hidden";
							getDocumentOfFrame(parent.rightframe).getElementById('rightArrow').style.visibility = "hidden";	

							closeLightbox();

							$.ajax({
								type: "POST",
								url: 'update_accounts.php',
								data: {
								email : "<?php echo $_SESSION['username']?>"
								},
								success: function(data)
								{
									var accounts = data.split("|")[0].split(",");
									var loggedInAccounts = data.split("|")[1].split(",");
									
									/*
									* Length of accounts Array is 1 when no accounts have been added yet
									*/
									
									for(var i=0 ; i < accounts.length ; i++)
									{
										if(accounts[i] == 'piazza')
											createDiv(300,250,'piazza', false);	
										if(accounts[i] == 'library')
											createDiv(650,50,'library',true);
										if(accounts[i] == 'cms')
											createDiv(400,50,'cms', true);
										if(accounts[i] == 'store')
											createDiv(750,225,'store', true);
										if(accounts[i] == 'studentcenter')
											createDiv(400,450,'studentcenter',true);
										if(accounts[i] == 'blackboard')
											createDiv(650,450,'blackboard', true)
										if(accounts[i] == 'gannett')
											createDiv(750,225,'gannett', true);
										if(accounts[i] == 'ccnet')
											createDiv(650,50,'ccnet', false)
											
									} 						 
										
								   	 for(var i=0 ; i < loggedInAccounts.length ; i++)
									{
										if($.inArray(loggedInAccounts[i], accounts) !== -1){
											addHeader(loggedInAccounts[i]);
										}
											
									}
									if(accounts.length == 1)
									{
										document.getElementsByClassName("a-btn")[0].innerHTML="<span></span><span>Get Started</span><span></span>";									
	
									}
									/*Because of an extra "" in the array*/
									else if(accounts.length == 7)
									{
										document.getElementsByClassName("a-btn")[0].innerHTML="<span></span><span>Done!!!</span><span></span>";									
	
									}
									
									else
									{							 
										document.getElementsByClassName("a-btn")[0].innerHTML="<span></span><span>Add More!</span><span>Add account</span>";
									}									
							}
						});					
				}
				var count;				
				function createDiv(x_pos, y_pos,imgName, sso,signIn) {
                                   document.getElementById('accountSelected').value = imgName;	
					$('#sign_up').find('input:first').val("");
	          		       $('#sign_up').find('#signup_password').val("");
					if(signIn){
	   					$('#sign_up').lightbox_me({
	       					 centered: true, 
							 closeEsc : false,
							 closeClick : false,
	       					 onLoad: function() { 
	          					  
	           				}
	        			});
   					}
    				var row = getDocumentOfFrame(parent.frame1).getElementById("header");
					var divName = 'div'+imgName;
					var div = document.createElement("div");
					div.id=divName;
					div.className = row.cells.length - 1;
					var img = document.createElement("img");
					img.style.position = "absolute";
					img.style.left = x_pos+'px';
					img.style.top = y_pos+'px';
					img.src = "resources/images/"+imgName+".jpg";
					if(sso == true)
						img.setAttribute("onclick","cornellsso('" + imgName + "')");
					else
						img.setAttribute("onclick", imgName + "()");
					div.appendChild(img);
					document.body.appendChild(div);
					closeLightbox();
					var addedAccounts = getDocumentOfFrame(parent.frame1).getElementById('activeAccounts').value.split(',');
					if(addedAccounts.indexOf(imgName) == -1){
						getDocumentOfFrame(parent.frame1).getElementById('activeAccounts').value += imgName + ",";
					}
					if(getDocumentOfFrame(parent.frame1).getElementById('activeAccounts').value.split(",").length >= 7)
					{
						document.getElementsByClassName("a-btn")[0].innerHTML="<span></span><span>Done!!!</span><span></span>";
					}
					else
					document.getElementsByClassName("a-btn")[0].innerHTML="<span></span><span>Add More!</span><span>Add account</span>";
												
				 var editImg = document.createElement("img");
                    editImg.style.position = "absolute";
                    editImg.style.left = x_pos-50+'px';
                    editImg.style.top = y_pos+'px';
                    editImg.src = "resources/images/document-edit.png";
					editImg.title = imgName;
                    div.appendChild(editImg);

                    var closeImg = document.createElement("img");
                    closeImg.style.position = "absolute";
                    closeImg.style.top = y_pos+30+'px';
                    closeImg.src = "resources/images/closeBlueIcon.jpg";
					closeImg.title = imgName;
					var offsetWidth = 0;
					if(img.naturalWidth === 0){
						var map = {};
						map['blackboard'] = 213;
						map['ccnet'] = 168;
						map['cms'] = 212;
						map['piazza'] = 218;
						map['studentcenter'] = 206;
						map['ganett'] = 178;
						closeImg.style.left =x_pos+map[imgName] +'px';
					}
					else{	
						closeImg.style.left =x_pos+img.naturalWidth +'px';
					}
                    div.appendChild(closeImg);
                    $(closeImg).hide();
                    $(editImg).hide();
                    $(closeImg).click(function() {
						var selectedAccId = $(this).attr("title");
                        $(div).remove();
						$.ajax({
						   type: "POST",
						   url: 'delete_account.php',
						   data: {
								username : "<?php echo $_SESSION['username']?>",
								accountid: selectedAccId
						   },
						   success: function(data)
						   {
							document.getElementsByClassName("a-btn")[0].innerHTML="<span></span><span>Add More!</span><span>Add account</span>";
							var row = getDocumentOfFrame(parent.frame1).getElementById("header");
							var addedAccounts = getDocumentOfFrame(parent.frame1).getElementById('activeAccounts').value.split(',');
							
							for (var i=addedAccounts.length-1; i>=0; i--) {
								
								if (addedAccounts[i] === selectedAccId) {
									
									addedAccounts.splice(i, 1);
									
								}
							}
							getDocumentOfFrame(parent.frame1).getElementById('activeAccounts').value = addedAccounts.join(',');
							for(i=0; i< row.cells.length; i++)
							{
								if(row.cells[i].id == selectedAccId)
								{
									row.deleteCell(i);
									break;
								}
							}
							$.ajax({
				    			type: "POST",
								url: 'track_logged_in_accounts.php',
								data: {
                            			account: selectedAccId,
										delete: true
        	   						},
					   			 success: function(data) {	
					   			 }
							});		

						   }
					   });	
									

                    });
                    $(editImg).click(function() {
					
						var selectedAccId = $(this).attr("title");
						$("#accountSelected").val(selectedAccId);
						$.ajax({
									type: "GET",
									url: 'get_acc_details.php',
									data: {
										username : "<?php echo $_SESSION['username']?>",
										accountid: selectedAccId,
									},
									 success: function(data) {	
									 
										if(data !=='NotFound'){
											var credArray = data.split("|");
											$("#edit_username").val(credArray[0]),
											$("#edit_password").val(credArray[1])
										}else{
											$("#edit_username").val(""),
											$("#edit_password").val("")
										}
									}
						});
                        $('#editForm').lightbox_me({
                            centered: true,
							closeEsc : false,
							closeClick : false,
                            onLoad: function() {
							
										

                            }
                        });

                    });
                    $('#'+divName).mouseover(function() {
                        $(editImg).show();
                        $(closeImg).show();

                    });
                    $('#'+divName).mouseout(function() {
                        $(editImg).hide();
                        $(closeImg).hide();
                    });
				}
			function loadPage(imgName)
			{        
				closeLightbox();
				var iframe = document.getElementById('invisible');
				iframe.setAttribute("onload", "");
				   
				var row = getDocumentOfFrame(parent.frame1).getElementById("header");
				blackboardLoggedIn = false;
				if(imgName == 'blackboard')
				{
					for(i=0; i< row.cells.length; i++)
					{
						if(row.cells[i].id == imgName)
						{
							blackboardLoggedIn = true;			
							break;
						}
					}
					if(!blackboardLoggedIn)
					{
						var win = window.open(urls[imgName], '_newtab');
						win.focus();

					}
                		}
				if(blackboardLoggedIn || imgName !== 'blackboard')
				{
					if(parent.frame2 === undefined)
						parent.frames[2].location=urls[imgName];
					else
						parent.frame2.location=urls[imgName];
						//parent.frame2.location=urls[imgName];
				}
				


				addHeader(imgName); 	
					                       
			}
		/*$(document).ready(function () {

		$("#signup_form").validate({
			rules: {
				signup_username: { required: true},
				signup_password: { required: true}
				},
			messages: {
				signup_username: "Please enter username.",
				signup_password: "Please enter password."
				},
			submitHandler: function() {
				$.ajax({
				   type: "POST",
				   url: 'signup.php',
				   data: {
						signup_username: $("#signup_username").val(),
						signup_password: $("#signup_password").val(),
						email : "<?php echo $_SESSION['username']?>",
						account: $("#accountSelected").val()
				   },
				   success: function(data)
				   {
					 
				   }
			   });	
			return false;
		   }
		});
		});	*/	

		 $('#log_in').click(function(e) {
		    	e.preventDefault();

			if($("#signup_username").val().trim().length !== 0 || $("#signup_username").val().trim().length !== 0){
				$.ajax({
				   type: "POST",
				   url: 'signup.php',
				   data: {
						signup_username: $("#signup_username").val(),
						signup_password: $("#signup_password").val(),
						email : "<?php echo $_SESSION['username']?>",
						account: $("#accountSelected").val()
				   },
				   success: function(data)
				   {
					 
				   }
			   });	
				
			   $('#sign_up').trigger('close');
			   closeLightbox();
			   return true;
		   }
		    else
			{
				alert("User Name/Password cannot be empty");
				
			}
		 });	
		 
		 function editCredentials(username,password){
			 $.ajax({
		       type: "POST",
		       url: 'update.php',
		       data: {
               		new_username: username,
               		new_password: password,
                    username : "<?php echo $_SESSION['username']?>",
                    accountid: $("#accountSelected").val()
        	   },
		       success: function(data)
		       {
		         //alert(data);
		       }
		   });	
		   
		   $('#editForm').trigger('close');
			
		 }
		 
		 function removeThumbnail(){
			var selectedAcc = $("#accountSelected").val();
				$('#div'+selectedAcc).remove();
			
		 	$("#a-btn").html("<span></span><span>Add More!</span><span>Add account</span>");

		 }
		 
		 </script>
				
            
			
        <iframe id="invisible" name="invisible" style="visibility:hidden"/>
</body></html>