<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Рейтинги");
?> 

<? $APPLICATION->IncludeComponent("mvector:ratings", "", Array(
					"SEF_MODE" => "Y", 
					"SEF_FOLDER" => "ratings/"),
					false
					);
?>
    
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>