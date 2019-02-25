<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");?>
<?IncludePublicLangFile(__FILE__);?>
<?
/*
//bxmail("koisha2006@narod.ru","test",implode("- ",$arCheck_p));
//echo $_SERVER["DOCUMENT_ROOT"]."/com/registration_event/".$_POST['code_m']."/var_config.php";
//require_once("../".$_POST['code_m']."/var_config.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/com/registration_event/".$_POST['code_m']."/var_config.php");
//echo $condition_payment;
require_once($_SERVER["DOCUMENT_ROOT"]."/ccws/sum_models/class_event.php");
global $ccws;
$ccws= new ccws_event();
include "CheckPerson.php"; //Подключение CheckPerson

if($ignor_filter_pl) {
	$currency_id=$currency_id_ignor;
	$currency=$currency_ignor;
	$option="";
	$error=0;
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
		
}


// ВЫБИРАЕМ ЗНАЧЕНИЯ из POST
$p_chk='';  //№ ЧК плательщика 
if(isset($_POST['p_chk'])) $p_chk=$_POST['p_chk'];
$p_family=''; //Фамилия плательщика 
if(isset($_POST['p_family'])) $p_family=$_POST['p_family'];
$p_name=''; //Имя плательщика 
if(isset($_POST['p_name'])) $p_name=$_POST['p_name'];
$stts='';// 1-Если № ЧК равен № ЧК плательщика, 0 - Если № ЧК не равен № ЧК плательщика
if(isset($_POST['stts'])) $stts=$_POST['stts'];
$gr_chk=''; // № ЧК гаранта
if(isset($_POST['gr_chk'])) $gr_chk=$_POST['gr_chk'];
$gr_family=''; // Фамилия гаранта
if(isset($_POST['gr_family'])) $gr_family=$_POST['gr_family'];
$gr_name='';  // Имя гаранта
if(isset($_POST['gr_name'])) $gr_name=$_POST['gr_name'];
$br=''; // 1 - Если оплата без рассрочки, 0 - Если оплата с рассрочкой
if(isset($_POST['br'])) $br=$_POST['br'];

//echo $p_chk." ".$p_family." ".$p_name." ";


 
 $iDSesison=$summit_id;
 
 // Возвращаем
 $error=0;  // код  проверки плательщика -  пройдена
 $garant=0;  // необходимость гаранта
 $option=0;  // промоушен оплаты
 $email="";  // почта плательщика
 $currency="";  //  символьный код валюты
 $currency_id="";  // id валюты
 // $option - возвращаемый проверкой плательщика параметр
 // $option_п - возвращаемый проверкой гаранта параметр
 if (!empty($_POST)) {
 //Проверка плательщика
$cond=$condition_payment;   // id проверяемого условия
	$arCheck_p = filter_chk($iDSesison,$cond,$p_chk,$p_family,$p_name);  // Проверка плательщика

	//echo "<pre>";print_r($arCheck_p);echo "</pre>";
	if($arCheck_p["Result"]) {
		$op=1;
		$email = $arCheck_p["Result"]["Email"];
		$currency_id=$arCheck_p["Result"]["Currency"];
		if($arCheck_p["Result"]["Extended"] || $arCheck_p["Result"]["Currency"]|| $arCheck_p["Result"]["Email"]) $option=1;
	}
	else {
		$op=0;
		$error=1;// Код проверки плательщика - не пройдена
		$error_txt=getMessage("ERROR_PL_1"); // текст ошибки
	}

	if($op) {
		if($stts) { 
			if(!$option) {
			 	$garant=1;
				if(!$br) {
				$error=2;// Код проверки плательщика - нужен гарант
				$error_txt=getMessage("ERROR_PL_2"); // текст ошибки
				 //Проверка гаранта
					if($gr_chk && $gr_family && $gr_name) {
						$cond=$condition_payment;   // id проверяемого условия
						$arCheck_g = filter_chk($iDSesison,$cond,$gr_chk,$gr_family,$gr_name);  //Проверка гаранта
							// Ошибка, если Не может быть гарантом
							if($arCheck_g["Result"]) {
								$op=1;
								$email_g = $arCheck_g["Result"]["Email"];
								$currency_g=$arCheck_g["Result"]["Currency"];
								
								$option_g=$arCheck_g["Result"]["Extended"];$error="";
								}
							else {

								$op=0;
								$error=5;// Код проверки плательщика -  Проверка Гаранта не пройдена
								$error_txt=getMessage("ERROR_PL_5"); // текст ошибки
							}
					}
				}
			}
		}
		else { 
			if(!$option) { 
				$error=3; // Код проверки плательщика -не пройдена
				$error_txt=getMessage("ERROR_PL_3"); // текст ошибки

			}
			else {

				CModule::IncludeModule('form'); // подключаем модуль форма 
				$FORM_ID=$form_m;  // ID формы
				$pl_chk="pl_chk"; // символьный идентификатор вопроса "№ ЧК плательщика" по которому фильтруем
				$pl_name="pl_name"; // символьный идентификатор вопроса "Имя плательщика" по которому фильтруем
				$pl_family="pl_family"; // символьный идентификатор вопроса "Фамилия плательщика" по которому фильтруем
				$ar_fist=array($status_ok, $status_nepr, $status_nopl, $status_rz, $status_opl);// массив необходимых статусов
				$fist=implode(" | ", $ar_fist); // строка фильтра статусов результата
				// фильтр по вопросам
				$marFilter = array("STATUS_ID" => $fist);
				$marFields = array();

				$marFields[] = array(
					"SID" => $pl_chk,                      // символьный идентификатор вопроса 
				"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
				"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
				"VALUE" => $p_chk,                       // выборка по значению
				"EXACT_MATCH"   => "Y"                    // точное совпадение          
					);
				$marFields[] = array(
					"SID" => $pl_name,                      // символьный идентификатор вопроса 
				"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
				"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
				"VALUE" => $p_name,                       // выборка по значению
				"EXACT_MATCH"   => "Y"                    // точное совпадение          
					);
				$marFields[] = array(
					"SID" => $pl_family,                      // символьный идентификатор вопроса 
				"FILTER_TYPE" => "text",                 //// фильтруем по текстовому полю
				"PARAMETER_NAME" => "USER",                 // параметр выборки по введённому значению
				"VALUE" => $p_family,                       // выборка по значению
				"EXACT_MATCH"   => "Y"                    // точное совпадение          
					);

					
				$marFilter["FIELDS"] = $marFields;

				$rsResults = CFormResult::GetList($FORM_ID, 
					($by="s_id"), 
					($order="asc"), 
					$marFilter, 
					$mis_filtered, 
					"N");
				$pl_reg=0;                 // Переменная, где хранится кол-во  плательщиков с этого №ЧК
				while ($arResult = $rsResults->Fetch())
				  {
				   $pl_reg++;
				  }
				  if ( $USER->IsAdmin() ){//skip check for admins
              $mail_ok=1;
          }else{
			  if($option=="ЗД") $lim=2;
			  else $lim=20000;
            if($pl_reg>=$lim) {
              $error=4;// Код проверки платильщика - не пройдена исчерпан лимит
				$error_txt=getMessage("ERROR_PL_4"); // текст ошибки
			}
            else
              $mail_ok=1;
			  }
          }

			}
	}
		
		if($op) {
		
			if(CModule::IncludeModule("form")){ 
				$FORM_ID = 8;
				$arFilter = array();
				$arFields = array();
				$arFields[] = array(
					"CODE"              => "currency_number",     // код поля по которому фильтруем
					"FILTER_TYPE"       => "text",          // фильтруем по числовому полю
					"PARAMETER_NAME"    => "USER",          // фильтруем по введенному значению
					"VALUE"             => trim($currency_id),        // значение по которому фильтруем
					"EXACT_MATCH"       => "Y"              // ищем точное совпадение
				);
				$arFilter["FIELDS"] = $arFields;
				$rsResults = CFormResult::GetList($FORM_ID, 
					($by="s_timestamp"), 
					($order="asc"), 
					$arFilter, 
					$is_filtered, 
					"Y", 
					false);
				
				while ($arResult = $rsResults->Fetch())
				{
				//echo "<pre>";print_r($arResult);echo "</pre>";
				$RESULT_ID=$arResult['ID'];
				$arAnswer = CFormResult::GetDataByID(
				$RESULT_ID, 
				array('code'),  // массив символьных кодов необходимых вопросов
				$ar_Res, 
				$ar_Answer2); 
					
				$currency=$arAnswer['code'][0]['USER_TEXT'];
				}
			}
		}
 }


if($mail_g_ok) { // Письмо гаранту

	$subject="Золотые для золотых";
	$message="Уважаемый(-ая), ".$gr_fio." ".$gr_name."!\n Ваши данные были указаны для гаранта оплаты участия в Мероприятии Кораллового Клуба \"Золотые для Золотых 2013\".\n 
	Если у Вас возникли вопросы, пожалуйста, свяжитесь с менеджером Coral Club
Аленой Пастуховой по адресу: manager_rio2@coral-club.com.";

	$headers= "MIME-Version: 1.0\r\n";
    $headers.= "Content-type: text/plain; charset=UTF-8\r\n";
	mail($email_g, $subject, $message, $headers);

}

if($mail_ok) { // Письмо плательщику

	$subject="Золотые для золотых";
	$message="Уважаемый(-ая), ".$p_fio." ".$p_name."!\n Ваши данные были указаны для оплаты участия в Мероприятии Кораллового Клуба \"Золотые для Золотых 2013\".
Пожалуйста, подтвердите свое согласие, либо откажитесь от оплаты.\n Если у Вас возникли вопросы, пожалуйста, свяжитесь с менеджером Coral Club
Аленой Пастуховой по адресу: manager_rio2@coral-club.com.";

	$headers= "MIME-Version: 1.0\r\n";
    $headers.= "Content-type: text/plain; charset=UTF-8\r\n";
	mail($email, $subject, $message, $headers);
	
}


//if(trim($error_txt)) echo "<div class='mess_rey'>".$error_txt."</div>";
}
*/
$error_txt="Проверка отключена";echo "<div class='mess_rey'>".$error_txt."</div>";
$currency_id=810;$currency="RUR";$option=1;$email="test@test.test";$garant=0;$error=0;
$j="^"; //разделитель 
echo $j.$currency_id.$j.$currency.$j.$option.$j.$email.$j.$garant.$j.$error;
 


//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>