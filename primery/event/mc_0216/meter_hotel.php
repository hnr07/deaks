<?
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//$APPLICATION->SetTitle("Title");
?>
echo 1
<? include "var_config.php"; ?>
<?  CModule::IncludeModule('form'); // подключаем модуль форма ?>
<?
if (CForm::GetDataByID($form_m, 
    $form, 
    $questions, 
    $answers, 
    $dropdown, 
    $multiselect))
{
   // echo "<pre>";
       // print_r($form);
       // print_r($questions["fly_1"]);
       // print_r($answers);
       // print_r($dropdown);
      //  print_r($multiselect);
   // echo "</pre>";
}
?>
<?
$QUESTION_ID_H = $questions["hotel"]["ID"]; // ID вопроса отель


// сформируем массив фильтра
$arFilter = Array(
   // "ID"                      => "589 | 590", // ID ответа равен 589 или 590
  //  "ID_EXACT_MATCH"          => "Y",         // точное совпадение для ID
  //  "ACTIVE"                  => "Y",         // флаг активности
  //  "MESSAGE"                 => "да | нет",  // параметр ANSWER_TEXT равен "да" или "нет"
 //   "MESSAGE_EXACT_MATCH"     => "Y",         // точное совпадение для MESSAGE
   // "FIELD_TYPE"              => "radio",     // тип поля ответа - radio-кнопка
  //  "FIELD_TYPE_EXACT_MATCH"  => "Y",         // точное совпадение для FIELD_TYPE
  //  "FIELD_PARAM"             => "checked",   // параметр включает в себя строку "checked"
  //  "FIELD_PARAM_EXACT_MATCH" => "N"          // вхождение для FIELD_PARAM
);

// получим список всех ответов вопроса  номер $QUESTION_ID_H
$rsAnswers = CFormAnswer::GetList(
    $QUESTION_ID_H, 
    $by="s_id", 
    $order="asc", 
    $arFilter, 
    $is_filtered
    );
while ($arAnswer = $rsAnswers->Fetch())
{
  //  echo "<pre>"; print_r($arAnswer[ID]); echo "</pre>";
	$ar_hot_mes[]=$arAnswer["MESSAGE"];
	$ar_hot[]=$arAnswer["ID"];
	//$ar_hot[]=$arAnswer[VALUE];
}
//echo "<br>";
//echo "<pre>"; print_r($ar_hot); echo "</pre>";

?>
<?
$QUESTION_ID_H = $questions["nomer"]["ID"]; // ID вопроса номер


// сформируем массив фильтра
$arFilter = Array(
   // "ID"                      => "589 | 590", // ID ответа равен 589 или 590
  //  "ID_EXACT_MATCH"          => "Y",         // точное совпадение для ID
  //  "ACTIVE"                  => "Y",         // флаг активности
  //  "MESSAGE"                 => "да | нет",  // параметр ANSWER_TEXT равен "да" или "нет"
 //   "MESSAGE_EXACT_MATCH"     => "Y",         // точное совпадение для MESSAGE
   // "FIELD_TYPE"              => "radio",     // тип поля ответа - radio-кнопка
  //  "FIELD_TYPE_EXACT_MATCH"  => "Y",         // точное совпадение для FIELD_TYPE
  //  "FIELD_PARAM"             => "checked",   // параметр включает в себя строку "checked"
  //  "FIELD_PARAM_EXACT_MATCH" => "N"          // вхождение для FIELD_PARAM
);

// получим список всех ответов вопроса  
$rsAnswers = CFormAnswer::GetList(
    $QUESTION_ID_H, 
    $by="s_id", 
    $order="asc", 
    $arFilter, 
    $is_filtered
    );
while ($arAnswer = $rsAnswers->Fetch())
{
   // echo "<pre>"; print_r($arAnswer[ID]); echo "</pre>";
	$ar_nora_mes[]=$arAnswer["MESSAGE"];
	$ar_nora[]=$arAnswer["ID"];
	//$ar_nora[]=$arAnswer[MESSAGE];
}
//echo "<br>";
//echo "<pre>"; print_r($ar_nora1); echo "</pre>";

?>
 <?
  global $fist;global $FORM_ID;
 $FORM_ID = $form_m; // ID веб-формы
 $ar_fist=array($status_ok, $status_nepr, $status_nopl, $status_rz, $status_opl, $status_no);// массив необходимых статусов
$fist=implode(" | ", $ar_fist); // строка фильтра статусов результата

function f_nor($hot,$nora) //  функция подсчёта зарегистрированных номеров
{
	global $fist;
	global $FORM_ID;

	//
	$siv_h="hotel"; $siv_n="nomer";

	// фильтр по полям результата
	$marFilter = array("STATUS_ID" => $fist);

	// фильтр по вопросам

	$marFields = array();

	$marFields[] = array
	(
		"SID" => $siv_h,                     	// символьный идентификатор вопроса 
		"FILTER_TYPE"       => "answer_id",          // фильтруем по id поля
		"PARAMETER_NAME" => "ANSWER_VALUE",         // параметр выборки по названию radio"
		"VALUE" => $hot                         // id поля
	);

	$marFields[] = array
	(
		"SID" => $siv_n,                      	// символьный идентификатор вопроса 
		"FILTER_TYPE"       => "answer_id",          // фильтруем по id поля
		"PARAMETER_NAME" => "ANSWER_VALUE",         // параметр выборки по названию radio"
		"VALUE" => $nora                        // id поля
	);

	$marFilter["FIELDS"] = $marFields;

	$rsResults = CFormResult::GetList
	(
		$FORM_ID, 
		($by="s_timestamp"), 
		($order="asc"), 
		$marFilter, 
		$mis_filtered, 
		"N"
	);
	$kon=0;
	while ($arResult = $rsResults->Fetch())
	  {
	   $kon++;
		 //echo "<pre>"; print_r($arResult); echo "</pre>";
	  }
	//echo "<pre>"; echo $arResult." >> ".$kon; echo "</pre>";
	//echo "<pre>";print_r($rsResults);echo "</pre>";
	//echo  $kon."<br>";
	return $kon;  // результат 
}


//echo "<pre>"; print_r($ar_nora); echo "</pre>";
$ca=count($ar_knora);

for($i=0;$i<$ca;$i++) {
$ar_onor[]=$ar_knora[$i]-$ar_bron[$i]-(f_nor($ar_hot[$i],$ar_nora[0])+ceil(f_nor($ar_hot[$i],$ar_nora[1])/2)+ceil(f_nor($ar_hot[$i],$ar_nora[2])/2)+ceil(f_nor($ar_hot[$i],$ar_nora[3])/3)+ceil(f_nor($ar_hot[$i],$ar_nora[4])/3)+ceil(f_nor($ar_hot[$i],$ar_nora[5])/3)+ceil(f_nor($ar_hot[$i],$ar_nora[6])/2)+ceil(f_nor($ar_hot[$i],$ar_nora[7])/3)+ceil(f_nor($ar_hot[$i],$ar_nora[8])/3)+ceil(f_nor($ar_hot[$i],$ar_nora[9])/4)+ceil(f_nor($ar_hot[$i],$ar_nora[10])/4)+ceil(f_nor($ar_hot[$i],$ar_nora[11])/4)+ceil(f_nor($ar_hot[$i],$ar_nora[12])/3)+ceil(f_nor($ar_hot[$i],$ar_nora[13])/4)+ceil(f_nor($ar_hot[$i],$ar_nora[14])/4));
}



$is_nora= implode("^",$ar_onor);

?>

 <?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>