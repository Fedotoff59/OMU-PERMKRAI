BX.ready(function() {
     $('#chose-location-filter').click(function(e) {
          e.preventDefault();
          var msg = null;
          $.ajax({
            type: 'GET',
            url: '/bitrix/components/mvector/location.choice.links/location-choice-rating-filter.php',
            data: msg,
            success: function(data) {
                $('#page-ovaerlay').html(data);
            },
            error:  function(xhr, str){
                alert(xhr.responseCode);
            }
        });
   });
//   $('#print').click(function(e) {
//        e.preventDefault();
//        var msg = $('#filter-params').serialize();
//        $.ajax({
//            type: 'GET',
//            url: '/export.php',
//            data: msg,
//            success: function(data) {
//                $('#log').html(data);
//            },
//            error:  function(xhr, str){
//                alert(xhr.responseCode);
//            }
//        });
//  });
});	