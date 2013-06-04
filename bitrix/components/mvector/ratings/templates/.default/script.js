BX.ready(function(){
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