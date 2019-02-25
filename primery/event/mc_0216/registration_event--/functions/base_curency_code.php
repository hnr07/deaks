<?

if($edit_z) $fr=@fopen("../manager_scripts/base_currency.txt","r");
else $fr=@fopen("../../../com/registration_event/".$code_m."/manager_scripts/base_currency.txt","r");
	$str_base_curency=@fgets($fr,255);
	@fclose($fr);
$ar_base_curency=explode("@",$str_base_curency);
$id_base_curency=trim($ar_base_curency[0]);

$kbvm=$id_base_curency;   // код базовой валюты мероприятия
//echo ">>>>> ".$kbvm;

//CModule::IncludeModule("form");
$FORM_ID_c = 8;
		$arFilter_c = array();
		$arFields_c = array();
		$arFields_c[0] = array(
			"CODE"              => "currency_number",     // код поля по которому фильтруем
			"FILTER_TYPE"       => "text",          // фильтруем по числовому полю
			"PARAMETER_NAME"    => "USER",          // фильтруем по введенному значению
			"VALUE"             => $kbvm,        // значение по которому фильтруем
			"EXACT_MATCH"       => "Y"              // ищем точное совпадение
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
			array('code'),  // массив символьных кодов необходимых вопросов
			$ar_Res_c, 
			$ar_Answer2_c);
		$tiv=$arAnswer_c['code'][0]['USER_TEXT']; //обозначение базовой валюты мероприятия

?>