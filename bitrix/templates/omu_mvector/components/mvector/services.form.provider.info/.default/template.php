<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if ($arResult['PROVIDER']['FULLNAME']) {    ?>
    <h3><?=$arResult['PROVIDER']['FULLNAME']?></h3>
<?  }   ?>
<? if ($arResult['PROVIDER']['ADDRESS']) {    ?>
    <strong>Адрес:</strong><p><?=$arResult['PROVIDER']['ADDRESS']?></p>
<?  }   ?>    
<? if ($arResult['PROVIDER']['INN']) {    ?>
    <strong>ИНН:</strong><p><?=$arResult['PROVIDER']['INN']?></p>
<?  }   ?>
<? if ($arResult['PROVIDER']['CEO']) {    ?>
    <strong>Руководитель:</strong><p><?=$arResult['PROVIDER']['CEO']?></p>
<?  }   ?>
<? if ($arResult['PROVIDER']['PHONE']) {    ?>
    <strong>Телефон:</strong><p><?=$arResult['PROVIDER']['PHONE']?></p>
<?  }   ?>
<? if ($arResult['PROVIDER']['FAX']) {    ?>
    <strong>Факс:</strong><p><?=$arResult['PROVIDER']['FAX']?></p>
<?  }   ?>
<? if ($arResult['PROVIDER']['EMAIL']) {    ?>
    <strong>E-mail:</strong><p><a href="mailto:<?=$arResult['PROVIDER']['EMAIL']?>"><?=$arResult['PROVIDER']['EMAIL']?></a></p>
<?  }   ?>
<? if ($arResult['PROVIDER']['SITE']) {    ?>
    <strong>Сайт:</strong><p><a href="<?=$arResult['PROVIDER']['SITE']?>" target="_blank"><?=$arResult['PROVIDER']['SITE']?></a></p>
<?  }   ?>

