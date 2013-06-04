BX.bind(document, "keypress", SendError);

function SendError(event, formElem)
{
		event = event || window.event;

		if((event.ctrlKey) && ((event.keyCode == 0xA)||(event.keyCode == 0xD)))
		{
			var Dialog = new BX.CDialog({
								title: "На сайте обнаружена ошибка!!",
								head: "В чём заключается ошибка?",
								content: 	'<form method="POST" id="help_form">\
											<textarea name="error_desc" style="height: 78px; width: 374px;"></textarea>\
											<input type="hidden" name="error_message"value="'+getSelectedText()+'">\
											<input type="hidden" name="error_url" value="'+window.location+'">\
											<input type="hidden" name="error_referer" value="'+document.referrer+'">\
											<input type="hidden" name="error_useragent" value="'+navigator.userAgent+'">\
											<input type="hidden" name="sessid" value="'+BX.bitrix_sessid()+'"></form>',
								resizable: false,
								height: '198',
								width: '400'});

			Dialog.SetButtons([
            {
                'title': 'Отправить',
				'id': 'action_send',
				'name': 'action_send',
                'action': function(){
					BX.ajax.submit(BX("help_form"));
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
		}
}
function getSelectedText(){
  if (window.getSelection){
    txt = window.getSelection();
  }
  else if (document.getSelection) {
    txt = document.getSelection();
  }
  else if (document.selection){
    txt = document.selection.createRange().text;
  }
  else return;
  return txt;
}