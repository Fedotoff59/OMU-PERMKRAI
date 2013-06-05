<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h2>Выберите услуги</h2>
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
                        <li><input type="checkbox" name="sid_<?=$elID?>" id="service_<?=$elID?>" value="<?=$elID?>"><label for="service_<?=$elID?>"><?=$elName;?></label></li>
                <?  }   ?>
            </ul>
<?  } ?>
                 

</div>