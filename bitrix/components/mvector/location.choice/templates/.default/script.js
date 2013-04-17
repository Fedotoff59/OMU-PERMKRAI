BX.ready(function(){
   
   var addAnswer = new BX.PopupWindow("my_answer", null, {
      content: BX('ajax-add-answer'),
      closeIcon: {right: "20px", top: "10px"},
      titleBar: {content: BX.create("span", {html: '<strong>Выбор муниципального образования</strong>', 'props': {'className': 'access-title-bar'}})}, 
        zIndex: 0,
        offsetLeft: 0,
        offsetTop: 0,
        draggable: {restrict: false},
      buttons: [
         new BX.PopupWindowButton({
            text: "Выбрать",
            className: "popup-window-button-accept",
            events: {click: function(){
                   document.getElementById("locations_select").submit();
                   //BX.ajax.submit(BX("places_select"));//, function(data){ // отправка данных из формы с id="myForm" в файл из action="..."
                    //BX('ajax-add-answer').innerHTML = data;
                //});
                    //$('#click_test').text(BX("places_select").place.value);
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
   $('#click_test').click(function(){
      BX.ajax.insertToNode('/bitrix/components/mvector/popup/locations_choice_form.php', BX('ajax-add-answer'), true); // функция ajax-загрузки контента из урла в #div
      addAnswer.show(); // появление окна
   });
});