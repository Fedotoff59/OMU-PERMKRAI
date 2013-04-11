<?
//echo '<strong>Компонент вывода формы оценки услуги<br /> Входные данные:</strong> <br />';
//echo '<pre>'; echo print_r($arParams); echo '</pre>';
$arResult = array();
unset($_SESSION['COMMENT']);
$_SESSION['COMMENT']['SERVICE_ID'] = $arParams['SERVICE_ID'];


if(CModule::IncludeModule("iblock")):
$res = CIBlockElement::GetByID($arParams['SERVICE_ID']); // Получаем полное и скоращенное наименование услуги
if($ar_res = $res->GetNext())
    {
        $arResult['SERVICE_NAME'] = $ar_res['NAME'];
        $db_props = CIBlockElement::GetProperty($arParams['IB_SERVICES_ID'], 
                $arParams['SERVICE_ID'], array("sort" => "asc"), 
                array("CODE"=>"FULLNAME"));
        if($ar_props = $db_props->Fetch())
	$arResult['SERVICE_FULLNAME']  = $ar_props["VALUE"];
    }
    
if (isset($_POST['count_values'])) // Записываем оценку пользователя в базу
{
    $arResult['TEMPLATE'] = 'SENT_VALUES';
    $arFields = array(
            'PROVISOR' => 0,
            'SERVICE' => $arParams['SERVICE_ID'],
            'SERVICEDATE' => $_POST['service_date'],
            'VALUATIONDATE' => date("d.m.Y"),
            'CRITERIAVALUES' => array(),
            'LOCATION' => $arParams['LOCATION_ID'],
            'USERID' => $USER->GetID(),
            'USERIP' => $_SERVER['REMOTE_ADDR'],
            //'USER_SESSION_ID' => $_POST['sessid']
            );
    for ($i = 1; $i <= intval($_POST['count_values']); $i++)
            {$arFields['CRITERIAVALUES'][$_POST['criteria_'.$i]] = $_POST['eval_'.$i];}
    echo '<p style="color: #f00;"><strong>Спасибо за оценку</strong></p>';
    echo '<pre>'; echo print_r($arFields); echo '</pre>';
    
    $el = new CIBlockElement;
    
    $arAddValuesElement = Array(
        'NAME' => $arResult['SERVICE_NAME'].' - '.$arParams['LOCATION_NAME'],
        "MODIFIED_BY" => $USER->GetID(), // элемент изменен текущим пользователем
        "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
        "IBLOCK_ID" => $arParams['IB_VALUES_ID'],                // ID блока с оценками 
        "PROPERTY_VALUES"=> $arFields
  );

   // echo '<pre>'; print_r($arAddValuesElement); echo '</pre>';
    
    if($EVAL_ID = $el->Add($arAddValuesElement))
        echo "Оценка сохранена в БД с ID: ".$EVAL_ID;
    else
        echo "Ошибка: ".$el->LAST_ERROR;
 

}
else { // Формируем данные для формы оценки
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
    
           $arSelect = Array('IBLOCK_ID',"ID","NAME", 'PROPERTY_COMMENT', 'PROPERTY_ANSWER', 'PROPERTY_SERVICE'); // выборка имен критериев
           $arFilter = Array("IBLOCK_ID"=>25, 
                            "POPERTY_SERVICE"=>$arParams['SERVICE_ID'], 
                            "POPERTY_LOCATION"=>$arParams['LOCATION_ID']);
            $res1 = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
           if ($ob3 = $res1->GetNextElement())
           {
             $arCommentFields[] = $ob3->GetFields();
             //echo '<pre>'; print_r($arCommentFields); echo '</pre>';
           }
    
    
    $arResult['CRITERIAS'] = $arFields; //Передаем критерии шаблону
    if (!count($arResult['CRITERIAS']))
       {
            echo '<p><strong style="color : #f00;">Критерии оценки еще не заполнены...</strong><p>';
       }
    $arResult['TEMPLATE'] = 'FORM_VALUES';
    $this->IncludeComponentTemplate();
}
 endif;
 //echo 'Печать из компонента';
 //echo '<pre>'; echo print_r($arParams['SEF_VARIABLES']); echo '</pre>'; 
?>