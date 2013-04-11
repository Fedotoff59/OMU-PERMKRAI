<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<form name="values_iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
    
    <input type="hidden" name="count_values" value="<? echo count($arResult['CRITERIAS']); // сохраняем в форме число критериев?>">
    
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
            <td width="100%" valign="top">
<?
 /*
 * Запускам цикл по выводу нужного количества критериев с оценками и ползунками
 */

                //$i=0;
                foreach($arResult['CRITERIAS'] as $elID => $elName) { // Вывод критериев оценки
                    //$i++;
?>   
                    <table width="100%" border="0" cellpadding="2" style="margin-top: 7px; height:45px; border-bottom: 1px solid #ccc">
                    <tr>
                        <td width="15" valign="top"><? echo $i // вывод порядкового номера критерия ?>.</td>
                        <td valign="top"><? echo $elName['NAME'] // вывод имени критерия ?></td>
                        <td valign="top" width="210"><div class="slider"></div></td>
                        <td valign="top" width="20"><span class="amount">3</span>
                        <input  type="hidden" 
                                name="criteria_<? echo $i // индексируем поле для хранения кода критерия?>" 
                                value="<? echo $elName['ID'] // сохраняем код критерия ?>">
                        <input  type="hidden"  
                                class="val_keeper" 
                                name="eval_<? echo $i // устанавливаем значение оценки по умолчанию?>" 
                                value="3">
                        </td>
                        </tr>
                    </table>
<?
            } // end foreach  
?>
   
</td>
</tr>
</table>