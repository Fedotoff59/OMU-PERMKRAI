<?
/*
 * Компонент формирует перечень критериев для выбранной услуги.
 * Данные выводятся в виде формы с полузнками 
 */

if(CModule::IncludeModule("iblock")):

// Получаем полное и скоращенное наименование услуги
$res = CIBlockElement::GetByID($arParams['SERVICE_ID']); 
if($ar_res = $res->GetNext())
    {
        $arResult['SERVICE_NAME'] = $ar_res['NAME'];
        $db_props = CIBlockElement::GetProperty(IB_SERVICES_ID, 
                $arParams['SERVICE_ID'], array("sort" => "asc"), 
                array("CODE"=>"FULLNAME"));
        if($ar_props = $db_props->Fetch())
	$arResult['SERVICE_FULL_NAME']  = $ar_props["VALUE"];
    }
    

// Формируем данные для формы оценки
    $arFields = array();
// Получаем по ID услуги IDs соответствующих критериев
    $db_props = CIBlockElement::GetProperty(IB_SERVICES_ID, 
                $arParams['SERVICE_ID'], "sort", "asc", array("CODE" => "CRITERIAS"));
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
 
//Передаем критерии шаблону   
    $arResult['CRITERIAS'] = $arFields;
    
// Определяем имя формы

endif;

$this->IncludeComponentTemplate();
?>