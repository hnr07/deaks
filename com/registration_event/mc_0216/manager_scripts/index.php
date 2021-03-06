<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
 include "../var_config.php"; 
 global $USER;
if(!in_array($group_id, $USER->GetUserGroupArray())) echo "<meta http-equiv=\"refresh\" content=\"0;url=/\" />";
$APPLICATION->SetTitle($title_m);
?> 

<link rel="stylesheet" type="text/css" href="/css/manager_scripts.css" />
<script type="text/javascript" src="/js/manager_scripts/manager_scripts.js"></script>

<br/>



<div class="manager_scripts">
<h2><?$APPLICATION->ShowTitle();?></h2> <br/>
<h2><i>Служебные обработчики результатов формы.</i></h2>

<!--<div class="chte"><b><a href="status_prom_edit.php">Страница проверки промоушен приглашения.</a></b> <span onclick="f_ps('txt1')"><u>Что это? >>></u></span><div id="txt1" class="txt" onclick="f_us('txt1')">
Данная страница используется для обработки результаты формы заявок на мероприятие "<?$APPLICATION->ShowTitle();?>".<br/>
 Кнопка "Проверить промоушен приглашения" проверяет промоушен у каждой заявки со статусом "Ожидает промоушен". Если промоушен приглашения положительный, заявка переводится в статус "Ожидает оплаты". В таблице выводятся результаты этого изменения статуса.
 <br/><br/><u>закрыть</u></div></div>-->

<div class="chte"><b><a href="iz.php">Страница проверки сроков оплаты.</a></b> <span onclick="f_ps('txt2')"><u>Что это? >>></u></span><div id="txt2" class="txt" onclick="f_us('txt2')">
Данная страница используется для обработки результаты формы заявок на мероприятие "<?$APPLICATION->ShowTitle();?>".<br/>
 Кнопка "Изменить статус" проверяет заявки со статусом "Ожидает оплаты" и "Ожидает промоушен". Если сумма оплаты в базовой валюте равна нулю или меньше, заявка переводится в статус "Истёк срок оплаты". В таблице выводятся результаты этого изменения статуса.
 <br/><br/><u>закрыть</u></div></div>
 
 <div class="chte"><b><a href="iz_otm.php">Страница проверки заявок с истёкшим сроком оплаты.</a></b> <span onclick="f_ps('txt3')"><u>Что это? >>></u></span><div id="txt3" class="txt" onclick="f_us('txt3')">
Данная страница используется для обработки результаты формы заявок на мероприятие "<?$APPLICATION->ShowTitle();?>".<br/>
 Кнопка "Изменить статус" проверяет заявки со статусом "Истёк срок оплаты". Если дата выставления этого статуса более семи дней от текущей даты и если сумма оплаты в базовой валюте равна нулю или меньше, заявка переводится в статус "Отменена", если сумма оплаты в базовой валюте больше нуля, заявка переводится в предыдущий статус. В таблице выводятся результаты этого изменения статуса.
 <br/><br/><u>закрыть</u></div></div>

 <!-- <div class="chte"><b><a href="<?=$dir_event?>manager_scripts/edit_key_0.php">Страница сброса ключа изменения.</a></b> <span onclick="f_ps('txt6')"><u>Что это? >>></u></span><div id="txt6" class="txt" onclick="f_us('txt6')">
Данная страница используется для обработки результаты формы заявок на мероприятие "<?$APPLICATION->ShowTitle();?>".<br/>
 Кнопка "Сбросить ключ" изменяет поле заявки "Ключ изменения"(key_edit) на "0". При этом значении ключа изменения, заявка учавствуют в передаче данных в базу.
 <br/><br/><u>закрыть</u></div></div> -->
 
   <div class="chte"><b><a href="n_status.php">Страница группового изменения статусов.</a></b> <span onclick="f_ps('txt8')"><u>Что это? >>></u></span><div id="txt8" class="txt" onclick="f_us('txt8')">
Данная страница используется для обработки результаты формы заявок на мероприятие "<?$APPLICATION->ShowTitle();?>".<br/>
Кнопка "Изменить статус" изменяет статус заявки(-ок) по заданному фильтру.
 <br/><br/><u>закрыть</u></div></div>

