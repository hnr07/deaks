<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Список заявок");?> 
<? include "var_config.php"; ?>
<style>
.res_zf .chte {
position:relative;
z-index:100;
}
.res_zf .chte span{
cursor:pointer;
}
.res_zf .txt {
display:none;
width:520px;
padding:20px;
background-color:#fff;
border:solid 1px #c5c5c5;
position:absolute;
top:-200px;
left:300px;
z-index:100;
line-height: 16pt;
  -moz-box-shadow: 0 0 5px #56b146; /* Firefox */
-webkit-box-shadow: 0 0 5px #56b146; /* Safari, Chrome */
box-shadow: 0 0 5px #56b146; /* CSS3 */
}
</style>
<script>
function f_ps(d) {$("#"+d).fadeIn(500);}
function f_us(d) {$("#"+d).fadeOut(800);}
function f_fr(s) {
	if(s){
	$(".stat_opros").fadeOut(0);
	$(".fo_opros").fadeIn(200);
	$("#fr_1").fadeOut(0);
	$("#fr_2").fadeIn(200);
	}
	else {
	$(".fo_opros").fadeOut(0);
	$(".stat_opros").fadeIn(200);
	$("#fr_2").fadeOut(0);
	$("#fr_1").fadeIn(200);
	}
}
</script>
<br/><br/>
<div class="res_zf" style="">
<p>Дорогие друзья!<br/> <!--html-->
Спасибо, что зарегистрировались на мероприятие "<?=$title_m?>".<br/> <!--html-->
<!--
Для вашего удобства и безопасности личных данных компания Coral Club вводит систему учета членов клуба
с помощью «Смарт-карт CCI». <br/><a href="/ru/smart-cards/" style="color:#239b06;text-decoration:underline;">Пройдите по ссылке для регистрации «Смарт-карты CCI»</a></p>
-->
<br/><br/>
<a href="/<?=$lang?><?=$dir_event?>step_1.php"><img src="/news/imgs/button_gfg.png"></a>
<br/><br/>
<div class="chte"> <span onclick="f_ps('txt1')"><img src="/images/button_opros.png"></span><div id="txt1" class="txt">
<div align="right"><i><span id="fr_1" onclick="f_fr(1)" style="display:none;">форма</span> &nbsp;&nbsp;&nbsp; <span id="fr_2" onclick="f_fr(0)">результаты</span></i></div>
<div class="fo_opros">
 <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"",
	Array(
		"SEF_MODE" => "N",
		"WEB_FORM_ID" => "7",
		"LIST_URL" => "",
		"EDIT_URL" => "",
		"SUCCESS_URL" => "",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"VARIABLE_ALIASES" => Array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID"
		)
	)
);?> 
</div>
<?
if(CModule::IncludeModule("form")){ 
$FORM_ID = 7;
// фильтр по полям результата
	$arFilter = array();
		
		// фильтр по вопросам
$arFields = array();
	
			// выберем (первые) все результатов
	$rsResults = CFormResult::GETList($FORM_ID, 
		($by="s_timestamp"), 
		($order="desc"), 
		$arFilter, 
		$is_filtered, 
		"N",
		false);
		//echo"<pre>";print_r($rsResults);echo"</pre>";
		$vv=0;
	$vopros_1_1=0; $vopros_1_2=0; $vopros_1_3=0; $vopros_1_4=0; 
	$vopros_2_1=0; $vopros_2_2=0; $vopros_2_3=0; $vopros_2_4=0;
	$vopros_3_1=0; $vopros_3_2=0; $vopros_3_3=0; $vopros_3_4=0;
	while ($arResult = $rsResults->Fetch())
	{ 
	$RESULT_ID=$arResult['ID'];
	$arAnswer = CFormResult::GETDataByID(
	$RESULT_ID, 
	array('form_reg','udobno','design'),  // массив символьных кодов необходимых вопросов
	$ar_Res, 
	$ar_Answer2); 
	
	$form_reg=$arAnswer['form_reg'][0]['ANSWER_ID'];//543-546
		switch($form_reg) {
		case 543:$vopros_1_1++;break;
		case 544:$vopros_1_2++;break;
		case 545:$vopros_1_3++;break;
		case 546:$vopros_1_4++;break;
		}
		
	$udobno=$arAnswer['udobno'][0]['ANSWER_ID'];//547-550
		switch($udobno) {
		case 547:$vopros_2_1++;break;
		case 548:$vopros_2_2++;break;
		case 549:$vopros_2_3++;break;
		case 550:$vopros_2_4++;break;
		}
	$design=$arAnswer['design'][0]['ANSWER_ID'];//551-554
		switch($design) {
		case 551:$vopros_3_1++;break;
		case 552:$vopros_3_2++;break;
		case 553:$vopros_3_3++;break;
		case 554:$vopros_3_4++;break;
		}
	$vv++;
	}
$ro_1_1=round($vopros_1_1*100/$vv,1);
$ro_1_2=round($vopros_1_2*100/$vv,1);
$ro_1_3=round($vopros_1_3*100/$vv,1);
$ro_1_4=round($vopros_1_4*100/$vv,1);
$ro_2_1=round($vopros_2_1*100/$vv,1);
$ro_2_2=round($vopros_2_2*100/$vv,1);
$ro_2_3=round($vopros_2_3*100/$vv,1);
$ro_2_4=round($vopros_2_4*100/$vv,1);
$ro_3_1=round($vopros_3_1*100/$vv,1);
$ro_3_2=round($vopros_3_2*100/$vv,1);
$ro_3_3=round($vopros_3_3*100/$vv,1);
$ro_3_4=round($vopros_3_4*100/$vv,1);
}		
?>
<style>
.stat_opros div {
height:7px;
margin:8px 5px 0 5px;
}
.o1 {background:green;}
.o2 {background:Aquamarine;}
.o3 {background:RosyBrown;}
.o4 {background:Firebrick;}
.stat_opros .tr_t {
background-color:#ddf7dd;
}
</style>
<div class="stat_opros" style="display:none;">

