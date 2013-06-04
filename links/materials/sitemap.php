<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карта портала");
?>
<!-- content -->
			<div id="content">
				<h1>Карта портала</h1>
				<ul class="sitemap">
					<li><a href="http://<?=SITE_SERVER_NAME?>">Главная страница</a></li>
					<li><a href="/about/">О портале</a></li>
					<li><a href="http://<?=SITE_SERVER_NAME?>">Оценка услуг</a></li>
					<li>
						<a href="/ratings/">Рейтинги</a>
						<ul>
							<li>
							<a href="/ratings/serviceslist/">Рейтинг поставщиков</a>
							</li>
							<li><a href="/ratings/locations/">Рейтинг муницуипальных образований</a></li>
							<li><a href="/ratings/report/">Отчеты</a></li>
						</ul>
					</li>
					<li><a href="/links/materials/">Полезные ссылки</a></li>
					<li><a href="/personal/profile/">Личный кабинет</a></li>
				</ul>
			</div>

    <div id="sidebar">                       
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>
</div>  
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>