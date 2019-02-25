<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
//print_r($_POST);
$arParams['WEB_FORM_ID'] = intval($arParams['WEB_FORM_ID']);
$arParams['RESULT_ID'] = intval($arParams['RESULT_ID']);

$arParams['VIEW_URL']=str_replace(array('#WEB_FORM_ID#'),array($arParams['WEB_FORM_ID']), $arParams["VIEW_URL"]);
$arParams['NEW_URL']=str_replace(array('#WEB_FORM_ID#'),array($arParams['WEB_FORM_ID']), $arParams["NEW_URL"]);

if (!$arParams['RESULT_ID']) $arParams['RESULT_ID'] = '';

$arParams['NAME_TEMPLATE'] = empty($arParams['NAME_TEMPLATE'])
	? (method_exists('CSite', 'GetNameFormat') ? CSite::GetNameFormat() : "#NAME# #LAST_NAME#")
	: $arParams["NAME_TEMPLATE"];

$arResult=array();


if (CModule::IncludeModule("form"))
{
	$FORM_ID=$arParams["WEB_FORM_ID"];  //ID формы
	
	//  insert chain item
	if (strlen($arParams["CHAIN_ITEM_TEXT"]) > 0)
	{
		$APPLICATION->AddChainItem($arParams["CHAIN_ITEM_TEXT"], $arParams["CHAIN_ITEM_LINK"]);
	}

	// preparing additional parameters
	$arResult["FORM_ERROR"] = $_REQUEST["strError"];
	$arResult["FORM_NOTE"] = $_REQUEST["strFormNote"];


	$arParams["F_RIGHT"] = CForm::GetPermission($arParams["WEB_FORM_ID"]);

	if($arParams["F_RIGHT"] < 15) $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

	$arParams["isStatisticIncluded"] = CModule::IncludeModule("statistic");

	//////////////////////////////////////////////////////////////////
	


	


	if (CForm::GetDataByID($FORM_ID, 
		$form, 
		$questions, 
		$answers, 
		$dropdown, 
		$multiselect))
	{
		//echo "<pre>";
		   // print_r($form);
		   // print_r($questions);
		   // print_r($answers);
		   // print_r($dropdown);
		   // print_r($multiselect);
		//echo "</pre>";
	}
	
	
	foreach($answers as $key => $val) {
		$field_type=$val[0]['FIELD_TYPE'];
		if(!in_array($key, $arParams["EXCLUDED_FROM_PROCESSING"]) AND ($field_type=="dropdown" OR $field_type=="multiselect" OR $field_type=="radio" OR $field_type=="checkbox")) {
			
			foreach($val as $v) {
				$ar_answers_stat[$key]['ANSWER'][$v['ID']]['MESSAGE']=$v['MESSAGE'];
				$ar_answers_stat[$key]['ANSWER'][$v['ID']]['FIELD_TYPE']=$v['FIELD_TYPE'];
				$ar_answers_stat[$key]['QUESTION']['COUNT_ANSWER']++;
			}
		$ar_sid_questions[]=$key;
		$ar_answers_stat[$key]['QUESTION']['SID']=$key;
		$ar_answers_stat[$key]['QUESTION']['ID']=$questions[$key]['ID'];
		$ar_answers_stat[$key]['QUESTION']['TITLE']=$questions[$key]['TITLE'];
		$ar_answers_stat[$key]['QUESTION']['COMMENTS']=$questions[$key]['COMMENTS'];
		}
	}
$arResult["COUNT_QUESTION"]=count($ar_sid_questions);	
	
// сформируем массив фильтра
$arFilter_Questions = Array(

  "SID"                   => implode(" | ",$ar_sid_questions),   // символьный идентификатор

);

// получим список всех вопросов веб-формы 
$rsQuestions = CFormField::GetList(
    $FORM_ID, 
    "N", 
    $by="s_id", 
    $order="desc", 
    $arFilter_Questions, 
    $is_filtered
    );
while ($arQuestion = $rsQuestions->Fetch())
{
  //  echo "<pre>"; print_r($arQuestion); echo "</pre>";
}
	
	//echo "<pre>";print_r($arParams["EXCLUDED_FROM_PROCESSING"]);echo "</pre>";
	//echo "<pre>";print_r($ar_answers_stat);echo "</pre>";
	
		$rsStatuses = CFormStatus::GetList(
		$FORM_ID, 
		$by="s_sort", 
		$order="asc", 
		$ar_status_Filter, 
		$is_status_filtered
		);
		if(is_array($arParams["SHOW_FILTER_STATUS"])) {
			$count_p_sfs=count($arParams["SHOW_FILTER_STATUS"]);
		}
		else $count_p_sfs=0;
	while ($arStatus = $rsStatuses->Fetch())
	{
		if($count_p_sfs) 
		{
			if($arStatus["ACTIVE"]=="Y" and in_array($arStatus["ID"],$arParams["SHOW_FILTER_STATUS"]))
			{
				$arResult["STATUS"][$arStatus["ID"]]["ID"]=$arStatus["ID"];
				$arResult["STATUS"][$arStatus["ID"]]["CSS"]=$arStatus["CSS"];
				$arResult["STATUS"][$arStatus["ID"]]["TITLE"]=$arStatus["TITLE"];
				$arResult["STATUS"][$arStatus["ID"]]["DESCRIPTION"]=$arStatus["DESCRIPTION"];
				$arResult["STATUS"][$arStatus["ID"]]["RESULTS"]=$arStatus["RESULTS"];
			}
		}
		else 
		{
			if($arStatus["ACTIVE"]=="Y")
			{
				$arParams["SHOW_FILTER_STATUS"][]=$arStatus["ID"];
				
				$arResult["STATUS"][$arStatus["ID"]]["ID"]=$arStatus["ID"];
				$arResult["STATUS"][$arStatus["ID"]]["CSS"]=$arStatus["CSS"];
				$arResult["STATUS"][$arStatus["ID"]]["TITLE"]=$arStatus["TITLE"];
				$arResult["STATUS"][$arStatus["ID"]]["DESCRIPTION"]=$arStatus["DESCRIPTION"];
				$arResult["STATUS"][$arStatus["ID"]]["RESULTS"]=$arStatus["RESULTS"];
			}
		}
	}
	
	if($_REQUEST["find_status_id"] AND !in_array("",$_REQUEST["find_status_id"])) {$status_id=implode("|",$_REQUEST["find_status_id"]);}
	else $status_id=implode("|",$arParams["SHOW_FILTER_STATUS"]);
	
	$arFilter = array(
  
    "STATUS_ID" => $status_id,          // статус

    );
	$rs_listResults = CFormResult::GetList(
		$FORM_ID, 
		($by="s_timestamp"), 
		($order="desc"), 
		$arFilter, 
		$is_filtered,
		"N"
	);
	$count_result=0;	
	while ($ar_listResult = $rs_listResults->Fetch())
	{
		//echo "<pre>"; print_r($ar_listResult); echo "</pre>";
		$arAnswer = CFormResult::GETDataByID(
		$ar_listResult["ID"], 
		$ar_sid_questions,  // массив символьных кодов необходимых вопросов
		$ar_Res, 
		$ar_Answer2); 
		//echo "<pre>"; print_r($arAnswer); echo "</pre>";
		foreach($arAnswer  as $key => $val) {
			foreach($val  as $k => $v) {
				$ar_answers_stat[$key]['ANSWER'][$v['ANSWER_ID']]['SUM']++;
				$ar_answers_stat[$key]['QUESTION']['TOTAL_SUM']++;
				
			}
		}
		$count_result++;
	}	
	//echo $count_result;
	$arResult["COUNT_RESULT"]=$count_result;
	
	foreach($ar_answers_stat as $key => $val) {
		foreach($val['ANSWER']  as $k => $v) {
			//echo round(($ar_answers_stat[$key]['ANSWER'][$k]['SUM']*100/$count_result),1)."<br />";
				$ar_answers_stat[$key]['ANSWER'][$k]['PERCENT']=round(($ar_answers_stat[$key]['ANSWER'][$k]['SUM']*100/$ar_answers_stat[$key]['QUESTION']['TOTAL_SUM']),2);
				
			}
	}
	
	//$ar_answers_stat[$key]['ANSWER'][$v['ANSWER_ID']]['PERCENT']=($ar_answers_stat[$key]['ANSWER'][$v['ANSWER_ID']]['SUM'])*100/($arResult["COUNT_QUESTION"]);
	$ar_answers_list=array_values($ar_answers_stat);
	

	

	
	if($arResult["COUNT_QUESTION"]) {
		$total=intval(($arResult["COUNT_QUESTION"] - 1) / $arParams["PAGE_SIZE"]) + 1; // общее число страниц 
		$page = intval($_REQUEST['PAGEN_1']);  // начало сообщений для текущей страницы 
		if(empty($page) or $page < 0) $page = 1; //Если значение $page меньше единицы или отрицательно, переходим на первую страницу 
		if($page > $total) $page = $total;  //Если значение $page больше общего числа страниц, переходим на последнюю 
		$start = $page * $arParams["PAGE_SIZE"]- $arParams["PAGE_SIZE"]; // с какого номера выводить
		if($arParams["PAGE_SIZE"]<$arResult["COUNT_QUESTION"]) $finish=$start+$arParams["PAGE_SIZE"];// до какого номера выводить
		else $finish=$arResult["COUNT_QUESTION"];// до какого номера выводить
		
		if($_REQUEST["SHOWALL_1"]==1){
			$start=0;
			$finish=$arResult["COUNT_QUESTION"];
		}
		for($i=$start;$i<$finish;$i++) {
			//$ar_list_str[]=$ar_sid_questions[$i];
			$arResult["RESULT"][]=$ar_answers_list[$i];
		}

		$arParams["PAGER_TEMPLATE"] = trim($arParams["PAGER_TEMPLATE"]);
		
		if($total>1 OR $arParams["PAGER_SHOW_ALWAYS"]=="Y") {
			$rsQuestions->NavStart($arParams["PAGE_SIZE"], true);
			$arResult["NavPageCount"]=$rsQuestions->NavPageCount;
			$arResult["NavPageNomer"]=$rsQuestions->NavPageNomer;
			$arResult["NAV_STRING"] = $rsQuestions->GetPageNavStringEx($navComponentObject, "", $arParams["PAGER_TEMPLATE"], "Y"); 
		}

	}
	else $arResult["NAV_STRING"]=GetMessage("NOT_NAV_STRING");

	//echo "<pre>";print_r($arParams);echo "</pre>";
	//echo "<pre>";print_r($arResult);echo "</pre>";


	///////////////////////////////////////////////////////////////////

	if (strlen($GLOBALS['strError']) > 0)
		$arResult["FORM_ERROR"] .= $GLOBALS['strError'];

	if (intval($arParams["WEB_FORM_ID"])>0)
		$dbres = CForm::GetByID($arParams["WEB_FORM_ID"]);
	else
		$dbres = CForm::GetBySID($arParams["WEB_FORM_NAME"]);

	// get form info
	if ($arParams["arFormInfo"] = $dbres->Fetch())
	{
		$GLOBALS["WEB_FORM_ID"] = $arParams["WEB_FORM_ID"] = $arParams["arFormInfo"]["ID"];
		$GLOBALS["WEB_FORM_NAME"] = $arParams["WEB_FORM_NAME"] = $arParams["arFormInfo"]["SID"];

		// check form params
		$arParams["USER_ID"] = $USER->GetID();
		$this->IncludeComponentTemplate();
	}
	else
	{
		echo ShowError(GetMessage("FORM_INCORRECT_FORM_ID"));
	}
}
else
{
	echo ShowError(GetMessage("FORM_MODULE_NOT_INSTALLED"));
}
?>