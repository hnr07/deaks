<?php
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Данные из XML");
?>
<b>Массив данных получен из файла <u><a href="Response.xml">Response.xml</a></u></b>
<?
$m=10; //ID мероприятия
$v=840; //ID базовой валюты мероприятия
$date_endpay=2806; //ID поля ответа вопроса "Дата последнего платежа"
$t_money_2=2813; //ID поля ответа вопроса "Оплачено в Вашей валюте"
$t_money=2814; //ID поля ответа вопроса "Оплачено в базовой валюте"
$money_2=2802; //ID поля ответа вопроса "Стоимость в Вашей валюте"
$sum_debt=2805; //ID поля ответа вопроса "Сумма задолженности"
$key_edit=2831; //ID поля ответа вопроса "Ключ изменения"
$status_ok=133; //ID статуса "Подтверждена"
$status_opl=135; //ID статуса "Ожидает оплаты"

global $USER;
//$authorize=$USER->Authorize(20);
//include "../config/exchange.php";
$xml = simplexml_load_file("Response.xml");
$tew=count($xml->ArrayOfPayer->Payer);
$er=count($xml->ArrayOfRequestError->RequestError);

$headers= "MIME-Version: 1.0\r\n";
$headers.= "Content-type: text/plain; charset=UTF-8\r\n";

