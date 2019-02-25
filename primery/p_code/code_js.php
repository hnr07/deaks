		//Проверка подключения jQuery
	/*
	if (window.jQuery) alert("Библиотека jQuery подключена");
    else alert("Библиотека jQuery не подключена");
  */

  // массив обрабатываемых полей
	var ar_epo = [
	
	"status",					// Статус
	"chk",							// №ЧК
	"family",						// Фамилия
	"name",							// Имя
	"kem_priglashen_chk",			// Кем приглашен - №ЧК
	"kem_priglashen_family",		// Кем приглашен - Фамилия
	"kem_priglashen_name",			// Кем приглашен - Имя
	
	"email",						// E-mail
	"tel",							// Телефон
	"skype",						// Скайп
	"tel_2",						// Доп. телефон
	"sex",							// Пол
	"birthday",						// Дата рождения
	"age",							// Возраст 
	//"country",						// Гражданство
	"city",							// Город проживания
	
	"oplata",						// Форма оплаты
	"op_country",					// Страна Офиса продаж
	"op_city",						// Страна Офиса продаж
	"op_nof",		 				// Страна Офиса продаж
	"pl_chk",						// ЧК плательщика
	"pl_name",						// Имя плательщика
	"pl_family",					// Фамилия плательщика
	"pl_phone",						// № телефона плательщика
	"pl_ok",						// Проверка плательщика
	"garant_chk",					// ЧК гаранта
	"garant_name",					// Имя гаранта
	"garant_family",				// Фамилия гаранта
	"garant_ok",					// Проверка гаранта
	
	"p_nal",						// Наличие загранпаспорта
	"p_name",						// Имя по загранпаспорту
	"p_family",						// Фамилия по загранпаспорту
	"p_date",						// Дата выдачи загранпаспорта
	"p_due_date",					// Действие загранпаспорта
	//"p_sn",						 	// Серия и номер загранпаспорта
	"p_sp",						 	// Серия загранпаспорта
	"p_np",						 	// Номер загранпаспорта
	"p_ready",						// Нет паспорта? Укажите дату
	"p_viza",						// Оформление визы
	
	"ip_sp",						// Серия Удостоверения личности
	"ip_np",						// Номер Удостоверения личности
	"ip_ready",						// Нет Удостоверения личности? Укажите дату
	/*
	"p_hotel",						// Вариант проживания
	"d_leader_ship", 				// Участие в Leader Ship
	"s_leader_ship",  				// Соучастие в Leader Ship
	"day_hotel_start",				// Дата начала проживания
	"day_hotel_finish",  			// Дата окончания проживания
	"hotel",  						// Отель
	"nomer",						// Номер
	"day_hotel_start_ls",  			// Дата начала проживания на Leader Ship
	"day_hotel_finish_ls",  		// Дата окончания проживания на Leader Ship
	"hotel_ls",						// Отель на Leader Ship
	"nomer_ls",  	 				// Номер  на Leader Ship
	"medical_insurance",  			// Медицинская страховка
	"guest_card",					// Гостевая карта
	"p_fly",  						// Вариант перелета
	"fly_1",  						// Перелет туда
	"fly_2",						// Перелет обратно
	"p_transfer",  					// Транcфер
	*/
	"d_konf",  						// Участие в форуме
	"d_ujin",						// Участие в гала ужине
	"d_eat_2",  					// Питание на форуме
	"d_eat_1", 						// Питание в гостинице
	"d_futbolka",					// Размер футболки
	"interpretation",  	 			// Синхронный перевод
	"interpretation_lang",  		// Выберите язык для синхронного перевода
	"second_interpretation_lang", 	// Дополнительный язык для синхронного перевода
	"mesto",						// Место
	"d_vopros_1",					// Один запасной вопрос
	"venue",					    // Площадка
	"id_venue",					    // ID площадки
	
];
  
$(document).ready(function(){

$("form").click(function(){sub_but();});
$("form").keyup(function(){sub_but();});
$("form").mouseup(function(){sub_but();});
$("form .cont_but").mouseenter(function(){sub_but();});
$("form input").bind("hastext",function(){sub_but();});
$("form input").bind("notext",function(){sub_but();});

// комментарий к полю
	$(".qm").hover(function() {
	$(this).children(".qm_text").css("display","block");
	$(this).children(".qm_text").animate({opacity:1,left:"-=5",top:"-=5"},800);
	}, function() {
	$(this).children(".qm_text").css("display","none");
	$(this).children(".qm_text").stop(true,true); 
	$(this).children(".qm_text").animate({opacity:0,left:"+=5",top:"+=5"},0);
	});

// Предварительные настройки формы

// Построение графика шагов
var ww=170; var ws;
var forpa =$("#t_step").val();
if(forpa==6) ws=ww;
else ws=ww/2;
$(".grafik .prok").css("width",(ww*forpa-ws)+"px");
for(var i=0;i&lt;forpa;i++) {$(".grafik .circ:eq("+i+")").addClass("circ_ps");}

/*
// Обработка поля возраст
	if(far_epo("age")) {
		if($("#hiscer").val()=="0" || $("#hiscer").val()=="1") {
			$("#ag_3 input").attr("checked","checked");
			$("#ti_blo_age").css("display","none");
		}
		if($("#hiscer").val()=="2") {
			$("#ti_blo_age").css("display","block");
		}
	}
*/

// Обработка поля Оформление визы
	if(far_epo("p_viza")) {
		var cot=$("#fld_country").val();
		var yes_visa=$("#yes_visa").val();
		var yes_visa_m=$("#yes_visa_m").val();
		var not_visa=$("#not_visa").val();

		//var ivi=not_visa.indexOf(cot);         //есть ли выбранная страна в списке безвизовых
		var ivi=yes_visa.indexOf(cot);         //есть ли выбранная страна в списке визовых

		if(ivi==-1) {$("#ti_blo_p_viza #p_viza_2 input").attr ("checked", true);$("#p_viza_1").css ("display", "none");$("#p_viza_0").css ("display", "none");$("#ti_blo_p_viza .not_f").css ("display", "none");}
		else {$("#p_viza_2").css ("display", "none");$("#ti_blo_p_viza .not_f").css ("display", "block");}
	}

luch();
	
sub_but();
});
  
 // Функция проверки наличия элемента на странице
jQuery.fn.exists = function() {
   return $(this).length;
}
  
// функция проверки наличия и активности полей и подключения полей к проверке
  function far_epo(p) {
  		if($.inArray(p, ar_epo)==-1) return false;
		else {
		if($('#ti_blo_'+p).exists()) return true;
		else return false;
		}
}
//////////////////////////////////////////////////////

// функция проверки полей на заполненность
function polto_rth(pto) {
	if($("#ti_blo_"+pto+" select").attr("id")=="sel_"+pto) {
		t=$("#ti_blo_"+pto+" option:selected").val();
	}
	else {
		var type=$("#ti_blo_"+pto+" input").attr("type");
		//alert(type);
		if(type=="text" || type=="hidden") {
			t=$("#ti_blo_"+pto+" input:"+type+":eq(0)").val();
		}
		if(type=="radio") {
			t=$("#ti_blo_"+pto+" input:radio").filter(":checked").val();
		}
	}
return t;
}

// функция проверки даты на валидность
function valid_date(strd, fbd) {
	// если fbd=true - не наступившая дата считается ошибочной
	var str=polto_rth(strd);
	var str2;
	str2=str.split(".");
	str2=str2[2] +'-'+ str2[1]+'-'+ str2[0];
	var dap=new Date(str2);
	
	if(dap=='Invalid Date' || (fbd && dap.getTime()&gt;(new Date()).getTime())) return false;
	else return true;
}
//////////////////////////////////////////////////

