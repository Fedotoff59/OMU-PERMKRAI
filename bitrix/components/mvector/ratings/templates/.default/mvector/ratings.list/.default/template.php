<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<h1 id="pagetitle"><?$APPLICATION->ShowTitle(false)?></h1>

<?
//	echo '<strong>Работает внутренний шаблон вывода услуг на главную страницу:</strong>';
//	echo '<pre>';
//	echo print_r($arResult);
//	echo '</pre><br />';
echo '<ul>';
foreach($arResult as $sID => $arElements)
{
	$res = CIBlockSection::GetByID($sID);
	if($ar_res = $res->GetNext())
  	{
		echo '<li>'.$ar_res['NAME'].'</li>';
	}
	echo '<ul>';
	foreach($arElements as $elID => $elName)
	{
		echo '<li><a href="services/'.$elID.'">'.$elName.'</a></li>';
	}
	echo '</ul>';
}
echo '</ul>';
?>