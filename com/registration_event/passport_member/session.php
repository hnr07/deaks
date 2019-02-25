<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?  CModule::IncludeModule('form'); // подключаем модуль форма ?>

<?
$passport_member_id=$_POST["passport_member_id"];
if($passport_member_id) {
		$ar_Answer= CFormResult::GETDataByID(
		$passport_member_id, 
		array(),  // массив символьных кодов необходимых вопросов
		$ar_Res_p, 
		$ar_Answer2);	
//echo "<pre>";print_r($ar_id_p);echo "</pre>";
//	$_SESSION["test"]=$ar_Answer;
	//echo $_SESSION["test"];
	foreach($ar_Answer as $k=>$v) {
		switch($v[0]["FIELD_TYPE"]) {
		case "radio":$_SESSION["passport_member"][$k]=$v[0]["ANSWER_VALUE"];break;
		case "file":$_SESSION["passport_member"][$k]=CFile::GetPath($v[0]["USER_FILE_ID"]);break;
		//case "file":$rsFile =CFile::GetByID($v[0]["USER_FILE_ID"]);$arFile = $rsFile->Fetch();$_SESSION["passport_member"][$k]=$arFile["ID"];break;
		default: $_SESSION["passport_member"][$k]=$v[0]["USER_TEXT"];
		}
	}
	echo 1;
}
else {
	unset($_SESSION["passport_member"]);
	echo 0;
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>