/** Delegates the rendering task to the required account **/
function showAccount(accountName)
{	
	getDocumentOfFrame(parent.leftframe).getElementById('leftArrow').style.visibility = "visible";
	getDocumentOfFrame(parent.rightframe).getElementById('rightArrow').style.visibility = "visible";
	var row = getDocumentOfFrame(parent.frame1).getElementById("header");
	var lastChild = getDocumentOfFrame(parent.frame1).getElementById("logout");
	found = false;
	for(i=0; i< row.cells.length; i++)
	{
		if(row.cells[i].id == accountName)
		{						    
			getDocumentOfFrame(parent.frame1).getElementById('current').value = i;
			found = true;
			break;
		}
	}
	var iframe = document.getElementById('invisible');

	iframe.setAttribute("onload", "loadPage('" + accountName + "')");
	if(!found)
		getDocumentOfFrame(parent.frame1).getElementById('current').value = row.cells.length - 2;
	
	//Get the account specific renderer
	var fn = window[accountName];
	
	//Call the default account renderer, if there is no specific one
	if(fn == 'undefined' || fn == null)
	{
		fn = window[defaultAccountRenderer];
		fn(accountName);
	}
	else
	{    
		//Call the specific account renderer
		fn();
	}
	
}