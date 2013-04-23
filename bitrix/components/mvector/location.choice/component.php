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
if (isset($_SESSION['LOCATION_ID']) && $_SESSION['LOCATION_ID'] > 0)
    $ChoiceLocation_ID = $_SESSION['LOCATION_ID'];
    else {
        // Если нету, проверяем, есть ли пользовательское поле со значением
        $rsUser = CUser::GetByID($USER);
        $arUser = $rsUser->Fetch();
        if(isset($arUser["UF_LOCATION"]) && $arUser["UF_LOCATION"] > 0)
            $ChoiceLocation_ID = $arUser["UF_LOCATION"];
            else {
                // Если нет, устанавливаем, что нужно показать уведомление о выборе
                // Проверям, есть значение в куках
                $bShowRemindChoiceWindow = true;
                if ($APPLICATION->get_cookie("LOCATION_ID") > 0)
                   $ChoiceLocation_ID = $APPLICATION->get_cookie("LOCATION_ID");
                    // Если нет, устанавливаем значение по умолчанию
                    else $ChoiceLocation_ID = DEFAULT_LOCATION_ID;
            }
    }
// Получаем параметры выбранного МО
$arChoiceLocation = CLocations::GetLocationParams($ChoiceLocation_ID);
$arResult = $arChoiceLocation[$ChoiceLocation_ID];
       
$this->IncludeComponentTemplate();
?>