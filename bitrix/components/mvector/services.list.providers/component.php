<?
/*
 * Компонент выводит список поставщиков,
 * соответствующих текущему МО и выбранной услуге.
 */

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
       
$this->IncludeComponentTemplate();
?>