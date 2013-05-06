<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
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
		<h2>Выберите услугу</h2>
<div class="column"> 
<?
    $i = 0;
    foreach($arResult['SERVICES'] as $sID => $arSectionData)
    {
        if ($i == 5) echo '</div><div class="column">';
        $i++;
?>
    <strong><?=$arSectionData['SECTION_NAME'];?></strong>
            <ul>
                <?
                foreach($arSectionData['ELEMENTS'] as $elID => $elName)
                    {
                ?>
                        <li><a href="http://<?=SITE_SERVER_NAME?>/services/<?=$elID;?>/<?=$arResult['LOCATION_ALIAS'];?>/"><?=$elName;?></a></li>
                <?  }   ?>
            </ul>
<?  } ?>
</div>