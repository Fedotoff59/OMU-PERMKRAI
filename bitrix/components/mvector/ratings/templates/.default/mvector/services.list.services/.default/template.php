<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="content">
<h1>Рейтинг поставщиков - выбор услуги</h1>
<p>
    Выберите, пожалуйста, услугу для формирования таблицы рейтинга поставщиков,
    оказывающих данную услугу.
</p>
<ul class="services">
<?
    $i = 0;
    foreach($arResult['SERVICES'] as $sID => $arSectionData)
    {
        $i++;
?>
    <li class="item<?=$i?>"><a href="#"><?=$arSectionData['SECTION_NAME'];?></a>
          <div class="drop">  
            <ul>
                <?
                foreach($arSectionData['ELEMENTS'] as $elID => $elName)
                    {
                ?>
                        <li><a href="<?=$elID;?>/"><?=$elName;?></a></li>
                <?  }   ?>
            </ul>
            <span class="arrow"></span>
          </div>
    </li>
<?  } ?>
    
</ul>
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
<div id="sidebar">                       
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>
</div>    

