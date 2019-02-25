<style>
.conditions_list {
	 font-family: "HelveticaLight";
color:#333;
}
.conditions_list b{
	font-family: "HelveticaRegular"; 
	/*  font-family: "HelveticaBold"; */
}
.conditions_list .but_coli {
	width:400px;
	--height:30px;
	padding:10px 0px;
	/*color: #fff;*/
	font-size: 18px;
	text-align: center;
	background:#ececec;
	display:inline-block;
	border:solid 0px #ececec;
	cursor:pointer;
}
.conditions_list .but_coli:hover {
	text-decoration:underline;
}
.conditions_list .hed {
	text-align:center;
}
.conditions_list .active_but {
	color: #fff;
	background:#e9aa3c;
	cursor:default;
}
.conditions_list .active_but:hover {
	text-decoration:none;
}
#tab_2 {
	display:none;
}

.visa_text {
	width:920px;
	margin:auto;
	background-color:#fff;
	padding:20px;

  -moz-box-shadow:0px 0px 10px #000;
	-webkit-box-shadow:0px 0px 10px #000;
	box-shadow: 0px 0px 10px #000;
}

.accordion .ht1, .accordion .ht2{
	background: #e7e7e7 url(/images/arrow-square.gif) no-repeat right -51px;
	padding: 7px 15px;
	margin: 0 0 10px 0;
	border: solid 0px #c4c4c4;
	border-bottom: none;
	cursor: pointer;
}
.accordion .noi{
	background:#e7e7e7;
}
.accordion .ht1:hover, .accordion .ht2:hover {
	background-color: #e3e2e2;
}
.accordion .ht1.active, .accordion .ht2.active {
	background-position: right 5px;
}
.accordion .sete {

	margin: 0;
	padding: 10px 15px 20px;
	border-left: solid 0px #c4c4c4;
	border-right: solid 0px #c4c4c4;
}
.div_d {
	float:right;
	width:100px;
	height:30px;
	padding:5px 30px 5px 5px;
	border:solid 1px #ffc67a;
	margin:20px;
	text-align:center;
	color:#5a431f;
	background: url(/images/ico_d.png) no-repeat right top;
	line-height:30px;
}
.ff_romul {
	font-family: 'romul';
	font-size:22px;
}
.ff_hreg {
	font-family: "HelveticaRegular";
}
.ff_hlig {
	font-family: "HelveticaLight";
}
.conditions_list ul {
	margin-left:-40px;
}
</style>
<script>
$(document).ready(function(){
	$(".hed .but_coli").each(function (i) {
		$(".hed .but_coli:eq("+i+")").click(function(){
			var tab_id=i+1;
			$(".hed .but_coli").removeClass("active_but");
			$(this).addClass("active_but");
			$(".conditions_content .tab").stop(false,false).hide();
			$("#tab_"+tab_id).stop(false,false).show();
			return false;
		})
	});
	
	//$(".accordion h3:first").addClass("active");
	//$(".accordion p:not(:first)").hide();
	$(".accordion .sete").hide();

	$(".accordion .ht1, .accordion .ht2").click(function(){
		$(this).next(".sete").slideToggle("slow")
		.siblings(".sete:visible").slideUp("slow");
		$(this).toggleClass("active");
		$(this).siblings(".ht1, .ht2").removeClass("active");
	});
})
</script>
<div id="conditions_list" class="conditions_list" style="display:none; width:800px;padding:20px;">

<div class="hed">
	<div class="but_coli active_but">УСЛОВИЯ УЧАСТИЯ</div><div class="but_coli" style="">ОФОРМЛЕНИЕ ВИЗЫ</div>
</div>
<div class="div_d"><a href="files/mc_0216_111115.docx" class="" download><span >СКАЧАТЬ</span></a></div><br /><br />
<div class="conditions_content">

<div id="tab_1" class="tab">

<p class="ff_romul">
УСЛОВИЯ УЧАСТИЯ
</p>

<p>
	 <b>На «Мастерские каникулы» 2016 года приглашаются:</b>