// функция проверки полей с учётом условий
function pro_su() {
//регулярные выражения
var reg_chk = /^[0-9]{6,7}$/;   //  номер - только 6-7 цифр 
var reg_fio = /^[a-zA-Zа-яА-Я-_Ёё ]+$/;   // только буквы, пробел и дефис - кирилица, латынь
var reg_mail =/^[a-zA-Z0-9][-\._a-zA-Z0-9]+@[\w-\._]+\.\w{2,4}$/i;//var reg_mail =/^\w+@\w+\.\w{2,4}$/i;
var reg_phone = /^[0-9-)(+ ]+$/;  // телефон - цифры скобки плюс дефис пробел

var po=0; // индикатор ошибок
var po_tx=""; // текст ошибок
var rdl="\r\n &lt;br&gt;"; // разделитель 

var sel;var hisel_0;var hisel_1;var hisel_2;
var do_0;var do_1;var do_2;var do_3;

// проверка Площадка
if(far_epo("venue")) if(!polto_rth("venue")) po_tx+=erp("venue")+rdl;

// проверка поля Статус 
if(far_epo("status")) if(!polto_rth("status")) po_tx+=erp("status")+rdl;


// проверка полей по выбору поля Статус 
sel=$("#ti_blo_status input:radio").filter(":checked").val();
hisel_0=$("#ti_blo_status input:radio:eq(0)").val();
hisel_1=$("#ti_blo_status input:radio:eq(1)").val();
hisel_2=$("#ti_blo_status input:radio:eq(2)").val();
	if(sel) {
		if(sel==hisel_0) { // выбран статус "Участник"
		
			// проверка поля №ЧК
			if(far_epo("chk")) if(!reg_chk.test(polto_rth("chk"))) po_tx+=erp("chk")+rdl;

			// проверка поля Фамилия
			if(far_epo("family")) if(!reg_fio.test(polto_rth("family"))) po_tx+=erp("family")+rdl;

			// проверка поля Имя
			if(far_epo("name")) if(!reg_fio.test(polto_rth("name"))) po_tx+=erp("name")+rdl;
		
		}
		else { // выбран статус "Приглашённый ЧК" или "Приглашённый родственник"
		
			if(sel==hisel_1) { // выбран статус "Приглашённый ЧК"
		
				// проверка поля №ЧК
				if(far_epo("chk")) if(!reg_chk.test(polto_rth("chk"))) po_tx+=erp("chk")+rdl;
			}
				// проверка поля Фамилия
				if(far_epo("family")) if(!reg_fio.test(polto_rth("family"))) po_tx+=erp("family")+rdl;

				// проверка поля Имя
				if(far_epo("name")) if(!reg_fio.test(polto_rth("name"))) po_tx+=erp("name")+rdl;		
				
				// проверка поля Кем приглашен - №ЧК
				if(far_epo("kem_priglashen_chk")) if(!reg_chk.test(polto_rth("kem_priglashen_chk"))) po_tx+=erp("kem_priglashen_chk")+rdl;

				// проверка поля Кем приглашен - Фамилия
				if(far_epo("kem_priglashen_family")) if(!reg_fio.test(polto_rth("kem_priglashen_family"))) po_tx+=erp("kem_priglashen_family")+rdl;

				// проверка поля Кем приглашен - Имя
				if(far_epo("kem_priglashen_name")) if(!reg_fio.test(polto_rth("kem_priglashen_name"))) po_tx+=erp("kem_priglashen_name")+rdl;
		
		}
	}

	
// проверка поля E-mail	
if(far_epo("email")) if(!reg_mail.test(polto_rth("email"))) po_tx+=erp("email")+rdl;

// проверка поля Телефон
if(far_epo("tel")) if(!reg_phone.test(polto_rth("tel"))) po_tx+=erp("tel")+rdl;

// проверка поля Доп. Телефон
if(far_epo("tel_2")) if(!reg_phone.test(polto_rth("tel_2"))) po_tx+=erp("tel_2")+rdl;		
	
// проверка поля Skype
sel=$("#pvs input:radio").filter(":checked").val();
hisel_2=$("#pvs input:radio:eq(2)").val();
	if(sel==hisel_2) {
		if(far_epo("skype")) if(!polto_rth("skype")) po_tx+=erp("skype")+rdl;
	}
	
// проверка поля Пол
if(far_epo("sex")) if(!polto_rth("sex")) po_tx+=erp("sex")+rdl;	
	
// проверка поля Возраст
if(far_epo("age")) if(!polto_rth("age")) po_tx+=erp("age")+rdl;

// проверка поля Дата рождения
if(far_epo("birthday")) {
	if(!polto_rth("birthday")) po_tx+=erp("birthday")+rdl;
	// проверка поля Дата рождения на валидность
	else if(!valid_date("birthday",true)) po_tx+=erp("nonexistent_date")+rdl;		
}

// проверка поля Город проживания 
if(far_epo("city")) if(!polto_rth("city")) po_tx+=erp("city")+rdl;	
	
// проверка поля Форма оплаты 
if(far_epo("oplata")) if(!polto_rth("oplata")) po_tx+=erp("oplata")+rdl;
	
// проверка полей по выбору поля Форма оплаты
sel=$("#ti_blo_oplata input:radio").filter(":checked").val();
hisel_0=$("#ti_blo_oplata input:radio:eq(0)").val();
hisel_1=$("#ti_blo_oplata input:radio:eq(1)").val();
	if(sel) {
		if(sel==hisel_0) { // выбрана Форма оплаты Чек №
		
			// проверка поля ЧК плательщика
			if(far_epo("pl_chk")) if(!reg_chk.test(polto_rth("pl_chk"))) po_tx+=erp("pl_chk")+rdl;

			// проверка поля Имя плательщика
			if(far_epo("pl_name")) if(!reg_fio.test(polto_rth("pl_name"))) po_tx+=erp("pl_name")+rdl;

			// проверка поля Фамилия плательщика
			if(far_epo("pl_family")) if(!reg_fio.test(polto_rth("pl_family"))) po_tx+=erp("pl_family")+rdl;

			// проверка поля № телефона плательщика
			if(far_epo("pl_phone")) if(!reg_phone.test(polto_rth("pl_phone"))) po_tx+=erp("pl_phone")+rdl;
			
			do_0=$("#pl_ok_id").val();
			if(do_0=="2") {
				// проверка поля ЧК гаранта
				if(far_epo("garant_chk")) if(!reg_chk.test(polto_rth("garant_chk"))) po_tx+=erp("garant_chk")+rdl;

				// проверка поля Имя гаранта
				if(far_epo("garant_name")) if(!reg_fio.test(polto_rth("garant_name"))) po_tx+=erp("garant_name")+rdl;

				// проверка поля Фамилия гаранта
				if(far_epo("garant_family")) if(!reg_fio.test(polto_rth("garant_family"))) po_tx+=erp("garant_family")+rdl;
			}
			
		}
		
		if(sel==hisel_1) { // выбрана Форма оплаты Нал в ОП
			
			// проверка поля Страна Офиса продаж
			if(far_epo("op_country")) if(!polto_rth("op_country")) po_tx+=erp("op_country")+rdl;
			
			// проверка поля Город Офиса продаж
			if(far_epo("op_city")) if(!polto_rth("op_city")) po_tx+=erp("op_city")+rdl;
			
			// проверка поля № Офиса продаж
			if(far_epo("op_nof")) if(!polto_rth("op_nof")) po_tx+=erp("op_nof")+rdl;
		}
	}
	
	// проверка поля Наличие загранпаспорта
	if(far_epo("p_nal")) if(!polto_rth("p_nal")) po_tx+=erp("p_nal")+rdl;

// проверка полей по выбору поля Наличие загранпаспорта
sel=$("#ti_blo_p_nal input:radio").filter(":checked").val();
hisel_0=$("#ti_blo_p_nal input:radio:eq(0)").val();	
hisel_1=$("#ti_blo_p_nal input:radio:eq(1)").val();	

if(sel) {
	if(sel==hisel_0) { // выбрано Наличие загранпаспорта Имеется
	
		// проверка поля Имя по загранпаспорту 
		if(far_epo("p_name")) if(!reg_fio.test(polto_rth("p_name"))) po_tx+=erp("p_name")+rdl;
		
		// проверка поля Фамилия по загранпаспорту 
		if(far_epo("p_family")) if(!reg_fio.test(polto_rth("p_family"))) po_tx+=erp("p_family")+rdl;
		
		// проверка поля Дата выдачи загранпаспорта
		if(far_epo("p_date")) if(!polto_rth("p_date")) po_tx+=erp("p_date")+rdl;		
		
		//Серия и номер загранпаспорта
		//if(far_epo("p_sn")) if(!polto_rth("p_sn")) po_tx+=erp("p_sn")+rdl;	

		//Серия загранпаспорта
		if(far_epo("p_sp")) if(!polto_rth("p_sp")) po_tx+=erp("p_sp")+rdl;

		//Номер загранпаспорта
		if(far_epo("p_np")) if(!polto_rth("p_np")) po_tx+=erp("p_np")+rdl;
	}
	if(sel==hisel_1) { // выбрано Наличие загранпаспорта Не имеется
	
		// проверка поля Нет паспорта? Укажите дату
		if(far_epo("p_ready")) if(!polto_rth("p_ready")) po_tx+=erp("p_ready")+rdl;		
	}
}
	
// проверка поля Оформление визы
if(far_epo("p_viza")) if(!polto_rth("p_viza")) po_tx+=erp("p_viza")+rdl;

// проверка поля Вариант проживания 
if(far_epo("p_hotel")) if(!polto_rth("p_hotel")) po_tx+=erp("p_hotel")+rdl;

// проверка полей по выбору поля Вариант проживания
sel=$("#ti_blo_p_hotel input:radio").filter(":checked").val();
hisel_0=$("#ti_blo_p_hotel input:radio:eq(0)").val();	
hisel_1=$("#ti_blo_p_hotel input:radio:eq(1)").val();	

if(sel) {
	if(sel==hisel_0) { // выбран Вариант проживания Через компанию
	
		// проверка поля Дата начала проживания
		if(far_epo("day_hotel_start")) if(!polto_rth("day_hotel_start")) po_tx+=erp("day_hotel_start")+rdl;	

		// проверка поля Дата окончания проживания
		if(far_epo("day_hotel_finish")) if(!polto_rth("day_hotel_finish")) po_tx+=erp("day_hotel_finish")+rdl;
		
		// проверка количества дней проживания
		if(f_d_sf("day_hotel_start","day_hotel_finish")&lt;1) po_tx+=erp("day_c")+rdl;
		
		// проверка поля Отель
		if(far_epo("hotel")) if(!polto_rth("hotel")) po_tx+=erp("hotel")+rdl;
		
		// проверка поля Номер
		if(far_epo("nomer")) if(!polto_rth("nomer")) po_tx+=erp("nomer")+rdl;
		
		// проверка полей по выбору поля Участие в Leadership или Соучастие в Leadership
		if($("#hiscer").val()==0) { // для участника
			do_0=$("#ti_blo_d_leader_ship input:radio").filter(":checked").val();
			do_1=$("#ti_blo_d_leader_ship input:radio:eq(0)").val();
		}
		else {             // для соучастника
			do_0=$("#ti_blo_s_leader_ship input:radio").filter(":checked").val();
			do_1=$("#ti_blo_s_leader_ship input:radio:eq(0)").val();
		}
		if(do_0==do_1) { // выбрано Участие/Соучастие в Leadership Да
			// проверка поля Дата начала проживания
			if(far_epo("day_hotel_start_ls")) if(!polto_rth("day_hotel_start_ls")) po_tx+=erp("day_hotel_start_ls")+rdl;	

			// проверка поля Дата окончания проживания для Leader Ship
			if(far_epo("day_hotel_finish_ls")) if(!polto_rth("day_hotel_finish_ls")) po_tx+=erp("day_hotel_finish_ls")+rdl;
			
			// проверка количества дней проживания для Leader Ship
			if(f_d_sf("day_hotel_start_ls","day_hotel_finish_ls")&lt;1) po_tx+=erp("day_c")+rdl;
			
			// проверка поля Отель для Leader Ship
			if(far_epo("hotel_ls")) if(!polto_rth("hotel_ls")) po_tx+=erp("hotel_ls")+rdl;
			
			// проверка поля Номер для Leader Ship
			if(far_epo("nomer_ls")) if(!polto_rth("nomer_ls")) po_tx+=erp("nomer_ls")+rdl;
		}
			
	}
	if(sel==hisel_1) { // выбран Вариант проживания Самостоятельно
		
	}
	
}

// проверка поля Медицинская страховка
if(far_epo("medical_insurance")) if(!polto_rth("medical_insurance")) po_tx+=erp("medical_insurance")+rdl;

// проверка поля Вариант перелета
if(far_epo("p_fly")) if(!polto_rth("p_fly")) po_tx+=erp("p_fly")+rdl;
	
// проверка полей по выбору поля Вариант перелета
sel=$("#ti_blo_p_fly input:radio").filter(":checked").val();
hisel_0=$("#ti_blo_p_fly input:radio:eq(0)").val();	
hisel_1=$("#ti_blo_p_fly input:radio:eq(1)").val();	

if(sel) {
	if(sel==hisel_0) { // выбрано Вариант перелета Через компанию
	
		// проверка поля Перелет туда
		if(far_epo("fly_1")) if(!polto_rth("fly_1")) po_tx+=erp("fly_1")+rdl;
		
		// проверка поля Перелет обратно
		if(far_epo("fly_2")) if(!polto_rth("fly_2")) po_tx+=erp("fly_2")+rdl;		
	}

}

// проверка поля Участие в конференции
if(far_epo("d_konf")) if(!polto_rth("d_konf")) po_tx+=erp("d_konf")+rdl;

// проверка поля Участие в гала ужине
if(far_epo("d_ujin")) if(!polto_rth("d_ujin")) po_tx+=erp("d_ujin")+rdl;

// проверка поля Питание в гостинице
if(far_epo("d_eat_1")) if(!polto_rth("d_eat_1")) po_tx+=erp("d_eat_1")+rdl;

// проверка поля Питание на конференции
if(far_epo("d_eat_2")) if(!polto_rth("d_eat_2")) po_tx+=erp("d_eat_2")+rdl;

// проверка полей по выбору поля Питание на конференции
sel=$("#ti_blo_d_eat_2 input:radio").filter(":checked").val();
hisel_0=$("#ti_blo_d_eat_2 input:radio:eq(0)").val();	
hisel_1=$("#ti_blo_d_eat_2 input:radio:eq(1)").val();	

if(sel==hisel_0 || sel==hisel_1) {
	// проверка поля Один запасной вопрос
	if(far_epo("d_vopros_1")) if(!polto_rth("d_vopros_1")) po_tx+=erp("d_vopros_1")+rdl;
}

// проверка поля Размер футболки
if(far_epo("d_futbolka")) if(!polto_rth("d_futbolka")) po_tx+=erp("d_futbolka")+rdl;

// проверка поля Синхронный перевод
if(far_epo("interpretation")) if(!polto_rth("interpretation")) po_tx+=erp("interpretation")+rdl;
	
// проверка полей по выбору поля Синхронный перевод
sel=$("#ti_blo_interpretation input:radio").filter(":checked").val();
hisel_0=$("#ti_blo_interpretation input:radio:eq(0)").val();	
hisel_1=$("#ti_blo_interpretation input:radio:eq(1)").val();	

if(sel) {
	if(sel==hisel_0) { // выбран Синхронный перевод Да
	
		// проверка поля Выберите язык для синхронного перевода
		if(far_epo("interpretation_lang")) if(!reg_fio.test(polto_rth("interpretation_lang"))) po_tx+=erp("interpretation_lang")+rdl;	
	}
}
// проверка поля Место
			if(far_epo("mesto")) if(!polto_rth("mesto")) po_tx+=erp("mesto")+rdl;

		
return po_tx;

}
//////////////////////////////////

