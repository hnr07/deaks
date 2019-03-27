<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?global $t_step; // Шаг регистрации?>
<? include "var_config.php"; // Конфигурация мероприятия?>
<? include "functions.php";  // Функции PHP?>


<?// include_once "functions_leadership.php"; // фкнкции для leadership?>

<? include "header_form.php"; // Шапка формы ?>
<? include "note_error.php"; // Ошибки заполнения ?>

<div id="ti_form">
<? 
$ar_head_form=explode(" ",$arResult["FORM_HEADER"],2);

$head_form=$ar_head_form[0]." onsubmit=\"return sub_form()\"  onreset=\"res_form()\" ".$ar_head_form[1];
echo $head_form;

?>
<?=bitrix_sessid_post()?>

<table id="cont_t">

<tr valign="top">

<td>

<div  class="right_b">



<div class="title_step">
<div id="title_step2">&nbsp;&nbsp;<?=getMessage('TITLE_STEP5')?> &nbsp;<?=getMessage('TITLE_PR5')?></div>

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
//echo "<pre>";print_r($arResult);echo "</pre>";
?>

<!--  Если предыдущий шаг не пройден возврат на начало  -->
<?if(fGetResultValues("step")<>($t_step-1)){?>
<meta http-equiv="Refresh" content="0; URL=<?=$dir_event?>index.php">
<?}?>


<? include "meter_hotel.php"; // файл подсчёта количества номеров ?>
<input type="hidden" id="meter_nomer" value="<?=$is_nora;?>">
<? include "meter_hotel_ls.php"; // файл подсчёта количества номеров ?>
<input type="hidden" id="meter_nomer_ls" value="<?=$is_nora_ls;?>">
<? include "meter_fly.php"; // файл подсчёта количества рейсов ?>
<input type="hidden" id="meter_fly" value="<?=$is_fly;?>">

<?if (fGetResultValues("status")==fGetValue("status",0)):?>
<input id="hiscer" type="hidden" value="0">
<div class="tipetu"><span class="tpt"><?=getMessage("status");?>:</span> <span class="npt"><?=getMessage("status_0");?></span></div>
<div class="tipetu"><span class="tpt"><?=getMessage("chk");?>:</span> <span class="npt"><?=fGetResultValues("chk")?> - <?=fGetResultValues("family")?> <?=fGetResultValues("name")?></span></div>
<?endif?>
<?if (fGetResultValues("status")==fGetValue("status",1)):?>
<input id="hiscer" type="hidden" value="1">
<div class="tipetu"><span class="tpt"><?=getMessage("status");?>:</span> <span class="npt"><?=getMessage("status_1");?></span></div>
<div class="tipetu"><span class="tpt"><?=getMessage("kem_priglashen_chk");?>:</span> <span class="npt"><?=fGetResultValues("kem_priglashen_chk")?> - <?=fGetResultValues("kem_priglashen_family")?> <?=fGetResultValues("kem_priglashen_name")?></span></div>
<?endif?>
<?if (fGetResultValues("status")==fGetValue("status",2)):?>
<input id="hiscer" type="hidden" value="2">
<div class="tipetu"><span class="tpt"><?=getMessage("status");?>:</span> <span class="npt"><?=getMessage("status_2");?></span></div>
<div class="tipetu"><span class="tpt"><?=getMessage("kem_priglashen_chk");?>:</span> <span class="npt"><?=fGetResultValues("kem_priglashen_chk")?> - <?=fGetResultValues("kem_priglashen_family")?> <?=fGetResultValues("kem_priglashen_name")?></span></div>
<?$spl_chk=fGetResultValues("kem_priglashen_chk"); $spl_family=fGetResultValues("kem_priglashen_family"); $spl_name=fGetResultValues("kem_priglashen_name");?>
<?endif?>


<!-- Скрытые поля  -->
<div class="nevid">
<? include "field_form.php"; // Все поля формы?>

<!-- Скрытые поля для перезаписи значений  -->
<!--  Шаг регистрации  -->
<input id="t_step" name="<?=fGetName("step",0)?>" value="<?=$t_step?>"  type="text">

</div>



  <!--  Вариант проживания  -->
<?if(fGetActive("p_hotel")):?>
<div class="ti_blo" id="ti_blo_p_hotel">

<div class="ti_dig">

<div class="tiqa"> <?=getMessage("p_hotel")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="p_hotel_0"><input name="<?=fGetName("p_hotel")?>" value="<?=fGetValue("p_hotel",0)?>" class="" id="p_hotel0" type="radio" checked><label for="p_hotel0"> <?=getMessage("p_hotel_0");?></label></div>

	<div class="ti_dis" id="p_hotel_1" style="display:none;"><input name="<?=fGetName("p_hotel")?>" value="<?=fGetValue("p_hotel",1)?>" class="" id="p_hotel1" type="radio"><label for="p_hotel1"> <?=getMessage("p_hotel_1");?></label></div>

</div>

</div>
<?if(fGetComments("p_hotel")):?><div class="qm"><div class="qm_text"><?=getMessage("p_hotel_comment")?></div></div><?endif?>
</div>
<?endif?>

<div class="not_f"><img src="/images/registration_event/info_24.png"><div class="luch"></div><?=getMessage("NOTE_FLY_0_5")?> <?=getMessage("DATE3")?></div>

<?//echo $ka_lsh;?>
<?//echo $so_lsh;?>
  <!--  Участие в Leader Ship   -->
  
<?if(fGetActive("d_leader_ship")):?>
<div class="ti_blo" id="ti_blo_d_leader_ship"  style="display:<?=$ka_lsh?"block":"none";?>">

<div class="ti_dig">

<div class="tiqa"> <?=getMessage("d_leader_ship")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="d_leader_ship_0"><input name="<?=fGetName("d_leader_ship")?>" value="<?=fGetValue("d_leader_ship",0)?>" class="" id="d_leader_ship0" type="radio" onchange="f_nochev_fly()" <?=$ka_lsh?"checked":""?>><label for="d_leader_ship0"> <?=getMessage("d_leader_ship_0");?></label></div>

	<div class="ti_dis" id="d_leader_ship_1"><input name="<?=fGetName("d_leader_ship")?>" value="<?=fGetValue("d_leader_ship",1)?>" class="" id="d_leader_ship1" type="radio" onchange="f_nochev_fly()" <?=!$ka_lsh?"checked":""?>><label for="d_leader_ship1"> <?=getMessage("d_leader_ship_1");?></label></div>

</div>

</div>
<?if(fGetComments("d_leader_ship")):?><div class="qm"><div class="qm_text"><?=getMessage("d_leader_ship_comment")?></div></div><?endif?>
</div>
<?endif?>



  <!--  Соучастие в Leader Ship   -->
  
<?if(fGetActive("s_leader_ship")):?>
<div class="ti_blo" id="ti_blo_s_leader_ship" style="display:<?=$so_lsh?"block":"none";?>">

<div class="ti_dig">

