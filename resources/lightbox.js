/****************************************
	Barebones Lightbox Template
	by Kyle Schaeffer
	http://www.kyleschaeffer.com
	* requires jQuery
****************************************/

// display the lightbox
function lightbox(insertContent, ajaxContentUrl){
	
	var div = document.createElement('allIcons');
	div.style.display='inline-block';
	var img = document.createElement("img");
	img.src = "resources/images/piazza.jpg";
	div.appendChild(img);
	insertContent = '';
	//Do not add if the account is already setup
	if(document.getElementById('divpiazza') == null)	
		insertContent = '<div style="display:inline-block;" id="piazzaIcon"><a href="#" onclick="createDiv(300,250,\'piazza\',false,true)"><img style="padding-left:18px" src="resources/images/piazza.jpg"/></a></div>';
	if(document.getElementById('divgannett') == null)
		insertContent += '<div style="display:inline-block;"  id="gannettIcon"><a href="#" onclick="createDiv(750,225,\'gannett\', true,true)"><img  style="padding-left:18px" src="resources/images/gannett.jpg"/></a></div>';
	//if(document.getElementById('divlibrary') == null)
		//insertContent += '<div style="display:inline-block;"  id="libraryIcon"><a href="#" onclick="createDiv(650,50,\'library\')"><img style="padding-left:18px" src="resources/images/library.jpg"/></a></div>';
	if(document.getElementById('divcms') == null)
		insertContent += '<div style="display:inline-block;"  id="cmsIcon"><a href="#" onclick="createDiv(400,50,\'cms\', true,true)"><img  style="padding-left:18px" src="resources/images/cms.jpg"/></a></div>'
	if(document.getElementById('divstudentcenter') == null)
		insertContent += '<div style="display:inline-block;"  id="studentcenterIcon"><a href="#" onclick="createDiv(400,450,\'studentcenter\', true,true)"><img  style="padding-left:18px" src="resources/images/studentcenter.jpg"/></a></div>';
	if(document.getElementById('divblackboard') == null)
		insertContent += '<div style="display:inline-block;"  id="blackboardIcon"><a href="#" onclick="createDiv(650,450,\'blackboard\', true,true)"><img  style="padding-left:18px"src="resources/images/blackboard.jpg"/></a></div>';
	if(document.getElementById('divccnet') == null)
		insertContent += '<div style="display:inline-block;"  id="ccnetIcon"><a href="#" onclick="createDiv(650,50,\'ccnet\',false,true)"><img  style="padding-left:18px"src="resources/images/ccnet.jpg"/></a></div>';
	if(insertContent == '' || insertContent == 'undefined')
	{
		document.getElementsByClassName("a-btn")[0].innerHTML = "<span></span><span>Done!!!</span><span></span>";
		document.getElementsByClassName("a-btn")[0].setAttribute("onclick","");
		return;
	}
	
	// jQuery wrapper (optional, for compatibility only)
	(function($) {
	
		// add lightbox/shadow <div/>'s if not previously added
		if($('#lightbox').size() == 0){
			var theLightbox = $('<div id="lightbox" style="width:470px;"/>');
			var theShadow = $('<div id="lightbox-shadow"/>');
			$(theShadow).click(function(e){
				closeLightbox();
			});
			$('body').append(theShadow);
			$('body').append(theLightbox);
		}
		
		// remove any previously added content
		$('#lightbox').empty();
		
		// insert HTML content
		if(insertContent != null){
			$('#lightbox').append(insertContent);
		}
		
		// insert AJAX content
		if(ajaxContentUrl != null){
			// temporarily add a "Loading..." message in the lightbox
			$('#lightbox').append('<p class="loading">Loading...</p>');
			
			// request AJAX content
			$.ajax({
				type: 'GET',
				url: ajaxContentUrl,
				success:function(data){
					// remove "Loading..." message and append AJAX content
					$('#lightbox').empty();
					$('#lightbox').append(data);
				},
				error:function(){
					alert('AJAX Failure!');
				}
			});
		}
		
		// move the lightbox to the current window top + 100px
		$('#lightbox').css('top', $(window).scrollTop() + 100 + 'px');
		
		// display the lightbox
		$('#lightbox').show();
		$('#lightbox-shadow').show();
	
	})(jQuery); // end jQuery wrapper
	
}

// close the lightbox
function closeLightbox(){
	
	// jQuery wrapper (optional, for compatibility only)
	(function($) {
		
		// hide lightbox/shadow <div/>'s
		$('#lightbox').hide();
		$('#lightbox-shadow').hide();
		
		// remove contents of lightbox in case a video or other content is actively playing
		$('#lightbox').empty();
	
	})(jQuery); // end jQuery wrapper
	
}