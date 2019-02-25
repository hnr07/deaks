<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
include "../var_config.php";
global $USER;
$APPLICATION->SetTitle($title_m);
?>
<link href="admin_list.css" type="text/css"  rel="stylesheet" />
<script type="text/javascript" src="admin_list.js"></script>


<?
if(CModule::IncludeModule("form")){ 

	if(isset($_POST["but_edit_status"])) {
	CFormResult::SetStatus($_POST["res_id_s"], $_POST["edit_status_id"], "Y");
	}

	$FORM_ID=$form_m;
	$arParams["WEB_FORM_ID"]=$FORM_ID;   //ID формы
	$arParams["ACTION"]["STATUS_EDIT"]="Y"; // Разрешить изменение статуса
	$arParams["ACTION"]["RESULT_EDIT"]="Y"; // Разрешить изменение результата
	$arParams["ACTION"]["RESULT_COPY"]="Y"; // Разрешить копирование результата
	$arParams["ACTION"]["ACT"]=0;          // Разрешить обработку результата
	foreach($arParams["ACTION"] as $val) {
	if($val=="Y") {$arParams["ACTION"]["ACT"]=1; break;}
	}

	$arParams["STATUS_DEFAULT"]=$ar_status_default; // массив id статусов для отображения в списке
	$arParams["STR_STATUS_DEFAULT"]=implode(",",$ar_status_default); // строка id статусов 

	$arParams["URL"]["EDIT"]="../result_edit_1.php"; // путь к странице редактирования
	$arParams["URL"]["COPY"]="../copy.php"; // путь к странице копирования



	$arParams["PAGE_SIZE"]=20; // Разбивка результата на страницы по умолчанию

	$arResult=array();


	if (CForm::GetDataByID($FORM_ID, 
		$form, 
		$questions, 
		$answers, 
		$dropdown, 
		$multiselect))
	{
		echo "<pre>";
		   // print_r($form);
		   // print_r($questions);
		   // print_r($answers);
		   // print_r($dropdown);
		   // print_r($multiselect);
		echo "</pre>";
	}
	$ar_col=array(); // массив полей

	foreach($questions as $val){
		if($val["ACTIVE"]=="Y") {
			$ar_col[$val["SID"]]["ID"]=$val["ID"];
			$ar_col[$val["SID"]]["TITLE"]=$val["TITLE"];
			$ar_col[$val["SID"]]["SID"]=$val["SID"];
			$ar_col[$val["SID"]]["IN_FILTER"]=$val["IN_FILTER"];
			$ar_col[$val["SID"]]["ANSWER_ID"]=$answers[$val["SID"]][0]["ID"];
			$ar_col[$val["SID"]]["FIELD_TYPE"]=$answers[$val["SID"]][0]["FIELD_TYPE"];
			$ar_col[$val["SID"]]["C_SORT"]=$val["C_SORT"];
		}
	}
		

	//echo "<pre>"; print_r($ar_col["family"]); echo "</pre>";
	$arParams["QUICK_SEARCH"]["ANSWER_ID"]["family"]=$ar_col["family"]["ANSWER_ID"]; // ID ответа поля Фамилия

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
	$dir_tools="./tools_user_form_".$FORM_ID."/";
	if(!file_exists ($dir_tools)) mkdir($dir_tools, 0777);
	$file_tools="admin_list_".$USER->GetID().".txt";
	if(isset($_POST["but_s"])) {
	//echo "<pre>"; print_r($_POST); echo "</pre>";
		foreach($ar_col as $val){
			if(is_numeric($_POST["no_col_".$val["SID"]])) $ar_tc[$val["SID"]]=$_POST["no_col_".$val["SID"]];
			if($_POST["no_filter_".$val["SID"]]==$val["SID"]) $ar_fr[]=$val["SID"];
		}
		asort($ar_tc);
		$ar_tc=array_keys($ar_tc);
		$text_tool="";
		$text_tool.=implode("#",$ar_tc);
		$text_tool.="~~~";
		$text_tool.=implode("#",$ar_fr);
		$text_tool.="~~~";
		if(is_numeric($_POST["pstr"])) $text_tool.=$_POST["pstr"];
		$text_tool.="~~~".str_replace("~~~","~-~",htmlspecialchars(trim($_POST["sticker"])));
		
		$fr=@fopen($dir_tools.$file_tools,"w");
		if (fwrite($fr, $text_tool) === FALSE) {
			echo "Не могу изменить настройки!";
		}
		else $_SESSION["text_tool_".$FORM_ID]=$text_tool;
		@fclose($fr);
		$_SESSION["show_sticker_".$FORM_ID]=1;
	}

	if(!$_SESSION["text_tool_".$FORM_ID]) {
		
		if(file_exists ($dir_tools.$file_tools)) {
		$fr=fopen($dir_tools.$file_tools,"r");
			$text_tool=fread($fr,filesize($nf));
			fclose($fr);
		}
		$_SESSION["text_tool_".$FORM_ID]=$text_tool;
	}
	else {$text_tool=$_SESSION["text_tool_".$FORM_ID];}


	//echo ">>> ".$text_tool;
	if($text_tool) {
		$ar_tool=explode("~~~",$text_tool);
		if($ar_tool[0]) $ar_final_col=explode("#",$ar_tool[0]);
		if($ar_tool[1]) $ar_final_filter=explode("#",$ar_tool[1]);
		if($ar_tool[2]) $arParams["PAGE_SIZE"]=$ar_tool[2];
		if($ar_tool[3]) $arParams["STICKER"]=$ar_tool[3];
	}

	foreach($ar_final_col as $val){
		$arResult["TABLE_HEAD_TITLE"][]=$questions[$val]["TITLE"]; // массив наименований вопросов формы
	}

		//echo "<pre>"; print_r($ar_final_col); echo "</pre>";
		//echo str_replace("\n","<br />",$sticker);
		$ar_col_filter=array();  // массив полей фильтра
	foreach($ar_final_filter as $val) {
		$ar_col_filter[$val]["ID"]=$questions[$val]["ID"];
		$ar_col_filter[$val]["SID"]=$questions[$val]["SID"];
		$ar_col_filter[$val]["TITLE"]=$questions[$val]["TITLE"];
		$ar_col_filter[$val]["FIELD_TYPE"]=$answers[$val][0]["FIELD_TYPE"];
		$i=0;
		foreach($answers[$val] as $val_ans){
			$ar_col_filter[$val]["ANSWER"][$i]["ID"]=$val_ans["ID"];
			$ar_col_filter[$val]["ANSWER"][$i]["MESSAGE"]=$val_ans["MESSAGE"];
			$i++;
		}
	}
	
	$arFilter = array();// фильтр по вопросам
	$arFields = array();// фильтр по ответам
	if(isset($_GET["install_filter"])) {

		$ke_s = array_search("", $_GET["find_status_id"]);
			if ($ke_s !== false) unset($_GET["find_status_id"][$ke_s]);
			if($_GET["find_status_id"]) $status_id=implode("|",$_GET["find_status_id"]);
			else $status_id=implode("|",$arParams["STATUS_DEFAULT"]);
			
		$arFilter = Array(
			"ID"=> $_GET["find_id"],
			"STATUS_ID"=> $status_id,
		);
		
		foreach($ar_col_filter as $key=>$val) {
			if($_GET["find_".$code_m."_".$val["SID"]]) {
				switch ($val["FIELD_TYPE"]) {
				case "radio":
					$arFields[]=array(
						"SID" => $key,       // код поля по которому фильтруем
						"FILTER_TYPE"       => "answer_id",  //проверка совпадения по id ответа
						"PARAMETER_NAME"    => "ANSWER_TEXT",         
						"VALUE" => $_GET["find_".$code_m."_".$val["SID"]]
					);break;
				default:
					$arFields[]=array(
						"SID" => $key,       // код поля по которому фильтруем
						"FILTER_TYPE"       => "text",  //проверка совпадения по id ответа
						"PARAMETER_NAME"    => "USER",         
						"VALUE" => $_GET["find_".$code_m."_".$val["SID"]]
					);break;
				}
			}
		}
	}
	else {
		$arFilter = Array(
			"STATUS_ID"=> implode("|",$arParams["STATUS_DEFAULT"]),
			);
			
		if(isset($_GET["result_view"])) {
		$arFilter = Array(
			"ID"=> $_GET["result_view"],
			);
		}
	}
		
	$arFilter["FIELDS"]=$arFields;
	
	$rs_listResults = CFormResult::GetList($FORM_ID, 
		($by="s_timestamp"), 
		($order="desc"), 
		$arFilter, 
		$is_filtered );

		//echo "<pre>"; print_r($arFilter); echo "</pre>";
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
	$page = intval($_GET['PAGEN_1']);  // начало сообщений для текущей страницы 
	if(empty($page) or $page < 0) $page = 1; //Если значение $page меньше единицы или отрицательно, переходим на первую страницу 
	if($page > $total) $page = $total;  //Если значение $page больше общего числа страниц, переходим на последнюю 
	$start = $page * $arParams["PAGE_SIZE"]- $arParams["PAGE_SIZE"]; // с какого номера выводить
	$finish=$start+$arParams["PAGE_SIZE"];// до какого номера выводить
	if($_GET["SHOWALL_1"]==1){
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
		echo "<pre>";
		//  echo "arrColumns:";
		//	print_r($arrColumns);
		//	echo "arrAnswers:";
		//	print_r($arrAnswers);
		//	echo "arrAnswersVarname:";
		//	print_r($arrAnswersVarname);
		echo "</pre>";
		
		foreach($arrAnswersVarname as $key_id=>$val_id) {
			foreach($ar_final_col as $val){
				if($val_id[$val]) {
					switch($val_id[$val][0]["FIELD_TYPE"]) {
					case "radio":$ti_name=$val_id[$val][0]["ANSWER_TEXT"]; break;
					case "file":$ti_name= "<a href='".CFile::GetPath($val_id[$val][0]["USER_FILE_ID"])."' target='_blank'>".$val_id[$val][0]["USER_FILE_NAME"]."</a>";break;
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
		
		$rs_listResults->NavStart($arParams["PAGE_SIZE"], true);
			$arResult["NavPageCount"]=$rs_listResults->NavPageCount;
			$arResult["NavPageNomer"]=$rs_listResults->NavPageNomer;
			$arResult["NAV_STRING"] = $rs_listResults->GetPageNavStringEx($navComponentObject, "Заявки", "navigation_events_list", "Y"); //arrows
		

	}
	else $arResult["NAV_STRING"]="Нет результатов";


		
	// сформируем массив фильтра
	
	$ar_status_Filter = Array(
		"ID"                       => "",       // ID статуса 
		"ID_EXACT_MATCH"           => "Y",           // точное совпадение для ID
	);

	// получим список всех статусов формы, соответствующих фильтру
	//$ar_filter_status=compact($status_ok,$status_nepr,$status_opl,$status_nopl,$status_rz,$status_del); 
	$ar_filter_nois=array($status_new,$status_no);
	$rsStatuses = CFormStatus::GetList(
		$FORM_ID, 
		$by="s_sort", 
		$order="asc", 
		$ar_status_Filter, 
		$is_status_filtered
		);
	while ($arStatus = $rsStatuses->Fetch())
	{
	if($arStatus["ACTIVE"]="Y" and !in_array($arStatus["ID"],$ar_filter_nois)){
	   // echo "<pre>"; print_r($arStatus); echo "</pre>";
		$arResult["STATUS"][$arStatus["ID"]]["ID"]=$arStatus["ID"];
		$arResult["STATUS"][$arStatus["ID"]]["CSS"]=$arStatus["CSS"];
		$arResult["STATUS"][$arStatus["ID"]]["TITLE"]=$arStatus["TITLE"];
		$arResult["STATUS"][$arStatus["ID"]]["DESCRIPTION"]=$arStatus["DESCRIPTION"];
		$arResult["STATUS"][$arStatus["ID"]]["RESULTS"]=$arStatus["RESULTS"];
		}
	}

}
//echo "<pre>"; print_r($arResult); echo "</pre>";
//echo "<pre>"; print_r($arParams); echo "</pre>";
//echo "<pre>"; print_r($_GET); echo "</pre>";
//echo "<pre>"; print_r($_SERVER); echo "</pre>";

?>



 <div id="admin_list">
 
<?if($_GET["print"]!="Y") {?>
<h2><?$APPLICATION->ShowTitle();?></h2>

<div class="top">
	

	<div class="but_top_1"><a href="#" onclick='window.open("./help.php", "help", "menubar=0,location=0,resizable=yes,scrollbars=yes,location=0,status=0,height=600, width=800,left=100,top=100")'><img class="open_faq" src="/images/registration_event/help.png" title="помощь"></a></div>

	<div class="but_top_1"><img class="open_tool" id="open_tool" src="/images/registration_event/tools.png" title="настройки"></div>
	
	<div class="but_top_1"><img class="open_filter" id="open_filter" src="/images/registration_event/<?=(isset($_GET["install_filter"]))?"filter_1.png":"filter_0.png"?>" title="<?=(isset($_GET["install_filter"]))?"фильтр установлен":"фильтр не установлен"?>"></div>
	
	<div class="but_top_1"><a id="a_print" href="http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?><?=(strpos($_SERVER['REQUEST_URI'],"?"))?"&print=Y":"?print=Y"?>"><img class="open_print" src="/images/registration_event/doc_print.png" title="печать"></a></div>
	
	<?if($arParams["STICKER"]) {?>
	<div class="but_top_1"><img class="open_sticker" id="open_sticker" src="/images/registration_event/list-accept.png" title="открыть стикер"></div>
	<?}?>
	
	<div class="but_top_bp"><input type="text" id="tqs" name="tqs" oninput="f_quick_search(<?=$arParams["WEB_FORM_ID"]?>,<?=$arParams["QUICK_SEARCH"]["ANSWER_ID"]["family"]?>,'<?=$arParams["STR_STATUS_DEFAULT"]?>','<?=$arParams["URL"]["EDIT"]?>')" title="введите № заявки или фамилию"></div>
</div>

<div class="nav_string"><?=$arResult["NAV_STRING"]?></div>
<?}?>
<div class="clear-all"></div>

<!-- Таблица результатов начало -->
<table class="res_tab">
	<thead>
		<tr>
		<?if($arParams["ACTION"]["ACT"] && $_GET["print"]!="Y") {?>
			<th>&nbsp;</th>
		<?}?>
		<th>Заявки(<?=$arResult["COUNT_RESULT"]?>)</th>
			<?foreach($arResult["TABLE_HEAD_TITLE"] as $val){
				echo "<th>".$val."</th>";
			}?>
		</tr>
	</thead>
	<tbody>
	
	<?if($arResult["RESULT_KEY_ID"]) {?>
		<?foreach($arResult["RESULT_KEY_ID"] as $key => $res){?>
		<tr class="tr_res">
			<?
			$ct_menu="";
			if($arParams["ACTION"]["ACT"] && $_GET["print"]!="Y") {
			
				if($arParams["ACTION"]["RESULT_EDIT"]=="Y") {
					$ct_menu.="<div class='div_c_menu res_edit'><div><a href='".$arParams["URL"]["EDIT"]."?RESULT_ID=".$key."&WEB_FORM_ID=".$arParams["WEB_FORM_ID"]."'><span>Изменить</span></a></div></div>";
				}
				if($arParams["ACTION"]["RESULT_COPY"]=="Y") {
					$ct_menu.="<div class='div_c_menu'><div onclick=\"f_copy(".$key.",".$arParams["WEB_FORM_ID"].")\">Копировать</div></div>";
				}
				if($arParams["ACTION"]["STATUS_EDIT"]=="Y") {
					$ct_menu.="<div class='div_c_menu'><div onclick=\"f_edit_status(".$key.",".$res["STATUS_RESULT"]["STATUS_ID"].",'".$res["STATUS_RESULT"]["STATUS_TITLE"]."')\">Статус</div></div>";
				}
			?>
				<td><div class="div_act">
					<div class="c_menu">
						<?=$ct_menu?>
					</div>
				<img class="open_act" id="open_tool" src="/images/registration_event/list.png" title="действия"></div></td>
			<?}?>
			
				<td title="Создатель: <?=$res["STATUS_RESULT"]["FULL_NAME"]?> <?=$res["STATUS_RESULT"]["DATE_CREATE"]?>"><div><b><?=$key?></b></div><div><?=$res["STATUS_RESULT"]["STATUS_TITLE"]?></div></td>
				<?foreach($res["QUESTION"] as $k=> $val){
					 echo "<td title='#".$key.": ".$val["TITLE"]."'>".$val["TEXT"]."</td>";
				}?>
			</tr>
		<?}?>
	<?}?>
	</tbody>

</table>

<!-- Таблица результатов конец -->
<div class="clear-all"></div>
<?if($_GET["print"]!="Y") {?>
<div class="nav_string"><?=$arResult["NAV_STRING"]?></div>
<?}?>
<br /><br /><br /><br />
<!-- Блок фильтра начало -->
<div class="div_filter"><img class="close" id="close" src="/images/registration_event/close.png">
<h3>Фильтр результатов таблицы</h3><br /><br />
<form action="" method="GET">
<table>
<tr><td>№ заявки</td><td><?=CForm::GetTextFilter("id", 0, "", "")?></td></tr>
<tr><td>Статус заявки</td><td>
<select name="find_status_id[]" multiple size="4">
<option value="" <?=($_GET["find_status_id"])?"":"selected"?>>все</option>
<?foreach($arResult["STATUS"] as $val) {?>
<option value="<?=$val["ID"]?>" <?=(in_array($val["ID"],$_GET["find_status_id"]))?"selected":""?>><?=$val["TITLE"]?>(<?=$val["RESULTS"]?>)</option>
<?}?>
</select>
</td></tr>

<?
$text_filter="";

foreach($ar_col_filter as $val) {
	switch($val["FIELD_TYPE"]){
	case "radio": 
		$text_filter.="<tr><td>".$val["TITLE"]."</td><td>";
		$text_filter.=CForm::GetDropDownFilter(
				$val["ID"], 
				"ANSWER_TEXT", 
					$code_m."_".$val["SID"]
				);
		$text_filter.="</td></tr>";break;
	default:
		$text_filter.="<tr><td>".$val["TITLE"]."</td><td>";
		$text_filter.=CForm::GetTextFilter($code_m."_".$val["SID"], 0, "", "");
		$text_filter.="</td></tr>";break;
	}
}
?>
<?=$text_filter?>
<tr><td><a href="?remove_filter=1"><input type="button" value="Сбросить фильтр"></a></td>
<td><input type="submit" name="install_filter" value="Установить фильтр"></td></tr>
</table>

</form>
</div>
<!-- Блок фильтра конец -->



<!-- Блок настроек начало -->
<div class="columns_tool"><img class="close" id="close" src="/images/registration_event/close.png">
<h3>Настройки таблицы</h3><br /><br />
<form id="form_tool" name="form_tool" method="POST">

<div class="div_pstr"><b>Результатов<br />на странице</b> <input class="no_col" name="pstr" type="text" value="<?=$arParams["PAGE_SIZE"]?>"></div>
<div class="div_sticker"><b>Стикер:</b><div id="sticker_not_text" title="стереть стикер">&#10005;</div> <textarea name="sticker"><?=$arParams["STICKER"]?></textarea></div>
<div class="but_tool"><input type="button" id="but_reset" class="but_r" value="Сброс"><input type="submit" class="but_t" name="but_s" value="Сохранить"></div>
<div style="clear:both"></div>
<br />
<div style="clear:both"></div>
<b>Настройка таблицы результатов и фильтра</b>
<div class="list_c">
	<?foreach($ar_col as $val){?>
		<div class="l_col"> <input class="no_filter" type="checkbox" name="no_filter_<?=$val["SID"]?>" value="<?=$val["SID"]?>" <?=(in_array($val["SID"],$ar_final_filter)?"checked":"")?> title="отметка поля для участия в фильтре"> <input type="text" class="no_col" name="no_col_<?=$val["SID"]?>" value="<?=(in_array($val["SID"],$ar_final_col))?(array_search($val["SID"],$ar_final_col)+1)*10:""?>" title="порядковый номер поля в таблице"><?=$val["TITLE"]?></div>
	<?}?>
</div>
	</form>
</div>
<!-- Блок настроек конец -->

<!-- Блок изменения статуса начало -->
<?if(isset($_POST["but_edit_status"])) {?>
<div class='inf_edit_status'>Статус заявки №<?=$_POST["res_id_s"]?> успешно изменён.</div>
<?}?>
<div class="box_status"><img class="close" id="close" src="/images/registration_event/close.png">
	<form id="" name="" method="POST">
		<h3>Заявка № <span id="nom"></span><br />статус: <span id="sta"></span></h3>
		<input id="res_id_s" type="hidden" name="res_id_s" value="">
	<br />
	Изменить на:
		<select id="edit_status_id" name="edit_status_id">

		</select><br /><br />
		<input type="submit" name="but_edit_status" value="Изменить">
	</form>
	<div style="display:none">
		<select id="default_status_id">
			<?foreach($arResult["STATUS"] as $val) {?>
			<option id="o_<?=$val["ID"]?>" value="<?=$val["ID"]?>"><?=$val["TITLE"]?>&nbsp;</option>
			<?}?>
		</select>
	</div>
</div>
<!-- Блок изменения статуса конец -->

<!-- Блок копирования начало -->
<div class="box_copy"><img class="close" id="close" src="/images/registration_event/close.png">
	<form id="" action="<?=$arParams["URL"]["COPY"]?>" name="" method="GET">
		<h3>Заявка № <span id="nom_copy"></span> после копирования будет отменена.<br /><br />Операция копирования не имеет обратного действия.<br /><br />Вы должны понимать, последствия этого изменения.</h3>
		<input id="copy_id" type="hidden" name="copy_id" value="">
		<input id="WEB_FORM_ID" type="hidden" name="WEB_FORM_ID" value="">
		<br /><br />
		<input type="reset" value="Отмена" class="but_reset_copy"><input type="submit" name="but_copy" value="Я понимаю, продолжить">
	</form>

</div>
<!-- Блок копирования конец -->

<!-- Блок стикер начало -->
<?
if($_SESSION["show_sticker_".$FORM_ID]) {
$style_box_sticker="none";
}
else {
	if($arParams["STICKER"]) $style_box_sticker="block";
	else $style_box_sticker="none";
}

?>
<div class="box_sticker" style="display:<?=$style_box_sticker?>"><img class="close" id="close" src="/images/registration_event/close.png">
	<?=str_replace("\n","<br />",$arParams["STICKER"]);$_SESSION["show_sticker_".$FORM_ID]=1;?>
</div>
<!-- Блок стикер конец -->

<!-- Блок индикатора начало -->
<div class="box_indicator">
	<img src="/images/registration_event/proc_3.gif">
</div>
<!-- Блок индикатора конец -->

<!-- Блок быстрого поиска начало -->
<div class="box_qs"><img class="close" id="close" src="/images/registration_event/close.png">
	<div id="result_quick_search"></div>

</div>
<!-- Блок быстрого поиска конец -->

</div>



<?

if($_REQUEST["formresult"]="editok") {
$ar_Answer = CFormResult::GetDataByID(
	$_REQUEST["RESULT_ID"], 
	array(),  // массив символьных кодов необходимых вопросов
	$ar_Result, 
	$ar_Answer2);
	
//echo "<pre>";print_r($ar_Answer);echo "</pre>";
// Блок формирования значений для таблицы логирования

global $LOG_INFO;
CForm::GetDataByID($_REQUEST["WEB_FORM_ID"], 
    $form_i, 
    $questions_i, 
    $answers_i, 
    $dropdown_i, 
    $multiselect_i);

$arFile = CFormResult::GetFileByAnswerID($_REQUEST[RESULT_ID], $answers_i["p_scan"][0]["ID"]);
$arim=CFile::GetPath($arFile[USER_FILE_ID]);
//echo "<pre>";print_r($arim);echo "</pre>";

//echo $_REQUEST[RESULT_ID]." >> ".$answers["p_scan"][0]["ID"];

// массив описывающий загруженную на сервер фотографию
$arImage = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/images/photo.gif");

// массив значений ответов

$LOG_INFO["editor"]=$USER->GetFullName()."[".$USER->GetID()."]"; //Кто изменил
$LOG_INFO["time"]=date("Y.m.d H:i:s");// дата/время
$LOG_INFO["id_form"]=$_REQUEST["WEB_FORM_ID"];// id формы
$LOG_INFO["id_result"]=$_REQUEST["RESULT_ID"];// id заявки

$LOG_INFO["status"] = $ar_Answer["status"][0]['ANSWER_TEXT'];// статус участника
$LOG_INFO["kem_priglashen_chk"]=$ar_Answer['kem_priglashen_chk'][0][USER_TEXT]; //Кем приглашен - № ЧК
$LOG_INFO["kem_priglashen_name"]=$ar_Answer["kem_priglashen_name"][0][USER_TEXT]; //Кем приглашен - имя
$LOG_INFO["kem_priglashen_family"]=$ar_Answer["kem_priglashen_family"][0][USER_TEXT]; //Кем приглашен - фамилия
$LOG_INFO["chk"]=$ar_Answer["chk"][0][USER_TEXT]; //№ ЧК
$LOG_INFO["name"]=$ar_Answer["name"][0][USER_TEXT];// имя
$LOG_INFO["family"]=$ar_Answer["family"][0][USER_TEXT];  // Фамилия
$LOG_INFO["middle_name"]=$ar_Answer["middle_name"][0][USER_TEXT]; //отчество
$LOG_INFO["email"]=$ar_Answer["email"][0][USER_TEXT]; //E-mail
$LOG_INFO["tel"]=$ar_Answer["tel"][0][USER_TEXT]; //Телефон
$LOG_INFO["tel_2"]=$ar_Answer["tel_2"][0][USER_TEXT]; //Доп. телефон
$LOG_INFO["skype"]=$ar_Answer["skype"][0][USER_TEXT]; //Skype

$LOG_INFO["sex"] = $ar_Answer["sex"][0]['ANSWER_TEXT']; //Пол

 
$LOG_INFO["age"] = $ar_Answer["age"][0]['ANSWER_VALUE'];//Возраст

$LOG_INFO["country"]=$ar_Answer["country"][0][USER_TEXT]; //Гражданство
$LOG_INFO["city"]=$ar_Answer["city"][0][USER_TEXT]; //Город проживания
$LOG_INFO["region"]=$ar_Answer["region"][0][USER_TEXT]; //Область проживания

 
$LOG_INFO["prioritet"] = $ar_Answer["prioritet"][0]['ANSWER_TEXT'];//Предпочтительный вид связи

$LOG_INFO["birthday"]=$ar_Answer["birthday"][0][USER_TEXT];  //Дата рождения
  
$LOG_INFO["p_nal"] = $ar_Answer["p_nal"][0]['ANSWER_TEXT'];//Наличие загранпаспорта

$LOG_INFO["p_name"]=$ar_Answer["p_name"][0][USER_TEXT]; //Имя по загранпаспорту
$LOG_INFO["p_family"]=$ar_Answer["p_family"][0][USER_TEXT]; //Фамилия по загранпаспорту
$LOG_INFO["p_date"]=$ar_Answer["p_date"][0][USER_TEXT]; //Дата выдачи загранпаспорта
$LOG_INFO["p_due_date"]=$ar_Answer["p_due_date"][0][USER_TEXT]; //Действие загранпаспорта
$LOG_INFO["p_sn"]=$ar_Answer["p_sn"][0][USER_TEXT]; //Серия и номер загранпаспорта
$LOG_INFO["p_scan"]=$arim; //Скан загранпаспорта
$LOG_INFO["p_ready"]=$ar_Answer["p_ready"][0][USER_TEXT]; //Нет паспорта? Укажите дату

$LOG_INFO["p_viza"] = $ar_Answer["p_viza"][0]['ANSWER_TEXT'];//Оформление визы

 
$LOG_INFO["p_fly"] = $ar_Answer["p_fly"][0]['ANSWER_TEXT'];//Вариант перелета


$LOG_INFO["fly_1"] = $ar_Answer["fly_1"][0]['ANSWER_TEXT']; //Перелет туда


$LOG_INFO["fly_2"] = $ar_Answer["fly_2"][0]['ANSWER_TEXT'];//Перелёт обратно


$LOG_INFO["p_hotel"] = $ar_Answer["p_hotel"][0]['ANSWER_TEXT'];//Вариант проживания

$LOG_INFO["day_hotel_start"]=$ar_Answer["day_hotel_start"][0][USER_TEXT]; //Дата начала проживания
$LOG_INFO["day_hotel_finish"]=$ar_Answer["day_hotel_finish"][0][USER_TEXT]; //Дата окончания проживания

$LOG_INFO["hotel"] = $ar_Answer["hotel"][0]['ANSWER_TEXT'];//Отель

 
$LOG_INFO["nomer"] = $ar_Answer["nomer"][0]['ANSWER_TEXT'];//Номер

  
$LOG_INFO["p_transfer"] = $ar_Answer["p_transfer"][0]['ANSWER_TEXT'];//Трансфер

$LOG_INFO["hotel_frend"]=$ar_Answer["hotel_frend"][0][USER_TEXT]; //ФИО соседа по номеру
  
$LOG_INFO["d_konf"] = $ar_Answer["d_konf"][0]['ANSWER_TEXT'];//Участие в конференции

$LOG_INFO["d_ujin"] = $ar_Answer["d_ujin"][0]['ANSWER_TEXT']; //Участие в гала ужине
$LOG_INFO["d_futbolka"] = $ar_Answer["d_futbolka"][0]['ANSWER_TEXT'];//Футболка


$LOG_INFO["medical_insurance"] = $ar_Answer["medical_insurance"][0]['ANSWER_TEXT'];//Медицинская страховка

$LOG_INFO["d_vopros_1"] = $ar_Answer["d_vopros_1"][0]['ANSWER_TEXT'];//Один запасной вопрос

$LOG_INFO["d_vopros_2"] = $ar_Answer["d_vopros_2"][0]['ANSWER_TEXT'];//Второй запасной вопрос

$LOG_INFO["oplata"] = $ar_Answer["oplata"][0]['ANSWER_TEXT'];//Форма оплаты

$LOG_INFO["pl_chk"]=$ar_Answer["pl_chk"][0][USER_TEXT]; //№ ЧК плательщика
$LOG_INFO["pl_name"]=$ar_Answer["pl_name"][0][USER_TEXT]; //Имя плательщика
$LOG_INFO["pl_family"]=$ar_Answer["pl_family"][0][USER_TEXT]; //Фамилия плательщика
$LOG_INFO["pl_phone"]=$ar_Answer["pl_phone"][0][USER_TEXT]; //№ телефона плательщика
$LOG_INFO["op_country"]=$ar_Answer["op_country"][0][USER_TEXT]; //Страна
$LOG_INFO["op_city"]=$ar_Answer["op_city"][0][USER_TEXT]; //Город
$LOG_INFO["op_nof"]=$ar_Answer["op_nof"][0][USER_TEXT]; //№ Офиса продаж
$LOG_INFO["time_money_chk"] = $ar_Answer["time_money_chk"][0]['ANSWER_TEXT'];//Рассрочка для чека

$LOG_INFO["time_money_op"] = $ar_Answer["time_money_op"][0]['ANSWER_TEXT'];//Рассрочка для ОП

$LOG_INFO["partner"]=$ar_Answer["partner"][0][USER_TEXT]; //Партнёр
$LOG_INFO["pl_ok"]=$ar_Answer["pl_ok"][0][USER_TEXT]; //Проверка плательщика 
$LOG_INFO["garant_chk"]=$ar_Answer["garant_chk"][0][USER_TEXT]; //№ ЧК гаранта
$LOG_INFO["garant_name"]=$ar_Answer["garant_name"][0][USER_TEXT]; //Имя гаранта
$LOG_INFO["garant_family"]=$ar_Answer["garant_family"][0][USER_TEXT]; //Фамилия гаранта
$LOG_INFO["garant_ok"]=$ar_Answer["garant_ok"][0][USER_TEXT]; //Проверка гаранта
$LOG_INFO["pl_ok_id"]=$ar_Answer["pl_ok_id"][0][USER_TEXT]; //код проверки плательщика
$LOG_INFO["garant_ok_id"]=$ar_Answer["garant_ok_id"][0][USER_TEXT]; //код проверки гаранта
$LOG_INFO["currency"]=$ar_Answer["currency"][0][USER_TEXT]; //Валюта заявки
$LOG_INFO["currency_id"]=$ar_Answer["currency_id"][0][USER_TEXT]; //ID валюты заявки
$LOG_INFO["money"]=$ar_Answer["money"][0][USER_TEXT]; //Стоимость мероприятия в у. е.
$LOG_INFO["money_2"]=$ar_Answer["money_2"][0][USER_TEXT]; //Стоимость в Вашей валюте
$LOG_INFO["t_money"]=$ar_Answer["t_money"][0][USER_TEXT]; //Оплачено в базовой валюте
$LOG_INFO["t_money_2"]=$ar_Answer["t_money_2"][0][USER_TEXT]; //Оплачено в Вашей валюте
$LOG_INFO["sum_debt"]=$ar_Answer["sum_debt"][0][USER_TEXT]; //Сумма задолженности
$LOG_INFO["date_endpay"]=$ar_Answer["date_endpay"][0][USER_TEXT]; //Дата последнего платежа
$LOG_INFO["billingdate"]=$ar_Answer["billingdate"][0][USER_TEXT]; //Дата выставления счёта
$LOG_INFO["claimdate"]=$ar_Answer["claimdate"][0][USER_TEXT]; //Дата поступления заявки
$LOG_INFO["discount"]=$ar_Answer["discount"][0][USER_TEXT]; //Скидка %
$LOG_INFO["markup"]=$ar_Answer["markup"][0][USER_TEXT]; //Наценка %
$LOG_INFO["plus"]=$ar_Answer["plus"][0][USER_TEXT]; //Наценка
$LOG_INFO["minus"]=$ar_Answer["minus"][0][USER_TEXT]; //Скидка
$LOG_INFO["money_calc"]=$ar_Answer["money_calc"][0][USER_TEXT]; //Калькуляция стоимости мероприятия в у. е.
$LOG_INFO["money_2_calc"]=$ar_Answer["money_2_calc"][0][USER_TEXT]; //Калькуляция стоимости мероприятия в нац. валюте
$LOG_INFO["expired"]=$ar_Answer["expired"][0][USER_TEXT]; //Истёк срок оплаты
$LOG_INFO["proverka"]=$ar_Answer["proverka"][0][USER_TEXT]; //Проверка пройдена
$LOG_INFO["dr_bd"]=$ar_Answer["dr_bd"][0][USER_TEXT]; //Дата рождения из БД
$LOG_INFO["em_bd"]=$ar_Answer["em_bd"][0][USER_TEXT]; //e-mail из БД
$LOG_INFO["promotion_1"]=$ar_Answer["promotion_1"][0][USER_TEXT]; //Промоушен приглашение
$LOG_INFO["promotion_3"]=$ar_Answer["promotion_3"][0][USER_TEXT]; //Промоушен оплата
$LOG_INFO["m_course"]=$ar_Answer["m_course"][0][USER_TEXT]; //Выбор курса валют
$LOG_INFO["comments"]=$ar_Answer["comments"][0][USER_TEXT]; //Комментарий
$LOG_INFO["comments_admin"]=$ar_Answer["comments_admin"][0][USER_TEXT]; //Комментарий администратора
$LOG_INFO["guest_card"]=$ar_Answer["guest_card"][0][ANSWER_TEXT]; //Гостевая карта
$LOG_INFO["copy"]=$ar_Answer["copy"][0][USER_TEXT]; //Копия


?>
<?include "../logging.php"?>
<?
global $ar_manager;

	global $USER;	
	if ($USER->IsAdmin()) {
		if(in_array($USER->GetID(), $ar_manager)) CFormResult::SetStatus($RESULT_ID_LOG, 40,"Y"); //Изменено менеджером
		else CFormResult::SetStatus($RESULT_ID_LOG, 41,"Y"); // Изменено админом
	}
}
?>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>