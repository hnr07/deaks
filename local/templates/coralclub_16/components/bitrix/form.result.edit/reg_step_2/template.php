<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $t_step; // Шаг регистрации
?>
 <? include "var_config.php"; // Конфигурация мероприятия?>
 <? include "functions.php";  // Функции PHP?>
 <? include "vop_array.php";  // массив доступных отделов продаж?>

<? include "header_form.php"; // Шапка формы ?>
<?// include "note_error.php"; // Ошибки заполнения ?>

<!--  Если предыдущий шаг не пройден возврат на начало  -->
<?if(fGetResultValues("step")<>($t_step-1)){?>
<meta http-equiv="Refresh" content="0; URL=<?="/".LANGUAGE_ID.$dir_event?>index.php">
<?}?>
<br />
<div class="div_form" style="">
	<div id="tr"></div>
<div class="stan">
<?if (fGetResultValues("status")==fGetValue("status",0)):?>
<div class="tipetu"><span class="tpt"><?=GetMessage("status");?>:</span> <span class="npt"><?=GetMessage("status_0");?></span></div>
<div class="tipetu"><span class="tpt"><?=GetMessage("chk");?>:</span> <span class="npt"><?=fGetResultValues("chk")?><br /><?=fGetResultValues("family")?> <?=fGetResultValues("name")?></span></div>
<?endif?>
<?if (fGetResultValues("status")==fGetValue("status",1)):?>
<div class="tipetu"><span class="tpt"><?=GetMessage("status");?>:</span> <span class="npt"><?=GetMessage("status_1");?></span></div>
<div class="tipetu"><span class="tpt"><?=GetMessage("chk");?>:</span> <span class="npt"><?=fGetResultValues("chk")?><br /><?=fGetResultValues("family")?> <?=fGetResultValues("name")?></span></div>
<div class="tipetu"><br /><span class="tpt"><?=GetMessage("kem_priglashen_chk");?>:</span><span class="npt"><?=fGetResultValues("kem_priglashen_chk")?><br /><?=fGetResultValues("kem_priglashen_family")?> <?=fGetResultValues("kem_priglashen_name")?></span></div>
<?endif?>
<?if (fGetResultValues("status")==fGetValue("status",2)):?>
<div class="tipetu"><span class="tpt"><?=GetMessage("status");?>:</span> <span class="npt"><?=GetMessage("status_2");?></span></div>
<div class="tipetu"><span class="tpt"><?=GetMessage("kem_priglashen_chk");?>:</span> <span class="npt"><?=fGetResultValues("kem_priglashen_chk")?><br /><?=fGetResultValues("kem_priglashen_family")?> <?=fGetResultValues("kem_priglashen_name")?></span></div>
<?$spl_chk=fGetResultValues("kem_priglashen_chk"); $spl_family=fGetResultValues("kem_priglashen_family"); $spl_name=fGetResultValues("kem_priglashen_name");?>
<?endif?>
</div>
	<? 
	$ar_head_form=explode(" ",$arResult["FORM_HEADER"],2);
	$head_form=$ar_head_form[0]." id=\"form_submit_step_2\" onsubmit=\"res_pro('form_submit')\" ".$ar_head_form[1];
	echo $head_form;
	?>
	<?=bitrix_sessid_post()?>
	
	<!-- Скрытые поля  -->
	<div class="nevid">
	<? include "field_form.php"; // Все поля формы?>
	<!-- Скрытые поля для перезаписи значений  -->
