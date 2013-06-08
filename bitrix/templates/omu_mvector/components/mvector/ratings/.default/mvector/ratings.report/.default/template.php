<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="content">
    <h1>Отчёты</h1>
    <?$APPLICATION->IncludeComponent("mvector:report.configurator", "", Array());?>
</div>
<div id="sidebar">                       
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>
</div>     