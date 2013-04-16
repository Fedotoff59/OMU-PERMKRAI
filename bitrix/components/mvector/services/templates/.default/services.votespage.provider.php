<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$APPLICATION->IncludeComponent(
"mvector:services.votespage.provider",
".default",
Array(  'SERVICE_ID' => $arParams['SEF_VARIABLES']['SERVICE_ID'],
        'LOCATION_ID' => $arParams['LOCATION_ID'],
        'LOCATION_NAME' => $arParams['LOCATION_NAME'],
        'PROVISOR_ID' => $arParams['SEF_VARIABLES']['PROVISOR_ID']
), $component
); 
?>