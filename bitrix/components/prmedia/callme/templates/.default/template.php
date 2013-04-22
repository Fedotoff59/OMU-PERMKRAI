<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>

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
					<tr>
						<td class="input">
							<input data-required="<?if($arField['REQUIRED']=='Y'): echo 1; else: echo 0; endif;?>" data-default="<?= $arField['TITLE'] ?>" type="text" name="<?=$arField['NAME']?>" class="text<?if($arField['REQUIRED']=='Y'):?> required<?endif;?>" value="<?if($arField['VALUE']): echo $arField['VALUE']; else: echo $arField['TITLE']; endif;?>" />
						</td>
					</tr>
				<?endforeach;?>
				
				<tr>
					<td class="empty">
					</td>
				</tr>
				<?if($arParams["USE_CAPTCHA"] == "Y"):?>
				<tr>
					<td class="input">
						<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
						<input id="captcha" data-required="1" data-default="<?=GetMessage('MFT_CAPTCHA')?>" type="text" style="text-transform: uppercase;" name="captcha_word" class="text required<?if($arResult['ERROR_MESSAGE']['CAPTCHA']):?> err<?endif;?>" value="<?if($arResult['ERROR_MESSAGE']['CAPTCHA']):?><?else:?><?=GetMessage('MFT_CAPTCHA')?><? endif; ?>" />
						<img class="captcha_img" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" alt="CAPTCHA">
					</td>
				</tr>
				<tr>
					<td class="empty">
					</td>
				</tr>
				<?endif;?>
				<tr valign="center">
					<td align="center" class="input">
						<input type="hidden" name="send" value="Y" />
						<input type="submit" class="blue_btn" value="<?=GetMessage('SUBMIT')?>" />
					</td>
				</tr>
			</table>
		</form>
		<div class="close"></div>
	</div>
</div>