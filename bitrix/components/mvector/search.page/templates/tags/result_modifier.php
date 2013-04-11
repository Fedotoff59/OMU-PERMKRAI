<?

foreach($arResult['SEARCH'] as $id => $arSearchItem ) {
        $arSearchItem['BODY_FORMATED'] = 'TEST';
        //echo $arSearchItem[''];
        $arFilter = Array( 'ID' => $arResult['SEARCH'][$id]['PARAM2'] );
        $res = CIBlock::GetList(false, $arFilter, false);
        if($ar_res = $res->Fetch()) {
            $IB_CODE = $ar_res['CODE'];
            $IB_ID = $ar_res['ID'];
        }
        if ($IB_CODE = 'PROVISORS') {
            $arFilter = Array('IBLOCK_ID' => $IB_ID, 'ID' => $arSearchItem['ITEM_ID']);
            $arSelect = Array('ID' , 
                              'PROPERTY_SERVICES', 
                              'PROPERTY_LOCATION.PROPERTY_ALIAS' , 
                              'PROPERTY_SERVICES',
                              'PROPERTY_ADDRESS');
            $res = CIBlockElement::GetList(false, $arFilter, false, false, $arSelect); 
            while($ob  = $res->GetNextElement()) 
                $arFields = $ob->GetFields();
            $URL = SITE_SERVER_NAME;
            $URL .= '/services/'.$arFields['PROPERTY_SERVICES_VALUE'][0];
            $URL .= '/provisors/'.$arFields['PROPERTY_LOCATION_PROPERTY_ALIAS_VALUE'];
            $URL .= '/'.$arFields['ID'];
            $arResult['SEARCH'][$id]['BODY_FORMATED'] = $arFields['PROPERTY_ADDRESS_VALUE'];
            $arResult['SEARCH'][$id]['URL'] = 'http://'.$URL;
        }
}

//echo '<pre>'; print_r($arFields /**/); echo '</pre>';

?>
