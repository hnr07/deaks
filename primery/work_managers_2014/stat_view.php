<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Опрос: \"Работа менеджеров-2014\"");
?> 
<link type="text/css" href="style.css" rel="stylesheet"></link> 
<br/><br/>
<h2><?=$APPLICATION->GetTitle();?> - статистика</h2>
<?
global $USER;
$ar_gr=$USER->GetUserGroupArray();

$ar_us=array(10972,1530);

//if(in_array(1, $ar_gr) || in_array($USER->GetID(), $ar_us)) {
	if(true) {
?>
<?
if(CModule::IncludeModule("form")){ 
$FORM_ID = $_REQUEST["WEB_FORM_ID"];

$ar_anq=array();
for($i=3;$i<=9;$i++) {
$ar_anq[]="question_".$i; //массив вопросов для статистики
}
$c_ar_anq=count($ar_anq);
	if (CForm::GetDataByID($FORM_ID, 
		$form, 
		$questions, 
		$answers, 
		$dropdown, 
		$multiselect))
	{
		echo "<pre>";
		   // print_r($form);
		   // print_r($questions);
		   // print_r($answers);
		   // print_r($dropdown);
		   // print_r($multiselect);
		echo "</pre>";
	}
	for($i=0;$i<$c_ar_anq;$i++) {
		$ar_res_statistics[$ar_anq[$i]]['TITLE']=$questions[$ar_anq[$i]]['TITLE'];
		foreach($answers[$ar_anq[$i]] as $val) {
			$ar_res_statistics[$ar_anq[$i]]['MESSAGE'][]=$val['MESSAGE'];
			$ar_res_statistics[$ar_anq[$i]]['RES_SUM'][$val['MESSAGE']]=0;	
		}
	}

// фильтр по полям результата
	$arFilter = array(
	   // "ID"                   => "12",              // ID результата
	  //  "ID_EXACT_MATCH"       => "N",               // вхождение
		//"STATUS_ID"            => $f_status,          // статус Ожидает оплаты
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
    "CODE"              => "residence",     // код поля по которому фильтруем
    "FILTER_TYPE"       => "text",          // фильтруем по текстовому полю
    "PARAMETER_NAME"    => "ANSWER_VALUE",          // фильтруем по полю ANSWER_TEXT
    "VALUE"             => "apartment",        // значение по которому фильтруем
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
		global $c_za;
		$c_za=0;
		$ar_svod=array();
?>


<?
$ar_anq=array();
for($i=3;$i<=9;$i++) {
$ar_anq[]="question_".$i;
}

$text_0="";
		while ($arResult = $rsResults->Fetch())
	{ 
	$c_za++;
	$RESULT_ID=$arResult['ID'];
	$arAnswer = CFormResult::GETDataByID(
	$RESULT_ID, 
	$ar_anq,  // массив символьных кодов необходимых вопросов
	$ar_Res, 
	$ar_Answer2); 

	foreach($arAnswer as $val) {
	$ar_pan[$RESULT_ID][$val[0]['VARNAME']]=$val[0]['ANSWER_TEXT'];
	}
	
	
	
	
	//	echo "<pre>";print_r($arAnswer);echo "</pre>";
	
}	
foreach($ar_pan as $val_ar_pan) {
	foreach($val_ar_pan as $k=>$v) {
		$ar_res_statistics[$k]['RES_SUM'][$v]++;
	}
}	

	//echo "<pre>";print_r($ar_pan);echo "</pre>";
	//echo "<pre>";print_r($ar_res_statistics);echo "</pre>";

?>
<?}?>

<div class="tiraz"><div class="tiraz_t"><h3></h3></div>
<?if($_GET['print']!="Y") {?>
<div class="tiraz_a"><a href="./result_list.php?WEB_FORM_ID=<?=$_REQUEST["WEB_FORM_ID"];?>">Результаты</a></div><div class="tiraz_p"><a href="?str=1&print=Y">Печать</a></div>
<?}?>
</div>
<div class="clear-all"></div>
<table class="tares">
<tr><th>Вопрос</th><th>Ответы</th><th>Результат (<?=$c_za?> шт.)</th></tr>
<?foreach($ar_res_statistics as $key=>$val){?>
<tr>
	<td><?=$val['TITLE']?></td>
	<td>
<?	foreach($val['RES_SUM'] as $k=>$v){?>
		<div class="div_ant"><nobr><?= $k;?></nobr></div>
<?}?>	
</td>
	<td>
<?		
	$i=0;
	foreach($val['RES_SUM'] as $k=>$v){
	$i++;
?>
		<div class="div_reg"><div class="grf reg_<?=$i?>" style="width:<?=(round(($v*400/$c_za)))?>px"></div><div class="ch_res"><?= $v;?> (<?=round(($v*100/$c_za),2)?>%)</div></div>
<?	}
?>	</td>

</tr>
<?}?>

</table>
<?
}
else {
?>
<div class="">У Вас недостаточно прав для просмотра статистики. Обратитесь к Сургучёвой Марие.</div>
<?}?>
<div class="clear-all"></div>
    <br/><br/><br/><br/>
   
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>