<?

$arResult = Array();

$fullDiagramWidth = 300;

$Service_ID = $arParams['SEF_VARIABLES']['SERVICE_ID'];

$arLocationRating = Array();
$arRating = CRating::services_rating();
//CRating::locations_rating();
ksort($arRating);
$fullAveragePercentRating = 0;
$i = 0;
foreach ($arRating as $LocationID => $arServiceIDRating) {
    $averageLocPercentRating = 0;
    $votesAmount = 0;
    $j = 0;
    foreach($arServiceIDRating as $ServiceID => $arCurServiceRating) {
        $averageLocPercentRating += $arCurServiceRating['AVERAGE_PERCENT_RATING'];
        $votesAmount += $arCurServiceRating['VOTES_AMOUNT'];
        $j++;
    }
    $arLocationRating[$LocationID]['AVERAGE_PERCENT_RATING'] = $averageLocPercentRating / $j;
    $fullAveragePercentRating += $arLocationRating[$LocationID]['AVERAGE_PERCENT_RATING'];
    $arLocationRating[$LocationID]['VOTES_AMOUNT'] = $votesAmount;
    $i++;
}

/*
if ($i != 0)
    $fullAveragePercentRating = $fullAveragePercentRating / $i;
*/
$arFilter = Array('IBLOCK_ID' => $arParams['IB_LOCATIONS_ID']);
$arSelect  = Array('IBLOCK_ID', 'ID', 'NAME');
$db_List = CIBlockElement::GetList(Array('NAME' => 'ASC'), $arFilter, false, false, $arSelect);
$i = 0;
$arLocationLoyalty = Array();
while($el = $db_List->GetNextElement())
{
   $arFields = $el->GetFields();
   $arLocationLoyalty[$i]['LOCATION_ID'] = $arFields['ID'];
   $arLocationLoyalty[$i]['LOCATION_NAME'] = $arFields['NAME'];
   if (isset($arLocationRating[$arFields['ID']]['AVERAGE_PERCENT_RATING'])) {
      $stLoyalty = $arLocationRating[$arFields['ID']]['AVERAGE_PERCENT_RATING'];
      $DiagramWidth = $fullDiagramWidth * $stLoyalty / 100;
      $stLoyalty = sprintf("%.2f", $stLoyalty);
      //$stLoyalty .= ' %';
      $arLocationLoyalty[$i]['AVERAGE_PERCENT_RATING'] = $stLoyalty;
      $arLocationLoyalty[$i]['VOTES_AMOUNT'] = $arLocationRating[$arFields['ID']]['VOTES_AMOUNT'];
      $arLocationLoyalty[$i]['DIAGRAM_WIDTH'] = sprintf("%.0f", $DiagramWidth);
   } else {
      $arLocationLoyalty[$i]['AVERAGE_PERCENT_RATING'] = 'Нет данных';
      $arLocationLoyalty[$i]['VOTES_AMOUNT'] = 0;
      $arLocationLoyalty[$i]['DIAGRAM_WIDTH'] = 0;
   }
       
   $i++;
} 

$arResult = $arLocationLoyalty;

//echo '<pre>'; print_r($arResult); echo '</pre>';

$this->IncludeComponentTemplate();

?>
