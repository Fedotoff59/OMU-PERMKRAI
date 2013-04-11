<?
/*
 *  Компонент выводит рейтинг и количество проголосовавших 
 *  за текущего поставщика на форме оценки поставщика
 */
   
    $arResult = Array();

    $curService_ID = $arParams['CURRENT_SERVICE_ID'];
    
    $curLocation_ID = $arParams['CURRENT_LOCATION_ID'];
    
    $arLocation[] = $curLocation_ID;
    
    $arService[] = $curService_ID;

    $arResult = CRating::services_rating($arService, $arLocation);

    $stLoyalty = $arResult[$curLocation_ID][$curService_ID]['AVERAGE_PERCENT_RATING'];
    $stVotesAmount = $arResult[$curLocation_ID][$curService_ID]['VOTES_AMOUNT'];
    if ($stVotesAmount > 0)
        {
            $stLoyalty = sprintf("%.2f", $stLoyalty).' %';
            $stVotesAmount = '(Число оценок: '.$stVotesAmount.')';
        }
    else  
        {
            $stLoyalty = "Нет данных";
            $stVotesAmount = "";
        }
    $arResult[$curLocation_ID][$curService_ID]['AVERAGE_PERCENT_RATING'] = $stLoyalty;
    $arResult[$curLocation_ID][$curService_ID]['VOTES_AMOUNT'] = $stVotesAmount;

//echo '<strong>Результат выборки:</strong> <br />';
//echo '<pre>'; echo print_r($arParams); echo '</pre>';

$this->IncludeComponentTemplate();
?>