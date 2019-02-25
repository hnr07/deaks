<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
IncludePublicLangFile(__FILE__);
global $USER;
$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."/connect_files/catalog_list.php"), false);
$ar_pit=$_SESSION["ar_pit"];

// Массив для изменения кол-ва клиньев от площади: ключ массива - площадь, значение - % от основ
$ar_minus[10]=30;
$ar_minus[100]=20;
$ar_minus[10000]=15;
ksort($ar_minus); // обязательная сортировка массива по ключам(площади) по возрастанию

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
$np=true;
foreach($ar_pit["osnova"]["OFFERS"] as $k=>$val) {
	$i++;
	$p_res=($sno-$sno%$k)/$k;
	$sno-=$p_res*$k;
	if($i==$c && $sno>0) $p_res+=1;
	
//	if($p_res) {
	/*
	$new_price = CCurrencyRates::ConvertCurrency($ar_pit["osnova"]["OFFERS"][$k]["CATALOG_PRICE_1"], $_SESSION['code_currency'],"RUB");
	$new_cena = CCurrencyRates::ConvertCurrency($ar_pit["osnova"]["OFFERS"][$k]["CENA"], $_SESSION['code_currency'],"RUB");
	if($new_price) {
		$price=$new_price;
		$cena=$new_cena;
	}
	else {
		$price=$ar_pit["osnova"]["OFFERS"][$k]["CATALOG_PRICE_1"];
		$cena=$ar_pit["osnova"]["OFFERS"][$k]["CENA"];
		$np=false;
	}
	*/
		$price=$ar_pit["osnova"]["OFFERS"][$k]["CATALOG_PRICE_1"];
		$sum=$p_res*$price;
		
		$ar_res_calc_osnova[$j_osnova]["ID"]=$ar_pit["osnova"]["OFFERS"][$k]["ID"];
		$ar_res_calc_osnova[$j_osnova]["NAME"]=$ar_pit["osnova"]["NAME"];
		$ar_res_calc_osnova[$j_osnova]["PICTURE"]=$ar_pit["osnova"]["PICTURE"];
		$ar_res_calc_osnova[$j_osnova]["SRC"]=$ar_pit["osnova"]["SRC"];
		$ar_res_calc_osnova[$j_osnova]["ARTNUMBER"]=$ar_pit["osnova"]["OFFERS"][$k]["ARTNUMBER"];
		$ar_res_calc_osnova[$j_osnova]["UPAKOVKA"]=$ar_pit["osnova"]["OFFERS"][$k]["UPAKOVKA"];
		$ar_res_calc_osnova[$j_osnova]["PRICE"]=$price;
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
		$ar_res_pr_osnova[$j_osnova]["PRICE"]=$price;
		$ar_res_pr_osnova[$j_osnova]["CENA"]=$ar_pit["osnova"]["OFFERS"][$k]["CENA"];
		$ar_res_pr_osnova[$j_osnova]["RES_U"]=0;
		$ar_res_pr_osnova[$j_osnova]["SUM_U"]=0;
	//}

	$j_osnova++;
}
$ar_res_calc_osnova=array_reverse($ar_res_calc_osnova);

