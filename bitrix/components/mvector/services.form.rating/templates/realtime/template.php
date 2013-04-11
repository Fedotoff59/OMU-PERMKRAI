<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
     
<div style="margin-left: 10px; width: 200px; height: 80px; float: left; background: #fdd;">
    <div style="margin: 5px 0 10px; text-align: center;">Текущий рейтинг поставщика:<br />
        <strong>
           <div style="margin-top: 10px; font-size: 1.8em; text-align: center;">
               <?echo $arResult[$arParams['CURRENT_PROVISOR_ID']]['AVERAGE_RATING'] ?>
           </div>
        </strong>
        </div>
      </div>
<span style="color: #999; float: right;">
    <?echo $arResult[$arParams['CURRENT_PROVISOR_ID']]['VOTES_AMOUNT'] ?>
</span>