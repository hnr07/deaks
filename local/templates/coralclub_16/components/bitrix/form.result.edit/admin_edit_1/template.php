<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $t_step; // Шаг регистрации
?>

 <? include "../var_config.php"; // Конфигурация мероприятия?>
 <? include "../../functions/functions.php";  // Функции PHP?>
 <? include "../../vop_array.php";  // массив доступных отделов продаж?>
 
<?//id="fld_code_m"!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!?>
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
$(document).ready(function(){
	$('#date_birthday').simpleDatepicker();  // Привязать вызов календаря к полю с CSS идентификатором 

	$('#date_p_date').simpleDatepicker_2();  // Привязать вызов календаря выдача паспорта к полю с CSS идентификатором 

	$('#date_p_due_date').simpleDatepicker_3();  // Привязать вызов календаря действие паспорта к полю с CSS идентификатором 

	$('#date_p_ready').simpleDatepicker_4();  // Привязать вызов календаря готовность паспорта к полю с CSS идентификатором 

	$('#day_hotel_start').simpleDatepicker_5();  // Привязать вызов календаря начала проживания к полю с CSS идентификатором 

	$('#day_hotel_finish').simpleDatepicker_5();  // Привязать вызов календаря окончание проживания к полю с CSS идентификатором 

	$('#date_ip_ready').simpleDatepicker_6();  // Привязать вызов календаря Нет удостоверения личности? Укажите дату

	$('#date_-----').simpleDatepicker_7();  // Привязать вызов календаря окончание проживания к полю с CSS идентификатором  

});

</script>

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
<br />

	<? 
	$ar_head_form=explode(" ",$arResult["FORM_HEADER"],2);
	$head_form=$ar_head_form[0]." id=\"form_submit_step_2\" onsubmit=\"res_pro('form_submit')\" ".$ar_head_form[1];
	echo $head_form;
	?>
	<?=bitrix_sessid_post()?>
	<!-- Скрытые поля  -->
	<div class="nevid">
		<? include "../../field_form.php"; // Все поля формы?>
	</div>
<div class="zkl_b">	
	<h3 class="zkl_t"> Личные данные</h3>
	<div class="zkl_d">

					<!--  Телефон -->
		<div class="ti_blo" id="ti_blo_tel">
			 <div class="tiqa"><?=GetMessage("tel");?><span class="zred"> *</span></div>
			<div class="odi">
				 <input id="" name="<?=fGetName("tel",0)?>" value="<?=fGetResultValues("tel",0)?>"  type="text" reg="reg_phone"> 
			</div>
		</div>
		
					<!--  Мобильный телефон -->
		<div class="ti_blo" id="ti_blo_tel_2">
			 <div class="tiqa"><?=GetMessage("tel_2");?><span class="zred"> *</span></div>
			<div class="odi">
				 <input id="" name="<?=fGetName("tel_2",0)?>" value="<?=fGetResultValues("tel_2",0)?>"  type="text" reg="reg_phone"> 
			</div>
		</div>
		
					<!--  E-mail -->
		<div class="ti_blo" id="ti_blo_email">
			 <div class="tiqa"><?=GetMessage("email");?><span class="zred"> *</span></div>
			<div class="odi">
				 <input id="" name="<?=fGetName("email",0)?>" value="<?=fGetResultValues("email",0)?>"  type="text" reg="reg_mail"> 
			</div>
		</div>
		
					<!--  Доп. e-mail -->
		<div class="ti_blo" id="ti_blo_email_2">
			 <div class="tiqa"><?=GetMessage("email_2");?></div>
			<div class="odi">
				 <input id="" name="<?=fGetName("email_2",0)?>" value="<?=fGetResultValues("email_2",0)?>"  type="text" reg="if_reg_mail"> 
			</div>
		</div>
		
					<!--  Skype -->
		<div class="ti_blo" id="ti_blo_skype">
			 <div class="tiqa"><?=GetMessage("skype");?></div>
			<div class="odi">
				 <input id="" name="<?=fGetName("skype",0)?>" value="<?=fGetResultValues("skype",0)?>"  type="text" reg="if_reg_skype"> 
			</div>
		</div>
		
					<!--  Предпочтительный вид связи -->
		<div class="ti_blo" id="ti_blo_prioritet">
			 <div class="tiqa"><?=GetMessage("prioritet");?><span class="zred"> *</span></div>
			<div class="odi">
				<input id="prioritet_0" name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",0)?>" class="radio_prioritet" type="radio" <? if(fGetResultValues("prioritet")==fGetValue("prioritet",0)) echo "checked";?>><label for="prioritet_0"> <?=GetMessage("prioritet_0");?></label>
				<input id="prioritet_1" name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",1)?>" class="radio_prioritet" type="radio" <? if(fGetResultValues("prioritet")==fGetValue("prioritet",1)) echo "checked";?>><label for="prioritet_1"> <?=GetMessage("prioritet_1");?></label>
				<input id="prioritet_2" name="<?=fGetName("prioritet")?>" value="<?=fGetValue("prioritet",2)?>" class="radio_prioritet" type="radio" <? if(fGetResultValues("prioritet")==fGetValue("prioritet",2)) echo "checked";?>><label for="prioritet_2"> <?=GetMessage("prioritet_2");?></label>
			</div>
		</div>
		
					<!--  Пол  -->
		<div class="ti_blo" id="ti_blo_sex">
			 <div class="tiqa"><?=GetMessage("sex");?><span class="zred"> *</span></div>
			<div class="odi">
				<input id="sex_0" name="<?=fGetName("sex")?>" value="<?=fGetValue("sex",0)?>" class="radio_sex" type="radio" <? if(fGetResultValues("sex")==fGetValue("sex",0)) echo "checked";?>><label for="sex_0"> <?=GetMessage("sex_0");?></label>
				<input id="sex_1" name="<?=fGetName("sex")?>" value="<?=fGetValue("sex",1)?>" class="radio_sex" type="radio" <? if(fGetResultValues("sex")==fGetValue("sex",1)) echo "checked";?>><label for="sex_1"> <?=GetMessage("sex_1");?></label>
			</div>
		</div>
		
		<div onMouseMove="sen_por_birthday()" >
				<!--  Дата рождения  -->
		<div class="ti_blo" id="ti_blo_birthday" onclick="sen_por_birthday()" onkeyup="sen_por_birthday()">
			 <div class="tiqa"><?=GetMessage("birthday");?><span class="zred"> *</span></div>
			<div class="odi">
				<input id="date_birthday" name="<?=fGetName("birthday",0)?>" value="<?=fGetResultValues("birthday",0)?>" type="text"  onclick="sen_por_birthday()" onBlur="sen_por_birthday()">
			</div>
		</div>
		
				<!--  Возраст  -->
		<div class="ti_blo" id="ti_blo_age" onclick="sen_por_birthday()" onkeyup="sen_por_birthday()">
			 <div class="tiqa">Возраст<?=GetMessage("age");?><span class="zred"> *</span></div>
			<div class="odi">
				<input id="age" name="<?=fGetName("age",0)?>" value="<?=fGetResultValues("age",0)?>" type="text">
			</div>
		</div>
		
				<!--  Гражданство  -->
			<div class="ti_blos" id="ti_blo_country">
			<? include "../../list_countries.php"; ?>
			<div class="tiqa"><?=GetMessage("country");?><span class="zred"> *</span></div>

				<div class="odi">
					<select name="<?=fGetName("country",0)?>"  id="sel_country">

						<?php

						$coc=count($ar_part_world);
						for($i=0;$i<$coc;$i++)
							{
							echo "<optgroup label='".$ar_part_world[$i]."'>";
							$v_ar_c=@explode(";",$ar_country[$i]);
							asort($v_ar_c);
								foreach($v_ar_c as $val) {
								echo "<option";
								if(fGetResultValues("country",0)==$val) echo " selected";						
								echo ">".$val."</option>";
								}
							echo "</optgroup>";
							}
						?>
					</select>

				</div>
			</div>	
			
					<!--  Город проживания  -->
		<div class="ti_blo" id="ti_blo_city">
			 <div class="tiqa"><?=GetMessage("city");?><span class="zred"> *</span></div>
			<div class="odi">
				<input name="<?=fGetName("city",0)?>" value="<?=fGetResultValues("city",0)?>" type="text">
			</div>
		</div>
		</div>
		
		<?if($interpretation_option) {?>
					<!--  Нуждаюсь в синхронном переводе  -->
		<div class="ti_blo" id="ti_blo_interpretation">
			 <div class="tiqa"><?//=GetMessage("interpretation");?>Нуждаюсь в синхронном переводе<span class="zred"> *</span></div>
			<div class="odi">
				<input id="interpretation_0" name="<?=fGetName("interpretation")?>" value="<?=fGetValue("interpretation",0)?>" class="radio_interpretation" type="radio" <? if(fGetResultValues("interpretation")==fGetValue("interpretation",0)) echo "checked";?>><label for="interpretation_0"> <?=GetMessage("interpretation_0");?></label>
				<input id="interpretation_1" name="<?=fGetName("interpretation")?>" value="<?=fGetValue("interpretation",1)?>" class="radio_interpretation" type="radio" <? if(fGetResultValues("interpretation")==fGetValue("interpretation",1)) echo "checked";?>><label for="interpretation_1"> <?=GetMessage("interpretation_1");?></label>
			</div>
		</div>
		
			<!--  Язык для перевода  -->
			<div class="ti_blos" id="ti_blo_interpretation_lang">
			<? include "../../interpretation_lang.php"; ?>
			<div class="tiqa"><?//=GetMessage("interpretation_lang");?>Язык для перевода</div>

				<div class="odi">
					<select name="<?=fGetName("interpretation_lang",0)?>"  id="sel_interpretation_lang">
						<option value="">---</option>
						<?php

						$coc=count($ar_interpretation_lang);
						for($i=0;$i<$coc;$i++)
							{
							$v_ar_c=@explode(";",$ar_interpretation_lang[$i]);
							asort($v_ar_c);
								foreach($v_ar_c as $val) {
								echo "<option";
								if(fGetResultValues("interpretation_lang",0)==$val) echo " selected";						
								echo ">".$val."</option>";
								}
							}
						?>
					</select>

				</div>
			</div>	
			
			<!--  Дополнительный язык для перевода  -->
			<div class="ti_blos" id="ti_blo_second_interpretation_lang">
			<? include "../../interpretation_lang.php"; ?>
			<div class="tiqa"><?//=GetMessage("second_interpretation_lang");?>Дополнительный язык для перевода</div>

				<div class="odi">
					<select name="<?=fGetName("second_interpretation_lang",0)?>"  id="sel_second_interpretation_lang">
						<option value="">---</option>
						<?php

						$coc=count($ar_second_lang);
						for($i=0;$i<$coc;$i++)
							{
							$v_ar_c=@explode(";",$ar_second_lang[$i]);
							asort($v_ar_c);
								foreach($v_ar_c as $val) {
								echo "<option";
								if(fGetResultValues("second_interpretation_lang",0)==$val) echo " selected";						
								echo ">".$val."</option>";
								}
							}
						?>
					</select>

				</div>
			</div>	
			<?}?>
		<?if($futbolka_option) {?>	
						<!--  Размерный ряд -->
		<div class="ti_blo" id="ti_blo_d_futbolka">
			 <div class="tiqa"><?=GetMessage("d_futbolka");?><span class="zred"> *</span></div>
			<div class="odi">
				<input id="d_futbolka_0" name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",0)?>" class="radio_d_futbolka" type="radio" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",0)) echo "checked";?>><label for="d_futbolka_0"> <?=GetMessage("d_futbolka_0");?></label>
				<input id="d_futbolka_1" name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",1)?>" class="radio_d_futbolka" type="radio" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",1)) echo "checked";?>><label for="d_futbolka_1"> <?=GetMessage("d_futbolka_1");?></label>
				<input id="d_futbolka_2" name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",2)?>" class="radio_d_futbolka" type="radio" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",2)) echo "checked";?>><label for="d_futbolka_2"> <?=GetMessage("d_futbolka_2");?></label>
				<input id="d_futbolka_3" name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",3)?>" class="radio_d_futbolka" type="radio" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",3)) echo "checked";?>><label for="d_futbolka_3"> <?=GetMessage("d_futbolka_3");?></label><br />
				<input id="d_futbolka_4" name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",4)?>" class="radio_d_futbolka" type="radio" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",4)) echo "checked";?>><label for="d_futbolka_4"> <?=GetMessage("d_futbolka_4");?></label>
				<input id="d_futbolka_5" name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",5)?>" class="radio_d_futbolka" type="radio" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",5)) echo "checked";?>><label for="d_futbolka_5"> <?=GetMessage("d_futbolka_5");?></label>
				<input id="d_futbolka_6" name="<?=fGetName("d_futbolka")?>" value="<?=fGetValue("d_futbolka",6)?>" class="radio_d_futbolka" type="radio" <? if(fGetResultValues("d_futbolka")==fGetValue("d_futbolka",6)) echo "checked";?>><label for="d_futbolka_6"> <?=GetMessage("d_futbolka_6");?></label>
			
			</div>
		</div>
		<?}?>
		
	</div>
	
	

