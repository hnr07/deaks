<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
IncludePublicLangFile(__FILE__);
global $ar_pit;
$ar_pit=$_SESSION["ar_pit"];

// Массив для изменения кол-ва клиньев от площади: ключ массива - площадь, значение - % от основ
$ar_minus[10]=30;
$ar_minus[100]=20;
$ar_minus[10000]=15;
ksort($ar_minus); // обязательная сортировка массива по ключам(площади) по возрастанию


// Удаляем из корзины записи, если есть;
CModule::IncludeModule("sale");

// foreach($_SESSION["in_cart"] as $zid) CSaleBasket::Delete($zid);
 unset($_SESSION["in_cart"],$_SESSION["add_cart"]);
/////////////////////////////

$sno=$_POST["sno"]; // Основа
$snk=$sno;    // Клин кол-во такое же, как и основ
foreach($ar_minus as $min_s2=>$minus) {
	if($_POST["sp"]>=$min_s2) $snk=ceil($sno*$minus/100); // Клин кол-во меньше, если больше установленной площади
}
$itogo=0;
$j_osnova=0;
$j_klin=0;
if($sno) $zm=1;
else $zm=0;

// Основа
krsort($ar_pit["osnova"]["OFFERS"]);
$c=count($ar_pit["osnova"]["OFFERS"]);
$i=0;
$ar_res_calc_osnova=array();
$ar_res_pr_osnova=array();
foreach($ar_pit["osnova"]["OFFERS"] as $k=>$val) {
	$i++;
	$p_res=($sno-$sno%$k)/$k;
	$sno-=$p_res*$k;
	if($i==$c && $sno>0) $p_res+=1;
	
//	if($p_res) {
		$sum=$p_res*$ar_pit["osnova"]["OFFERS"][$k]["CATALOG_PRICE_1"];
		
		$ar_res_calc_osnova[$j_osnova]["ID"]=$ar_pit["osnova"]["OFFERS"][$k]["ID"];
		$ar_res_calc_osnova[$j_osnova]["NAME"]=$ar_pit["osnova"]["NAME"];
		$ar_res_calc_osnova[$j_osnova]["PICTURE"]=$ar_pit["osnova"]["PICTURE"];
		$ar_res_calc_osnova[$j_osnova]["SRC"]=$ar_pit["osnova"]["SRC"];
		$ar_res_calc_osnova[$j_osnova]["ARTNUMBER"]=$ar_pit["osnova"]["OFFERS"][$k]["ARTNUMBER"];
		$ar_res_calc_osnova[$j_osnova]["UPAKOVKA"]=$ar_pit["osnova"]["OFFERS"][$k]["UPAKOVKA"];
		$ar_res_calc_osnova[$j_osnova]["PRICE"]=$ar_pit["osnova"]["OFFERS"][$k]["CATALOG_PRICE_1"];
		$ar_res_calc_osnova[$j_osnova]["CENA"]=$ar_pit["osnova"]["OFFERS"][$k]["CENA"];
		$ar_res_calc_osnova[$j_osnova]["RES_U"]=$p_res;
		$ar_res_calc_osnova[$j_osnova]["SUM_U"]=$sum;
		$itogo+=$sum;
		
	//}	else {
		$ar_res_pr_osnova[$j_osnova]["ID"]=$ar_pit["osnova"]["OFFERS"][$k]["ID"];
		$ar_res_pr_osnova[$j_osnova]["NAME"]=$ar_pit["osnova"]["NAME"];
		$ar_res_pr_osnova[$j_osnova]["PICTURE"]=$ar_pit["osnova"]["PICTURE"];
		$ar_res_pr_osnova[$j_osnova]["SRC"]=$ar_pit["osnova"]["SRC"];
		$ar_res_pr_osnova[$j_osnova]["ARTNUMBER"]=$ar_pit["osnova"]["OFFERS"][$k]["ARTNUMBER"];
		$ar_res_pr_osnova[$j_osnova]["UPAKOVKA"]=$ar_pit["osnova"]["OFFERS"][$k]["UPAKOVKA"];
		$ar_res_pr_osnova[$j_osnova]["PRICE"]=$ar_pit["osnova"]["OFFERS"][$k]["CATALOG_PRICE_1"];
		$ar_res_pr_osnova[$j_osnova]["CENA"]=$ar_pit["osnova"]["OFFERS"][$k]["CENA"];
		$ar_res_pr_osnova[$j_osnova]["RES_U"]=0;
		$ar_res_pr_osnova[$j_osnova]["SUM_U"]=0;
	//}

	$j_osnova++;
}
$ar_res_calc_osnova=array_reverse($ar_res_calc_osnova);

