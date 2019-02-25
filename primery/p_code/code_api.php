&lt;?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$title_m="Конструктор сообщений";
$form_m=3;
$APPLICATION-&gt;SetTitle($title_m);

?&gt; 

&lt;link rel="stylesheet" type="text/css" href="/css/manager_scripts.css" /&gt;
&lt;script type="text/javascript" src="/js/manager_scripts/manager_scripts.js"&gt;&lt;/script&gt;
&lt;br/&gt;
&lt;div class="manager_scripts"&gt;

&lt;h2&gt;&lt;?$APPLICATION-&gt;ShowTitle();?&gt;&lt;/h2&gt;
&lt;br/&gt;
&lt;div class="chte"&gt;&lt;b&gt;Конструктор сообщений.&lt;/b&gt; &lt;span onclick="f_ps('txt2')"&gt;&lt;u&gt;Что это? &gt;&gt;&gt;&lt;/u&gt;&lt;/span&gt;&lt;div id="txt2" class="txt" onclick="f_us('txt2')"&gt;
Данная страница позволяет отправить сообщения участникам мероприятия "&lt;?$APPLICATION-&gt;ShowTitle();?&gt;".&lt;br/&gt;
 Выбрать адресатов можно по статусу заявки и/или по номерам заявок. В текст сообщения можно включить индивидуальные данные из заявки.
 &lt;br/&gt;&lt;br/&gt;&lt;u&gt;закрыть&lt;/u&gt;&lt;/div&gt;&lt;/div&gt;

  &lt;form method="POST"&gt;

 &lt;?
CModule::IncludeModule("form");
$FORM_ID = $form_m;
 // массив символьных кодов необходимых вопросов;
//$ar_pole=array('status','name','family','middle_name','email','tel','money_2','currency','sum_debt','date_endpay','billingdate','claimdate','t_money_2','em_bd');
$ar_pole=array('status','kem_priglashen_chk','kem_priglashen_name','kem_priglashen_family','chk','name','family','middle_name','email','email_2','tel','skype','sex','country','city','region','birthday','prioritet','p_name','p_family','p_date','p_due_date','p_sn','p_viza','p_fly','fly_1','fly_2','p_hotel','day_hotel_start','day_hotel_finish','hotel','nomer','p_transfer','d_konf','d_ujin','d_futbolka','money_2','currency','sum_debt','date_endpay','billingdate','claimdate','t_money_2','em_bd','oplata','venue');
 
$cte=count($ar_pole);


$arFilter = Array(
   "SID"  =&gt; implode("|",$ar_pole)   // символьный идентификатор
 );
