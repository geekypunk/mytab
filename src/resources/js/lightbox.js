/****************************************
	Reference: Barebones Lightbox Template
	by Kyle Schaeffer
	http://www.kyleschaeffer.com
	* requires jQuery
****************************************/


// display the lightbox
function lightbox(insertContent, ajaxContentUrl){
	
	var div = document.createElement('allIcons');
	div.style.display='inline-block';
	
	insertContent = '';
	
	$.ajax({
			type: 'GET',
			url: 'getAccounts.php',
			success:function(data){
				data = data.trim();
				var accounts = data.split("|");
				
				for(i=0; i<accounts.length - 1; i++)
				{
					accountId = accounts[i].split(",")[0];
					accountName = accounts[i].split(",")[1];
					coords = coordinates[accountId];
					x = coords.split(",")[0];
					y = coords.split(",")[1];
					//Do not add if the account is already setup
					if(accountId !== '' && document.getElementById('div' + accountId) == null)	
					{
						insertContent += '<div style="display:inline-block;" id="' + accountId + 'Icon">\
								<a href="#" onclick="createDiv(' + x + ',' + y + ',\'' + accountId + '\',true)">\
								<img style="padding-left:18px" src="resources/images/' + accountId +  '.jpg"/></a></div>';						
					}
				}
				
				
				if(insertContent == '' || insertContent == 'undefined')
				{
					document.getElementsByClassName("a-btn")[0].innerHTML = "<span></span><span>Done!!!</span><span></span>";
					document.getElementsByClassName("a-btn")[0].setAttribute("onclick","");
					return;
				}
				
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
			
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
			}
		});
		
	
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