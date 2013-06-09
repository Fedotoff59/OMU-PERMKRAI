<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>
<div id="content">
<div class="bx-auth-profile">

<?ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<script type="text/javascript">
<!--
var opened_sections = [<?
$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
if (strlen($arResult["opened"]) > 0)
{
	echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
}
else
{
	$arResult["opened"] = "reg";
	echo "'reg'";
}
?>];
//-->

var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
</script>
<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data" class="registration">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("REG_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('reg')"><?=GetMessage("REG_SHOW_HIDE")?></a></div>
<div class="profile-block-<?=strpos($arResult["opened"], "reg") === false ? "hidden" : "shown"?>" id="user_div_reg">
<table class="profile-table data-table">
	<thead>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td><?=GetMessage('NAME')?></td>
		<td><div class="row"><input type="text" name="NAME" maxlength="50" class="input-text" value="<?=$arResult["arUser"]["NAME"]?>" /></div></td>
	</tr>
	<tr>
		<td><?=GetMessage('LAST_NAME')?></td>
		<td><div class="row"><input type="text" name="LAST_NAME" maxlength="50" class="input-text" value="<?=$arResult["arUser"]["LAST_NAME"]?>" /></div></td>
	</tr>
	<tr>
		<td><?=GetMessage('SECOND_NAME')?></font></td>
		<td><div class="row"><input type="text" name="SECOND_NAME" maxlength="50" class="input-text" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" /></div></td>
	</tr>
	<tr>
		<td><?=GetMessage('EMAIL')?><span class="starrequired">*</span></td>
		<td><div class="row"><input type="text" name="EMAIL" maxlength="50" class="input-text" value="<? echo $arResult["arUser"]["EMAIL"]?>" /></div></td>
	</tr>
	<tr>
		<td><?=GetMessage('LOGIN')?><span class="starrequired">*</span></td>
		<td><div class="row"><input type="text" name="LOGIN" maxlength="50" class="input-text" class="input-text" value="<? echo $arResult["arUser"]["LOGIN"]?>" /></div></td>
	</tr>
<?if($arResult["arUser"]["EXTERNAL_AUTH_ID"] == ''):?>
	<tr>
		<td><?=GetMessage('NEW_PASSWORD_REQ')?></td>
		<td><div class="row"><input type="password" name="NEW_PASSWORD" maxlength="50" class="input-text" value="" autocomplete="off" class="bx-auth-input" />
<?if($arResult["SECURE_AUTH"]):?>
				<!--<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>-->
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = 'inline-block';
</script>
		</div></td>
	</tr>
<?endif?>
	<tr>
		<td><?=GetMessage('NEW_PASSWORD_CONFIRM')?></td>
		<td><div class="row"><input type="password" class="input-text" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" /></div></td>
	</tr>
<?endif?>
	</tbody>
</table>
</div>
<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('personal')"><?=GetMessage("USER_PERSONAL_INFO")?></a></div>
<div id="user_div_personal" class="profile-block-<?=strpos($arResult["opened"], "personal") === false ? "hidden" : "shown"?>">
<table class="data-table profile-table">
	<thead>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?=GetMessage('USER_PROFESSION')?></td>
			<td><div class="row"><input type="text" name="PERSONAL_PROFESSION" maxlength="255" class="input-text" value="<?=$arResult["arUser"]["PERSONAL_PROFESSION"]?>" /></div></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_GENDER')?></td>
			<td><div class="row"><select name="PERSONAL_GENDER">
				<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
				<option value="M"<?=$arResult["arUser"]["PERSONAL_GENDER"] == "M" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("USER_MALE")?></option>
				<option value="F"<?=$arResult["arUser"]["PERSONAL_GENDER"] == "F" ? " SELECTED=\"SELECTED\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
			</select></div></td>
		</tr>
		<tr>
			<td><?=GetMessage("USER_BIRTHDAY_DT")?> (<?=$arResult["DATE_FORMAT"]?>):</td>
			<td><?
			$APPLICATION->IncludeComponent(
				'bitrix:main.calendar',
				'',
				array(
					'SHOW_INPUT' => 'Y',
					'FORM_NAME' => 'form1',
					'INPUT_NAME' => 'PERSONAL_BIRTHDAY',
					'INPUT_VALUE' => $arResult["arUser"]["PERSONAL_BIRTHDAY"],
					'SHOW_TIME' => 'N'
				),
				null,
				array('HIDE_ICONS' => 'Y')
			);

			//=CalendarDate("PERSONAL_BIRTHDAY", $arResult["arUser"]["PERSONAL_BIRTHDAY"], "form1", "15")
			?></td>
		</tr>
		
	</tbody>
