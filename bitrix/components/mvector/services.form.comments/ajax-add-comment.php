<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
    
<?  // Обработка комментария
    if (isset($_POST['comment-text']) && isset($_POST['comment-topic'])) {
        if(CModule::IncludeModule("iblock")):
        $Location_ID = $_SESSION['LOCATION_ID'];
        // Определяем, в какой инфоблок будем записывать комментарий      
        $db_props = CIBlockElement::GetProperty(IB_LOCATIONS_ID, $Location_ID, Array("sort"=>"asc"), Array("CODE"=>"IBCOMMENTS"));
            if($ar_props = $db_props->Fetch())
                $IB_COMMENTS_ID = IntVal($ar_props["VALUE"]);
                else
                $IB_COMMENTS_ID = false;
        // Создаем элемент инфоблока        
        $arFields = array(
            'PROVIDER' => $_SESSION['COMMENT']['PROVIDER_ID'],
            'CREATEDATE' => date("d.m.Y H:i:s"),
            'SERVICE' => $_SESSION['COMMENT']['SERVICE_ID'],
            'COMMENTTEXT' => $_POST['comment-text'],
            //'LOCATION' => $_SESSION['LOCATION_ID'],
            'USERIP' => $_SERVER['REMOTE_ADDR'],
            );
        
            $el = new CIBlockElement;
            global $USER; 
            $arAddValuesElement = Array(
            'NAME' => $_POST['comment-topic'],
            'ACTIVE' => 'N',  
            'CREATED_BY' => $USER->GetID(), 
            'IBLOCK_SECTION_ID' => false,         
            'IBLOCK_ID' => $IB_COMMENTS_ID, //Инфоблок комментариев               
            'PROPERTY_VALUES'=> $arFields
            );
        endif;
    if($EVAL_ID = $el->Add($arAddValuesElement))
        echo 'Ваш комментарий сохранен!';
    else
        echo "Ошибка: ".$el->LAST_ERROR;
        
    }
?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>