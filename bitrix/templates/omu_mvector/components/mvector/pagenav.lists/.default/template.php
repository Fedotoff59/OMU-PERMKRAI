<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="paging">
        <ul class="l">
            <?if ($arResult['ACTIVE_PAGE'] == 1) {?>
                <li><?=TEXT_PREV_PAGE?></li>
            <?} else {?>
                <li><a href="?page=<?=$arResult['ACTIVE_PAGE'] - 1?>"><?=TEXT_PREV_PAGE?></a></li>
            <?}     ?>
            <?if ($arResult['ACTIVE_PAGE'] == $arResult['TOTALPAGES']) {?>
                <li><?=TEXT_NEXT_PAGE?></li>
            <?} else {?>
                <li><a href="?page=<?=$arResult['ACTIVE_PAGE'] + 1?>"><?=TEXT_NEXT_PAGE?></a></li>
            <?}     ?>
	</ul>
	<ul class="paging-list">
            <?if ($arResult['ARROW_PREV']) {?>
                <li><a class="more" href="?page=<?=$arResult['START_PAGE'] - 1?>">back</a></li>
            <?  }?>
            <?for($i = $arResult['START_PAGE']; $i <= $arResult['END_PAGE']; $i++) {?>
                <?if ($i == $arResult['ACTIVE_PAGE']) {?>
                    <li><a class="active" href="?page=<?=$i?>"><?=$i?></a></li>
                <?} else {?>
                    <li><a href="?page=<?=$i?>"><?=$i?></a></li>
                <?}     ?>
            <?}     ?>
            <?if ($arResult['ARROW_NEXT']) {?>
                <li><a class="more" href="?page=<?=$arResult['END_PAGE'] + 1?>">more</a></li>
            <?  }?>      
	</ul>
    </div>