//echo "<pre>";print_r($ar_pit["osnova"]);echo "</pre>";
// Клин

krsort($ar_pit["klin"]["OFFERS"]);
$c=count($ar_pit["klin"]["OFFERS"]);
$i=0;
$ar_res_calc_klin=array();
$ar_res_pr_klin=array();
foreach($ar_pit["klin"]["OFFERS"] as $k=>$val) {
	$i++;
	$p_res=($snk-$snk%$k)/$k;
	$snk-=$p_res*$k;
	if($i==$c && $snk>0) $p_res+=1;

	//if($p_res) {
		$sum=$p_res*$ar_pit["klin"]["OFFERS"][$k]["CATALOG_PRICE_1"];
		
		$ar_res_calc_klin[$j_klin]["ID"]=$ar_pit["klin"]["OFFERS"][$k]["ID"];
		$ar_res_calc_klin[$j_klin]["NAME"]=$ar_pit["klin"]["NAME"];
		$ar_res_calc_klin[$j_klin]["PICTURE"]=$ar_pit["klin"]["PICTURE"];
		$ar_res_calc_klin[$j_klin]["SRC"]=$ar_pit["klin"]["SRC"];
		$ar_res_calc_klin[$j_klin]["ARTNUMBER"]=$ar_pit["klin"]["OFFERS"][$k]["ARTNUMBER"];
		$ar_res_calc_klin[$j_klin]["UPAKOVKA"]=$ar_pit["klin"]["OFFERS"][$k]["UPAKOVKA"];
		$ar_res_calc_klin[$j_klin]["PRICE"]=$ar_pit["klin"]["OFFERS"][$k]["CATALOG_PRICE_1"];
		$ar_res_calc_klin[$j_klin]["CENA"]=$ar_pit["klin"]["OFFERS"][$k]["CENA"];
		$ar_res_calc_klin[$j_klin]["RES_U"]=$p_res;
		$ar_res_calc_klin[$j_klin]["SUM_U"]=$sum;
		$itogo+=$sum;
		
	//}	else {
		$ar_res_pr_klin[$j_klin]["ID"]=$ar_pit["klin"]["OFFERS"][$k]["ID"];
		$ar_res_pr_klin[$j_klin]["NAME"]=$ar_pit["klin"]["NAME"];
		$ar_res_pr_klin[$j_klin]["PICTURE"]=$ar_pit["klin"]["PICTURE"];
		$ar_res_pr_klin[$j_klin]["SRC"]=$ar_pit["klin"]["SRC"];
		$ar_res_pr_klin[$j_klin]["ARTNUMBER"]=$ar_pit["klin"]["OFFERS"][$k]["ARTNUMBER"];
		$ar_res_pr_klin[$j_klin]["UPAKOVKA"]=$ar_pit["klin"]["OFFERS"][$k]["UPAKOVKA"];
		$ar_res_pr_klin[$j_klin]["PRICE"]=$ar_pit["klin"]["OFFERS"][$k]["CATALOG_PRICE_1"];
		$ar_res_pr_klin[$j_klin]["CENA"]=$ar_pit["klin"]["OFFERS"][$k]["CENA"];
		$ar_res_pr_klin[$j_klin]["RES_U"]=0;
		$ar_res_pr_klin[$j_klin]["SUM_U"]=0;
	//}

	$j_klin++;
}
$ar_res_calc_klin=array_reverse($ar_res_calc_klin);
$ar_res_pr_klin=array_reverse($ar_res_pr_klin);

