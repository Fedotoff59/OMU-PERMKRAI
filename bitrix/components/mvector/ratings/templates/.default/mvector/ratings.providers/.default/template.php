<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h1 id="pagetitle">Рейтинг поставщиков по услуге &laquo;<?=$arResult['SERVICE_NAME']?>&raquo;</h1>
<div class="section">
<div class="btn-row2">
    <ul class="tabset-table tabs">
        <li class="current">Таблица</li>
	<li><a href="#">Диаграмма</a></li>
    </ul>
    <a href="#" class="submit2" id="chose-location-filter"><span><span><em class="icon"></em>Выбор территории</span></span></a>
    <?foreach($arResult['FILTERED_LOCATIONS'] as $elID => $arLocation):?>
    <a href="?<?=$arLocation['REMOVE_FILTER_LINK']?>" class="btn-link"><span><?=$arLocation['LOCATION_NAME']?></span></a>
    <?endforeach;?>
</div>
<div class="table box visible">
    <table class="rating-table" id="Sortable">
        <thead>
            <tr>
                <th class="col1">№</th>
		<th class="col2"><a href="#"><span>Наименование поставщика</span></a></th>
		<th class="col3 active"><a href="#"><span>Муниципальное образование</span></a></th>
		<th><a href="#"><span>Рейтинг</span></a></th>
		<th><a href="#"><span>Число голосов</span></a></th>
            </tr>
	</thead>
        <tbody>
        <?foreach ($arResult['PROVIDERS'] as $key => $arProvider):
            if($key >= $arResult['PAGENAV']['START_NAV'] && $key <= $arResult['PAGENAV']['END_NAV']):?>
    <tr>
        <td class="col1"><?=($key + 1);?></td>
        <td class="col2"><a href="<?=$arProvider['PROVIDER_LINK']?>"><?=$arProvider['NAME'];?></a></td>
        <td class="col3"><?=$arProvider['LOCATION'];?></td>
        <td class="number-col"><?=$arProvider['AVERAGE_PERCENT_RATING'];?></td>
        <td class="number-col"><?=$arProvider['VOTES_AMOUNT'];?></td>
    </tr>
        <?endif; endforeach;?>
    </tbody>
</table>
</div>
<!-- graphic-hold -->
    <div class="graphic-hold box">
        <div class="head">
            <p>0%</p>
            <p>10%</p>
            <p>20%</p>
            <p>30%</p>
            <p>40%</p>
            <p>50%</p>
	</div>
    <ul>
                <?foreach ($arResult['PROVIDERS'] as $key => $arProvider):
            if($key >= $arResult['PAGENAV']['START_NAV'] && $key <= $arResult['PAGENAV']['END_NAV']):?>
        <li class="color1">
            <div class="text">
                <p><?=$arProvider['LOCATION'];?></p>
		<p><a href="<?=$arProvider['PROVIDER_LINK']?>"><?=$arProvider['NAME'];?></a></p>
            </div>
            <div class="line" style="width:0px;"></div>
            <strong class="percent"><?=$arProvider['AVERAGE_PERCENT_RATING'];?></strong>
	</li>
        <?endif; endforeach;?>
   </ul>
 </div>
</div>
<?  if ($arResult['PAGENAV']['END_PAGE'] > 1) { ?>
    <div class="paging">
        <ul class="l">
            <?if ($arResult['PAGENAV']['ACTIVE_PAGE'] == 1) {?>
                <li><?=TEXT_PREV_PAGE?></li>
            <?} else {?>
                <li><a href="?<?=$arResult['FILTER_LINK']?>&page=<?=$arResult['PAGENAV']['ACTIVE_PAGE'] - 1?>"><?=TEXT_PREV_PAGE?></a></li>
            <?}     ?>
            <?if ($arResult['PAGENAV']['ACTIVE_PAGE'] == $arResult['PAGENAV']['TOTALPAGES']) {?>
                <li><?=TEXT_NEXT_PAGE?></li>
            <?} else {?>
                <li><a href="?<?=$arResult['FILTER_LINK']?>&page=<?=$arResult['PAGENAV']['ACTIVE_PAGE'] + 1?>"><?=TEXT_NEXT_PAGE?></a></li>
            <?}     ?>
	</ul>
	<ul class="paging-list">
            <?if ($arResult['PAGENAV']['ARROW_PREV']) {?>
                <li><a class="more" href="?<?=$arResult['FILTER_LINK']?>&page=<?=$arResult['PAGENAV']['START_PAGE'] - 1?>">back</a></li>
            <?  }?>
            <?for($i = $arResult['PAGENAV']['START_PAGE']; $i <= $arResult['PAGENAV']['END_PAGE']; $i++) {?>
                <?if ($i == $arResult['PAGENAV']['ACTIVE_PAGE']) {?>
                    <li><a class="active" href="?<?=$arResult['FILTER_LINK']?>&page=<?=$i?>"><?=$i?></a></li>
                <?} else {?>
                    <li><a href="?<?=$arResult['FILTER_LINK']?>&page=<?=$i?>"><?=$i?></a></li>
                <?}     ?>
            <?}     ?>
            <?if ($arResult['PAGENAV']['ARROW_NEXT']) {?>
                <li><a class="more" href="?<?=$arResult['FILTER_LINK']?>&page=<?=$arResult['PAGENAV']['END_PAGE'] + 1?>">back</a></li>
            <?  }?>      
	</ul>
    </div>
    <?  }   ?>
<div class="doc-hold" style="float:right;">
    <div class="doc-box" style="float:left;">
        <strong class="title"><img src="<?=SITE_TEMPLATE_PATH?>/images/icon27.gif" alt="" /> <a href="<?=$arResult['PDF_REPORT_LINK']['FORM_2']?>">Загрузить отчет</a> <span>(pdf)</span></strong>
    </div>
    <div class="doc-box" style="float:left; margin-left: 15px; margin-right: 15px;">
        <strong class="title"><img src="<?=SITE_TEMPLATE_PATH?>/images/icon41.gif" alt="" /> <a href="<?=$arResult['EXCEL_REPORT_LINK']['FORM_2']?>">Загрузить отчет</a> <span>(xlsx)</span></strong>
    </div>
    <div class="btn-row2" style="float:left; margin-right: 15px;">
        <a href="#" class="submit2" id="print"><span><span>Распечатать</span></span></a>
    </div>
    <div class="btn-row2">
        <a href="/ratings/serviceslist/<?=$arParams['SERVICE_ID']?>/providers/?<?=$arResult['FILTER_LINK']?>" class="submit2"><span><span>Подписаться на рассылку</span></span></a>
    </div>
</div>
