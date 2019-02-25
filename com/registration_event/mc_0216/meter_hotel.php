<?
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//$APPLICATION->SetTitle("Title");
?>
<? include "var_config.php"; ?>
<? include "venue_array.php"; ?>
<? include "hotel_array.php"; ?>
<?  CModule::IncludeModule('form'); // подключаем модуль форма ?>

<?

 $FORM_ID = $form_m; // ID веб-формы
 $ar_fist=array($status_ok, $status_nepr, $status_nopl, $status_opl, $status_no);// массив необходимых статусов
$fist=implode(" | ", $ar_fist); // строка фильтра статусов результата

//echo "<pre>";print_r($ar_vlm);echo "</pre>";
foreach($ar_vlm as $k=>$v) {
		
	//echo $k."<br>";
// фильтр по полям результата
	$marFilter = array("STATUS_ID" => $fist);
	// фильтр по вопросам

	$marFields = array();

	$marFields[] = array
	(
		"SID" => "id_venue",                     	// символьный идентификатор вопроса 
		"FILTER_TYPE"       => "text",          // фильтруем по id поля
		"PARAMETER_NAME" => "USER",         // параметр выборки по названию radio"
		"VALUE" => $k                         // id поля
	);
	$marFilter["FIELDS"] = $marFields;
			
		$marResults = CFormResult::GetList($FORM_ID, 
			($by="s_timestamp"), 
			($order="asc"), 
			$marFilter, 
			$is_filtered, 
			"N"
			);
		while ($marResult = $marResults->Fetch())
		{
			//echo "<pre>"; print_r($arResult); echo "</pre>";
				$RESULT_ID=$marResult['ID'];
				$status_id=$marResult['STATUS_ID'];
				$status=$marResult['STATUS_TITLE'];
			$arAnswer = CFormResult::GETDataByID(
				$RESULT_ID, 
				array('id_hotel',"id_nomer","p_hotel"),  // массив символьных кодов необходимых вопросов
				$ar_Res, 
				$ar_Answer2); 
				if($arAnswer["p_hotel"][0]["ANSWER_VALUE"]=="r_comp") {
					$ar_ven[$k][$arAnswer["id_hotel"][0]["USER_TEXT"]][$arAnswer["id_nomer"][0]["USER_TEXT"]]+=1; // кол-во чел в номере (по типу номера)
					$ar_ven_nom[$k][$arAnswer["id_hotel"][0]["USER_TEXT"]][$arAnswer["id_nomer"][0]["USER_TEXT"]]+=(1/$ar_hot[$k]["nomer"][$arAnswer["id_nomer"][0]["USER_TEXT"]]["size"]); // номеров занято, без округления(по типу номера)
					$ar_ven_sum[$k][$arAnswer["id_hotel"][0]["USER_TEXT"]]+=1;  // кол-во чел в отеле 
				}
		}
		
}
//echo "<pre>"; print_r($ar_ven); echo "</pre>";
//echo "<pre>"; print_r($ar_ven_sum); echo "</pre>";
//echo "<pre>"; print_r($ar_ven_nom); echo "</pre>";


?>

<?
// Исходное количество отелей
foreach($ar_knora as $kiv=>$viv) {
	foreach($viv['hotel'] as $hiv=>$niv) {
		//echo "<pre>"; print_r($niv); echo "</pre>";
		$sum_nom_os[$kiv][$hiv]=$niv['quantity']-$ar_bron[$kiv]["hotel"][$hiv]["reserv"]; //Номеров в отеле 
	}
}
// Корректировка количества свободных номеров с учётом занятых
foreach($ar_ven as $k_venue => $val_venue) {
	foreach($val_venue as $k_hotel => $val_hotel) {
		$sum_nom[$k_venue][$k_hotel]=0;
		foreach($val_hotel as $k_nomer => $val_nomer) {
			$sum_nom[$k_venue][$k_hotel]+=ceil($ar_ven_nom[$k_venue][$k_hotel][$k_nomer]); //Номеров занято
			$sum_nom_os[$k_venue][$k_hotel]-=$sum_nom[$k_venue][$k_hotel];  //Номеров свободно
		}
	}
}
//echo "<pre>"; print_r($sum_nom); echo "</pre>";
//echo "<pre>"; print_r($sum_nom_os); echo "</pre>";



?>

 <?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>