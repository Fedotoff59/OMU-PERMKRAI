<?
/*
 *  Компонент выводит рейтинг и количество проголосовавших 
 *  за текущего поставщика на форме оценки поставщика
 */
   
    $arResult = Array();

    $curProvisor_ID = $arParams['CURRENT_PROVISOR_ID'];
    $arProviders[] = $curProvisor_ID;
    
    $arResult = CRating::provisors_rating($arProviders, $arParams['CURRENT_SERVICE_ID']);

    $stRating = $arResult[$curProvisor_ID]['AVERAGE_RATING'];
    $stVotesAmount = $arResult[$curProvisor_ID]['VOTES_AMOUNT'];
    if ($stRating > 0)
        {
            $stRating = sprintf("%.2f", $stRating);
            $stVotesAmount = '(Число голосов: '.$stVotesAmount.')';
        }
    else  
        {
            $stRating = "Нет данных";
            $stVotesAmount = "";
        }
    $arResult[$curProvisor_ID]['AVERAGE_RATING'] = $stRating;
    $arResult[$curProvisor_ID]['VOTES_AMOUNT'] = $stVotesAmount;

//echo '<strong>Результат выборки:</strong> <br />';
//echo '<pre>'; echo print_r($arResult); echo '</pre>';

$this->IncludeComponentTemplate();



?>