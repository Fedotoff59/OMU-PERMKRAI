<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

if (isset($_GET) && $_GET['load'] == 'locations'):
    if ($_GET['format'] == 'xlsx')
        $filetype = 'Excel';
    if ($_GET['format'] == 'pdf')
        $filetype = 'PDF';
    if (isset($filetype))
        $APPLICATION->IncludeComponent(
            "mvector:ratings.locations",
            "fullreport",
            array('IB_SERVICES_ID' => $arParams['IB_SERVICES_ID'],
                  'IB_CRITERIAS_ID' => $arParams['IB_CRITERIAS_ID'],
                  'IB_VALUES_ID' => $arParams['IB_VALUES_ID'],
                  'IB_LOCATIONS_ID' => $arParams['IB_LOCATIONS_ID'],
                  'IB_PROVISORS_ID' => $arParams['IB_PROVISORS_ID'],
                  'REPORT_TYPE' => 'FULL_LOCATIONS_REPORT',
                  'FILE_TYPE' => $filetype,
            ), false
        );
endif;
 //echo '<pre>'; print_r($arExcel); echo '</pre>';      

$this->IncludeComponentTemplate();
?>