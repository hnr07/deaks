<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
$tqs=trim($_POST["tqs"]);
$form_id=$_POST["form_id"];
$answer_id=$_POST["answer_id"]; 
$sts=$_POST["sts"]; 
$url_edit=$_POST["url_edit"]; 
$templateFolder=$_POST["templatefolder"];


if($tqs!="") {
	$ar_id=array();
	$ar_at=array();
	$ar_ut=array();
	if($answer_id) 
	{
		$za_answer_id="SELECT `RESULT_ID`,`USER_TEXT`,`ANSWER_TEXT` FROM `b_form_result_answer` AS a LEFT JOIN `b_form_result` AS r ON a.`RESULT_ID` = r.`ID`   WHERE ";
		$za_answer_id.="a.`ANSWER_ID` IN (".$answer_id.") AND (a.`USER_TEXT_SEARCH` LIKE '%".$tqs."%' OR a.`ANSWER_TEXT_SEARCH` LIKE '%".$tqs."%') AND a.`FORM_ID` ='".$form_id."' AND ";
		$za_answer_id.="r.`STATUS_ID` IN (".$sts.")";
		
		$query_answer_id = $DB->Query($za_answer_id);
		while ($pa_answer_id = $query_answer_id->Fetch())
		{
			$ar_result_qs[$pa_answer_id["RESULT_ID"]]["ID"]=$pa_answer_id["RESULT_ID"];
			$ar_result_qs[$pa_answer_id["RESULT_ID"]]["ANSWER_TEXT"]=$pa_answer_id["ANSWER_TEXT"];
			$ar_result_qs[$pa_answer_id["RESULT_ID"]]["USER_TEXT"]=$pa_answer_id["USER_TEXT"];
		
		}

	}
	
	$za_id="SELECT `ID` FROM `b_form_result` WHERE `ID` LIKE '%".$tqs."%' AND `STATUS_ID` IN (".$sts.")";
	
	
	$query_id = $DB->Query($za_id);
		while ($pa_id = $query_id->Fetch())
		{
			$ar_result_qs[$pa_id["ID"]]["ID"]=$pa_id["ID"];
		
		}

	$rows=count($ar_result_qs);
	if($rows) 
	{
		foreach($ar_result_qs as $key=>$val) {
			echo "<div><a href='".$url_edit."?RESULT_ID=".$key."&WEB_FORM_ID=".$form_id."' title='".$_POST["QS_CHANGE"]." ".$key."'><img src='".$templateFolder."/images/edit4.png'></a> <a href='?result_view=".$key."' title='".$_POST["QS_SELECT"]."'>".$key." ".$val["USER_TEXT"].$val["ANSWER_TEXT"]."</a></div>";
		}
	}
	else echo $_POST["QS_NOTHING"];
}
else echo $_POST["QS_NOT_PARAMETRS"];

?>
<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>