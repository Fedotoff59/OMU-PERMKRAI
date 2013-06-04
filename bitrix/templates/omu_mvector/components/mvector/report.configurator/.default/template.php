<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h2>Конфигуратор очтета</h2>
<div class="btn-row2">
    <a href="#" class="submit2" id="chose-location-filter"><span><span>Выбор территории</span></span></a>
    <?foreach($arResult['FILTERED_LOCATIONS'] as $elID => $arLocation):?>
        <a href="<?=$arLocation['REMOVE_FILTER_LOCATION_LINK']?>" class="btn-link"><span><?=$arLocation['LOCATION_NAME']?></span></a>
    <?endforeach;?>
</div>
<div class="btn-row2">
    <a href="#" class="submit2"><span><span>Выбор услуги</span></span></a>
    <?foreach($arResult['FILTERED_SERVICES'] as $elID => $arService):?>
        <a href="<?=$arService['REMOVE_FILTER_SERVICE_LINK']?>" class="btn-link"><span><?=$arService['SERVICE_NAME']?></span></a>
    <?endforeach;?>				
</div> 
