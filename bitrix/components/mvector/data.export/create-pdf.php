<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    // set default header data
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetFont('dejavusanscondensed', '', 12);
    $pdf->AddPage();
    $html ='Привет мир!';
    $pdf->writeHTML($html, true, false, true, false, '');
    $tmp_filename="report-".date("d-m-y")."_".time().".pdf";
    $pdf->Output($tmp_filename, 'I');
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>