<div class="tiqa"> <?=getMessage("s_leader_ship")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="s_leader_ship_0"><input name="<?=fGetName("s_leader_ship")?>" value="<?=fGetValue("s_leader_ship",0)?>" class="" id="s_leader_ship0" type="radio" onchange="f_nochev_fly()" <?=$so_lsh?"checked":""?>><label for="s_leader_ship0"> <?=getMessage("s_leader_ship_0");?></label></div>

	<div class="ti_dis" id="s_leader_ship_1"><input name="<?=fGetName("s_leader_ship")?>" value="<?=fGetValue("s_leader_ship",1)?>" class="" id="s_leader_ship1" type="radio" onchange="f_nochev_fly()" <?=!$so_lsh?"checked":""?>><label for="s_leader_ship1"> <?=getMessage("s_leader_ship_1");?></label></div>

</div>

</div>
<?if(fGetComments("s_leader_ship")):?><div class="qm"><div class="qm_text"><?=getMessage("s_leader_ship_comment")?></div></div><?endif?>
</div>
<?endif?>




<div id="hotel_to" style="display:none;">

<!--  Дата начала проживания  -->
<?if(fGetActive("day_hotel_start")):?>
<div class="ti_blo" id="ti_blo_day_hotel_start">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("day_hotel_start")?><span class="zred"> *</span></div>
	 <input id="date_day_hotel_start" name="<?=fGetName("day_hotel_start")?>" value="<?=fGetValue("day_hotel_start")?>" style="display:none;" type="text" readonly>
	 	 <div class="vida" id="vida"> 
<?=getMessage("number")?>
<select id="b_d_day_hotel_start" class="b_d" onchange="f_nochev_fly()">
<option value=''>---</option>
<?
for($i=1;$i<=31;$i++){
//if($i==28) $vco="color:red;";
//else $vco="";
echo "<option value='".$i."' style='".$vco."'>".$i."</option>";
}
?>
</select>

<?=getMessage("month")?>
<select id="b_m_day_hotel_start" class="b_m" onchange="f_nochev_fly()">

<?
//$ar_month=array("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");
for($i=2;$i<4;$i++){
//$to=getMessage($ar_month[$i]);
$to=getMessage("month".($i+1));
echo "<option value='".($i+1)."'";
echo ">".$to."</option>";
}
?>
</select>

<?=getMessage("year")?>
<select id="b_y_day_hotel_start" class="b_y" onchange="f_nochev_fly()">

<?
for($i=2015;$i<=2025;$i++){
echo "<option value='".$i."'>".$i."</option>";
}
?>
</select>
<!--<div class="but_vida" onclick="f_vida()">выбрать</div>-->
</div>
	 </div>
<?if(fGetComments("day_hotel_start")):?><div class="qm"><div class="qm_text"><?=getMessage("day_hotel_start_comment")?></div></div><?endif?>
</div>
<?endif?>

<!--<div class="not_f"><img src="/images/registration_event/info_24.png"><div class="luch"></div><?=getMessage("DATE1")?></div>-->

<!--  	Дата окончания проживания  -->
<?if(fGetActive("day_hotel_finish")):?>
<div class="ti_blo" id="ti_blo_day_hotel_finish">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("day_hotel_finish")?><span class="zred"> *</span></div>
	  <input id="date_day_hotel_finish" name="<?=fGetName("day_hotel_finish")?>" value="<?=fGetValue("day_hotel_finish")?>" style="display:none;" type="text" readonly>
	 	 	 <div class="vida" id="vida"> 
<?=getMessage("number")?>
<select id="b_d_day_hotel_finish" class="b_d" onchange="f_nochev_fly()">
<option value=''>---</option>
<?
for($i=1;$i<=31;$i++){
if($i==4) $vco="color:red;";
else $vco="";
echo "<option value='".$i."' style='".$vco."'>".$i."</option>";

}
?>
</select>

<?=getMessage("month")?>
<select id="b_m_day_hotel_finish" class="b_m" onchange="f_nochev_fly()">

<?
//$ar_month=array("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");
for($i=3;$i<5;$i++){
//$to=getMessage($ar_month[$i]);
$to=getMessage("month".($i+1));
echo "<option value='".($i+1)."'";
echo ">".$to."</option>";
}
?>
</select>

<?=getMessage("year")?>
<select id="b_y_day_hotel_finish" class="b_y" onchange="f_nochev_fly()">

<?
for($i=2015;$i<=2015;$i++){
echo "<option value='".$i."'>".$i."</option>";
}
?>
</select>
<!--<div class="but_vida" onclick="f_vida()">выбрать</div>-->
</div>
	</div>
<?if(fGetComments("day_hotel_finish")):?><div class="qm"><div class="qm_text"><?=getMessage("day_hotel_finish_comment")?></div></div><?endif?>
</div>
<?endif?>
<div class="nich"></div>
<div class="not_f"><img src="/images/registration_event/info_24.png"><div class="luch"></div>
<input type="hidden" id="date_v_1" value="<?=$date_v_1?>"> 
<input type="hidden" id="date_v_2" value="<?=$date_v_2?>">
<?=getMessage("DATE1")?>
<div class="date_v" onclick="date_v(1)">&#9658; <?=getMessage("DATE1_1")?>  >>> <span id="date_v_1"><?=getMessage("DATE_V")?></span></div>

<?//=getMessage("DATE1_3")?>
<div class="date_v" onclick="date_v(2)">&#9658; <?=getMessage("DATE1_2")?>  >>> <span id="date_v_2"><?=getMessage("DATE_V")?></span></div>

<b><?=getMessage("DATE2")?></b>
</div>



  <!--  Отель   -->
<?if(fGetActive("hotel")):?>
<div class="ti_blo" id="ti_blo_hotel">


<div class="ti_dig">

<div class="tiqa"> <?=getMessage("hotel")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="hotel_0" onclick="upr_nomer(0)"><input name="<?=fGetName("hotel")?>" value="<?=fGetValue("hotel",0)?>" class="" id="hotel0" type="radio"  onchange="sub_but()" ><label for="hotel0"> <b><?=getMessage("hotel_0")?></b></label>
	<?if (file_exists($img_hotel_0)) {?>
	<a href='<?=$img_hotel_0;?>' class='gallery' ><img align="top" title="<?=fGetAnswer("hotel", 0);?>" src='/images/registration_event/photo_ico.png' alt='photo'/></a>
	<?}?>
	</div>

	<div class="not_f" style="display:none;"><img src="/images/registration_event/info_24.png"><div class="luch"></div>
	<?=getMessage("NOT_HOTEL_1_1")?>
	<?=getMessage("NOT_HOTEL_1_2")?> 
	<span><?=$ar_onor[0]?></span>
	<?=getMessage("NOT_HOTEL_1_3")?> 
	</div>

	<div class="ti_dis" id="hotel_1" onclick="upr_nomer(1)"><input name="<?=fGetName("hotel")?>" value="<?=fGetValue("hotel",1)?>" class="" id="hotel1" type="radio"  onchange="sub_but()" ><label for="hotel1"> <b><?=getMessage("hotel_1")?></b></label> 
	<?if (file_exists($img_hotel_1)) {?>
	<a href='<?=$img_hotel_1;?>' class='gallery' ><img align="top" title="<?=fGetAnswer("hotel", 1);?>" src='/images/registration_event/photo_ico.png' alt='photo'/></a>
	<?}?>
	</div>
