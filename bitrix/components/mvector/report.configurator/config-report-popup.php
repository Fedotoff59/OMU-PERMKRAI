<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<script type="text/javascript">
$(document).ready(function(){
   $('#close-popup').click(function() {
        $('#page-ovaerlay').empty();
   });
       $('ul.tabs').on('click', 'li:not(.current)', function() {
        $(this).addClass('current').siblings().removeClass('current')
            .parents('div.section').find('div.box').eq($(this).index()).fadeIn(150).siblings('div.box').hide();
        if ($(this).index() == 0)
            $(this).html('<h2>Выбор территорий</h2>').siblings().html('<a href="#"><h2>Выбор услуг</h2></a>');
        if ($(this).index() == 1)
            $(this).html('<h2>Выбор услуг</h2>').siblings().html('<a href="#"><h2>Выбор территорий</h2></a>');
    })
    $('#submit-form').click(function() {
        $('#choice-params').submit();
    });
});
</script>
<div class="overlay"></div>
<div class="lightbox">
    <a href="#" class="close" id="close-popup">close</a>
    <div class="clearfix"></div>
    <div class="section">
    <div class="btn-row2">
        <ul class="tabset-table tabs" style="float:left">
            <li class="current"><h2>Выбор территорий</h2></li>
            <li><a href="#"><h2>Выбор услуг</h2></a></li>
        </ul>
    </div>
    <form name="service-choice" id="choice-params" action="<?SITE_SERVER_NAME?>">
     <div class="box visible">   

     <?
    $APPLICATION->IncludeComponent(
        "mvector:location.choice.form",
        $_GET['location_tmpl'], // Приходит по ajax
        Array(), 
        false
    ); 
?>
</div>
     <div class="box">   
<?
    $APPLICATION->IncludeComponent(
        "mvector:services.list.services",
        $_GET['service_tmpl'], // Приходит по ajax
        Array(), 
        false
    ); 
?>   
     </div>
        </div>
<div class="clearfix"></div>
<div style="padding: 30px;">
    <div style="float:right">      
        <span class="submit">
            <input type="button" class="btn" id="submit-form" value="Подтвердить выбор" />
            <span class="r"></span>
       </span>
    </div>
</div>
</form>
        </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>
