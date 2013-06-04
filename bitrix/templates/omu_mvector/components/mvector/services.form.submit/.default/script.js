BX.ready(function(){
    $("#submit").click(function(){
             $("#criteriasform").submit();
    })
});

BX.ready(function(){    
    $("#criteriasform").submit(function() {
      var msg = $('#criteriasform').serialize();
        $.ajax({
          type: 'POST',
          url: '/bitrix/components/mvector/services.form.submit/ajax-submit.php',
          dataType: 'html',
          data: msg,
          success: function(text) {
            $('#results').html(text);
          },
          error:  function(xhr, str){
                alert(xhr.responseCode);
          }
        });
    })      
});