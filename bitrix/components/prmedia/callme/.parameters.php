<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$site = ($_REQUEST["site"] <> ''? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));
$arFilter = Array("ACTIVE" => "Y");
if($site !== false)
	$arFilter["LID"] = $site;

$arComponentParameters = array(
	"PARAMETERS" => array(
		"USE_CAPTCHA" => Array(
			"NAME" => GetMessage("MFP_CAPTCHA"), 
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y", 
			"PARENT" => "BASE",
		),
		"USE_AUTHOR_TIME" => Array(
			"NAME" => GetMessage("MFP_AUTHOR_TIME"), 
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y", 
			"PARENT" => "BASE",
		),
		"VIEW_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("MFP_VIEW_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => Array(
								0 => GetMessage("MFP_VIEW_TYPE_1"),
								1 => GetMessage("MFP_VIEW_TYPE_2")
							),
			"DEFAULT" => 0,
		),
		"CALL_TEXT" => Array(
			"NAME" => GetMessage("MFP_CALL_MESSAGE"), 
			"TYPE" => "STRING",
			"DEFAULT" => GetMessage("MFP_CALL_TEXT"), 
			"PARENT" => "BASE",
		),
		"OK_TEXT" => Array(
			"NAME" => GetMessage("MFP_OK_MESSAGE"), 
			"TYPE" => "STRING",
			"DEFAULT" => GetMessage("MFP_OK_TEXT"), 
			"PARENT" => "BASE",
		),
		"EMAIL_TO" => Array(
			"NAME" => GetMessage("MFP_EMAIL_TO"), 
			"TYPE" => "STRING",
			"DEFAULT" => htmlspecialchars(COption::GetOptionString("main", "email_from")), 
			"PARENT" => "BASE",
		),
	)
);

?>