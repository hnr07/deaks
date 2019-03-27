<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?global $t_step; // Шаг регистрации?>
<? include "var_config.php"; // Конфигурация мероприятия?>
<? include "functions.php";  // Функции PHP?>

<? include "vop_array.php";  // массив доступных отделов продаж?>
<? include "header_form.php"; // Шапка формы ?>
<? include "note_error.php"; // Ошибки заполнения ?>
<div id="tr"></div>
<div id="ti_form">
<!--<form action="<?=$dir_event?>step_4.php" method="POST" onsubmit="return sub_form()">-->
<? 
$ar_head_form=explode(" ",$arResult["FORM_HEADER"],2);
$head_form=$ar_head_form[0]." onsubmit=\"return sub_form()\"  onreset=\"res_form()\" ".$ar_head_form[1];
echo $head_form;

?>

<table id="cont_t">

<tr valign="top">

<td>

<div  class="right_b">


<div class="title_step">
<div id="title_step1">&nbsp;&nbsp;<?=getMessage('TITLE_STEP3')?> &nbsp;<?=getMessage('TITLE_PR3')?></div>

</div>
<div id="tr"></div>


<div class="form-required">
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>


<?=$arResult["FORM_NOTE"]?>
</div>


<input type="hidden" name="forpa" value="1">




<?if ($_POST[fGetName("status")]==fGetValue("status",0)):?>
<input id="hiscer" type="hidden" value="0">
<div class="tipetu"><span class="tpt"><?=getMessage("status");?>:</span> <span class="npt"><?=getMessage("status_0");?></span></div>
<div class="tipetu"><span class="tpt"><?=getMessage("chk");?>:</span> <span class="npt"><?=$_POST[fGetName("chk")]?> - <?=$_POST[fGetName("family")]?> <?=$_POST[fGetName("name")]?></span></div>
<?endif?>
<?if ($_POST[fGetName("status")]==fGetValue("status",1)):?>
<input id="hiscer" type="hidden" value="1">
<div class="tipetu"><span class="tpt"><?=getMessage("status");?>:</span> <span class="npt"><?=getMessage("status_1");?></span></div>
<div class="tipetu"><span class="tpt"><?=getMessage("kem_priglashen_chk");?>:</span> <span class="npt"><?=$_POST[fGetName("kem_priglashen_chk")]?> - <?=$_POST[fGetName("kem_priglashen_family")]?> <?=$_POST[fGetName("kem_priglashen_name")]?></span></div>
<?endif?>
<?if ($_POST[fGetName("status")]==fGetValue("status",2)):?>
<input id="hiscer" type="hidden" value="2">
<div class="tipetu"><span class="tpt"><?=getMessage("status");?>:</span> <span class="npt"><?=getMessage("status_2");?></span></div>
<div class="tipetu"><span class="tpt"><?=getMessage("kem_priglashen_chk");?>:</span> <span class="npt"><?=$_POST[fGetName("kem_priglashen_chk")]?> - <?=$_POST[fGetName("kem_priglashen_family")]?> <?=$_POST[fGetName("kem_priglashen_name")]?></span></div>
<?$spl_chk=$_POST[fGetName("kem_priglashen_chk")]; $spl_family=$_POST[fGetName("kem_priglashen_family")]; $spl_name=$_POST[fGetName("kem_priglashen_name")];?>
<?endif?>

<!-- Скрытые поля  -->
<div class="nevid">

<!--  Шаг регистрации  -->
<input id="t_step" name="<?=fGetName("step",0)?>" value="<?=$t_step?>"  type="text">

<!--  Java  -->
<input name="<?=fGetName("java")?>" value="<?=fGetValue("java",0)?>" type="radio" <?if($_POST[fGetName("java")]==fGetValue("java",0)) echo "checked";?> >
<input name="<?=fGetName("java")?>" value="<?=fGetValue("java",1)?>" type="radio" <?if($_POST[fGetName("java")]==fGetValue("java",1)) echo "checked";?> >

