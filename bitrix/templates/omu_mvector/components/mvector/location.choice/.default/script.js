BX.ready(function() {
     $('#chose-location-link').click(function(e) {
          e.preventDefault();
          var msg = null;
          $.ajax({
            type: 'GET',
            url: '/bitrix/components/mvector/location.choice/form-location-choice.php',
            data: msg,
            success: function(data) {
                $('#page-ovaerlay').html(data);
            },
            error:  function(xhr, str){
                alert(xhr.responseCode);
            }
        });
   });
});
	