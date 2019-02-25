<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<? include "var_config.php"; ?>
<? include "functions.php"; ?>
<? include "../config/exchange.php"; ?>
<? include_once "functions_leadership.php"; ?>


<!--<script src="/jquery/jquery-1.6.2.js" type="text/javascript"></script>--> 
<script src="/js/chosen/chosen.jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/js/chosen/chosen.css" />

<script type="text/javascript" src="/js/datepicker/date.js"></script>
<script type="text/javascript" src="/js/datepicker/jquery.datePicker-2.1.2.js"></script>
<link rel="stylesheet" href="/js/datepicker/datepicker.css" type="text/css" /> 

<script type="text/javascript" src="/js/datepicker/cal.js"></script>
<script type="text/javascript" src="/js/datepicker/cal_2.js"></script>
<script type="text/javascript" src="/js/datepicker/cal_3.js"></script>
<script type="text/javascript" src="/js/datepicker/cal_4.js"></script>
<script type="text/javascript" src="/js/datepicker/cal_5.js"></script>
<link rel="stylesheet" href="/js/datepicker/cal.css" type="text/css" /> 

<script type="text/javascript">
// комментарий к полю ////////////
$(document).ready(function(){

	$(".qm").hover(function() {
	//$(this).next(".dem").children("em").animate({opacity: "show", top: "-15"}, "slow");
	$(this).children(".qm_text").css("display","block");
		var n=$(this).children(".qm_text").html();
		$("#note").html(n);
		if(n) {
		$("#leb_2").addClass("leb_r");
		$("#leb_2 legend").addClass("lg_r");
		}
	}, function() {
	$(this).children(".qm_text").css("display","none");
		//$(this).next(".dem").children("em").animate({opacity: "hide", top: "-25" }, "fast");
		$("#note").html("");
		$("#leb_2").removeClass("leb_r");
		$("#leb_2 legend").removeClass("lg_r");
	});
		$(".but_bot_1").hover(function() {
	$(this).children(".but_text").css("display","block");
	}, function() {
	$(this).children(".but_text").css("display","none");
	});
		$(".but_bot_2").hover(function() {
	$(this).children(".but_text").css("display","block");
	}, function() {
	$(this).children(".but_text").css("display","none");
	});
		$(".but_bot_3").hover(function() {
	$(this).children(".but_text").css("display","block");
	}, function() {
	$(this).children(".but_text").css("display","none");
	});
});


</script>

<script type="text/javascript">
$(function()
{
//$('#date_b').datePicker();

});
</script>
<script type="text/javascript">
$(document).ready(function(){
$('#date_b').simpleDatepicker();  // Привязать вызов календаря к полю с CSS идентификатором 
});
$(document).ready(function(){
$('#date_vp').simpleDatepicker_2();  // Привязать вызов календаря выдача паспорта к полю с CSS идентификатором 
});
$(document).ready(function(){
$('#date_dp').simpleDatepicker_3();  // Привязать вызов календаря действие паспорта к полю с CSS идентификатором 
});
$(document).ready(function(){
$('#date_rp').simpleDatepicker_4();  // Привязать вызов календаря готовность паспорта к полю с CSS идентификатором 
});
$(document).ready(function(){
$('#date_day_hotel_start').simpleDatepicker_5();  // Привязать вызов календаря начала проживания к полю с CSS идентификатором 
});
$(document).ready(function(){
$('#date_day_hotel_finish').simpleDatepicker_5();  // Привязать вызов календаря окончание проживания к полю с CSS идентификатором 
});
</script>

<div id="tr"></div>
<h1 class="htit"> &nbsp;<?=GetMessage('TITLE_PR_EDIT')?>&nbsp; </h1>
<br/><br/>
<div id="ti_form">
<!--
<form action="/ru/registration_event/step_4.php" method="POST" enctype="multipart/form-data" onsubmit="return sub_form()">
-->
<? 
$ar_head_form=explode(" ",$arResult["FORM_HEADER"],2);
$head_form=$ar_head_form[0]." onsubmit=\"return sub_form()\"  onreset=\"res_form()\" ".$ar_head_form[1];
//echo $head_form;
echo $arResult["FORM_HEADER"];
?>
<?=bitrix_sessid_post()?>
<div class="lic" id="lic_1">
<!--<div class="but_top"></div>-->
</div>
<table id="cont_t">

<tr valign="top"><td class="td_left">

</td>
<td>

<div  class="right_b">



<div class="title_step">
<div id="title_step2">&nbsp;&nbsp;<?=GetMessage('TITLE_STEP2')?> &nbsp;<?=GetMessage('TITLE_ED2')?></div>

