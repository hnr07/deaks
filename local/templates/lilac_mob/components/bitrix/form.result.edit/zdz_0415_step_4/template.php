<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?global $t_step; // Шаг регистрации?>
<? include "var_config.php"; // Конфигурация мероприятия?>
<? include "functions.php";  // Функции PHP?>


<? include "header_form.php"; // Шапка формы ?>
<? include "note_error.php"; // Ошибки заполнения ?>

<?
function all_mesta($zal=1) {
	// Проходим по секторам
	for ($p=1; $p<=13; $p++) {
		$sector_id = $p;
		$col = 0; $col2 = 0; $col3 = 0; unset($z_mesto); 
		
		// Максимальное количество клеток
		$query = mysql_query ("SELECT max( m_shema.to - m_shema.from + m_shema.p_number) + 1 AS max FROM m_shema WHERE sector='".$sector_id."' and zal='".$zal."'") or die(mysql_error()); 
		if (mysql_num_rows($query))
		{		
			$line_max = mysql_fetch_assoc($query);
			$line_max = $line_max['max'];
			//echo "Количество клеток ".$line_max."; ";
		}
		
		// Смотрим занятые места
		$query = mysql_query ("SELECT * FROM m_occupy WHERE sector='".$sector_id."' and zal='".$zal."' ORDER BY line DESC") or die(mysql_error()); 
		if (mysql_num_rows($query))
		{	
			$i = 0;
			while($occupy = mysql_fetch_assoc($query)) {
				$i++;
				if (!empty($occupy['line']) and !empty($occupy['mesto'])) {
					$z_mesto[$occupy['line']][]= array($occupy['mesto'],$occupy['status'],$occupy['zayavka']);
				}
			}
		}
		
		
		// Построение таблицы
		$query = mysql_query ("SELECT * FROM m_shema WHERE sector='".$sector_id."' and zal='".$zal."' ORDER BY line DESC") or die(mysql_error()); 
		if (mysql_num_rows($query))
		{		
			while($shema = mysql_fetch_assoc($query)) {
				// Заполняем с последних мест т.к. таблица идет с лева на право
				for($i=$line_max;$i>=1;$i--){
					$status = "";
					$class = "class=\"case\"";
					
					// Смотрим номер места
					$mesto = $shema['from']-1+$i;
					// если отступ, то места нет
					if ($mesto >= $shema['p_from'] and $mesto < $shema['p_from']+$shema['p_number']) { 
					$mesto = "otstup"; } else {
					// если дальше отступа, начинаем счет после отступа
					if($mesto >= $shema['p_from']+$shema['p_number']) $mesto = $mesto - $shema['p_number'];
					// если мест нет в ряду больше
					if ($mesto > $shema['to']) $mesto = "no";
					}
					
					// Смотрим занятые места в данном ряду
					if (!empty($z_mesto[$shema['line']])) { 
						foreach ($z_mesto[$shema['line']] as $key=>$value)
						{
						   if ($value[0] == $mesto) { 
								{
									$col2++;
								}
							}
						}
					} 
					
				
						// если места нет, не пишим клетку
						if ($mesto <> "no") { 
							if ($mesto == "otstup") {  } else { $col++;  };
						}
					
				}	
			}
			
		} 
		$col3 = $col - $col2;
		//echo "Сектор: ".$p."; Мест: ".$col."; Занятых: ".$col2."; Свободных: ".$col3."<br>";
		$col4 = $col4 + $col3;
	}
	return $col4;
}
?>


<div id="ti_form">
<!--
<form action="/ru/registration_event/zdz_0/step_5.php?WEB_FORM_ID=23&amp;RESULT_ID=49269&amp;formresult=addok" method="POST" enctype="multipart/form-data" onsubmit="return sub_form()">
-->
<? 
$ar_head_form=explode(" ",$arResult["FORM_HEADER"],2);

$head_form=$ar_head_form[0]." onsubmit=\"return sub_form()\"  onreset=\"res_form()\" ".$ar_head_form[1];
echo $head_form;
//echo $arResult["FORM_HEADER"];
?>

<?=bitrix_sessid_post()?>

<table id="cont_t">

<tr valign="top">

<td>

<div  class="right_b">



<div class="title_step">
<div id="title_step2">&nbsp;&nbsp;<?=getMessage('TITLE_STEP4')?> &nbsp;<?=getMessage('TITLE_PR4')?></div>

</div>
<div id="tr"></div>


<!--  Если предыдущий шаг не пройден возврат на начало  -->
<?if(fGetResultValues("step")<>($t_step-1)){?>
<meta http-equiv="Refresh" content="0; URL=<?=$dir_event?>index.php">
<?}?>

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

