<?
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//$APPLICATION->SetTitle("Статистика по площадкам");
?>
<?
 include "var_config.php"; 
 include "venue_array.php"; 
CModule::IncludeModule("iblock"); // подключаем модуль инфоблок
CModule::IncludeModule('form'); // подключаем модуль форма 
global $st_v;
$st_v=$status_ok."|".$status_nepr."|".$status_opl."|".$status_nopl."|".$status_rz;

function meter_venue($form_m,$id_venue) {
	global $st_v;
		$arFilter = array("STATUS_ID"=> $st_v, );
		$arFields = array();
		
		$arFields[] = array(
			"CODE"              => "id_venue",     // код поля по которому фильтруем
			"FILTER_TYPE"       => "text",          // фильтруем по числовому полю
			"PARAMETER_NAME"    => "USER",          // фильтруем по введенному значению
			"VALUE"             => $id_venue,        // значение по которому фильтруем
			"EXACT_MATCH"       => "Y"              // ищем точное совпадение
			);
		$arFilter["FIELDS"] = $arFields;	
		$rsResults = CFormResult::GetList($form_m, 
		($by="s_timestamp"), 
		($order="desc"), 
		$arFilter, 
		$is_filtered, 
		"Y" 
		);
		//echo "<pre>"; print_r($arFilter); echo "</pre>";
	while ($arResult = $rsResults->Fetch())
	{
		//echo "<pre>"; print_r($arResult); echo "</pre>";
		$ar_status[$arResult["STATUS_ID"]]["STATUS_TITLE"]=$arResult["STATUS_TITLE"];
		$ar_status[$arResult["STATUS_ID"]]["ID"][]=$arResult["ID"];
	}
	//echo "<pre>"; print_r($ar_status); echo "</pre>";
	return $ar_status;
}
$i=0;

foreach($ar_vlm as $kv=>$vv) {
	 $ar_vlm_meter[$i]["ID"]=$kv;
	 $ar_vlm_meter[$i]["name"]=$vv["name"];
	$i++;
}

//echo"<pre>";print_r($ar_vlm_meter);echo"</pre>";

?>

<?

$ar_obs=array();
for($j=0;$j<$i;$j++) {
	?>

<?	
	
	$ar_r=meter_venue($form_m,$ar_vlm_meter[$j]["ID"]);
	$osc=0; $osr=0;
	$astatus=array();
	foreach($ar_r as $k=>$val) {
		$astatus[$val["STATUS_TITLE"]]=count($val["ID"]);
		$osc+=count($val["ID"]); // всего заявок
		if($k==$status_rz) $osr+=count($val["ID"]); // всего заявок в статусе резерв
		$ar_obs[$val["STATUS_TITLE"]]+=count($val["ID"]); // всего заявок по статусам
	}
	

	
	$ar_osc[$ar_vlm_meter[$j]["ID"]]=$arc_volona_mesto[$ar_vlm_meter[$j]["ID"]]-$osc-$arc_volona_bron[$ar_vlm_meter[$j]["ID"]];
?>

<?


	$ar_venue_mesto[$ar_vlm_meter[$j]["ID"]]["ID"]=$ar_vlm_meter[$j]["ID"];
	$ar_venue_mesto[$ar_vlm_meter[$j]["ID"]]["name"]=$ar_vlm_meter[$j]["name"];
	$ar_venue_mesto[$ar_vlm_meter[$j]["ID"]]["status"]=$astatus;
	$ar_venue_mesto[$ar_vlm_meter[$j]["ID"]]["reg"]=$osc;
	$ar_venue_mesto[$ar_vlm_meter[$j]["ID"]]["mesto"]=$ar_vlm[$ar_vlm_meter[$j]["ID"]]["mesto"];
	$ar_venue_mesto[$ar_vlm_meter[$j]["ID"]]["bron"]=$ar_vlm[$ar_vlm_meter[$j]["ID"]]["bron"];
	$ar_venue_mesto[$ar_vlm_meter[$j]["ID"]]["ostatok"]=$ar_vlm[$ar_vlm_meter[$j]["ID"]]["mesto"]-$osc+$osr-$ar_vlm[$ar_vlm_meter[$j]["ID"]]["bron"];
	
	
	unset($ar_r,$osc);
}

?>


<?//echo "<pre>";print_r($ar_venue_mesto);echo "</pre>";?>

<? //require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>