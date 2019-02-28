<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;
?>
aaaaaaaaaaaa
<?



?>
<div class="product_detail_box">
	
	
		<div class="h_box h_box_1">
		<?echo "Params>><pre>";print_r($arParams);echo "</pre>";?>
		<div class="slider_picture">
			<?foreach($arResult["ELEMENT"]["PICTURE"] as $src) {?>
				<div class="el_img" style="background-image:url('<?=$src?>')"><img src="<?=$src?>"></div>
			<?}?>
		
		</div>
		</div>
		<div class="h_box h_box_2">
				<?echo "Result>><pre>";print_r($arResult);echo "</pre>";?>
		</div>
		<div class="h_box h_box_3">
			<?=$arResult["ELEMENT"]["DETAIL_TEXT"]?>
		</div>
	
</div>