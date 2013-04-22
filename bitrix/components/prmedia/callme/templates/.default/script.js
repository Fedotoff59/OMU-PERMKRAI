$(document).ready(function(){
	// fake inputs [start]
	$('div.call_container table.form_table td.input input.text').focus(function(){
		var def = $(this).attr('data-default');
		var current = $(this).val();
		
		// if current value equals default value - put empty value
		if (def == current)
			$(this).val('');
	});
	
	$('div.call_container table.form_table td.input input.text').blur(function(){
		var def = $(this).attr('data-default');
		var current = $(this).val();
		
		// if there's no value - put default
		if (current == '')
			$(this).val(def);
	});
	// fake inputs [end]

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

function removeGET(getName){
	var res = '';
	var d = location.href.split("#")[0].split("?");  
	var base = d[0];
	var query = d[1];
	if(query) {
		var params = query.split("&");  
		for(var i = 0; i < params.length; i++) {  
			var keyval = params[i].split("=");  
			if(keyval[0]!=getName) {  
				res += params[i] + '&';
			}
		}	
	}
	window.location.href = base + '?' + res;
	return false;
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

function CheckFields()
{
	var def = '';
	var current = '';
	var is_error = false;
	
	$('div.call_container table.form_table td.input input.text').each(function(i, item){
		def = $(item).attr('data-default');
		require = $(item).attr('data-required');
		current = $(item).val();
		
		// если текущее значение - дефолтное или вообще не заполнено, то ошибка
		if ((current == def || current == '') && require == 1){
			is_error = true;
			$(item).addClass('err');
		}
		else{
			$(item).removeClass('err');
		}
	});
	
	if(!is_error){
		$('div.call_container table.form_table td.input input.text').each(function(i, item){
			def = $(item).attr('data-default');
			current = $(item).val();
			require = $(item).attr('data-required');
			
			if(def == current && require == 0)
				$(item).val('');
			
		});		
	}

	if (is_error)
		return false;
	else
		return true;
}