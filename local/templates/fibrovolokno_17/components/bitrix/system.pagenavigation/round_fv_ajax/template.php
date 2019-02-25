<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

$colorSchemes = array(
	"green" => "bx-green",
	"yellow" => "bx-yellow",
	"red" => "bx-red",
	"blue" => "bx-blue",
);
if(isset($colorSchemes[$arParams["TEMPLATE_THEME"]]))
{
	$colorScheme = $colorSchemes[$arParams["TEMPLATE_THEME"]];
}
else
{
	$colorScheme = "";
}
?>
<?
//echo "<pre>";print_r($arResult);echo "</pre>";
if($arResult["add_anchor"]) $add_anchor=$arResult["add_anchor"];
else $add_anchor="";
?>
<div class="bx-pagination color_fv<?//=$colorScheme?>">
	<div class="bx-pagination-container row">
		<ul>

			<?if ($arResult["NavPageNomer"] > 1):?>
				<?if($arResult["bSavePage"]):?>
					<li class="bx-pag-prev"><div class="aaj" PAGEN_<?=$arResult["NavNum"]?>="<?=($arResult["NavPageNomer"]-1)?>"><span><?echo GetMessage("round_nav_back")?></span></div></li>
					<li class=""><div class="aaj" PAGEN_<?=$arResult["NavNum"]?>="1"><span>1</span></div></li>
				<?else:?>
					<?if ($arResult["NavPageNomer"] > 2):?>
						<li class="bx-pag-prev"><div class="aaj" PAGEN_<?=$arResult["NavNum"]?>="<?=($arResult["NavPageNomer"]-1)?>"><span><?echo GetMessage("round_nav_back")?></span></div></li>
					<?else:?>
						<li class="bx-pag-prev"><div><span><?echo GetMessage("round_nav_back")?></span></div></li>
					<?endif?>
					<li class=""><div><span>1</span></div></li>
				<?endif?>
			<?else:?>
					<li class="bx-pag-prev"><span><?echo GetMessage("round_nav_back")?></span></li>
					<li class="bx-active"><span>1</span></li>
			<?endif?>

			<?
			$arResult["nStartPage"]++;
			while($arResult["nStartPage"] <= $arResult["nEndPage"]-1):
			?>
				<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
					<li class="bx-active"><span><?=$arResult["nStartPage"]?></span></li>
				<?else:?>
					<li class=""><div class="aaj" PAGEN_<?=$arResult["NavNum"]?>="<?=$arResult["nStartPage"]?>"><span><?=$arResult["nStartPage"]?></span></div></li>
				<?endif?>
				<?$arResult["nStartPage"]++?>
			<?endwhile?>

			<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
				<?if($arResult["NavPageCount"] > 1):?>
					<li class=""><div class="aaj" PAGEN_<?=$arResult["NavNum"]?>="<?=$arResult["NavPageCount"]?>"><span><?=$arResult["NavPageCount"]?></span></div></li>
				<?endif?>
					<li class="bx-pag-next"><div class="aaj" PAGEN_<?=$arResult["NavNum"]?>="<?=($arResult["NavPageNomer"]+1)?>"><span><?echo GetMessage("round_nav_forward")?></span></div></li>
			<?else:?>
				<?if($arResult["NavPageCount"] > 1):?>
					<li class="bx-active"><span><?=$arResult["NavPageCount"]?></span></li>
				<?endif?>
					<li class="bx-pag-next"><span><?echo GetMessage("round_nav_forward")?></span></li>
			<?endif?>

		</ul>
		<div style="clear:both"></div>
	</div>
</div>
