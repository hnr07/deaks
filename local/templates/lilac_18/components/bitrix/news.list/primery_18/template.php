<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="list_a">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem){?>
	<?//echo "<pre>";print_r($arItem);echo "</pre>";?>
	<?$example_link=$arItem["PROPERTIES"]["example_link"]["VALUE"];?>
	<?if($arItem["PROPERTIES"]["new_win"]["VALUE_XML_ID"]=="Y") $new_win="_blank";
	else $new_win="_self";?>
	<div class="p_text">
		<?if($example_link){?><a href="<?=$example_link?>" target="<?=$new_win?>"><?}?>
			<b><?echo $arItem["NAME"]?></b>
		<?if($example_link){?></a><?}?>
		<hr>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]){?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?}?>
		 <br>
		 <?if($example_link){?>
			<a href="<?=$example_link?>" target="<?=$new_win?>"><button>Открыть &gt;&gt;&gt;</button></a>
		 <?}?>
	</div>

<?};?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