<!--  Статус  -->
<input name="<?=fGetName("status")?>" value="<?=fGetValue("status",0)?>" type="radio" <?if($_POST[fGetName("status")]==fGetValue("status",0)) echo "checked";?> >
<input name="<?=fGetName("status")?>" value="<?=fGetValue("status",1)?>" type="radio" <?if($_POST[fGetName("status")]==fGetValue("status",1)) echo "checked";?> >
<input name="<?=fGetName("status")?>" value="<?=fGetValue("status",2)?>" type="radio" <?if($_POST[fGetName("status")]==fGetValue("status",2)) echo "checked";?> >
<!--  № ЧК  -->
<input id="chk" name="<?=fGetName("chk",0)?>" value="<?=$_POST[fGetName("chk")]?>"  type="text">
<!--  Имя  -->
<input  name="<?=fGetName("name",0)?>" value="<?=$_POST[fGetName("name")]?>"  type="text">
<!--  Фамилия  -->
<input  name="<?=fGetName("family",0)?>" value="<?=$_POST[fGetName("family")]?>"  type="text">
<!--  Кем приглашен № ЧК  -->
<input  name="<?=fGetName("kem_priglashen_chk",0)?>" value="<?=$_POST[fGetName("kem_priglashen_chk")]?>"  type="text">
<!--  Кем приглашен имя  -->
<input  name="<?=fGetName("kem_priglashen_name",0)?>" value="<?=$_POST[fGetName("kem_priglashen_name")]?>"  type="text">
<!--  Кем приглашен фамилия  -->
<input  name="<?=fGetName("kem_priglashen_family",0)?>" value="<?=$_POST[fGetName("kem_priglashen_family")]?>"  type="text">

<!--  Отчество  -->
<input  name="<?=fGetName("middle_name",0)?>" value="<?=$_POST[fGetName("middle_name")]?>"  type="text">
<!--  E-mail  -->
<input  name="<?=fGetName("email",0)?>" value="<?=$_POST[fGetName("email")]?>"  type="text">
<!--  Телефон  -->
<input  name="<?=fGetName("tel",0)?>" value="<?=$_POST[fGetName("tel")]?>"  type="text">
<!--  Скайп  -->
<input  name="<?=fGetName("skype",0)?>" value="<?=$_POST[fGetName("skype")]?>"  type="text">
<!--  Доп. E-mail   -->
<input  name="<?=fGetName("email_2",0)?>" value="<?=$_POST[fGetName("email_2")]?>"  type="text">
<!--  Доп. телефон   -->
<input  name="<?=fGetName("tel_2",0)?>" value="<?=$_POST[fGetName("tel_2")]?>"  type="text">

<!--  Предпочтительный вид связи  -->
<input name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",0)?>" type="radio" <?if($_POST[fGetName("prioritet")]==fGetValue("prioritet",0)) echo "checked";?> >
<input name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",1)?>" type="radio" <?if($_POST[fGetName("prioritet")]==fGetValue("prioritet",1)) echo "checked";?> >
<input name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",2)?>" type="radio" <?if($_POST[fGetName("prioritet")]==fGetValue("prioritet",2)) echo "checked";?> >

<!--  Пол  -->
<input name="<?=fGetName("sex")?>" value="<?=fGetValue("sex",0)?>" type="radio" <?if($_POST[fGetName("sex")]==fGetValue("sex",0)) echo "checked";?> >
<input name="<?=fGetName("sex")?>" value="<?=fGetValue("sex",1)?>" type="radio" <?if($_POST[fGetName("sex")]==fGetValue("sex",1)) echo "checked";?> >

<!--  Возраст  -->
<input name="<?=fGetName("age_border")?>" value="<?=fGetValue("age_border",0)?>" type="radio" <?if($_POST[fGetName("age_border")]==fGetValue("age_border",0)) echo "checked";?> >
<input name="<?=fGetName("age_border")?>" value="<?=fGetValue("age_border",1)?>" type="radio" <?if($_POST[fGetName("age_border")]==fGetValue("age_border",1)) echo "checked";?> >
<input name="<?=fGetName("age_border")?>" value="<?=fGetValue("age_border",2)?>" type="radio" <?if($_POST[fGetName("age_border")]==fGetValue("age_border",2)) echo "checked";?> >
<input name="<?=fGetName("age_border")?>" value="<?=fGetValue("age_border",3)?>" type="radio" <?if($_POST[fGetName("age_border")]==fGetValue("age_border",3)) echo "checked";?> >


