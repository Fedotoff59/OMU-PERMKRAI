BX.ready(function() {
var mark = ['очень плохо', 'плохо', 'неплохо', 'хорошо', 'очень хорошо'];
		$("div.slider").each(function(i, element) {
			var curAmount = $("span.amount").eq(i);
			var curValue = $("input.val_keeper")[i];
			var markHolder = jQuery(element).parent().find('p > strong');
			
			$(this).slider({
				value: 3,
				min: 1,
				max: 5,
				range: "min",
				animate: false,
				slide: function( event, ui ) 
				{
					curAmount.text(ui.value.toString());
					curValue.value = ui.value;
					markHolder.text(mark[ui.value-1]);
				}
			});
			markHolder.text(mark[$(this).slider('value')-1]);
		});
});