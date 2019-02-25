<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?

$arParams['WEB_FORM_ID'] = intval($arParams['WEB_FORM_ID']);
$arParams['RESULT_ID'] = intval($arParams['RESULT_ID']);
if (!$arParams['RESULT_ID']) $arParams['RESULT_ID'] = '';

$arParams['NAME_TEMPLATE'] = empty($arParams['NAME_TEMPLATE'])
	? (method_exists('CSite', 'GetNameFormat') ? CSite::GetNameFormat() : "#NAME# #LAST_NAME#")
	: $arParams["NAME_TEMPLATE"];

	
	if($arParams["ENABLE_STATUS_EDIT"]=="Y" || ($arParams["ENABLE_RESULT_EDIT"]=="Y" AND $arParams["EDIT_URL"]!="") || ($arParams["ENABLE_RESULT_COPY"]=="Y" AND $arParams["COPY_URL"]!="") || ($arParams["ENABLE_RESULT_VIEW"]=="Y" AND $arParams["VIEW_URL"]!=""))
	{
		$arParams["ACTION"]="Y";          // Разрешить обработку результата
	}
	else
	{
		$arParams["ACTION"]="N";          // Не разрешать обработку результата
	}


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
	
	if(isset($_REQUEST["but_edit_status"])) {
		CFormResult::SetStatus($_REQUEST["res_id_s"], $_REQUEST["edit_status_id"], "Y");
	}
	if(isset($_REQUEST["but_del"])) {
		CFormResult::Delete($_REQUEST["del_id"]);
	}

	$arResult=array();


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
		    //print_r($answers);
		   // print_r($dropdown);
		   // print_r($multiselect);
		//echo "</pre>";
	}
	$ar_col=array(); // массив полей

	foreach($questions as $val){
		if($val["ACTIVE"]=="Y") {
			$ar_col[$val["SID"]]["ID"]=$val["ID"];
			$ar_col[$val["SID"]]["TITLE"]=$val["TITLE"];
			$ar_col[$val["SID"]]["SID"]=$val["SID"];
			$ar_col[$val["SID"]]["IN_FILTER"]=$val["IN_FILTER"];
			foreach($answers[$val["SID"]] as $k=>$v)
			{
				$ar_col[$val["SID"]]["ANSWER_ID"][]=$v["ID"];
				$ar_col[$val["SID"]]["FIELD_TYPE"][]=$v["FIELD_TYPE"];
				if($arParams["FIELD_QUICK_SEARCH"]==$val["SID"]) 
				{
					$arResult["QUICK_SEARCH_ID"][]=$v["ID"];
				}
			}
			
			
			$ar_col[$val["SID"]]["C_SORT"]=$val["C_SORT"];
		}	
	}
		
	$arResult["ARRAY_COL"]=$ar_col;
	
	// ID ответа поля для быстрого поиска
	if($arParams["FIELD_QUICK_SEARCH"])
	{
		$arResult["QUICK_SEARCH_ID_STR"]=implode(",",$arResult["QUICK_SEARCH_ID"]);
		$arResult["QUICK_SEARCH_TITLE"]=$ar_col[$arParams["FIELD_QUICK_SEARCH"]]["TITLE"]; 
	}
	else 
	{
	$arResult["QUICK_SEARCH_ID_STR"]="";
	$arResult["QUICK_SEARCH_TITLE"]="";
	}
	//echo "<pre>"; print_r($arResult["ARRAY_COL"]); echo "</pre>";
	/*
	foreach($ar_col as $val){
		$QUESTION_ID = $val["ID"]; // ID вопроса

		// получим список всех ответов вопроса
		$rsAnswers = CFormAnswer::GetList(
			$QUESTION_ID, 
			$by="s_id", 
			$order="desc", 
			$arFilter, 
			$is_filtered
			);
		while ($arAnswer = $rsAnswers->Fetch())
		{
			//echo "<pre>"; print_r($arAnswer); echo "</pre>";
		}
	}
	*/
	if($FORM_ID>0)
	{
		$dir_tools="./tools_user_form_".$FORM_ID."/";
		if(!file_exists ($dir_tools)) mkdir($dir_tools, 0775);
		$file_tools="admin_list_".$USER->GetID().".txt";
		
		if(isset($_REQUEST["but_s"])) {

			foreach($ar_col as $val){
				if(is_numeric($_REQUEST["no_col_".$val["SID"]])) $ar_tc[$val["SID"]]=$_REQUEST["no_col_".$val["SID"]];
				if($_REQUEST["no_filter_".$val["SID"]]==$val["SID"]) $ar_fr[]=$val["SID"];
			}
			asort($ar_tc);
			$ar_tc=array_keys($ar_tc);
			$text_tool="";
			$text_tool.=implode("#",$ar_tc);
			$text_tool.="~~~";
			$text_tool.=implode("#",$ar_fr);
			$text_tool.="~~~";
			if(is_numeric($_REQUEST["pstr"])) $text_tool.=$_REQUEST["pstr"];
			$text_tool.="~~~".str_replace("~~~","~-~",htmlspecialchars(trim($_REQUEST["sticker"])));
			
			$fr=@fopen($dir_tools.$file_tools,"w");
			if (fwrite($fr, $text_tool) === FALSE) {
				$arResult["FORM_ERROR"][] = GetMessage("NOT_EDIT_TOOLS");
			}
			else $_SESSION["text_tool_".$FORM_ID]=$text_tool;
			@fclose($fr);
			$_SESSION["show_sticker_".$FORM_ID]=1;
		}

		if(!$_SESSION["text_tool_".$FORM_ID]) {
			
			if(file_exists ($dir_tools.$file_tools)) {
			$fr=fopen($dir_tools.$file_tools,"r");
				$text_tool=fread($fr,filesize($dir_tools.$file_tools));
				fclose($fr);
			}
			$_SESSION["text_tool_".$FORM_ID]=$text_tool;
		}
		else {$text_tool=$_SESSION["text_tool_".$FORM_ID];}
	}
	if($text_tool) {
		$ar_tool=explode("~~~",$text_tool);
		if($ar_tool[0]) $ar_final_col=explode("#",$ar_tool[0]);
		if($ar_tool[1]) $ar_final_filter=explode("#",$ar_tool[1]);
		if($ar_tool[2]) $arParams["PAGE_SIZE"]=$ar_tool[2];
		if($ar_tool[3]) $arParams["STICKER"]=$ar_tool[3];
	}
	$arResult["ARRAY_FINAL_COL"]=$ar_final_col;
	$arResult["ARRAY_FINAL_FILTER"]=$ar_final_filter;
	foreach($ar_final_col as $val){
		$arResult["TABLE_HEAD_TITLE"][]=$questions[$val]["TITLE"]; // массив наименований вопросов формы
	}


		$ar_col_filter=array();  // массив полей фильтра
	foreach($ar_final_filter as $val) 
	{
		$ar_col_filter[$val]["ID"]=$questions[$val]["ID"];
		$ar_col_filter[$val]["SID"]=$questions[$val]["SID"];
		$ar_col_filter[$val]["TITLE"]=$questions[$val]["TITLE"];
		$ar_col_filter[$val]["FIELD_TYPE"]=$answers[$val][0]["FIELD_TYPE"];
		$ar_col_filter[$val]["TEXT_FILTER"]=array();
		switch($answers[$val][0]["FIELD_TYPE"])
		{
			case "radio": 
				$ar_col_filter[$val]["TEXT_FILTER"]=CForm::GetDropDownFilter(
						$questions[$val]["ID"], 
						"ANSWER_TEXT", 
							$form["SID"]."_".$questions[$val]["SID"]
						);
			break;
			case "checkbox": 
				$ar_col_filter[$val]["TEXT_FILTER"]=CForm::GetDropDownFilter(
						$questions[$val]["ID"], 
						"ANSWER_TEXT", 
							$form["SID"]."_".$questions[$val]["SID"]
						);
			break;
			case "dropdown": 
				$ar_col_filter[$val]["TEXT_FILTER"]=CForm::GetDropDownFilter(
						$questions[$val]["ID"], 
						"ANSWER_TEXT", 
							$form["SID"]."_".$questions[$val]["SID"]
						);
			break;
			case "multiselect": 
				$ar_col_filter[$val]["TEXT_FILTER"]=CForm::GetDropDownFilter(
						$questions[$val]["ID"], 
						"ANSWER_TEXT", 
							$form["SID"]."_".$questions[$val]["SID"]
						);
			break;
			case "date": 
				$ar_col_filter[$val]["TEXT_FILTER"]=CForm::GetDateFilter($form["SID"]."_".$questions[$val]["SID"], "", "", "");
			break;
			default:
				$ar_col_filter[$val]["TEXT_FILTER"]=CForm::GetTextFilter($form["SID"]."_".$questions[$val]["SID"], 0, "", "");
			break;
		}

		$i=0;
		foreach($answers[$val] as $val_ans){
			$ar_col_filter[$val]["ANSWER"][$i]["ID"]=$val_ans["ID"];
			$ar_col_filter[$val]["ANSWER"][$i]["MESSAGE"]=$val_ans["MESSAGE"];
			$i++;
		}
	}
	$arResult["ARRAY_COL_FILTER"]=$ar_col_filter;
	
	

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
		if($arParams["OLD_RESULT_STATUS"]==$arStatus["ID"]) 
		{
			$arParams["OLD_RESULT_STATUS_TITLE"]=$arStatus["TITLE"];
		}
		if($arParams["NEW_RESULT_STATUS"]==$arStatus["ID"]) 
		{
			$arParams["NEW_RESULT_STATUS_TITLE"]=$arStatus["TITLE"];
		}
	}
	$arParams["STR_STATUS_DEFAULT"]=implode(",",$arParams["SHOW_FILTER_STATUS"]); // строка id статусов 
	$arFilter = array();// фильтр по вопросам
	$arFields = array();// фильтр по ответам

	if(isset($_REQUEST["remove_filter"])) unset($_SESSION["FILTER_QUERY_STRING"]);
	if(isset($_REQUEST["install_filter"]) || isset($_SESSION["FILTER_QUERY_STRING"])) 
	{
		if(isset($_REQUEST["install_filter"])) $_SESSION["FILTER_QUERY_STRING"]=$_SERVER["QUERY_STRING"];
		if(!isset($_REQUEST["install_filter"]) && isset($_SESSION["FILTER_QUERY_STRING"])) {
			if(strpos($_SERVER["REQUEST_URI"],"?")) {$url_n=$_SERVER["REQUEST_URI"]."&".$_SESSION["FILTER_QUERY_STRING"];}
			else {$url_n=$_SERVER["REQUEST_URI"]."?".$_SESSION["FILTER_QUERY_STRING"];}
				LocalRedirect($url_n);
		}
		
		$ke_s = array_search("", $_REQUEST["find_status_id"]);
			if ($ke_s !== false) unset($_REQUEST["find_status_id"][$ke_s]);
			if($_REQUEST["find_status_id"]) $status_id=implode("|",$_REQUEST["find_status_id"]);
			else $status_id=implode("|",$arParams["SHOW_FILTER_STATUS"]);
			
		$arFilter = Array(
			"ID" => $_REQUEST["find_".$form["SID"]."_id_result"],
			"STATUS_ID" => $status_id,
			"ID_EXACT_MATCH" => ($_REQUEST["find_".$form["SID"]."_id_result_exact_match"])?$_REQUEST["find_".$form["SID"]."_id_result_exact_match"]:"N",
		);

		foreach($ar_col_filter as $key=>$val) {
			
				switch ($val["FIELD_TYPE"]) {
				case "radio":
					if($_REQUEST["find_".$form["SID"]."_".$val["SID"]]) 
					{
						$arFields[]=array(
							"SID" => $key,       // код поля по которому фильтруем
							"FILTER_TYPE"       => "answer_id",  //проверка совпадения по id ответа
							"PARAMETER_NAME"    => "ANSWER_TEXT",         
							"VALUE" => $_REQUEST["find_".$form["SID"]."_".$val["SID"]]
						);
					}
					break;
				case "checkbox":
					if($_REQUEST["find_".$form["SID"]."_".$val["SID"]]) 
					{
						$arFields[]=array(
							"SID" => $key,       // код поля по которому фильтруем
							"FILTER_TYPE"       => "answer_id",  //проверка совпадения по id ответа
							"PARAMETER_NAME"    => "ANSWER_TEXT",         
							"VALUE" => $_REQUEST["find_".$form["SID"]."_".$val["SID"]]
						);
					}
					break;
				case "multiselect":
					if($_REQUEST["find_".$form["SID"]."_".$val["SID"]]) 
					{
						$arFields[]=array(
							"SID" => $key,       // код поля по которому фильтруем
							"FILTER_TYPE"       => "answer_id",  //проверка совпадения по id ответа
							"PARAMETER_NAME"    => "ANSWER_TEXT",         
							"VALUE" => $_REQUEST["find_".$form["SID"]."_".$val["SID"]]
						);
					}
					break;
				case "dropdown":
					if($_REQUEST["find_".$form["SID"]."_".$val["SID"]]) 
					{
						$arFields[]=array(
							"SID" => $key,       // код поля по которому фильтруем
							"FILTER_TYPE"       => "answer_id",  //проверка совпадения по id ответа
							"PARAMETER_NAME"    => "ANSWER_TEXT",         
							"VALUE" => $_REQUEST["find_".$form["SID"]."_".$val["SID"]]
						);
					}
					break;
				case "date":
					if($_REQUEST["find_".$form["SID"]."_".$val["SID"]."_1"]) 
					{
						$arFields[]=array(
							"SID" => $key,       // код поля по которому фильтруем
							"FILTER_TYPE"       => "date",  //проверка совпадения по id ответа
							"PARAMETER_NAME"    => "USER",         
							"VALUE" => $_REQUEST["find_".$form["SID"]."_".$val["SID"]."_1"],
							"PART"              => 1                
						);
					}
					if($_REQUEST["find_".$form["SID"]."_".$val["SID"]."_2"]) 
					{
						$arFields[]=array(
							"SID" => $key,       // код поля по которому фильтруем
							"FILTER_TYPE"       => "date",  //проверка совпадения по id ответа
							"PARAMETER_NAME"    => "USER",         
							"VALUE" => $_REQUEST["find_".$form["SID"]."_".$val["SID"]."_2"],
							"PART"              => 2                
						);
					}
					break;
				default:
					if($_REQUEST["find_".$form["SID"]."_".$val["SID"]]) 
						{
							$arFields[]=array(
								"SID" => $key,       // код поля по которому фильтруем
								"FILTER_TYPE"       => "text",  //проверка совпадения по id ответа
								"PARAMETER_NAME"    => "USER",         
								"VALUE" => $_REQUEST["find_".$form["SID"]."_".$val["SID"]],
								"EXACT_MATCH" => ($_REQUEST["find_".$form["SID"]."_".$val["SID"]."_exact_match"])?$_REQUEST["find_".$form["SID"]."_".$val["SID"]."_exact_match"]:"N"
							);
						}
						break;
				}
			
		}
	}
	else {
		$arFilter = Array(
			"STATUS_ID"=> implode("|",$arParams["SHOW_FILTER_STATUS"]),
			);
			
		if(isset($_REQUEST["result_view"])) {
		$arFilter = Array(
			"ID"=> $_REQUEST["result_view"],
			);

		}
	}
	
	$arResult["ID_RESULT_TEXT_FILTER"]=CForm::GetTextFilter($form["SID"]."_id_result", 0, "", "");
	
	$arFilter["FIELDS"]=$arFields;
	
	$rs_listResults = CFormResult::GetList($FORM_ID, 
		($by="s_timestamp"), 
		($order="desc"), 
		$arFilter, 
		$is_filtered );

	//	echo "<pre>"; print_r($arFilter); echo "</pre>";
	while ($ar_listResult = $rs_listResults->Fetch())
	{
		//echo "<pre>"; print_r($ar_listResult); echo "</pre>";
		$ar_list_id[]=$ar_listResult["ID"]; //массив всех id записей по фильтру
		$ar_list_res[$ar_listResult["ID"]]=array( //массив всех записей с ключём id по фильтру
			"USER_ID"=>$ar_listResult["USER_ID"],  // создатель
			"STATUS_ID"=>$ar_listResult["STATUS_ID"], // id статуса
			"DATE_CREATE"=>$ar_listResult["DATE_CREATE"], // дата создания
			"TIMESTAMP_X"=>$ar_listResult["TIMESTAMP_X"], // дата последнего изменения
			"STATUS_TITLE"=>$ar_listResult["STATUS_TITLE"] // наименование статуса
			);
	}
		//echo "<pre>"; print_r($ar_list_id); echo "</pre>";
		//echo "<pre>"; print_r($ar_final_col); echo "</pre>";

	$arResult["COUNT_RESULT"]=count($ar_list_id);
	if($arResult["COUNT_RESULT"]) {
		$total=intval(($arResult["COUNT_RESULT"] - 1) / $arParams["PAGE_SIZE"]) + 1; // общее число страниц 
		$page = intval($_REQUEST['PAGEN_1']);  // начало сообщений для текущей страницы 
		if(empty($page) or $page < 0) $page = 1; //Если значение $page меньше единицы или отрицательно, переходим на первую страницу 
		if($page > $total) $page = $total;  //Если значение $page больше общего числа страниц, переходим на последнюю 
		$start = $page * $arParams["PAGE_SIZE"]- $arParams["PAGE_SIZE"]; // с какого номера выводить
		$finish=$start+$arParams["PAGE_SIZE"];// до какого номера выводить
		if($_REQUEST["SHOWALL_1"]==1){
			$start=0;
			$finish=$arResult["COUNT_RESULT"];
		}

		for($i=$start;$i<$finish;$i++) {
		$ar_list_str[]=$ar_list_id[$i];
		}

		$res_Filter=array();
		$res_Filter["FIELD_SID"]=implode("|",$ar_final_col);
		$res_Filter["RESULT_ID"]=implode("|",$ar_list_str);
		$res_Filter["FIELD_SID_EXACT_MATCH"]="Y";

		$rsResults = CForm::GetResultAnswerArray($FORM_ID, 
			$arrColumns, 
			$arrAnswers, 
			$arrAnswersVarname,
			$res_Filter
			);
		//echo "<pre>";
		//  echo "arrColumns:";
		//	print_r($arrColumns);
		//	echo "arrAnswers:";
		//	print_r($arrAnswers);
		//	echo "arrAnswersVarname:";
		//	print_r($arrAnswersVarname);
		//echo "</pre>";
		krsort($arrAnswersVarname);
		foreach($arrAnswersVarname as $key_id=>$val_id) {
			foreach($ar_final_col as $val){
				if($val_id[$val]) {
					switch($val_id[$val][0]["FIELD_TYPE"]) {
					case "radio":$ti_name=$val_id[$val][0]["ANSWER_TEXT"]; break;
					case "dropdown":$ti_name=$val_id[$val][0]["ANSWER_TEXT"]; break;
					case "checkbox":
						foreach($val_id[$val] as $at) {
						$ar_ti_name[]=$at["ANSWER_TEXT"]; 
						}
						$ti_name=implode("<br />",$ar_ti_name);
						unset($ar_ti_name);
						break;
					case "multiselect":
						foreach($val_id[$val] as $at) {
						$ar_ti_name[]=$at["ANSWER_TEXT"]; 
						}
						$ti_name=implode("<br />",$ar_ti_name);
						unset($ar_ti_name);
						break;
					case "file":$ti_name= "<a href='".CFile::GetPath($val_id[$val][0]["USER_FILE_ID"])."' target='_blank'>".$val_id[$val][0]["USER_FILE_NAME"]."</a>";break;
					case "image":$ti_name= "<a href='".CFile::GetPath($val_id[$val][0]["USER_FILE_ID"])."' target='_blank'>".$val_id[$val][0]["USER_FILE_NAME"]."</a>";break;
					default: $ti_name=$val_id[$val][0]["USER_TEXT"];
					}
					$arResult["RESULT_KEY_ID"][$key_id]["QUESTION"][$val]=array(
					"TITLE"=>$val_id[$val][0]["TITLE"],
					"ANSWER_ID"=>$val_id[$val][0]["ANSWER_ID"],
					"FIELD_ID"=>$val_id[$val][0]["FIELD_ID"],
					"SID"=>$val_id[$val][0]["SID"],
					"TEXT"=>$ti_name
					);
				}
				else $arResult["RESULT_KEY_ID"][$key_id]["QUESTION"][$val]=array();
				
			}
			$arResult["RESULT_KEY_ID"][$key_id]["STATUS_RESULT"]=$ar_list_res[$key_id];
			$rsUser = CUser::GetByID($ar_list_res[$key_id]["USER_ID"]);
			$arUser = $rsUser->Fetch();
			$arResult["RESULT_KEY_ID"][$key_id]["STATUS_RESULT"]["FULL_NAME"]=$arUser["LAST_NAME"]." ".$arUser["NAME"]."(".$arUser["ID"].")";
		}
		$arParams["PAGER_TEMPLATE"] = trim($arParams["PAGER_TEMPLATE"]);
		
		if($total>1 OR $arParams["PAGER_SHOW_ALWAYS"]=="Y") {
			$rs_listResults->NavStart($arParams["PAGE_SIZE"], true);
			$arResult["NavPageCount"]=$rs_listResults->NavPageCount;
			$arResult["NavPageNomer"]=$rs_listResults->NavPageNomer;
			$arResult["NAV_STRING"] = $rs_listResults->GetPageNavStringEx($navComponentObject, "", $arParams["PAGER_TEMPLATE"], "Y"); 
		}

	}
	else $arResult["NAV_STRING"]=GetMessage("NOT_NAV_STRING");


		



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