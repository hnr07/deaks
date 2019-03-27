<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<? include "var_config.php"; ?>
<? include "functions.php"; ?>
<? include "../config/exchange.php"; ?>
<? //include_once "functions_leadership.php"; ?>
<?global $_lang;?>
<? include "note_error.php"; // Ошибки заполнения ?>

<script src="/jquery/jquery-1.6.2.js" type="text/javascript"></script>
<script src="/js/chosen/chosen.jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/js/chosen/chosen.css" />

<script type="text/javascript" src="/js/datepicker/date.js"></script>
<script type="text/javascript" src="/js/datepicker/jquery.datePicker-2.1.2.js"></script>

<!--Для выборки мест оч оч оч нужно --> 
<!--
<link href="js/jquery-ui-1.9.2.custom/css/smoothness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
<script src="js/jquery-ui-1.9.2.custom/js/jquery-1.8.3.js"></script>
<script src="js/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.js"></script>
-->
<!--Для выборки мест оч оч оч нужно --> 

<link rel="stylesheet" href="/js/datepicker/datepicker.css" type="text/css" /> 

<script type="text/javascript" src="/js/datepicker/cal.js"></script>
<script type="text/javascript" src="/js/datepicker/cal_2.js"></script>
<script type="text/javascript" src="/js/datepicker/cal_3.js"></script>
<script type="text/javascript" src="/js/datepicker/cal_4.js"></script>
<script type="text/javascript" src="/js/datepicker/cal_5.js"></script>
<script type="text/javascript" src="/js/datepicker/cal_6.js"></script>
<script type="text/javascript" src="/js/datepicker/cal_7.js"></script>
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
$(document).ready(function(){
$('#date_day_hotel_start_ls').simpleDatepicker_6();  // Привязать вызов календаря начала проживания к полю с CSS идентификатором 
});
$(document).ready(function(){
$('#date_day_hotel_finish_ls').simpleDatepicker_7();  // Привязать вызов календаря окончание проживания к полю с CSS идентификатором 
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

<tr valign="top">

<td class="td_left">

</td>

<td>

<div  class="right_b">



<div class="title_step">
<div id="title_step2">&nbsp;&nbsp;<?=GetMessage('TITLE_STEP1')?> &nbsp;<?=GetMessage('TITLE_ED1')?></div>

</div>
<div id="tr"></div>


<div class="form-required">
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>


<?=$arResult["FORM_NOTE"]?>
</div>

<? include "meter_hotel.php"; // файл подсчёта количества номеров ?>
<input type="hidden" id="meter_nomer" value="<?=$is_nora;?>">
<? include "meter_fly.php"; // файл подсчёта количества рейсов ?>
<input type="hidden" id="meter_fly" value="<?=$is_fly;?>">

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
	<?if(fGetResultValues("garant_chk")):?>
	<div class="tipetu"><span class="tpt"><?=fGetQuestion("garant_chk")?>:</span> <span class="npt"><?=fGetResultValues("garant_chk")?></span></div>
	<div class="tipetu"><span class="tpt"><?=fGetQuestion("garant_name")?>:</span> <span class="npt"><?=fGetResultValues("garant_name")?></span></div>
	<div class="tipetu"><span class="tpt"><?=fGetQuestion("garant_family")?>:</span> <span class="npt"><?=fGetResultValues("garant_family")?></span></div>
	<?endif?>
<?endif?>
<?if(fGetResultValues("oplata")==fGetValue("oplata",1)):?>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("oplata")?>:</span> <span class="npt"><?=fGetAnswer("oplata", 1)?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("op_country")?>:</span> <span class="npt"><?=fGetResultValues("op_country")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("op_city")?>:</span> <span class="npt"><?=fGetResultValues("op_city")?></span></div>
<div class="tipetu"><span class="tpt"><?=fGetQuestion("op_nof")?>:</span> <span class="npt"><?=fGetResultValues("op_nof")?></span></div>
<?endif?>



<!-- Скрытые поля  -->
<div class="nevid">

<!--  Java  -->
<input name="<?=fGetName("java")?>" value="<?=fGetValue("java",0)?>" type="radio" <?if(fGetResultValues("java")==fGetValue("java",0)) echo "checked";?> >
<input name="<?=fGetName("java")?>" value="<?=fGetValue("java",1)?>" type="radio" <?if(fGetResultValues("java")==fGetValue("java",1)) echo "checked";?> >
<!--  Статус  -->
<input name="<?=fGetName("status")?>" value="<?=fGetValue("status",0)?>" type="radio" <? if(fGetResultValues("status")==fGetValue("status",0)) echo "checked";?> >
<input name="<?=fGetName("status")?>" value="<?=fGetValue("status",1)?>" type="radio" <? if(fGetResultValues("status")==fGetValue("status",1)) echo "checked";?> >
<input name="<?=fGetName("status")?>" value="<?=fGetValue("status",2)?>" type="radio" <? if(fGetResultValues("status")==fGetValue("status",2)) echo "checked";?> >

<!--  № ЧК  -->
<input id="chk" name="<?=fGetName("chk",0)?>" value="<?=fGetResultValues("chk")?>"  type="text">
<!--  Имя  -->
<input  name="<?=fGetName("name",0)?>" value="<?=fGetResultValues("name")?>"  type="text">
<!--  Фамилия  -->
<input  name="<?=fGetName("family",0)?>" value="<?=fGetResultValues("family")?>"  type="text">
<!--  Кем приглашен № ЧК  -->
<input  name="<?=fGetName("kem_priglashen_chk",0)?>" value="<?=fGetResultValues("kem_priglashen_chk")?>"  type="text">
<!--  Кем приглашен имя  -->
<input  name="<?=fGetName("kem_priglashen_name",0)?>" value="<?=fGetResultValues("kem_priglashen_name")?>"  type="text">
<!--  Кем приглашен фамилия  -->
<input  name="<?=fGetName("kem_priglashen_family",0)?>" value="<?=fGetResultValues("kem_priglashen_family")?>"  type="text">

<!--  Отчество  -->
<input  name="<?=fGetName("middle_name",0)?>" value="<?=fGetResultValues("middle_name")?>"  type="text">
<!--  E-mail  -->
<input  name="<?=fGetName("email",0)?>" value="<?=fGetResultValues("email")?>"  type="text">
<!--  Телефон  -->
<input  name="<?=fGetName("tel",0)?>" value="<?=fGetResultValues("tel")?>"  type="text">
<!--  Скайп  -->
<input  name="<?=fGetName("skype",0)?>" value="<?=fGetResultValues("skype")?>"  type="text">
<!--  Доп. телефон   -->
<input  name="<?=fGetName("tel_2",0)?>" value="<?=fGetResultValues("tel_2")?>"  type="text">

<!--  Предпочтительный вид связи  -->
<input name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",0)?>" type="radio" <? if(fGetResultValues("prioritet")==fGetValue("prioritet",0)) echo "checked";?> >
<input name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",1)?>" type="radio" <? if(fGetResultValues("prioritet")==fGetValue("prioritet",1)) echo "checked";?> >
<input name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",2)?>" type="radio" <? if(fGetResultValues("prioritet")==fGetValue("prioritet",2)) echo "checked";?> >

<!--  Пол  -->
<input name="<?=fGetName("sex")?>" value="<?=fGetValue("sex",0)?>" type="radio" <? if(fGetResultValues("sex")==fGetValue("sex",0)) echo "checked";?> >
<input name="<?=fGetName("sex")?>" value="<?=fGetValue("sex",1)?>" type="radio" <? if(fGetResultValues("sex")==fGetValue("sex",1)) echo "checked";?> >
<!--  Возраст  -->
<input name="<?=fGetName("age")?>" value="<?=fGetValue("age",0)?>" type="radio" <?if(fGetResultValues("age")==fGetValue("age",0)) echo "checked";?> >
<input name="<?=fGetName("age")?>" value="<?=fGetValue("age",1)?>" type="radio" <?if(fGetResultValues("age")==fGetValue("age",1)) echo "checked";?> >
<input name="<?=fGetName("age")?>" value="<?=fGetValue("age",2)?>" type="radio" <?if(fGetResultValues("age")==fGetValue("age",2)) echo "checked";?> >
<input name="<?=fGetName("age")?>" value="<?=fGetValue("age",3)?>" type="radio" <?if(fGetResultValues("age")==fGetValue("age",3)) echo "checked";?> >
<!--  Гражданство  -->
<input  name="<?=fGetName("country",0)?>" value="<?=fGetResultValues("country")?>"  type="text">
<!--  Город проживания  -->
<input  name="<?=fGetName("city",0)?>" value="<?=fGetResultValues("city")?>"  type="text">
<!--  Дата рождения  -->
<input  name="<?=fGetName("birthday",0)?>" value="<?=fGetResultValues("birthday")?>"  type="text">

<!--  Вылюта заявки  -->
<input id="currency"  name="<?=fGetName("currency",0)?>" value="<?=fGetResultValues("currency")?>"  type="text">
<!--  ID вылюты заявки  -->
<input id="currency_id" name="<?=fGetName("currency_id",0)?>" value="<?=fGetResultValues("currency_id")?>"  type="text">
<!--  промоушен оплата  -->
<input id="promotion_3" name="<?=fGetName("promotion_3",0)?>" value="<?=fGetResultValues("promotion_3")?>"  type="text">

<!--  код проверки плательщика  -->
<input id="pl_ok_id" name="<?=fGetName("op_ok_id",0)?>" value="<?=fGetResultValues("op_ok_id")?>"  type="text">
<!--  код проверки гаранта  -->
<input id="garant_ok_id" name="<?=fGetName("op_ok_id",0)?>" value="<?=fGetResultValues("op_ok_id")?>"  type="text">

<!--  промоушен приглашение  -->
<input  name="<?=fGetName("promotion_1",0)?>" value="<?=fGetResultValues("promotion_1")?>"  type="text">
<!--  	e-mail из БД  -->
<input  name="<?=fGetName("em_bd",0)?>" value="<?=fGetResultValues("em_bd")?>"  type="text">
<!--  	Дата рождения из БД  -->
<input  name="<?=fGetName("dr_bd",0)?>" value="<?=fGetResultValues("dr_bd")?>"  type="text">
<!--  	Проверка пройдена  -->
<input  name="<?=fGetName("proverka",0)?>" value="<?=fGetResultValues("proverka")?>"  type="text">

<!--  Форма оплаты  -->
<input name="<?=fGetName("oplata")?>" value="<?=fGetValue("oplata",0)?>" type="radio" <? if(fGetResultValues("oplata")==fGetValue("oplata",0)) echo "checked";?> >
<input name="<?=fGetName("oplata")?>" value="<?=fGetValue("oplata",1)?>" type="radio" <? if(fGetResultValues("oplata")==fGetValue("oplata",1)) echo "checked";?> >

<!--  Страна  -->
<input  name="<?=fGetName("op_country",0)?>" value="<?=fGetResultValues("op_country")?>"  type="text">
<!--  Город  -->
<input  name="<?=fGetName("op_city",0)?>" value="<?=fGetResultValues("op_city")?>"  type="text">
<!--  № Офиса продаж  -->
<input  name="<?=fGetName("op_nof",0)?>" value="<?=fGetResultValues("op_nof")?>"  type="text">
<!--  Рассрочка для ОП  -->
<input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",0)?>" type="radio" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",0)) echo "checked";?> >
<input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",1)?>" type="radio" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",1)) echo "checked";?> >
<input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",2)?>" type="radio" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",2)) echo "checked";?> >
<input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",3)?>" type="radio" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",3)) echo "checked";?> >
<input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",4)?>" type="radio" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",4)) echo "checked";?> >
<input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",5)?>" type="radio" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",5)) echo "checked";?> >
<input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",6)?>" type="radio" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",6)) echo "checked";?> >

<!--  № ЧК плательщика  -->
<input  name="<?=fGetName("pl_chk",0)?>" value="<?=fGetResultValues("pl_chk")?>"  type="text">
<!--  Имя плательщика  -->
<input  name="<?=fGetName("pl_name",0)?>" value="<?=fGetResultValues("pl_name")?>"  type="text">
<!--  Фамилия плательщика  -->
<input  name="<?=fGetName("pl_family",0)?>" value="<?=fGetResultValues("pl_family")?>"  type="text">
<!--  № телефона плательщика  -->
<input  name="<?=fGetName("pl_phone",0)?>" value="<?=fGetResultValues("pl_phone")?>"  type="text">
<!--  Проверка плательщика  -->
<input  name="<?=fGetName("pl_ok",0)?>" value="<?=fGetResultValues("pl_ok")?>"  type="text">
<!--  № ЧК гаранта  -->
<input  name="<?=fGetName("garant_chk",0)?>" value="<?=fGetResultValues("garant_chk")?>"  type="text">
<!--  Имя гаранта  -->
<input  name="<?=fGetName("garant_name",0)?>" value="<?=fGetResultValues("garant_name")?>"  type="text">
<!--  Фамилия гаранта  -->
<input  name="<?=fGetName("garant_family",0)?>" value="<?=fGetResultValues("garant_family")?>"  type="text">
<!--  Проверка гаранта  -->
<input  name="<?=fGetName("garant_ok",0)?>" value="<?=fGetResultValues("garant_ok")?>"  type="text">
<!--  Рассрочка для чека  -->
<input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",0)?>" type="radio" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",0)) echo "checked";?> >
<input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",1)?>" type="radio" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",1)) echo "checked";?> >
<input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",2)?>" type="radio" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",2)) echo "checked";?> >
<input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",3)?>" type="radio" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",3)) echo "checked";?> >
<input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",4)?>" type="radio" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",4)) echo "checked";?> >
<input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",5)?>" type="radio" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",5)) echo "checked";?> >
<input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",6)?>" type="radio" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",6)) echo "checked";?> >

<!--  Наличие загранпаспорта  -->
<input name="<?=fGetName("p_nal")?>" value="<?=fGetValue("p_nal",0)?>" type="radio" <? if(fGetResultValues("p_nal")==fGetValue("p_nal",0)) echo "checked";?> >
<input name="<?=fGetName("p_nal")?>" value="<?=fGetValue("p_nal",1)?>" type="radio" <? if(fGetResultValues("p_nal")==fGetValue("p_nal",1)) echo "checked";?> >
<!--  Имя по загранпаспорту  -->
<input  name="<?=fGetName("p_name",0)?>" value="<?=fGetResultValues("p_name")?>"  type="text">
<!--  Фамилия по загранпаспорту  -->
<input  name="<?=fGetName("p_family",0)?>" value="<?=fGetResultValues("p_family")?>"  type="text">
<!--  Дата выдачи загранпаспорта  -->
<input  name="<?=fGetName("p_date",0)?>" value="<?=fGetResultValues("p_date")?>"  type="text">
<!--  Действие загранпаспорта  -->
<input  name="<?=fGetName("p_due_date",0)?>" value="<?=fGetResultValues("p_due_date")?>"  type="text">
<!--  Серия и номер загранпаспорта  -->
<input  name="<?=fGetName("p_sn",0)?>" value="<?=fGetResultValues("p_sn")?>"  type="text">
<!--  Скан загранпаспорта  -->
<?=fGetHTML("p_scan")?>
<!--  Нет паспорта? Укажите дату  -->
<input  name="<?=fGetName("p_ready",0)?>" value="<?=fGetResultValues("p_ready")?>"  type="text">

<!--  Скидка %  -->
<input  name="<?=fGetName("discount",0)?>" value="<?=fGetResultValues("discount")?>"  type="text">
<!--  Наценка %  -->
<input  name="<?=fGetName("markup",0)?>" value="<?=fGetResultValues("markup")?>"  type="text">
<!--  Минус  -->
<input  name="<?=fGetName("minus",0)?>" value="<?=fGetResultValues("minus")?>"  type="text">
<!--  Плюс  -->
<input  name="<?=fGetName("plus",0)?>" value="<?=fGetResultValues("plus")?>"  type="text">
<!--  Оформление визы  -->
<input name="<?=fGetName("p_viza")?>" value="<?=fGetValue("p_viza",0)?>" type="radio" <? if(fGetResultValues("p_viza")==fGetValue("p_viza",0)) echo "checked";?> >
<input name="<?=fGetName("p_viza")?>" value="<?=fGetValue("p_viza",1)?>" type="radio" <? if(fGetResultValues("p_viza")==fGetValue("p_viza",1)) echo "checked";?> >
<input name="<?=fGetName("p_viza")?>" value="<?=fGetValue("p_viza",2)?>" type="radio" <? if(fGetResultValues("p_viza")==fGetValue("p_viza",2)) echo "checked";?> >
<!--  Вариант перелета  -->
<input name="<?=fGetName("p_fly")?>" value="<?=fGetValue("p_fly",0)?>" type="radio" <? if(fGetResultValues("p_fly")==fGetValue("p_fly",0)) echo "checked";?> >
<input name="<?=fGetName("p_fly")?>" value="<?=fGetValue("p_fly",1)?>" type="radio" <? if(fGetResultValues("p_fly")==fGetValue("p_fly",1)) echo "checked";?> >
<!--  Перелет туда  -->
<input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",0)?>" type="radio" <? if(fGetResultValues("fly_1")==fGetValue("fly_1",0)) echo "checked";?> >
<input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",1)?>" type="radio" <? if(fGetResultValues("fly_1")==fGetValue("fly_1",1)) echo "checked";?> >
<input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",2)?>" type="radio" <? if(fGetResultValues("fly_1")==fGetValue("fly_1",2)) echo "checked";?> >
<input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",3)?>" type="radio" <? if(fGetResultValues("fly_1")==fGetValue("fly_1",3)) echo "checked";?> >
<input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",4)?>" type="radio" <? if(fGetResultValues("fly_1")==fGetValue("fly_1",4)) echo "checked";?> >
<input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",5)?>" type="radio" <? if(fGetResultValues("fly_1")==fGetValue("fly_1",5)) echo "checked";?> >
<input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",6)?>" type="radio" <? if(fGetResultValues("fly_1")==fGetValue("fly_1",6)) echo "checked";?> >
<input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",7)?>" type="radio" <? if(fGetResultValues("fly_1")==fGetValue("fly_1",7)) echo "checked";?> >
<!--  Перелет обратно  -->
<input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",0)?>" type="radio" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",0)) echo "checked";?> >
<input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",1)?>" type="radio" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",1)) echo "checked";?> >
<input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",2)?>" type="radio" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",2)) echo "checked";?> >
<input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",3)?>" type="radio" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",3)) echo "checked";?> >
<input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",4)?>" type="radio" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",4)) echo "checked";?> >
<input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",5)?>" type="radio" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",5)) echo "checked";?> >
<input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",6)?>" type="radio" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",6)) echo "checked";?> >
<input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",7)?>" type="radio" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",7)) echo "checked";?> >
<!--  Транcфер  -->
<input name="<?=fGetName("p_transfer")?>" value="<?=fGetValue("p_transfer",0)?>" type="radio" <? if(fGetResultValues("p_transfer")==fGetValue("p_transfer",0)) echo "checked";?> >
<input name="<?=fGetName("p_transfer")?>" value="<?=fGetValue("p_transfer",1)?>" type="radio" <? if(fGetResultValues("p_transfer")==fGetValue("p_transfer",1)) echo "checked";?> >
<!--  Вариант проживания  -->
<input name="<?=fGetName("p_hotel")?>" value="<?=fGetValue("p_hotel",0)?>" type="radio" <? if(fGetResultValues("p_hotel")==fGetValue("p_hotel",0)) echo "checked";?> >
<input name="<?=fGetName("p_hotel")?>" value="<?=fGetValue("p_hotel",1)?>" type="radio" <? if(fGetResultValues("p_hotel")==fGetValue("p_hotel",1)) echo "checked";?> >
<!--  Дата начала проживания   -->
<input  name="<?=fGetName("day_hotel_start",0)?>" value="<?=fGetResultValues("day_hotel_start")?>"  type="text">
<!--  Дата окончания проживания   -->
<input  name="<?=fGetName("day_hotel_finish",0)?>" value="<?=fGetResultValues("day_hotel_finish")?>"  type="text">
<!--  Отель  -->
<input name="<?=fGetName("hotel")?>" value="<?=fGetValue("hotel",0)?>" type="radio" <? if(fGetResultValues("hotel")==fGetValue("hotel",0)) echo "checked";?> >
<input name="<?=fGetName("hotel")?>" value="<?=fGetValue("hotel",1)?>" type="radio" <? if(fGetResultValues("hotel")==fGetValue("hotel",1)) echo "checked";?> >
<input name="<?=fGetName("hotel")?>" value="<?=fGetValue("hotel",2)?>" type="radio" <? if(fGetResultValues("hotel")==fGetValue("hotel",2)) echo "checked";?> >
<input name="<?=fGetName("hotel")?>" value="<?=fGetValue("hotel",3)?>" type="radio" <? if(fGetResultValues("hotel")==fGetValue("hotel",3)) echo "checked";?> >
<!--  Номер  -->
<input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",0)?>" type="radio" <? if(fGetResultValues("nomer")==fGetValue("nomer",0)) echo "checked";?> >
<input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",1)?>" type="radio" <? if(fGetResultValues("nomer")==fGetValue("nomer",1)) echo "checked";?> >
<input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",2)?>" type="radio" <? if(fGetResultValues("nomer")==fGetValue("nomer",2)) echo "checked";?> >
<input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",3)?>" type="radio" <? if(fGetResultValues("nomer")==fGetValue("nomer",3)) echo "checked";?> >
<input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",4)?>" type="radio" <? if(fGetResultValues("nomer")==fGetValue("nomer",4)) echo "checked";?> >
<input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",5)?>" type="radio" <? if(fGetResultValues("nomer")==fGetValue("nomer",5)) echo "checked";?> >
<input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",6)?>" type="radio" <? if(fGetResultValues("nomer")==fGetValue("nomer",6)) echo "checked";?> >
<input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",7)?>" type="radio" <? if(fGetResultValues("nomer")==fGetValue("nomer",7)) echo "checked";?> >
<input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",8)?>" type="radio" <? if(fGetResultValues("nomer")==fGetValue("nomer",8)) echo "checked";?> >
<!--  Гостевая карта  -->
<input name="<?=fGetName("guest_card")?>" value="<?=fGetValue("guest_card",0)?>" type="radio" <? if(fGetResultValues("guest_card")==fGetValue("guest_card",0)) echo "checked";?> >
<input name="<?=fGetName("guest_card")?>" value="<?=fGetValue("guest_card",1)?>" type="radio" <? if(fGetResultValues("guest_card")==fGetValue("guest_card",1)) echo "checked";?> >
<!--  Участие в конференции  -->
<input name="<?=fGetName("d_konf")?>" value="<?=fGetValue("d_konf",0)?>" type="radio" <? if(fGetResultValues("d_konf")==fGetValue("d_konf",0)) echo "checked";?> >
<input name="<?=fGetName("d_konf")?>" value="<?=fGetValue("d_konf",1)?>" type="radio" <? if(fGetResultValues("d_konf")==fGetValue("d_konf",1)) echo "checked";?> >
<!--  Участие в гала ужине  -->
<input name="<?=fGetName("d_ujin")?>" value="<?=fGetValue("d_ujin",0)?>" type="radio" <? if(fGetResultValues("d_ujin")==fGetValue("d_ujin",0)) echo "checked";?> >
<input name="<?=fGetName("d_ujin")?>" value="<?=fGetValue("d_ujin",1)?>" type="radio" <? if(fGetResultValues("d_ujin")==fGetValue("d_ujin",1)) echo "checked";?> >
<!--  Питание в гостинице  -->
<input name="<?=fGetName("d_eat_1")?>" value="<?=fGetValue("d_eat_1",0)?>" type="radio" <? if(fGetResultValues("d_eat_1")==fGetValue("d_eat_1",0)) echo "checked";?> >
<input name="<?=fGetName("d_eat_1")?>" value="<?=fGetValue("d_eat_1",1)?>" type="radio" <? if(fGetResultValues("d_eat_1")==fGetValue("d_eat_1",1)) echo "checked";?> >
<input name="<?=fGetName("d_eat_1")?>" value="<?=fGetValue("d_eat_1",2)?>" type="radio" <? if(fGetResultValues("d_eat_1")==fGetValue("d_eat_1",2)) echo "checked";?> >
<input name="<?=fGetName("d_eat_1")?>" value="<?=fGetValue("d_eat_1",3)?>" type="radio" <? if(fGetResultValues("d_eat_1")==fGetValue("d_eat_1",3)) echo "checked";?> >
<!--  Питание на конференции  -->
<input name="<?=fGetName("d_eat_2")?>" value="<?=fGetValue("d_eat_2",0)?>" type="radio" <? if(fGetResultValues("d_eat_2")==fGetValue("d_eat_2",0)) echo "checked";?> >
<input name="<?=fGetName("d_eat_2")?>" value="<?=fGetValue("d_eat_2",1)?>" type="radio" <? if(fGetResultValues("d_eat_2")==fGetValue("d_eat_2",1)) echo "checked";?> >
<input name="<?=fGetName("d_eat_2")?>" value="<?=fGetValue("d_eat_2",2)?>" type="radio" <? if(fGetResultValues("d_eat_2")==fGetValue("d_eat_2",2)) echo "checked";?> >
<input name="<?=fGetName("d_eat_2")?>" value="<?=fGetValue("d_eat_2",3)?>" type="radio" <? if(fGetResultValues("d_eat_2")==fGetValue("d_eat_2",3)) echo "checked";?> >
<!--  Участие в экскурсии 1  -->
<input name="<?=fGetName("tour_1")?>" value="<?=fGetValue("tour_1",0)?>" type="radio" <? if(fGetResultValues("tour_1")==fGetValue("tour_1",0)) echo "checked";?> >
<input name="<?=fGetName("tour_1")?>" value="<?=fGetValue("tour_1",1)?>" type="radio" <? if(fGetResultValues("tour_1")==fGetValue("tour_1",1)) echo "checked";?> >
<!--  Участие в экскурсии 2  -->
<input name="<?=fGetName("tour_2")?>" value="<?=fGetValue("tour_2",0)?>" type="radio" <? if(fGetResultValues("tour_2")==fGetValue("tour_2",0)) echo "checked";?> >
<input name="<?=fGetName("tour_2")?>" value="<?=fGetValue("tour_2",1)?>" type="radio" <? if(fGetResultValues("tour_2")==fGetValue("tour_2",1)) echo "checked";?> >
<!--  Участие в экскурсии 3  -->
<input name="<?=fGetName("tour_3")?>" value="<?=fGetValue("tour_3",0)?>" type="radio" <? if(fGetResultValues("tour_3")==fGetValue("tour_3",0)) echo "checked";?> >
<input name="<?=fGetName("tour_3")?>" value="<?=fGetValue("tour_3",1)?>" type="radio" <? if(fGetResultValues("tour_3")==fGetValue("tour_3",1)) echo "checked";?> >
<!--  Размер футболки  -->
<input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",0)?>" type="radio" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",0)) echo "checked";?> >
<input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",1)?>" type="radio" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",1)) echo "checked";?> >
<input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",2)?>" type="radio" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",2)) echo "checked";?> >
<input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",3)?>" type="radio" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",3)) echo "checked";?> >
<input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",4)?>" type="radio" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",4)) echo "checked";?> >
<input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",5)?>" type="radio" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",5)) echo "checked";?> >
<!--  Медицинская страховка  -->
<input name="<?=fGetName("medical_insurance")?>" value="<?=fGetValue("medical_insurance",0)?>" type="radio" <? if(fGetResultValues("medical_insurance")==fGetValue("medical_insurance",0)) echo "checked";?> >
<input name="<?=fGetName("medical_insurance")?>" value="<?=fGetValue("medical_insurance",1)?>" type="radio" <? if(fGetResultValues("medical_insurance")==fGetValue("medical_insurance",1)) echo "checked";?> >
<!--  Стоимость мероприятия в у. е.  -->
<input  name="<?=fGetName("money",0)?>" value="<?=fGetResultValues("money")?>"  type="text">
<!--  Стоимость в Вашей валюте  -->
<input  name="<?=fGetName("money_2",0)?>" value="<?=fGetResultValues("money_2")?>"  type="text">

<!--  Оплачено в базовой валюте в у. е.  -->
<input  name="<?=fGetName("t_money",0)?>" value="<?=fGetResultValues("t_money")?>"  type="text">
<!--  Оплачено в Вашей валюте  -->
<input  name="<?=fGetName("t_money_2",0)?>" value="<?=fGetResultValues("t_money_2")?>"  type="text">

<!--  Дата поступления заявки  -->
<input  name="<?=fGetName("claimdate",0)?>" value="<?=fGetResultValues("claimdate")?>"  type="text">

<!--  Калькуляция стоимости мероприятия в у. е.  -->
<textarea name="<?=fGetName("money_calc",0)?>"><?=$ctext;?></textarea>
<!--  Калькуляция стоимости мероприятия в нац. валюте  -->
<textarea name="<?=fGetName("money_2_calc",0)?>"><?=$ctext_n;?></textarea>

<!--  Дата последнего платежа  -->
<input  name="<?=fGetName("date_endpay",0)?>" value="<?=fGetResultValues("date_endpay")?>"  type="text">
<!--  Сумма задолженности  -->
<input  name="<?=fGetName("sum_debt",0)?>" value="<?=fGetResultValues("sum_debt")?>"  type="text">
<!--  Стоимость в Вашей валюте  -->
<input  name="<?=fGetName("sum_debt",0)?>" value="<?=fGetResultValues("sum_debt")?>"  type="text">
<!--  Дата выставления счёта  -->
<input  name="<?=fGetName("billingdate",0)?>" value="<?=fGetResultValues("billingdate")?>"  type="text">
<!--  ФИО соседа по номеру  -->
<textarea name="<?=fGetName("hotel_frend",0)?>"><?=fGetResultValues("hotel_frend", 0);?></textarea>
<!--  Комментарий  -->
<textarea name="<?=fGetName("comments",0)?>"><?=fGetResultValues("comments", 0);?></textarea>
<!--  Комментарий администратора  -->
<textarea name="<?=fGetName("comments_admin",0)?>"><?=fGetResultValues("comments_admin", 0);?></textarea>
<!--  Метка  -->
<input  name="<?=fGetName("metka",0)?>" value="<?=fGetResultValues("metka")?>"  type="text">
<!--  Карточка  -->
<input  name="<?=fGetName("card",0)?>" value="<?=fGetResultValues("card")?>"  type="text">

<!--  Дата изменения  -->
<input  name="<?=fGetName("date_edit",0)?>" value="<?=date("d.m.Y")?>"  type="text">
<!--  Ключ изменения  -->
<input  name="<?=fGetName("key_edit",0)?>" value="0"  type="text">
<!--  Копия  -->
<input  name="<?=fGetName("copy",0)?>" value="<?=fGetResultValues("copy")?>"  type="text">

<!--  История изменения статусов -->
<input  name="<?=fGetName("history_status",0)?>" value="<?=fGetResultValues("history_status")?>"  type="text">
<!--  Истёк срок оплаты -->
<input  name="<?=fGetName("expired",0)?>" value="<?=fGetResultValues("expired")?>"  type="text">

<!--  Участие в Leader Ship  -->
<input name="<?=fGetName("d_leader_ship")?>" value="<?=fGetValue("d_leader_ship",0)?>" type="radio" <? if(fGetResultValues("d_leader_ship")==fGetValue("d_leader_ship",0)) echo "checked";?> >
<input name="<?=fGetName("d_leader_ship")?>" value="<?=fGetValue("d_leader_ship",1)?>" type="radio" <? if(fGetResultValues("d_leader_ship")==fGetValue("d_leader_ship",1)) echo "checked";?> >

<!--  Соучастие в Leader Ship  -->
<input name="<?=fGetName("s_leader_ship")?>" value="<?=fGetValue("s_leader_ship",0)?>" type="radio" <? if(fGetResultValues("s_leader_ship")==fGetValue("s_leader_ship",0)) echo "checked";?> >
<input name="<?=fGetName("s_leader_ship")?>" value="<?=fGetValue("s_leader_ship",1)?>" type="radio" <? if(fGetResultValues("s_leader_ship")==fGetValue("s_leader_ship",1)) echo "checked";?> >

<!--  Дата начала проживания на Leader Ship   -->
<input  name="<?=fGetName("day_hotel_start_ls",0)?>" value="<?=fGetResultValues("day_hotel_start_ls")?>"  type="text">
<!--  Дата окончания проживания на Leader Ship   -->
<input  name="<?=fGetName("day_hotel_finish_ls",0)?>" value="<?=fGetResultValues("day_hotel_finish_ls")?>"  type="text">

<!--  Отель на Leader Ship  -->
<input name="<?=fGetName("hotel_ls")?>" value="<?=fGetValue("hotel_ls",0)?>" type="radio" <? if(fGetResultValues("hotel_ls")==fGetValue("hotel_ls",0)) echo "checked";?> >
<input name="<?=fGetName("hotel_ls")?>" value="<?=fGetValue("hotel_ls",1)?>" type="radio" <? if(fGetResultValues("hotel_ls")==fGetValue("hotel_ls",1)) echo "checked";?> >
<input name="<?=fGetName("hotel_ls")?>" value="<?=fGetValue("hotel_ls",2)?>" type="radio" <? if(fGetResultValues("hotel_ls")==fGetValue("hotel_ls",2)) echo "checked";?> >
<input name="<?=fGetName("hotel_ls")?>" value="<?=fGetValue("hotel_ls",3)?>" type="radio" <? if(fGetResultValues("hotel_ls")==fGetValue("hotel_ls",3)) echo "checked";?> >
<!--  Номер на Leader Ship  -->
<input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",0)?>" type="radio" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",0)) echo "checked";?> >
<input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",1)?>" type="radio" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",1)) echo "checked";?> >
<input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",2)?>" type="radio" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",2)) echo "checked";?> >
<input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",3)?>" type="radio" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",3)) echo "checked";?> >
<input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",4)?>" type="radio" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",4)) echo "checked";?> >
<input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",5)?>" type="radio" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",5)) echo "checked";?> >
<input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",6)?>" type="radio" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",6)) echo "checked";?> >
<input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",7)?>" type="radio" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",7)) echo "checked";?> >
<input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",8)?>" type="radio" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",8)) echo "checked";?> >
<input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",9)?>" type="radio" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",9)) echo "checked";?> >
<input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",10)?>" type="radio" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",10)) echo "checked";?> >

<!--  Синхронный перевод  -->
<input  name="<?=fGetName("interpretation",0)?>" value="<?=fGetResultValues("interpretation")?>"  type="text">
<!--  Выберите язык для синхронного перевода  -->
<input  name="<?=fGetName("interpretation_lang",0)?>" value="<?=fGetResultValues("interpretation_lang")?>"  type="text">
<!--  Дополнительный язык для синхронного перевода  -->
<input  name="<?=fGetName("second_interpretation_lang",0)?>" value="<?=fGetResultValues("second_interpretation_lang")?>"  type="text">

</div>

<?if (fGetResultValues("status")==fGetValue("status",0)):?>

	<!--  № ЧК -->
	<?if(fGetActive("chk")):?>
	<div class="ti_blo" id="ti_blo_chk">
	<input type="hidden" value="<?=fGetResultValues("chk")?>">
		 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("chk")?></div><input type="text" id="" name="<?=fGetName("chk")?>" value="<?=fGetResultValues("chk")?>" class="" type="text" onkeyup="sub_but()"></div>
	<?if(fGetComments("chk")):?><div class="qm"><div class="qm_text"><?=fGetComments("chk")?></div></div><?endif?>
	</div>
	<?endif?>
	
	<!--  Фамилия -->
	<?if(fGetActive("family")):?>
	<div class="ti_blo" id="ti_blo_family">
		 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("family")?></div><input id="" name="<?=fGetName("family")?>" value="<?=fGetResultValues("family")?>" class="" type="text" onkeyup="sub_but()"></div>
	<?if(fGetComments("family")):?><div class="qm"><div class="qm_text"><?=fGetComments("family")?></div></div><?endif?>
	</div>
	<?endif?>
	
	<!--  Имя -->
	<?if(fGetActive("name")):?>
	<div class="ti_blo" id="ti_blo_name">
		 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("name")?></div><input id="" name="<?=fGetName("name")?>" value="<?=fGetResultValues("name")?>" class="" type="text" onkeyup="sub_but()"></div>
	<?if(fGetComments("name")):?><div class="qm"><div class="qm_text"><?=fGetComments("name")?></div></div><?endif?>
	</div>
	<?endif?>
	
	<!--  История изменения № ЧК участников -->
	<?if(fGetActive("history_chk")):?>
	<div class="ti_blo" id="ti_blo_history_chk">
		 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("history_chk")?></div><input id="" name="<?=fGetName("history_chk")?>" value="<?=fGetResultValues("history_chk")?>" class="" type="text" onkeyup="sub_but()" readonly="readonly"></div>
	<?if(fGetComments("history_chk")):?><div class="qm"><div class="qm_text"><?=fGetComments("history_chk")?></div></div><?endif?>
	</div>
	<?endif?>

<?endif?>

<!--  Отчество  -->
<?if(fGetActive("middle_name")):?>
<div class="ti_blo" id="ti_blo_middle_name">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("middle_name")?></div><input id="" name="<?=fGetName("middle_name")?>" value="<?=fGetResultValues("middle_name")?>" class="" type="text" onkeyup="sub_but()"></div>
<?if(fGetComments("middle_name")):?><div class="qm"><div class="qm_text"><?=fGetComments("middle_name")?></div></div><?endif?>
</div>
<?endif?>

<div id="pvs">
<!--  E-mail  -->
<?if(fGetActive("email")):?>
<div class="ti_blo" id="ti_blo_email">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("email")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("email")?>" value="<?=fGetResultValues("email")?>" class="" type="text" onkeyup="sub_but()"></div>
<?if(fGetComments("email")):?><div class="qm"><div class="qm_text"><?=fGetComments("email")?></div></div><?endif?>
<div class="ti_dil"><input id="pr0" class="" name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",0)?>" type="radio" onchange="sub_but()" <? if(fGetResultValues("prioritet")==fGetValue("prioritet",0)) echo "checked";?>> <label for="pr0"><?=fGetQuestion("prioritet");?></label></div> 
</div>
<?endif?>

<!--  Телефон  -->
<?if(fGetActive("tel")):?>
<div class="ti_blo" id="ti_blo_tel">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("tel")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("tel")?>" value="<?=fGetResultValues("tel")?>" class="" type="text" onkeyup="sub_but()"></div>
<?if(fGetComments("tel")):?><div class="qm"><div class="qm_text"><?=fGetComments("tel")?></div></div><?endif?>
<div class="ti_dil"><input id="pr1" class="" name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",1)?>" type="radio" checked onchange="sub_but()" <? if(fGetResultValues("prioritet")==fGetValue("prioritet",1)) echo "checked";?>> <label for="pr1"><?=fGetQuestion("prioritet");?></label></div>
</div>
<?endif?>

<!--  Скайп  -->
<?if(fGetActive("skype")):?>
<div class="ti_blo" id="ti_blo_skype">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("skype")?></div><input id="" name="<?=fGetName("skype")?>" value="<?=fGetResultValues("skype")?>" class="" type="text" onkeyup="sub_but()"></div>
<?if(fGetComments("skype")):?><div class="qm"><div class="qm_text"><?=fGetComments("skype")?></div></div><?endif?>
<div class="ti_dil"><input type="hidden" value="<?=fGetValue("prioritet",2)?>"><input id="pr2" class="" name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",2)?>" type="radio" onchange="sub_but()" <? if(fGetResultValues("prioritet")==fGetValue("prioritet",2)) echo "checked";?>> <label for="pr2"><?=fGetQuestion("prioritet");?></label></div>
</div>
<?endif?>

<!--  Доп. E-mail  -->
<?if(fGetActive("email_2")):?>
<div class="ti_blo" id="ti_blo_email_2">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("email_2")?></div><input id="" name="<?=fGetName("email_2")?>" value="<?=fGetResultValues("email_2")?>" class="" type="text" onkeyup="sub_but()"></div>
<?if(fGetComments("email_2")):?><div class="qm"><div class="qm_text"><?=fGetComments("email_2")?></div></div><?endif?>
</div>
<?endif?>

<!--  Доп. телефон  -->
<?if(fGetActive("tel_2")):?>
<div class="ti_blo" id="ti_blo_tel_2">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("tel_2")?></div><input id="" name="<?=fGetName("tel_2")?>" value="<?=fGetResultValues("tel_2")?>" class="" type="text" onkeyup="sub_but()"></div>
<?if(fGetComments("tel_2")):?><div class="qm"><div class="qm_text"><?=fGetComments("tel_2")?></div></div><?endif?>
</div>
<?endif?>
</div>

<!--  Пол  -->
<?if(fGetActive("sex")):?>
<div class="ti_blo" id="ti_blo_sex" onkeyup="sub_but()">

<input type="hidden" value="<?=fGetValue("sex",0)?>"><input type="hidden" value="<?=fGetValue("sex",0)?>">
<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("sex")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="sx_0"><input name="<?=fGetName("sex")?>" value="<?=fGetValue("sex",0)?>" class="" id="sx0" type="radio" onchange="sub_but()"<? if(fGetResultValues("sex")==fGetValue("sex",0)) echo "checked";?>><label for="sx0"> <?=fGetAnswer("sex", 0);?></label></div>

	<div class="ti_dis" id="sx_1"><input name="<?=fGetName("sex")?>" value="<?=fGetValue("sex",1)?>" class="" id="sx1" type="radio" onchange="sub_but()"<? if(fGetResultValues("sex")==fGetValue("sex",1)) echo "checked";?>><label for="sx1"> <?=fGetAnswer("sex", 1);?></label></div>

</div>


</div>
<?if(fGetComments("sex")):?><div class="qm"><div class="qm_text"><?=fGetComments("sex")?></div></div><?endif?>
</div>
<?endif?>

<!--  Дата рождения  -->
<?if(fGetActive("birthday")):?>
<div class="ti_blo" id="ti_blo_birthday"  onkeyup="sub_but()">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("birthday")?><span class="zred"> *</span></div><input id="date_b" name="<?=fGetName("birthday")?>" value="<?=fGetResultValues("birthday")?>" class="" type="text" readonly onchange="sub_but()"></div>
<?if(fGetComments("birthday")):?><div class="qm"><div class="qm_text"><?=fGetComments("birthday")?></div></div><?endif?>
</div>
<?endif?>

<!--  Возраст  -->
<?if(fGetActive("age")):?>
<div class="ti_blo" id="ti_blo_age" onkeyup="sub_but()">

<input type="hidden" value="<?=fGetValue("age",0)?>"><input type="hidden" value="<?=fGetValue("age",0)?>">
<input type="hidden" value="<?=fGetValue("age",1)?>"><input type="hidden" value="<?=fGetValue("age",1)?>">
<input type="hidden" value="<?=fGetValue("age",2)?>"><input type="hidden" value="<?=fGetValue("age",2)?>">
<input type="hidden" value="<?=fGetValue("age",3)?>"><input type="hidden" value="<?=fGetValue("age",3)?>">
<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("age")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="ag_0"><input name="<?=fGetName("age")?>" value="<?=fGetValue("age",0)?>" class="" id="ag0" type="radio" onchange="sub_but()"<? if(fGetResultValues("age")==fGetValue("age",0)) echo "checked";?>><label for="ag0"> <?=fGetAnswer("age", 0);?></label></div>

	<div class="ti_dis" id="ag_1"><input name="<?=fGetName("age")?>" value="<?=fGetValue("age",1)?>" class="" id="ag1" type="radio" onchange="sub_but()"<? if(fGetResultValues("age")==fGetValue("age",1)) echo "checked";?>><label for="ag1"> <?=fGetAnswer("age", 1);?></label></div>

	<div class="ti_dis" id="ag_2"><input name="<?=fGetName("age")?>" value="<?=fGetValue("age",2)?>" class="" id="ag2" type="radio" onchange="sub_but()"<? if(fGetResultValues("age")==fGetValue("age",2)) echo "checked";?>><label for="ag2"> <?=fGetAnswer("age", 2);?></label></div>

	<div class="ti_dis" id="ag_3"><input name="<?=fGetName("age")?>" value="<?=fGetValue("age",3)?>" class="" id="ag3" type="radio" onchange="sub_but()"<? if(fGetResultValues("age")==fGetValue("age",3)) echo "checked";?>><label for="ag3"> <?=fGetAnswer("age", 3);?></label></div>

</div>


</div>
<?if(fGetComments("age")):?><div class="qm"><div class="qm_text"><?=fGetComments("age")?></div></div><?endif?>
</div>
<?endif?>

<!--  Гражданство  -->
<?if(fGetActive("country")):?>
<? include "../list_countries.php"; ?>
<div class="ti_blo" id="ti_blo_country" >

<div class="ti_dig"><div class="tiqa"><?=fGetQuestion("country")?><span class="zred"> *</span></div>
<div class="vsta">
<select name="<?=fGetName("country",0)?>" id="sel_country" class='chzn-select' onchange="sub_but()">
<?php

$coc=count($ar_part_world[$_lang]);
for($i=0;$i<$coc;$i++)
	{
	//if($i>0 && !($i%3)) echo "</div><div class='col_co'>";
	//echo "<div class='ticou'>".$ar_part_world[$i]."</div>";
	$v_ar_c=@explode(";",$ar_country[$_lang][$i]);
	asort($v_ar_c);
		foreach($v_ar_c as $val) {
		echo "<option";
		if(fGetResultValues("country", 0)==$val) echo " selected";
		echo ">".$val."</option>";
		}
	}
?>
</select>
</div>
</div>
<?if(fGetComments("country")):?><div class="qm"><div class="qm_text"><?=fGetComments("country")?></div></div><?endif?>
<script type="text/javascript"> 
$(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true});
 </script>

 </div>
<?endif?> 
 
 <!--  Город проживания  -->
<?if(fGetActive("city")):?>
<div class="ti_blo" id="ti_blo_city">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("city")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("city")?>" value="<?=fGetResultValues("city")?>" class="" type="text" onkeyup="sub_but()"></div>
<?if(fGetComments("city")):?><div class="qm"><div class="qm_text"><?=fGetComments("city")?></div></div><?endif?>
</div>
<?endif?>

<!--  Наличие загранпаспорта  -->
<?if(fGetActive("p_nal")):?>
<div class="ti_blo" id="ti_blo_p_nal">

<input type="hidden" value="<?=fGetValue("p_nal",0)?>">
<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("p_nal")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="p_nal_0"><input name="<?=fGetName("p_nal")?>" value="<?=fGetValue("p_nal",0)?>" class="" id="p_nal0" type="radio" onchange="sub_but()" <? if(fGetResultValues("p_nal")==fGetValue("p_nal",0)) echo "checked";?>><label for="p_nal0"> <?=fGetAnswer("p_nal", 0);?></label></div>

	<div class="ti_dis" id="p_nal_1"><input name="<?=fGetName("p_nal")?>" value="<?=fGetValue("p_nal",1)?>" class="" id="p_nal1" type="radio" onchange="sub_but()" <? if(fGetResultValues("p_nal")==fGetValue("p_nal",1)) echo "checked";?>><label for="p_nal1"> <?=fGetAnswer("p_nal", 1);?></label></div>


</div>


</div>
<?if(fGetComments("p_nal")):?><div class="qm"><div class="qm_text"><?=fGetComments("p_nal")?></div></div><?endif?>
</div>
<?endif?>

<div id="p_nal_ok">
  <!--  Имя по загранпаспорту  -->
<?if(fGetActive("p_name")):?>
<div class="ti_blo" id="ti_blo_p_name">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("p_name")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("p_name")?>" value="<?=fGetResultValues("p_name")?>" class="" type="text" onkeyup="sub_but()"></div>
<?if(fGetComments("p_name")):?><div class="qm"><div class="qm_text"><?=fGetComments("p_name")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Фамилия по загранпаспорту  -->
<?if(fGetActive("p_family")):?>
<div class="ti_blo" id="ti_blo_p_family">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("p_family")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("p_family")?>" value="<?=fGetResultValues("p_family")?>" class="" type="text" onkeyup="sub_but()"></div>
<?if(fGetComments("p_family")):?><div class="qm"><div class="qm_text"><?=fGetComments("p_family")?></div></div><?endif?>
</div>
<?endif?>

<!--  Дата выдачи загранпаспорта  -->
<?if(fGetActive("p_date")):?>
<div class="ti_blo" id="ti_blo_p_date"  onkeyup="sub_but()" onmouseout="sub_but()">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("p_date")?><span class="zred"> *</span></div><input id="date_vp" name="<?=fGetName("p_date")?>" value="<?=fGetResultValues("p_date")?>" class="" type="text" readonly onchange="sub_but()"></div>
<?if(fGetComments("p_date")):?><div class="qm"><div class="qm_text"><?=fGetComments("p_date")?></div></div><?endif?>
</div>
<?endif?>

<!--  Действие загранпаспорта  -->
<?if(fGetActive("p_due_date")):?>
<div class="ti_blo" id="ti_blo_p_due_date"  onkeyup="sub_but()" onmouseout="sub_but()">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("p_due_date")?><span class="zred"> *</span></div><input id="date_dp" name="<?=fGetName("p_due_date")?>" value="<?=fGetResultValues("p_due_date")?>" class="" type="text" readonly onchange="sub_but()"></div>
<?if(fGetComments("p_due_date")):?><div class="qm"><div class="qm_text"><?=fGetComments("p_due_date")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Серия и номер загранпаспорта  -->
<?if(fGetActive("p_sn")):?>
<div class="ti_blo" id="ti_blo_p_sn" onmouseout="sub_but()">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("p_sn")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("p_sn")?>" value="<?=fGetResultValues("p_sn")?>" class="" type="text" onkeyup="sub_but()"></div>
<?if(fGetComments("p_sn")):?><div class="qm"><div class="qm_text"><?=fGetComments("p_sn")?></div></div><?endif?>
</div>
<?endif?>
 
 <!--  Скан загранпаспорта  -->
<?if(fGetActive("p_scan")):?>
<div class="ti_blo" id="ti_blo_p_scan" onkeyup="sub_but()" onmouseout="sub_but()">
<div class="ti_dig"><div class="tiqa"><?=fGetQuestion("p_scan")?></div><?=fGetHTML("p_scan")?></div>
<?if(fGetComments("p_scan")):?><div class="qm"><div class="qm_text"><?=fGetComments("p_scan")?></div></div><?endif?>
</div>
<?endif?>

</div>

<div id="p_nal_not">
<!--  Нет паспорта? Укажите дату  -->
<?if(fGetActive("p_ready")):?>
<div class="ti_blo" id="ti_blo_p_ready"  onmouseout="sub_but()">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("p_ready")?><span class="zred"> *</span></div><input id="date_rp" name="<?=fGetName("p_ready")?>" value="<?=fGetResultValues("p_ready")?>" class="" type="text" onchange="sub_but()"></div>
<?if(fGetComments("p_ready")):?><div class="qm"><div class="qm_text"><?=fGetComments("p_ready")?></div></div><?endif?>
</div>
<?endif?>
<div class="not_f" onmouseout="sub_but()"><?=GetMessage("NPUD")?></div>
 </div>

<!--  Оформление визы  -->
<?if(fGetActive("p_viza")):?>
<div class="ti_blo" id="ti_blo_p_viza" onmouseout="sub_but()">
<input type="hidden" value="<?=fGetValue("p_viza",0)?>">
<input type="hidden" id="yes_visa" value="<?=$yes_visa?>">

<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("p_viza")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="p_viza_0"><input name="<?=fGetName("p_viza")?>" value="<?=fGetValue("p_viza",0)?>" class="" id="p_viza0" type="radio" onchange="sub_but()" <? if(fGetResultValues("p_viza")==fGetValue("p_viza",0)) echo "checked";?>><label for="p_viza0"> <?=fGetAnswer("p_viza", 0);?></label></div>

	<div class="ti_dis" id="p_viza_1"><input name="<?=fGetName("p_viza")?>" value="<?=fGetValue("p_viza",1)?>" class="" id="p_viza1" type="radio" onchange="sub_but()" <? if(fGetResultValues("p_viza")==fGetValue("p_viza",1)) echo "checked";?>><label for="p_viza1"> <?=fGetAnswer("p_viza", 1);?></label></div>
	
	<div class="ti_dis" id="p_viza_2"><input name="<?=fGetName("p_viza")?>" value="<?=fGetValue("p_viza",2)?>" class="" id="p_viza2" type="radio" onchange="sub_but()" <? if(fGetResultValues("p_viza")==fGetValue("p_viza",2)) echo "checked";?>><label for="p_viza2"> <?=fGetAnswer("p_viza", 2);?></label></div>

</div>

</div>
<?if(fGetComments("p_viza")):?><div class="qm"><div class="qm_text"><?=fGetComments("p_viza")?></div></div><?endif?>
</div>
<?endif?>


  <!--  Вариант проживания  -->
<?if(fGetActive("p_hotel")):?>
<div class="ti_blo" id="ti_blo_p_hotel">
<input type="hidden" value="<?=fGetValue("p_hotel",0)?>">

<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("p_hotel")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="p_hotel_0"><input name="<?=fGetName("p_hotel")?>" value="<?=fGetValue("p_hotel",0)?>" class="" id="p_hotel0" type="radio" onchange="sub_but()" <? if(fGetResultValues("p_hotel")==fGetValue("p_hotel",0)) echo "checked";?>><label for="p_hotel0"> <?=fGetAnswer("p_hotel", 0);?></label></div>

	<div class="ti_dis" id="p_hotel_1"><input name="<?=fGetName("p_hotel")?>" value="<?=fGetValue("p_hotel",1)?>" class="" id="p_hotel1" type="radio" onchange="sub_but()" <? if(fGetResultValues("p_hotel")==fGetValue("p_hotel",1)) echo "checked";?>><label for="p_hotel1"> <?=fGetAnswer("p_hotel", 1);?></label></div>

</div>

</div>
<?if(fGetComments("p_hotel")):?><div class="qm"><div class="qm_text"><?=fGetComments("p_hotel")?></div></div><?endif?>
</div>
<?endif?>


<div id="hotel_to">

<!--  Дата начала проживания  -->
<?if(fGetActive("day_hotel_start")):?>
<div class="ti_blo" id="ti_blo_day_hotel_start"  onkeyup="sub_but()" onmouseout="sub_but()">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("day_hotel_start")?><span class="zred"> *</span></div>

	 <input id="date_day_hotel_start" name="<?=fGetName("day_hotel_start")?>" value="<?=fGetResultValues("day_hotel_start")?>"  type="text" readonly onchange="sub_but()"></div>
<?if(fGetComments("day_hotel_start")):?><div class="qm"><div class="qm_text"><?=fGetComments("day_hotel_start")?></div></div><?endif?>
</div>
<?endif?>

<!--<div class="not_f"><?=GetMessage("DATE1")?></div>-->

<!--  	Дата окончания проживания  -->
<?if(fGetActive("day_hotel_finish")):?>
<div class="ti_blo" id="ti_blo_day_hotel_finish"  onkeyup="sub_but()" onmouseout="sub_but()">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("day_hotel_finish")?><span class="zred"> *</span></div>

	 <input id="date_day_hotel_finish" name="<?=fGetName("day_hotel_finish")?>" value="<?=fGetResultValues("day_hotel_finish")?>"  type="text" readonly onchange="sub_but()"></div>
<?if(fGetComments("day_hotel_finish")):?><div class="qm"><div class="qm_text"><?=fGetComments("day_hotel_finish")?></div></div><?endif?>
</div>
<?endif?>

<div class="not_f" onmouseout="sub_but()">
<input type="hidden" id="date_v_1" value="<?=$date_v_1?>"> 
<input type="hidden" id="date_v_2" value="<?=$date_v_2?>">
<?=GetMessage("DATE1")?>
<div class="date_v" onclick="date_v(1)">&#9658; <?=GetMessage("DATE1_1")?>  >>> <span id="date_v_1"><?=GetMessage("DATE_V")?></span></div>

<div class="date_v" onclick="date_v(2)">&#9658; <?=GetMessage("DATE1_2")?>  >>> <span id="date_v_2"><?=GetMessage("DATE_V")?></span></div>

<b><?=GetMessage("DATE2")?></b>
</div>

  <!--  Отель   -->
<?if(fGetActive("hotel")):?>
<div class="ti_blo" id="ti_blo_hotel" onmouseout="sub_but()">


<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("hotel")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="hotel_0" onclick="upr_nomer(0)"><input name="<?=fGetName("hotel")?>" value="<?=fGetValue("hotel",0)?>" class="" id="hotel0" type="radio"  onchange="sub_but()" <? if(fGetResultValues("hotel")==fGetValue("hotel",0)) echo "checked";?> ><label for="hotel0"> <?=fGetAnswer("hotel", 0);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>

	<div class="ti_dis" id="hotel_1" onclick="upr_nomer(1)"><input name="<?=fGetName("hotel")?>" value="<?=fGetValue("hotel",1)?>" class="" id="hotel1" type="radio"  onchange="sub_but()" <? if(fGetResultValues("hotel")==fGetValue("hotel",1)) echo "checked";?> ><label for="hotel1"> <?=fGetAnswer("hotel", 1);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>
<!--	
	<div class="ti_dis" id="hotel_2" onclick="upr_nomer(2)"><input name="<?=fGetName("hotel")?>" value="<?=fGetValue("hotel",2)?>" class="" id="hotel2" type="radio"  onchange="sub_but()" <? if(fGetResultValues("hotel")==fGetValue("hotel",2)) echo "checked";?> ><label for="hotel2"> <?=fGetAnswer("hotel", 2);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>

	<div class="ti_dis" id="hotel_3" onclick="upr_nomer(3)"><input name="<?=fGetName("hotel")?>" value="<?=fGetValue("hotel",3)?>" class="" id="hotel3" type="radio"  onchange="sub_but()" <? if(fGetResultValues("hotel")==fGetValue("hotel",3)) echo "checked";?> ><label for="hotel3"> <?=fGetAnswer("hotel", 3);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>
-->
</div>

</div>
<?if(fGetComments("hotel")):?><div class="qm"><div class="qm_text"><?=fGetComments("hotel")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Номер   -->
<?if(fGetActive("nomer")):?>
<div class="ti_blo" id="ti_blo_nomer" onmouseout="sub_but()">


<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("nomer")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="nomer_0"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",0)?>" class="" id="nomer0" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer")==fGetValue("nomer",0)) echo "checked";?>><label for="nomer0"> <?=fGetAnswer("nomer", 0);?></label></div>

	<div class="ti_dis" id="nomer_1"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",1)?>" class="" id="nomer1" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer")==fGetValue("nomer",1)) echo "checked";?>><label for="nomer1"> <?=fGetAnswer("nomer", 1);?></label></div>
	
	<div class="ti_dis" id="nomer_2"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",2)?>" class="" id="nomer2" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer")==fGetValue("nomer",2)) echo "checked";?>><label for="nomer2"> <?=fGetAnswer("nomer", 2);?></label></div>

	<div class="ti_dis" id="nomer_3"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",3)?>" class="" id="nomer3" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer")==fGetValue("nomer",3)) echo "checked";?>><label for="nomer3"> <?=fGetAnswer("nomer", 3);?></label></div>
	
	<div class="ti_dis" id="nomer_4"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",4)?>" class="" id="nomer4" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer")==fGetValue("nomer",4)) echo "checked";?>><label for="nomer4"> <?=fGetAnswer("nomer", 4);?></label></div>

	<div class="ti_dis" id="nomer_5"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",5)?>" class="" id="nomer5" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer")==fGetValue("nomer",5)) echo "checked";?>><label for="nomer5"> <?=fGetAnswer("nomer", 5);?></label></div>
	
	<div class="ti_dis" id="nomer_6"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",6)?>" class="" id="nomer6" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer")==fGetValue("nomer",6)) echo "checked";?>><label for="nomer6"> <?=fGetAnswer("nomer", 6);?></label></div>
	
	<div class="ti_dis" id="nomer_7"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",7)?>" class="" id="nomer7" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer")==fGetValue("nomer",7)) echo "checked";?>><label for="nomer7"> <?=fGetAnswer("nomer", 7);?></label></div>
	
	<div class="ti_dis" id="nomer_8"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",8)?>" class="" id="nomer8" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer")==fGetValue("nomer",8)) echo "checked";?>><label for="nomer8"> <?=fGetAnswer("nomer", 8);?></label></div>

	<div class="ti_dis" id="nomer_9"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",9)?>" class="" id="nomer9" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer")==fGetValue("nomer",9)) echo "checked";?>><label for="nomer9"> <?=fGetAnswer("nomer", 9);?></label></div>
	
	<div class="ti_dis" id="nomer_10"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",10)?>" class="" id="nomer10" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer")==fGetValue("nomer",10)) echo "checked";?>><label for="nomer10"> <?=fGetAnswer("nomer", 10);?></label></div>

	<div class="ti_dis" id="nomer_11"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",11)?>" class="" id="nomer11" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer")==fGetValue("nomer",11)) echo "checked";?>><label for="nomer11"> <?=fGetAnswer("nomer", 11);?></label></div>
	<!--
	<div class="ti_dis" id="nomer_12"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",12)?>" class="" id="nomer12" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer")==fGetValue("nomer",12)) echo "checked";?>><label for="nomer12"> <?=fGetAnswer("nomer", 12);?></label></div>

	<div class="ti_dis" id="nomer_13"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",13)?>" class="" id="nomer13" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer")==fGetValue("nomer",13)) echo "checked";?>><label for="nomer13"> <?=fGetAnswer("nomer", 13);?></label></div>
	
	<div class="ti_dis" id="nomer_14"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",14)?>" class="" id="nomer14" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer")==fGetValue("nomer",14)) echo "checked";?>><label for="nomer14"> <?=fGetAnswer("nomer", 14);?></label></div>
-->
</div>

</div>
<?if(fGetComments("nomer")):?><div class="qm"><div class="qm_text"><?=fGetComments("nomer")?></div></div><?endif?>
</div>
<?endif?>
</div>
<input type="hidden" id="fls" value="<?if($ka_lsh || $so_lsh) echo "1";else echo "0";?>">

<?if($ka_lsh || $so_lsh) { ?>

<div style="border:1px solid #f00;">
<!-- ------------------------------------------------------ -->
<!--  Участие в Leader Ship   -->

<?if(fGetActive("d_leader_ship")):?>
<div class="ti_blo" id="ti_blo_d_leader_ship"  style="display:<?=$ka_lsh?"block":"none";?>">
<input type="hidden" value="<?=fGetValue("d_leader_ship",0)?>">

<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("d_leader_ship")?><span class="zred"> *<br></span></div>

<div class="vsta">

	<div class="ti_dis" id="d_leader_ship_0"><input name="<?=fGetName("d_leader_ship")?>" value="<?=fGetValue("d_leader_ship",0)?>" class="" id="d_leader_ship0" type="radio" onchange="sub_but()" <? if(fGetResultValues("d_leader_ship")==fGetValue("d_leader_ship",0)) echo "checked";?>><label for="d_leader_ship0"> <?=fGetAnswer("d_leader_ship",0);?></label></div>

	<div class="ti_dis" id="d_leader_ship_1"><input name="<?=fGetName("d_leader_ship")?>" value="<?=fGetValue("d_leader_ship",1)?>" class="" id="d_leader_ship1" type="radio" onchange="sub_but()" <? if(fGetResultValues("d_leader_ship")==fGetValue("d_leader_ship",1)) echo "checked";?>><label for="d_leader_ship1"> <?=fGetAnswer("d_leader_ship",1);?></label></div>

</div>

</div>
<?if(fGetComments("d_leader_ship")):?><div class="qm"><div class="qm_text"><?=fGetAnswer("d_leader_ship_comment")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Соучастие в Leader Ship   -->
  
<?if(fGetActive("s_leader_ship")):?>
<div class="ti_blo" id="ti_blo_s_leader_ship" style="display:<?=$so_lsh?"block":"none";?>">
<input type="hidden" value="<?=fGetValue("s_leader_ship",0)?>">

<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("s_leader_ship")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="s_leader_ship_0"><input name="<?=fGetName("s_leader_ship")?>" value="<?=fGetValue("s_leader_ship",0)?>" class="" id="s_leader_ship0" type="radio" onchange="sub_but()" <? if(fGetResultValues("s_leader_ship")==fGetValue("s_leader_ship",0)) echo "checked";?>><label for="s_leader_ship0"> <?=fGetAnswer("s_leader_ship",0);?></label></div>

	<div class="ti_dis" id="s_leader_ship_1"><input name="<?=fGetName("s_leader_ship")?>" value="<?=fGetValue("s_leader_ship",1)?>" class="" id="s_leader_ship1" type="radio" onchange="sub_but()" <? if(fGetResultValues("s_leader_ship")==fGetValue("s_leader_ship",1)) echo "checked";?>><label for="s_leader_ship1"> <?=fGetAnswer("s_leader_ship",1);?></label></div>

</div>

</div>
<?if(fGetComments("s_leader_ship")):?><div class="qm"><div class="qm_text"><?=ft("s_leader_ship_comment",$_SESSION["f_lang"])?></div></div><?endif?>
</div>
<?endif?>
<!-- ---------------------------------------- -->
<div id="plsd">
		<!-- Проживание на Leader Ship  -->
		<div id="leader_ship_to">

		<!--  Дата начала проживания на Leader Ship  -->
		<?if(fGetActive("day_hotel_start_ls")):?>
		<div class="ti_blo" id="ti_blo_day_hotel_start_ls"  onkeyup="sub_but()" onmouseout="sub_but()">
			 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("day_hotel_start_ls")?><span class="zred"> *</span></div>
				
			 <input id="date_day_hotel_start_ls" name="<?=fGetName("day_hotel_start_ls")?>" value="<?=fGetResultValues("day_hotel_start_ls")?>" style="" type="text" readonly onchange="sub_but()"></div>
		<?if(fGetComments("day_hotel_start_ls")):?><div class="qm"><div class="qm_text"><?=fGetComments("day_hotel_start_ls")?></div></div><?endif?>
		</div>
		<?endif?>

		<!--<div class="not_f"><?=ft("DATE1",$_SESSION["f_lang"])?></div>-->

		<!--  	Дата окончания проживания на Leader Ship  -->
		<?if(fGetActive("day_hotel_finish_ls")):?>
		<div class="ti_blo" id="ti_blo_day_hotel_finish_ls"  onkeyup="sub_but()" onmouseout="sub_but()">
			 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("day_hotel_finish_ls")?><span class="zred"> *</span></div>
		
			 <input id="date_day_hotel_finish_ls" name="<?=fGetName("day_hotel_finish_ls")?>" value="<?=fGetResultValues("day_hotel_finish_ls")?>" style="" type="text" readonly onchange="sub_but()"></div>
		<?if(fGetComments("day_hotel_finish_ls")):?><div class="qm"><div class="qm_text"><?=fGetComments("day_hotel_finish_ls")?></div></div><?endif?>
		</div>
		<?endif?>

<div class="not_f" onmouseout="sub_but()">
<input type="hidden" id="date_v_1" value="<?=$date_v_1?>"> 
<input type="hidden" id="date_v_2" value="<?=$date_v_2?>">
<?=GetMessage("DATE1")?>
<!--
<div class="date_v" onclick="date_v_2(1)">&#9658; <?=GetMessage("DATE1_1")?>  >>> <span id="date_v_1"><?=GetMessage("DATE_V")?></span></div>
-->
<div class="date_v" onclick="date_v_2(2)">&#9658; <?=GetMessage("DATE1_2")?>  >>> <span id="date_v_2"><?=GetMessage("DATE_V")?></span></div>

<b><?=GetMessage("DATE2")?></b>
</div>


		  <!--  Отель на Leader Ship   -->
		<?if(fGetActive("hotel_ls")):?>
		<div class="ti_blo" id="ti_blo_hotel_ls" onmouseout="sub_but()">


		<div class="ti_dig">

		<div class="tiqa"> <?=fGetQuestion("hotel_ls")?><span class="zred"> *</span></div>

		<div class="vsta">

			<div class="ti_dis" id="hotel_ls_0" onclick="upr_nomer_ls_two(0)"><input name="<?=fGetName("hotel_ls")?>" value="<?=fGetValue("hotel_ls",0)?>" class="" id="hotel_ls0" type="radio"  onchange="sub_but()" <? if(fGetResultValues("hotel_ls")==fGetValue("hotel_ls",0)) {echo "checked";$i_vo=0;}?>><label for="hotel_ls0"> <?=fGetAnswer("hotel_ls", 0);?></label></div>
		
			<div class="ti_dis" id="hotel_ls_1" onclick="upr_nomer_ls_two(1)"><input name="<?=fGetName("hotel_ls")?>" value="<?=fGetValue("hotel_ls",1)?>" class="" id="hotel_ls1" type="radio"  onchange="sub_but()" <? if(fGetResultValues("hotel_ls")==fGetValue("hotel_ls",1)) {echo "checked";$i_vo=1;}?>><label for="hotel_ls1"> <?=fGetAnswer("hotel_ls", 1);?></label></div>
			
			<div class="ti_dis" id="hotel_ls_2" onclick="upr_nomer_ls_two(2)"><input name="<?=fGetName("hotel_ls")?>" value="<?=fGetValue("hotel_ls",2)?>" class="" id="hotel_ls2" type="radio"  onchange="sub_but()" <? if(fGetResultValues("hotel_ls")==fGetValue("hotel_ls",2)) {echo "checked";$i_vo=0;}?>><label for="hotel_ls2"> <?=fGetAnswer("hotel_ls", 2);?></label></div>

	
		</div>

		</div>
		<?if(fGetComments("hotel_ls")):?><div class="qm"><div class="qm_text"><?=fGetComments("hotel_ls")?></div></div><?endif?>
		</div>
		<?endif?>

		  <!--  Номер  на Leader Ship  -->
		<?if(fGetActive("nomer_ls")):?>
		<div class="ti_blo" id="ti_blo_nomer_ls" onmouseout="sub_but()">


		<div class="ti_dig">

		<div class="tiqa"> <?=fGetQuestion("nomer_ls")?><span class="zred"> *</span></div>

		<div class="vsta">

			<div class="ti_dis" id="nomer_ls_0"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",0)?>" class="" id="nomer_ls0" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",0)) echo "checked";?>><label for="nomer_ls0"> <?=fGetAnswer("nomer",0);?></label></div>

			<div class="ti_dis" id="nomer_ls_1"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",1)?>" class="" id="nomer_ls1" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",1)) echo "checked";?>><label for="nomer_ls1"> <?=fGetAnswer("nomer",1);?></label></div>
			
			<div class="ti_dis" id="nomer_ls_2"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",2)?>" class="" id="nomer_ls2" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",2)) echo "checked";?>><label for="nomer_ls2"> <?=fGetAnswer("nomer",2);?></label></div>

			<div class="ti_dis" id="nomer_ls_3"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",3)?>" class="" id="nomer_ls3" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",3)) echo "checked";?>><label for="nomer_ls3"> <?=fGetAnswer("nomer",3);?></label></div>
			
			<div class="ti_dis" id="nomer_ls_4"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",4)?>" class="" id="nomer_ls4" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",4)) echo "checked";?>><label for="nomer_ls4"> <?=fGetAnswer("nomer",4);?></label></div>

			<div class="ti_dis" id="nomer_ls_5"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",5)?>" class="" id="nomer_ls5" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",5)) echo "checked";?>><label for="nomer_ls5"> <?=fGetAnswer("nomer",5);?></label></div>
			
			<div class="ti_dis" id="nomer_ls_6"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",6)?>" class="" id="nomer_ls6" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",6)) echo "checked";?>><label for="nomer_ls6"> <?=fGetAnswer("nomer",6);?></label></div>
			
			<div class="ti_dis" id="nomer_ls_7"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",7)?>" class="" id="nomer_ls7" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",7)) echo "checked";?>><label for="nomer_ls7"> <?=fGetAnswer("nomer",7);?></label></div>
			<!--
			<div class="ti_dis" id="nomer_ls_8"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",8)?>" class="" id="nomer_ls8" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",8)) echo "checked";?>><label for="nomer_ls8"> <?=fGetAnswer("nomer",8);?></label></div>

			<div class="ti_dis" id="nomer_ls_9"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",9)?>" class="" id="nomer_ls9" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",9)) echo "checked";?>><label for="nomer_ls9"> <?=fGetAnswer("nomer",9);?></label></div>
			
			<div class="ti_dis" id="nomer_ls_10"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",10)?>" class="" id="nomer_ls10" type="radio" onchange="sub_but()" <? if(fGetResultValues("nomer_ls")==fGetValue("nomer_ls",10)) echo "checked";?>><label for="nomer_ls10"> <?=fGetAnswer("nomer",10);?></label></div>
			-->
			

		</div>

		</div>
		<?if(fGetComments("nomer_ls")):?><div class="qm"><div class="qm_text"><?=fGetComments("nomer_ls")?></div></div><?endif?>
		</div>
		<?endif?>
									<!--  выбор номеров по выбранному отелю при загрузке страницы  -->
									<script>
									var count = $('#ti_blo_hotel_ls .vsta input').size();
									//alert(count);
									for(i=0;i<count;i++){
									if($("#hotel_ls"+i).prop("checked")) upr_nomer_ls_one(i);
									}
									</script>

		</div>
	</div>		
</div>	
<?}?>	
		<!-- -->

  <!--  Медицинская страховка  -->
<?if(fGetActive("medical_insurance")):?>
<div class="ti_blo" id="ti_blo_medical_insurance">
<input type="hidden" value="<?=fGetValue("medical_insurance",0)?>">

<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("medical_insurance")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="medical_insurance_0"><input name="<?=fGetName("medical_insurance")?>" value="<?=fGetValue("medical_insurance",0)?>" class="" id="medical_insurance0" type="radio" onchange="sub_but()" <? if(fGetResultValues("medical_insurance")==fGetValue("medical_insurance",0)) echo "checked";?>><label for="medical_insurance0"> <?=fGetAnswer("medical_insurance", 0);?></label></div>

	<div class="ti_dis" id="medical_insurance_1"><input name="<?=fGetName("medical_insurance")?>" value="<?=fGetValue("medical_insurance",1)?>" class="" id="medical_insurance1" type="radio" onchange="sub_but()"<? if(fGetResultValues("medical_insurance")==fGetValue("medical_insurance",1)) echo "checked";?>><label for="medical_insurance1"> <?=fGetAnswer("medical_insurance", 1);?></label></div>

</div>

</div>
<?if(fGetComments("medical_insurance")):?><div class="qm"><div class="qm_text"><?=fGetComments("medical_insurance")?></div></div><?endif?>
</div>
<?endif?>


<div id="hotel_not">

  <!--  Гостевая карта  -->
  <!--
<?if(fGetActive("guest_card")):?>
<div class="ti_blo" id="ti_blo_guest_card">
<input type="hidden" value="<?=fGetValue("guest_card",0)?>">

<div class="ti_dig">

<div class="tiqa"> <?=ft("guest_card",$_SESSION["f_lang"])?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="guest_card_0"><input name="<?=fGetName("guest_card")?>" value="<?=fGetValue("guest_card",0)?>" class="" id="guest_card0" type="radio" onchange="sub_but()"><label for="guest_card0"> <?=ft("guest_card_0",$_SESSION["f_lang"]);?></label></div>

	<div class="ti_dis" id="guest_card_1"><input name="<?=fGetName("guest_card")?>" value="<?=fGetValue("guest_card",1)?>" class="" id="guest_card1" type="radio" onchange="sub_but()"><label for="guest_card1"> <?=ft("guest_card_1",$_SESSION["f_lang"]);?></label></div>

</div>

</div>
<?if(fGetComments("guest_card")):?><div class="qm"><div class="qm_text"><?=ft("guest_card_comment",$_SESSION["f_lang"])?></div></div><?endif?>
</div>
<?endif?>
-->
</div>

  <!--  Вариант перелета  -->
<?if(fGetActive("p_fly")):?>
<div class="ti_blo" id="ti_blo_p_fly">
<input type="hidden" value="<?=fGetValue("p_fly",0)?>">

<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("p_fly")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="p_fly_0"><input name="<?=fGetName("p_fly")?>" value="<?=fGetValue("p_fly",0)?>" class="" id="p_fly0" type="radio" onchange="sub_but()" <? if(fGetResultValues("p_fly")==fGetValue("p_fly",0)) echo "checked";?>><label for="p_fly0"> <?=fGetAnswer("p_fly", 0);?></label></div>

	<div class="ti_dis" id="p_fly_1"><input name="<?=fGetName("p_fly")?>" value="<?=fGetValue("p_fly",1)?>" class="" id="p_fly1" type="radio" onchange="sub_but()" <? if(fGetResultValues("p_fly")==fGetValue("p_fly",1)) echo "checked";?>><label for="p_fly1"> <?=fGetAnswer("p_fly", 1);?></label></div>

</div>

</div>
<?if(fGetComments("p_fly")):?><div class="qm"><div class="qm_text"><?=fGetComments("p_fly")?></div></div><?endif?>
</div>
<?endif?>

<div id="fly_to">

  <!--  Перелет туда  -->
<?if(fGetActive("fly_1")):?>
<div class="ti_blo" id="ti_blo_fly_1">


<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("fly_1")?><span class="zred"> *</span><div class="snav" onclick="p_pes('fly_1','fly_2')">&#215;&nbsp; <?=GetMessage('BOX_REMOVE_ALL')?></div></div>

<div class="vsta">

	<div class="ti_dis" id="fly_1_0"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",0)?>" class="" id="fly_10" type="radio" onchange="sub_but()" onclick="p_pe('fly_1','fly_2',0)" <? if(fGetResultValues("fly_1")==fGetValue("fly_1",0)) echo "checked";?>><label for="fly_10"> <?=fGetAnswer("fly_1", 0);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>

	<div id="fly_1_date_1">
		<div class="ti_dis" id="fly_1_1"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",1)?>" class="" id="fly_11" type="radio" onchange="sub_but()" onclick="p_pe('fly_1','fly_2',1)" <? if(fGetResultValues("fly_1")==fGetValue("fly_1",1)) echo "checked";?>><label for="fly_11"> <?=fGetAnswer("fly_1", 1);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>
		
		<div class="ti_dis" id="fly_1_2"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",2)?>" class="" id="fly_12" type="radio" onchange="sub_but()" onclick="p_pe('fly_1','fly_2',2)" <? if(fGetResultValues("fly_1")==fGetValue("fly_1",2)) echo "checked";?>><label for="fly_12"> <?=fGetAnswer("fly_1", 2);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>

		<div class="ti_dis" id="fly_1_3"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",3)?>" class="" id="fly_13" type="radio" onchange="sub_but()" onclick="p_pe('fly_1','fly_2',3)" <? if(fGetResultValues("fly_1")==fGetValue("fly_1",3)) echo "checked";?>><label for="fly_13"> <?=fGetAnswer("fly_1", 3);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>
		
		<div class="ti_dis" id="fly_1_4"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",4)?>" class="" id="fly_14" type="radio" onchange="sub_but()" onclick="p_pe('fly_1','fly_2',4)" <? if(fGetResultValues("fly_1")==fGetValue("fly_1",4)) echo "checked";?>><label for="fly_14"> <?=fGetAnswer("fly_1", 4);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>

		<div class="ti_dis" id="fly_1_5"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",5)?>" class="" id="fly_15" type="radio" onchange="sub_but()" onclick="p_pe('fly_1','fly_2',5)" <? if(fGetResultValues("fly_1")==fGetValue("fly_1",5)) echo "checked";?>><label for="fly_15"> <?=fGetAnswer("fly_1", 5);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>

		<div class="ti_dis" id="fly_1_6"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",6)?>" class="" id="fly_16" type="radio" onchange="sub_but()" onclick="p_pe('fly_1','fly_2',6)"<? if(fGetResultValues("fly_1")==fGetValue("fly_1",6)) echo "checked";?>><label for="fly_16"> <?=fGetAnswer("fly_1", 6);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>

		<div class="ti_dis" id="fly_1_7"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",7)?>" class="" id="fly_17" type="radio" onchange="sub_but()" onclick="p_pe('fly_1','fly_2',7)"<? if(fGetResultValues("fly_1")==fGetValue("fly_1",7)) echo "checked";?>><label for="fly_17"> <?=fGetAnswer("fly_1", 7);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>

		<div class="ti_dis" id="fly_1_8"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",8)?>" class="" id="fly_18" type="radio" onchange="sub_but()" onclick="p_pe('fly_1','fly_2',8)"<? if(fGetResultValues("fly_1")==fGetValue("fly_1",8)) echo "checked";?>><label for="fly_18"> <?=fGetAnswer("fly_1", 8);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>
	</div>
	<div id="fly_1_date_2">
		<div class="ti_dis" id="fly_1_9"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",9)?>" class="" id="fly_19" type="radio" onchange="sub_but()" onclick="p_pe('fly_1','fly_2',9)"<? if(fGetResultValues("fly_1")==fGetValue("fly_1",9)) echo "checked";?>><label for="fly_19"> <?=fGetAnswer("fly_1", 9);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>
	</div>
</div>

</div>
<?if(fGetComments("fly_1")):?><div class="qm"><div class="qm_text"><?=fGetComments("fly_1")?></div></div><?endif?>
</div>
<?endif?>

<!--<div class="not_f"><?=GetMessage("NOT_f1")?></div>-->

 <!--  Перелет обратно  -->
<?if(fGetActive("fly_2")):?>
<div class="ti_blo" id="ti_blo_fly_2">


<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("fly_2")?><span class="zred"> *</span><div class="snav" onclick="p_pes('fly_2','fly_1')">&#215;&nbsp; <?=GetMessage('BOX_REMOVE_ALL')?></div></div>

<div class="vsta">


	<div class="ti_dis" id="fly_2_0"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",0)?>" class="" id="fly_20" type="radio" onchange="sub_but()" onclick="p_pe('fly_2','fly_1',0)" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",0)) echo "checked";?>><label for="fly_20"> <?=fGetAnswer("fly_2", 0);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>

	<div id="fly_2_date_1">
		<div class="ti_dis" id="fly_2_1"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",1)?>" class="" id="fly_21" type="radio" onchange="sub_but()" onclick="p_pe('fly_2','fly_1',1)" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",1)) echo "checked";?>><label for="fly_21"> <?=fGetAnswer("fly_2", 1);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>
		
		<div class="ti_dis" id="fly_2_2"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",2)?>" class="" id="fly_22" type="radio" onchange="sub_but()" onclick="p_pe('fly_2','fly_1',2)" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",2)) echo "checked";?>><label for="fly_22"> <?=fGetAnswer("fly_2", 2);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>


		<div class="ti_dis" id="fly_2_3"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",3)?>" class="" id="fly_23" type="radio" onchange="sub_but()" onclick="p_pe('fly_2','fly_1',3)" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",3)) echo "checked";?>><label for="fly_23"> <?=fGetAnswer("fly_2", 3);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>


		<div class="ti_dis" id="fly_2_4"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",4)?>" class="" id="fly_24" type="radio" onchange="sub_but()" onclick="p_pe('fly_2','fly_1',4)" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",4)) echo "checked";?>><label for="fly_24"> <?=fGetAnswer("fly_2", 4);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>

		<div class="ti_dis" id="fly_2_5"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",5)?>" class="" id="fly_25" type="radio" onchange="sub_but()" onclick="p_pe('fly_2','fly_1',5)" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",5)) echo "checked";?>><label for="fly_25"> <?=fGetAnswer("fly_2", 5);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>
		

		
		<div class="ti_dis" id="fly_2_6"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",6)?>" class="" id="fly_26" type="radio" onchange="sub_but()" onclick="p_pe('fly_2','fly_1',6)" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",6)) echo "checked";?>><label for="fly_26"> <?=fGetAnswer("fly_2", 6);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>

		<div class="ti_dis" id="fly_2_7"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",7)?>" class="" id="fly_27" type="radio" onchange="sub_but()" onclick="p_pe('fly_2','fly_1',7)" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",7)) echo "checked";?>><label for="fly_27"> <?=fGetAnswer("fly_2", 7);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>
		
		<div class="ti_dis" id="fly_2_8"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",8)?>" class="" id="fly_28" type="radio" onchange="sub_but()" onclick="p_pe('fly_2','fly_1',8)" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",8)) echo "checked";?>><label for="fly_28"> <?=fGetAnswer("fly_2", 8);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>
	</div>
	<div id="fly_2_date_2">	
		<div class="ti_dis" id="fly_2_9"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",9)?>" class="" id="fly_29" type="radio" onchange="sub_but()" onclick="p_pe('fly_2','fly_1',9)" <? if(fGetResultValues("fly_2")==fGetValue("fly_2",9)) echo "checked";?>><label for="fly_29"> <?=fGetAnswer("fly_2", 9);?></label><div class="ostok"><?=GetMessage("OSTOK")?><span></span></div></div>
	</div>		


</div>

</div>
<?if(fGetComments("fly_2")):?><div class="qm"><div class="qm_text"><?=fGetComments("fly_2")?></div></div><?endif?>
</div>
<?endif?>

<!--<div class="not_f"><?=GetMessage("NOT_f2")?></div>-->

</div>

  <!--  Транcфер  -->
<?if(fGetActive("p_transfer")):?>
<div class="ti_blo" id="ti_blo_p_transfer">
<input type="hidden" value="<?=fGetValue("p_transfer",0)?>">

<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("p_transfer")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="p_transfer_0"><input name="<?=fGetName("p_transfer")?>" value="<?=fGetValue("p_transfer",0)?>" class="" id="p_transfer0" type="radio" readonly <? if(fGetResultValues("p_transfer")==fGetValue("p_transfer",0)) echo "checked";?>><label for="p_transfer0"> <?=fGetAnswer("p_transfer", 0);?></label></div>

	<div class="ti_dis" id="p_transfer_1"><input name="<?=fGetName("p_transfer")?>" value="<?=fGetValue("p_transfer",1)?>" class="" id="p_transfer1" type="radio" readonly <? if(fGetResultValues("p_transfer")==fGetValue("p_transfer",1)) echo "checked";?>><label for="p_transfer1"> <?=fGetAnswer("p_transfer", 1);?></label></div>

</div>

</div>
<?if(fGetComments("p_transfer")):?><div class="qm"><div class="qm_text"><?=fGetComments("p_transfer")?></div></div><?endif?>
</div>
<?endif?>


  <!--  Участие в конференции  -->
<?if(fGetActive("d_konf")):?>
<div class="ti_blo" id="ti_blo_d_konf">
<input type="hidden" value="<?=fGetValue("d_konf",0)?>">

<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("d_konf")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="d_konf_0"><input name="<?=fGetName("d_konf")?>" value="<?=fGetValue("d_konf",0)?>" class="" id="d_konf0" type="radio" onchange="sub_but()" <? if(fGetResultValues("d_konf")==fGetValue("d_konf",0)) echo "checked";?>><label for="d_konf0"> <?=fGetAnswer("d_konf", 0);?></label></div>

	<div class="ti_dis" id="d_konf_1"><input name="<?=fGetName("d_konf")?>" value="<?=fGetValue("d_konf",1)?>" class="" id="d_konf1" type="radio" onchange="sub_but()"<? if(fGetResultValues("d_konf")==fGetValue("d_konf",1)) echo "checked";?>><label for="d_konf1"> <?=fGetAnswer("d_konf", 1);?></label></div>

</div>

</div>
<?if(fGetComments("d_konf")):?><div class="qm"><div class="qm_text"><?=fGetComments("d_konf")?></div></div><?endif?>
</div>
<?endif?>


 <!--  Участие в гала ужине  -->

<?if(fGetActive("d_ujin")):?>
<div class="ti_blo" id="ti_blo_d_ujin">
<input type="hidden" value="<?=fGetValue("d_ujin",0)?>">

<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("d_ujin")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="d_ujin_0"><input name="<?=fGetName("d_ujin")?>" value="<?=fGetValue("d_ujin",0)?>" class="" id="d_ujin0" type="radio" onchange="sub_but()" <? if(fGetResultValues("d_ujin")==fGetValue("d_ujin",0)) echo "checked";?>><label for="d_ujin0"> <?=fGetAnswer("d_ujin", 0);?></label></div>

	<div class="ti_dis" id="d_ujin_1"><input name="<?=fGetName("d_ujin")?>" value="<?=fGetValue("d_ujin",1)?>" class="" id="d_ujin1" type="radio" onchange="sub_but()" <? if(fGetResultValues("d_ujin")==fGetValue("d_ujin",1)) echo "checked";?>><label for="d_ujin1"> <?=fGetAnswer("d_ujin", 1);?></label></div>

</div>

</div>
<?if(fGetComments("d_ujin")):?><div class="qm"><div class="qm_text"><?=fGetComments("d_ujin")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Футболка  -->
<?if(fGetActive("d_futbolka")):?>
<div class="ti_blo" id="ti_blo_d_futbolka">
<input type="hidden" value="<?=fGetValue("d_futbolka",0)?>">

<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("d_futbolka")?><span class="zred">*</span></div>

<div class="vsta">

	<div class="ti_dis" id="d_futbolka_0"><input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",0)?>" class="" id="d_futbolka0" type="radio" onchange="sub_but()" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",0)) echo "checked";?>><label for="d_futbolka0"> <?=fGetAnswer("d_futbolka", 0);?></label></div>

	<div class="ti_dis" id="d_futbolka_1"><input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",1)?>" class="" id="d_futbolka1" type="radio" onchange="sub_but()" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",1)) echo "checked";?>><label for="d_futbolka1"> <?=fGetAnswer("d_futbolka", 1);?></label></div>
	
	<div class="ti_dis" id="d_futbolka_2"><input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",2)?>" class="" id="d_futbolka2" type="radio" onchange="sub_but()" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",2)) echo "checked";?>><label for="d_futbolka2"> <?=fGetAnswer("d_futbolka", 2);?></label></div>

	<div class="ti_dis" id="d_futbolka_3"><input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",3)?>" class="" id="d_futbolka3" type="radio" onchange="sub_but()" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",3)) echo "checked";?>><label for="d_futbolka3"> <?=fGetAnswer("d_futbolka", 3);?></label></div>
	
	<div class="ti_dis" id="d_futbolka_4"><input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",4)?>" class="" id="d_futbolka4" type="radio" onchange="sub_but()" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",4)) echo "checked";?>><label for="d_futbolka4"> <?=fGetAnswer("d_futbolka", 4);?></label></div>
	
	<div class="ti_dis" id="d_futbolka_5"><input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",5)?>" class="" id="d_futbolka5" type="radio" onchange="sub_but()" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",5)) echo "checked";?>><label for="d_futbolka5"> <?=fGetAnswer("d_futbolka", 5);?></label></div>

</div>

</div>
<?if(fGetComments("d_futbolka")):?><div class="qm"><div class="qm_text"><?=fGetComments("d_futbolka")?></div></div><?endif?>
</div>
<?endif?>
/////////////////////////////////////
<?=fGetResultValues("t_money")?"<br><br>По заявке есть оплата, редактирование формы оплаты недоступно.<br><br>":""?>
<div id="oub" style="display:<?=fGetResultValues("t_money")?"none":"block"?>;">
<!--  Форма оплаты  -->
<?if(fGetActive("oplata")):?>
<div class="ti_blo" id="ti_blo_oplata">

<input type="hidden" value="<?=fGetValue("oplata",0)?>">
<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("oplata")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="opl_0"><input name="<?=fGetName("oplata")?>" value="<?=fGetValue("oplata",0)?>" class="" id="opl0" type="radio" onchange="pro_pl()" <? if(fGetResultValues("oplata")==fGetValue("oplata",0)) echo "checked";?>><label for="opl0"> <?=fGetAnswer("oplata",0);?></label></div>

	<div class="ti_dis" id="opl_1"><input name="<?=fGetName("oplata")?>" value="<?=fGetValue("oplata",1)?>" class="" id="opl1" type="radio" onclick="pro_op()" <? if(fGetResultValues("oplata")==fGetValue("oplata",1)) echo "checked";?>><label for="opl1"> <?=fGetAnswer("oplata",1);?></label></div>


</div>


</div>
<?if(fGetComments("oplata")):?><div class="qm"><div class="qm_text"><?=fGetComments("oplata")?></div></div><?endif?>
</div>
<?endif?>
 
 <div id="op_div">
 
 <!--  Страна  -->
<?if(fGetActive("op_country")):?>
<div class="ti_blo" id="ti_blo_op_country">
<div class="ti_dig"><div class="tiqa"><?=fGetQuestion("op_country")?><span class="zred"> *</span></div>
<div class="vsta">
	
	<select name="<?=fGetName("op_country",0)?>" id="sel_op_country" class='chzn-select' onChange="f_nas_country('<?=fGetName("op_city",0)?>','<?=fGetName("op_nof",0)?>')" rrrronChange="f_op_country_get('<?=fGetName("op_city",0)?>')">
<option></option>
<?php
$xml = simplexml_load_file("../branch/branch.xml");
$tew=count($xml->i);
for($i=0;$i<$tew;$i++) {
$viy=($xml->i[$i]['a']);
//$ar_vse_co["$viy"]=iconv ('utf-8', 'windows-1251',($xml->i[$i]['b']));
//$ar_vse_ci["$viy"]=iconv ('utf-8', 'windows-1251',($xml->i[$i]['c']));
$ar_vse_co["$viy"]=($xml->i[$i]['b']);
$ar_vse_ci["$viy"]=($xml->i[$i]['c']);
			}

	
$ar_vse_cou=array_unique($ar_vse_co);		
sort($ar_vse_cou,SORT_STRING);
$coc=count($ar_vse_cou);
for($i=0;$i<$coc;$i++)
	{
		echo "<option";
		if(fGetResultValues("op_country", 0)==$ar_vse_cou[$i]) echo " selected";
		echo ">".$ar_vse_cou[$i]."</option>";
	}
?>
</select>
</div>
</div>	
<?if(fGetComments("op_country")):?><div class="qm"><div class="qm_text"><?=fGetComments("op_country")?></div></div><?endif?>
</div>
<?endif?>
 
 <!--  Город  -->
<?if(fGetActive("op_city")):?>
<div class="ti_blo" id="ti_blo_op_city">
<div class="ti_dig"><div class="tiqa"><?=fGetQuestion("op_city")?><span class="zred"> *</span></div>
<div class="vsta" id="soc">
		
	<select  id='sel_op_city' name="<?=fGetName("op_city",0)?>" class='chzn-select'   onChange="f_nas_city('<?=fGetName("op_nof",0)?>')">
	<?
	for($i=0;$i<$tew;$i++) {
		$tc=($xml->i[$i]['b']);
		//$tc=iconv ('utf-8', 'windows-1251',($xml->i[$i]['b']));
		//echo $val_country." >> ".$tc."<br/>";
			if(fGetResultValues("op_country", 0)==$tc) { 
			$ar_vop_cy[$i]=$xml->i[$i]['c'];
			//$ar_vop_cy[$i]=iconv ('utf-8', 'windows-1251',($xml->i[$i]['c']));
			}
		}
$ar_vop_cyu=array_unique($ar_vop_cy);
	$coc=count($ar_vop_cyu);
	sort($ar_vop_cyu,SORT_STRING);
	for($i=0;$i<$coc;$i++) {
	echo "<option";
		if(fGetResultValues("op_city", 0)==$ar_vop_cyu[$i]) echo " selected";
		echo ">".$ar_vop_cyu[$i]."</option>";
	}
	?>
</select>	
	</div>
</div>
<?if(fGetComments("op_city")):?><div class="qm"><div class="qm_text"><?=fGetComments("op_city")?><span class="zred"> *</span></div></div><?endif?>
</div>
<?endif?>
 
 <!--  № Офиса продаж  -->
<?if(fGetActive("op_nof")):?>
<div class="ti_blo" id="ti_blo_op_nof">
<div class="ti_dig"><div class="tiqa"><?=fGetQuestion("op_nof")?><span class="zred"> *</span></div>
<div class="vsta" id="sos">
	
	<select  id='sel_op_nof' name="<?=fGetName("op_nof",0)?>" class='chzn-select'  onChange="f_nas_nof()">
	<?
	for($i=0;$i<$tew;$i++) {
		$tc=($xml->i[$i]['b']);
		$tco=($xml->i[$i]['c']);
			if(fGetResultValues("op_country", 0)==$tc && fGetResultValues("op_city", 0)==$tco) { 
			$ar_vop_op[$i]=$xml->i[$i]['a'];
			//$ar_vop_op[$i]=iconv ('utf-8', 'windows-1251',($xml->i[$i]['a']));
			}
		}
$ar_vop_opu=array_unique($ar_vop_op);
	$coc=count($ar_vop_opu);
	sort($ar_vop_opu,SORT_STRING);
	for($i=0;$i<$coc;$i++) {
	echo "<option";
		if(fGetResultValues("op_nof", 0)==$ar_vop_opu[$i]) echo " selected";
		echo ">".$ar_vop_opu[$i]."</option>";
	}
	?>
</select>	
	</div>
	</div>
<?if(fGetComments("op_nof")):?><div class="qm"><div class="qm_text"><?=fGetComments("op_nof")?></div></div><?endif?>
</div>
<?endif?>

 <!--  Рассрочка для ОП  -->
 
<?if(fGetActive("time_money_op")):?>
<div class="ti_blo" id="ti_blo_time_money_op">


<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("time_money_op")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="tm_op_0"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",0)?>" class="" id="tm_op0" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",0)) echo "checked";?>><label for="tm_op0"> <?=fGetAnswer("time_money_op",0);?></label></div>

	
	<?if(date("ynj") <=2014628): // показывать до 28 июня?>
	<div class="ti_dis" id="tm_op_1"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",1)?>" class="" id="tm_op1" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",1)) echo "checked";?>><label for="tm_op1"> <?=fGetAnswer("time_money_op",1);?></label></div>
	<?endif?>
	
	<?if(date("ynj") <=2014528): // показывать до 28 мая?>
	<div class="ti_dis" id="tm_op_2"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",2)?>" class="" id="tm_op2" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",2)) echo "checked";?>><label for="tm_op2"> <?=fGetAnswer("time_money_op",2);?></label></div>
	<?endif?>
	
	<?if(date("ynj") <=2014428): // показывать до 28 апреля?>
	<div class="ti_dis" id="tm_op_3"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",3)?>" class="" id="tm_op3" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",3)) echo "checked";?>><label for="tm_op3"> <?=fGetAnswer("time_money_op",3);?></label></div>
	<?endif?>
	
	<?if(date("ynj") <=2014328): // показывать до 28 марта?>
	<div class="ti_dis" id="tm_op_4"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",4)?>" class="" id="tm_op4" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",4)) echo "checked";?>><label for="tm_op4"> <?=fGetAnswer("time_money_op",4);?></label></div>
	<?endif?>
	
	<?if(date("ynj") <=2014228): // показывать до 28 февраля?>
	<div class="ti_dis" id="tm_op_5"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",5)?>" class="" id="tm_op5" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",5)) echo "checked";?>><label for="tm_op5"> <?=fGetAnswer("time_money_op",5);?></label></div>
	<?endif?>
	
	<?if(date("ynj") <=2014228): // показывать до 28 февраля?>
	<div class="ti_dis" id="tm_op_6"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",6)?>" class="" id="tm_op6" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",6)) echo "checked";?>><label for="tm_op6"> <?=fGetAnswer("time_money_op",6);?></label></div>
	<?endif?>
	
	<?if(date("ynj") <=2014228): // показывать до 28 февраля?>
	<div class="ti_dis" id="tm_op_7"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",7)?>" class="" id="tm_op7" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",7)) echo "checked";?>><label for="tm_op7"> <?=fGetAnswer("time_money_op",7);?></label></div>
	<?endif?>
	
	<?if(date("ynj") <=2014228): // показывать до 28 февраля?>
	<div class="ti_dis" id="tm_op_8"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",8)?>" class="" id="tm_op8" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",8)) echo "checked";?>><label for="tm_op8"> <?=fGetAnswer("time_money_op",8);?></label></div>
	<?endif?>
	


</div>


</div>
<?if(fGetComments("time_money_chk")):?><div class="qm"><div class="qm_text"><?=fGetComments("time_money_chk")?></div></div><?endif?>
</div>
<?endif?>

 </div>
 
 <div id="pl_div">
 
  <!--  № ЧК плательщика  -->
<?if(fGetActive("pl_chk")):?>
<div class="ti_blo" id="ti_blo_pl_chk">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("pl_chk")?><span class="zred">*</span></div><input id="" name="<?=fGetName("pl_chk")?>" value="<?=fGetResultValues("pl_chk")?>" class="" type="text"  onkeyup="pro_pl()"></div>
<?if(fGetComments("pl_chk")):?><div class="qm"><div class="qm_text"><?=fGetComments("pl_chk")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Имя плательщика  -->
<?if(fGetActive("pl_name")):?>
<div class="ti_blo" id="ti_blo_pl_name">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("pl_name")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("pl_name")?>" value="<?=fGetResultValues("pl_name")?>" class="" type="text"  onkeyup="pro_pl()"></div>
<?if(fGetComments("pl_name")):?><div class="qm"><div class="qm_text"><?=fGetComments("pl_name")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Фамилия плательщика  -->
<?if(fGetActive("pl_family")):?>
<div class="ti_blo" id="ti_blo_pl_family">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("pl_family")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("pl_family")?>" value="<?=fGetResultValues("pl_family")?>" class="" type="text"  onkeyup="pro_pl()"></div>
<?if(fGetComments("pl_family")):?><div class="qm"><div class="qm_text"><?=fGetComments("pl_family")?></div></div><?endif?>
</div>
<?endif?>

  <!--  № телефона плательщика  -->
<?if(fGetActive("pl_phone")):?>
<div class="ti_blo" id="ti_blo_pl_phone">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("pl_phone")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("pl_phone")?>" value="<?=fGetResultValues("pl_phone")?>" class="" type="text" onkeyup="sub_but()"></div>
<?if(fGetComments("pl_phone")):?><div class="qm"><div class="qm_text"><?=fGetComments("pl_phone")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Проверка плательщика	  -->
<?if(fGetActive("pl_ok")):?>
<div class="ti_blo" id="ti_blo_pl_ok" style="1display:none;">
<input type="hidden" value="<?=GetMessage('HI_OP_OK_0');?>">
<input type="hidden" value="<?=GetMessage('HI_OP_OK_1');?>">
<input type="hidden" value="<?=GetMessage('HI_OP_OK_2');?>">
<input type="hidden" value="<?=GetMessage('HI_OP_OK_3');?>">
<input type="hidden" value="<?=GetMessage('OK_NOTE');?>">
<!--<div id="but_op_ok" class="stid_dp" style="" onclick="show_check()" ><?=GetMessage('TITLE_OP_OK');?></div>-->
<div class="ti_dig"><div class="tiqa"> <?=fGetQuestion("pl_ok")?> </div><input id="pl_ok" name="<?=fGetName("pl_ok")?>" value="<?=fGetResultValues("pl_ok")?>" class="" type="text" onkeyup="sub_but()" readonly ></div>
<?if(fGetComments("pl_ok")):?><div class="qm"><div class="qm_text"><?=fGetComments("pl_ok")?></div></div><?endif?>

</div>
<?endif?>


 <div id="garant_div">
 
   <!--  № ЧК гаранта  -->
<?if(fGetActive("garant_chk")):?>
<div class="ti_blo" id="ti_blo_garant_chk">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("garant_chk")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("garant_chk")?>" value="<?=fGetResultValues("garant_chk")?>" class="" type="text"></div>
<?if(fGetComments("garant_chk")):?><div class="qm"><div class="qm_text"><?=fGetComments("garant_chk")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Имя гаранта  -->
<?if(fGetActive("garant_name")):?>
<div class="ti_blo" id="ti_blo_garant_name">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("garant_name")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("garant_name")?>" value="<?=fGetResultValues("garant_name")?>" class="" type="text"></div>
<?if(fGetComments("garant_name")):?><div class="qm"><div class="qm_text"><?=fGetComments("garant_name")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Фамилия гаранта  -->
<?if(fGetActive("garant_family")):?>
<div class="ti_blo" id="ti_blo_garant_family">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("garant_family")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("garant_family")?>" value="<?=fGetResultValues("garant_family")?>" class="" type="text"></div>
<?if(fGetComments("garant_family")):?><div class="qm"><div class="qm_text"><?=fGetComments("garant_family")?></div></div><?endif?>
</div>
<?endif?>
 
   <!--  Проверка гаранта	  -->
<?if(fGetActive("garant_ok")):?>
<div class="ti_blo" id="ti_blo_garant_ok" style="1display:none;">
<input type="hidden" value="<?=GetMessage('ERROR_NOTE_5');?>">
<input type="hidden" value="<?=GetMessage('ERROR_NOTE_6');?>">
<input type="hidden" value="<?=GetMessage('ERROR_NOTE_4');?>">
<!--<div id="but_op_gr" class="stid_dp" style="" onclick="show_check_gr()" ><?=GetMessage('TITLE_OP_GR');?></div>-->
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("garant_ok")?></div><input id="garant_ok" name="<?=fGetName("garant_ok")?>" value="<?=fGetResultValues("garant_ok")?>" class="" type="text" onkeyup="sub_but()" readonly></div>
<?if(fGetComments("garant_ok")):?><div class="qm"><div class="qm_text"><?=fGetComments("garant_ok")?></div></div><?endif?>

</div>
<?endif?>
 
 </div>
 
 <!--  Рассрочка для чека  -->
 
<?if(fGetActive("time_money_chk")):?>
<div class="ti_blo" id="ti_blo_time_money_chk" >
<input type="hidden" value="<?=fGetValue("time_money_chk",0)?>">

<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("time_money_chk")?><span class="zred">*</span></div>

<div class="vsta">

	<div class="ti_dis" id="tm_chk_0"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",0)?>" class="" id="tm_chk0" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",0)) echo "checked";?>><label for="tm_chk0"> <?=fGetAnswer("time_money_chk",0);?></label></div>

	<?//if(date("Ymd") <=20141013): // показывать до 13 октября?>
	<div class="ti_dis" id="tm_chk_1"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",1)?>" class="" id="tm_chk1" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",1)) echo "checked";?>><label for="tm_chk1"> <?=fGetAnswer("time_money_chk",1);?></label></div>
	<?//endif?>
	
	<?//if(date("Ymd") <=20140913): // показывать до 13 сентября?>
	<div class="ti_dis" id="tm_chk_2"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",2)?>" class="" id="tm_chk2" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",2)) echo "checked";?>><label for="tm_chk2"> <?=fGetAnswer("time_money_chk",2);?></label></div>
	<?//endif?>
	
	<?//if(date("Ymd") <=20140813): // показывать до 13 августа?>
	<div class="ti_dis" id="tm_chk_3"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",3)?>" class="" id="tm_chk3" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",3)) echo "checked";?>><label for="tm_chk3"> <?=fGetAnswer("time_money_chk",3);?></label></div>
	<?//endif?>
	
	<?//if(date("Ymd") <=20140713): // показывать до 13 июля?>
	<div class="ti_dis" id="tm_chk_4"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",4)?>" class="" id="tm_chk4" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",4)) echo "checked";?>><label for="tm_chk4"> <?=fGetAnswer("time_money_chk",4);?></label></div>
	<?//endif?>
	
	<?//if(date("Ymd") <=20140613): // показывать до 13 июня?>
	<div class="ti_dis" id="tm_chk_5"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",5)?>" class="" id="tm_chk5" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",5)) echo "checked";?>><label for="tm_chk5"> <?=fGetAnswer("time_money_chk",5);?></label></div>
	<?//endif;?>
	
	<?//if(date("Ymd") <=20140913): // показывать до 13 сентября?>
	<div class="ti_dis" id="tm_chk_6"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",6)?>" class="" id="tm_chk6" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",6)) echo "checked";?>><label for="tm_chk6"> <?=fGetAnswer("time_money_chk",6);?></label></div>
	<?//endif?>
	
	<?//if(date("Ymd") <=20140813): // показывать до 13 августа?>
	<div class="ti_dis" id="tm_chk_7"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",7)?>" class="" id="tm_chk7" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",7)) echo "checked";?>><label for="tm_chk7"> <?=fGetAnswer("time_money_chk",7);?></label></div>
	<?//endif?>
	
	<?//if(date("Ymd") <=20140713): // показывать до 13 июля?>
	<div class="ti_dis" id="tm_chk_8"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",8)?>" class="" id="tm_chk8" type="radio" onchange="sub_but()" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",8)) echo "checked";?>><label for="tm_chk8"> <?=fGetAnswer("time_money_chk",8);?></label></div>
	<?//endif?>



</div>


</div>
<?if(fGetComments("time_money_chk")):?><div class="qm"><div class="qm_text"><?=fGetComments("time_money_chk")?></div></div><?endif?>
</div>
<?endif?>
 
 </div>
 </div>
/////////////////////////////////////

<div>

<!--  Синхронный перевод  -->
<?if(fGetActive("interpretation")):?>
<div class="ti_blo" id="ti_blo_interpretation">

<input type="hidden" value="<?=fGetValue("interpretation",0)?>">
<div class="ti_dig">

<div class="tiqa"> <?=fGetQuestion("interpretation")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="interpretation_0"><input name="<?=fGetName("interpretation")?>" value="<?=fGetValue("interpretation",0)?>" class="" id="interpretation0" type="radio" onchange="sub_but()" <? if(fGetResultValues("interpretation")==fGetValue("interpretation",0)) echo "checked";?>><label for="interpretation0"> <?=fGetAnswer("interpretation",0)?></label></div>

	<div class="ti_dis" id="interpretation_1"><input name="<?=fGetName("interpretation")?>" value="<?=fGetValue("interpretation",1)?>" class="" id="interpretation1" type="radio" onchange="sub_but()" <? if(fGetResultValues("interpretation")==fGetValue("interpretation",1)) echo "checked";?>><label for="interpretation1"> <?=fGetAnswer("interpretation",1)?></label></div>


</div>


</div>
<?if(fGetComments("interpretation")):?><div class="qm"><div class="qm_text"><?=fGetComments("interpretation")?></div></div><?endif?>
</div>
<?endif?>

<!--  Выберите язык для синхронного перевода   -->
<?if(fGetActive("interpretation_lang")):?>

<div class="ti_blo" id="ti_blo_interpretation_lang">

<div class="ti_dig"><div class="tiqa"><?=fGetQuestion("interpretation_lang")?><span class="zred"> *</span></div>
<div class="vsta_s">

<select name="<?=fGetName("interpretation_lang",0)?>" id="interpretation_lang" class='interpretation_lang-select' onchange="sub_but()">
<option value="0">&nbsp;</option>
<?php

$coc=count($ar_interpretation_lang["ru"]);

for($i=0;$i<$coc;$i++)
	{
	
	$v_ar_c=@explode(",",$ar_interpretation_lang["ru"][$i]);
	asort($v_ar_c);
		foreach($v_ar_c as $val) {
		echo "<option value='".$val."'";
		if(fGetResultValues("interpretation_lang", 0)==$val) echo " selected";
		echo ">".$val."</option>";
		}
	}
?>

</select>
</div>
</div>
<?if(fGetComments("interpretation_lang")):?><div class="qm"><div class="qm_text"><?=fGetComments("interpretation_lang")?></div></div><?endif?>
<script type="text/javascript"> 
//$(".interpretation_lang-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true});
 </script>

 </div>
<?endif?> 

<!--  Дополнительный язык для синхронного перевода   -->
<?if(fGetActive("second_interpretation_lang")):?>

<div class="ti_blo" id="ti_blo_second_interpretation_lang">

<div class="ti_dig"><div class="tiqa"><?=fGetQuestion("second_interpretation_lang")?></div>
<div class="vsta_s">

<select name="<?=fGetName("second_interpretation_lang",0)?>" id="second_interpretation_lang" class='second_interpretation_lang-select' >
<option value="0">&nbsp;</option>
<?php

$coc=count($ar_second_lang["ru"]);
for($i=0;$i<$coc;$i++)
	{
	//if($i>0 && !($i%3)) echo "</div><div class='col_co'>";
	//echo "<div class='ticou'>".$ar_part_world[$i]."</div>";
	$v_ar_c=@explode(",",$ar_second_lang["ru"][$i]);
	asort($v_ar_c);
		foreach($v_ar_c as $val) {
		echo "<option value='".$val."'";
		if(fGetResultValues("second_interpretation_lang", 0)==$val) echo " selected";
		echo ">".$val."</option>";
		}
	}
?>
</select>
</div>
</div>
<?if(fGetComments("second_interpretation_lang")):?><div class="qm"><div class="qm_text"><?=fGetComments("second_interpretation_lang")?></div></div><?endif?>

<script type="text/javascript"> 
//$(".second_interpretation_lang-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true});
 </script>

 </div>
<?endif?> 
</div>




<!--  	ФИО соседа по номеру -->
<?if(fGetActive("hotel_frend")):?>
<div class="ti_blo" id="ti_blo_hotel_frend"  onkeyup="sub_but()">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("hotel_frend")?></div><textarea name="<?=fGetName("hotel_frend",0)?>"><?=fGetResultValues("hotel_frend", 0);?></textarea></div>
<?if(fGetComments("hotel_frend")):?><div class="qm"><div class="qm_text"><?=fGetComments("hotel_frend")?></div></div><?endif?>
</div>
<?endif?>





<!--  	Комментарий -->
<?if(fGetActive("comments")):?>
<div class="ti_blo" id="ti_blo_comments"  onkeyup="sub_but()">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("comments")?></div><textarea name="<?=fGetName("comments",0)?>"><?=fGetResultValues("comments", 0);?></textarea></div>
<?if(fGetComments("comments")):?><div class="qm"><div class="qm_text"><?=fGetComments("comments")?></div></div><?endif?>
</div>
<?endif?>

<h3><?=GetMessage("TOADMIN")?></h3>



<!--  Скидка %  -->
<?if(fGetActive("discount")):?>
<div class="ti_blo" id="ti_blo_discount">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("discount")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("discount")?>" value="<?=fGetResultValues("discount")?>" class="" type="text" onkeyup="sub_but()"></div>
<?if(fGetComments("discount")):?><div class="qm"><div class="qm_text"><?=fGetComments("discount")?></div></div><?endif?>

</div>
<?endif?>

<!--  Наценка %  -->
<?if(fGetActive("markup")):?>
<div class="ti_blo" id="ti_blo_markup">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("markup")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("markup")?>" value="<?=fGetResultValues("markup")?>" class="" type="text" onkeyup="sub_but()"></div>
<?if(fGetComments("markup")):?><div class="qm"><div class="qm_text"><?=fGetComments("markup")?></div></div><?endif?>
</div>
<?endif?>

<!--  Минус  -->
<?if(fGetActive("minus")):?>
<div class="ti_blo" id="ti_blo_minus">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("minus")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("minus")?>" value="<?=fGetResultValues("minus")?>" class="" type="text" onkeyup="sub_but()"></div>
<?if(fGetComments("minus")):?><div class="qm"><div class="qm_text"><?=fGetComments("minus")?></div></div><?endif?>
</div>
<?endif?>

<!--  Плюс  -->
<?if(fGetActive("plus")):?>
<div class="ti_blo" id="ti_blo_plus">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("plus")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("plus")?>" value="<?=fGetResultValues("plus")?>" class="" type="text" onkeyup="sub_but()"></div>
<?if(fGetComments("plus")):?><div class="qm"><div class="qm_text"><?=fGetComments("plus")?></div></div><?endif?>
</div>
<?endif?>


<!--  Выбор курса валют  -->
<!--
<?

$knvm=trim(fGetResultValues("currency_id")); // код национальной валюты мероприятия
$mv=time();

$za="SELECT `course`,`time_stamp`,`date_a` FROM currency_course WHERE `currency_course`.`activity`=1 AND `code_m`='".$code_m."' AND `currency_number`='".$knvm."' AND `time_stamp`<='".$mv."'";
	if(!($z=mysql_query($za))) {echo "Не могу выполнить запрос $za";}
	else{ 
	$rows=mysql_num_rows($z);
	for($i=0;$i<$rows;$i++) 
	   {
       $pa=mysql_fetch_array($z);
	   $course[$pa["time_stamp"]]=$pa["course"];
	   $d_course[$pa["time_stamp"]]=$pa["date_a"];
	   }
	}
	$kc= max(array_keys($course));
	$kp=$course[$kc];  // курс нац.валюты к базовой
	$kd=$d_course[$kc];  // дата курса нац.валюты к базовой
	?>
	
<div class="ti_blo" id="m_course">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("m_course")?></div>
<select name="<?=fGetName("m_course")?>">
<option value=<?=$kp?>><?=$kp?> от <?=$kd?> текущий</option>
<?
$sc=count($course);
	foreach($course as $k=>$v){
		if($k<>$kc){?>
		<option value=<?=$v?>><?=$v?> от <?=$d_course[$k]?></option>
<?		}
	}
?>
</select>

</div>
<?if(fGetComments("m_course")):?><div class="qm"><div class="qm_text"><?=fGetComments("m_course")?></div></div><?endif?>
</div>
-->
<!--  	Комментарий администратора -->
<?if(fGetActive("comments_admin")):?>
<div class="ti_blo" id="ti_blo_comments_admin"  onkeyup="sub_but()">
	 <div class="ti_dig"><div class="tiqa"><?=fGetQuestion("comments_admin")?></div><textarea name="<?=fGetName("comments_admin",0)?>"><?=fGetResultValues("comments_admin", 0);?></textarea></div>
<?if(fGetComments("comments_admin")):?><div class="qm"><div class="qm_text"><?=fGetComments("comments_admin")?></div></div><?endif?>
</div>
<?endif?>


 
</div>
</td></tr></table>

 <!-- Кнопки -->
<div class="lic" id="lic_2">

<!-- кнопка к шагу ... не активная -->
 <div class="but_bot_3"><input type="button" id="but_bot_3" class="vst" value="<?=GetMessage("BUT_BOT_3_2")?>" onclick="sub_form()"></div>

<!-- кнопка к шагу ...  активная -->
<div class="1but_bot_3_a"><input type="button" id="but_bot_3_a"  class="vst_a" value="<?=GetMessage("BUT_BOT_3_2")?>"  onclick="old_show_check()" hidden><input type="submit" class="vst" id="gud" value="<?=GetMessage("BUT_BOT_3_2")?>" name="web_form_submit" style="visibility:hidden"> </div>

</div> 

<!-- ///////////////////////////////////////// -->
 </form>
 </div>
<script type="text/javascript">
sub_but(); 
</script>
<br/><br/><br/><br/><br/>
