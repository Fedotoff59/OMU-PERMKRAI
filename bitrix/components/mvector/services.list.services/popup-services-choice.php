<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
    global $APPLICATION;
    $APPLICATION->IncludeComponent(
        "mvector:services.list.services",
        $_GET['service_tmpl'], // Приходит по ajax
        Array(), 
        false
    ); 
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>