<!--  Гражданство  -->
<input  name="<?=fGetName("country",0)?>" value="<?=$_POST[fGetName("country")]?>"  type="text">
<!--  Город проживания  -->
<input  name="<?=fGetName("city",0)?>" value="<?=$_POST[fGetName("city")]?>"  type="text">
<!--  Дата рождения  -->
<input  name="<?=fGetName("birthday",0)?>" value="<?=$_POST[fGetName("birthday")]?>"  type="text">

<!--  Вылюта заявки  -->
<input id="currency"  name="<?=fGetName("currency",0)?>" value=""  type="text"> 
<!--  ID вылюты заявки  -->
<input id="currency_id" name="<?=fGetName("currency_id",0)?>" value=""  type="text"> 
<!--  промоушен оплата  -->
<input id="promotion_3" name="<?=fGetName("promotion_3",0)?>" value=""  type="text">

<!--  Оплачено в базовой валюте в у. е.  -->
<input  name="<?=fGetName("t_money",0)?>" value="0"  type="text">
<!--  Оплачено в Вашей валюте  -->
<input  name="<?=fGetName("t_money_2",0)?>" value="0"  type="text">

<!--  Сумма задолженности  -->
<input  name="<?=fGetName("sum_debt",0)?>" value="0"  type="text">

<!--  Дата поступления заявки  -->
<input  name="<?=fGetName("claimdate",0)?>" value="<?=date("d.m.Y")?>"  type="text">

<!--  код проверки плательщика  -->
<input id="pl_ok_id" name="<?=fGetName("op_ok_id",0)?>" value="1"  type="text">
<!--  код проверки гаранта  -->
<input id="garant_ok_id" name="<?=fGetName("garant_ok_id",0)?>" value="1"  type="text">

<!--  промоушен приглашение  -->
<input  name="<?=fGetName("promotion_1",0)?>" value="<?=$_POST[fGetName("promotion_1",0)]?>"  type="text"> 
<!--  	e-mail из БД  -->
<input  name="<?=fGetName("em_bd",0)?>" value="<?=$_POST[fGetName("em_bd",0)]?>"  type="text">
<!--  	Дата рождения из БД  -->
<input  name="<?=fGetName("dr_bd",0)?>" value="<?=$_POST[fGetName("dr_bd",0)]?>"  type="text">
<!--  	Проверка пройдена  -->
<input  name="<?=fGetName("proverka",0)?>" value="<?=$_POST[fGetName("proverka",0)]?>"  type="text">

<!--  Индекс места  -->
<input  name="<?=fGetName("mesto_index",0)?>" value="<?=fGetResultValues("mesto_index")?>"  type="text">

<!--  Место  -->
<input  name="<?=fGetName("mesto",0)?>" value="<?=fGetResultValues("mesto")?>"  type="text">

<!--  Дата изменения  -->
<input  name="<?=fGetName("date_edit",0)?>" value="<?=date("d.m.Y")?>"  type="text">
<!--  Ключ изменения  -->
<input  name="<?=fGetName("key_edit",0)?>" value="0"  type="text">

</div>


<!--  Форма оплаты  -->
<?if(fGetActive("oplata")):?>
<div class="ti_blo" id="ti_blo_oplata">

<div class="ti_dig">

<div class="tiqa"> <?=getMessage("oplata")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="opl_0"><input name="<?=fGetName("oplata")?>" value="<?=fGetValue("oplata",0)?>" class="" id="opl0" type="radio" <?if(fGetAnswerCode("oplata",0)==$_SESSION["passport_member"]["oplata"]) echo "checked"?> disabled><label for="opl0"> <?=getMessage("oplata_0");?></label></div>

	<div class="ti_dis" id="opl_1"><input name="<?=fGetName("oplata")?>" value="<?=fGetValue("oplata",1)?>" class="" id="opl1" type="radio" <?if(fGetAnswerCode("oplata",1)==$_SESSION["passport_member"]["oplata"]) echo "checked"?> checked disabled><label for="opl1"> <?=getMessage("oplata_1");?></label></div>


</div>


