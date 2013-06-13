<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$APPLICATION->IncludeComponent(
"mvector:services.section.providers",
".default",
Array(  'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
        'LOCATION_ALIAS' => $arResult['VARIABLES']['LOCATION_ALIAS']
), $component
); 
?>