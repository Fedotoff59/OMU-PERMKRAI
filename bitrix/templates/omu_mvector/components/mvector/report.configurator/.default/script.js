BX.ready(function() {
    $('#config-report-filter').click(function(e) {
          e.preventDefault();
          var msg = 'service_tmpl=checkbox&location_tmpl=checkbox';
          $.ajax({
            type: 'GET',
            url: '/bitrix/components/mvector/report.configurator/config-report-popup.php',
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
	