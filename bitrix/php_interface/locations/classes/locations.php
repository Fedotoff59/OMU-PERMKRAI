<?

class CLocations {
    
    
    const IB_LOCATIONS_ID = IB_LOCATIONS_ID; // Инфблок с местоположениями
    
    function GetCurrentLocationID() {
        $Location_ID = 0;
        if (isset($_SESSION['LOCATION_ID']) && $_SESSION['LOCATION_ID'] > 0)
            $Location_ID = $_SESSION['LOCATION_ID'];
        return $Location_ID;
    }
    
    function GetLocationParams($arLocation_ID = Array()) {
        
        $arLocation = Array();
        if(CModule::IncludeModule("iblock")): 
            $arFilter = Array('IBLOCK_ID' => self::IB_LOCATIONS_ID, 
                               'ID' => $arLocation_ID
                                );
            $arSelect = Array(  'ID', 
                        'NAME', 
                        'PROPERTY_ALIAS', 
                        'PROPERTY_IBPROVIDERS', 
                        'PROPERTY_IBCOMMENTS', 
                        'PROPERTY_SPECIALIST'
                    );
            $arOrder = Array("NAME" => "ASC");
            $db_List = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
            while($el = $db_List->GetNextElement())
            {
                $arFields = $el->GetFields();
                $arLocation[$arFields['ID']]['LOCATION_ID'] = $arFields['ID'];
                $arLocation[$arFields['ID']]['LOCATION_NAME'] = $arFields['NAME'];
                $arLocation[$arFields['ID']]['LOCATION_ALIAS'] = $arFields['PROPERTY_ALIAS_VALUE'];
                $arLocation[$arFields['ID']]['IB_PROVIDERS_ID'] = $arFields['PROPERTY_IBPROVIDERS_VALUE'];
                $arLocation[$arFields['ID']]['IB_COMMENTS_ID'] = $arFields['PROPERTY_IBCOMMENTS_VALUE'];
                $arLocation[$arFields['ID']]['SPECIALIST_ID'] = $arFields['PROPERTY_SPECIALIST_VALUE'];
                
            }
        endif;     
        return $arLocation;
     }
 
    function SetLocationByID ($Location_ID) {
        global $APPLICATION;
        if (isset($Location_ID) && $Location_ID > 0)
        {
            $_SESSION['LOCATION_ID'] = $Location_ID;
            $APPLICATION->set_cookie("LOCATION_ID", $Location_ID);
        }
        
    }
    
    function GetLocationByAlias ($Location_ALIAS) {
        
        global $APPLICATION;
        $Location_ID = 0;
        if (isset($Location_ALIAS) && $Location_ALIAS != '') {
            if(CModule::IncludeModule("iblock")): 
            $arFilter = Array('IBLOCK_ID' => self::IB_LOCATIONS_ID, 
                              'PROPERTY_ALIAS' => $Location_ALIAS
                             );
            $arSelect  = Array('IBLOCK_ID', 'ID');
            $db_List = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            while($el = $db_List->GetNextElement())
            {
                $arFields = $el->GetFields();
                $Location_ID = $arFields['ID'];
            }  
            endif;
            
        }
        return $Location_ID;
    }
    
}

?>