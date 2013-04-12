<?
/*
 * Файл служит для проверки запроса с данными об оценке.
 * В случае удачной проверки происходит отправка результата в виде сообщения
 * 
 */

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$ERR_MESSAGE_ = '';

function get_voting_obj ($LOCATION_ID, $SERVICE_ID, $PROVIDER_ID = 0) {
    //
    $arVotingObj = Array(
        'TYPE' => NULL,
        'LOCATION_ID' => $LOCATION_ID,
        'SERVICE_ID' => $SERVICE_ID,
        'PROVIDER_ID' => $PROVIDER_ID
    );
    if ($PROVIDER_ID == 0)
        $arVotingObj['TYPE'] = 'SERVICE';
    else 
        $arVotingObj['TYPE'] = 'PROVIDER';
    
    return $arVotingObj;
}

function get_post_request($_POST) {
        $arVotingFields = array(
            'PROVIDER' => $_POST['provider_id'], // Этот параметр нужно определить
            'SERVICE' => $_POST['service_id'], // Этот параметр нужно определить
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
}


function check_voting_obj_aceess($USER, $VOTING_OBJ) {
    //
    // Получить территорию текущего пользователя
    $LOCATION_ID = '';
}

global $USER;

if(CModule::IncludeModule("iblock")):
if (isset($_POST['count_values'])) // Записываем оценку пользователя в базу
{

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
 
 //echo '<pre>'; echo print_r($_POST); echo '</pre>';
//echo 'Спасибо за оценку';
}
endif;
?>
