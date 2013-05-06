<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!-- content -->
<div id="content">
    <h1>Выбор поставщика услуг</h1>
    <div class="btn-row2">
        <a href="#" class="submit2" id="chose-service-link"><span><span>Выбор услуги</span></span></a>
	<span class="choose"><?=$arResult['SERVICE_NAME']?></span>
    </div>
    <ul class="address-list">
        <?
        for($i=0; $i < intval($arResult['COUNT_PROVIDERS']); $i++) 
        {   
        ?>
        <li>
            <h4><a href="/services/<?=$arResult['SERVICE_ID'];?>/providers/<?=$arResult['LOCATION_ALIAS'];?>/<?=$arResult['PROVIDERS'][$i]['ID'];?>/"><?=$arResult['PROVIDERS'][$i]['NAME'];?></a></h4>
            <p><?=$arResult['PROVIDERS'][$i]['PROPERTY_ADDRESS_VALUE'];?></p>
	</li>
        <?
        } 
        ?>
    </ul>
    <div class="paging">
        <ul class="l">
            <li>Предыдущая страница</li>
            <li><a href="#">Следующая страница</a></li>
	</ul>
	<ul class="paging-list">
            <li><a class="active" href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">6</a></li>
            <li><a class="more" href="#">more</a></li>
	</ul>
    </div>
</div>
<!-- sidebar-right -->
<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>