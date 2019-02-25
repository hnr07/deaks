<?include "var_config.php"; ?>
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
$QUESTION_ID[0] = $questions["fly_1"]["ID"]; // ID вопроса перелет туда
$QUESTION_ID[1] = $questions["fly_2"]["ID"]; // ID вопроса перелет оттуда

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

// получим список всех ответов вопроса #27 перелёт туда
$rsAnswers = CFormAnswer::GetList(
    $QUESTION_ID[0], 
    $by="s_id", 
    $order="asc", 
    $arFilter, 
    $is_filtered
    );
while ($arAnswer = $rsAnswers->Fetch())
{
   // echo "<pre>"; print_r($arAnswer); echo "</pre>";
	$ar_reys_t_mes[]=$arAnswer["MESSAGE"];
	$ar_reys_t[]=$arAnswer["ID"];
	//$ar_reys_t[]=$arAnswer[MESSAGE];
}
//echo "<pre>"; print_r($ar_reys_t); echo "</pre>";

// получим список всех ответов вопроса #28 перелёт оттуда
$rsAnswers = CFormAnswer::GetList(
    $QUESTION_ID[1], 
    $by="s_id", 
    $order="asc", 
    $arFilter, 
    $is_filtered
    );
while ($arAnswer = $rsAnswers->Fetch())
{
    //echo "<pre>"; print_r($arAnswer); echo "</pre>";
	$ar_reys_o_mes[]=$arAnswer["MESSAGE"];
	$ar_reys_o[]=$arAnswer["ID"];
	//$ar_reys_o[]=$arAnswer[MESSAGE];
}
//echo "<pre>"; print_r($ar_reys_o); echo "</pre>";
?>
 <?
 global $fist;global $FORM_ID;
 $FORM_ID = $form_m; // ID веб-формы
 $ar_fist=array($status_ok, $status_nepr, $status_nopl, $status_rz, $status_opl, $status_no);// массив необходимых статусов
$fist=implode(" | ", $ar_fist); // строка фильтра статусов результата

function f_omr($kuda,$reys) //  функция подсчёта зарегистрированных мест на рейс 
{

 global $fist;
global $FORM_ID;
if($kuda=="tuda") $siv="fly_1";
if($kuda=="ottuda") $siv="fly_2";
// фильтр по полям результата
$marFilter = array("STATUS_ID" => $fist);

// фильтр по вопросам
$marFields = array();

$marFields[] = array(
    "SID" => $siv,                          // символьный идентификатор вопроса 
	"FILTER_TYPE"       => "answer_id",          // фильтруем по id поля
"PARAMETER_NAME" => "ANSWER_TEXT",         // параметр выборки по названию radio
"VALUE" => $reys                              // выборка по названию
    );

$marFilter["FIELDS"] = $marFields;

$rsResults = CFormResult::GetList($FORM_ID, 
    ($by="s_id"), 
    ($order="asc"), 
    $marFilter, 
    $mis_filtered, 
    "N");
$kon=0;
while ($arResult = $rsResults->Fetch())
  {
    $arAnswer = CFormResult::GETDataByID(
	$arResult["ID"], 
	array('age'),  // массив символьных кодов необходимых вопросов
	$ar_Res, 
	$ar_Answer2);
   if($arAnswer['age'][0]['ANSWER_VALUE']<>"2") $kon++; // Если ребёнок до 2 лет - место не резервируется
  //$kon++;
   // echo "<pre>"; print_r($arResult); echo "</pre>";
  }

 //echo "<pre>";print_r($rsResults); echo "</pre>";
//echo  $kon."<br>";
return $kon;  // результат 
}

$ck_1=count($ar_kfly_1);
$ck_2=count($ar_kfly_2);

for($i=0;$i<$ck_1;$i++){
$ar_os_t[$i]=$ar_kfly_1[$i]-f_omr("tuda",$ar_reys_t[$i])-$ar_bron_1[$i];
}

for($i=0;$i<$ck_2;$i++){
$ar_os_o[$i]=$ar_kfly_2[$i]-f_omr("ottuda",$ar_reys_o[$i])-$ar_bron_2[$i];
}


$is_fly= (implode("^",$ar_os_t))."&".(implode("^",$ar_os_o));

?>