<div class="not_f" style="display:none;"><img src="/images/registration_event/info_24.png"><div class="luch"></div>
	<?=getMessage("NOT_HOTEL_1_1_1")?> 
	<?//=($ar_knora[0]-$ar_bron[0])?>
	<?=getMessage("NOT_HOTEL_1_2_1")?> 
	<span><?=$ar_onor[1]?></span>
	<?=getMessage("NOT_HOTEL_1_3_1")?> 
	</div>

	

<!--
	<div class="ti_dis" id="hotel_3" onclick="upr_nomer(3)"><input name="<?=fGetName("hotel")?>" value="<?=fGetValue("hotel",3)?>" class="" id="hotel3" type="radio"  onchange="sub_but()" ><label for="hotel3"> <?=fGetAnswer("hotel", 3);?></label></div>
<div class="not_f"><img src="/images/registration_event/info_24.png"><div class="luch"></div>
<?=getMessage("NOT_HOTEL_3")?> 
</div>
-->
</div>

</div>
<?if(fGetComments("hotel")):?><div class="qm"><div class="qm_text"><?=getMessage("hotel_comment")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Номер   -->
<?if(fGetActive("nomer")):?>
<div class="ti_blo" id="ti_blo_nomer" onmouseout="sub_but()">


<div class="ti_dig">

<div class="tiqa"> <?=getMessage("nomer")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="nomer_0"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",0)?>" class="" id="nomer0" type="radio" onchange="sub_but()" ><label for="nomer0"> <?=getMessage("nomer_0");?></label></div>

	<div class="ti_dis" id="nomer_1"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",1)?>" class="" id="nomer1" type="radio" onchange="sub_but()" ><label for="nomer1"> <?=getMessage("nomer_1");?></label></div>
	
	<div class="ti_dis" id="nomer_2"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",2)?>" class="" id="nomer2" type="radio" onchange="sub_but()" ><label for="nomer2"> <?=getMessage("nomer_2");?></label></div>

	<div class="ti_dis" id="nomer_3" style="display:none;"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",3)?>" class="" id="nomer3" type="radio" onchange="sub_but()" ><label for="nomer3"> <?=getMessage("nomer_3");?></label></div>
	
	<div class="ti_dis" id="nomer_4" style="display:none;"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",4)?>" class="" id="nomer4" type="radio" onchange="sub_but()" ><label for="nomer4"> <?=getMessage("nomer_4");?></label></div>

	<div class="ti_dis" id="nomer_5" style="display:none;"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",5)?>" class="" id="nomer5" type="radio" onchange="sub_but()" ><label for="nomer5"> <?=getMessage("nomer_5");?></label></div>
	
	<div class="ti_dis" id="nomer_6"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",6)?>" class="" id="nomer6" type="radio" onchange="sub_but()" ><label for="nomer6"> <?=getMessage("nomer_6");?></label></div>
	
	<div class="ti_dis" id="nomer_7"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",7)?>" class="" id="nomer7" type="radio" onchange="sub_but()" ><label for="nomer7"> <?=getMessage("nomer_7");?></label></div>
	
	<div class="ti_dis" id="nomer_8"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",8)?>" class="" id="nomer8" type="radio" onchange="sub_but()" ><label for="nomer8"> <?=getMessage("nomer_8");?></label></div>

	<div class="ti_dis" id="nomer_9"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",9)?>" class="" id="nomer9" type="radio" onchange="sub_but()" ><label for="nomer9"> <?=getMessage("nomer_9");?></label></div>
	
	<div class="ti_dis" id="nomer_10" style="display:none;"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",10)?>" class="" id="nomer10" type="radio" onchange="sub_but()" ><label for="nomer10"> <?=getMessage("nomer_10");?></label></div>
	
	<div class="ti_dis" id="nomer_11"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",11)?>" class="" id="nomer11" type="radio" onchange="sub_but()" ><label for="nomer11"> <?=getMessage("nomer_11");?></label></div>
	
	<div class="ti_dis" id="nomer_12" style="display:none;"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",12)?>" class="" id="nomer12" type="radio" onchange="sub_but()" ><label for="nomer12"> <?=getMessage("nomer_12");?></label></div>

	<div class="ti_dis" id="nomer_13" style="display:none;"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",13)?>" class="" id="nomer13" type="radio" onchange="sub_but()" ><label for="nomer13"> <?=getMessage("nomer_13");?></label></div>
	
	<div class="ti_dis" id="nomer_14" style="display:none;"><input name="<?=fGetName("nomer")?>" value="<?=fGetValue("nomer",14)?>" class="" id="nomer14" type="radio" onchange="sub_but()" ><label for="nomer14"> <?=getMessage("nomer_14");?></label></div>
	
	

</div>

</div>
<?if(fGetComments("nomer")):?><div class="qm"><div class="qm_text"><?=getMessage("nomer_comment")?></div></div><?endif?>
</div>
<?endif?>

