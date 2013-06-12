<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-edge" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<title><?$APPLICATION->ShowTitle()?></title>
<link rel="icon" type="image/x-icon" href="/favicon.ico" />
<link href="<?=SITE_TEMPLATE_PATH?>/css/all.css" rel="stylesheet" type="text/css" media="all"/>
<link href="<?=SITE_TEMPLATE_PATH?>/css/jquery.ui.all.css" rel="stylesheet" type="text/css" media="all"/>
<!--[if lte IE 7]>
<link href="<?=SITE_TEMPLATE_PATH?>/css/ie7fix.css" rel="stylesheet" type="text/css" media="all"/>
<![endif]-->
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
<script type="text/javascript"> 
var $buoop = {} 
$buoop.ol = window.onload; 
window.onload=function(){ 
 try {if ($buoop.ol) $buoop.ol();}catch (e) {} 
 var e = document.createElement("script"); 
 e.setAttribute("type", "text/javascript"); 
 e.setAttribute("src", "http://browser-update.org/update.js"); 
 document.body.appendChild(e); 
} 
</script> 
<?
    if ( CSite::InGroup( array(1, 8, 9) ) ) {
            $APPLICATION->ShowPanel = true;
            $APPLICATION->IncludeComponent("bitrix:im.messenger", "", Array());
    }
    $APPLICATION->ShowPanel();
?>
    

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
            <!--[if lte IE 7]>
                <div style="clear: both"></div>
            <![endif]-->
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
			"PROFILE_URL"	=>	"/personal/profile/",
                        "SHOW_ERRORS" => "Y"
			)
                );?>
            </div>
        </div>
    </div>
    <div id="main">