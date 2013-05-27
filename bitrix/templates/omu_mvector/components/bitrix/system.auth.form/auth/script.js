BX.ready(function() {
     $('#logout-link').click(function(e) {
          e.preventDefault();
          $('#logout-form').submit();
   });
});