</div>
<div id="hotel_to_2">

		<!-- Проживание на Leader Ship  -->
		<div id="leader_ship_to">

		<!--  Дата начала проживания на Leader Ship  -->
		<?if(fGetActive("day_hotel_start_ls")):?>
		<div class="ti_blo" id="ti_blo_day_hotel_start_ls">
			 <div class="ti_dig"><div class="tiqa"><?=getMessage("day_hotel_start_ls")?><span class="zred"> *</span></div>
			 <input id="date_day_hotel_start_ls" name="<?=fGetName("day_hotel_start_ls")?>" value="<?=fGetValue("day_hotel_start_ls")?>" style="display:none;" type="text" readonly>
				 <div class="vida" id="vida"> 
		<?=getMessage("number")?>
		<select id="b_d_day_hotel_start_ls" class="b_d" onchange="f_nochev_fly_ls()">
		<option value=''>---</option>
		<?
		for($i=1;$i<=31;$i++){
		if($i==4) $vco="color:red;";
		else $vco="";
		echo "<option value='".$i."' style='".$vco."'>".$i."</option>";
		}
		?>
		</select>

		<?=getMessage("month")?>
		<select id="b_m_day_hotel_start_ls" class="b_m" onchange="f_nochev_fly_ls()">

		<?
		//$ar_month=array("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");
		for($i=8;$i<9;$i++){
		//$to=getMessage($ar_month[$i]);
		$to=getMessage("month".($i+1));
		echo "<option value='".($i+1)."'";
		echo ">".$to."</option>";
		}
		?>
		</select>

		<?=getMessage("year")?>
		<select id="b_y_day_hotel_start_ls" class="b_y" onchange="f_nochev_fly_ls()">

		<?
		for($i=2014;$i<=2024;$i++){
		echo "<option value='".$i."'>".$i."</option>";
		}
		?>
		</select>
		<!--<div class="but_vida" onclick="f_vida()">выбрать</div>-->
		</div>
			 </div>
		<?if(fGetComments("day_hotel_start_ls")):?><div class="qm"><div class="qm_text"><?=getMessage("day_hotel_start_comment_ls")?></div></div><?endif?>
		</div>
		<?endif?>

		<!--<div class="not_f"><img src="/images/registration_event/info_24.png"><div class="luch"></div><?=getMessage("DATE1")?></div>-->

		<!--  	Дата окончания проживания на Leader Ship  -->
		<?if(fGetActive("day_hotel_finish_ls")):?>
		<div class="ti_blo" id="ti_blo_day_hotel_finish_ls">
			 <div class="ti_dig"><div class="tiqa"><?=getMessage("day_hotel_finish_ls")?><span class="zred"> *</span></div>
			  <input id="date_day_hotel_finish_ls" name="<?=fGetName("day_hotel_finish_ls")?>" value="<?=fGetValue("day_hotel_finish_ls")?>" style="display:none;" type="text" readonly>
					 <div class="vida" id="vida"> 
		<?=getMessage("number")?>
		<select id="b_d_day_hotel_finish_ls" class="b_d" onchange="f_nochev_fly_ls()">
		<option value=''>---</option>
		<?
		for($i=1;$i<=31;$i++){
		if($i==7) $vco="color:red;";
		else $vco="";
		echo "<option value='".$i."' style='".$vco."'>".$i."</option>";

		}
		?>
		</select>

		<?=getMessage("month")?>
		<select id="b_m_day_hotel_finish_ls" class="b_m" onchange="f_nochev_fly_ls()">

		<?
		//$ar_month=array("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");
		for($i=8;$i<9;$i++){
		//$to=getMessage($ar_month[$i]);
		$to=getMessage("month".($i+1));
		echo "<option value='".($i+1)."'";
		echo ">".$to."</option>";
		}
		?>
		</select>

		<?=getMessage("year")?>
		<select id="b_y_day_hotel_finish_ls" class="b_y" onchange="f_nochev_fly_ls()">

		<?
		for($i=2014;$i<=2014;$i++){
		echo "<option value='".$i."'>".$i."</option>";
		}
		?>
		</select>
		<!--<div class="but_vida" onclick="f_vida()">выбрать</div>-->
		</div>
			</div>
		<?if(fGetComments("day_hotel_finish_ls")):?><div class="qm"><div class="qm_text"><?=getMessage("day_hotel_finish_comment_ls")?></div></div><?endif?>
		</div>
		<?endif?>

		<div class="not_f"><img src="/images/registration_event/info_24.png"><div class="luch"></div>
		<input type="hidden" id="date_v_1" value="<?=$date_v_1?>"> 
		<input type="hidden" id="date_v_2" value="<?=$date_v_2?>">
		<!--
		<?=getMessage("DATE1")?>
		<div class="date_v" onclick="date_v_2(1)">&#9658; <?=getMessage("DATE1_1")?>  >>> <span id="date_v_1"><?=getMessage("DATE_V")?></span></div>
		-->
		<?=getMessage("DATE1_3")?>
		<div class="date_v" onclick="date_v_2(2)">&#9658; <?=getMessage("DATE1_2")?>  >>> <span id="date_v_2"><?=getMessage("DATE_V")?></span></div>
		
		<b><?=getMessage("DATE2")?></b>
		</div>

		  <!--  Отель на Leader Ship   -->
		<?if(fGetActive("hotel_ls")):?>
		<div class="ti_blo" id="ti_blo_hotel_ls">


		<div class="ti_dig">

		<div class="tiqa"> <?=getMessage("hotel_ls")?><span class="zred"> *</span></div>

		<div class="vsta">

			<div class="ti_dis" id="hotel_ls_0" onclick="upr_nomer_ls(0)"><input name="<?=fGetName("hotel_ls")?>" value="<?=fGetValue("hotel_ls",0)?>" class="" id="hotel_ls0" type="radio"><label for="hotel_ls0"> <?=fGetAnswer("hotel_ls", 0);?></label></div>
			<div class="not_f"><img src="/images/registration_event/info_24.png"><div class="luch"></div>
	<?=getMessage("NOT_HOTEL_2_1")?> 
	<?=($ar_knora_ls[0]-$ar_bron_ls[0])?>
	<?=getMessage("NOT_HOTEL_2_2")?> 
	<?=$ar_onor_ls[0]?>
	<?=getMessage("NOT_HOTEL_2_3")?> 
	</div>
			<div class="ti_dis" id="hotel_ls_1" onclick="upr_nomer_ls(1)"><input name="<?=fGetName("hotel_ls")?>" value="<?=fGetValue("hotel_ls",1)?>" class="" id="hotel_ls1" type="radio"><label for="hotel_ls1"> <?=fGetAnswer("hotel_ls", 1);?></label></div>
		<div class="not_f"><img src="/images/registration_event/info_24.png"><div class="luch"></div>
	<?=getMessage("NOT_HOTEL_2_1")?> 
	<?=($ar_knora_ls[1]-$ar_bron_ls[1])?>
	<?=getMessage("NOT_HOTEL_2_2")?> 
	<?=$ar_onor_ls[1]?>
	<?=getMessage("NOT_HOTEL_2_3")?> 
	</div>
	
			<div class="ti_dis" id="hotel_ls_2" onclick="upr_nomer_ls(2)"><input name="<?=fGetName("hotel_ls")?>" value="<?=fGetValue("hotel_ls",2)?>" class="" id="hotel_ls2" type="radio"><label for="hotel_ls2"> <?=fGetAnswer("hotel_ls", 2);?></label></div>
		
		<div class="not_f"><img src="/images/registration_event/info_24.png"><div class="luch"></div>
	<?=getMessage("NOT_HOTEL_2_1")?> 
	<?=($ar_knora_ls[2]-$ar_bron_ls[2])?>
	<?=getMessage("NOT_HOTEL_2_2")?> 
	<?=$ar_onor_ls[2]?>
	<?=getMessage("NOT_HOTEL_2_3")?> 
	</div>
		</div>

		</div>
		<?if(fGetComments("hotel_ls")):?><div class="qm"><div class="qm_text"><?=getMessage("hotel_ls_comment")?></div></div><?endif?>
		</div>
		<?endif?>

		  <!--  Номер  на Leader Ship  -->
		<?if(fGetActive("nomer_ls")):?>
		<div class="ti_blo" id="ti_blo_nomer_ls" onmouseout="sub_but()">


		<div class="ti_dig">

		<div class="tiqa"> <?=getMessage("nomer_ls")?><span class="zred"> *</span></div>

		<div class="vsta">

			<div class="ti_dis" id="nomer_ls_0"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",0)?>" class="" id="nomer_ls0" type="radio"><label for="nomer_ls0"> <?=getMessage("nomer_0");?></label></div>

			<div class="ti_dis" id="nomer_ls_1"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",1)?>" class="" id="nomer_ls1" type="radio"><label for="nomer_ls1"> <?=getMessage("nomer_1");?></label></div>
			
			<div class="ti_dis" id="nomer_ls_2"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",2)?>" class="" id="nomer_ls2" type="radio"><label for="nomer_ls2"> <?=getMessage("nomer_2");?></label></div>

			<div class="ti_dis" id="nomer_ls_3"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",3)?>" class="" id="nomer_ls3" type="radio"><label for="nomer_ls3"> <?=getMessage("nomer_3");?></label></div>
			
			<div class="ti_dis" id="nomer_ls_4"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",4)?>" class="" id="nomer_ls4" type="radio"><label for="nomer_ls4"> <?=getMessage("nomer_4");?></label></div>

			<div class="ti_dis" id="nomer_ls_5"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",5)?>" class="" id="nomer_ls5" type="radio"><label for="nomer_ls5"> <?=getMessage("nomer_5");?></label></div>
			
			<div class="ti_dis" id="nomer_ls_6"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",6)?>" class="" id="nomer_ls6" type="radio"><label for="nomer_ls6"> <?=getMessage("nomer_6");?></label></div>
			
			<div class="ti_dis" id="nomer_ls_7"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",7)?>" class="" id="nomer_ls7" type="radio"><label for="nomer_ls7"> <?=getMessage("nomer_7");?></label></div>
			
			<div class="ti_dis" id="nomer_ls_8"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",8)?>" class="" id="nomer_ls8" type="radio"><label for="nomer_ls8"> <?=getMessage("nomer_8");?></label></div>

			<div class="ti_dis" id="nomer_ls_9"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",9)?>" class="" id="nomer_ls9" type="radio"><label for="nomer_ls9"> <?=getMessage("nomer_9");?></label></div>
			
			<div class="ti_dis" id="nomer_ls_10"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",10)?>" class="" id="nomer_ls10" type="radio"><label for="nomer_ls10"> <?=getMessage("nomer_10");?></label></div>
			
			<div class="ti_dis" id="nomer_ls_11"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",11)?>" class="" id="nomer_ls11" type="radio"><label for="nomer_ls11"> <?=getMessage("nomer_11");?></label></div>
			
			<div class="ti_dis" id="nomer_ls_12"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",12)?>" class="" id="nomer_ls12" type="radio"><label for="nomer_ls12"> <?=getMessage("nomer_12");?></label></div>

			<div class="ti_dis" id="nomer_ls_13"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",13)?>" class="" id="nomer_ls13" type="radio"><label for="nomer_ls13"> <?=getMessage("nomer_13");?></label></div>
			
			<div class="ti_dis" id="nomer_ls_14"><input name="<?=fGetName("nomer_ls")?>" value="<?=fGetValue("nomer_ls",14)?>" class="" id="nomer_ls14" type="radio"><label for="nomer_ls14"> <?=getMessage("nomer_14");?></label></div>
			
			

		</div>

		</div>
		<?if(fGetComments("nomer_ls")):?><div class="qm"><div class="qm_text"><?=getMessage("nomer_ls_comment")?></div></div><?endif?>
		</div>
		<?endif?>


		</div>
		<!-- -->
