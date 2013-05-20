<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
    <div class="hold-row">
        <span class="submit">
            <input id="submit" type="submit" class="btn" value="Отправить выставленные оценки" />
            <span class="r"></span>
        </span>
        <p id="results">
        <?if(isset($arResult['VOTES_AMOUNT']) && $arResult['VOTES_AMOUNT'] > 0) {?>
            Всего проголосовало <?=$arResult['VOTES_AMOUNT']?> человек
        <?  }?>
        </p>
    </div>
