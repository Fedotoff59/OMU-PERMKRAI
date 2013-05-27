<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if ($arResult["FORM_TYPE"] == "login"):?>


<ul class="r-list">
    <li class="login">
        <a href="#">Войти в личный кабинет </a>
        <div class="drop">
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
		<span class="submit">
                    <input type="submit" class="btn" name="Login" value="Войти в личный кабинет" />
                    <span class="r"></span>
		</span>
            </form>
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