<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/classes/cci_pdpws.php");
$APPLICATION->SetTitle("PDPWS");
global $APLICATION, $USER, $CCIExternalAuth;
$oWS = new CCI_PDPWS();
// ОПРЕДЕЛЯЕМ СЕССИЮ
$iDSesison = $APPLICATION->get_cookie("BX_AUTH_SESSION_ID");
if(empty($iDSesison)) {$iDSesison = $USER->GetLogin();};
if(empty($iDSesison)) {$iDSesison = "SOS";}

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

include "var_config.php"; 
 
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
	$arCheck_p = $oWS->CheckConf($iDSesison,$cond,$p_chk,$p_family,$p_name);  // Проверка плательщика
	$error_p = $oWS->ShowError(); // Ошибка, если Не может быть плательщиком
		if(!$error_p) {$op=1;$email = $arCheck_p["EMAIL"];$currency=$arCheck_p["CURRENCY"];$option=$arCheck_p["OPTION"];}
		else {
		$op=0;
		$error=1;// Код проверки плательщика - не пройдена
		}
		
	if($op) {
		if($stts) {
			if(!$option) {
			 	$garant=1;
				if(!$br) {
				$error=2;// Код проверки плательщика - нужен гарант
				 //Проверка гаранта
					if($gr_chk && $gr_family && $gr_name) {
						$cond=$condition_payment;   // id проверяемого условия
						$arCheck_g = $oWS->CheckConf($iDSesison,$cond,$gr_chk,$gr_family,$gr_name);  //Проверка гаранта
						$error_g = $oWS->ShowError(); // Ошибка, если Не может быть гарантом
							if(!$error_g) {$op=1;$email_g = $arCheck_g["EMAIL"];$currency_g=$arCheck_g["CURRENCY"];$option_g=$arCheck_g["OPTION"];$error="";}
							else {
							$op=0;
							$error=5;// Код проверки плательщика -  Проверка Гаранта не пройдена
							}
					}
				}
			}
		}
		else {
			if(!$option) $error=3; // Код проверки плательщика -не пройдена
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
            if($pl_reg>=$option)
              $error=4;// Код проверки платильщика - не пройдена исчерпан лимит
            else
              $mail_ok=1;
			  }
          }

			}
		}
		
		$za="SELECT `currency_number` FROM currency_list WHERE `code`='".$currency."'";
		if(!($z=mysql_query($za))) {
		$error=6;// Код проверки платильщика - ошибка обращения к БД
		}
		else{ 
		$pa=mysql_fetch_array($z);
		$currency_id=$pa['currency_number']; // ID валюты
		}
	
 }

if($mail_g_ok) { // Письмо гаранту
/*
	$subject="Золотые для золотых";
	$message="Уважаемый(-ая), ".$gr_fio." ".$gr_name."!\n Ваши данные были указаны для гаранта оплаты участия в Мероприятии Кораллового Клуба \"Золотые для Золотых 2013\".\n 
	Если у Вас возникли вопросы, пожалуйста, свяжитесь с менеджером Coral Club
Аленой Пастуховой по адресу: manager_rio2@coral-club.com.";

	$headers= "MIME-Version: 1.0\r\n";
    $headers.= "Content-type: text/plain; charset=UTF-8\r\n";
	mail($email_g, $subject, $message, $headers);
*/	
}

if($mail_ok) { // Письмо плательщику
/*
	$subject="Золотые для золотых";
	$message="Уважаемый(-ая), ".$p_fio." ".$p_name."!\n Ваши данные были указаны для оплаты участия в Мероприятии Кораллового Клуба \"Золотые для Золотых 2013\".
Пожалуйста, подтвердите свое согласие, либо откажитесь от оплаты.\n Если у Вас возникли вопросы, пожалуйста, свяжитесь с менеджером Coral Club
Аленой Пастуховой по адресу: manager_rio2@coral-club.com.";

	$headers= "MIME-Version: 1.0\r\n";
    $headers.= "Content-type: text/plain; charset=UTF-8\r\n";
	mail($email, $subject, $message, $headers);
*/	
}

$j="^"; //разделитель 


 echo $currency_id.$j.$currency.$j.$option.$j.$email.$j.$garant.$j.$error;
 
 

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>