<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);

$APPLICATION->SetTitle("Авторизация");
?>
<div id="content">
<p>Вы зарегистрированы и успешно авторизовались.</p>
 
<p>Вы можете настроить дополнительные параметры в личном кабинете</p>
 
<p><a href="/personal/profile/">Войти в личный кабинет</a></p>
</div>
<div id="sidebar"> <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?> </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>