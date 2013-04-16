<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? 
/* Компонент обрабатывает выбор услуги на главной странице.
 * Если выбранная услуга в текущем МО содержит поставщиков,
 * компонент подключает шаблон списка поставщиков.
 * Если выбранная услуга поставщиков не содержит,
 * компонент подключает шаблон формы оценки услуги.
 */

if(CModule::IncludeModule("iblock")):

//Определяем ID инфоблока поставщиков в соответствии с выбранной территорией

    $arLocationParams = get_location_params($arParams['LOCATION_ID']);                                          

    $IB_PROVIDERS_ID = $arLocationParams['IB_PROVIDERS_ID'];

// Проверка наличия поставщиков

    $arProviders = Array();
    $arSelect = Array("ID", "NAME");
    $arFilter = Array("IBLOCK_ID" => IntVal($IB_PROVIDERS_ID), 
                      "ACTIVE" => "Y", 
                      "PROPERTY_SERVICES" => $arParams['SEF_VARIABLES']['SERVICE_ID']
                );
    $res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
     {
            $arProviders[] = $ob->GetFields();
     }
     
endif;

// Определение того, что будем выводить

if ($arProviders) // В зависимости от того, есть ли поставщики
{
    // Если только 1 поставщик - сразу переходим на форму оценки этого поставщика
    if (count($arProviders) == 1) {      
        $link2form = '/services/'.$arParams['SEF_VARIABLES']['SERVICE_ID'].'/providers/'.$arParams['LOCATION_ALIAS'].'/'.$arProviders[0]['ID'];
        LocalRedirect($link2form);        
    }
    // Если несколько поставщиков, подключаем компонент вывода списка поставщиков
    else if (count($arProviders) > 1) {       
            $APPLICATION->IncludeComponent(
            "mvector:services.list.providers",
            ".default",
            Array(  'SERVICE_ID' => $arParams['SEF_VARIABLES']['SERVICE_ID'],
                    'LOCATION_ALIAS' => $arParams['LOCATION_ALIAS'],
                    'LOCATION_ID' => $arParams['LOCATION_ID'],
                    'LOCATION_NAME' => $arParams['LOCATION_NAME'],
                    'COUNT_PROVIDERS' => count($arProviders),
                    'PROVIDERS' => $arProviders
                ), $component
        );  
    }
    
}
else {  // Если поставщиков вообще нет, подключаем страницу с формой оценки выбранной услуги
        $APPLICATION->IncludeComponent(
        "mvector:services.votespage.service",
        ".default",
        Array(  'SERVICE_ID' => $arParams['SEF_VARIABLES']['SERVICE_ID'],
                'LOCATION_ID' => $arParams['LOCATION_ID'],
                'LOCATION_NAME' => $arParams['LOCATION_NAME'],
                'PROVIDER_ID' => 0,
            ), $component
        );
   }
?>