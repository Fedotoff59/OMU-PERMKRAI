<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Оценка качества муниципальных услуг в Пермском крае");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Оценка услуг");
?> 

<? $APPLICATION->IncludeComponent("mvector:services", "", Array(
					"SEF_MODE" => "Y", 
					"SEF_FOLDER" => "/services/",
					false)
					);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>