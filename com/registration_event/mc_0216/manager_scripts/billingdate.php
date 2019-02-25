<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
include "../var_config.php"; 
$APPLICATION->SetTitle($title_m);

function dat_dat($date1, $date2) {
$ar_date1=explode(".", $date1);
$ar_date2=explode(".", $date2);
$p_date1=($ar_date1[2].$ar_date1[1].$ar_date1[0])*1;
$p_date2=($ar_date2[2].$ar_date2[1].$ar_date2[0])*1;
if($p_date1>$p_date2) return false;
else return true;
}
?> 

<link rel="stylesheet" type="text/css" href="/css/manager_scripts.css" />
<script type="text/javascript" src="/js/manager_scripts/manager_scripts.js"></script>
<br/>
<div class="manager_scripts">
<div class="a_vozo"><a href="./">Все служебные обработчики</a><div id="sz"><div><img src="/images/registration_event/d.gif"></div></div></div>
<h2><?$APPLICATION->ShowTitle();?></h2>
<br/>
<div class="chte"><b>Страница правки даты выставления счёта.</b> <span onclick="f_ps('txt2')"><u>Что это? >>></u></span><div id="txt2" class="txt" onclick="f_us('txt2')">
Данная страница использует для обработки результаты формы заявок на мероприятие "<?$APPLICATION->ShowTitle();?>".<br/>
 Кнопка "Править дату выставления счёта" в заявках, у которых нет даты выставления счёта или дата выставления счета меньше, чем дата поступления заявки записывает в поле заявки "Дата выставления счёта"(billingdate) значение поля "Дата поступления заявки"(claimdate). Заявка учавствуют в передаче данных в базу. Заявка без даты поступления в автоматическом режиме не изменяется т. к. требуется индивидуальное решение. Фильтр позволяет ограничить изменения по статусу заявки и/или по номеру(id).
 <br/><br/><u>закрыть</u></div></div>

  <form method="POST">

 <?
