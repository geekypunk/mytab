var current;
var urls = {};
urls["piazza"] = "https://piazza.com/class";
urls["store"] = "https://store.cornell.edu/signin.aspx";
urls["bursar"] = "https://bosebill.salliemae.com/NetPay/EBPP/SYR/Tuition+and+Fees/313/EBPP.aspx";
urls["cms"] = "https://cms.csuglab.cornell.edu/web/auth/?action=loginview";
urls["studentcenter"] = "http://studentcenter.cornell.edu";
urls["library"]= "http://www.library.cornell.edu/myacctpage";
urls["home"]= "main.php";
urls["gannett"] = "https://mygannett.gannett.cornell.edu";
//urls["gannett"]="http://www.videonote.com/cornell";
urls["blackboard"] = "https://blackboard.cornell.edu/webapps/portal/execute/tabs/tabAction?tab_tab_group_id=_1_1";
//urls["blackboard"] = "http://localhost:8080/blackboard.html";
urls["ccnet"] = "https://cornell-students.experience.com/stu/home";
urls["settings"] = "dialog.php";

var accounts = [];
function toTitleCase(toTransform) {
  return toTransform.replace(/\b([a-z])/g, function (_, initial) {
      return initial.toUpperCase();
  });
}

function getDocumentOfFrame1(){

	var m = navigator.userAgent.match(/Firefox\/(\d+)\./);
	if (m && m[1] > 15) {
	  // .... firefox 15 and above ...
		return parent.frame1.contentDocument;
	}else
	{
		return parent.frame1.document;
	}
			
}

function getDocumentOfFrame(frame)
{
	//var m = navigator.userAgent.match(/Firefox\/(\d+)\./);
	if(frame.document !== undefined){
		return frame.document;
	}
	/*
	else if (m && m[1] > 15 || frame.document === undefined) {
	  // .... firefox 15 and above ...
		return frame.contentDocument;
	}*/
	else
	{
		return frame.contentDocument;
	}
}
				
function changeMainFrame(location, number)
{
    
   	var cellsLength = getDocumentOfFrame(parent.frame1).getElementById('header').cells.length;
	var index = getDocumentOfFrame(parent.frame1).getElementById('current').value;
	if(location == 'settings')
	{
		location = urls['settings'];
		getDocumentOfFrame(parent.leftFrame).getElementById('leftArrow').style.visibility = "hidden";
		getDocumentOfFrame(parent.rightFrame).getElementById('rightArrow').style.visibility = "hidden";		
	}
       else{
	if(number!= undefined)
	{
		index = number;
	}
	if(location == 'left')
	{
		index --;
		if(index == -1)
		{
			index = cellsLength - 2;
		}
		location = urls[getDocumentOfFrame(parent.frame1).getElementById('header').cells[index].id];
	}
	else if(location == 'right')
	{
		index ++;		
		if(index >= cellsLength - 2)
		{
			index = 0;
		}
		location = urls[getDocumentOfFrame(parent.frame1).getElementById('header').cells[index].id];
	}
      else if(location == 'home')
      {
               index = 0;
		 location = urls["home"];
	}
	
	else
	{
		location=urls[getDocumentOfFrame(parent.frame1).getElementById('header').cells[index].id];
	}
	getDocumentOfFrame(parent.frame1).getElementById('current').value = index;
      
   	if(index != 0)
   	{
		getDocumentOfFrame(parent.leftFrame).getElementById('leftArrow').style.visibility = "visible";

		getDocumentOfFrame(parent.rightFrame).getElementById('rightArrow').style.visibility = "visible";

	}
	if(location == undefined)
	{
		location = urls["home"];
	}
	}
	if(parent.frame2 === undefined)
		parent.frames[2].location=location;
	else
		parent.frame2.location=location;	
  
}



