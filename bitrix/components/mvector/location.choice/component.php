<?
/*
 * Компонент проверяет текущее местоположение, выбранное пользователем
 * и выводит его в верхний угол шаблона.
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
              $rsUser = CUser::GetByID($USER);
                 $arUser = $rsUser->Fetch();
            $ChoiceLocation_ID = $arUser["UF_LOCATION"];
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
                
$this->IncludeComponentTemplate();
?>