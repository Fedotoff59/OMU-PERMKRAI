<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?

$arDefaultUrlTemplates404 = array(
   "ratings.about" => "index.php",
   "ratings.list" => "serviceslist",
   "ratings.locations" => "locations",
    "ratings.report" => "report/",
   "ratings.services.loyalty" => "services/#SERVICE_ID#",
   "ratings.provisors" => "services/#SERVICE_ID#/provisors/",
);

$arDefaultVariableAliases404 = array();

$arDefaultVariableAliases = array();

$arComponentVariables = array();


$SEF_FOLDER = "/ratings/";
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
      $componentPage = "ratings";
   else
      $componentPage = "ratings.mainpage";

}

$arResult = array(
   "FOLDER" => $SEF_FOLDER,
   "URL_TEMPLATES" => $arUrlTemplates,
   "VARIABLES" => $arVariables,
   "ALIASES" => $arVariableAliases
);

$arParams = array(
'IB_SERVICES_ID' => 20,
'IB_CRITERIAS_ID' => 21,
'IB_VALUES_ID' => 22,
'IB_LOCATIONS_ID' => 23,
'IB_PROVISORS_ID' => 24,   
'SEF_VARIABLES' => $arVariables,
'SEF_FOLDER' => $SEF_FOLDER
//'PLACE_ID' => 470,
//'PLACE_NAME' => 'Пермь',
//'PLACE_ALIAS' => 'perm'
);

//echo '<span style="color: #f00;">componentPage = '.$componentPage.'</span>';

//echo '<pre>'; print_r($_GET); echo '</pre>';

$this->IncludeComponentTemplate($componentPage);

?>