</div>
<?if(fGetComments("oplata")):?><div class="qm"><div class="qm_text"><?=getMessage("oplata_comment")?></div></div><?endif?>
</div>
<?endif?>
 
 <div id="op_div">
 
  <!--  Страна  -->
<?if(fGetActive("op_country")):?>
<div class="ti_blo" id="ti_blo_op_country">
<div class="ti_dig"><div class="tiqa"><?=getMessage("op_country")?><span class="zred"> *</span></div>
<div class="vsta">
	
	<select name="<?=fGetName("op_country",0)?>" id="sel_op_country" onChange="f_chang_country()">
<option></option>
<?php
		
//sort($ar_country_u,SORT_STRING);
$coc=count($ar_country_u);
for($i=0;$i<$coc;$i++)
	{
		echo "<option";
		if($_SESSION["passport_member"]["op_country"]==$ar_country_u[$i]) echo " selected";
		echo ">".$ar_country_u[$i]."</option>";
	}
	
?>
</select>

</div>
</div>	
<?if(fGetComments("op_country")):?><div class="qm"><div class="qm_text"><?=getMessage("op_country_comment")?></div></div><?endif?>
</div>
<?endif?>
 
  <!--  Город  -->
<?if(fGetActive("op_city")):?>
<div class="ti_blo" id="ti_blo_op_city">
<div class="ti_dig"><div class="tiqa"><?=getMessage("op_city")?><span class="zred"> *</span></div>
<div class="vsta" id="soc">
		
	<select  id='sel_op_city' name="<?=fGetName("op_city",0)?>" onChange="f_chang_city()">
	
	</select>	
	</div>
</div>
<?if(fGetComments("op_city")):?><div class="qm"><div class="qm_text"><?=getMessage("op_city_comment")?></div></div><?endif?>
</div>
<?endif?>
	 <?// echo "<pre>";print_r($_SESSION["AR_OP"]);echo "</pre>";?>
 <!--  № Офиса продаж  -->
<?if(fGetActive("op_nof")):?>
<div class="ti_blo" id="ti_blo_op_nof">
<div class="ti_dig"><div class="tiqa"><?=getMessage("op_nof")?><span class="zred"> *</span></div>
<div class="vsta" id="sos">
	
	<select  id='sel_op_nof' name="<?=fGetName("op_nof",0)?>" onChange="f_chang_nof()">
	
	</select>	
	</div>
	</div>
<?if(fGetComments("op_nof")):?><div class="qm"><div class="qm_text"><?=getMessage("op_nof_comment")?></div></div><?endif?>
</div>
<?endif?>

<?if($_SESSION["passport_member"]["op_country"]) echo "<script>f_chang_country()</script>"?>

 <!--  Рассрочка для ОП  -->

<?if(fGetActive("time_money_op")):?>
<div class="ti_blo" id="ti_blo_time_money_op">


<div class="ti_dig">