</div>
<div id="tr"></div>

<!--
<div class="form-required">
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>


<?=$arResult["FORM_NOTE"]?>
</div>
-->
<?//if ($arResult["isFormNote"] != "Y")
//{
?>

<?//=$arResult["FORM_HEADER"];?>
<? 
//$ar_head_form=explode(" ",$arResult["FORM_HEADER"],2);
//$head_form=$ar_head_form[0]." onsubmit=\"return sub_form()\"  onreset=\"res_form()\" ".$ar_head_form[1];
//echo $head_form;

?>

<? $edit_z=1; // флаг редактирования?>
<? include "calculator.php"; // калькулятор ?>
<?

?>
<!-- Скрытые поля  -->
<div class="nevid">
<? include "field_form.php"; // Все поля формы?>
<!--  Стоимость мероприятия в у. е.  -->
<input  name="<?=fGetName("money",0)?>" value="<?=$cena_e?>"  type="text">
<!--  Стоимость в Вашей валюте  -->
<input  name="<?=fGetName("money_2",0)?>" value="<?=$cena_n?>"  type="text">
<!--  Калькуляция стоимости мероприятия в у. е.  -->
<textarea name="<?=fGetName("money_calc",0)?>"><?=$ctext;?></textarea>
<!--  Калькуляция стоимости мероприятия в нац. валюте  -->
<textarea name="<?=fGetName("money_2_calc",0)?>"><?=$ctext_n;?></textarea>

<!--  Индекс места  -->
<input  name="<?=fGetName("mesto_index",0)?>" value="<?=$i_mesto?>"  type="text">

<!--  Дата изменения  -->
<input  name="<?=fGetName("date_edit",0)?>" value="<?=date("d.m.Y")?>"  type="text">
<!--  Ключ изменения  -->
<input  name="<?=fGetName("key_edit",0)?>" value="0"  type="text">

</div>

<div class="tipetu"><span class="tpt"><?=GetMessage("ZAYAVKA")?>:</span> <span class="npt"><?=$_GET['RESULT_ID']?></span></div>
<?if (fGetResultValues("status")==fGetValue("status",0)):?>
<input id="hiscer" type="hidden" value="0">
<div class="tipetu"><span class="tpt"><?=fGetQuestion("status")?>:</span> <span class="npt"><?=fGetAnswer("status", 0)?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("chk")?>:</span> <span class="npt"><?=fGetResultValues("chk")?> - <?=fGetResultValues("family")?> <?=fGetResultValues("name")?></span></div>
<?endif?>
<?if (fGetResultValues("status")==fGetValue("status",1)):?>
<input id="hiscer" type="hidden" value="1">
<div class="tipetu"><span class="tpt"><?=fGetQuestion("status")?>:</span> <span class="npt"><?=fGetAnswer("status", 1)?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("kem_priglashen_chk")?>:</span> <span class="npt"><?=fGetResultValues("kem_priglashen_chk")?> - <?=fGetResultValues("kem_priglashen_family")?> <?=fGetResultValues("kem_priglashen_name")?></span></div>
<?endif?>
<?if (fGetResultValues("status")==fGetValue("status",2)):?>
<input id="hiscer" type="hidden" value="1">
<div class="tipetu"><span class="tpt"><?=fGetQuestion("status")?>:</span> <span class="npt"><?=fGetAnswer("status", 2)?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("kem_priglashen_chk")?>:</span> <span class="npt"><?=fGetResultValues("kem_priglashen_chk")?> - <?=fGetResultValues("kem_priglashen_family")?> <?=fGetResultValues("kem_priglashen_name")?></span></div>
<?endif?>

<?if(fGetResultValues("oplata")==fGetValue("oplata",0)):?>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("oplata")?>:</span> <span class="npt"><?=fGetAnswer("oplata", 0)?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("pl_chk")?>:</span> <span class="npt"><?=fGetResultValues("pl_chk")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("pl_name")?>:</span> <span class="npt"><?=fGetResultValues("pl_name")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("pl_family")?>:</span> <span class="npt"><?=fGetResultValues("pl_family")?></span></div>
<?endif?>
<?if(fGetResultValues("oplata")==fGetValue("oplata",1)):?>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("oplata")?>:</span> <span class="npt"><?=fGetAnswer("oplata", 1)?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("op_country")?>:</span> <span class="npt"><?=fGetResultValues("op_country")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("op_city")?>:</span> <span class="npt"><?=fGetResultValues("op_city")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("op_nof")?>:</span> <span class="npt"><?=fGetResultValues("op_nof")?></span></div>
<?endif?>

