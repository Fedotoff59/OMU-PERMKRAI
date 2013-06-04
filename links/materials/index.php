<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Методические материалы");
?>
<div id="content">
<h1>Методические материалы</h1>
<?if ( CSite::InGroup( array(1, 8, 9) ) ):?>
<div class="slide-content">
<h2 class="open"><a class="opener" href="#">Методическое пособие для специалистов системы</a></h2>
	<div class="clearfix"></div>
		<div class="slide">
			
            <div class="doc-hold">
				<h2>Методическое пособие</h2>
				<div class="doc-box">
					<strong class="title"><img src="<?=SITE_TEMPLATE_PATH?>/images/icon27.gif" alt="" /> <a href="/upload/metodica.pdf">Методическое пособие для специалистов муниципальных образований</a> <span></span></strong>
					<p>Методическое пособие для специалистов муниципальных образований 
					</p>
				</div>
			</div>
		</div>
</div>
<?endif;?>
				<div class="video-box">
					<img src="<?=SITE_TEMPLATE_PATH?>/images/img04.png" alt="" />
					<a href="/links/materials/videohelper.php" class="play"></a>
					<strong>Видеопомощник</strong>
				</div>
</div>
    <div id="sidebar">                       
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>
</div>  
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>