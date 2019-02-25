<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Расчёт веса и ИМТ");
?> 
<link href="./calc_weight.css" type="text/css" rel="stylesheet" />
<script>
function f_cvr() {

	$(".vivd div").css({display: "none"});  // сокрытие описания результа для Индекса массы тела 

	var vx=$(":radio[name=sex]").filter(":checked").val(); // пол
	var vs=+$("#sm input:text:eq(0)").val();              // рост
	var vk=+$("#kg input:text:eq(0)").val();            // вес

	// расчёт веса по росту
	if(vs) {   
	var ivs=(vs-100)-(vs-150)/2;    // вес по формуле Лоренца
	ivs=(Math.round(ivs*1000))/1000;  // округление до граммм
	 // выводим вес по формуле Лоренца
	if(ivs>0) {$("#vvs_l").html(ivs);}
	else {$("#vvs_l").html("нет решения");}        


	if(vx=="w") ivs=(vs*3.5/2.54-108)*0.453;   // вес по формуле Купера для женщин
	if(vx=="m") ivs=(vs*4/2.54-128)*0.453;   // вес по формуле Купера для мужчин
	ivs=(Math.round(ivs*1000))/1000;      // округление до граммм
	 // выводим вес по формуле Купера
	if(ivs>0) {$("#vvs_k").html(ivs);}
	else {$("#vvs_k").html("нет решения");}
	}
	else {$("#vvs_k").html("?");$("#vvs_l").html("?");}   // выводим ? ,если не задан рост

	// расчёт ИМТ 
	if(vs && vk) {
	var a=Math.pow((vs/100), 2);
	var imt=vk/a;
	imt=(Math.round(imt*100))/100;  // формула ИМТ
	$("#imt").html(imt);           // выводим ИМТ

		if(vx=="w") { // описание результата для женщин
			if(imt<=19) $("#ned_v").css({display: "block"});
			if(imt>19 && imt<=25) $("#ide_v").css({display: "block"});
			if(imt>25 && imt<=31) $("#izb_v").css({display: "block"});
			if(imt>31) $("#jir_v").css({display: "block"});
		}
		if(vx=="m") { // описание результата для мужчин
			if(imt<=18) $("#ned_v").css({display: "block"});
			if(imt>18 && imt<=23.8) $("#ide_v").css({display: "block"});
			if(imt>23.8 && imt<=29) $("#izb_v").css({display: "block"});
			if(imt>29) $("#jir_v").css({display: "block"});
		}
	}
	else $("#imt").html("?"); // выводим ? ,если не задан рост и вес

}

function f_ppch(i) {

	var ch=$("#"+i+" input:text:eq(0)").val();
	ch=+ch.replace(",",".");
			
	if(isNaN(ch))
			{
			  $("#"+i+" input:text:eq(0)").val(0);
			  }
			  else $("#"+i+" input:text:eq(0)").val(ch);
}

$(document).ready(function() {
		
	$('.i_help').hover(
		function(){
			//$(this).children("a").children(".t_img").stop(true,true).animate({height: 50, bottom:0}, 500);
			//alert(11);
			var ib=$(this).attr("i_help");
			//alert(ib);
			$("#"+ib).css("display","block");
		},
		function(){
			//$(this).children("a").children(".t_img").animate({height: 0, bottom:-6}, 1000);
			$(".t_help").css("display","none");
	});
});
</script>
<!--<div class="titleh"><h1><?=$APPLICATION->GetTitle();?></h1></div>-->
<div class="border-top"></div>
<div class="calc_weight">
<p>Воспользовавшись нашим сервисом, Вы узнаете свой оптимальный вес и ИМТ (индекс массы тела). Для этого достаточно в форму, расположенную ниже, ввести свой вес в киллограммах и рост в сантиметрах, а также указать свой пол.</p>

	<table align="center"><tr><td>
	<div class="cont">
		<div class="form">
		<table>
		<tr>
		<td><div class="lb">Ваш вес <span class="krs">кг</span></div></td><td><div class="it" id="kg"><input type="text" name="kg" value="" onchange="f_ppch('kg')"></div></td>
		</tr>
		<tr>
		<td><div class="lb">Ваш рост <span class="krs">см</span></div></td><td><div class="it" id="sm"><input type="text" name="sm" value="" onchange="f_ppch('sm')"></div></td>
		</tr>
		<tr>
		<td><div class="lb">Ваш пол</div></td><td><div class="it"><input type="radio" name="sex" id="sex_w" value="w" checked> жен.<br /><input type="radio" name="sex" id="sex_m" value="m"> муж.</div></td>
		</tr>
		<tr>
		<td colspan="2" ><br /><br /><div class="bt" onclick="f_cvr()">Расчёт веса и ИМТ</div></td>
		</tr>
		</table>
		</div>

	</div>
