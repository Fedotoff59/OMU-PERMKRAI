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
define("IBT_PROVIDERS", 'IBT_PROVIDERS');
// Задаем ID территории по умолчанию
define("DEFAULT_LOCATION_ID", 470); // Пермь
// Задаем имя формы для организации ajax взаимодействия
define("CRITERIAS_FORM_ID", "criteriasform");

define("ERR_MESSAFE_SEF_MODE", "Ошибка! Для работы компонента необходимо включить режим SEF");

// Задаем текстовые константы для постраничной навигации
define("TEXT_NEXT_PAGE", "Следующая страница");
define("TEXT_PREV_PAGE", "Предыдущая страница");
// Задаем ID пользовательского соглашения
define("ID_USER_AGREEMENT", 17944);
// Задаем константы направлений услуг
define("SEC_SERVICE_EDU_ID", 155);
define("SEC_SERVICE_HEALTH_ID", 156);
define("SEC_SERVICE_HOUSING_ID", 157);
define("SEC_SERVICE_EMPLOYMENT_ID", 159);
define("SEC_SERVICE_SECURITY_ID", 160);
define("SEC_SERVICE_CULTURE_ID", 158);
define("SEC_SERVICE_SPORT_ID", 163);
define("SEC_SERVICE_TRADE_ID", 161);
define("SEC_SERVICE_TRANSPORT_ID", 162);
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
    $arNav['SIZE_PAGE'] = $eltopagelimit;
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
/*
 * Функция получает информацию об услуге по ее ID
 * Краткое, полное наименование, набор критериев
 * 
 */
function get_service_params($Service_ID) {
    $arService = false;
    if(CModule::IncludeModule("iblock") && $Service_ID > 0):
        $arService = Array();
        $res = CIBlockElement::GetByID($Service_ID); 
        if($ar_res = $res->GetNext())
            $arService['NAME'] = $ar_res['NAME'];
        
    endif;
    return $arService;
}

function count_providers($arLocationsIDS, $ServiceID) {
    $CountProviders = false;
    if(CModule::IncludeModule("iblock")):
    $i = 0;
    $arFilter = Array('IBLOCK_ID' => IB_LOCATIONS_ID, 'ID' => $arLocationsIDS);
    $arSelect = Array('IBLOCK_ID', 'ID', 'PROPERTY_IBPROVIDERS');
    $db_List = CIBlockElement::GetList(false, $arFilter, false, false, $arSelect);
    while($el = $db_List->GetNextElement()):
        $arFields = $el->GetFields();
        $arProvFilter = Array('IBLOCK_ID' => $arFields['PROPERTY_IBPROVIDERS_VALUE'],
                              'PROPERTY_SERVICES.ID' => $ServiceID);
        $arProvSelect = Array('ID', 'NAME');
        $db_ProvList = CIBlockElement::GetList(false, $arProvFilter, false, false, $arProvSelect);
        while($elProv = $db_ProvList->GetNextElement())
            $i++;
    endwhile;
        $CountProviders = $i;
    endif;
    return $CountProviders;
}

function GoTo404() {
   @define("ERROR_404","Y");
   if(function_exists("LocalRedirect"))
      LocalRedirect("/404.php"); 
}
?>