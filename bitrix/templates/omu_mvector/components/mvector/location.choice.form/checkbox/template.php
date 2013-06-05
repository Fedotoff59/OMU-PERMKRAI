<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h2>Выберите муниципальные районы</h2>
<div class="column">
<ul>
<?
$i = 0;

foreach($arResult['LOCATIONS'] as $LocationID => $LocationParams)
{
    $i++;
    if ($i % 25 == 0) echo '</ul></div><div class="column"><ul>';
?>     
    <li><input type="checkbox" name="lid_<?=$i?>" value="<?=$LocationID?>"><?=$LocationParams['LOCATION_NAME']?></li>
<?
} // endwhile
echo $LocationParams['ID'];
?>
</ul>
    </div>
