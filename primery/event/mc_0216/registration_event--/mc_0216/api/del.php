<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>
<?
include "../var_config.php";
if (CModule::IncludeModule("form")) {
	
	$_REQUEST["id_del"]=168;
	
$id_del=$_REQUEST['id_del'];

$ar_status= array($status_ok, $status_nepr, $status_opl, $status_nopl, $status_rz, $status_del); // id �������� ����� ��� ��������

	if($id_del) {
$arAnswer = CFormResult::GETDataByID(
	$id_del, 
	array('chk','status'),  // ������ ���������� ����� ����������� ��������
	$ar_Res, 
	$ar_Answer2);
	}	
	if(in_array($ar_Res['STATUS_ID'],$ar_status)) {
		$ar_del[$id_del]['status_result_id']=$ar_Res['STATUS_ID']; // ID ������� � ������
		$ar_del[$id_del]['status_result_title']=$ar_Res['STATUS_TITLE']; // ������������ ������� � ������
		$fa=1; //���� ������� ���������
	}
	else $fa=0; //���� ������� ���������
	
	if($fa && $arAnswer['status'][0]['ANSWER_VALUE']=="member"){ // ���� ������ �������� � ��������� � ������ "��������", ��������� � ��������� � ������ ������������ ���� ��
		
	$arFilter = array();
	$arFields = array();

	$arFields[] = array(
		"CODE"              => "kem_priglashen_chk",       // ��� ���� �� �������� ���������
		"FILTER_TYPE"       => "text",       // ��������� �� ��������� ����
		"PARAMETER_NAME"    => "USER",          // �� �������� ���������� � ����������
		"VALUE"             => $arAnswer['chk'][0]['USER_TEXT'] ,  // �������� �� �������� ���������
		"EXACT_MATCH"       => "Y"              // ���� ������ ����������
		);
	$arFields[] = array(
		"CODE"              => "status",       // ��� ���� �� �������� ���������
		"FILTER_TYPE"       => "text",       //  ��������� �� ���������� ����
		"PARAMETER_NAME"    => "ANSWER_VALUE",          // �� �������� ANSWER_VALUE
		"VALUE"             => "guest_chk"   // �������� �� �������� ���������
		
		);
	$arFields[] = array(
		"CODE"              => "status",       // ��� ���� �� �������� ���������
		"FILTER_TYPE"       => "text",       //  ��������� �� ���������� ����
		"PARAMETER_NAME"    => "ANSWER_VALUE",          // �� �������� ANSWER_VALUE
		"VALUE"             => "guest"   // �������� �� �������� ���������
	 );		
	$arFilter["FIELDS"] = $arFields;
	$rsResults = CFormResult::GETList($form_m, 
			($by="s_timestamp"), 
			($order="desc"), 
			$arFilter, 
			$is_filtered, 
			"Y",
			false);
	$i=1;	
	while ($arResult = $rsResults->Fetch())
		{
		$ar_del[$id_del]['guest_'.$i]=$arResult['ID'];
		$i++;
		}
	}
	
	
	$str = json_encode($ar_del);
	$str = preg_replace_callback(
    '/\\\\u([0-9a-f]{4})/i',
    function ($matches) {
        $sym = mb_convert_encoding(
                pack('H*', $matches[1]), 
                'UTF-8', 
                'UTF-16'
                );
	    return $sym;
    },
    $str
);
//header('Content-Type: application/json; charset=UTF-8');
$val = htmlspecialchars_decode($str . PHP_EOL);
$shit = array("&lt;p&gt;", "&lt;\/p&gt;", "&lt;", "&gt;", "\\r\\n", "&lt;b&gt;", "&lt;\/b&gt;", "<b>", "</b>");
$good = array("", "", "", "", "", "", "", "", "");
$new = str_replace($shit, $good, $str);
//$new = str_replace("[", "", $new);
//$new = str_replace("]", "", $new);
//$new = $str;
echo trim($new);
}
?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>