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
<form name="service-choice" action="<?SITE_SERVER_NAME?>">
<div class="column"> 
<?
    $i = 0;
    foreach($arResult['SERVICES'] as $sID => $arSectionData)
    {
        if ($i == 5) echo '</div><div class="column">'; // новая колонка после 6-го направления
        $i++;
?>
    <strong><?=$arSectionData['SECTION_NAME'];?></strong>
            <ul>
                <?
                foreach($arSectionData['ELEMENTS'] as $elID => $elName)
                    {
                ?>
                        <li><input type="radio" name="services" id="service_<?=$elID?>" value="<?=$elID?>"><label for="service_<?=$elID?>"><?=$elName;?></label></li>
                <?  }   ?>
            </ul>
<?  } ?>
</div>

<div class="clearfix"></div>
<div style="padding-right: 30px;">
    <div style="float:right">      
        <span class="submit">
            <input type="submit" class="btn" value="Применить фильтр" />
            <span class="r"></span>
       </span>
    </div>
</div>
</form>                  

</div>