$rsQuestions = CFormField::GetList(
    $FORM_ID, 
    "N", 
    $by="s_id", 
    $order="ask", 
    $arFilter, 
    $is_filtered
    );
	while ($arQuestion = $rsQuestions-&gt;Fetch())
	{
		//echo "&lt;pre&gt;"; print_r($arQuestion); echo "&lt;/pre&gt;";
		$ar_title[$arQuestion["SID"]]=$arQuestion["TITLE"];
		
	}
	
	for($i=0;$i&lt;$cte;$i++) {
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
	while ($arStatus = $rsStatuses-&gt;Fetch())
	{
		//echo "&lt;pre&gt;"; print_r($arStatus); echo "&lt;/pre&gt;";
		if($arStatus["TITLE"]!="Поступила"){
		$ar_status_id[]=$arStatus["ID"];
		$ar_status_title[]=$arStatus["TITLE"];
		}
	}
	$sit=count($ar_status_id);

?&gt;
&lt;table border='0' width="1000"&gt;&lt;tr&gt;&lt;td&gt;
&lt;div class="chte" &gt;
&lt;b&gt;Фильтр:&lt;/b&gt;&lt;span onclick="f_ps('txt5')"&gt; &lt;u&gt;Что это? &gt;&gt;&gt;&lt;/u&gt;&lt;/span&gt;&lt;div id="txt5" class="txt" onclick="f_us('txt5')"&gt;
Фильтр позволяет выбрать для обработки один статус из выпадающего списка. Выбор статуса обязателен, если не заданы номера заявок. Номера заявок вносятся в поле одной строкой. Для разделения номеров используйте разделитель ","(запятая).
 &lt;br/&gt;&lt;br/&gt;&lt;u&gt;закрыть&lt;/u&gt;&lt;/div&gt;
 &lt;div class="f_van"&gt;

 &lt;div class="t_van"&gt;
 Статус&lt;br/&gt;
 &lt;select name="van_status"&gt;
 
 &lt;option value="0" &lt;?if($_POST['van_status']==0) echo " selected";?&gt;&gt;Выберите статус&lt;/option&gt;
 
 &lt;?
 for($i=0;$i&lt;$sit;$i++){
 echo "&lt;option value='".$ar_status_id[$i]."'";
 if($_POST['van_status']==$ar_status_id[$i]) echo " selected";
 echo"&gt;".$ar_status_title[$i]."&lt;/option&gt;";
 }
 ?&gt;
 &lt;/select&gt;
 &lt;/div&gt;
 &lt;div class="t_van"&gt;
 №№ заявок&lt;br/&gt;
 &lt;input type="text" name="van_list" value="&lt;?echo $_POST['van_list']?&gt;"&gt;
 &lt;/div&gt;
 &lt;/div&gt;
&lt;/div&gt;
&lt;/td&gt;&lt;td width="70%"&gt;
&lt;div class="pismo"&gt;
&lt;div class="chte"&gt;&lt;b&gt;Текст сообщения.&lt;/b&gt; &lt;span onclick="f_ps('txt6')"&gt;&lt;u&gt;Что это? &gt;&gt;&gt;&lt;/u&gt;&lt;/span&gt;&lt;div id="txt6" class="txt" onclick="f_us('txt6')"&gt;
Текст из поля ниже будет отправлен участникам, выбранным по фильтру на адреса электронной почты, указанные в заявке. В сообщение можно добавлять символьные коды полей заявки. Перед отправкой эти коды будут заменены на значения этих полей из каждой заявки.
 &lt;br/&gt;&lt;br/&gt;&lt;u&gt;закрыть&lt;/u&gt;&lt;/div&gt;&lt;/div&gt;
&lt;textarea name="pismo_text"&gt;
&lt;?=$_POST["pismo_text"]?&gt;
&lt;/textarea&gt;
&lt;div class="but_ar" onclick="edit_ar('&lt;?=date("d.m.Y")?&gt;')"&gt;Текущая дата&lt;/div&gt;
&lt;div class="but_ar" onclick="edit_ar('[status_title]')"&gt;Статус заявки&lt;/div&gt;
&lt;div class="but_ar" onclick="edit_ar('[RESULT_ID]')"&gt;№ заявки&lt;/div&gt;

&lt;?
for($i=0;$i&lt;$cte;$i++) {
?&gt;
&lt;div class="but_ar" onclick="edit_ar('&lt;?=$ar_temstr[$i]?&gt;')"&gt;&lt;?=$ar_temstr_name[$i]?&gt;&lt;/div&gt;
&lt;?
}

?&gt;

&lt;/div&gt;
&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;
 &lt;div class="chte"&gt;&lt;input class="buts" type="submit" name="prp" value="Предварительный просмотр" onclick="f_sz()"&gt; &lt;span onclick="f_ps('txt4')"&gt;&lt;u&gt;Что это? &gt;&gt;&gt;&lt;/u&gt;&lt;/span&gt;&lt;div id="txt4" class="txt" onclick="f_us('txt4')"&gt;
 Кнопка "Предварительный просмотр" выводит значения полей заявок, отобранных по фильтру и образец сообщения для одной из заявок. Отправки сообщений нет.
 &lt;br/&gt;&lt;br/&gt;&lt;u&gt;закрыть&lt;/u&gt;&lt;/div&gt;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &lt;input class="buts" type="submit" name="address_list" value="Создать список обратной связи" onclick="f_sz()"&gt; &lt;span onclick="f_ps('txt8')"&gt;&lt;u&gt;Что это? &gt;&gt;&gt; &lt;/u&gt;&lt;/span&gt;&lt;div id="txt8" class="txt" onclick="f_us('txt8')"&gt;
 Кнопка "Создать список обратной связи" создаёт файл со списком: № заявки, № ЧК, имя, фамилия, e-mail, телефон, скайп и предпочтительный вид связи по заданному фильтру. Файл можно скачать. Отправки сообщений нет.
 &lt;br/&gt;&lt;br/&gt;&lt;u&gt;закрыть&lt;/u&gt;&lt;/div&gt;
 
 &lt;/div&gt;
 
&lt;div class="chte"&gt;
 &lt;input class="buts" type="submit" name="proso" value="Отправить сообщение" onclick="f_sz()"&gt; 
  &lt;br&gt;
  Статусы сообщения: &lt;span style='font-size:12pt;'&gt; &#9993;&lt;/span&gt; - Режим просмотра; &lt;span style='color:green;font-size:12pt;'&gt; &#9993;&#10004;&lt;/span&gt; - Успешная отправка; 
  &lt;span style='color:red;font-size:12pt;'&gt; &#9993;&#10008;&lt;/span&gt; - Ошибка отправки; &lt;span style='color:#c8640a;font-size:12pt;'&gt; &#9993;&#8264;&lt;/span&gt; - Нет текста сообщения, отправка отменена.
  
&lt;/div&gt;
 &lt;/form&gt;
 
&lt;?php

//-------------------------
if(isset($_POST['address_list'])) {
$fr=@fopen("address_list.xml","w");
$somecontent="&lt;Address&gt;&lt;ArrayOfClaim&gt;\n";
/*
require_once '../../../../bitrix/php_interface/include/phpexcel/PHPExcel.php'; // Подключаем библиотеку PHPExcel

 $phpexcel = new PHPExcel(); // Создаём объект PHPExcel
  // Каждый раз делаем активной 1-ю страницу и получаем её, потом записываем в неё данные 
  $page = $phpexcel-&gt;setActiveSheetIndex(0); // Делаем активной первую страницу и получаем её
  $page-&gt;setCellValue("A1", "№ заявки"); // Добавляем в ячейку A1 
  $page-&gt;setCellValue("B1", "№ ЧК"); // Добавляем в ячейку B1 
  $page-&gt;setCellValue("C1", "Фамилия"); // Добавляем в ячейку C1 
  $page-&gt;setCellValue("D1", "Имя"); // Добавляем в ячейку D1 
  $page-&gt;setCellValue("E1", "E-mail"); // Добавляем в ячейку E1
  $page-&gt;setCellValue("F1", "E-mail(БД)"); // Добавляем в ячейку F1
  $page-&gt;setCellValue("G1", "Телефон"); // Добавляем в ячейку G1
  $page-&gt;setCellValue("H1", "Skype"); // Добавляем в ячейку H1
  $page-&gt;setCellValue("I1", "Предпочтение"); // Добавляем в ячейку I1
 
*/
}

//-------------------------

if(isset($_POST['proso']) || isset($_POST['prp']) || isset($_POST['address_list'])) {

$f_status=$_POST['van_status'];

$f_id=str_replace(",","|",trim($_POST['van_list']));
if($f_id && $f_status==0) $f_status="";

// фильтр по полям результата
	$arFilter = array(
	    "ID"                   =&gt; $f_id,              // ID результата
	  //  "ID_EXACT_MATCH"       =&gt; "N",               // вхождение
		"STATUS_ID"            =&gt; $f_status,          // статус Ожидает оплаты
	   // "TIMESTAMP_1"          =&gt; "10.10.2003",      // изменен "с"
	   // "TIMESTAMP_2"          =&gt; "15.10.2003",      // изменен "до"
	  //  "DATE_CREATE_1"        =&gt; "10.10.2003",      // создан "с"
	  //  "DATE_CREATE_2"        =&gt; "12.10.2003",      // создан "до"
	  //  "REGISTERED"           =&gt; "Y",               // был зарегистрирован
	  //  "USER_AUTH"            =&gt; "N",               // не был авторизован
	  //  "USER_ID"              =&gt; "45 | 35",         // пользователь-автор
	  //  "USER_ID_EXACT_MATCH"  =&gt; "Y",               // точное совпадение
	  //  "GUEST_ID"             =&gt; "4456 | 7768",     // посетитель-автор
	 //   "SESSION_ID"           =&gt; "456456 | 778768", // сессия
		);
		
		// фильтр по вопросам
		
$arFields = array();
/*	
$arFields[] = array(
    "CODE"              =&gt; "billingdate",     // код поля по которому фильтруем
    "FILTER_TYPE"       =&gt; "text",          // фильтруем по текстовому полю
    "PARAMETER_NAME"    =&gt; "USER",          // фильтруем по введенному значению
    "VALUE"             =&gt; "15.03.2013",        // значение по которому фильтруем
    "EXACT_MATCH"       =&gt; "N"              // ищем вхождение, ищем точное совпадение-"Y"
    );

$arFields[] = array(
    "CODE"              =&gt; "oplata",     // код поля по которому фильтруем
    "FILTER_TYPE"       =&gt; "text",          // фильтруем по текстовому полю
    "PARAMETER_NAME"    =&gt; "ANSWER_TEXT",          // фильтруем по полю ANSWER_TEXT
    "VALUE"             =&gt; "Нал в ОП",        // значение по которому фильтруем
    "EXACT_MATCH"       =&gt; "N"              // ищем вхождение, ищем точное совпадение-"Y"
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

?&gt;

&lt;div class="" style="width:1000px;overflow:auto;"&gt;
&lt;table class="tmbl"&gt;
	 &lt;tr&gt;
	 &lt;th&gt;№ п/п&lt;/th&gt;
	 &lt;th&gt;№ заявки&lt;/th&gt;
	 &lt;th&gt;Статус заявки&lt;/th&gt;
	 
	 &lt;?
	 for($i=0;$i&lt;$cte;$i++) {
	echo "&lt;th&gt;".$ar_temstr_name[$i]."&lt;/th&gt;";
	}
	 ?&gt;
	&lt;!-- 
	 &lt;th&gt;Ф.И.О.&lt;/th&gt;
	 &lt;th&gt;e-mail&lt;/th&gt;
	 &lt;th&gt;e-mail(БД ЦОИ)&lt;/th&gt;
	 &lt;th&gt;Телефон&lt;/th&gt;
	 &lt;th&gt;Стоимость мероприятия&lt;/th&gt;
	 &lt;th&gt;Сумма задолженности&lt;/th&gt;
	 &lt;th&gt;Оплачено&lt;/th&gt;
	 &lt;th&gt;Дата поступления заявки&lt;/th&gt;
	 &lt;th&gt;Дата выставления счёта&lt;/th&gt;
	 &lt;th&gt;Дата последнего платежа&lt;/th&gt;
	 --&gt;
	 &lt;/tr&gt;
&lt;?
			$subject=$title_m;  // Тема сообщения
			// Шапка сообщения
			$headers= "MIME-Version: 1.0\r\n";
			$headers.= "Content-type: text/plain; charset=UTF-8\r\n";

	while ($arResult = $rsResults-&gt;Fetch())
	{ 
	//echo "&lt;pre&gt;";print_r($arResult);echo "&lt;/pre&gt;";
	$addres['RESULT_ID']=$arResult['ID'];
	$addres['status_id']=$arResult['STATUS_ID'];
	$addres['status_title']=$arResult['STATUS_TITLE'];
	
$arAnswer = CFormResult::GETDataByID(
	$addres['RESULT_ID'], 
	$ar_pole,  // массив символьных кодов необходимых вопросов
	$ar_Res, 
	$ar_Answer2); 
	//echo "&lt;pre&gt;";print_r($arAnswer);echo "&lt;/pre&gt;";
	for($i=0;$i&lt;$cte;$i++) {
	if($arAnswer[$ar_pole[$i]][0]['FIELD_TYPE']=="radio") $addres[$ar_pole[$i]]=trim($arAnswer[$ar_pole[$i]][0]['ANSWER_TEXT']);
	else $addres[$ar_pole[$i]]=trim($arAnswer[$ar_pole[$i]][0]['USER_TEXT']);
			$ar_fstr[$i]=$addres[$ar_pole[$i]];
			}
	//echo "&lt;pre&gt;";print_r($addres);echo "&lt;/pre&gt;";		

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
			
			if(mail($e, $subject, $message, $headers)) $not_o="&lt;span style='color:green;font-size:12pt;' title='Успешная отправка.'&gt; &#9993;&#10004;&lt;/span&gt;";
			else  $not_o="&lt;span style='color:red;font-size:12pt;' title='Ошибка отправки.'&gt; &#9993;&#10008;&lt;/span&gt;";
			}
			else {
			$not_o="&lt;span style='color:#c8640a;font-size:12pt;' title='Нет текста сообщения, отправка отменена.'&gt; &#9993;&#8264;&lt;/span&gt;";
			}
			unset($ar_e_p, $message, $ar_e_u, $e);
		}
		if(isset($_POST['prp'])) {
		
		// массив замен для заготовок			
			for($i=0;$i&lt;$cte;$i++) {
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
			echo "&lt;div class='obrazec'&gt;&lt;h3&gt;Образец сообщения&lt;/h3&gt;-----------&lt;br&gt;Кому: ".$e;
			echo "&lt;br&gt;----------&lt;div&gt;".str_replace("\n","&lt;br&gt;",$message)."&lt;/div&gt;";
			echo "&lt;/div&gt;";
			$f=1;
			}
		$not_o="&lt;span style='font-size:12pt;' title='Режим просмотра'&gt; &#9993;&lt;/span&gt;";
		
		}
		if(isset($_POST['address_list'])) {

		$somecontent.="&lt;Claim Номер_заявки=\"".$addres['RESULT_ID']."\" Номер_ЧК=\"".$addres['chk']."\" Фамилия=\"".$addres['family']."\" Имя=\"".$addres['name']."\" E-mail=\"".$addres['email']."\" E-mail_БД=\"".$addres['em_bd']."\" Телефон=\"".$addres['tel']."\" Skype=\"".$addres['skype']."\" Предпочтение=\"".$addres['prioritet']."\"/&gt;\n";
		/*
		  $page-&gt;setCellValue("A".($npp+2), $addres['RESULT_ID']); // Добавляем в ячейку A1 
		  $page-&gt;setCellValue("B".($npp+2), $addres['chk']); // Добавляем в ячейку B1 
		  $page-&gt;setCellValue("C".($npp+2), $addres['family']); // Добавляем в ячейку C1 
		  $page-&gt;setCellValue("D".($npp+2), $addres['name']); // Добавляем в ячейку D1 
		  $page-&gt;setCellValue("E".($npp+2), $addres['email']); // Добавляем в ячейку E1
		  $page-&gt;setCellValue("F".($npp+2), $addres['em_bd']); // Добавляем в ячейку F1
		  $page-&gt;setCellValue("G".($npp+2), $addres['tel']); // Добавляем в ячейку G1
		  $page-&gt;setCellValue("H".($npp+2), $addres['skype']); // Добавляем в ячейку H1
		  $page-&gt;setCellValue("I".($npp+2), $addres['prioritet']); // Добавляем в ячейку I1
		*/
		}

	$npp++;
echo "&lt;tr&gt;";
echo "&lt;td&gt;".$npp.$not_o."&lt;/td&gt;";
echo "&lt;td&gt;".$addres['RESULT_ID']."&lt;/td&gt;";
echo "&lt;td&gt;".$addres['status_title']."(".$addres['status_id'].")"."&lt;/td&gt;";

 for($i=0;$i&lt;$cte;$i++) {
	echo "&lt;td&gt;".$addres[$ar_pole[$i]]."&lt;/td&gt;";
	}

echo "&lt;/tr&gt;";


unlink($addres);
	}
	//if(!$f_status && !$f_id) echo "&lt;tr&gt;&lt;td colspan='8'&gt; Не заданы параметры фильтра&lt;/td&gt;&lt;/tr&gt;";
	if(!$npp) echo "&lt;tr&gt;&lt;td colspan='8'&gt; Нет заявок для обработки. Измените параметры фильтра.&lt;/td&gt;&lt;/tr&gt;";
	

		if(isset($_POST['address_list'])) {
		$somecontent.="&lt;/ArrayOfClaim&gt;&lt;/Address&gt;";
		if (fwrite($fr, $somecontent) === FALSE) {
				echo "Не могу создать файл!";
				exit;
			}
			?&gt;
			&lt;div class="chte"&gt;&lt;b&gt;Файл создан!&lt;/b&gt; &lt;span onclick="f_ps('txt7')"&gt;&lt;u&gt;Скачать &gt;&gt;&gt;&lt;/u&gt;&lt;/span&gt;&lt;div id="txt7" class="txt"&gt;&lt;div style="text-align:center"&gt;&lt;a href='address_list.xml' target="_blank" style="font-size:14pt;"&gt;address_list.xml&lt;/a&gt;&lt;/div&gt;&lt;br /&gt;
Для скачивания файла кликните правой кнопкой мыши по имени файла, веберите пункт "Сохранить объект как". Сохранённый файл открыть с помощью Exel. В дальнейшем файл можно сохранить в формате Exel 
 &lt;br/&gt;&lt;br/&gt;&lt;u  onclick="f_us('txt7')"&gt;закрыть&lt;/u&gt;&lt;/div&gt;&lt;/div&gt;
			&lt;?
			//echo "Файл создан! &lt;a href='address_list.xml'&gt;Скачать &gt;&gt;&gt;&lt;/a&gt;";
		@fclose($fr);
		/*
		 $page-&gt;setTitle("e-mail"); // Ставим заголовок "e-mail" на странице
		  // Начинаем готовиться к записи информации в xlsx-файл 
		  
		  $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
		  
		  // Записываем в файл 
		  $objWriter-&gt;save("address.xlsx");
		  echo "Файл создан! &lt;a href='address.xlsx'&gt;Скачать &gt;&gt;&gt;&lt;/a&gt;";
		 */
		}

//echo "&lt;pre&gt;";print_r($ar_ver);echo "&lt;/pre&gt;";

?&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;?}?&gt;
&lt;/div&gt;
&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;&lt;br&gt;
	&lt;?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?&gt;
