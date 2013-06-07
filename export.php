<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
foreach($_GET as $key => $value) {
    $k = explode('_', $key);
    $param = $k[0];
    if ($param == 'lid') {
        $arFilter['LOCATIONS'][] = $value;
    }
    if ($param == 'sid') {
        $arFilter['SERVICES'][] = $value;
    }
    if ($key == 'form')
        $arFilter['FORM'] = $value;
    if ($key == 'format')
        $arFilter['FORMAT'] = $value;
}
?>
<?if ($arFilter['FORMAT'] == 'print'):?>
<script type="text/javascript">
    window.onload = function(){
        window.print();
        setTimeout('window.close()', 1000);
    }
</script>
<?endif;?>
<?CDataExport::Export($arFilter);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>