// функция задержки проверки полей перед отправкой формы
function sub_form() {
	if(pro_su() !="") {
		$("#err_p_t").html(pro_su());
		$("#err_p_b").click();
		return false;
	}
	else {
		$(".but_preloader").css("display", "block");
		return true;
	}
}
//////////////////////////////////////////

// функция управления кнопкой 
function sub_but() {
	
	sen_por();
	
	if(pro_su() !="") {
		$("#but_bot_3_a").css("display","none");
		$("#but_bot_3").css("display","block");
	}
	else {
		$("#but_bot_3").css("display","none");
		$("#but_bot_3_a").css("display","block");
	}
}
////////////////////////////////////////

// функция вывода ошибки
function erp(n) {
	var ty =$("#erp_"+n).html();
	return ty;
}
///////////////////////////////////////

// функция дополнительных обработок полей
function sen_por() {

// доп. обработка полей перелёта при пеесчёте остатка мест
if(far_epo("fly_1") && far_epo("fly_2")) meter_fly();

// доп. обработка полей отелей при пеесчёте остатка мест
if(far_epo("hotel")) meter_nomer();

var sel;var hisel_0;var hisel_1;var hisel_2;
var b_d;var b_m;var b_y;

		// доп обработка поля Статус
	if(far_epo("status")) {
		sel=$("#ti_blo_status input:radio").filter(":checked").val();
		hisel_0=$("#ti_blo_status input:radio:eq(0)").val();
		hisel_1=$("#ti_blo_status input:radio:eq(1)").val();
		hisel_2=$("#ti_blo_status input:radio:eq(2)").val();
		if(sel) {
			if(sel==hisel_0) {
				$("#sipo_1").css("display", "block" );
				$("#sipo_2").css("display", "block" );
				$("#sipo_0").css("display", "none" );
				$("#sipo_0 input:text").val("");
			}
			else {
				$("#sipo_0").css("display", "block");
				$("#sipo_2").css("display", "block");
				if(sel==hisel_1) {$("#sipo_1").css("display", "block");}
				else {$("#sipo_1").css("display", "none"); $("#sipo_1 input:text").val("");}
			}
			
			$("#titu").css("display", "block" );
		}
		else $("#titu").css("display", "none" );
	}
	
		// доп обработка поля Дата рождения
	if(far_epo("birthday")) {
		b_d=$("#ti_blo_birthday #b_d_birthday option:selected").val();
		b_m=$("#ti_blo_birthday #b_m_birthday option:selected").val();
		b_y=$("#ti_blo_birthday #b_y_birthday option:selected").val();
		$("#ti_blo_birthday input:text:eq(0)").val(f_dmy(b_d,b_m,b_y));
		
		var mydate = new Date();
		mydate.setFullYear(b_y, b_m-1, b_d);
		var currdate = new Date();
		currdate.setFullYear(currdate.getFullYear());
		var ry=new Date();
		ry=currdate.getFullYear()- mydate.getFullYear();
		if(currdate.getMonth() &lt; mydate.getMonth()) ry=ry-1;
		if(currdate.getMonth() == mydate.getMonth()) {
			if(currdate.getDate() &lt; mydate.getDate()) ry=ry-1;
		}
	}	
	
	// доп обработка поля Возраст
	if(far_epo("age")) {
		var ia=$("#ti_blo_age input").length;
		var icd=0;
			for(var i=ia;i&gt;0;i--) {
				icd=$("#ti_blo_age input:radio:eq("+(i-1)+")");
				if(ry&lt;icd.attr("answercode")*1) icd.attr("checked","checked");
			}
	}
		
		// доп обработка поля Оплата
	if(far_epo("oplata")) {
		sel=$("#ti_blo_oplata input:radio").filter(":checked").val();
		hisel_0=$("#ti_blo_oplata input:radio:eq(0)").val();
		
		if(sel){
			if(sel==hisel_0) {
				$("#pl_div").css("display", "block" );
				$("#op_div").css("display", "none" );
				$("#op_div select:eq(0) option").each(function(){this.selected=false;});
				$("#op_div select:eq(1)").empty();
				$("#op_div select:eq(2)").empty();
				$("#op_div input:radio:eq(0)").attr("checked","checked");
			}
			else {
				$("#op_div").css("display", "block" );
				$("#pl_div").css("display", "none" );
				$("#pl_div  input:text").val("");
				$("#pl_div  input:radio:eq(0)").attr("checked","checked");
			}
		}
	}	
		// доп обработка поля Проверка плательщика
	if(far_epo("ok_id")) {
		sel=$("#pl_ok_id").val();
		if(sel=="2") {$("#garant_div").css("display", "block" );}
		else {$("#garant_div").css("display", "none" );}
	}
		// доп обработка поля Наличие загранпаспорта
	if(far_epo("p_nal")) {
		sel=$("#ti_blo_p_nal input:radio").filter(":checked").val();
		hisel_0=$("#ti_blo_p_nal input:radio:eq(0)").val();
		
		if(sel){
			if(sel==hisel_0) {
				$("#p_nal_ok").css("display", "block" );
				$("#ti_blo_p_ready select:eq(0) option").each(function(){this.selected=false;});
				$("#ti_blo_p_ready select:eq(1) option").each(function(){this.selected=false;});
				$("#ti_blo_p_ready select:eq(2) option").each(function(){this.selected=false;});
				$("#ti_blo_p_ready input:text").val("");
				$("#p_nal_not").css("display", "none" );
			}
			else {
				$("#p_nal_not").css("display", "block" );
				$("#ti_blo_p_name input:text").val("");
				$("#ti_blo_p_family input:text").val("");
				$("#ti_blo_p_date select:eq(0) option").each(function(){this.selected=false;});
				$("#ti_blo_p_date select:eq(1) option").each(function(){this.selected=false;});
				$("#ti_blo_p_date select:eq(2) option").each(function(){this.selected=false;});
				$("#ti_blo_p_date input:text").val("");
				$("#ti_blo_p_due_date select:eq(0) option").each(function(){this.selected=false;});
				$("#ti_blo_p_due_date select:eq(1) option").each(function(){this.selected=false;});
				$("#ti_blo_p_due_date select:eq(2) option").each(function(){this.selected=false;});
				$("#ti_blo_p_due_date input:text").val("");
				$("#ti_blo_p_sn input:text").val("");
				$("#ti_blo_p_scan input:file").val("");
				$("#p_nal_ok").css("display", "none" );
			}
		}	
	}
		// доп обработка поля Дата выдачи загранпаспорта
	if(far_epo("p_date")) {
		b_d=$("#ti_blo_p_date #b_d_p_date option:selected").val();
		b_m=$("#ti_blo_p_date #b_m_p_date option:selected").val();
		b_y=$("#ti_blo_p_date #b_y_p_date option:selected").val();
		$("#ti_blo_p_date input:text:eq(0)").val(f_dmy(b_d,b_m,b_y));
	}
			// доп обработка поля Действие загранпаспорта
	if(far_epo("p_due_date")) {
		b_d=$("#ti_blo_p_due_date #b_d_p_due_date option:selected").val();
		b_m=$("#ti_blo_p_due_date #b_m_p_due_date option:selected").val();
		b_y=$("#ti_blo_p_due_date #b_y_p_due_date option:selected").val();
		$("#ti_blo_p_due_date input:text:eq(0)").val(f_dmy(b_d,b_m,b_y));
	}
		// доп обработка поля Нет паспорта? Укажите дату 
	if(far_epo("p_ready")) {
		b_d=$("#ti_blo_p_ready #b_d_p_ready option:selected").val();
		b_m=$("#ti_blo_p_ready #b_m_p_ready option:selected").val();
		b_y=$("#ti_blo_p_ready #b_y_p_ready option:selected").val();
		$("#ti_blo_p_ready input:text:eq(0)").val(f_dmy(b_d,b_m,b_y));
	}
	
		// доп обработка поля Нет удостоверения личности? Укажите дату 
	if(far_epo("ip_ready")) {
		ib_d=$("#ti_blo_ip_ready #b_d_ip_ready option:selected").val();
		ib_m=$("#ti_blo_ip_ready #b_m_ip_ready option:selected").val();
		ib_y=$("#ti_blo_ip_ready #b_y_ip_ready option:selected").val();
		$("#ti_blo_ip_ready input:text:eq(0)").val(f_dmy(ib_d,ib_m,ib_y));
	}
	
			// доп обработка поля Вариант проживания
	if(far_epo("p_hotel")) {
		sel=$("#ti_blo_p_hotel input:radio").filter(":checked").val();
		hisel_0=$("#ti_blo_p_hotel input:radio:eq(0)").val();
		
		if(sel){
			if(sel==hisel_0) {
				$("#hotel_to").css("display", "block" );
			}
			else {
				$("#hotel_to").css("display", "none" );
				$("#ti_blo_hotel input:radio").attr ("checked", false);
				$("#ti_blo_nomer input:radio").attr ("checked", false);
			}
		}
	}
	
		// доп обработка поля Дата начала проживания
	if(far_epo("day_hotel_start")) {
		b_d=$("#ti_blo_day_hotel_start #b_d_day_hotel_start option:selected").val();
		b_m=$("#ti_blo_day_hotel_start #b_m_day_hotel_start option:selected").val();
		b_y=$("#ti_blo_day_hotel_start #b_y_day_hotel_start option:selected").val();
		$("#ti_blo_day_hotel_start input:text:eq(0)").val(f_dmy(b_d,b_m,b_y));
	}
		// доп обработка поля Дата окончания проживания
	if(far_epo("day_hotel_finish")) {
		b_d=$("#ti_blo_day_hotel_finish #b_d_day_hotel_finish option:selected").val();
		b_m=$("#ti_blo_day_hotel_finish #b_m_day_hotel_finish option:selected").val();
		b_y=$("#ti_blo_day_hotel_finish #b_y_day_hotel_finish option:selected").val();
		$("#ti_blo_day_hotel_finish input:text:eq(0)").val(f_dmy(b_d,b_m,b_y));
	}
	
	// доп обработка поля Участие/Соучастие в Leadership
	if($("#hiscer").val()==0) { // для участника
			sel=$("#ti_blo_d_leader_ship input:radio").filter(":checked").val();
			hisel_0=$("#ti_blo_d_leader_ship input:radio:eq(0)").val();
			hisel_2="d_leader_ship";
		}
		else {             // для соучастника
			sel=$("#ti_blo_s_leader_ship input:radio").filter(":checked").val();
			hisel_0=$("#ti_blo_s_leader_ship input:radio:eq(0)").val();
			hisel_2="s_leader_ship";
		}
	if(far_epo(hisel_2)) {
		if(sel){
			if(sel==hisel_0) {
				$("#hotel_to_2").css("display", "block" );
			}
			else {
				$("#hotel_to_2").css("display", "none" );
				$("#ti_blo_hotel_ls input:radio").attr ("checked", false);
				$("#ti_blo_nomer_ls input:radio").attr ("checked", false);
			}
		}
	}
			// доп обработка поля Дата начала проживания для Leader Ship
	if(far_epo("day_hotel_start_ls")) {
		b_d=$("#ti_blo_day_hotel_start_ls #b_d_day_hotel_start_ls option:selected").val();
		b_m=$("#ti_blo_day_hotel_start_ls #b_m_day_hotel_start_ls option:selected").val();
		b_y=$("#ti_blo_day_hotel_start_ls #b_y_day_hotel_start_ls option:selected").val();
		$("#ti_blo_day_hotel_start_ls input:text:eq(0)").val(f_dmy(b_d,b_m,b_y));
	}
		// доп обработка поля Дата окончания проживания для Leader Ship
	if(far_epo("day_hotel_finish_ls")) {
		b_d=$("#ti_blo_day_hotel_finish_ls #b_d_day_hotel_finish_ls option:selected").val();
		b_m=$("#ti_blo_day_hotel_finish_ls #b_m_day_hotel_finish_ls option:selected").val();
		b_y=$("#ti_blo_day_hotel_finish_ls #b_y_day_hotel_finish_ls option:selected").val();
		$("#ti_blo_day_hotel_finish_ls input:text:eq(0)").val(f_dmy(b_d,b_m,b_y));
	}
	
			// доп обработка поля Вариант перелета
	if(far_epo("p_fly")) {
		sel=$("#ti_blo_p_fly input:radio").filter(":checked").val();
		hisel_0=$("#ti_blo_p_fly input:radio:eq(0)").val();
		
		if(sel){
			if(sel==hisel_0) {
			$("#fly_to").css("display", "block");
				$("#ti_blo_p_transfer input:radio:eq(0)").attr ("checked", true);
				$("#ti_blo_p_transfer #p_transfer_0").css("display", "block");
				$("#ti_blo_p_transfer  #p_transfer_1").css("display", "none");
			}
			else {
				$("#fly_to").css("display", "none");
				$("#ti_blo_fly_1 input:radio").attr ("checked", false);
				$("#ti_blo_fly_2 input:radio").attr ("checked", false);
				$("#ti_blo_p_transfer input:radio:eq(1)").attr ("checked", true);
				$("#ti_blo_p_transfer  #p_transfer_1").css("display", "block");
				$("#ti_blo_p_transfer  #p_transfer_0").css("display", "none");
				$("#ti_blo_fly_1 input:radio").attr ("checked", false);
				$("#ti_blo_fly_2 input:radio").attr ("checked", false);
			}
		}
	}
	
				// доп обработка поля Синхронный перевод
	if(far_epo("interpretation")) {
		sel=$("#ti_blo_interpretation input:radio").filter(":checked").val();
		hisel_0=$("#ti_blo_interpretation input:radio:eq(0)").val();
		
		if(sel){
			if(sel==hisel_0) {
				$("#ti_blo_interpretation_lang").css("display", "block" );
				$("#ti_blo_second_interpretation_lang").css("display", "block" );
			}
			else {
				$("#ti_blo_interpretation_lang").css("display", "none" );
				$("#sel_interpretation_lang [value='0']").attr("selected", "selected");
				$("#ti_blo_second_interpretation_lang").css("display", "none" );
				$("#sel_second_interpretation_lang [value='0']").attr("selected", "selected");
			}
		}
	}
	
		// доп обработка поля Место на форуме
	if(far_epo("mesto")) {	
		sel=$("#ti_blo_mesto input:text").val();
		if($.trim(sel)) $("#ti_blo_mesto .but").css("display", "none" );
		else $("#ti_blo_mesto .but").css("display", "block" );
	}

		// доп обработка поля Питание на мероприятии	
	if(far_epo("d_eat_2")) {
		sel=$("#ti_blo_d_eat_2 input:radio").filter(":checked").val();
		hisel_0=$("#ti_blo_d_eat_2 input:radio:eq(0)").val();
		hisel_1=$("#ti_blo_d_eat_2 input:radio:eq(1)").val();

		if(sel){
			if(sel==hisel_0 || sel==hisel_1) {
				$("#ti_blo_d_vopros_1").css("display", "block" );
				if(sel==hisel_0) {
					$("#d_eat_2_0").css("display", "block");
					$("#d_eat_2_1").css("display", "none");
					$("#d_eat_2_2").css("display", "none");
				}
				else {
					$("#d_eat_2_0").css("display", "none");
					$("#d_eat_2_1").css("display", "block");
					$("#d_eat_2_2").css("display", "block");
				}
			}
			else {
				$("#ti_blo_d_vopros_1").css("display", "none" );
				$("#ti_blo_d_vopros_1 input:radio").attr ("checked", false);
			}
		}
	}
}
///////////////////////////////////////

