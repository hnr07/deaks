<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
if(CModule::IncludeModule("form")){
	// ID веб-формы
	$FORM_ID = 6;

		$arFilter = array(
	   
		);
/*		
		// фильтр по вопросам
		
$arFields = array();

$arFields[] = array(
    "CODE"              => "id_video",     // код поля по которому фильтруем
    "FILTER_TYPE"       => "text",          // фильтруем по текстовому полю
    "PARAMETER_NAME"    => "USER",          // фильтруем по введенному значению
    "VALUE"             => $_POST["id"],        // значение по которому фильтруем
    "EXACT_MATCH"       => "N"              // ищем вхождение, ищем точное совпадение-"Y"
    );
	
$arFields[] = array(
    "CODE"              => "ip_user",     // код поля по которому фильтруем
    "FILTER_TYPE"       => "text",          // фильтруем по текстовому полю
    "PARAMETER_NAME"    => "USER",          // фильтруем по полю ANSWER_TEXT
    "VALUE"             => $_SERVER["REMOTE_ADDR"],        // значение по которому фильтруем
    "EXACT_MATCH"       => "N"              // ищем вхождение, ищем точное совпадение-"Y"
    );
	
	$arFilter["FIELDS"] = $arFields;
	
			// выберем (первые) все результатов
	$rsResults = CFormResult::GETList($FORM_ID, 
		($by="s_timestamp"), 
		($order="desc"), 
		$arFilter, 
		$is_filtered, 
		"N",
		1);

$arResult = $rsResults->Fetch();
		//echo "<pre>";print_r($arResult);echo "</pre>";
		if($arResult) {
		$arAnswer = CFormResult::GETDataByID(
			$arResult["ID"], 
			array('date'),  // массив символьных кодов необходимых вопросов
			$ar_Res, 
			$ar_Answer2); 
			
			echo "Вы уже голосовали за это видео<br /> ".$arAnswer['date'][0]['USER_TEXT']." г.";
		}
		*/
		if($_COOKIE['visit_'.$_POST["id"]]=="Y") echo "0^Вы уже голосовали за это видео";
		else {
			
			// массив значений ответов
			$arValues = array (
				"form_text_546"                 => $_POST["id"],    // ID видео
				"form_text_547"                 => $_SERVER["REMOTE_ADDR"],     // IP пользователя
				"form_text_548"             => date("d.m.Y"),      // Дата голосования
			);

			// создадим новый результат
			if ($RESULT_ID = CFormResult::Add($FORM_ID, $arValues))
			{
				echo "1^Спасибо! Ваш голос принят.";
			}
			else
			{
				echo "0^Ошибка записи в базу.";
			}
		}
	
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>