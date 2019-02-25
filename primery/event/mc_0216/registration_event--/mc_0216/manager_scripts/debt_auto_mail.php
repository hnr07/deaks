<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
include "../var_config.php";


global $USER;

$APPLICATION->SetTitle($title_m);
?> 
<?if(!isset($_GET['proso'])) {?>
 
<?
$ar_dgr=array(1,7); //массив групп для которых доступна страница
// получим массив групп текущего пользователя
$arGroups = $USER->GetUserGroupArray();
if(!array_intersect($arGroups, $ar_dgr)) header('Location: /');

?>			

<link rel="stylesheet" type="text/css" href="/css/manager_scripts.css" />
<script type="text/javascript" src="/js/manager_scripts/manager_scripts.js"></script>
<br/>
<div class="manager_scripts">
<div class="a_vozo"><a href="./">Все служебные обработчики</a><div id="sz"><div><img src="/images/registration_event/d.gif"></div></div></div>
<h2><?$APPLICATION->ShowTitle();?></h2>
<br/>
<div class="chte"><b>Страница проверки задолженности по оплате и отправке оповещений.</b> <span onclick="f_ps('txt2')"><u>Что это? >>></u></span><div id="txt2" class="txt" onclick="f_us('txt2')">
Данная страница использует для обработки результаты формы заявок на мероприятие "<?$APPLICATION->ShowTitle();?>".<br/>
 
 Страница проверяет заявки со статусом "Ожидает оплаты", "Ожидает промоушен" и "Истёк срок оплаты" с оплатой "Нал. в ОП" мероприятия "<?$APPLICATION->ShowTitle();?>". При неполной оплате заявки список выводится в таблицу. Кнопка "Отправить письмо" проверяет задолженность и отправляет письмо. При отправке действует фильтр "Исключить из обработки". 
 <br/><br/><u>закрыть</u></div></div>

  <form method="POST">
 <div class="chte"><input type="text" name="isk" value="<?=$_POST['isk']?>" class="input_text">  Исключить из обработки <span onclick="f_ps('txt3')"><u>Что это? >>></u></span><div id="txt3" class="txt" onclick="f_us('txt3')">
Заявки, номера которых внесены в поле "Исключить из обработки" не будут учавствовать в проверке на задолженность. Номера должны быть внесены через запятую. Пример: 11111,22222,54321,12345
 <br/><br/><u>закрыть</u></div></div>


 <div class="chte"><input class="buts" type="submit" name="prp" value="Предварительный просмотр" onclick="f_sz()"> <span onclick="f_ps('txt4')"><u>Что это? >>></u></span><div id="txt4" class="txt" onclick="f_us('txt4')">
 Кнопка "Предварительный просмотр" проверяет заявки со статусом "Ожидает оплаты", "Ожидает промоушен" и "Истёк срок оплаты". В таблице выводятся результаты кандидатов на отправку оповещения. Отправка писем при этом не происходит.
 <br/><br/><u>закрыть</u></div></div>

 <input class="buts" type="submit" name="proso" value="Отправить письмо" onclick="f_sz()">
 </form>
 <?} else $authorize=$USER->Authorize(20);?>
 
<?php


