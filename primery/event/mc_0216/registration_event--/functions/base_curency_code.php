<?

if($edit_z) $fr=@fopen("../manager_scripts/base_currency.txt","r");
else $fr=@fopen("../../../com/registration_event/".$code_m."/manager_scripts/base_currency.txt","r");
	$str_base_curency=@fgets($fr,255);
	@fclose($fr);
$ar_base_curency=explode("@",$str_base_curency);
$id_base_curency=trim($ar_base_curency[0]);

$kbvm=$id_base_curency;   // ��� ������� ������ �����������
//echo ">>>>> ".$kbvm;

//CModule::IncludeModule("form");
$FORM_ID_c = 8;
		$arFilter_c = array();
		$arFields_c = array();
		$arFields_c[0] = array(
			"CODE"              => "currency_number",     // ��� ���� �� �������� ���������
			"FILTER_TYPE"       => "text",          // ��������� �� ��������� ����
			"PARAMETER_NAME"    => "USER",          // ��������� �� ���������� ��������
			"VALUE"             => $kbvm,        // �������� �� �������� ���������
			"EXACT_MATCH"       => "Y"              // ���� ������ ����������
		);
		$arFilter_c["FIELDS"] = $arFields_c;
		$rsResults_c = CFormResult::GetList($FORM_ID_c, 
			($by="s_timestamp"), 
			($order="asc"), 
			$arFilter_c, 
			$is_filtered, 
			"Y", 
			false);

		$arResult_c = $rsResults_c->GetNext();
			$RESULT_ID_c=$arResult_c['ID'];
			$arAnswer_c = CFormResult::GetDataByID(
			$RESULT_ID_c, 
			array('code'),  // ������ ���������� ����� ����������� ��������
			$ar_Res_c, 
			$ar_Answer2_c);
		$tiv=$arAnswer_c['code'][0]['USER_TEXT']; //����������� ������� ������ �����������

?>