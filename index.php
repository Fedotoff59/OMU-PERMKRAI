<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
$APPLICATION->SetPageProperty("title", "Оценка качества муниципальных услуг в Пермском крае");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
?> 
<?LocalRedirect('http://'.SITE_SERVER_NAME.'/services/');?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>