<?
/*
 * Компонент получает список поставщиков,
 * соответствующих текущему МО и выбранному направлению услуг.
 */

 // Проверяем, корретны ли введенные параметры
$SectionID = $arParams['SECTION_ID'];
$Location_Alias = $arParams['LOCATION_ALIAS'];
$Location_ID = CLocations::GetLocationByAlias($Location_Alias);
if (!CServices::CheckSection($SectionID) || !$Location_ID) GoTo404();

// Задаем константы постраничной навигации
define("ELEMENTS_PER_PAGE", 10);
define("PAGES_IN_GROUP", 7);

$arResult = Array();

// Проверяем, запрошена ли какая-то страница
if (isset($_GET['page']) && $_GET['page'] > 1)
    $CurentPage = $_GET['page'];
    else $CurentPage = 1;
// Получаем ID услуг из выбранного раздела
$arServices = CServices::GetServices($SectionID);
foreach ($arServices[$SectionID]['ELEMENTS'] as $Sid => $Sname)
    $arServicesIDs[] = $Sid;
// Получаем количество поставщиков в выбранном разделе и заданном МО
$countProviders = CProviders::CountProviders($Location_ID, $arServicesIDs);
if (!$countProviders) GoTo404();
$arNav = pagenav($CurentPage, $countProviders, ELEMENTS_PER_PAGE, PAGES_IN_GROUP);
$arProviders = CProviders::GetProviders($Location_ID, $arServicesIDs, $arNav);

 echo '<pre>'; print_r($arProviders); echo '</pre>';
    
// Получаем массив постраничной навигации
$arResult['PAGENAV'] = $arNav;

$this->IncludeComponentTemplate();
?>