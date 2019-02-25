<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>
<?
include "../var_config.php";
if (CModule::IncludeModule("form")) {
	
	$_REQUEST["user_login"]="web";
	$_REQUEST["user_id"]=1;
	
$user_login=$_REQUEST["user_login"];  // логин пользователя

//$rsUser = CUser::GetByLogin($user_login);
//$arUser = $rsUser->Fetch();
//$user_id=$arUser['ID'];        // id пользователя

$user_id=$_REQUEST["user_id"];        // id пользователя


	//массив кодов для фильтра
//"user_id"           // ЧК - автор заявки
//"chk"               // ЧК - участник
//"guest_chk"               // ЧК - приглашённый ЧК
//"kem_priglashen_chk" // ЧК - приглашающий
//"pl_chk"             // ЧК - плательщик
//"garant_chk"         // ЧК - гарант
$ar_code=array("user_id","chk","guest_chk","kem_priglashen_chk","pl_chk","garant_chk");
$c_pa=count($ar_code); // количество элементов массива

$list_status= $status_ok."|".$status_nepr."|".$status_opl."|".$status_nopl."|".$status_rz."|".$status_del; // id статусов формы для проверки

	if($user_id) {
		//global $rsResults;
		//global $f_arRes;
		for($i=0;$i<$c_pa;$i++) {
			//filid($form_m, $list_status, $user_id, $user_login, $ar_code[$i]);
		$code =	$ar_code[$i];
		$status_id = $list_status;
			if($code=="user_id"){
		// фильтр по полям результата
		$arFilter = array(
			"STATUS_ID"            => $status_id,          // статус
			"USER_ID"              => $user_id         // пользователь-автор
			);
		}
		else {
		// фильтр по полям результата
		$arFilter = array(
			"STATUS_ID"            => $status_id,          // статус
			);
			
		// фильтр по вопросам
		$arFields = array();	
		
		switch($code) {
			
		case "chk":
			$arFields[] = array(
			"CODE"              => $code,     // код поля по которому фильтруем
			"FILTER_TYPE"       => "text",          // фильтруем по числовому полю
			"PARAMETER_NAME"    => "USER",          // фильтруем по введенному значению
			"VALUE"             => $user_login,        // значение по которому фильтруем
			"EXACT_MATCH"       => "Y"              // ищем точное совпадение
			);
			$arFields[] = array(
			"CODE"              => "status",     // код поля по которому фильтруем
			"FILTER_TYPE"       => "text",          // фильтруем по текстовому полю
			"PARAMETER_NAME"    => "ANSWER_VALUE",          // фильтруем по полю ANSWER_TEXT
			"VALUE"             => "member",        // значение по которому фильтруем
			"EXACT_MATCH"       => "N"              // ищем вхождение, ищем точное совпадение-"Y"
			);
			break;
		case "guest_chk":
			$arFields[] = array(
			"CODE"              => "chk",     // код поля по которому фильтруем
			"FILTER_TYPE"       => "text",          // фильтруем по числовому полю
			"PARAMETER_NAME"    => "USER",          // фильтруем по введенному значению
			"VALUE"             => $user_login,        // значение по которому фильтруем
			"EXACT_MATCH"       => "Y"              // ищем точное совпадение
			);
			$arFields[] = array(
			"CODE"              => "status",     // код поля по которому фильтруем
			"FILTER_TYPE"       => "text",          // фильтруем по текстовому полю
			"PARAMETER_NAME"    => "ANSWER_VALUE",          // фильтруем по полю ANSWER_TEXT
			"VALUE"             => "guest_chk",        // значение по которому фильтруем
			"EXACT_MATCH"       => "N"              // ищем вхождение, ищем точное совпадение-"Y"
			);
			break;
					
		default:
			$arFields[] = array(
			"CODE"              => $code,     // код поля по которому фильтруем
			"FILTER_TYPE"       => "text",          // фильтруем по числовому полю
			"PARAMETER_NAME"    => "USER",          // фильтруем по введенному значению
			"VALUE"             => $user_login,        // значение по которому фильтруем
			"EXACT_MATCH"       => "Y"              // ищем точное совпадение
			);
			break;
		}
		
		$arFilter["FIELDS"] = $arFields;
		}
		//echo "<pre>";print_r($arFilter);echo "</pre>";
		
		$rsResults = CFormResult::GetList($form_m, 
			($by="s_timestamp"), 
			($order="desc"), 
			$arFilter, 
			$is_filtered, 
			"Y", 
			false);
			//unset($f_arRes);
			//global $f_arRes;
			
			while ($arRes = $rsResults->Fetch()) {$f_arRes[]=$arRes;}
	
		//echo "<pre>";print_r($f_arRes);echo "</pre>";
			
		
				 foreach($f_arRes as $res)
				{ 	//echo $res['ID']."<br>";
				
					// получим данные по всем вопросам
			$ar_Answer = CFormResult::GetDataByID(
				$res['ID'],
				array('family','name','sum_debt'), 
				$ar_Result, 
				$ar_Answer2);

				if($ar_Answer['sum_debt'][0]['USER_TEXT']) $sum_debt=$ar_Answer['sum_debt'][0]['USER_TEXT'];
				else $sum_debt=0;
				$family=$ar_Answer['family'][0]['USER_TEXT'];
				$name=$ar_Answer['name'][0]['USER_TEXT'];
				
				$ar_ri[$user_login][$code_m][$ar_code[$i]][$res['ID']]['ID']=$res['ID'];
				$ar_ri[$user_login][$code_m][$ar_code[$i]][$res['ID']]['status_result_id']=$res['STATUS_ID'];
				$ar_ri[$user_login][$code_m][$ar_code[$i]][$res['ID']]['status_result_title']=$res['STATUS_TITLE'];
				$ar_ri[$user_login][$code_m][$ar_code[$i]][$res['ID']]['family']=$family;
				$ar_ri[$user_login][$code_m][$ar_code[$i]][$res['ID']]['name']=$name;
				$ar_ri[$user_login][$code_m][$ar_code[$i]][$res['ID']]['sum_debt']=$sum_debt;
				
				
			}
			unset($f_arRes);
		}
		
	}	
	//echo "<pre>";print_r($ar_ri);echo "</pre>";
	$str = json_encode($ar_ri);
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
header('Content-Type: application/json; charset=UTF-8');
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