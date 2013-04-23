<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION; 
$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"bitrix:menu.sections",
	"",
	Array(
		"ID" => $_REQUEST["ID"], 
		"IBLOCK_TYPE" => "mu_services", 
		"IBLOCK_ID" => "20", 
		"SECTION_URL" => "/services/", 
		"DEPTH_LEVEL" => "3", 
		"CACHE_TYPE" => "N", 
		"CACHE_TIME" => "3600" 
	)
);
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>