//echo "<pre>";print_r($ar_res_calc_osnova);echo "</pre>";
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
		/*
	$new_price = CCurrencyRates::ConvertCurrency($ar_pit["klin"]["OFFERS"][$k]["CATALOG_PRICE_1"], $_SESSION['code_currency'],"RUB");
	$new_cena = CCurrencyRates::ConvertCurrency($ar_pit["klin"]["OFFERS"][$k]["CENA"], $_SESSION['code_currency'],"RUB");
	if($new_price) {
		$price=$new_price;
		$cena=$new_cena;
	}
	else {
		$price=$ar_pit["klin"]["OFFERS"][$k]["CATALOG_PRICE_1"];
		$cena=$ar_pit["klin"]["OFFERS"][$k]["CENA"];
		$np=false;
	}
	*/
		$price=$ar_pit["klin"]["OFFERS"][$k]["CATALOG_PRICE_1"];
		$sum=$p_res*$price;
		
		$ar_res_calc_klin[$j_klin]["ID"]=$ar_pit["klin"]["OFFERS"][$k]["ID"];
		$ar_res_calc_klin[$j_klin]["NAME"]=$ar_pit["klin"]["NAME"];
		$ar_res_calc_klin[$j_klin]["PICTURE"]=$ar_pit["klin"]["PICTURE"];
		$ar_res_calc_klin[$j_klin]["SRC"]=$ar_pit["klin"]["SRC"];
		$ar_res_calc_klin[$j_klin]["ARTNUMBER"]=$ar_pit["klin"]["OFFERS"][$k]["ARTNUMBER"];
		$ar_res_calc_klin[$j_klin]["UPAKOVKA"]=$ar_pit["klin"]["OFFERS"][$k]["UPAKOVKA"];
		$ar_res_calc_klin[$j_klin]["PRICE"]=$price;
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
		$ar_res_pr_klin[$j_klin]["PRICE"]=$price;
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
	/*
	$new_price = CCurrencyRates::ConvertCurrency($ar_pit["zazhim"]["CATALOG_PRICE_1"], $_SESSION['code_currency'],"RUB");
	if($new_price) {
		$price=$new_price;	
	}
	else {
		$price=$ar_pit["klin"]["OFFERS"][$k]["CATALOG_PRICE_1"];
		$np=false;
	}
	*/
	$price=$ar_pit["zazhim"]["CATALOG_PRICE_1"];
	$sum=$zm*$price;
	$ar_res_calc_zazhim[0]["ID"]=$ar_pit["zazhim"]["ID"];
	$ar_res_calc_zazhim[0]["NAME"]=$ar_pit["zazhim"]["NAME"];
	$ar_res_calc_zazhim[0]["PICTURE"]=$ar_pit["zazhim"]["PICTURE"];
	$ar_res_calc_zazhim[0]["SRC"]=$ar_pit["zazhim"]["SRC"];
	$ar_res_calc_zazhim[0]["ARTNUMBER"]=$ar_pit["zazhim"]["ARTNUMBER"];
	$ar_res_calc_zazhim[0]["UPAKOVKA"]=1;
	$ar_res_calc_zazhim[0]["PRICE"]=$price;
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

	switch($_SESSION['code_currency']) {
		case "RUB":$sim_cur='<div class="rur">q</div>';break;
		case "BYN":$sim_cur='<img src="/images/bel_rub.svg">';break;
		case "ILS":$sim_cur='&#8362;';break;
		case "KZT":$sim_cur='&#8376;';break;
		case "GEL":$sim_cur='&#8382;';break;
		default:$sim_cur='<div style="font-size:12px;">'.$_SESSION['code_currency'].'</div>';
	}

