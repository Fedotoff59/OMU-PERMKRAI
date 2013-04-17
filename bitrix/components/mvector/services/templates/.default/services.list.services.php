<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$APPLICATION->IncludeComponent(
    "mvector:services.list.services",
    ".default",
    Array('LOCATION_ALIAS' => $arResult['CUR_LOCATION_ALIAS']
    ), $component
); 
?>
