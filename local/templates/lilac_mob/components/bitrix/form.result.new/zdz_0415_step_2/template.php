<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?>
<?global $t_step; // Шаг регистрации?>
<? include "var_config.php"; // Конфигурация мероприятия?>
<? include "functions.php";  // Функции PHP?>


<? include "header_form.php"; // Шапка формы ?>
<? include "note_error.php"; // Ошибки заполнения ?>
<?
global $APPLICATION, $USER, $CCIExternalAuth;

//$oWS = new CCI_PDPWS();
// ОПРЕДЕЛЯЕМ СЕССИЮ
//$iDSesison = $APPLICATION->get_cookie("BX_AUTH_SESSION_ID");
//if(empty($iDSesison)) {$iDSesison = $USER->GetLogin();};
//if(empty($iDSesison)) {$iDSesison = "SOS";}

?>

<script src="/js/chosen/chosen.jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/js/chosen/chosen.css" />

<?
// переменные для проверки ЧК и гостей ЧК

// Входящие данные для проверки участника  /////////////
$p_chk=$_POST[fGetName("chk")];  // № ЧК
$p_family=$_POST[fGetName("family")]; // фамилия
$p_name=$_POST[fGetName("name")];  // имя
$p_kem_priglashen_chk=$_POST[fGetName("kem_priglashen_chk")]; // Кем приглашён № ЧК
$p_kem_priglashen_family=$_POST[fGetName("kem_priglashen_family")]; // Кем приглашён фамилия
$p_kem_priglashen_name=$_POST[fGetName("kem_priglashen_name")]; // Кем приглашён имя
$p_status=$_POST[fGetName("status")];   // статус участника

$a_status[0]=fGetValue("status",0);
$a_status[1]=fGetValue("status",1);
$a_status[2]=fGetValue("status",2);

include "filter_chk.php"; // Подключаем проверки ЧК и гостей ЧК
?>

<?if($erk) : // Если проверки не пройдены /// ?> 
<div class="dicer">
<?
$fu=0;   
foreach($errors as $key=>$val) {
		echo "<div class='mess_rey'><div class='luch'></div><div>".getMessage('GER_TIT_2')."</div>".$val; // Текст ошибки
		if($key=="MEMBER" and count($errors) == 1) $fu=1;                // Разрешить регистрацию даже, если не пройдено условие участия
		else echo "<br><br> <a href='step_1.php?pravila=1'>".getMessage('GER_VER')."</a>"; // Ссылка "Вернуться"
		echo "</div>";
	}
?>
</div>
<?endif;?>

<?$fu=1; // Открыть доступ к регистрации в любом случае?>

