<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карта удовлетворенности услугами");
?>

<!-- content -->

			<div id="content">
				<h1>Карта удовлетворённости услугами</h1>
				<p></p>
                                <?$APPLICATION->IncludeComponent("mvector:services.list.map", "", Array());?>
				<div class="map-info">
					<p>Обозначения рейтина на карте</p>
					<strong class="color1">0%-25%</strong>
					<strong class="color2">25%-50%</strong>
					<strong class="color3">50%-75%</strong>
					<strong class="color4">75%-100%</strong>
				</div>
				<a href="/ratings/locations/"><div class="map-hold map-hold2">
				</div></a>
			</div>

    <div id="sidebar">                       
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>
</div>  
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>