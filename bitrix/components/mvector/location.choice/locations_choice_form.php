<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<form id="locations_select" action="http://<? echo SITE_SERVER_NAME; ?>/services/" method="post" enctype="multipart/form-data">
<?
if(CModule::IncludeModule("iblock")):
$arSelect = Array("ID", "NAME");
$arFilter = Array("IBLOCK_ID"=>23);
$res = CIBlockElement::GetList(Array('NAME' => 'ASC'), $arFilter, false, false, $arSelect);
$i = 0;
echo '<table width="100%" border="0"><tr><td width="50%">';
while($ob = $res->GetNextElement())
{
 $i++;
  $arFields = $ob->GetFields();
 // print_r($arFields);
if ($i % 25 == 0) echo '</td><td width="50%">';
  echo '<input type="radio" name="locations" value="'.$arFields['ID'].'">'.$arFields['NAME'].'</input><br />';
}
//echo '</td></tr></table>';
endif;
?>


</form>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>