<?
/*
 *  Компонент выводит рейтинг и количество проголосовавших 
 *  за текущего поставщика на форме оценки поставщика
 */
   
    $arResult = Array();

    $curService_ID = $arParams['SERVICE_ID'];
    
    $curLocation_ID = $arParams['LOCATION_ID'];
    
    $arLocation[] = $curLocation_ID;
    
    $arService[] = $curService_ID;

    $arResult = CRating::services_rating($arService, $arLocation);

    $stLoyalty = $arResult[$curLocation_ID][$curService_ID]['AVERAGE_PERCENT_RATING'];
    $stRating = $arResult[$curLocation_ID][$curService_ID]['AVERAGE_RATING'];
    $stVotesAmount = $arResult['FULL_VOTES_AMOUNT'];
    if (false /*$stVotesAmount > 0*/)
        {
            $stLoyalty = sprintf("%.0f", $stLoyalty).' %';
            $stRating = sprintf("%.2f", $stRating);
            $stVotesAmount = '(Число оценок: '.$stVotesAmount.')';
        }
    else  
        {
            $stLoyalty = "&nbsp;&nbsp;&otimes;";
            $stRating = "&nbsp;&nbsp;&otimes;";
            $stVotesAmount = "";
        }
    $arResult[$curLocation_ID][$curService_ID]['AVERAGE_PERCENT_RATING'] = $stLoyalty;
    $arResult[$curLocation_ID][$curService_ID]['AVERAGE_RATING'] = $stRating;
    $arResult[$curLocation_ID][$curService_ID]['VOTES_AMOUNT'] = $stVotesAmount;

//echo '<strong>Результат выборки:</strong> <br />';
//echo '<pre>'; echo print_r($arParams); echo '</pre>';
//echo '<pre>'; echo print_r($arResult); echo '</pre>';

$this->IncludeComponentTemplate();
?>