<?php
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
//
echo "123";
function Request($ar_Ans,$ar_Result,$ar_Ans2) 
{
require($_SERVER["DOCUMENT_ROOT"]."../var_config.php");

global $ccws;
//global $href;
//global $_GET['RESULT_ID'];

/*function par_dat($date) {
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
*/
echo "123";

//echo $ar_Result["STATUS_ID"];
if (!is_array($ar_Ans)) {
	// получим данные по всем вопросам
if (!$_GET['RESULT_ID']) $result_id=$ar_Ans; else $result_id=$_GET['RESULT_ID'];
$ar_Ans = CFormResult::GetDataByID(
	$result_id, 
	array('status','chk','family','name','sum_debt','key_edit','middle_name','skype','tel','email','garant_chk','comments','oplata','kem_priglashen_chk','time_money_op','time_money_chk','pl_chk','money_2','money','currency_id','claimdate','billingdate','op_nof'),
//array('chk','family','name','kem_priglashen_chk','kem_priglashen_family','kem_priglashen_name','sum_debt','money_2_calc','currency','promotion_1','fly_1','fly_2','hotel','nomer','p_hotel','d_leader_ship','s_leader_ship','hotel_ls','nomer_ls','status','comments_admin','mesto','claimdate'), 	
	$ar_Result, 
	$ar_Ans2);
}
	//echo"<pre>";print_r($ar_Ans[oplata]);echo"</pre>";
//echo"<pre>";print_r($ar_Result["STATUS_ID"]);echo"</pre>";			 
					
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
						
						
					// присваиваем ID заявки
					if (!$_GET['RESULT_ID']) $ar_xml_var["Id"]=$ar_Result['ID']; else $ar_xml_var["Id"]=$_GET['RESULT_ID']; 
					
					// присваиваем код мероприятия
					$ar_xml_var["SummitId"]=$summit_id; 
					
					// присваиваем № ЧК
					$ar_xml_var["ParticipantId"]=trim($ar_Ans['chk'][0]["USER_TEXT"]);
					
					// присваиваем Фамилия
					$ar_xml_var["ParticipantLastName"]=(trim($ar_Ans['family'][0]["USER_TEXT"]));
					
					// присваиваем Имя
					$ar_xml_var["ParticipantFirstName"]=(trim($ar_Ans['name'][0]["USER_TEXT"]));
					
					// присваиваем Отчество
					$ar_xml_var["ParticipantMiddleName"]=(trim($ar_Ans['middle_name'][0]["USER_TEXT"]));
					
					// присваиваем Скайп
					$ar_xml_var["SkypeName"]=(trim($ar_Ans['skype'][0]["USER_TEXT"]));
					
					// присваиваем Телефон
					$ar_xml_var["TelephoneNumber"]=(trim($ar_Ans['tel'][0]["USER_TEXT"]));
					
					// присваиваем Электронная почта
					$ar_xml_var["Email"]=trim($ar_Ans['email'][0]["USER_TEXT"]);
					
					// присваиваем № ЧК гаранта
					$ar_xml_var["WarrantorId"]=trim($ar_Ans['garant_chk'][0]["USER_TEXT"]);
					
					// присваиваем Комментарий
					$ar_xml_var["Comment"]=(trim($ar_Ans['comments'][0]["USER_TEXT"]));
						
					//присваиваем код каждому статусу
					switch($ar_Result["STATUS_ID"]) {
					case $status_no:$ar_xml_var["Condition"]=1;break;   // Не подтверждена
					case $status_ok:$ar_xml_var["Condition"]=2;break;   //  Подтверждена
					case $status_nopl:$ar_xml_var["Condition"]=3;break;   // Истек срок оплаты
					case $status_del:$ar_xml_var["Condition"]=4;break;   // Отменена 
					case $status_rz:$ar_xml_var["Condition"]=10;break;   // Резерв
					case $status_nepr:$ar_xml_var["Condition"]=5;break;   // Ожидает промоушен
					case $status_opl:$ar_xml_var["Condition"]=6;break;   // Ожидает оплаты
					default: $ar_xml_var["Condition"]=0;       //  Поступила
					}
					
					//присваиваем код формы оплаты
					switch($ar_Ans['oplata'][0]['ANSWER_VALUE']){
					case "check": $ar_xml_var["Payment"]=2;break;  // ЧК №
					case "cash": $ar_xml_var["Payment"]=1;break;  // Нал в ОП
					default: $ar_xml_var["Payment"]=1;
					}
					
					if($ar_xml_var["Payment"]==1) { 
						
						// присваиваем № ЧК плательщика для формы оплаты Нал в ОП
						if($ar_Ans['status'][0]['ANSWER_VALUE']=="member") $ar_xml_var["PayerId"]=trim($ar_Ans['chk'][0]["USER_TEXT"]); //плательщик - № ЧК участника
						if($ar_Ans['status'][0]['ANSWER_VALUE']=="guest_chk") $ar_xml_var["PayerId"]=trim($ar_Ans['chk'][0]["USER_TEXT"]);    // плательщик - приглашенный № ЧК
						if($ar_Ans['status'][0]['ANSWER_VALUE']=="guest") $ar_xml_var["PayerId"]=trim($ar_Ans['kem_priglashen_chk'][0]["USER_TEXT"]); //  плательщик - приглашающий № ЧК
						
						//присваиваем № ОП
						if(trim($ar_Ans['op_nof'][0]["USER_TEXT"])) $ar_xml_var["BranchId"]=trim($ar_Ans['op_nof'][0]["USER_TEXT"]); //№ Офиса продаж
						//else $ar_xml_var["BranchId"]=100; // Если нет № Офиса продаж то применяем № 100 - центральный офис
						else $errors_request[]=$code_m.": заявка № ".$_GET['RESULT_ID']." Ошибка: Нет № Офиса продаж(BranchId - op_nof)"; // если ОП не указан запишем ошибку в массив

						//присваиваем рассрочку для формы оплаты Нал в ОП
						if($ar_Ans['time_money_op'][0]["ANSWER_VALUE"]) $ar_xml_var["InstallmentPlain"]=$ar_Ans['time_money_op'][0]["ANSWER_VALUE"];
						else $ar_xml_var["InstallmentPlain"]=0;
					}
			
					if($ar_xml_var["Payment"]==2) {
						// присваиваем № ЧК плательщика для формы оплаты ЧК №
						$ar_xml_var["PayerId"]=trim($ar_Ans['pl_chk'][0]["USER_TEXT"]);  // № ЧК плательщика

						//присваиваем рассрочку для формы оплаты ЧК №
						if($ar_Ans['time_money_chk']["ANSWER_VALUE"]) $ar_xml_var["InstallmentPlain"]=$ar_Ans['time_money_chk'][0]["ANSWER_VALUE"];
						else $ar_xml_var["InstallmentPlain"]=0;
					}
					
					// если код статуса 0 запишем ошибку в массив
					if(!$ar_xml_var["Condition"]) $errors_request[]=$code_m.": заявка № ".$_GET['RESULT_ID']." Ошибка: Код статуса 0";					
					
					// если плательщик не указан запишем ошибку в массив
					if(!$ar_xml_var["PayerId"]) $errors_request[]=$code_m.": заявка № ".$_GET['RESULT_ID']." Ошибка: Нет № ЧК плательщика(PayerId - pl_chk)";
					
					//присваиваем Стоимость в Вашей валюте					
					if(trim($ar_Ans['money_2'][0]["USER_TEXT"])=="") $ar_xml_var["Amount"]=0; // Если нет стоимости в Вашей валюте
					else $ar_xml_var["Amount"]=str_replace(",",".",trim($ar_Ans['money_2'][0]["USER_TEXT"]));     // Стоимость в Вашей валюте

					//присваиваем Стоимость в базовой валюте	
					if(trim($ar_Ans['money'][0]["USER_TEXT"])=="") $ar_xml_var["SummitAmount"]=0; // Если нет стоимости в базовой валюте
					else $ar_xml_var["SummitAmount"]=str_replace(",",".",trim($ar_Ans['money'][0]["USER_TEXT"]));     // Стоимость в базовой валюте

					//присваиваем код валюты
					if(trim($ar_Ans['currency_id'][0]["USER_TEXT"])) $ar_xml_var["CurrencyNumericCode"]=trim($ar_Ans['currency_id'][0]["USER_TEXT"]); // код вылюты
					else $errors_request[]=$code_m.": заявка № ".$_GET['RESULT_ID']." Ошибка: Нет кода национальной валюты(CurrencyNumericCode - currency_id)";// если код вылюты не указан запишем ошибку в массив
					
					//присваиваем дату поступления заявки 
					if(ereg("([0-9]{2}).([0-9]{2}).([0-9]{4})",$ar_Ans['claimdate'][0]["USER_TEXT"])) $ar_xml_var["ClaimDate"]=$ar_Ans['claimdate'][0]["USER_TEXT"];// Дата поступления заявки 
					else $errors_request[]=$code_m.": заявка № ".$ar_xml_var["Id"]." Ошибка: Нет или ошибка формата даты поступления заявки(ClaimDate - claimdate)";// если дата поступления заявки не указана или неформат запишем ошибку в массив
					//$ar_xml_var["ClaimDate"]=
					//присваиваем дату выставления счёта
					$ar_xml_var["BillingDate"]=$ar_Ans['billingdate'][0]["USER_TEXT"];
					
					// Проверка даты выставления счёта для некоторых кодов статусов заявки
					if($ar_xml_var["Condition"]==2 || $ar_xml_var["Condition"]==6 || $ar_xml_var["Condition"]==3 || $ar_xml_var["Condition"]==5) {
						if(!ereg("([0-9]{2}).([0-9]{2}).([0-9]{4})",$ar_Ans['billingdate'][0]["USER_TEXT"]))  $errors_request[]=$code_m.": заявка № ".$_GET['RESULT_ID']." Ошибка: Нет или ошибка формата даты выставления счёта(BillingDate - billingdate)";
						
						//if(!dat_dat($ar_Ans['claimdate'][0]["USER_TEXT"],$ar_Ans['billingdate'][0]["USER_TEXT"])) $errors_request[]=$code_m.": заявка № ".$_GET['RESULT_ID']." Ошибка: Дата выставления счёта(BillingDate - billingdate) меньше даты поступления заявки(ClaimDate - claimdate)";
					}
					$ar_xml_var["CurrencyNumericCode"]=preg_replace("/[^0-9]/", '', $ar_xml_var["CurrencyNumericCode"]);					
					//echo "Данные для передачи >>><br><pre>"; print_r($ar_xml_var); echo "</pre><br>";
					//echo "Ошибки >>><br><pre>"; print_r($errors_request); echo "</pre><br>";
					$rwq=count($errors_request);
					//echo "<br>".$rwq."<br>";
					if($rwq){  // Сообщение при ошибке передаваемых данных
						$message='';
						foreach($errors_request as $val){$message.=$val."\r\n";}
						$headers= "MIME-Version: 1.0\r\n";
						$headers.= "Content-type: text/plain; charset=UTF-8\r\n";
						//@mail("a.elsiev@coral-club.com", "Ошибки файла Request",  $message, $headers);
					//	@mail("a.demidov@atreid.ru", "Ошибки файла Request",  $message, $headers);
						@mail("koisha2006@narod.ru", $code_m.": заявка № ".$_GET['RESULT_ID']." Ошибка файла Request",  $message, $headers);	

					}
					else { 
					echo "<pre>";
					print_r($ar_xml_var);
					echo "</pre>";
						/*$result=$ccws->Claim_Processing(
							array( //Основной метод отправляющий заявку на сервис
								'Id' => $ar_xml_var["SummitId"],//Номер мероприятия в базе mssql, тестовый номер 303
								'Workflow'  => array(
									array(
										"Id"=>$ar_xml_var["Id"], //Номер заявки = bitrix result id
										"SummitId"=>$ar_xml_var["SummitId"], //Номер мероприятия в базе mssql тестовый номер 303
										"ClaimDate"=>$ccws->Atom_date($ar_xml_var["ClaimDate"]), //ИЗМЕНЕНИЮ НЕ ПОДЛЕЖИТ! Дата подачи заявки, Atom_date переводит в нужный формат
										"BillingDate"=>$ccws->Atom_date($ar_xml_var["BillingDate"]), //ИЗМЕНЕНИЮ НЕ ПОДЛЕЖИТ! Дата выставления счета, Atom_date переводит в нужный формат
										"Amount"=>$ar_xml_var["Amount"], //Цена в валюте ЧК
										"SummitAmount"=>$ar_xml_var["SummitAmount"], //Цена в валюте мероприятия 
										"CurrencyNumericCode"=>$ar_xml_var["CurrencyNumericCode"], //3 значный код валюты
										"Payment"=>$ar_xml_var["Payment"],// Способ оплаты 1/2 - Чек/Либо в Офисе
										"InstallmentPlain"=>$ar_xml_var["InstallmentPlain"], //Рассрочка
										"Condition"=>$ar_xml_var["Condition"], //Состояние, новая заявка должна передаваться Валере 6 кондишене
										"ParticipantId"=>$ar_xml_var["ParticipantId"], //Номер ЧК
										"ParticipantLastName"=>$ar_xml_var["ParticipantLastName"], //Фамилия
										"ParticipantFirstName"=>$ar_xml_var["ParticipantFirstName"], //Имя 
										"ParticipantMiddleName"=>$ar_xml_var["ParticipantMiddleName"],//Отчество
										"TelephoneNumber"=>$ar_xml_var["TelephoneNumber"], // Телефон
										"Email"=>$ar_xml_var["Email"], // E-mail
										"PayerId"=>$ar_xml_var["PayerId"], //плательщик
										"BranchId" =>$ar_xml_var["BranchId"], //Номер бранча
										"Comment" =>$ar_xml_var["Comment"] // Комментарий
									)
								)
							)
						); */
//						echo "<pre>";
//print_r($ar_Ans);
//echo "<br/>".$ar_Ans['key_edit']['0']['ANSWER_ID'];
						//echo "Возвращённые данные >>><br><pre>";print_r($result);echo "</pre><br>";
						
						if($result['ErrorCode']) { // Сообщение при ошибке записи данных
							$headers= "MIME-Version: 1.0\r\n";
							$headers.= "Content-type: text/plain; charset=UTF-8\r\n";
							//@mail("a.elsiev@coral-club.com", "Ошибки файла Request",  $message, $headers);
					//		@mail("a.demidov@atreid.ru", $code_m.": заявка № ".$_GET['RESULT_ID']." Ошибка файла Request",  $result['ErrorText'], $headers);	
							@mail("koisha2006@narod.ru", $code_m.": заявка № ".$ar_xml_var["Id"]." Ошибка файла Request",  $result['ErrorText'], $headers);	
//echo "Заявка № ".$_GET['RESULT_ID']." Ошибка".$result['ErrorText'];

						}
						else {
						CFormResult::SetField($ar_xml_var["Id"], "key_edit", array ($ar_Ans['key_edit']['0']['ANSWER_ID']=>"3")); //Изменение курса
//if (GetUserText($ar_Ans,"sum_debt")!=$value['LiabilityAmount']) 
//CFormResult::SetField($ar_Result['ID'], "sum_debt", array (GetID($ar_Ans2,"sum_debt") =>$result['Result']['LiabilityAmount'])); //Случай когда оплата
//if (GetUserText($ar_Ans,"money_2")!=$value['SummitAmountInNationalCurrency']) 
//CFormResult::SetField($ar_Result['ID'], "money_2", array (GetID($ar_Ans2,"money_2") =>$result['Result']['SummitAmountInNationalCurrency'])); //Изменение курса

						//header("Refresh: 10; url=".$href);
							}
					}
					
					unset($ar_xml_var,$errors_request);
}



?>


