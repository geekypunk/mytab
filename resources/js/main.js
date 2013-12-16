/** All Javascript functionalities related to Main page **/

/** Load the thumbnails for the accounts that are already set up and add headers for logged in accounts **/
$(document).ready(function(){
		
	//Arrows should be invisible in home page
	getDocumentOfFrame(parent.leftframe).getElementById('leftArrow').style.visibility = "hidden";
	getDocumentOfFrame(parent.rightframe).getElementById('rightArrow').style.visibility = "hidden";	
	
	//Close the light box
	closeLightbox();
	
	//Retrieve the configured accounts from database
	$.ajax({
			type: "POST",
			url: 'update_accounts.php',
			data: {
			email : $("#email").val()
			},
			success: function(data)
			{
				data = data.trim();
				
				//Accounts set up
				var accounts = data.split("|")[0].split(",");
				
				//Logged in accounts for the current session
				var loggedInAccounts = data.split("|")[1].split(",");
				
				
				/*
				* Add the thumbnails for the accounts. Length of accounts Array is 1 when no accounts have been added yet
				*/				
				for(var i=0 ; i < accounts.length ; i++)
				{	
				   if(accounts[i].trim() !== '')
				   {
					var coords = coordinates[accounts[i].trim()]; 
					x = coords.split(",")[0];
					y = coords.split(",")[1];
					createDiv(x,y,accounts[i], false);
				   }					
				} 						 
					
				// Add the logged in accounts of the current session to header navigation bar
				for(var i=0 ; i < loggedInAccounts.length ; i++)
				{
					if($.inArray(loggedInAccounts[i], accounts) !== -1){
						addHeader(loggedInAccounts[i]);
					}						
				}
				
				//Update the central button content
				if(accounts.length == 1)
				{
					$("#a-btn").html("<span></span><span>Get Started</span><span></span>");									

				}				
				/*Because of an extra "" in the array*/
				else if(accounts.length == 7)
				{
					$("#a-btn").html("<span></span><span>Done!!!</span><span></span>");									

				}				
				else
				{							 
					document.getElementsByClassName("a-btn")[0].innerHTML="<span></span><span>Add More!</span><span>Add account</span>";
				}									
		}
	});	

	//Make sure that the home frame is visisble
	toggleFrames('frame2');		

	/** Log-in handler for accounts **/
	 $('#log_in').click(function(e) {
		e.preventDefault();
		if($("#signup_username").val().trim().length !== 0 || $("#signup_username").val().trim().length !== 0){
			$.ajax({
			   type: "POST",
			   url: 'signup.php',
			   data: {
				
					//Encode to prevent cross-site attack
					signup_username: encodeURI($("#signup_username").val()),
					signup_password: encodeURI($("#signup_password").val()),
					email : encodeURI($("#email").val()),
					account: encodeURI($("#accountSelected").val())
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
});

var count;				

/** Creates the thumbnail with edit and delete icon for each image **/
function createDiv(x_pos, y_pos,imgName, signIn) {

    
    if(imgName === '')
		return;
		
	//Update account selected
	$("#accountSelected").val(imgName);	
	
	//Initialize sign up form
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
    
	//Get the header navigation bar
	var row = getDocumentOfFrame(parent.frame1).getElementById("header");
	
	//Create a div for the account selected
	var divName = 'div'+imgName;
	var div = document.createElement("div");
	div.id=divName;
	div.className = row.cells.length - 1;
	var img = document.createElement("img");
	img.style.position = "absolute";
	img.style.left = x_pos+'px';
	img.style.top = y_pos+'px';
	img.style.cursor = 'pointer';
	img.src = "resources/images/"+imgName+".jpg";
	img.setAttribute("onclick", "showAccount('" + imgName +"')");
	div.appendChild(img);
	document.body.appendChild(div);
	
	//Close the lightbox
	closeLightbox();
	
	//Update the active Accounts field
	var addedAccounts = getDocumentOfFrame(parent.frame1).getElementById('activeAccounts').value.split(',');
	if(addedAccounts.indexOf(imgName) == -1){
		getDocumentOfFrame(parent.frame1).getElementById('activeAccounts').value += imgName + ",";
	}
	
	//Update the central button text
	if(getDocumentOfFrame(parent.frame1).getElementById('activeAccounts').value.split(",").length >= 7)
	{
		$("#a-btn").html("<span></span><span>Done!!!</span><span></span>)");
	}
	else
	$("#a-btn").html("<span></span><span>Add More!</span><span>Add account</span>");	
		
	//Add edit image
	addEditImage(div, divName, img, imgName, x_pos, y_pos);
	
	//Add close image
	addDeleteImage(div, divName, img, imgName, x_pos, y_pos);                    
          
	//Get the content frameset
	frameset = parent.document.getElementById('content');
	frameFound = false;
	
	//Check whether the frame is already added
	for(j=1;j<frameset.children.length - 1;j++)
	{
		if(frameset.children[j].id == imgName +'Frame')
		{
			frameFound = true;
			break;
		}
	}
	
	//Add the frame if not added
	if(!frameFound)
	{
		var frame = parent.document.createElement('frame');
		frame.name=imgName +'Frame';
		frame.id = imgName + 'Frame';
		
		frame.noresize = "noresize";
		var lastFrame = parent.document.getElementById('rightFrame');
			
		frameset.insertBefore(frame, lastFrame);
		
		//Update the frameset cols
		frameset.cols=frameset.cols.replace(',5%', ',0%,5%');
	}		
}


/** Called when the acccounts' thumbnail is clicked. 
This is an onload event for the frame 'invisible', and is responsible for making the correct account visible **/
function loadPage(imgName)
{  

	//Close lightbox
	closeLightbox();
	
	//Clear the onload event to avoid recursive calling
	var iframe = document.getElementById('invisible');
	iframe.setAttribute("onload", "");
	
	//Get the header row
	var row = getDocumentOfFrame(parent.frame1).getElementById("header");

	//Find if the account is logged in
	loggedIn = false;
	for(i=0; i< row.cells.length; i++)
	{
		if(row.cells[i].id == imgName)
		{
			loggedIn = true;			
			break;
		}
	}			
	
	//If the account is in exception list defined in constants.js, open it in a new window
	if($.inArray(imgName, accountExceptions) !== -1 && !loggedIn)
	{					
			var win = window.open(urls[imgName], '_newtab');
			win.focus();	
			addHeader(imgName)
	}	
	
	//Otherwise reload the corresponding frame, and make it visible
	else 
	{
		parent.document.getElementById(imgName+'Frame').setAttribute('onload','toggleAccount("' + imgName + '")');
		parent.document.getElementById(imgName+'Frame').src=urls[imgName];		
		parent.document.getElementById(imgName+'Frame').location=urls[imgName];					
	}
}
		 
/** Update account credentials **/
 function editCredentials(username,password){
	 $.ajax({
	   type: "POST",
	   url: 'update.php',
	   data: {
	   
			//Encode to prevent cross site attack
			new_username: encodeURI(username),
			new_password: encodeURI(password),
			username : encodeURI($("#email").val()),
			accountid: encodeURI($("#accountSelected").val())
	   },
	   success: function(data)
	   {		
			data = data.trim();
			parent.document.getElementById($("#accountSelected").val() +'Frame').setAttribute('onload',"");
			parent.document.getElementById($("#accountSelected").val() + 'Frame').src=urls[$("#accountSelected").val()];
	   }
   });   
   $('#editForm').trigger('close');	
 }

/** Remove account thumbnail. Called on deletion of account **/		 
function removeThumbnail(){
	var selectedAcc = $("#accountSelected").val();
	$('#div'+selectedAcc).remove();
	
	//Update the central button text
	$("#a-btn").html("<span></span><span>Add More!</span><span>Add account</span>");
}

/** Creates and appends edit image for the given account **/
function addEditImage(div, divName, img, imgName, x_pos, y_pos)
{
	//Append edit image to document
	var editImg = document.createElement("img");
	editImg.style.position = "absolute";
	editImg.style.left = x_pos-38+'px';
	editImg.style.top = y_pos+'px';
	editImg.style.cursor = 'pointer';
	editImg.src = "resources/images/document-edit.png";
	editImg.title = imgName;
	div.appendChild(editImg);
	$(editImg).hide();
	
	//On click handler for edit image
	$(editImg).click(function() {

			//Get the account name from title attribute of the image
			var selectedAccId = $(this).attr("title");
			$("#accountSelected").val(selectedAccId);
			$.ajax({
						type: "GET",
						url: 'get_acc_details.php',
						data: {
							username : $("#email").val(),
							accountid: selectedAccId,
						},
						 success: function(data) {	
						 	data = data.trim();
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
	
	//Show the edit image only on hovering over this div
	$('#'+divName).mouseover(function() {
		$(editImg).show();;

	});
	$('#'+divName).mouseout(function() {
		$(editImg).hide();
	});
}

/** Creates and appends delete image for the given account **/
function addDeleteImage(div, divName, img, imgName, x_pos, y_pos)
{
	//Create close image
	var closeImg = document.createElement("img");
	closeImg.style.position = "absolute";
	closeImg.style.top = parseInt(y_pos) + 30 +'px';
	closeImg.style.cursor = 'pointer';
	closeImg.src = "resources/images/closeBlueIcon.jpg";
	closeImg.title = imgName;
	var offsetWidth = 0;
	
	//Adjust the width.
	if(img.naturalWidth === 0){		
		closeImg.style.left = parseInt(x_pos) + map[imgName] +'px';
	}
	else{	
		closeImg.style.left = parseInt(x_pos) +img.naturalWidth +'px';
	}
	div.appendChild(closeImg);
	$(closeImg).hide();
	
	//Add onclick handler
	$(closeImg).click(function() {
		var selectedAccId = $(this).attr("title");
		$(div).remove();
		$.ajax({
		   type: "POST",
		   url: 'delete_account.php',
		   data: {
				username : $("#email").val(),
				accountid: selectedAccId
		   },
		   success: function(data)
		   {
				data = data.trim();
				$("#a-btn").html("<span></span><span>Add More!</span><span>Add account</span>");
				document.getElementById('a-btn').setAttribute('onclick', 'lightbox()');

				var row = getDocumentOfFrame(parent.frame1).getElementById("header");
				
				//Update the activeAccounts field
				var addedAccounts = getDocumentOfFrame(parent.frame1).getElementById('activeAccounts').value.split(',');
				for (var i=addedAccounts.length-1; i>=0; i--) {
					
					if (addedAccounts[i] === selectedAccId) {
						
						addedAccounts.splice(i, 1);
						
					}
				}
				
				//Remove from the header, if the account was logged in
				getDocumentOfFrame(parent.frame1).getElementById('activeAccounts').value = addedAccounts.join(',');				
				removeHeader(selectedAccId);
				alert("Account "+selectedAccId+" has been deleted!");
		   }
	   });
	});
	
	//Show the delete images only on hovering over this div
	$('#'+divName).mouseover(function() {
		$(closeImg).show();;

	});
	$('#'+divName).mouseout(function() {
		$(closeImg).hide();
	});
	
}
