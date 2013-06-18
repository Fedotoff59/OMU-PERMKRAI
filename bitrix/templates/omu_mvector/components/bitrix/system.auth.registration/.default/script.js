BX.ready(function() {  
     $('#agreement-link').click(function(e) {
          e.preventDefault();
          window.scrollTo(0,0);
          var msg = null;  
          $.ajax({
            type: 'GET',
            url: '/auth/agreement.php',
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
function check_register_form ()
    {
        var cb_pd_agreement = document.getElementById('agreement');
        if(!cb_pd_agreement.checked)
        {
            alert('Для регистрации необходимо принять соглашения на обработку персональных данных.');
            return false;
        }   
        return true;
    } 