<h3 class="zkl_t"> Документы</h3>
	<div class="zkl_d">	
		<?if($ip_passport) {?>
							<!--  Серия удостоверения личности  -->
			<div class="ti_blo" id="ti_blo_ip_sp">
				 <div class="tiqa"><?=GetMessage("ip_sp");?></div>
				<div class="odi">
					<input name="<?=fGetName("ip_sp",0)?>" value="<?=fGetResultValues("ip_sp",0)?>" type="text">
				</div>
			</div>
			
							<!--  Номер удостоверения личности  -->
			<div class="ti_blo" id="ti_blo_ip_np">
				 <div class="tiqa"><?=GetMessage("ip_np");?></div>
				<div class="odi">
					<input name="<?=fGetName("ip_np",0)?>" value="<?=fGetResultValues("ip_np",0)?>" type="text">
				</div>
			</div>
			
							<!--  Скан удостоверения личности   -->
			<div class="ti_blo" id="ti_blo_ip_scan" style="height:90px;">
				 <div class="tiqa"><?=GetMessage("ip_scan");?></div>
				<div class="odi">
				<?=fGetHTML("ip_scan")?>
				
				</div>
			</div>
			
					<!--  Нет удостоверения личности? Укажите дату  -->
			<div class="ti_blo" id="ti_blo_ip_ready">
				 <div class="tiqa"><?=GetMessage("ip_ready");?><span class="zred"> *</span></div>
				<div class="odi">
					<input id="date_ip_ready" name="<?=fGetName("ip_ready",0)?>" value="<?=fGetResultValues("ip_ready",0)?>" type="text">
				</div>
			</div>
		<?}?>
		<?if($passport) {?>	
						<!--  Наличие загранпаспорта  -->
			<div class="ti_blo" id="ti_blo_p_nal">
				 <div class="tiqa"><?=GetMessage("p_nal");?><span class="zred"> *</span></div>
				<div class="odi">
					<input id="p_nal_0" name="<?=fGetName("p_nal")?>" value="<?=fGetValue("p_nal",0)?>" class="radio_p_nal" type="radio" <? if(fGetResultValues("p_nal")==fGetValue("p_nal",0)) echo "checked";?>><label for="p_nal_0"> <?=GetMessage("p_nal_0");?></label>
					<input id="p_nal_1" name="<?=fGetName("p_nal")?>" value="<?=fGetValue("p_nal",1)?>" class="radio_p_nal" type="radio" <? if(fGetResultValues("p_nal")==fGetValue("p_nal",1)) echo "checked";?>><label for="p_nal_1"> <?=GetMessage("p_nal_1");?></label>
				</div>
			</div>
			
			<div id="p_nal_ok">
								<!--  Имя по загранпаспорту   -->
				<div class="ti_blo" id="ti_blo_p_name">
					 <div class="tiqa"><?=GetMessage("p_name");?><span class="zred"> *</span></div>
					<div class="odi">
						<input name="<?=fGetName("p_name",0)?>" value="<?=fGetResultValues("p_name",0)?>" type="text">
					</div>
				</div>
				
									<!--  Фамилия по загранпаспорту  -->
				<div class="ti_blo" id="ti_blo_p_family">
					 <div class="tiqa"><?=GetMessage("p_family");?><span class="zred"> *</span></div>
					<div class="odi">
						<input name="<?=fGetName("p_family",0)?>" value="<?=fGetResultValues("p_family",0)?>" type="text">
					</div>
				</div>
				
								<!--  Дата выдачи загранпаспорта  -->
				<div class="ti_blo" id="ti_blo_p_date">
					 <div class="tiqa"><?=GetMessage("p_date");?><span class="zred"> *</span></div>
					<div class="odi">
						<input id="date_p_date" name="<?=fGetName("p_date",0)?>" value="<?=fGetResultValues("p_date",0)?>" type="text">
					</div>
				</div>
				
								<!--  Действие загранпаспорта   -->
				<div class="ti_blo" id="ti_blo_p_due_date">
					 <div class="tiqa"><?=GetMessage("p_due_date");?><span class="zred"> *</span></div>
					<div class="odi">
						<input id="date_p_due_date" name="<?=fGetName("p_due_date",0)?>" value="<?=fGetResultValues("p_due_date",0)?>" type="text">
					</div>
				</div>
				
								<!--  Серия загранпаспорта  -->
				<div class="ti_blo" id="ti_blo_p_sp">
					 <div class="tiqa"><?=GetMessage("p_sp");?><span class="zred"> *</span></div>
					<div class="odi">
						<input name="<?=fGetName("p_sp",0)?>" value="<?=fGetResultValues("p_sp",0)?>" type="text">
					</div>
				</div>
				
								<!--  Номер загранпаспорта  -->
				<div class="ti_blo" id="ti_blo_p_np">
					 <div class="tiqa"><?=GetMessage("p_np");?><span class="zred"> *</span></div>
					<div class="odi">
						<input name="<?=fGetName("p_np",0)?>" value="<?=fGetResultValues("p_np",0)?>" type="text">
					</div>
				</div>
				
									<!--  Скан загранпаспорта   -->
				<div class="ti_blo" id="ti_blo_p_scan" style="height:90px;">
					 <div class="tiqa"><?=GetMessage("p_scan");?></div>
					<div class="odi">
					<?=fGetHTML("p_scan")?>
					
					</div>
				</div>
			</div>
			<div id="p_nal_not">
							<!--  Нет загранпаспорта? Укажите дату  -->
				<div class="ti_blo" id="ti_blo_p_ready">
					 <div class="tiqa"><?=GetMessage("p_ready");?></div>
					<div class="odi">
						<input id="date_p_ready" name="<?=fGetName("p_ready",0)?>" value="<?=fGetResultValues("p_ready",0)?>" type="text">
					</div>
				</div>
			</div>
		<?}?>

	</div>
