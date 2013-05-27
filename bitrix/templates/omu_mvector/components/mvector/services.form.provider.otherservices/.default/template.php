<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(isset($arResult['OTHER_SERVICE'])):?>
    <div class="other-services">
        <h2>Другие услуги поставщика</h2>
        <?foreach($arResult['OTHER_SERVICE'] as $number => $arServiceParams):?>
            <p><a href="<?=$arServiceParams['LINK']?>"><?=$arServiceParams['NAME']?></a></p>
        <?endforeach;?>
    </div>
<?endif;?>
