<?
/*
You can place here your functions and event handlers

AddEventHandler("module", "EventName", "FunctionName");
function FunctionName(params)
{
	//code
}
*/
?>
<?
if (file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/common/commonapi.php"))
		require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/common/commonapi.php");
?>
<?
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("AfterProviderActivity", "OnAfterProviderActivity"));
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("AfterProviderActivity", "OnAfterProviderActivity"));

class AfterProviderActivity
{
    
    public function OnAfterProviderActivity(&$arFields)
    {
        // Устанавливаем массив инфоблоков с поставщиками
        // !!!! Нужно заменить на проверку соответствующего типа инфоблоков
        $arIBProviders = Array(31, 63);
        // Устанавливаем пользователей, чьи действия не будут вызывать бизнес-процесс
        $arAdmins = Array(1, 10);
        global $USER;
        $UserID = $USER->GetID();
        if (!in_array($UserID, $arAdmins))
            if($arFields["ID"]>0 && in_array($arFields["IBLOCK_ID"], $arIBProviders))
                CBPDocument::StartWorkflow(6, //6 <- ID  БП Утверждение по первому голосу
                    array("iblock","CIBlockDocument", $arFields["ID"]),
                    array("Voters"=>Array("user_1", "user_10")));        
    }
    
}
?>
<?
CModule::AddAutoloadClasses(
        '', // не указываем имя модуля
        array(
           // ключ - имя класса, значение - путь относительно корня сайта к файлу с классом
                'CRating' => '/bitrix/php_interface/rating/classes/rating.php',
                'CLocations' => '/bitrix/php_interface/locations/classes/locations.php',
                'CDataExport' => '/bitrix/php_interface/dataexport/classes/dataexport.php',
                'PHPExcel' => '/bitrix/php_interface/Excel/classes/PHPExcel.php',
        )
);
?>