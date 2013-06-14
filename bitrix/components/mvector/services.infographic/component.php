<?
if(CModule::IncludeModule("iblock")):

    $arComServices = CServices::GetServices();
    $LocationID = $arParams['LOCATION_ID'];
    $CurLocatin = CLocations::GetLocationParams($LocationID);
    $CurLocatinAlias = $CurLocatin[$LocationID]['LOCATION_ALIAS'];
    $arResult = Array();
    $arResult['COUNT_PROVIDERS'] = Array();
    // Проверка числа поставщиков
    
    foreach ($arComServices as $Section_ID => $arServices) {
        unset($arServicesIDs);
        foreach ($arServices['ELEMENTS'] as $Service_ID => $Service_Name)
            $arServicesIDs[] = $Service_ID;
        $CountProviders = CProviders::CountProviders($LocationID, $arServicesIDs);
        $arResult['COUNT_PROVIDERS'][] = $CountProviders;
        $arResult['S_PROVIDERS_URLS'][] = ($CountProviders > 0) ? 
            '/services/providers/'.$Section_ID.'/'.$CurLocatinAlias.'/' : 'javascript:void(0)';
    }
endif;
    $this->IncludeComponentTemplate();
?>
