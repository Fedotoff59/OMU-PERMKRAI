<?
echo '<pre>'; print_r($arParams); echo '</pre>';
if(CModule::IncludeModule("iblock")):

// Получаем полное и скоращенное наименование услуги
$res = CIBlockElement::GetByID($arParams['SERVICE_ID']); 
if($ar_res = $res->GetNext())
    {
        $arResult['SERVICE_NAME'] = $ar_res['NAME'];
        $db_props = CIBlockElement::GetProperty($arParams['IB_SERVICES_ID'], 
                $arParams['SERVICE_ID'], array("sort" => "asc"), 
                array("CODE"=>"FULLNAME"));
        if($ar_props = $db_props->Fetch())
	$arResult['SERVICE_FULL_NAME']  = $ar_props["VALUE"];
    }
    

// Формируем данные для формы оценки
    $arFields = array();
    $db_props = CIBlockElement::GetProperty($arParams['IB_SERVICES_ID'], 
                $arParams['SERVICE_ID'], "sort", "asc", array("CODE" => "CRITERIAS"));
    while ($ob = $db_props->GetNext())
    {
        if ($ob['VALUE'])
        {
           $arSelect = Array("ID","NAME"); // выборка имен критериев
           $arFilter = Array("IB_SERVICES_ID"=>$arParams['IB_CRITERIAS_ID'], 
                            "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","ID"=>$ob['VALUE']);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
           if ($ob2 = $res->GetNextElement())
           {
             $arFields[] = $ob2->GetFields();
           }
        }
    }
 
//Передаем критерии шаблону   
    $arResult['CRITERIAS'] = $arFields; 

endif;

$this->IncludeComponentTemplate();
?>