<?if($fu) {  // Регистрация доступна ?>

<div id="ti_form">
<form action="<?=$dir_event?>step_3.php" method="POST" onsubmit="return sub_form()">


<table id="cont_t">

<tr valign="top">

<td>

<div  class="right_b">



<div class="title_step">
<div id="title_step2">&nbsp;&nbsp;<?=getMessage('TITLE_STEP2')?> &nbsp;<?=getMessage('TITLE_PR2')?></div>

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


<!--  Кем приглашен № ЧК  -->
<input  name="<?=fGetName("kem_priglashen_chk",0)?>" value="<?=$_POST[fGetName("kem_priglashen_chk")]?>"  type="text">
<!--  Кем приглашен имя  -->
<input  name="<?=fGetName("kem_priglashen_name",0)?>" value="<?=$_POST[fGetName("kem_priglashen_name")]?>"  type="text">
<!--  Кем приглашен фамилия  -->
<input  name="<?=fGetName("kem_priglashen_family",0)?>" value="<?=$_POST[fGetName("kem_priglashen_family")]?>"  type="text">
<!--  № ЧК  -->
<input  name="<?=fGetName("chk",0)?>" value="<?=$_POST[fGetName("chk")]?>"  type="text">
<!--  Имя  -->
<input  name="<?=fGetName("name",0)?>" value="<?=$_POST[fGetName("name")]?>"  type="text">
<!--  Фамилия  -->
<input  name="<?=fGetName("family",0)?>" value="<?=$_POST[fGetName("family")]?>"  type="text">
<!--  промоушен приглашение  -->
<input  name="<?=fGetName("promotion_1",0)?>" value="<?=$promotion_1?>"  type="text">
<!--промоушн оплата -->
<input id="promotion_3" name="<?=fGetName("promotion_3")?>" value="<?=$promotion_3?>">
<!--ID вылюты заявки -->
<input id="currency_id" name="<?=fGetName("currency_id",0)?>" value="">
<!--Вылюта заявки -->
<input id="currency" name="<?=fGetName("currency",0)?>" value="">

<!--  	e-mail из БД  -->
<input  name="<?=fGetName("em_bd",0)?>" value="<?=$email?>"  type="text">
<!--  	Дата рождения из БД  -->
<input  name="<?=fGetName("dr_bd",0)?>" value=""  type="text">
<!--  	Проверка пройдена  -->
<input  name="<?=fGetName("proverka",0)?>" value="<?=date("d.m.Y H:i:s")." ".LANGUAGE_ID?>"  type="text">

</div>


<!--  Отчество  -->
<?if(fGetActive("middle_name")):?>
<div class="ti_blo" id="ti_blo_middle_name">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("middle_name")?></div><input id="" name="<?=fGetName("middle_name")?>" value="<?=$_SESSION["passport_member"]["middle_name"]?>" class="" type="text"></div>
<?if(fGetComments("middle_name")):?><div class="qm"><div class="qm_text"><?=getMessage("middle_name_comment")?></div></div>
<?endif?>
</div>
<?endif?>

<div id="pvs">
<!--  E-mail  -->
<?if(fGetActive("email")):?>
<div class="ti_blo" id="ti_blo_email">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("email")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("email")?>" value="<?=$_SESSION["passport_member"]["email"]?>" class="" type="text"></div>
<?if(fGetComments("email")):?><div class="qm"><div class="qm_text"><?=getMessage("email_comment")?></div></div><?endif?>
<div class="ti_dil"><input id="pr0" class="" name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",0)?>" type="radio" onchange="sub_but()" <?if(fGetAnswerCode("prioritet",0)==$_SESSION["passport_member"]["prioritet"]) echo "checked"?>> <label for="pr0"><?=getMessage("prioritet");?></label></div> 
</div>
<?endif?>

<!--  Телефон  -->
<?if(fGetActive("tel")):?>
<div class="ti_blo" id="ti_blo_tel">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("tel")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("tel")?>" value="<?=$_SESSION["passport_member"]["tel"]?>" class="" type="text"></div>
<?if(fGetComments("tel")):?><div class="qm"><div class="qm_text"><?=getMessage("tel_comment")?></div></div><?endif?>
<div class="ti_dil"><input id="pr1" class="" name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",1)?>" type="radio" onchange="sub_but()" <?if(fGetAnswerCode("prioritet",1)==$_SESSION["passport_member"]["prioritet"] || !$_SESSION["passport_member"]["prioritet"]) echo "checked"?>> <label for="pr1"><?=getMessage("prioritet");?></label></div>
</div>
<?endif?>

<!--  Скайп  -->
<?if(fGetActive("skype")):?>
<div class="ti_blo" id="ti_blo_skype">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("skype")?></div><input id="" name="<?=fGetName("skype")?>" value="<?=$_SESSION["passport_member"]["skype"]?>" class="" type="text"></div>
<?if(fGetComments("skype")):?><div class="qm"><div class="qm_text"><?=getMessage("skype_comment")?></div></div><?endif?>
<div class="ti_dil"><input id="pr2" class="" name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",2)?>" type="radio" onchange="sub_but()" <?if(fGetAnswerCode("prioritet",2)==$_SESSION["passport_member"]["prioritet"]) echo "checked"?>> <label for="pr2"><?=getMessage("prioritet");?></label></div>
</div>
<?endif?>

<!--  Доп. e-mail  -->
<?if(fGetActive("email_2")):?>
<div class="ti_blo" id="ti_blo_email_2">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("email_2")?></div><input id="" name="<?=fGetName("email_2")?>" value="<?=$_SESSION["passport_member"]["email_2"]?>" class="" type="text"></div>
<?if(fGetComments("email_2")):?><div class="qm"><div class="qm_text"><?=getMessage("email_2_comment")?></div></div><?endif?>
</div>
<?endif?>

<!--  Доп. телефон  -->
<?if(fGetActive("tel_2")):?>
<div class="ti_blo" id="ti_blo_tel_2">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("tel_2")?></div><input id="" name="<?=fGetName("tel_2")?>" value="<?=$_SESSION["passport_member"]["tel_2"]?>" class="" type="text"></div>
<?if(fGetComments("tel_2")):?><div class="qm"><div class="qm_text"><?=getMessage("tel_2_comment")?></div></div><?endif?>
</div>
<?endif?>
</div>

<!--  Пол  -->
<?if(fGetActive("sex")):?>
<div class="ti_blo" id="ti_blo_sex">


<div class="ti_dig">

<div class="tiqa"> <?=getMessage("sex")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="sx_0"><input name="<?=fGetName("sex")?>" value="<?=fGetValue("sex",0)?>" class="" id="sx0" type="radio" <?if(fGetAnswerCode("sex",0)==$_SESSION["passport_member"]["sex"]) echo "checked"?>><label for="sx0"> <?=getMessage("sex_0");?></label></div>

	<div class="ti_dis" id="sx_1"><input name="<?=fGetName("sex")?>" value="<?=fGetValue("sex",1)?>" class="" id="sx1" type="radio" <?if(fGetAnswerCode("sex",1)==$_SESSION["passport_member"]["sex"]) echo "checked"?>><label for="sx1"> <?=getMessage("sex_1");?></label></div>

</div>


</div>
<?if(fGetComments("sex")):?><div class="qm"><div class="qm_text"><?=getMessage("sex_comment")?></div></div><?endif?>
</div>
<?endif?>



<!--  Дата рождения  -->
<?$ar_birthday_s=explode(".",$_SESSION["passport_member"]["birthday"]);// Разбиение даты рождения из паспорта участника на составляющие?>
<?if(fGetActive("birthday")):?>
<div class="ti_blo" id="ti_blo_birthday">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("birthday")?><span class="zred"> *</span></div>
	 <input id="date_b" name="<?=fGetName("birthday")?>" value="<?=fGetValue("birthday")?>" style="display:none;" type="text" readonly>
	 <div class="vida" id="vida"> 
<?=getMessage("number")?>
<select id="b_d_birthday" class="b_d">
<option value=''>---</option>
<?
for($i=1;$i<=31;$i++){
echo "<option value='".$i."'";
if((int)$ar_birthday_s[0]==$i) echo " selected";
echo ">".$i."</option>";
}
?>
</select>

<?=getMessage("month")?>
<select id="b_m_birthday" class="b_m">
<option value=''>---</option>
<?
//$ar_month=array("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");
for($i=0;$i<12;$i++){
//$to=getMessage($ar_month[$i]);
$to=getMessage("month".($i+1));
echo "<option value='".($i+1)."'";
if((int)$ar_birthday_s[1]==($i+1)) echo " selected";
echo ">".$to."</option>";
}
?>
</select>


<?=getMessage("year")?>
<select id="b_y_birthday" class="b_y">
<option value=''>---</option>
<?
for($i=1914;$i<=2014;$i++){
echo "<option value='".$i."'";
if((int)$ar_birthday_s[2]==$i) echo " selected";
echo ">".$i."</option>";
}
?>
</select>
<!--<div class="but_vida" onclick="f_vida()">выбрать</div>-->
</div>
	 </div>
<?if(fGetComments("birthday")):?><div class="qm"><div class="qm_text"><?=getMessage("birthday_comment")?></div></div><?endif?>
</div>


<?endif?>

<!--  Возраст  -->
<?if(fGetActive("age")):?>
<div class="ti_blo" id="ti_blo_age">


<div class="ti_dig">

<div class="tiqa"> <?=getMessage("age")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="ag_0"><input name="<?=fGetName("age_border")?>" value="<?=fGetValue("age_border",0)?>" answercode="<?=fGetAnswerCode("age_border",0)?>" class="" id="ag0" type="radio"><label for="ag0"> <?=getMessage("age_0");?></label></div>

	<div class="ti_dis" id="ag_1"><input name="<?=fGetName("age_border")?>" value="<?=fGetValue("age_border",1)?>" answercode="<?=fGetAnswerCode("age_border",1)?>" class="" id="ag1" type="radio"><label for="ag1"> <?=getMessage("age_1");?></label></div>

	<div class="ti_dis" id="ag_2"><input name="<?=fGetName("age_border")?>" value="<?=fGetValue("age_border",2)?>" answercode="<?=fGetAnswerCode("age_border",2)?>" class="" id="ag2" type="radio"><label for="ag2"> <?=getMessage("age_2");?></label></div>

	<div class="ti_dis" id="ag_3"><input name="<?=fGetName("age_border")?>" value="<?=fGetValue("age_border",3)?>" answercode="<?=fGetAnswerCode("age_border",3)?>" class="" id="ag3" type="radio"><label for="ag3"> <?=getMessage("age_3");?></label></div>
<!--
	<div class="ti_dis" id="ag_4"><input name="<?=fGetName("age_border")?>" value="<?=fGetValue("age_border",4)?>" answercode="<?=fGetAnswerCode("age_border",4)?>" class="" id="ag4" type="radio"><label for="ag4"> <?=getMessage("age_4");?></label></div>
-->
</div>


</div>
<?if(fGetComments("age")):?><div class="qm"><div class="qm_text"><?=getMessage("age_comment")?></div></div><?endif?>
</div>
<?endif?>

<!--  Гражданство  -->
<?if(fGetActive("country")):?>
<? include "../list_countries.php"; ?>

<div class="ti_blo" id="ti_blo_country">

<div class="ti_dig"><div class="tiqa"><?=getMessage("country")?><span class="zred"> *</span></div>
<div class="vsta_s">

<select name="<?=fGetName("country",0)?>" id="sel_country" class='chzn-select'>
<?php

$coc=count($ar_part_world[LANGUAGE_ID]);
for($i=0;$i<$coc;$i++)
	{
	echo "<optgroup label='".$ar_part_world[LANGUAGE_ID][$i]."'>";
	$v_ar_c=@explode(";",$ar_country[LANGUAGE_ID][$i]);
	asort($v_ar_c);
		foreach($v_ar_c as $val) {
		echo "<option";
		if($_SESSION["passport_member"]["country"]==$val) echo " selected";
		echo ">".$val."</option>";
		}
	echo "</optgroup>";
	}
?>
</select>
</div>
</div>
<?if(fGetComments("country")):?>&nbsp;&nbsp;&nbsp;&nbsp;<div class="qm"><div class="qm_text"><?=getMessage("country_comment")?></div></div><?endif?>
<script type="text/javascript"> 
// Инициализация плагина для select
$(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true});
 </script>

 </div>
<?endif?> 
 
 <!--  Город проживания  -->
<?if(fGetActive("city")):?>
<div class="ti_blo" id="ti_blo_city">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("city")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("city")?>" value="<?=$_SESSION["passport_member"]["city"]?>" class="" type="text"></div>
<?if(fGetComments("city")):?><div class="qm"><div class="qm_text"><?=getMessage("city_comment")?></div></div><?endif?>
</div>
<?endif?>
 

 
</div>
</td></tr></table>

<? include "button_step.php"; // Кнопки перехода к следующему шагу ?>

 </form>
 </div>
<?}?>
<br/><br/><br/><br/><br/>



