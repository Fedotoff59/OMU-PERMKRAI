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

function get_location_params($LOCATION_ID) {
    if(CModule::IncludeModule("iblock")):
    $arResult = Array();
    $arSelect = Array(  'ID', 
                        'NAME', 
                        'PROPERTY_ALIAS', 
                        'PROPERTY_IBPROVIDERS', 
                        'PROPERTY_IBCOMMENTS', 
                        'PROPERTY_SPECIALIST'
                    );
    $arFilter = Array(  "IBLOCK_ID" => IB_LOCATIONS_ID, 
                        "ID" => $LOCATION_ID, 
                        "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(FALSE, $arFilter, false, false, FALSE);
    while($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();
        $arResult['ID'] = $arFields['ID'];
        $arResult['NAME'] = $arFields['NAME'];
        $arResult['ALIAS'] = $arProps['ALIAS']['VALUE'];
        $arResult['IB_PROVIDERS_ID'] = $arProps['IBPROVIDERS']['VALUE'];
        $arResult['IB_COMMENTS_ID'] = $arProps['IBCOMMENTS']['VALUE'];
        $arResult['IB_SPECIALIST_ID'] = $arProps['SPECIALIST']['VALUE'];
    }
    return $arResult;
   endif;
}

?>
