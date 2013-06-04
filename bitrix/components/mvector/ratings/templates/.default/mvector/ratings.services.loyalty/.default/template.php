<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="content">
    <h1>Услуга &laquo;<?=$arResult['SERVICE_NAME']?>&raquo; - удовлетворенность в муниципальных образованиях</h1>
    <?if($arResult['SERVICE_HAS_PROVISORS']):?>
        <div class="btn-row2 btn-row2-r">
            <a href="/ratings/serviceslist/<?=$arParams['SERVICE_ID']?>/providers/?<?=$arResult['FILTER_LINK']?>" class="submit2"><span><span>Перейти к поставщикам</span></span></a>
        </div>
    <?endif;?>
    <div class="section">
    <div class="btn-row2">
        <ul class="tabset-table tabs">
            <li class="current">Таблица</li>
            <li><a href="#">Диаграмма</a></li>
        </ul>
    </div>
    <?if($arResult['SERVICE_HAS_PROVISORS']):?>
    <div class="clearfix"></div>
    <?endif;?>
    <div class="table box visible">
        <table class="rating-table" id="Sortable">
            <thead>
                <tr>
                    <th class="col1">№</th>
                    <th class="col2 active"><a href="#"><span>Муниципальное образование</span></a></th>
                    <th class="num-title col3"><a href="#"><span>Удовлетворенность<br /> услугой</span></a></th>
                    <th class="num-title"><a href="#"><span>Число голосов</span></a></th>
		</tr>
            </thead>
            <tbody>
            <?foreach ($arResult['SERVICE_LOYALTY'] as $key => $arLoyalty):?>
                <tr>
                    <td class="col1"><?=($key + 1);?></td>
                    <td class="col2"><?=$arLoyalty['LOCATION_NAME'];?></td>
                    <td class="number-col col3">
                        <a href="<?=$arLoyalty['FORM_VALUES_LINK'];?>">
                            <?=$arLoyalty['AVERAGE_PERCENT_RATING'];?>
                        </a>
                    </td>
                    <td class="number-col"><?=$arLoyalty['VOTES_AMOUNT'];?></td>
                </tr>
            <?endforeach;?>
           </tbody>
        </table>
        </div>
        <div class="graphic-hold graphic-hold2 box">
            <div class="head">
                <p>0%</p>
                <p>25%</p>
                <p>50%</p>
                <p>75%</p>
                <p>100%</p>
            </div>
            <ul>
                <?foreach ($arResult['SERVICE_LOYALTY'] as $key => $arLoyalty):?>
                <li class="color1">
                    <div class="text">
                        <p><?=$arLoyalty['LOCATION_NAME'];?></p>
                    </div>
                    <div class="line" style="width:0px;"></div>
                    <strong class="percent"><?=$arLoyalty['AVERAGE_PERCENT_RATING'];?> %</strong>
		</li>
                <?endforeach;?>
            </ul>
        </div>
    </div>
    <p>&nbsp;</p>
    <ul class="rating-box"> 
	<li>
            <div class="img">
                <div>
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/bg-icon02.png" alt="" />
                </div>
            </div>
            <h3><a href="/ratings/locations/">Рейтинг муниципальных образований</a></h3>
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