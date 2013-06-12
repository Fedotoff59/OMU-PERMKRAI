<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?>
<?
$APPLICATION->SetPageProperty("title", "Оценка качества муниципальных услуг в Пермском крае");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
?> 
<!-- steps-list -->
 
<ul class="steps-list"> 
  <li> <img src="<?=SITE_TEMPLATE_PATH?>/images/icon06.gif"  /> 	<strong>Найдите</strong> 	
    <p>Найдите поставщика, которого хотите оценить</p>
   </li>
 
  <li> <img src="<?=SITE_TEMPLATE_PATH?>/images/icon07.gif"  /> 	<strong>Оцените</strong> 	
    <p>Оцените качество предоставления муниципальных услуг</p>
   </li>
 
  <li> <img src="<?=SITE_TEMPLATE_PATH?>/images/icon08.gif"  /> 	<strong>Будьте в курсе</strong> 	
    <p>Следите за тем, как будет меняться качество услуг</p>
   </li>
 </ul>
 
<!-- content -->
 
<div id="content"> 
<!-- services -->
 <?$APPLICATION->IncludeComponent(
	"mvector:services.list.services",
	".default",
	Array(
	)
);?> 
<!-- infographic -->
<!--[if lte IE 7]>
<div class="clearfix">&nbsp;</div>
<![endif]-->
<a href="/ratings/">
 <?
    $APPLICATION->IncludeComponent(
        "mvector:services.infographic",
        ".default",
        Array(
            'LOCATION_ID' => CLocations::GetCurrentLocationID()
        ), 
        false
    ); 
    ?> </a>

<!-- banner-hold -->
 
<!--    <div class="banner-hold">
        <div class="banner">
            <a id="bxid_378069" href="#" ><img id="bxid_143706" alt=""  /></a>
	</div>
	<div class="banner">
            <a id="bxid_592136" href="#" ><img id="bxid_139445" alt=""  /></a>
	</div>
	<div class="banner">
            <a id="bxid_16485" href="#" ><img id="bxid_932480" alt=""  /></a>
	</div>
    </div>-->
 </div>
 
<!-- sidebar-right -->
 
<div id="sidebar"> <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?> </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>