<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
// Задаем константы постраничной навигации
define("ELEMENTS_PER_PAGE", 30);
define("PAGES_IN_GROUP", 7);

function get_providers($arLocationsIDS, $ServiceID, $arNav = Array()) {
    $arProv = false;
    if(CModule::IncludeModule("iblock")):
    $arFilter = Array('IBLOCK_ID' => IB_LOCATIONS_ID, 'ID' => $arLocationsIDS);
    $arSelect = Array('IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_ALIAS', 'PROPERTY_IBPROVIDERS');
    $arOrder = Array('NAME' => 'ASC');
    $db_List = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
    $i = 0;
    while($el = $db_List->GetNextElement()):     
        $arFields = $el->GetFields();
        $arProvFilter = Array('IBLOCK_ID' => $arFields['PROPERTY_IBPROVIDERS_VALUE'],
                                'PROPERTY_SERVICES.ID' => $ServiceID);
        $arProvSelect = Array('ID', 'NAME');
        $arProvOrder  = Array('NAME' => 'ASC');
        
        $db_ProvList = CIBlockElement::GetList($arProvOrder, $arProvFilter, false, false, $arProvSelect);
        while($elProv = $db_ProvList->GetNextElement()):
            if($i >= $arNav['START_NAV'] && $i <= $arNav['END_NAV']):
            $arProvFields = $elProv->GetFields();
            $arProv[$i]['LOCATION'] = $arFields['NAME'];
            $arProv[$i]['NAME'] = $arProvFields['NAME'];
            $arProv[$i]['ID'] = $arProvFields['ID'];
            $alias = $arFields['PROPERTY_ALIAS_VALUE'];
            $arProv[$i]['PROVIDER_LINK'] = '/services/'.$ServiceID.'/providers/'.$alias.'/'.$arProv[$i]['ID'].'/';
            $curProvRating = CRating::providers_rating(Array($arFields['ID']), $ServiceID);
            $arProv[$i]['AVERAGE_RATING'] = 0; 
            foreach ($curProvRating as $provID => $arCurProvRating)
                foreach ($arCurProvRating as $key => $CurProvRating_VALUE)
                    if($key != 'CRITERIAS_RATING')
                        $arProv[$i][$key] = $CurProvRating_VALUE;
            if ($arProv[$i]['AVERAGE_RATING'] > 0) {
            //$stRating = $arProv[$i]['AVERAGE_RATING'];
            //$arProv[$i]['AVERAGE_RATING'] = sprintf("%.2f", $stRating);
            //$stRating = $arProv[$i]['AVERAGE_PERCENT_RATING'];
            $arProv[$i]['AVERAGE_PERCENT_RATING'] = '&nbsp;&nbsp;&otimes;';//sprintf("%.2f", $stRating);
            //$arProv[$i]['AVERAGE_PERCENT_RATING'] = $arProv[$i]['AVERAGE_PERCENT_RATING'].' %';
            } else {
                $arProv[$i]['AVERAGE_PERCENT_RATING'] = '&nbsp;&nbsp;&otimes;';
                $arProv[$i]['VOTES_AMOUNT'] = 0;
            }
            endif;
            $i++;
        endwhile;
    endwhile;
    endif;
    return $arProv;
}

$arResult = Array();
$arResult['FILTERED_LOCATIONS'] = Array();
$Service_ID = $arParams['SERVICE_ID'];
$arService = get_service_params($Service_ID);
$arResult['SERVICE_NAME'] = $arService['NAME'];
$CurentPage = 1;

if (isset($_GET['page']) && $_GET['page'] > 1)
        $CurentPage = $_GET['page'];
if (isset($_GET['nofilter']) && $_GET['nofilter'] == 'yes') {
            $arLocationsIDS = Array();
            $arResult['FILTER_LINK'] = 'nofilter=yes';
        }
        else {
            foreach($_GET as $key => $value) {
                $k = explode('_', $key);
                $lid = $k[0];
                if ($lid == 'lid') {
                    $arLocationsIDS[] = $value;
                    $report_link .= '&'.$key.'='.$value;
                }
            }
            if(!$arLocationsIDS)
                $arLocationsIDS[] = (CLocations::GetCurrentLocationID() > 0) ? CLocations::GetCurrentLocationID() : DEFAULT_LOCATION_ID;
            $arResult['FILTERED_LOCATIONS'] = CLocations::GetLocationParams($arLocationsIDS);
            foreach ($arResult['FILTERED_LOCATIONS'] as $elID => $arLocation) {
                $arRemoveLocationFilterIDS = $arLocationsIDS;
                $key = array_search($elID, $arRemoveLocationFilterIDS);
                if ($key !== false)
                {
                    unset($arRemoveLocationFilterIDS[$key]);
                }
                if (!empty($arRemoveLocationFilterIDS))
                    $RemoveFilterLink = http_build_query($arRemoveLocationFilterIDS, 'lid_');
                else $RemoveFilterLink = 'nofilter=yes';
                $arResult['FILTERED_LOCATIONS'][$elID]['REMOVE_FILTER_LINK'] = $RemoveFilterLink;
                $arResult['FILTER_LINK'] = http_build_query($arLocationsIDS, 'lid_');
            }   
        }
$countProviders = count_providers($arLocationsIDS, $Service_ID);
$arResult['PAGENAV'] = pagenav($CurentPage, $countProviders, ELEMENTS_PER_PAGE, PAGES_IN_GROUP);
$arResult['PROVIDERS'] = get_providers($arLocationsIDS, $Service_ID, $arResult['PAGENAV']);
$arResult['PDF_REPORT_LINK']['FORM_2'] = '/export.php?format=pdf&form=2&sid_0='.$Service_ID.$report_link;
$arResult['EXCEL_REPORT_LINK']['FORM_2'] = '/export.php?format=xlsx&form=2&sid_0='.$Service_ID.$report_link;

//echo '<pre>'; print_r($countProviders); echo '</pre>';
$this->IncludeComponentTemplate();
?>