<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?global $ar_fres;?>
<script>
$(document).ready(function(){
	jQuery("a.fancybox").fancybox();
	$("a.fancybox").fancybox();
});
</script>
<div class="portfolio">

<?if($arParams["DISPLAY_TOP_PAGER"]){?>
	<?=$arResult["NAV_STRING"]?><br />
<?}?>
<div class="portfolio-list">
	<?foreach($ar_fres["Y"] as $arItem){?>

		<div class="box_pos">
			<div class="picture" style="background-image: url('<?=$arItem["PREVIEW_PICTURE"]?>');">
				<a class="fancybox" href="<?=$arItem["PREVIEW_PICTURE"]?>" data-fancybox-group="gallery" title="<?=$arItem["NAME"]?>"></a>
			</div>
			
			<div class="name">
				<?=$arItem["NAME"]?>
			</div>
			<a href="<?=$arItem["site"]?>" target="_blank">
				<i class="fa fa-globe"></i> <?=$arItem["site"]?>
			</a>
			
			<div class="note">
				<?=$arItem["PREVIEW_TEXT"]?>
			</div>
			<?if($arItem["primer"]) {?>
			<a href="<?=$arItem["primer"]?>" target="_blank">
				<i class="fa fa-desktop"></i> смотреть пример >>>
			</a>
			<?}?>
		</div>

	<?}?>
</div>
<br /><br />
<i class="fa fa-frown-o"> Следующие сайты больше не используются</i>

<div class="portfolio-list">

	<?foreach($ar_fres["N"] as $arItem){?>

		<div class="box_pos">
			<div class="picture" style="background-image: url('<?=$arItem["PREVIEW_PICTURE"]?>');">
				<a class="fancybox" href="<?=$arItem["PREVIEW_PICTURE"]?>" data-fancybox-group="gallery" title="<?=$arItem["NAME"]?>"></a>
			</div>
			
			<div class="name">
				<?=$arItem["NAME"]?>
			</div>
			<!--
			<a href="<?=$arItem["site"]?>" target="_blank">
				<i class="fa fa-globe"></i> <?=$arItem["site"]?>
			</a>
			-->
			<div class="note">
				<?=$arItem["PREVIEW_TEXT"]?>
			</div>
		</div>

	<?}?>
</div>
<br />
<?if($arParams["DISPLAY_BOTTOM_PAGER"]){?>
	<br /><?=$arResult["NAV_STRING"]?>
<?}?>

</div>
<br /><br /><br /><br />