// Зажим
$ar_res_calc_zazhim=array();
$ar_res_pr_zazhim=array();
//if($itogo) {
	$sum=$zm*$ar_pit["zazhim"]["CATALOG_PRICE_1"];
	$ar_res_calc_zazhim[0]["ID"]=$ar_pit["zazhim"]["ID"];
	$ar_res_calc_zazhim[0]["NAME"]=$ar_pit["zazhim"]["NAME"];
	$ar_res_calc_zazhim[0]["PICTURE"]=$ar_pit["zazhim"]["PICTURE"];
	$ar_res_calc_zazhim[0]["SRC"]=$ar_pit["zazhim"]["SRC"];
	$ar_res_calc_zazhim[0]["ARTNUMBER"]=$ar_pit["zazhim"]["ARTNUMBER"];
	$ar_res_calc_zazhim[0]["UPAKOVKA"]=1;
	$ar_res_calc_zazhim[0]["PRICE"]=$ar_pit["zazhim"]["CATALOG_PRICE_1"];
	$ar_res_calc_zazhim[0]["RES_U"]=$zm;
	$ar_res_calc_zazhim[0]["SUM_U"]=$sum;
	$itogo+=$sum;
//} else {
	$ar_res_pr_zazhim[0]["ID"]=$ar_pit["zazhim"]["ID"];
	$ar_res_pr_zazhim[0]["NAME"]=$ar_pit["zazhim"]["NAME"];
	$ar_res_pr_zazhim[0]["PICTURE"]=$ar_pit["zazhim"]["PICTURE"];
	$ar_res_pr_zazhim[0]["SRC"]=$ar_pit["zazhim"]["SRC"];
	$ar_res_pr_zazhim[0]["ARTNUMBER"]=$ar_pit["zazhim"]["ARTNUMBER"];
	$ar_res_pr_zazhim[0]["UPAKOVKA"]=1;
	$ar_res_pr_zazhim[0]["PRICE"]=$ar_pit["zazhim"]["CATALOG_PRICE_1"];
	$ar_res_pr_zazhim[0]["RES_U"]=0;
	$ar_res_pr_zazhim[0]["SUM_U"]=0;
//}
	
	$ar_res_calc=array_merge($ar_res_calc_osnova, $ar_res_calc_klin, $ar_res_calc_zazhim);
	$ar_res_pr=array_merge($ar_res_pr_osnova, $ar_res_pr_klin, $ar_res_pr_zazhim);
	
//echo "<pre>";print_r($ar_res_calc);echo "</pre>";


$rub="<img src='/images/rub_18.png' class='img_rub'>";

?>
<style>
.rhe_0 {
	height:0px;
}
.rhe_1 {
	height:65px;
}
</style>

