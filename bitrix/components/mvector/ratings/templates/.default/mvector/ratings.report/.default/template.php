<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div id="content">
<h1>Отчёты</h1>
					<div class="doc-hold">
					<h2>Отчет по муниципальным образованиям</h2>
					<div class="doc-box">
						<strong class="title"><img src="<?=SITE_TEMPLATE_PATH?>/images/icon27.gif" alt="" /> <a href="/upload/report.pdf">Сводный отчет</a> <span>(pdf)</span></strong>
						<p>Сводный отчет за текущий отчетный период.</p>
					</div>
					<div class="doc-box">
						<strong class="title"><img src="<?=SITE_TEMPLATE_PATH?>/images/icon41.gif" alt="" /> <a href="/upload/report.xlsx">Сводный отчет</a> <span>(xlsx)</span></strong>
						<p>Сводный отчет за текущий отчетный период. </p>
					</div>
				</div>
                                <?$APPLICATION->IncludeComponent("mvector:report.configurator", "", Array());?>

</div>
<div id="sidebar">                       
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>
</div>     