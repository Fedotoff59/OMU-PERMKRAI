<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="btn-row">
    <!--<a href="#" class="button send-btn"><span></span>Отправить благодарность</a>-->
    <?if ($USER->IsAuthorized()) {    ?>
        <a href="#" class="button add-btn open"><span></span>Добавить  комментарий</a>
    <?  }?>
    <? if(count($arResult) > 0) { ?>
    <h2>Комментарии</h2>
    <?  }?>
    <div class="comment-popup">
        <form id="commentsform" action="javascript:void()" method="post" enctype="multipart/form-data">
            <a href="#" class="close">close</a>
            <h2>Оставить комментарий</h2>
            <div class="row" id="comm-topic">
                <label for="comment-topic">Тема</label>
                <input type="text" class="input-text" id="comment-topic" />
            </div>
            <div class="row">
                <label for="comment-text">Сообщение</label>
                <textarea rows="20" cols="20" id="comment-text"></textarea>
            </div>
            <span class="submit">
                <input type="reset" value="Отменить" class="btn">
                <span class="r"></span>
            </span>
            <span class="submit">
                <input id="submit-comment" type="submit" value="Отправить" class="btn">
                <span class="r"></span>
            </span>
        </form>
    </div>
</div>
<? if(count($arResult) > 0) { ?>
<?      for($i = 0; $i < count($arResult); $i++) { ?>
            <div class="comment-box">
                <p><?=$arResult[$i]['COMMENTTEXT']?></p>
                <div class="row">
                    <em class="date"><?=$arResult[$i]['COMMENTDATE']?></em>
                    <strong class="name"><?=$arResult[$i]['COMMENTPOSTER']?></strong>
                </div>
            </div>
        <? if($arResult[$i]['COMMENTANSWER'] != '') { ?>

            <div class="comment-box comment-box-answer">
                <p><?=$arResult[$i]['COMMENTANSWER']?></p>
                <div class="row">
                    <strong class="name">Ответ специалиста</strong>
                </div>
            </div>
<?          } ?>
<?      } ?>
<? } ?>
