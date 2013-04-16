<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div id="form-criterias" style="width: 75%">
    <?$APPLICATION->IncludeComponent("mvector:services.form.criterias","",Array(
                    "SERVICE_ID" => $arParams['SERVICE_ID'],
                    "CRITERIAS_FORM_ID" => $arResult['CRITERIAS_FORM_ID'],
                    "LOCATION_ID" => $arParams['LOCATION_ID'],
                    "LOCATION_NAME" => $arParams['LOCATION_NAME']
                )
        );?>
</div>

  
<?

//echo '<strong>Форма оценки услуги:</strong> <br />';
//echo '<strong>Массив результатов</strong>';
//echo '<pre>'; echo print_r($arParams); echo '</pre>';
//echo '<pre>'; echo print_r($arResult); echo '</pre>';
?>

