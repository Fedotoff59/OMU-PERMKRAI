<?

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CProviders
 *
 * @author Fedotoff
 */
class CProviders {
  
    /*
     * Функция подсчитывает количество поставщиков в соответствии с заданным
     * набором МО и услуг
     * 
     */
    
public static function CountProviders($arLocationsIDs, $arServiceIDs) {
    $CountProviders = 0;
    if(CModule::IncludeModule("iblock")):
    $i = 0;
    // Получаем номера инфоблоков поставщиков для заданных МО
    $arFilter = Array('IBLOCK_ID' => IB_LOCATIONS_ID, 'ID' => $arLocationsIDs);
    $arSelect = Array('IBLOCK_ID', 'ID', 'PROPERTY_IBPROVIDERS');
    $db_List = CIBlockElement::GetList(false, $arFilter, false, false, $arSelect);
    // Просматриваем по очереди все инфоблоки
    while($el = $db_List->GetNextElement()):
        $arFields = $el->GetFields();
        $arProvFilter = Array('IBLOCK_ID' => $arFields['PROPERTY_IBPROVIDERS_VALUE'],
                                  'PROPERTY_SERVICES.ID' => $arServiceIDs);
            $arProvSelect = Array('ID', 'NAME');
            $db_ProvList = CIBlockElement::GetList(false, $arProvFilter, false, false, $arProvSelect);
            while($elProv = $db_ProvList->GetNextElement()) {
                $i++;
            }                
    endwhile;
    $CountProviders = $i;
    endif;
    return $CountProviders;
}
    
public static function GetProviders($arLocationsIDs, $arServiceIDs, $arNav = Array()) {
    $arProv = false;
    if(CModule::IncludeModule("iblock")):
    // Определяем номера инфоблоков поставщиков
        $arFilter = Array('IBLOCK_ID' => IB_LOCATIONS_ID, 'ID' => $arLocationsIDs);
        $arSelect = Array('IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_ALIAS', 'PROPERTY_IBPROVIDERS');
        $arOrder = Array('NAME' => 'ASC');
        $db_List = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
    while($el = $db_List->GetNextElement()):     
        $arFields = $el->GetFields();
        $arProvFilter = Array('IBLOCK_ID' => $arFields['PROPERTY_IBPROVIDERS_VALUE'],
                                    'PROPERTY_SERVICES.ID' => $arServiceIDs);
        $arProvSelect = Array('ID', 'NAME', 'PROPERTY_SERVICES');
        $arProvOrder  = Array('NAME' => 'ASC');
        // Если установлена навигация, применяем ее.
        if (isset($arNav['ACTIVE_PAGE']) && isset($arNav['SIZE_PAGE']))
            $arProvNav = Array('iNumPage' => $arNav['ACTIVE_PAGE'], 'nPageSize' => $arNav['SIZE_PAGE']);
            else $arProvNav = false;
        $db_ProvList = CIBlockElement::GetList($arProvOrder, $arProvFilter, false, $arProvNav, $arProvSelect);
        while($elProv = $db_ProvList->GetNextElement()):
            $arProvFields = $elProv->GetFields();
            $elProvID = $arProvFields['ID'];
            $arProv[$elProvID]['LOCATION'] = $arFields['NAME'];
            $arProv[$elProvID]['NAME'] = $arProvFields['NAME'];
            $arProv[$elProvID]['ID'] = $elProvID;
            $alias = $arFields['PROPERTY_ALIAS_VALUE'];
            // Получаем ссылки на формы оценки по услугам, которые оказывает поставщик
            foreach($arProvFields['PROPERTY_SERVICES_VALUE'] as $num => $Sid)
                $arProv[$elProvID]['PROVIDER_FORM_URLS'][$Sid] = '/services/'.$Sid.'/providers/'.$alias.'/'.$arProv[$elProvID]['ID'].'/';
        endwhile;
    endwhile;
    endif;
    return $arProv;
}
}

?>
