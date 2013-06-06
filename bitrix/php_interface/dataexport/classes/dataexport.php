<?

class CDataExport {
    
    const SAVE_PATH_EXCEL = '/upload/ExcelExport/';
    const SAVE_PATH_PDF = '/upload/PDFExport/';
    
    private function GetLetter ($num){
        $aLetter=array(
        "A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
        "AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ",
        "BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ"
        );
        return $aLetter[$num]; 
    }
    
    private function cutString($string, $maxlen) {
    $len = (mb_strlen($string) > $maxlen)
        ? mb_strripos(mb_substr($string, 0, $maxlen), ' ')
        : $maxlen
    ;
    $cutStr = mb_substr($string, 0, $len);
    return (mb_strlen($string) > $maxlen)
        ?  $cutStr . '...'
        :  $cutStr;
    }
    
    private function SaveData($objPHPExcel, $type) {
              
        if ($type == 'Excel2007') {
            $savepath=$_SERVER["DOCUMENT_ROOT"].self::SAVE_PATH_EXCEL;
            $link = 'http://'.SITE_SERVER_NAME.self::SAVE_PATH_EXCEL;
            $tmp_filename="report-".date("d-m-y")."_".time().".xlsx";
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        } else if($type == 'PDF') {
            $savepath=$_SERVER["DOCUMENT_ROOT"].self::SAVE_PATH_PDF;
            $tmp_filename="report-".date("d-m-y")."_".time().".pdf";
            $link = 'http://'.SITE_SERVER_NAME.self::SAVE_PATH_PDF;
            $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
            $rendererLibrary = 'tcpdf';
            $rendererLibraryPath = $_SERVER["DOCUMENT_ROOT"].'/bitrix/php_interface/' . $rendererLibrary;
            if (!PHPExcel_Settings::setPdfRenderer(
		$rendererName,
		$rendererLibraryPath
                )) {
                    die(
                        'Please set the $rendererName and $rendererLibraryPath values' .
                        PHP_EOL .
                        ' as appropriate for your directory structure'
                     );
                }         
            $objWriter = new PHPExcel_Writer_PDF($objPHPExcel);
        }
        
        $objWriter->save($savepath.$tmp_filename);
        LocalRedirect($link.$tmp_filename);
    }
    
    private function get_providers($arLocationsIDS, $ServiceID) {
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
            $i++;
        endwhile;
    endwhile;
    endif;
    return $arProv;
    }
    
