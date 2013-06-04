<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$arDefaultUrlTemplates404 = Array(
   "services.votespage.service" => "#SERVICE_ID#/#LOCATION_ALIAS#/",
   "services.votespage.provider" => "#SERVICE_ID#/providers/#LOCATION_ALIAS#/#PROVIDER_ID#/",
);
$arDefaultVariableAliases404 = Array();
$arDefaultVariableAliases = Array();
$arComponentVariables = Array();

if ($arParams['SEF_MODE'] != 'Y')
    {
        echo ERR_MESSAFE_SEF_MODE;
    } else {
        $arResult = Array();
        $arVariables = Array();
        $arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams['SEF_URL_TEMPLATES']);
        $componentPage = CComponentEngine::ParseComponentPath($arParams['SEF_FOLDER'], $arUrlTemplates, $arVariables);
        // Проверяем, есть ли переменные в адресной строке
        if (!empty($arVariables)) {
            // Сохраняем переменные в результат
            $arResult['VARIABLES'] = $arVariables;
            // Определяем территорию компонента по переменной
            $CurLocation = CLocations::GetLocationByAlias($arVariables['LOCATION_ALIAS']);
        // Если переменных нет, значит, это главная страница
        // Значение территории компонента устанавливаем из выбранного пользователем
        } else {
            @define("ERROR_404","Y");
            if(function_exists("LocalRedirect"))
                LocalRedirect("/404.php"); 
        }
        if($CurLocation > 0) 
            $arLocation = CLocations::GetLocationParams($CurLocation);
            foreach($arLocation as $LocationID => $LocationParams)
                $arResult['LOCATION'] = $LocationParams;
        //echo '<span style="color: #f00;">componentPage = '.$componentPage.'</span>';
        //echo '<pre>'; print_r($arVariables); echo '</pre>';
        $this->IncludeComponentTemplate($componentPage);
    }
?>