<?

$arResult = Array();

/*
 *  Получаем информацию о других услугах поставщика
 */
    $arFilter = Array("ID" => $arParams['PROVIDER_ID'], "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(false, $arFilter, false, false, false);
    while($ob = $res->GetNextElement())
    {
        $arProps = $ob->GetProperties();
        if (count($arProps['SERVICES']['VALUE']) > 1)
            {
                // Если у поставщика больше 1 услуги - сохраняем их имена
                $arResult['OTHER_SERVICE'] = Array();
                for ($i = 0; $i < count($arProps['SERVICES']['VALUE']); $i++) {
                    if ($arProps['SERVICES']['VALUE'][$i] != $arParams['SERVICE_ID']) {
                        $OTH_SERVICE_ID = $arProps['SERVICES']['VALUE'][$i];
                        $arOthServiceIDs[] = $OTH_SERVICE_ID;
                        //echo $OTH_SERVICE_ID;
                    }
                } 
                $arServiceFilter = Array("ID" => $arOthServiceIDs, "ACTIVE"=>"Y");
                $arServiceSelect = Array("ID", "NAME");
                $Service_res = CIBlockElement::GetList(false, $arServiceFilter, false, false, $arServiceSelect);
                $i = 0;
                $arLocationParams = CLocations::GetLocationParams($arParams['LOCATION_ID']);
                $LOCATION_ALIAS = $arLocationParams[$arParams['LOCATION_ID']]['LOCATION_ALIAS'];
                while($Service_ob = $Service_res->GetNextElement()) {
                    $arFields = $Service_ob->GetFields();
                    $arResult['OTHER_SERVICE'][$i]['NAME'] = $arFields['NAME'];
                    $arResult['OTHER_SERVICE'][$i]['LINK'] = 'http://'.SITE_SERVER_NAME.'/services';
                    $arResult['OTHER_SERVICE'][$i]['LINK'] .= '/'.$arFields['ID'];
                    $arResult['OTHER_SERVICE'][$i]['LINK'] .= '/providers/'.$LOCATION_ALIAS;
                    $arResult['OTHER_SERVICE'][$i]['LINK'] .= '/'.$arParams['PROVIDER_ID'].'/';
                    $i++;
                }
                //echo '<pre>'; print_r($arResult); echo '</pre>';    
            }
    }

$this->IncludeComponentTemplate();
?>
