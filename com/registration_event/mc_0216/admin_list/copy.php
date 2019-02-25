<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Копирование заявки");
?>
<?include "../var_config.php"; ?>
<style>
.dib {
border:solid 0px #b2b2b2;
	background-color:#fff;
	/*background-image: linear-gradient(#e2e2e2, #fff 100px);*/
	-moz-box-shadow:0px 0px 10px #000;
	-webkit-box-shadow:0px 0px 10px #000;
	box-shadow: 0px 0px 10px #000;
	border-radius:0px;
	margin-top:40px;

	padding:0px 20px;
	}
</style>
<?  CModule::IncludeModule('form'); // подключаем модуль форма ?>
<br /><br />
<div class="dib">
<h2>
Страница копирования заявки.
</h2>
<p>
Страница создает копию предложенной заявки от Вашего имени. Заявка-оригинал переводится в статус "Отменена".<br>
В заявке-копии поля оплаты доступны для редактирования при первом редактировании.<br>
При последующих редактированиях заявки доступность полей оплаты регламентируется на общем основании. 

</p>
<p><a href="index.php">Админ-лист >>></a></p>
<br /><br /><br />
<?if(isset($_GET['copy_id'])){?>
<?
$RESULT_ID=$_GET['copy_id'];
$ar_Answer = CFormResult::GETDataByID(
	$RESULT_ID, 
	array(),  // массив символьных кодов необходимых вопросов
	$ar_Res, 
	$ar_Answer2);
	//echo "<pre>";print_r($ar_Res);echo "</pre>";
	//echo "<pre>";print_r($arAnswer);echo "</pre>";
	
	?>
	<?
	//if($ar_Res['STATUS_ID']!=$status_del) {
	$arValues = CFormResult::GetDataByIDForHTML($RESULT_ID, "Y");
	//echo "<pre>";print_r($arValues);echo "</pre>";
	
	?>
	<?
// ID веб-формы
$FORM_ID = $ar_Res['FORM_ID'];

// массив описывающий загруженную на сервер фотографию
//$arImage = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/images/photo.gif");



// создадим новый результат

if ($NEW_RESULT_ID = CFormResult::Add($FORM_ID, $arValues))
{
	echo "Копируем заявку № ".$RESULT_ID."...<br>";
    echo "Заявка № ".$NEW_RESULT_ID." успешно создана  в форме #".$ar_Res['FORM_ID']." - ".$ar_Res['NAME']."<br>";
	CFormResult::SetField( $NEW_RESULT_ID, "history_status", array ($ar_Answer['history_status'][0]['ANSWER_ID'] => "Копия №".$RESULT_ID." - ".date("Y.m.d H:i:s")));// Записываем изменение статуса в историю
	CFormResult::SetField( $NEW_RESULT_ID, "key_edit", array ($ar_Answer['key_edit'][0]['ANSWER_ID'] => "0"));// изменяем Ключ редактирования
    CFormResult::SetField( $NEW_RESULT_ID, "copy", array ($ar_Answer['copy'][0]['ANSWER_ID'] => "1"));// изменяем Ключ копирования		
	CFormResult::SetStatus($RESULT_ID, $status_del,"N");
	echo "Заявка № ".$RESULT_ID." переведена в статус \"Отменена\"<br>";
	CFormResult::SetStatus($NEW_RESULT_ID, $ar_Res['STATUS_ID'],"N");
	echo "Заявка № ".$NEW_RESULT_ID." переведена в статус ".$ar_Res['STATUS_TITLE']."<br>";

echo "<p><a href='result_edit_1.php?RESULT_ID=".$NEW_RESULT_ID."&WEB_FORM_ID=".$FORM_ID."'>Редактировать заявку № ".$NEW_RESULT_ID." >>></a></p>";
	/*
	// массив значений ответов
global $USER;
$LOG_INFO["editor"]=$USER->GetFullName()."[".$USER->GetID()."]"; //Кто изменил
$LOG_INFO["time"]=date("Y.m.d H:i:s");// дата/время
$LOG_INFO["id_form"]=$ar_Res['FORM_ID'];// id формы
$LOG_INFO["id_result"]=$NEW_RESULT_ID;// id заявки
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
$LOG_INFO["copy"]="Копия №".$RESULT_ID; //Копия	

include "logging.php";
global $ar_manager;

global $USER;	
	if ($USER->IsAdmin()) {
		if(in_array($USER->GetID(), $ar_manager)) CFormResult::SetStatus($RESULT_ID_LOG, 40,"Y"); //Изменено менеджером
		else CFormResult::SetStatus($RESULT_ID_LOG, 41,"Y"); // Изменено админом
	}
	*/
	}

	else
	{
		global $strError;
		echo $strError;
	}
//}
//else echo "Заявки в статусе \"Отменена\" копировать запрещено.";
?>
<?}?>
<br />
</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>