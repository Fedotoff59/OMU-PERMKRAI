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
    
}

?>
