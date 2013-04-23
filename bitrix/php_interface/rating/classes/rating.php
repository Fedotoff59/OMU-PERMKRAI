<?
class CRating {
    
    const IB_VALUES_ID = IB_VALUES_ID;
    const IB_SERVICES_ID = IB_SERVICES_ID;
    const IB_LOCATIONS_ID = IB_LOCATIONS_ID;
    const IB_VALUES_PERIOD_CODE = "IB_VALUES_PERIOD";

/*=============================================================================
* 
*   Функция расчета рейтингов по поставщикам 
* 
=============================================================================*/    
    
    function providers_rating ($arProviders = Array(),
                               $SERVICE_ID = 0,
                               $quantile = 1.282)
    {
    
    if(CModule::IncludeModule("iblock")):

/*
 *      Получаем критерии оценки для данной услуги    
 */
        $arCriteria = Array();
    
        $arFilter = Array('IBLOCK_ID' => self::IB_SERVICES_ID, 
                          'ID' => $SERVICE_ID
                         );
	$arSelect  = Array('IBLOCK_ID', 'ID', 'PROPERTY_CRITERIAS');
	$db_List = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($el = $db_List->GetNextElement())
	{
        
            $arFields = $el->GetFields();
            $arCriteria = $arFields['PROPERTY_CRITERIAS_VALUE'];
        }

/*
 *      Получаем оценки поставщиков    
 */
        
        $arValues = Array();        
      
        $arFilter = Array('IBLOCK_ID' => self::IB_VALUES_ID, 
                          'PROPERTY_PROVIDER' => $arProviders,
                          'PROPERTY_SERVICE' => $SERVICE_ID,
                          'PROPERTY_STATUS_VALUE' => 'OK'
                         );
	$arSelectFields  = Array('IBLOCK_ID', 'ID', 'PROPERTY_LOCATION', 'PROPERTY_SERVICE', 'PROPERTY_PROVIDER.ID', 'PROPERTY_CRITERIAVALUES');
	$db_List = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelectFields);
        while($el = $db_List->GetNextElement())
	{
        
            $arFields = $el->GetFields();
            // Каждому поставщику присваивается свой массив наборов оценок    
            $arValues[$arFields['PROPERTY_PROVIDER_ID']][] = $arFields['PROPERTY_CRITERIAVALUES_VALUE'];
        }

/*
 *      Приступаем к расчету рейтингов
 */        
        // Запускаем цикл перебора оценок каждого поставщика        

        
        $amountCriteria = count($arCriteria);
        $arRating = Array();
        $v_min = 1;
        $v_width = 4;
        foreach ($arValues as $CurProv_ID => $arCurProvValues) {
            $amountValues = count($arCurProvValues);
            $arSumCurProvValues = Array();
            $arPhat = Array();
            $arRating[$CurProv_ID] = Array();
            $curAverageRating = 0;
            for ($i = 0; $i < $amountCriteria; $i++) {
                $arSumCurProvValues[$i] = 0;
                $arPhat[$i] = 0;
                for ($j = 0; $j < $amountValues; $j++)
                    $arSumCurProvValues[$i] += $arCurProvValues[$j][$i];
                $arPhat[$i] = ( $arSumCurProvValues[$i] -  $amountValues * $v_min) /
                                $v_width / $amountValues;
                // Нижняя граница доверительного интервала Вильсона для параметра Бернулли
                $tmpRating = ($arPhat[$i] + 
                                $quantile * $quantile / (2 * $amountValues) -
                                $quantile * sqrt(($arPhat[$i] * (1 - $arPhat[$i]) +
                                $quantile * $quantile / (4 * $amountValues)) / $amountValues)) /
                                (1 + $quantile * $quantile / $amountValues);
                $tmpRating = $v_min + $tmpRating * $v_width;
                $arRating[$CurProv_ID]['CRITERIAS_RATING'][$arCriteria[$i]] = $tmpRating;
                $curAverageRating += $tmpRating;
            }
            $fullRating = $curAverageRating / $amountCriteria;
            $arRating[$CurProv_ID]['AVERAGE_RATING'] = $fullRating;
            if (strval($fullRating) == "1")
                    $percentRating = 0;
                    else $percentRating = 100 * ($fullRating - $v_min) / $v_width;  
            $arRating[$CurProv_ID]['AVERAGE_PERCENT_RATING'] = $percentRating;
            $arRating[$CurProv_ID]['VOTES_AMOUNT'] = $amountValues;
        }
        //echo '<pre>'; print_r($arFields); echo '</pre>';
        //echo '<pre>'; print_r($arRating); echo '</pre>';
    
