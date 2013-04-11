<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
     
<div style="margin-left: 10px; width: 200px; height: 80px; float: left; background: #ddf;">
    <div style="margin: 5px 0 10px; text-align: center;">Удовлетворенность услугой:<br />
        <strong>
           <div style="margin-top: 10px; font-size: 1.8em; text-align: center;">
               <?echo $arResult[$arParams['CURRENT_LOCATION_ID']][$arParams['CURRENT_SERVICE_ID']]['AVERAGE_PERCENT_RATING']; ?>
           </div>
        </strong>
        </div>
      </div>
<span style="color: #999; float: right;">
    <?echo $arResult[$arParams['CURRENT_LOCATION_ID']][$arParams['CURRENT_SERVICE_ID']]['VOTES_AMOUNT']; ?>
</span>