</td><td>
			<div class="cont">

		<div class="res">
		<table>
		
		<tr><td><div class="res_str">Идеальный вес по <br />формуле Лоренца:</div></td><td> <div class="dire"><span id="vvs_l">?</span></div></td><td class="krs">&nbsp;<?=t("kg")?>&nbsp;</td><td> <img src="/images/help.png" class="i_help" i_help="i_help_1"></td></tr>
		<tr><td><div class="res_str">Идеальный вес по <br />формуле Купера:</div></td><td> <div class="dire"><span id="vvs_k">?</span></div></td><td class="krs">&nbsp;<?=t("kg")?>&nbsp;</td><td> <img src="/images/help.png" class="i_help" i_help="i_help_2"></td></tr>
		<tr><td><div class="res_str">Индекс массы тела <br />(индекс Кетле):</div></td><td>  <div class="dire"><span id="imt">?</span></div> </td><td>&nbsp;</td><td> <img src="/images/help.png" class="i_help" i_help="i_help_3"></td></tr>
		</table>	
			<div class="vivd"><br /><br />
			<div class="res_str" id="ned_v">Расшифровка ИМТ:<br />у Вас недостаток веса </div>
			<div class="res_str" id="ide_v">Расшифровка ИМТ:<br />у Вас идеальный вес </div>
			<div class="res_str" id="izb_v">Расшифровка ИМТ:<br />у Вас избыточный вес </div>
			<div class="res_str" id="jir_v">Расшифровка ИМТ:<br />Вы страдаете ожирением </div>
			</div>
			<div class="t_help" id="i_help_1">
			формула Лоренца<br /><br />
			<b>[Ваш вес(кг)]=([Ваш рост(см)] – 100) – ([Ваш рост(см)] – 150)/2</b>
			</div>
			<div class="t_help" id="i_help_2">
			формула Купера<br /><br />
			<b>женщины:<br />[Ваш вес(кг)]=([Ваш рост(см)] x 3,5 : 2,54 — 108) х 0,453</b><br /><br />
			<b>мужчины:<br />[Ваш вес(кг)]=([Ваш рост(см)] x 4,0 : 2,54 — 128) х 0,453</b>
			</div>
			<div class="t_help" id="i_help_3">
			индекс Кетле<br /><br />
				<b>ИМТ=[Ваш вес(кг)] : ([Ваш рост(м)] x [Ваш рост(м)])</b><br />
				<br />
				<b>женщины</b><br />
				до 18 - недостаток веса <br />
				19-25 - идеальный вес <br />
				25-31 - избыточный вес <br />
				от 31 - ожирение<br />
				<br />
				<b>мужчины</b><br />
				до 19 - недостаток веса <br />
				18-23,8 - идеальный вес <br />
				23,8-29 - избыточный вес <br />
				от 29 - ожирение
			</div>
		</div>
	</div>
</td></tr></table>
</div>

<br /><br /><br /><br /><br /><br />
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>