<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!-- content -->
<div id="content">
    <h1>Поставщики услуг в направлении «<?=$arResult['SECTION_NAME']?>»</h1>
    <ul class="<?=$arResult['PAGENAV']['UL_CLASS']?>">
        <?foreach($arResult['PROVIDERS'] as $ProvID => $curProvider):?>   
        <li>
            <h4><?=$curProvider['NAME'];?></h4>
            <p>Оценить услуги поставщика:
                <?foreach ($curProvider['PROVIDER_FORM_URLS'] as $Sid => $ServiceURL):?>
                    <br /><a href="<?=$ServiceURL?>"><?=$curProvider['PROVIDER_SERVICE_NAMES'][$Sid]?></a>    
                <?endforeach;?>
            </p>
	</li>
        <?endforeach?>
    </ul>
    <?$APPLICATION->IncludeComponent(
        "mvector:pagenav.lists",
	"",
	Array("PAGENAV" => $arResult['PAGENAV'])
    );?>
</div>
<!-- sidebar-right -->
<div id="sidebar">
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>
</div>