<?if (fGetResultValues("status")!=fGetValue("status",0)){?>
<h3 class="zkl_t"> Данные по оплате</h3>
<div class="zkl_d">
<?=fGetResultValues("t_money")?"<br><br>По заявке есть оплата, редактирование формы оплаты недоступно.<br><br>":""?>
<div id="oub" style="display:<?=fGetResultValues("t_money")?"none":"block"?>;">

		<!--  Форма оплаты  -->
		<div class="ti_blo" id="ti_blo_oplata">

			<div class="tiqa"> <?=GetMessage("oplata");?><span class="zred"> *</span></div>
<div class="odi">
			<input id="opl_0" name="<?=fGetName("oplata")?>" value="<?=fGetValue("oplata",0)?>" class="radio_oplata" type="radio" <? if(fGetResultValues("oplata")==fGetValue("oplata",0)) echo "checked";?>><label for="opl_0"> <?=GetMessage("oplata_0");?></label>
			<input id="opl_1" name="<?=fGetName("oplata")?>" value="<?=fGetValue("oplata",1)?>" class="radio_oplata" type="radio" <? if(fGetResultValues("oplata")==fGetValue("oplata",1)) echo "checked";?>><label for="opl_1"> <?=GetMessage("oplata_1");?></label>
		</div>
		</div>

		
				<div id="pl_div" style="">		
		
				<!--  № ЧК плательщика -->
			<div class="ti_blo" id="ti_blo_pl_chk">
				 <div class="tiqa"><?=GetMessage("pl_chk");?><span class="zred"> *</span></div>
	<div class="odi">
				 <input id="" name="<?=fGetName("pl_chk",0)?>" value="<?=fGetResultValues("pl_chk",0)?>"  type="text" reg="reg_chk"> 

</div>
			</div>

		
				<!--  Имя плательщика  -->
			<div class="ti_blo" id="ti_blo_pl_name">
				 <div class="tiqa"><?=GetMessage("pl_name");?><span class="zred"> *</span></div>
<div class="odi">
				 <input id="" name="<?=fGetName("pl_name",0)?>" value="<?=fGetResultValues("pl_name",0)?>" type="text" reg="reg_fio"> 
</div>
			</div>


			<!--  Фамилия плательщика  -->

			<div class="ti_blo" id="ti_blo_pl_family">
				 <div class="tiqa"><?=GetMessage("pl_family");?><span class="zred"> *</span></div>
<div class="odi">
				<input id="" name="<?=fGetName("pl_family",0)?>" value="<?=fGetResultValues("pl_family",0)?>" type="text" reg="reg_fio">
</div>
			</div>

			
			<!--  № телефона плательщика  -->

			<div class="ti_blo" id="ti_blo_pl_phone">
				 <div class="tiqa"><?=GetMessage("pl_phone");?><span class="zred"> *</span></div>
<div class="odi">
				<input id="" name="<?=fGetName("pl_phone",0)?>" value="<?=fGetResultValues("pl_phone",0)?>" type="text" reg="reg_phone">
				</div>
			</div>


				<!--  Рассрочка для чека  -->

			<div class="ti_blo" id="ti_blo_time_money_chk">

				<div class="tiqa"> <?=GetMessage("time_money_chk");?></div>
	<div class="odi">
				<input id="time_money_chk_0" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",0)?>" class="radio_time_money_chk" type="radio" <? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",0)) echo "checked";?>><label for="time_money_chk_0"> <?=GetMessage("time_money_chk_0");?></label>
				
				<?//if(date("Ymd") <= date_in_int($month_inst_chk_1)): // показывать до ?>
				<input id="time_money_chk_1" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",1)?>" class="radio_time_money_chk" type="radio"<? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",1)) echo "checked";?>><label for="time_money_chk_1"> <?=GetMessage("time_money_chk_1");?></label>
				<?//endif?>
				
				<?//if(date("Ymd") <= date_in_int($month_inst_chk_2)): // показывать до ?>
				<input id="time_money_chk_2" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",2)?>" class="radio_time_money_chk" type="radio"<? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",2)) echo "checked";?>><label for="time_money_chk_2"> <?=GetMessage("time_money_chk_2");?></label>
				<?//endif?>
				
				<?//if(date("Ymd") <= date_in_int($month_inst_chk_3)): // показывать до ?>
				<input id="time_money_chk_3" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",3)?>" class="radio_time_money_chk" type="radio"<? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",3)) echo "checked";?>><label for="time_money_chk_3"> <?=GetMessage("time_money_chk_3");?></label>
				<?//endif?>
				
				<?//if(date("Ymd") <= date_in_int($month_inst_chk_4)): // показывать до ?>
				<input id="time_money_chk_4" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",4)?>" class="radio_time_money_chk" type="radio"<? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",4)) echo "checked";?>><label for="time_money_chk_4"> <?=GetMessage("time_money_chk_4");?></label>
				<?//endif?>
				
				<?//if(date("Ymd") <= date_in_int($month_inst_chk_5)): // показывать до ?>
				<input id="time_money_chk_5" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",5)?>" class="radio_time_money_chk" type="radio"<? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",5)) echo "checked";?>><label for="time_money_chk_5"> <?=GetMessage("time_money_chk_5");?></label>
				<?//endif?>
				
				<?//if(date("Ymd") <= date_in_int($month_inst_chk_6)): // показывать до ?>
				<input id="time_money_chk_6" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",6)?>" class="radio_time_money_chk" type="radio"<? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",6)) echo "checked";?>><label for="time_money_chk_6"> <?=GetMessage("time_money_chk_6");?></label>
				<?//endif?>
				
				<?//if(date("Ymd") <= date_in_int($month_inst_chk_7)): // показывать до ?>
				<input id="time_money_chk_7" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",7)?>" class="radio_time_money_chk" type="radio"<? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",7)) echo "checked";?>><label for="time_money_chk_7"> <?=GetMessage("time_money_chk_7");?></label>
				<?//endif?>
				
				<?//if(date("Ymd") <= date_in_int($month_inst_chk_8)): // показывать до ?>
				<input id="time_money_chk_8" name="<?=fGetName("time_money_chk")?>" value="<?=fGetValue("time_money_chk",8)?>" class="radio_time_money_chk" type="radio"<? if(fGetResultValues("time_money_chk")==fGetValue("time_money_chk",8)) echo "checked";?>><label for="time_money_chk_8"> <?=GetMessage("time_money_chk_8");?></label>
				<?//endif?>
		</div>		

			</div>

			
			<div id="garant_div">
				
					<!--  № ЧК гаранта -->
				<div class="-ti_blo" id="ti_blo_garant_chk">
					 <div class="tiqa"><?=GetMessage("garant_chk");?><span class="zred"> *</span></div>
		<div class="odi">
					 <input id="" name="<?=fGetName("garant_chk",0)?>" value="<?=fGetResultValues("garant_chk",0)?>"  type="text" reg="reg_chk"> 
					
</div>
				</div>
				

			
					<!--  Имя гаранта  -->
				<div class="-ti_blo" id="ti_blo_garant_name">
					 <div class="tiqa"><?=GetMessage("garant_name");?><span class="zred"> *</span></div>
			
					 <input id="" name="<?=fGetName("garant_name",0)?>" value="<?=fGetResultValues("garant_name",0)?>" type="text" reg="reg_fio"> 
					 <div class="in_er"><div class="in_er_content"><?=GetMessage("ERP_garant_name");?></div></div>
				</div>


				<!--  Фамилия гаранта  -->
				<div class="-ti_blo" id="ti_blo_garant_family">
					 <div class="tiqa"><?=GetMessage("garant_family");?><span class="zred"> *</span></div>
<div class="odi">
					<input id="" name="<?=fGetName("garant_family",0)?>" value="<?=fGetResultValues("garant_family",0)?>" type="text" reg="reg_fio">
</div>
				</div>

			
			</div>
			
			
			<div class="ti_but" id="ti_but_proverka_check">
				<div class="sktt_1" style="display:none;">&#9658;&#9658;&#9658; <?=GetMessage("proverka_check_but")?></div><div class="sktt_2" style="display:none;"><?=GetMessage("error_all");?></div>
				
				<button form="" onclick="check_chk_ajax()">&#9658;&#9658;&#9658; <?=GetMessage("proverka_check_but")?></button>
			</div>
			
			<div class="div_pl_error"></div>
				
		</div>
		
				<div id="op_div">
		
		
			  <!--  Страна  -->

			<div class="ti_blos" id="ti_blo_op_country">
			<div class="tiqa"><?=GetMessage("op_country");?><span class="zred"> *</span></div>

				<div class="odi">
				<select name="<?=fGetName("op_country",0)?>"  id="sel_op_country" onChange="f_chang_country()">
				<!--<option value="">---</option>-->
			<?php
					
			//sort($ar_country_u,SORT_STRING);
			$coc=count($ar_country_u);
			
			for($i=0;$i<$coc;$i++)
				{
					echo "<option";
					if(strtolower(fGetResultValues("op_country",0))==strtolower($ar_country_u[$i])) echo " selected";
					echo ">".$ar_country_u[$i]."</option>";
				}
				
			?>
			</select>
			<div class="-div_hidden">
				<!--<input  name="<?=fGetName("op_country",0)?>" value="<?=fGetResultValues("op_country",0)?>" type="text">-->
			</div>
		</div>
		<br />в заявке <?=fGetResultValues("op_country", 0)?>
			</div>				

			 
			
			  <!--  Город  -->
			<div class="ti_blos" id="ti_blo_op_city">
			<div class="tiqa"><?=GetMessage("op_city");?><span class="zred"> *</span></div>
			<div class="odi">	
				<select  name="<?=fGetName("op_city",0)?>" id="sel_op_city" onChange="f_chang_city()">
		
				</select>
				<div class="-div_hidden">
					<!--<input  name="<?=fGetName("op_city",0)?>" value="<?=fGetResultValues("op_city",0)?>" type="text">-->
				</div>
			</div>
			<br />в заявке <?=fGetResultValues("op_city", 0)?>
			</div>				

			 
			
			  <!--  № Офиса продаж  -->
			<div class="ti_blos" id="ti_blo_op_nof">
			<div class="tiqa"><?=GetMessage("op_nof");?><span class="zred"> *</span></div>
			<div class="odi">	
				<select  name="<?=fGetName("op_nof",0)?>" id="sel_op_nof" onChange="f_chang_nof()">
		
				</select>
				<div class="-div_hidden">
					<!--<input  name="<?=fGetName("op_nof",0)?>" value="<?=fGetResultValues("op_nof",0)?>" type="text">-->
				</div>
				</div>
				<br />в заявке <?=fGetResultValues("op_nof", 0)?>
			</div>			

			 
			 <?//echo "<script>setTimeout(\"f_chang_country()\", 1000);"; echo "</script>"?>
			
			<script>//setTimeout("f_chang_country()", 1000);</script>
			
						<!--  Рассрочка для ОП  -->

			<div class="ti_blo" id="ti_blo_time_money_op">

				<div class="tiqa"> <?=GetMessage("time_money_op");?></div>
<div class="odi">
				<input id="time_money_op_0" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",0)?>" class="radio_time_money_op" type="radio" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",0)) echo "checked";?>><label for="time_money_op_0"> <?=GetMessage("time_money_op_0");?></label>
				
				<?//if(date("Ymd") <= date_in_int($month_inst_op_1)): // показывать до ?>
				<input id="time_money_op_1" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",1)?>" class="radio_time_money_op" type="radio" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",1)) echo "checked";?>><label for="time_money_op_1"> <?=GetMessage("time_money_op_1");?></label>
				<?//endif?>
				
				<?//if(date("Ymd") <= date_in_int($month_inst_op_2)): // показывать до ?>
				<input id="time_money_op_2" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",2)?>" class="radio_time_money_op" type="radio" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",2)) echo "checked";?>><label for="time_money_op_2"> <?=GetMessage("time_money_op_2");?></label>
				<?//endif?>
				
				<?//if(date("Ymd") <= date_in_int($month_inst_op_3)): // показывать до ?>
				<input id="time_money_op_3" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",3)?>" class="radio_time_money_op" type="radio" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",3)) echo "checked";?>><label for="time_money_op_3"> <?=GetMessage("time_money_op_3");?></label>
				<?//endif?>
				
				<?//if(date("Ymd") <= date_in_int($month_inst_op_4)): // показывать до ?>
				<input id="time_money_op_4" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",4)?>" class="radio_time_money_op" type="radio" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",4)) echo "checked";?>><label for="time_money_op_4"> <?=GetMessage("time_money_op_4");?></label>
				<?//endif?>
				
				<?//if(date("Ymd") <= date_in_int($month_inst_op_5)): // показывать до ?>
				<input id="time_money_op_5" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",5)?>" class="radio_time_money_op" type="radio" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",5)) echo "checked";?>><label for="time_money_op_5"> <?=GetMessage("time_money_op_5");?></label>
				<?//endif?>
				
				<?//if(date("Ymd") <= date_in_int($month_inst_op_6)): // показывать до ?>
				<input id="time_money_op_6" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",6)?>" class="radio_time_money_op" type="radio" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",6)) echo "checked";?>><label for="time_money_op_6"> <?=GetMessage("time_money_op_6");?></label>
				<?//endif?>
				
				<?//if(date("Ymd") <= date_in_int($month_inst_op_7)): // показывать до ?>
				<input id="time_money_op_7" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",7)?>" class="radio_time_money_op" type="radio" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",7)) echo "checked";?>><label for="time_money_op_7"> <?=GetMessage("time_money_op_7");?></label>
				<?//endif?>
				
				<?//if(date("Ymd") <= date_in_int($month_inst_op_8)): // показывать до ?>
				<input id="time_money_op_8" name="<?=fGetName("time_money_op")?>" value="<?=fGetValue("time_money_op",8)?>" class="radio_time_money_op" type="radio" <? if(fGetResultValues("time_money_op")==fGetValue("time_money_op",8)) echo "checked";?>><label for="time_money_op_8"> <?=GetMessage("time_money_op_8");?></label>
				<?//endif?>
</div>
			</div>

			<!--
			<div class="ti_but" id="ti_but_proverka_op">
				<div class="sktt_1" style="display:none;">&#9658;&#9658;&#9658; <?=GetMessage("proverka_op_but")?></div><div class="sktt_2" style="display:none;"><?=GetMessage("error_all");?></div>
				
				<button form="" onclick="res_pro('proverka_op')">&#9658;&#9658;&#9658; <?=GetMessage("proverka_op_but")?></button>
			</div>
			-->
			<div class="div_op_error">
		
			</div>
			
		</div>
		<script>sen_por_oplata();</script>
		<div class="ti_blo" id="ti_blo_currency_id">
		 <div class="tiqa">ID валюты:<span class="zred"> *</span></div>
		<input id="currency_id" name="<?=fGetName("currency_id",0)?>" value="" type="text" readonly>
		</div>
		<div class="ti_blo" id="ti_blo_currency">
		<div class="tiqa">SID валюты:<span class="zred"> *</span></div>
		<input id="currency" name="<?=fGetName("currency",0)?>" value="" type="text" readonly>
		</div>
		<!--Промоушен оплата:--><input id="promotion_3" name="<?=fGetName("promotion_3",0)?>" value="" type="hidden" readonly>
		
						 <!--  Курс заявки  -->
		<?
				$mv=time();
		//echo $mv;
		$FORM_ID_c = 9; // форма результатов курсов
		$arFilter_c = array();
		$arFields_c = array();
		$arFields_c[0] = array(
			"CODE"              => "code_m",     // код поля по которому фильтруем
			"FILTER_TYPE"       => "text",          // фильтруем по числовому полю
			"PARAMETER_NAME"    => "USER",          // фильтруем по введенному значению
			"VALUE"             => fGetResultValues("code_m",0),        // значение по которому фильтруем
			"EXACT_MATCH"       => "Y"              // ищем точное совпадение
		);
	
		
		$arFilter_c["FIELDS"] = $arFields_c;
				// выберем (первые) все результатов
		$rsResults_c = CFormResult::GetList($FORM_ID_c, 
			($by="s_timestamp"), 
			($order="asc"), 
			$arFilter_c, 
			$is_filtered, 
			"N", 
			false);
		
		while ($arResult_c = $rsResults_c->Fetch())
		{
				$RESULT_ID_c=$arResult_c['ID'];
				$arAnswer_c = CFormResult::GetDataByID(
				$RESULT_ID_c, 
				array('currency_number','time_stamp','course'),  // массив символьных кодов необходимых вопросов
				$ar_Res_c, 
				$ar_Answer2_c);
				if($arAnswer_c['currency_number'][0]['USER_TEXT']==fGetResultValues("currency_id",0) && $arAnswer_c['time_stamp'][0]['USER_TEXT']<=$mv) {
					$course[$arAnswer_c["time_stamp"][0]['USER_TEXT']]=$arAnswer_c["course"][0]['USER_TEXT'];
				}
		}
		//echo "<pre>";print_r($course);echo "</pre>";
		$kc= max(array_keys($course));
		
		$kp=$course[$kc];  //текущий курс нац.валюты к базовой
	
		$FORM_ID_lc=8; // форма списка валют
			$rsResults_lc = CFormResult::GetList($FORM_ID_lc, 
			($by="s_timestamp"), 
			($order="asc"), 
			$arFilter_lc, 
			$is_filtered, 
			"N", 
			false);
		while ($arResult_lc = $rsResults_lc->Fetch())
		{
				$RESULT_ID_lc=$arResult_lc['ID'];
				$arAnswer_lc = CFormResult::GetDataByID(
				$RESULT_ID_lc, 
				array('currency_number','name','code'),  // массив символьных кодов необходимых вопросов
				$ar_Res_c, 
				$ar_Answer2_lc);
			$list_course[$arAnswer_lc['currency_number'][0]['USER_TEXT']]['name']=	$arAnswer_lc['name'][0]['USER_TEXT'];
			$list_course[$arAnswer_lc['currency_number'][0]['USER_TEXT']]['code']=	$arAnswer_lc['code'][0]['USER_TEXT'];
		}
		//echo "<pre>";print_r($list_course);echo "</pre>";	
		?>


				<div class="ti_blos" id="ti_blo_m_course" style="height:150px;">
					<div class="tiqa" style=""><?=GetMessage("m_course");?><span class="zred"> *</span></div>
			
					<div class="odi" style="width:150px;"><span id="sid_c"><?=fGetResultValues("currency", 0)?></span>
						<select id="m_course" name="<?=fGetName("m_course",0)?>">
							<?
							foreach($course as $val_c) {
								echo "<option value='".$val_c."'";
								//if(fGetResultValues("m_course",0)==$val_c) {echo " style='background-color:green;color:#fff;' title='курс в заявке'";}
								if($kp==$val_c) echo " selected";
								echo ">".$val_c;
								if($kp==$val_c) echo " -текущий";
								echo "</option>";
							}
							?>
						</select>
					
						

					</div>
					<br /><br />в заявке <?=fGetResultValues("m_course", 0)?> для <?=fGetResultValues("currency", 0)?><br />
						<br />
						<div id="list_cur"><i>Изменить валюту:</i>
						<?foreach($list_course as $klc=>$vlc) {?>
							<div class="div_kbut" onclick="check_course_ajax('<?=$code_m?>',<?=$klc?>,'<?=$vlc['code']?>')" title="<?=$vlc['name']?>"><?=$vlc['code']?></div>
						<?}?>
						</div>
						

				</div>	
				


</div>
		</div>
<?}?>

