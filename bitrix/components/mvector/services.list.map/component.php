<?
if (isset($_GET['services'])):
    $Service_ID = $_GET['services'];
    $CurService = CServices::GetServicesParams($Service_ID);
    $arResult['SERVICE_NAME'] = $CurService[$Service_ID]['SERVICE_NAME'];
    $arResult['SERVICE_LINK'] = $APPLICATION->GetCurPage();
endif;
    
$this->IncludeComponentTemplate();
?>