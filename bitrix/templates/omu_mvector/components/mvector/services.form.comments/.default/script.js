BX.ready(function(){
    $("#submit-comment").click(function(){
             $("#commentsform").submit();
    })
});

BX.ready(function(){
    $("#commentsform").submit(function(){
        if (!(BX('comment-topic').value == '' || BX('comment-text').value == '')) {
            //var msg = $('#commentsform').serialize();
            var msg = 'comment-topic=' + BX('comment-topic').value + '&comment-text=' + BX('comment-text').value;
            $.ajax({
                type: 'POST',
                url: '/bitrix/components/mvector/services.form.comments/ajax-add-comment.php',
                data: msg,
                success: function(data) {
                    $('.comment-popup h2').html(data);
                    $("#comment-topic").attr('disabled', true);
                    $("#comment-text").attr('disabled', true);
                    $("#submit-comment").attr('disabled', true);
                    alert('Ваш комментарий успешно сохранен!');
                    
                },
                error:  function(xhr, str){
                    alert(xhr.responseCode);
                }
            });
            } else {
                alert('Пожалуйста, заполните все поля!');
            }
    })
});