<h3 class="zkl_t"> Конфигурация мероприятия</h3>
<div class="zkl_d">

<?if($viza_option) {?>
	<?if($info_viza_option) { //блок информации по визе?> 
			<!--  Информация по визе  -->
				<div class="ti_blo" id="ti_blo_info_viza" style="z-index:1;">

					<div class="tiqa"> <?=GetMessage("info_viza");?><span class="zred"> *</span></div>
					<div class="odi">
						<div id="div_p_info_viza" style="display:inline-block;"><input id="p_info_viza" name="<?=fGetName("info_viza")?>" value="<?=fGetValue("info_viza",0)?>" class="radio_info_viza" type="radio" <?if(fGetResultValues("info_viza")==fGetValue("info_viza",0)) echo "checked";?>><label for="info_viza_0"> <?=GetMessage("info_viza_0");?></label></div>
						<div id="div_p_info_viza" style="display:inline-block;"><input id="p_info_viza" name="<?=fGetName("info_viza")?>" value="<?=fGetValue("info_viza",1)?>" class="radio_info_viza" type="radio" <?if(fGetResultValues("info_viza")==fGetValue("info_viza",1)) echo "checked";?>><label for="info_viza_1"> <?=GetMessage("info_viza_1");?></label></div>
					
						<div class="div_kbut" onclick="list_viza_info()" style="margin-left:40px;"> 
							Список: <?=($flag_viza)?'"Нужна виза"':'"Не нужна виза"';?>
						</div>
					</div>
				</div>
				<div class="list_viza_info"  onclick="list_viza_info()"><?=($flag_viza)?$yes_visa:$not_visa;?></div>	
	<?}?>
	<?if($p_viza_option) { //блок оформления визы?> 
		<!--  Виза  -->
		<div class="ti_blo" id="ti_blo_p_viza">

			<div class="tiqa"> <?=GetMessage("p_viza");?><span class="zred"> *</span></div>
			<div class="odi">
				<div id="div_p_viza_0" style="display:inline-block;"><input id="p_viza_0" name="<?=fGetName("p_viza")?>" value="<?=fGetValue("p_viza",0)?>" class="radio_p_viza" type="radio" <?if(fGetResultValues("p_viza")==fGetValue("p_viza",0)) echo "checked";?>><label for="p_viza_0"> <?=GetMessage("p_viza_0");?></label></div>
				<div id="div_p_viza_1" style="display:inline-block;"><input id="p_viza_1" name="<?=fGetName("p_viza")?>" value="<?=fGetValue("p_viza",1)?>" class="radio_p_viza" type="radio" <?if(fGetResultValues("p_viza")==fGetValue("p_viza",1)) echo "checked";?>><label for="p_viza_1"> <?=GetMessage("p_viza_1");?></label></div>
			</div>
		</div>
	<?}?>
	
<?}?>

	<?if($hotel_option) {?>
	
		<?include "../hotel_array.php";?>
		
		<div class="ti_but" style="margin-top:10px;"><button form="" id="" onclick="date_v(1)">&#9658;&#9658;&#9658; <?=GetMessage("date_recommend")?> <span id="pdp_s_1"><?=$ar_hot[fGetResultValues("id_venue",0)]["date"][0]?></span> - <span id="pdp_f_1"><?=$ar_hot[fGetResultValues("id_venue",0)]["date"][1]?></span></button></div>
	<div onmouseout="f_add_day_hotel()" onmouseover="f_add_day_hotel()">	
		<!--  Дата начала проживания  -->
		<div class="ti_blo" id="ti_blo_day_hotel_start" onclick="f_add_day_hotel()" onkeyup="f_add_day_hotel()">
			 <div class="tiqa"><?=GetMessage("day_hotel_start");?><span class="zred"> *</span></div>
<div class="odi">
	
			<div class="-div_hidden">
				<input id="day_hotel_start" name="<?=fGetName("day_hotel_start",0)?>" value="<?=fGetResultValues("day_hotel_start",0)?>" type="text" onchange="f_add_day_hotel()">
			</div>
	</div> 
		</div>
		

		
		<!--  Дата окончания проживания  -->
		<div class="ti_blo" id="ti_blo_day_hotel_finish" onclick="f_add_day_hotel()"  onkeyup="f_add_day_hotel()">
			 <div class="tiqa"><?=GetMessage("day_hotel_finish");?><span class="zred"> *</span></div>
<div class="odi">
			
			<div class="-div_hidden">
				<input id="day_hotel_finish" name="<?=fGetName("day_hotel_finish",0)?>" value="<?=fGetResultValues("day_hotel_finish",0)?>" type="text" onchange="f_add_day_hotel()">
			</div>
 </div>
		</div>
		
		
		<!--  Дней проживания в отеле  -->
		<div class="ti_blo" id="ti_blo_day_hotel" onclick="f_add_day_hotel()">
			 <div class="tiqa"><?=GetMessage("day_hotel");?> <span id="dpo"> </span></div>
<div class="odi">
			<div class="-div_hidden">
			<input id="day_hotel" name="<?=fGetName("day_hotel",0)?>" value="<?=fGetResultValues("day_hotel",0)?>" type="text" reg="if_reg_day_hotel" readonly>
			</div>
	</div>
		</div>

	
		
		
		<!--  Вариант проживания  -->
		<div class="ti_blo" id="ti_blo_p_hotel">

			<div class="tiqa"> <?=GetMessage("p_hotel");?><span class="zred"> *</span></div>
			<div class="odi">
				<div id="div_p_hotel_0" style="display:inline-block;"><input id="p_hotel_0" name="<?=fGetName("p_hotel")?>" value="<?=fGetValue("p_hotel",0)?>" class="radio_p_hotel" type="radio" <?if(fGetResultValues("p_hotel")==fGetValue("p_hotel",0)) echo "checked";?>><label for="p_hotel_0"> <?=GetMessage("p_hotel_0");?></label></div>
				<div id="div_p_hotel_1" style="display:inline-block;"><input id="p_hotel_1" name="<?=fGetName("p_hotel")?>" value="<?=fGetValue("p_hotel",1)?>" class="radio_p_hotel" type="radio" <?if(fGetResultValues("p_hotel")==fGetValue("p_hotel",1)) echo "checked";?>><label for="p_hotel_1"> <?=GetMessage("p_hotel_1");?></label></div>
			</div>
		</div>
		
		<script>// sen_por_p_hotel(); </script>
		<div id="div_p_hotel">
		
			<?
				$ar_hot_v=$ar_hot[fGetResultValues("id_venue",0)]["hotel"];
				$chv=count($ar_hot_v);
				$ar_not_v=$ar_hot[fGetResultValues("id_venue",0)]["nomer"];
				$cnv=count($ar_not_v);
			?>
		
						<!--  Отель  -->
					<div class="ti_blo" id="ti_blo_hotel">
					<div class="tiqa"><?=GetMessage("hotel");?><span class="zred"> *</span></div>
<div class="odi">
						<select  id="sel_hotel" onChange="f_chang_hotel()"><option value="">---</option>
							<?
							for($i=0;$i<$chv;$i++) {
								echo "<option value='".$i."'";
								if(fGetResultValues("id_hotel",0)==$i) echo " selected ";
								echo ">".$ar_hot_v[$i]["name"]."</option>";
							}
							?>
						</select>
						<div class="-div_hidden">
							<input id="hotel" name="<?=fGetName("hotel",0)?>" value="<?=fGetResultValues("hotel",0)?>" type="hidden">
							id отеля:<input id="id_hotel"  name="<?=fGetName("id_hotel",0)?>" value="<?=fGetResultValues("id_hotel",0)?>" type="text" readonly>
						</div>
</div>
					</div>				

					<script>// sen_por_hotel(); </script>
					
						<!--  Номер  -->

					<div class="ti_blo" id="ti_blo_nomer">
					<div class="tiqa"><?=GetMessage("nomer");?><span class="zred"> *</span></div>
<div class="odi">
						<select id="sel_nomer" onChange="f_chang_nomer()"><option value="">---</option>
							<?
							for($i=0;$i<$cnv;$i++) {
								echo "<option value='".$i."'";
								if(fGetResultValues("id_nomer",0)==$i) echo " selected ";
								echo ">".$ar_not_v[$i]["note"]."</option>";
							}
							?>
						</select>
						<div class="-div_hidden">
							<input  id="nomer" name="<?=fGetName("nomer",0)?>" value="<?=fGetResultValues("nomer",0)?>" type="hidden">
							id номера:<input id="id_nomer" name="<?=fGetName("id_nomer",0)?>" value="<?=fGetResultValues("id_nomer",0)?>" type="text" readonly>
						</div>
</div>
					</div>				

					<script>// sen_por_nomer(); </script>
		
		</div>
		
</div>	
		
	<?}?>
	
	<?if($fly_option) {?>

		<!--  Вариант перелета  -->
		<div class="ti_blo" id="ti_blo_p_fly">

			<div class="tiqa"> <?=GetMessage("p_fly");?><span class="zred"> *</span></div>
			<div class="odi">
			<div id="div_p_fly_0" style="display:inline-block;"><input id="p_fly_0" name="<?=fGetName("p_fly")?>" value="<?=fGetValue("p_fly",0)?>" class="radio_p_fly" type="radio" <?if(fGetResultValues("p_fly")==fGetValue("p_fly",0)) echo "checked";?>><label for="p_fly_0"> <?=GetMessage("p_fly_0");?></label></div>
			<div id="div_p_fly_1" style="display:inline-block;"><input id="p_fly_1" name="<?=fGetName("p_fly")?>" value="<?=fGetValue("p_fly",1)?>" class="radio_p_fly" type="radio" <?if(fGetResultValues("p_fly")==fGetValue("p_fly",1)) echo "checked";?>><label for="p_fly_1"> <?=GetMessage("p_fly_1");?></label></div>
</div>
		</div>
		
		
		<div id="div_p_fly">
		
			<?include "../fly_array.php";?>
			<?
				$ar_fly_v=$ar_fly[fGetResultValues("id_venue",0)];
				$cfv=count($ar_fly_v);
				for($i=0;$i<$cfv;$i++) {
					$ar_fly_1[$i]=$ar_fly_v[$i][1];
					$ar_fly_2[$i]=$ar_fly_v[$i][2];
				}
				
				?>
			<?if($fly_synchron) { //синхронизировать перелёт?>
			
						  <!--  Перелет туда и Перелёт обратно  -->

					<div class="ti_blo" id="ti_blo_fly_1">
					<div class="tiqa"><?=GetMessage("fly_0");?><span class="zred"> *</span></div>
<div class="odi">

						<select  id="sel_fly_0" onChange="f_chang_fly_0()">
						<option value="">---</option>
							<?
							for($i=0;$i<$cfv;$i++) {
								echo "<option value='".$i."'";
								if(fGetResultValues("id_fly_1",0)==$i) echo " selected ";
								echo ">".$ar_fly_1[$i]["name"]." | ".$ar_fly_2[$i]["name"]."</option>";
							}
							?>
						</select>
						<div class="-div_hidden">
							id перелёта туда:<input id="idt_fly_1" name="<?=fGetName("id_fly_1",0)?>" value="<?=fGetResultValues("id_fly_1",0)?>" type="text" readonly>
							<input id="t_fly_1" name="<?=fGetName("fly_1",0)?>" value="<?=fGetResultValues("fly_1",0)?>" type="hidden" readonly>
							id перелёта обратно:<input id="idt_fly_2" name="<?=fGetName("id_fly_2",0)?>" value="<?=fGetResultValues("id_fly_2",0)?>" type="text" readonly>
							<input id="t_fly_2" name="<?=fGetName("fly_2",0)?>" value="<?=fGetResultValues("fly_2",0)?>" type="hidden" readonly>
							
						</div>
</div>
					</div>				

					<script>// sen_por_fly_0(); </script>
			
			<?}else{?>
					  <!--  Перелет туда  -->
				<div class="ti_blo" id="ti_blo_fly_1">
				<div class="tiqa"><?=GetMessage("fly_1");?><span class="zred"> *</span></div>
<div class="odi">

					<select  id="sel_fly_1" onChange="f_chang_fly_1()">
						<?
						for($i=0;$i<$cfv;$i++) {
							echo "<option value='".$i."'";
							if(fGetResultValues("id_fly_1",0)===$i) echo " selected ";
							echo ">".$ar_fly_1[$i]["name"]."</option>";
						}
						?>
					</select>
					<div class="-div_hidden">
						<input id="t_fly_1" name="<?=fGetName("fly_1",0)?>" value="<?=fGetResultValues("fly_1",0)?>" type="hidden">
						id перелёта туда:<input id="idt_fly_1" name="<?=fGetName("id_fly_1",0)?>" value="<?=fGetResultValues("id_fly_1",0)?>" type="text">
					</div>
</div>
				</div>				

				
					  <!--  Перелёт обратно  -->

				<div class="ti_blo" id="ti_blo_fly_2">
				<div class="tiqa"><?=GetMessage("fly_2");?><span class="zred"> *</span></div>
		
<div class="odi">
					<select  id="sel_fly_2" onChange="f_chang_fly_2()">
						<?
						for($i=0;$i<$cfv;$i++) {
							echo "<option value='".$i."'";
							if(fGetResultValues("id_fly_2",0)===$i) echo " selected ";
							echo ">".$ar_fly_2[$i]["name"]."</option>";
						}
						?>
					</select>
					<div class="-div_hidden">
						<input id="t_fly_2" name="<?=fGetName("fly_2",0)?>" value="<?=fGetResultValues("fly_2",0)?>" type="hidden">
						id перелёта обратно:<input id="idt_fly_2" name="<?=fGetName("id_fly_2",0)?>" value="<?=fGetResultValues("id_fly_2",0)?>" type="text">
					</div>
</div>
				</div>				

				<script> //sen_por_fly_1(); sen_por_fly_2(); </script>
			<?}?>
		</div>

	<?}?>
	
		<!--  <!--  Трансфер  -->  
	
		<div class="ti_blo" id="ti_blo_p_transfer">

			<div class="tiqa"> <?=GetMessage("p_transfer");?><span class="zred"> *</span></div>