<div class="tiqa"> <?=getMessage("time_money_op")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="tm_op_0"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",0)?>" class="" id="tm_op0" type="radio" checked><label for="tm_op0"> <?=getMessage("time_money_op_0");?></label></div>
	
	<?if(date("Ymd") <= date_in_int($month_inst_op_1)): // показывать ?>
	<div class="ti_dis" id="tm_op_1"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",1)?>" class="" id="tm_op1" type="radio"><label for="tm_op1"> <?=getMessage("time_money_op_1");?></label></div>
	<?endif?>
	
	<?if(date("Ymd") <= date_in_int($month_inst_op_2)): // показывать ?>
	<div class="ti_dis" id="tm_op_2"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",2)?>" class="" id="tm_op2" type="radio"><label for="tm_op2"> <?=getMessage("time_money_op_2");?></label></div>
	<?endif?>
	
	<?if(date("Ymd") <= date_in_int($month_inst_op_3)): // показывать до ?>
	<div class="ti_dis" id="tm_op_3"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",3)?>" class="" id="tm_op3" type="radio"><label for="tm_op3"> <?=getMessage("time_money_op_3");?></label></div>
	<?endif?>
	
	<?if(date("Ymd") <= date_in_int($month_inst_op_4)): // показывать до ?>
	<div class="ti_dis" id="tm_op_4"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",4)?>" class="" id="tm_op4" type="radio"><label for="tm_op4"> <?=getMessage("time_money_op_4");?></label></div>
	<?endif?>
	
	<?if(date("Ymd") <= date_in_int($month_inst_op_5)): // показывать до ?>
	<div class="ti_dis" id="tm_op_5"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",5)?>" class="" id="tm_op5" type="radio"><label for="tm_op5"> <?=getMessage("time_money_op_5");?></label></div>
	<?endif?>
	
	<?if(date("Ymd") <= date_in_int($month_inst_op_6)): // показывать до ?>
	<div class="ti_dis" id="tm_op_6"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",6)?>" class="" id="tm_op6" type="radio"><label for="tm_op6"> <?=getMessage("time_money_op_6");?></label></div>
	<?endif?>
	
	<?if(date("Ymd") <= date_in_int($month_inst_op_7)): // показывать до ?>
	<div class="ti_dis" id="tm_op_7"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",7)?>" class="" id="tm_op7" type="radio"><label for="tm_op7"> <?=getMessage("time_money_op_7");?></label></div>
	<?endif?>
	
	<?if(date("Ymd") <= date_in_int($month_inst_op_8)): // показывать до ?>
	<div class="ti_dis" id="tm_op_8"><input name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",8)?>" class="" id="tm_op8" type="radio"><label for="tm_op8"> <?=getMessage("time_money_op_8");?></label></div>
	<?endif?>

</div>


</div>
<?if(fGetComments("time_money_chk")):?><div class="qm"><div class="qm_text"><?=getMessage("time_money_chk_comment")?></div></div><?endif?>
</div>
<?endif?>

 </div>
 
 <div id="pl_div">
 
  <!--  № ЧК плательщика  -->
<?if(fGetActive("pl_chk")):?>
<div class="ti_blo" id="ti_blo_pl_chk">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("pl_chk")?><span class="zred">*</span></div><input id="" name="<?=fGetName("pl_chk")?>" value="<?=$_SESSION["passport_member"]["pl_chk"]?>" class="" type="text"  onkeyup="pro_pl()"></div>
<?if(fGetComments("pl_chk")):?><div class="qm"><div class="qm_text"><?=getMessage("pl_chk_comment")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Имя плательщика  -->
<?if(fGetActive("pl_name")):?>
<div class="ti_blo" id="ti_blo_pl_name">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("pl_name")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("pl_name")?>" value="<?=$_SESSION["passport_member"]["pl_name"]?>" class="" type="text"  onkeyup="pro_pl()"></div>
<?if(fGetComments("pl_name")):?><div class="qm"><div class="qm_text"><?=getMessage("pl_name_comment")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Фамилия плательщика  -->
<?if(fGetActive("pl_family")):?>
<div class="ti_blo" id="ti_blo_pl_family">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("pl_family")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("pl_family")?>" value="<?=$_SESSION["passport_member"]["pl_family"]?>" class="" type="text"  onkeyup="pro_pl()"></div>
<?if(fGetComments("pl_family")):?><div class="qm"><div class="qm_text"><?=getMessage("pl_family_comment")?></div></div><?endif?>
</div>
<?endif?>

  <!--  № телефона плательщика  -->
<?if(fGetActive("pl_phone")):?>
<div class="ti_blo" id="ti_blo_pl_phone">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("pl_phone")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("pl_phone")?>" value="<?=$_SESSION["passport_member"]["pl_phone"]?>" class="" type="text" onkeyup="sub_but()"></div>
<?if(fGetComments("pl_phone")):?><div class="qm"><div class="qm_text"><?=getMessage("pl_phone_comment")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Проверка плательщика	  -->
<?if(fGetActive("pl_ok")):?>
<div class="ti_blo" id="ti_blo_pl_ok" style="display:none;">
<input type="hidden" value="<?=getMessage('HI_OP_OK_0');?>">
<input type="hidden" value="<?=getMessage('HI_OP_OK_1');?>">
<input type="hidden" value="<?=getMessage('HI_OP_OK_2');?>">
<input type="hidden" value="<?=getMessage('HI_OP_OK_3');?>">
<input type="hidden" value="<?=getMessage('OK_NOTE');?>">
<!--<div id="but_op_ok" class="stid_dp" style="" onclick="show_check()" ><?=getMessage('TITLE_OP_OK');?></div>-->
<div class="ti_dig"><div class="tiqa"> <?=getMessage("pl_ok")?> </div><input id="pl_ok" name="<?=fGetName("pl_ok")?>" value="<?=fGetValue("pl_ok")?>" class="" type="text" onkeyup="sub_but()" readonly ></div>
<?if(fGetComments("pl_ok")):?><div class="qm"><div class="qm_text"><?=getMessage("pl_ok_comment")?></div></div><?endif?>

