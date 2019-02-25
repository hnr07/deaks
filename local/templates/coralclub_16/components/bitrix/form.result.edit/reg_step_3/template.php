<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $t_step; // Шаг регистрации
global $USER;
?>
 <? include "var_config.php"; // Конфигурация мероприятия?>
 <? include "functions.php";  // Функции PHP?>

<? include "header_form.php"; // Шапка формы ?>

	<? include "venue/price_list_".fGetResultValues("id_venue").".php"; // Прайс-лист мероприятия ?>
	<? include "calculator.php"; // калькулятор ?>
	<? if ($USER->IsAuthorized()) include "../../com/registration_event/passport_member/view.php"?>
	
	<!--  Если предыдущий шаг не пройден возврат на начало  -->
<?if(fGetResultValues("step")<>($t_step-1)){?>
<meta http-equiv="Refresh" content="0; URL=<?="/".LANGUAGE_ID.$dir_event?>index.php">
<?}?>
<br />
<div class="stan">
	<?if (fGetResultValues("status")==fGetValue("status",0)):?>
<div class="tipetu"><span class="tpt"><?=GetMessage("status");?>:</span> <span class="npt"><?=GetMessage("status_0");?></span></div>
<div class="tipetu"><span class="tpt"><?=GetMessage("chk");?>:</span> <span class="npt"><?=fGetResultValues("chk")?> - <?=fGetResultValues("family")?> <?=fGetResultValues("name")?></span></div>
<?endif?>
<?if (fGetResultValues("status")==fGetValue("status",1)):?>
<div class="tipetu"><span class="tpt"><?=GetMessage("status");?>:</span> <span class="npt"><?=GetMessage("status_1");?></span></div>
<div class="tipetu"><span class="tpt"><?=GetMessage("chk");?>:</span> <span class="npt"><?=fGetResultValues("chk")?> - <?=fGetResultValues("family")?> <?=fGetResultValues("name")?></span></div>
<div class="tipetu"><span class="tpt"><?=GetMessage("kem_priglashen_chk");?>:</span> <span class="npt"><?=fGetResultValues("kem_priglashen_chk")?> - <?=fGetResultValues("kem_priglashen_family")?> <?=fGetResultValues("kem_priglashen_name")?></span></div>
<?endif?>
<?if (fGetResultValues("status")==fGetValue("status",2)):?>
<div class="tipetu"><span class="tpt"><?=GetMessage("status");?>:</span> <span class="npt"><?=GetMessage("status_2");?></span></div>
<div class="tipetu"><span class="tpt"><?=GetMessage("kem_priglashen_chk");?>:</span> <span class="npt"><?=fGetResultValues("kem_priglashen_chk")?> - <?=fGetResultValues("kem_priglashen_family")?> <?=fGetResultValues("kem_priglashen_name")?></span></div>
<?$spl_chk=fGetResultValues("kem_priglashen_chk"); $spl_family=fGetResultValues("kem_priglashen_family"); $spl_name=fGetResultValues("kem_priglashen_name");?>
<?endif?>
</div>
<div class="div_form" style="">
	<div id="tr"></div>
	<? 
	$ar_head_form=explode(" ",$arResult["FORM_HEADER"],2);
	$head_form=$ar_head_form[0]." id=\"form_submit_step_3\" onsubmit=\"res_pro('form_submit')\" ".$ar_head_form[1];
	echo $head_form;
	echo $arResult["FORM_HEADER"];
	?>
	<?=bitrix_sessid_post()?>
	
	<!-- Скрытые поля  -->
	<div class="nevid">
	<? include "field_form.php"; // Все поля формы?>

			<!-- Скрытые поля для перезаписи значений  -->