</div>

  <!--  Медицинская страховка  -->
<?if(fGetActive("medical_insurance")):?>
<div class="ti_blo" id="ti_blo_medical_insurance">

<div class="ti_dig">

<div class="tiqa"> <?=getMessage("medical_insurance")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="medical_insurance_0"><input name="<?=fGetName("medical_insurance")?>" value="<?=fGetValue("medical_insurance",0)?>" class="" id="medical_insurance0" type="radio" checked><label for="medical_insurance0"> <?=getMessage("medical_insurance_0");?></label></div>
<!--
	<div class="ti_dis" id="medical_insurance_1"><input name="<?=fGetName("medical_insurance")?>" value="<?=fGetValue("medical_insurance",1)?>" class="" id="medical_insurance1" type="radio"><label for="medical_insurance1"> <?=getMessage("medical_insurance_1");?></label></div>
-->
</div>

</div>
<?if(fGetComments("medical_insurance")):?><div class="qm"><div class="qm_text"><?=getMessage("medical_insurance_comment")?></div></div><?endif?>
</div>
<?endif?>

  
  


<div id="hotel_not" style="display:none;">

  <!--  Гостевая карта  -->
  
<?if(fGetActive("guest_card")):?>
<div class="ti_blo" id="ti_blo_guest_card">

<div class="ti_dig">

<div class="tiqa"> <?=getMessage("guest_card")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="guest_card_0"><input name="<?=fGetName("guest_card")?>" value="<?=fGetValue("guest_card",0)?>" class="" id="guest_card0" type="radio"><label for="guest_card0"> <?=getMessage("guest_card_0");?></label></div>

	<div class="ti_dis" id="guest_card_1"><input name="<?=fGetName("guest_card")?>" value="<?=fGetValue("guest_card",1)?>" class="" id="guest_card1" type="radio"><label for="guest_card1"> <?=getMessage("guest_card_1");?></label></div>

</div>

</div>
<?if(fGetComments("guest_card")):?><div class="qm"><div class="qm_text"><?=getMessage("guest_card_comment")?></div></div><?endif?>
</div>
<?endif?>

</div>
  <!--  Вариант перелета  -->
<?if(fGetActive("p_fly")):?>
<div class="ti_blo" id="ti_blo_p_fly">

<div class="ti_dig">

<div class="tiqa"> <?=getMessage("p_fly")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="p_fly_0"><input name="<?=fGetName("p_fly")?>" value="<?=fGetValue("p_fly",0)?>" class="" id="p_fly0" type="radio" ><label for="p_fly0"> <?=getMessage("p_fly_0");?></label></div>

	<div class="ti_dis" id="p_fly_1"><input name="<?=fGetName("p_fly")?>" value="<?=fGetValue("p_fly",1)?>" class="" id="p_fly1" type="radio"><label for="p_fly1"> <?=getMessage("p_fly_1");?></label></div>

</div>

</div>
<?if(fGetComments("p_fly")):?><div class="qm"><div class="qm_text"><?=getMessage("p_fly_comment")?></div></div><?endif?>
</div>
<?endif?>



<div class="not_f"><img src="/images/registration_event/info_24.png"><div class="luch"></div>
	<?//=getMessage("NOTE_FLY_0_1")?> <br />
<?=getMessage("NOTE_FLY_0_2")?> <br /><br />
<?=getMessage("NOTE_FLY_0_3")?> <br /><br />
<span style="color:red;">
<?=getMessage("NOTE_FLY_0_4")?> 
</span>
</div>

<div id="fly_to" style="display:none;">

  <!--  Перелет туда  -->
<?if(fGetActive("fly_1")):?>
<div class="ti_blo" id="ti_blo_fly_1">


<div class="ti_dig">

<div class="tiqa"> <?=getMessage("fly_1")?><span class="zred"> *</span><div class="snav" onclick="p_pes('fly_1','fly_2')">&#215;&nbsp; <?=getMessage('BOX_REMOVE_ALL')?></div></div>

<div class="vsta">

<!--
	<div class="ti_dis" id="fly_1_0"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",0)?>" class="" id="fly_10" type="radio" onclick="p_pe('fly_1','fly_2',0)" readonly><label for="fly_10"> <?=getMessage("fly_1_0");?></label></div>
