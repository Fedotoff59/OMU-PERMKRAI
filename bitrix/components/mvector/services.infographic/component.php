<?
if(CModule::IncludeModule("iblock")):

    $arComServices = CServices::GetServices();
    $arLocation = CLocations::GetLocationParams($arParams['LOCATION_ID']);
    $IB_PROVIDERS_ID = $arLocation[$arParams['LOCATION_ID']]['IB_PROVIDERS_ID'];
    $arResult = Array();
    $arResult['COUNT_PROVIDERS'] = Array();
    // Проверка числа поставщиков
    
    foreach ($arComServices as $Section_ID => $arServices) {
        unset($arServicesIDs);
        foreach ($arServices['ELEMENTS'] as $Service_ID => $Service_Name)
            $arServicesIDs[] = $Service_ID;
    $arProviders = Array();
    $arSelect = Array("ID", "NAME");
    $arFilter = Array("IBLOCK_ID" => $IB_PROVIDERS_ID, 
                      "ACTIVE" => "Y", 
                      "PROPERTY_SERVICES.ID" => $arServicesIDs
                );
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
     {
            $arProviders[] = $ob->GetFields();
     }
     $arResult['COUNT_PROVIDERS'][] = count($arProviders);
     //print_r($arServicesIDs);
    }
endif;
    $this->IncludeComponentTemplate();
?>