</div>
<?endif?>


 <div id="garant_div">
 
   <!--  № ЧК гаранта  -->
<?if(fGetActive("garant_chk")):?>
<div class="ti_blo" id="ti_blo_garant_chk">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("garant_chk")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("garant_chk")?>" value="<?=fGetValue("garant_chk")?>" class="" type="text"></div>
<?if(fGetComments("garant_chk")):?><div class="qm"><div class="qm_text"><?=getMessage("garant_chk_comment")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Имя гаранта  -->
<?if(fGetActive("garant_name")):?>
<div class="ti_blo" id="ti_blo_garant_name">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("garant_name")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("garant_name")?>" value="<?=fGetValue("garant_name")?>" class="" type="text"></div>
<?if(fGetComments("garant_name")):?><div class="qm"><div class="qm_text"><?=getMessage("garant_name_comment")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Фамилия гаранта  -->
<?if(fGetActive("garant_family")):?>
<div class="ti_blo" id="ti_blo_garant_family">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("garant_family")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("garant_family")?>" value="<?=fGetValue("garant_family")?>" class="" type="text"></div>
<?if(fGetComments("garant_family")):?><div class="qm"><div class="qm_text"><?=getMessage("garant_family_comment")?></div></div><?endif?>
</div>
<?endif?>
 
   <!--  Проверка гаранта	  -->
<?if(fGetActive("garant_ok")):?>
<div class="ti_blo" id="ti_blo_garant_ok" style="display:none;">
<input type="hidden" value="<?=getMessage('p_ERROR_NOTE_5');?>">
<input type="hidden" value="<?=getMessage('p_ERROR_NOTE_6');?>">
<input type="hidden" value="<?=getMessage('p_ERROR_NOTE_4');?>">
<!--<div id="but_op_gr" class="stid_dp" style="" onclick="show_check_gr()" ><?=getMessage('TITLE_OP_GR');?></div>-->
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("garant_ok")?></div><input id="garant_ok" name="<?=fGetName("garant_ok")?>" value="<?=fGetValue("garant_ok")?>" class="" type="text" onkeyup="sub_but()" readonly></div>
<?if(fGetComments("garant_ok")):?><div class="qm"><div class="qm_text"><?=getMessage("garant_ok_comment")?></div></div><?endif?>

</div>
<?endif?>
 
 </div>
 
 <!--  Рассрочка для чека  -->
 
<?if(fGetActive("time_money_chk")):?>
<div class="ti_blo" id="ti_blo_time_money_chk" >

<div class="ti_dig">

<div class="tiqa"> <?=getMessage("time_money_chk")?><span class="zred">*</span></div>

