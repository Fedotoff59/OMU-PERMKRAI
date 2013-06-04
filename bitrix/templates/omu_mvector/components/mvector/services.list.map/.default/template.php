<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
				<div class="btn-row2">
					<a href="#" class="submit2" id="chose-radio-service-link"><span><span>Выбор услуги</span></span></a>
					<?if (isset($arResult['SERVICE_NAME'])):?>
                                        <a href="<?=$arResult['SERVICE_LINK']?>" class="choose"><span><?=$arResult['SERVICE_NAME']?></span></a>
                                        <?endif;?>
				</div>
