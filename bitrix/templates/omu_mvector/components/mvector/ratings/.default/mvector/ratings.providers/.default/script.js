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
    $("#Sortable").tablesorter({
        headers: {
            0: {sorter: false}
        },
        cssAsc: 'active',
        cssDesc: 'active'
    });
    $('ul.tabs').on('click', 'li:not(.current)', function() {
        $(this).addClass('current').siblings().removeClass('current')
            .parents('div.section').find('div.box').eq($(this).index()).fadeIn(150).siblings('div.box').hide();
        if ($(this).index() == 0)
            $(this).html('Таблица').siblings().html('<a href="#">Диаграмма</a>');
        if ($(this).index() == 1)
            $(this).html('Диаграмма').siblings().html('<a href="#">Таблица</a>');
    })
});	