<div class="tipetu"><span class="tpt"><?=fGetQuestion("middle_name")?>:</span> <span class="npt"><?=fGetResultValues("middle_name")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("email")?>:</span> <span class="npt"><?=fGetResultValues("email")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("tel")?>:</span> <span class="npt"><?=fGetResultValues("tel")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("email_2")?>:</span> <span class="npt"><?=fGetResultValues("email_2")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("tel_2")?>:</span> <span class="npt"><?=fGetResultValues("tel_2")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("skype")?>:</span> <span class="npt"><?=fGetResultValues("skype")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("sex")?>:</span> <span class="npt">
<?if(fGetResultValues("sex")==fGetValue("sex",0))echo fGetAnswer("sex", 0)?>
<?if(fGetResultValues("sex")==fGetValue("sex",1))echo fGetAnswer("sex", 1)?>
<?if(fGetResultValues("sex")==fGetValue("sex",2))echo fGetAnswer("sex", 2)?>
<?if(fGetResultValues("sex")==fGetValue("sex",3))echo fGetAnswer("sex", 3)?>
<?if(fGetResultValues("sex")==fGetValue("sex",4))echo fGetAnswer("sex", 4)?>
</span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("country")?>:</span> <span class="npt"><?=fGetResultValues("country")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("city")?>:</span> <span class="npt"><?=fGetResultValues("city")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("birthday")?>:</span> <span class="npt"><?=fGetResultValues("birthday")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("prioritet")?>:</span> <span class="npt">
<?if(fGetResultValues("prioritet")==fGetValue("prioritet",0))echo fGetAnswer("prioritet", 0)?>
<?if(fGetResultValues("prioritet")==fGetValue("prioritet",1))echo fGetAnswer("prioritet", 1)?>
<?if(fGetResultValues("prioritet")==fGetValue("prioritet",2))echo fGetAnswer("prioritet", 2)?>
</span></div>
<!--
<div class="tipetu"><span class="tpt"><?=fGetQuestion("p_nal")?>:</span> <span class="npt">
<?if(fGetResultValues("p_nal")==fGetValue("p_nal",0))echo fGetAnswer("p_nal", 0)?>
<?if(fGetResultValues("p_nal")==fGetValue("p_nal",1))echo fGetAnswer("p_nal", 1)?>
</span></div>
<?if(fGetResultValues("p_nal")==fGetValue("p_nal",0)):?>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("p_name")?>:</span> <span class="npt"><?=fGetResultValues("p_name")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("p_family")?>:</span> <span class="npt"><?=fGetResultValues("p_family")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("p_date")?>:</span> <span class="npt"><?=fGetResultValues("p_date")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("p_due_date")?>:</span> <span class="npt"><?=fGetResultValues("p_due_date")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("p_sn")?>:</span> <span class="npt"><?=fGetResultValues("p_sn")?></span></div>
<?endif?>
<?if(fGetResultValues("p_nal")==fGetValue("p_nal",1)):?>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("p_ready")?>:</span> <span class="npt"><?=fGetResultValues("p_ready")?></span></div>
<?endif?>

<div class="tipetu"><span class="tpt"><?=fGetQuestion("p_viza")?>:</span> <span class="npt">
<?if(fGetResultValues("p_viza")==fGetValue("p_viza",0))echo fGetAnswer("p_viza", 0)?>
<?if(fGetResultValues("p_viza")==fGetValue("p_viza",1))echo fGetAnswer("p_viza", 1)?>
</span></div>

<div class="tipetu"><span class="tpt"><?=fGetQuestion("p_fly")?>:</span> <span class="npt">
<?if(fGetResultValues("p_fly")==fGetValue("p_fly",0))echo fGetAnswer("p_fly", 0)?>
<?if(fGetResultValues("p_fly")==fGetValue("p_fly",1))echo fGetAnswer("p_fly", 1)?>
</span></div>

