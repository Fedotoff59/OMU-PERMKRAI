<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?

$arDefaultUrlTemplates404 = array(
   "ratings.about" => "index.php",
   "services.list.services" => "serviceslist/",
   "ratings.locations" => "locations/",
   "ratings.report" => "report/",
   "ratings.services.loyalty" => "serviceslist/#SERVICE_ID#/",
   "ratings.providers" => "serviceslist/#SERVICE_ID#/providers/",
   "data.export" => "report/export/"
);
$arDefaultVariableAliases404 = Array();
$arDefaultVariableAliases = Array();
$arComponentVariables = Array();

if ($arParams['SEF_MODE'] != 'Y')
    echo ERR_MESSAFE_SEF_MODE;
    else {
        $arResult = Array();
        $arVariables = Array();
        $arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams['SEF_URL_TEMPLATES']);
        $componentPage = CComponentEngine::ParseComponentPath($arParams['SEF_FOLDER'], $arUrlTemplates, $arVariables);
        // Проверяем, есть ли переменные в адресной строке
        if (!empty($arVariables))
            $arResult['VARIABLES'] = $arVariables;

        $this->IncludeComponentTemplate($componentPage);
    }
?>