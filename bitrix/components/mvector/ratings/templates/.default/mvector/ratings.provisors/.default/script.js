BX.ready(function(){
   
   var ratingLocation = new BX.PopupWindow("rating_locations", null, {
      content: BX('ajax-rating-locations'),
      closeIcon: {right: "20px", top: "10px"},
      titleBar: {content: BX.create("span", {html: '<strong>Выбор муниципального образования</strong>', 'props': {'className': 'access-title-bar'}})}, 
        zIndex: 0,
        offsetLeft: 0,
        offsetTop: 0,
        draggable: {restrict: false},
      buttons: [
         new BX.PopupWindowButton({
            text: "Применить",
            className: "popup-window-button-accept",
            events: {click: function(){
                   this.popupWindow.close(); 
            }}
         }),
         new BX.PopupWindowButton({
            text: "Закрыть",
            className: "webform-button-link-cancel",
            events: {click: function(){
               this.popupWindow.close(); // закрытие окна
            }}
         })
         ]
   }); 
   $('#rating-locations').click(function(){
      BX.ajax.insertToNode('/bitrix/components/mvector/popup/rating_locations_choice_form.php', BX('ajax-rating-locations'), true); // функция ajax-загрузки контента из урла в #div
      ratingLocation.show(); // появление окна
   });
});