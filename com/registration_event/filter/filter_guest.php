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

//Есть ли такой  приглашающий в БД
$cond=$condition_chk;   // id проверяемого условия
	$arCheck = filter_chk($iDSesison,$cond,$p_kem_priglashen_chk,$p_kem_priglashen_family,$p_kem_priglashen_name);  // Есть ли такой пользователь

		if($arCheck["Result"]) {$op=1;$email = $arCheck["Result"]["Email"];}
		else {$op=0;$errors["CHK"]='ERROR_CODE_2';}

		// Если такой ЧК существует, продолжаем проверки
if($op) {	

						// Проверка на возможность участия ЧК
		$cond=$condition_member;   // id проверяемого условия
		$arCheck = filter_chk($iDSesison,$cond,$p_kem_priglashen_chk,$p_kem_priglashen_family,$p_kem_priglashen_name);  // Условие участия в мероприятии
		//$error = $oWS->ShowError(); // Ошибка, если Не выполнено условие участия в мероприятии
		if($arCheck["Result"]) {
			$promotion_1=1; // промоушен участия
		//$op=1;
		}
		else {
			$promotion_1=0;// промоушен участия
			//$op=0;
			}
	//$op=1;
		// Проверка на возможность участия ЧК в гала-ужине
		$cond=$condition_ujin;   // id проверяемого условия
		$arCheck = filter_chk($iDSesison,$cond,$p_kem_priglashen_chk,$p_kem_priglashen_family,$p_kem_priglashen_name);  // Условие участия в гала-ужине

		if(($arCheck["Result"])) {
			$promotion_2=1; // промоушен участия в гала-ужине
		}
		else {

			$promotion_2=0;// промоушен участия в гала-ужине
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
		$chk_reg=0;                 // Переменная, где хранится кол-во регистраций ЧК в форме, как участника
		while ($arResult = $rsResults->Fetch())
		  {
		   $chk_reg++;
		  }
		 if(!$chk_reg) {
		  $errors["PROMOTION"]='ERROR_NOTE_5';// Приглашающий Вас ЧК не зарегистрирован на мероприятие.
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
		$guest_reg=0;                 // Переменная, где хранится кол-во приглашений родственников от этого приглашающего
		while ($arResult = $rsResults->Fetch())
		  {
		   $guest_reg++;
		  }
		  
		if($guest_reg >= $limit_guest) {
		$errors["LIMIT_GUEST"]='ERROR_NOTE_6'; // Приглашающий Вас ЧК превысил лимит приглашения родственников
		$op=1;
		}
		else $op=0;
		
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