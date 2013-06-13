<?
class CServices {
    
    
    const IB_SERVICES_ID = IB_SERVICES_ID; // Инфблок с услугами
    
/*
 * Функция возвращает услуги в виде массива разделов и самих услуг
 * 
 */    
    
    public static function GetServices($arSections = Array()) {
        if(CModule::IncludeModule("iblock")):
        $arServices = Array();
        $arFilter = Array('IBLOCK_ID'=>self::IB_SERVICES_ID, 'ID' => $arSections, 'ACTIVE'=>'Y');
	$db_Section_list = CIBlockSection::GetList(Array("sort"=>"asc"), $arFilter, true);
	while($arSection_result = $db_Section_list->GetNext())
	{
		$arElementFilter = Array('IBLOCK_ID' => self::IB_SERVICES_ID, 'SECTION_ID' => $arSection_result['ID'], 'ACTIVE'=>'Y');
		$arElementSelect = Array('ID', 'NAME');
		$db_Element_List = CIBlockElement::GetList(Array("name"=>"asc"), $arElementFilter, false, false, $arElementSelect);
		$arServices[$arSection_result['ID']]['SECTION_NAME'] = $arSection_result['NAME'];
                $arServices[$arSection_result['ID']]['ELEMENTS'] = Array();
		while($Element = $db_Element_List->GetNextElement())
		{
			$arElementFields = $Element->GetFields();
			$arServices[$arSection_result['ID']]['ELEMENTS'][$arElementFields['ID']] = $arElementFields['NAME'];
		}
	}
        endif;
        return $arServices;
    }
    
    public static function GetServicesParams($arServiceIDs) {
        // Получаем полное и скоращенное наименование услуг
        $arServices = false;
        if(CModule::IncludeModule("iblock")):
            $arServices = Array();
            $arFilter = Array('IBLOCK_ID' => self::IB_SERVICES_ID, 
                               'ID' => $arServiceIDs
                                );
            $arSelect = Array(  'ID', 
                        'NAME', 
                        'PROPERTY_FULLNAME'
                    );
            $arOrder = Array("NAME" => "ASC");
            $db_List = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
            while($el = $db_List->GetNextElement())
            {
                $arFields = $el->GetFields();
                $arServices[$arFields['ID']]['SERVICE_ID'] = $arFields['ID'];
                $arServices[$arFields['ID']]['SERVICE_NAME'] = $arFields['NAME'];
                $arServices[$arFields['ID']]['SERVICE_FULLNAME'] = $arFields['PROPERTY_FULLNAME_VALUE'];                
            }
            
        endif;
        return $arServices;
    }
    
    public static function GetServiceCriterias($SID) {
        // Формируем данные для формы оценки
    $arFields = false;
// Получаем по ID услуги IDs соответствующих критериев
    $db_props = CIBlockElement::GetProperty(IB_SERVICES_ID, 
                $SID, "sort", "asc", array("CODE" => "CRITERIAS"));
    while ($ob = $db_props->GetNext())
    {
        if ($ob['VALUE'])
        {   // Зная IDs критериев оценки, получаем их имена
           $arSelect = Array("ID","NAME"); 
           $arFilter = Array(   "IBLOCK_ID" => IB_CRITERIAS_ID, 
                                "ID" => $ob['VALUE'],
                                "ACTIVE" => "Y"
                            );
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
           if ($ob2 = $res->GetNextElement())
           {
             $arFields[] = $ob2->GetFields();
           }
        }
    }
    return $arFields;
    }
 /*
 * Функция проверяет, существует ли запрошеный раздел
 * 
 */    
    
    public static function CheckSection($SectionID) {
        $bRightSection = false;
        if(CModule::IncludeModule("iblock")):
        $arFilter = Array('IBLOCK_ID'=>self::IB_SERVICES_ID, 'ID' => $SectionID, 'ACTIVE'=>'Y');
	$db_Section_list = CIBlockSection::GetList(Array("sort"=>"asc"), $arFilter, true);
	if ($arSection_result = $db_Section_list->GetNext())
            $bRightSection = true;    
        endif;
        return $bRightSection;
    }
}
?>