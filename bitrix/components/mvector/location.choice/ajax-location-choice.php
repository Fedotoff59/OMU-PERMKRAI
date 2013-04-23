<?
/*
 * Скрипт устанавливает текущее местоположение исходя из выбора пользователя
 * в правом верхем углу
 */

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (isset($_POST['location_choice'])) 
{
    $LocationID = $_POST['location_choice'];
    $arLocation = CLocations::GetLocationParams($LocationID);
    CLocations::SetLocationByID($arLocation[$LocationID]['LOCATION_ID']);
    echo $arLocation[$LocationID]['LOCATION_NAME'];
 }

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>