<!--  Дата изменения  -->
<input  name="<?=fGetName("date_edit",0)?>" value="<?=date("d.m.Y")?>"  type="text">

<!--  Дата поступления заявки  -->
<input  name="<?=fGetName("claimdate",0)?>" value="<?=date("d.m.Y")?>"  type="text">

<!--  Ключ изменения  -->
<input  name="<?=fGetName("key_edit",0)?>" value="0"  type="text">

</div>

<?
// Блок дополнительной проверки поля Валюта для ОП и добавления по необходимости
	// получим данные по  вопросам
	$ar_Answer = CFormResult::GetDataByID(
		$_GET["RESULT_ID"], 
		array('op_nof','currency_id','currency'),  // массив символьных кодов необходимых вопросов
		$ar_Result, 
		$ar_Answer2);
	if(!$ar_Answer['currency'][0]["USER_TEXT"] && $ar_Answer['op_nof'][0]["USER_TEXT"]) {
		$nd=$ar_Answer['op_nof'][0]["USER_TEXT"];
		CFormResult::SetField( $_GET["RESULT_ID"], "currency", array ($ar_Answer['currency'][0]["ANSWER_ID"] => $_SESSION["AR_OP"][$nd]["cur_sid"])); // 
		CFormResult::SetField( $_GET["RESULT_ID"], "currency_id", array ($ar_Answer['currency_id'][0]["ANSWER_ID"] => $_SESSION["AR_OP"][$nd]["cur_id"])); // 
	}
?>

