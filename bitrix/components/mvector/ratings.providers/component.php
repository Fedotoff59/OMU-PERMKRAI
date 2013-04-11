<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

$arResult = Array();

$ItemsPerRow = 25;

if (isset($_GET['page']) && $_GET['page'] > 1)
    $CurentPage = $_GET['page'];
    else $CurentPage = 1;


$Service_ID = $arParams['SEF_VARIABLES']['SERVICE_ID'];

if(CModule::IncludeModule("iblock")):
    
    $res = CIBlockElement::GetByID($Service_ID);
    if($ar_res = $res->GetNext())
    $Service_NAME = $ar_res['NAME'];
    
    $arFilter = Array('IBLOCK_ID' => $arParams['IB_PROVISORS_ID'],
                  'PROPERTY_SERVICES' => $Service_ID);
    $arSelect  = Array('IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_LOCATION.ID', 'PROPERTY_LOCATION.NAME', 'PROPERTY_LOCATION.PROPERTY_ALIAS');
    $arOrder = Array('PROPERTY_LOCATION.NAME' => 'ASC', 'NAME' => 'ASC');
    $db_List = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
    $rowCount = $db_List->SelectedRowsCount();
    $LastPage = ceil($rowCount / $ItemsPerRow);
    if($CurentPage > $LastPage)
        $CurentPage = $LastPage;
    $arResult['ITEMS_RANGE'] = Range(($CurentPage - 1)* $ItemsPerRow + 1, $CurentPage * $ItemsPerRow);
    $i = 0;
    //$db_List = CIBlockElement::GetList(Array('PROPERTY_PLACE' => 'ASC'), $arFilter, false, Array('nTopCount' => 25), $arSelectFields);
    while($el = $db_List->GetNextElement())
    {
        
        if (in_array($i + 1, $arResult['ITEMS_RANGE'])):
        $arFields = $el->GetFields();
        $arProv[$i]['ID'] = $arFields['ID'];
        $arProv[$i]['NAME'] = $arFields['NAME'];
        $LocationID = $arFields['PROPERTY_LOCATION_ID'];
        $arProv[$i]['PROVISOR_LOCATION'] = $arFields['PROPERTY_LOCATION_NAME'];
        $alias = $arFields['PROPERTY_LOCATION_PROPERTY_ALIAS_VALUE'];
        $arProv[$i]['PROVISOR_LINK'] = 'http://'.SITE_SERVER_NAME.'/services/'.$Service_ID.'/provisors/'.$alias.'/'.$arProv[$i]['ID'];
        $curProvRating = CRating::provisors_rating(Array($arFields['ID']), $Service_ID);
        $arProv[$i]['AVERAGE_RATING'] = 0;
        foreach ($curProvRating as $provID => $arCurProvRating)
            foreach ($arCurProvRating as $key => $CurProvRating_VALUE)
                if($key != 'CRITERIAS_RATING')
                    $arProv[$i][$key] = $CurProvRating_VALUE;
        if ($arProv[$i]['AVERAGE_RATING'] > 0) {
            $stRating = $arProv[$i]['AVERAGE_RATING'];
            $arProv[$i]['AVERAGE_RATING'] = sprintf("%.2f", $stRating);
            $stRating = $arProv[$i]['AVERAGE_PERCENT_RATING'];
            $arProv[$i]['AVERAGE_PERCENT_RATING'] = sprintf("%.2f", $stRating);
            $arProv[$i]['AVERAGE_PERCENT_RATING'] = $arProv[$i]['AVERAGE_PERCENT_RATING'].' %';
        } else {
            $arProv[$i]['AVERAGE_PERCENT_RATING'] = 'Нет данных';
            $arProv[$i]['VOTES_AMOUNT'] = 0;
        }
           
        endif;
        $i++;
    }
endif;

$arResult['PROVISOR'] = $arProv;
$arResult['PROVISORS_AMOUNT'] = $i;
$arResult['SERVICE_NAME'] = $Service_NAME;
$arResult['CURRENT_PAGE'] = $CurentPage;
$arResult['LAST_PAGE'] = $LastPage;


//echo '<pre>'; print_r($arParams); echo '</pre>';
$this->IncludeComponentTemplate();



?>