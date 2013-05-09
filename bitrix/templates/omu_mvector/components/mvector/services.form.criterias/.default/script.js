BX.ready(function() {
    $("div.slider").each(function(i, element) {
        var curAmount = $("span.amount").eq(i);
        var curValue = $("input.val_keeper")[i];
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
                    }
                });
            });
        });