</p>
<ul>
<li> <b>Мастера и выше</b>, поддерживающие ранг со сбалансированным сетевым объемом поколений от 20 000<!--<sub style="font-size:16px;">*</sub>--> баллов в месяц (за период с сентября 2015 года по декабрь 2015 года включительно).</li>
<li> <b>Новые Мастера</b>, выполнившие ранг Мастера со сбалансированным сетевым объемом поколений от 20 000<!--<sub style="font-size:16px;">*</sub>-->  баллов в месяц (за период с октября 2015 года по декабрь 2015 года включительно).</li>
</ul>
<p>
<!--
<sub style="font-size:16px;">*</sub> 
<span  style="font-size:11px;">Если контракт партнерский, то для участия обоих Мастеров сбалансированный сетевой объем поколений должен составлять 40 000 баллов в месяц за тот же период.<br />Сбалансированный сетевой объем поколений - это сетевой объем директоров (за исключением сильной ветви), соразмерный половине (или более) общего сетевого объема.</span>-->

</p>
<p>
	 В качестве признания компания выплачивает полную стоимость участия Мастерам, выполнившим условия промоушена.
<br />
	 Участники по желанию могут взять с собой одного члена семьи, предварительно оплатив полную стоимость его путевки.
</p>


<h3>
	 ПРОЦЕДУРА РЕГИСТРАЦИИ И ПРИЕМА ОПЛАТЫ
</h3>

<p>
	 Регистрация на «Мастерские каникулы» будет проводиться с 16 ноября 2015 года по 15 января 2016 года включительно.
</p>

<p>
	 <b>1. ЗАРЕГИСТРИРОВАТЬСЯ МОЖНО ДВУМЯ СПОСОБАМИ:</b>
</p>
<ul>
<li> <b> онлайн-регистрация на сайте компании;</b></li>
<li><b> регистрация в офисах продаж компании.</b> </li>
</ul>
</p>
<p class="zcol">
	 ОБРАТИТЕ ВНИМАНИЕ!
</p>
<p>
	 Все поля заявки являются обязательными для заполнения.
</p>

<ul type="disc" class="zcol"style="margin-left:-30px;">
<li>
	<span style="color:#333">Заполненная заявка означает, что вы ознакомлены с правилами регистрации, замены участников и штрафными санкциями в случае отказа.</span>
</li>

<li>
	 <span style="color:#333"> В случае если вы заполнили заявку на другого участника, это означает, что вы ознакомлены с правилами регистрации и обязуетесь ознакомить с ними зарегистрированного вами участника.</span>
</li>

<li>
	 <span style="color:#333"> Заявки подтверждаются после прохождения полной оплаты (данное условие распространяется на приглашенного родственника).</span>
</li>
<li>
	 <span style="color:#333">Оплатить участие приглашенного родственника необходимо в течение 10 рабочих дней после подачи заявки.
</li>
</ul>
<p>
	 <b>2. ОПЛАТА УЧАСТИЯ ДЛЯ ПРИГЛАШЕННЫХ РОДСТВЕННИКОВ ПРОИЗВОДИТСЯ СОГЛАСНО УКАЗАННОЙ В ВАШЕЙ ЗАЯВКЕ ФОРМЕ ОПЛАТЫ:</b>
</p>
<p>
</p>
<ul>
<li><b> наличными в офисах продаж;</b></li>
<li><b> в счет бонус-скидки (с чека).</b> </li>
</ul>
<p>
	 Эта форма оплаты разрешена только членам клуба рангом не ниже закрытого Мастера.
</p>

<p>
	 Рассрочка на данное мероприятие не предоставляется. Оплата должна быть произведена до 16 января 2016 года включительно.
</p>
<p>
	 Обратите внимание: с 16 ноября по 16 декабря 2015 года действует преференциальный период: для всех зарегистрировавшихся родственников предоставляется скидка 10%. Начиная с 17 декабря скидка не предоставляется.
</p>
<p>
	 Стоимость мероприятия для приглашенных родственников будет рассчитываться автоматически в национальной валюте по коммерческому курсу на текущий день при заполнении заявки на сайте компании.
</p>
<p>
	 Перед внесением оплаты за участие в мероприятии необходимо уточнить стоимость на день оплаты в вашем личном кабинете.
</p>

<p>
	 <b>3. ОТКАЗЫ ОТ УЧАСТИЯ В МЕРОПРИЯТИИ.</b>
</p>

