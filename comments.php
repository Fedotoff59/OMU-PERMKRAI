<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?>
<div id="content">
				<h1>Все комментарии</h1>
				<div class="comment-box">
					<p>Тестовый комментарий</p>
					<div class="row">
						<em class="date">20 мая 2013</em>
						<strong class="name">Имя автора</strong>
					</div>
				</div>
				<div class="comment-box comment-box-answer">
					<p>Ответ на комментарий</p>
					<div class="row">
						<em class="date"></em>
						<strong class="name">Ответ специалиста</strong>
					</div>
				</div>
                                </div>
<!-- sidebar-right -->
 
<div id="sidebar"> <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?> </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>