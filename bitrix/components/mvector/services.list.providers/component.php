<?
/*
 * Компонент выводит список поставщиков,
 * соответствующих текущему МО и выбранной услуге.
 */
// Задаем константы постраничной навигации
define("ELEMENTS_PER_PAGE", 15);
define("PAGES_IN_GROUP", 5);

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
$curPage = 1;
$countProviders = count($arParams['PROVIDERS']);
$totalpages = floor($countProviders / ELEMENTS_PER_PAGE) + 1;
echo $totalpages;
// Проверяем, запрошена ли какая-то страница

/*
if (isset($_GET['page']))
    if($_GET['page'] < 1 || $_GET['page'] > $totalpages)
*/      
       
$this->IncludeComponentTemplate();
?>