if(isset($_POST['proso']) || isset($_POST['prp']) || isset($_GET['proso'])) {

if(CModule::IncludeModule("form")){ 

$FORM_ID = $form_m;
$f_status=$status_nepr." | ".$status_opl." | ".$status_nopl;

// фильтр по полям результата
	$arFilter = array(
	  //  "ID"                   => "44218|44217	",              // ID результата
	  //  "ID_EXACT_MATCH"       => "N",               // вхождение
		"STATUS_ID"            => $f_status,          // статус Ожидает оплаты
	   // "TIMESTAMP_1"          => "10.10.2003",      // изменен "с"
	   // "TIMESTAMP_2"          => "15.10.2003",      // изменен "до"
	  //  "DATE_CREATE_1"        => "10.10.2003",      // создан "с"
	  //  "DATE_CREATE_2"        => "12.10.2003",      // создан "до"
	  //  "REGISTERED"           => "Y",               // был зарегистрирован
	  //  "USER_AUTH"            => "N",               // не был авторизован
	  //  "USER_ID"              => "45 | 35",         // пользователь-автор
	  //  "USER_ID_EXACT_MATCH"  => "Y",               // точное совпадение
	  //  "GUEST_ID"             => "4456 | 7768",     // посетитель-автор
	 //   "SESSION_ID"           => "456456 | 778768", // сессия
		);
		
		// фильтр по вопросам
		
$arFields = array();
/*
$arFields[] = array(
    "CODE"              => "billingdate",     // код поля по которому фильтруем
    "FILTER_TYPE"       => "text",          // фильтруем по текстовому полю
    "PARAMETER_NAME"    => "USER",          // фильтруем по введенному значению
    "VALUE"             => "15.03.2013",        // значение по которому фильтруем
    "EXACT_MATCH"       => "N"              // ищем вхождение, ищем точное совпадение-"Y"
    );
	*/
$arFields[] = array(
    "CODE"              => "oplata",     // код поля по которому фильтруем
    "FILTER_TYPE"       => "text",          // фильтруем по текстовому полю
    "PARAMETER_NAME"    => "ANSWER_TEXT",          // фильтруем по полю ANSWER_TEXT
    "VALUE"             => "Нал в ОП",        // значение по которому фильтруем
    "EXACT_MATCH"       => "N"              // ищем вхождение, ищем точное совпадение-"Y"
    );


	
	
	$arFilter["FIELDS"] = $arFields;
	
			// выберем (первые) все результатов
	$rsResults = CFormResult::GETList($FORM_ID, 
		($by="s_timestamp"), 
		($order="desc"), 
		$arFilter, 
		$is_filtered, 
		"Y",
		false);

?>
<?
$ar_lang_dir=scandir("../mail_status/lang/"); // массив используемых языков
	$key=array_search(".", $ar_lang_dir);
	if (false !== $key) unset($ar_lang_dir[ $key ]); // удаляем папку "."
	$key=array_search("..", $ar_lang_dir);
	if (false !== $key) unset($ar_lang_dir[ $key ]); // удаляем папку ".."
foreach($ar_lang_dir as $d) {
		include_once "../mail_status/lang/".$d."/dolg.php";
		$ar_text_dolg[$d]["title"]=$title;
		$ar_text_dolg[$d]["text"]=$text;
				unset($title,$text);
}
echo "<pre>";print_r($ar_text_dolg);echo "</pre>";

		$trans = array("#RESULT_ID#" => $RESULT_ID, "#NAME#" => $name, "#FAMILY#" => $family, "#MONEY_2#" => $money_2, "#CURRENCY#" => $currency, "#OPLATA#" => $oplata); // массив для замены в шаблоне
?>

<?
$co_ti='';$i=0;
	while ($arResult = $rsResults->Fetch()) {
			$RESULT_ID=$arResult['ID'];
		$pos = stripos($_POST['isk'], $RESULT_ID);

		 if ($pos === false) $fisk=1;
		 else $fisk=0;	
		if($fisk){
		$arAnswer = CFormResult::GETDataByID(
			$RESULT_ID, 
			array('money','money_2','t_money','t_money_2','email','em_bd','oplata','time_money_op','name','family','currency','proverka','lang_id'),  // массив символьных кодов необходимых вопросов
			$ar_Res, 
			$ar_Answer2); 
			
			if($ar_Answer['lang_id'][0]['USER_TEXT']) $lang_id=$ar_Answer['lang_id'][0]['USER_TEXT']; //язык регистрации
			else $lang_id="ru"; //язык регистрации
		
			if(!$arAnswer['time_money_op'][0]['ANSWER_VALUE']){    //обработка только заявок без рассрочки
			
	
				$money=floatval($arAnswer['money'][0]['USER_TEXT']);
				$t_money=floatval($arAnswer['t_money'][0]['USER_TEXT']);
				$money_2=floatval($arAnswer['money_2'][0]['USER_TEXT']);
				$t_money_2=floatval($arAnswer['t_money_2'][0]['USER_TEXT']);
				if(!$t_money) $t_money=0;
				if(!$t_money_2) $t_money_2=0;
					if($t_money<$money){  // Обработка только заявок с неоплатой
								CForm::GetDataByID($FORM_ID, $form, $questions, $answers, $dropdown,  $multiselect); // данные по форме
							
								// Проверяем адреса в БД и форме на идентичность
								if($ar_Answer['email'][0]['USER_TEXT']==$ar_Answer['em_bd'][0]['USER_TEXT']) $e=$ar_Answer['email'][0]['USER_TEXT']; // письмо на один адрес
								else $e=$ar_Answer['email'][0]['USER_TEXT'].", ".$ar_Answer['em_bd'][0]['USER_TEXT']; // письмо на оба адреса
				
					// Массив данных для шаблона
					
					$title=strtr($ar_text_dolg[$lang_id]["title"], $trans); // замена хештегов на значение в теме сообщения
					$text=strtr($ar_text_dolg[$lang_id]["text"], $trans); // замена хештегов на значение в шаблоне сообщения
							
						$arFields = array(
					"RS_RESULT_ID" => $RESULT_ID,
					"name" => $arAnswer['name'][0]['USER_TEXT'],
					"family" => $arAnswer['family'][0]['USER_TEXT'],
					"money_2" => $arAnswer['money_2'][0]['USER_TEXT'],
					"t_money_2" => $arAnswer['t_money_2'][0]['USER_TEXT'],
					"currency" => $arAnswer['currency'][0]['USER_TEXT'],
					"oplata" => $arAnswer['oplata'][0]['ANSWER_TEXT'],
					"email" => $e,
					"title" =>$title,                            // заголовок сообщения
					"text" =>$text,                            // текст сообщения
				   
					);
						if(isset($_POST['proso'])|| isset($_GET['proso'])){
							
						
						
						CEvent::Send($form["MAIL_EVENT_TYPE"], array("ru"), $arFields, "N", $t_mail);
						
						$resi="<span style='color:green;'>Письмо отправлено.</span>";
						}
						else $resi="<span style='color:red;'>Письмо не отправлено.</span>";
						$i++;
						$co_ti.="<tr><td>".$i."</td><td>".$RESULT_ID."</td><td>".$money."</td><td>".$t_money."</td><td>".$money_2."</td><td>".$t_money_2."</td><td>".$arAnswer['currency'][0]['USER_TEXT']."</td><td>".$resi."</td></tr>";
					
				}

			}
		}
	}

		if(!isset($_GET['proso'])) {
			if($co_ti) {
			?>
			<table class="tmbl">
				 <tr><th>№ п/п</th><th>№ заявки</th><th>Счёт(у.е.)</th><th>Оплачено(у.е.)</th><th>Счёт(нац.)</th><th>Оплачено(нац.)</th><th>Валюта</th><th>Результат</th></tr>
				<?=$co_ti?> 
				 </table>
			<?
			}
			else echo "Нет заявок для обработки.";

		}
	}

}
//echo "<pre>";print_r($arFields);echo "</pre>";
?>

</div>

	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>