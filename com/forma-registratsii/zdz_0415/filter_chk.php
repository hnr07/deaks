<?
		$chk="chk"; // символьный идентификатор вопроса "№ ЧК" по которому фильтруем
		$name="name"; // символьный идентификатор вопроса "Имя" по которому фильтруем
		$family="family"; // символьный идентификатор вопроса "Фамилия" по которому фильтруем
		$kem_priglashen_chk="kem_priglashen_chk"; // символьный идентификатор вопроса "Кем приглашен - № ЧК" по которому фильтруем
		$kem_priglashen_name="kem_priglashen_name"; // символьный идентификатор вопроса "Кем приглашен - Имя" по которому фильтруем
		$kem_priglashen_family="kem_priglashen_family"; // символьный идентификатор вопроса "Кем приглашен - Фамилия" по которому фильтруем
		$status="status"; // символьный идентификатор вопроса "Статус" по которому фильтруем
		$ar_fist=array($status_ok, $status_nepr, $status_nopl, $status_rz, $status_opl);// массив необходимых статусов
		$fist=implode(" | ", $ar_fist); // строка фильтра статусов результата
		
$errors=array(); // массив ошибок
CModule::IncludeModule('form'); // подключаем модуль форма 
$FORM_ID=$form_m;  // ID формы
/*

if ($p_status==$a_status[0]) {

//Исходные данные для проверки участника	

//Есть ли ЧК в БД
$cond=$condition_chk;   // id проверяемого условия
	$arCheck_p = $oWS->CheckConf($iDSesison,$cond,$p_chk,$p_family,$p_name);  // Есть ли такой пользователь
	$error_p = $oWS->ShowError(); // Ошибка, если Нет такого ЧК в БД
		if(!$error_p) {$op=1;$email = $arCheck_p["EMAIL"];}
		else {$op=0;$errors["CHK"]=$error_p;}
//$op=1;
		// Если такой ЧК существует, продолжаем проверки
	if($op) {
		// Проверка на возможность участия ЧК
		$cond=$condition_member;   // id проверяемого условия
		$arCheck = $oWS->CheckConf($iDSesison,$cond,$p_chk,$p_family,$p_name);  // Условие участия в мероприятии
		$error = $oWS->ShowError(); // Ошибка, если Не выполнено условие участия в мероприятии
		if(!$error) {
		if($arCheck["PARTNER"]=='') $arCheck["PARTNER"]=0;
		$partner=$arCheck["PARTNER"];
		$promotion_1=1; // промоушен участия
		//$op=1;
		}
		else {
			$errors["MEMBER"]=ft('ERROR_NOTE_12',$_SESSION["f_lang"]);
			$partner="";
			$promotion_1=0;// промоушен участия
			//$op=0;
			}
	}
		
	  // Если Проверка на возможность участия ЧК пройдена, продолжаем проверки
	if($op) { 
		
			// Проверка ЧК на регистрацию, как участника на это мероприятие
			// фильтр по статусам результата
			$marFilter = array("STATUS_ID" => $fist);
			// фильтр по вопросам
			$marFields = array();

			$marFields[] = array(
				"SID" => $chk,                      // символьный идентификатор вопроса 
			"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
			"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
			"VALUE" => $p_chk,                       // выборка по значению
			"EXACT_MATCH"   => "Y"                    // точное совпадение          
				);
			$marFields[] = array(
				"SID" => $name,                      // символьный идентификатор вопроса 
			"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
			"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
			"VALUE" => $p_name,                       // выборка по значению
			"EXACT_MATCH"   => "Y"                    // точное совпадение          
				);
			$marFields[] = array(
				"SID" => $family,                      // символьный идентификатор вопроса 
			"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
			"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
			"VALUE" => $p_family,                       // выборка по значению
			"EXACT_MATCH"   => "Y"                    // точное совпадение          
				);
			$marFields[] = array(
				"SID" => $status,                      // символьный идентификатор вопроса 
			"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
			"PARAMETER_NAME" => "ANSWER_VALUE",                 // параметр выборки по введённому значению
			"VALUE" => $a_v_member,                       // выборка по значению
			"EXACT_MATCH"   => "Y"                    // точное совпадение          
				);		

			$marFilter["FIELDS"] = $marFields;

			$rsResults = CFormResult::GetList($FORM_ID, 
				($by="s_id"), 
				($order="asc"), 
				$marFilter, 
				$mis_filtered, 
				"N");
			$chk_reg=0;                 // Переменная, где хранится кол-во регистраций ЧК в форме, как участника
			while ($arResult = $rsResults->Fetch())
			  {
			   $chk_reg++;
			  }
			 unset($marFilter);
			 
				// Проверка ЧК на повторную регистрацию

				if($partner) {    // партнёр есть
					if($chk_reg>=2) {
					$op=0; 
					$errors["LIMIT_MEMBER"]=ft('ERROR_NOTE_4',$_SESSION["f_lang"]);// Заявка от этого ЧК уже есть в базе заявок на мероприятие.
					}
					else $op=1;
				}
				else {         // партнёра нет
					if($chk_reg) {
					$op=0;
					$errors["LIMIT_MEMBER"]=ft('ERROR_NOTE_4',$_SESSION["f_lang"]);// Заявка от этого ЧК уже есть в базе заявок на мероприятие.
					}
					else $op=1;
				}
		}

	if($op) {
			// Проверка ЧК на регистрацию, как гостя-ЧК на это мероприятие
		// фильтр по статусам результата
		$marFilter = array("STATUS_ID" => $fist);
		// фильтр по вопросам
		$marFields = array();

		$marFields[] = array(
			"SID" => $chk,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_chk,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $name,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_name,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $family,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_family,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $status,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "ANSWER_VALUE",                 // параметр выборки по введённому значению
		"VALUE" => $a_v_guest_chk,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);		

		$marFilter["FIELDS"] = $marFields;

		$rsResults = CFormResult::GetList($FORM_ID, 
			($by="s_id"), 
			($order="asc"), 
			$marFilter, 
			$mis_filtered, 
			"N");
		$chk_guest_reg=0;                 // Переменная, где хранится кол-во регистраций ЧК в форме, как гостя-ЧК
		while ($arResult = $rsResults->Fetch())
		  {
		   $chk_guest_reg++;
		  }
		unset($marFilter);
		if($chk_guest_reg) {
		$op=0;
		$errors["LIMIT_MEMBER"]=ft('ERROR_NOTE_10',$_SESSION["f_lang"]);// Приглашение для этого ЧК уже есть в базе заявок на мероприятие.
		}
		else $op=1;
	}
}


if ($p_status==$a_status[1]) {

//Исходные данные для проверки 	
//Есть ли приглашающий ЧК в БД
$cond=$condition_chk;   // id проверяемого условия
	$arCheck_p = $oWS->CheckConf($iDSesison,$cond,$p_kem_priglashen_chk,$p_kem_priglashen_family,$p_kem_priglashen_name);  // Есть ли такой пользователь
	$error_p = $oWS->ShowError(); // Ошибка, если Нет такого ЧК в БД
		if(!$error_p) {$op=1;$email = $arCheck_p["EMAIL"];}
		else {$op=0;$errors["CHK"]=ft('ERROR_NOTE_1',$_SESSION["f_lang"]);}
		
		 // Если ЧК существует, продолжаем проверки
	if($op) {		

						// Проверка на возможность участия ЧК
		$cond=$condition_member;   // id проверяемого условия
		$arCheck = $oWS->CheckConf($iDSesison,$cond,$p_kem_priglashen_chk,$p_kem_priglashen_family,$p_kem_priglashen_name);  // Условие участия в мероприятии
		$error = $oWS->ShowError(); // Ошибка, если Не выполнено условие участия в мероприятии
		if(!$error) {
			$promotion_1=1; // промоушен участия
		//$op=1;
		}
		else {
			$promotion_1=0;// промоушен участия
			//$op=0;
			}
		
	  //Может ли участник приглашать гостей-ЧК
	  $cond=$condition_guest_chk;   // id проверяемого условия
		$arCheck_gck = $oWS->CheckConf($iDSesison,$cond,$p_kem_priglashen_chk,$p_kem_priglashen_family,$p_kem_priglashen_name);  // Возможность приглашения гостей-ЧК
		$error_gck = $oWS->ShowError(); // Ошибка, если Нет возможности
			if(!$error_gck) {
			$op=1;
			if($arCheck_gck["EMAIL"]) $email = $arCheck_gck["EMAIL"];
			}
			else {$op=0;$errors["LIMIT_MEMBER"]=ft('ERROR_NOTE_3',$_SESSION["f_lang"]);}
	}
		
	 // Если такой ЧК может приглашать гостей-ЧК, продолжаем проверки
	if($op) {			
	  //Есть ли приглашаемый ЧК в БД
	  $cond=$condition_chk;   // id проверяемого условия
		$arCheck_p = $oWS->CheckConf($iDSesison,$cond,$p_chk,$p_family,$p_name);  // Есть ли такой пользователь
		$error_p = $oWS->ShowError(); // Ошибка, если Нет такого ЧК в БД
			if(!$error_p) {
			$op=1;
			if($arCheck_p["EMAIL"]) $email = $arCheck_p["EMAIL"];
			}
			else {$op=0;$errors["CHK"]=ft('ERROR_NOTE_9',$_SESSION["f_lang"]);}
	}
	
	 // Если такие ЧК существуют и есть возможность приглашения, продолжаем проверки
	if($op) {	
				// Проверка приглашающего ЧК на регистрацию, как участника на это мероприятие
		// фильтр по статусам результата
		$marFilter = array("STATUS_ID" => $fist);
		// фильтр по вопросам
		$marFields = array();

		$marFields[] = array(
			"SID" => $chk,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_kem_priglashen_chk,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $name,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_kem_priglashen_name,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $family,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_kem_priglashen_family,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $status,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "ANSWER_VALUE",                 // параметр выборки по введённому значению
		"VALUE" => $a_v_member,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);		

		$marFilter["FIELDS"] = $marFields;

		$rsResults = CFormResult::GetList($FORM_ID, 
			($by="s_id"), 
			($order="asc"), 
			$marFilter, 
			$mis_filtered, 
			"N");
		$chk_reg=0;        // Переменная, где хранится кол-во регистраций приглашающего ЧК в форме, как участника
		while ($arResult = $rsResults->Fetch())
		  {
		   $chk_reg++;
		  }
		  if(!$chk_reg) {
		  $errors["PROMOTION"]=ft('ERROR_NOTE_5',$_SESSION["f_lang"]);// Приглашающий Вас ЧК не зарегистрирован на мероприятие.
		  $op=0;
		  }
		  else $op=1;
		 unset($marFilter);
		 }
		 
		 // Если приглашающий зарегистрирован на мероприятие, продолжаем проверку
	if($op) {	
		 
		 	// Проверка приглашающего ЧК на регистрацию, как гостя-ЧК на это мероприятие
		// фильтр по статусам результата
		$marFilter = array("STATUS_ID" => $fist);
		// фильтр по вопросам
		$marFields = array();

		$marFields[] = array(
			"SID" => $chk,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_kem_priglashen_chk,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $name,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_kem_priglashen_name,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $family,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_kem_priglashen_family,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $status,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "ANSWER_VALUE",                 // параметр выборки по введённому значению
		"VALUE" => $a_v_guest_chk,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);		

		$marFilter["FIELDS"] = $marFields;

		$rsResults = CFormResult::GetList($FORM_ID, 
			($by="s_id"), 
			($order="asc"), 
			$marFilter, 
			$mis_filtered, 
			"N");
		$chk_guest_reg=0;                 // Переменная, где хранится кол-во регистраций ЧК в форме, как гостя-ЧК
		while ($arResult = $rsResults->Fetch())
		  {
		   $chk_guest_reg++;
		  }
		    if($chk_guest_reg) {
		  $errors["PROMOTION"]=ft('ERROR_NOTE_11',$_SESSION["f_lang"]);// Приглашающий Вас ЧК не должен быть гостем на мероприятии
		  $op=0;
		  }
		  else $op=1;
		unset($marFilter);
	}
	
	if($op) {
	
		// Проверка кол-ва приглашённых-ЧК приглашающего 
				
		// формируем фильтр по статусам результата

		$marFilter = array("STATUS_ID" => $fist);

		// фильтр по вопросам
		$marFields = array();

		$marFields[] = array(
			"SID" => $kem_priglashen_chk,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_kem_priglashen_chk,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $kem_priglashen_name,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_kem_priglashen_name,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $kem_priglashen_family,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_kem_priglashen_family,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $status,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "ANSWER_VALUE",                 // параметр выборки по введённому значению
		"VALUE" => $a_v_guest_chk,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
			
		$marFilter["FIELDS"] = $marFields;

		$rsResults = CFormResult::GetList($FORM_ID, 
			($by="s_id"), 
			($order="asc"), 
			$marFilter, 
			$mis_filtered, 
			"N");
		$guest_chk_reg=0;                 // Переменная, где хранится кол-во приглашений членов клуба от этого приглашающего
		while ($arResult = $rsResults->Fetch())
		  {
		   $guest_chk_reg++;
		  }
		  
		if($guest_chk_reg >= $limit_guest_chk) {
		$errors["LIMIT_GUEST"]=ft('ERROR_NOTE_13',$_SESSION["f_lang"]); // Приглашающий Вас ЧК превысил лимит приглашения членов клуба
		$op=1;
		}
		else $op=0;
		
	}
	
	// Если  с приглашающим всё в порядке, продолжаем проверки
	if($op) {
				// Проверка приглашемого ЧК на регистрацию, как участника на это мероприятие
		// фильтр по статусам результата
		$marFilter = array("STATUS_ID" => $fist);
		// фильтр по вопросам
		$marFields = array();

		$marFields[] = array(
			"SID" => $chk,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_chk,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $name,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_name,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $family,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_family,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $status,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "ANSWER_VALUE",                 // параметр выборки по введённому значению
		"VALUE" => $a_v_member,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);		

		$marFilter["FIELDS"] = $marFields;

		$rsResults = CFormResult::GetList($FORM_ID, 
			($by="s_id"), 
			($order="asc"), 
			$marFilter, 
			$mis_filtered, 
			"N");
		$guest_chk_reg=0;        // Переменная, где хранится кол-во регистраций приглашаемого ЧК в форме, как участника
		while ($arResult = $rsResults->Fetch())
		  {
		   $guest_chk_reg++;
		  }
		  if($guest_chk_reg) {
		  $errors["PROMOTION"]=ft('ERROR_NOTE_4',$_SESSION["f_lang"]);// Заявка от этого ЧК уже есть в базе заявок на мероприятие.
		  $op=0;
		  }
		  else $op=1;
		 unset($marFilter);
		 }
		 
		 // Если приглашаемый не зарегистрирован на мероприятие, продолжаем проверку
	if($op) {	
		 
		 	// Проверка приглашаемого ЧК на регистрацию, как гостя-ЧК на это мероприятие
		// фильтр по статусам результата
		$marFilter = array("STATUS_ID" => $fist);
		// фильтр по вопросам
		$marFields = array();

		$marFields[] = array(
			"SID" => $chk,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_chk,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $name,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_name,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $family,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_family,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $status,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "ANSWER_VALUE",                 // параметр выборки по введённому значению
		"VALUE" => $a_v_guest_chk,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);		

		$marFilter["FIELDS"] = $marFields;

		$rsResults = CFormResult::GetList($FORM_ID, 
			($by="s_id"), 
			($order="asc"), 
			$marFilter, 
			$mis_filtered, 
			"N");
		$guest_chk_guest_reg=0;                 // Переменная, где хранится кол-во регистраций ЧК в форме, как гостя-ЧК
		while ($arResult = $rsResults->Fetch())
		  {
		   $guest_chk_guest_reg++;
		  }
		    if($guest_chk_guest_reg) {
		  $errors["PROMOTION"]=ft('ERROR_NOTE_10',$_SESSION["f_lang"]);// Приглашение для этого ЧК уже есть в базе заявок на мероприятие.
		  $op=0;
		  }
		  else $op=1;
		unset($marFilter);
	}
	
}



// Входящие данные для проверки приглашающего родственников /////////////
if ($p_status==$a_status[2]) {

//Исходные данные для проверки 

//Есть ли такой  приглашающий в БД
$cond=$condition_chk;   // id проверяемого условия
	$arCheck_p = $oWS->CheckConf($iDSesison,$cond,$p_kem_priglashen_chk,$p_kem_priglashen_family,$p_kem_priglashen_name);  // Есть ли такой пользователь
	$error_p = $oWS->ShowError(); // Ошибка, если Нет такого ЧК в БД
		if(!$error_p) {$op=1;$email = $arCheck_p["EMAIL"];}
		else {$op=0;$errors["CHK"]=$error_p;}

		// Если такой ЧК существует, продолжаем проверки
if($op) {	

						// Проверка на возможность участия ЧК
		$cond=$condition_member;   // id проверяемого условия
		$arCheck = $oWS->CheckConf($iDSesison,$cond,$p_kem_priglashen_chk,$p_kem_priglashen_family,$p_kem_priglashen_name);  // Условие участия в мероприятии
		$error = $oWS->ShowError(); // Ошибка, если Не выполнено условие участия в мероприятии
		if(!$error) {
			$promotion_1=1; // промоушен участия
		//$op=1;
		}
		else {
			$promotion_1=0;// промоушен участия
			//$op=0;
			}
		
// Проверка участника или приглашающего на регистрацию на это мероприятие

		// формируем фильтр по статусам

		$marFilter = array("STATUS_ID" => $fist);

		// фильтр по вопросам
		$marFields = array();

		$marFields[] = array(
			"SID" => $chk,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_kem_priglashen_chk,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $name,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_kem_priglashen_name,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $family,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_kem_priglashen_family,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
	$marFields[] = array(
			"SID" => $status,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "ANSWER_VALUE",                 // параметр выборки по введённому значению
		"VALUE" => $a_v_member,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);		

		$marFilter["FIELDS"] = $marFields;

		$rsResults = CFormResult::GetList($FORM_ID, 
			($by="s_id"), 
			($order="asc"), 
			$marFilter, 
			$mis_filtered, 
			"N");
		$chk_reg=0;                 // Переменная, где хранится кол-во регистраций ЧК в форме, как участника
		while ($arResult = $rsResults->Fetch())
		  {
		   $chk_reg++;
		  }
		 if(!$chk_reg) {
		  $errors["PROMOTION"]=ft('ERROR_NOTE_5',$_SESSION["f_lang"]);// Приглашающий Вас ЧК не зарегистрирован на мероприятие.
		  $op=0;
		  }
		  else $op=1;

	}
	// Если приглашающий зарегистрирован на мероприятие, продолжаем проверки
	if($op) {	
	
		// Проверка кол-ва приглашённых родственников приглашающего 
				
		// формируем фильтр по статусам результата

		$marFilter = array("STATUS_ID" => $fist);

		// фильтр по вопросам
		$marFields = array();

		$marFields[] = array(
			"SID" => $kem_priglashen_chk,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_kem_priglashen_chk,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $kem_priglashen_name,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_kem_priglashen_name,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $kem_priglashen_family,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
		"VALUE" => $p_kem_priglashen_family,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
		$marFields[] = array(
			"SID" => $status,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "ANSWER_VALUE",                 // параметр выборки по введённому значению
		"VALUE" => $a_v_guest,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);
			
		$marFilter["FIELDS"] = $marFields;

		$rsResults = CFormResult::GetList($FORM_ID, 
			($by="s_id"), 
			($order="asc"), 
			$marFilter, 
			$mis_filtered, 
			"N");
		$guest_reg=0;                 // Переменная, где хранится кол-во приглашений родственников от этого приглашающего
		while ($arResult = $rsResults->Fetch())
		  {
		   $guest_reg++;
		  }
		  
		if($guest_reg >= $limit_guest) {
		$errors["LIMIT_GUEST"]=ft('ERROR_NOTE_6',$_SESSION["f_lang"]); // Приглашающий Вас ЧК превысил лимит приглашения родственников
		$op=1;
		}
		else $op=0;
		
	}
}
*/
$errors["CHK"]=getMessage("ERNCHK");
$erk=count($errors);  // кол-во ошибок в массиве ошибок
$fu=1;              // флаг доступа к заполнению полей формы

//echo "<pre>";print_r($errors);echo "</pre>";
?>