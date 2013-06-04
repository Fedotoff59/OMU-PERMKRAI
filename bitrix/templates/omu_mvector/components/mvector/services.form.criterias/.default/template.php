<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<h1><? echo $arResult['SERVICE_FULL_NAME']; ?></h1>
<div class="title-row">
<?$APPLICATION->IncludeComponent("bitrix:main.calendar","",Array(
                                            "SHOW_INPUT" => "Y",
                                            "FORM_NAME" => "values_iblock_add",
                                            "INPUT_NAME" => "service_date",
                                            "INPUT_VALUE" => date("d.m.Y"),
                                            "SHOW_TIME" => "N",
                                            "HIDE_TIMEBAR" => "Y",
                                            "INPUT_ADDITIONAL_ATTR" => "placeholder='дд.мм.гггг'"
                                            )
                );?>
<a href="http://gosuslugi.permkrai.ru/" class="link" target="_blank">Об услуге</a>
</div>

<form id="<?=CRITERIAS_FORM_ID?>" action="javascript:void()" method="post" enctype="multipart/form-data">
    <?=bitrix_sessid_post()?>
    <input type="hidden"
           name="service_id"
           value="<?=$arParams['SERVICE_ID'];?>">
   <input type="hidden"
           name="provider_id"
           value="<?=$arParams['PROVIDER_ID'];?>">
    <input type="hidden"
           name="service_name"
           value="<?=$arResult['SERVICE_NAME'];?>">
    <input type="hidden"
           name="location_id"
           value="<?=$arParams['LOCATION_ID'];?>">
    <input type="hidden"
           name="location_name"
           value="<?=$arParams['LOCATION_NAME'];?>">
    <input type="hidden" 
           name="count_values" 
           value="<?=count($arResult['CRITERIAS']); // сохраняем в форме число критериев?>">
    <div class="rating-hold">
  <?
/*
 * Запускам цикл по выводу нужного количества критериев с оценками и ползунками
 */
    $i=0;
    if ($arResult['CRITERIAS'])
        {
            foreach($arResult['CRITERIAS'] as $elID => $elName) // Вывод критериев оценки
                {
                    $i++;
?>  
        <div class="rating-row">
            <div class="box">
                <p>Оценка: <strong>неплохо</strong></p>
		<span class="amount"></span>
                <input type="hidden" name="criteria_<?=$i?>" value="<?=$elName['ID']?>"/>    
                <input type="text" class="val_keeper" name="eval_<?=$i?>" value="3" />
                    <div class="slider"></div>
                    <ul>
                        <li class="first">1</li>
			<li class="second">2</li>
			<li class="third">3</li>
			<li class="fourth">4</li>
			<li class="last">5</li>
                    </ul>
            </div>
            <p><?=$elName['NAME']?></p>
        </div>
 <?
                } // end foreach
        }  // end if     
 ?> 
    </div>
</form>