// Функция проверки плательщика
 function old_show_check()  
        {  
		$(".but_preloader").css("display", "block");
		var fop=$("#ti_blo_oplata input:radio").filter(":checked").val();//какой способ оплаты выбран
		var hifop=$("#ti_blo_oplata input:radio:eq(0)").val();  // первый способ оплпты для сравнения 
		var gn=$("#ti_blo_time_money_chk input:radio").filter(":checked").val(); //какая  выбрана рассрочка
		var gnh=$("#ti_blo_time_money_chk input:radio:eq(0)").val(); // первый тип рассрочки для сравнения 
		
		if(fop==hifop) {
				var p_chk="";   //№ ЧК плательщика 
				var p_family="";  //Фамилия плательщика 
				var p_name="";  //Имя плательщика 
				var stts="";
				var br="";
				$("#erch").html("");
				// Скрытые поля проверки плательщика с сообщениями
			var cop0=$("#ti_blo_pl_ok input:hidden:eq(0)").val(); // Проверка не пройдена
			var cop1=$("#ti_blo_pl_ok input:hidden:eq(1)").val(); // Проверки не было
			var cop2=$("#ti_blo_pl_ok input:hidden:eq(2)").val(); // Нужен гарант
			var cop3=$("#ti_blo_pl_ok input:hidden:eq(3)").val(); // Не нужен гарант
			var cop4=$("#ti_blo_pl_ok input:hidden:eq(4)").val(); // Проверка пройдена
			var chk=$("#chk").val();   //№ ЧК  

				p_chk=$("#ti_blo_pl_chk input:text:eq(0)").val();  //№ ЧК плательщика 
				p_family=$("#ti_blo_pl_family input:text:eq(0)").val();  //Фамилия плательщика 
				p_name=$("#ti_blo_pl_name input:text:eq(0)").val(); //Имя плательщика 
				gr_chk=$("#ti_blo_garant_chk input:text:eq(0)").val(); // № ЧК гаранта
				gr_family=$("#ti_blo_garant_family input:text:eq(0)").val(); // Фамилия гаранта
				gr_name=$("#ti_blo_garant_name input:text:eq(0)").val();  // Имя гаранта
				// Проверка если плательщик и заявитель одно лицо 
				if(p_chk == chk) stts=1;   //Если № ЧК равен № ЧК плательщика
				else stts=0;   //Если № ЧК не равен № ЧК плательщика
				if(gn == gnh) br=1; // Если оплата без рассрочки
				else br=0; // Если оплата с рассрочкой

		            $.ajax({  
                type: "POST",
                url: "methods/check_chk.php",  
				data: "p_chk="+p_chk+"&p_family="+p_family+"&p_name="+p_name+"&stts="+stts+"&br="+br+"&gr_chk="+gr_chk+"&gr_family="+gr_family+"&gr_name="+gr_name, 
                cache: false,  
                success: function(html){ 
					//$("#tr").html(html);
					var ar_h=html.split("^");
					//ar_h[0] - id валюты
					//ar_h[1] - символьный код валюты
					//ar_h[2] - возвращаемый проверкой плательщика параметр
					//ar_h[3] - e-mail плательщика
					//ar_h[4] - код необходимости гаранта 1-нужен, 0 - не нужен
					//ar_h[5] - код ошибки
					
					//ar_h[5]=0; // игнорирование ошибки
					
					var pf=0;  // флаг перехода на следующий шаг
					if(ar_h[5]==0) // Ошибки нет
					{
					pf=1;
					}
					else  // Ошибка есть
					{
						pf=0;
							if((ar_h[5]==2 || ar_h[5]==5))	{// ошибка проверки гаранта
								if(ar_h[4]) { // гарант нужен
										if(gn==gnh) {	//если без рассрочки гарант не нужен
										$("#garant_div").css("display","none");
										pf=1;
										}									
										else { // если есть рассрочка гарант нужен
										$("#garant_div").css("display","block");
										//show_hsh("div_er_pro"+ar_h[5]);
										var jo=$("#div_er_pro"+ar_h[5]).html();
										$("#err_p_t").html(jo);
										$("#err_p_b").click();
										}
								}
								else pf=1; // гарант не нужен
								
							}
							else {		// остальные ошибки
								//show_hsh("div_er_pro"+ar_h[5]);
								$("#pl_ok").val(ar_h[5]);
								var jo=$("#div_er_pro"+ar_h[5]).html();
								$("#err_p_t").html(jo);
								$("#err_p_b").click();
							}
					}
					
					if(pf){
					$("#pl_ok").val(cop4);// В поле Проверка плательщика - Проверка пройдена
						$("#currency_id").val(ar_h[0]); // В поле ID валюты - ID валюты
						$("#currency").val(ar_h[1]);// В поле валюта - символьный код валюты
						$("#promotion_3").val(ar_h[2]); // В поле промоушен оплата -  - возвращаемый проверкой плательщика параметр
						$("#garant_ok_id").val(ar_h[4]); // В поле валюта - код необходимости гаранта 1-нужен, 0 - не нужен
						$("#pl_ok_id").val(ar_h[3]); // В поле код проверки плательщика - e-mail плательщика
						//alert("OK");
						setTimeout(function() { $("#gud").click(); }, 1000); //// На следующий шаг, если все ОК
						//$("#gud").click();
					}
					else $(".but_preloader").css("display", "none");
                } 
		
            }); 

		}
		else $("#gud").click();
    } 

