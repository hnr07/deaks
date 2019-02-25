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
			$status="status"; // символьный идентификатор вопроса "Статус" по которому фильтруем
			
			if(!$fir){
				$p_chk=$_POST['chk'];
				$p_family=$_POST['family'];
				$p_name=$_POST['name'];
				$p_kem_priglashen_chk=$_POST['kem_priglashen_chk'];
				$p_kem_priglashen_family=$_POST['kem_priglashen_family'];
				$p_kem_priglashen_name=$_POST['kem_priglashen_name'];
			}
			$ar_fist=array($status_ok, $status_nepr, $status_nopl, $status_rz, $status_opl);// массив необходимых статусов
			$fist=implode(" | ", $ar_fist); // строка фильтра статусов результата
			

			
	$errors=array(); // массив ошибок
	CModule::IncludeModule('form'); // подключаем модуль форма 
	$FORM_ID=$form_m;  // ID формы

	$iDSesison=$summit_id;

	if ($p_status==$a_status[0]) {

	//Исходные данные для проверки участника	

	//Есть ли ЧК в БД
	$cond=$condition_chk;   // id проверяемого условия
	//$start = microtime(true); 
		$arCheck = filter_chk($iDSesison,$cond,$p_chk,$p_family,$p_name);  // Есть ли такой пользователь
		//echo 'Время выполнения скрипта: '.(microtime(true) - $start).' сек.';
		
			if($arCheck["Result"]) {$op=1;$email = $arCheck["Result"]["Email"];}
			else {$op=0;$errors["CHK"]='ERROR_CODE_0';}
	//echo "<br>>>> ".$arCheck["ErrorText"]."<br>";
	//echo "<pre>";print_r($arCheck);echo "</pre>";
			// Если такой ЧК существует, продолжаем проверки
		if($op) {
			// Проверка на возможность участия ЧК
			$cond=$condition_member;   // id проверяемого условия
			$arCheck = filter_chk($iDSesison,$cond,$p_chk,$p_family,$p_name);  // Условие участия в мероприятии
			//print_r($arCheck);
			if(($arCheck["Result"])) {
			
				if($arCheck["Result"]["Partner"]=='') $arCheck["Result"]["Partner"]=0;
				$partner=$arCheck["Result"]["Partner"];
				$promotion_1=1; // промоушен участия
			}
			else {
				$errors["MEMBER"]='ERROR_CODE_1';
				$partner="";
				
				//$promotion_1=0;// промоушен участия
				//$op=0;
			}
			
			// Проверка на возможность участия в гала-ужине
			$cond=$condition_ujin;   // id проверяемого условия
			$arCheck = filter_chk($iDSesison,$cond,$p_chk,$p_family,$p_name);  // Условие участия в гала-ужине

			if(($arCheck["Result"])) {
				$promotion_2=1; // промоушен участия в гала-ужине
			}
			else {

				$promotion_2=0;// промоушен участия в гала-ужине
			}
		}
		//$op=1;
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
						$errors["LIMIT_MEMBER"]='ERROR_NOTE_4';// Заявка от этого ЧК уже есть в базе заявок на мероприятие.
						}
						else $op=1;
					}
					else {         // партнёра нет
						if($chk_reg) {
						$op=0;
						$errors["LIMIT_MEMBER"]='ERROR_NOTE_4';// Заявка от этого ЧК уже есть в базе заявок на мероприятие.
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
			$errors["LIMIT_MEMBER"]='ERROR_NOTE_10';// Приглашение для этого ЧК уже есть в базе заявок на мероприятие.
			}
			else $op=1;
		}
	}


	$erk=count($errors);  // кол-во ошибок в массиве ошибок
				 
	if($erk) {
		$fu=0;  // флаг доступа к заполнению полей формы
		foreach($errors as $key=>$val) {
			echo "<div class='mess_rey'>".getMessage($val); // Текст ошибки
			if($key=="MEMBER" and count($errors) >= 1) $fu=0;                // Разрешить регистрацию даже, если не пройдено условие участия
			echo "</div>";
		}
	}
	else {
		$fu=1;  // флаг доступа к заполнению полей формы
	}
	
}
*/
$fu=1;$promotion_1=1;$promotion_2=1;$email="test@test.test"; 
if(!$fir) echo "^".$fu."^".$promotion_1."^".$promotion_2."^".$email ;

if(!$fir) require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>