<div class="list_itog"> <a id="box_price" name="box_price"></a>
	<!--<form action="/<?=LANGUAGE_ID?>/#order" method="POST">	-->
	<form action="/<?=LANGUAGE_ID?>/personal/basket/order.php" method="POST">
		<table id="tab_calc">
			<thead>
				<tr valign="center" >
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><?=GetMessage("kolvo");?></td>
					<td style="text-align:right;width:114px"><?=GetMessage("cena");?></td>
					<td style="width:114px"><?=GetMessage("summa");?></td>
				</tr>
			</thead>
			<tbody>
			
			<?foreach($ar_res_calc as $ki=>$vi) {?>
			<?
			if($vi["UPAKOVKA"]>500) {$upak_note="(коробка) <div class='icobox'></div>";}
			elseif($vi["UPAKOVKA"]==1) {$upak_note=" <div class='zazhico'></div>";}
			else {$upak_note="(пакет) <div class='icopack'></div>";}
			?>
				<tr id="trc_<?=$vi["ID"]?>">
					<td><div class="npp c96">&nbsp;</div><input type="hidden" value="<?=$vi["ID"]?>"></td>
					<td><div class="el_img" style='background-image:url("<?=$vi["SRC"]?>")'><div class="accept" id="as_<?=$vi["ID"]?>"></div></div></td>
					<td style="text-align:left"> <div class="upak"><?=$vi["UPAKOVKA"]?> <small><?=GetMessage("sht");?></small></div> <div class="name" ><?=GetMessage($vi["NAME"])?></div> <div class="upak_note"><?=$upak_note?></div><div class="artn c96"><?=$vi["ARTNUMBER"]?></div></td>
					<td>
						<div class="number">
							<span class="minus c96">&minus;</span><div class="show show_div" id="s_<?=$vi["ID"]?>"><?=$vi["RES_U"]?></div><input type="hidden" name="in_cart[<?=$vi["ID"]?>]" value="<?=$vi["RES_U"]?>"><span class="plus c96">+</span>
						</div>
					</td>
					<td><div class="price"><?=number_format($vi["PRICE"], 2, '.', ' ');?></div> <div class="rub"><div class="rur">q</div><?//=$rub?></div><input type="hidden" class="i_price" value="<?=$vi["PRICE"];?>">
					<?if($vi["CENA"]) {?>
						<div class="ntc c96"><div class="cena"><?=number_format($vi["CENA"], 2, '.', ' ');?></div> <div class="rub"><div class="rur">q</div><?//=$rub?></div> /<?//=GetMessage("za");?> <?=GetMessage("sht");?></div>
					<?}?>
					</td>
					<td><div class="sum"><?=number_format($vi["SUM_U"], 2, '.', ' ');?></div> <div class="rub"><div class="rur">q</div><?//=$rub?></div><br /><input type="hidden" class="i_sum" value="<?=$vi["SUM_U"]?>"><div class="ntc c96">&nbsp;</div></td>
				</tr>
			<?}?>
	
			</tbody>
			<!--
				<tfoot>
					<tr class="tfoot" style="display:<?=($itogo)?"table-row":"none"?>;">
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><?=GetMessage("itogo");?>:</td>
						<td></td>
					</tr>
				
				</tfoot>
				-->
			
		</table>
		
			
		
		<?//echo"<pre>";print_r($ar_pit);echo"</pre>";?>
		<div class="buza" style="display:<?=($sno>0)?"block":"none"?>;">
			
				<button type="submit"><img src="/images/card.svg" height="20" width="24"> <?=GetMessage("oformit_zakaz");?> &nbsp;&nbsp;<div class="itogo" style="display:inline-block;"><?=number_format($itogo, 2, '.', ' ');?></div> <div class="rub" style="display:inline-block;"><div class="rur">q</div><?//=$rub?></div></button>
			<input type="hidden" class="i_itogo" value="<?=$itogo?>">
		</div>
		
		<table id="tab_pr">
		<thead>
				<tr valign="center" >
					<td>&nbsp;</td>
					
					<td colspan="2" style="text-align:center;"><?//=GetMessage("element_dls");?></td>
					
					<td style="text-align:right;"><?=GetMessage("cena");?></td>
					<td>&nbsp;</td>
				</tr>
			</thead>
			<tbody>
				<?foreach($ar_res_calc as $ki=>$vi) {?>
					<?
					if($vi["UPAKOVKA"]>500) {$upak_note="(коробка) <div class='icobox'></div>";}
					elseif($vi["UPAKOVKA"]==1) {$upak_note=" <div class='zazhico'></div>";}
					else {$upak_note="(пакет) <div class='icopack'></div>";}
					?>
						<tr id="trp_<?=$vi["ID"]?>">
							<td><div class="npp0">&nbsp;</div><input type="hidden" value="<?=$vi["ID"]?>"></td>
							<td><div class="el_img" style='background-image:url("<?=$vi["SRC"]?>")'></div></td>
							<td  style="text-align:left"><div class="upak"><?=$vi["UPAKOVKA"]?> <small><?=GetMessage("sht");?></small></div> <div class="name"><?=GetMessage($vi["NAME"])?></div>  <div class="upak_note"><?=$upak_note?></div><div class="artn c96"><?=$vi["ARTNUMBER"]?></div></td>
							<td><div class="price"><?=number_format($vi["PRICE"], 2, '.', ' ');?></div> <div class="rub"><div class="rur">q</div><?//=$rub?></div>
							<?if($vi["CENA"]) {?>
								<div class="ntc c96"><div class="cena"><?=number_format($vi["CENA"], 2, '.', ' ');?></div> <div class="rub"><div class="rur">q</div><?//=$rub?></div> / <?//=GetMessage("za");?> <?=GetMessage("sht");?></div>
							<?}?>
							</td>
							<td>
								<div style="text-align:right;">
									<button type="button" class="plus_pr"><?=GetMessage("v_zakaz");?></button>
								</div>
							</td>
							
							
						</tr>
				<?}?>
			</tbody>
		</table>
		
		
	</form>	
	</div>

	
	<div class="list_itog_mob">
	<form action="/<?=LANGUAGE_ID?>/personal/basket/order.php" method="POST">
		<table id="tab_calc">
	
			<tbody>
			
			<?foreach($ar_res_calc as $ki=>$vi) {?>
			<?
			if($vi["UPAKOVKA"]>500) {$upak_note="<div class='icobox'></div>";}
			elseif($vi["UPAKOVKA"]==1) {$upak_note="<div class='zazhico'></div>";}
			else {$upak_note="<div class='icopack'></div>";}
			?>
		
				<tr id="trcm_<?=$vi["ID"]?>">
					<td><div class="npp c96">&nbsp;</div>
						<input type="hidden" value="<?=$vi["ID"]?>"><div class="el_img" style='background-image:url("<?=$vi["SRC"]?>")'><div class="accept" id="asm_<?=$vi["ID"]?>"></div></div>
					</td>
					<td>
						<div class="name"><?=GetMessage($vi["NAME"])?>,</div> <div class="upak"><?=$vi["UPAKOVKA"]?> <?=GetMessage("sht");?> <?=$upak_note?></div><div class="artn c96"><?=$vi["ARTNUMBER"]?></div><div class="price"><?=number_format($vi["PRICE"], 2, '.', ' ');?><?//=$vi["PRICE"];?></div> <div class="rub"><div class="rur">q</div><?//=$rub?></div><br />
						<?if($vi["CENA"]) {?>
							<div class="ntc c96"><div class="cena"><?=number_format($vi["CENA"], 2, '.', ' ');?></div> <div class="rub"><div class="rur">q</div><?//=$rub?></div> /<?//=GetMessage("za");?> <?=GetMessage("sht");?></div>
						<?}?>
						<input type="hidden" class="i_price" value="<?=$vi["PRICE"];?>">
					</td>
					<td style="text-align:right;">
						<div class="number"><div class="t_sht"><?=GetMessage("sht");?></div>
							<span class="minus">&minus;</span><div class="show show_div" id="sm_<?=$vi["ID"]?>"><?=$vi["RES_U"]?></div><span class="plus">+</span><input type="hidden" name="in_cart[<?=$vi["ID"]?>]" value="<?=$vi["RES_U"]?>">
						</div>
						<div class="sum"><?=number_format($vi["SUM_U"], 2, '.', ' ');?><?//=$vi["SUM_U"]?></div> <div class="rub"><div class="rur">q</div><?//=$rub?></div><input type="hidden" class="i_sum" value="<?=$vi["SUM_U"]?>">
					</td>

				</tr>
			<?}?>
			
			</tbody>

		</table>
	
		
		<?//echo"<pre>";print_r($ar_pit);echo"</pre>";?>
		<div class="buza" style="display:<?=($sno>0)?"block":"none"?>;">
			
				<button type="submit"><img src="/images/card.svg" height="18" width="21"> <?=GetMessage("oformit_zakaz");?> &nbsp;<nobr><div class="itogo"><?=number_format($itogo, 2, '.', ' ');?><?//=$itogo?></div> <div class="rub"><div class="rur">q</div><?//=$rub?></div></nobr></button>
				<input type="hidden" class="i_itogo" value="<?=$itogo?>">
		</div>
		
			<table id="tab_pr">
	
			<tbody>
			
			<?foreach($ar_res_calc as $ki=>$vi) {?>
			<?
			if($vi["UPAKOVKA"]>500) {$upak_note="<div class='icobox'></div>";}
			elseif($vi["UPAKOVKA"]==1) {$upak_note="<div class='zazhico'></div>";}
			else {$upak_note="<div class='icopack'></div>";}
			?>
		
				<tr id="trpm_<?=$vi["ID"]?>">
					<td>
						<input type="hidden" value="<?=$vi["ID"]?>"><div class="el_img" style='background-image:url("<?=$vi["SRC"]?>")'></div>
					</td>
					<td>
						<div class="name"><?=GetMessage($vi["NAME"])?>,</div> <div class="upak"><?=$vi["UPAKOVKA"]?> <?=GetMessage("sht");?> <?=$upak_note?></div><div class="artn c96"><?=$vi["ARTNUMBER"]?></div><div class="price"><?=number_format($vi["PRICE"], 2, '.', ' ');?><?//=$vi["PRICE"];?></div> <div class="rub"><div class="rur">q</div><?//=$rub?></div><br />
						<?if($vi["CENA"]) {?>
							<div class="ntc c96"><div class="cena"><?=number_format($vi["CENA"], 2, '.', ' ');?></div> <div class="rub"><div class="rur">q</div><?//=$rub?></div> / <?//=GetMessage("za");?> <?=GetMessage("sht");?></div>
						<?}?>
					</td>
					<td style="text-align:center;">
						<div class="number">
							<button type="button" class="plus_prm"><?=GetMessage("v_zakaz");?></button>
						</div>
						
					</td>

				</tr>
			<?}?>
			
			</tbody>

		</table>
	</form>	
	</div>
	<script type="text/javascript">
	$(document).ready(function() {

		$('.minus').click(function () {
			var input = $(this).parent().find('.show');
			
			var count = parseInt(input.html()) - 1;
			
			if(count<0) count=0;
			else {
				if($(".list_itog_mob").css("display")=="block") {f_ch_sum_mob(input,-1);}
				if($(".list_itog").css("display")=="block") {f_ch_sum(input,-1);}
			}
			
			input.html(count);
			$(this).parent().find('input').val(count);
			each_show();
			each_min();
			return false;
		});
		$('.plus').click(function () {
			var input = $(this).parent().find('.show');
			var count = parseInt(input.html()) + 1;
			input.html(count);
			$(this).parent().find('input').val(count);
			if($(".list_itog_mob").css("display")=="block") {f_ch_sum_mob(input,1);}
			if($(".list_itog").css("display")=="block") {f_ch_sum(input,1);}
			each_show();
			each_min();
			
			
			return false;
		});
		$('.plus_pr').click(function () {
			var mpr=$(this).parent().parent().parent().attr("id").split("_");
			//alert(mpr[1]);
			$("#trc_"+mpr[1]+" .plus").click();
		});
		$('.plus_prm').click(function () {
			var mprm=$(this).parent().parent().parent().attr("id").split("_");
			//alert(mprm[1]);
			$("#trcm_"+mprm[1]+" .plus").click();
		});
		each_show();
		each_min();
			
		
	 });
	 
