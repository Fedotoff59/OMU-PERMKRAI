<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<script type="text/javascript">
$(document).ready(function(){
   $('#close-popup').click(function() {
        $('#page-ovaerlay').empty();
   });
   $('.popup-location-link').click(function(e) {  
        //$("#log").html("link: " + e.target.className);
        if (e.target.className == 'popup-location-link') {
            var locationtextid = e.target.id;
            var locationid = locationtextid.split('-');
            $.ajax({
                type: 'POST',
                url: '/bitrix/components/mvector/location.choice/ajax-location-choice.php',
                data: ({'location_choice': locationid[1]}),
                success: function(data) {
                    // Переадресация в случе, если мы находимся в разделе оценки
                    var currenturl = window.location.href;
                    var spliturl = currenturl.split('/');
                    if (spliturl[3] == 'services' || spliturl[3] == '' || spliturl[3] == '#') {
                        window.location.replace("/");
                    } else $('#page-ovaerlay').empty();
                    // Вписываем выбранную территорию
                    $('#chose-location-link').html(data);
                    $("#log").html("link: " + spliturl[3]);
                },
                error:  function(xhr, str){
                    alert(xhr.responseCode);
                }
            });
        }
   });
});
</script>
<div class="overlay"></div>
<div class="lightbox">
    <a href="#" class="close" id="close-popup">close</a>
    <div class="clearfix"></div>
    <h2>Выберите муниципальный район</h2>
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
    <li><a href="javascript:;" class="popup-location-link" id="location-<?=$LocationID?>"><?=$LocationParams['LOCATION_NAME']?></a></li>
<?
} // endwhile
?>
        </ul>
        <div id="log"></div>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>