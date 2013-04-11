
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

$arData = $arResult;

$arExcel = Array();

 foreach($arData as $row => $rowData) {
    $arExcel[$row] = Array();
        foreach($rowData as $cell => $cellData)
            if($cell != 'DIAGRAM_WIDTH' && $cell != 'LOCATION_ID')
                $arExcel[$row][] = $cellData;
 }

if ($arParams['FILE_TYPE'] == 'Excel')
   CDataExport::ExcelExport($arExcel);
if ($arParams['FILE_TYPE'] == 'PDF')
    CDataExport::PDFExport($arExcel);
 
?>
