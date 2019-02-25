<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $t_step; // Шаг регистрации
?>

 <? include "var_config.php"; // Конфигурация мероприятия?>
 <? include "functions.php";  // Функции PHP?>
 <? include "vop_array.php";  // массив доступных отделов продаж ?>

<?// include "note_error.php"; // Ошибки заполнения ?>

<? include "header_form.php"; // Шапка формы ?>

<div style="">
<? include "../../../com/registration_event/passport_member/choice.php"; // Выбор карточки участника ?>
</div>

<div class="div_form" style="">
	<div id="tr"></div>
	<? 
	$ar_head_form=explode(" ",$arResult["FORM_HEADER"],2);
	$head_form=$ar_head_form[0]." id=\"form_submit_step_1\" onsubmit=\"res_pro('form_submit')\" ".$ar_head_form[1];
	echo $head_form;
	?>
	<!-- Скрытые поля  -->
<div class="nevid">

<!--  Шаг регистрации  -->
<input id="t_step" name="<?=fGetName("step",0)?>" value="<?=$t_step?>"  type="text">
<!--  Язык регистрации  -->
<input id="lang_id" name="<?=fGetName("lang_id",0)?>" value="<?=LANGUAGE_ID?>"  type="text">
<!--  Код мероприятия  -->
<input id="code_m" name="<?=fGetName("code_m",0)?>" value="<?=$code_m?>" type="text">

