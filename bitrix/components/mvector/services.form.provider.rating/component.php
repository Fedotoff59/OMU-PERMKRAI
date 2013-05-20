<?
/*
 *  Компонент выводит рейтинг и количество проголосовавших 
 *  за текущего поставщика на форме оценки поставщика
 */
   
    $arResult = Array();

    $curProvider_ID = $arParams['PROVIDER_ID'];
    $arProviders[] = $curProvider_ID;
    
    $arResult = CRating::providers_rating($arProviders, $arParams['SERVICE_ID']);

    $stRating = $arResult[$curProvider_ID]['AVERAGE_RATING'];
    $stVotesAmount = $arResult[$curProvider_ID]['VOTES_AMOUNT'];
    if (false/*$stRating > 0*/)
        {
            $stRating = sprintf("%.2f", $stRating);
            $stVotesAmount = '(Число голосов: '.$stVotesAmount.')';
        }
    else  
        {
            $stRating = '&nbsp;&nbsp;&otimes;';
            $stVotesAmount = "";
        }
    $arResult[$curProvider_ID]['AVERAGE_RATING'] = $stRating;
    $arResult[$curProvider_ID]['VOTES_AMOUNT'] = $stVotesAmount;

//echo '<strong>Результат выборки:</strong> <br />';
//echo '<pre>'; echo print_r($arResult); echo '</pre>';

$this->IncludeComponentTemplate();
?>