<?if(fGetResultValues("p_fly")==fGetValue("p_fly",0)):?>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("fly_1")?>:</span> <span class="npt">
<?if(fGetResultValues("fly_1")==fGetValue("fly_1",0))echo fGetAnswer("fly_1", 0)?>
<?if(fGetResultValues("fly_1")==fGetValue("fly_1",1))echo fGetAnswer("fly_1", 1)?>
<?if(fGetResultValues("fly_1")==fGetValue("fly_1",2))echo fGetAnswer("fly_1", 2)?>
<?if(fGetResultValues("fly_1")==fGetValue("fly_1",3))echo fGetAnswer("fly_1", 3)?>
<?if(fGetResultValues("fly_1")==fGetValue("fly_1",4))echo fGetAnswer("fly_1", 4)?>
<?if(fGetResultValues("fly_1")==fGetValue("fly_1",5))echo fGetAnswer("fly_1", 5)?>
<?if(fGetResultValues("fly_1")==fGetValue("fly_1",6))echo fGetAnswer("fly_1", 6)?>
<?if(fGetResultValues("fly_1")==fGetValue("fly_1",7))echo fGetAnswer("fly_1", 7)?>
</span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("fly_2")?>:</span> <span class="npt">
<?if(fGetResultValues("fly_2")==fGetValue("fly_1",0))echo fGetAnswer("fly_2", 0)?>
<?if(fGetResultValues("fly_2")==fGetValue("fly_1",1))echo fGetAnswer("fly_2", 1)?>
<?if(fGetResultValues("fly_2")==fGetValue("fly_1",2))echo fGetAnswer("fly_2", 2)?>
<?if(fGetResultValues("fly_2")==fGetValue("fly_1",3))echo fGetAnswer("fly_2", 3)?>
<?if(fGetResultValues("fly_2")==fGetValue("fly_1",4))echo fGetAnswer("fly_2", 4)?>
<?if(fGetResultValues("fly_2")==fGetValue("fly_1",5))echo fGetAnswer("fly_2", 5)?>
<?if(fGetResultValues("fly_2")==fGetValue("fly_1",6))echo fGetAnswer("fly_2", 6)?>
<?if(fGetResultValues("fly_2")==fGetValue("fly_1",7))echo fGetAnswer("fly_2", 7)?>
</span></div>
<?endif?>

<div class="tipetu"><span class="tpt"><?=fGetQuestion("p_hotel")?>:</span> <span class="npt">
<?if(fGetResultValues("p_hotel")==fGetValue("p_hotel",0))echo fGetAnswer("p_hotel", 0)?>
<?if(fGetResultValues("p_hotel")==fGetValue("p_hotel",1))echo fGetAnswer("p_hotel", 1)?>
</span></div>

<?if(fGetResultValues("p_hotel")==fGetValue("p_hotel",0)):?>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("day_hotel_start")?>:</span> <span class="npt"><?=fGetResultValues("day_hotel_start")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("day_hotel_finish")?>:</span> <span class="npt"><?=fGetResultValues("day_hotel_finish")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("hotel")?>:</span> <span class="npt">
<?if(fGetResultValues("hotel")==fGetValue("hotel",0))echo fGetAnswer("hotel", 0)?>
<?if(fGetResultValues("hotel")==fGetValue("hotel",1))echo fGetAnswer("hotel", 1)?>
<?if(fGetResultValues("hotel")==fGetValue("hotel",2))echo fGetAnswer("hotel", 2)?>
<?if(fGetResultValues("hotel")==fGetValue("hotel",3))echo fGetAnswer("hotel", 3)?>
</span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("nomer")?>:</span> <span class="npt">
<?if(fGetResultValues("nomer")==fGetValue("nomer",0))echo fGetAnswer("nomer", 0)?>
<?if(fGetResultValues("nomer")==fGetValue("nomer",1))echo fGetAnswer("nomer", 1)?>
<?if(fGetResultValues("nomer")==fGetValue("nomer",2))echo fGetAnswer("nomer", 2)?>
<?if(fGetResultValues("nomer")==fGetValue("nomer",3))echo fGetAnswer("nomer", 3)?>
<?if(fGetResultValues("nomer")==fGetValue("nomer",4))echo fGetAnswer("nomer", 4)?>
<?if(fGetResultValues("nomer")==fGetValue("nomer",5))echo fGetAnswer("nomer", 5)?>
<?if(fGetResultValues("nomer")==fGetValue("nomer",6))echo fGetAnswer("nomer", 6)?>
<?if(fGetResultValues("nomer")==fGetValue("nomer",7))echo fGetAnswer("nomer", 7)?>
<?if(fGetResultValues("nomer")==fGetValue("nomer",8))echo fGetAnswer("nomer", 8)?>
</span></div>
<?endif?>

<div class="tipetu"><span class="tpt"><?=fGetQuestion("p_transfer")?>:</span> <span class="npt">
<?if(fGetResultValues("p_transfer")==fGetValue("p_transfer",0))echo fGetAnswer("p_transfer", 0)?>
<?if(fGetResultValues("p_transfer")==fGetValue("p_transfer",1))echo fGetAnswer("p_transfer", 1)?>
</span></div>
<?$hv=str_replace("\n","<br/>",fGetResultValues("hotel_frend"));?>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("hotel_frend")?>:<br/></span> <span class="npt"><?=$hv?></span></div>