<p>
	 Вы можете отказаться от участия в мероприятии до 16 декабря 2015 года (включительно) через сайт компании из личного кабинета заявителя, либо через менеджера по Skype: <a href="skype:eventcci">eventcci</a> или по электронной почте: <a href="mailto:manager_rio2@coral-club.com">manager_rio2@coral-club.com</a>.
</p>

<p>
	 В случае вашего немотивированного отказа от участия в мероприятии после 16 декабря 2015 года компания имеет право возложить на вас финансовые издержки, эквивалентные расходам, оплаченным поставщикам услуг по данной поездке.
</p>

<p>
	 В случае непрохождения промоушена финансовые издержки, понесенные вами на оформление поездки, не компенсируются.
</p>

<p>
	 Приглашенным гостям, не посетившим мероприятие по не зависящим от компании причинам, оплата за поездку не возвращается.
</p>

<p>
	 <b>4. В СТОИМОСТЬ ПОЕЗДКИ ВХОДИТ:</b>
</p>
<ul>
<li><b> Проживание в отеле InterСontinental Carlton Cannes</b>
<br />
Все участники и приглашенные ими гости будут проживать в отеле <a href="http://www.intercontinental-carlton-cannes.com/" target="_blank">InterСontinental Carlton Cannes</a> на базе завтраков в двухместных номерах Superior с боковым видом на море.
Для членов Президентского совета предусмотрено размещение в двухкомнатных номерах категории Suite с видом на море.
Для Золотых мастеров предусмотрены номера класса Deluxe с панорамным видом на море.

</li>
<li><b> Авиаперелет (эконом-класс);</b><br />
Если при регистрации на мероприятие в предложенном списке авиарейсов вы не нашли вариант вылета из вашего города, вам необходимо связаться с менеджером по организации мероприятий для подбора оптимального рейса либо сделать это самостоятельно.
В случае самостоятельного бронирования необходимо согласовать вариант перелета перед покупкой билета с менеджером по организации мероприятий по Skype: <a href="skype:eventcci">eventcci</a> или по электронной почте: <a href="mailto:manager_rio2@coral-club.com">manager_rio2@coral-club.com</a>.

</li>
<li><b>  Трансфер в/из аэропорта во Франции</b></li>
<li><b>  Консульский сбор и услуги визового центра(ВИЗА ОФОРМЛЯЕТСЯ САМОСТОЯТЕЛЬНО)</b></li>

<li><b>  Медицинская страховка для выезжающих за рубеж </b>

<br />
	 (медицинскую страховку для выезжающих за рубеж вы можете оформить при регистрации на мероприятие либо самостоятельно. Сумма покрытия страховки должна составлять не менее 30000 евро);
</li>
<li><b>  Участие в тренинге</b></li>
<li><b>  Участие в гала-ужине</b></li>
<li><b>  Участие в экскурсионно-развлекательной программе</b></li>
</ul>

	<b> 5. УСЛОВИЯ ВОЗВРАТА ДЕНЕЖНЫХ СРЕДСТВ УЧАСТНИКАМ ПРИ САМОСТОЯТЕЛЬНОМ ОФОРМЛЕНИИ ПОЕЗДКИ
<br />
	 (ЗА ИСКЛЮЧЕНИЕМ ПРОЖИВАНИЯ)</b>
</p>

<p>
	 Денежные средства, потраченные участниками на оформление поездки, будут возмещены в полном объеме при наличии подтверждающих документов, а именно:
</p>

<ul>
<li><b> авиабилета и чека об оплате;</b></li>
<li><b> чека за индивидуальный трансфер в/из аэропорта во Франции;</b></li>
<li><b> копии медицинской страховки для выезжающих за рубеж;</b></li>
<li><b> визовая поддержка: возмещение консульского сбора и услуг визового центра.</b></li>
</ul>
<p>
	 В случае возникновения любых вопросов вы можете обращаться к менеджеру отдела по организации мероприятий по Skype: <a href="skype:eventcci">eventcci</a> или по электронной почте: <a href="mailto:manager_rio2@coral-club.com">manager_rio2@coral-club.com</a>.
</p>



</div>
<div id="tab_2" class="tab accordion">
	<p class="ff_romul">
	 ОФОРМЛЕНИЕ  ШЕНГЕНСКОЙ ВИЗЫ
</p>

