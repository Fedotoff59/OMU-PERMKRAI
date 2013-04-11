<?

$arResult = Array();

$Service_ID = $arParams['SEF_VARIABLES']['SERVICE_ID'];

$arRating = CRating::services_rating($Service_ID);

$res = CIBlockElement::GetByID($Service_ID);
if($ar_res = $res->GetNext())
  $Service_NAME = $ar_res['NAME'];

$arLoyalty = Array();

$arFilter = Array('IBLOCK_ID' => $arParams['IB_LOCATIONS_ID']);
$arSelect  = Array('IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_ALIAS');
$db_List = CIBlockElement::GetList(Array('NAME' => 'ASC'), $arFilter, false, false, $arSelect);
$i = 0;
while($el = $db_List->GetNextElement())
{
   $arFields = $el->GetFields();
   $arLoyalty[$i]['LOCATION_ID'] = $arFields['ID'];
   $arLoyalty[$i]['LOCATION_NAME'] = $arFields['NAME'];
   $arLoyalty[$i]['FORM_VALUES_LINK'] = 'http://'.SITE_SERVER_NAME.'/services/'.$Service_ID.'/'.$arFields['PROPERTY_ALIAS_VALUE'];
   $i++;
} 

for($i = 0; $i < count($arLoyalty); $i++)
{
    $locationID = $arLoyalty[$i]['LOCATION_ID'];
    if (isset($arRating[$locationID][$Service_ID]['AVERAGE_PERCENT_RATING'])) {
       $stRating = $arRating[$locationID][$Service_ID]['AVERAGE_PERCENT_RATING'];
       $arLoyalty[$i]['AVERAGE_PERCENT_RATING'] = sprintf("%.2f", $stRating);
       $arLoyalty[$i]['VOTES_AMOUNT'] = $arRating[$locationID][$Service_ID]['VOTES_AMOUNT'];
    } else {
       $arLoyalty[$i]['AVERAGE_PERCENT_RATING'] = 'Нет данных';
       $arLoyalty[$i]['VOTES_AMOUNT'] = 0;
    }
}

//$arProvRating = CRating::provisors_rating($arIBLOCK_ID, Array(), $Service_ID);

$arFilter = Array('IBLOCK_ID' => $arParams['IB_PROVISORS_ID'],
                  'PROPERTY_SERVICES' => $Service_ID);
$arSelect  = Array('IBLOCK_ID', 'ID');
$db_List = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
if( $db_List->SelectedRowsCount() > 0)
    $bServceHasProvisors = true;
    else $bServceHasProvisors = false;

$arResult['SERVICE_ID'] = $Service_ID;
$arResult['SERVICE_NAME'] = $Service_NAME; 
$arResult['SERVICE_LOYALTY'] = $arLoyalty;
$arResult['SERVICE_HAS_PROVISORS'] = $bServceHasProvisors;

//echo '<br />'.$Service_NAME;
//echo '<pre>'; print_r($arResult); echo '</pre>';

$this->IncludeComponentTemplate();

?>
