<?
/*
 * Компонент выводит контакты специалиста в выбранной территории
 * 
 */

$CurLocationID = CLocations::GetCurrentLocationID();
if (!($CurLocationID > 0))
    $CurLocationID = $arParams['DEFAULT'];
$arFilter = Array("ACTIVE"=>"Y","GROUPS_ID"=>Array(8), "UF_USERLOCATION" => $CurLocationID);
$rsUsers = CUser::GetList(  ($by = "id"), 
                            ($order = "desc"), 
                            $arFilter, 
                            Array("FIELDS" => Array("ID", 
                                                    "NAME", 
                                                    "LAST_NAME",
                                                    "SECOND_NAME",
                                                    "EMAIL",
                                                    "WORK_PHONE")
                                 )
                         );
while ($arUser = $rsUsers->Fetch()) 
{
   if (isset($arUser["NAME"]))
       $arResult['FULL_NAME'] = $arUser["NAME"];
   if (isset($arUser["SECOND_NAME"]))
       $arResult['FULL_NAME'] .= ' '.$arUser["SECOND_NAME"];
   if (isset($arUser["LAST_NAME"]))
       $arResult['FULL_NAME'] .= ' '.$arUser["LAST_NAME"];
   $arResult['EMAIL'] = $arUser['EMAIL'];
   $arResult['WORK_PHONE'] = $arUser['WORK_PHONE'];
}
$this->IncludeComponentTemplate();

?>