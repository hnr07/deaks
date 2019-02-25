<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
global $USER;
if(!$USER->IsAuthorized()) {$authorize=$USER->Authorize(4);header("Location: ".$_SERVER["REQUEST_URI"]);}
$title_m="Конструктор сообщений";
$form_m=1;
$APPLICATION->SetTitle($title_m);

?> 

<link rel="stylesheet" type="text/css" href="/css/manager_scripts.css" />
<script type="text/javascript" src="/js/manager_scripts/manager_scripts.js"></script>
<br/>
<div class="manager_scripts">

<!--<h2><?$APPLICATION->ShowTitle();?></h2>-->
<br/>
<div class="chte"><b>Конструктор сообщений.</b> <span onclick="f_ps('txt2')"><u>Что это? >>></u></span><div id="txt2" class="txt" onclick="f_us('txt2')">
Данная страница позволяет отправить сообщения участникам мероприятия из таблицы веб-формы.<br/>
 Выбрать адресатов можно по статусу заявки и/или по номерам заявок. В текст сообщения можно включить индивидуальные данные из заявки.
 <br/><br/><u>закрыть</u></div></div>

  <form method="POST" >

 <?
CModule::IncludeModule("form");
$FORM_ID = $form_m;
 // массив символьных кодов необходимых вопросов;
//$ar_pole=array('status','name','family','middle_name','email','tel','money_2','currency','sum_debt','date_endpay','billingdate','claimdate','t_money_2','em_bd');
$ar_pole=array('status','kem_priglashen_chk','kem_priglashen_name','kem_priglashen_family','chk','name','family','middle_name','email','email_2','tel','skype','sex','country','city','region','birthday','prioritet','p_name','p_family','p_date','p_due_date','p_sn','p_viza','p_fly','fly_1','fly_2','p_hotel','day_hotel_start','day_hotel_finish','hotel','nomer','p_transfer','d_konf','d_ujin','d_futbolka','money_2','currency','sum_debt','date_endpay','billingdate','claimdate','t_money_2','em_bd','oplata','venue');
 
$cte=count($ar_pole);


$arFilter = Array(
   "SID"  => implode("|",$ar_pole)   // символьный идентификатор
 );
$rsQuestions = CFormField::GetList(
    $FORM_ID, 
    "N", 
    $by="s_id", 
    $order="ask", 
    $arFilter, 
    $is_filtered
    );
	while ($arQuestion = $rsQuestions->Fetch())
	{
		//echo "<pre>"; print_r($arQuestion); echo "</pre>";
		$ar_title[$arQuestion["SID"]]=$arQuestion["TITLE"];
		
	}
	
	for($i=0;$i<$cte;$i++) {
	$ar_temstr[$i]="[".$ar_pole[$i]."]"; //массив текстовых шаблонов
	$ar_temstr_name[$i]=$ar_title[$ar_pole[$i]]; //массив наименовааний текстовых шаблонов
	}


 // получим список всех статусов формы, соответствующих фильтру
	$rsStatuses = CFormStatus::GetList(
		$FORM_ID, 
		$by="s_id", 
		$order="desc", 
		$arFilter, 
		$is_filtered
		);
	while ($arStatus = $rsStatuses->Fetch())
	{
		//echo "<pre>"; print_r($arStatus); echo "</pre>";
		if($arStatus["TITLE"]!="Поступила"){
		$ar_status_id[]=$arStatus["ID"];
		$ar_status_title[]=$arStatus["TITLE"];
		}
	}
	$sit=count($ar_status_id);

?>
<table border='0' width="1000"><tr><td>
<div class="chte" >
<b>Фильтр:</b><span onclick="f_ps('txt5')"> <u>Что это? >>></u></span><div id="txt5" class="txt" onclick="f_us('txt5')">
Фильтр позволяет выбрать для обработки один статус из выпадающего списка. Выбор статуса обязателен, если не заданы номера заявок. Номера заявок вносятся в поле одной строкой. Для разделения номеров используйте разделитель ","(запятая).
 <br/><br/><u>закрыть</u></div>
 <div class="f_van">

 <div class="t_van">
 Статус<br/>
 <select name="van_status">
 
 <option value="0" <?if($_POST['van_status']==0) echo " selected";?>>Выберите статус</option>
 
 <?
 for($i=0;$i<$sit;$i++){
 echo "<option value='".$ar_status_id[$i]."'";
 if($_POST['van_status']==$ar_status_id[$i]) echo " selected";
 echo">".$ar_status_title[$i]."</option>";
 }
 ?>
 </select>
 </div>
 <div class="t_van">
 №№ заявок<br/>
 <input type="text" name="van_list" value="<?echo $_POST['van_list']?>">
 </div>
 </div>
