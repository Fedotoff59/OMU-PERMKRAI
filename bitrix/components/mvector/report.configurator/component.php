<?

foreach($_GET as $key => $value) {
    $k = explode('_', $key);
    $param = $k[0];
    if ($param == 'lid') {
        $arGetLocationsIDs[] = $value;
        $arGetLocationsKEYs[] = $key;
    }
    if ($param == 'sid') {
        $arServicesIDs[] = $value;
        $arServicesKEYs[] = $key;
    }
}

if (isset($arGetLocationsIDs)) {   
    $arResult['FILTERED_LOCATIONS'] = CLocations::GetLocationParams($arGetLocationsIDs);
    foreach ($arResult['FILTERED_LOCATIONS'] as $elID => $arLocation) {
             $i = array_search($elID, $arGetLocationsIDs);
             $RemoveLocationFilterLink = $APPLICATION->GetCurPageParam('', Array($arGetLocationsKEYs[$i]));
             $arResult['FILTERED_LOCATIONS'][$elID]['REMOVE_FILTER_LOCATION_LINK'] = $RemoveLocationFilterLink;
    }  
}
if (isset($arServicesIDs)) {   
    $arResult['FILTERED_SERVICES'] = CServices::GetServicesParams($arServicesIDs);
    foreach ($arResult['FILTERED_SERVICES'] as $elID => $arService) {
                $i = array_search($elID, $arServicesIDs);
                $RemoveServiceLink = $APPLICATION->GetCurPageParam('', Array($arServicesKEYs[$i]));
                $arResult['FILTERED_SERVICES'][$elID]['REMOVE_FILTER_SERVICE_LINK'] = $RemoveServiceLink;
    }  
}
$report_link = $APPLICATION->GetCurUri();
$params = explode('?', $report_link);
$arResult['EXCEL_REPORT_LINK']['FORM_2'] = '/ratings/report/export/?'.$params[1].'&format=xlsx&form=2';
$this->IncludeComponentTemplate();
?>