<table>
<tr><th colspan="2" align="right">Обработано результатов &nbsp;&nbsp;&nbsp;</th><th><?=$vv?></th></tr>
<tr class="tr_t"><th colspan="3">Насколько Вам понравилась форма регистрации</th></tr>
<tr><th align="left">Очень понравилась</th><td width="300"><div class="o1"  style="width:<?=(3*$ro_1_1)?>px;">&nbsp;</div></td><td><?=$vopros_1_1?>(<?=$ro_1_1?>%)</td></tr>
<tr><th align="left">Понравилась</th><td><div class="o2"  style="width:<?=(3*$ro_1_2)?>px;">&nbsp;</div></td><td><?=$vopros_1_2?>(<?=$ro_1_2?>%)</td></tr>
<tr><th align="left">Не очень понравилась</th><td><div class="o3"  style="width:<?=(3*$ro_1_3)?>px;">&nbsp;</div></td><td><?=$vopros_1_3?>(<?=$ro_1_3?>%)</td></tr>
<tr><th align="left">Не понравилась</th><td><div class="o4"  style="width:<?=(3*$ro_1_4)?>px;">&nbsp;</div></td><td><?=$vopros_1_4?>(<?=$ro_1_4?>%)</td></tr>

<tr class="tr_t"><th colspan="3">Насколько Вам было удобно заполнять</th></tr>
<tr><th align="left">Очень удобно</th><td width="300"><div class="o1"  style="width:<?=(3*$ro_2_1)?>px;">&nbsp;</div></td><td><?=$vopros_2_1?>(<?=$ro_2_1?>%)</td></tr>
<tr><th align="left">Удобно</th><td><div class="o2"  style="width:<?=(3*$ro_2_2)?>px;">&nbsp;</div></td><td><?=$vopros_2_2?>(<?=$ro_2_2?>%)</td></tr>
<tr><th align="left">Не очень удобно</th><td><div class="o3"  style="width:<?=(3*$ro_2_3)?>px;">&nbsp;</div></td><td><?=$vopros_2_3?>(<?=$ro_2_3?>%)</td></tr>
<tr><th align="left">Не удобно</th><td><div class="o4"  style="width:<?=(3*$ro_2_4)?>px;">&nbsp;</div></td><td><?=$vopros_2_4?>(<?=$ro_2_4?>%)</td></tr>

