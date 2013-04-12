<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$APPLICATION->IncludeComponent(
"mvector:services.votespage.provider",
".default",
Array('IB_SERVICES_ID' => $arParams['IB_SERVICES_ID'],
        'IB_CRITERIAS_ID' => $arParams['IB_CRITERIAS_ID'],
        'SERVICE_ID' => $arParams['SEF_VARIABLES']['SERVICE_ID'],
        'LOCATION_ID' => $arParams['LOCATION_ID'],
        'LOCATION_NAME' => $arParams['LOCATION_NAME'],
        'IB_VALUES_ID' => $arParams['IB_VALUES_ID'],
        'IB_PROVISORS_ID' => $arParams['IB_PROVISORS_ID'],
        'PROVISOR_ID' => $arParams['SEF_VARIABLES']['PROVISOR_ID']
), $component
); 
?>