<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<h2>Поставщики услуги <?=$arResult['SERVICE_NAME'];?> в МО: <?=$arResult['LOCATION_NAME'];?></h2>

<ol>
<?
    for($i=0; $i < intval($arResult['COUNT_PROVIDERS']); $i++) 
        {   
?>
    <li><a href="/services/<?=$arResult['SERVICE_ID'];?>/providers/<?=$arResult['LOCATION_ALIAS'];?>/<?=$arResult['PROVIDERS'][$i]['ID'];?>/"><?=$arResult['PROVIDERS'][$i]['NAME'];?></a></li>
<?      } ?>
</ol>