<?
if(isset($_REQUEST["PAGEN_1"])) require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?
	// Подключаем функции php
		$APPLICATION->IncludeFile(
			SITE_DIR."fibrovolokno/catalog/functions.php",
			Array(),
			Array("MODE"=>"html")
		);
		
   $arCalcConfig = array(
			'list_2' => array(
				'js' => SITE_DIR.'fibrovolokno/catalog/list_2.js',
				'css' => SITE_DIR.'fibrovolokno/catalog/list_2.css',//если требуется подтянуть еще и CSS
			),
		);
		foreach ($arCalcConfig as $ext => $arExt) {
			CJSCore::RegisterExt($ext, $arExt);
		}
CJSCore::Init (array('list_2'));


?>
<script>

$(document).ready(function() {

	$(".table_elo").on("click", ".ah_shop", function(){
		$(this).blur();
		var elo = $(this).closest(".elo");
		var in_cart=$(this).attr("in_cart");
		if(in_cart=="N") {
			var name_el = elo.children(".name").html();
			var price_el = elo.children(".price_packing").attr("price_packing");
			if(!$.isNumeric(price_el)) price_el=elo.children(".price").attr("price");
			var elo = $(this).closest(".elo");	
			var id_el = elo.attr("id_elem");
						
			//elo.find(".cart").removeClass("cart").addClass("chek");
			elo.find("[in_cart]").attr("in_cart","Y").removeClass("visible").addClass("hidden");
			
			elo.removeClass("def").addClass("add");
			elo.find(".calc_el").removeClass("none").addClass("block");
			d_sum(id_el,"N","N");
		}
		
		
	});
	$("body").on("click", "#show_mod_po", function(){
		$(".str_po .mod_po .note_ok").css({"display":"none"});
		$(".str_po .mod_po .mod_form").css({"display":"block"});
		$(".str_po").css({"display":"block"});
		$("html").css({"overflow": "hidden"});
		var itogo=$(".mod_po .listel [name=itogo]").val();
		var itogo_weight=$(".mod_po .listel [name=itogo_weight]").val();
		var itogo_qty=$(".mod_po .listel [name=itogo_qty]").val();
		var l_url="/fibrovolokno/orders/show_order.php";
		var l_data="show=Y&itogo="+itogo+"&itogo_weight="+itogo_weight+"&itogo_qty="+itogo_qty;
		$.ajax({  
			type: "POST",
			url: l_url,  
			data: l_data, 
			cache: false,  
			success: function(html){ 
				$("#elem_table").html(html);
				//alert(23);
			} 
		});
	});
	
	$("body").on("click", ".close, .d_carry", function(){
		$(".str_po").css({"display":"none"});
		$("html").css({"overflow": "auto"});
	});
	$("body").on("click", ".str_po .mod_po", function(){
		//e.stopPropagation();
	});
	
	
	$(".str_po .mod_po").on("change keyup input click", "input[name=phone_user]", function(){
		var a=$(this).val();
		$(this).val(a.replace(/[^0-9()+-]/g, ''));
	});
	$(".str_po .mod_po").on("click", "#new_capcha", function(){
		var s_url="/fibrovolokno/orders/new_capcha.php";
		$.ajax({  
                type: "POST",
                url: s_url,  
				data: "", 
                cache: false,  
                success: function(html){ 
					$(".div_capcha").html(html);
                } 
            });
	});
	
	$(".calc_el .calc_qty").on("click", ".plus", function(){
		var calc_el = $(this).closest(".calc_el");
		var id_el = calc_el.find("[name=id_elem]").val();
		var qty = calc_el.find("[name=qty]").val()*1;
		var price_packing = calc_el.find("[name=price_packing]").val()*1;
		calc_el.find("[name=qty]").val(qty+1);
		calc_el.find(".calc_qty input").val(qty+1).click();

		d_sum(id_el,"N","N");
	});
	$(".calc_el .calc_qty").on("click", ".minus", function(){
		var calc_el = $(this).closest(".calc_el");
		var id_el = calc_el.find("[name=id_elem]").val();
		var qty = calc_el.find("[name=qty]").val()*1;
		var price_packing = calc_el.find("[name=price_packing]").val()*1;
		if(qty>1) {
			calc_el.find("[name=qty]").val(qty-1);
			calc_el.find(".calc_qty input").val(qty-1).click();
		}
		else {
			calc_el.find("[name=qty]").val(1);
			calc_el.find(".calc_qty input").val(1).click();
		}

		d_sum(id_el,"N","N");
	});
	$(".calc_el").on("click", ".del", function(){
		var calc_el = $(this).closest(".calc_el");
		var id_el = calc_el.find("[name=id_elem]").val();
		calc_el.find("[name=qty]").val(1);
		calc_el.find(".calc_qty input").val(1);

		var elo = $(this).closest(".elo");
		//elo.find(".chek").removeClass("chek").addClass("cart");
		elo.find("[in_cart]").attr("in_cart","N").removeClass("hidden").addClass("visible");
		elo.removeClass("add").addClass("def");
		elo.find(".calc_el").removeClass("block").addClass("none");
			
		d_sum(id_el,"Y","N");
	});
	
	$(".calc_el .calc_qty").on("change keyup input click", "input", function(){
		var a=$(this).val();
		if(a=="0" || a=="") a="1";
		$(this).val(a.replace(/[^0-9]/g, ''));
		var calc_el = $(this).closest(".calc_el");
		var id_el = calc_el.find("[name=id_elem]").val();
		calc_el.find("[name=qty]").val(a.replace(/[^0-9]/g, ''));
		d_sum(id_el,"N","N");
		tin(id_el);	
	});
	
	
	
	var scrolled = false;
	var  pe=$(".mod_calc").offset();
	$(window).scroll(function() { 
		var scrollTop = $(window).scrollTop();
		
		if (scrollTop > pe.top){
			if(!scrolled) {
				$(".mod_calc").css({"position":"fixed", "left":pe.left}).addClass("box_shadow");
				$(".mod_calc .sel").addClass("box_shadow");
				scrolled = true;
			}
		}
		else {
			if(scrolled) {
				$(".mod_calc").css({"position":"absolute","left":""}).removeClass("box_shadow");
				$(".mod_calc .sel").removeClass("box_shadow");
				scrolled = false;
			}
		}

	});
	
	$(".dibox_in").on("focus", function() {
		$('.pos_a').each(function(i,elem) {
			if($(elem).next("input").val()=="") {$(this).removeClass("pos_a").addClass("pos_i");}
			//alert(11);
		});
		$(this).prev(".dibox_name").removeClass("pos_i").addClass("pos_a");
	});
	$(".dibox_in").on("blur", function() {
		if($(this).val()=="") {$(this).prev(".dibox_name").removeClass("pos_a").addClass("pos_i");}
		var polto_name=$(this).attr("name");
		polto( polto_name);
	});
	

});

