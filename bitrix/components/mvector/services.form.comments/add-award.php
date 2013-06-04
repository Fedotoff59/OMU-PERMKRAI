<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<script type="text/javascript">
$(document).ready(function(){
   $('#close-filter').click(function() {
        $('#page-ovaerlay').empty();
   });
   $('#form-award').submit(function() {
        alert('Благодарность отправлена!');
        $('#page-ovaerlay').empty();
   });
});
</script>
<div class="overlay"></div>
<div class="lightbox">
    <a href="#" class="close" id="close-filter">close</a>
    <div class="clearfix"></div>
    <h2>Отправить благодарность поставщику</h2>    
    <form id="form-award">
        <ul>
            <li><input name="action" type="radio">за образцовое исполнение служебного долга</li>
            <li><input name="action" type="radio"> за вклад в развитие отрасли</li>
            <li><input name="action" type="radio"> за качественное оказание услуги</li>
        </ul>
        <div align="center">
    <img style="text-align:center; border: 1px solid #ccc;" src="<?=SITE_TEMPLATE_PATH?>/images/award_to_provider.jpg">
    </div>
    <br /><br />
    <div align="center">
    <span class="submit">
                <input type="submit" class="btn" value="Отправить благодарность" />
                <span class="r"></span>
            </span>
    </span>
    </form>
    
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>