<?
if($passport){ // открыть/закрыть блок загранпаспорта
?>

<!--  Наличие загранпаспорта  -->
<?if(fGetActive("p_nal")):?>
<div class="ti_blo" id="ti_blo_p_nal">

<div class="ti_dig">

<div class="tiqa"> <?=getMessage("p_nal")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="p_nal_0"><input name="<?=fGetName("p_nal")?>" value="<?=fGetValue("p_nal",0)?>" class="" id="p_nal0" type="radio" <?if(fGetAnswerCode("p_nal",0)==$_SESSION["passport_member"]["p_nal"]) echo "checked"?>><label for="p_nal0"> <?=getMessage("p_nal_0");?></label></div>

	<div class="ti_dis" id="p_nal_1"><input name="<?=fGetName("p_nal")?>" value="<?=fGetValue("p_nal",1)?>" class="" id="p_nal1" type="radio" <?if(fGetAnswerCode("p_nal",1)==$_SESSION["passport_member"]["p_nal"]) echo "checked"?>><label for="p_nal1"> <?=getMessage("p_nal_1");?></label></div>


</div>


</div>
<?if(fGetComments("p_nal")):?><div class="qm"><div class="qm_text"><?=getMessage("p_nal_comment")?></div></div><?endif?>
</div>
<?endif?>

<div id="p_nal_ok" style="display:none;">
  <!--  Имя по загранпаспорту  -->
<?if(fGetActive("p_name")):?>
<div class="ti_blo" id="ti_blo_p_name">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("p_name")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("p_name")?>" value="<?=$_SESSION["passport_member"]["p_name"]?>" class="" type="text"></div>
<?if(fGetComments("p_name")):?><div class="qm"><div class="qm_text"><?=getMessage("p_name_comment")?></div></div><?endif?>
</div>
<?endif?>

  <!--  Фамилия по загранпаспорту  -->
<?if(fGetActive("p_family")):?>
<div class="ti_blo" id="ti_blo_p_family">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("p_family")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("p_family")?>" value="<?=$_SESSION["passport_member"]["p_family"]?>" class="" type="text"></div>
<?if(fGetComments("p_family")):?><div class="qm"><div class="qm_text"><?=getMessage("p_family_comment")?></div></div><?endif?>
</div>
<?endif?>

<!--  Дата выдачи загранпаспорта  -->
<?$ar_p_date_s=explode(".",$_SESSION["passport_member"]["p_date"]);// Разбиение даты выдачи загранпаспорта из паспорта участника на составляющие?>
<?if(fGetActive("p_date")):?>
<div class="ti_blo" id="ti_blo_p_date">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("p_date")?><span class="zred"> *</span></div>
	 <input id="date_vp" name="<?=fGetName("p_date")?>" value="<?=fGetValue("p_date")?>" style="display:none;" type="text" readonly>
	 	 <div class="vida" id="vida"> 
<?=getMessage("number")?>
<select id="b_d_p_date" class="b_d">
<option value=''>---</option>
<?
for($i=1;$i<=31;$i++){
echo "<option value='".$i."'";
if((int)$ar_p_date_s[0]==$i) echo " selected";
echo ">".$i."</option>";
}
?>
</select>

<?=getMessage("month")?>
<select id="b_m_p_date" class="b_m">
<option value=''>---</option>
<?
//$ar_month=array("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");
for($i=0;$i<12;$i++){
//$to=getMessage($ar_month[$i]);
$to=getMessage("month".($i+1));
echo "<option value='".($i+1)."'";
if((int)$ar_p_date_s[1]==$i) echo " selected";
echo ">".$to."</option>";
}
?>
</select>

<?=getMessage("year")?>
<select id="b_y_p_date" class="b_y">
<option value=''>---</option>
<?
for($i=2000;$i<=2014;$i++){
echo "<option value='".$i."'";
if((int)$ar_p_date_s[2]==$i) echo " selected";
echo ">".$i."</option>";
}
?>
</select>
<!--<div class="but_vida" onclick="f_vida()">выбрать</div>-->
</div>
	 </div>
<?if(fGetComments("p_date")):?><div class="qm"><div class="qm_text"><?=getMessage("p_date_comment")?></div></div><?endif?>
</div>
<?endif?>


<!--  Действие загранпаспорта  -->
<?$ar_p_due_date_s=explode(".",$_SESSION["passport_member"]["p_due_date"]);// Разбиение даты действия загранпаспорта из паспорта участника на составляющие?>
<?if(fGetActive("p_due_date")):?>
<div class="ti_blo" id="ti_blo_p_due_date">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("p_due_date")?><span class="zred"> *</span></div>
	  <input id="date_dp" name="<?=fGetName("p_due_date")?>" value="<?=fGetValue("p_due_date")?>" style="display:none;" type="text" readonly>
	 	 	 <div class="vida" id="vida"> 
<?=getMessage("number")?>
<select id="b_d_p_due_date" class="b_d">
<option value=''>---</option>
<?
for($i=1;$i<=31;$i++){
echo "<option value='".$i."'";
if((int)$ar_p_due_date_s[0]==$i) echo " selected";
echo ">".$i."</option>";
}
?>
</select>

<?=getMessage("month")?>
<select id="b_m_p_due_date" class="b_m">
<option value=''>---</option>
<?
//$ar_month=array("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");
for($i=0;$i<12;$i++){
//$to=getMessage($ar_month[$i]);
$to=getMessage("month".($i+1));
echo "<option value='".($i+1)."'";
if((int)$ar_p_due_date_s[1]==($i+1)) echo " selected";
echo ">".$to."</option>";
}
?>
</select>

<?=getMessage("year")?>
<select id="b_y_p_due_date" class="b_y">
<option value=''>---</option>
<?
for($i=2014;$i<=2025;$i++){
echo "<option value='".$i."'";
if((int)$ar_p_due_date_s[2]==$i) echo " selected";
echo ">".$i."</option>";
}
?>
</select>
<!--<div class="but_vida" onclick="f_vida()">выбрать</div>-->
</div>
	</div>
<?if(fGetComments("p_due_date")):?><div class="qm"><div class="qm_text"><?=getMessage("p_due_date_comment")?></div></div><?endif?>
</div>
<?endif?>

<div class="not_f"><img src="/images/registration_event/info_24.png"><div class="luch"></div><?=getMessage("DUE_DATE_1")?></div>

  <!--  Серия и номер загранпаспорта  -->
<?if(fGetActive("p_sn")):?>
<div class="ti_blo" id="ti_blo_p_sn">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("p_sn")?><span class="zred"> *</span></div><input id="" name="<?=fGetName("p_sn")?>" value="<?=$_SESSION["passport_member"]["p_sn"]?>" class="" type="text"></div>
<?if(fGetComments("p_sn")):?><div class="qm"><div class="qm_text"><?=getMessage("p_sn_comment")?></div></div><?endif?>
</div>
<?endif?>
 
 <!--  Скан загранпаспорта  -->
<?
 // Добавляем скан из карточки участника, если есть
if($_SESSION["passport_member"]["p_scan"] && file_exists($_SERVER["DOCUMENT_ROOT"].$_SESSION["passport_member"]["p_scan"])) {?>
 <a class="gallery" href="<?=$_SESSION["passport_member"]["p_scan"];?>"><img align="top" title="<?=getMessage("scan_passport_card")?>" src='/images/registration_event/passport_48.png' alt='scan_passport'/></a>
 <br /><?=getMessage("scan_passport_card")?><br /><?=getMessage("select_another_file")?>
 <?
 $arVALUE = array();
$FIELD_SID = "p_scan"; // символьный идентификатор вопроса
$ANSWER_ID = $arResult["QUESTIONS"]["p_scan"]["STRUCTURE"][0]["ID"]; // ID поля ответа
$path = $_SERVER["DOCUMENT_ROOT"].$_SESSION["passport_member"]["p_scan"]; // путь к файлу
$arVALUE[$ANSWER_ID] = CFile::MakeFileArray($path);
CFormResult::SetField($_GET["RESULT_ID"], $FIELD_SID, $arVALUE);
}
$html_p_scan= CForm::GetFileField($arResult["QUESTIONS"]["p_scan"]["STRUCTURE"][0]["ID"], 0, "FILE", 0);			
?>
 
<?if(fGetActive("p_scan")):?>
<div class="ti_blo" id="ti_blo_p_scan">
<div class="ti_dig"><div class="tiqa"><?=getMessage("p_scan")?></div><?=$html_p_scan//=fGetHTML("p_scan")?></div>
<?if(fGetComments("p_scan")):?><div class="qm"><div class="qm_text"><?=getMessage("p_scan_comment")?></div></div><?endif?>
</div>
<?endif?>

</div>

<div id="p_nal_not" style="display:none;">
<!--  Нет паспорта? Укажите дату  -->
<?if(fGetActive("p_ready")):?>
<div class="ti_blo" id="ti_blo_p_ready">
	 <div class="ti_dig"><div class="tiqa"><?=getMessage("p_ready")?><span class="zred"> *</span></div>
	 <input id="date_rp" name="<?=fGetName("p_ready")?>" value="<?=fGetValue("p_ready")?>" style="display:none;" type="text"></div>
	 	 	 	 <div class="vida" id="vida"> 
<?=getMessage("number")?>
<select id="b_d_p_ready" class="b_d">
<option value=''>---</option>
<?
for($i=1;$i<=31;$i++){
echo "<option value='".$i."'>".$i."</option>";
}
?>
</select>

<?=getMessage("month")?>
<select id="b_m_p_ready" class="b_m">
<option value=''>---</option>
<?
//$ar_month=array("jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec");
for($i=0;$i<12;$i++){
//$to=getMessage($ar_month[$i]);
$to=getMessage("month".($i+1));
echo "<option value='".($i+1)."'";
echo ">".$to."</option>";
}
?>
</select>

<?=getMessage("year")?>
<select id="b_y_p_ready" class="b_y">
<!--<option value=''>---</option>-->
<?
for($i=2014;$i<=2025;$i++){
echo "<option value='".$i."'>".$i."</option>";
}
?>
</select>
<!--<div class="but_vida" onclick="f_vida()">выбрать</div>-->
</div>
	 
<?if(fGetComments("p_ready")):?><div class="qm"><div class="qm_text"><?=getMessage("p_ready_comment")?></div></div><?endif?>
</div>
<?endif?>
<div class="not_f"><img src="/images/registration_event/info_24.png"><div class="luch"></div><?=getMessage("NPUD")?></div>
 </div>

 
<!--  Оформление визы  -->
<?if(fGetActive("p_viza")):?>
<div class="ti_blo" id="ti_blo_p_viza">

<div class="ti_dig">

<div class="tiqa"> <?=getMessage("p_viza")?><span class="zred"> *</span></div>

<div class="vsta">

	<div class="ti_dis" id="p_viza_0"><input name="<?=fGetName("p_viza")?>" value="<?=fGetValue("p_viza",0)?>" class="" id="p_viza0" type="radio"><label for="p_viza0"> <?=getMessage("p_viza_0");?></label></div>

	<div class="ti_dis" id="p_viza_1"><input name="<?=fGetName("p_viza")?>" value="<?=fGetValue("p_viza",1)?>" class="" id="p_viza1" type="radio"><label for="p_viza1"> <?=getMessage("p_viza_1");?></label></div>
	
	<div class="ti_dis" id="p_viza_2"><input name="<?=fGetName("p_viza")?>" value="<?=fGetValue("p_viza",2)?>" class="" id="p_viza2" type="radio"><label for="p_viza2"> <?=getMessage("p_viza_2pp");?></label></div>

</div>

</div>
<?if(fGetComments("p_viza")):?><div class="qm"><div class="qm_text"><?=getMessage("p_viza_comment")?></div></div><?endif?>

<input type="hidden" id="yes_visa" value="<?=$yes_visa?>">
<input type="hidden" id="yes_visa_m" value="<?=$yes_visa_m?>">
<input type="hidden" id="not_visa" value="<?=$not_visa?>">
</div>
<?endif?>
<div class="not_f"><img src="/images/registration_event/info_24.png"><div class="luch"></div>

<?//=getMessage("NOTE_VISA_1")?> 

<span style="color:red;">
<?=getMessage("NOTE_VISA_2")?> 
</span>
</div>
<?}?>


</div>


</div>



</td></tr></table>

<? include "button_step.php"; // Кнопки перехода к следующему шагу ?>

 </form>
 </div>

<br/><br/><br/><br/><br/>

