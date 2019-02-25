<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//////////////////////// Статус Резерв




if(CModule::IncludeModule("form")){ 
	$rsStatus = CFormStatus::GetByID($CURRENT_STATUS_ID);
			$arStatus = $rsStatus->Fetch();// данные по новому статусу
	$prStatus = CFormStatus::GetByID($PREV_STATUS_ID);
			$prStatus = $prStatus->Fetch();// данные по предыдущему статусу
			
		// получим данные по  вопросам
	$ar_Answer = CFormResult::GetDataByID(
		$RESULT_ID, 
		array('name','family','email','email_2','em_bd','money_2','currency','billingdate','history_status','oplata','lang_id','code_m'),  // массив символьных кодов необходимых вопросов
		$ar_Result, 
		$ar_Answer2);  

	CFormResult::SetField( $RESULT_ID, "history_status", array ($ar_Answer['history_status'][0]['ANSWER_ID'] => $ar_Answer['history_status'][0]['USER_TEXT']."\n".$prStatus["TITLE"].">".$arStatus["TITLE"]." - ".date("Y.m.d H:i:s")));// Записываем изменение статуса в историю
	if(!($ar_Answer['billingdate'][0]['USER_TEXT'])) {	                             // Если нет даты выставления счёта
	CFormResult::SetField( $RESULT_ID, "billingdate", array ($ar_Answer['billingdate'][0]['ANSWER_ID'] => date("d.m.Y"))); // Текущую дату вносим в результат, как дату выставления счёта
	} 
	

	//////////////////////// 
	 // отправка письма при реальной смене статуса
if($CURRENT_STATUS_ID <>$PREV_STATUS_ID) {

	CForm::GetDataByID($arStatus["FORM_ID"], $form, $questions, $answers, $dropdown,  $multiselect); // данные по форме
	
		$name = $ar_Answer['name'][0]['USER_TEXT'];          // Имя
		$family = $ar_Answer['family'][0]['USER_TEXT'];      // Фамилия
		$money_2 = $ar_Answer['money_2'][0]['USER_TEXT'];    // Стоимость в Вашей валюте
		$currency = $ar_Answer['currency'][0]['USER_TEXT'];  // Валюта заявки
		$oplata = $ar_Answer['oplata'][0]['ANSWER_TEXT'];    // Форма оплаты
		$code_m = $ar_Answer['code_m'][0]['USER_TEXT'];    // Код мероприятия
	
		// собираем все адреса в массив
		$ar_e_p[]=$ar_Answer['email'][0]['USER_TEXT'];
		$ar_e_p[]=$ar_Answer['email_2'][0]['USER_TEXT'];
		$ar_e_p[]=$ar_Answer['em_bd'][0]['USER_TEXT'];
		$ar_e_u=array_unique($ar_e_p); //убираем повторяющиеся адреса
		$e=implode(",", $ar_e_u); // строка адресов для отправки письма статуса
		
		if($ar_Answer['lang_id'][0]['USER_TEXT']) $lang_id=$ar_Answer['lang_id'][0]['USER_TEXT']; //язык регистрации
		else $lang_id="ru"; //язык регистрации
		
		$trans = array("#RESULT_ID#" => $RESULT_ID, "#NAME#" => $name, "#FAMILY#" => $family, "#MONEY_2#" => $money_2, "#CURRENCY#" => $currency, "#OPLATA#" => $oplata); // массив для замены в шаблоне
		
	@include $_SERVER["DOCUMENT_ROOT"]."/com/registration_event/".$code_m."/var_config.php";	// настройки		
	@include $_SERVER["DOCUMENT_ROOT"]."/com/registration_event/".$code_m."/mail_status/lang/".$lang_id."/status_rz.php"; //шаблон письма на языке регистрации заявки
	
	$title=strtr($title, $trans); // замена хештегов на значение в теме сообщения
	$text=strtr($text, $trans); // замена хештегов на значение в шаблоне сообщения
	
	// Массив данных для шаблона
		$arFields = array(
	"RS_RESULT_ID" => $RESULT_ID,                        // ID заявки
    "name" => $name,          // Имя
	"family" => $family,      // Фамилия
	"money_2" => $money_2,    // Стоимость в Вашей валюте
	"currency" => $currency,  // Валюта заявки
	"oplata" => $oplata,    // Форма оплаты
	//"occupy_text" => $occupy_text,                       // список забронированных мест
	
  	"email" => $e,                                       // email для отправки
	"title" =>$title,                            // заголовок сообщения
	"text" =>$text,                            // текст сообщения
    
    );
	
		if($o_mail) CEvent::Send($form["MAIL_EVENT_TYPE"], array("s1"), $arFields, "N", $t_mail); // в очередь на отправку сообщения

	}
}

 ?>
