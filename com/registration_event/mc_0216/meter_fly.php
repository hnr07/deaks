<?
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//$APPLICATION->SetTitle("Title");
?>
<? include "var_config.php"; ?>
<? include "venue_array.php"; ?>
<? include "fly_array.php"; ?>
<?  CModule::IncludeModule('form'); // ���������� ������ ����� ?>

<?

 $FORM_ID = $form_m; // ID ���-�����
 $ar_fist=array($status_ok, $status_nepr, $status_nopl, $status_rz, $status_opl, $status_no);// ������ ����������� ��������
$fist=implode(" | ", $ar_fist); // ������ ������� �������� ����������

//echo "<pre>";print_r($ar_vlm);echo "</pre>";
foreach($ar_vlm as $k=>$v) {
	//echo $k."<br>";
// ������ �� ����� ����������
	$farFilter = array("STATUS_ID" => $fist);
	// ������ �� ��������

	$farFields = array();

	$farFields[] = array
	(
		"SID" => "id_venue",                     	// ���������� ������������� ������� 
		"FILTER_TYPE"       => "text",          // ��������� �� id ����
		"PARAMETER_NAME" => "USER",         // �������� ������� �� ��������� ��������"
		"VALUE" => $k                         // id ����
	);
	
	
	$farFilter["FIELDS"] = $farFields;
			
		$farResults = CFormResult::GetList($FORM_ID, 
			($by="s_timestamp"), 
			($order="asc"), 
			$farFilter, 
			$is_filtered, 
			"N"
			);
		while ($farResult = $farResults->Fetch())
		{
			//echo "<pre>"; print_r($arResult); echo "</pre>";
				$RESULT_ID=$farResult['ID'];
				$status_id=$farResult['STATUS_ID'];
				$status=$farResult['STATUS_TITLE'];
			$arAnswer = CFormResult::GETDataByID(
				$RESULT_ID, 
				array('id_fly_1',"id_fly_2","p_fly"),  // ������ ���������� ����� ����������� ��������
				$ar_Res, 
				$ar_Answer2); 
				if($arAnswer["p_fly"][0]["ANSWER_VALUE"]=="r_comp") {
					$sum_fly[$k][$arAnswer["id_fly_1"][0]["USER_TEXT"]][1]+=1; // ���-�� ������� �� ����
					$sum_fly[$k][$arAnswer["id_fly_2"][0]["USER_TEXT"]][2]+=1; // ���-�� ������� �� ����
				}
		}
		
}
//echo "<pre>"; print_r($sum_fly); echo "</pre>";
//echo "<pre>"; print_r($ar_ven_sum); echo "</pre>";
//echo "<pre>"; print_r($ar_ven_nom); echo "</pre>";

?>
<?

foreach($ar_fly as $k_venue => $val_venue) {
	//ksort($val_venue);
	//echo "<pre>"; print_r($val_venue); echo "</pre>";
	foreach($val_venue as $k_nap => $val_fly) {
		//echo "<pre>"; print_r($val_fly); echo "</pre>";
		foreach($val_fly as $k_fly => $val_m) {
			$sum_fly_os[$k_venue][$k_nap][$k_fly]=$ar_fly[$k_venue][$k_nap][$k_fly]["quantity"]-$ar_fly[$k_venue][$k_nap][$k_fly]["reserv"]-$sum_fly[$k_venue][$k_nap][$k_fly];
		}
	}
}


?>

<?//echo "<pre>"; print_r($sum_fly_os); echo "</pre>";?>

 <?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>