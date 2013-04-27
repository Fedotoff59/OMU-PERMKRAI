<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
    $arResult = Array();
    $arResult['SERVICES'] = CServices::GetServices();
    $CurLocation = CLocations::GetCurrentLocationID();
    if($CurLocation > 0) {
        $arLocation = CLocations::GetLocationParams($CurLocation);
        $arResult['LOCATION_ALIAS'] = $arLocation[$CurLocation]['LOCATION_ALIAS'];
        $this->IncludeComponentTemplate();
    } else echo LOCATION_CHOICE_ERR_MSG;
?>