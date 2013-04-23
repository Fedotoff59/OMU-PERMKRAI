<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<script type="text/javascript">
$(document).ready(function(){
   $('#locations-table').click(function(e) {  
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
                    if (spliturl[3] == 'services') {
                        window.location.replace("/services/");
                    }
                    // Вписываем выбранную территорию
                    $('#chose-location-link').html(data);
                },
                error:  function(xhr, str){
                    alert(xhr.responseCode);
                }
            });
            //$("#log").html("link: " + url[3]);
            $.fancybox.close();
        }
   });
});
</script>
<table width="100%" border="0" id="locations-table"><tr><td width="50%" align="left">
<?
$arLocation = CLocations::GetLocationParams();
$i = 0;
foreach($arLocation as $LocationID => $LocationParams)
{
    $i++;
    if ($i % 25 == 0) echo '</td><td width="50%" align="left">';
?>     
    <a href="javascript:;" class="popup-location-link" id="location-<?=$LocationID?>"><?=$LocationParams['LOCATION_NAME']?></a><br>
<?
} // endwhile
?>
</td></tr></table>
<div id="log"></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>