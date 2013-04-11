<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<h1 id="pagetitle">Поставщики услуги "<?echo $arResult['SERVICE_NAME']?>"</h1>
<p><a id="rating-locations" href="javascript:void(0)">Фильтр территории</a><p>
<div id="ajax-rating-locations"></div>
<table width="98%" align="center" cellspacing="0" cellpadding="0" id="Sortable" class="tablesorter">
   <thead>
    <tr>
        <th><strong>№</strong></td>
        <th><strong>Наименование поставщика</strong></td>
        <th width="50"><strong>Муниципальное образование</strong></td>
        <th width="20"><strong>Рейтинг, %</strong></td>
        <th width="20"><strong>Число голосов</strong></td>
    </tr>
    </thead>
    <tbody>
<?  foreach ($arResult['PROVISOR'] as $key => $arProvisor) { 
    
    $number = $key + 1;
   // if (in_array($number, $arResult['ITEMS_RANGE'])):

?>
    <tr>
        <td style="border-bottom: 1px solid #ddd;"><?echo $number;?>.</td>
        <td style="border-bottom: 1px solid #ddd;"><a href="<? echo $arProvisor['PROVISOR_LINK']?>"><?echo $arProvisor['NAME'];?></a></td>
        <td style="border-bottom: 1px solid #ddd;"><?echo $arProvisor['PROVISOR_LOCATION'];?></td>
        <td style="border-bottom: 1px solid #ddd;"><?echo $arProvisor['AVERAGE_PERCENT_RATING'];?></td>
        <td style="border-bottom: 1px solid #ddd;" align="center"><?echo $arProvisor['VOTES_AMOUNT'];?></td>
    </tr>
<? /*endif;*/ } ?>
    </tbody>
</table>
<?
    if ($arResult['LAST_PAGE'] > 1):
        echo '<br /><div style="text-align: center">|'; 
        for($i = 1; $i <= $arResult['LAST_PAGE']; $i++)
            if($i != $arResult['CURRENT_PAGE'])
            echo ' <a href="?page='.$i.'">'.$i.'<a> |';
            else echo ' '.$i.' |';
        echo '</div>';
    endif;
?>
<p>
<a href="http://omu.m-vector.org/ratings/report/?load=locations&format=xlsx">Загрузить отчет (*.xls)</a>
<a href="http://omu.m-vector.org/ratings/report/?load=locations&format=pdf">Загрузить отчет (*.pdf)</a>
</p>


