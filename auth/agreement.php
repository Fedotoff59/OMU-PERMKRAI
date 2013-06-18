<?
/*
 * Скрипт показывает пользовательское соглашение
 * 
 */

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
// Получаем необходимые данные из инфоблока
if(CModule::IncludeModule("iblock")): 
    $res = CIBlockElement::GetByID(ID_USER_AGREEMENT);
    $ar_res = $res->GetNext();      
endif;
?>
<script type="text/javascript">
$(document).ready(function(){
   $('#close-popup').click(function() {
        $('#page-ovaerlay').empty();
   });
});
</script>
    <div class="overlay"></div>
    <div class="lightbox">
    <a href="#" class="close" id="close-popup">close</a>
    <div class="clearfix"></div>
        <h1><?=$ar_res['NAME']?></h1>
        <div style="margin-right: 30px;"><?=$ar_res['DETAIL_TEXT']?></div>
    </div>
    
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>