</div>
</td><td width="70%">
<div class="pismo">
<div class="chte"><b>Текст сообщения.</b> <span onclick="f_ps('txt6')"><u>Что это? >>></u></span><div id="txt6" class="txt" onclick="f_us('txt6')">
Текст из поля ниже будет отправлен участникам, выбранным по фильтру на адреса электронной почты, указанные в заявке. В сообщение можно добавлять символьные коды полей заявки. Перед отправкой эти коды будут заменены на значения этих полей из каждой заявки.
 <br/><br/><u>закрыть</u></div></div>
<textarea name="pismo_text">
<?=$_POST["pismo_text"]?>
</textarea>
<div class="but_ar" onclick="edit_ar('<?=date("d.m.Y")?>')">Текущая дата</div>
<div class="but_ar" onclick="edit_ar('[status_title]')">Статус заявки</div>
<div class="but_ar" onclick="edit_ar('[RESULT_ID]')">№ заявки</div>

<?
for($i=0;$i<$cte;$i++) {
?>
<div class="but_ar" onclick="edit_ar('<?=$ar_temstr[$i]?>')"><?=$ar_temstr_name[$i]?></div>
<?
}

?>

</div>
</td></tr></table>
 <div class="chte"><input class="buts" type="submit" name="prp" value="Предварительный просмотр" onclick="f_sz()"> <span onclick="f_ps('txt4')"><u>Что это? >>></u></span><div id="txt4" class="txt" onclick="f_us('txt4')">
 Кнопка "Предварительный просмотр" выводит значения полей заявок, отобранных по фильтру и образец сообщения для одной из заявок. Отправки сообщений нет.
 <br/><br/><u>закрыть</u></div>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <input class="buts" type="submit" name="address_list" value="Создать список обратной связи" onclick="f_sz()"> <span onclick="f_ps('txt8')"><u>Что это? >>> </u></span><div id="txt8" class="txt" onclick="f_us('txt8')">
 Кнопка "Создать список обратной связи" создаёт файл со списком: № заявки, № ЧК, имя, фамилия, e-mail, телефон, скайп и предпочтительный вид связи по заданному фильтру. Файл можно скачать. Отправки сообщений нет.
 <br/><br/><u>закрыть</u></div>
 
 </div>
 
<div class="chte">
 <input class="buts" type="submit" name="proso" value="Отправить сообщение " onclick="f_sz()"> -в примере отправка отключена
  <br>
  Статусы сообщения: <span style='font-size:12pt;'> &#9993;</span> - Режим просмотра; <span style='color:green;font-size:12pt;'> &#9993;&#10004;</span> - Успешная отправка; 
  <span style='color:red;font-size:12pt;'> &#9993;&#10008;</span> - Ошибка отправки; <span style='color:#c8640a;font-size:12pt;'> &#9993;&#8264;</span> - Нет текста сообщения, отправка отменена.
  
</div>
 </form>
 
<?php

//-------------------------
if(isset($_POST['address_list'])) {
$fr=@fopen("address_list.xml","w");
$somecontent="<Address><ArrayOfClaim>\n";
/*
require_once '../../../../bitrix/php_interface/include/phpexcel/PHPExcel.php'; // Подключаем библиотеку PHPExcel

 $phpexcel = new PHPExcel(); // Создаём объект PHPExcel
  // Каждый раз делаем активной 1-ю страницу и получаем её, потом записываем в неё данные 
  $page = $phpexcel->setActiveSheetIndex(0); // Делаем активной первую страницу и получаем её
  $page->setCellValue("A1", "№ заявки"); // Добавляем в ячейку A1 
  $page->setCellValue("B1", "№ ЧК"); // Добавляем в ячейку B1 
  $page->setCellValue("C1", "Фамилия"); // Добавляем в ячейку C1 
  $page->setCellValue("D1", "Имя"); // Добавляем в ячейку D1 
  $page->setCellValue("E1", "E-mail"); // Добавляем в ячейку E1
  $page->setCellValue("F1", "E-mail(БД)"); // Добавляем в ячейку F1
  $page->setCellValue("G1", "Телефон"); // Добавляем в ячейку G1
  $page->setCellValue("H1", "Skype"); // Добавляем в ячейку H1
  $page->setCellValue("I1", "Предпочтение"); // Добавляем в ячейку I1
 
*/
}

//-------------------------

