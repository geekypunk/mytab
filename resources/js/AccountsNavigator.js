/** Function to support navigation between accounts **/

/** Toggle frames visibility by updating the cols attribute of the frameset **/			
function toggleFrames(imgName) {

	//Show home page if img name is empty
	if(imgName === '')
	{
		parent.frame2.location=urls["home"];
		return;
	}
	
	//Update frame source if empty
	if(imgName !== 'frame2' && imgName !== 'settings')
	{
		var frameSrc = parent.document.getElementById(imgName + 'Frame').src;
		if(frameSrc == 'undefined' || frameSrc === '' || frameSrc === window.location.origin + "/frame.html")
			parent.document.getElementById(imgName + 'Frame').src = urls[imgName];
	}
	
	//Get the content frameset
    var frameset = parent.document.getElementById("content");
	var count=0;
	frameSetCols = "";
	var frameIndex = -1;
	
	//Update the frameset cols, to make the frame corresponding to this imgName visible
	for(i=1;i<frameset.children.length - 1;i++)
	{
	    var frame = frameset.children[i];
		if(frameSetCols !== '')
		{
			frameSetCols += ","
			frameIndex = i;
		}
		if(frame.id === imgName + 'Frame' || frame.id === imgName)
		{
			frameSetCols += "*";
			
		}
		else
		{
			frameSetCols += "0%";
		}
		
	}
	frameset.cols= "5%," + frameSetCols + ",5%";
}

/** Change the content frame **/				
function changeMainFrame(location, number)
{
     var arrowVisibility = "hidden";
	 var index = 0;
	 
	 //If location is home, reload home page and make it visible
	 if(location === 'home')
	 {
		parent.frame2.location=urls[location];
		
	 }
	 //If location is settings, make the settings page visible
	 else if(location === 'settings')
	 {
		toggleFrames('settings');
	 }
	 //Toggle the frames for accounts
	 else
	 {
		arrowVisibility = "visible";
		
		var cellsLength = getDocumentOfFrame(parent.frame1).getElementById('header').cells.length;
		index = getDocumentOfFrame(parent.frame1).getElementById('current').value;
		
		//Link in navigation bar
		if(number!= undefined)
		{
			index = number;
		}
		
		//Left arrow
		if(location == 'left')
		{
			index --;
			if(index == -1)
			{
				index = cellsLength - 2;
			}		
		}
		
		//right arrow
		else if(location == 'right')
		{
			index ++;		
			if(index >= cellsLength - 2)
			{
				index = 0;
			}
		}
		
		//home page
		if(index == 0)
		{
			arrowVisibility = 'hidden';
			parent.frame2.location=urls['home'];			
		}
		
		//Other accounts
       	 else
		{
			toggleFrames(getDocumentOfFrame(parent.frame1).getElementById('header').cells[index].id);
		}
	}
	
	//Update current account selected
	getDocumentOfFrame(parent.frame1).getElementById('current').value = index;
	
	//Toggle navigation arrows visibility
	getDocumentOfFrame(parent.leftFrame).getElementById('leftArrow').style.visibility = arrowVisibility;
	getDocumentOfFrame(parent.rightFrame).getElementById('rightArrow').style.visibility = arrowVisibility;
	  
}

/** Toggle Accounts **/
function toggleAccount(imgName)
{	
	toggleFrames(imgName);
	addHeader(imgName);
}

/** Add link for account in navigation bar. **/
function addHeader(imgName)
{	
	if(imgName == '')
		return;
		
	var row = getDocumentOfFrame(parent.frame1).getElementById("header");
	
	//Return if header is already added
	for(i=0; i< row.cells.length; i++)
	{
		if(row.cells[i].id == imgName)
		{
			return;
		}
	}
	
	//Retrieve the logged in accounts from session
	$.ajax({
	       type: "POST",
		url: 'track_logged_in_accounts.php',
		data: {
                   	account: imgName
       		},
		success: function(data) {	
					   }
		});
	
	//Add to header before settings link 
	var lastChild = getDocumentOfFrame(parent.frame1).getElementById("settings");

	//Add otherwise
	var newCell = document.createElement("td");
	newCell.id = imgName;
	newCell.innerHTML = '<a href="javascript:changeMainFrame(\''+
	imgName +'\',' + (row.cells.length - 2) + ')"><b>'+
	toTitleCase(imgName) + '</b></a>&nbsp;&nbsp;<button style="height:20px;width:20px" class="ui-button ui-close-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close" role="button" aria-disabled="false" title="Log Out" \
       onclick="logoutFromIndividualAccount(\'' + imgName + '\')"><span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span class="ui-button-text"></span></button>';
	
	row.insertBefore(newCell, lastChild);
}

/** Removes link from navigation header **/
function removeHeader(imgName)
{
	var row = getDocumentOfFrame(parent.frame1).getElementById("header");
	
	//Remove from header
	for(i=0; i< row.cells.length; i++)
	{
		if(row.cells[i].id == imgName)
		{
			row.deleteCell(i);
			break;
		}
	}
	
	//Server request to delete the account from database
	$.ajax({
		type: "POST",
		url: 'track_logged_in_accounts.php',
		data: {
				account: imgName,
				delete: true
			},
		 success: function(data) {	
		 }
	});
}

/** Logout from an individual account **/
function logoutFromIndividualAccount(imgName)
{
	parent.document.getElementById(imgName + 'Frame').setAttribute("onload", "");
	parent.document.getElementById(imgName + 'Frame').src = logoutUrls[imgName];
	parent.document.getElementById(imgName + 'Frame').location = logoutUrls[imgName];
	
	//Remove the link from navigation header
	removeHeader(imgName);
	
	//Switch back to home screen
	changeMainFrame('home');
}

/** Log out from all the previously logged in accounts **/
function logoutFromAllAccounts()
{	
	
	//Switch back to home screen
    changeMainFrame('home');
   var row = getDocumentOfFrame(parent.frame1).getElementById("header");
   
   //No logged in accounts
   if(row.cells.length == 3)
   {
		logout();
   }
	for(i=1; i< row.cells.length - 2; i++)
	{
		imgName = row.cells[i].id;
		
		//Last account to be logged out
		if(i == row.cells.length - 3)
		{
			parent.document.getElementById(imgName + 'Frame').setAttribute("onload", "logout()");
		}
		else
			parent.document.getElementById(imgName + 'Frame').setAttribute("onload", "");
		parent.document.getElementById(imgName + 'Frame').src = logoutUrls[imgName];
		parent.document.getElementById(imgName + 'Frame').location = logoutUrls[imgName];		
	}
}

function logout()
{
	window.open("logout.php", "_parent");
}