</script>
<?
//echo "<pre>";print_r($_REQUEST);echo "</pre>";
//echo "<pre>";print_r($_SESSION["ELEM_F"]);echo "</pre>";
$PARENT_ID=$_REQUEST["PARENT_ID"];
$SECTION_ID=$_REQUEST["SECTION_ID"];
$SELECTION=$_REQUEST["SELECTION"];
$PAGEN_1=$_REQUEST["PAGEN_1"];

if($SELECTION=="Y") {
	foreach($_SESSION["ELEM_F"]["tov"] as $pk0 => $pv0) {
			foreach($pv0 as $tval) {
				if(array_key_exists($tval["ID"],$_SESSION["order"]["add_elem"])) $ar_tov_all[$tval["ID"]]=$tval;
			}
		}
}
else {
if($PARENT_ID) {
	if($SECTION_ID) {
		$ar_tov_all=$_SESSION["ELEM_F"]["tov"][$SECTION_ID];
	}
	else {
		foreach($_SESSION["ELEM_F"]["tov"] as $pk0 => $pv0) {
			foreach($pv0 as $tval) {
				if($tval["section_0"]==$PARENT_ID) $ar_tov_all[$tval["ID"]]=$tval;
			}
		}
	}
}
else {
	foreach($_SESSION["ELEM_F"]["tov"] as $pk0 => $pv0) {
		foreach($pv0 as $tval) {
			$ar_tov_all[$tval["ID"]]=$tval;
		}
	}
}



// Включение рекламы
if($PARENT_ID) {
	if($SECTION_ID) $id_u=$SECTION_ID;
	else $id_u=$PARENT_ID;
}
else $id_u=0;

foreach($_SESSION["ELEM_F"]["ad_unit"] as $ku => $vu) {
	if($id_u) {
		
		if(in_array($id_u, $vu["to_section"])) {
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
}
$e_count=count($ar_tov_all);
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
//echo "<pre>";print_r($_SESSION["ELEM_F"]["tov"]);echo "</pre>";
//echo "<pre>";print_r($_SESSION["ELEM_F"]);echo "</pre>";
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
//echo "<pre>";print_r($_SESSION["order"]["add_elem"]);echo "</pre>";
?>

<?foreach($ar_tov as $val_t) {?>
	
		<?if($val_t["TYPE"]=="ad_unit") {?>
			<?$rand_keys = array_rand($ar_ad_unit);?>
			<a href="<?=$ar_ad_unit[$rand_keys]["url"]?>" target="_blank"><div class="ad_unit" style="background-image: url('<?=$ar_ad_unit[$rand_keys]["PREVIEW_PICTURE_SRC"]?>');" title="<?=$ar_ad_unit[$rand_keys]["PREVIEW_TEXT"]?>"> Случайный рекламный блок - ссылка на статью, сайт, видео и т. п. Имеет привязку к разделу. В примере ссылки отключены. </div></a>
		<?} else {?>
			<div class="elo <?=(is_array($_SESSION["order"]["add_elem"][$val_t["ID"]]))?"add":"def"?>" id_elem="<?=$val_t["ID"]?>">
				<!--<a href="#">-->
					<button type="button" class="go_shop ah_shop cart <?=(is_array($_SESSION["order"]["add_elem"][$val_t["ID"]]))?"hidden":"visible"?>" in_cart="<?=(is_array($_SESSION["order"]["add_elem"][$val_t["ID"]]))?"Y":"N"?>"></button>
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
				<?if($val_t["PROPERTY_PRICE_PACKING_VALUE"]) {?>
					
					<div class="price_packing" price_packing=<?=$val_t["PROPERTY_PRICE_PACKING_VALUE"]?>><?=nfn($val_t["PROPERTY_PRICE_PACKING_VALUE"])?> <div class="rur">q</div> <span class="price_packing_nt">/уп - <?=$val_t["PROPERTY_PACKING_VALUE"]?> <?=$val_t["PROPERTY_UNIT_VALUE"]?></span></div>					
				<?}?>
				<?if($val_t["PROPERTY_PRICE_VALUE"]) {?>
					<div class="price" price=<?=$val_t["PROPERTY_PRICE_VALUE"]?>><?=nfn($val_t["PROPERTY_PRICE_VALUE"])?> <div class="rur">q</div> <span class="price_nt">/<?=$val_t["PROPERTY_UNIT_VALUE"]?></span></div>
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
									<?=nfn($val_t["PROPERTY_PRICE_VALUE"])?> <div class="rur">q</div> <span class="d_price_nt">/<?=$val_t["PROPERTY_UNIT_VALUE"]?></span>
									<?if($val_t["PROPERTY_PRICE_PACKING_VALUE"]) {?>
										<div class="d_price_packing"><?=nfn($val_t["PROPERTY_PRICE_PACKING_VALUE"])?> <div class="rur">q</div> <span class="d_price_packing_nt">уп/ - <?=$val_t["PROPERTY_PACKING_VALUE"]?> <?=$val_t["PROPERTY_UNIT_VALUE"]?></span></div>
									<?}?>
								</div>
						<?}?>
						<!--<a href="#">-->
							<button type="button" class="d_go_shop ah_shop" in_cart="N">Добавить <div class="cart"></div></button>
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
				<?
				if($val_t["PROPERTY_PRICE_PACKING_VALUE"]) $sum=$val_t["PROPERTY_PRICE_PACKING_VALUE"];
				else $sum=$val_t["PROPERTY_PRICE_VALUE"];
				if(is_array($_SESSION["order"]["add_elem"][$val_t["ID"]])){
					$qty=$_SESSION["order"]["add_elem"][$val_t["ID"]]["qty"];
					$sum=$_SESSION["order"]["add_elem"][$val_t["ID"]]["sum"];
					$weight=$_SESSION["order"]["add_elem"][$val_t["ID"]]["weight"];
				} else {
					$qty=1;
					if($val_t["PROPERTY_PRICE_PACKING_VALUE"]) $sum=$val_t["PROPERTY_PRICE_PACKING_VALUE"];
					else $sum=$val_t["PROPERTY_PRICE_VALUE"];
					$weight=$val_t["PROPERTY_PACKING_VALUE"];
				}
				?>
				<div class="calc_el <?=(is_array($_SESSION["order"]["add_elem"][$val_t["ID"]]))?"block":"none"?>"><div class="buq del"></div>
					<div class="prel"><span class="prec"></span> <div class="rur">q</div> <span class="pren">/уп.</span></div>
					<div class="calc_qty"><div class="buq minus"></div><div class="qty_text"><input type="text" value="<?=$qty?>" maxlength="4"><div class="input_buf"></div> <span>шт</span></div><div class="buq plus"></div></div>
					<div class="dha" id_elem="<?=$val_t["ID"]?>">
						<input type="hidden" name="id_elem" value="<?=$val_t["ID"]?>">
						<input type="hidden" name="price_packing" value="<?=($val_t["PROPERTY_PRICE_PACKING_VALUE"])?$val_t["PROPERTY_PRICE_PACKING_VALUE"]:$val_t["PROPERTY_PRICE_VALUE"]?>">
						<input type="hidden" name="price" value="<?=$val_t["PROPERTY_PRICE_VALUE"]?>">
						<input type="hidden" name="packing" value="<?=$val_t["PROPERTY_PACKING_VALUE"]?>">
						<input type="hidden" name="name_before_elem" value="<?=$val_t["PROPERTY_NAME_BEFORE_VALUE"]?>">
						<input type="hidden" name="name_elem" value="<?=$val_t["NAME"]?>">
						<input type="hidden" name="size_elem" value="<?=$val_t["PROPERTY_SIZE_VALUE"]?>">
						<input type="hidden" name="src_elem" value="<?=$val_t["PREVIEW_PICTURE_SRC"]?>">
						<input type="hidden" name="unit_elem" value="<?=$val_t["PROPERTY_UNIT_VALUE"]?>">
						
						<input type="hidden" name="qty" value="<?=$qty?>">
						<input type="hidden" name="sum" value="<?=$sum?>">
						<input type="hidden" name="weight" value="<?=$weight?>">
					</div>
				</div>
			</div>
		<?}?>
	
<?}?>
<div class="both"></div>
<div class="page_nav" style="margin:auto;">
	<?$APPLICATION->IncludeComponent("bitrix:system.pagenavigation", "round_fv_ajax", array("NAV_RESULT" => $navResult,));?>
</div>

<?
//unset($_SESSION["order"]["add_elem"]);
if(count($_SESSION["order"]["add_elem"])>0) {
	echo "<script>";
	//echo "alert(11);";
	foreach($_SESSION["order"]["add_elem"] as $ear) {
		echo "d_sum(".$ear["id"].",'N','Y');";
		echo "tin(".$ear["id"].");";	
	}
	echo "d_itogo();";
	echo "</script>";
}
?>
<?if(isset($_REQUEST["PAGEN_1"])) require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>