<?
/*
 * Компонент проверяет текущее местоположение, выбранное пользователем
 * и выводит его в верхний угол шаблона.
 * А так же контакты специалиста выранного МО и ссылку на сайт МО
 * Компонент подключается в header.php и отображается на всех страницах.
 * Наблон выводит наименование местоположения.
 * Выбор организуется с помощью всплывающего окна form-location-choice.php
 * Обработка выбора происходит ajax-запросом к файлу ajax-location-choice.php
 * 
 */

$arResult = Array();
$ChoiceLocation_ID = 0;
$arChiceLocation = Array ();
// Флаг показа уведомления о выборе местоположения
$bShowRemindChoiceWindow = false;
// Проверяем, есть ли значение в сессии
if ($_SESSION['LOCATION_ID'] > 0) {
    
    $flag = 'session';
    $ChoiceLocation_ID = $_SESSION['LOCATION_ID'];
}    else {
        // Если нету, проверяем, есть ли пользовательское поле со значением
        global $USER;
        
        if($USER->IsAuthorized()) {
         $flag = 'user';   
              $rsUser = CUser::GetByID($USER->GetID());
                 $arUser = $rsUser->Fetch();
            $ChoiceLocation_ID = $arUser["UF_USERLOCATION"];
        }  else {
                // Если нет, устанавливаем, что нужно показать уведомление о выборе
                // Проверям, есть значение в куках
                $bShowRemindChoiceWindow = true;
                global $APPLICATION;
                $CokieLocation = $APPLICATION->get_cookie("LOCATION_ID");
                if ($APPLICATION->get_cookie("LOCATION_ID")) {
                    
                $flag = 'cookie';
                   $ChoiceLocation_ID = $APPLICATION->get_cookie("LOCATION_ID");
                    // Если нет, устанавливаем значение по умолчанию
                }    else {
                        $ChoiceLocation_ID = DEFAULT_LOCATION_ID;
                        $flag = 'default';
                }
            }
    }
//echo $flag;
CLocations::SetLocationByID($ChoiceLocation_ID);
// Получаем параметры выбранного МО
$arChoiceLocation = CLocations::GetLocationParams($ChoiceLocation_ID);
$arResult = $arChoiceLocation[$ChoiceLocation_ID];
                global $APPLICATION;
                $CokieLocation = $APPLICATION->get_cookie("LOCATION_ID");
// Получаем данные специалиста выбранного МО
$arFilter = Array("ACTIVE"=>"Y","GROUPS_ID"=>Array(8), "UF_USERLOCATION" => $ChoiceLocation_ID);
$rsUsers = CUser::GetList(  ($by = "id"), 
                            ($order = "desc"), 
                            $arFilter, 
                            Array("FIELDS" => Array("ID", 
                                                    "NAME", 
                                                    "LAST_NAME",
                                                    "SECOND_NAME",
                                                    "EMAIL",
                                                    "WORK_PHONE",
                                                    "WORK_WWW")
                                 )
                         );
while ($arUser = $rsUsers->Fetch()) 
{
   if (isset($arUser["NAME"]))
       $arResult['SPECIALIST']['FULL_NAME'] = $arUser["NAME"];
   if (isset($arUser["SECOND_NAME"]))
       $arResult['SPECIALIST']['FULL_NAME'] .= ' '.$arUser["SECOND_NAME"];
   if (isset($arUser["LAST_NAME"]))
       $arResult['SPECIALIST']['FULL_NAME'] .= ' '.$arUser["LAST_NAME"];
   $arResult['SPECIALIST']['EMAIL'] = $arUser['EMAIL'];
   $arResult['SPECIALIST']['WORK_PHONE'] = $arUser['WORK_PHONE'];
   $arResult['SPECIALIST']['WORK_WWW'] = $arUser['WORK_WWW'];
}
                
$this->IncludeComponentTemplate();
?>