</table>
</div>

<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('work')"><?=GetMessage("USER_WORK_INFO")?></a></div>
<div id="user_div_work" class="profile-block-<?=strpos($arResult["opened"], "work") === false ? "hidden" : "shown"?>">
<table class="data-table profile-table">
	<thead>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?=GetMessage('USER_COMPANY')?></td>
			<td><div class="row"><input type="text" name="WORK_COMPANY" maxlength="255" class="input-text" value="<?=$arResult["arUser"]["WORK_COMPANY"]?>" /></div></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_WWW')?></td>
			<td><div class="row"><input type="text" name="WORK_WWW" maxlength="255" class="input-text" value="<?=$arResult["arUser"]["WORK_WWW"]?>" /></div></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_DEPARTMENT')?></td>
			<td><div class="row"><input type="text" name="WORK_DEPARTMENT" maxlength="255" class="input-text" value="<?=$arResult["arUser"]["WORK_DEPARTMENT"]?>" /></div></td>
		</tr>
		<tr>
			<td><?=GetMessage('USER_POSITION')?></td>
			<td><div class="row"><input type="text" name="WORK_POSITION" maxlength="255" class="input-text" value="<?=$arResult["arUser"]["WORK_POSITION"]?>" /></div></td>
		</tr>
		<tr>
			<td><?=GetMessage("USER_WORK_PROFILE")?></td>
			<td><textarea cols="30" rows="5" name="WORK_PROFILE"><?=$arResult["arUser"]["WORK_PROFILE"]?></textarea></td>
		</tr>
		
	</tbody>
</table>
</div>

	<?if($arResult["IS_ADMIN"]):?>
	<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('admin')"><?=GetMessage("USER_ADMIN_NOTES")?></a></div>
	<div id="user_div_admin" class="profile-block-<?=strpos($arResult["opened"], "admin") === false ? "hidden" : "shown"?>">
	<table class="data-table profile-table">
		<thead>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?=GetMessage("USER_ADMIN_NOTES")?>:</td>
				<td><textarea cols="30" rows="5" name="ADMIN_NOTES"><?=$arResult["arUser"]["ADMIN_NOTES"]?></textarea></td>
			</tr>
		</tbody>
	</table>
	</div>
	<?endif;?>
	<?// ********************* User properties ***************************************************?>
	<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('user_properties')"><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></a></div>
	<div id="user_div_user_properties" class="profile-block-<?=strpos($arResult["opened"], "user_properties") === false ? "hidden" : "shown"?>">
	<table class="data-table profile-table">
		<thead>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</thead>
		<tbody>
		<?$first = true;?>
		<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
		<tr><td class="field-name">
			<?if ($arUserField["MANDATORY"]=="Y"):?>
				<span class="starrequired">*</span>
			<?endif;?>
			<?=$arUserField["EDIT_FORM_LABEL"]?>:</td><td class="field-value">
				<?$APPLICATION->IncludeComponent(
					"bitrix:system.field.edit",
					$arUserField["USER_TYPE"]["USER_TYPE_ID"],
					array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
		<?endforeach;?>
		</tbody>
	</table>
	</div>
	<?endif;?>
	<?// ******************** /User properties ***************************************************?>
	<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
	<span class="submit">
<input type="submit" name="save" class="btn" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">
<span class="r"></span>
</span>
        <span class="submit">
<input type="reset" class="btn" value="<?=GetMessage('MAIN_RESET');?>">
<span class="r"></span>
</span>
</form>
<?
if($arResult["SOCSERV_ENABLED"])
{
	$APPLICATION->IncludeComponent("bitrix:socserv.auth.split", ".default", array(
			"SHOW_PROFILES" => "Y",
			"ALLOW_DELETE" => "Y"
		),
		false
	);
}
?>
</div>
    </div>
<div id="sidebar"> <?$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/sidebar_right.php", Array(), Array());?> </div>