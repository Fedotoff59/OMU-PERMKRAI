<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<h1 id="pagetitle">Удовлетворенность услугой "<?echo $arResult['SERVICE_NAME']?>"</h1>

<?  if($arResult['SERVICE_HAS_PROVISORS']): ?>
    <p style="float: right"><a href="<? echo $arResult['SERVICE_ID']?>/provisors/">Перейти к поставщикам</a></p>
<?  endif;  ?>
<table width="98%" align="center" cellspacing="0" cellpadding="0">
    <tr style="background: #ddd; font-size: 0.8em">
        <td><strong>№</strong></td>
        <td><strong>Муниципальное образование</strong></td>
        <td></td>
        <td width="20"><strong>Удовлетворенность услугой</strong></td>
        <td width="20"><strong>Число голосов</strong></td>
    </tr>
<?  foreach ($arResult['SERVICE_LOYALTY'] as $key => $arLoyalty) { ?>
    <tr>
        <td style="border-bottom: 1px solid #ddd;"><?echo $key + 1;?></td>
        <td style="border-bottom: 1px solid #ddd;"><?echo $arLoyalty['LOCATION_NAME'];?></td>
        <td style="border-bottom: 1px solid #ddd;"></td>
        <td style="border-bottom: 1px solid #ddd;">
            <a href="<? echo $arLoyalty['FORM_VALUES_LINK'] ?>">
            <?echo $arLoyalty['AVERAGE_PERCENT_RATING'];?>
            </a>
        </td>
        <td style="border-bottom: 1px solid #ddd;"><?echo $arLoyalty['VOTES_AMOUNT'];?></td>
    </tr>
<? } ?>
</table>