<!--  Шаг регистрации  -->
<input id="t_step" name="<?=fGetName("step",0)?>" value="<?=$t_step?>"  type="text">

	</div>
	
		<?if($viza_option) { //блок выбора визы?> 
		<div class="dib_sh"><h4><?=GetMessage("block_4");?></h4>
			<?if($info_viza_option) { //блок информации по визе?> 
				<!--  Информация по визе  -->
				<?if(fGetActive("info_viza")):?>
				<div class="ti_blo s_radio" id="ti_blo_info_viza">
					<div class="tiqa"> <?=GetMessage("info_viza");?>: <b><?=fGetResultValues("country")?></b><span class="zred"> </span>
					<?if(GetMessage("info_viza_comment")) {?>
						<div class="qm"></div>	
					<?}?>
					</div>
					<div class="qm_text"><?=GetMessage("info_viza_comment")?></div>
					
					<?if($flag_viza) {?>
						<?if(strstr($yes_visa,fGetResultValues("country"))){?><div id="div_info_viza_0" class="div-radio i_rb"><input id="info_viza_0" name="<?=fGetName("info_viza")?>" value="<?=fGetValue("info_viza",0)?>" class="radio_info_viza" type="radio" checked><label for="info_viza_0" class="l_r_a"> <?=GetMessage("info_viza_0");?></label></div>
					<? } else {?><div id="div_info_viza_1" class="div-radio i_rb"><input id="info_viza_1" name="<?=fGetName("info_viza")?>" value="<?=fGetValue("info_viza",1)?>" class="radio_info_viza" type="radio" checked><label for="info_viza_1" class="l_r_a"> <?=GetMessage("info_viza_1");?></label></div>
						<?}?>
					<?} else {?>
						<?if(!strstr($not_visa,fGetResultValues("country"))){?><div id="div_info_viza_0" class="div-radio i_rb"><input id="info_viza_0" name="<?=fGetName("info_viza")?>" value="<?=fGetValue("info_viza",0)?>" class="radio_info_viza" type="radio" checked><label for="info_viza_0" class="l_r_a"> <?=GetMessage("info_viza_0");?></label></div>
					<?} else {?><div id="div_info_viza_1" class="div-radio i_rb"><input id="info_viza_1" name="<?=fGetName("info_viza")?>" value="<?=fGetValue("info_viza",1)?>" class="radio_info_viza" type="radio" checked><label for="info_viza_1" class="l_r_a"> <?=GetMessage("info_viza_1");?></label></div><?}?>
					<?}?>
				 <div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_info_viza");?></div></div>
				</div>
				<?endif?>
			<?}?>	
			<?if($p_viza_option) { //блок оформления визы ?> 		
				<!--  Виза  -->
				<?if(fGetActive("p_viza")):?>
				<div class="ti_blo s_radio" id="ti_blo_p_viza">
					<div class="tiqa"> <?=GetMessage("p_viza");?><span class="zred"> *</span>
					<?if(GetMessage("p_viza_comment")) {?>
						<div class="qm"></div>	
					<?}?>
					</div>
					<div class="qm_text"><?=GetMessage("p_viza_comment")?></div>
					
					<div id="div_p_viza_0" class="div-radio i_rb"><input id="p_viza_0" name="<?=fGetName("p_viza")?>" value="<?=fGetValue("p_viza",0)?>" class="radio_p_viza" type="radio" checked><label for="p_viza_0" class="l_r_a"> <?=GetMessage("p_viza_0");?></label></div>
					<?if($p_viza_sam) {?><div id="div_p_viza_1" class="div-radio i_rb"><input id="p_viza_1" name="<?=fGetName("p_viza")?>" value="<?=fGetValue("p_viza",1)?>" class="radio_p_viza" type="radio"><label for="p_viza_1" class="l_r"> <?=GetMessage("p_viza_1");?></label></div><?}?>
				 <div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_p_viza");?></div></div>
				</div>
				<?endif?>
			<?}?>
		</div>
		<?}?>
	
	<?if($hotel_option) { //блок выбора варианта проживания?> 
	<div class="dib_sh"><h4><?=GetMessage("block_1");?></h4>
		<?include "hotel_array.php";?>
		<?if($stat_hotel) include "meter_hotel.php";?>
		
		<!--  Вариант проживания  -->
		<?if(fGetActive("p_hotel")):?>
		<div class="ti_blo s_radio" id="ti_blo_p_hotel">
			<div class="tiqa"> <?=GetMessage("p_hotel");?><span class="zred"> *</span>
			<?if(GetMessage("p_hotel_comment")) {?>
				<div class="qm"></div>	
			<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("p_hotel_comment")?></div>
			
			<div id="div_p_hotel_0" class="div-radio i_rb"><input id="p_hotel_0" name="<?=fGetName("p_hotel")?>" value="<?=fGetValue("p_hotel",0)?>" class="radio_p_hotel" type="radio" checked><label for="p_hotel_0" class="l_r_a"> <?=GetMessage("p_hotel_0");?></label></div>
			<?if($hotel_sam) {?><div id="div_p_hotel_1" class="div-radio i_rb"><input id="p_hotel_1" name="<?=fGetName("p_hotel")?>" value="<?=fGetValue("p_hotel",1)?>" class="radio_p_hotel" type="radio"><label for="p_hotel_1" class="l_r"> <?=GetMessage("p_hotel_1");?></label></div><?}?>
		 <div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_p_hotel");?></div></div>
		</div>
		<?endif?>
		
		<div id="div_p_hotel">
				
		<div class="ti_but"> <?=($hotel_date)?GetMessage("date_sure"):GetMessage("date_recommend")?> <span id="pdp_s_1"><?=$ar_hot[fGetResultValues("id_venue",0)]["date"][0]?></span> - <span id="pdp_f_1"><?=$ar_hot[fGetResultValues("id_venue",0)]["date"][1]?></span><?if(!$hotel_date) {?><button form="" id="date_recommend" onclick="date_v(1)"> ►►► <?=GetMessage("vibor")?></button><?}?></div>
		
		<!--  Дата начала проживания  -->
		<?if(fGetActive("day_hotel_start")):?>
		<div class="ti_blo" id="ti_blo_day_hotel_start">
			<div class="hotmin">
				 <div class="tiqa"><?=GetMessage("day_hotel_start");?><span class="zred"> *</span>
				 <?if(GetMessage("day_hotel_start_comment")) {?>
					<div class="qm"></div>
				<?}?>
				 </div>
				<div class="qm_text"><?=GetMessage("day_hotel_start_comment")?></div>	
				<div  class="sel_m">
					<span><?=GetMessage("number_date")?></span>
					<!--
					<div class="ober_sel">
					<select id="b_d_day_hotel_start">
					<option value=''>---</option>
					<?
					for($i=1;$i<=31;$i++){
					echo "<option value='".$i."'";
					echo ">".$i."</option>";
					}
					?>
					</select>
					</div>
					-->
					<div id="b_d_day_hotel_start" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
						<?
						for($i=1;$i<=31;$i++){
						echo "<div value='".$i."' onClick=\"sen_por_day_hotel_start(".$i.",1)\">".$i."</div>";
						}
						?>
					</div>
				</div>
				</div>
				<div  class="sel_m">
					<span><?=GetMessage("month_date")?></span>
					<!--
					<div class="ober_sel">
					<select id="b_m_day_hotel_start">
					<option value=''>---</option>
					<?
					$ar_month=explode(",",GetMessage("ar_month"));
					for($i=0;$i<12;$i++){
					
					echo "<option value='".($i+1)."'";
					echo ">".trim($ar_month[$i])."</option>";
					}
					?>
					</select>
					</div>
					-->
					<div id="b_m_day_hotel_start" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
						<?
							$ar_month=explode(",",GetMessage("ar_month"));
							for($i=0;$i<12;$i++){
							
							echo "<div value='".($i+1)."' onClick=\"sen_por_day_hotel_start(".($i+1).",2)\">".trim($ar_month[$i])."</div>";
							}
						?>
					</div>
				</div>
				</div>
				<div  class="sel_m">

					<span><?=GetMessage("year_date")?></span>
					<!--
					<div class="ober_sel">
					<select id="b_y_day_hotel_start">
					<option value=''>---</option>
					<?
					for($i=$year_day_hotel_start_start;$i<=$year_day_hotel_start_finish;$i++){
					echo "<option value='".$i."'";
					echo ">".$i."</option>";
					}
					?>
					</select>
					</div>
					-->
					<div id="b_y_day_hotel_start" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
						<?
							for($i=$year_day_hotel_start_start;$i<=$year_day_hotel_start_finish;$i++){
							echo "<div value='".$i."' onClick=\"sen_por_day_hotel_start(".$i.",3)\">".$i."</div>";
							}
						?>
					</div>
				</div>
				</div>
			</div>
			<div class="div_hidden">
				<input id="day_hotel_start" name="<?=fGetName("day_hotel_start",0)?>" value="" type="text">
			</div>
			<div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_day_hotel_start");?></div></div>	 
		</div>
		
		<?endif?>
		
		<!--  Дата окончания проживания  -->
		<?if(fGetActive("day_hotel_finish")):?>
		<div class="ti_blo" id="ti_blo_day_hotel_finish">
			<div class="hotmin">
				 <div class="tiqa"><?=GetMessage("day_hotel_finish");?><span class="zred"> *</span>
				 <?if(GetMessage("day_hotel_finish_comment")) {?>
					<div class="qm"></div>
					
				<?}?>
				 </div>
				<div class="qm_text"><?=GetMessage("day_hotel_finish_comment")?></div>	
				<div  class="sel_m">
					<span><?=GetMessage("number_date")?></span>
					<!--
					<div class="ober_sel">
					<select id="b_d_day_hotel_finish">
					<option value=''>---</option>
					<?
					for($i=1;$i<=31;$i++){
					echo "<option value='".$i."'";
					echo ">".$i."</option>";
					}
					?>
					</select>
					</div>
					-->
					<div id="b_d_day_hotel_finish" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
						<?
						for($i=1;$i<=31;$i++){
						echo "<div value='".$i."' onClick=\"sen_por_day_hotel_finish(".$i.",1)\">".$i."</div>";
						}
						?>
					</div>
				</div>
				</div>
				<div  class="sel_m">
					<span><?=GetMessage("month_date")?></span>
					<!--
					<div class="ober_sel">
					<select id="b_m_day_hotel_finish">
					<option value=''>---</option>
					<?
					$ar_month=explode(",",GetMessage("ar_month"));
					for($i=0;$i<12;$i++){
					
					echo "<option value='".($i+1)."'";
					echo ">".trim($ar_month[$i])."</option>";
					}
					?>
					</select>
					</div>
					-->
					<div id="b_m_day_hotel_finish" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
						<?
							$ar_month=explode(",",GetMessage("ar_month"));
							for($i=0;$i<12;$i++){
							
							echo "<div value='".($i+1)."' onClick=\"sen_por_day_hotel_finish(".($i+1).",2)\">".trim($ar_month[$i])."</div>";
							}
						?>
					</div>
				</div>
				</div>
				<div  class="sel_m">

					<span><?=GetMessage("year_date")?></span>
					<!--
					<div class="ober_sel">
					<select id="b_y_day_hotel_finish">
					<option value=''>---</option>
					<?
					for($i=$year_day_hotel_finish_start;$i<=$year_day_hotel_finish_finish;$i++){
					echo "<option value='".$i."'";
					echo ">".$i."</option>";
					}
					?>
					</select>
					</div>
					-->
					<div id="b_y_day_hotel_finish" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
						<?
							for($i=$year_day_hotel_finish_start;$i<=$year_day_hotel_finish_finish;$i++){
							echo "<div value='".$i."' onClick=\"sen_por_day_hotel_finish(".$i.",3)\">".$i."</div>";
							}
						?>
					</div>
				</div>
				</div>
			</div>
			<div class="div_hidden">
				<input id="day_hotel_finish" name="<?=fGetName("day_hotel_finish",0)?>" value="" type="text">
			</div>
			<div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_day_hotel_finish");?></div></div>	 
		</div>
		
		<?endif?>
		
		<!--  Дней проживания в отеле  -->
		<?if(fGetActive("day_hotel")):?>
		<div class="ti_blo" id="ti_blo_day_hotel" style="min-height:30px;">
			 <div class="tiqa"><?=GetMessage("day_hotel");?> <b><span id="dpo"></span></b></div>
		
			<div class="div_hidden" style="">
			<input id="" name="<?=fGetName("day_hotel",0)?>" value="" type="text" reg="if_reg_day_hotel">
			</div>
			<div class="in_er" style="top:-40px;"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_day_hotel");?></div></div>	 
		</div>
		<?endif?>
	
		
			<?
				$ar_hot_v=$ar_hot[fGetResultValues("id_venue",0)]["hotel"];    // массив отелей
				$chv=count($ar_hot_v);
				$ar_not_v=$ar_hot[fGetResultValues("id_venue",0)]["nomer"];   // массив номеров
				
				$cnv=count($ar_not_v);
			?>
			<input type="hidden" id="hotel_date" value="<?=$hotel_date?>">
			<input type="hidden" id="fly_date" value="<?=$fly_date?>">
		<script> sen_por_p_hotel(); </script>
		
		<div class="not_f"><?=GetMessage("text_info_1");?></div>

						<!--  Отель  -->
					<?if(fGetActive("hotel")):?>
					<div class="ti_blo s_select" id="ti_blo_hotel">
					<div class="tiqa"><?=GetMessage("hotel");?><span class="zred"> *</span>
					<?if(GetMessage("hotel_comment")) {?>
								<div class="qm"></div>
								
							<?}?>
					</div>
						<div class="qm_text"><?=GetMessage("hotel_comment")?></div>		
							<!--
						<div class="ober_sel">
						<select  id="sel_hotel" onChange="f_chang_hotel()"><option value="">---</option>
							<?
							for($i=0;$i<$chv;$i++) {
								echo "<option value='".$i."'>".$ar_hot_v[$i]["name"]."</option>";
							}
							?>
						</select>
						</div>
						-->
						<?if($chv>1) {?>
								<div id="sel_hotel" class="ober_div">
									<div class="coon_t" value=""></div><div class="coon"></div>
									<div class="coon_s">
										<?
											for($i=0;$i<$chv;$i++) {
											echo "<div value='".$i."' onClick=\"sen_por_hotel(".$i.",'".$ar_hot_v[$i]["name"]."')\">".$ar_hot_v[$i]["name"];
											if($stat_hotel) echo" (".GetMessage("ostatok")." ".$sum_nom_os[fGetResultValues("id_venue",0)][$i].")";
											echo "</div>";
											}
										?>
									</div>
								</div>
								<div class="div_hidden">
									<input  name="<?=fGetName("hotel",0)?>" value="" type="text">
									<input  name="<?=fGetName("id_hotel",0)?>" value="" type="text">
								</div>
					
								
					
							<?if($sel_hotel_did!=='') {?>
								<script>
								
									var hp="<?=$ar_hot_v[$sel_hotel_did]["name"]?>";
									var sp="<?=$sel_hotel_did?>";
									$("#ti_blo_hotel input:text:eq(0)").val(hp);
									$("#ti_blo_hotel input:text:eq(1)").val(sp);
									$("#sel_hotel .coon_t").html(hp);
									$("#sel_hotel .coon_t").attr("value",sp);
								
								</script>
							<?}?>
						<?} else {?>
							<div  class="ober_div" style="">
								<div class="coon_t" value=""><?=$ar_hot_v[0]["name"]?></div>
							</div>
							
							<div class="div_hidden" style="border:solid 1px red;">
								<input  name="<?=fGetName("hotel",0)?>" value="<?=$ar_hot_v[0]["name"]?>" type="text">
								<input  name="<?=fGetName("id_hotel",0)?>" value="0" type="text">
							</div>
						<?}?>
					<div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_hotel");?></div></div>
					</div>	
					<?endif?>
						<!--  Номер  -->
					<?if(fGetActive("nomer")):?>
					<div class="ti_blo s_select" id="ti_blo_nomer">
					<div class="tiqa"><?=GetMessage("nomer");?><span class="zred"> *</span>
					<?if(GetMessage("nomer_comment")) {?>
						<div class="qm"></div>
					<?}?>
					</div>
					<div class="qm_text"><?=GetMessage("nomer_comment")?><!--<div class="mm"></div>--></div>	
							
							<!--
						<div class="ober_sel">
						<select  id="sel_nomer" onChange="f_chang_nomer()"><option value="">---</option>
							<?
							for($i=0;$i<$cnv;$i++) {
								echo "<option value='".$i."'>".$ar_not_v[$i]["note"]."</option>";
							}
							?>
						</select>
						</div>
						-->
						<div id="sel_nomer" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
						<?
							for($i=0;$i<$cnv;$i++) {
							if($ar_not_v[$i]["vizi"]) echo "<div value='".$i."' onClick=\"sen_por_nomer(".$i.",'".$ar_not_v[$i]["note"]."')\">".$ar_not_v[$i]["note"]."</div>";
							}
						?>
					</div>
				</div>
						<div class="div_hidden">
							<input  name="<?=fGetName("nomer",0)?>" value="" type="text">
							<input  name="<?=fGetName("id_nomer",0)?>" value="" type="text">
						</div>
					<div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_nomer");?></div></div>
					</div>				
					<?endif?>
					<script> //sen_por_nomer(); </script>
		
		</div>
	<br />	
	</div>
	
		<script>//f_vp_sc_hotel(1);</script>
	<?}?>
	
	<?if($fly_option) {?>
	
	<div class="dib_sh"><h4><?=GetMessage("block_2");?></h4>
		<!--  Вариант перелета  -->
		<?if(fGetActive("p_fly")):?>
		<div class="ti_blo s_radio" id="ti_blo_p_fly">

			<div class="tiqa"> <?=GetMessage("p_fly");?><span class="zred"> *</span>
			<?if(GetMessage("p_fly_comment")) {?>
				<div class="qm"></div>
					
			<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("p_fly_comment")?></div>
			<div id="div_p_fly_0" class="div-radio i_rb"><input id="p_fly_0" name="<?=fGetName("p_fly")?>" value="<?=fGetValue("p_fly",0)?>" class="radio_p_fly" type="radio" checked><label for="p_fly_0" class="l_r_a"> <?=GetMessage("p_fly_0");?></label></div>
			<div id="div_p_fly_1" class="div-radio i_rb"><input id="p_fly_1" name="<?=fGetName("p_fly")?>" value="<?=fGetValue("p_fly",1)?>" class="radio_p_fly" type="radio"><label for="p_fly_1" class="l_r"> <?=GetMessage("p_fly_1");?></label></div>
		 <div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_p_fly");?></div></div>
		</div>
		<?endif?>
		
		<div id="div_p_fly">
		
		<div class="not_f"><?=GetMessage("text_info_2");?></div>
		
			<?include "fly_array.php";?>
			<?include "meter_fly.php";?>
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
					<?if(fGetActive("fly_1")):?>
					<div class="ti_blo s_select" id="ti_blo_fly_1">
					<div class="tiqa"><?=GetMessage("fly_0");?><span class="zred"> *</span>
					<?if(GetMessage("fly_0_comment")) {?>
								<div class="qm"></div>
								
							<?}?>
					</div>
					<div class="qm_text"><?=GetMessage("fly_0_comment")?></div>			
							<!--
						<div class="ober_sel">
						<select  id="sel_fly_0" onChange="f_chang_fly_0()"><option value="">---</option>
							<?
							for($i=0;$i<$cfv;$i++) {
								echo "<option value='".$i."'>✈ ".$ar_fly_1[$i]["name"]." | ✈ ".$ar_fly_2[$i]["name"]."</option>";
							}
							?>
						</select>
						</div>
						-->
						<div id="sel_fly_0" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
						<?
							for($i=0;$i<$cfv;$i++) {
								if($sum_fly_os[fGetResultValues("id_venue",0)][$i][1]>0) {								
									echo "<div value='".$i."' onClick=\"sen_por_fly_0('".$i."','".$ar_fly_1[$i]["name"]." | ".$ar_fly_2[$i]["name"]."')\" title='".$ar_fly_1[$i]["note"]." | ".$ar_fly_2[$i]["note"]."'>".$ar_fly_1[$i]["name"]." | ".$ar_fly_2[$i]["name"];
									if($stat_fly) echo" (".GetMessage("ostatok")." ".$sum_fly_os[fGetResultValues("id_venue",0)][$i][1].")";
									echo "</div>";
								}
								else {
									echo "<span>".$ar_fly_1[$i]["name"]." | ".$ar_fly_2[$i]["name"];
									if($stat_fly) echo" (<span>".GetMessage("not_m")."</span>)";
									echo "</span>";
								}
							}
						?>
					</div>
				</div>
						<div class="div_hidden">
							<input  name="<?=fGetName("fly_1",0)?>" value="" type="text">
							<input  name="<?=fGetName("id_fly_1",0)?>" value="" type="text">
							<input  name="<?=fGetName("fly_2",0)?>" value="" type="text">
							<input  name="<?=fGetName("id_fly_2",0)?>" value="" type="text">
						</div>
					<div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_fly_0");?></div></div>
					</div>				
					<?endif?>
					<script>// sen_por_fly_0(); </script>
			
			<?}else{?>
					  <!--  Перелет туда  -->
				<?if(fGetActive("fly_1")):?>
				<div class="ti_blo s_select" id="ti_blo_fly_1">
				<div class="tiqa"><?=GetMessage("fly_1");?><span class="zred"> *</span>
				<?if(GetMessage("fly_1_comment")) {?>
							<div class="qm"></div>
							
						<?}?>
				</div>
					<div class="qm_text"><?=GetMessage("fly_1_comment")?></div>		
						<!--
					<div class="ober_sel">
					<select  id="sel_fly_1" onChange="f_chang_fly_1()">
						<?
						for($i=0;$i<$cfv;$i++) {
							echo "<option value='".$i."'>✈ ".$ar_fly_1[$i]["name"]."</option>";
						}
						?>
					</select>
					</div>
					-->
					<div id="sel_fly_1" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
						<?
							for($i=0;$i<$cfv;$i++) {
								if($sum_fly_os[fGetResultValues("id_venue",0)][$i][1]>0) {	
									echo "<div value='".$i."' onClick=\"sen_por_fly_1(".$i.",'".$ar_fly_1[$i]["name"]."')\" title='".$ar_fly_1[$i]["note"]."'>".$ar_fly_1[$i]["name"];
									if($stat_fly) echo" (".GetMessage("ostatok")." ".$sum_fly_os[fGetResultValues("id_venue",0)][$i][1].")";
									echo "</div>";
								}
								else {
									echo "<span>".$ar_fly_1[$i]["name"];
									if($stat_fly) echo" (<span>".GetMessage("not_m")."</span>)";
									echo "</span>";
								}
							}
						?>
					</div>
				</div>
					<div class="div_hidden">
						<input  name="<?=fGetName("fly_1",0)?>" value="" type="text">
						<input  name="<?=fGetName("id_fly_1",0)?>" value="" type="text">
					</div>
				<div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_fly_1");?></div></div>
				</div>				
				<?endif?>
				
					  <!--  Перелёт обратно  -->
				<?if(fGetActive("fly_2")):?>
				<div class="ti_blo s_select" id="ti_blo_fly_2">
				<div class="tiqa"><?=GetMessage("fly_2");?><span class="zred"> *</span>
				<?if(GetMessage("fly_2_comment")) {?>
							<div class="qm"></div>
								
						<?}?>
				</div>
					<div class="qm_text"><?=GetMessage("fly_2_comment")?></div>	
						<!--
					<div class="ober_sel">
					<select  id="sel_fly_2" onChange="f_chang_fly_2()">
						<?
						for($i=0;$i<$cfv;$i++) {
							echo "<option value='".$i."'>✈ ".$ar_fly_2[$i]["name"]."</option>";
						}
						?>
					</select>
					</div>
					-->
					<div id="sel_fly_2" class="ober_div">
					<div class="coon_t" value=""></div><div class="coon"></div>
					<div class="coon_s">
						<?
							for($i=0;$i<$cfv;$i++) {
								if($sum_fly_os[fGetResultValues("id_venue",0)][$i][2]>0) {	
									echo "<div value='".$i."' onClick=\"sen_por_fly_2(".$i.",'".$ar_fly_2[$i]["name"]."')\" title='".$ar_fly_2[$i]["note"]."'>".$ar_fly_2[$i]["name"];
									if($stat_fly) echo" (".GetMessage("ostatok")." ".$sum_fly_os[fGetResultValues("id_venue",0)][$i][2].")";
									echo "</div>";
								}
								else {
									echo "<span>".$ar_fly_2[$i]["name"];
									if($stat_fly) echo" (<span>".GetMessage("not_m")."</span>)";
									echo "</span>";
								}
							}
						?>
					</div>
				</div>
					<div class="div_hidden">
						<input  name="<?=fGetName("fly_2",0)?>" value="" type="text">
						<input  name="<?=fGetName("id_fly_2",0)?>" value="" type="text">
					</div>
				<div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_fly_2");?></div></div>
				</div>				
				<?endif?>
				<script> sen_por_fly_1(); sen_por_fly_2(); </script>
			<?}?>
		</div>
		<!--  Трансфер  -->
		<?if(fGetActive("p_transfer")):?>
		<div class="ti_blo s_radio" id="ti_blo_p_transfer">

			<div class="tiqa"> <?=GetMessage("p_transfer");?><span class="zred"> *</span>
			<?if(GetMessage("p_transfer_comment")) {?>
				<div class="qm"></div>
					
			<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("p_transfer_comment")?></div>
			<div id="div_p_transfer_0" class="div-radio i_rb"><input id="p_transfer_0" name="<?=fGetName("p_transfer")?>" value="<?=fGetValue("p_transfer",0)?>" class="radio_p_transfer" type="radio" checked><label for="p_transfer_0" class="l_r_a"> <?=GetMessage("p_transfer_0");?></label></div>
			<div id="div_p_transfer_1" class="div-radio i_rb"><input id="p_transfer_1" name="<?=fGetName("p_transfer")?>" value="<?=fGetValue("p_transfer",1)?>" class="radio_p_transfer" type="radio"><label for="p_transfer_1" class="l_r"> <?=GetMessage("p_transfer_1");?></label></div>
		 <div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_p_transfer");?></div></div>
		</div>
		<?endif?>
	</div>
	
	<script>f_vp_sc_fly(1);</script>
	<?}?>
	<div class="dib_sh"><h4><?=GetMessage("block_3");?></h4>

	<?if($d_konf_option) {?>
	<!--  Участие в конференции  -->
		<?if(fGetActive("d_konf")):?>
		<div class="ti_blo s_radio" id="ti_blo_d_konf">

			<div class="tiqa"> <?=GetMessage("d_konf");?><span class="zred"> *</span>
			<?if(GetMessage("d_konf_comment")) {?>
				<div class="qm"></div>
				
			<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("d_konf_comment")?></div>	
			<div id="div_d_konf_0" class="div-radio i_rb"><input id="d_konf_0" name="<?=fGetName("d_konf")?>" value="<?=fGetValue("d_konf",0)?>" class="radio_d_konf" type="radio"><label for="d_konf_0" class="l_r"> <?=GetMessage("d_konf_0");?></label></div>
			<div id="div_d_konf_1" class="div-radio i_rb"><input id="d_konf_1" name="<?=fGetName("d_konf")?>" value="<?=fGetValue("d_konf",1)?>" class="radio_d_konf" type="radio"><label for="d_konf_1" class="l_r"> <?=GetMessage("d_konf_1");?></label></div>
		 <div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_d_konf");?></div></div>
		</div>
		<?endif?>
	<?}?>	
		<?if($futbolka_option) {?>
			<!--  Футболка  -->
		<?if(fGetActive("futbolka")):?>
		<div class="ti_blo s_radio" id="ti_blo_futbolka">

			<div class="tiqa"> <?=GetMessage("futbolka");?><span class="zred"> *</span>
			<?if(GetMessage("futbolka_comment")) {?>
				<div class="qm"></div>
				
			<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("futbolka_comment")?></div>	
			<div class="i_rb" id="div_futbolka_0"><input id="futbolka_0" name="<?=fGetName("futbolka")?>" value="<?=fGetValue("futbolka",0)?>" class="radio_futbolka" type="radio"><label for="futbolka_0"  class="l_r"> <?=GetMessage("futbolka_0");?></label></div>
			<div class="i_rb" id="div_futbolka_1"><input id="futbolka_1" name="<?=fGetName("futbolka")?>" value="<?=fGetValue("futbolka",1)?>" class="radio_futbolka" type="radio"><label for="futbolka_1"  class="l_r"> <?=GetMessage("futbolka_1");?></label></div>
			
		 <div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_d_futbolka");?></div></div>
		</div>
		<?endif?>
		
	<script> sen_por_d_konf(); </script>	
	<?}?>
	
	<?if($training_option) {?>
	<!--  Тренинг  -->
		<?if(fGetActive("training")):?>
		<div class="ti_blo s_radio" id="ti_blo_training">

			<div class="tiqa"> <?=GetMessage("training");?><span class="zred"> *</span>
			<?if(GetMessage("training_comment")) {?>
				<div class="qm"></div>
				
			<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("training_comment")?></div>

			<?if(fGetResultValues("status")==fGetValue("status",0)) { // Участник принимает участие обязательно?>
				<div class="i_rb" id="div_training_0"><input id="training_0" name="<?=fGetName("training")?>" value="<?=fGetValue("training",0)?>" class="radio_training" type="radio" checked><label for="training_0"  class="l_r_a"> <?=GetMessage("training_0");?></label></div>		
			<?} else { // Приглашённый принимает участие по желанию?>
				<div class="i_rb" id="div_training_0"><input id="training_0" name="<?=fGetName("training")?>" value="<?=fGetValue("training",0)?>" class="radio_training" type="radio" checked><label for="training_0"  class="l_r_a"> <?=GetMessage("training_0");?></label></div>	
				<div class="i_rb" id="div_training_0"><input id="training_1" name="<?=fGetName("training")?>" value="<?=fGetValue("training",1)?>" class="radio_training" type="radio"><label for="training_1"  class="l_r"> <?=GetMessage("training_1");?></label></div>
			<?}?>
			
			
		 <div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_training");?></div></div>
		</div>
		<?endif?>
	<?}?>
	
	<?if($d_ujin_option) {?>
	<!--  Участие в гала ужине  -->
		<?if(fGetActive("d_ujin")):?>
		<div class="ti_blo s_radio" id="ti_blo_d_ujin">

			<div class="tiqa"> <?=GetMessage("d_ujin");?><span class="zred"> *</span>
			<?if(GetMessage("d_ujin_comment")) {?>
				<div class="qm"></div>
				
			<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("d_ujin_comment")?></div>
			<?if($d_ujin_type) { // Обязательное участие?>
				<div id="div_d_ujin_0" class="div-radio i_rb"><input id="d_ujin_0" name="<?=fGetName("d_ujin")?>" value="<?=fGetValue("d_ujin",0)?>" class="radio_d_ujin" type="radio" checked><label for="d_ujin_0" class="l_r_a"> <?=GetMessage("d_ujin_0");?></label></div>
			<? } else {?>
				<div id="div_d_ujin_0" class="div-radio i_rb"><input id="d_ujin_0" name="<?=fGetName("d_ujin")?>" value="<?=fGetValue("d_ujin",0)?>" class="radio_d_ujin" type="radio"><label for="d_ujin_0" class="l_r"> <?=GetMessage("d_ujin_0");?></label></div>
				<div id="div_d_ujin_1" class="div-radio i_rb"><input id="d_ujin_1" name="<?=fGetName("d_ujin")?>" value="<?=fGetValue("d_ujin",1)?>" class="radio_d_ujin" type="radio"><label for="d_ujin_1" class="l_r"> <?=GetMessage("d_ujin_1");?></label></div>
			<?}?>
		 <div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_d_ujin");?></div></div>
		</div>
		<?endif?>
	<?}?>
	
	<?if($tour_1_option) {?>	
		<!--  Участие в экскурсии  -->
		<?if(fGetActive("tour_1")):?>
		<div class="ti_blo s_radio" id="ti_blo_tour_1">

			<div class="tiqa"> <?=GetMessage("tour_1");?><span class="zred"> *</span>
			<?if(GetMessage("tour_1_comment")) {?>
				<div class="qm"></div>
				
			<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("tour_1_comment")?></div>
			<?if($tour_1_type) { // Обязательное участие?>
				<div id="div_tour_1_0" class="i_rb"><input id="tour_1_0" name="<?=fGetName("tour_1")?>" value="<?=fGetValue("tour_1",0)?>" class="radio_tour_1" type="radio" checked><label for="tour_1_0" class="l_r_a"> <?=GetMessage("tour_1_0");?></label></div>
			<? } else {?>
				<div id="div_tour_1_0" class="i_rb"><input id="tour_1_0" name="<?=fGetName("tour_1")?>" value="<?=fGetValue("tour_1",0)?>" class="radio_tour_1" type="radio" checked><label for="tour_1_0" class="l_r_a"> <?=GetMessage("tour_1_0");?></label></div>
				<div id="div_tour_1_1" class="i_rb"><input id="tour_1_1" name="<?=fGetName("tour_1")?>" value="<?=fGetValue("tour_1",1)?>" class="radio_tour_1" type="radio"><label for="tour_1_1" class="l_r"> <?=GetMessage("tour_1_1");?></label></div>
			<?}?>
		 <div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_tour_1");?></div></div>
		</div>
		<?endif?>
	<?}?>
		
		<?if($medical_insurance_option) {?>
		<!--  Медицинская страховка  -->
		<?if(fGetActive("medical_insurance")):?>
		<div class="ti_blo s_radio" id="ti_blo_medical_insurance">

			<div class="tiqa"> <?=GetMessage("medical_insurance");?><span class="zred"> *</span>
			<?if(GetMessage("medical_insurance_comment")) {?>
				<div class="qm"></div>
				
			<?}?>
			</div>
			<div class="qm_text"><?=GetMessage("medical_insurance_comment")?></div>	
			<div id="div_medical_insurance_0" class="div-radio i_rb"><input id="medical_insurance_0" name="<?=fGetName("medical_insurance")?>" value="<?=fGetValue("medical_insurance",0)?>" class="radio_medical_insurance" type="radio"><label for="medical_insurance_0" class="l_r"> <?=GetMessage("medical_insurance_0");?></label></div>
			<div id="div_medical_insurance_1" class="div-radio i_rb"><input id="medical_insurance_1" name="<?=fGetName("medical_insurance")?>" value="<?=fGetValue("medical_insurance",1)?>" class="radio_medical_insurance" type="radio"><label for="medical_insurance_1" class="l_r"> <?=GetMessage("medical_insurance_1");?></label></div>
		 <div class="in_er"><div class="ust">▼</div><div class="in_er_content"><?=GetMessage("ERP_medical_insurance");?></div></div>
		</div>
		<?endif?>
		<?}?>

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