if(isset($_POST['proso']) || isset($_POST['prp']) || isset($_POST['address_list'])) {

$f_status=$_POST['van_status'];

$f_id=str_replace(",","|",trim($_POST['van_list']));
if($f_id && $f_status==0) $f_status="";

// фильтр по полям результата
	$arFilter = array(
	    "ID"                   => $f_id,              // ID результата
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

$arFields[] = array(
    "CODE"              => "oplata",     // код поля по которому фильтруем
    "FILTER_TYPE"       => "text",          // фильтруем по текстовому полю
    "PARAMETER_NAME"    => "ANSWER_TEXT",          // фильтруем по полю ANSWER_TEXT
    "VALUE"             => "Нал в ОП",        // значение по которому фильтруем
    "EXACT_MATCH"       => "N"              // ищем вхождение, ищем точное совпадение-"Y"
    );
	*/
	$arFilter["FIELDS"] = $arFields;
	
			// выберем (первые) все результатов
	$rsResults = CFormResult::GETList($FORM_ID, 
		($by="s_timestamp"), 
		($order="desc"), 
		$arFilter, 
		$is_filtered, 
		"Y",
		false);
	$npp=0;

?>

<div class="" style="width:1000px;overflow:auto;">
<table class="tmbl">
	 <tr>
	 <th>№ п/п</th>
	 <th>№ заявки</th>
	 <th>Статус заявки</th>
	 
	 <?
	 for($i=0;$i<$cte;$i++) {
	echo "<th>".$ar_temstr_name[$i]."</th>";
	}
	 ?>
	<!-- 
	 <th>Ф.И.О.</th>
	 <th>e-mail</th>
	 <th>e-mail(БД ЦОИ)</th>
	 <th>Телефон</th>
	 <th>Стоимость мероприятия</th>
	 <th>Сумма задолженности</th>
	 <th>Оплачено</th>
	 <th>Дата поступления заявки</th>
	 <th>Дата выставления счёта</th>
	 <th>Дата последнего платежа</th>
	 -->
	 </tr>
<?
			$subject=$title_m;  // Тема сообщения
			// Шапка сообщения
			$headers= "MIME-Version: 1.0\r\n";
			$headers.= "Content-type: text/plain; charset=UTF-8\r\n";

	while ($arResult = $rsResults->Fetch())
	{ 
	//echo "<pre>";print_r($arResult);echo "</pre>";
	$addres['RESULT_ID']=$arResult['ID'];
	$addres['status_id']=$arResult['STATUS_ID'];
	$addres['status_title']=$arResult['STATUS_TITLE'];
	
$arAnswer = CFormResult::GETDataByID(
	$addres['RESULT_ID'], 
	$ar_pole,  // массив символьных кодов необходимых вопросов
	$ar_Res, 
	$ar_Answer2); 
	//echo "<pre>";print_r($arAnswer);echo "</pre>";
	for($i=0;$i<$cte;$i++) {
	if($arAnswer[$ar_pole[$i]][0]['FIELD_TYPE']=="radio") $addres[$ar_pole[$i]]=trim($arAnswer[$ar_pole[$i]][0]['ANSWER_TEXT']);
	else $addres[$ar_pole[$i]]=trim($arAnswer[$ar_pole[$i]][0]['USER_TEXT']);
			$ar_fstr[$i]=$addres[$ar_pole[$i]];
			}
	//echo "<pre>";print_r($addres);echo "</pre>";		

		if(isset($_POST['proso'])) {
			
			$message=str_replace($ar_temstr,$ar_fstr,$_POST["pismo_text"]);
			$message=str_replace("[RESULT_ID]",$addres['RESULT_ID'],$message);
			$message=str_replace("[status_title]",$addres['status_title'],$message);
			if($message) {
				
			// собираем все адреса в массив
			$ar_e_p[]=$addres['email'];
			$ar_e_p[]=$addres['email_2'];
			$ar_e_p[]=$addres['em_bd'];
			$ar_e_u=array_unique($ar_e_p); //убираем повторяющиеся адреса
			$e=implode(",", $ar_e_u); // строка адресов для отправки письма статуса
			
			// Отправка отключена
			/*
			if(mail($e, $subject, $message, $headers)) $not_o="<span style='color:green;font-size:12pt;' title='Успешная отправка.'> &#9993;&#10004;</span>";
			else  $not_o="<span style='color:red;font-size:12pt;' title='Ошибка отправки.'> &#9993;&#10008;</span>";
			*/
			$not_o="<span style='color:green;font-size:12pt;' title='Успешная отправка.'> &#9993;&#10004;</span>";
			}
			else {
			$not_o="<span style='color:#c8640a;font-size:12pt;' title='Нет текста сообщения, отправка отменена.'> &#9993;&#8264;</span>";
			}
			unset($ar_e_p, $message, $ar_e_u, $e);
		}
		if(isset($_POST['prp'])) {
		
		// массив замен для заготовок			
			for($i=0;$i<$cte;$i++) {
			$ar_fstr[$i]=$addres[$ar_pole[$i]];
			
			}
			
		$message=str_replace($ar_temstr,$ar_fstr,$_POST["pismo_text"]);
		$message=str_replace("[RESULT_ID]",$addres['RESULT_ID'],$message);
		$message=str_replace("[status_title]",$addres['status_title'],$message);

		// собираем все адреса в массив
			$ar_e_p[]=$addres['email'];
			$ar_e_p[]=$addres['email_2'];
			$ar_e_p[]=$addres['em_bd'];
			$ar_e_u=array_unique($ar_e_p); //убираем повторяющиеся адреса
			$e=implode(",", $ar_e_u); // строка адресов для отправки письма статуса
		
			if(!$f) {
			echo "<div class='obrazec'><h3>Образец сообщения</h3>-----------<br>Кому: ".$e;
			echo "<br>----------<div>".str_replace("\n","<br>",$message)."</div>";
			echo "</div>";
			$f=1;
			}
		$not_o="<span style='font-size:12pt;' title='Режим просмотра'> &#9993;</span>";
		
		}
		if(isset($_POST['address_list'])) {

		$somecontent.="<Claim Номер_заявки=\"".$addres['RESULT_ID']."\" Номер_ЧК=\"".$addres['chk']."\" Фамилия=\"".$addres['family']."\" Имя=\"".$addres['name']."\" E-mail=\"".$addres['email']."\" E-mail_БД=\"".$addres['em_bd']."\" Телефон=\"".$addres['tel']."\" Skype=\"".$addres['skype']."\" Предпочтение=\"".$addres['prioritet']."\"/>\n";
		/*
		  $page->setCellValue("A".($npp+2), $addres['RESULT_ID']); // Добавляем в ячейку A1 
		  $page->setCellValue("B".($npp+2), $addres['chk']); // Добавляем в ячейку B1 
		  $page->setCellValue("C".($npp+2), $addres['family']); // Добавляем в ячейку C1 
		  $page->setCellValue("D".($npp+2), $addres['name']); // Добавляем в ячейку D1 
		  $page->setCellValue("E".($npp+2), $addres['email']); // Добавляем в ячейку E1
		  $page->setCellValue("F".($npp+2), $addres['em_bd']); // Добавляем в ячейку F1
		  $page->setCellValue("G".($npp+2), $addres['tel']); // Добавляем в ячейку G1
		  $page->setCellValue("H".($npp+2), $addres['skype']); // Добавляем в ячейку H1
		  $page->setCellValue("I".($npp+2), $addres['prioritet']); // Добавляем в ячейку I1
		*/
		}

	$npp++;
echo "<tr>";
echo "<td>".$npp.$not_o."</td>";
echo "<td>".$addres['RESULT_ID']."</td>";
echo "<td>".$addres['status_title']."(".$addres['status_id'].")"."</td>";

 for($i=0;$i<$cte;$i++) {
	echo "<td>".$addres[$ar_pole[$i]]."</td>";
	}

echo "</tr>";


unlink($addres);
	}
	//if(!$f_status && !$f_id) echo "<tr><td colspan='8'> Не заданы параметры фильтра</td></tr>";
	if(!$npp) echo "<tr><td colspan='8'> Нет заявок для обработки. Измените параметры фильтра.</td></tr>";
	

		if(isset($_POST['address_list'])) {
		$somecontent.="</ArrayOfClaim></Address>";
		if (fwrite($fr, $somecontent) === FALSE) {
				echo "Не могу создать файл!";
				exit;
			}
			?>
			<div class="chte"><b>Файл создан!</b> <span onclick="f_ps('txt7')"><u>Скачать >>></u></span><div id="txt7" class="txt"><div style="text-align:center"><a href='address_list.xml' target="_blank" style="font-size:14pt;">address_list.xml</a></div><br />
Для скачивания файла кликните правой кнопкой мыши по имени файла, веберите пункт "Сохранить объект как". Сохранённый файл открыть с помощью Exel. В дальнейшем файл можно сохранить в формате Exel 
 <br/><br/><u  onclick="f_us('txt7')">закрыть</u></div></div>
			<?
			//echo "Файл создан! <a href='address_list.xml'>Скачать >>></a>";
		@fclose($fr);
		/*
		 $page->setTitle("e-mail"); // Ставим заголовок "e-mail" на странице
		  // Начинаем готовиться к записи информации в xlsx-файл 
		  
		  $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
		  
		  // Записываем в файл 
		  $objWriter->save("address.xlsx");
		  echo "Файл создан! <a href='address.xlsx'>Скачать >>></a>";
		 */
		}

//echo "<pre>";print_r($ar_ver);echo "</pre>";

?>
</table>
</div>
<?}?>
</div>
<br><br><br><br><br><br><br><br>
	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
