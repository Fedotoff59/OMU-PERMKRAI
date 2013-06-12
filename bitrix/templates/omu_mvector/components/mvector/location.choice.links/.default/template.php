<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="select">
    <a href="#chose-location-form" id="chose-location-link">
        <?=$arResult['LOCATION_NAME']?>
    </a>
</div>
<div class="clearfix" style="clear:both"></div>
<div class="link">
    <a href="/links/materials/sitemap.php" class="sitemap">sitemap</a>
        <ul>
            <li>
                <a href="#">Контакты специалиста</a>
                <?if ($arResult['SPECIALIST']['FULL_NAME'] != '' || $arResult['SPECIALIST']['WORK_PHONE'] !='' || $arResult['SPECIALIST']['EMAIL'] != ''):?>
                <div class="drop">
                    <?if ($arResult['SPECIALIST']['FULL_NAME'] != ''):?>
                        <strong><?=$arResult['SPECIALIST']['FULL_NAME']?></strong>
                    <?endif;?>
                    <?if ($arResult['SPECIALIST']['WORK_PHONE'] != ''):?>
                        <p>&nbsp;</p>
                        <strong>Контактный телефон</strong>
                        <p><?=$arResult['SPECIALIST']['WORK_PHONE']?></p>
                    <?endif;?>
                    <?if ($arResult['SPECIALIST']['EMAIL'] != ''):?>
                        <strong class="email">E-mail:</strong>
                        <p><a href="mailto:<?=$arResult['SPECIALIST']['EMAIL']?>"><?=$arResult['SPECIALIST']['EMAIL']?></a></p>
                    <?endif;?>
                    <span class="arrow"></span>
                </div>
                <?endif;?>
            </li>
            <li><a href="<?=$arResult['LOCATION_LINK']?>" target="_blank">Информация о МО</a></li>
       </ul>
</div>