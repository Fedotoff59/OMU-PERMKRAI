<?
//AddMessage2Log(mydump($_POST));
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

if(CModule::IncludeModuleEx('prmedia.callme') != MODULE_DEMO_EXPIRED) 
{ 



CModule::IncludeModule("prmedia.callme");

$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");
$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if(strlen($arParams["EMAIL_TO"]) <= 0)
	$arParams["EMAIL_TO"] = COption::GetOptionString("main", "mail_admin");
$arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
if(strlen($arParams["OK_TEXT"]) <= 0)
	$arParams["OK_TEXT"] = GetMessage("MF_OK_MESSAGE");
$arParams["CALL_TEXT"] = trim($arParams["CALL_TEXT"]);
if(strlen($arParams["CALL_TEXT"]) <= 0)
	$arParams["CALL_TEXT"] = GetMessage("MF_CALL_MESSAGE");

CJSCore::Init(array("jquery"));


if($_SESSION['SUCCESS'])
{
	$arResult["OK_MESSAGE"] = $arParams["OK_TEXT"];
	$_SESSION['SUCCESS'] = 0;
}

/* INPUT PARAMS */
$arFieldsTitles=array(
	GetMessage("PRMEDIA_CM_ENABLE_FIELD_1"),
	GetMessage("PRMEDIA_CM_ENABLE_FIELD_2"),
	GetMessage("PRMEDIA_CM_ENABLE_FIELD_3")
);
$arFieldsNames=array(
	'AUTHOR_NAME',
	'AUTHOR_PHONE',
	'AUTHOR_TIME',
);

$arFieldsErrors=array(
	GetMessage("PRMEDIA_CM_ERROR_FIELD_1"),
	GetMessage("PRMEDIA_CM_ERROR_FIELD_2"),
	GetMessage("PRMEDIA_CM_ERROR_FIELD_3")
);

$arFieldsTmp=array();
foreach($arFieldsNames as $ID=>$field){

	switch($arFieldsNames[$ID]){
		
		case 'AUTHOR_TIME':
			if($arParams['USE_AUTHOR_TIME'] == "Y"){
				$arFieldsTmp[$arFieldsNames[$ID]]['TITLE']=$arFieldsTitles[$ID];
				$arFieldsTmp[$arFieldsNames[$ID]]['NAME']=$arFieldsNames[$ID];
				$arFieldsTmp[$arFieldsNames[$ID]]['REQUIRED']='N';					
			}
		break;
		default:
			$arFieldsTmp[$arFieldsNames[$ID]]['TITLE']=$arFieldsTitles[$ID];
			$arFieldsTmp[$arFieldsNames[$ID]]['NAME']=$arFieldsNames[$ID];
			$arFieldsTmp[$arFieldsNames[$ID]]['REQUIRED']='Y';	
		break;
	}
	
}

//    echo "<pre>";
//    print_r($arFieldsTmp);
//    echo "</pre>";

/* POST */
if($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST['send']=='Y')
{
	
	foreach($arReqFields as $ID=>$field){
		if(strlen($_POST[$arFieldsNames[$field]]) <= 1) $arFieldsTmp[$ID]['ERROR']=$arFieldsErrors[$field];
	}

	if($arParams["USE_CAPTCHA"] == "Y")
	{

		include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
		$captcha_code = $_POST["captcha_sid"];
		$captcha_word = $_POST["captcha_word"];
		$cpt = new CCaptcha();
		$captchaPass = COption::GetOptionString("main", "captcha_password", "");
		if (strlen($captcha_word) > 0 && strlen($captcha_code) > 0)
		{
			
			if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass)){
				
				$arResult["ERROR_MESSAGE"]['CAPTCHA'] = GetMessage("MF_CAPTCHA_WRONG");
				// if captcha is wrong need to save value of fields
				
				$_SESSION["CM_NAME"] = htmlspecialcharsEx($_POST["AUTHOR_NAME"]);
				$_SESSION["CM_PHONE"] = htmlspecialcharsEx($_POST["AUTHOR_PHONE"]);
				$_SESSION["CM_TIME"] = htmlspecialcharsEx($_POST["AUTHOR_TIME"]);
			}
				
		}
		else
			$arResult["ERROR_MESSAGE"]['CAPTCHA'] = GetMessage("MF_CAPTHCA_EMPTY");
	}
	
	if(empty($arResult))
	{
		$_POST["MESSAGE"] = htmlspecialcharsEx($_POST["MESSAGE"]);
		$_POST["AUTHOR_NAME"] = htmlspecialcharsEx($_POST["AUTHOR_NAME"]);
		$_POST["AUTHOR_PHONE"] = htmlspecialcharsEx($_POST["AUTHOR_PHONE"]);
		$_POST["AUTHOR_TIME"] = htmlspecialcharsEx($_POST["AUTHOR_TIME"]);
	
		$arEmailFields = Array(
			"AUTHOR_NAME" => trim($_POST["AUTHOR_NAME"]),
			"AUTHOR_PHONE" => trim($_POST["AUTHOR_PHONE"]),
			"AUTHOR_TIME" => trim($_POST["AUTHOR_TIME"]),
			"EMAIL_TO" => trim($arParams["EMAIL_TO"]),
		);
		
		$arOrder = Array(
			"AUTHOR_NAME" => trim($_POST['AUTHOR_NAME']),
			"AUTHOR_PHONE" => trim($_POST['AUTHOR_PHONE']),
			"AUTHOR_TIME" => trim($_POST["AUTHOR_TIME"]),
			"SITE_ID" => SITE_ID
		);

		
		$post_template_id = COption::GetOptionInt("prmedia.callme", 'post_templates');
		$save_to_services_enable = COption::GetOptionInt("prmedia.callme", 'save_to_services_enable');
		
		$rsEM = CEventMessage::GetByID($post_template_id);
		$arEM = $rsEM->Fetch();
		$post_event_type=$arEM['EVENT_NAME'];
		
		if($post_event_type){
			CEvent::Send($post_event_type, SITE_ID, $arEmailFields);
			if($_SESSION['SUCCESS'] == 0)
				$_SESSION['SUCCESS'] = 1;
		}
		else{
			$arResult["ERROR_MESSAGE"]['NO_EVENT_TYPE']=GetMessage('NO_EVENT_TYPE');
		}
		
		// get to db
		
		if($save_to_services_enable==1){
			$el = new CCallMe;
			$el->Add($arOrder);
			
			if($_SESSION['SUCCESS'] == 0)
				$_SESSION['SUCCESS'] = 1;
		}
		
		$_POST["MESSAGE"] = '';
		$_POST["AUTHOR_NAME"] = '';
		$_POST["AUTHOR_PHONE"] = '';
		$_POST["AUTHOR_TIME"] = '';
		
		$_SESSION["CM_NAME"] = htmlspecialcharsEx($_POST["AUTHOR_NAME"]);
		$_SESSION["CM_PHONE"] = htmlspecialcharsEx($_POST["AUTHOR_PHONE"]);
		$_SESSION["CM_TIME"] = htmlspecialcharsEx($_POST["AUTHOR_TIME"]);
		
		// if success - reset the values

		
		LocalRedirect($_SERVER['REQUEST_URI']);
	}
	
	$arResult["MESSAGE"] = htmlspecialcharsEx($_POST["MESSAGE"]);
	$arResult["AUTHOR_NAME"] = htmlspecialcharsEx($_POST["AUTHOR_NAME"]);
	$arResult["AUTHOR_PHONE"] = htmlspecialcharsEx($_POST["AUTHOR_PHONE"]);
	$arResult["AUTHOR_TIME"] = htmlspecialcharsEx($_POST["AUTHOR_TIME"]);
	
}


