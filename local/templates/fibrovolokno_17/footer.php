<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>

		</div>
	</div>

<div class="footer">
	<div class="footer_map">
	<?
	$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	"fv_y_map", 
	array(
		"CONTROLS" => array(
			0 => "SMALLZOOM",
			1 => "MINIMAP",
			2 => "TYPECONTROL",
			3 => "SCALELINE",
		),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.81609356290878;s:10:\"yandex_lon\";d:37.68138031249256;s:12:\"yandex_scale\";i:12;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.68051208495797;s:3:\"LAT\";d:55.82081585796871;s:4:\"TEXT\";s:70:\"г. Москва ул. *****, д. **###RN###Тел.: +7(***) ***-**-**\";}}}",
		"MAP_HEIGHT" => "445",
		"MAP_ID" => "yam_1",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(
			0 => "ENABLE_DBLCLICK_ZOOM",
			1 => "ENABLE_DRAGGING",
		),
		"COMPONENT_TEMPLATE" => "fv_y_map"
	),
	false
);?>
	</div>
	<div class="footer_bottom">
	
		<div class="copyright">
			<?
			$APPLICATION->IncludeFile(
				SITE_DIR."/fibrovolokno/include/copyright.php",
				Array(),
				Array("MODE"=>"html")
			);
			?>
		</div>
		<div class="soc_set">
			<?
			$APPLICATION->IncludeFile(
				SITE_DIR."/fibrovolokno/include/soc_set.php",
				Array(),
				Array("MODE"=>"html")
			);
			?>
		</div>
	</div>
</div>
</body>
</html>