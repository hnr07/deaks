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
<div class="chte"><b>Страница группового изменения статуса.</b> <span onclick="f_ps('txt2')"><u>Что это? >>></u></span><div id="txt2" class="txt" onclick="f_us('txt2')">
Данная страница используется для обработки результатов формы заявок на мероприятие "<?$APPLICATION->ShowTitle();?>".<br/>
 Кнопка "Изменить статус" изменяет статус заявки(-ок) по заданному фильтру.
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
		$ar_status_id[]=$arStatus["ID"];
		$ar_status_title[]=$arStatus["TITLE"];
	}
	$sit=count($ar_status_id);

?>
<div class="chte">
<b>Фильтр:</b><span onclick="f_ps('txt5')"> <u>Что это? >>></u></span><div id="txt5" class="txt" onclick="f_us('txt5')">
Фильтр позволяет выбрать для обработки несколько статусов из списка или номер(-а) заявок. Номера заявок вносятся в поле одной строкой. Для разделения номеров используйте разделитель ","(запятая).
 <br/><br/><u>закрыть</u></div>
 <div class="f_van">

 <div class="t_van">
 Статус<br/>

 <select name="van_status[]" multiple>
 
 <?
 for($i=0;$i<$sit;$i++){
	 if($ar_status_id[$i]<>$status_new) {
	 echo "<option value='".$ar_status_id[$i]."'";
	 if(in_array ($ar_status_id[$i], $_POST['van_status'])) echo " selected";
	 echo">".$ar_status_title[$i]."</option>";
	 }
 }
 ?>
 </select>
 </div>
 <div class="t_van">
 или №№ заявок<br/>
 <input type="text" name="van_list" value="<?echo $_POST['van_list']?>">
 </div>
 

 </div>
 <b>Новый статус</b><span onclick="f_ps('txt6')"> <u>Что это? >>></u></span><div id="txt6" class="txt" onclick="f_us('txt6')">
Выбранный из выпадающего списка статус будет присвоен заявкам отобранным при помощи фильтра.
 <br/><br/><u>закрыть</u></div>
 <div class="f_van">
   <div class="t_van">

 <select name="new_status">

 <?
 for($i=0;$i<$sit;$i++){
	 if($ar_status_id[$i]<>$status_new) {
	 echo "<option value='".$ar_status_id[$i]."'";
	 if($_POST['new_status']==$ar_status_id[$i]) echo " selected";
	 echo">".$ar_status_title[$i]."</option>";
	 }
 }
 ?>
 </select>
 </div>
 </div>
 
 
</div>
 <div class="chte"><input class="buts" type="submit" name="prp" value="Предварительный просмотр" onclick="f_sz()"> <span onclick="f_ps('txt4')"><u>Что это? >>></u></span><div id="txt4" class="txt" onclick="f_us('txt4')">
 Кнопка "Предварительный просмотр" показывает в каких заявках будет изменён существующий статус на выбранный.
 <br/><br/><u>закрыть</u></div></div>
 
<div class="chte">
 <input class="buts" type="submit" name="proso" value="Изменить статус" onclick="f_sz()">
</div>
 </form>
 
<?php


if(isset($_POST['proso']) || isset($_POST['prp'])) {
//echo "<pre>"; print_r($_POST); echo "</pre>";
$filtr=1;
if(trim($_POST['van_list'])) {
$f_id=str_replace(",","|",$_POST['van_list']);
$f_status="";
}
else {
	if(count($_POST['van_status'])) $f_status=implode("|",$_POST['van_status']);
	else $filtr=0;
}


if($filtr) {
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

<?
$new_status_id = $_POST['new_status']; // ID статуса
$new_rsStatus = CFormStatus::GetByID($new_status_id);
$new_arStatus = $new_rsStatus->Fetch();
//echo "<pre>"; print_r($new_arStatus); echo "</pre>";
?>

<table class="tmbl">
	 <tr><th>№ п/п</th><th>№ заявки</th><th>Статус</th><th>Новый статус</th><th>Результат</th></tr>
<?
	while ($arResult = $rsResults->Fetch())
	{ 
	//echo "<pre>";print_r($arResult);echo "</pre>";
	$RESULT_ID=$arResult['ID'];
	$status_id=$arResult['STATUS_ID'];
	$status=$arResult['STATUS_TITLE'];
	

	

	
		if(isset($_POST['proso'])) {
			if(CFormResult::SetStatus($RESULT_ID, $new_status_id, "Y")) { // меняем статус заявки на новый
			$resi="<span style='color:green;'>Статус заявки изменён на ".$new_arStatus["TITLE"]."</span>";
			}
			else $resi="<span style='color:red;'>Ошибка обработки</span>";
		}
		if(isset($_POST['prp'])) {
		$resi="<span style='color:green;'>Статус заявки будет изменён на ".$new_arStatus["TITLE"]."</span>";
		
		}

	$i++;
echo "<tr><td>".$i."</td><td>".$RESULT_ID."</td><td>".$status."(".$status_id.")"."</td><td>".$new_arStatus["TITLE"]."(".$new_arStatus["ID"].")"."</td><td>".$resi."</td></tr>";

	}
	if(!$i) echo "<tr><td colspan='4'> Не найдены заявки для обработки</td></tr>";
}
else  echo "<span style='color:red;'> Не выбраны заявки для обработки</span>";
}
}
//echo "<pre>";print_r($ar_ver);echo "</pre>";
?>
</table>
</div>
<br/><br/><br/><br/>
	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>