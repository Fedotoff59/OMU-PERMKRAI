<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>

<? $key = 0; ?>

<div class="call_container">

	<span class="call"><?=$arParams["CALL_TEXT"]?></span>

	<div class="call_popup type<?=$arParams['VIEW_TYPE']?><?if(!empty($arResult["ERROR_MESSAGE"]) || strlen($arResult["OK_MESSAGE"])>0):?> vis<?else:?> hid<?endif;?>">

		<div class="arrow"></div>

		<div class="response">

		<?if(!empty($arResult["ERROR_MESSAGE"]['NO_EVENT_TYPE'])):?>

			<p class="errtext"><?=$arResult["ERROR_MESSAGE"]['NO_EVENT_TYPE']?></p>

		<?elseif(strlen($arResult["OK_MESSAGE"]) > 0):?>

			<p class="oktext"><?=$arResult["OK_MESSAGE"]?></p>

		<?endif;?>

		</div>

		<form action="<?=$APPLICATION->GetCurPage()?>" method="POST" onsubmit="return CheckFields();">

			<table class="form_table<?if(strlen($arResult["OK_MESSAGE"]) > 0):?> hid<?endif;?>">

				<?foreach($arResult['FIELDS'] as $arField):?>

				<? $key++; ?>

					<tr>

						<td class="input">

							<label><?=$arField['TITLE']?><? if($key != 1) echo ":"; ?><?if($arField['REQUIRED']=='Y'):?> <font color="e60505">*</font><?endif;?></label>

							<input type="text" name="<?=$arField['NAME']?>" class="text<?if($arField['REQUIRED']=='Y'):?> required<?endif;?>" value="<?if($arField['VALUE']): echo $arField['VALUE'];endif;?>" />

						</td>

					</tr>

				<?endforeach;?>

				<?if($arParams["USE_CAPTCHA"] == "Y"):?>

				<tr>

					<td class="input">

						<label><?=GetMessage('CAPTCHA')?>:<font color="e60505"> *</font></label>

						<input type="text" name="captcha_word" style="text-transform: uppercase;" class="text required<?if($arResult['ERROR_MESSAGE']['CAPTCHA']):?> err<?endif;?>" value="" />

						<img class="captcha_img" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" alt="CAPTCHA">

						<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">

					</td>

				</tr>

				<?endif;?>

				<tr>

					<td align="center" class="input">

						<input type="hidden" name="send" value="Y" />

						<input type="submit" class="grey_btn" value="<?=GetMessage('SUBMIT')?>" />

					</td>

				</tr>

			</table>

		</form>

		<div class="close"></div>

	</div>

</div>