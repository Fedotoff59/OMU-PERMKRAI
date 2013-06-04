<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Видеопомощник");
?> 
<div id="content"> <?$APPLICATION->IncludeComponent(
	"bitrix:player",
	"",
	Array(
		"PLAYER_TYPE" => "flv",
		"USE_PLAYLIST" => "N",
		"PATH" => "/upload/medialibrary/videohelper_480p.mp4",
		"PROVIDER" => "video",
		"STREAMER" => "",
		"WIDTH" => "940",
		"HEIGHT" => "528",
		"PREVIEW" => "",
		"FILE_TITLE" => "",
		"FILE_DURATION" => "",
		"FILE_AUTHOR" => "",
		"FILE_DATE" => "",
		"FILE_DESCRIPTION" => "",
		"SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins",
		"SKIN" => "",
		"CONTROLBAR" => "bottom",
		"WMODE" => "opaque",
		"LOGO" => "",
		"LOGO_LINK" => "",
		"LOGO_POSITION" => "none",
		"PLUGINS" => array(),
		"ADDITIONAL_FLASHVARS" => "",
		"AUTOSTART" => "Y",
		"REPEAT" => "none",
		"VOLUME" => "90",
		"MUTE" => "N",
		"ADVANCED_MODE_SETTINGS" => "Y",
		"PLAYER_ID" => "",
		"BUFFER_LENGTH" => "20",
		"ALLOW_SWF" => "N"
	)
);?> </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>