<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$arDefaultUrlTemplates404 = Array(
   "services.list.services" => "index.php",
   "services.votespage.service" => "#SERVICE_ID#/#LOCATION_ALIAS#",
   "services.votespage.provider" => "#SERVICE_ID#/providers/#LOCATION_ALIAS#/#PROVIDER_ID#",
);
$arDefaultVariableAliases404 = Array();
$arDefaultVariableAliases = Array();
$arComponentVariables = Array();

if ($arParams['SEF_MODE'] != 'Y')
    {
        echo ERR_MESSAFE_SEF_MODE;
    } else {
    $arVariables = array();
    $arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams['SEF_URL_TEMPLATES']);
    $componentPage = CComponentEngine::ParseComponentPath($arParams['SEF_FOLDER'], $arUrlTemplates, $arVariables);
    $arResult = array('VARIABLES' => $arVariables);
    
    if(isset($_POST['locations'])) { // Изменилось ли местоположение по запросу пользователя
        CLocations::SetlocationByID($_POST['locations']);
        LocalRedirect('http://'.SITE_SERVER_NAME.'/services/');
        } 
    if (isset($arVariables['LOCATION_ALIAS'])) { 
               CLocations::SetLocationByAlias($arVariables['LOCATION_ALIAS']);
    } else {
         $arResult['CUR_LOCATION_ID'] = CUR_LOCATION_ID;
         $arResult['CUR_LOCATION_NAME'] = CUR_LOCATION_NAME;
         $arResult['CUR_LOCATION_ALIAS'] = CUR_LOCATION_ALIAS;
         $arResult['CUR_LOCATION_IB_PROVIDERS_ID'] = CUR_LOCATION_IB_PROVIDERS_ID;
         $arResult['CUR_LOCATION_IB_COMMENTS_ID'] = CUR_LOCATION_IB_COMMENTS_ID;
         $arResult['CUR_LOCATION_SPECIALIST_ID'] = CUR_LOCATION_SPECIALIST_ID; 
    }

        //echo '<span style="color: #f00;">componentPage = '.$componentPage.'</span>';
        echo '<pre>'; print_r($arResult); echo '</pre>';
        $this->IncludeComponentTemplate($componentPage);
    }
?>