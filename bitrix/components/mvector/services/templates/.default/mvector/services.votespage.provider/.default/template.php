<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!-- content -->
<div id="content">

<?$APPLICATION->IncludeComponent("mvector:services.form.criterias","",Array(
                    "SERVICE_ID" => $arParams['SERVICE_ID'],
                    "PROVIDER_ID" => $arParams['PROVIDER_ID'],
                    "LOCATION_ID" => $arParams['LOCATION_ID'],
                    "LOCATION_NAME" => $arParams['LOCATION_NAME']
                )
);?>



<!-- Вывод блока под формой критериев оценки -->
<table width="73%" border="0">
    <tr>
        <td valign="top" width="200">   <!-- Показываем рейтинг услуги -->
            <?$APPLICATION->IncludeComponent("mvector:services.form.provider.rating","realtime", Array(
                            "LOCATION_ID" => $arParams['LOCATION_ID'],
                            "SERVICE_ID" => $arParams['SERVICE_ID'],
                            "PROVIDER_ID" => $arParams['PROVIDER_ID']
                      )
            );?>  
        </td>
        <td valign="top" width="200">  <!-- Показываем удовлетворенность услугой -->
            <?$APPLICATION->IncludeComponent("mvector:services.form.service.results","loyalty", Array(
                            "LOCATION_ID" => $arParams['LOCATION_ID'],
                            "SERVICE_ID" => $arParams['SERVICE_ID']
                      )
            );?>            
        </td>
        <td valign="top">              <!-- Показываем блок кнопки оценки -->
            <?$APPLICATION->IncludeComponent("mvector:services.form.submit","realtime", Array(
                            "LOCATION_ID" => $arParams['LOCATION_ID'],
                            "SERVICE_ID" => $arParams['SERVICE_ID'],
                            "PROVIDER_ID" => $arParams['PROVIDER_ID']
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
                "PROVIDER_ID" => $arParams['PROVIDER_ID']
                )
    );?>
</div>
<?$APPLICATION->IncludeComponent("mvector:services.form.provider.info","",Array(
                    "PROVIDER_ID" => $arParams['PROVIDER_ID'],
                )
);?>
</div>