<div class="vsta">

	<div class="ti_dis" id="tm_chk_0"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",0)?>" class="" id="tm_chk0" type="radio" checked><label for="tm_chk0"> <?=getMessage("time_money_chk_0");?></label></div>

	<?if(date("Ymd") <= date_in_int($month_inst_chk_1)): // показывать до ?>
	<div class="ti_dis" id="tm_chk_1"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",1)?>" class="" id="tm_chk1" type="radio"><label for="tm_chk1"> <?=getMessage("time_money_chk_1");?></label></div>
	<?endif?>
	
	<?if(date("Ymd") <= date_in_int($month_inst_chk_2)): // показывать до ?>
	<div class="ti_dis" id="tm_chk_2"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",2)?>" class="" id="tm_chk2" type="radio"><label for="tm_chk2"> <?=getMessage("time_money_chk_2");?></label></div>
	<?endif?>
	
	<?if(date("Ymd") <= date_in_int($month_inst_chk_3)): // показывать до ?>
	<div class="ti_dis" id="tm_chk_3"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",3)?>" class="" id="tm_chk3" type="radio"><label for="tm_chk3"> <?=getMessage("time_money_chk_3");?></label></div>
	<?endif?>
	
	<?if(date("Ymd") <= date_in_int($month_inst_chk_4)): // показывать до?>
	<div class="ti_dis" id="tm_chk_4"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",4)?>" class="" id="tm_chk4" type="radio"><label for="tm_chk4"> <?=getMessage("time_money_chk_4");?></label></div>
	<?endif?>
	
	<?if(date("Ymd") <= date_in_int($month_inst_chk_5)): // показывать до ?>
	<div class="ti_dis" id="tm_chk_5"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",5)?>" class="" id="tm_chk5" type="radio"><label for="tm_chk5"> <?=getMessage("time_money_chk_5");?></label></div>
	<?endif;?>
	
	<?if(date("Ymd") <= date_in_int($month_inst_chk_6)): // показывать до?>
	<div class="ti_dis" id="tm_chk_6"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",6)?>" class="" id="tm_chk6" type="radio"><label for="tm_chk6"> <?=getMessage("time_money_chk_6");?></label></div>
	<?endif;?>
	
	<?if(date("Ymd") <= date_in_int($month_inst_chk_7)): // показывать до?>
	<div class="ti_dis" id="tm_chk_7"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",7)?>" class="" id="tm_chk7" type="radio"><label for="tm_chk7"> <?=getMessage("time_money_chk_7");?></label></div>
	<?endif;?>
	
	<?if(date("Ymd") <= date_in_int($month_inst_chk_8)): // показывать до?>
	<div class="ti_dis" id="tm_chk_8"><input name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",8)?>" class="" id="tm_chk8" type="radio"><label for="tm_chk8"> <?=getMessage("time_money_chk_8");?></label></div>
	<?endif;?>

</div>


</div>
<?if(fGetComments("time_money_chk")):?><div class="qm"><div class="qm_text"><?=getMessage("time_money_chk_comment")?></div></div><?endif?>
</div>
<?endif?>
 
 </div>
 
</div>
</td></tr></table>

<? include "button_step.php"; // Кнопки перехода к следующему шагу ?>


 </form>
 </div>

<br/><br/><br/><br/><br/>



<div class="hid_error_text">

<!-- Сообщение проверки платильщика - не пройдена  -->
<div class="div_err" id="div_er_pro1"> 

<?=getMessage("p_ERROR_NOTE")?><br/>
<?=getMessage("p_ERROR_NOTE_0")?><br/>

</div>
<!-- Сообщение проверки плательщика -  пройдена  -->
<div class="div_err" id="div_er_pro0"> 

<?=getMessage("OK_NOTE")?><br/>

</div>
<!-- Сообщение проверки плательщика - нужен гарант  -->
<div class="div_err" id="div_er_pro2"> 

<?=getMessage("ERROR_NOTE")?><br/>
<?=getMessage("p_ERROR_NOTE_2")?><br/><br/>

</div>

<!-- Сообщение проверки плательщика - не пройдена   -->
<div class="div_err" id="div_er_pro3"> 

<?=getMessage("ERROR_NOTE")?><br/>
<?=getMessage("p_ERROR_NOTE_0")?><br/><br/>

</div>

<!-- Сообщение проверки плательщика - не пройдена исчерпан лимит  -->
<div class="div_err" id="div_er_pro4"> 

<?=getMessage("ERROR_NOTE")?><br/>
<?=getMessage("p_ERROR_NOTE_8")?><br/><br/>

</div>

<!-- Сообщение проверки  Проверка Гаранта не пройдена  -->
<div class="div_err" id="div_er_pro5"> 

<?=getMessage("ERROR_NOTE")?><br/>
<?=getMessage("p_ERROR_NOTE_5")?><br/><br/>

</div>

<!-- Сообщение проверки ошибка обращения к БД  -->
<div class="div_err" id="div_er_pro6"> 

<?=getMessage("ERROR_NOTE")?><br/>
<?=getMessage("p_ERROR_NOTE_9")?><br/><br/>

</div>

</div>



