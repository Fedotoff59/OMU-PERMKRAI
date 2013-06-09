<?

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of providers
 *
 * @author Fedotoff
 */
class providers {
  
    /*
     * Функция подсчитывает количество поставщиков в соответствии с заданным
     * набором МО и услуг
     * 
     */
    
    public static function count_providers($arLocationsIDs, $ServiceID) {
    $CountProviders = false;
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
                              'PROPERTY_SERVICES.ID' => $ServiceID);
        $arProvSelect = Array('ID', 'NAME');
        $db_ProvList = CIBlockElement::GetList(false, $arProvFilter, false, false, $arProvSelect);
        while($elProv = $db_ProvList->GetNextElement())
            $i++;
    endwhile;
        $CountProviders = $i;
    endif;
    return $CountProviders;
}
    
    
    public static function get_providers($arLocationsIDs, $ServiceID, $arNav = Array()) {
    $arProv = false;
    if(CModule::IncludeModule("iblock")):
    // Определяем номера инфоблоков поставщиков
        $arFilter = Array('IBLOCK_ID' => IB_LOCATIONS_ID, 'ID' => $arLocationsIDs);
        $arSelect = Array('IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_ALIAS', 'PROPERTY_IBPROVIDERS');
        $arOrder = Array('NAME' => 'ASC');
        $db_List = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
        $i = 0;
    while($el = $db_List->GetNextElement()):     
        $arFields = $el->GetFields();
        $arProvFilter = Array('IBLOCK_ID' => $arFields['PROPERTY_IBPROVIDERS_VALUE'],
                                'PROPERTY_SERVICES.ID' => $ServiceID);
        $arProvSelect = Array('ID', 'NAME');
        $arProvOrder  = Array('NAME' => 'ASC');       
        $db_ProvList = CIBlockElement::GetList($arProvOrder, $arProvFilter, false, false, $arProvSelect);
        while($elProv = $db_ProvList->GetNextElement()):
            // Если не усьановлен массив навигации, то получаем данные всех поставщиков
            // Если массив установлен, то получаем параметры поставщиков из интервала
            if (empty($arNav))
                $bGetProvParams = true;
                elseif($i >= $arNav['START_NAV'] && $i <= $arNav['END_NAV'])
                    $bGetProvParams = true;
                    else $bGetProvParams = false;
            if($bGetProvParams):
                $arProvFields = $elProv->GetFields();
                $arProv[$i]['LOCATION'] = $arFields['NAME'];
                $arProv[$i]['NAME'] = $arProvFields['NAME'];
                $arProv[$i]['ID'] = $arProvFields['ID'];
                $alias = $arFields['PROPERTY_ALIAS_VALUE'];
                $arProv[$i]['PROVIDER_LINK'] = '/services/'.$ServiceID.'/providers/'.$alias.'/'.$arProv[$i]['ID'].'/';
            endif;
            $i++;
        endwhile;
    endwhile;
    endif;
    return $arProv;
}
}

?>
