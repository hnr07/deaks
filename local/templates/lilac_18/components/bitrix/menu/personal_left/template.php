<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<ul id="user-menu">
<?foreach($arResult as $arItem):?>
	<?if ($arItem["PERMISSION"] > "D"):?>
		<li<?if ($arItem["SELECTED"]):?> class="selected"<?endif?>><a href="<?=$arItem["LINK"]?>" target="<?=$arItem["PARAMS"]["target"]?>"><?=$arItem["TEXT"]?></a></li>
	<?endif?>
<?endforeach?>

	</ul>
<?endif?>