<p>
	 <b>Для поездки в Канны на «Мастерские каникулы» вам и вашим приглашенным родственникам необходимо получить шенгенскую визу, которую вы оформляете самостоятельно.</b>
</p>

<p>
	 Участникам конференции<sub style="font-size:16px;">*</sub> будут возвращены расходы, затраченные на оформление визы: услуги визового центра, консульский сбор и медицинская страховка для выезжающих за рубеж.
</p>

<p>
	 Для посещения стран шенгенского соглашения гражданам России и СНГ необходима виза. Правом безвизового въезда обладают граждане стран, входящих в состав шенгенской зоны.
</p>
<p>
	 <a href="visa_country.php">Список стран, для которых требуется шенгенская виза.</a>

</p>
<p>
<sub style="font-size:16px;">*</sub> Участники конференции <br />
<span  style="font-size:11px;">Мастера и выше, поддерживающие ранг со сбалансированным сетевым объемом поколения от 20 000 баллов в месяц (за период с сентября 2015 года по декабрь 2015 года включительно).<br />
Новые Мастера, выполнившие ранг Мастера со сбалансированным сетевым объемом поколения от 20 000 баллов в месяц (за период с октября 2015 года по декабрь 2015 года включительно).</span>

</p>
<Br>
<h3>
	 ПОШАГОВАЯ ИНСТРУКЦИЯ ДЛЯ ПОЛУЧЕНИЯ ВИЗЫ
</h3>
<p><b>1. ПОДГОТОВИТЬ КОМПЛЕКТ ДОКУМЕНТОВ ДЛЯ ПОЛУЧЕНИЯ ВИЗЫ.</b> </p>
<p>
	 На каждого участника готовится отдельный комплект документов, в том числе и на ребенка (данное условие не распространяется на детей, вписанных в паспорт родителей и путешествующих с ними)
</p>
<p class="ht1"><b>&#8226; Бланк визовой анкеты</b> </p>
<p class="sete">
	 <a href="blank_ankety.pdf" download>Анкета</a> заполняется на русском (в этом случае слова должны быть написаны латинскими буквами), национальном или английском языках и подписанная лично заявителем (<a href="obrazec_ankety.doc" download>пример заполнения анкеты</a>). На детей, вписанных в паспорт родителей, отдельная анкета не заполняется;
</p>
<p class="ht1"><b>&#8226; Загранпаспорт</b> </p>
<p class="sete">
	 Необходимо наличие загранпаспорта и копия страницы с фотографией и персональными данными. Паспорт должен иметь срок действия не менее 3-х месяцев после окончания срока запрашиваемой визы;
</p>
<p class="ht1 sete"><b>&#8226; Цветные фотографии 3,5 х 4,5 см (2 шт.)</b> </p>
<p class="sete">
	 Фотографии должны отвечать требованиям шенгена (уведомляете фотографа, что вам необходима фотография для получения визы во Францию);
</p>
<p class="ht1"><b>&#8226;  Бронь гостиницы и приглашение от французской стороны</b></p>
<p class="sete">
	 Бронь гостиницы и приглашение будет направлять менеджер по организации мероприятий индивидуально каждому участнику по электронной почте;
</p>
<p class="ht1"><b>&#8226;  Бронь авиабилетов:</b></p>
<p class="sete">
	 Если вы бронируете авиабилеты через компанию, бронь будет направлять менеджер по организации мероприятий индивидуально каждому участнику по электронной почте. Если вы бронируете самостоятельно, необходимо согласовать окончательный вариант перелета до покупки билета с менеджером отдела организации мероприятий по Skype: <a href="skype:eventcci">eventcci</a> или по электронной почте:&nbsp;<a href="mailto:manager_rio2@coral-club.com">manager_rio2@coral-club.com</a>;
</p>
<p class="ht1"><b>&#8226;  Медицинская страховка</b> </p>
<p class="sete">
	 Покрытие медицинской страховки, действующей во всех странах Европейского союза, составляет € 30 000. Страховой полис должен охватывать весь период пребывания (9 дней);
</p>

<p class="ht1"><b>&#8226; Копия внутреннего общегражданского паспорта</b> </p>
<p class="sete">
	 Копия всех страниц паспорта, содержащих информацию, или свидетельство о рождении (условие для приглашенного вами родственника моложе 14 лет);
