<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!-- content -->
<div id="content">
    <!-- Вывод блока под формой критериев оценки -->
    <?$APPLICATION->IncludeComponent("mvector:services.form.criterias","",Array(
                    "SERVICE_ID" => $arParams['SERVICE_ID'],
                    "PROVIDER_ID" => $arParams['PROVIDER_ID'],
                    "LOCATION_ID" => $arParams['LOCATION_ID'],
                    "LOCATION_NAME" => $arParams['LOCATION_NAME']
                )
    );?>
    <!-- Показываем блок кнопки оценки -->
    <?$APPLICATION->IncludeComponent("mvector:services.form.submit","", Array(
                            "LOCATION_ID" => $arParams['LOCATION_ID'],
                            "SERVICE_ID" => $arParams['SERVICE_ID'],
                            "PROVIDER_ID" => $arParams['PROVIDER_ID']
                          )
    );?>
    <!-- Вывод формы комментариев -->
    <?$APPLICATION->IncludeComponent("mvector:services.form.comments","", Array(
                "LOCATION_ID" => $arParams['LOCATION_ID'],
                "SERVICE_ID" => $arParams['SERVICE_ID'],
                "PROVIDER_ID" => $arParams['PROVIDER_ID']
                )
    );?>		
</div>
<div id="sidebar">
    <!-- Показываем информацию о поставщике -->
    <div class="about-box">
        <?$APPLICATION->IncludeComponent("mvector:services.form.provider.info","",Array(
                    "PROVIDER_ID" => $arParams['PROVIDER_ID'],
                )
        );?>
        <!-- Показываем рейтинг поставщика и удовлетворенность услугой -->
        <div class="info">
            <?$APPLICATION->IncludeComponent("mvector:services.form.provider.rating","realtime", Array(
                            "LOCATION_ID" => $arParams['LOCATION_ID'],
                            "SERVICE_ID" => $arParams['SERVICE_ID'],
                            "PROVIDER_ID" => $arParams['PROVIDER_ID']
                      )
            );?>  
            <?$APPLICATION->IncludeComponent("mvector:services.form.service.results","loyalty", Array(
                            "LOCATION_ID" => $arParams['LOCATION_ID'],
                            "SERVICE_ID" => $arParams['SERVICE_ID']
                      )
            );?>   
	</div>
    </div>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>
</div>