<div class="tipetu"><span class="tpt"><?=fGetQuestion("d_konf")?>:</span> <span class="npt">
<?if(fGetResultValues("d_konf")==fGetValue("d_konf",0))echo fGetAnswer("d_konf", 0)?>
<?if(fGetResultValues("d_konf")==fGetValue("d_konf",1))echo fGetAnswer("d_konf", 1)?>
</span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("d_ujin")?>:</span> <span class="npt">
<?if(fGetResultValues("d_ujin")==fGetValue("d_ujin",0))echo fGetAnswer("d_ujin", 0)?>
<?if(fGetResultValues("d_ujin")==fGetValue("d_ujin",1))echo fGetAnswer("d_ujin", 1)?>
</span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("tour_1")?>:</span> <span class="npt">
<?if(fGetResultValues("tour_1")==fGetValue("tour_1",0))echo fGetAnswer("tour_1", 0)?>
<?if(fGetResultValues("tour_1")==fGetValue("tour_1",1))echo fGetAnswer("tour_1", 1)?>
</span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("tour_2")?>:</span> <span class="npt">
<?if(fGetResultValues("tour_2")==fGetValue("tour_2",0))echo fGetAnswer("tour_2", 0)?>
<?if(fGetResultValues("tour_2")==fGetValue("tour_2",1))echo fGetAnswer("tour_2", 1)?>
</span></div>
-->

<?
$cts_n=str_replace("\n","<br/>",$ctext_n);
$cts=str_replace("\n","<br/>",$ctext);
?>
<br/><br/>
<table><tr><td>
<span class="tpt"><?=fGetQuestion("money_2_calc")?>:<br/></span>
<div class="ctext">
<?=$cts_n?>
</div>
</td><td>
<span class="tpt"><?=fGetQuestion("money_calc")?>:<br/></span>
<div class="ctext">
<?=$cts?>
</td></tr></table>
<?$ct=str_replace("\n","<br/>",fGetResultValues("comments"));?>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("comments")?>:<br/></span> <span class="npt"><?=$ct?></span></div>

<div class="tipetu"><span class="tpt"><?=fGetQuestion("discount")?>:</span> <span class="npt"><?=fGetResultValues("discount")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("markup")?>:</span> <span class="npt"><?=fGetResultValues("markup")?></span></div>

<div class="tipetu"><span class="tpt"><?=fGetQuestion("minus")?>:</span> <span class="npt"><?=fGetResultValues("minus")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("plus")?>:</span> <span class="npt"><?=fGetResultValues("plus")?></span></div>
 
 <?$ct_a=str_replace("\n","<br/>",fGetResultValues("comments_admin"));?>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("comments_admin")?>:<br/></span> <span class="npt"><?=$ct_a?></span></div>

</div>
</td></tr></table>
<br /><br /><br /><br /><br />
 <!-- Кнопки -->
<div class="lic" id="lic_2">
<!-- кнопка сохранить -->
<!--<div class="but_bot_1"><div class="but_text"><?=GetMessage("TINOT_SAVE")?></div><input type="button" class="vst"  value="<?=GetMessage("BUT_BOT_1")?>" onclick="sub_form()"></div>-->
<!-- кнопка сохранить активная -->
<div class="but_bot_1"><input type="submit" name="web_form_submit" class="vst_a" value="<?=GetMessage("BUT_BOT_1")?>" ></div>

<!-- кнопка пауза -->
<!--<div class="but_bot_2"><div class="but_text"><?=GetMessage("TINOT_PAUSE")?></div><input type="button" class="vst" value=" &nbsp;&nbsp;&nbsp;&nbsp;<?=GetMessage("BUT_BOT_2")?>"></div>-->

<!-- кнопка к шагу ... не активная -->
<!--<div class="but_bot_3"><div class="but_text"><?=GetMessage("TINOT_STEP")?></div><input type="button" class="vst" value="<?=GetMessage("BUT_BOT_3_6")?>" onclick="sub_form()"></div>-->

<!-- кнопка к шагу ...  активная -->
<!--<div class="but_bot_3_a"><input type="submit" class="vst" value="<?=GetMessage("BUT_BOT_3_6")?>" name="web_form_submit"></div>-->

</div>

<!-- ///////////////////////////////////////// -->
 </form>
 </div>

<br/><br/><br/><br/><br/>


