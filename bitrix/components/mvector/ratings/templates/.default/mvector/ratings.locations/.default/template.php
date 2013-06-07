<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="content">
    <h1>Рейтинг муниципальных образований</h1>
        <div style="float:right;">
    <div class="btn-row2" style="float:left; margin-right: 15px;">
        <a href="#" onclick="window.open('/export.php?format=print&form=1');return(false)" class="submit2" id="print"><span><span>Распечатать</span></span></a>
    </div>
    <div class="btn-row2">
        <a href="javascript:void(0)" id="subscribe" class="submit2"><span><span>Подписаться на рассылку</span></span></a>
    </div>
        
</div>
    <div class="section">
    <div class="btn-row2">
        <ul class="tabset-table tabs">
            <li class="current">Таблица</li>
            <li><a href="#">Диаграмма</a></li>
        </ul>
    </div>
    <div class="table box visible">
        <table class="rating-table" id="Sortable">
            <thead>
                <tr>
                    <th class="col1">№</th>
                    <th class="col2 active"><a href="#"><span>Муниципальное образование</span></a></th>
                    <th class="num-title col3"><a href="#"><span>Удовлетворенность<br /> услугами</span></a></th>
                    <th class="num-title"><a href="#"><span>Число голосов</span></a></th>
		</tr>
            </thead>
            <tbody>
            <?foreach ($arResult as $key => $arLocations):?>
                <tr>
                    <td class="col1"><?=($key + 1);?></td>
                    <td class="col2"><?=$arLocations['LOCATION_NAME'];?></td>
                    <td class="number-col col3"><?=$arLocations['AVERAGE_PERCENT_RATING'];?></td>
                    <td class="number-col"><?=$arLocations['VOTES_AMOUNT'];?></td>
                </tr>
            <?endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="box">
        <div class="graphic-hold graphic-hold2">
            <div class="head">
                <p>0%</p>
                <p>25%</p>
                <p>50%</p>
                <p>75%</p>
                <p>100%</p>
            </div>
            <ul>
                <?foreach ($arResult as $key => $arLocations):?>
                <li class="color1">
                    <div class="text">
                        <p><?=$arLocations['LOCATION_NAME'];?></p>
                    </div>
                    <div class="line" style="width:0px;"></div>
                    <strong class="percent"><?=$arLocations['AVERAGE_PERCENT_RATING'];?> %</strong>
		</li>
                <?endforeach;?>
            </ul>
        </div>
    </div>
    </div>

        <div class="doc-hold" style="float:right;">
    <div class="doc-box" style="float:left;">
        <strong class="title"><img src="<?=SITE_TEMPLATE_PATH?>/images/icon27.gif" alt="" /> <a href="/export.php?format=pdf&form=1">Загрузить отчет</a> <span>(pdf)</span></strong>
    </div>
    <div class="doc-box" style="float:left; margin-left: 15px; margin-right: 15px;">
        <strong class="title"><img src="<?=SITE_TEMPLATE_PATH?>/images/icon41.gif" alt="" /> <a href="/export.php?format=xlsx&form=1">Загрузить отчет</a> <span>(xlsx)</span></strong>
    </div>
        </div>
    <p>&nbsp;</p>
    <ul class="rating-box">
        <li>
            <div class="img">
                <div>
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/bg-icon04.png" alt="" />
                </div>
            </div>
            <h3><a href="/ratings/serviceslist/">Рейтинг поставщиков</a></h3>
	</li>
	<li>
            <div class="img">
                <div>
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/bg-icon03.png" alt="" />
		</div>
            </div>
            <h3><a href="/ratings/report/">Отчёты</a></h3>
	</li>
    </ul>
</div>
<!-- sidebar-right -->
<div id="sidebar">
 <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>
</div>