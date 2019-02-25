<?
if(isset($_REQUEST["PAGEN_1"])) require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?
//echo "<pre>";print_r($_REQUEST);echo "</pre>";
$PARENT_ID=$_REQUEST["PARENT_ID"];
$SECTION_ID=$_REQUEST["SECTION_ID"];
$PAGEN_1=$_REQUEST["PAGEN_1"];

if($PARENT_ID) {
	if($SECTION_ID) {
		$ar_tov_all=$_SESSION["EL_FIB"]["tov"][$SECTION_ID];
	}
	else {
		foreach($_SESSION["EL_FIB"]["tov"] as $pk0 => $pv0) {
			foreach($pv0 as $tval) {
				if($tval["section_0"]==$PARENT_ID) $ar_tov_all[$tval["ID"]]=$tval;
			}
		}
	}
}
else {
	foreach($_SESSION["EL_FIB"]["tov"] as $pk0 => $pv0) {
		foreach($pv0 as $tval) {
			$ar_tov_all[$tval["ID"]]=$tval;
		}
	}
}

$e_count=count($ar_tov_all);

// Включение рекламы
if($PARENT_ID) {
	if($SECTION_ID) $id_u=$SECTION_ID;
	else $id_u=$PARENT_ID;
}
else $id_u=0;
foreach($_SESSION["EL_FIB"]["ad_unit"] as $ku => $vu) {
	if($id_u) {
		if(in_array($id_u, $vu["to_section"]) || !is_array($vu["to_section"])) {
			$ar_ad_unit[$ku]["NAME"]=$vu["NAME"];
			$ar_ad_unit[$ku]["PREVIEW_PICTURE_SRC"]=$vu["PREVIEW_PICTURE_SRC"];
			$ar_ad_unit[$ku]["PREVIEW_TEXT"]=$vu["PREVIEW_TEXT"];
			$ar_ad_unit[$ku]["url"]=$vu["url"];
		}
	}
	else{
		$ar_ad_unit[$ku]["NAME"]=$vu["NAME"];
		$ar_ad_unit[$ku]["PREVIEW_PICTURE_SRC"]=$vu["PREVIEW_PICTURE_SRC"];
		$ar_ad_unit[$ku]["PREVIEW_TEXT"]=$vu["PREVIEW_TEXT"];
		$ar_ad_unit[$ku]["url"]=$vu["url"];
	}
}
//echo "<pre>";print_r($ar_ad_unit);echo "</pre>";
if(count($ar_ad_unit)>0) {
	if($_SESSION["page_nav"]["countOnPage"]>0) $op=ceil($e_count/$_SESSION["page_nav"]["countOnPage"]);
	else $op=1;
	$kp=0;
	for($i=0;$i<$op;$i++){
		$ar_nmr[]=$_SESSION["page_nav"]["index_ad_unit"]+$kp;
		$kp+=$_SESSION["page_nav"]["countOnPage"];
	}

	foreach($ar_nmr as $nmr) {
		$inserted=array(array("TYPE"=>"ad_unit"));
		array_splice( $ar_tov_all, $nmr, 0, $inserted );
		$e_count++;
	}
}
//echo "<pre>";print_r($ar_nmr);echo "</pre>";
//echo "<pre>";print_r($ar_tov_all);echo "</pre>";
//echo "<pre>";print_r($_SESSION["EL_FIB"]["tov"]);echo "</pre>";
//echo "<pre>";print_r($_SESSION["EL_FIB"]);echo "</pre>";
if(!$PAGEN_1) $PAGEN_1=1;
if($_SESSION["page_nav"]["countOnPage"]>0) $countOnPage=$_SESSION["page_nav"]["countOnPage"];
else $countOnPage=$e_count;

$p_count=ceil($e_count/$countOnPage);
$add_anchor='#box_top';
$page = intval($PAGEN_1);

$ar_tov = array_slice($ar_tov_all, (($page-1) * $countOnPage), $countOnPage);
$navResult = new CDBResult();
$navResult->NavPageCount = $p_count;
$navResult->NavPageNomer = $page;
$navResult->NavNum = 1;
$navResult->NavPageSize = $countOnPage;
$navResult->NavRecordCount = $e_count;
$navResult->add_anchor = $_SESSION["page_nav"]["add_anchor"];

//echo "<pre>";print_r($ar_tov);echo "</pre>";
?>

