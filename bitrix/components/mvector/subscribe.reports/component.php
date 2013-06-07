<?
if (check_bitrix_sessid() && $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_REQUEST["subscribe"]))
{
	$arMailFields = Array();
	$arMailFields["SUBSCRIBE_EMAIL"] = $_REQUEST["subscribe"];
	CEvent::Send("SUBSCRIBE_REQUEST", SITE_ID, $arMailFields);
}
$this->IncludeComponentTemplate();
?>