<?
/*
 * Компонент подключает шаблон с кнопкой оценки
 * Добавление оценки происходит через ajax запрос
 * к файлу ajax-submit.php
 * 
 */

$arResult = Array();

 if ($arParams['PROVIDER_ID'] > 0) {
    $curProvider_ID = $arParams['PROVIDER_ID'];
    $arProviders[] = $curProvider_ID;
    $arRating = CRating::providers_rating($arProviders, $arParams['SERVICE_ID']);
    $stVotesAmount = $arRating[$curProvider_ID]['VOTES_AMOUNT'];
} else {
    $curService_ID = $arParams['SERVICE_ID'];
    $curLocation_ID = $arParams['LOCATION_ID'];
    $arLocation[] = $curLocation_ID;
    $arService[] = $curService_ID;
    $arRating = CRating::services_rating($arService, $arLocation);
    $stVotesAmount = $arRating['FULL_VOTES_AMOUNT'];
}
$arResult['VOTES_AMOUNT'] = $stVotesAmount;
      
$this->IncludeComponentTemplate();
?>