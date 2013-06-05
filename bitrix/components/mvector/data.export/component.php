<?

foreach($_GET as $key => $value) {
    $k = explode('_', $key);
    $param = $k[0];
    if ($param == 'lid') {
        $arFilter['LOCATIONS'][] = $value;
        $arGetLocationsKEYs[] = $key;
    }
    if ($param == 'sid') {
        $arFilter['SERVICES'][] = $value;
    }
    if ($key == 'form')
        $arFilter['FORM'] = $value;
    if ($key == 'format')
        $arFilter['FORMAT'] = $value;
}
CDataExport::ScreenExport($arFilter);
$this->IncludeComponentTemplate();
?>