<div class="odi">
			<div id="div_p_transfer_0" style="display:inline-block;"><input id="p_transfer_0" name="<?=fGetName("p_transfer")?>" value="<?=fGetValue("p_transfer",0)?>" class="radio_p_transfer" type="radio" <?if(fGetResultValues("p_transfer")==fGetValue("p_transfer",0)) echo "checked";?>><label for="d_konf_0"> <?=GetMessage("p_transfer_0");?></label></div>
			<div id="div_p_transfer_1" style="display:inline-block;"><input id="p_transfer_1" name="<?=fGetName("p_transfer")?>" value="<?=fGetValue("p_transfer",1)?>" class="radio_p_transfer" type="radio" <?if(fGetResultValues("p_transfer")==fGetValue("p_transfer",1)) echo "checked";?>><label for="d_konf_1"> <?=GetMessage("p_transfer_1");?></label></div>
</div>
		</div>

	
	<!--  Участие в конференции  -->
	<?if($d_konf_option) {?>
		<div class="ti_blo" id="ti_blo_d_konf">

			<div class="tiqa"> <?=GetMessage("d_konf");?><span class="zred"> *</span></div>
<div class="odi">
			<div id="div_d_konf_0" style="display:inline-block;"><input id="d_konf_0" name="<?=fGetName("d_konf")?>" value="<?=fGetValue("d_konf",0)?>" class="radio_d_konf" type="radio" <?if(fGetResultValues("d_konf")==fGetValue("d_konf",0)) echo "checked";?>><label for="d_konf_0"> <?=GetMessage("d_konf_0");?></label></div>
			<div id="div_d_konf_1" style="display:inline-block;"><input id="d_konf_1" name="<?=fGetName("d_konf")?>" value="<?=fGetValue("d_konf",1)?>" class="radio_d_konf" type="radio" <?if(fGetResultValues("d_konf")==fGetValue("d_konf",1)) echo "checked";?>><label for="d_konf_1"> <?=GetMessage("d_konf_1");?></label></div>
</div>
		</div>
<?}?>

		
		<?if($futbolka_option) {?>
				<!--  Футболка  -->
		<div class="ti_blo" id="ti_blo_futbolka">

			<div class="tiqa"> <?=GetMessage("futbolka");?><span class="zred"> *</span></div>
<div class="odi">
			<div id="div_futbolka_0" style="display:inline-block;"><input id="futbolka_0" name="<?=fGetName("futbolka")?>" value="<?=fGetValue("futbolka",0)?>" class="radio_futbolka" type="radio" <?if(fGetResultValues("futbolka")==fGetValue("futbolka",0)) echo "checked";?>><label for="futbolka_0"> <?=GetMessage("futbolka_0");?></label></div>
			<div id="div_futbolka_1" style="display:inline-block;"><input id="futbolka_1" name="<?=fGetName("futbolka")?>" value="<?=fGetValue("futbolka",1)?>" class="radio_futbolka" type="radio" <?if(fGetResultValues("futbolka")==fGetValue("futbolka",1)) echo "checked";?>><label for="futbolka_1"> <?=GetMessage("futbolka_1");?></label></div>
		</div>
		</div>
		<?}?>
		
				<?if($training_option) {?>
				<!--  Тренинг  -->
		<div class="ti_blo" id="ti_blo_training">

			<div class="tiqa"> <?=GetMessage("training");?><span class="zred"> *</span></div>
<div class="odi">
			<div id="div_training_0" style="display:inline-block;"><input id="training_0" name="<?=fGetName("training")?>" value="<?=fGetValue("training",0)?>" class="radio_training" type="radio" <?if(fGetResultValues("training")==fGetValue("training",0)) echo "checked";?>><label for="training_0"> <?=GetMessage("training_0");?></label></div>
			<div id="div_training_1" style="display:inline-block;"><input id="training_1" name="<?=fGetName("training")?>" value="<?=fGetValue("training",1)?>" class="radio_training" type="radio" <?if(fGetResultValues("training")==fGetValue("training",1)) echo "checked";?>><label for="training_1"> <?=GetMessage("training_1");?></label></div>
		</div>
		</div>
		<?}?>
		
				
		<!--  Участие в гала ужине  -->
		<div class="ti_blo" id="ti_blo_d_ujin">

			<div class="tiqa"> <?=GetMessage("d_ujin");?><span class="zred"> *</span></div>