function f_ch_sum(input,z) {
	var price_div = input.parent().parent().next("td").children(".price");
	var price_div_i = input.parent().parent().next("td").children(".i_price");
	var p=price_div_i.val().replace(/\s+/g, '');
	var price = parseFloat(p);
	//alert(p);
	var sum_div = price_div.parent().next("td").children(".sum");
	var sum_div_i = price_div_i.parent().next("td").children(".i_sum");
	var s=sum_div_i.val().replace(/\s+/g, '');
	var sum = (parseFloat(s)+price*z).toFixed(2);

	sum_div.html(number_format(sum,2,"."," "));
	sum_div_i.val(sum);
	
	var itogo_div = $(".list_itog .itogo");
	var itogo_div_i = $(".list_itog .i_itogo");
	var i=itogo_div_i.val().replace(/\s+/g, '');
	var itogo = (parseFloat(i)+price*z).toFixed(2);
	itogo_div.html(number_format(itogo,2,"."," "));
	itogo_div_i.val(itogo);
	if(itogo>0) $(".list_itog .buza").css({"display":"block"});
	else $(".list_itog .buza").css({"display":"none"});
}

function f_ch_sum_mob(input,z) {
	var price_div = input.parent().parent().prev("td").children(".price");
	var price_div_i = input.parent().parent().prev("td").children(".i_price");
	var p=price_div_i.val().replace(/\s+/g, '');
	//alert(p);
	var price = parseFloat(p);
	var sum_div = price_div.parent().next("td").children(".sum");
	var sum_div_i = price_div_i.parent().next("td").children(".i_sum");
	var s=sum_div_i.val().replace(/\s+/g, '');
	var sum = (parseFloat(s)+price*z).toFixed(2);
	sum_div.html(number_format(sum,2,"."," "));
	sum_div_i.val(sum);
	var itogo_div = $(".list_itog_mob .itogo");
	var itogo_div_i = $(".list_itog_mob .i_itogo");
	var i=itogo_div_i.val().replace(/\s+/g, '');
	var itogo = (parseFloat(i)+price*z).toFixed(2);
	itogo_div.html(number_format(itogo,2,"."," "));
	itogo_div_i.val(itogo);
	if(itogo>0) $(".list_itog_mob .buza").css({"display":"block"});
	else $(".list_itog_mob .buza").css({"display":"none"});
	
}


