<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<!-- content -->
<div id="content">
    <h1>Рейтинги</h1>
    <ul class="rating-box">
        <li>
            <div class="img">
                <div>
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/bg-icon04.png" alt="" />
                </div>
            </div>
            <h3><a href="/ratings/serviceslist/">Рейтинг поставщиков</a></h3>
	</li>
	<li>
            <div class="img">
                <div>
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/bg-icon02.png" alt="" />
                </div>
            </div>
            <h3><a href="/ratings/locations/">Рейтинг муниципальных образований</a></h3>
	</li>
	<li>
            <div class="img">
                <div>
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/bg-icon03.png" alt="" />
		</div>
            </div>
            <h3><a href="/ratings/report/">Отчёты</a></h3>
	</li>
    </ul>
</div>
<!-- sidebar-right -->
<div id="sidebar">
 <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>
</div>