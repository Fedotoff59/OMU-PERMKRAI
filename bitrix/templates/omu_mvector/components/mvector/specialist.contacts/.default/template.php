<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult['FULL_NAME'] != '' || $arResult['WORK_PHONE'] !='' || $arResult['EMAIL'] != ''):?>
<div class="drop">
    <?if ($arResult['FULL_NAME'] != ''):?>
        <p><strong><?=$arResult['FULL_NAME']?></strong></p>
    <?endif;?>
    <?if ($arResult['WORK_PHONE'] != ''):?>
        <strong>Контактный телефон</strong>
        <p><?=$arResult['WORK_PHONE']?></p>
    <?endif;?>
    <?if ($arResult['EMAIL'] != ''):?>
        <strong class="email">E-mail:</strong>
        <p><a href="mailto:<?=$arResult['EMAIL']?>"><?=$arResult['EMAIL']?></a></p>
    <?endif;?>
    <span class="arrow"></span>
</div>
<?endif;?>