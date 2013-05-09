<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!-- content -->
<div id="content">
    <h1>Выбор поставщика услуг</h1>
    <div class="btn-row2">
        <a href="#" class="submit2" id="chose-service-link"><span><span>Выбор услуги</span></span></a>
	<span class="choose"><?=$arResult['SERVICE_NAME']?></span>
    </div>
    <ul class="<?=$arResult['PAGENAV']['UL_CLASS']?>">
        <?
        for($i = $arResult['PAGENAV']['START_NAV']; $i <= $arResult['PAGENAV']['END_NAV']; $i++) 
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
    <?  if ($arResult['PAGENAV']['END_PAGE'] > 1) { ?>
    <div class="paging">
        <ul class="l">
            <?if ($arResult['PAGENAV']['ACTIVE_PAGE'] == 1) {?>
                <li><?=TEXT_PREV_PAGE?></li>
            <?} else {?>
                <li><a href="?page=<?=$arResult['PAGENAV']['ACTIVE_PAGE'] - 1?>"><?=TEXT_PREV_PAGE?></a></li>
            <?}     ?>
            <?if ($arResult['PAGENAV']['ACTIVE_PAGE'] == $arResult['PAGENAV']['TOTALPAGES']) {?>
                <li><?=TEXT_NEXT_PAGE?></li>
            <?} else {?>
                <li><a href="?page=<?=$arResult['PAGENAV']['ACTIVE_PAGE'] + 1?>"><?=TEXT_NEXT_PAGE?></a></li>
            <?}     ?>
	</ul>
	<ul class="paging-list">
            <?if ($arResult['PAGENAV']['ARROW_PREV']) {?>
                <li><a class="more" href="?page=<?=$arResult['PAGENAV']['START_PAGE'] - 1?>">back</a></li>
            <?  }?>
            <?for($i = $arResult['PAGENAV']['START_PAGE']; $i <= $arResult['PAGENAV']['END_PAGE']; $i++) {?>
                <?if ($i == $arResult['PAGENAV']['ACTIVE_PAGE']) {?>
                    <li><a class="active" href="?page=<?=$i?>"><?=$i?></a></li>
                <?} else {?>
                    <li><a href="?page=<?=$i?>"><?=$i?></a></li>
                <?}     ?>
            <?}     ?>
            <?if ($arResult['PAGENAV']['ARROW_NEXT']) {?>
                <li><a class="more" href="?page=<?=$arResult['PAGENAV']['END_PAGE'] + 1?>">back</a></li>
            <?  }?>      
	</ul>
    </div>
    <?  }   ?>
</div>
<!-- sidebar-right -->
<?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>