        return $arRating;
        
    endif;    
    }
  
/*=============================================================================
* 
*   Функция расчета рейтингов по услугам 
* 
*=============================================================================*/
   
     
     function services_rating ($arServiсes = Array(), 
                               $arLocations = Array(),
                               $quantile = 1.282)
    {
    if(CModule::IncludeModule("iblock")):
        
/*
 *      Получаем критерии оценки для услуг    
 */
        $arCriteria = Array();
    
        $arFilter = Array('IBLOCK_ID' => self::IB_SERVICES_ID, 
                          'ID' => $arServiсes
                         );
	$arSelect  = Array('IBLOCK_ID', 'ID', 'PROPERTY_CRITERIAS');
	$db_List = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($el = $db_List->GetNextElement())
	{
        
            $arFields = $el->GetFields();
            $arCriteria[$arFields['ID']] = $arFields['PROPERTY_CRITERIAS_VALUE'];
        }

/*
 *      Получаем оценки услуг    
 */
        
        $arValues = Array();        
      
        $arFilter = Array('IBLOCK_ID' => self::IB_VALUES_ID, 
                          'PROPERTY_LOCATION' => $arLocations,
                          'PROPERTY_SERVICE' => $arServiсes,
                          'PROPERTY_STATUS_VALUE' => 'OK'
                         );
	$arSelect  = Array('IBLOCK_ID', 'ID', 'PROPERTY_LOCATION.ID', 'PROPERTY_SERVICE.ID', 'PROPERTY_PROVIDER.ID', 'PROPERTY_CRITERIAVALUES');
	$db_List = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($el = $db_List->GetNextElement())
	{
        
            $arFields = $el->GetFields();
            // Записываем оценки в массив вида:
            // Код МО => Код услуги => Набор оценок => Оценка по каждому критерию
            $arValues[$arFields['PROPERTY_LOCATION_ID']][$arFields['PROPERTY_SERVICE_ID']][] = $arFields['PROPERTY_CRITERIAVALUES_VALUE'];
        }        

/*
 *      Приступаем к расчету рейтингов
 */        
        // Запускаем цикл перебора оценок каждого поставщика        
        $arRating = Array();
        $v_min = 1.0;
        $v_width = 4.0;
        $arRating['FULL_VOTES_AMOUNT'] = 0;
        foreach ($arValues as $locationID => $arServices)
        {
            $arRating[$locationID] = Array();
            foreach ($arServices as $serviceID => $arCurServiceValues)
            {
                $arRating[$locationID][$serviceID] = Array();
                $amountValues = count($arCurServiceValues);
                $amountCriterias = count($arCriteria[$serviceID]);
                $arSumCriteriaValues = Array();
                $arPhat = Array();
                $averageRating = 0;
                //settype($averageRating, 'double');
                for ($i = 0; $i < $amountCriterias; $i++)
                {
                    $arSumCriteriaValues[$i] = 0;
                    $arPhat[$i] = 0;
                    for ($j = 0; $j < $amountValues; $j++)
                        $arSumCriteriaValues[$i] += $arCurServiceValues[$j][$i];
                    $arPhat[$i] = ( $arSumCriteriaValues[$i] -  $amountValues * $v_min) /
                                    $v_width / $amountValues;
                    // Нижняя граница доверительного интервала Вильсона для параметра Бернулли
                    $tmpRating = ($arPhat[$i] + 
                                    $quantile * $quantile / (2 * $amountValues) -
                                    $quantile * sqrt(($arPhat[$i] * (1 - $arPhat[$i]) +
                                    $quantile * $quantile / (4 * $amountValues)) / $amountValues)) /
                                (1 + $quantile * $quantile / $amountValues);
                    $tmpRating = $v_min + $tmpRating * $v_width;
                    $averageRating = $averageRating + $tmpRating;
                    $arRating[$locationID][$serviceID]['CRITERIAS_RATING'][$arCriteria[$serviceID][$i]] = $tmpRating;                   
                }
                
                $fullRating = $averageRating / $amountCriterias;
                $arRating[$locationID][$serviceID]['AVERAGE_RATING'] = $fullRating;
                if (strval($fullRating) == "1")
                    $percentRating = 0;
                    else $percentRating = 100 * ($fullRating - $v_min) / $v_width;            
                //if ($serviceID == 394 && $locationID == 481) echo '<br>'.$percentRating;
                $arRating[$locationID][$serviceID]['AVERAGE_PERCENT_RATING'] = $percentRating; 
                $arRating[$locationID][$serviceID]['VOTES_AMOUNT'] = $amountValues;
                $arRating['FULL_VOTES_AMOUNT'] += $amountValues;
            }
        }
        
        //echo '<pre>'; print_r($arRating); echo '</pre>';    
        return $arRating;
    endif;        
    }
    
    function locations_rating() {
        $arRating = self::services_rating();
        $m = 3; // Константа нормализации результатов
        
        $arLocationRating = Array();
        
        $arServices = Array();
        
        if(CModule::IncludeModule("iblock")):
        $arFilter = Array('IBLOCK_ID' => self::IB_SERVICES_ID);
	$arSelect  = Array('IBLOCK_ID', 'ID');
	$db_List = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($el = $db_List->GetNextElement())
	{
            $arFields = $el->GetFields();
            $arServices[] = $arFields['ID'];
        }    
        endif;
        
        $fullAverageRating = 0;
        foreach ($arRating as $LocationID => $arSrvicesRating) {
            $curLocPercRating = 0;
            $curLocVotesAmount = 0;
            foreach($arSrvicesRating as $ServiceID => $arCurServiceRating) {
                $curLocPercRating += $arCurServiceRating['AVERAGE_PERCENT_RATING'];
                $curLocVotesAmount += $arCurServiceRating['VOTES_AMOUNT'];
            }
            $arLocationRating[$LocationID]['AVERAGE_PERCENT_RATING'] = $curLocPercRating / count($arSrvicesRating);
            $arLocationRating[$LocationID]['VOTES_AMOUNT'] = $curLocVotesAmount;
            $fullAverageRating += $arLocationRating[$LocationID]['AVERAGE_PERCENT_RATING'];
        }
        
        $fullAverageRating = $fullAverageRating / count($arRating);
        
        foreach($arLocationRating as $LocationID => $arCurLocRating) {
            $v = $arCurLocRating['VOTES_AMOUNT'];
            $R = $arCurLocRating['AVERAGE_PERCENT_RATING'];
            $arLocationRating[$LocationID]['CORRECT_AVERAGE_PERCENT'] = ($v / ($v+$m)) * $R + ($m / ($v+$m)) * $fullAverageRating;
        }

        echo '<pre>'; print_r($arLocationRating); echo '</pre>'.$fullAverageRating;
    }
    
 /*=============================================================================
* 
*   Функция возвращает свойства текущего отчетного периода
* 
*=============================================================================*/
    
    function get_voting_period() {
        if(CModule::IncludeModule("iblock")):
        
        $arCurPeriod = Array();
        $arSelect = Array("ID", "NAME", "PROPERTY_PERIODSECTION", "PROPERTY_PERIODVOTESCOUNT");
        $arFilter = Array("IBLOCK_CODE"=>self::IB_VALUES_PERIOD_CODE, "ACTIVE"=>"Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNextElement())
        {
            $arFields = $ob->GetFields();
            // Получаем ID раздела, где будут сохраняться оценки
            $arCurPeriod['SECTION_ID'] = $arFields['PROPERTY_PERIODSECTION_VALUE'];
            // Получаем ограничение по количеству голосов за 1 объект в текущем отчетном периоде
            $arCurPeriod['PERIODVOTESCOUNT'] = $arFields['PROPERTY_PERIODVOTESCOUNT_VALUE'];
        }
        return $arCurPeriod;
        endif;
}
}

?> 