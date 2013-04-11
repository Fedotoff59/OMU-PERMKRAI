<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
    //echo '<strong>Работает внутренний шаблон вывода формы оценки услуг:</strong>';
    echo '<h2>'.$arResult['SERVICE_FULLNAME'].'</h2>';
?>

<form name="values_iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
<?=bitrix_sessid_post()?>
    
<table width="100%" border="0">
    <tr>
        <td>Ссылка на регламент</td>
        <td width="365" height="40">
            <!-- Календарь -->
            <div style="float: left; margin-top: 5px; margin-right: 10px;">Дата предоставления услуги: </div>
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
        </td>
    </tr>
</table>

<table width="98%" border="0" cellpadding="0">
   <tr>
   <td width="100%" valign="top"> <!--  Критерии и оценки -->
   <input type="hidden" name="count_values" value="<? echo count($arResult['CRITERIAS']); // сохраняем в форме число критериев?>">
<?
/*
 * Запускам цикл по выводу нужного количества критериев с оценками и ползунками
 */

    $i=0;
    if ($arResult['CRITERIAS'])
        {foreach($arResult['CRITERIAS'] as $elID => $elName) // Вывод критериев оценки
            {$i++;
?>   
        <table width="100%" border="0" cellpadding="2" style="margin-top: 7px; height:45px; border-bottom: 1px solid #ccc"><tr>
        <td width="15" valign="top"><? echo $i // вывод порядкового номера критерия ?>.</td>
        <td valign="top"><? echo $elName['NAME'] // вывод имени критерия ?></td>
        <td valign="top" width="210"><div class="slider"></div></td>
        <td valign="top" width="20"><span class="amount">3</span>
        <input type="hidden" 
               name="criteria_<? echo $i // индексируем поле для хранения кода критерия?>" 
               value="<? echo $elName['ID'] // сохраняем код критерия ?>">
        <input type="hidden"  
               class="val_keeper" 
               name="eval_<? echo $i // устанавливаем значение оценки по умолчанию?>" 
               value="3">
        </td></tr></table>
<?
            } // end foreach
        }  // end if     
?>
   
</td>
</tr></table>
    
<table width="98%" border="0">
    <tr>
        <td width="420">
        <?$APPLICATION->IncludeComponent("mvector:services.form.rating","realtime", Array(
                            "IB_VALUES_ID" => $arParams['IB_VALUES_ID'],
                            "IB_SERVICES_ID" => $arParams['IB_SERVICES_ID'],
                            "IB_LOCATIONS_ID" => $arParams['IB_LOCATIONS_ID'],
                            "CURRENT_LOCATION_ID" => $arParams['LOCATION_ID'],
                            "CURRENT_SERVICE_ID" => $arParams['SERVICE_ID']
                          )
        );?>
        </td>
        <td>
            <div style="margin-top: 15px;  width: 200px; height: 80px; float: right; background: #dcf; ">
                <div style="margin-top: 15%; margin-left: 32%;">
                    <strong> 
                    <a href="javascript:void()" onclick="document.forms['values_iblock_add'].submit();">ОЦЕНИТЬ</a> 
                    </strong>
                </div>
            </div>
        </td>
    </tr>
</table>
</form>

<?$APPLICATION->IncludeComponent("mvector:comments.view","amountform", Array(
                            "LOCATION_ID" => $arParams['LOCATION_ID'],
                            "SERVICE_ID" => $arParams['SERVICE_ID']
                          )
  );?>


<!--<input type="submit" name="iblock_submit" value="Оценить" />-->

<?
//echo '<strong>Форма оценки услуги:</strong> <br />';
//echo '<strong>Массив результатов</strong>';
//echo '<pre>'; echo print_r($arParams); echo '</pre>';
//echo '<pre>'; echo print_r($arResult); echo '</pre>';
?>

