BX.ready(function(){
$('#chose-radio-service-link').click(function(e) {
          e.preventDefault();
          var msg = 'service_tmpl=map';
          $.ajax({
            type: 'GET',
            data: msg,
            url: '/bitrix/components/mvector/services.list.services/popup-services-choice.php',
            success: function(data) {
                $('#page-ovaerlay').html(data);
            },
            error:  function(xhr, str){
                alert(xhr.responseCode);
            }
        });
   });
});