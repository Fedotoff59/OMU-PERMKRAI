<?
/*
 *  Компонент выводит блок комментариев, 
 *  относящихся к текущей форме оценки (поставщика / услуги)
 *  в зависимости от выбранного муниципального образования
 */
   
    $arResult = Array();
    
    unset($_SESSION['COMMENT']);
    $_SESSION['COMMENT']['SERVICE_ID'] = $arParams['SERVICE_ID'];
    if (isset($arParams['PROVIDER_ID']) && $arParams['PROVIDER_ID'] > 0)
        $_SESSION['COMMENT']['PROVIDER_ID'] = $arParams['PROVIDER_ID'];

    $Service_ID = $arParams['SERVICE_ID'];
    $Provider_ID = $arParams['PROVIDER_ID'];
    $Location_ID = $arParams['LOCATION_ID'];
    
    // Определяем, из какого инфоблока будем читать комментарии     
    $db_props = CIBlockElement::GetProperty(IB_LOCATIONS_ID, $Location_ID, Array("sort"=>"asc"), Array("CODE"=>"IBCOMMENTS"));
       if($ar_props = $db_props->Fetch())
          $IB_COMMENTS_ID = IntVal($ar_props["VALUE"]);
          else
          $IB_COMMENTS_ID = false;
    // Создаем элемент инфоблока   
    
    $arFilter = Array();
    $arFilter['IBLOCK_ID'] = intval($IB_COMMENTS_ID);
    // Определяем поля выборки в зависимости от того задан ли поставщик
    if ($Provider_ID > 0)
       $arFilter['PROPERTY_PROVIDER'] = $Provider_ID;
    $arFilter['PROPERTY_SERVICE'] = $Service_ID;
    $arFilter['ACTIVE'] = 'Y';
    $arOrder = Array("created" => "desc");
    $arSelect = Array("ID", "NAME", "PROPERTY_COMMENTTEXT", "PROPERTY_COMMENTANSWER", "CREATED_BY", "DATE_CREATE");

    $res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
    $i = 0;
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $arResult[$i]['ID'] = $arFields['ID'];
        $arResult[$i]['TOPIC'] = $arFields['NAME'];
        $arResult[$i]['COMMENTTEXT'] = $arFields['PROPERTY_COMMENTTEXT_VALUE'];
        $arResult[$i]['COMMENTANSWER'] = $arFields['PROPERTY_COMMENTANSWER_VALUE'];
        $date = $arFields['DATE_CREATE'];
        $arCommentdate = date_parse_from_format("d.m.Y H:i:s", $date);
        $months = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
        $arResult[$i]['COMMENTDATE'] = $arCommentdate['day'];
        $arResult[$i]['COMMENTDATE'] .= ' '.$months[$arCommentdate['month'] - 1];
        $arResult[$i]['COMMENTDATE'] .= ' '.$arCommentdate['year'];
        if ($arFields['CREATED_BY']) {
            $rsUser = CUser::GetByID($arFields['CREATED_BY']);
            $arUser = $rsUser->Fetch();
            $stUser = $arUser['LOGIN'];
            $stUser .= ' (';
            $stUser .= $arUser['NAME'];
            $stUser .= ' ';
            $stUser .= $arUser['LAST_NAME'];
            $stUser .= ')';
        } else {
            $stUser = 'Аноним';
        }

        $arResult[$i]['COMMENTPOSTER'] = $stUser;
        $i++;
    }
    
    
//echo '<strong>Данные компонента:</strong> <br />';
//echo '<pre>';  print_r($arFields); echo '</pre>';

$this->IncludeComponentTemplate();
?>