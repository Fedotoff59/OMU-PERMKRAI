<div id="content">
<h1>Регистрация пользователя портала</h1>
<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="bx-auth">
<?
ShowMessage($arParams["~AUTH_RESULT"]);
?>
<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y" && is_array($arParams["AUTH_RESULT"]) &&  $arParams["AUTH_RESULT"]["TYPE"] === "OK"):?>
<p><?echo GetMessage("AUTH_EMAIL_SENT")?></p>
<?else:?>

<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
	<p><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></p>
<?endif?>
<noindex>
<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" class="registration">
    
<?
if (strlen($arResult["BACKURL"]) > 0)
{
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
}
?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="REGISTRATION" />
        <div class="row">
            <label for="input001">Логин*</label>
            <input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" class="input-text" id="input001" />
            <span class="error-text">Нужно заполнить</span>
	</div>
        <div class="row">
            <label for="input001">Имя*</label>
            <input type="text" name="USER_NAME" maxlength="50" value="<?=$arResult["USER_NAME"]?>" class="input-text" id="input001" />
            <span class="error-text">Нужно заполнить</span>
	</div>
        <div class="row">
            <label for="input002">Фамилия*</label>
            <input type="text" name="USER_LAST_NAME" maxlength="50" value="<?=$arResult["USER_LAST_NAME"]?>" class="input-text" id="input002" />
            <span class="error-text">Нужно заполнить</span>
	</div>
	<div class="row">
            <label for="input003">Отчество</label>
            <input type="text" class="input-text" id="input003" />
            <span class="error-text">Нужно заполнить</span>
	</div>
        <?// ********************* User properties ***************************************************?>
<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	
	<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
	<div class="row">
		<label for="input003"><?=$arUserField["EDIT_FORM_LABEL"]?><?if ($arUserField["MANDATORY"]=="Y"):?><span class="required">*</span><?endif;?></label>
			<?$APPLICATION->IncludeComponent(
				"bitrix:system.field.edit",
				$arUserField["USER_TYPE"]["USER_TYPE_ID"],
				array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "bform"), null, array("HIDE_ICONS"=>"Y"));?>
	</div>
                                    <?endforeach;?>
<?endif;?>
<?// ******************** /User properties ***************************************************?>

	<div class="row">
            <label for="input004">Электронная почта*</label>
            <input type="text" name="USER_EMAIL" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" class="input-text" id="input004" />
            <span class="error-text">Нужно заполнить</span>
	</div>
        <div class="row">
            <label for="input005">Пароль*</label>
            <input type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" class="input-text" id="input005" />
            <span class="error-text">Нужно заполнить</span>
	</div>
	<div class="row">
            <label for="input006">Повторите пароль*</label>
            <input type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="input-text" id="input006" />
            <span class="error-text">Нужно заполнить</span>
	</div>
	            <?	if ($arResult["USE_CAPTCHA"] == "Y")
	{
		?>
		<div class="hold">
                <?=GetMessage("CAPTCHA_REGF_TITLE")?>
				<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" /><br />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
		</div>	
			<div class="row"><label for="captcha_word">Проверочный код*</label><input type="text" name="captcha_word" id="captcha_word" class="input-text" maxlength="50" value="" />
                        </div>
		
		<?
	}
	/* CAPTCHA */?>
            <span class="submit">
                <input type="submit" name="Register" class="btn" value="Зарегистрироваться" />
                <span class="r"></span>
            </span>
            <p><a href="http://www.consultant.ru/popular/o-personalnyh-dannyh/" target="_blank">Закон о персональных данных</a></p>
	
<p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>



<p>
<a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><b>Войти в личный кабинет</b></a>
</p>

</form>
</noindex>

<?endif?>
</div>
</div>
<!-- sidebar-right -->
<div id="sidebar">
 <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?>
</div>