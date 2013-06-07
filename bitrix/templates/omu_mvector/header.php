<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<title><?$APPLICATION->ShowTitle()?></title>

<link href="<?=SITE_TEMPLATE_PATH?>/css/all.css" rel="stylesheet" type="text/css" media="all"/>
<link href="<?=SITE_TEMPLATE_PATH?>/css/jquery.ui.all.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.ui.mouse.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.ui.slider.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/main.js"></script>

<?$APPLICATION->ShowHead()?>

</head>

<body>
<?
    if ( CSite::InGroup( array(1, 8, 9) ) )
            $APPLICATION->ShowPanel = true;
    $APPLICATION->ShowPanel()
?>
    
<?$APPLICATION->IncludeComponent("bitrix:im.messenger", "", Array());?>
<?$APPLICATION->IncludeComponent("mvector:feedback.error", "",	Array());?>
<?$APPLICATION->IncludeComponent("mvector:subscribe.reports", "", Array());?>

<div id="wrapper">
    <!-- header -->
    <div id="header">
        <div class="header-hold">
            <strong class="logo"><a href="http://<?=SITE_SERVER_NAME?>">Оценка качества муниципальных услуг в Пермском крае</a></strong>
            <div class="r-box">
                <!--<a href="#" class="font-size">A</a>
                <a href="#" class="font-size font-size2">A</a>-->
		<!-- Location Specialist MO-Link -->
                <?$APPLICATION->IncludeComponent(
				"mvector:location.choice.links",
				"",
				Array("DEFAULT" => 470, // Пермь
                                )
                );?>
		<form action="/search" class="search">
                    <input type="text" name="q" class="input-text" value="Введите название поставщика или услуги" />
                    <input type="submit" class="btn" value="найти" />
		</form>
            </div>
            <div class="clearfix"></div>
            <div class="nav-row">
                <ul id="nav">
                    <li><a href="/about/">О портале</a></li>
                    <li><a href="http://<?=SITE_SERVER_NAME?>">Оценка услуг</a></li>
                    <li><a href="/ratings/">Рейтинги</a>
                        <div class="drop">
                            <ul>
                                <li><a href="/ratings/serviceslist/">Рейтинг поставщиков</a></li>
                                <li><a href="/ratings/locations/">Рейтинг муниципальных образований</a></li>
                                <li><a href="/ratings/report/">Отчёты</a></li>
                            </ul>
                            <span class="arrow"></span>
                        </div>
                    </li>
                    <li><a href="#">Полезные ссылки</a>
                                            <div class="drop">
                            <ul>
                                <li><a href="/links/materials/">Методические материалы</a></li>
                                <li><a href="/links/documents/">Нормативно-правовые документы</a></li>
                            </ul>
                            <span class="arrow"></span>
                        </div></li>
                    <?if ( CSite::InGroup( array(1, 8, 9) ) ):?>
                        <li><a href="/social-network/">Рабочая группа</a></li>
                    <?endif;?>
		</ul>
		<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "auth", Array(
			"REGISTER_URL"	=>	"/auth/",
			"PROFILE_URL"	=>	"/personal/profile/"
			)
                );?>
            </div>
        </div>
    </div>
    <?//=parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH)?>
    <div id="main">