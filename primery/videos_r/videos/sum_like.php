<?if($_POST["fa"]) require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
global $USER;
// ��������� ���������� 
$df=1; // $USER->IsAdmin()- ������ �������, 0 - ������, 1 - ����

if ($df) {
	if(CModule::IncludeModule("form")){
		// ID ���-�����
		$FORM_ID = 6;

			$arFilter = array(
		   
			);
			
			// ������ �� ��������
			
		$arFields = array();

		$arFilter["FIELDS"] = $arFields;
		
				// ������� (������) ��� �����������
		$rsResults = CFormResult::GETList($FORM_ID, 
			($by="s_timestamp"), 
			($order="desc"), 
			$arFilter, 
			$is_filtered, 
			"N",
			false);


			
			while ($arResult = $rsResults->Fetch()){
				//echo "<pre>";print_r($arResult);echo "</pre>";
			$arAnswer = CFormResult::GETDataByID(
				$arResult["ID"], 
				array('id_video'),  // ������ ���������� ����� ����������� ��������
				$ar_Res, 
				$ar_Answer2); 
				
				$ar_sum[$arAnswer['id_video'][0]['USER_TEXT']]++;
			}
		arsort($ar_sum);
		$i=0;$r=0;
		foreach($ar_sum as $k=>$v) {
			$ar_i[$i]=$v;
			if($i) {
				if($ar_i[$i]!=$ar_i[$i-1]) $r++;
			}
			else {$r++;}
			$ar_ret[$k]=$r;
			$i++;
		}
		if($_POST["fa"]) {
			$i=0;
			foreach($ar_sum as $k=>$v) {
				if($i) echo "|";
				echo $ar_sum[$k]."^".$ar_ret[$k]."^".$k;
				$i++;
			}
			
		}
		
	}
}
//echo "<pre>";print_r($ar_sum);echo "</pre>";
//echo "<pre>";print_r($ar_ret);echo "</pre>";
?>

<?if($_POST["fa"]) require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>