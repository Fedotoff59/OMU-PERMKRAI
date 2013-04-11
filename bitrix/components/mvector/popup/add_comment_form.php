<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? CUtil::InitJSCore( array('ajax' ,'window', 'popup' ));?>

    
<?  // Обработка комментария
    if ($_POST) {
        if(CModule::IncludeModule("iblock")):
        $Location_ID = $_SESSION['LOCATION_ID'];
        $IB_LOCATIONS_ID = 23;
        // Определяем, в какой инфоблок будем записывать комментарий      
        $db_props = CIBlockElement::GetProperty($IB_LOCATIONS_ID, $Location_ID, Array("sort"=>"asc"), Array("CODE"=>"IBCOMMENTS"));
            if($ar_props = $db_props->Fetch())
                $IB_COMMENTS_ID = IntVal($ar_props["VALUE"]);
                else
                $IB_COMMENTS_ID = false;
        // Создаем элемент инфоблока        
        $arFields = array(
            'PROVIDER' => $_SESSION['COMMENT']['PROVISOR_ID'],
            'CREATEDATE' => date("d.m.Y H:i:s"),
            'SERVICE' => $_SESSION['COMMENT']['SERVICE_ID'],
            'COMMENTTEXT' => $_POST['text'],
            //'LOCATION' => $_SESSION['LOCATION_ID'],
            'USERIP' => $_SERVER['REMOTE_ADDR'],
            );
        
            $el = new CIBlockElement;
            global $USER; 
            $arAddValuesElement = Array(
            'NAME' => $_POST['topic'],
            'ACTIVE' => 'N',  
            'CREATED_BY' => $USER->GetID(), 
            'IBLOCK_SECTION_ID' => false,         
            'IBLOCK_ID' => $IB_COMMENTS_ID, //Инфоблок комментариев               
            'PROPERTY_VALUES'=> $arFields
            );
        endif;
    if($EVAL_ID = $el->Add($arAddValuesElement))
        echo '<div style="width:400px"><div style="text-align: center;margin-top:15px auto;font-size:2em">Ваш комментарий сохранен!</div></div>';
    else
        echo "Ошибка: ".$el->LAST_ERROR;
        
    }
    else {  // Вывод формы комментария
?>

<form id="add-comment-form" 
      action="<?=POST_FORM_ACTION_URI?>" 
      method="post" 
      enctype="multipart/form-data">
    <span>
        <strong>Тема комментария<span style="color:red">*</span></strong>
    </span>
    <br />
    <input type="text" id="comment-topic" name="topic" required>
    <br /><br />
    <span>
        <strong>Текст комментария<span style="color:red">*</span></strong>
    </span>
    <textarea rows="10" cols="40" id="comment-text" name="text" style="resize: none;" required></textarea>
</form>
<div id="add-comment-message" style="margin-top: 5px;">Поля, отмеченные звездочкой (*) обязательны для заполнения.</div>

<? } ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>