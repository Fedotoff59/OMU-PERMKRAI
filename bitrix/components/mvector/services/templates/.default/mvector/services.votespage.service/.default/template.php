<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div style="float: right; background-color: #ccc; width: 20%; min-height: 550px; margin-top: 15px; text-align: center; padding-top: 15px;">
    Правая колонка
</div>
<!-- Вывод формы критериев оценки -->
<div id="form-criterias" style="width: 75%">
    <?$APPLICATION->IncludeComponent("mvector:services.form.criterias","",Array(
                    "SERVICE_ID" => $arParams['SERVICE_ID'],
                    "PROVIDER_ID" => $arParams['PROVIDER_ID'], // 0
                    "CRITERIAS_FORM_ID" => $arResult['CRITERIAS_FORM_ID'],
                    "LOCATION_ID" => $arParams['LOCATION_ID'],
                    "LOCATION_NAME" => $arParams['LOCATION_NAME']
                )
        );?>
</div>

<!-- Вывод блока под формой критериев оценки -->
<table width="73%" border="0">
    <tr>
        <td valign="top" width="200">   <!-- Показываем рейтинг услуги -->
            <?$APPLICATION->IncludeComponent("mvector:services.form.service.results","rating", Array(
                            "CURRENT_LOCATION_ID" => $arParams['LOCATION_ID'],
                            "CURRENT_SERVICE_ID" => $arParams['SERVICE_ID']
                       )
            );?>
        </td>
        <td valign="top" width="200">  <!-- Показываем удовлетворенность услугой -->
            <?$APPLICATION->IncludeComponent("mvector:services.form.service.results","loyalty", Array(
                            "CURRENT_LOCATION_ID" => $arParams['LOCATION_ID'],
                            "CURRENT_SERVICE_ID" => $arParams['SERVICE_ID']
                      )
            );?>            
        </td>
        <td valign="top">              <!-- Показываем блок кнопки оценки -->
            <?$APPLICATION->IncludeComponent("mvector:services.form.submit","realtime", Array(
                            "LOCATION_ID" => $arParams['LOCATION_ID'],
                            "SERVICE_ID" => $arParams['SERVICE_ID']
                          )
            );?>
        </td>
    </tr>
</table>

<!-- Вывод формы комментариев -->
<div id="comments-view" style="width: 80%">
    <?$APPLICATION->IncludeComponent("mvector:services.form.comments","amountform", Array(
                "LOCATION_ID" => $arParams['LOCATION_ID'],
                "SERVICE_ID" => $arParams['SERVICE_ID'],
                "PROVIDER_ID" => $arParams['PROVIDER_ID'] // 0
                )
            );?>
</div>