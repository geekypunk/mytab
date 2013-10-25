<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>MyTab Home page</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" type="text/css" href="resources/demo.css">
        <link rel="stylesheet" type="text/css" href="resources/style6.css">
		<link rel="stylesheet" type="text/css" href="resources/lightbox.css">
		
        
	</head>		
    <body onload="updateActiveAccounts()">
	
	<form class="form-horizontal" id="piazza_loginform" method="post" action="https://piazza.com/class" target="frame2">
			  <input type="hidden" class="input-block-level" id="email_field" name="email"/>
              <input type="hidden" class="input-block-level" id="password_field" name="password"/>
	</form>
	<form id="ccnet" method="post" action="https://cornell-students.experience.com/experience/login">
		<input class="inputText" type="hidden" name="username"  />
		<input class="inputPassword" type="hidden" name="password"  />
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
	
    <script type="text/javascript" src="../beta2/resources/jquery.js"></script>   
	<script type="text/javascript" src="../beta2/resources/jquery-migrate-1.2.1.js"></script>
	<script type="text/javascript" src="../beta2/resources/lightbox.js"></script>  
	<script type="text/javascript" src="../beta2/resources/utils.js"></script>  
	<script type="text/javascript" src="../beta2/resources/cufon-yui.js"></script>
	<script type="text/javascript"  src="../beta2/resources/Calibri_400.font.js"></script>
	<script type="text/javascript"  src="../beta2/resources/jquery.lightbox_me.js"></script>
	<script type="text/javascript">  
		$(document).ready(function() {
			Cufon.replace('div#greetings,b,span');
		});
    	
	</script>
				<div id="greetings">
					<?php 
					include "pass.php";
					session_start();
					if(!isset($_SESSION['username'])) 
					{
						header("Location: ../beta2/index.php");
					}

					echo "<p><font size='5' face='verdana' color='green'>Hi $_SESSION[firstname]!</font></p>";

					?>

				</div>
				<div id="accountsDiv"></div>
				<div id="lightboxDiv"></div>
				<div id="sign_up"  style="display: none">
               		<h3 id="see_id" class="sprited" >Can I see some ID?</h3>
                	<span>Please sign in using the form below</span>
	                <div id="sign_up_form">
	                    <label><strong>Username:</strong> <input class="sprited" "text" name="username" id="username" /></label>
	                    <label><strong>Password:</strong> <input class="sprited" type="password" id="password" /></label>
	                    <div id="actions">
	                        <a class="close form_button sprited" id="cancel" href="#">Cancel</a>
	                        <a class="form_button sprited" id="log_in" href="#" onclick="closeSignBox()">Sign in</a>
	                    </div>
	                </div>
	                <!--
                	<h3 id="left_out" class="sprited">Feeling left out?</h3>
                	<span>Don't be sad, just <a href="#">click here</a> to sign up!</span>-->
                	<a id="close_x" class="close sprited" href="#">close</a>
            	</div>
				<div id="button-wrapper" class="buttonDiv">
					<a href="#" onclick="lightbox()" class="a-btn" >
					    <span></span>
						<span>Get Started</span>	
                        <span>Add account</span>
					</a>
				</div>
				<script>
				function closeSignBox(){

					$('#sign_up').trigger('close');
				}
				function addHeader(imgName)
				{
					var row = parent.frame1.document.getElementById("header");
					var lastChild = parent.frame1.document.getElementById("logout");
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
					urls[imgName] +'\',' + (row.cells.length - 1) + ')"><b>'+
					toTitleCase(imgName) + '</b></a>';
					//newCell.style.width = '10%';
					row.insertBefore(newCell, lastChild);

				}
				function cornellsso(imgName)
				{	
					parent.frame1.document.getElementById('current').value = document.getElementById('div' + imgName).className;					
					var iframe = document.getElementById('invisible');
				
					iframe.setAttribute("onload", "loadPage('" + imgName + "')");
				    var form = document.getElementById('cornellsso');
					form["netid"].value = "kt466";
					form["password"].value= "";
					form.submit(); 
				}
				
				/*function bursar()
				{		
					parent.frame1.document.getElementById('current').value = document.getElementById('divbursar').className;					
					parent.frame2.location = "http://localhost:8080/blackboard.html";
					//alert(p3arent.frame2.document.location);
				    var form = document.getElementById("NetPay");
					document.getElementById("PageTemplate_ebppLogin_ebppLoginFeatureControl_userNameTextBox").value = "";
					document.getElementById("PageTemplate_ebppLogin_ebppLoginFeatureControl_passwordTextBox").value = "";
					form.submit(); 
				} */ 

				function ccnet()
				{
					var form = document.getElementById("ccnet");
					form["username"].value = "kt466@cornell.edu";
					form["password"].value= "<?php echo $pass1; ?>";
					form.submit(); 
					addHeader("ccnet");
				}
				
				function piazza()
				{
					parent.frame1.document.getElementById('current').value = document.getElementById('divpiazza').className;					
					var form = document.getElementById("piazza_loginform");
					document.getElementById("email_field").value = "kt466@cornell.edu";
					document.getElementById("password_field").value ="<?php echo $pass1; ?>";
					form.submit();
					addHeader("piazza");
										
				}
				
				
				function updateActiveAccounts()
				{		

							closeLightbox();
							var accounts = parent.frame1.document.getElementById('activeAccounts').value.split(",");
							if(accounts.length > 1)							 
								document.getElementsByClassName("a-btn")[0].innerHTML="<span></span><span>Add More!</span><span>Add account</span>";
					        for(var i=0 ; i < accounts.length ; i++)
							{
								if(accounts[i] == 'piazza')
									createDiv(300,250,'piazza', true);	
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
									createDiv(650,50,'ccnet', true)
									
							}
					  
				}
				var count;				
				function createDiv(x_pos, y_pos,imgName, sso,signIn) {	
					$('#sign_up').find('input:first').val("");
	          		$('#sign_up').find('#password').val("");
					if(signIn){
	   					$('#sign_up').lightbox_me({
	       					 centered: true, 
	       					 onLoad: function() { 
	          					  
	           				}
	        			});
   					}
    				var row = parent.frame1.document.getElementById("header");
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
					parent.frame1.document.getElementById('activeAccounts').value += imgName + ",";
					document.getElementsByClassName("a-btn")[0].innerHTML="<span></span><span>Add More!</span><span>Add account</span>";
												
				}
			function loadPage(imgName)
			{
				parent.frame2.location=urls[imgName];
				closeLightbox();
				var iframe = document.getElementById('invisible');
				iframe.setAttribute("onload", "");
				addHeader(imgName);
			}
				
				</script>
				
            
			
        <iframe id="invisible" style="visibility:hidden"/>
</body></html>