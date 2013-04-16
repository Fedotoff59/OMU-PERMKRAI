<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$APPLICATION->IncludeComponent(
"mvector:services.list.services",
".default",
Array('LOCATION_ALIAS' => $arParams['LOCATION_ALIAS']
), $component
); 
?>
