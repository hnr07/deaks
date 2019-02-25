<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $t_step; // Шаг регистрации
?>

 <? include "../var_config.php"; // Конфигурация мероприятия?>
 <? include "../../functions/functions.php";  // Функции PHP?>
 <? include "../../vop_array.php";  // массив доступных отделов продаж?>
 <? include "../price_list_".fGetResultValues("id_venue").".php"; // Прайс-лист мероприятия ?>
<?//id="fld_code_m"!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!?>

<div class="div_form" style="">
	<div id="tr"></div>
	Заявка № <?=$_GET['RESULT_ID']?>
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
<div><?=GetMessage("venue");?> - <?=fGetResultValues("venue",0)?></div>
<div>ID площадки - <?=fGetResultValues("id_venue",0)?></div>

	<? 
	$ar_head_form=explode(" ",$arResult["FORM_HEADER"],2);
	$head_form=$ar_head_form[0]." id=\"form_submit_step_2\" onsubmit=\"res_pro('form_submit')\" ".$ar_head_form[1];
	echo $head_form;
	?>
	<?=bitrix_sessid_post()?>
	
	<?$edit_z=1; include "../../calculator.php"; // калькулятор ?>
	
	<!-- Скрытые поля  -->
	<div class="nevid">
		<? include "../../field_form.php"; // Все поля формы?>
		<!--  Курс заявки  -->
		<input  name="<?=fGetName("m_course",0)?>" value="<?=$kp?>"  type="text">
			<!--  Сумма задолженности  -->
		<input  name="<?=fGetName("sum_debt",0)?>" value="<?=$cena_n?>"  type="text">
		
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
	
		<div class="dib"><h4>Сохранение заявки</h4>
	
	<?
		$cts=str_replace("\n","<br/>",$ctext_n);
		$cts_b=str_replace("\n","<br/>",$ctext);
		?>
		<?if($choice_venue) {?><div class="ctext"><?=GetMessage("venue")?>: <?=fGetResultValues("venue")?></div><br /><?}?>

		<div class="ctext">
		<?
		$ar_noc = array();
		if(in_array(fGetResultValues("id_venue"),$ar_noc)) {?>
			Стоимость участия в конференции уточняется и будет опубликована позже.
		<?} else {?>
		<table width="90%"><tr>
		<td width="50%">
		<?=$cts?>
		</td><td>
		<?=$cts_b?>
		</td>
		</tr></table>
		<?}?>
		</div>
	<br /><br />
		<!--  ФИО соседа по номеру  -->
		
		<div class="ti_bar" id="ti_blo_hotel_frend">
			 <div class="tiqa">ФИО соседа по номеру </div>

			<textarea name="<?=fGetName("hotel_frend",0)?>" style="width:400px;"><?=fGetResultValues("hotel_frend")?></textarea>
			
		</div>
			<!--  Комментарий  -->
		
		<div class="ti_bar" id="ti_blo_comments">
			 <div class="tiqa">Комментарий </div>

			<textarea name="<?=fGetName("comments",0)?>" style="width:400px;"><?=fGetResultValues("comments")?></textarea>
			
		</div>
		
	<br />
</div>

	
	
			<input id="but_bot_3_a" name="web_form_submit" type="submit" class="vst" value="Сохранить" style="">
		

	<?=$arResult["FORM_FOOTER"]?>


</div>
<script>
//f_vp_sc(1);
//sen_por_oplata();
sen_por();
</script>
