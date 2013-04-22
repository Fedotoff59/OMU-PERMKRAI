$(document).ready(function(){
	// close popup
	$('div.call_popup div.close').click(function(){ 
		closePopup($(this).parent());
	});
	
	// show popup
	$('span.call').click(function(){ 
		var popup=$(this).parent().find('div.call_popup');
		popupPosition(popup);
		showPopup(popup);
	});
	
	//wrap
	if($('div.call_popup').hasClass('type1')){
		$('div.call_popup.type1').wrap('<div class="call_wrapper"></div>');
	}
	// position
	if($('div.call_popup').hasClass('vis')){
		popupPosition($('div.call_popup'));
	}
	
});

$(document).click(function(e){ 
	if (($(e.target).parents().filter('div.call_container').length != 1 && $('div.call_popup').is(':visible')) || $(e.target).filter('div.call_wrapper:visible').length) {
		closePopup($('div.call_popup'));
	}
});	

// functions

function showPopup(popup){
	popup.removeClass('hid').addClass('vis').find('div.response').html('');
	popup.find('table.form_table').removeClass('hid').addClass('vis');
}

function closePopup(popup){
	popup.removeClass('vis').addClass('hid');
	if(popup.hasClass('type1')) popup.parent('div.call_wrapper').hide();
}

function popupPosition(popup){
	var link=popup.parent().find('span.call');

	if(popup.hasClass('type0')){
		popup.find('div.arrow').show();
		var linkLeft=link.position().left;
		var linkTop=link.position().top;
		var linkPopupDiff=15; // difference between popup and link in px
		
		popup.css({'left':linkLeft,'top':(linkTop+link.height()+linkPopupDiff)});
	}
	else if(popup.hasClass('type1')){
		popup.parent('div.call_wrapper').show();
		popup.css('margin-top',-1*(popup.height()/2));
	}
}

function CheckFields(){ // check form fields function
	var trigger=true;
	$('div.call_container input.required').removeClass('err');
		
	$('div.call_container input.required,div.call_container textarea.required').each(function(){
		if($(this).val()==''){
			$(this).addClass('err');
			trigger=false;
		}
	});
	
	if(trigger==false){
		return false;
	}
	else return true;
}
