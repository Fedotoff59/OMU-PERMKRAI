<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<h2>Поставщики услуги <?echo $arResult['SERVICE_NAME'];?> в МО: <?echo $arResult['LOCATION_NAME'];?></h2>

<ol>
<?
    for($i=0; $i < intval($arResult['COUNT_PROVIDERS']); $i++) 
        {   
?>
    <li><a href="/services/<?echo $arResult['SERVICE_ID'];?>/providers/<?echo $arResult['LOCATION_ALIAS'];?>/<?echo $arResult['PROVIDERS'][$i]['ID'];?>"><?echo $arResult['PROVIDERS'][$i]['NAME'];?></a></li>
<?      } ?>
</ol>