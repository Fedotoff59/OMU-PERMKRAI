<?
//echo '<strong>Параметры выборки:</strong> <br />';
//echo '<pre>';
//echo print_r($arParams);    
//echo '</pre><br />';

if(CModule::IncludeModule("iblock")):

	$IB_SERVICES_ID = $arParams['IB_SERVICES_ID'];
	$arResult = Array();
	$arFilter = Array('IBLOCK_ID'=>$IB_SERVICES_ID, 'GLOBAL_ACTIVE'=>'Y');
	$db_Section_list = CIBlockSection::GetList(Array($by=>"id", $by2=>"asc"), $arFilter, true);
	while($arSection_result = $db_Section_list->GetNext())
	{
		$arElementFilter = Array('IBLOCK_ID' => $IB_SERVICES_ID, 'SECTION_ID' => $arSection_result['ID']);
		$arElementSelect = Array('ID', 'NAME');
		$db_Element_List = CIBlockElement::GetList(Array(), $arElementFilter, false, false, $arElementSelect);
		$arResult[$arSection_result['ID']] = array();
		while($Element = $db_Element_List->GetNextElement())
		{
			$arElementFields = $Element->GetFields();
			$arResult[$arSection_result['ID']][$arElementFields['ID']] = $arElementFields['NAME'];
		}
	}

endif;

//echo '<strong>Результат выборки:</strong> <br />';
//echo '<pre>'; echo print_r($arResult); echo '</pre>';

$this->IncludeComponentTemplate();
?>