<div class="odi">
			<div id="div_d_ujin_0" style="display:inline-block;"><input id="d_ujin_0" name="<?=fGetName("d_ujin")?>" value="<?=fGetValue("d_ujin",0)?>" class="radio_d_ujin" type="radio" <?if(fGetResultValues("d_ujin")==fGetValue("d_ujin",0)) echo "checked";?>><label for="d_ujin_0"> <?=GetMessage("d_ujin_0");?></label></div>
			<div id="div_d_ujin_1" style="display:inline-block;"><input id="d_ujin_1" name="<?=fGetName("d_ujin")?>" value="<?=fGetValue("d_ujin",1)?>" class="radio_d_ujin" type="radio" <?if(fGetResultValues("d_ujin")==fGetValue("d_ujin",1)) echo "checked";?>><label for="d_ujin_1"> <?=GetMessage("d_ujin_1");?></label></div>
		</div>
		</div>
		
		<?if($medical_insurance_option) {?>
				<!--  Медицинская страховка  -->
		<div class="ti_blo" id="ti_blo_medical_insurance">

			<div class="tiqa"> <?=GetMessage("medical_insurance");?><span class="zred"> *</span></div>
<div class="odi">
			<div id="div_medical_insurance_0" style="display:inline-block;"><input id="medical_insurance_0" name="<?=fGetName("medical_insurance")?>" value="<?=fGetValue("medical_insurance",0)?>" class="radio_medical_insurance" type="radio" <?if(fGetResultValues("medical_insurance")==fGetValue("medical_insurance",0)) echo "checked";?>><label for="medical_insurance_0"> <?=GetMessage("medical_insurance_0");?></label></div>
			<div id="div_medical_insurance_1" style="display:inline-block;"><input id="medical_insurance_1" name="<?=fGetName("medical_insurance")?>" value="<?=fGetValue("medical_insurance",1)?>" class="radio_medical_insurance" type="radio" <?if(fGetResultValues("medical_insurance")==fGetValue("medical_insurance",1)) echo "checked";?>><label for="medical_insurance_1"> <?=GetMessage("medical_insurance_1");?></label></div>
		</div>
		</div>
		<?}?>
		
				<!--  Скидка %  -->
		<div class="ti_blo" id="ti_blo_discount">

			<div class="tiqa"> Скидка %</div>
			<div class="odi">
				 <input id="" name="<?=fGetName("discount",0)?>" value="<?=fGetResultValues("discount",0)?>"  type="text"> 
			</div>
		</div>
		
				<!--  Наценка %  -->
		<div class="ti_blo" id="ti_blo_markup">

			<div class="tiqa"> Наценка %</div>
			<div class="odi">
				 <input id="" name="<?=fGetName("markup",0)?>" value="<?=fGetResultValues("markup",0)?>"  type="text"> 
			</div>
		</div>
		
				<!--  Минус  -->
		<div class="ti_blo" id="ti_blo_minus">

			<div class="tiqa"> Минус</div>
			<div class="odi">
				 <input id="" name="<?=fGetName("minus",0)?>" value="<?=fGetResultValues("minus",0)?>"  type="text"> 
			</div>
		</div>
		
				<!--  Плюс  -->
		<div class="ti_blo" id="ti_blo_markup">

			<div class="tiqa"> Плюс</div>
			<div class="odi">
				 <input id="" name="<?=fGetName("plus",0)?>" value="<?=fGetResultValues("plus",0)?>"  type="text"> 
			</div>
		</div>
		

				
</div>
</div>
	
	<div class="ti_but" id="ti_but_form_submit" style="margin-top:10px;">
		<div class="sktt_1" style="display:none;">&#9658;&#9658;&#9658; <?=GetMessage("form_submit_but")?></div><div class="sktt_2" style="display:none;"><?=GetMessage("error_all");?></div>
			<button form="" id="" onclick="res_pro('form_submit')" style="width:800px;height:30px;">&#9658;&#9658;&#9658; <?=GetMessage("form_submit_but")?></button>
		</div>
		<div style="display:none">
			<input id="but_bot_3_a" name="web_form_submit" type="submit" class="vst" value=">>>>>" style="">
		</div>

	<?=$arResult["FORM_FOOTER"]?>


</div>
<script>
//f_vp_sc(1);
//sen_por_oplata();
sen_por();
</script>
