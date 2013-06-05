<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h2>Конфигуратор очтета</h2>
<div class="btn-row2">
    <a href="#" class="submit2" id="config-report-filter"><span><span>Сформировать фильтр</span></span></a>
</div>
<?if (isset($arResult['FILTERED_LOCATIONS'])):?>
    <h3>Выбранные территрии</h3>
    <div class="clearfix"></div>
    <?foreach($arResult['FILTERED_LOCATIONS'] as $elID => $arLocation):?>
        <a href="<?=$arLocation['REMOVE_FILTER_LOCATION_LINK']?>" class="btn-link"><span><?=$arLocation['LOCATION_NAME']?></span></a>
    <?endforeach;?>
<?endif;?>
<?if (isset($arResult['FILTERED_SERVICES'])):?>
    <div class="clearfix"></div>
    <p>&nbsp;</p>
    <h3>Выбранные услуги</h3>
    <div class="clearfix"></div>
    <?foreach($arResult['FILTERED_SERVICES'] as $elID => $arService):?>
        <a href="<?=$arService['REMOVE_FILTER_SERVICE_LINK']?>" class="btn-link"><span><?=$arService['SERVICE_NAME']?></span></a>
    <?endforeach;?>				
<?endif;?> 