-->

	<div id="fly_1_date_1">
		<div class="ti_dis" id="fly_1_1"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",1)?>" class="" id="fly_11" type="radio" onclick="p_pe('fly_1','fly_2',1)"><label for="fly_11"> <?=getMessage("fly_1_1");?></label><div class="ostok">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>

		<div class="ti_dis" id="fly_1_2"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",2)?>" class="" id="fly_12" type="radio" onclick="p_pe('fly_1','fly_2',2)"><label for="fly_12"> <?=getMessage("fly_1_2");?></label><div class="ostok">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>

		
			
		<div class="ti_dis" id="fly_1_4"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",4)?>" class="" id="fly_14" type="radio" onclick="p_pe('fly_1','fly_2',4)" style="display:none;"><label for="fly_14" style="display:none;"> <?=getMessage("fly_1_4");?></label><div class="ostok" style="display:none;">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>

		<div class="ti_dis" id="fly_1_5"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",5)?>" class="" id="fly_15" type="radio" onclick="p_pe('fly_1','fly_2',5)"><label for="fly_15"> <?=getMessage("fly_1_5");?></label><div class="ostok">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>
		<div class="ti_dis" id="fly_1_3"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",3)?>" class="" id="fly_13" type="radio" onclick="p_pe('fly_1','fly_2',3)"><label for="fly_13"> <?=getMessage("fly_1_3");?></label><div class="ostok">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>
		<div class="ti_dis" id="fly_1_6" style=""><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",6)?>" class="" id="fly_16" type="radio" onclick="p_pe('fly_1','fly_2',6)"><label for="fly_16"> <?=getMessage("fly_1_6");?></label><div class="ostok">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>

		<div class="ti_dis" id="fly_1_7" style=""><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",7)?>" class="" id="fly_17" type="radio" onclick="p_pe('fly_1','fly_2',7)"><label for="fly_17"> <?=getMessage("fly_1_7");?></label><div class="ostok">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>
		
		<div class="ti_dis" id="fly_1_8" style=""><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",8)?>" class="" id="fly_18" type="radio" onclick="p_pe('fly_1','fly_2',8)"><label for="fly_18"> <?=getMessage("fly_1_8");?></label><div class="ostok">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>
	</div>
	<div id="fly_1_date_2">
		<div class="ti_dis" id="fly_1_9"><input name="<?=fGetName("fly_1")?>" value="<?=fGetValue("fly_1",9)?>" class="" id="fly_19" type="radio" onclick="p_pe('fly_1','fly_2',9)"><label for="fly_19"> <?=getMessage("fly_1_9");?></label><div class="ostok">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>
	</div>
</div>

</div>
<?if(fGetComments("fly_1")):?><div class="qm"><div class="qm_text"><?=getMessage("fly_1_comment")?></div></div><?endif?>
</div>
<?endif?>

<!--<div class="not_f"><img src="/images/registration_event/info_24.png"><div class="luch"></div><?=getMessage("NOT_f1")?></div>-->

 <!--  Перелет обратно  -->
<?if(fGetActive("fly_2")):?>
<div class="ti_blo" id="ti_blo_fly_2">


<div class="ti_dig">

<div class="tiqa"> <?=getMessage("fly_2")?><span class="zred"> *</span><div class="snav" onclick="p_pes('fly_2','fly_1')">&#215;&nbsp; <?=getMessage('BOX_REMOVE_ALL')?></div></div>

<div class="vsta">

<!--
	<div class="ti_dis" id="fly_2_0"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",0)?>" class="" id="fly_20" type="radio" onchange="sub_but()" onclick="p_pe('fly_2','fly_1',0)"><label for="fly_20"> <?=getMessage("fly_2_0");?></label></div>
	-->

	<div id="fly_2_date_1">
		<div class="ti_dis" id="fly_2_1"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",1)?>" class="" id="fly_21" type="radio" onclick="p_pe('fly_2','fly_1',1)"><label for="fly_21"> <?=getMessage("fly_2_1");?></label><div class="ostok">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>

		<div class="ti_dis" id="fly_2_2"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",2)?>" class="" id="fly_22" type="radio" onclick="p_pe('fly_2','fly_1',2)"><label for="fly_22"> <?=getMessage("fly_2_2");?></label><div class="ostok">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>

		
				
		<div class="ti_dis" id="fly_2_4"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",4)?>" class="" id="fly_24" type="radio" onclick="p_pe('fly_2','fly_1',4)" style="display:none;"><label for="fly_24" style="display:none;"> <?=getMessage("fly_2_4");?></label><div class="ostok" style="display:none;">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>

		<div class="ti_dis" id="fly_2_5"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",5)?>" class="" id="fly_25" type="radio" onclick="p_pe('fly_2','fly_1',5)"><label for="fly_25"> <?=getMessage("fly_2_5");?></label><div class="ostok">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>
		<div class="ti_dis" id="fly_2_3"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",3)?>" class="" id="fly_23" type="radio" onclick="p_pe('fly_2','fly_1',3)"><label for="fly_23"> <?=getMessage("fly_2_3");?></label><div class="ostok">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>	
		<div class="ti_dis" id="fly_2_6" style="d"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",6)?>" class="" id="fly_26" type="radio" onclick="p_pe('fly_2','fly_1',6)"><label for="fly_26"> <?=getMessage("fly_2_6");?></label><div class="ostok">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>

		<div class="ti_dis" id="fly_2_7" style=""><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",7)?>" class="" id="fly_27" type="radio" onclick="p_pe('fly_2','fly_1',7)"><label for="fly_27"> <?=getMessage("fly_2_7");?></label><div class="ostok">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span></span></div></div>
		
		<div class="ti_dis" id="fly_2_8" style=""><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",8)?>" class="" id="fly_28" type="radio" onclick="p_pe('fly_2','fly_1',8)"><label for="fly_28"> <?=getMessage("fly_2_8");?></label><div class="ostok">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>
	</div>	
	<div id="fly_2_date_2">
		<div class="ti_dis" id="fly_2_9"><input name="<?=fGetName("fly_2")?>" value="<?=fGetValue("fly_2",9)?>" class="" id="fly_29" type="radio" onclick="p_pe('fly_2','fly_1',9)"><label for="fly_29"> <?=getMessage("fly_2_9");?></label><div class="ostok">&#9992; <span><?=getMessage("OSTOK_FLY");?></span><span><?=getMessage("net_mest");?></span></div></div>
	</div>
</div>

</div>
<?if(fGetComments("fly_2")):?><div class="qm"><div class="qm_text"><?=getMessage("fly_2_comment")?></div></div><?endif?>
</div>
<?endif?>

<!--<div class="not_f"><img src="/images/registration_event/info_24.png"><div class="luch"></div><?=getMessage("NOT_f2")?></div>-->

</div>



  <!--  Транcфер  -->
<?if(fGetActive("p_transfer")):?>
<div class="ti_blo" id="ti_blo_p_transfer">

<div class="ti_dig">

