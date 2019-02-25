
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
$QUESTION_ID_H = $questions["hotel_ls"]["ID"]; // ID вопроса отель Leader Ship


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
	$ar_hot_mes_ls[]=$arAnswer[MESSAGE];
	$ar_hot_ls[]=$arAnswer[ID];
	//$ar_hot[]=$arAnswer[VALUE];
}
//echo "<br>";
//echo "<pre>"; print_r($ar_hot); echo "</pre>";

?>
<?
$QUESTION_ID_H = $questions["nomer_ls"]["ID"]; // ID вопроса номер Leader Ship


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

	$ar_nora_mes_ls[]=$arAnswer[MESSAGE];
	$ar_nora_ls[]=$arAnswer[ID];
	
}


?>
 <?
  global $fist;global $FORM_ID;
 $FORM_ID = $form_m; // ID веб-формы
 $ar_fist=array($status_ok, $status_nepr, $status_nopl, $status_rz, $status_opl, $status_no);// массив необходимых статусов
$fist=implode(" | ", $ar_fist); // строка фильтра статусов результата

function f_nor_ls($hot,$nora) //  функция подсчёта зарегистрированных номеров
{
global $fist;
global $FORM_ID;

//
$siv_h="hotel_ls"; $siv_n="nomer_ls";

// фильтр по полям результата
$marFilter = array("STATUS_ID" => $fist);

// фильтр по вопросам

$marFields = array();

$marFields[] = array(
    "SID" => $siv_h,                     	// символьный идентификатор вопроса 
"FILTER_TYPE"       => "answer_id",          // фильтруем по id поля
"PARAMETER_NAME" => "ANSWER_VALUE",         // параметр выборки по названию radio"
"VALUE" => $hot                         // выборка по названию
    );

$marFields[] = array(
    "SID" => $siv_n,                      	// символьный идентификатор вопроса 
	"FILTER_TYPE"       => "answer_id",          // фильтруем по id поля
"PARAMETER_NAME" => "ANSWER_VALUE",         // параметр выборки по названию radio"
"VALUE" => $nora      // выборка по названию

    );

$marFilter["FIELDS"] = $marFields;

$rsResults = CFormResult::GetList($FORM_ID, 
    ($by="s_timestamp"), 
    ($order="asc"), 
    $marFilter, 
    $mis_filtered, 
    "N");
$kon=0;
while ($arResult = $rsResults->Fetch())
  {
   $kon++;
   
  }

return $kon;  // результат 
}



$ca=count($ar_knora_ls);
for($i=0;$i<$ca;$i++) {
$ar_onor_ls[]=$ar_knora_ls[$i]-$ar_bron_ls[$i]-(f_nor_ls($ar_hot_ls[$i],$ar_nora_ls[0])+ceil(f_nor_ls($ar_hot_ls[$i],$ar_nora_ls[1])/2)+ceil(f_nor_ls($ar_hot_ls[$i],$ar_nora_ls[2])/2)+ceil(f_nor_ls($ar_hot_ls[$i],$ar_nora_ls[3])/2)+ceil(f_nor_ls($ar_hot_ls[$i],$ar_nora_ls[4])/3)+ceil(f_nor_ls($ar_hot_ls[$i],$ar_nora_ls[5])/3)+ceil(f_nor_ls($ar_hot_ls[$i],$ar_nora_ls[6])/4)+ceil(f_nor_ls($ar_hot_ls[$i],$ar_nora_ls[7])/4)/*+ceil(f_nor_ls($ar_hot_ls[$i],$ar_nora_ls[8])/3)+ceil(f_nor_ls($ar_hot_ls[$i],$ar_nora_ls[9])/4)+ceil(f_nor_ls($ar_hot_ls[$i],$ar_nora_ls[10])/4)*/);
}


$is_nora_ls= implode("^",$ar_onor_ls);

?>

