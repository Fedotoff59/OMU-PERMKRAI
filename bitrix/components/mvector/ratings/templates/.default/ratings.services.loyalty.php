<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$APPLICATION->IncludeComponent(
"mvector:ratings.services.loyalty",
".default",
array('IB_SERVICES_ID' => IB_SERVICES_ID,
        'IB_CRITERIAS_ID' => IB_CRITERIAS_ID,
        'IB_VALUES_ID' => IB_VALUES_ID,
        'IB_LOCATIONS_ID' => IB_LOCATIONS_ID,
        'IB_PROVIDERS_IDS' => IB_PROVIDERS_IDS,
        'SERVICE_ID' => $arResult['VARIABLES']['SERVICE_ID'],
        'SEF_FOLDER' => $arParams['SEF_FOLDER']
), $component
); 
?>