    public function ExcelExport($arData, $stDataType) {
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("PHP")
                ->setLastModifiedBy("Денис Федотов")
                ->setTitle("Office 2007 XLSX Тестируем")
                ->setSubject("Office 2007 XLSX Тестируем")
                ->setDescription("Тестовый файл Office 2007 XLSX, сгенерированный PHPExcel.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Тестовый файл");
        $objPHPExcel->getActiveSheet()->setTitle('Муниципальные образования');

        //$arExcel = Array();
        
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', '№')
                    ->setCellValue('B1', 'Муниципальное образование')
                    ->setCellValue('C1', 'Удовлетворенность услугами, %')
                    ->setCellValue('D1', 'Число оценок');

        $boldFont = array(
                    'font'=>array(
                    'name'=>'Calibri',
                    'size'=>'10',
                    'bold'=>true
                    )
        );

        $center = array(
                    'alignment'=>array(
                    'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'=>PHPExcel_Style_Alignment::VERTICAL_TOP
                    )
         );

        $style_header = Array (
                    'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb'=>'CCCCCC'),
                    )
          );

        $aSheet = $objPHPExcel->getActiveSheet();
        $aSheet->getStyle('C1')->getAlignment()->setWrapText(true);
        
        $aSheet->getColumnDimension('B')->setWidth(50);
        $aSheet->getColumnDimension('C')->setWidth(30);
        $aSheet->getColumnDimension('D')->setWidth(15);

        $aSheet->getStyle('A1:D1')->applyFromArray($boldFont)
               ->applyFromArray($center)->applyFromArray($style_header);

        $i = 0;
        foreach($arData as $row => $rowData) {
            $i++;
            $aSheet->setCellValue(self::GetLetter(0).($i+1), $i);
                foreach($rowData as $cell => $cellData){ 
                    $aSheet->setCellValue(self::GetLetter($cell + 1).($i + 1), $cellData);
                }
         $aSheet->getStyle('C'.($i + 1))
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);      
        }

        $aSheet->setAutoFilter('A1:D1');
        $aSheet->freezePane('A2');

        self::SaveData($objPHPExcel, 'Excel2007');
        
    }
    
    public function PDFExport ($arData) {
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("PHP")
                ->setLastModifiedBy("Денис Федотов")
                ->setTitle("Office 2007 XLSX Тестируем")
                ->setSubject("Office 2007 XLSX Тестируем")
                ->setDescription("Тестовый файл Office 2007 XLSX, сгенерированный PHPExcel.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Тестовый файл");
        $objPHPExcel->getActiveSheet()->setTitle('Муниципальные образования');

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', '№')
                    ->setCellValue('B1', 'Муниципальное образование')
                    ->setCellValue('C1', 'Удовлетворенность услугами, %')
                    ->setCellValue('D1', 'Число оценок');

        $boldFont = array(
                    'font'=>array(
                    'name'=>'Calibri',
                    'size'=>'10',
                    'bold'=>true
                    )
        );

        $center = array(
                    'alignment'=>array(
                    'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'=>PHPExcel_Style_Alignment::VERTICAL_TOP
                    )
         );

        $style_header = Array (
                    'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb'=>'CCCCCC'),
                    )
          );

        $aSheet = $objPHPExcel->getActiveSheet();
        $aSheet->getStyle('C1')->getAlignment()->setWrapText(true);
        
        $aSheet->getColumnDimension('B')->setWidth(50);
        $aSheet->getColumnDimension('C')->setWidth(30);
        $aSheet->getColumnDimension('D')->setWidth(15);

        $aSheet->getStyle('A1:D1')->applyFromArray($boldFont)
               ->applyFromArray($center)->applyFromArray($style_header);

        $i = 0;
        foreach($arData as $row => $rowData) {
            $i++;
            $aSheet->setCellValue(self::GetLetter(0).($i+1), $i);
                foreach($rowData as $cell => $cellData){ 
                    $aSheet->setCellValue(self::GetLetter($cell + 1).($i + 1), $cellData);
                }
         $aSheet->getStyle('C'.($i + 1))
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);      
        }

        $aSheet->setAutoFilter('A1:D1');
        $aSheet->freezePane('A2');
        
        self::SaveData($objPHPExcel, 'PDF');
        
    }
    
    public function PrintExport ($arData) {
        
    }
    
    private function ExcelExport_Form2($arServices) {
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("PHP")
                ->setLastModifiedBy("Денис Федотов")
                ->setTitle("Office 2007 XLSX Тестируем")
                ->setSubject("Office 2007 XLSX Тестируем")
                ->setDescription("Тестовый файл Office 2007 XLSX, сгенерированный PHPExcel.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Тестовый файл");
        $center = array(
                    'alignment'=>array(
                    'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'=>PHPExcel_Style_Alignment::VERTICAL_CENTER
                    )
         );

        $style_header = Array (
                    'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb'=>'CCCCCC'),
                    )
          );
        
        $H1 = array('font'=>array('name'=>'Calibri', 'size'=>'12', 'bold'=>true));
        $H2 = array('font'=>array('name'=>'Calibri', 'size'=>'11', 'bold'=>true));
        $SheetNum = 0;
        foreach ($arServices as $key => $CurService):
        $CurServiceNAME = self::cutString($CurService['SERVICE_NAME'], 27);
        if($SheetNum > 0)
            $objPHPExcel->createSheet($SheetNum);
        $objPHPExcel->setActiveSheetIndex($SheetNum);
        $objPHPExcel->getActiveSheet()->setTitle($CurServiceNAME);
        $aSheet = $objPHPExcel->getActiveSheet();
        $aSheet->getColumnDimension('A')->setWidth(5);
        $aSheet->getColumnDimension('B')->setWidth(40);

        $aSheet->setCellValue('A1', $CurService['SERVICE_FULLNAME']);
        $aSheet->getStyle('A1')->applyFromArray($H1);
        $aSheet->setCellValue('A2', 'Критерии оценки');
        $aSheet->getStyle('A2')->applyFromArray($H2);
        $j = 3;
        foreach ($CurService['CRITERIAS'] as $row => $arCurCriteria) {            
            $aSheet->setCellValue('A'.$j, ($row+1).'. '.$arCurCriteria['NAME']);
            $j++;
        }
        $i = $j;
        $lastCriteriaCell = $row + 3;
        $i++;
        $aSheet->setCellValue('A'.$i, '№');
        $aSheet->getStyle('A'.$i)->applyFromArray($style_header)->applyFromArray($center);
        $aSheet->setCellValue('B'.$i, 'Информация о поставщике');
        $aSheet->getStyle('B'.$i)->applyFromArray($style_header)->applyFromArray($center);
        $aSheet->setCellValue('C'.$i, 'МО');
        $aSheet->getStyle('C'.$i)->applyFromArray($style_header)->applyFromArray($center);
        $aSheet->setCellValue('D'.$i, 'Текущий балл рейтинга по каждому критерию');
        $aSheet->getStyle('D'.$i)->getAlignment()->setWrapText(true);
        $aSheet->getRowDimension($i)->setRowHeight(50);
        $aSheet->mergeCells('D'.$i.':'.self::GetLetter($lastCriteriaCell).$i);
        $aSheet->getStyle('D'.$i)->applyFromArray($style_header)->applyFromArray($center);
        $aSheet->setCellValue(self::GetLetter($lastCriteriaCell + 1).$i, 'Текущий усредненный балл рейтинга по всем критериям');
        $aSheet->getColumnDimension(self::GetLetter($lastCriteriaCell + 1))->setWidth(20);
        $aSheet->getStyle(self::GetLetter($lastCriteriaCell + 1).$i)->getAlignment()->setWrapText(true);
        $aSheet->getStyle(self::GetLetter($lastCriteriaCell + 1).$i)->applyFromArray($style_header)->applyFromArray($center);
        $aSheet->setCellValue(self::GetLetter($lastCriteriaCell + 2).$i, 'Число голосов');
        $aSheet->getColumnDimension(self::GetLetter($lastCriteriaCell + 2))->setWidth(15);
        $aSheet->getStyle(self::GetLetter($lastCriteriaCell + 2).$i)->getAlignment()->setWrapText(true);
        $aSheet->getStyle(self::GetLetter($lastCriteriaCell + 2).$i)->applyFromArray($style_header)->applyFromArray($center);
        $aSheet->mergeCells('A'.$i.':A'.($i+1));
        $aSheet->mergeCells('B'.$i.':B'.($i+1));
        $aSheet->mergeCells('C'.$i.':C'.($i+1));
        $aSheet->mergeCells(self::GetLetter($lastCriteriaCell + 1).$i.':'.self::GetLetter($lastCriteriaCell + 1).($i+1));
        $aSheet->mergeCells(self::GetLetter($lastCriteriaCell + 2).$i.':'.self::GetLetter($lastCriteriaCell + 2).($i+1));
        $i++;
        $aSheet->freezePane('A'.($i+1));
        for ($k = 3; $k <= ($lastCriteriaCell); $k++) {
            $aSheet->setCellValue(self::GetLetter($k).$i, $k - 2);
            $aSheet->getColumnDimension(self::GetLetter($k))->setWidth(5);
            $aSheet->getStyle(self::GetLetter($k).$i)->applyFromArray($style_header)->applyFromArray($center);
        }
        foreach($CurService['PROVIDERS'] as $row => $arCurProvider) {
            $aSheet->setCellValue(self::GetLetter(0).($i+1), $i - $j - 1);
            $arCurProviderNAME = str_replace('&quot;', '"', $arCurProvider['NAME']);
            $aSheet->setCellValue(self::GetLetter(1).($i+1), $arCurProviderNAME);
            $aSheet->setCellValue(self::GetLetter(2).($i+1), $arCurProvider['LOCATION']);
            for ($k = 3; $k <= ($lastCriteriaCell); $k++)
                $aSheet->setCellValue(self::GetLetter($k).($i+1), 'X'); // Оценки по критериям. Пока пустые значения
            $aSheet->setCellValue(self::GetLetter($lastCriteriaCell + 1).($i+1), 'Х'); // Общий балл по критериям
            $aSheet->setCellValue(self::GetLetter($lastCriteriaCell + 2).($i+1), 'Х'); // Число голосов
            $i++;
        }
        $aSheet->setSelectedCell('A1');
        $SheetNum++;
        endforeach;
        $objPHPExcel->setActiveSheetIndex(0);
        self::SaveData($objPHPExcel, 'Excel2007');
    }
    
    private function PDFExport_Form2($arServices) {
    ob_end_clean();
    $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
    // set default header data
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetFont('dejavusanscondensed', '', 11);
    $pdf->AddPage();
    
                 
                foreach ($arServices as $key => $CurService):
                    $html .= $CurService['SERVICE_NAME'].'<br />';
                    $i = 0;
                    $html .= 'Критерии оценки<br />';
                    foreach ($CurService['CRITERIAS'] as $key => $CurCriteria) {
                        $i++;
                        $html .= $i.'. '.$CurCriteria['NAME'].'<br />';
                    }
                    $html .= '<table border="1" width="100%">';
                    $html .= '<thead>';
                        $html .= '<tr>';
                            $html .= '<th width="20" align="center" rowspan="2">№</th>';
                            $html .= '<th width="250" rowspan="2">Информация о поставщике (наименование, контакты)</th>';
                            $html .= '<th width="150" rowspan="2">МО</th>';
                            $html .= '<th width="200" colspan="'.($i).'">Текущий балл рейтинга по каждому критерию</th>';
                            $html .= '<th width="150" rowspan="2">Текущий усредненный балл рейтинга по всем критериям</th>';
                            $html .= '<th width="200" rowspan="2">Число голосов</th>';
                        $html .= '</tr>';
                                                $html .= '<tr>';

                            for ($j = 1; $j <= $i; $j++)
                                $html .= '<th width="20">'.$j.'</th>';

                        $html .= '</tr>';
                    $html .= '</thead>';
                    $html .= '<tbody>';
                    foreach ($CurService['PROVIDERS'] as $key => $CurProvider):
                        $html .= '<tr>';
                            $html .= '<td width="20">'.($key + 1).'</td>';
                            $html .= '<td width="250">'.$CurProvider['NAME'].'</td>';
                            $html .= '<td width="100">'.$CurProvider['LOCATION'].'</td>';
                            for ($j = 1; $j <= $i; $j++)
                                $html .= '<td width="20" align="center">&otimes;</td>';
                            $html .= '<td width="150" align="center">&otimes;</td>';
                            $html .= '<td width="150" align="center">&otimes;</td>';
                        $html .= '</tr>';
                    endforeach;
                    $html .= '</tbody>';
                    $html .= '</table>';
                endforeach;
                 
    $pdf->writeHTML($html, true, false, true, false, '');
    $tmp_filename="report-".date("d-m-y")."_".time().".pdf";
    $pdf->Output($tmp_filename, 'I');

    }
    
    public function Export ($arFilter) {
        switch ($arFilter['FORM']):
            case 1:
            case 2: // Форма по поставщикам 2
                $arServices = CServices::GetServicesParams($arFilter['SERVICES']);
                foreach($arServices as $key => $CurService) {
                    $arProviders = self::get_providers($arFilter['LOCATIONS'], $CurService['SERVICE_ID']);
                    if (!empty($arProviders)) {
                        $arServices[$key]['PROVIDERS'] = $arProviders;
                        $arServices[$key]['CRITERIAS'] = CServices::GetServiceCriterias($CurService['SERVICE_ID']);
                    }   else unset($arServices[$key]);
                }
                if($arServices) {
                    switch ($arFilter['FORMAT']):
                        case 'xlsx': self::ExcelExport_Form2($arServices); break;
                        case 'pdf'; self::PDFExport_Form2($arServices); break;
                    endswitch;
                    
                 } else {
                        $backURL = '/ratings/report/?';
                        foreach ($_GET as $param => $value)
                            if(stripos($param, 'id') !== false)
                                $backURL .= '&'.$param.'='.$value;
                        LocalRedirect($backURL);
                 }
                //echo '<pre>'; print_r($arServices); echo '</pre>';
                break;
        endswitch;
    }
}

?>
