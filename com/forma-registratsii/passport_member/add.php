<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?  CModule::IncludeModule('form'); // подключаем модуль форма ?>

<?

$FORM_ID_P = 2;
if (CForm::GetDataByID($FORM_ID_P, 
    $form, 
    $questions, 
    $answers, 
    $dropdown, 
    $multiselect))

  //  echo "<pre>";
       // print_r($form);
       //print_r($questions);
       //print_r($answers);
      //  print_r($dropdown);
       // print_r($multiselect);
  //  echo "</pre>";
foreach($answers as $key=>$val)	{
	$ar_sid[]=$key;
	foreach($val as $v) {
		$ar_pp[$key][$v["ID"]]["ID"]=$v["ID"];
		$ar_pp[$key][$v["ID"]]["MESSAGE"]=$v["MESSAGE"];
		$ar_pp[$key][$v["ID"]]["VALUE"]=$v["VALUE"];
		$ar_pp[$key][$v["ID"]]["FIELD_TYPE"]=$v["FIELD_TYPE"];
	}	
}
 //echo "<pre>"; print_r($ar_pp); echo "</pre>";
?>

<?
$title=$_POST["title"];
$FORM_ID = $_POST["web_form_id"];
$arFilter=array("ID"=>$_POST["result_id"]);
$rsResults = CFormResult::GetList($FORM_ID, 
    ($by="s_timestamp"), 
    ($order="desc"), 
    $arFilter, 
    $is_filtered, 
    "Y", 
    1);

while ($arResult = $rsResults->Fetch())
{
$RESULT_ID=$arResult['ID'];
  //  echo "<pre>"; print_r($arResult); echo "</pre>";
	$arAnswer = CFormResult::GETDataByID(
		$RESULT_ID, 
		$ar_sid,
		$ar_Res, 
		$ar_Answer2); 
		//echo "<pre>"; print_r($arAnswer); echo "</pre>";
}

foreach($ar_pp as $key => $val) {
	foreach($val as $k => $v) {
		switch($v["FIELD_TYPE"]) {
		case "radio": 
			if($arAnswer[$key][0]["ANSWER_VALUE"]==$v["VALUE"]) {
			$ar_vaad["form_".$v["FIELD_TYPE"]."_".$key]=$v["ID"];
			}
			break;
		case "file": 
			$ar_vaad["form_".$v["FIELD_TYPE"]."_".$k]=CFile::MakeFileArray($arAnswer[$key][0]["USER_FILE_ID"]);
			break;
		default:
			if($key=="title") $ar_vaad["form_".$v["FIELD_TYPE"]."_".$k]=$title;
			else $ar_vaad["form_".$v["FIELD_TYPE"]."_".$k]=$arAnswer[$key][0]["USER_TEXT"];
		}
	}
}
//echo "<pre>"; print_r($ar_vaad); echo "</pre>";
	
	if($RESULT_ID_ADD = CFormResult::Add($FORM_ID_P, $ar_vaad))
{
    //echo "<div class='p_ok'>".ft("card_party")." \"".$title."\" ".ft("successfully_created")."</div>";
	echo "1^".$title;

	
}
else
{
  //echo "<div class='p_er'>".ft("error_creating_card")."</div>";
  echo "0";
}
	
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>