// функция построения списка стран для ОП	
	function f_nas_country(zcity,znof) {
var y=document.getElementById('sel_op_country').options[document.getElementById('sel_op_country').selectedIndex].value;
  $.ajax({ 
				type: "POST",			
                url: "vop2.php",
				data: "vcountry="+y+"&zcity="+zcity+"&znof="+znof,  
                cache: false,  
                success: function(html){  
                    $("#soc").html(html);  
                }  
            });
		setTimeout("f_nas_city('"+znof+"')",500);
		setTimeout("sub_but()",500);
}

// функция построения списка городов для ОП	
function f_nas_city(znof) {
var y=document.getElementById('sel_op_city').options[document.getElementById('sel_op_city').selectedIndex].value;
  $.ajax({ 
				type: "POST",			
                url: "vop2.php",
				data: "vcity="+y+"&znof="+znof,  
                cache: false,  
                success: function(html){  
                    $("#sos").html(html);  
                }  
            });
		setTimeout("f_nas_nof()",1000);
		setTimeout("sub_but()",500);
}

// функция построения списка ОП	
function f_nas_nof() {
var y=document.getElementById('sel_op_nof').options[document.getElementById('sel_op_nof').selectedIndex].value;
//alert(y);
  $.ajax({ 
				type: "POST",			
                url: "vop2.php",
				data: "vnof="+y,  
                cache: false,  
                success: function(html){ 
				//$("#tr").html(html);
				var ar_h=html.split("^");
                 document.getElementById('currency_id').value=ar_h[0];
				document.getElementById('currency').value=ar_h[1];				 
                }  
            });

		setTimeout("sub_but()",500);
}

