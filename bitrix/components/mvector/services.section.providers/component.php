<?
/*
 * Компонент получает список поставщиков,
 * соответствующих текущему МО и выбранному направлению услуг.
 */

// Проверяем, корректны ли введенные параметры
$SectionID = $arParams['SECTION_ID'];
$Location_Alias = $arParams['LOCATION_ALIAS'];
$Location_ID = CLocations::GetLocationByAlias($Location_Alias);
if (!CServices::CheckSection($SectionID) || !$Location_ID) GoTo404();

// Задаем константы постраничной навигации
define("ELEMENTS_PER_PAGE", 10);
define("PAGES_IN_GROUP", 7);

$arResult = Array();

// Проверяем, запрошена ли какая-то страница
$CurentPage = (isset($_GET['page']) && $_GET['page'] > 1) ? $_GET['page'] : 1;

// Получаем ID услуг из выбранного раздела
$arServices = CServices::GetServices($SectionID);
$arResult['SECTION_NAME'] = $arServices[$SectionID]['SECTION_NAME'];
foreach ($arServices[$SectionID]['ELEMENTS'] as $Sid => $Sname)
    $arServicesIDs[] = $Sid;

// Получаем количество поставщиков в выбранном разделе и заданном МО
$countProviders = CProviders::CountProviders($Location_ID, $arServicesIDs);
if (!$countProviders) GoTo404();
// Получаем массив навигации по выборке, в зависимости от запроса
$arNav = pagenav($CurentPage, $countProviders, ELEMENTS_PER_PAGE, PAGES_IN_GROUP);

// Получаем выборку поставщиков в соответствии с запросом
$arProviders = CProviders::GetProviders($Location_ID, $arServicesIDs, $arNav);
// Получаем имена услуг поставщиков
foreach($arProviders as $Pid => $curProvider)
    foreach($curProvider['PROVIDER_FORM_URLS'] as $Sid => $SLink) {
        $curService = CServices::GetServicesParams($Sid);
        $arProviders[$Pid]['PROVIDER_SERVICE_NAMES'][$Sid] = $curService[$Sid]['SERVICE_NAME'];
    }

// Передаем переменные в массив результатов
$arResult['PAGENAV'] = $arNav;
$arResult['PROVIDERS'] = $arProviders;

$this->IncludeComponentTemplate();
?>