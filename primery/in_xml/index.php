<?php 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if ($_POST["login"] == "test" and $_POST["pass"] == "test") {

?><?

ob_end_clean();


//$APPLICATION->SetTitle("Title");
header('Content-Type: text/xml; charset=utf-8');
?>
<? //include "../var_config_all.php"; ?>
<?// include "../config/exchange.php"; ?>
<?php
function par_dat($date) {
	$date=str_replace(",",".",trim($date));
	$date=str_replace("/",".",trim($date));
	$date=str_replace("-",".",trim($date));
	$ar_date=explode(".", $date);
	$p_date=$ar_date[2]."-".$ar_date[1]."-".$ar_date[0]."T00:00:00.000Z";
	return $p_date;
}
function dat_dat($date1, $date2) {
$ar_date1=explode(".", $date1);
$ar_date2=explode(".", $date2);
$p_date1=($ar_date1[2].$ar_date1[1].$ar_date1[0])*1;
$p_date2=($ar_date2[2].$ar_date2[1].$ar_date2[0])*1;
if($p_date1>$p_date2) return false;
else return true;
}
function par_tel($t) {
		$p_tel = str_replace("+","",$t); //// УБИРАЕМ +
		$p_tel = str_replace("-","",$t); //// УБИРАЕМ -
		$p_tel = str_replace(" ","",$t); //// УБИРАЕМ пробел
		$p_tel = str_replace("(","",$t); //// УБИРАЕМ (
		$p_tel = str_replace(")","",$t); //// УБИРАЕМ )
	return $p_tel;
}
function par_text($t) {
		
		$p_txt = str_replace("`","(апостроф)",$t); //// УБИРАЕМ `
		$p_txt = str_replace("'","(апостроф)",$t); //// УБИРАЕМ `
		$p_txt = str_replace("~","(тильда)",$t); //// УБИРАЕМ ~
	$p_txt=htmlspecialchars($p_txt);
	return $p_txt;
}

?>
<?php
global $USER;
//$authorize=$USER->Authorize(4);



$summit_id_0415="0414";
$title_0415="Золотые для золотых. Апрель 2014 г";
$token_0415="ЗДЗ_0414";
$form_m_0415=3;

$filersscenter="";
$filersscenter.="<?xml version=\"1.0\" encoding=\"UTF-16\"?>\n";
$filersscenter.="<Request xmlns=\"http://schemas.coral-club.com/conference\">\n";
 if(CModule::IncludeModule("form")){ 
		
$filersscenter.="<ArrayOfSummit>\n";

	

	/////////////////////////////////////////////////////zdz_0415
	
	$fr=@fopen("base_currency.txt","r");
		$str_base_curency=@fgets($fr,255);
		@fclose($fr);
	
	$ar_base_curency=explode("@",$str_base_curency);
	if(!$ar_base_curency[0]) $ar_global_errors[]= $code_0415.": Не могу найти валюту мероприятия(файл ".$code_0415."/manager_scripts/base_currency.txt)";
else $filersscenter.="<Summit Id=\"".$summit_id_0415."\" Title=\"".$title_0415."\" Token=\"".$token_0415."\" CurrencyNumericCode=\"".(trim($ar_base_curency[0]))."\" Comment=\"Комментарий\"/>\n"; // 9
	unset($str_base_curency,$ar_base_curency);
	
	/////////////////////////////////////////////////////

$filersscenter.="</ArrayOfSummit>\n";
$filersscenter.="<ArrayOfPaymentSummit>\n";

//$filersscenter.="<Summit Id=\"".$summit_id_0914."\" />\n"; // 8
$filersscenter.="<Summit Id=\"".$summit_id_0415."\" />\n"; // 9
$filersscenter.="</ArrayOfPaymentSummit>\n";
	
	$filersscenter.="<ArrayOfExchange>\n";


	// Курсы для мероприятия id=9 ЗДЗ 04.15
	
		///////////// массив наименований валют ////////////
		
$ar_namecur[840]=11;//"США";  // Для США Доллары 
$ar_namecur[792]=22;//"Турция";  // Для Турции  Лиры
$ar_namecur[978]=33;//"Еврозона";  // Для Еврозоны  Евро
$ar_namecur[398]=44;//"Казахстан";  // Для Казахстана  Тенге
$ar_namecur[985]=55;//"Польша";  // Для Польши  Злоты
$ar_namecur[642]=66;//"Румыния";  // Для Румынии  Леи
$ar_namecur[980]=77;//"Украина";  // Для Украины Гривны
$ar_namecur[203]=88;//"Чехия";  // Для Чехии  Кроны
$ar_namecur[974]=99;//"Белорусия";  // Для Белорусии  Беларусские рубли
$ar_namecur[498]=11;//"Молдавия";  // Для Молдавии  Молдавские леи
$ar_namecur[975]=22;//"Болгария";  // Для Болгарии  Лев
$ar_namecur[440]=33;//"Литва";  // Для Литвы  Литы
$ar_namecur[428]=44;//"Латвия(с 01.01.14 Еврозона)";  // Для Латвии  Латы
$ar_namecur[376]=55;//"Израиль";  // Для Израиля Шекели
$ar_namecur[810]=66;//"Россия";  // Для России	Рубли
$ar_namecur[31]=77;//"Айзербайджан";  // Для Айзербайджана  Манат
$ar_namecur[51]=88;//"Армения";  // Для Армении  Драм
$ar_namecur[990]=99;//"Приднестровье";  // Для Приднестровья  Приднестровские рубли
$ar_namecur[981]=11;//"Грузия";  // Для Грузии  Лари
$ar_namecur[496]=22;//"Монголия";  // Для Монголии  Тугрик


	foreach($ar_namecur as $k=>$v) 
	{
		
		
				$filersscenter.="<Exchange SummitId=\"".$summit_id_0415."\" OperatingDate=\"".par_dat("10.04.2014")."\" CurrencyNumericCode=\"".$k."\" Rate=\"".$v."\"/>\n";
				
		
	}
	
	
	$filersscenter.="</ArrayOfExchange>\n";
	
	
	// Карта переходов статусов для мероприятия id=9

$filersscenter.="<ClaimConditionDifinition SummitId=\"".$summit_id_0415."\">\n
<ArrayOfCondition>\n
<Condition Id=\"0\" BillRequired=\"false\" BillingDateUpdate=\"false\" />
<Condition Id=\"1\" BillRequired=\"false\" BillingDateUpdate=\"false\" />
<Condition Id=\"2\" BillRequired=\"true\" BillingDateUpdate=\"true\" />
<Condition Id=\"3\" BillRequired=\"true\" BillingDateUpdate=\"true\" />
<Condition Id=\"4\" BillRequired=\"false\" BillingDateUpdate=\"false\" />
<Condition Id=\"5\" BillRequired=\"true\" BillingDateUpdate=\"true\" />
<Condition Id=\"6\" BillRequired=\"true\" BillingDateUpdate=\"true\" />
<Condition Id=\"10\" BillRequired=\"false\" BillingDateUpdate=\"false\" />
</ArrayOfCondition>\n
<ArrayOfWorkflow>\n";
$filersscenter.="<Workflow ConditionId=\"0\" />\n";
$filersscenter.="<Workflow ConditionId=\"1\" />\n";
$filersscenter.="<Workflow ConditionId=\"2\">\n<Condition Id=\"4\" />\n<Condition Id=\"6\" />\n</Workflow>\n";
$filersscenter.="<Workflow ConditionId=\"3\">\n<Condition Id=\"2\" />\n<Condition Id=\"4\" />\n<Condition Id=\"5\" />\n<Condition Id=\"6\" />\n<Condition Id=\"10\" />\n</Workflow>";
$filersscenter.="<Workflow ConditionId=\"4\" />";
$filersscenter.="<Workflow ConditionId=\"5\">\n<Condition Id=\"2\" />\n<Condition Id=\"3\" />\n<Condition Id=\"4\" />\n<Condition Id=\"6\" />\n<Condition Id=\"10\" />\n</Workflow>";
$filersscenter.="<Workflow ConditionId=\"6\">\n<Condition Id=\"2\" />\n<Condition Id=\"3\" />\n<Condition Id=\"4\" />\n<Condition Id=\"10\" />\n</Workflow>";
$filersscenter.="<Workflow ConditionId=\"10\">\n<Condition Id=\"2\" />\n<Condition Id=\"3\" />\n<Condition Id=\"4\" />\n<Condition Id=\"5\" />\n<Condition Id=\"6\" />\n</Workflow>\n";
$filersscenter.="</ArrayOfWorkflow>\n
</ClaimConditionDifinition>";

//////////////////////////////////////////	
	


$filersscenter.="<ArrayOfClaim>\n";



	 if(!$ar_global_errors) { // Если нет глобальных ошибок


			
			 ////////////////// мероприятие id=9 ЗДЗ 04.15
			 
			  ///////////////////////////////

                $PARS_RES=array();  // массив текущих переменных
				
				$PARS_RES["code_m"]=$summit_id_0415;  //код мероприятия
				$PARS_RES["form_id"]=$form_m_0415;  //ID формы для мероприятия $PARS_RES["code_m"]
				$PARS_RES["str"]="";  // переменная для хранения формируемого текста 

				// Построение строки id статусов по их наименованию //
				$PARS_RES["ar_status"]=array("Подтверждена","Ожидает промоушен","Ожидает оплаты","Истёк срок оплаты","Резерв","Отменена","Не подтверждена"); // массив id статусов, участвующих в обработке
				$PARS_RES["str_status"] = "'".implode("','" , $PARS_RES["ar_status"])."'";
				
				$PARS_RES["za"]="SELECT `ID`,`TITLE` FROM `b_form_status` WHERE `FORM_ID`='".$PARS_RES["form_id"]."' AND `TITLE` IN (".$PARS_RES["str_status"].")";
				
				$PARS_RES["query"]= mysql_query($PARS_RES["za"]);
				$PARS_RES["rows"]=mysql_num_rows($PARS_RES["query"]);
				$PARS_RES["str_status_id"]=""; // строка id статусов для основного запроса
				
				if($PARS_RES["rows"]) {
				$PARS_RES["str_status_id"].="'";
					for($i=0;$i<$PARS_RES["rows"];$i++) {
					$PARS_RES["work"]=mysql_fetch_array($PARS_RES["query"]);
					$PARS_RES["ar_ststus_title"][$PARS_RES["work"]["ID"]]=$PARS_RES["work"]["TITLE"]; //массив наименований статусов с ключом ID
					if($i) $PARS_RES["str_status_id"].="', '".$PARS_RES["work"]["ID"];
					else $PARS_RES["str_status_id"].=$PARS_RES["work"]["ID"];
					}
				$PARS_RES["str_status_id"].="'";
				}
				//echo "<pre>"; print_r($PARS_RES["ar_ststus_title"]); echo "</pre>";
				/////////////////////////////////////////////////
				
				// Построение строки id вопросов по их символьному коду //
				$PARS_RES["ar_field"]=array('money','money_2','currency_id','oplata','time_money_chk','time_money_op','chk','family','name','middle_name','op_nof','pl_chk','pl_family','garant_chk','claimdate','billingdate','status','kem_priglashen_chk','comments','skype','tel','email','key_edit','age','nomer'); // массив символьных кодов полей вопросов, участвующих в обработке
				$PARS_RES["str_field"] = "'".implode("','" , $PARS_RES["ar_field"])."'";
				
				$PARS_RES["za"]="SELECT `ID`,`SID` FROM `b_form_field` WHERE `FORM_ID`='".$PARS_RES["form_id"]."' AND `SID` IN (".$PARS_RES["str_field"].")";
				
				$PARS_RES["query"]= mysql_query($PARS_RES["za"]);
				$PARS_RES["rows"]=mysql_num_rows($PARS_RES["query"]);
				
				$PARS_RES["str_field_id"]=""; // строка id вопросов для основного запроса
				if($PARS_RES["rows"]) {
				$PARS_RES["str_field_id"].="'";
					for($i=0;$i<$PARS_RES["rows"];$i++) {
					$PARS_RES["work"]=mysql_fetch_array($PARS_RES["query"]);
					$PARS_RES["ar_sid"][$PARS_RES["work"]["ID"]]=$PARS_RES["work"]["SID"]; //массив символьных кодов вопросов с ключом ID
					if($i) $PARS_RES["str_field_id"].="', '".$PARS_RES["work"]["ID"];
					else $PARS_RES["str_field_id"].=$PARS_RES["work"]["ID"];
					}
				$PARS_RES["str_field_id"].="'";
				}
				/////////////////////////////////////////////////
								
				//echo "<pre>"; print_r($PARS_RES["ar_sid"]); echo "</pre>";
				
				// Запрос к базе даных  ///////////////////////// 
				
				$PARS_RES["za"]="SELECT `RESULT_ID`,`ANSWER_ID`,`ANSWER_VALUE`,`USER_TEXT`,`STATUS_ID`,`FIELD_ID` FROM `b_form_result_answer` AS a LEFT JOIN `b_form_result` AS r ON a.`RESULT_ID` = r.`ID` WHERE a.`FORM_ID` ='".$PARS_RES["form_id"]."' AND r.`STATUS_ID` IN (".$PARS_RES["str_status_id"].") AND a.`FIELD_ID` IN (".$PARS_RES["str_field_id"].")";// AND (`FIELD_ID`='539' AND `USER_TEXT`='0')
				$PARS_RES["query"]= mysql_query($PARS_RES["za"]); 
				$PARS_RES["rows"]=mysql_num_rows($PARS_RES["query"]);
				
				for($i=0;$i<$PARS_RES["rows"];$i++) {
				$pa=mysql_fetch_array($PARS_RES["query"]);
								
				// Собираем данные по заявке в массив, ключ - id заявки
				
				//$PARS_RES["result"][$pa["RESULT_ID"]]["RESULT_ID"]=$pa["RESULT_ID"]; // номер заявки
				$PARS_RES["result"][$pa["RESULT_ID"]]["STATUS_ID"]=$pa["STATUS_ID"]; // статус заявки
				
				$PARS_RES["result"][$pa["RESULT_ID"]]["FIELD"][$PARS_RES["ar_sid"][$pa["FIELD_ID"]]]["FIELD_ID"]=$pa["FIELD_ID"];
				$PARS_RES["result"][$pa["RESULT_ID"]]["FIELD"][$PARS_RES["ar_sid"][$pa["FIELD_ID"]]]["ANSWER_ID"]=$pa["ANSWER_ID"];
				$PARS_RES["result"][$pa["RESULT_ID"]]["FIELD"][$PARS_RES["ar_sid"][$pa["FIELD_ID"]]]["ANSWER_VALUE"]=$pa["ANSWER_VALUE"];
				$PARS_RES["result"][$pa["RESULT_ID"]]["FIELD"][$PARS_RES["ar_sid"][$pa["FIELD_ID"]]]["USER_TEXT"]=$pa["USER_TEXT"];
				
				
				
				unset($pa);
				
				}
			
				/////////////////////////////////////////////////
				
				// Формирование текста ////////////////////////////
				
				if(count($PARS_RES["result"])) {
					foreach($PARS_RES["result"] as $key_r => $res) {

				//	if($res["FIELD"]["key_edit"]["USER_TEXT"]!="0") continue;//если установлен ключ редактирования переходим к обработке следующей заявки
					
						$ar_xml_var["Id"]="";  // ID заявки
						$ar_xml_var["SummitId"]=""; // код мероприятия 
						$ar_xml_var["ClaimDate"]=""; // Дата поступления заявки 
						$ar_xml_var["BillingDate"]=""; // Дата выставления счёта 
						$ar_xml_var["Amount"]=""; //  Стоимость в Вашей валюте
						$ar_xml_var["SummitAmount"]=""; //  Стоимость мероприятия в у. е.
						$ar_xml_var["CurrencyNumericCode"]=""; //  ID валюты заявки
						$ar_xml_var["Payment"]=""; //  Код формы оплаты 1- Нал в ОП, 2- ЧК №
						$ar_xml_var["InstallmentPlain"]=""; //  Рассрочка для чека или ОП
						$ar_xml_var["Condition"]=""; // Код статуса заявки
						$ar_xml_var["ParticipantId"]=""; //  № ЧК
						$ar_xml_var["ParticipantLastName"]=""; //  Фамилия
						$ar_xml_var["ParticipantFirstName"]=""; //  Имя
						$ar_xml_var["ParticipantMiddleName"]=""; //  Отчество
						$ar_xml_var["SkypeName"]=""; //  Скайп
						$ar_xml_var["TelephoneNumber"]=""; // Телефон
						$ar_xml_var["Email"]=""; // Электронная почта
						$ar_xml_var["PayerId"]=""; // № ЧК плательщика
						$ar_xml_var["WarrantorId"]=""; // № ЧК гаранта
						$ar_xml_var["BranchId"]=""; // № Офиса продаж	
						$ar_xml_var["Comment"]=""; // Комментарий
						
					
						foreach($res["FIELD"] as $key_v => $var) {
						$ar_var[$key_v]=$var;
						unset($var,$key_v);
						}
						//echo "<pre>"; print_r($ar_var); echo "</pre>";
						
					// присваиваем ID заявки
					$ar_xml_var["Id"]=$key_r; 
					
					// присваиваем код мероприятия
					$ar_xml_var["SummitId"]=$PARS_RES["code_m"]; 
					
					// присваиваем № ЧК
					$ar_xml_var["ParticipantId"]=trim($ar_var['chk']["USER_TEXT"]);
					
					// присваиваем Фамилия
					$ar_xml_var["ParticipantLastName"]=par_text(trim($ar_var['family']["USER_TEXT"]));
					
					// присваиваем Имя
					$ar_xml_var["ParticipantFirstName"]=par_text(trim($ar_var['name']["USER_TEXT"]));
					
					// присваиваем Отчество
					$ar_xml_var["ParticipantMiddleName"]=par_text(trim($ar_var['middle_name']["USER_TEXT"]));
					
					// присваиваем Скайп
					$ar_xml_var["SkypeName"]=par_text(trim($ar_var['skype']["USER_TEXT"]));
					
					// присваиваем Телефон
					$ar_xml_var["TelephoneNumber"]=par_tel(trim($ar_var['tel']["USER_TEXT"]));
					
					// присваиваем Электронная почта
					$ar_xml_var["Email"]=trim($ar_var['email']["USER_TEXT"]);
					
					// присваиваем № ЧК гаранта
					$ar_xml_var["WarrantorId"]=trim($ar_var['garant_chk']["USER_TEXT"]);
					
					// присваиваем Комментарий
					$ar_xml_var["Comment"]=par_text(trim($ar_var['comments']["USER_TEXT"]));
						
					//присваиваем код каждому статусу
					switch($PARS_RES["ar_ststus_title"][$res['STATUS_ID']]) {
					case "Не подтверждена":$ar_xml_var["Condition"]=1;break;   // Не подтверждена
					case "Подтверждена":$ar_xml_var["Condition"]=2;break;   //  Подтверждена
					case "Истёк срок оплаты":$ar_xml_var["Condition"]=3;break;   // Истек срок оплаты
					case "Отменена":$ar_xml_var["Condition"]=4;break;   // Отменена 
					case "Резерв":$ar_xml_var["Condition"]=10;break;   // Резерв
					case "Ожидает промоушен":$ar_xml_var["Condition"]=5;break;   // Ожидает промоушен
					case "Ожидает оплаты":$ar_xml_var["Condition"]=6;break;   // Ожидает оплаты
					default: $ar_xml_var["Condition"]=0;       //  Поступила
					}
					
					//присваиваем код формы оплаты
					switch($ar_var['oplata']['ANSWER_VALUE']){
					case "check": $ar_xml_var["Payment"]=2;break;  // ЧК №
					case "cash": $ar_xml_var["Payment"]=1;break;  // Нал в ОП
					default: $ar_xml_var["Payment"]=1;
					}
					
					if($ar_xml_var["Payment"]==1) { 
						
						// присваиваем № ЧК плательщика для формы оплаты Нал в ОП
						if($ar_var['status']['ANSWER_VALUE']=="member") $ar_xml_var["PayerId"]=trim($ar_var['chk']["USER_TEXT"]); //плательщик - № ЧК участника
						if($ar_var['status']['ANSWER_VALUE']=="guest_chk") $ar_xml_var["PayerId"]=trim($ar_var['chk']["USER_TEXT"]);    // плательщик - приглашенный № ЧК
						if($ar_var['status']['ANSWER_VALUE']=="guest") $ar_xml_var["PayerId"]=trim($ar_var['kem_priglashen_chk']["USER_TEXT"]); //  плательщик - приглашающий № ЧК
						
						//присваиваем № ОП
						if(trim($ar_var['op_nof']["USER_TEXT"])) $ar_xml_var["BranchId"]=trim($ar_var['op_nof']["USER_TEXT"]); //№ Офиса продаж
						//else $ar_xml_var["BranchId"]=100; // Если нет № Офиса продаж то применяем № 100 - центральный офис
						else $errors[]=$PARS_RES["code_m"].": заявка № ".$key_r." Ошибка: Нет № Офиса продаж(BranchId - op_nof)"; // если ОП не указан запишем ошибку в массив

						//присваиваем рассрочку для формы оплаты Нал в ОП
						if($ar_var['time_money_op']["ANSWER_VALUE"]) $ar_xml_var["InstallmentPlain"]=$ar_var['time_money_op']["ANSWER_VALUE"];
						else $ar_xml_var["InstallmentPlain"]=0;
					}
			
					if($ar_xml_var["Payment"]==2) {
						// присваиваем № ЧК плательщика для формы оплаты ЧК №
						$ar_xml_var["PayerId"]=trim($ar_var['pl_chk']["USER_TEXT"]);  // № ЧК плательщика

						//присваиваем рассрочку для формы оплаты ЧК №
						if($ar_var['time_money_chk']["ANSWER_VALUE"]) $ar_xml_var["InstallmentPlain"]=$ar_var['time_money_chk']["ANSWER_VALUE"];
						else $ar_xml_var["InstallmentPlain"]=0;
					}
					
					// если код статуса 0 запишем ошибку в массив
					if(!$ar_xml_var["Condition"]) $errors[]=$PARS_RES["code_m"].": заявка № ".$key_r." Ошибка: Код статуса 0";					
					
					// если плательщик не указан запишем ошибку в массив
					if(!$ar_xml_var["PayerId"]) $errors[]=$PARS_RES["code_m"].": заявка № ".$key_r." Ошибка: Нет № ЧК плательщика(PayerId - pl_chk)";
					
					//присваиваем Стоимость в Вашей валюте					
					if(trim($ar_var['money_2']["USER_TEXT"])=="") $ar_xml_var["Amount"]=0; // Если нет стоимости в Вашей валюте
					else $ar_xml_var["Amount"]=str_replace(",",".",trim($ar_var['money_2']["USER_TEXT"]));     // Стоимость в Вашей валюте

					//присваиваем Стоимость в базовой валюте	
					if(trim($ar_var['money']["USER_TEXT"])=="") $ar_xml_var["SummitAmount"]=0; // Если нет стоимости в базовой валюте
					else $ar_xml_var["SummitAmount"]=str_replace(",",".",trim($ar_var['money']["USER_TEXT"]));     // Стоимость в базовой валюте
					
					/////////////// Для мероприятия id=9 ЗДЗ 04.15 //////////////////////////////
					if(
						($ar_xml_var["Condition"]!=2 && $ar_xml_var["Amount"]<=0) || 
						($ar_xml_var["Condition"]==2 && $ar_var['nomer']["ANSWER_VALUE"]=="n_1" && $ar_var['age']["ANSWER_VALUE"]>7 && $ar_xml_var["Amount"]<=0) ||
						($ar_xml_var["Condition"]==2 && $ar_var['nomer']["ANSWER_VALUE"]=="n_2" && $ar_var['age']["ANSWER_VALUE"]>12 && $ar_xml_var["Amount"]<=0) ||
						($ar_xml_var["Condition"]==2 && $ar_var['nomer']["ANSWER_VALUE"]=="n_7" && $ar_var['age']["ANSWER_VALUE"]>7 && $ar_xml_var["Amount"]<=0) ||
						($ar_xml_var["Condition"]==2 && $ar_var['nomer']["ANSWER_VALUE"]=="n_8" && $ar_var['age']["ANSWER_VALUE"]>12 && $ar_xml_var["Amount"]<=0) ||
						($ar_xml_var["Condition"]==2 && $ar_var['nomer']["ANSWER_VALUE"]=="n_9" && $ar_var['age']["ANSWER_VALUE"]>12 && $ar_xml_var["Amount"]<=0)
					)
					{$errors[]=$PARS_RES["code_m"].": заявка № ".$key_r." Ошибка: Стоимость в Вашей валюте меньше или равна 0(Amount - 'money_2)";}
					
					if(
						($ar_xml_var["Condition"]!=2 && $ar_xml_var["SummitAmount"]<=0) || 
						($ar_xml_var["Condition"]==2  && $ar_var['nomer']["ANSWER_VALUE"]=="n_1" && $ar_var['age']["ANSWER_VALUE"]>7 && $ar_xml_var["SummitAmount"]<=0) ||
						($ar_xml_var["Condition"]==2  && $ar_var['nomer']["ANSWER_VALUE"]=="n_2" && $ar_var['age']["ANSWER_VALUE"]>12 && $ar_xml_var["SummitAmount"]<=0) ||
						($ar_xml_var["Condition"]==2  && $ar_var['nomer']["ANSWER_VALUE"]=="n_7" && $ar_var['age']["ANSWER_VALUE"]>7 && $ar_xml_var["SummitAmount"]<=0) ||
						($ar_xml_var["Condition"]==2  && $ar_var['nomer']["ANSWER_VALUE"]=="n_8" && $ar_var['age']["ANSWER_VALUE"]>12 && $ar_xml_var["SummitAmount"]<=0) ||
						($ar_xml_var["Condition"]==2  && $ar_var['nomer']["ANSWER_VALUE"]=="n_9" && $ar_var['age']["ANSWER_VALUE"]>12 && $ar_xml_var["SummitAmount"]<=0)
					) 
					{$errors[]=$PARS_RES["code_m"].": заявка № ".$key_r." Ошибка: Стоимость в базовой валюте меньше или равна 0(SummitAmount - 'money)";}
					/////////////////////////////////////////////////////////////////////////////
					
					//присваиваем код валюты
					if(trim($ar_var['currency_id']["USER_TEXT"])) $ar_xml_var["CurrencyNumericCode"]=trim($ar_var['currency_id']["USER_TEXT"]); // код вылюты
					else $errors[]=$PARS_RES["code_m"].": заявка № ".$key_r." Ошибка: Нет кода национальной валюты(CurrencyNumericCode - currency_id)";// если код вылюты не указан запишем ошибку в массив
					
					//присваиваем дату поступления заявки 
					if(ereg("([0-9]{2}).([0-9]{2}).([0-9]{4})",$ar_var['claimdate']["USER_TEXT"])) $ar_xml_var["ClaimDate"]=par_dat($ar_var['claimdate']["USER_TEXT"]);// Дата поступления заявки 
					else $errors[]=$PARS_RES["code_m"].": заявка № ".$key_r." Ошибка: Нет или ошибка формата даты поступления заявки(ClaimDate - claimdate)";// если дата поступления заявки не указана или неформат запишем ошибку в массив
					
					//присваиваем дату выставления счёта
					$ar_xml_var["BillingDate"]=par_dat($ar_var['billingdate'][USER_TEXT]);
					
					// Проверка даты выставления счёта для некоторых кодов статусов заявки
					if($ar_xml_var["Condition"]==2 || $ar_xml_var["Condition"]==6 || $ar_xml_var["Condition"]==3 || $ar_xml_var["Condition"]==5) {
						if(!ereg("([0-9]{2}).([0-9]{2}).([0-9]{4})",$ar_var['billingdate'][USER_TEXT]))  $errors[]=$PARS_RES["code_m"].": заявка № ".$key_r." Ошибка: Нет или ошибка формата даты выставления счёта(BillingDate - billingdate)";
						
						if(!dat_dat($ar_var['claimdate']["USER_TEXT"],$ar_var['billingdate'][USER_TEXT])) $errors[]=$PARS_RES["code_m"].": заявка № ".$key_r." Ошибка: Дата выставления счёта(BillingDate - billingdate) меньше даты поступления заявки(ClaimDate - claimdate)";
					}
						
					//echo "<pre>"; print_r($res); echo "</pre>";
					
					if(!count($errors)) {
					$PARS_RES["str"].= "<Claim ";
					
					$PARS_RES["str"].= "Id=\"".$ar_xml_var["Id"]."\" SummitId=\"".$ar_xml_var["SummitId"]."\" ClaimDate=\"".$ar_xml_var["ClaimDate"]."\" ";
					if($ar_var['billingdate'][USER_TEXT]) $PARS_RES["str"].="BillingDate=\"".$ar_xml_var["BillingDate"]."\" ";
					$PARS_RES["str"].="Amount=\"".$ar_xml_var["Amount"]."\" SummitAmount=\"".$ar_xml_var["SummitAmount"]."\" CurrencyNumericCode=\"".$ar_xml_var["CurrencyNumericCode"]."\" Payment=\"".$ar_xml_var["Payment"]."\" InstallmentPlain=\"".$ar_xml_var["InstallmentPlain"]."\"  Condition=\"".$ar_xml_var["Condition"]."\" ";
					if($ar_xml_var["ParticipantId"] && ($ar_var['status']['ANSWER_VALUE']=="member" || $ar_var['status']['ANSWER_VALUE']=="guest_chk")) $PARS_RES["str"].="ParticipantId=\"".$ar_xml_var["ParticipantId"]."\" ";
					$PARS_RES["str"].="ParticipantLastName=\"".$ar_xml_var["ParticipantLastName"]."\" ParticipantFirstName=\"".$ar_xml_var["ParticipantFirstName"]."\"  ParticipantMiddleName=\"".$ar_xml_var["ParticipantMiddleName"]."\"  SkypeName=\"".$ar_xml_var["SkypeName"]."\" TelephoneNumber=\"".$ar_xml_var["TelephoneNumber"]."\" Email=\"".$ar_xml_var["Email"]."\"   ";
					if($ar_xml_var["PayerId"]) $PARS_RES["str"].="PayerId=\"".$ar_xml_var["PayerId"]."\" ";
					if($ar_xml_var["WarrantorId"]) $PARS_RES["str"].="WarrantorId=\"".$ar_xml_var["WarrantorId"]."\" ";
					if($ar_xml_var["Payment"]==1 && $ar_xml_var["BranchId"]) $PARS_RES["str"].="BranchId=\"".$ar_xml_var["BranchId"]."\"  ";
					if($ar_xml_var["Comment"]) $PARS_RES["str"].="Comment=\"".$ar_xml_var["Comment"]."\"  ";  
					
					$PARS_RES["str"].="/>\n";
					}
					else {
						for($j=0;$j<count($errors);$j++) {
						$ar_errors[]=$errors[$j];
						}
					}
					
					unset($res,$key_r,$ar_xml_var,$errors);
					}
				}
				
			////////////////////////////////////////////////
$filersscenter.= $PARS_RES["str"];
			 
	unset($PARS_RES);
///////////////////////////////////////////////////////////

		}
	else {
		foreach($ar_global_errors as $k => $er) {
			$filersscenter.="<error> ".$ar_global_errors[$k]."</error>\n";
		}
		
	$message='';
	$ptr=count($ar_global_errors);
		if($ptr){
		for($i=0;$i<$ptr;$i++){$message.=$ar_global_errors[$i]."\r\n";}
		$headers= "MIME-Version: 1.0\r\n";
		$headers.= "Content-type: text/plain; charset=UTF-8\r\n";
		//@mail("a.elsiev@coral-club.com", "Ошибки файла Request",  $message, $headers);
		//@mail("a.demidov@atreid.ru", "Ошибки файла Request",  $message, $headers);
		}
	//echo "<pre>"; print_r($ar_global_errors); echo "</pre>";
	}

////////////////////////////////

	
	
$filersscenter.="</ArrayOfClaim>\n";
$filersscenter.="</Request>\n";

echo $filersscenter;

//$fp = @fopen("request_".(date("Y-m-d-H-i-s")).".xml", "w"); // Открываем файл в режиме записи
//@fwrite($fp, $filersscenter); // Запись в файл
//@fclose($fp); //Закрытие файла	
}

$rwq=count($ar_errors);
	if($rwq){
	$message='';
	for($i=0;$i<$rwq;$i++){$message.=$ar_errors[$i]."\r\n";}
	$headers= "MIME-Version: 1.0\r\n";
    $headers.= "Content-type: text/plain; charset=UTF-8\r\n";
	//@mail("", "Ошибки файла Request",  $message, $headers);
  //  @mail("a.demidov@atreid.ru", "Ошибки файла Request",  $message, $headers);
	}
?>




<?
} else { 
?>
Не пройдена проверка логин/пароль/IP
<form action="" method="post">
test<input name="login" value="test" type="text" /> 
test<input name="pass" value="test" type="text" />
<input name="" type="submit" />
</form>
<? } ?>
 <? // require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
