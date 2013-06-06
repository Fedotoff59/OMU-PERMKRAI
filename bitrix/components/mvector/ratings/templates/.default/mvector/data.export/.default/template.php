<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="content">
<?if (isset($arResult['EXPORT'])):?>
    <h1><?=$arResult['EXPORT']['HEADER']?></h1>
    <strong class="not-found"><?=$arResult['EXPORT']['TEXT']?></strong>
<?endif;?>
</div>
<!-- sidebar-right -->
<div id="sidebar">
 <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>
</div>