BX.ready(function(){$("#subscribe").click(function(){
			var Dialog = new BX.CDialog({
								title: "Подписка на рассылку",
								head: "Рассылка отчетов по оценке качества муниципальных услуг",
								content: 	'<form method="POST" id="subscribe_form">\
										<label for="subscribe">Введите ваш e-mail:</label>\
                                                                                <input type="text" name="subscribe" id="subscribe" value="">\
                                                                                </form>',
								resizable: false,
								height: '100',
								width: '400'});

			Dialog.SetButtons([
            {
                'title': 'Отправить',
				'id': 'action_send',
				'name': 'action_send',
                'action': function(){
					BX.ajax.submit(BX("subscribe_form"));
                    this.parentWindow.Close();
                }
            },
			{
                'title': 'Отмена',
				'id': 'cancel',
				'name': 'cancel',
                'action': function(){
                    this.parentWindow.Close();
                }
            }
			]);
			Dialog.Show();
});
});