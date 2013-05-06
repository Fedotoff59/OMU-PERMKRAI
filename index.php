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
	<p>Найдите поставщика которого хотите оценить</p>
    </li>
    <li>
        <img src="<?=SITE_TEMPLATE_PATH?>/images/icon07.gif" alt="" />
	<strong>Оцените</strong>
	<p>Оцените качество предоставления муниципальных услуг</p>
    </li>
    <li>
        <img src="<?=SITE_TEMPLATE_PATH?>/images/icon08.gif" alt="" />
	<strong>Будьте в курсе</strong>
	<p>Следите, за тем как будет меняться качество услуг</p>
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
    <div class="infographic">
        <div class="row">
            <strong>Статистика пользователей</strong>
            <img src="<?=SITE_TEMPLATE_PATH?>/images/icon03.png" alt="" />
            <em class="user">10 234</em>
            <p>пользователей каждый день приходят<br /> выразить своё мнение о качестве различных услуг</p>
	</div>
	<div class="slide">
            <strong>Среди них:</strong>
            <div class="sex-box">
                <img src="<?=SITE_TEMPLATE_PATH?>/images/icon04.png" alt="" />
                <em class="percent">45%</em>
                <p>Мужчины</p>
            </div>
            <div class="sex-box">
                <img src="<?=SITE_TEMPLATE_PATH?>/images/icon05.png" alt="" />
                <em class="percent">55%</em>
                <p>Женщины</p>
            </div>
            <div class="box">
                <em class="percent">67%</em>
                <p>Молодые люди в возрасте до 35 лет. Мы рады, что молодым не все равно</p>
            </div>
            <div class="box box2">
                <em class="percent">5%</em>
                <p>Это люди старшего возраста.</p>
            </div>
        </div>
        <ul class="swicher">
            <li><a class="active" href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">6</a></li>
        </ul>
        <a href="#" class="prev">prev</a>
        <a href="#" class="next">next</a>
    </div>
<!-- banner-hold -->
    <div class="banner-hold">
        <div class="banner">
            <a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/images/banner01.gif" alt="" /></a>
	</div>
	<div class="banner">
            <a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/images/banner02.gif" alt="" /></a>
	</div>
	<div class="banner">
            <a href="#"><img src="<?=SITE_TEMPLATE_PATH?>/images/banner03.gif" alt="" /></a>
	</div>
    </div>
</div>
                        
<!-- sidebar-right -->
<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>