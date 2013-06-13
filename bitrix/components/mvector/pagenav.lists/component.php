<?
if (isset($arParams['PAGENAV']['END_PAGE']) && ($arParams['PAGENAV']['END_PAGE'] > 1)) {                
    $arResult = $arParams['PAGENAV'];
    $this->IncludeComponentTemplate();
}
?>