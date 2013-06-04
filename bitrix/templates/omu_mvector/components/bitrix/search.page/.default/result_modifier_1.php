<?

foreach($arResult['SEARCH'] as $id => $arSearchItem ) {
        if ($arSearchItem['PARAM1'] == IBT_PROVIDERS && $arSearchItem['ITEM_ID'][0] != 'S') {
            $arFilter = Array('ID' => 683, 'ACTIVE' => 'Y');
            $arSelect = Array('IBLOCK_ID', 'ID' , 'NAME',
                              'PROPERTY_SERVICES',
                              'PROPERTY_ADDRESS');
            $res = CIBlockElement::GetList(false, $arFilter, false, false, $arSelect); 
            while($ob = $res->GetNextElement()) 
                $arFields = $ob->GetFields();
            $URL = SITE_SERVER_NAME;
            $URL .= '/services/'.$arFields['PROPERTY_SERVICES_VALUE'][0];
            $URL .= '/providers/'.$arFields['PROPERTY_LOCATION_PROPERTY_ALIAS_VALUE'];
            $URL .= '/'.$arFields['ID'];
            $arResult['SEARCH'][$id]['BODY_FORMATED'] .= 'Адрес';
            $arResult['SEARCH'][$id]['URL'] = 'http://'.$URL;
        } else unset($arResult['SEARCH'][$id]);
}

echo '<pre>'; print_r($arFields /**/); echo '</pre>';

?>
