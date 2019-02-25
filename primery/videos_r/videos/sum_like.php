<?if($_POST["fa"]) require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
global $USER;
// видимость результата 
$df=1; // $USER->IsAdmin()- только админам, 0 - никому, 1 - всем

if ($df) {
	if(CModule::IncludeModule("form")){
		// ID веб-формы
		$FORM_ID = 6;

			$arFilter = array(
		   
			);
			
			// фильтр по вопросам
			
		$arFields = array();

		$arFilter["FIELDS"] = $arFields;
		
				// выберем (первые) все результатов
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
				array('id_video'),  // массив символьных кодов необходимых вопросов
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