$arResult['FIELDS']=$arFieldsTmp;

//if(empty($arResult["ERROR_MESSAGE"]))
//{
	
	if($USER->IsAuthorized())
	{
		$arResult['FIELDS']['AUTHOR_NAME']['VALUE'] = htmlspecialcharsEx($USER->GetFullName());
	}
	else
	{
		if(strlen($_SESSION["CM_NAME"]) > 0 && !empty($arResult['FIELDS']['AUTHOR_NAME']))
			$arResult['FIELDS']['AUTHOR_NAME']['VALUE'] = htmlspecialcharsEx($_SESSION["CM_NAME"]);
		if(strlen($_SESSION["CM_PHONE"]) > 0 && !empty($arResult['FIELDS']['AUTHOR_PHONE']))
			$arResult['FIELDS']['AUTHOR_PHONE']['VALUE'] = htmlspecialcharsEx($_SESSION["CM_PHONE"]);
		if(strlen($_SESSION["CM_TIME"]) > 0 && !empty($arResult['FIELDS']['AUTHOR_TIME']))
			$arResult['FIELDS']['AUTHOR_TIME']['VALUE'] = htmlspecialcharsEx($_SESSION["CM_TIME"]);
	}
//}

if($arParams["USE_CAPTCHA"] == "Y")
	$arResult["capCode"] =  htmlspecialchars($APPLICATION->CaptchaGetCode());

$this->IncludeComponentTemplate();

}
else 
{ 
	echo '<div style="border: solid 1px #000; padding: 5px; font-weight: bold; color: #ff0000;">'.GetMessage('PRMEDIA_CM_DEMO_EXPIRED').'</div>'; 
} 
?>