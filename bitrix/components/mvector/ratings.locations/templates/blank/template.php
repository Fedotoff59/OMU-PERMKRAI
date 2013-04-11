<?

$arData = $arResult;

$arExcel = Array();

 foreach($arData as $row => $rowData) {
    $arExcel[$row] = Array();
        foreach($rowData as $cell => $cellData)
            if($cell != 'DIAGRAM_WIDTH' && $cell != 'LOCATION_ID')
                $arExcel[$row][] = $cellData;
 }


?>