<tr class="tr_t"><th colspan="3">Насколько Вам понравился дизайн формы</th></tr>
<tr><th align="left">Очень понравился</th><td width="300"><div class="o1"  style="width:<?=(3*$ro_3_1)?>px;">&nbsp;</div></td><td><?=$vopros_3_1?>(<?=$ro_3_1?>%)</td></tr>
<tr><th align="left">Понравился</th><td><div class="o2"  style="width:<?=(3*$ro_3_2)?>px;">&nbsp;</div></td><td><?=$vopros_3_2?>(<?=$ro_3_2?>%)</td></tr>
<tr><th align="left">Не очень понравился</th><td><div class="o3"  style="width:<?=(3*$ro_3_3)?>px;">&nbsp;</div></td><td><?=$vopros_3_3?>(<?=$ro_3_3?>%)</td></tr>
<tr><th align="left">Не понравился</th><td><div class="o4"  style="width:<?=(3*$ro_3_4)?>px;">&nbsp;</div></td><td><?=$vopros_3_4?>(<?=$ro_3_4?>%)</td></tr>
</table>
</div>
<br/>
<u><span onclick="f_us('txt1')" style="cursor:pointer;">закрыть</span></u></div></div>
<br/><br/>
<h2><?$APPLICATION->ShowTitle();?></h2>
<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.list.my", 
	"result_list_".$code_m, 
	array(
		"FORMS" => array(
			0 => "3",
			1 => "",
			2 => "",
		),
		"NUM_RESULTS" => "1000",
		"LIST_URL" => "my_result_list.php?WEB_FORM_ID=#FORM_ID#",
		"VIEW_URL" => "my_result_view.php?WEB_FORM_ID=#FORM_ID#&RESULT_ID=#RESULT_ID#",
		"EDIT_URL" => "edit_1.php?WEB_FORM_ID=#FORM_ID#&RESULT_ID=#RESULT_ID#",
		"COMPONENT_TEMPLATE" => "result_list_volna_0416"
	),
	false
);?> 
</div>
<?
if($_REQUEST["formresult"]="editok") {
$ar_Answer = CFormResult::GetDataByID(
	$_REQUEST["RESULT_ID"], 
	array(),  // массив символьных кодов необходимых вопросов
	$ar_Result, 
	$ar_Answer2);
	
//echo "<pre>";print_r($ar_Answer);echo "</pre>";
// Блок формирования значений для таблицы логирования

global $LOG_INFO;
CForm::GetDataByID($_REQUEST["WEB_FORM_ID"], 
    $form_i, 
    $questions_i, 
    $answers_i, 
    $dropdown_i, 
    $multiselect_i);

$arFile = CFormResult::GetFileByAnswerID($_REQUEST[RESULT_ID], $answers_i["p_scan"][0]["ID"]);
$arim=CFile::GetPath($arFile[USER_FILE_ID]);
//echo "<pre>";print_r($arim);echo "</pre>";

//echo $_REQUEST[RESULT_ID]." >> ".$answers["p_scan"][0]["ID"];

// массив описывающий загруженную на сервер фотографию
//$arImage = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/images/photo.gif");
//include "methods/request.php"; 
// массив значений ответов
global $USER;
$LOG_INFO["editor"]=$USER->GetFullName()."[".$USER->GetID()."]"; //Кто изменил
$LOG_INFO["time"]=date("Y.m.d H:i:s");// дата/время
$LOG_INFO["id_form"]=$_REQUEST["WEB_FORM_ID"];// id формы
$LOG_INFO["id_result"]=$_REQUEST["RESULT_ID"];// id заявки
$LOG_INFO["status"] = $ar_Answer["status"][0]['ANSWER_TEXT'];// статус участника
$LOG_INFO["kem_priglashen_chk"]=$ar_Answer['kem_priglashen_chk'][0][USER_TEXT]; //Кем приглашен - № ЧК
$LOG_INFO["kem_priglashen_name"]=$ar_Answer["kem_priglashen_name"][0][USER_TEXT]; //Кем приглашен - имя
$LOG_INFO["kem_priglashen_family"]=$ar_Answer["kem_priglashen_family"][0][USER_TEXT]; //Кем приглашен - фамилия
$LOG_INFO["chk"]=$ar_Answer["chk"][0][USER_TEXT]; //№ ЧК
$LOG_INFO["name"]=$ar_Answer["name"][0][USER_TEXT];// имя
$LOG_INFO["family"]=$ar_Answer["family"][0][USER_TEXT];  // Фамилия
$LOG_INFO["middle_name"]=$ar_Answer["middle_name"][0][USER_TEXT]; //отчество
$LOG_INFO["email"]=$ar_Answer["email"][0][USER_TEXT]; //E-mail
$LOG_INFO["tel"]=$ar_Answer["tel"][0][USER_TEXT]; //Телефон
$LOG_INFO["tel_2"]=$ar_Answer["tel_2"][0][USER_TEXT]; //Доп. телефон
$LOG_INFO["skype"]=$ar_Answer["skype"][0][USER_TEXT]; //Skype
$LOG_INFO["sex"] = $ar_Answer["sex"][0]['ANSWER_TEXT']; //Пол
$LOG_INFO["age"] = $ar_Answer["age"][0]['ANSWER_VALUE'];//Возраст
$LOG_INFO["country"]=$ar_Answer["country"][0][USER_TEXT]; //Гражданство
$LOG_INFO["city"]=$ar_Answer["city"][0][USER_TEXT]; //Город проживания
$LOG_INFO["region"]=$ar_Answer["region"][0][USER_TEXT]; //Область проживания
$LOG_INFO["prioritet"] = $ar_Answer["prioritet"][0]['ANSWER_TEXT'];//Предпочтительный вид связи
$LOG_INFO["birthday"]=$ar_Answer["birthday"][0][USER_TEXT];  //Дата рождения
$LOG_INFO["p_nal"] = $ar_Answer["p_nal"][0]['ANSWER_TEXT'];//Наличие загранпаспорта
$LOG_INFO["p_name"]=$ar_Answer["p_name"][0][USER_TEXT]; //Имя по загранпаспорту
$LOG_INFO["p_family"]=$ar_Answer["p_family"][0][USER_TEXT]; //Фамилия по загранпаспорту
$LOG_INFO["p_date"]=$ar_Answer["p_date"][0][USER_TEXT]; //Дата выдачи загранпаспорта
$LOG_INFO["p_due_date"]=$ar_Answer["p_due_date"][0][USER_TEXT]; //Действие загранпаспорта
$LOG_INFO["p_sn"]=$ar_Answer["p_sn"][0][USER_TEXT]; //Серия и номер загранпаспорта
$LOG_INFO["p_scan"]=$arim; //Скан загранпаспорта
$LOG_INFO["p_ready"]=$ar_Answer["p_ready"][0][USER_TEXT]; //Нет паспорта? Укажите дату
$LOG_INFO["p_viza"] = $ar_Answer["p_viza"][0]['ANSWER_TEXT'];//Оформление визы
$LOG_INFO["p_fly"] = $ar_Answer["p_fly"][0]['ANSWER_TEXT'];//Вариант перелета
$LOG_INFO["fly_1"] = $ar_Answer["fly_1"][0]['ANSWER_TEXT']; //Перелет туда
$LOG_INFO["fly_2"] = $ar_Answer["fly_2"][0]['ANSWER_TEXT'];//Перелёт обратно
$LOG_INFO["p_hotel"] = $ar_Answer["p_hotel"][0]['ANSWER_TEXT'];//Вариант проживания
$LOG_INFO["day_hotel_start"]=$ar_Answer["day_hotel_start"][0][USER_TEXT]; //Дата начала проживания
$LOG_INFO["day_hotel_finish"]=$ar_Answer["day_hotel_finish"][0][USER_TEXT]; //Дата окончания проживания
$LOG_INFO["hotel"] = $ar_Answer["hotel"][0]['ANSWER_TEXT'];//Отель
$LOG_INFO["nomer"] = $ar_Answer["nomer"][0]['ANSWER_TEXT'];//Номер
$LOG_INFO["p_transfer"] = $ar_Answer["p_transfer"][0]['ANSWER_TEXT'];//Трансфер
$LOG_INFO["hotel_frend"]=$ar_Answer["hotel_frend"][0][USER_TEXT]; //ФИО соседа по номеру
$LOG_INFO["d_konf"] = $ar_Answer["d_konf"][0]['ANSWER_TEXT'];//Участие в конференции
$LOG_INFO["d_ujin"] = $ar_Answer["d_ujin"][0]['ANSWER_TEXT']; //Участие в гала ужине
$LOG_INFO["d_futbolka"] = $ar_Answer["d_futbolka"][0]['ANSWER_TEXT'];//Футболка
$LOG_INFO["medical_insurance"] = $ar_Answer["medical_insurance"][0]['ANSWER_TEXT'];//Медицинская страховка
$LOG_INFO["d_vopros_1"] = $ar_Answer["d_vopros_1"][0]['ANSWER_TEXT'];//Один запасной вопрос
$LOG_INFO["d_vopros_2"] = $ar_Answer["d_vopros_2"][0]['ANSWER_TEXT'];//Второй запасной вопрос
$LOG_INFO["oplata"] = $ar_Answer["oplata"][0]['ANSWER_TEXT'];//Форма оплаты
$LOG_INFO["pl_chk"]=$ar_Answer["pl_chk"][0][USER_TEXT]; //№ ЧК плательщика
$LOG_INFO["pl_name"]=$ar_Answer["pl_name"][0][USER_TEXT]; //Имя плательщика
$LOG_INFO["pl_family"]=$ar_Answer["pl_family"][0][USER_TEXT]; //Фамилия плательщика
$LOG_INFO["pl_phone"]=$ar_Answer["pl_phone"][0][USER_TEXT]; //№ телефона плательщика
$LOG_INFO["op_country"]=$ar_Answer["op_country"][0][USER_TEXT]; //Страна
$LOG_INFO["op_city"]=$ar_Answer["op_city"][0][USER_TEXT]; //Город
$LOG_INFO["op_nof"]=$ar_Answer["op_nof"][0][USER_TEXT]; //№ Офиса продаж
$LOG_INFO["time_money_chk"] = $ar_Answer["time_money_chk"][0]['ANSWER_TEXT'];//Рассрочка для чека
$LOG_INFO["time_money_op"] = $ar_Answer["time_money_op"][0]['ANSWER_TEXT'];//Рассрочка для ОП
$LOG_INFO["partner"]=$ar_Answer["partner"][0][USER_TEXT]; //Партнёр
$LOG_INFO["pl_ok"]=$ar_Answer["pl_ok"][0][USER_TEXT]; //Проверка плательщика 
$LOG_INFO["garant_chk"]=$ar_Answer["garant_chk"][0][USER_TEXT]; //№ ЧК гаранта
$LOG_INFO["garant_name"]=$ar_Answer["garant_name"][0][USER_TEXT]; //Имя гаранта
$LOG_INFO["garant_family"]=$ar_Answer["garant_family"][0][USER_TEXT]; //Фамилия гаранта
$LOG_INFO["garant_ok"]=$ar_Answer["garant_ok"][0][USER_TEXT]; //Проверка гаранта
$LOG_INFO["pl_ok_id"]=$ar_Answer["pl_ok_id"][0][USER_TEXT]; //код проверки плательщика
$LOG_INFO["garant_ok_id"]=$ar_Answer["garant_ok_id"][0][USER_TEXT]; //код проверки гаранта
$LOG_INFO["currency"]=$ar_Answer["currency"][0][USER_TEXT]; //Валюта заявки
$LOG_INFO["currency_id"]=$ar_Answer["currency_id"][0][USER_TEXT]; //ID валюты заявки
$LOG_INFO["money"]=$ar_Answer["money"][0][USER_TEXT]; //Стоимость мероприятия в у. е.
$LOG_INFO["money_2"]=$ar_Answer["money_2"][0][USER_TEXT]; //Стоимость в Вашей валюте
$LOG_INFO["t_money"]=$ar_Answer["t_money"][0][USER_TEXT]; //Оплачено в базовой валюте
$LOG_INFO["t_money_2"]=$ar_Answer["t_money_2"][0][USER_TEXT]; //Оплачено в Вашей валюте
$LOG_INFO["sum_debt"]=$ar_Answer["sum_debt"][0][USER_TEXT]; //Сумма задолженности
$LOG_INFO["date_endpay"]=$ar_Answer["date_endpay"][0][USER_TEXT]; //Дата последнего платежа
$LOG_INFO["billingdate"]=$ar_Answer["billingdate"][0][USER_TEXT]; //Дата выставления счёта
$LOG_INFO["claimdate"]=$ar_Answer["claimdate"][0][USER_TEXT]; //Дата поступления заявки
$LOG_INFO["discount"]=$ar_Answer["discount"][0][USER_TEXT]; //Скидка %
$LOG_INFO["markup"]=$ar_Answer["markup"][0][USER_TEXT]; //Наценка %
$LOG_INFO["plus"]=$ar_Answer["plus"][0][USER_TEXT]; //Наценка
$LOG_INFO["minus"]=$ar_Answer["minus"][0][USER_TEXT]; //Скидка
$LOG_INFO["money_calc"]=$ar_Answer["money_calc"][0][USER_TEXT]; //Калькуляция стоимости мероприятия в у. е.
$LOG_INFO["money_2_calc"]=$ar_Answer["money_2_calc"][0][USER_TEXT]; //Калькуляция стоимости мероприятия в нац. валюте
$LOG_INFO["expired"]=$ar_Answer["expired"][0][USER_TEXT]; //Истёк срок оплаты
$LOG_INFO["proverka"]=$ar_Answer["proverka"][0][USER_TEXT]; //Проверка пройдена
$LOG_INFO["dr_bd"]=$ar_Answer["dr_bd"][0][USER_TEXT]; //Дата рождения из БД
$LOG_INFO["em_bd"]=$ar_Answer["em_bd"][0][USER_TEXT]; //e-mail из БД
$LOG_INFO["promotion_1"]=$ar_Answer["promotion_1"][0][USER_TEXT]; //Промоушен приглашение
$LOG_INFO["promotion_3"]=$ar_Answer["promotion_3"][0][USER_TEXT]; //Промоушен оплата
$LOG_INFO["m_course"]=$ar_Answer["m_course"][0][USER_TEXT]; //Выбор курса валют
$LOG_INFO["comments"]=$ar_Answer["comments"][0][USER_TEXT]; //Комментарий
$LOG_INFO["comments_admin"]=$ar_Answer["comments_admin"][0][USER_TEXT]; //Комментарий администратора
$LOG_INFO["guest_card"]=$ar_Answer["guest_card"][0][ANSWER_TEXT]; //Гостевая карта
$LOG_INFO["copy"]=$ar_Answer["copy"][0][USER_TEXT]; //Копия
}

?>

<?include "logging.php"?>
<br /><br /><br /><br /><br />
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>