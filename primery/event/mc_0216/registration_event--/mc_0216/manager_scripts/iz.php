<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
include "../var_config.php";
$APPLICATION->SetTitle($title_m);
?> 

<link rel="stylesheet" type="text/css" href="/css/manager_scripts.css" />
<script type="text/javascript" src="/js/manager_scripts/manager_scripts.js"></script>
<br/>
<div class="manager_scripts">
<div class="a_vozo"><a href="./">Все служебные обработчики</a><div id="sz"><div><img src="/images/registration_event/d.gif"></div></div></div>
<h2><?$APPLICATION->ShowTitle();?></h2>
<br/>
<div class="chte"><b>Страница проверки сроков оплаты.</b> <span onclick="f_ps('txt2')"><u>Что это? >>></u></span><div id="txt2" class="txt" onclick="f_us('txt2')">
Данная страница использует для обработки результаты формы заявок на мероприятие "<?$APPLICATION->ShowTitle();?>".<br/>
 Кнопка "Изменить статус" проверяет заявки со статусом "Ожидает оплаты" и "Ожидает промоушен" при оплате "Нал. в ОП". Если для заявки со статусом "Ожидает оплаты" дата выставления счёта более <?=$m_diso?> дней от текущей даты и если сумма оплаты в базовой валюте равна нулю или меньше, заявка переводится в статус "Истёк срок оплаты". Если для заявки со статусом "Ожидает промоушен" дата поступления заявки более десяти дней от текущей даты и если сумма оплаты в базовой валюте равна нулю или меньше, заявка переводится в статус "Истёк срок оплаты". В таблице выводятся результаты этого изменения статуса.
 <br/><br/><u>закрыть</u></div></div>

  <form method="POST">
 <div class="chte"><input type="text" name="isk" value="<?=$_POST['isk']?>" class="input_text">  Исключить из обработки <span onclick="f_ps('txt3')"><u>Что это? >>></u></span><div id="txt3" class="txt" onclick="f_us('txt3')">
Заявки, номера которых внесены в поле "Исключить из обработки" не будут учавствовать в проверке на срок оплаты. Номера должны быть внесены через запятую. Пример: 1111,2222,4321,1234
 <br/><br/><u>закрыть</u></div></div>


 <div class="chte"><input class="buts" type="submit" name="prp" value="Предварительный просмотр" onclick="f_sz()"> <span onclick="f_ps('txt4')"><u>Что это? >>></u></span><div id="txt4" class="txt" onclick="f_us('txt4')">
 Кнопка "Предварительный просмотр" проверяет заявки со статусом "Ожидает оплаты" и "Ожидает промоушен". В таблице выводятся результаты прверки с будущим результатом обработки. Изменение статуса при этом не происходит.
 <br/><br/><u>закрыть</u></div></div>

 <input class="buts" type="submit" name="proso" value="Изменить статус" onclick="f_sz()">
 </form>
 
<?php


if(isset($_POST['proso']) || isset($_POST['prp'])) {
if(CModule::IncludeModule("form")){ 
$FORM_ID = $form_m;
$f_status=$status_nepr." | ".$status_opl;
// фильтр по полям результата
	$arFilter = array(
	   // "ID"                   => "12",              // ID результата
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
	*/
$arFields[] = array(
    "CODE"              => "oplata",     // код поля по которому фильтруем
    "FILTER_TYPE"       => "text",          // фильтруем по текстовому полю
    "PARAMETER_NAME"    => "ANSWER_TEXT",          // фильтруем по полю ANSWER_TEXT
    "VALUE"             => "Нал в ОП",        // значение по которому фильтруем
    "EXACT_MATCH"       => "N"              // ищем вхождение, ищем точное совпадение-"Y"
    );
	
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

	$date_d=date("j");
	$date_m=date("n");
	$date_y=date("Y");
	$mt0=mktime(0,0,0,$date_m,$date_d,$date_y);
?>

<table class="tmbl">
	 <tr><th>№ п/п</th><th>№ заявки</th><th>Статус</th><th>Тип оплаты</th><th>Дата<br />выставления счёта</th><th>Разница<br />дней</th><th>Оплачено в<br />базовой валюте</th><th>Результат</th></tr>
<?
	while ($arResult = $rsResults->Fetch())
	{ 
	//echo "<pre>";print_r($arResult);echo "</pre>";
	$RESULT_ID=$arResult['ID'];
	$status_id=$arResult['STATUS_ID'];
	$status=$arResult['STATUS_TITLE'];
	
	
$arAnswer = CFormResult::GETDataByID(
	$RESULT_ID, 
	array('t_money','billingdate','oplata','expired','key_edit'),  // массив символьных кодов необходимых вопросов
	$ar_Res, 
	$ar_Answer2); 
$t_money=floatval($arAnswer['t_money'][0]['USER_TEXT']);
if(!$t_money) $t_money=0;
 /* 
 if($status_id==$status_opl) $date_table=trim($arAnswer['billingdate'][0]['USER_TEXT']);
  if($status_id==$status_nepr) $date_table=trim($arAnswer['claimdate'][0]['USER_TEXT']);
  */
  $date_table=trim($arAnswer['billingdate'][0]['USER_TEXT']);
  $ar_dt=explode(".",$date_table);
  $mt=mktime(0,0,0,($ar_dt[1]*1),($ar_dt[0]*1),$ar_dt[2]);
  $rt=($mt0-$mt)/(60*60*24);
 //echo $_POST['isk'];
 $pos = stripos($_POST['isk'], $RESULT_ID);

 if ($pos === false) $fisk=1;
 else $fisk=0;
	if($fisk) {
		if(isset($_POST['proso'])) {
		if($t_money<=0 && $rt>$m_diso) {
		CFormResult::SetStatus($RESULT_ID, $status_nopl, "Y"); // меняем статус заявки на Истёк срок оплаты
		CFormResult::SetField( $RESULT_ID, "expired", array ($arAnswer["expired"][0]["ANSWER_ID"] => (date("d.m.Y")."-".$status_id))); //внесём дату изменения статуса и из какого статуса переход
		CFormResult::SetField( $RESULT_ID, "key_edit", array ($arAnswer["key_edit"][0]["ANSWER_ID"] => "0"));// изменяем Ключ редактирования для участия заявки в передаче данных в базу
		$resi="<span style='color:red;'>Статус изменён</span>";
		} 
		else $resi="<span style='color:green;'>Статус не изменён</span>";
		}
		if(isset($_POST['prp'])) {
		if($t_money<=0 && $rt>$m_diso && $fisk) {$resi="<span style='color:red;'>Статус будет изменён</span>";} 
		else $resi="<span style='color:green;'>Статус не будет изменён</span>";
		}
	}
	else $resi="Исключён из обработки";
	$i++;
echo "<tr><td>".$i."</td><td>".$RESULT_ID."</td><td>".$status."(".$status_id.")"."</td><td>".$arAnswer['oplata'][0]['ANSWER_TEXT']."</td><td>".$date_table."</td><td>".$rt."</td><td>".$t_money."</td><td>".$resi."</td></tr>";

	}
}
}
//echo "<pre>";print_r($ar_ver);echo "</pre>";
?>
</table>
</div>

	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>