if($er){
$ter="";$ter_m="";
for($i=0;$i<$er;$i++){
$t_er=($xml->ArrayOfRequestError->RequestError[$i]['Description']);
	$t_id=($xml->ArrayOfRequestError->RequestError[$i]['Id']);
	$ter.="<br/><font color='red'>".$t_er." - ID=".$t_id."</font><br/>";
	$ter_m.=$t_er." - ID=".$t_id."\n";
	}
	//@mail("a.demidov@atreid.ru", "Ошибка обработки файла Response", $ter_m, $headers);
}
else {
//
$rsa = 0; 
//echo $tew."<br/><br/>";

	//if(CModule::IncludeModule("form")){
	
		for($i=0;$i<$tew;$i++){
		$PARS_RES["summitid"]=((string)$xml->ArrayOfPayer->Payer[$i]['SummitId']); // ID мероприятия
		$PARS_RES["claim"]=((string)$xml->ArrayOfPayer->Payer[$i]['ClaimId']);  // ID заявки
		$PARS_RES["paymentdate_0"]=((string)$xml->ArrayOfPayer->Payer[$i]['PaymentDate']);//Дата внесения последнего платежа
		$PARS_RES["currencynumericcode"]=trim(((string)$xml->ArrayOfPayer->Payer[$i]['CurrencyNumericCode'])); // Валюта заявки
		$PARS_RES["summitamount"]=((string)$xml->ArrayOfPayer->Payer[$i]['SummitAmount']); // Сумма заявки в базовой валюте
		$PARS_RES["summitpayment"]=((string)$xml->ArrayOfPayer->Payer[$i]['SummitPayment']); // Оплачено всего в базовой валюте
		$PARS_RES["amount"]=((string)$xml->ArrayOfPayer->Payer[$i]['Amount']); // Сумма заявки в нац.валюте валюте
		$PARS_RES["payment"]=((string)$xml->ArrayOfPayer->Payer[$i]['Payment']);// Оплачено всего в нац валюте
		$PARS_RES["liabilityamount"]=((string)$xml->ArrayOfPayer->Payer[$i]['LiabilityAmount']);//Сумма задолженности
		
		
		//Дата внесения последнего платежа в формате дд.мм.гггг //
		
		if($PARS_RES["paymentdate_0"]){
			$PARS_RES["ar_paymentdate"]=explode("-",$PARS_RES["paymentdate_0"]);
			$PARS_RES["paymentdate"]=$PARS_RES["ar_paymentdate"][2][0].$PARS_RES["ar_paymentdate"][2][1].".".$PARS_RES["ar_paymentdate"][1].".".$PARS_RES["ar_paymentdate"][0];
			}
			else $PARS_RES["paymentdate"]="";
			
		///////////////////////////////////////////
		
			//Приведение переменных в числовой вид //
				
				$PARS_RES["liabilityamount"]=floatval($PARS_RES["liabilityamount"]);
				$PARS_RES["summitamount"]=floatval($PARS_RES["summitamount"]);
				$PARS_RES["summitpayment"]=floatval($PARS_RES["summitpayment"]);
				$PARS_RES["amount"]=floatval($PARS_RES["amount"]);
				$PARS_RES["payment"]=floatval($PARS_RES["payment"]);
			
			//////////////////////////////////////////////
				
	   // $PARS_RES["mt0"]=mktime(0,0,0,4,1,2013); // метка времени для 01.04.2013 00:00
		/*	
			//// мероприятие 9 ЗДЗ 0415 //////////////
				if($PARS_RES["summitid"]==$m){
			if($PARS_RES["currencynumericcode"]==$v) { //Если валюта заявки базовая
					$PARS_RES["payment"]=$PARS_RES["summitpayment"];
					}
				$PARS_RES["fl"]=1;  // флаг обработки
				if($PARS_RES["fl"]) {	
				
				// ID статуса текущего элемента  //
				$PARS_RES["za"]="SELECT `STATUS_ID` FROM `b_form_result` WHERE `ID` =".$PARS_RES["claim"]." LIMIT 0 , 1";
				if($PARS_RES["z"]=@mysql_query($PARS_RES["za"])) {$PARS_RES["ts"]=@mysql_result($PARS_RES["z"],0,0);}
				/////////////////////////////////////
				
				// Изменение необходимых полей заявки  //
				
				// изменяем дату последнего платежа
				$PARS_RES["za"]="UPDATE `b_form_result_answer` SET `USER_TEXT` = '".$PARS_RES["paymentdate"]."', `USER_TEXT_SEARCH` = '".$PARS_RES["paymentdate"]."'  WHERE (`RESULT_ID` =".$PARS_RES["claim"]." AND `ANSWER_ID`='".$date_endpay."')";
				if(@mysql_query($PARS_RES["za"]));
				
				// изменяем Оплачено в Вашей валюте
				$PARS_RES["za"]="UPDATE `b_form_result_answer` SET `USER_TEXT` = '".$PARS_RES["payment"]."', `USER_TEXT_SEARCH` = '".$PARS_RES["payment"]."'  WHERE (`RESULT_ID` =".$PARS_RES["claim"]." AND `ANSWER_ID`='".$t_money_2."')";
				@mysql_query($PARS_RES["za"]);
				
				// изменяем Оплачено в базовой валюте
				$PARS_RES["za"]="UPDATE `b_form_result_answer` SET `USER_TEXT` = '".$PARS_RES["summitpayment"]."', `USER_TEXT_SEARCH` = '".$PARS_RES["summitpayment"]."'  WHERE (`RESULT_ID` =".$PARS_RES["claim"]." AND `ANSWER_ID`='".$t_money."')";
				@mysql_query($PARS_RES["za"]);
				
				// изменяем Стоимость в Вашей валюте
				$PARS_RES["za"]="UPDATE `b_form_result_answer` SET `USER_TEXT` = '".$PARS_RES["amount"]."', `USER_TEXT_SEARCH` = '".$PARS_RES["amount"]."'  WHERE (`RESULT_ID` =".$PARS_RES["claim"]." AND `ANSWER_ID`='".$money_2."')";
				@mysql_query($PARS_RES["za"]);
				
				// изменяем сумму задолженности
				$PARS_RES["za"]="UPDATE `b_form_result_answer` SET `USER_TEXT` = '".$PARS_RES["liabilityamount"]."', `USER_TEXT_SEARCH` = '".$PARS_RES["liabilityamount"]."'  WHERE (`RESULT_ID` =".$PARS_RES["claim"]." AND `ANSWER_ID`='".$sum_debt."')";
				@mysql_query($PARS_RES["za"]);
				
				// изменяем Ключ изменения
				//$PARS_RES["za"]="UPDATE `b_form_result_answer` SET `USER_TEXT` = '1', `USER_TEXT_SEARCH` = '1'  WHERE (`RESULT_ID` =".$PARS_RES["claim"]." AND `ANSWER_ID`='".$key_edit."')";
				//@mysql_query($PARS_RES["za"]);
				
				///////////////////////////////////////////////////////////
				
				// изменяем статус Ожидает оплаты на Подтверждена
					if($PARS_RES["ts"]==$status_opl && $PARS_RES["liabilityamount"]<=0 && $PARS_RES["summitamount"]>0 && $PARS_RES["amount"]>0 && $PARS_RES["summitamount"]<=$PARS_RES["summitpayment"]) {
					//$PARS_RES["za"]="UPDATE `b_form_result` SET `STATUS_ID` = '".$status_ok."'  WHERE (`ID` =".$PARS_RES["claim"].")";
					//@mysql_query($PARS_RES["za"]);
					CFormResult::SetStatus($PARS_RES["claim"], $status_ok,"N"); // изменяем статус Ожидает оплаты на Подтверждена
					} 
				}
			}
			
			*/
			echo "<pre>";print_r($PARS_RES);echo "</pre>";
		unset($PARS_RES);	
		}
		
		//@mail("a.elsiev@coral-club.com", "Обработка файла Response для мероприятия ".$m, "Файл Response принят форма ".$m."  обработана успешно",$headers);
		//@mail("rychagov.s@gmail.com", "TEST", $rsa_subj);

		//@mail("a.demidov@atreid.ru", "Обработка файла Response для формы ".$m, "Файл Response принят форма ".$m."  обработана успешно",$headers);
	//}
	
}
//@mail("rychagov.s@gmail.com", "TEST", "Был запущен респонс");
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>