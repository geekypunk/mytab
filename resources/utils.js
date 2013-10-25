var current;
var urls = {};
urls["piazza"] = "https://piazza.com/class";
urls["store"] = "https://store.cornell.edu/signin.aspx";
urls["bursar"] = "https://bosebill.salliemae.com/NetPay/EBPP/SYR/Tuition+and+Fees/313/EBPP.aspx";
urls["cms"] = "https://cms.csuglab.cornell.edu/web/auth/?action=loginview";
urls["studentcenter"] = "http://studentcenter.cornell.edu";
urls["library"]= "http://www.library.cornell.edu/myacctpage";
urls["home"]= "../beta2/main.php";
urls["gannett"] = "https://mygannett.gannett.cornell.edu";
urls["blackboard"] = "https://blackboard.cornell.edu/webapps/portal/execute/tabs/tabAction?tab_tab_group_id=_1_1";
//urls["blackboard"] = "http://localhost:8080/blackboard.html";
urls["ccnet"] = "https://cornell-students.experience.com/stu/home";

var accounts = [];
function toTitleCase(toTransform) {
  return toTransform.replace(/\b([a-z])/g, function (_, initial) {
      return initial.toUpperCase();
  });
}


				
function changeMainFrame(location, number)
{
    var cellsLength = parent.frame1.document.getElementById('header').cells.length;
	var index = parent.frame1.document.getElementById('current').value;
	if(location == 'left')
	{
		index --;
		if(index == -1)
		{
			index = cellsLength - 2;
		}
		location = urls[parent.frame1.document.getElementById('header').cells[index].id];
	}
	 if(location == 'right')
	{
		index ++;
		if(index == cellsLength - 1)
		{
			index = 0;
		}
		location = urls[parent.frame1.document.getElementById('header').cells[index].id];
	}
	parent.frame1.document.getElementById('current').value = index;
      parent.frame2.location=location;
  
}