// Обработка выбора фиксированных пар перелётов
function p_pe(p,v,o) 
	{
	$("#ti_blo_"+p+" .ti_dis").css({"display": "none"}); 
	$("#ti_blo_"+v+" .ti_dis").css({"display": "none"});
	//$("#ti_blo_"+p+" .ti_dis:eq("+o+")").css({"display": "block"});
	//$("#ti_blo_"+v+" .ti_dis:eq("+o+")").css({"display": "block"});
	$("#ti_blo_"+p+" #"+p+"_"+o).css({"display": "block"});
	$("#ti_blo_"+p+" #"+p+"_"+o+" input:radio").attr ("checked", true);
	$("#ti_blo_"+v+" #"+v+"_"+o).css({"display": "block"});
	$("#ti_blo_"+v+" #"+v+"_"+o+" input:radio").attr ("checked", true);
	
	}
function p_pes(b,c)
	{
	f_nochev(b);
	f_nochev(c);
		if($("#ti_blo_"+c+" input:radio").filter(":checked").val()==undefined)
		{
		$("#ti_blo_"+b+" .ti_dis").css({"display": "block"});
		$("#ti_blo_"+c+" .ti_dis").css({"display": "block"});
		}
	}
// Сброс радиоточек 
function f_nochev(n) {
$("#ti_blo_"+n+" input:radio").filter(":checked").attr ("checked", false);
}

