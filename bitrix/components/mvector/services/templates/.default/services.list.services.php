<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$APPLICATION->IncludeComponent(
"mvector:services.list.services",
".default",
array('IB_SERVICES_ID' => $arParams['IB_SERVICES_ID'],
        'LOCATION_ALIAS' => $arParams['LOCATION_ALIAS']
), $component
); 
?>
