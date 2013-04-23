<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
     
<div style="margin-left: 10px; width: 200px; height: 80px; float: left; background: #fdd;">
    <div style="margin: 5px 0 10px; text-align: center;">Текущий балл поставщика:<br />
        <strong>
           <div style="margin-top: 10px; font-size: 1.8em; text-align: center;">
               <?=$arResult[$arParams['PROVIDER_ID']]['AVERAGE_RATING']; ?>
            </div>
        </strong>
    </div>
</div>
<span style="color: #999; float: right;">
    <?=$arResult[$arParams['PROVIDER_ID']]['VOTES_AMOUNT']; ?>
</span>