// Обработка перелётов в зависимости от дат проживания //////////////////
function f_nochev_fly() {

	$("#ti_blo_fly_1 input:radio").filter(":checked").attr ("checked", false);
	$("#ti_blo_fly_2 input:radio").filter(":checked").attr ("checked", false);
	
	var ds=$("#ti_blo_day_hotel_start #b_d_day_hotel_start").val();
	var ms=$("#ti_blo_day_hotel_start #b_m_day_hotel_start").val();
	var df=$("#ti_blo_day_hotel_finish #b_d_day_hotel_finish").val();
	var mf=$("#ti_blo_day_hotel_finish #b_m_day_hotel_finish").val();

	var d_1=$("#date_v_1").val();
	var d_2=$("#date_v_2").val();
	var kld_1=0;
	var kld_2=0;
	
	var ard_1=d_1.split("-");
	var ds_ard_1=ard_1[0].split(".");
		if(ds_ard_1[0][0]=="0") ds_ard_1[0]=ds_ard_1[0][1];
		if(ds_ard_1[1][0]=="0") ds_ard_1[1]=ds_ard_1[1][1];
		
	var df_ard_1=ard_1[1].split(".");
		if(df_ard_1[0][0]=="0") df_ard_1[0]=df_ard_1[0][1];
		if(df_ard_1[1][0]=="0") df_ard_1[1]=df_ard_1[1][1];
	if(ds_ard_1[0]==ds && ds_ard_1[1]==ms && df_ard_1[0]==df && df_ard_1[1]==mf) {kld_1=1;}
	
	var ard_2=d_2.split("-");
	var ds_ard_2=ard_2[0].split(".");
		if(ds_ard_2[0][0]=="0") ds_ard_2[0]=ds_ard_2[0][1];
		if(ds_ard_2[1][0]=="0") ds_ard_2[1]=ds_ard_2[1][1];
		
	var df_ard_2=ard_2[1].split(".");
		if(df_ard_2[0][0]=="0") df_ard_2[0]=df_ard_2[0][1];
		if(df_ard_2[1][0]=="0") df_ard_2[1]=df_ard_2[1][1];
	if(ds_ard_2[0]==ds && ds_ard_2[1]==ms && df_ard_2[0]==df && df_ard_2[1]==mf) {kld_2=1;}
	
		if(kld_1 || kld_2) {
			$("#ti_blo_p_fly #p_fly_0 input:radio").attr ("checked", true);
			$("#ti_blo_p_fly #p_fly_1 input:radio").attr ("checked", false);
			$("#ti_blo_p_fly #p_fly_0").css("display", "block");
			
			if(kld_1) {
				$("#ti_blo_fly_1 #fly_1_date_1").css("display", "block");
				$("#ti_blo_fly_1 #fly_1_date_2").css("display", "none");
				$("#ti_blo_fly_2 #fly_2_date_1").css("display", "block");
				$("#ti_blo_fly_2 #fly_2_date_2").css("display", "none");
			}
			if(kld_2) {
				$("#ti_blo_fly_1 #fly_1_date_1").css("display", "none");
				$("#ti_blo_fly_1 #fly_1_date_2").css("display", "block");
				$("#ti_blo_fly_2 #fly_2_date_1").css("display", "none");
				$("#ti_blo_fly_2 #fly_2_date_2").css("display", "block");
			}
			
		}
		else {
		
			$("#ti_blo_p_fly #p_fly_0 input:radio").attr ("checked", false);
			$("#ti_blo_p_fly #p_fly_1 input:radio").attr ("checked", true);
			$("#ti_blo_p_fly #p_fly_0").css("display", "none");
		}
		
	
	sub_but();
}

// Функция построения даты
function f_dmy(b_d,b_m,b_y) {
	if(b_d && b_d&lt;10) b_d="0"+b_d;
	if(b_m && b_m&lt;10) b_m="0"+b_m;
	if(b_d && b_m && b_y) return b_d+"."+b_m+"."+b_y;
	else return "";
}

// Функция подсчёта разницы дней между датами 
function f_d_sf(date_start,date_finish) {
	var f_fs=$("#ti_blo_"+date_start+" input:text:eq(0)").val();
	var f_ff=$("#ti_blo_"+date_finish+" input:text:eq(0)").val();
	var ar_n=f_fs.split(".");
	var ar_k=f_ff.split(".");
	var tew_n=Date.parse(ar_n[2]+"-"+ar_n[1]+"-"+ar_n[0]);
	var tew_k=Date.parse(ar_k[2]+"-"+ar_k[1]+"-"+ar_k[0]);
	return (tew_k-tew_n) / 86400000;
}

