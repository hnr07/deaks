<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(count($arResult["ITEMS"]) < 1)
	return;?>

<!--<div class="h3"><?=GetMessage("JOIN_US")?></div>-->
<ul class="join_us">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<li>
			<?if(!empty($arItem["DISPLAY_PROPERTIES"]["URL"])):?>
				<a target="_blank" href="<?=$arItem['DISPLAY_PROPERTIES']['URL']['VALUE']?>" rel="nofollow">
			<?else:?>
				<a href="javascript:void(0)" title="<?=$arItem['NAME']?>">
			<?endif;?>			
				<div class="dico <?=(!empty($arItem['DISPLAY_PROPERTIES']['ICON']['VALUE'])) ? ' '.$arItem['DISPLAY_PROPERTIES']['ICON']['VALUE'] : ''?>" title="<?=$arItem['DISPLAY_PROPERTIES']['ICON_TITLE']['VALUE']?>"></div>
			</a>
		</li>
	<?endforeach;?>
</ul>