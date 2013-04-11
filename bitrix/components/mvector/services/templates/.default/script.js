            BX.ready(function(){ 
            var commentForm = new BX.PopupWindow("addcomment", null, {
                content: BX('ajax-commentform'),
                closeIcon: {right: "20px", top: "10px"},
                titleBar: {content: BX.create("span", {html: '<strong>Добавить комментарий</strong>', 'props': {'className': 'access-title-bar'}})}, 
                zIndex: 0,
                offsetLeft: 0,
                offsetTop: 0,
                draggable: {restrict: false},
                buttons: [
                    new BX.PopupWindowButton({
                            text: "Отправить",
                            className: "popup-window-button-accept",
                            events: {
                                click: function(){
                                    //, function(data){ // отправка данных из формы с id="myForm" в файл из action="..."
                                    var topic = BX('comment-topic').value;
                                    var text = BX('comment-text').value;
                                    if (!(BX('comment-topic').value == '' || BX('comment-text').value == '')){

                                        BX.ajax.submit(BX("add-comment-form"),
                                        function(data){ BX('ajax-commentform').innerHTML = data;
                                        });
                                        
                                        function closeform() {
                                            commentForm.close();
                                        }

                                        
                                        
                                        setTimeout(closeform, 3000); 
                                    } else BX('add-comment-message').text = 'Комментарий сохранен!';
                                }
                            }
                        }),
                    new BX.PopupWindowButton({
                            text: "Закрыть",
                            className: "webform-button-link-cancel",
                            events: {
                                click: function(){
                                    this.popupWindow.close(); // закрытие окна
                                }
                            }
                    })
                ] //end buttons
                }); 
                
                $('#link-toaddcomment').click(function(){
                    BX.ajax.insertToNode('/bitrix/components/mvector/popup/add_comment_form.php', BX('ajax-commentform'), false);
                    // функция ajax-загрузки контента из урла в #div
                    commentForm.show(); // появление окна
                });
           });