<?foreach($ar_tov as $val_t) {?>
	
		<?if($val_t["TYPE"]=="ad_unit") {?>
			<?$rand_keys = array_rand($ar_ad_unit);?>
			<a href="<?=$ar_ad_unit[$rand_keys]["url"]?>" target="_blank"><div class="ad_unit" style="background-image: url('<?=$ar_ad_unit[$rand_keys]["PREVIEW_PICTURE_SRC"]?>');" title="<?=$ar_ad_unit[$rand_keys]["PREVIEW_TEXT"]?>"></div></a>
		<?} else {?>
			<div class="elo" id_elem="<?=$val_t["ID"]?>">
				<!--<a href="#">-->
					<button type="button" class="go_shop ah_shop cart" in_cart="N"></button>
				<!--</a>-->
				<div class="img" style="background-image: url('<?=$val_t["PREVIEW_PICTURE_SRC"]?>');" title="Подробно"></div>
				<?if($val_t["PROPERTY_IN_STOCK_VALUE"]=="Да") {?>
					<div class="in_stock">В наличии</div>
				<?}?>
				
				<div class="name_before"><?=$val_t["PROPERTY_NAME_BEFORE_VALUE"]?></div>
				<div class="name" title="Подробно"><?=$val_t["NAME"]?></div>
				<?if($val_t["PROPERTY_SIZE_VALUE"]) {?>
					<div class="size"><?=$val_t["PROPERTY_SIZE_VALUE"]?> мм</div>
				<?}?>
				<div class="preview_text"><?=$val_t["PREVIEW_TEXT"]?></div>
				<?if($val_t["PROPERTY_PRICE_VALUE"]) {?>
					<div class="price" price=<?=$val_t["PROPERTY_PRICE_VALUE"]?>><?=$val_t["PROPERTY_PRICE_VALUE"]?> <div class="rur">q</div> <span>/<?=$val_t["PROPERTY_UNIT_VALUE"]?></span></div>
				<?}?>
				<?if($val_t["PROPERTY_PRICE_PACKING_VALUE"]) {?>
					
					<div class="price_packing" price_packing=<?=$val_t["PROPERTY_PRICE_PACKING_VALUE"]?>><?=$val_t["PROPERTY_PRICE_PACKING_VALUE"]?> <div class="rur">q</div> <span>/уп - <?=$val_t["PROPERTY_PACKING_VALUE"]?> <?=$val_t["PROPERTY_UNIT_VALUE"]?></span></div>					
				<?}?>
				<div class="detail_box">
					<div class="top_left">
						<div class="d_name_before"><?=$val_t["PROPERTY_NAME_BEFORE_VALUE"]?></div>
						<div class="d_name"><?=$val_t["NAME"]?></div>
						<div class="d_name_after"><?=$val_t["PROPERTY_NAME_AFTER_VALUE"]?></div>
						<?if($val_t["PROPERTY_SIZE_VALUE"]) {?>
							<div class="size"><?=$val_t["PROPERTY_SIZE_VALUE"]?> мм</div>
						<?}?>
					</div>
					<div class="top_right">
						<?if($val_t["PROPERTY_PRICE_VALUE"]) {?>
							<div class="d_price">
									<?=$val_t["PROPERTY_PRICE_VALUE"]?> <div class="rur">q</div> <span>/<?=$val_t["PROPERTY_UNIT_VALUE"]?></span>
									<?if($val_t["PROPERTY_PRICE_PACKING_VALUE"]) {?>
										<div class="d_price_packing"><?=$val_t["PROPERTY_PRICE_PACKING_VALUE"]?> <div class="rur">q</div> <span>уп/ - <?=$val_t["PROPERTY_PACKING_VALUE"]?> <?=$val_t["PROPERTY_UNIT_VALUE"]?></span></div>
									<?}?>
								</div>
						<?}?>
						<!--<a href="#">-->
							<button type="button" class="d_go_shop ah_shop" in_cart="N">Купить <div class="cart"></div></button>
						<!--</a>-->
						
					</div>
					<div class="detail_text"><?=$val_t["DETAIL_TEXT"]?></div>
					
					<?if(is_array($val_t["PROPERTY_FEATURES_VALUE"])) {?>
					
						<div class="features"><div class="d_tit">Особенности и преимущества</div><?=$val_t["PROPERTY_FEATURES_VALUE"]["TEXT"]?></div>
					<?}?>
					<?if(is_array($val_t["PROPERTY_FORMS_APPLICATION_VALUE"])) {?>
					<div class="both"></div>
						<div class="form_application"><div class="d_tit">Основные формы применения</div><?=$val_t["PROPERTY_FORMS_APPLICATION_VALUE"]["TEXT"]?></div>
					<?}?>
					<div class="bottom">
						<?if($val_t["PROPERTY_SPECIFICATION_VALUE"]) {?>
							<a href="<?=$val_t["PROPERTY_SPECIFICATION_VALUE"]?>" class="specification" download>Скачать<br />Спецификацию</a>
						<?}?>
						<?if($val_t["PROPERTY_LOGO_VALUE"]) {?>
							<div class="logo"  style="background-image: url('<?=$val_t["PROPERTY_LOGO_VALUE"]?>');"></div>
						<?}?>
						
					</div>
				</div>
			</div>
		<?}?>
	
<?}?>
<div class="page_nav">
	<?$APPLICATION->IncludeComponent("bitrix:system.pagenavigation", "round_fv_ajax", array("NAV_RESULT" => $navResult,));?>
</div>
<?if(isset($_REQUEST["PAGEN_1"])) require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>