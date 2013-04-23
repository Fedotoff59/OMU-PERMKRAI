<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div style="text-align: left">
<?
if ($arResult['PROVIDER']['FULLNAME'])
    echo '<span style="font-size: 0.9em"><strong>'.$arResult['PROVIDER']['FULLNAME'].'</strong></span><br /><br />';
if ($arResult['PROVIDER']['ADDRESS'])
    echo '<strong>Адрес:</strong><br />'.$arResult['PROVIDER']['ADDRESS'].'<br /><br />';
if ($arResult['PROVIDER']['INN'])
    echo '<strong>ИНН:</strong><br />'.$arResult['PROVIDER']['INN'].'<br /><br />';
if ($arResult['PROVIDER']['CEO'])
    echo '<strong>Руководитель:</strong><br />'.$arResult['PROVIDER']['CEO'].'<br /><br />';
if ($arResult['PROVIDER']['PHONE'])
    echo '<strong>Телефон:</strong><br />'.$arResult['PROVIDER']['PHONE'].'<br /><br />';
if ($arResult['PROVIDER']['FAX'])
    echo '<strong>Факс:</strong><br />'.$arResult['PROVIDER']['FAX'].'<br /><br />';
if ($arResult['PROVIDER']['SITE'])
    echo '<strong>Сайт:</strong><br /><a href="'.$arResult['PROVIDER']['SITE'].'" target="_blank">'.$arResult['PROVIDER']['SITE'].'</a><br /><br />';
if ($arResult['PROVIDER']['EMAIL'])
    echo '<strong>E-mail:</strong><br /><a href="mailto:'.$arResult['PROVIDER']['EMAIL'].'">'.$arResult['PROVIDER']['EMAIL'].'</a><br /><br />';
?>
</div>