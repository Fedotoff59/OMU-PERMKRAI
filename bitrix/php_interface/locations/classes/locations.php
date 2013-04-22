<?

class CLocations {
    
    
    const IB_LOCATIONS_ID = IB_LOCATIONS_ID; // Инфблок с местоположениями
    
    
    function GetLocationParams($Location_ID) {
        
        $arLocation = Array();
        if (isset($Location_ID) && $Location_ID > 0) {
        if(CModule::IncludeModule("iblock")): 
             $arFilter = Array('IBLOCK_ID' => self::IB_LOCATIONS_ID, 
                               'ID' => $Location_ID
                                );
             $arSelect = Array(  'ID', 
                        'NAME', 
                        'PROPERTY_ALIAS', 
                        'PROPERTY_IBPROVIDERS', 
                        'PROPERTY_IBCOMMENTS', 
                        'PROPERTY_SPECIALIST'
                    );
            $db_List = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            while($el = $db_List->GetNextElement())
            {
                $arFields = $el->GetFields();
                $arLocation['LOCATION_ID'] = $arFields['ID'];
                $arLocation['LOCATION_NAME'] = $arFields['NAME'];
                $arLocation['LOCATION_ALIAS'] = $arFields['PROPERTY_ALIAS_VALUE'];
                $arLocation['IB_PROVIDERS_ID'] = $arFields['PROPERTY_IBPROVIDERS_VALUE'];
                $arLocation['IB_COMMENTS_ID'] = $arFields['PROPERTY_IBCOMMENTS_VALUE'];
                $arLocation['SPECIALIST_ID'] = $arFields['PROPERTY_SPECIALIST_VALUE'];
                
            }
        endif;     
        }
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
    
    function SetLocationByAlias ($Location_ALIAS) {
        
        global $APPLICATION;
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
                self::SetLocationByID($Location_ID);
            }  
            endif;
            
        }

    }
    
}

?>