//// Добавление рекомендуемых дат проживания из комментария в поля
function date_v(n) { 
var d=$("#date_v_"+n).val();
var ard=d.split("-");
var ds_ard=ard[0].split(".");
if(ds_ard[0][0]=="0") ds_ard[0]=ds_ard[0][1];
$("#ti_blo_day_hotel_start #b_d_day_hotel_start [value="+ds_ard[0]+"]").attr("selected", "selected");
if(ds_ard[1][0]=="0") ds_ard[1]=ds_ard[1][1];
$("#ti_blo_day_hotel_start #b_m_day_hotel_start [value="+ds_ard[1]+"]").attr("selected", "selected");
var df_ard=ard[1].split(".");
if(df_ard[0][0]=="0") df_ard[0]=df_ard[0][1];
$("#ti_blo_day_hotel_finish #b_d_day_hotel_finish [value="+df_ard[0]+"]").attr("selected", "selected");
if(df_ard[1][0]=="0") df_ard[1]=df_ard[1][1];
$("#ti_blo_day_hotel_finish #b_m_day_hotel_finish [value="+df_ard[1]+"]").attr("selected", "selected");

$("#ti_blo_fly_2 input:radio").filter(":checked").attr ("checked", false);
//if(n==1) {$(".v12").css({"display": "block"});$(".v15").css({"display": "none"});}
//else {$(".v12").css({"display": "none"});$(".v15").css({"display": "block"});}
//$("#date_day_hotel_start").val(ard[0]);
//$("#date_day_hotel_finish").val(ard[1]);
$("#p_fly_0").css("display", "block");
$("#p_fly_0 input:radio").attr("checked", true); //при выборе рекомендуемых дат перелёт предлагать через компанию
f_nochev_fly();
sub_but();
}

//// Добавление рекомендуемых дат проживания из комментария в поля 2
function date_v_2(n) { 
var d=$("#date_v_ls_"+n).val();
var ard=d.split("-");
var ds_ard=ard[0].split(".");
if(ds_ard[0][0]=="0") ds_ard[0]=ds_ard[0][1];
$("#ti_blo_day_hotel_start_ls #b_d_day_hotel_start_ls [value="+ds_ard[0]+"]").attr("selected", "selected");
if(ds_ard[1][0]=="0") ds_ard[1]=ds_ard[1][1];
$("#ti_blo_day_hotel_start_ls #b_m_day_hotel_start_ls [value="+ds_ard[1]+"]").attr("selected", "selected");
var df_ard=ard[1].split(".");
if(df_ard[0][0]=="0") df_ard[0]=df_ard[0][1];
$("#ti_blo_day_hotel_finish_ls #b_d_day_hotel_finish_ls [value="+df_ard[0]+"]").attr("selected", "selected");
if(df_ard[1][0]=="0") df_ard[1]=df_ard[0][1];
$("#ti_blo_day_hotel_finish_ls #b_m_day_hotel_finish_ls [value="+df_ard[1]+"]").attr("selected", "selected");

$("#ti_blo_fly_2 input:radio").filter(":checked").attr ("checked", false);
//if(n==1) {$(".v12").css({"display": "block"});$(".v15").css({"display": "none"});}
//else {$(".v12").css({"display": "none"});$(".v15").css({"display": "block"});}
//$("#date_day_hotel_start_ls").val(ard[0]);
//$("#date_day_hotel_finish_ls").val(ard[1]);
$("#p_fly_0 input:radio").attr ("checked", true); //при выборе рекомендуемых дат перелёт предлагать через компанию
sub_but();

}

//// Проверка на количество номеров
function meter_nomer() {

var strf=$("#meter_nomer").val();
var ar_nom=strf.split("^");
var co_n=ar_nom.length;

for(var i=0;i&lt;co_n;i++) {
		if(ar_nom[i]&lt;=0) {
			//$("#hotel_"+i).css({"display": "none"});
			$("#hotel_"+i).next(".not_f").children("span").html("0");
		}
		else {
			//$("#hotel_"+i).css({"display": "block"}); 
			$("#hotel_"+i).next(".not_f").children("span").html(ar_nom[i]);
		}
	}

}

//// Проверка на количество рейсов
function meter_fly() {
	var strf=$("#meter_fly").val();
	var ar_polo=strf.split("&");
	var ar_pt=ar_polo[0].split("^");
	var ar_po=ar_polo[1].split("^");
	var co_t=ar_pt.length;
	var co_o=ar_po.length;

	for(var i=1;i&lt;co_t;i++) {
		if(ar_pt[i]&lt;=0) {
			//$("#fly_1_"+i).css({"display": "none"});
			//$("#fly_1_"+i+" input").attr("disabled",true);
			
		}
		else {
			//$("#fly_1_"+i).css({"display": "block"}); 
			$("#fly_1_"+i+" .ostok span:eq(1)").html(ar_pt[i]);
			//$("#fly_1_"+i+" input").attr("disabled",false);
		}
	}
	
	for(var i=1;i&lt;co_o;i++) {
		if(ar_po[i]&lt;=0) {
			//$("#fly_2_"+i).css({"display": "none"});
			//$("#fly_2_"+i+" input").attr("disabled",true);
		}
		else {
			//$("#fly_2_"+i).css({"display": "block"}); 
			$("#fly_2_"+i+" .ostok span:eq(1)").html(ar_po[i]);
			//$("#fly_2_"+i+" input").attr("disabled",false);
		}
	}

}

 // функция построения списка городов по выбранной стране
 function f_chang_country() {
	var y=$("#sel_op_country option:selected").val();
	$("#sel_op_city").html(""); 
	
			$.ajax({ 
				type: "POST",			
                url: "vop.php",
				data: "vcountry="+y,  
                cache: false,  
                success: function(html){  
                    $("#sel_op_city").html(html); 
					//$("#tr").html(html);				
                }  
            });
	setTimeout("f_chang_city()", 1000);
			
 }
 
  // функция построения списка ОП по выбранному городу
  function f_chang_city() {
	var y=$("#sel_op_city option:selected").val();
	$("#sel_op_nof").html("");
			$.ajax({ 
				type: "POST",			
                url: "vop.php",
				data: "vcity="+y,  
                cache: false,  
                success: function(html){  
                    $("#sel_op_nof").html(html); 
					//$("#tr").html(html);				
                }  
            });
			
	setTimeout("f_chang_nof()", 1000);
	
 }
 // функция передачи в поля формы id и кода валюты ОП	
 function f_chang_nof() {
	var y=$("#sel_op_nof option:selected").val();
	 $.ajax({ 
				type: "POST",			
                url: "vop.php",
				data: "vnof="+y,  
                cache: false,  
                success: function(html){  
					var ar_h = html.split("^");
					//$("#tr").html(html);
					$("#currency_id").val(ar_h[0]);
					$("#currency").val(ar_h[1]);
                }  
            });
	setTimeout("sub_but()",1000);
	//sub_but();
 }
 
 ///// Добавление заявки в резерв
 function add_rezerv(n,s)  
        {  
			var inf=$(".text_rezerv_ok").html();
			$(".text_rezerv_ok").css({"display":"block"});
			$(".text_rezerv_add").css({"display":"none"})
			$(".but_rezerv").css({"display":"none"});
			$("#ti_blo_mesto input:text:eq(0)").val(inf);
			$("#mesto_index").val("");
			sub_but();
			/*
		        $.ajax({  
                type: "POST",
                url: "add_rezerv.php",  
				data: "RESULT_ID="+n+"&STATUS_ID="+s, 
                cache: false,  
                success: function(html){  
				//$("#tr").html(html);
				var ar_h=html.split("^");
				if(ar_h[1]=="1"){
				$(".text_rezerv_ok").css({"display":"block"});
				$(".text_rezerv_add").css({"display":"none"})
				$(".but_rezerv").css({"display":"none"});
				$("#ti_blo_mesto input:text:eq(0)").val(inf);
				sub_but();
					}
				else {
					$(".text_rezerv_error").css({"display":"block"});
					}
		
                }  
            }); 
			*/			
        } 
 
// анимация для полей комментариев
function luch(){
$(".luch").animate({left:800},2500).animate({top:0,left:-100},0);
setTimeout("luch();", 5000);
}
