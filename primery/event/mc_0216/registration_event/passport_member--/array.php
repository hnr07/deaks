<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?  CModule::IncludeModule('form'); // подключаем модуль форма ?>

<?
$lim=5;             //лимит паспортов участника
$FORM_ID_P = 7;    // id формы паспортов участника
global $USER;

// фильтр по полям результата
	$arFilter_p = array(

	    "USER_ID"              => $USER->GetId(),         // пользователь-автор
	    "USER_ID_EXACT_MATCH"  => "Y",               // точное совпадение

		);
	$rsResults_p = CFormResult::GETList($FORM_ID_P, 
		($by="s_timestamp"), 
		($order="desc"), 
		$arFilter_p, 
		$is_filtered_p, 
		"Y",
		false);

while ($arResult_p = $rsResults_p->Fetch())
	{ 
		//echo "<pre>";print_r($arResult_p);echo "</pre>";
		$RESULT_ID_P=$arResult_p['ID'];
		$arAnswer_p = CFormResult::GETDataByID(
		$RESULT_ID_P, 
		array('title'),  // массив символьных кодов необходимых вопросов
		$ar_Res_p, 
		$ar_Answer2_p);
		$ar_title_p[]=$arAnswer_p["title"][0]["USER_TEXT"];
		$ar_id_p[]=$RESULT_ID_P;
		//echo "<pre>";print_r($arAnswer_p);echo "</pre>";
	}
	
$cp=count($ar_id_p);	
//echo "<pre>";print_r($ar_id_p);echo "</pre>";
?>

<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>