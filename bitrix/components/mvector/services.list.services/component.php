<?

if(CModule::IncludeModule("iblock")):

	$arResult = Array();
	$arFilter = Array('IBLOCK_ID'=>IB_SERVICES_ID, 'ACTIVE'=>'Y');
	$db_Section_list = CIBlockSection::GetList(Array($by=>"id", $by2=>"asc"), $arFilter, true);
	while($arSection_result = $db_Section_list->GetNext())
	{
		$arElementFilter = Array('IBLOCK_ID' => IB_SERVICES_ID, 'SECTION_ID' => $arSection_result['ID']);
		$arElementSelect = Array('ID', 'NAME');
		$db_Element_List = CIBlockElement::GetList(Array(), $arElementFilter, false, false, $arElementSelect);
		$arResult[$arSection_result['ID']]['SECTION_NAME'] = $arSection_result['NAME'];
                $arResult[$arSection_result['ID']]['ELEMENTS'] = Array();
		while($Element = $db_Element_List->GetNextElement())
		{
			$arElementFields = $Element->GetFields();
			$arResult[$arSection_result['ID']]['ELEMENTS'][$arElementFields['ID']] = $arElementFields['NAME'];
		}
	}

endif;

$this->IncludeComponentTemplate();
?>