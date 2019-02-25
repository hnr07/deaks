<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
include "../var_config.php";
$APPLICATION->SetTitle($title_m);
?> 

<link rel="stylesheet" type="text/css" href="/css/manager_scripts.css" />
<script type="text/javascript" src="/js/manager_scripts/manager_scripts.js"></script>

<?php

$oWS = new CCI_PDPWS();
// ОПРЕДЕЛЯЕМ СЕССИЮ
$iDSesison = $APPLICATION->get_cookie("BX_AUTH_SESSION_ID");
if(empty($iDSesison)) {$iDSesison = $USER->GetLogin();};
if(empty($iDSesison)) {$iDSesison = "SOS";}
if(isset($_GET['prom']) || isset($_GET['prp'])) {
if(CModule::IncludeModule("form")){ 
$FORM_ID = $form_m;
// фильтр по полям результата
	$arFilter = array(
	   // "ID"                   => "12",              // ID результата
	  //  "ID_EXACT_MATCH"       => "N",               // вхождение
		"STATUS_ID"            => $status_nepr,          // статус Ожидает промоушен
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
		
			// выберем (первые) все результатов
	$rsResults = CFormResult::GetList($FORM_ID, 
		($by="s_timestamp"), 
		($order="desc"), 
		$arFilter, 
		$is_filtered, 
		"Y", 
		false);
	
	while ($arResult = $rsResults->Fetch())
	{
	//echo "<pre>";print_r($arResult);echo "</pre>";
	$RESULT_ID=$arResult['ID'];
	$arAnswer = CFormResult::GetDataByID(
	$RESULT_ID, 
	array('chk','name','family','kem_priglashen_chk','kem_priglashen_family','kem_priglashen_name','status','promotion_1','billingdate','key_edit'),  // массив символьных кодов необходимых вопросов
	$ar_Res, 
	$ar_Answer2); 
	
	
	if($arAnswer['status'][0]['ANSWER_VALUE']=="member") { //статус Участник
		$p_chk=$arAnswer['chk'][0][USER_TEXT];
		$p_family=$arAnswer['family'][0][USER_TEXT];
		$p_name=$arAnswer['name'][0][USER_TEXT];
		$status=$arAnswer['status'][0]['ANSWER_TEXT'];
		$fl=$condition_member;
	}
	
	if($arAnswer['status'][0]['ANSWER_VALUE']=="guest_chk") {  //статус Приглашённый ЧК
		$p_chk=$arAnswer['kem_priglashen_chk'][0][USER_TEXT];
		$p_family=$arAnswer['kem_priglashen_family'][0][USER_TEXT];
		$p_name=$arAnswer['kem_priglashen_name'][0][USER_TEXT];
		$status=$arAnswer['status'][0]['ANSWER_TEXT'];
		$fl=$condition_guest_chk;
	}
	
	if($arAnswer['status'][0]['ANSWER_VALUE']=="guest") {  //статус Приглашённый родственник
		$p_chk=$arAnswer['kem_priglashen_chk'][0][USER_TEXT];
		$p_family=$arAnswer['kem_priglashen_family'][0][USER_TEXT];
		$p_name=$arAnswer['kem_priglashen_name'][0][USER_TEXT];
		$status=$arAnswer['status'][0]['ANSWER_TEXT'];
		$fl=$condition_member;
	}
	//echo "<pre>";print_r($arAnswer);echo "</pre>";
		$arCheck = Person_check($iDSesison,$fl,$p_chk,$p_family,$p_name);  // Может ли пользователь учавствовать и/или приглашать
		if($arCheck["Result"]) {$c_pu = 1;}
		else {$c_pu=0;}
		 
		if($c_pu) {
		if(isset($_GET['prom'])){
		CFormResult::SetField( $RESULT_ID, "promotion_1", array ($arAnswer['promotion_1'][0]['ANSWER_ID'] => $c_pu));//изменяем промоушен приглашения
		CFormResult::SetField( trim($ar_nz[$i]), "billingdate", array ($arAnswer['billingdate'][0]['ANSWER_ID'] => date("d.m.Y")));//вносим дату выставления счёта
		CFormResult::SetStatus($RESULT_ID, $status_opl, "Y"); // меняем статус заявки на Ожидает оплаты
		
		}
			$ar_table[]=array(
			'result_id'=>$RESULT_ID,
			'status'=>$status,
			'chk'=>$p_chk,
			'family'=>$p_family,
			'name'=>$p_name,
			'promotion_1'=>"1"
			);
		}
	}
}
//echo "<pre>";print_r($ar_ver);echo "</pre>";
$pli=count($ar_table);
}
?>
<div class="manager_scripts">
<div class="a_vozo"><a href="./">Все служебные обработчики</a><div id="sz"><div><img src="/images/registration_event/d.gif"></div></div></div>
<h2><?$APPLICATION->ShowTitle();?></h2>
<br/>
<div class="chte"><b>Страница проверки промоушен приглашения.</b> <span onclick="f_ps('txt2')"><u>Что это? >>></u></span><div id="txt2" class="txt" onclick="f_us('txt2')">
Данная страница использует для обработки результаты формы заявок на мероприятие "<?$APPLICATION->ShowTitle();?>".<br/>
 Кнопка "Проверить промоушен приглашения" проверяет промоушен у каждой заявки со статусом "Ожидает промоушен". Если промоушен приглашения положительный, заявка переводится в статус "Ожидает оплаты". В таблице выводятся результаты этого изменения статуса.
 <br/><br/><u>закрыть</u></div></div>

 <form>
 <div class="chte"><input class="buts" type="submit" name="prp" value="Предварительный просмотр" onclick="f_sz()"> <span onclick="f_ps('txt4')"><u>Что это? >>></u></span><div id="txt4" class="txt" onclick="f_us('txt4')">
 Кнопка "Предварительный просмотр" проверяет заявки у которых промоушен приглашения не пройден. В таблице выводятся результаты прверки с будущим результатом обработки. Изменение промоушена при этом не происходит.
 <br/><br/><u>закрыть</u></div></div>

 <input class="buts" type="submit" name="prom" value="Проверить промоушен приглашения" onclick="f_sz()"></form>
 <br/>
 

 <?if(isset($_GET['prom']) || isset($_GET['prp'])):?>
	 <?if($pli):?>
	 <?if(isset($_GET['prom'])){?> <div>Внесены изменения - <?=$pli?> шт.</div> <?}?>
	 <?if(isset($_GET['prp'])){?> <div>Будут внесены изменения - <?=$pli?> шт.</div> <?}?>
	 
	 <table class="tmbl">
	 <tr><th>№ заявки</th><th>Статус</th><th>№ ЧК</th><th>ФИО</th><th>Промоушен</th></tr>
	 <?for($i=0;$i<$pli;$i++):?>
		<?if($ar_table[$i]["promotion_1"]):?>
			<tr><td><?=$ar_table[$i]["result_id"]?></td><td><?=$ar_table[$i]["status"]?></td><td><?=$ar_table[$i]["chk"]?></td><td><?=$ar_table[$i]["family"]?></br><?=$ar_table[$i]["name"]?></td><td><?=$ar_table[$i]["promotion_1"]?></td></tr>
		<?endif?>
	 <?endfor?>
	 </table>
	 <?else:?>
	 <div>Нет изменений</div>
	 <?endif?>
 <?endif?>
 </div>
 <br/><br/> <br/><br/> <br/><br/> <br/><br/>
	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>