if(CModule::IncludeModule("form")){ 
$FORM_ID = $form_m;
 // получим список всех статусов формы, соответствующих фильтру
	$rsStatuses = CFormStatus::GetList(
		$FORM_ID, 
		$by="s_id", 
		$order="desc", 
		$arFilter, 
		$is_filtered
		);
	while ($arStatus = $rsStatuses->Fetch())
	{
		//echo "<pre>"; print_r($arStatus); echo "</pre>";
		//Создадим массивы статусов и их наименований, кроме статуса Поступила
		if($arStatus["ID"]!=$status_new){
		$ar_status_id[]=$arStatus["ID"];
		$ar_status_title[]=$arStatus["TITLE"];
		}
	}
	$sit=count($ar_status_id);

?>
<div class="chte">
<b>Фильтр:</b><span onclick="f_ps('txt5')"> <u>Что это? >>></u></span><div id="txt5" class="txt" onclick="f_us('txt5')">
Фильтр позволяет выбрать для обработки все статусы или один из выпадающего списка. Номера заявок вносятся в поле одной строкой. Для разделения номеров используйте разделитель ","(запятая).
 <br/><br/><u>закрыть</u></div>
 <div class="f_van">

 <div class="t_van">
 Статус<br/>
 <select name="van_status">
 <option value="0" <?if($_POST['van_status']==0) echo " selected";?>>Все статусы</option>
 <?
 for($i=0;$i<$sit;$i++){
	 echo "<option value='".$ar_status_id[$i]."'";
	 if($_POST['van_status']==$ar_status_id[$i]) echo " selected";
	 echo">".$ar_status_title[$i]."</option>";
 }
 ?>
 </select>
 </div>
 <div class="t_van">
 №№ заявок<br/>
 <input type="text" name="van_list" value="<?echo $_POST['van_list']?>">
 </div>
 </div>
</div>
 <div class="chte"><input class="buts" type="submit" name="prp" value="Предварительный просмотр" onclick="f_sz()"> <span onclick="f_ps('txt4')"><u>Что это? >>></u></span><div id="txt4" class="txt" onclick="f_us('txt4')">
 Кнопка "Предварительный просмотр" проверяет в каких заявках нет даты поступления, нет даты выставления счёта или дата выставления счёта меньше даты поступления заявки.
 <br/><br/><u>закрыть</u></div></div>
 
<div class="chte">
 <input class="buts" type="submit" name="proso" value="Править дату выставления счёта" onclick="f_sz()">
</div>
 </form>
 
<?php

//echo $_POST['proso']." >> ".$_POST['prp'];
if(isset($_POST['proso']) || isset($_POST['prp'])) {

if($_POST['van_status']) $f_status=$_POST['van_status'];
else $f_status=implode("|", $ar_status_id);
$f_id=str_replace(",","|",$_POST['van_list']);

// фильтр по полям результата
	$arFilter = array(
	    "ID"                   => $f_id,              // ID результата
	  //  "ID_EXACT_MATCH"       => "N",               // вхождение
		"STATUS_ID"            => $f_status,          // статус Ожидает оплаты
	   // "TIMESTAMP_1"          => "10.10.2003",      // изменен "с"
	   // "TIMESTAMP_2"          => "15.10.2003",      // изменен "до"
	  //  "DATE_CREATE_1"        => "10.10.2003",      // создан "с"
	  //  "DATE_CREATE_2"        => "12.10.2003",      // создан "до"
	  //  "REGISTERED"           => "Y",               // был зарегистрирован
	  //  "USER_AUTH"            => "N",               // не был авторизован
	  //  "USER_ID"              => "45 | 35",         // пользователь-автор
	  //  "USER_ID_EXACT_MATCH"  => "Y",               // точное совпадение
	  //  "GUEST_ID"             => "4456 | 7768",     // посетитель-автор
	 //   "SESSION_ID"           => "456456 | 778768", // сессия
		);
		
		// фильтр по вопросам
		
$arFields = array();
/*
$arFields[] = array(
    "CODE"              => "billingdate",     // код поля по которому фильтруем
    "FILTER_TYPE"       => "text",          // фильтруем по текстовому полю
    "PARAMETER_NAME"    => "USER",          // фильтруем по введенному значению
    "VALUE"             => "15.03.2013",        // значение по которому фильтруем
    "EXACT_MATCH"       => "N"              // ищем вхождение, ищем точное совпадение-"Y"
    );
	
$arFields[] = array(
    "CODE"              => "oplata",     // код поля по которому фильтруем
    "FILTER_TYPE"       => "text",          // фильтруем по текстовому полю
    "PARAMETER_NAME"    => "ANSWER_TEXT",          // фильтруем по полю ANSWER_TEXT
    "VALUE"             => "Нал в ОП",        // значение по которому фильтруем
    "EXACT_MATCH"       => "N"              // ищем вхождение, ищем точное совпадение-"Y"
    );
	*/
	$arFilter["FIELDS"] = $arFields;
	
			// выберем (первые) все результатов
	$rsResults = CFormResult::GETList($FORM_ID, 
		($by="s_timestamp"), 
		($order="desc"), 
		$arFilter, 
		$is_filtered, 
		"Y",
		false);
	$i=0;

?>
<table class="tmbl">
	 <tr><th>№ п/п</th><th>№ заявки</th><th>Статус</th><th>Дата поступления</th><th>Дата выставления счёта</th><th>Результат</th></tr>
<?
	while ($arResult = $rsResults->Fetch())
	{ 
	//echo "<pre>";print_r($arResult);echo "</pre>";
	$RESULT_ID=$arResult['ID'];
	$status_id=$arResult['STATUS_ID'];
	$status=$arResult['STATUS_TITLE'];
	//echo $arResult['ID']."<br>";
$arAnswer = CFormResult::GETDataByID(
	$RESULT_ID, 
	array('key_edit','billingdate','claimdate'),  // массив символьных кодов необходимых вопросов
	$ar_Res, 
	$ar_Answer2); 
	//echo "<pre>";print_r($arAnswer);echo "</pre>";
	$billingdate=$arAnswer["billingdate"][0]["USER_TEXT"];
	$claimdate=$arAnswer["claimdate"][0]["USER_TEXT"];
	$errors=array(0=>"",1=>"",2=>"");
	if($claimdate) {
		if($billingdate) {
			if(!dat_dat($claimdate, $billingdate)) $errors[0]="Дата выставления счёта меньше даты поступления заявки";
		}
		else {
		$errors[1]="Нет даты выставления счёта";
		}
	}
	else {
	$errors[2]="Нет даты поступления заявки";
	}
	
		if($errors[0] || $errors[1] || $errors[2]) {
		if(isset($_POST['proso'])) {
		if(!$errors[2]) {
		CFormResult::SetField( $RESULT_ID, "billingdate", array ($arAnswer["billingdate"][0]["ANSWER_ID"] => $claimdate));// изменяем Дату выставления счёта
		$resi="Дата выставления счёта исправлена";
		CFormResult::SetField( $RESULT_ID, "key_edit", array ($arAnswer["key_edit"][0]["ANSWER_ID"] => "0"));// изменяем Ключ редактирования для участия заявки в передаче данных в базу
		}
		else $resi="<div style='background:red;color:#fff;'>Отказ: ".$errors[2]."</div>";
		
		}
		if(isset($_POST['prp'])) {
		$resi=$errors[0].$errors[1].$errors[2];
		
		}

	$i++;
echo "<tr><td>".$i."</td><td>".$RESULT_ID."</td><td>".$status."(".$status_id.")"."</td><td>".$claimdate."</td><td>".$billingdate."</td><td>".$resi."</td></tr>";
}
//else echo "<tr><td colspan='4'> Ошибки даты выставления счёта нет</td></tr>";
unset($errors);
	}
	if(!$i) echo "<tr><td colspan='4'> Нет заявок для обработки</td></tr>";
}
}
echo "<pre>";print_r($ar_ver);echo "</pre>";
?>
</table>
</div>

	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>