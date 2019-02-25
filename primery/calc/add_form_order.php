<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
IncludePublicLangFile(__FILE__);
$ar_calc=(array)json_decode($_POST["calc_par"]);
$ar_date=(array)json_decode($_POST["data_par"]);

//echo "<pre>";print_r($ar_calc);"</pre>";
//echo "<pre>";print_r($ar_date);"</pre>";
//echo "<pre>";print_r($_POST);"</pre>";

if(CModule::IncludeModule("form")){
	$df_calc="";
	$s2=0;
	if(count($ar_calc["row"])>0) {
		foreach($ar_calc["row"] as $k => $val) {
			$s2+=$val->S;
			$df_calc.=($k+1).") ".($val->type).": ".(($val->A)*100)." x ".(($val->B)*100)." = ".($val->S)." --> ".($val->itg)."\n";
		}
		$df_calc.="Общ. пл.: ".$s2." Общ. кол-во: ".$ar_calc["sno"]; 
	}
	$df_date="";
	$tm_date='<table border="1" cellpadding="5" cellspacing="0"  style="border-collapse:collapse; border:#cc 1px solid;"><tr><td></td><th>'.GetMessage("element_dls").'</th><th>'.GetMessage("upakovka").'</th><th>'.GetMessage("cena").'('.$ar_date["code_currency"].')</th><th>'.GetMessage("kolvo").'</th><th>'.GetMessage("summa").'('.$ar_date["code_currency"].')</th></tr>';
	foreach($ar_date["order_list"] as $k => $val) {
		$ar_nu=explode(" ", $val->upak);
		$df_date.=($k+1).") ".($val->code)."(".($ar_nu[0]).")[".($val->artn)."] - ".($val->price)." x ".($val->show)." = ".($val->sum)."\n";
		$tm_date.='<tr><td>'.($k+1).'</td><td>'.($val->name).'</td><td>'.($val->upak).'</td><td>'.(number_format($val->price, 2, '.', ' ')).'</td><td>'.($val->show).'</td><td>'.(number_format($val->sum, 2, '.', ' ')).'</td></tr>';
	}
	$df_date.="-------------------\n".$ar_date["itogo"]." ".$ar_date["code_currency"];
	$tm_date.='<tr><th colspan="5" style="text-align:right;border:0;">'.GetMessage("itogo").':</th><td><b>'.(number_format($ar_date["itogo"], 2, '.', ' ')).'</b></td></tr></table>';
	

			
		
	
	$df_geo="";
	foreach($_SESSION['ar_geoip'] as $k => $val) {
		$df_geo.=$k." - ".$val."\n";
	}
	
	$FORM_ID = 3; // ID веб-формы
			// массив значений ответов
			$arValues_3 = array (
				"form_text_15"                 => $_POST["user_name"],       // "Имя"
				"form_text_16"                 => $_POST["code_tel"],        // "Код страны(тел.)"
				"form_text_17"                 => $_POST["tel"],             // "Телефон"
				"form_text_18"                 => $_POST["email"],           // "E-mail"
				"form_textarea_19"             => $_POST["comment"],         // "Комментарий"
				"form_textarea_20"             => $df_date,                  // "Заказ"
				"form_text_21"                 => $ar_date["code_currency"], // "Валюта заказа"
				"form_textarea_22"             => $df_calc,                  // "Калькулятор"
				"form_text_23"                 => $_POST["sid_c"],           // "Страна"
				"form_textarea_24"             => $df_geo,                   // "GEO"
				"form_text_25"                 => $_POST["email_curator"]    // "E-mail куратора"
			);
			$RESULT_ID=CFormResult::Add($FORM_ID, $arValues_3);
			
			$str1=GetMessage("privet").", ".$_POST["user_name"]." <br /><br />".GetMessage("oformlen_zakaz")." # ".$RESULT_ID." ".GetMessage("na_sayte")." https://4dls.pro <br /><br />";
			$str2="<br /><br />".GetMessage("note_1")."<br /><br />".GetMessage("note_2");
			
			// Массив данных для шаблона
		$arFields_user = array(
			"RS_RESULT_ID" => $RESULT_ID,            // ID заявки
			"user_name" => $_POST["user_name"],                         // Имя
			"email_curator" => $_POST["email_curator"],                    // email куратора
			"email" => $_POST["email"],             		      	// email для отправки
			"title" =>GetMessage("oformlen_zakaz"),                   // заголовок сообщения
			"text_1" =>$str1,                     // текст сообщения
			"text_2" =>$str2,                     // текст сообщения
			"text_date" =>$tm_date,                     // текст сообщения
		);
		$arFields_curator = array(
			"RS_RESULT_ID" => $RESULT_ID,            // ID заявки
			"user_name" => $_POST["user_name"],                         // Имя
			"email_curator" => $_POST["email_curator"],                    // email куратора
			"email" => $_POST["email"],             		      	// email для отправки
			"title" =>GetMessage("oformlen_zakaz"),                   // заголовок сообщения
			"code_tel" => $_POST["code_tel"],                       // Код страны(тел.)
			
			"tel" =>  $_POST["tel"],             // Телефон
			"sid_c" =>  $_POST["sid_c"],           // Страна
			"code_currency" =>  $ar_date["code_currency"],             // Валюта заказа
			"text_date" =>$df_date,                     // текст сообщения
			"comment" =>$_POST["comment"],                     // Комментарий
		);
			
			//mail($_POST["email"], GetMessage("oformlen_zakaz"), $str1.$df_date.$str2);
			if($_POST["email_curator"]) {
				if($_POST["email"]) {CEvent::Send("FORM_FILLING_order_not_ru", array("s1"), $arFields_user, "N", 80);} // в очередь на отправку сообщения для пользователя
				CEvent::Send("FORM_FILLING_order_not_ru", array("s1"), $arFields_curator, "N", 81); // в очередь на отправку сообщения для куратора
			}
}
if($RESULT_ID) {?>
	<div class="note_add_order" style="">
		<?=GetMessage("oformlen_zakaz")." # ".$RESULT_ID."<br /><br />".GetMessage("note_1")."<br /><br />".GetMessage("note_2")?>
	</div>
<?}
else {?>
	<div class="note_add_order" style="text-align:center;">
		<?=GetMessage("error_or1")?>
	</div>
<?}
?>