<div class="tiqa"> <?=getMessage("p_transfer")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="p_transfer_0"><input name="<?=fGetName("p_transfer")?>" value="<?=fGetValue("p_transfer",0)?>" class="" id="p_transfer0" type="radio" readonly><label for="p_transfer0"> <?=getMessage("p_transfer_0");?></label></div>

	<div class="ti_dis" id="p_transfer_1"><input name="<?=fGetName("p_transfer")?>" value="<?=fGetValue("p_transfer",1)?>" class="" id="p_transfer1" type="radio" readonly><label for="p_transfer1"> <?=getMessage("p_transfer_1");?></label></div>

</div>

</div>
<?if(fGetComments("p_transfer")):?><div class="qm"><div class="qm_text"><?=getMessage("p_transfer_comment")?></div></div><?endif?>
</div>
<?endif?>


  <!--  Участие в форуме  -->
<?if(fGetActive("d_konf")):?>
<div class="ti_blo" id="ti_blo_d_konf">

<div class="ti_dig">

<div class="tiqa"> <?=getMessage("d_konf")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="d_konf_0"><input name="<?=fGetName("d_konf")?>" value="<?=fGetValue("d_konf",0)?>" class="" id="d_konf0" type="radio" checked><label for="d_konf0"> <?=getMessage("d_konf_0");?></label></div>

	<div class="ti_dis" id="d_konf_1"><input name="<?=fGetName("d_konf")?>" value="<?=fGetValue("d_konf",1)?>" class="" id="d_konf1" type="radio"><label for="d_konf1"> <?=getMessage("d_konf_1");?></label></div>

</div>

</div>
<?if(fGetComments("d_konf")):?><div class="qm"><div class="qm_text"><?=getMessage("d_konf_comment")?></div></div><?endif?>
</div>
<?endif?>


 <!--  Участие в гала ужине  -->
 
<?if(fGetActive("d_ujin")):?>
<div class="ti_blo" id="ti_blo_d_ujin">

<div class="ti_dig">

<div class="tiqa"> <?=getMessage("d_ujin")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="d_ujin_0"><input name="<?=fGetName("d_ujin")?>" value="<?=fGetValue("d_ujin",0)?>" class="" id="d_ujin0" type="radio"><label for="d_ujin0"> <?=getMessage("d_ujin_0");?></label></div>

	<div class="ti_dis" id="d_ujin_1"><input name="<?=fGetName("d_ujin")?>" value="<?=fGetValue("d_ujin",1)?>" class="" id="d_ujin1" type="radio"><label for="d_ujin1"> <?=getMessage("d_ujin_1");?></label></div>

</div>

</div>
<?if(fGetComments("d_ujin")):?><div class="qm"><div class="qm_text"><?=getMessage("d_ujin_comment")?></div></div><?endif?>
</div>
<?endif?>


  <!--  Питание на форуме   -->
  <!--
<?if(fGetActive("d_eat_2")):?>
<div class="ti_blo" id="ti_blo_d_eat_2">


<div class="ti_dig">

<div class="tiqa"> <?=getMessage("d_eat_2")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="d_eat_2_0"><input name="<?=fGetName("d_eat_2")?>" value="<?=fGetValue("d_eat_2",0)?>" class="" id="d_eat_20" type="radio"><label for="d_eat_20"> <?=fGetAnswer("d_eat_2_0");?></label></div>

	<div class="ti_dis" id="d_eat_2_1"><input name="<?=fGetName("d_eat_2")?>" value="<?=fGetValue("d_eat_2",1)?>" class="" id="d_eat_21" type="radio"><label for="d_eat_21"> <?=fGetAnswer("d_eat_2_1");?></label></div>
	
	<div class="ti_dis" id="d_eat_2_2"><input name="<?=fGetName("d_eat_2")?>" value="<?=fGetValue("d_eat_2",2)?>" class="" id="d_eat_22" type="radio"><label for="d_eat_22"> <?=fGetAnswer("d_eat_2_2");?></label></div>

	<div class="ti_dis" id="d_eat_2_3"><input name="<?=fGetName("d_eat_2")?>" value="<?=fGetValue("d_eat_2",3)?>" class="" id="d_eat_23" type="radio"><label for="d_eat_23"> <?=fGetAnswer("d_eat_2_3");?></label></div>
	
	<div class="ti_dis" onclick="f_nochev('d_eat_2')"><span class="nochev">&#215;&nbsp; <?=getMessage('BOX_REMOVE_ALL')?></span></div>
</div>

</div>
<?if(fGetComments("d_eat_2")):?><div class="qm"><div class="qm_text"><?=getMessage("d_eat_2_comment")?></div></div><?endif?>
</div>
<?endif?>
 -->
 
 <!-- Питание в гостинице -->
 <!--
<?if(fGetActive("d_eat_1")):?>
<div class="ti_blo" id="ti_blo_d_eat_1">


<div class="ti_dig">

<div class="tiqa"> <?=getMessage("d_eat_1")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="d_eat_1_0"><input name="<?=fGetName("d_eat_1")?>" value="<?=fGetValue("d_eat_1",0)?>" class="" id="d_eat_10" type="radio"><label for="d_eat_10"> <?=getMessage("d_eat_1_0")?></label></div>

	<div class="ti_dis" id="d_eat_1_1"><input name="<?=fGetName("d_eat_1")?>" value="<?=fGetValue("d_eat_1",1)?>" class="" id="d_eat_11" type="radio"><label for="d_eat_11"> <?=getMessage("d_eat_1_1");?></label></div>

	<div class="ti_dis" id="d_eat_1_2"><input name="<?=fGetName("d_eat_1")?>" value="<?=fGetValue("d_eat_1",2)?>" class="" id="d_eat_12" type="radio"><label for="d_eat_12"> <?=fGetAnswer("d_eat_1_2");?></label></div>

	<div class="ti_dis" id="d_eat_1_3"><input name="<?=fGetName("d_eat_1")?>" value="<?=fGetValue("d_eat_1",3)?>" class="" id="d_eat_13" type="radio"><label for="d_eat_13"> <?=fGetAnswer("d_eat_1_3");?></label></div>
	
	<div class="ti_dis" onclick="f_nochev('d_eat_1')"><span class="nochev">&#215;&nbsp; <?=getMessage('BOX_REMOVE_ALL')?></span></div>

</div>

</div>
<?if(fGetComments("d_eat_1")):?><div class="qm"><div class="qm_text"><?=getMessage("d_eat_1_comment")?></div></div><?endif?>
</div>
<?endif?>
-->
  <!--  Размер футболки  -->
<?if(fGetActive("d_futbolka")):?>
<div class="ti_blo" id="ti_blo_d_futbolka">

<div class="ti_dig">

<div class="tiqa"> <?=getMessage("d_futbolka")?><span class="zred">*</span></div>

