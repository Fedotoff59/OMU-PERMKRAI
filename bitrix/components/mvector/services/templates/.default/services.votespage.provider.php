<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$APPLICATION->IncludeComponent(
"mvector:services.votespage.provider",
".default",
Array(  'SERVICE_ID' => $arResult['VARIABLES']['SERVICE_ID'],
        'LOCATION_ID' => $arResult['LOCATION']['LOCATION_ID'],
        'LOCATION_NAME' => $arResult['LOCATION']['LOCATION_NAME'],
        'PROVIDER_ID' => $arResult['VARIABLES']['PROVIDER_ID']
), $component
); 
?>