<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
echo 'test';
$arDefaultUrlTemplates404 = array(
   "services.list.services" => "index.php",
   "services.evaluation.service" => "#SERVICE_ID#/#LOCATION_ALIAS#",
   "services.evaluation.provider" => "#SERVICE_ID#/providers/#LOCATION_ALIAS#/#PROVIDER_ID#",
);

$arDefaultVariableAliases404 = array();

$arDefaultVariableAliases = array();

$arComponentVariables = array("IB_SERVICES_ID", "ELEMENT_ID");


$SEF_FOLDER = "/services/";
$arUrlTemplates = array();

if ($arParams["SEF_MODE"] == "Y")
{
   $arVariables = array();

    $arUrlTemplates = 
        CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, 
                                                    $arParams["SEF_URL_TEMPLATES"]);
    $arVariableAliases = 
        CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases404, 
                                                       $arParams["VARIABLE_ALIASES"]);

   $componentPage = CComponentEngine::ParseComponentPath(
      $arParams["SEF_FOLDER"],
      $arUrlTemplates,
      $arVariables
   );


   if (StrLen($componentPage) <= 0)
      $componentPage = "404";

   CComponentEngine::InitComponentVariables($componentPage, 
                                            $arComponentVariables, 
                                            $arVariableAliases, 
                                            $arVariables);

   $SEF_FOLDER = $arParams["SEF_FOLDER"];
}
else
{
   $arVariables = array();

    $arVariableAliases = 
       CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases, 
                                                      $arParams["VARIABLE_ALIASES"]);
    CComponentEngine::InitComponentVariables(false, 
                                             $arComponentVariables, 
                                             $arVariableAliases, $arVariables);

   $componentPage = "";
   if (IntVal($arVariables["ELEMENT_ID"]) > 0)
      $componentPage = "service";
   else
      $componentPage = "services.mainpage";

}

$arResult = array(
   "FOLDER" => $SEF_FOLDER,
   "URL_TEMPLATES" => $arUrlTemplates,
   "VARIABLES" => $arVariables,
   "ALIASES" => $arVariableAliases
);

$arProviders = Array(31, 65, 66, 67, 68, 69, 70);

$arParams = array(
'IB_SERVICES_ID' => 20,
'IB_CRITERIAS_ID' => 21,
'IB_VALUES_ID' => 22,
'IB_LOCATIONS_ID' => 23,
'IB_PROVISORS_ID' => 24,
'IB_PROVIDERS_IDS' => $arProviders,
'SEF_VARIABLES' => $arVariables,
//'PLACE_ID' => 470,
//'PLACE_NAME' => 'Пермь',
//'PLACE_ALIAS' => 'perm'
);

if(isset($_POST['locations'])) { // Изменилось ли местоположение по запросу пользователя
        CLocations::SetlocationByID($_POST['locations']);
        LocalRedirect('http://'.SITE_SERVER_NAME.'/services/');
        }
   else if (isset($arVariables['LOCATION_ALIAS'])) 
            CLocations::SetLocationByAlias($arVariables['LOCATION_ALIAS']);

$arLocation = CLocations::Getlocation();

$arParams['LOCATION_ID'] = $arLocation['LOCATION_ID'];
$arParams['LOCATION_ALIAS'] = $arLocation['LOCATION_ALIAS'];
$arParams['LOCATION_NAME'] = $arLocation['LOCATION_NAME'];

//echo '<span style="color: #f00;">componentPage = '.$componentPage.'</span>';

//echo '<pre>'; print_r($arParams); echo '</pre>';

$this->IncludeComponentTemplate($componentPage);

?>