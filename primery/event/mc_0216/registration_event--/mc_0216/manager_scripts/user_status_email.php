<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
include "../var_config.php";
$APPLICATION->SetTitle($title_m);

?> 

<link rel="stylesheet" type="text/css" href="/css/manager_scripts.css" />
<script type="text/javascript" src="/js/manager_scripts/manager_scripts.js"></script>
<br/>
<div class="manager_scripts">
	<div class="a_vozo"><a href="./">Все служебные обработчики</a><div id="sz"><div><img src="/images/registration_event/d.gif"></div></div></div>
	<h2><?$APPLICATION->ShowTitle();?></h2>
	<br/>
	<div class="chte"><b>Отправка сообщений по существующим шаблонам.</b> <span onclick="f_ps('txt2')"><u>Что это? >>></u></span><div id="txt2" class="txt" onclick="f_us('txt2')">
	Данная страница позволяет отправить сообщения участникам мероприятия "<?$APPLICATION->ShowTitle();?>".<br/>
	 Выбрать адресатов можно по статусу заявки и/или по номерам заявок. Сообщение формируется индивидуально для каждого участника по уже существующему шаблону.
	 <br/><br/><u>закрыть</u></div></div>

	  <form method="POST">

	 <?
	if(CModule::IncludeModule("form")){ 
		$FORM_ID = $form_m;
		 // массив символьных кодов необходимых вопросов;
		//$ar_pole=array('status','name','family','middle_name','email','tel','money_2','currency','sum_debt','date_endpay','billingdate','claimdate','t_money_2','em_bd');
		$ar_pole=array('name','family','email','email_2','money_2','em_bd','oplata','currency','lang_id');
		 
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
			/*
			while ($arQuestion = $rsQuestions->Fetch())
			{
				//echo "<pre>"; print_r($arQuestion); echo "</pre>";
				$ar_title[$arQuestion["SID"]]=$arQuestion["TITLE"];
				
			}
			
			for($i=0;$i<$cte;$i++) {
			$ar_temstr[$i]="[".$ar_pole[$i]."]"; //массив текстовых шаблонов
			$ar_temstr_name[$i]=$ar_title[$ar_pole[$i]]; //массив наименовааний текстовых шаблонов
			}
		*/

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
		<table><tr valign="top"><td>
		<div class="chte" style="border:solid 0px red;">
		<b>Фильтр:</b><span onclick="f_ps('txt5')"> <u>Что это? >>></u></span><div id="txt5" class="txt" onclick="f_us('txt5')">
		Фильтр позволяет выбрать для формирования адресатов один статус из выпадающего списка или номера заявок. Выбор статуса обязателен, если не заданы номера заявок. Номера заявок вносятся в поле одной строкой. Для разделения номеров используйте разделитель ","(запятая).
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
		</td><td width="35%">
		<div class="pismo">
		<?
		$arFilter = Array(
		   // "ID"            => "12 | 134",
			"TYPE"          => $code_m,
		   // "TYPE_ID"       => "ADV_BANNER | ADV_CONTRACT",
		   // "TIMESTAMP_1"   => "12.11.2001",
		   // "TIMESTAMP_2"   => "12.11.2005",
		   // "SITE_ID"       => "ru | en",
		   // "ACTIVE"        => "Y",
			//"FROM"          => "bitrixsoft.ru",
		   // "TO"            => "#TO#",
		   // "BCC"           => "admin",
		   // "SUBJECT"       => "конктракт",
		   // "BODY_TYPE"     => "text",
		   // "BODY"          => "auto"
			
			);
		$rsMess = CEventMessage::GetList($by="event_name", $order="desc", $arFilter);
		//$is_filtered = $rsMess->is_filtered;


		while ($arMess = $rsMess->Fetch())
		{
			$ar_mail_mess[$arMess["ID"]]["ID"]=$arMess["ID"];
			$ar_mail_mess[$arMess["ID"]]["SUBJECT"]=$arMess["SUBJECT"];
			$ar_mail_mess[$arMess["ID"]]["MESSAGE"]=$arMess["MESSAGE"];
		}
		//echo "<pre>";print_r($ar_mail_mess);echo "</pre>";
	$ntt=count($ar_mail_mess); // кол-во доступных шаблонов

		?>


		<div class="chte"><b>Список шаблонов.</b> <span onclick="f_ps('txt6')"><u>Что это? >>></u></span><div id="txt6" class="txt" onclick="f_us('txt6')">
	Сообщение формируется индивидуально для каждого участника по выбранному из списка шаблону. Список формируется по типу почтового события "Заполнена web-форма <?=$code_m?>". Выбор шаблона обязателен.
	 <br/><br/><u>закрыть</u></div></div>
		
			<?foreach($ar_mail_mess as $k=>$v) {?>
				<div class="div_mess"><input type="radio" name="id_mess" id="id_mess_<?=$k?>" value="<?=$k?>" <?if($k==$_POST["id_mess"] || $ntt==1) echo "checked"?>> <label for="id_mess_<?=$k?>"><?=$v["SUBJECT"]?><?=($v["SUBJECT"]=="#title#")?"(универсальный)":""?></label> <a href="#div_text_<?=$k?>" class="gallery" title="просмотр шаблона сообщения"><img src="/images/registration_event/page_white_text_width.png" align="top"></a><div class="text" id="div_text_<?=$k?>"><h3><?=$v["SUBJECT"]?></h3><br /><?=str_replace("\n","<br />",$v["MESSAGE"])?></div></div>
			<?}?>
		</select>
		</div>
		</td>
		<td width="40%">
		
		<?
			$ar_lang_dir=scandir("../mail_status/lang/"); // массив используемых языков
	$key=array_search(".", $ar_lang_dir);
	if (false !== $key) unset($ar_lang_dir[ $key ]); // удаляем папку "."
	$key=array_search("..", $ar_lang_dir);
	if (false !== $key) unset($ar_lang_dir[ $key ]); // удаляем папку ".."
	
	//echo "<pre>";print_r($ar_lang_dir);echo "</pre>";
	
	//$ar_list_file=scandir("../mail_status/lang/ru");//array("status_del.php","status_nepr.php","status_no.php","status_nopl.php","status_ok.php","status_opl.php","status_rz.php"); // массив файлов писем статусов
	
	foreach($ar_lang_dir as $dir) {
		$list_dir=scandir("../mail_status/lang/".$dir."/");
		//echo "<pre>";print_r($list_dir);echo "</pre>";
		$i=0;
		foreach($list_dir as $fil) {
			if($fil!="." && $fil!="..") {
				//echo $fil."<br />";
				include_once "../mail_status/lang/".$dir."/".$fil;
				$ar_text[$i][$dir]["title"]=$title;
				$ar_text[$i][$dir]["text"]=$text;
				unset($title,$text);
				$i++;
			}
		}
	}
	//echo "<pre>";print_r($ar_text);echo "</pre>";
		?>
		
			<div class="chte"><b>Языковые конструкции.</b> <span onclick="f_ps('txt7')"><u>Что это? >>></u></span><div id="txt7" class="txt" onclick="f_us('txt7')">
	В универсальный шаблон вместо #title# и #text# будет подставлен текст из файла в соответствии языка заявки индивидуально для каждого участника.
	 <br/><br/><u>закрыть</u></div></div>
			
			<?foreach($ar_text as $kt=>$vt) {?>
				<div class="div_mess"><input type="radio" name="id_text" id="id_text_<?=$kt?>" value="<?=$kt?>" <?if($kt==$_POST["id_text"]) echo "checked"?>> <label for="id_text_<?=$kt?>"><?=$vt["ru"]["title"]?></label> <a href="#div_text_<?=$kt?>" class="gallery" title="просмотр текстового шаблоная"><img src="/images/registration_event/page_white_text_width.png" align="top"></a><div class="text" id="div_text_<?=$kt?>">
					<?foreach($vt as $st=>$tt) {?>
						<h3><?=$st?> > <?=$tt["title"]?></h3><div style="text-align:left;"><?=str_replace("\n","<br />",$tt["text"])?></div><hr>
					<?}?>
				</div></div>
			<?}?>
		</td>
		</tr></table>
		 <div class="chte"><input class="buts" type="submit" name="prp" value="Предварительный просмотр" onclick="f_sz()"> <span onclick="f_ps('txt4')"><u>Что это? >>></u></span><div id="txt4" class="txt" onclick="f_us('txt4')">
		 Кнопка "Предварительный просмотр" выводит значения полей заявок, отобранных по фильтру и образец сообщения для одной из заявок. Отправки сообщений нет.
		 <br/><br/><u>закрыть</u></div>

		 
		 </div>
		 
		<div class="chte">
		 <input class="buts" type="submit" name="proso" value="Отправить сообщение" onclick="f_sz()"> 
		  <br>
		  Статусы сообщения: <span style='font-size:12pt;'> &#9993;</span> - Режим просмотра; <span style='color:green;font-size:12pt;'> &#9993;&#10004;</span> - Создано почтовое событие; 
		  <span style='color:red;font-size:12pt;'> &#9993;&#10008;</span> - Ошибка создания почтового события.
		  
		</div>
		 </form>
		 
		<?php


		if(isset($_POST['proso']) || isset($_POST['prp'])) {
			
		//echo "<pre>";print_r($_POST);echo "</pre>";
		CForm::GetDataByID($form_m, $form, $questions, $answers, $dropdown,  $multiselect); // данные по форме

		if($_POST["id_mess"]) {
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
				
			
				<?

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

						
								// собираем все адреса в массив
									$ar_e_p[]=$addres['email'];
									$ar_e_p[]=$addres['email_2'];
									$ar_e_p[]=$addres['em_bd'];
									$ar_e_u=array_unique($ar_e_p); //убираем повторяющиеся адреса
									$e=implode(",", $ar_e_u); // строка адресов для отправки письма статуса
									
							
							/////////////////////////////////// билет начало /////////////////////////////////////////////////////////////
							
								switch($_POST["id_mess"]) { // формирование дополнительных переменных для некоторых шаблонов
									
									case $t_mail_nepr: // ожидает промоушен
										include_once "../choice_place/functions_shema.php";
											$zal = 1;
											occupy_edit_status ($zal,$addres['RESULT_ID'],"Резерв под себя");

												$zayavka = $addres['RESULT_ID'];
												// Смотрим занятые места
												$query = mysql_query ("SELECT * FROM m_occupy WHERE zal='".$zal."' and zayavka = '".$zayavka."'ORDER BY line DESC") or die(mysql_error()); 
												if (mysql_num_rows($query))
												{	
													//$occupy_text = "Зарезервированные Вами места:\r\n";
													$occupy_text = "";
													while($occupy = mysql_fetch_assoc($query)) {
													
														$query_sec = mysql_query ("SELECT * FROM m_sector WHERE id = '".$occupy['sector']."' and zal='".$zal."'") or die(mysql_error()); 
														if (mysql_num_rows($query_sec))
														{
																while($sector = mysql_fetch_assoc($query_sec)) {
																	$sector_id = $sector['id'];
																	$sector_name = $sector['name'];
																	$sector_align = $sector['align']; 
																}
														}
														if ($sector_id != 15) $ryd="Ряд";
														else $ryd="Стол";
														
														if($occupy['status']=="Резерв под коллегу") $bron="(БРОНЬ: ".$occupy['id']."-".$zayavka.")";
														else $bron="";
														
														$occupy_text .= "Статус: ".$occupy['status']." -  Сектор: ".$sector_name.". ".$ryd.": ".$occupy['line'].". Место: ".$occupy['mesto']." ".$bron."\r\n\r\n";
													}
												}
									break;
									
									case $t_mail_opl: // ожидает оплаты
										include_once "../choice_place/functions_shema.php";
											$zal = 1;
										occupy_edit_status ($zal,$addres['RESULT_ID'],"Резерв под себя");
											$zayavka = $addres['RESULT_ID'];
											// Смотрим занятые места
											$query = mysql_query ("SELECT * FROM m_occupy WHERE zal='".$zal."' and zayavka = '".$zayavka."'ORDER BY line DESC") or die(mysql_error()); 
											if (mysql_num_rows($query))
											{	
												//$occupy_text = "Зарезервированные Вами места:\r\n";
												$occupy_text = "";
												while($occupy = mysql_fetch_assoc($query)) {
												
													$query_sec = mysql_query ("SELECT * FROM m_sector WHERE id = '".$occupy['sector']."' and zal='".$zal."'") or die(mysql_error()); 
													if (mysql_num_rows($query_sec))
													{
															while($sector = mysql_fetch_assoc($query_sec)) {
																$sector_id = $sector['id'];
																$sector_name = $sector['name'];
																$sector_align = $sector['align']; 
															}
													}
													if ($sector_id == 15) $ryd="Ряд";
													else $ryd="Стол";
													
													if($occupy['status']=="Резерв под коллегу") $bron=$occupy['id']."-".$zayavka;
													else $bron=$occupy['id'];
													
													$occupy_text .= "Статус: ".$occupy['status']." -  Сектор: ".$sector_name.". ".$ryd.": ".$occupy['line'].". Место: ".$occupy['mesto']." (БРОНЬ - ".$bron.")\r\n\r\n";
												}
											}
									break;
									
									case $t_mail_ok: // подтверждена
										include_once "../choice_place/functions_shema.php";	
										$zal = 1;
										occupy_edit_status ($zal,$addres['RESULT_ID'],"Забронировано");
											$zayavka = $addres['RESULT_ID'];
											// Смотрим занятые места
											$query = mysql_query ("SELECT * FROM m_occupy WHERE zal='".$zal."' and zayavka = '".$zayavka."'ORDER BY line DESC") or die(mysql_error()); 
											if (mysql_num_rows($query))
											{	
												//$occupy_text = "Зарезервированные Вами места:\r\n";
												$occupy_text = "";
												while($occupy = mysql_fetch_assoc($query)) {
												
													$query_sec = mysql_query ("SELECT * FROM m_sector WHERE id = '".$occupy['sector']."' and zal='".$zal."'") or die(mysql_error()); 
													if (mysql_num_rows($query_sec))
													{
															while($sector = mysql_fetch_assoc($query_sec)) {
																$sector_id = $sector['id'];
																$sector_name = $sector['name'];
																$sector_align = $sector['align']; 
															}
													}
													if ($sector_id != 15) $ryd="Ряд";
													else $ryd="Стол";
													
													if($occupy['status']=="Резерв под коллегу") $bron="(БРОНЬ: ".$occupy['id']."-".$zayavka.")";
													else $bron="";
													
													$occupy_text .= "Статус: ".$occupy['status']." -  Сектор: ".$sector_name.". ".$ryd.": ".$occupy['line'].". Место: ".$occupy['mesto']." ".$bron."\r\n\r\n";
												}
											}
											
												// Проверяем, есть ли билет
											$RESULT_ID=$addres['RESULT_ID'];
											if(!file_exists ('../choice_place/take_place/tickets/ticket-'.$addres['RESULT_ID'].'.jpg')) {
												// если билета нет - делаем
												include "../choice_place/take_place/status_tiket_add.php";
											}
											$filename='/ru/registration_event/forum_0615/choice_place/take_place/tickets/ticket-'.$addres['RESULT_ID'].'.jpg';// файл билета
											
									break;
									
								}
							/////////////////////////////////// билет конец /////////////////////////////////////////////////////////////

							?>
								<table class="tmbl">
					 <tr>
					 <th>№ п/п</th>
					 <th>№ заявки</th>
					 <th>Статус заявки</th>
					 


					 </tr>
							<?
							
							
							$trans = array("#RESULT_ID#" => $addres['RESULT_ID'], "#NAME#" => $addres['name'], "#FAMILY#" => $addres['family'], "#MONEY_2#" => $addres['money_2'], "#CURRENCY#" => $addres['currency'], "#OPLATA#" => $addres['oplata']); // массив для замены в шаблоне
							$title=strtr($ar_text[$_POST["id_text"]][$addres['lang_id']]["title"], $trans); // замена хештегов на значение в теме сообщения
							$text=strtr($ar_text[$_POST["id_text"]][$addres['lang_id']]["text"], $trans); // замена хештегов на значение в шаблоне сообщения
							//echo "<pre>";print_r($ar_text[$_POST["id_text"]]);echo "</pre>";
							if(isset($_POST['proso'])) {
								
								
																		
								// Массив данных для шаблона
								$arFields = array(
									"RS_RESULT_ID" => $addres['RESULT_ID'], // ID заявки
									"name" => $addres['name'],              // Имя
									"family" => $addres['family'],          // Фамилия
									"money_2" => $addres['money_2'],        // Стоимость в Вашей валюте
									"currency" => $addres['currency'],      // Валюта заявки
									"oplata" => $addres['oplata'],          // Форма оплаты
									"ticket" => $filename,				    // файл билета
									"occupy_text" => $occupy_text,          // список забронированных мест
									"email" => $e,                          // email для отправки
									
									"title" =>$title,                            // заголовок сообщения
									"text" =>$text,                            // текст сообщения
								
								);
								if($e) {				
									//if(CEvent::Send($form["MAIL_EVENT_TYPE"], array("ru"), $arFields, "N", $_POST["id_mess"])) $not_o="<span style='color:green;font-size:12pt;' title='Создано почтовое событие.'> &#9993;&#10004;</span>";
									//else  $not_o="<span style='color:red;font-size:12pt;' title='Ошибка создания почтового события.'> &#9993;&#10008;</span>";
								}
								unset($ar_e_p, $ar_e_u, $e);
							}
							if(isset($_POST['prp'])) {
							
								
									if(!$f) {
								
										
									echo "<div class='obrazec'>Образец сообщения:<h3>".$title."</h3>-----------<br>Кому: ".$e;
									echo "<br>----------<div>".str_replace("\n","<br />",$text)."</div>";
									echo "</div>";
									$f=1;
									}
								$not_o="<span style='font-size:12pt;' title='Режим просмотра'> &#9993;</span>";
							
							}
						

						$npp++;
					echo "<tr>";
					echo "<td>".$npp.$not_o."</td>";
					echo "<td>".$addres['RESULT_ID']."</td>";
					echo "<td>".$addres['status_title']."(".$addres['status_id'].")"."</td>";



					echo "</tr>";


					unlink($addres);
				}
				
				
				//if(!$f_status && !$f_id) echo "<tr><td colspan='8'> Не заданы параметры фильтра</td></tr>";
				if(!$npp) echo "<tr><td colspan='8'> Нет заявок для обработки. Измените параметры фильтра.</td></tr>";
			}
			else {
				echo "<tr><td colspan='8'><span class='gk'>Не выбран шаблон сообщения!</span></td></tr>";
			}
		}

	}
	//echo "<pre>";print_r($ar_ver);echo "</pre>";
	
	?>
	</table>
</div>

<script type="text/javascript">
		$(document).ready(function() {
			$("a.gallery").fancybox();
		});
		</script>
<br><br><br><br><br><br><br><br>
	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>