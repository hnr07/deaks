<?php
global $APPLICATION;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule("form");
include_once '../var_config.php';

//require($_SERVER["DOCUMENT_ROOT"]."/ccws/sum_models/class_event.php");
global $USER;
global $ccws;
//Для теста
if (!$ccws) {
require_once($_SERVER["DOCUMENT_ROOT"]."/ru/registration_event/forum_0615/functions.php");
$ccws= new ccws_event(); 
}
//global $ccws;
global $dir_event;
global $exception;



function par_text($t) {

		$p_txt = str_replace("`","(апостроф)",$t); //// УБИРАЕМ `
		$p_txt = str_replace("'","(апостроф)",$t); //// УБИРАЕМ `
		$p_txt = str_replace("~","(тильда)",$t); //// УБИРАЕМ ~
	$p_txt=htmlspecialchars($p_txt);
	return $p_txt;
}

?>
<?
//Массив значений передаваемых параметров, аналогичен $_POST


	// получим данные по ответам для RESULT_ID

	

	if (!$arrVALUES) $arrVALUES=$_POST;
	/*
	echo "<pre>Значения";
print_r($arrVALUES);
echo "значения</pre>"; 
	*/
//print_r($arrVALUES);
	
$ar_Ans = CFormResult::GetDataByID(
	$_GET['RESULT_ID'], 
	array('status','chk','sum_debt','key_edit','family','name','middle_name','skype','tel','email','garant_chk','comments','oplata','kem_priglashen_chk','time_money_op','time_money_chk','pl_chk','money_2','money','currency_id','claimdate','billingdate','op_nof'),
	$ar_Result, 
	$ar_Ans2);
//echo substr_count($_SERVER['PHP_SELF'], "result_edit_1.php");
//echo $_SERVER['PHP_SELF'];
//break;
	//substr_count()
