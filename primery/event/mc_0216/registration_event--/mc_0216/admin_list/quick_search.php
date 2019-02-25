<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$tqs=trim($_POST["tqs"]);
$form_id=$_POST["form_id"];
$answer_id=$_POST["answer_id"]; 
$sts=$_POST["sts"]; 
$url_edit=$_POST["url_edit"]; 
$not_text="Ничего не найдено.";	

if($tqs) {
	if(is_numeric($tqs)) $ip="RESULT_ID";
	else $ip="USER_TEXT";

	$za="SELECT `RESULT_ID`,`USER_TEXT` FROM `b_form_result_answer` AS a LEFT JOIN `b_form_result` AS r ON a.`RESULT_ID` = r.`ID`   WHERE a.`ANSWER_ID`='".$answer_id."' AND a.`".$ip."` LIKE '%".$tqs."%' AND a.`FORM_ID` ='".$form_id."' AND r.`STATUS_ID` IN (".$sts.")";
	$query= mysql_query($za); 
	$rows=mysql_num_rows($query);
	if($rows) {
		for($i=0;$i<$rows;$i++) {
		$pa=mysql_fetch_array($query);

		echo "<div><a href='".$url_edit."?RESULT_ID=".$pa["RESULT_ID"]."&WEB_FORM_ID=".$form_id."' title='редактировать № ".$pa["RESULT_ID"]."'><img src='/images/registration_event/edit4.png'></a> <a href='?result_view=".$pa["RESULT_ID"]."'>".$pa["RESULT_ID"]." ".$pa["USER_TEXT"]."</a></div>";
		}
	}
	else echo $not_text;
}
else echo $not_text;			

?>