<div class="vsta">

	<div class="ti_dis" id="d_futbolka_0"><input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",0)?>" class="" id="d_futbolka0" type="radio" <?if(fGetAnswerCode("d_futbolka",0)==$_SESSION["passport_member"]["d_futbolka"]) echo "checked"?>><label for="d_futbolka0"> <?=getMessage("d_futbolka_0");?></label></div>

	<div class="ti_dis" id="d_futbolka_1"><input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",1)?>" class="" id="d_futbolka1" type="radio" <?if(fGetAnswerCode("d_futbolka",1)==$_SESSION["passport_member"]["d_futbolka"]) echo "checked"?>><label for="d_futbolka1"> <?=getMessage("d_futbolka_1");?></label></div>
	
	<div class="ti_dis" id="d_futbolka_2"><input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",2)?>" class="" id="d_futbolka2" type="radio" <?if(fGetAnswerCode("d_futbolka",2)==$_SESSION["passport_member"]["d_futbolka"]) echo "checked"?>><label for="d_futbolka2"> <?=getMessage("d_futbolka_2");?></label></div>

	<div class="ti_dis" id="d_futbolka_3"><input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",3)?>" class="" id="d_futbolka3" type="radio" <?if(fGetAnswerCode("d_futbolka",3)==$_SESSION["passport_member"]["d_futbolka"]) echo "checked"?>><label for="d_futbolka3"> <?=getMessage("d_futbolka_3");?></label></div>
	
	<div class="ti_dis" id="d_futbolka_4"><input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",4)?>" class="" id="d_futbolka4" type="radio" <?if(fGetAnswerCode("d_futbolka",4)==$_SESSION["passport_member"]["d_futbolka"]) echo "checked"?>><label for="d_futbolka4"> <?=getMessage("d_futbolka_4");?></label></div>
	
	<div class="ti_dis" id="d_futbolka_5"><input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",5)?>" class="" id="d_futbolka5" type="radio" <?if(fGetAnswerCode("d_futbolka",5)==$_SESSION["passport_member"]["d_futbolka"]) echo "checked"?>><label for="d_futbolka5"> <?=getMessage("d_futbolka_5");?></label></div>
	
	<div class="ti_dis" id="d_futbolka_6"><input name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",6)?>" class="" id="d_futbolka6" type="radio" <?if(fGetAnswerCode("d_futbolka",6)==$_SESSION["passport_member"]["d_futbolka"]) echo "checked"?>><label for="d_futbolka6"> <?=getMessage("d_futbolka_6");?></label></div>
	
</div>

</div>
<?if(fGetComments("d_futbolka")):?><div class="qm"><div class="qm_text"><?=getMessage("d_futbolka_comment")?></div></div><?endif?>
</div>
<?endif?>
 
 <div>

<!--  Синхронный перевод  -->
<?if(fGetActive("interpretation")):?>
<div class="ti_blo" id="ti_blo_interpretation">

<div class="ti_dig">

<div class="tiqa"> <?=getMessage("interpretation")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="interpretation_0"><input name="<?=fGetName("interpretation")?>" value="<?=fGetValue("interpretation",0)?>" class="" id="interpretation0" type="radio" <?if(fGetAnswerCode("interpretation",0)==$_SESSION["passport_member"]["interpretation"]) echo "checked"?>><label for="interpretation0"> <?=getMessage("interpretation_0");?></label></div>

	<div class="ti_dis" id="interpretation_1"><input name="<?=fGetName("interpretation")?>" value="<?=fGetValue("interpretation",1)?>" class="" id="interpretation1" type="radio" <?if(fGetAnswerCode("interpretation",1)==$_SESSION["passport_member"]["interpretation"]) echo "checked"?>><label for="interpretation1"> <?=getMessage("interpretation_1");?></label></div>


</div>


</div>
<?if(fGetComments("interpretation")):?><div class="qm"><div class="qm_text"><?=getMessage("interpretation_comment")?></div></div><?endif?>
</div>
<?endif?>

<!--  Выберите язык для синхронного перевода   -->
<?if(fGetActive("interpretation_lang")):?>

<div class="ti_blo" id="ti_blo_interpretation_lang" style="display:none;">

<div class="ti_dig"><div class="tiqa"><?=getMessage("interpretation_lang")?><span class="zred"> *</span></div>
<div class="vsta_s">

<select name="<?=fGetName("interpretation_lang",0)?>" id="sel_interpretation_lang" class='interpretation_lang-select'>
<option value="0">&nbsp;</option>
<?php

$coc=count($ar_interpretation_lang[LANGUAGE_ID]);

for($i=0;$i<$coc;$i++)
	{
	//if($i>0 && !($i%3)) echo "</div><div class='col_co'>";
	//echo "<div class='ticou'>".$ar_part_world[$i]."</div>";
	$v_ar_c=@explode(",",$ar_interpretation_lang[LANGUAGE_ID][$i]);
	asort($v_ar_c);
		foreach($v_ar_c as $val) {
		echo "<option value='".$val."'";
		if($_SESSION["passport_member"]["interpretation_lang"]==$val) echo " selected";
		echo ">".$val."</option>";
		}
	}
?>

</select>
</div>
</div>
<?if(fGetComments("interpretation_lang")):?><div class="qm"><div class="qm_text"><?=getMessage("interpretation_lang_comment")?></div></div><?endif?>
<script type="text/javascript"> 
//$(".interpretation_lang-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true});
 </script>

 </div>
<?endif?> 

<!--  Дополнительный язык для синхронного перевода   -->
<?if(fGetActive("second_interpretation_lang")):?>

<div class="ti_blo" id="ti_blo_second_interpretation_lang" style="display:none;">

<div class="ti_dig"><div class="tiqa"><?=getMessage("second_interpretation_lang")?></div>
<div class="vsta_s">

<select name="<?=fGetName("second_interpretation_lang",0)?>" id="sel_second_interpretation_lang" class='second_interpretation_lang-select' >
<option value="0">&nbsp;</option>
<?php

$coc=count($ar_second_lang[LANGUAGE_ID]);
for($i=0;$i<$coc;$i++)
	{
	//if($i>0 && !($i%3)) echo "</div><div class='col_co'>";
	//echo "<div class='ticou'>".$ar_part_world[$i]."</div>";
	$v_ar_c=@explode(",",$ar_second_lang[LANGUAGE_ID][$i]);
	asort($v_ar_c);
		foreach($v_ar_c as $val) {
		echo "<option value='".$val."'";
		if($_SESSION["passport_member"]["second_interpretation_lang"]==$val) echo " selected";
		echo ">".$val."</option>";
		}
	}
?>
</select>
</div>
</div>
<?if(fGetComments("second_interpretation_lang")):?><div class="qm"><div class="qm_text"><?=getMessage("second_interpretation_lang_comment")?></div></div><?endif?>

 </div>
<?endif?> 
</div>
  
</div>
</td></tr></table>

<? include "button_step.php"; // Кнопки перехода к следующему шагу ?>

 </form>
 </div>

<br/><br/><br/><br/><br/>

<script type="text/javascript"> 
	date_v(1); // выставляем рекомендуемые даты пребывания 
	//date_v_2(2); // выставляем рекомендуемые даты пребывания для участия в Leadership

</script>
<script type="text/javascript">
		$(document).ready(function() {
			$("a.gallery").fancybox();
		});
		</script>
