<?
class CServices {
    
    
    const IB_SERVICES_ID = IB_SERVICES_ID; // Инфблок с услугами
    
/*
 * Функция возвращает услуги в виде массива разделов и самих услуг
 * 
 */    
    
    public static function GetServices() {
        if(CModule::IncludeModule("iblock")):
        $arServices = Array();
	$arFilter = Array('IBLOCK_ID'=>self::IB_SERVICES_ID, 'ACTIVE'=>'Y');
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
}
?>