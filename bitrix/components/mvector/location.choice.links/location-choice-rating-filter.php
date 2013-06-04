<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<script type="text/javascript">
$(document).ready(function(){
   $('#close-filter').click(function() {
        $('#page-ovaerlay').empty();
   });
});
</script>
<div class="overlay"></div>
<div class="lightbox">
    <a href="#" class="close" id="close-filter">close</a>
    <div class="clearfix"></div>
    <h2>Выберите муниципальные районы для отображения соответствующих поставщиков</h2>
    <form action="<?SITE_SERVER_NAME?>">
    <div class="column">
        
        <ul>
<?
$arLocation = CLocations::GetLocationParams();
$i = 0;
foreach($arLocation as $LocationID => $LocationParams)
{
    $i++;
    if ($i % 25 == 0) echo '</ul></div><div class="column"><ul>';
?>     
    <li><input type="checkbox" name="lid_<?=$i?>" value="<?=$LocationID?>"><?=$LocationParams['LOCATION_NAME']?></li>
<?
} // endwhile
?>
        </ul>
            
        <div id="log"></div>
    </div>
    <div class="clearfix"></div>
    <br />
    <br />
    <div align="center">
    <span class="submit">
                <input type="submit" class="btn" value="Применить фильтр" />
                <span class="r"></span>
            </span>
    </span>
    </form>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>