<?

class CLocations {
    
    
    //const DEFAULT_LOCATION_ID = 470; // Пермь
    //const IB_LOCATIONS_ID = 23; // Инфблок с местоположениями
    
    
    function GetLocation() {
        global $APPLICATION;
        $Location_ID = 0;
        $arLocation = Array ();
        if ($_SESSION['LOCATION_ID'] > 0)
            $Location_ID = $_SESSION['LOCATION_ID'];
            elseif ($APPLICATION->get_cookie("LOCATION_ID") > 0)
                $Location_ID = $APPLICATION->get_cookie("LOCATION_ID");
                else {
                    $Location_ID = DEFAULT_LOCATION_ID;
                    self::SetLocationByID($Location_ID);
                }
        if ($Location_ID == 0)
            return false;
        
        if(CModule::IncludeModule("iblock")): 
             $arFilter = Array('IBLOCK_ID' => IB_LOCATIONS_ID, 
                               'ID' => $Location_ID
                                );
            $arSelect  = Array('IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_ALIAS');
            $db_List = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            while($el = $db_List->GetNextElement())
            {
                $arFields = $el->GetFields();
                $arLocation['LOCATION_ID'] = $arFields['ID'];
                $arLocation['LOCATION_NAME'] = $arFields['NAME'];
                $arLocation['LOCATION_ALIAS'] = $arFields['PROPERTY_ALIAS_VALUE'];
                
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
    
    function SetLocationByAlias ($Location_ALIAS) {
        
        global $APPLICATION;
        if (isset($Location_ALIAS) && $Location_ALIAS != '') {
            if(CModule::IncludeModule("iblock")): 
            $arFilter = Array('IBLOCK_ID' => IB_LOCATIONS_ID, 
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