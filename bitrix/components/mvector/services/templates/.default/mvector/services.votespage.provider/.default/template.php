<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->IncludeComponent(
"mvector:services.form.criterias",
".default",
array('IB_SERVICES_ID' => $arParams['IB_SERVICES_ID'],
        'SERVICE_ID' => $arParams['SERVICE_ID'],
        'IB_CRITERIAS_ID' => $arParams['IB_CRITERIAS_ID']
)
)
        ?>
   <td width="30%" valign="top" style="border-left: 1px solid #ccc;"><!--  Карточка поставщика -->
<div style="margin-left:10px; margin-top:10px;">
    <?     
    if ($arResult['PROVISOR']['FULLNAME'])
                echo '<span style="font-size: 1.2em"><strong>'.$arResult['PROVISOR']['FULLNAME'].'</strong></span><br /><br />';
           if ($arResult['PROVISOR']['ADDRESS'])
                echo '<strong>Адрес:</strong><br />'.$arResult['PROVISOR']['ADDRESS'].'<br /><br />';
           if ($arResult['PROVISOR']['INN'])
                echo '<strong>ИНН:</strong><br />'.$arResult['PROVISOR']['INN'].'<br /><br />';
           if ($arResult['PROVISOR']['CEO'])
                echo '<strong>Руководитель:</strong><br />'.$arResult['PROVISOR']['CEO'].'<br /><br />';
           if ($arResult['PROVISOR']['PHONE'])
                echo '<strong>Телефон:</strong><br />'.$arResult['PROVISOR']['PHONE'].'<br /><br />';
           if ($arResult['PROVISOR']['FAX'])
                echo '<strong>Факс:</strong><br />'.$arResult['PROVISOR']['FAX'].'<br /><br />';
           if ($arResult['PROVISOR']['SITE'])
                echo '<strong>Сайт:</strong><br /><a href="'.$arResult['PROVISOR']['SITE'].'" target="_blank">'.$arResult['PROVISOR']['SITE'].'</a><br /><br />';
           if ($arResult['PROVISOR']['EMAIL'])
                echo '<strong>E-mail:</strong><br /><a href="mailto:'.$arResult['PROVISOR']['EMAIL'].'">'.$arResult['PROVISOR']['EMAIL'].'</a><br /><br />';
           ?>
</div>
</td>
</tr></table>
  
<table width="98%" border="0">
    <tr>
        <td width="70%">
<table border="0">
    <tr>
      <td width="200" valign="top">
        <?$APPLICATION->IncludeComponent("mvector:provisor.form.rating","realtime", Array(
                            "IB_VALUES_ID" => $arParams['IB_VALUES_ID'],
                            "IB_SERVICES_ID" => $arParams['IB_SERVICES_ID'],
                            "IB_PROVISORS_ID" => $arParams['IB_PROVISORS_ID'],
                            "CURRENT_PROVISOR_ID" => $arParams['PROVISOR_ID'],
                            "CURRENT_SERVICE_ID" => $arParams['SERVICE_ID']
                          )
        );?>
      </td>
<td width="200" valign="top">
        <?$APPLICATION->IncludeComponent("mvector:provisor.form.loyalty","realtime", Array(
                            "CURRENT_LOCATION_ID" => $arParams['LOCATION_ID'],
                            "CURRENT_SERVICE_ID" => $arParams['SERVICE_ID']
                          )
        );?>
</td>
<td valign="top">

            <div style="margin-left: 10px;  width: 200px; height: 80px; float: right; background: #dcf; ">
                <div style="margin-top: 15%; text-align: center;">
                    <strong> 
                    <a href="javascript:void()" onclick="document.forms['values_iblock_add'].submit();">ОЦЕНИТЬ</a> 
                    </strong>
                </div>
            </div>
    </td>
</tr>
</table>
</td>


        <td width="30%" style="border-left: 1px solid #ccc;">    
        </td>
    </tr>
</table>
</form>

<?$APPLICATION->IncludeComponent("mvector:comments.view","amountform", Array(
                            "LOCATION_ID" => $arParams['LOCATION_ID'],
                            "PROVISOR_ID" => $arParams['PROVISOR_ID'],
                            "SERVICE_ID" => $arParams['SERVICE_ID']
                          )
  );?>

<?

//echo '<strong>Форма оценки услуги:</strong> <br />';
//echo '<strong>Массив результатов</strong>';
//echo '<pre>'; echo print_r($arParams); echo '</pre>';
//echo '<pre>'; echo print_r($arResult); echo '</pre>';
?>