</div>
<div class="dib"><h4><?=GetMessage("block_1");?></h4><div class="div_za b1"><div><img src="/images/registration_event/check.png"><?//=GetMessage("provereno");?></div></div>
	<?if($choice_venue) {  // Используем выбор площадки?>
	<!--  Площадка  -->
	<?if(fGetActive("venue")):?>
	<div class="ti_blo s_mtext" id="ti_blo_venue">
		<div class="tiqa" id="slide_venue" block="Y"> <?=GetMessage("venue");?><span class="zred"> *</span> &#9660;
		<?if(GetMessage("venue_comment")) {?>
			<div class="qm"></div>
				
		<?}?>
		</div>
		<div class="qm_text"><?=GetMessage("venue_comment")?></div>
		<?include "venue/venue_list.php";?>
		<input id="name_venue" name="<?=fGetName("venue",0)?>" value="" class="" type="text" readonly>
		<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_venue");?></div></div>
		
	</div>
	<?endif?>

	<?} else {?>
	<?include "venue/venue_array.php";?>
	<input id="name_venue" name="<?=fGetName("venue",0)?>" value="<?=$ar_vlm[$venue_default]["name"]?>" class="" type="hidden">
	<?}?>
	<!--  ID площадки  -->
	<?if(fGetActive("id_venue")):?>
	<div class="" id="ti_blo_id_venue">
	<div class="div_hidden">
		<input id="id_venue" name="<?=fGetName("id_venue",0)?>" value="<?=$venue_default?>" class="" type="text">
	</div>
	</div>
	<?endif?>

	<input id="not_filter_pl_member" type="hidden" value="<?=$not_filter_pl_member?>"> <!-- проверять оплату для участника-->
	<input id="not_filter_pl_guest_chk" type="hidden" value="<?=$not_filter_pl_guest_chk?>"> <!-- проверять оплату для приглашённого ЧК-->
	<input id="not_filter_pl_guest" type="hidden" value="<?=$not_filter_pl_guest?>"> <!-- проверять оплату для приглашённого родственника-->
	<input id="currency_id_not" type="hidden" value="<?=$currency_id_not?>"> <!-- id валюты, если без проверки-->
	<input id="currency_not" type="hidden" value="<?=$currency_not?>"> <!-- символьный код валюты, если без проверки-->
	
	<!--  Статус  -->
	<?if(fGetActive("status")):?>

		<div class="ti_blo s_radio" id="ti_blo_status">

			<div class="tiqa"> <?=GetMessage("status");?><span class="zred"> *</span>
			<?if(GetMessage("status_comment")) {?>
				<div class="qm"></div>
					
			<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("status_comment")?></div>
			<div class="i_rb"><input id="stat_0" name="<?=fGetName("status")?>" value="<?=fGetValue("status",0)?>" class="radio_status" type="radio" <?if(fGetAnswerCode("status",0)==$_SESSION["passport_member"]["status"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="stat_0" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("status_0");?></label></div>
			<?if($guest_chk_option) {?><div class="i_rb"><input id="stat_1" name="<?=fGetName("status")?>" value="<?=fGetValue("status",1)?>" class="radio_status" type="radio" <?if(fGetAnswerCode("status",1)==$_SESSION["passport_member"]["status"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="stat_1" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("status_1");?></label></div><?}?>
			<?if($guest_option) {?><div class="i_rb"><input id="stat_2" name="<?=fGetName("status")?>" value="<?=fGetValue("status",2)?>" class="radio_status" type="radio" <?if(fGetAnswerCode("status",2)==$_SESSION["passport_member"]["status"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="stat_2" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("status_2");?></label></div><?}?>
		 <div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_STATUS");?></div></div>
		</div>

	<?endif?>
<div class="nich"></div>
	<div id="sipo_0">
		<div class="tinot"><?=GetMessage('TINOT_3')?></div>
		<!--  Кем приглашен № ЧК  -->
		<?if(fGetActive("kem_priglashen_chk")):?>
		<div class="ti_blo s_text" id="ti_blo_kem_priglashen_chk">
			
			 <div class="tiqa"><?=GetMessage("kem_priglashen_chk");?><span class="zred"> *</span>
			 <?if(GetMessage("kem_priglashen_chk_comment")) {?>
				<div class="qm"></div>
				
			<?}?>
			 </div>
			<div class="qm_text"><?=GetMessage("kem_priglashen_chk_comment")?></div>	
			 <input id="" name="<?=fGetName("kem_priglashen_chk",0)?>" value="<?=$_SESSION["passport_member"]["kem_priglashen_chk"]?>" type="text" reg="reg_chk"> 
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_PR_CHK");?></div></div>
			
		</div>
		<?endif?>

		<!--  Кем приглашен имя  -->
		<?if(fGetActive("kem_priglashen_name")):?>
		<div class="ti_blo s_text" id="ti_blo_kem_priglashen_name">
			 <div class="tiqa"><?=GetMessage("kem_priglashen_name");?><span class="zred"> *</span>
			<?if(GetMessage("kem_priglashen_name_comment")) {?>
				<div class="qm"></div>
				
			<?}?> 
			 </div>
			<div class="qm_text"><?=GetMessage("kem_priglashen_name_comment")?></div>	
			 <input id="" name="<?=fGetName("kem_priglashen_name",0)?>" value="<?=$_SESSION["passport_member"]["kem_priglashen_name"]?>"  type="text" reg="reg_fio"> 
			 <div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_PR_NAME");?></div></div>
		</div>
		<?endif?>

		<!--  Кем приглашен фамилия  -->
		<?if(fGetActive("kem_priglashen_family")):?>
		<div class="ti_blo s_text" id="ti_blo_kem_priglashen_family">
			  <div class="tiqa"><?=GetMessage("kem_priglashen_family");?><span class="zred"> *</span>
			<?if(GetMessage("kem_priglashen_family_comment")) {?>
				<div class="qm"></div>
				
			<?}?>  
			  </div>
			<div class="qm_text"><?=GetMessage("kem_priglashen_family_comment")?></div>	
			 <input id="" name="<?=fGetName("kem_priglashen_family",0)?>" value="<?=$_SESSION["passport_member"]["kem_priglashen_family"]?>" type="text" reg="reg_fio"> 
			 <div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_PR_FAMILY");?></div></div>
		</div>
		<?endif?>

	</div>

<div id="sipo_2">
	<div id="sipo_1">

		<!--  № ЧК  -->
		<?if(fGetActive("chk")):?>
		<div class="ti_blo s_text" id="ti_blo_chk">
			 <div class="tiqa"><?=GetMessage("chk");?><span class="zred"> *</span>
			<?if(GetMessage("chk_comment")) {?>
				<div class="qm"></div>
				
			<?}?> 
			 </div>
			<div class="qm_text"><?=GetMessage("chk_comment")?></div>	
			 <input id="" name="<?=fGetName("chk",0)?>" value="<?=$_SESSION["passport_member"]["chk"]?>"  type="text" reg="reg_chk"> 
			
			 <div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_CHK");?></div></div>

		</div>
		<?endif?>	

	</div>
		

	

		<!--  Имя  -->
		<?if(fGetActive("name")):?>
		<div class="ti_blo s_text" id="ti_blo_name">
			 <div class="tiqa"><?=GetMessage("name");?><span class="zred"> *</span>
			<?if(GetMessage("name_comment")) {?>
				<div class="qm"></div>
				
			<?}?> 
			 </div>
			<div class="qm_text"><?=GetMessage("name_comment")?></div>	
			 <input id="" name="<?=fGetName("name",0)?>" value="<?=$_SESSION["passport_member"]["name"]?>" type="text" reg="reg_fio"> 
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_NAME");?></div></div>
		</div>
		<?endif?>
	
		<!--  Фамилия  -->
		<?if(fGetActive("family")):?>
		<div class="ti_blo s_text" id="ti_blo_family">
			 <div class="tiqa"><?=GetMessage("family");?><span class="zred"> *</span>
			<?if(GetMessage("family_comment")) {?>
				<div class="qm"></div>
				
			<?}?> 
			 </div>
			<div class="qm_text"><?=GetMessage("family_comment")?></div>	
			<input id="" name="<?=fGetName("family",0)?>" value="<?=$_SESSION["passport_member"]["family"]?>" type="text" reg="reg_fio">
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_FAMILY");?></div></div>	 
		</div>
		<?endif?>

		<div class="nich"></div>

	
	<div class="div_pro_error"></div>
		<div class="ti_but" id="ti_but_proverka">
			<div class="sktt_1" style="display:none;">&#9658;&#9658;&#9658; <?=GetMessage("proverka_but")?></div><div class="sktt_2" style="display:none;"><?=GetMessage("error_all");?></div>
				<div class="tiqa"><?=GetMessage("proverka")?><span class="zred"> *</span></div>
				<button form="" id="" onclick="res_pro('proverka')" type="button">&#9658;&#9658;&#9658; <?=GetMessage("proverka_but")?></button>
			</div>
	</div>	
	
	<input id="promotion_1" name="<?=fGetName("promotion_1",0)?>" value="" type="hidden">
	<input id="promotion_2" name="<?=fGetName("promotion_2",0)?>" value="" type="hidden">
	<input id="em_bd" name="<?=fGetName("em_bd",0)?>" value="" type="hidden">
	
</div>	
		
	<div class="div_oplata_ok" style="">
	
	<div class="dib"><h4><?=GetMessage("block_2");?></h4><div class="div_za b2"><div><img src="/images/registration_event/check.png"><?//=GetMessage("provereno");?></div></div>
			<!--  Форма оплаты  -->
		<?if(fGetActive("oplata")):?>
		<div class="ti_blo s_radio" id="ti_blo_oplata">

			<div class="tiqa"> <?=GetMessage("oplata");?><span class="zred"> *</span>
			<?if(GetMessage("oplata_comment")) {?>
				<div class="qm"></div>
				
			<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("oplata_comment")?></div>	
			<div class="i_rb"><input id="opl_0" name="<?=fGetName("oplata")?>" value="<?=fGetValue("oplata",0)?>" class="radio_oplata" type="radio" <?if(fGetAnswerCode("oplata",0)==$_SESSION["passport_member"]["oplata"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="opl_0" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("oplata_0");?></label></div>
			<div class="i_rb"><input id="opl_1" name="<?=fGetName("oplata")?>" value="<?=fGetValue("oplata",1)?>" class="radio_oplata" type="radio" <?if(fGetAnswerCode("oplata",1)==$_SESSION["passport_member"]["oplata"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="opl_1" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("oplata_1");?></label></div>
			
		 <div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_oplata");?></div></div>
		</div>
		<?endif?>
		
		<div class="nich"></div>
		
		<div id="pl_div" style="">
			
			<div class="ti_but"><button form="" id="but_plachu_sam" onclick="plachu_sam()" type="button">&#9658;&#9658;&#9658; <?=GetMessage("plachu_sam")?></button></div>
		
		
				<!--  № ЧК плательщика -->
			<?if(fGetActive("pl_chk")):?>
			<div class="ti_blo s_text" id="ti_blo_pl_chk">
				 <div class="tiqa"><?=GetMessage("pl_chk");?><span class="zred"> *</span>
				<?if(GetMessage("pl_chk_comment")) {?>
					<div class="qm"></div>
					
				<?}?> 
				 </div>
				<div class="qm_text"><?=GetMessage("pl_chk_comment")?></div>	
				 <input id="" name="<?=fGetName("pl_chk",0)?>" value="<?=$_SESSION["passport_member"]["pl_chk"]?>"  type="text" reg="reg_chk"> 
				
				 <div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_pl_chk");?></div></div>

			</div>
			
			<?endif?>
		
				<!--  Имя плательщика  -->
			<?if(fGetActive("pl_name")):?>
			<div class="ti_blo s_text" id="ti_blo_pl_name">
				 <div class="tiqa"><?=GetMessage("pl_name");?><span class="zred"> *</span>
				<?if(GetMessage("pl_name_comment")) {?>
					<div class="qm"></div>
					
				<?}?> 
				 </div>
				<div class="qm_text"><?=GetMessage("pl_name_comment")?></div>	
				 <input id="" name="<?=fGetName("pl_name",0)?>" value="<?=$_SESSION["passport_member"]["pl_name"]?>" type="text" reg="reg_fio"> 
				 <div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_pl_name");?></div></div>
			</div>
			<?endif?>

			<!--  Фамилия плательщика  -->
			<?if(fGetActive("pl_family")):?>
			<div class="ti_blo s_text" id="ti_blo_pl_family">
				 <div class="tiqa"><?=GetMessage("pl_family");?><span class="zred"> *</span>
				<?if(GetMessage("pl_family_comment")) {?>
					<div class="qm"></div>
					
				<?}?> 
				 </div>
				<div class="qm_text"><?=GetMessage("pl_family_comment")?></div>	
				<input id="" name="<?=fGetName("pl_family",0)?>" value="<?=$_SESSION["passport_member"]["pl_family"]?>" type="text" reg="reg_fio">
				<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_pl_family");?></div></div>	 
			</div>
			<?endif?>
			
			<!--  № телефона плательщика  -->
			<?if(fGetActive("pl_phone")):?>
			<div class="ti_blo s_text" id="ti_blo_pl_phone">
				 <div class="tiqa"><?=GetMessage("pl_phone");?><span class="zred"> *</span>
				<?if(GetMessage("pl_phone_comment")) {?>
					<div class="qm"></div>
					
				<?}?> 
				 </div>
				<div class="qm_text"><?=GetMessage("pl_phone_comment")?></div>	
				<input id="" name="<?=fGetName("pl_phone",0)?>" value="<?=$_SESSION["passport_member"]["pl_phone"]?>" type="text" reg="reg_phone">
				<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_pl_phone");?></div></div>	 
			</div>
			<?endif?>

				<!--  Рассрочка для чека  -->
			<?if(fGetActive("time_money_chk")):?>
			<div class="ti_blo s_radio" id="ti_blo_time_money_chk">

				<div class="tiqa"> <?=GetMessage("time_money_chk");?>
				
				<?if(GetMessage("time_money_chk_comment")) {?>
					<div class="qm"></div>
					
				<?}?></div>
				<div class="qm_text"><?=GetMessage("time_money_chk_comment")?></div>	
				<div class="i_rb"><input id="time_money_chk_0" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",0)?>" class="radio_time_money_chk" type="radio" checked><label for="time_money_chk_0" class="l_r_a"> <?=GetMessage("time_money_chk_0");?></label></div>
				
				<?if(date("Ymd") <= date_in_int($month_inst_chk_1)): // показывать до ?>
				<div class="i_rb"><input id="time_money_chk_1" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",1)?>" class="radio_time_money_chk" type="radio"><label for="time_money_chk_1" class="l_r"> <?=GetMessage("time_money_chk_1");?></label></div>
				<?endif?>
				
				<?if(date("Ymd") <= date_in_int($month_inst_chk_2)): // показывать до ?>
				<div class="i_rb"><input id="time_money_chk_2" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",2)?>" class="radio_time_money_chk" type="radio"><label for="time_money_chk_2" class="l_r"> <?=GetMessage("time_money_chk_2");?></label></div>
				<?endif?>
				
				<?if(date("Ymd") <= date_in_int($month_inst_chk_3)): // показывать до ?>
				<div class="i_rb"><input id="time_money_chk_3" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",3)?>" class="radio_time_money_chk" type="radio"><label for="time_money_chk_3" class="l_r"> <?=GetMessage("time_money_chk_3");?></label></div>
				<?endif?>
				
				<?if(date("Ymd") <= date_in_int($month_inst_chk_4)): // показывать до ?>
				<div class="i_rb"><input id="time_money_chk_4" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",4)?>" class="radio_time_money_chk" type="radio"><label for="time_money_chk_4" class="l_r"> <?=GetMessage("time_money_chk_4");?></label></div>
				<?endif?>
				
				<?if(date("Ymd") <= date_in_int($month_inst_chk_5)): // показывать до ?>
				<div class="i_rb"><input id="time_money_chk_5" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",5)?>" class="radio_time_money_chk" type="radio"><label for="time_money_chk_5" class="l_r"> <?=GetMessage("time_money_chk_5");?></label></div>
				<?endif?>
				
				<?if(date("Ymd") <= date_in_int($month_inst_chk_6)): // показывать до ?>
				<div class="i_rb"><input id="time_money_chk_6" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",6)?>" class="radio_time_money_chk" type="radio"><label for="time_money_chk_6" class="l_r"> <?=GetMessage("time_money_chk_6");?></label></div>
				<?endif?>
				
				<?if(date("Ymd") <= date_in_int($month_inst_chk_7)): // показывать до ?>
				<div class="i_rb"><input id="time_money_chk_7" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",7)?>" class="radio_time_money_chk" type="radio"><label for="time_money_chk_7" class="l_r"> <?=GetMessage("time_money_chk_7");?></label></div>
				<?endif?>
				
				<?if(date("Ymd") <= date_in_int($month_inst_chk_8)): // показывать до ?>
				<div class="i_rb"><input id="time_money_chk_8" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",8)?>" class="radio_time_money_chk" type="radio"><label for="time_money_chk_8" class="l_r"> <?=GetMessage("time_money_chk_8");?></label></div>
				<?endif?>
				
			 <div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_money_chk");?></div></div>
			</div>
			<?endif?>
			
			<div id="garant_div">
				
					<!--  № ЧК гаранта -->
				<?if(fGetActive("garant_chk")):?>
				<div class="ti_blo s_text" id="ti_blo_garant_chk">
					 <div class="tiqa"><?=GetMessage("garant_chk");?><span class="zred"> *</span>
					<?if(GetMessage("garant_chk_comment")) {?>
						<div class="qm"></div>
						
					<?}?> 
					 </div>
					<div class="qm_text"><?=GetMessage("garant_chk_comment")?></div>	
					 <input id="" name="<?=fGetName("garant_chk",0)?>" value="<?=$_SESSION["passport_member"]["garant_chk"]?>"  type="text" reg="reg_chk"> 
					
					 <div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_garant_chk");?></div></div>

				</div>
				
				<?endif?>
			
					<!--  Имя гаранта  -->
				<?if(fGetActive("garant_name")):?>
				<div class="ti_blo s_text" id="ti_blo_garant_name">
					 <div class="tiqa"><?=GetMessage("garant_name");?><span class="zred"> *</span>
					<?if(GetMessage("garant_name_comment")) {?>
						<div class="qm"></div>
						
					<?}?> 
					 </div>
					<div class="qm_text"><?=GetMessage("garant_name_comment")?></div>	
					 <input id="" name="<?=fGetName("garant_name",0)?>" value="<?=$_SESSION["passport_member"]["garant_name"]?>" type="text" reg="reg_fio"> 
					 <div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_garant_name");?></div></div>
				</div>
				<?endif?>

				<!--  Фамилия гаранта  -->
				<?if(fGetActive("garant_family")):?>
				<div class="ti_blo s_text" id="ti_blo_garant_family">
					 <div class="tiqa"><?=GetMessage("garant_family");?><span class="zred"> *</span>
					<?if(GetMessage("garant_family_comment")) {?>
						<div class="qm"></div>
						
					<?}?> 
					 </div>
					<div class="qm_text"><?=GetMessage("garant_family_comment")?></div>	
					<input id="" name="<?=fGetName("garant_family",0)?>" value="<?=$_SESSION["passport_member"]["garant_family"]?>" type="text" reg="reg_fio">
					<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_garant_family");?></div></div>	 
				</div>
				<?endif?>
			
			</div>
			
			<div class="div_pl_error"></div>
			<div class="ti_but" id="ti_but_proverka_check">
				<div class="sktt_1" style="display:none;">&#9658;&#9658;&#9658; <?=GetMessage("proverka_check_but")?></div><div class="sktt_2" style="display:none;"><?=GetMessage("error_all");?></div>
				
				<button form="" onclick="res_pro('proverka_check')" type="button">&#9658;&#9658;&#9658; <?=GetMessage("proverka_check_but")?></button>
			</div>
			
			
				
		</div>
		
		<div id="op_div">
		
		
			  <!--  Страна  -->
			<?if(fGetActive("op_country")):?>
			<div class="ti_blo s_select" id="ti_blo_op_country">
			<div class="tiqa"><?=GetMessage("op_country");?><span class="zred"> *</span>
					<?if(GetMessage("op_country_comment")) {?>
						<div class="qm"></div>
						
					<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("op_country_comment")?></div>	

			<div id="sel_op_country" class="ober_div">
				<div class="coon_t"><?=$_SESSION["passport_member"]["op_country"]?></div><div class="coon"></div>
				<div class="coon_s">
					<?
					
					$coc=count($ar_country_u);
					
					for($i=0;$i<$coc;$i++)
						{
							echo "<div onclick=\"f_click_country('".$ar_country_u[$i]."')\">".$ar_country_u[$i]."</div>";
						}
				
			?>
				</div>
			</div>
			<div class="div_hidden">
				<input  name="<?=fGetName("op_country",0)?>" value="<?=$_SESSION["passport_member"]["op_country"]?>" type="text">
			</div>
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_op_country");?></div></div>
			</div>				
			<?endif?>
			
			  <!--  Город  -->
			<?if(fGetActive("op_city")):?>
			<div class="ti_blo s_select" id="ti_blo_op_city">
			<div class="tiqa"><?=GetMessage("op_city");?><span class="zred"> *</span>
					<?if(GetMessage("op_city_comment")) {?>
						<div class="qm"></div>
						
					<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("op_city_comment")?></div>	
		
				<div id="sel_op_city" class="ober_div">
					<div class="coon_t"><?=$_SESSION["passport_member"]["op_city"]?></div><div class="coon"></div>
					<div class="coon_s">
					
					</div>
				</div>
				<div class="div_hidden">
					<input  name="<?=fGetName("op_city",0)?>" value="<?=$_SESSION["passport_member"]["op_city"]?>" type="text">
				</div>
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_op_city");?></div></div>
			</div>				
			<?endif?>
			
			
			  <!--  № Офиса продаж  -->
			<?if(fGetActive("op_nof")):?>
			<div class="ti_blo s_select" id="ti_blo_op_nof">
			<div class="tiqa"><?=GetMessage("op_nof");?><span class="zred"> *</span>
					<?if(GetMessage("op_nof_comment")) {?>
						<div class="qm"></div>
						
					<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("op_nof_comment")?></div>	
					<!--
				<div class="ober_sel">
				<select  id="sel_op_nof" onChange="f_chang_nof()">
		
				</select>
				</div>
				-->
				<div id="sel_op_nof" class="ober_div">
					<div class="coon_t"><?=$_SESSION["passport_member"]["op_nof"]?></div><div class="coon"></div>
					<div class="coon_s">
					
					</div>
				</div>
				<div class="div_hidden">
					<input  name="<?=fGetName("op_nof",0)?>" value="<?=$_SESSION["passport_member"]["op_nof"]?>" type="text">
				</div>
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_op_nof");?></div></div>
				</div>			
			<?endif?>
			<?if($_SESSION["passport_member"]["op_country"]) {?>
			<script>var gf_1=1;var h=$("#sel_op_country .coon_t").html();f_click_country(h);</script>
			<?}else {?><script>var gf_1=0;</script><?}?>
			<?if($_SESSION["passport_member"]["op_city"]) {?>
			<script>var gf_2=1;var h=$("#sel_op_city .coon_t").html();f_click_city(h);</script>
			<?}else {?><script>var gf_2=0;</script><?}?>
			<?if($_SESSION["passport_member"]["op_nof"]) {?>
			<script>var h=$("#sel_op_nof .coon_t").html();f_click_nof(h);</script>
			<?}?>
						<!--  Рассрочка для ОП  -->
			<?if(fGetActive("time_money_op")):?>
			<div class="ti_blo s_radio" id="ti_blo_time_money_op">

				<div class="tiqa"> <?=GetMessage("time_money_op");?>
				<?if(GetMessage("time_money_op_comment")) {?>
					<div class="qm"></div>
					
				<?}?>
				</div>
				<div class="qm_text"><?=GetMessage("time_money_op_comment")?></div>	
				<div class="i_rb"><input id="time_money_op_0" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",0)?>" class="radio_time_money_op" type="radio" checked><label for="time_money_op_0" class="l_r_a"> <?=GetMessage("time_money_op_0");?></label></div>
				
				<?if(date("Ymd") <= date_in_int($month_inst_op_1)): // показывать до ?>
				<div class="i_rb"><input id="time_money_op_1" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",1)?>" class="radio_time_money_op" type="radio"><label for="time_money_op_1" class="l_r"> <?=GetMessage("time_money_op_1");?></label></div>
				<?endif?>
				
				<?if(date("Ymd") <= date_in_int($month_inst_op_2)): // показывать до ?>
				<div class="i_rb"><input id="time_money_op_2" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",2)?>" class="radio_time_money_op" type="radio"><label for="time_money_op_2" class="l_r"> <?=GetMessage("time_money_op_2");?></label></div>
				<?endif?>
				
				<?if(date("Ymd") <= date_in_int($month_inst_op_3)): // показывать до ?>
				<div class="i_rb"><input id="time_money_op_3" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",3)?>" class="radio_time_money_op" type="radio"><label for="time_money_op_3" class="l_r"> <?=GetMessage("time_money_op_3");?></label></div>
				<?endif?>
				
				<?if(date("Ymd") <= date_in_int($month_inst_op_4)): // показывать до ?>
				<div class="i_rb"><input id="time_money_op_4" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",4)?>" class="radio_time_money_op" type="radio"><label for="time_money_op_4" class="l_r"> <?=GetMessage("time_money_op_4");?></label></div>
				<?endif?>
				
				<?if(date("Ymd") <= date_in_int($month_inst_op_5)): // показывать до ?>
				<div class="i_rb"><input id="time_money_op_5" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",5)?>" class="radio_time_money_op" type="radio"><label for="time_money_op_5" class="l_r"> <?=GetMessage("time_money_op_5");?></label></div>
				<?endif?>
				
				<?if(date("Ymd") <= date_in_int($month_inst_op_6)): // показывать до ?>
				<div class="i_rb"><input id="time_money_op_6" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",6)?>" class="radio_time_money_op" type="radio"><label for="time_money_op_6" class="l_r"> <?=GetMessage("time_money_op_6");?></label></div>
				<?endif?>
				
				<?if(date("Ymd") <= date_in_int($month_inst_op_7)): // показывать до ?>
				<div class="i_rb"><input id="time_money_op_7" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",7)?>" class="radio_time_money_op" type="radio"><label for="time_money_op_7" class="l_r"> <?=GetMessage("time_money_op_7");?></label></div>
				<?endif?>
				
				<?if(date("Ymd") <= date_in_int($month_inst_op_8)): // показывать до ?>
				<div class="i_rb"><input id="time_money_op_8" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",8)?>" class="radio_time_money_op" type="radio"><label for="time_money_op_8" class="l_r"> <?=GetMessage("time_money_op_8");?></label></div>
				<?endif?>
				
			 <div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_money_op");?></div></div>
			</div>
			<?endif?>
			
			<div class="div_op_error">
			<div class="ti_but" id="ti_but_proverka_op">
				<div class="sktt_1" style="display:none;">&#9658;&#9658;&#9658; <?=GetMessage("proverka_op_but")?></div><div class="sktt_2" style="display:none;"><?=GetMessage("error_all");?></div>
				
				<button form="" onclick="res_pro('proverka_op')" type="button">&#9658;&#9658;&#9658; <?=GetMessage("proverka_op_but")?></button>
			</div>
			
			
		
			</div>
			
		</div>
		
		<input id="currency_id" name="<?=fGetName("currency_id",0)?>" value="" type="hidden">
		<input id="currency" name="<?=fGetName("currency",0)?>" value="" type="hidden">
		<input id="promotion_3" name="<?=fGetName("promotion_3",0)?>" value="" type="hidden">
		
	</div>
</div>

	<div class="div_pro_ok">
	<div class="dib_sh"><h4><?=GetMessage("block_3");?></h4>	
		<!--  Телефон  -->
		<?if(fGetActive("tel")):?>
		<div class="ti_blo s_text" id="ti_blo_tel">
			 <div class="tiqa"><?=GetMessage("tel");?><span class="zred"> *</span>
			<?if(GetMessage("tel_comment")) {?>
				<div class="qm"></div>
				
			<?}?> 
			 </div>
			<div class="qm_text"><?=GetMessage("tel_comment")?></div>	
			<input id="" name="<?=fGetName("tel",0)?>" value="<?=$_SESSION["passport_member"]["tel"]?>" type="text" reg="reg_phone">
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_tel");?></div></div>	 
		</div>
		<?endif?>
		
		<!--  Мобильный телефон  -->
		<?if(fGetActive("tel_2")):?>
		<div class="ti_blo s_text" id="ti_blo_tel_2">
			 <div class="tiqa"><?=GetMessage("tel_2");?><span class="zred"> *</span>
			<?if(GetMessage("tel_2_comment")) {?>
				<div class="qm"></div>
				
			<?}?> 
			 </div>
			<div class="qm_text"><?=GetMessage("tel_2_comment")?></div>	
			<input id="" name="<?=fGetName("tel_2",0)?>" value="<?=$_SESSION["passport_member"]["tel_2"]?>" type="text" reg="reg_phone">
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_tel_2");?></div></div>	 
		</div>
		<?endif?>
		
		<!--  E-mail  -->
		<?if(fGetActive("email")):?>
		<div class="ti_blo s_text" id="ti_blo_email">
			 <div class="tiqa"><?=GetMessage("email");?><span class="zred"> *</span>
			<?if(GetMessage("email_comment")) {?>
				<div class="qm"></div>
				
			<?}?> 
			 </div>
			<div class="qm_text"><?=GetMessage("email_comment")?></div>	
			<input id="" name="<?=fGetName("email",0)?>" value="<?=$_SESSION["passport_member"]["email"]?>" type="text" reg="reg_mail">
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_email");?></div></div>	 
		</div>
		<?endif?>
		
		<!--  Доп. e-mail  -->
		<?if(fGetActive("email_2")):?>
		<div class="ti_blo s_text" id="ti_blo_email_2">
			 <div class="tiqa"><?=GetMessage("email_2");?>
			<?if(GetMessage("email_2_comment")) {?>
				<div class="qm"></div>
				
			<?}?> 
			 </div>
			<div class="qm_text"><?=GetMessage("email_2_comment")?></div>	
			<input id="" name="<?=fGetName("email_2",0)?>" value="<?=$_SESSION["passport_member"]["email_2"]?>" type="text" reg="if_reg_mail">
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_email_2");?></div></div>	 
		</div>
		<?endif?>
		
		<!--  Skype  -->
		<?if(fGetActive("skype")):?>
		<div class="ti_blo s_text" id="ti_blo_skype">
			 <div class="tiqa"><?=GetMessage("skype");?><span class="zred"> </span>
			<?if(GetMessage("skype_comment")) {?>
				<div class="qm"></div>
				
			<?}?> 
			 </div>
			<div class="qm_text"><?=GetMessage("skype_comment")?></div>	
			<input id="" name="<?=fGetName("skype",0)?>" value="<?=$_SESSION["passport_member"]["skype"]?>" type="text" reg="if_reg_skype">
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_skype");?></div></div>	 
		</div>
		<?endif?>
		
			<!--  Предпочтительный вид связи  -->
		<?if(fGetActive("prioritet")):?>
		<div class="ti_blo s_radio" id="ti_blo_prioritet">

			<div class="tiqa"> <?=GetMessage("prioritet");?><span class="zred"> *</span>
			<?if(GetMessage("prioritet_comment")) {?>
				<div class="qm"></div>
				
			<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("prioritet_comment")?></div>	
			<div class="i_rb"><input id="prioritet_0" name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",0)?>" class="radio_prioritet" type="radio" <?if(fGetAnswerCode("prioritet",0)==$_SESSION["passport_member"]["prioritet"] || !$_SESSION["passport_member"]["prioritet"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="prioritet_0" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("prioritet_0");?></label></div>
			<div class="i_rb"><input id="prioritet_1" name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",1)?>" class="radio_prioritet" type="radio" <?if(fGetAnswerCode("prioritet",1)==$_SESSION["passport_member"]["prioritet"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="prioritet_1" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("prioritet_1");?></label></div>
			<div class="i_rb"><input id="prioritet_2" name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",2)?>" class="radio_prioritet" type="radio" <?if(fGetAnswerCode("prioritet",2)==$_SESSION["passport_member"]["prioritet"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="prioritet_2" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("prioritet_2");?></label></div>
			
		 <div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("");?></div></div>
		</div>
		<?endif?>
		
		<!--  Пол  -->
		<?if(fGetActive("sex")):?>
		<div class="ti_blo s_radio" id="ti_blo_sex">

			<div class="tiqa"> <?=GetMessage("sex");?><span class="zred"> *</span>
			<?if(GetMessage("sex_comment")) {?>
				<div class="qm"></div>
				
			<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("sex_comment")?></div>	
			<div class="i_rb"><input id="sex_0" name="<?=fGetName("sex")?>" value="<?=fGetValue("sex",0)?>" class="radio_sex" type="radio" <?if(fGetAnswerCode("sex",0)==$_SESSION["passport_member"]["sex"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="sex_0" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("sex_0");?></label></div>
			<div class="i_rb"><input id="sex_1" name="<?=fGetName("sex")?>" value="<?=fGetValue("sex",1)?>" class="radio_sex" type="radio" <?if(fGetAnswerCode("sex",1)==$_SESSION["passport_member"]["sex"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="sex_1" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("sex_1");?></label></div>
			
		 <div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_sex");?></div></div>
		</div>
		
		<?endif?>
		
		<!--  Дата рождения  -->
		<?$ar_birthday_s=explode(".",$_SESSION["passport_member"]["birthday"]);// Разбиение даты рождения из паспорта участника на составляющие?>
		<?if(fGetActive("birthday")):?>
		<div class="ti_blo" id="ti_blo_birthday">
			 <div class="tiqa"><?=GetMessage("birthday");?><span class="zred"> *</span>
			<?if(GetMessage("birthday_comment")) {?>
				<div class="qm"></div>
				
			<?}?> 
			 </div>
			<div class="qm_text"><?=GetMessage("birthday_comment")?></div>	
			<div  class="sel_m">
				<span><?=GetMessage("number_date")?></span>
				<!--
				<div class="ober_sel">
				<select id="b_d_birthday">
				<option value=''>---</option>
				<?
				for($i=1;$i<=31;$i++){
				echo "<option value='".$i."'";
				if((int)$ar_birthday_s[0]==$i) echo " selected";
				echo ">".$i."</option>";
				}
				?>
				</select>
				</div>
				-->
				<div id="b_d_birthday" class="ober_div">
					<div class="coon_t" value="<?=($ar_birthday_s[0])?(int)$ar_birthday_s[0]:"";?>"><?=($ar_birthday_s[0])?(int)$ar_birthday_s[0]:"";?></div><div class="coon"></div>
					<div class="coon_s">
						<?
						for($i=1;$i<=31;$i++){
						echo "<div value='".$i."' onClick=\"sen_por_birthday(".$i.",1)\">".$i."</div>";
						}
						?>
					</div>
				</div>
			</div>
			<div  class="sel_m">
				<span><?=GetMessage("month_date")?></span>
				<!--
				<div class="ober_sel">
				<select id="b_m_birthday">
				<option value=''>---</option>
				<?
				$ar_month=explode(",",GetMessage("ar_month"));
				for($i=0;$i<12;$i++){
				
				echo "<option value='".($i+1)."'";
				if((int)$ar_birthday_s[1]==($i+1)) echo " selected";
				echo ">".trim($ar_month[$i])."</option>";
				}
				?>
				</select>
				</div>
				-->
				<div id="b_m_birthday" class="ober_div">
					<div class="coon_t" value="<?=($ar_birthday_s[1])?(int)$ar_birthday_s[1]:"";?>"><?=($ar_birthday_s[1])?$ar_month[(int)$ar_birthday_s[1]-1]:"";?></div><div class="coon"></div>
					<div class="coon_s">
						<?
							$ar_month=explode(",",GetMessage("ar_month"));
							for($i=0;$i<12;$i++){
							
							echo "<div value='".($i+1)."' onClick=\"sen_por_birthday(".($i+1).",2)\">".trim($ar_month[$i])."</div>";
							}
						?>
					</div>
				</div>
			</div>
			<div  class="sel_m">

				<span><?=GetMessage("year_date")?></span>
				<!--
				<div class="ober_sel">
				<select id="b_y_birthday">
				<option value=''>---</option>
				<?
				for($i=$year_birthday_start;$i<=$year_birthday_finish;$i++){
				echo "<option value='".$i."'";
				if((int)$ar_birthday_s[2]==$i) echo " selected";
				echo ">".$i."</option>";
				}
				?>
				</select>
				</div>
				-->
				<div id="b_y_birthday" class="ober_div">
					<div class="coon_t" value="<?=($ar_birthday_s[2])?(int)$ar_birthday_s[2]:"";?>"><?=($ar_birthday_s[2])?(int)$ar_birthday_s[2]:"";?></div><div class="coon"></div>
					<div class="coon_s">
						<?
							for($i=$year_birthday_start;$i<=$year_birthday_finish;$i++){
							echo "<div value='".$i."' onClick=\"sen_por_birthday(".$i.",3)\">".$i."</div>";
							}
						?>
					</div>
				</div>
			</div>
			<div class="div_hidden">
				<input id="birthday" name="<?=fGetName("birthday",0)?>" value="<?=$_SESSION["passport_member"]["birthday"]?>" type="text" onChange="sen_por_birthday()">
				<input id="age" name="<?=fGetName("age",0)?>" value="" type="text">
			</div>
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_birthday");?></div></div>	 
		</div>
		<script>
			var b_d=$("#ti_blo_birthday #b_d_birthday .coon_t").attr("value");
			var b_m=$("#ti_blo_birthday #b_m_birthday .coon_t").attr("value");
			var b_y=$("#ti_blo_birthday #b_y_birthday .coon_t").attr("value");
			//sen_por_birthday(b_d,1);
			//sen_por_birthday(b_m,2);
			//sen_por_birthday(b_y,3);
		</script>
		<?endif?>
		
		  <!--  Гражданство  -->
			<?if(fGetActive("country")):?>
			<? include "list_countries.php"; ?>
			<div class="ti_blo s_select" id="ti_blo_country" style="float:left;">
			<div class="tiqa"><?=GetMessage("country");?><span class="zred"> *</span>
					<?if(GetMessage("country_comment")) {?>
						<div class="qm"></div>
						
					<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("country_comment")?></div>	
<!--
				<div class="ober_sel" style="">
				<select id="sel_country">
					<?php

					$coc=count($ar_part_world);
					for($i=0;$i<$coc;$i++)
						{
						echo "<optgroup label='".$ar_part_world[$i]."'>";
						$v_ar_c=@explode(";",$ar_country[$i]);
						asort($v_ar_c);
							foreach($v_ar_c as $val) {
							echo "<option";
							if($_SESSION["passport_member"]["country"]){if($_SESSION["passport_member"]["country"]==$val) echo " selected";}
							else {if($ar_select_default==$val) echo " selected";}
							
							echo ">".$val."</option>";
							}
						echo "</optgroup>";
						}
					?>
				</select>
				</div>
-->
			<div class="ober_div">
			<div class="coon_t" value="<?=$_SESSION["passport_member"]["country"];?>"><?=$_SESSION["passport_member"]["country"];?></div><div class="coon"></div>
					<div class="coon_s">
						<?
							$coc=count($ar_part_world);
					for($i=0;$i<$coc;$i++)
						{
						echo "<h6>".$ar_part_world[$i]."</h6>";
						$v_ar_c=@explode(";",$ar_country[$i]);
						asort($v_ar_c);
							foreach($v_ar_c as $val) {
							echo "<div onClick=\"sen_por_country('".$val."')\">".$val."</div>";
							}
						
						}
						?>
					</div>
				</div>
				
								
				<div class="div_hidden">
						<input id="h_country"  name="<?=fGetName("country",0)?>" value="<?=$_SESSION["passport_member"]["country"];?>" type="text">
					</div>
					
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_country");?></div></div>
			</div>	
				
			<?endif?>
			
			
				<!--  Город проживания  -->
			<?if(fGetActive("city")):?>
			<div class="ti_blo s_text" id="ti_blo_city" style="">
				 <div class="tiqa"><?=GetMessage("city");?><span class="zred"> *</span>
				<?if(GetMessage("city_comment")) {?>
					<div class="qm"></div>
					
				<?}?> 
				 </div>
				<div class="qm_text"><?=GetMessage("city_comment")?></div>	
				<input id="" name="<?=fGetName("city",0)?>" value="<?=$_SESSION["passport_member"]["city"]?>" type="text">
				<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_city");?></div></div>	 
			</div>
			<?endif?>
	</div>	

			<? if($ip_passport){ // открыть/закрыть блок удостоверения личности	?>
				<?if($yes_ip_passport) {?><input id="yes_ip_passport" value="<?=$yes_ip_passport?>" type="hidden"><?}?>
			<div class="dib_sh" id="div_ip_passport"><h4><?=GetMessage("block_4");?></h4>	
					<!--  Удостоверение личности  -->
					<?$ar_ip_passport=array(GetMessage("sel_ip_passport"),/*GetMessage("sel_ip_metric"),GetMessage("sel_ip_military"),GetMessage("sel_ip_driver")*/);?>
<!--
				<?if(fGetActive("ip_passport")):?>
				<div class="ti_blo s_select" id="ti_blo_ip_passport" style="float:left;">
				<div class="tiqa"><?=GetMessage("ip_passport");?><span class="zred"> </span></div>
						<?if(GetMessage("ip_passport_comment")) {?>
							<div class="qm"></div>
							<div class="qm_text"><?=GetMessage("ip_passport_comment")?></div>	
						<?}?>

<div class="ober_div">
			<div class="coon_t" value="<?=$_SESSION["passport_member"]["ip_passport"];?>"><?=$_SESSION["passport_member"]["ip_passport"];?></div><div class="coon"></div>
					<div class="coon_s">
						<?
							for($i=0;$i<1;$i++){
							echo "<div onClick=\"sen_por_ip_passport('паспорт')\">".паспорт."</div>";
							}
						?>
					</div>
				</div>
					<div class="-div_hidden">
						<input  name="<?=fGetName("ip_passport",0)?>" value="" type="text">
					</div>
				<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("");?></div></div>
				</div>
<script>
//var t=$("#ti_blo_ip_passport .coon_t").attr("value");
//alert(t);
//sen_por_ip_passport(t);
</script>				
				<?endif?>
				-->
					<!--  Серия удостоверения личности  -->
				<?if(fGetActive("ip_sp")):?>
				<div class="ti_blo s_text" id="ti_blo_ip_sp" style="float:left;">
					 <div class="tiqa"><?=GetMessage("ip_sp");?><span class="zred"> *</span>
					<?if(GetMessage("ip_sp_comment")) {?>
						<div class="qm"></div>
						
					<?}?> 
					 </div>
					<div class="qm_text"><?=GetMessage("ip_sp_comment")?></div>	
					<input id="" name="<?=fGetName("ip_sp",0)?>" value="<?=$_SESSION["passport_member"]["ip_sp"]?>" type="text">
					<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_ip_sp");?></div></div>	  
				</div>
				<?endif?>
				
					<!--  Номер удостоверения личности  -->
				<?if(fGetActive("ip_np")):?>
				<div class="ti_blo s_text" id="ti_blo_ip_np" style="float:left;">
					 <div class="tiqa"><?=GetMessage("ip_np");?><span class="zred"> *</span>
					<?if(GetMessage("ip_np_comment")) {?>
						<div class="qm"></div>
						
					<?}?> 
					 </div>
					<div class="qm_text"><?=GetMessage("ip_np_comment")?></div>	
					<input id="" name="<?=fGetName("ip_np",0)?>" value="<?=$_SESSION["passport_member"]["ip_np"]?>" type="text">
					<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_ip_np");?></div></div>	 
				</div>
				<?endif?>
				
					<!--  Скан удостоверения личности  -->
						<?
						 // Добавляем скан из карточки участника, если есть
						 /*
						if($_SESSION["passport_member"]["ip_scan"] && file_exists($_SERVER["DOCUMENT_ROOT"].$_SESSION["passport_member"]["ip_scan"])) {?>
						 <a class="gallery" href="<?=$_SESSION["passport_member"]["ip_scan"];?>"><img align="top" title="<?=GetMessage("ip_scan_passport_card")?>" src='/images/registration_event/passport_48.png' alt='scan_passport'/></a>
						 <br /><?=GetMessage("ip_scan_passport_card")?><br /><?=GetMessage("select_another_file")?>
						 <?
						 $arVALUE = array();
						$FIELD_SID = "ip_scan"; // символьный идентификатор вопроса
						$ANSWER_ID = $arResult["QUESTIONS"]["ip_scan"]["STRUCTURE"][0]["ID"]; // ID поля ответа
						$path = $_SERVER["DOCUMENT_ROOT"].$_SESSION["passport_member"]["ip_scan"]; // путь к файлу
						$arVALUE[$ANSWER_ID] = CFile::MakeFileArray($path);
						CFormResult::SetField($_GET["RESULT_ID"], $FIELD_SID, $arVALUE);
						}
						*/
					$html_ip_scan= CForm::GetFileField($arResult["QUESTIONS"]["ip_scan"]["STRUCTURE"][0]["ID"], 0, "FILE", 0);			
						?>
				<?if(fGetActive("ip_scan")):?>
				<div class="ti_blo s_text" id="ti_blo_ip_scan">
					 <div class="tiqa"><?=GetMessage("ip_scan");?><span class="zred"> *</span>
					<?if(GetMessage("ip_scan_comment")) {?>
						<div class="qm"></div>
						
					<?}?> 
					 </div>
					<div class="qm_text"><?=GetMessage("ip_scan_comment")?></div>	
					<?=$html_ip_scan//=fGetHTML("p_scan")?>
					<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("");?></div></div>	 
				</div>
				<?endif?>
				
				<!-- Дата выдачи внутреннего паспорта -->
				<?if(fGetActive("ip_date")):?>
		<div class="ti_blo" id="ti_blo_ip_date">
			 <div class="tiqa"><?=GetMessage("ip_date");?><span class="zred"> </span>
			<?if(GetMessage("ip_date_comment")) {?>
				<div class="qm"></div>
				
			<?}?> 
			 </div>
			<div class="qm_text"><?=GetMessage("ip_date_comment")?></div>	
			<div  class="sel_m">
				<span><?=GetMessage("number_date")?></span>
				<!--
				<div class="ober_sel">
				<select id="b_d_ip_ready">
				<option value=''>---</option>
				<?
				for($i=1;$i<=31;$i++){
				echo "<option value='".$i."'>".$i."</option>";
				}
				?>
				</select>
				</div>
				-->
				<div id="b_d_ip_date" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
					<div value="" onClick="sen_por_ip_date(0,1)"></div>
						<?
						for($i=1;$i<=31;$i++){
						echo "<div value='".$i."' onClick=\"sen_por_ip_date(".$i.",1)\">".$i."</div>";
						}
						?>
					</div>
				</div>
			</div>
			<div  class="sel_m">
				<span><?=GetMessage("month_date")?></span>
				<!--
				<div class="ober_sel">
				<select id="b_m_ip_ready">
				<option value=''>---</option>
				<?
				$ar_month=explode(",",GetMessage("ar_month"));
				for($i=0;$i<12;$i++){
				
				echo "<option value='".($i+1)."'>".trim($ar_month[$i])."</option>";
				}
				?>
				</select>
				</div>
				-->
				<div id="b_m_ip_date" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
					<div value="" onClick="sen_por_ip_date(0,2)"></div>
						<?
							$ar_month=explode(",",GetMessage("ar_month"));
							for($i=0;$i<12;$i++){
							
							echo "<div value='".($i+1)."' onClick=\"sen_por_ip_date(".($i+1).",2)\">".trim($ar_month[$i])."</div>";
							}
						?>
					</div>
				</div>
			</div>
			<div  class="sel_m">

				<span><?=GetMessage("year_date")?></span>
				<!--
				<div class="ober_sel">
				
				<select id="b_y_ip_ready">
				<?if($year_ip_date_start==$year_ip_date_finish) {echo "<option value='".$year_ip_date_start."'>".$year_ip_date_start."</option>";}
				else {?>
				<option value=''>---</option>
				<?
					for($i=$year_ip_date_start;$i<=$year_ip_date_finish;$i++){
						echo "<option value='".$i."'>".$i."</option>";
					}
				}
				?>
				</select>
				</div>
				-->
				<div id="b_y_ip_date" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
					<div value="" onClick="sen_por_ip_date(0,3)"></div>
						<?
							for($i=$year_ip_date_start;$i<=$year_ip_date_finish;$i++){
							echo "<div value='".$i."' onClick=\"sen_por_ip_date(".$i.",3)\">".$i."</div>";
							}
						?>
					</div>
				</div>
			</div>
			<div class="div_hidden">
				<input id="ip_date" name="<?=fGetName("ip_date",0)?>" value="<?=$_SESSION["passport_member"]["ip_date"]?>" type="text">
			</div>
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_ip_date");?></div></div>	 
		</div>
		
		<?endif?>
				
				<!--  Нет удостоверения личности? Укажите дату  -->
				<?if(fGetActive("ip_ready")):?>
		<div class="ti_blo" id="ti_blo_ip_ready">
			 <div class="tiqa"><?=GetMessage("ip_ready");?><span class="zred"> </span>
			<?if(GetMessage("ip_ready_comment")) {?>
				<div class="qm"></div>
				
			<?}?> 
			 </div>
			<div class="qm_text"><?=GetMessage("ip_ready_comment")?></div>	
			<div  class="sel_m">
				<span><?=GetMessage("number_date")?></span>
				<!--
				<div class="ober_sel">
				<select id="b_d_ip_ready">
				<option value=''>---</option>
				<?
				for($i=1;$i<=31;$i++){
				echo "<option value='".$i."'>".$i."</option>";
				}
				?>
				</select>
				</div>
				-->
				<div id="b_d_ip_ready" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
					<div value="" onClick="sen_por_ip_ready(0,1)"></div>
						<?
						for($i=1;$i<=31;$i++){
						echo "<div value='".$i."' onClick=\"sen_por_ip_ready(".$i.",1)\">".$i."</div>";
						}
						?>
					</div>
				</div>
			</div>
			<div  class="sel_m">
				<span><?=GetMessage("month_date")?></span>
				<!--
				<div class="ober_sel">
				<select id="b_m_ip_ready">
				<option value=''>---</option>
				<?
				$ar_month=explode(",",GetMessage("ar_month"));
				for($i=0;$i<12;$i++){
				
				echo "<option value='".($i+1)."'>".trim($ar_month[$i])."</option>";
				}
				?>
				</select>
				</div>
				-->
				<div id="b_m_ip_ready" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
					<div value="" onClick="sen_por_ip_ready(0,2)"></div>
						<?
							$ar_month=explode(",",GetMessage("ar_month"));
							for($i=0;$i<12;$i++){
							
							echo "<div value='".($i+1)."' onClick=\"sen_por_ip_ready(".($i+1).",2)\">".trim($ar_month[$i])."</div>";
							}
						?>
					</div>
				</div>
			</div>
			<div  class="sel_m">

				<span><?=GetMessage("year_date")?></span>
				<!--
				<div class="ober_sel">
				
				<select id="b_y_ip_ready">
				<?if($year_ip_ready_start==$year_ip_ready_finish) {echo "<option value='".$year_ip_ready_start."'>".$year_ip_ready_start."</option>";}
				else {?>
				<option value=''>---</option>
				<?
					for($i=$year_ip_ready_start;$i<=$year_ip_ready_finish;$i++){
						echo "<option value='".$i."'>".$i."</option>";
					}
				}
				?>
				</select>
				</div>
				-->
				<div id="b_y_ip_ready" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
					<div value="" onClick="sen_por_ip_ready(0,3)"></div>
						<?
							for($i=$year_ip_ready_start;$i<=$year_ip_ready_finish;$i++){
							echo "<div value='".$i."' onClick=\"sen_por_ip_ready(".$i.",3)\">".$i."</div>";
							}
						?>
					</div>
				</div>
			</div>
			<div class="div_hidden">
				<input id="ip_ready" name="<?=fGetName("ip_ready",0)?>" value="<?=$_SESSION["passport_member"]["ip_ready"]?>" type="text">
			</div>
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("");?></div></div>	 
		</div>
		
		<?endif?>
		<br />
		</div>	
			<?}?>
			
			<? if($passport){ // открыть/закрыть блок загранпаспорта	?>
	<div class="dib_sh"><h4><?=GetMessage("block_5");?></h4>			
					<!--  Наличие загранпаспорта  -->
				<?if(fGetActive("p_nal")):?>
				<div class="ti_blo s_radio" id="ti_blo_p_nal">

					<div class="tiqa"> <?=GetMessage("p_nal");?><span class="zred"> *</span>
					<?if(GetMessage("p_nal_comment")) {?>
						<div class="qm"></div>
						
					<?}?>
					</div>
					<div class="qm_text"><?=GetMessage("p_nal_comment")?></div>	
					<div class="i_rb"><input id="p_nal_0" name="<?=fGetName("p_nal")?>" value="<?=fGetValue("p_nal",0)?>" class="radio_p_nal" type="radio" <?if(fGetAnswerCode("p_nal",0)==$_SESSION["passport_member"]["p_nal"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="p_nal_0" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("p_nal_0");?></label></div>
					<div class="i_rb"><input id="p_nal_1" name="<?=fGetName("p_nal")?>" value="<?=fGetValue("p_nal",1)?>" class="radio_p_nal" type="radio" <?if(fGetAnswerCode("p_nal",1)==$_SESSION["passport_member"]["p_nal"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="p_nal_1" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("p_nal_1");?></label></div>
					
				 <div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_p_nal");?></div></div>
				</div>
				
				<?endif?>
			
				<div id="p_nal_ok">
						<!--  Имя по загранпаспорту  -->
				<?if(fGetActive("p_name")):?>
				<div class="ti_blo s_text" id="ti_blo_p_name">
					 <div class="tiqa"><?=GetMessage("p_name");?><span class="zred"> *</span>
					<?if(GetMessage("p_name_comment")) {?>
						<div class="qm"></div>
						
					<?}?> 
					 </div>
					<div class="qm_text"><?=GetMessage("p_name_comment")?></div>	
					<input id="" name="<?=fGetName("p_name",0)?>" value="<?=$_SESSION["passport_member"]["p_name"]?>" type="text">
					<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_p_name");?></div></div>	 
				</div>
				<?endif?>
				
					<!--  Фамилия по загранпаспорту  -->
				<?if(fGetActive("p_family")):?>
				<div class="ti_blo s_text" id="ti_blo_p_family">
					 <div class="tiqa"><?=GetMessage("p_family");?><span class="zred"> *</span>
					<?if(GetMessage("p_family_comment")) {?>
						<div class="qm"></div>
						
					<?}?> 
					 </div>
					<div class="qm_text"><?=GetMessage("p_family_comment")?></div>	
					<input id="" name="<?=fGetName("p_family",0)?>" value="<?=$_SESSION["passport_member"]["p_family"]?>" type="text">
					<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_p_family");?></div></div>	 
				</div>
				<?endif?>
			
					<!--  Дата выдачи загранпаспорта  -->		
		<?if(fGetActive("p_date")):?>
		<?$ar_p_date_s=explode(".",$_SESSION["passport_member"]["p_date"]);// Разбиение даты выдачи загранпаспорта из паспорта участника на составляющие?>
		<div class="ti_blo" id="ti_blo_p_date">
			 <div class="tiqa"><?=GetMessage("p_date");?><span class="zred"> *</span>
			<?if(GetMessage("p_date_comment")) {?>
				<div class="qm"></div>
				
			<?}?> 
			 </div>
			<div class="qm_text"><?=GetMessage("p_date_comment")?></div>	
			<div  class="sel_m">
				<span><?=GetMessage("number_date")?></span>
				<!--
				<div class="ober_sel">
				<select id="b_d_p_date">
				<option value=''>---</option>
				<?
				for($i=1;$i<=31;$i++){
				echo "<option value='".$i."'";
				if((int)$ar_p_date_s[0]==$i) echo " selected";
				echo ">".$i."</option>";
				}
				?>
				</select>
				</div>
				-->
				<div id="b_d_p_date" class="ober_div">
					<div class="coon_t" value="<?=($ar_p_date_s[0])?(int)$ar_p_date_s[0]:"";?>"><?=($ar_p_date_s[0])?(int)$ar_p_date_s[0]:"";?></div><div class="coon"></div>
					<div class="coon_s">
						<?
						for($i=1;$i<=31;$i++){
						echo "<div value='".$i."' onClick=\"sen_por_p_date(".$i.",1)\">".$i."</div>";
						}
						?>
					</div>
				</div>
			</div>
			<div  class="sel_m">
				<span><?=GetMessage("month_date")?></span>
				<!--
				<div class="ober_sel">
				<select id="b_m_p_date">
				<option value=''>---</option>
				<?
				$ar_month=explode(",",GetMessage("ar_month"));
				for($i=0;$i<12;$i++){
				
				echo "<option value='".($i+1)."'";
				if((int)$ar_p_date_s[1]==($i+1)) echo " selected";
				echo ">".trim($ar_month[$i])."</option>";
				}
				?>
				</select>
				</div>
				-->
				<div id="b_m_p_date" class="ober_div">
					<div class="coon_t" value="<?=($ar_p_date_s[1])?(int)$ar_p_date_s[1]:"";?>"><?=($ar_p_date_s[1])?$ar_month[(int)$ar_p_date_s[1]-1]:"";?></div><div class="coon"></div>
					<div class="coon_s">
						<?
							$ar_month=explode(",",GetMessage("ar_month"));
							for($i=0;$i<12;$i++){
							
							echo "<div value='".($i+1)."' onClick=\"sen_por_p_date(".($i+1).",2)\">".trim($ar_month[$i])."</div>";
							}
						?>
					</div>
				</div>
			</div>
			<div  class="sel_m">

				<span><?=GetMessage("year_date")?></span>
				<!--
				<div class="ober_sel">
				<select id="b_y_p_date">
				<option value=''>---</option>
				<?
				for($i=$year_p_date_start;$i<=$year_p_date_finish;$i++){
				echo "<option value='".$i."'";
				if((int)$ar_p_date_s[2]==$i) echo " selected";
				echo ">".$i."</option>";
				}
				?>
				</select>
				</div>
				-->
				<div id="b_y_p_date" class="ober_div">
					<div class="coon_t" value="<?=($ar_p_date_s[2])?(int)$ar_p_date_s[2]:"";?>"><?=($ar_p_date_s[2])?(int)$ar_p_date_s[2]:"";?></div><div class="coon"></div>
					<div class="coon_s">
						<?
							for($i=$year_p_date_start;$i<=$year_p_date_finish;$i++){
							echo "<div value='".$i."' onClick=\"sen_por_p_date(".$i.",3)\">".$i."</div>";
							}
						?>
					</div>
				</div>
			</div>
			<div class="div_hidden">
				<input id="p_date" name="<?=fGetName("p_date",0)?>" value="<?=$_SESSION["passport_member"]["p_date"]?>" type="text">
			</div>
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_p_date");?></div></div>	 
		</div>
		<script>
			var b_d=$("#ti_blo_p_date #b_d_p_date .coon_t").attr("value");
			var b_m=$("#ti_blo_p_date #b_m_p_date .coon_t").attr("value");
			var b_y=$("#ti_blo_p_date #b_y_p_date .coon_t").attr("value");
			//sen_por_p_date(b_d,1);
			//sen_por_p_date(b_m,2);
			//sen_por_p_date(b_y,3);
		</script>
		<?endif?>
		
					<!--  Действие загранпаспорта  -->		
		<?if(fGetActive("p_due_date")):?>
		<?$ar_p_due_date_s=explode(".",$_SESSION["passport_member"]["p_due_date"]);// Разбиение даты выдачи загранпаспорта из паспорта участника на составляющие?>
		<div class="ti_blo" id="ti_blo_p_due_date">
			 <div class="tiqa"><?=GetMessage("p_due_date");?><span class="zred"> *</span>
			<?if(GetMessage("p_due_date_comment")) {?>
				<div class="qm"></div>
				
			<?}?> 
			 </div>
			<div class="qm_text"><?=GetMessage("p_due_date_comment")?></div>	
			<div  class="sel_m">
				<span><?=GetMessage("number_date")?></span>
				<!--
				<div class="ober_sel">
				<select id="b_d_p_due_date">
				<option value=''>---</option>
				<?
				for($i=1;$i<=31;$i++){
				echo "<option value='".$i."'";
				if((int)$ar_p_due_date_s[0]==$i) echo " selected";
				echo ">".$i."</option>";
				}
				?>
				</select>
				</div>
				-->
				<div id="b_d_p_due_date" class="ober_div">
					<div class="coon_t" value="<?=($ar_p_due_date_s[0])?(int)$ar_p_due_date_s[0]:"";?>"><?=($ar_p_due_date_s[0])?(int)$ar_p_due_date_s[0]:"";?></div><div class="coon"></div>
					<div class="coon_s">
						<?
						for($i=1;$i<=31;$i++){
						echo "<div value='".$i."' onClick=\"sen_por_p_due_date(".$i.",1)\">".$i."</div>";
						}
						?>
					</div>
				</div>
			</div>
			<div  class="sel_m">
				<span><?=GetMessage("month_date")?></span>
				<!--
				<div class="ober_sel">
				<select id="b_m_p_due_date">
				<option value=''>---</option>
				<?
				$ar_month=explode(",",GetMessage("ar_month"));
				for($i=0;$i<12;$i++){
				
				echo "<option value='".($i+1)."'";
				if((int)$ar_p_due_date_s[1]==($i+1)) echo " selected";
				echo ">".trim($ar_month[$i])."</option>";
				}
				?>
				</select>
				</div>
				-->
				<div id="b_m_p_due_date" class="ober_div">
					<div class="coon_t" value="<?=($ar_p_due_date_s[1])?(int)$ar_p_due_date_s[1]:"";?>"><?=($ar_p_due_date_s[1])?$ar_month[(int)$ar_p_due_date_s[1]-1]:"";?></div><div class="coon"></div>
					<div class="coon_s">
						<?
							$ar_month=explode(",",GetMessage("ar_month"));
							for($i=0;$i<12;$i++){
							
							echo "<div value='".($i+1)."' onClick=\"sen_por_p_due_date(".($i+1).",2)\">".trim($ar_month[$i])."</div>";
							}
						?>
					</div>
				</div>
			</div>
			<div  class="sel_m">

				<span><?=GetMessage("year_date")?></span>
				<!--
				<div class="ober_sel">
				<select id="b_y_p_due_date">
				<option value=''>---</option>
				<?
				for($i=$year_p_due_date_start;$i<=$year_p_due_date_finish;$i++){
				echo "<option value='".$i."'";
				if((int)$ar_p_due_date_s[2]==$i) echo " selected";
				echo ">".$i."</option>";
				}
				?>
				</select>
				</div>
				-->
				<div id="b_y_p_due_date" class="ober_div">
					<div class="coon_t" value="<?=($ar_p_due_date_s[2])?(int)$ar_p_due_date_s[2]:"";?>"><?=($ar_p_due_date_s[2])?(int)$ar_p_due_date_s[2]:"";?></div><div class="coon"></div>
					<div class="coon_s">
						<?
							for($i=$year_p_ready_start;$i<=$year_p_ready_finish;$i++){
							echo "<div value='".$i."' onClick=\"sen_por_p_due_date(".$i.",3)\">".$i."</div>";
							}
						?>
					</div>
				</div>
			</div>
			<div class="div_hidden">
				<input id="p_due_date" name="<?=fGetName("p_due_date",0)?>" value="<?=$_SESSION["passport_member"]["p_due_date"]?>" type="text">
			</div>
			<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_p_due_date");?></div></div>	 
		</div>
		<script>
			var b_d=$("#ti_blo_p_due_date #b_d_p_due_date .coon_t").attr("value");
			var b_m=$("#ti_blo_p_due_date #b_m_p_due_date .coon_t").attr("value");
			var b_y=$("#ti_blo_p_due_date #b_y_p_due_date .coon_t").attr("value");
			//sen_por_p_due_date(b_d,1);
			//sen_por_p_due_date(b_m,2);
			//sen_por_p_due_date(b_y,3);
		</script>
		<?endif?>
				
					<!--  Серия загранпаспорта  -->
				<?if(fGetActive("p_sp")):?>
				<div class="ti_blo s_text" id="ti_blo_p_sp" style="float:left;">
					 <div class="tiqa"><?=GetMessage("p_sp");?><span class="zred"> *</span>
					<?if(GetMessage("p_sp_comment")) {?>
						<div class="qm"></div>
						
					<?}?> 
					 </div>
					<div class="qm_text"><?=GetMessage("p_sp_comment")?></div>	
					<input id="" name="<?=fGetName("p_sp",0)?>" value="<?=$_SESSION["passport_member"]["p_sp"]?>" type="text">
					<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_p_sp");?></div></div>	 
				</div>
				<?endif?>
				
					<!--  Номер загранпаспорта  -->
				<?if(fGetActive("p_np")):?>
				<div class="ti_blo s_text" id="ti_blo_p_np" style="float:left;">
					 <div class="tiqa"><?=GetMessage("p_np");?><span class="zred"> *</span>
					<?if(GetMessage("p_np_comment")) {?>
						<div class="qm"></div>
						
					<?}?> 
					 </div>
					<div class="qm_text"><?=GetMessage("p_np_comment")?></div>	
					<input id="" name="<?=fGetName("p_np",0)?>" value="<?=$_SESSION["passport_member"]["p_np"]?>" type="text">
					<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_p_np");?></div></div>	 
				</div>
				<?endif?>
				
					<!--  Скан загранпаспорта  -->
						<?/*
						 // Добавляем скан из карточки участника, если есть
						if($_SESSION["passport_member"]["p_scan"] && file_exists($_SERVER["DOCUMENT_ROOT"].$_SESSION["passport_member"]["p_scan"])) {?>
						 <a class="gallery" href="<?=$_SESSION["passport_member"]["p_scan"];?>"><img align="top" title="<?=GetMessage("p_scan_passport_card")?>" src='/images/registration_event/passport_48.png' alt='scan_passport'/></a>
						 <br /><?=GetMessage("p_scan_passport_card")?><br /><?=GetMessage("select_another_file")?>
						 <?
						 $arVALUE = array();
						$FIELD_SID = "p_scan"; // символьный идентификатор вопроса
						$ANSWER_ID = $arResult["QUESTIONS"]["p_scan"]["STRUCTURE"][0]["ID"]; // ID поля ответа
						$path = $_SERVER["DOCUMENT_ROOT"].$_SESSION["passport_member"]["p_scan"]; // путь к файлу
						$arVALUE[$ANSWER_ID] = CFile::MakeFileArray($path);
						CFormResult::SetField($_GET["RESULT_ID"], $FIELD_SID, $arVALUE);
						}
						*/
					$html_p_scan= CForm::GetFileField($arResult["QUESTIONS"]["p_scan"]["STRUCTURE"][0]["ID"], 0, "FILE", 0);			
						?>
				<?if(fGetActive("p_scan")):?>
				<div class="ti_blo s_text" id="ti_blo_p_scan" style="">
					 <div class="tiqa"><?=GetMessage("p_scan");?><span class="zred"> </span>
					<?if(GetMessage("p_scan_comment")) {?>
						<div class="qm"></div>
						
					<?}?> 
					 </div>
					<div class="qm_text"><?=GetMessage("p_scan_comment")?></div>	
					<?=$html_p_scan//=fGetHTML("p_scan")?>
					<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("");?></div></div>	 
				</div>
				<?endif?>
			</div>
			<div id="p_nal_not">
						<!--  Нет загранпаспорта? Укажите дату  -->
				<?if(fGetActive("p_ready")):?>
				<div class="ti_blo" id="ti_blo_p_ready">
					 <div class="tiqa"><?=GetMessage("p_ready");?><span class="zred"> *</span>
					<?if(GetMessage("p_ready_comment")) {?>
						<div class="qm"></div>
						
					<?}?> 
					 </div>
					<div class="qm_text"><?=GetMessage("p_ready_comment")?></div>	
					<div  class="sel_m">
						<span><?=GetMessage("number_date")?></span>
						<!--
						<div class="ober_sel">
						<select id="b_d_p_ready">
						<option value=''>---</option>
						<?
						for($i=1;$i<=31;$i++){
						echo "<option value='".$i."'>".$i."</option>";
						}
						?>
						</select>
						</div>
						-->
						<div id="b_d_p_ready" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
					<div value="" onClick="sen_por_ip_ready(0,1)"></div>
						<?
						for($i=1;$i<=31;$i++){
						echo "<div value='".$i."' onClick=\"sen_por_p_ready(".$i.",1)\">".$i."</div>";
						}
						?>
					</div>
				</div>
					</div>
					<div  class="sel_m">
						<span><?=GetMessage("month_date")?></span>
						<!--
						<div class="ober_sel">
						<select id="b_m_p_ready">
						<option value=''>---</option>
						<?
						$ar_month=explode(",",GetMessage("ar_month"));
						for($i=0;$i<12;$i++){
						
						echo "<option value='".($i+1)."'>".trim($ar_month[$i])."</option>";
						}
						?>
						</select>
						</div>
						-->
						<div id="b_m_p_ready" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
					<div value="" onClick="sen_por_ip_ready(0,2)"></div>
						<?
							$ar_month=explode(",",GetMessage("ar_month"));
							for($i=0;$i<12;$i++){
							
							echo "<div value='".($i+1)."' onClick=\"sen_por_p_ready(".($i+1).",2)\">".trim($ar_month[$i])."</div>";
							}
						?>
					</div>
				</div>
					</div>
					<div  class="sel_m">

						<span><?=GetMessage("year_date")?></span>
						<!--
						<div class="ober_sel">
						<select id="b_y_p_ready">
						<?if($year_p_due_date_start==$year_p_due_date_finish) echo "<option value='".$year_p_due_date_start."'>".$year_p_due_date_start."</option>";
						else {?>
						<option value=''>---</option>
						<?
							for($i=$year_p_due_date_start;$i<=$year_p_due_date_finish;$i++){
								echo "<option value='".$i."'>".$i."</option>";
							}
						}
						?>
						</select>
						</div>
						-->
							<div id="b_y_p_ready" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
					<div value="" onClick="sen_por_ip_ready(0,3)"></div>
						<?
							for($i=$year_p_due_date_start;$i<=$year_p_due_date_finish;$i++){
							echo "<div value='".$i."' onClick=\"sen_por_p_ready(".$i.",3)\">".$i."</div>";
							}
						?>
					</div>
				</div>
					</div>
					<div class="div_hidden">
						<input id="p_ready" name="<?=fGetName("p_ready",0)?>" value="<?=$_SESSION["passport_member"]["p_ready"]?>" type="text">
					</div>
					<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_p_ready");?></div></div>	 
				</div>

				<?endif?>
			</div>
			<?}?>
		</div>	
		<div class="dib_sh"><h4><?=GetMessage("block_6");?></h4>	
			<? if($interpretation_option){ // открыть/закрыть блок выбора синхронного перевода	?>
				
						<!--  Нуждаюсь в синхронном переводе  -->
				<?if(fGetActive("interpretation")):?>
				<div class="ti_blo s_radio" id="ti_blo_interpretation">

					<div class="tiqa"> <?=GetMessage("interpretation");?><span class="zred"> *</span>
					<?if(GetMessage("interpretation_comment")) {?>
						<div class="qm"></div>
						
					<?}?>
					</div>
					<div class="qm_text"><?=GetMessage("interpretation_comment")?></div>	
					<div class="i_rb"><input id="interpretation_0" name="<?=fGetName("interpretation")?>" value="<?=fGetValue("interpretation",0)?>" class="radio_interpretation" type="radio" <?if(fGetAnswerCode("interpretation",0)==$_SESSION["passport_member"]["interpretation"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="interpretation_0" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("interpretation_0");?></label></div>
					<div class="i_rb"><input id="interpretation_1" name="<?=fGetName("interpretation")?>" value="<?=fGetValue("interpretation",1)?>" class="radio_interpretation" type="radio" <?if(fGetAnswerCode("interpretation",1)==$_SESSION["passport_member"]["interpretation"] || !$_SESSION["passport_member"]["interpretation"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="interpretation_1" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("interpretation_1");?></label></div>
					
				 <div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_interpretation");?></div></div>
				</div>
				
				<?endif?>
				
				<div id="div_interpretation_lang">
						  <!--  Язык для перевода   -->
					<?if(fGetActive("interpretation_lang")):?>
					<? include "interpretation_lang.php"; ?>
					<div class="ti_blo s_select" id="ti_blo_interpretation_lang">
					<div class="tiqa"><?=GetMessage("interpretation_lang");?><span class="zred"> *</span>
							<?if(GetMessage("interpretation_lang_comment")) {?>
								<div class="qm"></div>
								
							<?}?>
					</div>
					<div class="qm_text"><?=GetMessage("interpretation_lang_comment")?></div>	
						<!--
						<select id="sel_interpretation_lang"><option value="">---</option>
							<?php

							$coc=count($ar_interpretation_lang);
							
							for($i=0;$i<$coc;$i++){
							echo "<option value='".$ar_interpretation_lang[$i]."'>".$ar_interpretation_lang[$i]."</option>";
							}
					
							?>
							</select>
							-->
							<div id="sel_interpretation_lang" class="ober_div">
					<div class="coon_t" value="<?=$_SESSION["passport_member"]["interpretation_lang"];?>"><?=$_SESSION["passport_member"]["interpretation_lang"];?></div><div class="coon"></div>
					<div class="coon_s">
					<div onClick="sen_por_interpretation_lang('')"></div>
						<?
							$coc=count($ar_interpretation_lang);
							for($i=0;$i<$coc;$i++){
							
							echo "<div onClick=\"sen_por_interpretation_lang('".$ar_interpretation_lang[$i]."')\">".$ar_interpretation_lang[$i]."</div>";
							}
						?>
					</div>
				</div>
							<div class="div_hidden">
								<input   name="<?=fGetName("interpretation_lang",0)?>" value="<?=$_SESSION["passport_member"]["interpretation_lang"];?>" type="text">
							</div>
					<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_interpretation_lang");?></div></div>
					</div>				
					<?endif?>
					
						  <!--  Дополнительный язык для перевода   -->
					<?if(fGetActive("second_interpretation_lang")):?>
					<? include "interpretation_lang.php"; ?>
					<div class="ti_blo s_select" id="ti_blo_second_interpretation_lang">
					<div class="tiqa"><?=GetMessage("second_interpretation_lang");?><span class="zred"> </span>
							<?if(GetMessage("second_interpretation_lang_comment")) {?>
								<div class="qm"></div>
								
							<?}?>
					</div>
					<div class="qm_text"><?=GetMessage("second_interpretation_lang_comment")?></div>	
						<!--
						<select id="sel_second_interpretation_lang">
						<option value="">---</option>
							<?php

							$coc=count($ar_second_lang);
							
							for($i=0;$i<$coc;$i++){
							echo "<option value='".$ar_second_lang[$i]."'>".$ar_second_lang[$i]."</option>";
							}
					
							?>
							</select>
							-->
							<div id="sel_second_interpretation_lang" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
					<div onClick="sen_por_second_interpretation_lang('')"></div>
						<?
							$coc=count($ar_second_lang);
							for($i=0;$i<$coc;$i++){
							
							echo "<div onClick=\"sen_por_second_interpretation_lang('".$ar_second_lang[$i]."')\">".$ar_second_lang[$i]."</div>";
							}
						?>
					</div>
				</div>
							<div class="div_hidden">
								<input   name="<?=fGetName("second_interpretation_lang",0)?>" value="" type="text">
							</div>
					<div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("");?></div></div>
					</div>				
					<?endif?>
				</div>
			<?}?>
			
			
			<?if($futbolka_option) {?>
						<!--  Размерный ряд  -->
				<?if(fGetActive("d_futbolka")):?>
				<div class="ti_blo s_radio" id="ti_blo_d_futbolka">

					<div class="tiqa"> <?=GetMessage("d_futbolka");?><span class="zred"> *</span>
					<?if(GetMessage("d_futbolka_comment")) {?>
						<div class="qm"></div>
						
					<?}?>
					</div>
					<div class="qm_text"><?=GetMessage("d_futbolka_comment")?></div>	
					<div class="i_rb"><input id="d_futbolka_0" name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",0)?>" class="radio_d_futbolka" type="radio" <?if(fGetAnswerCode("d_futbolka",0)==$_SESSION["passport_member"]["d_futbolka"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="d_futbolka_0" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("d_futbolka_0");?></label></div>
					<div class="i_rb"><input id="d_futbolka_1" name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",1)?>" class="radio_d_futbolka" type="radio" <?if(fGetAnswerCode("d_futbolka",1)==$_SESSION["passport_member"]["d_futbolka"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="d_futbolka_1" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("d_futbolka_1");?></label></div>
					<div class="i_rb"><input id="d_futbolka_2" name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",2)?>" class="radio_d_futbolka" type="radio" <?if(fGetAnswerCode("d_futbolka",2)==$_SESSION["passport_member"]["d_futbolka"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="d_futbolka_2" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("d_futbolka_2");?></label></div>
					<div class="i_rb"><input id="d_futbolka_3" name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",3)?>" class="radio_d_futbolka" type="radio" <?if(fGetAnswerCode("d_futbolka",3)==$_SESSION["passport_member"]["d_futbolka"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="d_futbolka_3" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("d_futbolka_3");?></label></div>
					<div class="i_rb"><input id="d_futbolka_4" name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",4)?>" class="radio_d_futbolka" type="radio" <?if(fGetAnswerCode("d_futbolka",4)==$_SESSION["passport_member"]["d_futbolka"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="d_futbolka_4" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("d_futbolka_4");?></label></div>
					<div class="i_rb"><input id="d_futbolka_5" name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",5)?>" class="radio_d_futbolka" type="radio" <?if(fGetAnswerCode("d_futbolka",5)==$_SESSION["passport_member"]["d_futbolka"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="d_futbolka_5" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("d_futbolka_5");?></label></div>
					<div class="i_rb"><input id="d_futbolka_6" name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",6)?>" class="radio_d_futbolka" type="radio" <?if(fGetAnswerCode("d_futbolka",6)==$_SESSION["passport_member"]["d_futbolka"]) {echo "checked";$ct=1;}else $ct=0;?>><label for="d_futbolka_6" class="<?=($ct)?"l_r_a":"l_r"?>"> <?=GetMessage("d_futbolka_6");?></label></div>
					
				 <div class="in_er"><div class="ust">&#9660;</div><div class="in_er_content"><?=GetMessage("ERP_d_futbolka");?></div></div>
				</div>
				<?endif?>
			<?}?>
			<br />
		</div>	
		<div class="ti_but" id="ti_but_form_submit">
		<div class="sktt_1" style="display:none;">&#9658;&#9658;&#9658; <?=GetMessage("form_submit_but")?></div><div class="sktt_2" style="display:none;"><?=GetMessage("error_all");?></div>
			<button form="" id="" onclick="res_pro('form_submit')" type="button">&#9658;&#9658;&#9658; <?=GetMessage("form_submit_but")?></button>
		</div>
		<div style="display:none">
			<input id="but_bot_3_a" name="web_form_submit" type="submit" class="vst" value=">>>>>" style="">
		</div>
	</div>

	

	<?=$arResult["FORM_FOOTER"]?>

</div>
<script>
	var h_country=$("#h_country").val();
	sen_por_country(h_country);
	
	sen_por_ip_passport();
	//sen_por_interpretation_lang();
	//sen_por_birthday();
</script>
<?if($_SESSION["passport_member"]) echo '<script>sen_por();</script>'?>
