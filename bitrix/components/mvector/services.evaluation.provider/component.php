<?

$arResult = array();
unset($_SESSION['COMMENT']);
$_SESSION['COMMENT']['SERVICE_ID'] = $arParams['SERVICE_ID'];
$_SESSION['COMMENT']['PROVIDER_ID'] = $arParams['PROVIDER_ID'];



    
/*
 *  Получаем карточку поставщика
 */
    $arResult['PROVIDER'] = Array();
    $arSelect = Array('NAME');
    $arFilter = Array('IBLOCK_ID' => $arParams['IB_PROVISORS_ID'], "ID" => $arParams['PROVIDER_ID'], "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(false, $arFilter, false, false, false);
   //  echo '<pre>'; print_r($arFilter); echo '</pre>';
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();
        $arResult['PROVIDER']['ID'] = $arFields['ID'];
        $arResult['PROVIDER']['NAME'] = $arFields['NAME'];
        $arResult['PROVIDER']['FULLNAME'] = $arProps['FULLNAME']['VALUE'];
        $arResult['PROVIDER']['LOCATION'] = $arProps['LOCATION']['VALUE'];
        $arResult['PROVIDER']['FORM'] = $arProps['FORM']['VALUE'];
        $arResult['PROVIDER']['INN'] = $arProps['INN']['VALUE'];
        $arResult['PROVIDER']['ADDRESS'] = $arProps['ADDRESS']['VALUE'];
        $arResult['PROVIDER']['CEO'] = $arProps['CEO']['VALUE'];
        $arResult['PROVIDER']['PHONE'] = $arProps['PHONE']['VALUE'];
        $arResult['PROVIDER']['FAX'] = $arProps['FAX']['VALUE'];
        $arResult['PROVIDER']['SITE'] = $arProps['SITE']['VALUE'];
        $arResult['PROVIDER']['EMAIL'] = $arProps['EMAIL']['VALUE'];
        if (count($arProps['SERVICES']['VALUE']) > 1)
            {
               // Добавить дополнительные услуги
            }
    
    $this->IncludeComponentTemplate();
    }

?>