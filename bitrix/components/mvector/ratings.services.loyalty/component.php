<?

$arResult = Array();

$Service_ID = $arParams['SERVICE_ID'];

$arRating = CRating::services_rating($Service_ID);

// Получаем полное и скоращенное наименование услуги
$res = CIBlockElement::GetByID($arParams['SERVICE_ID']); 
if($ar_res = $res->GetNext())
    {
        $arResult['SERVICE_NAME'] = $ar_res['NAME'];
        $db_props = CIBlockElement::GetProperty(IB_SERVICES_ID, 
                $arParams['SERVICE_ID'], array("sort" => "asc"), 
                array("CODE"=>"FULLNAME"));
        if($ar_props = $db_props->Fetch())
	$arResult['SERVICE_FULL_NAME']  = $ar_props["VALUE"];
    }

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
       $arLoyalty[$i]['AVERAGE_PERCENT_RATING'] = '&nbsp;&nbsp;&otimes;';//sprintf("%.2f", $stRating);
       $arLoyalty[$i]['VOTES_AMOUNT'] = $arRating[$locationID][$Service_ID]['VOTES_AMOUNT'];
    } else {
       $arLoyalty[$i]['AVERAGE_PERCENT_RATING'] = '&nbsp;&nbsp;&otimes;';
       $arLoyalty[$i]['VOTES_AMOUNT'] = 0;
    }
}

$countProviders = count_providers(Array(), $Service_ID);
if ($countProviders > 0) {
    $curLocationID = CLocations::GetCurrentLocationID();
    $arResult['FILTER_LINK'] = (count_providers($curLocationID, $Service_ID) > 0) ? 'lid_0='.$curLocationID : 'nofilter=yes';
}    
$bServceHasProvisors = ($countProviders > 0) ? true : false; 

$arResult['SERVICE_LOYALTY'] = $arLoyalty;
$arResult['SERVICE_HAS_PROVISORS'] = $bServceHasProvisors;

//echo '<br />'.$Service_NAME;
//echo '<pre>'; print_r($countProviders); echo '</pre>';

$this->IncludeComponentTemplate();

?>
