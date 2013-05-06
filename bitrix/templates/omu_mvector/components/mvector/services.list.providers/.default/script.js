BX.ready(function() {
     $('#chose-service-link').click(function(e) {
          e.preventDefault();
          $.ajax({
            type: 'GET',
            url: '/bitrix/components/mvector/services.list.providers/form-services-choice.php',
            success: function(data) {
                $('#page-ovaerlay').html(data);
            },
            error:  function(xhr, str){
                alert(xhr.responseCode);
            }
        });
   });
});
	