<!--  Шаг регистрации  -->
<input id="t_step" name="<?=fGetName("step",0)?>" value="<?=$t_step?>"  type="text">
		<!--  Курс заявки  -->
		<input  name="<?=fGetName("m_course",0)?>" value="<?=$kp?>"  type="text">
		<!--  Скидка %  -->
		<input  name="<?=fGetName("discount",0)?>" value="<?=$discount?>"  type="text">

		<!--  Наценка %  -->
		<input  name="<?=fGetName("markup",0)?>" value="<?=$markup?>"  type="text">

		<!--  Минус  -->
		<input  name="<?=fGetName("minus",0)?>" value="<?=$minus?>"  type="text">

		<!--  Плюс  -->
		<input  name="<?=fGetName("plus",0)?>" value="<?=$plus?>"  type="text">

		<!--  Стоимость мероприятия в у. е.  -->
		<input  name="<?=fGetName("money",0)?>" value="<?=$cena_e?>"  type="text">

		<!--  Стоимость в Вашей валюте  -->
		<input  name="<?=fGetName("money_2",0)?>" value="<?=$cena_n?>"  type="text">

		<!--  Сумма задолженности  -->
		<input  name="<?=fGetName("sum_debt",0)?>" value="<?=$cena_n?>"  type="text">

		<!--  Калькуляция стоимости мероприятия в у. е.  -->
		<textarea name="<?=fGetName("money_calc",0)?>"><?=$ctext;?></textarea>

		<!--  Калькуляция стоимости мероприятия в нац. валюте  -->
		<textarea name="<?=fGetName("money_2_calc",0)?>"><?=$ctext_n;?></textarea>
	</div>

	<div class="dib"><h4><?=GetMessage("block_1");?></h4>
	<table class="tab_c" border=0><tr valign="top">
	<td width="50%">
	<?
		$cts=str_replace("\n","<br/>",$ctext_n);
		?>
		<?if($choice_venue) {?><div class="ctext"><?=GetMessage("venue")?>: <?=fGetResultValues("venue")?></div><?}?>

		<div class="ctext">
		<?
		$ar_noc = array();
		if(in_array(fGetResultValues("id_venue"),$ar_noc)) {?>
			Стоимость участия в конференции уточняется и будет опубликована позже.
		<?} else {?>
		<?=$cts?>
		<?}?>
		</div>
	</td><td>
			<!--  ФИО соседа по номеру  -->
		<?if(fGetActive("hotel_frend")):?>

		<div class="ti_bar" id="ti_blo_hotel_frend" style="margin-top:0px;">
			 <div class="tiqa"><?=GetMessage("hotel_frend");?><span class="zred"> </span>
			 <?if(GetMessage("hotel_frend_comment")) {?>
				<div class="qm"></div>

			<?}?>
			 </div>
			<div class="qm_text"><?=GetMessage("hotel_frend_comment")?></div>
			<textarea name="<?=fGetName("hotel_frend",0)?>"></textarea>

			 <div class="in_er"><div class="in_er_content"><?=GetMessage("ERP_hotel_frend");?></div></div>
		</div>

		<?endif?>
			<!--  Комментарий  -->
		<?if(fGetActive("comments")):?>

		<div class="ti_bar" id="ti_blo_comments" style="margin-top:0px;">
			 <div class="tiqa"><?=GetMessage("comments");?><span class="zred"> </span>
			 <?if(GetMessage("comments_comment")) {?>
				<div class="qm"></div>

			<?}?>
			 </div>
			<div class="qm_text"><?=GetMessage("comments_comment")?></div>
			<textarea name="<?=fGetName("comments",0)?>"></textarea>

			 <div class="in_er"><div class="in_er_content"><?=GetMessage("ERP_comments");?></div></div>
		</div>

		<?endif?>
	</td>
	</tr></table><br />
</div>
	<div class="ti_but" id="ti_but_form_submit">
		<div class="sktt_1" style="display:none;">►►► <?=GetMessage("form_submit_but")?></div><div class="sktt_2" style="display:none;"><?=GetMessage("error_all");?></div>
			<button form="" id="" onclick="res_pro('form_submit')" type="button">►►► <?=GetMessage("form_submit_but")?></button>
		</div>
		<div style="display:none">
			<input id="but_bot_3_a" name="web_form_submit" type="submit" class="vst" value=">>>>>" style="">
		</div>

	<?=$arResult["FORM_FOOTER"]?>

</div>

