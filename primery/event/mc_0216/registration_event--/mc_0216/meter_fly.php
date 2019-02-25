<?
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//$APPLICATION->SetTitle("Title");
?>
<? include "var_config.php"; ?>
<? include "venue_array.php"; ?>
<? include "fly_array.php"; ?>
<?  CModule::IncludeModule('form'); // подключаем модуль форма ?>

<?

 $FORM_ID = $form_m; // ID веб-формы
 $ar_fist=array($status_ok, $status_nepr, $status_nopl, $status_rz, $status_opl, $status_no);// массив необходимых статусов
$fist=implode(" | ", $ar_fist); // строка фильтра статусов результата

//echo "<pre>";print_r($ar_vlm);echo "</pre>";
foreach($ar_vlm as $k=>$v) {
	//echo $k."<br>";
// фильтр по полям результата
	$farFilter = array("STATUS_ID" => $fist);
	// фильтр по вопросам

	$farFields = array();

	$farFields[] = array
	(
		"SID" => "id_venue",                     	// символьный идентификатор вопроса 
		"FILTER_TYPE"       => "text",          // фильтруем по id поля
		"PARAMETER_NAME" => "USER",         // параметр выборки по введённому значению"
		"VALUE" => $k                         // id поля
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
				array('id_fly_1',"id_fly_2","p_fly"),  // массив символьных кодов необходимых вопросов
				$ar_Res, 
				$ar_Answer2); 
				if($arAnswer["p_fly"][0]["ANSWER_VALUE"]=="r_comp") {
					$sum_fly[$k][$arAnswer["id_fly_1"][0]["USER_TEXT"]][1]+=1; // кол-во человек на рейс
					$sum_fly[$k][$arAnswer["id_fly_2"][0]["USER_TEXT"]][2]+=1; // кол-во человек на рейс
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