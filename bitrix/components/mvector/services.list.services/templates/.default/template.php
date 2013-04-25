<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<ul>
<?
    foreach($arResult as $sID => $arSectionData)
    {
?>
        <li><?echo $arSectionData['SECTION_NAME'];?>
            <ul>
                <?
                foreach($arSectionData['ELEMENTS'] as $elID => $elName)
                    {
                ?>
                        <li><a href="services/<?=$elID;?>/<?=$arParams['LOCATION_ALIAS'];?>"><?=$elName;?></a></li>
                <?  }   ?>
            </ul>
        </li>
<?  } ?>
</ul>