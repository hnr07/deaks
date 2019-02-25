<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
$referer=explode("?",$_SERVER['HTTP_REFERER'],2);

if(isset($_REQUEST["copy_id"])) {
	if (CModule::IncludeModule("form")) {
		$copy_arValues = CFormResult::GetDataByIDForHTML($_REQUEST["copy_id"], "Y");
		echo count($copy_arValues);
		foreach($copy_arValues as $kp=>$vp) {
			$ar_kp=explode("_",$kp,3);
			if($ar_kp[1]=="image" || $ar_kp[1]=="file") $copy_arValues[$kp]=CFile::MakeFileArray(CFile::CopyFile($vp));
		}
	
		if ($NEW_RESULT_ID = CFormResult::Add($_REQUEST["WEB_FORM_ID"], $copy_arValues))
		{
			if($_REQUEST["NEW_RESULT_STATUS"]) CFormResult::SetStatus($NEW_RESULT_ID, $_REQUEST["NEW_RESULT_STATUS"], "Y");
			else CFormResult::SetStatus($NEW_RESULT_ID, $_REQUEST["copy_status"], "Y");
			if($_REQUEST["OLD_RESULT_STATUS"]) CFormResult::SetStatus($_REQUEST["copy_id"], $_REQUEST["OLD_RESULT_STATUS"], "Y");
			header("Location: ".$referer[0]."?copy_new=".$NEW_RESULT_ID."&copy_old=".$_REQUEST["copy_id"]); exit;
		}
		else
		{
			global $strError;
			header("Location: ".$referer[0]."?copy_old=".$_REQUEST["copy_id"]."&text_error=".$strError); exit;
		}
	}
}
else header("Location: ".$referer[0]); exit;
?>
<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>