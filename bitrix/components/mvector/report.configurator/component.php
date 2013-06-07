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
if($params[1] != '') {
    $arResult['EXCEL_REPORT_LINK']['FORM_1'] = '/export.php?'.$params[1].'&format=xlsx&form=1';
    $arResult['PDF_REPORT_LINK']['FORM_1'] = '/export.php?'.$params[1].'&format=pdf&form=1';
    $arResult['EXCEL_REPORT_LINK']['FORM_2'] = '/export.php?'.$params[1].'&format=xlsx&form=2';
    $arResult['PDF_REPORT_LINK']['FORM_2'] = '/export.php?'.$params[1].'&format=pdf&form=2';
        $arResult['EXCEL_REPORT_LINK']['FORM_3'] = '/export.php?'.$params[1].'&format=xlsx&form=3';
    $arResult['PDF_REPORT_LINK']['FORM_3'] = '/export.php?'.$params[1].'&format=pdf&form=3';
} else {
    $arResult['EXCEL_REPORT_LINK']['FORM_1'] = '/upload/ExcelExport/full-report-'.date('m-Y').'_01.xlsx';
    $arResult['PDF_REPORT_LINK']['FORM_1'] = '/upload/PDFExport/full-report-'.date('m-Y').'_01.pdf';
    $arResult['EXCEL_REPORT_LINK']['FORM_2'] = '/upload/ExcelExport/full-report-'.date('m-Y').'_02.xlsx';
    $arResult['PDF_REPORT_LINK']['FORM_2'] = '/upload/PDFExport/full-report-'.date('m-Y').'_02.pdf';
        $arResult['EXCEL_REPORT_LINK']['FORM_3'] = '/upload/ExcelExport/full-report-'.date('m-Y').'_03.xlsx';
    $arResult['PDF_REPORT_LINK']['FORM_3'] = '/upload/PDFExport/full-report-'.date('m-Y').'_03.pdf';
}
$this->IncludeComponentTemplate();
?>
