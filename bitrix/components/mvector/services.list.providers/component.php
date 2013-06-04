<?
/*
 * Компонент выводит список поставщиков,
 * соответствующих текущему МО и выбранной услуге.
 */
// Задаем константы постраничной навигации
define("ELEMENTS_PER_PAGE", 10);
define("PAGES_IN_GROUP", 7);

$arResult = Array();

// Получаем скоращенное наименование услуги
if(CModule::IncludeModule("iblock")):
    $res = CIBlockElement::GetByID($arParams['SERVICE_ID']); 
    if($ar_res = $res->GetNext())
        $arResult['SERVICE_NAME'] = $ar_res['NAME'];
endif;

// Передаем в массив результатов дополнительные данные
$arResult['SERVICE_ID'] = $arParams['SERVICE_ID'];
$arResult['LOCATION_NAME'] = $arParams['LOCATION_NAME'];
$arResult['LOCATION_ALIAS'] = $arParams['LOCATION_ALIAS'];
$arResult['PROVIDERS'] = $arParams['PROVIDERS'];
$arResult['COUNT_PROVIDERS'] = $arParams['COUNT_PROVIDERS'];

// Нижеследующий блок кода готовит элементы постраничной навигации
// Устанавливаем начальные значения переменных
$countProviders = count($arParams['PROVIDERS']);

// Проверяем, запрошена ли какая-то страница
if (isset($_GET['page']) && $_GET['page'] > 1)
    $CurentPage = $_GET['page'];
    else $CurentPage = 1;
 
// Получаем массив постраничной навигации
$arResult['PAGENAV'] = pagenav($CurentPage, $countProviders, ELEMENTS_PER_PAGE, PAGES_IN_GROUP);
    
       
$this->IncludeComponentTemplate();
?>