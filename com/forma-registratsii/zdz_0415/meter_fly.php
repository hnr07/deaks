<?include "var_config.php"; ?>
<?  CModule::IncludeModule('form'); // ���������� ������ ����� ?>
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
$QUESTION_ID[0] = $questions["fly_1"]["ID"]; // ID ������� ������� ����
$QUESTION_ID[1] = $questions["fly_2"]["ID"]; // ID ������� ������� ������

// ���������� ������ �������
$arFilter = Array(
   // "ID"                      => "589 | 590", // ID ������ ����� 589 ��� 590
  //  "ID_EXACT_MATCH"          => "Y",         // ������ ���������� ��� ID
  //  "ACTIVE"                  => "Y",         // ���� ����������
  //  "MESSAGE"                 => "�� | ���",  // �������� ANSWER_TEXT ����� "��" ��� "���"
 //   "MESSAGE_EXACT_MATCH"     => "Y",         // ������ ���������� ��� MESSAGE
   // "FIELD_TYPE"              => "radio",     // ��� ���� ������ - radio-������
  //  "FIELD_TYPE_EXACT_MATCH"  => "Y",         // ������ ���������� ��� FIELD_TYPE
  //  "FIELD_PARAM"             => "checked",   // �������� �������� � ���� ������ "checked"
  //  "FIELD_PARAM_EXACT_MATCH" => "N"          // ��������� ��� FIELD_PARAM
);

// ������� ������ ���� ������� ������� #27 ������ ����
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

// ������� ������ ���� ������� ������� #28 ������ ������
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
 $FORM_ID = $form_m; // ID ���-�����
 $ar_fist=array($status_ok, $status_nepr, $status_nopl, $status_rz, $status_opl, $status_no);// ������ ����������� ��������
$fist=implode(" | ", $ar_fist); // ������ ������� �������� ����������

function f_omr($kuda,$reys) //  ������� �������� ������������������ ���� �� ���� 
{

 global $fist;
global $FORM_ID;
if($kuda=="tuda") $siv="fly_1";
if($kuda=="ottuda") $siv="fly_2";
// ������ �� ����� ����������
$marFilter = array("STATUS_ID" => $fist);

// ������ �� ��������
$marFields = array();

$marFields[] = array(
    "SID" => $siv,                          // ���������� ������������� ������� 
	"FILTER_TYPE"       => "answer_id",          // ��������� �� id ����
"PARAMETER_NAME" => "ANSWER_TEXT",         // �������� ������� �� �������� radio
"VALUE" => $reys                              // ������� �� ��������
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
	array('age'),  // ������ ���������� ����� ����������� ��������
	$ar_Res, 
	$ar_Answer2);
   if($arAnswer['age'][0]['ANSWER_VALUE']<>"2") $kon++; // ���� ������ �� 2 ��� - ����� �� �������������
  //$kon++;
   // echo "<pre>"; print_r($arResult); echo "</pre>";
  }

 //echo "<pre>";print_r($rsResults); echo "</pre>";
//echo  $kon."<br>";
return $kon;  // ��������� 
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

