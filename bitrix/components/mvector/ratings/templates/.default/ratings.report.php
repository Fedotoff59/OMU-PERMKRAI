<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$APPLICATION->IncludeComponent(
"mvector:ratings.report",
".default",
array('IB_SERVICES_ID' => $arParams['IB_SERVICES_ID'],
        'IB_CRITERIAS_ID' => $arParams['IB_CRITERIAS_ID'],
        'IB_VALUES_ID' => $arParams['IB_VALUES_ID'],
        'IB_LOCATIONS_ID' => $arParams['IB_LOCATIONS_ID'],
        'IB_PROVISORS_ID' => $arParams['IB_PROVISORS_ID'],
        'SEF_VARIABLES' => $arParams['SEF_VARIABLES'],
        'SEF_FOLDER' => $arParams['SEF_FOLDER']
), $component
); 
?>