echo"<pre>";
print_r($_POST);
echo "</pre>";
	
					// присваиваем ID заявки
					$ar_xml_var["Id"]=$_GET['RESULT_ID']; 
					//Валюта
					$ar_xml_var["Currency"]=$arrVALUES['form_'.$ar_Ans['currency_id']['0']['TITLE_TYPE']."_".$ar_Ans['currency_id']['0']['ANSWER_ID']];
					echo "this-->".$arrVALUES['form_'.$ar_Ans['currency_id']['0']['TITLE_TYPE']."_".$ar_Ans['currency_id']['0']['ANSWER_ID']];
					// присваиваем код мероприятия
					$ar_xml_var["SummitId"]=$summit_id; 
					// Стоимость мероприятия в валюте мероприятия
					$ar_xml_var["SummitAmount"]=trim($arrVALUES['form_'.$ar_Ans['money']['0']['TITLE_TYPE']."_".$ar_Ans['money']['0']['ANSWER_ID']]); 
				    // номер ЧК
                    $ar_xml_var["ParticipantId"]=trim($arrVALUES['form_'.$ar_Ans['chk']['0']['FIELD_TYPE']."_".$ar_Ans['chk']['0']['ANSWER_ID']]);
                    // Фамилия 
					$ar_xml_var["ParticipantLastName"]=par_text(trim($arrVALUES['form_'.$ar_Ans['family']['0']['FIELD_TYPE']."_".$ar_Ans['family']['0']['ANSWER_ID']]));
                    // Имя
					$ar_xml_var["ParticipantFirstName"]=par_text(trim($arrVALUES['form_'.$ar_Ans['name']['0']['FIELD_TYPE']."_".$ar_Ans['name']['0']['ANSWER_ID']]));
                    // Отчество
					$ar_xml_var["ParticipantMiddleName"]=par_text(trim($arrVALUES['form_'.$ar_Ans['middle_name']['0']['FIELD_TYPE']."_".$ar_Ans['middle_name']['0']['ANSWER_ID']]));
                    // Телефон
					$ar_xml_var["TelephoneNumber"]=trim($arrVALUES['form_'.$ar_Ans['tel']['0']['FIELD_TYPE']."_".$ar_Ans['tel']['0']['ANSWER_ID']]);
                    // Электронная почта
					$ar_xml_var["Email"]=trim($arrVALUES['form_'.$ar_Ans['email']['0']['FIELD_TYPE'].'_'.$ar_Ans['email']['0']['ANSWER_ID']]);
                    // ID плательщика
					//$ar_xml_var["PayerId"]=trim($arrVALUES['form_'.$ar_Ans['pl_chk']['0']['FIELD_TYPE']."_".$ar_Ans['pl_chk']['0']['ANSWER_ID']]);

					//if (!$ar_xml_var["PayerId"]) Error("25");
                    // Номер ОП
					$ar_xml_var["BranchId"]=trim($arrVALUES['form_'.$ar_Ans['op_nof']['0']['FIELD_TYPE']."_".$ar_Ans['op_nof']['0']['ANSWER_ID']]);
                    // Комментарий
					$ar_xml_var["Comment"]=trim($arrVALUES['form_'.$ar_Ans['comments']['0']['FIELD_TYPE']."_".$ar_Ans['comments']['0']['ANSWER_ID']]);

				


					//ПРОВЕРКА СТАТУСОВ	
					//присваиваем код старому статусу в виде цифрового значения
					switch($ar_Result["STATUS_ID"]) {
					case $status_no:$Old_Condition=1;break;   // Не подтверждена
					case $status_ok:$Old_Condition=2;break;   //  Подтверждена
					case $status_nopl:$Old_Condition=3;break;   // Истек срок оплаты
					case $status_del:$Old_Condition=4;break;   // Отменена 
					case $status_rz:$Old_Condition=10;break;   // Резерв
					case $status_nepr:$Old_Condition=5;break;   // Ожидает промоушен
					case $status_opl:$Old_Condition=6;break;   // Ожидает оплаты
					default: $Old_Condition=0;       //  Поступила
					}
					//echo $Old_Condition; 
					//echo $arrVALUES["status_".$code_m];
                    if (($arrVALUES["status_".$code_m]=='NOT_REF') || !$arrVALUES["status_".$code_m]) $ar_xml_var["Condition"]=$Old_Condition; else 
					switch($arrVALUES["status_".$code_m]) {
					case $status_no:$ar_xml_var["Condition"]=1;break;   // Не подтверждена
					case $status_ok:$ar_xml_var["Condition"]=2;break;   //  Подтверждена
					case $status_nopl:$ar_xml_var["Condition"]=3;break;   // Истек срок оплаты
					case $status_del:$ar_xml_var["Condition"]=4;break;   // Отменена 
					case $status_rz:$ar_xml_var["Condition"]=10;break;   // Резерв
					case $status_nepr:$ar_xml_var["Condition"]=5;break;   // Ожидает промоушен
					case $status_opl:$ar_xml_var["Condition"]=6;break;   // Ожидает оплаты
					default: $ar_xml_var["Condition"]=0;       //  Поступила
					}
					//echo $ar_xml_var["Condition"];
	//print_r($Old_Condition); break;
	                if (($Old_Condition!=$status_no && $Old_Condition!=0) && (!substr_count($_SERVER['PHP_SELF'], "result_edit_1.php"))) {

/*					echo "<pre>";
print_r($ar_Ans);
echo "</pre>";
*/
//print_r( $ar_xml_var["Condition"]);
					//break;
				//	 echo $ar_xml_var["Condition"];
					 
					 //Проверка статусов согласно карте переходов состояний. Временно закоментирована так как проверка проходит на стороне веб-сервиса
					/*if (($ar_xml_var["Condition"]!=$Old_Condition))
					{

					switch($Old_Condition) {
					case 0: // Не подтверждена и Поступила
					case 1: 
					if (($ar_xml_var["Condition"]==0) || ($ar_xml_var["Condition"]==1) || ($ar_xml_var["Condition"]==2)) 
					Error("1"); //Ошибка перевода статуса
					break;   
					case 2: // Подтверждена
					if (($ar_xml_var["Condition"]!=4) && ($ar_xml_var["Condition"]!=6)) 
					Error("2"); //Ошибка перевода статуса
					break;   
					case 3: // Истек срок оплаты
					if (($ar_xml_var["Condition"]==0) || ($ar_xml_var["Condition"]==1))
					Error("3"); //Ошибка перевода статуса
					break;   					
					case 4:   // Отменена 
					Error("4"); //Ошибка перевода статуса
					break;   
					case 10: // Резерв
					if (($ar_xml_var["Condition"]==0) || ($ar_xml_var["Condition"]==1))
					Error("10"); //Ошибка перевода статуса
					break;   
					case 5: // Ожидает промоушен
					if (($ar_xml_var["Condition"]==0) || ($ar_xml_var["Condition"]==1))
					Error("5"); //Ошибка перевода статуса
					break;   
					case 6: // Ожидает оплаты
					if (($ar_xml_var["Condition"]==0) || ($ar_xml_var["Condition"]==1) || ($ar_xml_var["Condition"]==5))
					Error("6"); //Ошибка перевода статуса
					break;   

					}
					}*/
			       
				
					
// проверка изменения статусов
/*
echo "Из ответов->".trim($ar_Ans['oplata'][0]['ANSWER_ID'])."<br/>";
echo "Кнопка радио->".trim($arrVALUES['form_radio_oplata'])."<br/>";
echo "Значение ответа->".trim($ar_Ans['oplata'][0]['ANSWER_VALUE']);*/

//присваиваем код формы оплаты


if (trim($ar_Ans['oplata'][0]['ANSWER_ID'])== trim($arrVALUES['form_radio_oplata']))
if (trim($ar_Ans['oplata'][0]['ANSWER_VALUE'])=="cash") $ar_xml_var["Payment"]=1; else $ar_xml_var["Payment"]=2;
else if (trim($ar_Ans['oplata'][0]['ANSWER_VALUE']="cash")) $ar_xml_var["Payment"]=2;  else $ar_xml_var["Payment"]=1;
if (!$arrVALUES['form_'.$ar_Ans['pl_chk']['0']['FIELD_TYPE']."_".$ar_Ans['pl_chk']['0']['ANSWER_ID']]) {
if($ar_xml_var["Payment"]==1) {  
						if($ar_Ans['status'][0]['ANSWER_VALUE']=="member") $ar_xml_var["PayerId"]=trim($ar_Ans['chk'][0]["USER_TEXT"]); //плательщик - № ЧК участника
						if($ar_Ans['status'][0]['ANSWER_VALUE']=="guest_chk") $ar_xml_var["PayerId"]=trim($ar_Ans['chk'][0]["USER_TEXT"]);    // плательщик - приглашенный № ЧК
						if($ar_Ans['status'][0]['ANSWER_VALUE']=="guest") $ar_xml_var["PayerId"]=trim($ar_Ans['kem_priglashen_chk'][0]["USER_TEXT"]); //  плательщик - приглашающий № ЧК
                        if (!$ar_xml_var["PayerId"]) $ar_xml_var["PayerId"]="0000000";
						}
else {
					$ar_xml_var["PayerId"]=trim($arrVALUES['form_'.$ar_Ans['pl_chk']['0']['FIELD_TYPE']."_".$ar_Ans['pl_chk']['0']['ANSWER_ID']]);
					
				


}
}
else $ar_xml_var["PayerId"]=trim($arrVALUES['form_'.$ar_Ans['pl_chk']['0']['FIELD_TYPE']."_".$ar_Ans['pl_chk']['0']['ANSWER_ID']]);
echo "-->".$ar_xml_var["PayerId"];
	if (!$ar_xml_var["PayerId"]) Error("25");
					//Рассрочка
if ($ar_xml_var["Payment"]==1) $rsAnswer = CFormAnswer::GetByID($arrVALUES['form_radio_time_money_op']);
else  $rsAnswer = CFormAnswer::GetByID($arrVALUES['form_radio_time_money_chk']);
$arAnswer = $rsAnswer->Fetch();
$ar_xml_var["InstallmentPlain"]= $arAnswer['VALUE']; 					
					
					
					
					
					
					
					
					if(($ar_xml_var["Payment"]==1) && ($ar_xml_var["BranchId"]=="" || !$ar_xml_var["BranchId"])) { Error("22"); } //Если выбран способ оплаты Нал в ОП но не указан ОП возвращаем ошибку
				


			
				
					//присваиваем Стоимость в Вашей валюте
					$ar_xml_var["Amount"]=$arrVALUES['form_'.$ar_Ans['money_2']['0']['TITLE_TYPE']."_".$ar_Ans['money_2']['0']['ANSWER_ID']];
					//$ar_xml_var["Amount"]=str_replace(",",".",trim($ar_Ans['money_2'][0]["USER_TEXT"]));     //Стоимость в валюте ЧК
                    if (!$ar_xml_var["Amount"]) {
					$ar_xml_var["Amount"]=str_replace(",",".",trim($ar_Ans['money_2'][0]["USER_TEXT"]));     //Стоимость в валюте ЧК
					if (!$ar_xml_var["Amount"]) { $ar_xml_var["Amount"]="1";  $arrVALUES['form_'.$ar_Ans['money_2']['0']['TITLE_TYPE']."_".$ar_Ans['money_2']['0']['ANSWER_ID']]="1"; }
					}                   

			
					//if ($arrVALUES['form_'.$ar_Ans['money_2']['0']['TITLE_TYPE']."_".$ar_Ans['money_2']['0']['ANSWER_ID']]!=$ar_xml_var["Amount"] )  Error("21"); //Попытка стоимости заявки в валюте ЧК;
					

					
					
					$ar_xml_var["ClaimDate"]=$arrVALUES['form_'.$ar_Ans['claimdate']['0']['TITLE_TYPE']."_".$ar_Ans['claimdate']['0']['ANSWER_ID']];// Дата поступления заявки 
				   // if ($arrVALUES['form_'.$ar_Ans['claimdate']['0']['TITLE_TYPE']."_".$ar_Ans['claimdate']['0']['ANSWER_ID']]!=$ar_xml_var["ClaimDate"]) Error("24"); //Попытка изменит дату подачи заявки;
					
					
					$ar_xml_var["BillingDate"]=$arrVALUES['form_'.$ar_Ans['billingdate']['0']['TITLE_TYPE']."_".$ar_Ans['billingdate']['0']['ANSWER_ID']]; //  Дата выставления счета


/*echo "<pre>";
print_r($ar_xml_var);
print_r($ar_Ans);
echo "</pre>";
break;*/
if (!$APPLICATION->GetException()) 
						$result=$ccws->Claim_Processing( 
							array( //Основной метод отправляющий заявку на сервис
								'Id' => $ar_xml_var["SummitId"],//Номер мероприятия в базе mssql, тестовый номер 303
								'Workflow'  => array(
									array(
										"Id"=>$ar_xml_var["Id"], 
										"SummitId"=>$ar_xml_var["SummitId"], //Номер мероприятия в базе mssql тестовый номер 303
										"ClaimDate"=>$ccws->Atom_date($ar_xml_var["ClaimDate"]), //ИЗМЕНЕНИЮ НЕ ПОДЛЕЖИТ! Дата подачи заявки, Atom_date переводит в нужный формат
										"BillingDate"=>$ccws->Atom_date($ar_xml_var["BillingDate"]), //ИЗМЕНЕНИЮ НЕ ПОДЛЕЖИТ! Дата выставления счета, Atom_date переводит в нужный формат
										"Amount"=>$ar_xml_var["Amount"], //Цена в валюте ЧК
										"SummitAmount"=>$ar_xml_var["SummitAmount"], //Цена в валюте мероприятия 
										"CurrencyNumericCode"=>$ar_xml_var["Currency"], //3 значный код валюты
										"Payment"=>$ar_xml_var["Payment"],// Способ оплаты 2 - Чек, 1 - в Офисе
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
							), $USER->GetID()."/".$USER->GetLogin()
						);
	//	echo "<pre>"; print_r($ar_Ans); 
	//	print_r($arrVALUES);
	//	echo "</pre>";
//break;
			
// echo 'form_'.$ar_Ans['sum_debt']['0']['TITLE_TYPE']."_".$ar_Ans['sum_debt']['0']['ANSWER_ID'];
// echo " ".$result['Result']['LiabilityAmount'];

				
				
if($result['ErrorCode']) Error('23',$result['ErrorCode'],$result['ErrorText']);	
 //CFormResult::SetField($ar_xml_var["Id"], "key_edit", array ($ar_Ans['key_edit']['0']['ANSWER_ID']=>"1")); //Изменение курса}					

$arrVALUES['form_'.$ar_Ans['key_edit']['0']['TITLE_TYPE']."_".$ar_Ans['key_edit']['0']['ANSWER_ID']]="2";
$arrVALUES['form_'.$ar_Ans['money_2']['0']['TITLE_TYPE']."_".$ar_Ans['money_2']['0']['ANSWER_ID']]=$result['Result']['Amount'];
$arrVALUES['form_'.$ar_Ans['sum_debt']['0']['TITLE_TYPE']."_".$ar_Ans['sum_debt']['0']['ANSWER_ID']]=$result['Result']['LiabilityAmount'];






}
















function Error($code,$ErrorCode=false,$ErrorText=false) {
global $APPLICATION;
global $code_m;

switch ($code) {
case '1':
$APPLICATION->ThrowException("Не верный перевод статуса в заявке №".$_GET['RESULT_ID']." из  Поступила или Не подтверждена, обратитесь в web отдел.");
break;
case '2':
$APPLICATION->ThrowException("Не верный перевод статуса в заявке №".$_GET['RESULT_ID']." из  Подтверждена, обратитесь в web отдел.");
break;
case '3':
$APPLICATION->ThrowException("Не верный перевод статуса в заявке №".$_GET['RESULT_ID']." из  Истек Срок оплаты, обратитесь в web отдел.");
break;
case '4':
$APPLICATION->ThrowException("Не верный перевод статуса в заявке №".$_GET['RESULT_ID']." из  Отменена, обратитесь в web отдел.");
break;
case '5':
$APPLICATION->ThrowException("Не верный перевод статуса в заявке №".$_GET['RESULT_ID']." из  Ожидает Выполнения промоушена, обратитесь в web отдел.");
break;
case '6':
$APPLICATION->ThrowException("Не верный перевод статуса в заявке №".$_GET['RESULT_ID']." из  Ожидает оплаты, обратитесь в web отдел.");
break;
case '10':
$APPLICATION->ThrowException("Не верный перевод статуса в заявке №".$_GET['RESULT_ID']." из  Резерв, обратитесь в web отдел.");
break;
case '21':
$APPLICATION->ThrowException("Изменение Стоимости Заявки №".$_GET['RESULT_ID']." в Валюте ЧК не возможна для изменения стоимости заявки необходимо менять общую стоимость заявки с помощью скидок.");
break;
case '22':
$APPLICATION->ThrowException("В заявке №".$_GET['RESULT_ID']." при способе оплаты в Офисе Продаж не указан номер офиса продаж.");
break;
case '23':
$APPLICATION->ThrowException("Отправка заявки №".$_GET['RESULT_ID']." вызвала ошибку веб-сервиса, Код ошибки: ".$ErrorCode." Текст ошибки: ".$ErrorText);
break;
case '24':
$APPLICATION->ThrowException("Нельзя изменять Дату поступления заявк.");
break;
case '25':
$APPLICATION->ThrowException("НЧК плательщика на может быть пустым в заявке №".$_GET['RESULT_ID']." так как тип оплаты- ЧЕК.");
break;
default:
$APPLICATION->ThrowException("Произошла неизвестная ошибка!");
break;
}

if ($ErrorCode) {
$headers= "MIME-Version: 1.0\r\n";
$headers.= "Content-type: text/plain; charset=UTF-8\r\n";
@mail("koisha2006@narod.ru", $code_m.": заявка № ".$_GET['RESULT_ID']." Ошибка при редактировании заявки","Код ошибки:".$ErrorCode." Текст ошибки:".$ErrorText, $headers);	


}
			
}






?>