?>
<!--<script type="text/javascript" src="/js/jquery.maskedinput.js"></script>-->
<input type="hidden" id="code_currency" value="<?=$_SESSION['code_currency']?>">
<input type="hidden" id="LANGUAGE_ID" value="<?=LANGUAGE_ID?>">
<input type="hidden" id="date_calc" value='<?=$_POST["ar_dj"]?>'>
<div class="list_itog"> <a id="box_price" name="box_price"></a>
	<!--<form action="/<?=LANGUAGE_ID?>/#order" method="POST">	-->
	<!--<form action="/<?=LANGUAGE_ID?>/personal/basket/order.php" method="POST">-->
	<form action="/ru/calc/order.php" method="POST"><!-- Заказ оформляется только в зоне RU -->
		<table id="tab_calc">
			<thead>
				<tr valign="center" >
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><?=GetMessage("kolvo");?></td>
					<td style="text-align:right;width:144px"><?=GetMessage("cena");?></td>
					<td style="width:114px"><?=GetMessage("summa");?></td>
				</tr>
			</thead>
			<tbody>
			
			<?foreach($ar_res_calc as $ki=>$vi) {?>
			<?
			if($vi["UPAKOVKA"]>500) {$upak_note=GetMessage("pack")." <div class='icobox'></div>";}
			elseif($vi["UPAKOVKA"]==1) {$upak_note=" <div class='zazhico'></div>";}
			else {$upak_note=GetMessage("packet")." <div class='icopack'></div>";}
			?>
				<tr id="trc_<?=$vi["ID"]?>" class="tr_order">
					<td><div class="npp c96">&nbsp;</div><input type="hidden" value="<?=$vi["ID"]?>"><input type="hidden" class="code_name" value="<?=$vi["NAME"]?>"></td>
					<td><div class="el_img" style='background-image:url("<?=$vi["SRC"]?>")'><div class="accept" id="as_<?=$vi["ID"]?>"></div></div></td>
					<td style="text-align:left"> <div class="upak"><?=$vi["UPAKOVKA"]?> <small><?=GetMessage("sht");?></small></div> <div class="name" ><?=GetMessage($vi["NAME"])?></div> <div class="upak_note"><?=$upak_note?></div><div class="artn c96"><?=$vi["ARTNUMBER"]?></div></td>
					<td>
						<div class="number">
							<span class="minus c96">&minus;</span><input type="text" class="show show_input" id="s_<?=$vi["ID"]?>" value="<?=$vi["RES_U"]?>" maxlength="10"><input class="ht" type="hidden" name="in_cart[<?=$vi["ID"]?>]" value="<?=$vi["RES_U"]?>"><span class="plus c96">+</span>
						</div>
					</td>
					<td><div class="price"><?=number_format($vi["PRICE"], 2, '.', ' ');?></div> <div class="rub size_img_12-14"><?=$sim_cur?><?//=$rub?></div><input type="hidden" class="i_price" value="<?=$vi["PRICE"];?>">
					<?if($vi["CENA"]) {?>
						<div class="ntc c96"><div class="cena"><?=number_format($vi["CENA"], 2, '.', ' ');?></div> <div class="rub size_img_7-8 iiop"><?=$sim_cur?><?//=$rub?></div> /<?//=GetMessage("za");?> <?=GetMessage("sht");?></div>
					<?}?>
					</td>
					<td><div class="sum"><?=number_format($vi["SUM_U"], 2, '.', ' ');?></div> <div class="rub size_img_12-14"><?=$sim_cur?><?//=$rub?></div><br /><input type="hidden" class="i_sum" value="<?=$vi["SUM_U"]?>"><div class="ntc c96">&nbsp;</div></td>
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
			<?if($_SESSION['code_currency']=="RUB" AND $_SESSION['s_lang_dir']=="ru") {?>
				<div class="div_print print" title="<?=GetMessage("print");?>"></div>
				<div class="paymasvisa"></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
				<button class="but_buza" type="submit" style="float:right;"><img src="/images/card.svg" height="20" width="24"> <?=GetMessage("oformit_zakaz");?> &nbsp;&nbsp;<div class="itogo" style="display:inline-block;"><?=number_format($itogo, 2, '.', ' ');?></div> <div class="rub size_img_14-16"><?=$sim_cur?><?//=$rub?></div></button>
			<?} 
			else {?>
				<div class="no_submit"><button type="button" class="mibu print"><?=GetMessage("print");?></button> <?if ($USER->IsAdmin()): ?><button type="button" class="mibu add_order"><?=GetMessage("zakazat");?> <span>&#9660;</span></button><? endif; ?> <?=GetMessage("itogo")?>: <div class="itogo" style="display:inline-block;"><?=number_format($itogo, 2, '.', ' ');?></div> <div class="rub size_img_14-16"><?=$sim_cur?><?//=$rub?></div>
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/".$_SESSION['s_lang_dir']."/calc/form_order.php"), false);?>
				</div>
			<?}?>
			<input type="hidden" class="i_itogo" value="<?=$itogo?>">
		</div>
		
		<table class="tab_pr">
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
					if($vi["UPAKOVKA"]>500) {$upak_note=GetMessage("pack")." <div class='icobox'></div>";}
					elseif($vi["UPAKOVKA"]==1) {$upak_note=" <div class='zazhico'></div>";}
					else {$upak_note=GetMessage("packet")." <div class='icopack'></div>";}
					?>
						<tr id="trp_<?=$vi["ID"]?>">
							<td><div class="npp0">&nbsp;</div><input type="hidden" value="<?=$vi["ID"]?>"></td>
							<td><div class="el_img" style='background-image:url("<?=$vi["SRC"]?>")'></div></td>
							<td  style="text-align:left"><div class="upak"><?=$vi["UPAKOVKA"]?> <small><?=GetMessage("sht");?></small></div> <div class="name"><?=GetMessage($vi["NAME"])?></div>  <div class="upak_note"><?=$upak_note?></div><div class="artn c96"><?=$vi["ARTNUMBER"]?></div></td>
							<td><div class="price"><?=number_format($vi["PRICE"], 2, '.', ' ');?></div> <div class="rub size_img_12-14"><?=$sim_cur?><?//=$rub?></div>
							<?if($vi["CENA"]) {?>
								<div class="ntc c96"><div class="cena"><?=number_format($vi["CENA"], 2, '.', ' ');?></div> <div class="rub size_img_7-8 iiop"><?=$sim_cur?><?//=$rub?></div> / <?//=GetMessage("za");?> <?=GetMessage("sht");?></div>
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
	<!--<form action="/<?=LANGUAGE_ID?>/personal/basket/order.php" method="POST">-->
	<form action="/ru/calc/order.php" method="POST"><!-- Заказ оформляется только в зоне RU -->
		<table id="tab_calc">
	
			<tbody>
			
			<?foreach($ar_res_calc as $ki=>$vi) {?>
			<?
			if($vi["UPAKOVKA"]>500) {$upak_note="<div class='icobox'></div>";}
			elseif($vi["UPAKOVKA"]==1) {$upak_note="<div class='zazhico'></div>";}
			else {$upak_note="<div class='icopack'></div>";}
			?>
		
				<tr id="trcm_<?=$vi["ID"]?>" class="tr_order">
					<td><div class="npp c96">&nbsp;</div>
						<input type="hidden" value="<?=$vi["ID"]?>"><div class="el_img" style='background-image:url("<?=$vi["SRC"]?>")'><div class="accept" id="asm_<?=$vi["ID"]?>"></div></div>
					</td>
					<td>
						<div class="name"><?=GetMessage($vi["NAME"])?>,</div> <div class="upak"><?=$vi["UPAKOVKA"]?> <?=GetMessage("sht");?> <?=$upak_note?></div><div class="artn c96"><?=$vi["ARTNUMBER"]?></div><div class="price"><?=number_format($vi["PRICE"], 2, '.', ' ');?><?//=$vi["PRICE"];?></div> <div class="rub size_img_9-10"><?=$sim_cur?><?//=$rub?></div><br />
						<?if($vi["CENA"]) {?>
							<div class="ntc c96"><div class="cena"><?=number_format($vi["CENA"], 2, '.', ' ');?></div> <div class="rub size_img_7-8 iiop"><?=$sim_cur?><?//=$rub?></div> /<?//=GetMessage("za");?> <?=GetMessage("sht");?></div>
						<?}?>
						<input type="hidden" class="i_price" value="<?=$vi["PRICE"];?>">
					</td>
					<td style="text-align:right;">
						<div class="number"><div class="t_sht"><?=GetMessage("sht");?></div>
							<span class="minus">&minus;</span><input type="tel" class="show show_input" id="sm_<?=$vi["ID"]?>" value="<?=$vi["RES_U"]?>" maxlength="10"><input class="ht" type="hidden" name="in_cart[<?=$vi["ID"]?>]" value="<?=$vi["RES_U"]?>"><span class="plus">+</span><input class="ht" type="hidden" name="in_cart[<?=$vi["ID"]?>]" value="<?=$vi["RES_U"]?>">
						</div>
						<div class="sum"><?=number_format($vi["SUM_U"], 2, '.', ' ');?><?//=$vi["SUM_U"]?></div> <div class="rub size_img_9-10"><?=$sim_cur?><?//=$rub?></div><input type="hidden" class="i_sum" value="<?=$vi["SUM_U"]?>">
					</td>

				</tr>
			<?}?>
			
			</tbody>

		</table>
	
		
		<?//echo"<pre>";print_r($ar_pit);echo"</pre>";?>
		<div class="buza" style="display:<?=($sno>0)?"block":"none"?>;">
			<?if($_SESSION['code_currency']=="RUB" AND $_SESSION['s_lang_dir']=="ru") {?>
				<button class="but_buza" type="submit"><img src="/images/card.svg" height="18" width="21"> <?=GetMessage("oformit_zakaz");?> &nbsp;<nobr><div class="itogo"><?=number_format($itogo, 2, '.', ' ');?><?//=$itogo?></div> <div class="rub size_img_11-12"><?=$sim_cur?><?//=$rub?></div></nobr></button>
				<div class="paymasvisa"></div>
			<?} else {?>
				<div class="no_submit"><nobr><?=GetMessage("itogo")?>: <div class="itogo"><?=number_format($itogo, 2, '.', ' ');?><?//=$itogo?></div> <div class="rub size_img_11-12"><?=$sim_cur?><?//=$rub?></div></nobr> <?if ($USER->IsAdmin()): ?><button type="button" class="mibu add_order"><?=GetMessage("zakazat");?> <span>&#9660;</span></button><? endif; ?>
				<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/".$_SESSION['s_lang_dir']."/calc/form_order_mob.php"), false);?>
				</div>
			<?}?>
				<input type="hidden" class="i_itogo" value="<?=$itogo?>">
		</div>
		
			<table class="tab_pr">
	
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
						<div class="name"><?=GetMessage($vi["NAME"])?>,</div> <div class="upak"><?=$vi["UPAKOVKA"]?> <?=GetMessage("sht");?> <?=$upak_note?></div><div class="artn c96"><?=$vi["ARTNUMBER"]?></div><div class="price"><?=number_format($vi["PRICE"], 2, '.', ' ');?><?//=$vi["PRICE"];?></div> <div class="rub size_img_9-10"><?=$sim_cur?><?//=$rub?></div><br />
						<?if($vi["CENA"]) {?>
							<div class="ntc c96"><div class="cena"><?=number_format($vi["CENA"], 2, '.', ' ');?></div> <div class="rub size_img_7-8 iiop"><?=$sim_cur?><?//=$rub?></div> / <?//=GetMessage("za");?> <?=GetMessage("sht");?></div>
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
	
	<?
	//echo "<pre>";print_r($_POST["ar_dj"]);"</pre>";
	// Добавление в форму ID=1 лога калькулятора
	
	if($_POST["sno"]) {
		if(CModule::IncludeModule("form")){ 
			$ar_d=str_replace(",","\n",$_POST["ar_d"]);
			$res_text="";
			foreach($ar_res_calc as $vi) {
				if($vi["RES_U"]) $res_text.=GetMessage($vi["NAME"])."-".$vi["UPAKOVKA"].": ".$vi["RES_U"]." x ".$vi["PRICE"]." = ".$vi["SUM_U"]."\n";
			}
			$FORM_ID = 1; // ID веб-формы
			// массив значений ответов
			$arValues = array (
				//"form_date_1"                 => date("d.m.Y"),           // "Дата заполнения"
				"form_textarea_2"             => $ar_d,                   // "Калькулятор"
				"form_text_3"                 => $_POST["sp"],            // "Площадь"
				"form_text_4"                 => $_POST["sno"],           // "Расход"
				"form_textarea_5"             => $res_text,               // "Результат"
				"form_text_6"                 => $_SESSION['s_lang_dir'], // "Страна"
				"form_text_7"                 => $itogo,                   // "Сумма заказа"
				"form_text_26"                 => $_SESSION['code_currency'] // "Валюта"
			);
			CFormResult::Add($FORM_ID, $arValues);
		}
	}
	
	?>
	
	<script type="text/javascript">
	$(document).ready(function() {
		$('.show').bind("change keyup input click", function() {
			var input=$(this);
			if (this.value.match(/[^0-9]/g)) {
				this.value = this.value.replace(/[^0-9]/g, '');
			}	
			
				var chp=input.val();
				input.val(chp);
				var chp_i=input.next(".ht").val();
				var z=chp-chp_i;
				//alert(chp);
				$(this).next(".ht").val(chp);

				if($(".list_itog_mob").css("display")=="block") {f_ch_sum_mob(input,z);}
				if($(".list_itog").css("display")=="block") {f_ch_sum(input,z);}

				if (input.val()=='0') each_show();
				each_min();
				return false;
			
		});
	
		$('.minus').click(function () {
			var input = $(this).parent().find('.show');
			if(input.val()=='') input.val(0);
			var count = parseInt(input.val()) - 1;
			
			if(count<0) count=0;
			else {
				if($(".list_itog_mob").css("display")=="block") {f_ch_sum_mob(input,-1);}
				if($(".list_itog").css("display")=="block") {f_ch_sum(input,-1);}
			}
			
			input.val(count);
			$(this).parent().find('.ht').val(count);
			each_show();
			each_min();
			return false;
		});
		$('.plus').click(function () {
			var input = $(this).parent().find('.show');
			if(input.val()=='') input.val(0);
			var count = parseInt(input.val()) + 1;
			input.val(count);
			$(this).parent().find('.ht').val(count);
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
		
		$(".print").click(function () {
			print_order();
		});
		
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
		if(($("#s_"+si[1]).val()*1)>0) {
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
	if(f_p>0) $(".tab_pr thead tr").css({"display":"table-row"});
	else $(".tab_pr thead tr").css({"display":"none"});
	
	setTimeout("list_npp()", 1050);
	
	///////////////////////// mob //////////////////////////////
	
	$('.list_itog_mob .show').each(function(i,elem) {
		var sim=$(this).attr("id").split('_');
		
		//alert(si[1]);
		var am=$("#asm_"+sim[1]);
		if(($("#sm_"+sim[1]).val()*1)>0) {
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
function json_order() {
	var code_currency=$("#code_currency").val();
	var itogo=$(".list_itog .i_itogo").val();
	var j_elem=[];
	$('.list_itog .tr_order:visible').each(function(i,elem) {
		j_elem[i]={};
		j_elem[i]["code"]=$(this).children("td:eq(0)").children(".code_name").val();
		j_elem[i]["name"]=$(this).children("td:eq(2)").children(".name").html();
		j_elem[i]["artn"]=$(this).children("td:eq(2)").children(".artn").html();
		j_elem[i]["upak"]=$(this).children("td:eq(2)").children(".upak").html().replace(/<[^>]+>/g,'');
		j_elem[i]["show"]=$(this).children("td:eq(3)").children(".number").children(".show").val();
		j_elem[i]["price"]=$(this).children("td:eq(4)").children(".i_price").val();
		j_elem[i]["sum"]=$(this).children("td:eq(5)").children(".i_sum").val();
		
		//ar_elem[i]= j_elem[i]["name"]+"("+j_elem[i]["upak"]+"): "+j_elem[i]["show"]+" х "+j_elem[i]["price"]+" = "+j_elem[i]["sum"]+" "+code_currency;
		//alert(j_elem[i]["name"]);
	});
	var date_elem={"order_list":j_elem, "code_currency":code_currency,"itogo":itogo};
	//date_elem=["date"]=j_elem;
	//date_elem=["code_currency"]=code_currency;
	//date_elem=["itogo"]=itogo;
	return JSON.stringify(date_elem);
}
function json_order_mob() {
	var code_currency=$("#code_currency").val();
	var itogo=$(".list_itog_mob .i_itogo").val();
	var j_elem=[];
	$('.list_itog_mob .tr_order:visible').each(function(i,elem) {
		j_elem[i]={};
		j_elem[i]["code"]=$(this).children("td:eq(0)").children(".code_name").val();
		j_elem[i]["name"]=$(this).children("td:eq(1)").children(".name").html();
		j_elem[i]["artn"]=$(this).children("td:eq(1)").children(".artn").html();
		j_elem[i]["upak"]=$(this).children("td:eq(1)").children(".upak").html().replace(/<[^>]+>/g,'');
		j_elem[i]["show"]=$(this).children("td:eq(2)").children(".number").children(".show").val();
		j_elem[i]["price"]=$(this).children("td:eq(1)").children(".i_price").val();
		j_elem[i]["sum"]=$(this).children("td:eq(2)").children(".i_sum").val();
		
		//ar_elem[i]= j_elem[i]["name"]+"("+j_elem[i]["upak"]+"): "+j_elem[i]["show"]+" х "+j_elem[i]["price"]+" = "+j_elem[i]["sum"]+" "+code_currency;
		//alert(j_elem[i]["name"]);
	});
	var date_elem={"order_list":j_elem, "code_currency":code_currency,"itogo":itogo};
	//date_elem=["date"]=j_elem;
	//date_elem=["code_currency"]=code_currency;
	//date_elem=["itogo"]=itogo;
	return JSON.stringify(date_elem);
}
function json_calc() {
	var date_calc=$("#date_calc").val();
	return date_calc;
}
function print_order() {
	var lang=$("#LANGUAGE_ID").val();
	//var ar_elem=[];
	
	//var elem_order = ar_elem.join('\n');

	var data_par='data_par='+json_order();
	var calc_par='calc_par='+json_calc();
	window.open("/"+lang+"/calc/print.php?print=Y&"+data_par+"&"+calc_par);
	 
}
</script>
<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>
 