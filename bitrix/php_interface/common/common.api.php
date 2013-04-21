<?
/*
 * Общие константы:
 * ID инфоблоков
 * Значения по умолчанию
 * Константы
 */

// Задаем ID информационных блоков
define("IB_SERVICES_ID", 20);
define("IB_CRITERIAS_ID", 21);
define("IB_VALUES_ID", 71);
define("IB_LOCATIONS_ID", 23);
define("IB_PROVIDERS_IDS", Array());
// Задаем ID территории по умолчанию
define("DEFAULT_LOCATION_ID", 470); // Пермь
// Задаем имя формы для организации ajax взаимодействия
define("CRITERIAS_FORM_ID", "criteriasform");

define ("ERR_MESSAFE_SEF_MODE", "Ошибка! Для работы компонента необходимо включить режим SEF");

/*
 * Функция возвращает данные о текущем отчетном периоде
 * 
 */

function get_voting_period() {
    if(CModule::IncludeModule("iblock")):
    $arCurPeriod = Array();
    $arSelect = Array("ID", "NAME", "PROPERTY_PERIODSECTION", "PROPERTY_PERIODVOTESCOUNT");
    $arFilter = Array("IBLOCK_CODE"=>"IB_VALUES_PERIOD", "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
            // Получаем ID отчетного периода
            $arCurPeriod['ID'] = $arFields['ID'];
            // Получаем ID раздела, где будут сохраняться оценки
            $arCurPeriod['SECTION_ID'] = $arFields['PROPERTY_PERIODSECTION_VALUE'];
            // Получаем ограничение по количеству голосов за 1 объект в текущем отчетном периоде
            $arCurPeriod['PERIODVOTESCOUNT'] = $arFields['PROPERTY_PERIODVOTESCOUNT_VALUE'];
        }
    return $arCurPeriod;
    endif;
}
?>