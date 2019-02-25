<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?global $link_start; $link_start='';?>
<?if (!empty($arResult)):?>
	<ul id="top-menu">
<?foreach($arResult as $arItem):?>
	<?if ($arItem["PERMISSION"] > "D"):?>
	<?if($link_start=='') $link_start=$arItem["LINK"]?>
		<li <?if ($arItem["SELECTED"]):?> class="selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span></a></li>
	<?endif?>
<?endforeach?>

	</ul>
<?endif?>