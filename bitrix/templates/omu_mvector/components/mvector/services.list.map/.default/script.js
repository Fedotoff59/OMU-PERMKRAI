BX.ready(function(){
$('#chose-radio-service-link').click(function(e) {
          e.preventDefault();
          $.ajax({
            type: 'GET',
            url: '/bitrix/components/mvector/services.list.services/map-services-choice.php',
            success: function(data) {
                $('#page-ovaerlay').html(data);
            },
            error:  function(xhr, str){
                alert(xhr.responseCode);
            }
        });
   });
});