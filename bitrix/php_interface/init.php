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
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("AfterProviderActivity", "OnAfterProviderActivity"));
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("AfterProviderActivity", "OnAfterProviderActivity"));
AddEventHandler("main", "OnAfterUserLogin", Array("SetUserLocation", "OnAfterUserLoginHandler"));

class AfterProviderActivity
{
    
    const IBT_PROVIDERS = 'IBT_PROVIDERS';
    
    public function OnAfterProviderActivity(&$arFields)
    {
        // Устанавливаем массив инфоблоков с поставщиками
        // Проверяем в каком типе инфоблока происходят изменения
        $res = CIBlock::GetList(
	Array(), 
	Array(
		'ID' => $arFields["IBLOCK_ID"], 
	), true
        );
        while($ar_res = $res->Fetch())
        {
            $IBT = $ar_res['IBLOCK_TYPE_ID'];
        }
        // Сравниваем результат проверки с 'IBT_PROVIDERS'
        if ($IBT == self::IBT_PROVIDERS):
        // Устанавливаем пользователей, чьи действия будут вызывать бизнес-процесс
        if (CSite::InGroup(Array(8)))
        {
            if($arFields["ID"] > 0)
               CBPDocument::StartWorkflow(6, //6 <- ID  БП Утверждение по первому голосу
               Array("iblock", "CIBlockDocument", $arFields["ID"]),
               Array("Voters" => Array("user_1", "user_10")));
        } elseif (CSite::InGroup(Array(1, 9))) {
            if($arFields["ID"] > 0)
               CBPDocument::StartWorkflow(6, //6 <- ID  БП Утверждение по первому голосу
               Array("iblock", "CIBlockDocument", $arFields["ID"]),
               Array("Voters" => Array("user_1")));
        }
        endif;
    }
    
}

class SetUserLocation
{
    // создаем обработчик события "OnAfterUserLogin"
    function OnAfterUserLoginHandler(&$fields)
    {
        // если логин успешен то
        if($fields['USER_ID'] > 0)
        {
               // ищем пользователя по логину
                $rsUser = CUser::GetByLogin($fields['LOGIN']);
                // и если нашли, то
                if ($arUser = $rsUser->Fetch())
                {   // смотрим, есть ли у пользователя поле с территорией
                    if (isset($arUser["UF_USERLOCATION"]))
                        // если есть, то устанавливаем территорию пользователя
                        CLocations::SetLocationByID($arUser["UF_USERLOCATION"]);

                }

        }
    }
}
?>
<?
CModule::AddAutoloadClasses(
        '', // не указываем имя модуля
        Array(
           // ключ - имя класса, значение - путь относительно корня сайта к файлу с классом
                'CRating' => '/bitrix/php_interface/rating/classes/rating.php',
                'CLocations' => '/bitrix/php_interface/locations/classes/locations.php',
                'CServices' =>  '/bitrix/php_interface/services/classes/services.php',
                'CDataExport' => '/bitrix/php_interface/dataexport/classes/dataexport.php',
                'TCPDF' => '/bitrix/php_interface/tcpdf/tcpdf.php',
                'PHPExcel' => '/bitrix/php_interface/Excel/classes/PHPExcel.php',
                
        )
);
?>
<?
if (file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/common/common.api.php"))
    require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/common/common.api.php");
?>