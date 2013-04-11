<h1 id="pagetitle">Рейтинг муниципальных образований</h1>

<table width="98%" align="center" cellspacing="0" cellpadding="0" border="0">
    <tr style="background: #ddd; font-size: 0.8em">
        <td width="25"><strong>№</strong></td>
        <td width="28%"><strong>Муниципальное образование</strong></td>
        <td width="350"></td>
        <td width="50"><strong>Удовлетворенность услугами</strong></td>
        <td><strong>Число голосов</strong></td>
    </tr>
<?  foreach ($arResult as $key => $arLocations) { ?>
    <tr>
        <td style="border-bottom: 1px solid #ddd;"><?echo $key + 1;?></td>
        <td style="border-bottom: 1px solid #ddd;"><?echo $arLocations['LOCATION_NAME'];?></td>
        <td style="border-bottom: 1px solid #ddd;"><div style="background: red; height: 8px; width:<? echo $arLocations['DIAGRAM_WIDTH']?>px"></div></td>
        <td style="border-bottom: 1px solid #ddd;"><?echo $arLocations['AVERAGE_PERCENT_RATING'];?></td>
        <td style="border-bottom: 1px solid #ddd;" align="center"><?echo $arLocations['VOTES_AMOUNT'];?></td>
    </tr>
<? } ?>
</table>