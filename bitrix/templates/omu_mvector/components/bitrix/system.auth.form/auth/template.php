<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arResult["FORM_TYPE"] == "login"):?>

<ul class="r-list">
    <li class="login">
        <div class="login-box">
        <a href="#" class="open">Войти в личный кабинет </a>
        <div class="drop">
                <?if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR']) 
                ShowMessage($arResult['ERROR_MESSAGE']);?>
            <form method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
                <?
                if (strlen($arResult["BACKURL"]) > 0)
                {
                ?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?
                }
                ?>
                <?
                foreach ($arResult["POST"] as $key => $value)
                {
                ?>
                <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                <?
                }
                ?>
                <input type="hidden" name="AUTH_FORM" value="Y" />
                <input type="hidden" name="TYPE" value="AUTH" />
                <label for="input1">Имя пользователя</label>
		<div class="input">
                    <input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" size="17" />
		</div>
		<a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" class="pass-link">Напомнить пароль</a>
		<label for="input2">Пароль</label>
		<div class="input">
                    <input type="password" name="USER_PASSWORD" maxlength="50" size="17" />
		</div>
                <?if ($arResult["CAPTCHA_CODE"]):?>   
			<label for="input3">Введите буквы с картинки:</label>
                        
			<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" style="margin-bottom: 12px;" />
                        <div class="input">
                            <input type="text" name="captcha_word" maxlength="5" value="" size="17" />
                        </div>
                <?endif;?>
		<span class="submit">
                    <input type="submit" class="btn" name="Login" value="Войти в личный кабинет" />
                    <span class="r"></span>
		</span>
            </form>
	</div>
        </div>
    </li>
    <li><a href="<?=$arResult["AUTH_REGISTER_URL"]?>">Зарегистрироваться</a></li>



</ul>

<?else:?>

<form id="logout-form" action="<?=$arResult["AUTH_URL"]?>">

<?foreach ($arResult["GET"] as $key => $value):?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>
	<input type="hidden" name="logout" value="yes" />

</form>
<div class="user-r">
    <a id="logout-link" href="javascript:void(0)">выйти</a>
    <span><a href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><?=$arResult["USER_NAME"]?></a></span>
</div>
<?endif?>