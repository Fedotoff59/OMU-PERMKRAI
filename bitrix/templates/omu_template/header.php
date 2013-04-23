<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<?$APPLICATION->ShowHead()?>
<title><?$APPLICATION->ShowTitle()?></title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="http://tablesorter.ru/jquery.tablesorter.min.js"></script>
<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<!-- Add fancyBox -->
<link rel="stylesheet" href="/js/fancybox/source/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" />
<script type="text/javascript" src="/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.4"></script>

<link rel="stylesheet" href="/js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<script>
    $(document).ready(function() 
        { 
            $("#Sortable").tablesorter();           
        } 
    ); 
</script>
    
</head>

<body>
<?$APPLICATION->IncludeComponent("bitrix:im.messenger", "", Array(), null, array("HIDE_ICONS" => "Y"));?>

<?
    $props = $APPLICATION->GetPagePropertyList();
    foreach($props as $key=>$val)
	echo '<meta name="'.$key.'" content="'.htmlspecialchars($val).'">';
?>
<?$APPLICATION->ShowPanel();?>
    
<div id="container">

<div id="header">
	<div id="header_text">
		<?$APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("include_areas/company_name.php"),
			Array(),
			Array("MODE"=>"html")
		);?>
	</div>

	<div id="search">
		&nbsp;Поиск на сайте
		<?$APPLICATION->IncludeComponent("bitrix:search.form", "flat", Array(
			"PAGE"	=>	"/search/"
			)
	);?>
	</div>

	<div id="login">
		<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "auth", Array(
			"REGISTER_URL"	=>	"/auth/",
			"PROFILE_URL"	=>	"/personal/profile/"
			)
		);?>
	</div>
 
	<div id="menu">
	<?$APPLICATION->IncludeComponent("bitrix:menu", "horizontal_multilevel", array(
	"ROOT_MENU_TYPE" => "top",
	"MENU_CACHE_TYPE" => "N",
	"MENU_CACHE_TIME" => "3600",
	"MENU_CACHE_USE_GROUPS" => "N",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "3",
	"CHILD_MENU_TYPE" => "omu",
	"USE_EXT" => "N",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
	</div>
    <div>
        <?$APPLICATION->IncludeComponent(
				"mvector:location.choice",
				"",
				Array(
					"DEFAULT" => 470, // Пермь 
				)
			);?>
    </div>
</div>

<table id="content" cellpadding="0" cellspacing="0">
    <tr>
        <td rowspan="4" width="9" class="table-border-color"><div style="width:9px"></div></td>
	<td width="4"><img src="<?=SITE_TEMPLATE_PATH?>/images/left_top_corner.gif" width="4" height="4" border="0" alt="" /></td>
	<td align="right"><img src="<?=SITE_TEMPLATE_PATH?>/images/right_top_corner.gif" width="7" height="5" border="0" alt="" /></td>
	<td rowspan="4" width="7" class="table-border-color"><div style="width:7px"></div></td>
    </tr>
    <tr>
        <td class="left-column"></td>
	<td class="main-column">
            <div id="navigation">
                <?$APPLICATION->IncludeComponent(
				"bitrix:breadcrumb",
				".default",
				Array(
					"START_FROM" => "0", 
					"PATH" => "", 
					"SITE_ID" => "" 
				)
			);?>
            </div>