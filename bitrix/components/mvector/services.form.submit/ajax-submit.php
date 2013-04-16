<?
/*
 * Скрипт служит для проверки запроса с данными об оценке.
 * Скрипт проверяет права пользователя на голосование в соответствии с установленными ограничениями.
 * В случае успешной проверки - оценки сохраняются в БД.
 * В случае неудачи выводится соответствующее сообщение об ошибке.
 * Запись о неудачной попытке так же сохраняется в БД
 * 
 */

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

define("ERR_MESSAGE_PERIOD_SERVICE", "Ошибка! Превышено число голосов от одного пользователя. За эту услугу Вы сможете проголосовать в следующем месяце.");
define("ERR_MESSAGE_PERIOD_PROVIDER", "Ошибка! Превышено число голосов от одного пользователя. За этого поставщика Вы сможете проголосовать в следующем месяце.");
define("ERR_MESSAGE_LOCATION", "Ошибка! Вы можете ставить оценки поставщикам и услугам только в пределах своей территории.");
define("ERR_MESSAGE_UNREGISTERED", "Ошибка! Для оценки Вам необходимо зарегистрироваться!");
define("THANKYOU_MESSAGE", "Спасибо, Ваш голос учтен!");

function get_post_request($_POST) {
    global $USER;
    $arResult = Array(); 
    $arResult['PERIODOFVOTE'] = get_voting_period(); // Из файла commonapi.php
    $arVotingFields = Array(
            'PROVIDER' => $_POST['provider_id'], 
            'SERVICE' => $_POST['service_id'], 
            'SERVICEDATE' => $_POST['service_date'],
            'DATEOFVOTE' => date("d.m.Y"),
            'CRITERIAVALUES' => Array(),
            'LOCATION' => $_POST['location_id'],
            'USERID' => $USER->GetID(),
            'USERIP' => $_SERVER['REMOTE_ADDR'],
            'PERIODOFVOTE' => $arResult['PERIODOFVOTE']['ID'],
            );
    for ($i = 1; $i <= intval($_POST['count_values']); $i++)
            $arVotingFields['CRITERIAVALUES'][$_POST['criteria_'.$i]] = $_POST['eval_'.$i];
    $arResult['SERVICE_NAME'] = $_POST['service_name'];
    $arResult['LOCATION_NAME'] = $_POST['location_name'];
    $arResult['FIELDS'] = $arVotingFields;

    return $arResult;
}

function save_vote($arVoteParams, $STATUS) {
    // Формируем поля для записи в БД
    // Формируем сообщение в соответствии со статусом оценки
    $STATUS_ID = 5; // ERR_UNDEFINED
    switch ($STATUS) {
        case 'OK': $SAVE_MESSAGE = THANKYOU_MESSAGE; $STATUS_ID = 1; break;
        case 'ERR_PERIOD': {
            if($arVoteParams['FIELDS']['PROVIDER'] == 0)
                $SAVE_MESSAGE = ERR_MESSAGE_PERIOD_SERVICE; 
                else $SAVE_MESSAGE = ERR_MESSAGE_PERIOD_PROVIDER; 
            $STATUS_ID = 2; 
            break;
        }
        case 'ERR_LOCATION': $SAVE_MESSAGE = ERR_MESSAGE_LOCATION; $STATUS_ID = 3; break;
        case 'ERR_UNREGISTERED': $SAVE_MESSAGE = ERR_MESSAGE_UNREGISTERED; $STATUS_ID = 4; break;
    }
    $arVoteParams['FIELDS']['STATUS'] = Array("VALUE" => $STATUS_ID);
    $arAddValuesElement = Array(
        "NAME" => $arVoteParams['SERVICE_NAME'].' - '.$arVoteParams['LOCATION_NAME'],
        "MODIFIED_BY" => $arVoteParams['FIELDS']['USERID'], // элемент изменен текущим пользователем
        "IBLOCK_SECTION_ID" => $arVoteParams['PERIODOFVOTE']['SECTION_ID'],  // Определяем раздел, где лежит элемент
        "IBLOCK_ID" => IB_VALUES_ID,                // ID блока с оценками 
        "PROPERTY_VALUES"=> $arVoteParams['FIELDS'],
        );

    // Записываем оценку пользователя в базу
    // Выводим сообщение о статусе оценки или об ошибке сохранения
    
    $el = new CIBlockElement;
    echo '<p style="color: #f00;"><strong>';
    if($EVAL_ID = $el->Add($arAddValuesElement))
        echo $SAVE_MESSAGE;
        // echo "Оценка сохранена в БД с ID: ".$EVAL_ID;
    else
        echo "Ошибка: ".$el->LAST_ERROR;
    echo '</strong></p>';

}


function check_vote_aceess($arVoteParams) {
    //По умолчанию статус не определен
    $STATUS = 'ERR_UNDEFINED';
    // Проверяем, зарегистрирован ли пользователь
    global $USER;
    if (!$USER->GetID()) 
        $STATUS = 'ERR_UNREGISTERED';
        else {
        // Проверяем, в своем ли муниципалитете голосует пользователь
        $rsUser = CUser::GetByID($USER);
        $arUser = $rsUser->Fetch();
        if($arUser["UF_LOCATION"] != $arVoteParams['FIELDS']['LOCATION']) 
            $STATUS = 'ERR_LOCATION';
            else {
                // Последняя проверка
                // Проверям превышение количества голосов за 1 объект оценки
                // Если меньше, то проверка полностью пройдена
                $arSelect = Array("ID", "NAME");
                $arFilter = Array(  "IBLOCK_ID"=> IB_VALUES_ID, 
                        "ACTIVE"=>"Y", 
                        "PROPERTY_LOCATION" => $arVoteParams['FIELDS']['LOCATION'],
                        "PROPERTY_SERVICE" => $arVoteParams['FIELDS']['SERVICE'],
                        "PROPERTY_PROVIDER" => $arVoteParams['FIELDS']['PROVIDER'],
                        "PROPERTY_USERID" =>  $USER->GetID(),
                        "PROPERTY_PERIODOFVOTE" => $arVoteParams['PERIODOFVOTE']['ID']);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                $i = 0;
                while($ob = $res->GetNextElement())
                {
                    $i++;
                }
                if ($i < $arVoteParams['PERIODOFVOTE']['PERIODVOTESCOUNT']) 
                    $STATUS = 'OK'; 
                    else $STATUS = 'ERR_PERIOD';     

            }
    }
    return $STATUS;
}

if(CModule::IncludeModule("iblock")):
if (isset($_POST['count_values'])) 
{
    // Получаем необходимые данные из POST запроса
    $arVoteParams = get_post_request($_POST);
    // Проверяем доступ пользователя
    $vote_aceess =  check_vote_aceess($arVoteParams);
    // Сохраняем оценки в БД
    save_vote($arVoteParams, $vote_aceess);
    //echo '<pre>'; print_r($arVoteParams); echo '</pre>';
 }
endif;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>