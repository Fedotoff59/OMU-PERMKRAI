<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<h1 id="pagetitle"><?$APPLICATION->ShowTitle(false)?></h1>

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
                        <li><a href="<?echo $elID;?>/<?echo $arParams['LOCATION_ALIAS'];?>"><?echo $elName;?></a></li>
                <?  }   ?>
            </ul>
        </li>
<?  } ?>
</ul>