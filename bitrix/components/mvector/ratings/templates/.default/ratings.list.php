<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$APPLICATION->IncludeComponent(
"mvector:ratings.list",
".default",
array('IB_SERVICES_ID' => $arParams['IB_SERVICES_ID']), 
$component
); 
?>