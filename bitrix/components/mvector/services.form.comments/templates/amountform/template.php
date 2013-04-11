<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
     
<div style="margin-top: 5px; width: 98%;">
    <span>
    <strong>
        <a id="link-toaddcomment" href="javascript:void(0)" class="link-comment">
            Добавить комментарий
        </a>
        <div id="ajax-commentform"></div>
    </strong>
    </span>
</div>

<? if(count($arResult) > 0) { ?>
<?      for($i = 0; $i < count($arResult); $i++) { ?>
            <div style="margin-bottom: 5px; margin-top: 15px;  width: 690px; min-height: 100px; background: #fec">
                 <div style="margin: 0px; padding: 5px; text-align: left;  background: #fdd">
                     <span style="font-weight: bold"><? echo $arResult[$i]['TOPIC']; ?></span>
                     <span> - <? echo $arResult[$i]['COMMENTPOSTER']; ?></span>
                     <span style="float:right"> <? echo $arResult[$i]['COMMENTDATE']; ?></span>
                 </div>
                 <div style="padding: 5px; text-align: left;">
                    <? echo $arResult[$i]['COMMENTTEXT'] ?>
                 </div>
            </div>
        <? if($arResult[$i]['COMMENTANSWER'] != '') { ?>

            <div style="margin-bottom: 5px; margin-top: 15px; margin-left: 25px;  width: 665px; min-height: 100px; background: #fcc">
                 <div style="margin: 0px; padding: 5px; text-align: left;  background: #fee">
                     <span style="font-weight: bold">Ответ специалиста</span>
                 </div>
                 <div style="padding: 5px; text-align: left;">
                    <? echo $arResult[$i]['COMMENTANSWER'] ?>
                 </div>
            </div>
<?          } ?>
<?      } ?>
<? } ?>