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
    <div class="about-box">
        <!-- Показываем рейтинг поставщика и удовлетворенность услугой -->
        <div class="info">
            <?$APPLICATION->IncludeComponent("mvector:services.form.service.results","rating", Array(
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
    <!-- Показываем случайный комментарий -->
    <!--<div class="quote-box">
        <blockquote>
            <q>Всегда отличная работа! Приятно посмотреть на то, что делают наши дружинники для того, чтобы мы могли гулять по вечерам и не боялись за </q>
            <cite>— Валерий Овчинников</cite>
        </blockquote>
        <div class="text">
            <span class="icon"></span>
            <p>Деятельность добровольных формирований по охране общественного порядка</p>
        </div>
    </div>-->
    <!-- Баннер карты -->
    <div class="map-banner">
        <a href="#">
            <img src="<?=SITE_TEMPLATE_PATH?>/images/banner-map.gif" alt="" />
            <span>Карта удовлетворённости услугами</span>
	</a>
    </div>
    <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>
</div>