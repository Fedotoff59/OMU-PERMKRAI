<?
/*
 * Общие константы:
 * ID инфоблоков
 * Значения по умолчанию
 */

define("IB_SERVICES_ID", 20);
define("IB_CRITERIAS_ID", 21);
define("IB_VALUES_ID", 71);
define("IB_LOCATIONS_ID", 23);
define("IB_PROVIDERS_IDS", Array());

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