<!-- <div class="chte"><b><a href="<?=$dir_event?>manager_scripts/billingdate.php">Страница правки даты выставления счёта.</a></b> <span onclick="f_ps('txt9')"><u>Что это? >>></u></span><div id="txt9" class="txt" onclick="f_us('txt9')">
Данная страница используется для обработки результаты формы заявок на мероприятие "<?$APPLICATION->ShowTitle();?>".<br/>
Кнопка "Править дату выставления счёта" в заявках, у которых нет даты выставления счёта или дата выставления счета меньше, чем дата поступления заявки записывает в поле заявки "Дата выставления счёта"(billingdate) значение поля "Дата поступления заявки"(claimdate). Заявка учавствуют в передаче данных в базу. Заявка без даты поступления в автоматическом режиме не изменяется т. к. требуется индивидуальное решение. Фильтр позволяет ограничить изменения по статусу заявки и/или по номеру(id).
 <br/><br/><u>закрыть</u></div></div> -->
 
   <div class="chte"><b><a href="debt_auto_mail.php">Страница проверки задолженности по оплате и отправке оповещений.</a></b> <span onclick="f_ps('txt11')"><u>Что это? >>></u></span><div id="txt11" class="txt" onclick="f_us('txt11')">
Данная страница проверяет заявки со статусом "Ожидает оплаты", "Ожидает промоушен" и "Истёк срок оплаты" мероприятия "<?$APPLICATION->ShowTitle();?>". При неполной оплате заявки список выводится в таблицу. Должникам автоматически ежедневно в 5:00 отправляется письмо - напоминание. Вручную немедленную отправку можно запустить кнопкой "Отправить письмо". При ручной отправке действует фильтр "Исключить из обработки". <br/>
 <br/><br/><u>закрыть</u></div></div>
 
  <br />
 <h2><i>Работа с валютами мероприятия.</i></h2>
 
  <div class="chte"><b><a href="currency_list.php">Страница списка используемых валют.</a></b> <span onclick="f_ps('txt4')"><u>Что это? >>></u></span><div id="txt4" class="txt" onclick="f_us('txt4')">
Данная страница выводит список используемых валют на мероприятии "<?$APPLICATION->ShowTitle();?>".<br/>
 Позволяет добавить новую валюту и изменить существующую. Также на этой странице выбирается базовая валюта мероприятия.
 <br/><br/><u>закрыть</u></div></div>
 
   <div class="chte"><b><a href="currency_course.php">Страница курсов валют.</a></b> <span onclick="f_ps('txt5')"><u>Что это? >>></u></span><div id="txt5" class="txt" onclick="f_us('txt5')">
Данная страница выводит список курсов валют для мероприятия "<?$APPLICATION->ShowTitle();?>".<br/>
 Позволяет добавить новый курс для любой валюты.
 <br/><br/><u>закрыть</u></div></div>
 
 <br />
 <h2><i>Информационные обработчики результатов формы.</i></h2>

<div class="chte"><b><a href="user_email.php">Конструктор сообщений.</a></b> <span onclick="f_ps('txt7')"><u>Что это? >>></u></span><div id="txt7" class="txt" onclick="f_us('txt7')">
Данная страница позволяет отправить сообщения участникам мероприятия "<?$APPLICATION->ShowTitle();?>".<br/>
 Выбрать адресатов можно по статусу заявки и/или по номерам заявок. В текст сообщения можно включить индивидуальные данные из заявки.
 <br/><br/><u>закрыть</u></div></div>
 
  <div class="chte"><b><a href="user_status_email.php">Отправка сообщений по существующим шаблонам.</a></b> <span onclick="f_ps('txt12')"><u>Что это? >>></u></span><div id="txt12" class="txt" onclick="f_us('txt12')">
Данная страница позволяет отправить сообщения участникам мероприятия "<?$APPLICATION->ShowTitle();?>".<br/>
 Выбрать адресатов можно по статусу заявки и/или по номерам заявок. Сообщение формируется индивидуально для каждого участника по уже существующему шаблону.
 <br/><br/><u>закрыть</u></div></div>
 
 <div class="chte"><b><a href="chk_promotion.php">Страница проверки члена клуба.</a></b> <span onclick="f_ps('txt10')"><u>Что это? >>></u></span><div id="txt10" class="txt" onclick="f_us('txt10')">
Данная страница позволяет проверить ЧК для возможности участия на мероприятии "<?$APPLICATION->ShowTitle();?>".<br/>
 <br/><br/><u>закрыть</u></div></div>
 

 
</div>

 <br/><br/> <br/><br/> <br/><br/> <br/><br/> <br/><br/> <br/><br/> 
	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>