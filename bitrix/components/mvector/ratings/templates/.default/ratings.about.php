<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$APPLICATION->IncludeComponent(
"mvector:ratings.about",
".default",
array('SEF_FOLDER' => $arParams['SEF_FOLDER']
), $component
); 
?>