</p>
<p class="ht1"><b>&#8226;  Подтверждение наличия у заявителя денежных средств для покрытия расходов, связанных с поездкой</b></p>
<p class="sete">
	 это может быть справка с места работы, выписка с банковского счета за последние 3 месяца на английском языке или кредитная карта (со справкой из банка о наличии средств на карте за последние 3 месяца на английском языке), из расчета не менее 50 евро в сутки на человека.<br /><br />
	 <span class="zcol">
	 ОБРАТИТЕ ВНИМАНИЕ!<br />
</span>

	 Деньги, зачисленные на карту накануне подачи заявления на визу, не будут подтверждать вашу финансовую состоятельность. Деньги (из расчета не менее 50 евро в сутки на человека) должны храниться на вашем счете не менее 3 месяцев до подачи заявления на визу в консульство.

</p>

<p class="ht1"><b>&#8226;  Спонсорское письмо:</b></p>
<p class="sete">

	 если денежных средств у заявителя недостаточно (из расчета не менее 50 евро в сутки на человека), необходимо предоставить спонсорское письмо на английском языке – это письменное обязательство ближайшего родственника (супруга, родителей, совершеннолетних детей или внуков, бабушек или дедушек) о покрытии расходов (<a href="sponsorskoe_pismo.docx" download>образец спонсорского письма</a>).<br /><br />
	 <span class="zcol">
	 К СПОНСОРСКОМУ ПИСЬМУ НЕОБХОДИМО ПРЕДОСТАВИТЬ:<br />
	</span>

  <br /><span class="zcol">&#8226;</span> копию первой страницы (с фотографией) паспорта спонсора;
  <br /><span class="zcol">&#8226;</span> подтверждение родственной связи заявителя со спонсором (свидетельство о рождении, браке и т.д.);
  <br /><span class="zcol">&#8226;</span> подтверждение доходов спонсора (справка с места работы, выписка с банковского счета, кредитные карты, из расчета 50 евро в сутки на человека);
  <br /><span class="zcol">&#8226;</span> бронь гостиницы;
  <br /><span class="zcol">&#8226;</span> бронь билетов в обе стороны. Если вы планируете бронировать билеты через компанию, необходимо в заявке на участие в мероприятии указать данную информацию;
  <br /><span class="zcol">&#8226;</span> если едет ребенок в сопровождении одного родителя, необходимо предоставить нотариально заверенное согласие на выезд ребенка, выданное не ранее чем за 3 месяца, от второго родителя.

</p>


<p>
	 <b>2. ЗАПИСАТЬСЯ НА ПОДАЧУ ДОКУМЕНТОВ В БЛИЖАЙШИЙ К ВАМ ВИЗОВЫЙ ЦЕНТР.</b>
</p>

<p>
	<b> 3. ПРИЙТИ В КОНСУЛЬСТВО В НАЗНАЧЕННОЕ ВРЕМЯ НА СДАЧУ ДОКУМЕНТОВ.</b>
</p>
<p>
	 Вам необходимо будет пройти биометрию (отпечатки пальцев и цифровая фотография).
</p>
<p>
	 Детям до 12 лет дактилоскопия (процедура снятия отпечатков пальцев) не требуется.
</p>
<p>
</p>
<p>
	 <b>4. ОПЛАТИТЬ КОНСУЛЬСКИЙ СБОР И УСЛУГИ ВИЗОВОГО ЦЕНТРА.</b>
</p>
<p>
	 Размер консульского сбора составляет 35 евро.
</p>
<p>
	 Для граждан Казахстана, Республики Беларусь и Узбекистана консульский сбор составляет 60 евро.
</p>
<p>
	 С детей до 6 лет консульский сбор не взимается.
</p>
<p>
	 Услуги визового центра: около 2000–2500 рублей.
</p>

<p>
	 <b>5. СРОК РАССМОТРЕНИЯ ДОКУМЕНТОВ, ПОДАННЫХ НА ОФОРМЛЕНИЕ ВИЗЫ, – 5–10 РАБОЧИХ ДНЕЙ.</b>
</p>

<p>
	 <b>6. ФИНАЛЬНЫЙ СРОК ПОДАЧИ ДОКУМЕНТОВ НА ВИЗУ – 15 ЯНВАРЯ 2016 ГОДА.</b>
</p>
</div>

</div>
</div>
 <br>