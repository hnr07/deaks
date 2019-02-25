<?if(!$fir) require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");?>
<?IncludePublicLangFile(__FILE__);?>
<?
/*
if(!$fir) require_once($_SERVER["DOCUMENT_ROOT"]."/com/registration_event/".$_POST['code_m']."/var_config.php");

require_once($_SERVER["DOCUMENT_ROOT"]."/ccws/sum_models/class_event.php");
global $ccws;
$ccws= new ccws_event();
include "CheckPerson.php"; //Подключение CheckPerson

if($ignor_filter_chk) {
	$fu=1;  // флаг доступа к заполнению полей формы
	$promotion_1=1; // промоушен участия
	$promotion_2=1; // промоушен участия в гала-ужине
	echo "<div class='mess_rey'>".getMessage("ignor_filter")."</div>"; // Текст ошибки
}
else {
	function filter_chk($s_id, $cond, $chk, $family, $name) {
		
		$arCh=Person_check(array(  
			'SummitId' => $s_id,
			'QuestionId' => $cond, //ИД ВОПРОСА
			'PersonId' => $chk,
			'PersonFirstName' => $name,
			'PersonLastName' => $family
			));
			
		return $arCh;
		
		return true;
	}

			$chk="chk"; // символьный идентификатор вопроса "№ ЧК" по которому фильтруем
			$name="name"; // символьный идентификатор вопроса "Имя" по которому фильтруем
			$family="family"; // символьный идентификатор вопроса "Фамилия" по которому фильтруем
			
			$kem_priglashen_chk="kem_priglashen_chk"; // символьный идентификатор вопроса "Кем приглашен - № ЧК" по которому фильтруем
			$kem_priglashen_name="kem_priglashen_name"; // символьный идентификатор вопроса "Кем приглашен - Имя" по которому фильтруем
			$kem_priglashen_family="kem_priglashen_family"; // символьный идентификатор вопроса "Кем приглашен - Фамилия" по которому фильтруем
			
			if(!$fir){
				$p_chk=$_POST['chk'];
				$p_family=$_POST['family'];
				$p_name=$_POST['name'];
				$p_kem_priglashen_chk=$_POST['kem_priglashen_chk'];
				$p_kem_priglashen_family=$_POST['kem_priglashen_family'];
				$p_kem_priglashen_name=$_POST['kem_priglashen_name'];
			}
			
			$status="status"; // символьный идентификатор вопроса "Статус" по которому фильтруем
			
			$ar_fist=array($status_ok, $status_nepr, $status_nopl, $status_rz, $status_opl);// массив необходимых статусов
			$fist=implode(" | ", $ar_fist); // строка фильтра статусов результата
			

			
	$errors=array(); // массив ошибок
	CModule::IncludeModule('form'); // подключаем модуль форма 
	$FORM_ID=$form_m;  // ID формы

	$iDSesison=$summit_id;

//Исходные данные для проверки 	
//Есть ли приглашающий ЧК в БД
$cond=$condition_chk;   // id проверяемого условия
	$arCheck = filter_chk($iDSesison,$cond,$p_kem_priglashen_chk,$p_kem_priglashen_family,$p_kem_priglashen_name);  // Есть ли такой пользователь

		if(($arCheck["Result"])) {$op=1;$email = $arCheck["Result"]["Email"];}
		else {$op=0;$errors["CHK"]='ERROR_CODE_2';}
	
		 // Если ЧК существует, продолжаем проверки
	if($op) {		

						// Проверка на возможность участия ЧК
		$cond=$condition_member;   // id проверяемого условия
		$arCheck = filter_chk($iDSesison,$cond,$p_kem_priglashen_chk,$p_kem_priglashen_family,$p_kem_priglashen_name);  // Условие участия в мероприятии

		if($arCheck["Result"]) {
			$promotion_1=1; // промоушен участия
		//$op=1;
		}
		else {
			$promotion_1=0;// промоушен участия
			//$op=0;
		}
			
		// Проверка на возможность участия ЧК в гала-ужине
		$cond=$condition_ujin;   // id проверяемого условия
		$arCheck = filter_chk($iDSesison,$cond,$p_kem_priglashen_chk,$p_kem_priglashen_family,$p_kem_priglashen_name);  // Условие участия в гала-ужине

		if(($arCheck["Result"])) {
			$promotion_2=1; // промоушен участия в гала-ужине
		}
		else {

			$promotion_2=0;// промоушен участия в гала-ужине
		}
		
	  //Может ли участник приглашать гостей-ЧК
	  $cond=$condition_guest_chk;   // id проверяемого условия
		$arCheck = filter_chk($iDSesison,$cond,$p_kem_priglashen_chk,$p_kem_priglashen_family,$p_kem_priglashen_name);  // Возможность приглашения гостей-ЧК
//print_r($arCheck);
			if($arCheck["Result"]) {
			$op=1; 
			if($arCheck["Result"]["Email"]) $email = $arCheck["Result"]["Email"];
			}
			else {$op=0;$errors["LIMIT_MEMBER"]='ERROR_CODE_0'; 	}
	}
		
	 // Если такой ЧК может приглашать гостей-ЧК, продолжаем проверки
	if($op) {			
	  //Есть ли приглашаемый ЧК в БД
	  $cond=$condition_chk;   // id проверяемого условия
		$arCheck = filter_chk($iDSesison,$cond,$p_chk,$p_family,$p_name);  // Есть ли такой пользователь

			if($arCheck["Result"]) {
			$op=1;
			if($arCheck["Result"]["Email"]) $email = $arCheck["Result"]["Email"];
			}
			else {$op=0;$errors["CHK"]='ERROR_CODE_0';}
	}
	
//	$op=1;
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
				
		$marFields[] = array(
            "SID" => "id_venue",                      // символьный идентификатор вопроса 
			"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
			"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
			"VALUE" => $id_venue,                       // выборка по значению
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
		  $errors["PROMOTION"]='ERROR_NOTE_5';// Приглашающий Вас ЧК не зарегистрирован на мероприятие.
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

		$marFields[] = array(
            "SID" => "id_venue",                      // символьный идентификатор вопроса 
			"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
			"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
			"VALUE" => $id_venue,                       // выборка по значению
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
		  $errors["PROMOTION"]='ERROR_NOTE_11';// Приглашающий Вас ЧК не должен быть гостем на мероприятии
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
			
		$marFields[] = array(
            "SID" => "id_venue",                      // символьный идентификатор вопроса 
			"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
			"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
			"VALUE" => $id_venue,                       // выборка по значению
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
		$errors["LIMIT_GUEST"]='ERROR_NOTE_13'; // Приглашающий Вас ЧК превысил лимит приглашения членов клуба
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
			"SID" => $status,                      // символьный идентификатор вопроса 
		"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
		"PARAMETER_NAME" => "ANSWER_VALUE",                 // параметр выборки по введённому значению
		"VALUE" => $a_v_member,                       // выборка по значению
		"EXACT_MATCH"   => "Y"                    // точное совпадение          
			);		
			
		$marFields[] = array(
            "SID" => "id_venue",                      // символьный идентификатор вопроса 
			"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
			"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
			"VALUE" => $id_venue,                       // выборка по значению
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
		  $errors["PROMOTION"]='ERROR_NOTE_4';// Заявка от этого ЧК уже есть в базе заявок на мероприятие.
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

		$marFields[] = array(
            "SID" => "id_venue",                      // символьный идентификатор вопроса 
			"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
			"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
			"VALUE" => $id_venue,                       // выборка по значению
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
		  $errors["PROMOTION"]='ERROR_NOTE_10';// Приглашение для этого ЧК уже есть в базе заявок на мероприятие.
		  $op=0;
		  }
		  else $op=1;
		  
		unset($marFilter);
	}
	
}
$erk=count($errors);  // кол-во ошибок в массиве ошибок
				 
	if($erk) {
		$fu=0;  // флаг доступа к заполнению полей формы
		foreach($errors as $key=>$val) {
			echo "<div class='mess_rey'>".getMessage($val); // Текст ошибки
			if($key=="MEMBER" and count($errors) == 1) $fu=1;                // Разрешить регистрацию даже, если не пройдено условие участия
			echo "</div>";
		}
	}
	else {
		$fu=1;  // флаг доступа к заполнению полей формы
	}
	*/
	$fu=1;$promotion_1=1;$promotion_2=1;$email="test@test.test";
if(!$fir) echo "^".$fu."^".$promotion_1."^".$promotion_2."^".$email;

if(!$fir) require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");

?>