function number_format(number, decimals, dec_point, thousands_sep) {
	/***
	number - исходное число
	decimals - количество знаков после разделителя
	dec_point - символ разделителя
	thousands_sep - разделитель тысячных
	***/
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}
function each_show() {
	var f_c=0; var f_p=0;
	$('.list_itog .show').each(function(i,elem) {
		var si=$(this).attr("id").split('_');
		
		//alert(si[1]);
		var a=$("#as_"+si[1]);
		if(($("#s_"+si[1]).html()*1)>0) {
			a.css({"display":"block"});
			$("#trc_"+si[1]).show(1000);
			$("#trp_"+si[1]).hide(1000);
			//$("#trc_"+si[1]).css({"display":"table-row"});
			//$("#trp_"+si[1]).css({"display":"none"});
			f_c++;
		}
		else {
			a.css({"display":"none"});
			$("#trp_"+si[1]).show(1000);
			$("#trc_"+si[1]).hide(1000);
			//$("#trp_"+si[1]).css({"display":"table-row"});
			//$("#trc_"+si[1]).css({"display":"none"});
			f_p++;
		}
	});
	
	if(f_c>0) {
		//$("#tab_calc .tfoot").css({"display":"table-row"});
		$("#tab_calc thead tr").css({"display":"table-row"});
	}
	else {
		//$("#tab_calc .tfoot").css({"display":"none"});
		$("#tab_calc thead tr").css({"display":"none"});
	}
	if(f_p>0) $("#tab_pr thead tr").css({"display":"table-row"});
	else $("#tab_pr thead tr").css({"display":"none"});
	
	setTimeout("list_npp()", 1050);
	
	///////////////////////// mob //////////////////////////////
	
	$('.list_itog_mob .show').each(function(i,elem) {
		var sim=$(this).attr("id").split('_');
		
		//alert(si[1]);
		var am=$("#asm_"+sim[1]);
		if(($("#sm_"+sim[1]).html()*1)>0) {
			am.css({"display":"block"});
			$("#trcm_"+sim[1]).show(1000);
			$("#trpm_"+sim[1]).hide(1000);

		}
		else {
			am.css({"display":"none"});
			$("#trpm_"+sim[1]).show(1000);
			$("#trcm_"+sim[1]).hide(1000);

		}
	});
	
}
	function dd_min(t) {
		var iti=$(t).html();
		var fs=iti.replace('<span class="dd_min">','');
		fs=fs.replace('</span>','');
		var it=fs.split(".");
		
		$(t).html(it[0]+'.<span class="dd_min">'+it[1]+'</span>');
	}
	function each_min() {
		$('.price').each(function(i,elem) {
				dd_min(this);
			});
			$('.sum').each(function(i,elem) {
				dd_min(this);
			});
			$('.itogo').each(function(i,elem) {
				dd_min(this);
			});
			$('.cena').each(function(i,elem) {
				dd_min(this);
			});
	}
	function list_npp() {
		$('.list_itog .npp:visible').each(function(i,elem) {
			$(this).html(i+1);
		});
		$('.list_itog_mob .npp:visible').each(function(i,elem) {
			$(this).html(i+1);
		});
	}
</script>
<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>
 