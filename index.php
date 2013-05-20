<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
$APPLICATION->SetPageProperty("title", "Оценка качества муниципальных услуг в Пермском крае");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
?>
<!-- steps-list -->
<ul class="steps-list">
    <li>
        <img src="<?=SITE_TEMPLATE_PATH?>/images/icon06.gif" alt="" />
	<strong>Найдите</strong>
	<p>Найдите поставщика, которого хотите оценить</p>
    </li>
    <li>
        <img src="<?=SITE_TEMPLATE_PATH?>/images/icon07.gif" alt="" />
	<strong>Оцените</strong>
	<p>Оцените качество предоставления муниципальных услуг</p>
    </li>
    <li>
        <img src="<?=SITE_TEMPLATE_PATH?>/images/icon08.gif" alt="" />
	<strong>Будьте в курсе</strong>
	<p>Следите за тем, как будет меняться качество услуг</p>
    </li>
</ul>
<!-- content -->
<div id="content">
<!-- services -->
    <?
    $APPLICATION->IncludeComponent(
        "mvector:services.list.services",
        ".default",
        Array(), 
        false
    ); 
    ?>
<!-- infographic -->
    <?
    $APPLICATION->IncludeComponent(
        "mvector:services.infographic",
        ".default",
        Array(
            'LOCATION_ID' => CLocations::GetCurrentLocationID()
        ), 
        false
    ); 
    ?>

<!-- banner-hold -->
<!--    <div class="banner-hold">
        <div class="banner">
            <a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/images/banner01.gif" alt="" /></a>
	</div>
	<div class="banner">
            <a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/images/banner02.gif" alt="" /></a>
	</div>
	<div class="banner">
            <a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/images/banner03.gif" alt="" /></a>
	</div>
    </div>-->
</div>
<!-- sidebar-right -->
<div id="sidebar">                       
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>
</div>     
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>