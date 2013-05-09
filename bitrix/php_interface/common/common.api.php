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

define("ERR_MESSAFE_SEF_MODE", "Ошибка! Для работы компонента необходимо включить режим SEF");

// Задаем текстовые константы для постраничной навигации
define("TEXT_NEXT_PAGE", "Следующая страница");
define("TEXT_PREV_PAGE", "Предыдущая страница");
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

/*
 * Функция постраничную навигацию: активную страницу, страницы, которые рядом,
 * номера элементов, которые нужно вывести
 * 
 */
function pagenav($curpage, $elcount, $eltopagelimit = 15, $pageingrouplimit = 5) {
    $arNav = Array();
    // Расчет количества страниц
    if ($elcount % $eltopagelimit == 0)
        $totalpages = $elcount / $eltopagelimit;
        else $totalpages = floor($elcount / $eltopagelimit) + 1;
    // Проверка на правильность значения $curpage, если не проходит, то сброс на 1
    if($curpage < 1 || $curpage > $totalpages)
       $curpage = 1;
    // Определяем количество групп страниц
    if ($totalpages % $pageingrouplimit == 0)
        $totalpagesgroups = $totalpages / $pageingrouplimit;
        else $totalpagesgroups = floor($totalpages / $pageingrouplimit) + 1;
    // Определяем текущую группу страницы
    if ($curpage % $pageingrouplimit == 0)
        $curpagegroup = $curpage / $pageingrouplimit;
        else $curpagegroup = floor($curpage / $pageingrouplimit) + 1;
    if ($curpagegroup > 1)
        $arNav['ARROW_PREV'] = true;
        else $arNav['ARROW_PREV'] = false;
    if ($curpagegroup < $totalpagesgroups)
        $arNav['ARROW_NEXT'] = true;
        else $arNav['ARROW_NEXT'] = false;
    // Определяем стартовый номер элемента (отсчет с нуля)
    $navstart = ($curpage - 1) * $eltopagelimit;
    // Определяем конечный номер элемента
    $navend = $navstart + $eltopagelimit;
    // Если конечный номер больше кол-ва элементов - переопределяем
    if ($navend > $elcount)
        $navend = $elcount;
    $navend -= 1;
    // Определяем стартовый номер страницы
    $pagestart = ($curpagegroup - 1) * $pageingrouplimit + 1;
    // Определяем конечный номер страницы
    $pageend = $pagestart + $pageingrouplimit - 1;
    // Если конечный номер больше кол-ва страниц - переопределяем
    if ($pageend > $totalpages)
        $pageend = $totalpages;
    $arNav['ACTIVE_PAGE'] = $curpage;
    $arNav['START_PAGE'] = $pagestart;
    $arNav['END_PAGE'] = $pageend;
    $arNav['START_NAV'] = $navstart;
    $arNav['END_NAV'] = $navend;
    $arNav['TOTALPAGES'] = $totalpages;
    if ($arNav['END_PAGE'] > 1)
        $arNav['UL_CLASS'] = 'address-list-paging';
        else $arNav['UL_CLASS'] = 'address-list';
    return $arNav;
}
?>