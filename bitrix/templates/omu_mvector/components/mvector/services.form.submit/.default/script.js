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
          data: msg,
          success: function(data) {
            $('#results').html(data);
          },
          error:  function(xhr, str){
                alert(xhr.responseCode);
          }
        });
    })      
});