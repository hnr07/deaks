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
	"email_2",						// Доп. e-mail
	"tel",							// Телефон
	"skype",						// Скайп
	"tel_2",						// Доп. телефон
	"sex",							// Пол
	"birthday",						// Дата рождения
	"age",							// Возраст 
	"country",						// Гражданство
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
	
	"ip_sp",						// Серия внутреннего паспорта
	"ip_np",						// Номер внутреннего паспорта
	"ip_date",						// Дата выдачи внутреннего паспорта
	//"ip_ready",						// Нет Удостоверения личности? Укажите дату
	
	"p_hotel",						// Вариант проживания
	//"d_leader_ship", 				// Участие в Leader Ship
	//"s_leader_ship",  				// Соучастие в Leader Ship
	"day_hotel_start",				// Дата начала проживания
	"day_hotel_finish", 	       // Дата окончания проживания
	"day_hotel",					// Дней проживания в отеле
	"hotel",  						// Отель
	"nomer",						// Номер
	//"day_hotel_start_ls",  			// Дата начала проживания на Leader Ship
	//"day_hotel_finish_ls",  		// Дата окончания проживания на Leader Ship
	//"hotel_ls",						// Отель на Leader Ship
	//"nomer_ls",  	 				// Номер  на Leader Ship
	"medical_insurance",  			// Медицинская страховка
	//"guest_card",					// Гостевая карта
	"p_fly",  						// Вариант перелета
	"fly_1",  						// Перелет туда
	"fly_2",						// Перелет обратно
	"p_transfer",  					// Транcфер
	
	"d_konf",  						// Участие в форуме
	"d_ujin",						// Участие в гала ужине
	"d_eat_2",  					// Питание на форуме
	"d_eat_1", 						// Питание в гостинице
	"d_futbolka",					// Размерный ряд
	"futbolka",				   		// Футболка
	"interpretation",  	 			// Синхронный перевод
	"interpretation_lang",  		// Выберите язык для синхронного перевода
	//"second_interpretation_lang", 	// Дополнительный язык для синхронного перевода
	"mesto",						// Место
	"d_vopros_1",					// Один запасной вопрос
	"venue",					    // Площадка
	//"id_venue",					    // ID площадки
	
];

$(document).ready(function(){
	
	// Запрещаем обработку формы по кнопке Enter
	 $("form").keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
      }
   });
	
// Построение графика шагов
var ww=170; var ws;
var forpa =$("#t_step").val();
if(forpa==3) ws=ww;
else ws=ww/2;
$(".grafik .prok").css("width",(ww*forpa-ws)+"px");
for(var i=0;i<forpa;i++) {$(".grafik .circ:eq("+i+")").addClass("circ_ps");}


//$("form").click(function(){sen_por();});
//$("form").keyup(function(){sen_por();});
//$("form").mouseup(function(){sen_por();});
$("form input").change(function(){sen_por(); pro_po(this);});
//$("#ti_blo_birthday select").change(function(){sen_por_birthday();});
//$("#ti_blo_ip_passport select").change(function(){sen_por_ip_passport();});
//$("#ti_blo_country select").change(function(){sen_por_country();});
//$("#ti_blo_ip_ready select").change(function(){sen_por_ip_ready();});
//$("#ti_blo_p_ready select").change(function(){sen_por_p_ready();});
//$("#ti_blo_p_date select").change(function(){sen_por_p_date();});
$("#ti_blo_p_due_date select").change(function(){sen_por_p_due_date();});
//$("#ti_blo_interpretation_lang select").change(function(){sen_por_interpretation_lang();});
//$("#ti_blo_fly_1 select").change(function(){sen_por_fly_1();sen_por_fly_0();});
//$("#ti_blo_fly_2 select").change(function(){sen_por_fly_2();});
//$("#ti_blo_day_hotel_start select").change(function(){sen_por_day_hotel_start();});
//$("#ti_blo_day_hotel_finish select").change(function(){sen_por_day_hotel_finish();});
//$("#ti_blo_hotel select").change(function(){sen_por_hotel();});
//$("#ti_blo_nomer select").change(function(){sen_por_nomer();});

// Изменение стилей радио-кнопок
  $(".i_rb label").click(function() {
	  var lb=$(this).parent(".i_rb").parent(".ti_blo").children(".i_rb").children("label");
		lb.removeClass("l_r_a").addClass("l_r");
		$(this).toggleClass("l_r_a");
 
 });
 
// Закрываем текст ошибки
  $(".in_er").click(function() {
	  var lb=$(this).css({"display":"none"});
 });


//$(function() {
	// Обработка выпадающего списка (вместо select)
    $('.ober_div .coon').click(function(event) {
        $(this).next(".coon_s").fadeIn();
    });
	
   $(document).click( function(event){
      if( $(event.target).closest(".coon").length ) 
        return;
      $(".coon_s").fadeOut("slow");
      event.stopPropagation();
    });
	
	$('.coon_s div').click(function(event) {
		var t=$(this).html();
		var v=$(this).attr('value');
		//alert(t);
		$(this).parent().parent().children(".coon_t").html(t);
		$(this).parent().parent().children(".coon_t").attr("value",v);
		//$(this).parent().parent().children(".coon_t").next("div").css("background","red");
	});
	
//});


// Сброс выбора ОП
$("#opl_1").click(function(){f_click_country("");$("#sel_op_country .coon_t").html("");});

// комментарий к полю
	$(".qm").click(function() {	
		//$(this).next(".qm_text").css({"display":"block"});	
		//$(this).css({"display":"none"});
		$(this).parent("div").next(".qm_text").slideToggle("fast");//css({"display":"block"});	
	});
	$(".qm_text").click(function() {	
		$(this).slideToggle("fast");//css({"display":"none"});	
		//$(this).prev(".qm").css({"display":"block"});
	});

$("#slide_venue, #ti_blo_venue input").click(function(){
	if($("#slide_venue").attr("block")=="Y") $("#gde_volna").slideToggle("slow");	
	});
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
// функция проверки полей на заполненность
function polto_rth(pto) {
	//if($("#ti_blo_"+pto+" select").attr("id")=="sel_"+pto) {
	//	t=$("#ti_blo_"+pto+" option:selected").val();
	//}
	//else {
		var type=$("#ti_blo_"+pto+" input").attr("type");
		//alert(type);
		if(type=="text" || type=="hidden") {
			t=$("#ti_blo_"+pto+" input:"+type+":eq(0)").val();
		}
		if(type=="radio") {
			t=$("#ti_blo_"+pto+" input:radio").filter(":checked").val();
		}
	//}
return t;
}
//////////////////////////////////////////////////////

// функция проверки полей с учётом условий
function pro_po(ip) {
	var at=$(ip).parents(".ti_blo").attr("id").replace("ti_blo_",""); // символьный код блока
//alert (at);
var io=$("#ti_blo_"+at+" .in_er");

	//регулярные выражения
	var reg_chk = /^[0-9]{6,7}$/;   //  номер - только 6-7 цифр 
	var reg_fio = /^[a-zA-Zа-яА-Я-_Ёё ]+$/;   // только буквы, пробел и дефис - кирилица, латынь
	var reg_fio_lat = /^[a-zA-Z- ]+$/;   // только буквы, пробел и дефис - кирилица, латынь
	var reg_mail =/^[a-zA-Z0-9][-\._a-zA-Z0-9]+@[\w-\._]+\.\w{2,4}$/i;//var reg_mail =/^\w+@\w+\.\w{2,4}$/i;
	var reg_phone = /^[0-9-)(+ ]+$/;  // телефон - цифры скобки плюс дефис пробел

	if(far_epo(at)) {

		switch($("#ti_blo_"+at+" input").attr("reg")) {
			case "reg_chk":var reg=!reg_chk.test(polto_rth(at));break; // проверка поля с применением регулярного выражения
			case "reg_fio":var reg=!reg_fio.test(polto_rth(at));break; // проверка поля с применением регулярного выражения
			case "reg_fio_lat":var reg=!reg_fio_lat.test(polto_rth(at));break; // проверка поля с применением регулярного выражения
			case "reg_mail":var reg=!reg_mail.test(polto_rth(at));break; // проверка поля с применением регулярного выражения
			case "reg_phone":var reg=!reg_phone.test(polto_rth(at));break; // проверка поля с применением регулярного выражения
			
			case "if_reg_mail":if(polto_rth(at)=="") var reg=false; else var reg=!reg_mail.test(polto_rth(at));break; // проверка поля с применением регулярного выражения по дополнительному условию
			case "if_reg_skype":     // проверка поля с применением регулярного выражения по дополнительному условию
								sel=$("#ti_blo_prioritet input:radio").filter(":checked").val();
								hisel_2=$("#ti_blo_prioritet input:radio:eq(2)").val();
								
								if(sel!=hisel_2) var reg=false; else {if(polto_rth(at)) var reg=false; else var reg=true;}break;
		
			case "if_reg_day_hotel": if(($("#ti_blo_"+at+" input:text:eq(0)").val()*1)>0) var reg=false; else var reg=true; break; // проверка поля по дополнительному условию

			default:if(polto_rth(at)) var reg=false; else var reg=true; // проверка поля только на заполненность
		}

		if(reg) {io.css({"display":"block"});return 1;}
		else {io.css({"display":"none"});return 0;}
	}
	else return 0;

}

// Функция проверки всех полей на странице
function res_pro(sid_bp) {
	var kb=$('.ti_blo:visible').length;
//alert(kb);
	var so=0;
	for(var i=0;i<kb;i++) {
		so=so+pro_po($(".ti_blo:visible:eq("+i+") input"));
	}
	//alert(so);
	if(so) { 
		var th_1=$("#ti_but_"+sid_bp+" button").html();
		var th_2=$("#ti_but_"+sid_bp+" .sktt_2").html();
		
		if(th_1.indexOf(th_2)==-1) $("#ti_but_"+sid_bp+" button").html(th_1+": "+th_2+" - <span>"+so+"</span>");
		else $("#ti_but_"+sid_bp+" button span").html(so);

	}
	else {
		var th_3=$("#ti_but_"+sid_bp+" .sktt_1").html();
		$("#ti_but_"+sid_bp+" button").html(th_3);
		switch(sid_bp){
		case 'proverka':filter_chk_ajax();break;
		case 'proverka_check':check_chk_ajax();break;
		case 'proverka_op':op_chk();break;
		case 'form_submit':$("#loading").fadeIn(10);$('#but_bot_3_a').click();break;
		}
	}

}

function op_chk() {
	$(".div_pro_ok").css({"display":"block"});
	$("#ti_but_proverka_op").css({"display":"none"});
	$(".div_oplata_ok select").attr("disabled","disabled");
	$(".div_oplata_ok input").attr("readonly","readonly");
	var ig=$("#ti_blo_oplata input:radio").filter(":checked").attr("id");
	$("#ti_blo_oplata input").parent("div").css({"display":"none"});
	$("#ti_blo_oplata input[id='"+ig+"']").parent("div").css({"display":"block"});
	var ig=$("#ti_blo_time_money_op input:radio").filter(":checked").attr("id");
	$("#ti_blo_time_money_op input").parent("div").css({"display":"none"});
	$("#ti_blo_time_money_op input[id='"+ig+"']").parent("div").css({"display":"block"});
	$(".b2").css({"display":"block"});
}

// функция дополнительных обработок полей
function sen_por() {

		// доп обработка поля Статус
	sen_por_status();
	
		// доп обработка поля Оплата
	sen_por_oplata();
		
		// доп обработка поля Нуждаюсь в синхронном переводе
	sen_por_interpretation();
	
		// доп обработка поля Наличие загранпаспорта
	sen_por_p_nal();
	
		// доп обработка поля Вариант перелета
	sen_por_p_fly();
	
		// доп обработка поля Вариант проживания
	sen_por_p_hotel();

	// доп обработка поля Удостоверение личности
	//sen_por_ip_passport();
	
		// доп обработка поля Участие в конференции
	sen_por_d_konf();
		
}

	// доп обработка поля Участие в конференции
function sen_por_d_konf(){
	var sel;var hisel_0;
	sel=$("#ti_blo_d_konf input:radio").filter(":checked").val();
	hisel_0=$("#ti_blo_d_konf input:radio:eq(0)").val();
	
	if(sel!=undefined) {
		if(sel==hisel_0) {
			$("#div_futbolka_0").css("display", "block");
			$("#div_futbolka_0 input").attr("checked","checked");
			$("#div_futbolka_0 label").click();
			$("#div_futbolka_1").css("display", "none");
		}
		else {
			$("#div_futbolka_1").css("display", "block");
			$("#div_futbolka_1 input").attr("checked","checked");
			$("#div_futbolka_1 label").click();
			$("#div_futbolka_0").css("display", "none");
		}
	}
	else {
		$("#div_futbolka_1").css("display", "block");
		$("#div_futbolka_1 input").attr("checked","checked");
		$("#div_futbolka_1 label").removeClass("l_r").addClass("l_r_a");
		$("#div_futbolka_0").css("display", "none");
	}
	//$("#futbolka_1 label").click();
}

// доп обработка поля Статус
function sen_por_status() {
	var sel;var hisel_0;var hisel_1;var hisel_2;
	if(far_epo("status")) {
		sel=$("#ti_blo_status input:radio").filter(":checked").val();
		hisel_0=$("#stat_0").val();
		hisel_1=$("#stat_1").val();
		hisel_2=$("#stat_2").val();
		//alert(sel);
		if(sel) {
			if(sel==hisel_0) {
				$("#sipo_1").css("display", "inline-block" );
				$("#sipo_2").css("display", "inline-block" );
				$("#sipo_0").css("display", "none" );
				$("#sipo_0 input:text").val("");
				$("#tipl").val("1");
			}
			else {
				$("#sipo_0").css("display", "inline-block");
				$("#sipo_2").css("display", "inline-block");
				if(sel==hisel_1) {$("#sipo_1").css("display", "inline-block");}
				else {$("#sipo_1").css("display", "none"); $("#sipo_1 input:text").val("");}
				$("#tipl").val("0");
			}
			
			$("#titu").css("display", "block" );
		}
		else $("#titu").css("display", "none" );
	}
}
// доп обработка поля Оплата
function sen_por_oplata() {
	var sel;var hisel_0;
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
				$("#op_div input:text").attr("disabled",true);
			}
			else {
				$("#op_div").css("display", "block" );
				$("#pl_div").css("display", "none" );
				$("#pl_div  input:text").val("");
				$("#pl_div  input:radio:eq(0)").attr("checked","checked");	
				$("#op_div input:text").prop("disabled",false);
			}
		}
	}
}
// доп обработка отдельных полей поля Дата рождения
function sen_por_birthday_i(d,n) {
	var b_d;var b_m;var b_y;
		switch(n) {
		case 1:	b_d=$(this).attr("value");break;
		case 2:	b_m=$(this).attr("value");break;
		case 3:	b_y=$(this).attr("value");break;
		}
}
// доп обработка поля Дата рождения
function sen_por_birthday(t,n) {
	if(far_epo("birthday")) {
		
		var b_d=$("#ti_blo_birthday #b_d_birthday .coon_t").attr("value");
		var b_m=$("#ti_blo_birthday #b_m_birthday .coon_t").attr("value");
		var b_y=$("#ti_blo_birthday #b_y_birthday .coon_t").attr("value");
		switch(n) {
			case 1:	b_d=t;break;
			case 2:	b_m=t;break;
			case 3:	b_y=t;break;
		}
		var b_v=f_dmy(b_d,b_m,b_y);
		//alert(b_v);
		var ip=$("#ti_blo_birthday input:text:eq(0)");
		ip.val(b_v);
		pro_po(ip);
		
		var mydate = new Date();
		mydate.setFullYear(b_y, b_m-1, b_d);
		var currdate = new Date();
		currdate.setFullYear(currdate.getFullYear());
		var ry=new Date();
		ry=currdate.getFullYear()- mydate.getFullYear();
		if(currdate.getMonth() < mydate.getMonth()) ry=ry-1;
		if(currdate.getMonth() == mydate.getMonth()) {
			if(currdate.getDate() < mydate.getDate()) ry=ry-1;
		}
		
		if(b_v!="")	$("#ti_blo_birthday input:text:eq(1)").val(ry);
		
	}
}

// доп обработка поля Гражданство 
function sen_por_country(sp) {
	var str=$("#yes_ip_passport").val();
	$("#ti_blo_country input:text:eq(0)").val(sp);
	if(str.indexOf(sp) + 1) $("#div_ip_passport").css("display", "block" );
	else $("#div_ip_passport").css("display", "none" );
}

// доп обработка поля Удостоверение личности 
function sen_por_ip_passport() {
	//var sp=$("#ti_blo_ip_passport #sel_ip_passport option:selected").val();
	var sp=($(this).html()).replace(/[\r\n]/g,'');alert(sp);
	$("#ti_blo_ip_passport input:text:eq(0)").val(sp);
}

// доп обработка поля Дата выдачи внутреннего паспорта 
function sen_por_ip_date(t,n) {
		var b_d=$("#ti_blo_ip_date #b_d_ip_date .coon_t").attr("value");
		var b_m=$("#ti_blo_ip_date #b_m_ip_date .coon_t").attr("value");
		var b_y=$("#ti_blo_ip_date #b_y_ip_date .coon_t").attr("value");
		//alert(b_d);
		switch(n) {
			case 1:	b_d=t;break;
			case 2:	b_m=t;break;
			case 3:	b_y=t;break;
		}
		var b_v=f_dmy(b_d,b_m,b_y);
	$("#ti_blo_ip_date input:text:eq(0)").val(b_v);
}

// доп обработка поля Нет удостоверения личности? Укажите дату 
function sen_por_ip_ready(t,n) {
		var b_d=$("#ti_blo_ip_ready #b_d_ip_ready .coon_t").attr("value");
		var b_m=$("#ti_blo_ip_ready #b_m_ip_ready .coon_t").attr("value");
		var b_y=$("#ti_blo_ip_ready #b_y_ip_ready .coon_t").attr("value");
		//alert(b_d);
		switch(n) {
			case 1:	b_d=t;break;
			case 2:	b_m=t;break;
			case 3:	b_y=t;break;
		}
		var b_v=f_dmy(b_d,b_m,b_y);
	$("#ti_blo_ip_ready input:text:eq(0)").val(b_v);
}

// доп обработка поля Нет загранпаспорта? Укажите дату
function sen_por_p_ready(t,n) {
		var b_d=$("#ti_blo_p_ready #b_d_p_ready .coon_t").attr("value");
		var b_m=$("#ti_blo_p_ready #b_m_p_ready .coon_t").attr("value");
		var b_y=$("#ti_blo_p_ready #b_y_p_ready .coon_t").attr("value");

		switch(n) {
			case 1:	b_d=t;break;
			case 2:	b_m=t;break;
			case 3:	b_y=t;break;
		}
	var b_v=f_dmy(b_d,b_m,b_y);
		var ip=$("#ti_blo_p_ready input:text:eq(0)");
		ip.val(b_v);
		pro_po(ip);
}

// доп обработка поля Дата выдачи загранпаспорта
function sen_por_p_date(t,n) {
		var b_d=$("#ti_blo_p_date #b_d_p_date .coon_t").attr("value");
		var b_m=$("#ti_blo_p_date #b_m_p_date .coon_t").attr("value");
		var b_y=$("#ti_blo_p_date #b_y_p_date .coon_t").attr("value");
		switch(n) {
			case 1:	b_d=t;break;
			case 2:	b_m=t;break;
			case 3:	b_y=t;break;
		}
		var b_v=f_dmy(b_d,b_m,b_y);
		var ip=$("#ti_blo_p_date input:text:eq(0)");
		ip.val(b_v);
		pro_po(ip);
}

// доп обработка поля Действие загранпаспорта
function sen_por_p_due_date(t,n) {
	var b_d=$("#ti_blo_p_due_date #b_d_p_due_date .coon_t").attr("value");
		var b_m=$("#ti_blo_p_due_date #b_m_p_due_date .coon_t").attr("value");
		var b_y=$("#ti_blo_p_due_date #b_y_p_due_date .coon_t").attr("value");
		switch(n) {
			case 1:	b_d=t;break;
			case 2:	b_m=t;break;
			case 3:	b_y=t;break;
		}
		var b_v=f_dmy(b_d,b_m,b_y);
		var ip=$("#ti_blo_p_due_date input:text:eq(0)");
		ip.val(b_v);
		pro_po(ip);
}

// доп обработка поля Нуждаюсь в синхронном переводе
function sen_por_interpretation() {
	var sel;var hisel_0;
	if(far_epo("interpretation")) {
		sel=$("#ti_blo_interpretation input:radio").filter(":checked").val();
		hisel_0=$("#ti_blo_interpretation input:radio:eq(0)").val();
		
		if(sel){
			if(sel==hisel_0) {
				$("#div_interpretation_lang").css("display", "block" );
			}
			else {
				$("#div_interpretation_lang").css("display", "none" );	
			}
		}
	}
}

// доп обработка поля Язык для перевода
function sen_por_interpretation_lang(sp) {
	//var sp=$("#ti_blo_interpretation_lang #sel_interpretation_lang option:selected").val();
	$("#ti_blo_interpretation_lang input:text:eq(0)").val(sp);
}

// доп обработка поля Дополнительный язык для перевода
function sen_por_second_interpretation_lang(sp) {
	//var sp=$("#ti_blo_second_interpretation_lang #sel_second_interpretation_lang option:selected").val();
	$("#ti_blo_second_interpretation_lang input:text:eq(0)").val(sp);
}

// доп обработка поля Наличие загранпаспорта
function sen_por_p_nal() {
	var sel;var hisel_0;
	if(far_epo("p_nal")) {
		sel=$("#ti_blo_p_nal input:radio").filter(":checked").val();
		hisel_0=$("#ti_blo_p_nal input:radio:eq(0)").val();
		
		if(sel){
			if(sel==hisel_0) {
				$("#p_nal_ok").css("display", "block" );
				$("#p_nal_not").css("display", "none" );
				
				$("#p_nal_not input").attr("disabled",true);
				$("#p_nal_ok input").attr("disabled",false);
			}
			else {
				$("#p_nal_ok").css("display", "none" );
				$("#p_nal_not").css("display", "block" );
				
				$("#p_nal_not input").attr("disabled",false);
				$("#p_nal_ok input").attr("disabled",true);
			}
		}
	}
}

// доп обработка поля Вариант перелета
function sen_por_p_fly() {
	var sel;var hisel_0;
	if(far_epo("p_fly")) {
		sel=$("#ti_blo_p_fly input:radio").filter(":checked").val();
		hisel_0=$("#ti_blo_p_fly input:radio:eq(0)").val();
		
		if(sel!=undefined){
			if(sel==hisel_0) {
				$("#div_p_fly").css("display", "block" );
				$("#div_p_transfer_0").css("display", "block" );	
				$("#div_p_transfer_0  input").attr("checked","checked");
				$("#div_p_transfer_0  label").click();	
				$("#div_p_transfer_1").css("display", "none" );			
			}
			else {
				$("#div_p_fly").css("display", "none" );
				$("#div_p_transfer_1").css("display", "block" );
				$("#div_p_transfer_1  input").attr("checked","checked");	
				$("#div_p_transfer_1  label").click();	
				$("#div_p_transfer_0").css("display", "none" );					
			}
		}
	}
}

// доп обработка поля Перелет туда 
function sen_por_fly_1(sp,hp) {
	//var sp=$("#ti_blo_fly_1 #sel_fly_1 option:selected").val();
	//var hp="";
	//if(sp) hp=$("#ti_blo_fly_1 #sel_fly_1 option:selected").html();
	$("#ti_blo_fly_1 input:text:eq(0)").val(hp);
	$("#ti_blo_fly_1 input:text:eq(1)").val(sp);
}
// доп обработка поля Перелёт обратно 
function sen_por_fly_2(sp,hp) {
	//var sp=$("#ti_blo_fly_2 #sel_fly_2 option:selected").val();
	//var hp="";
	//if(sp) hp=$("#ti_blo_fly_2 #sel_fly_2 option:selected").html();
	$("#ti_blo_fly_2 input:text:eq(0)").val(hp);
	$("#ti_blo_fly_2 input:text:eq(1)").val(sp);
}

// доп обработка полей Перелет туда и  Перелёт обратно
function sen_por_fly_0(sp,hp) {
	//var sp=$("#ti_blo_fly_1 #sel_fly_0 option:selected").val();
	//var hp="";
	if(sp) {
		//hp=$("#ti_blo_fly_1 #sel_fly_0 option:selected").html();
		var ar_hp=hp.split("|");
	
	$("#ti_blo_fly_1 input:text:eq(0)").val(ar_hp[0]);
	$("#ti_blo_fly_1 input:text:eq(1)").val(sp);
	$("#ti_blo_fly_1 input:text:eq(2)").val(ar_hp[1]);
	$("#ti_blo_fly_1 input:text:eq(3)").val(sp);
	}
	
	
}

// доп обработка поля Вариант проживания 
function sen_por_p_hotel() {
	var sel;var hisel_0;
	if(far_epo("p_hotel")) {
		sel=$("#ti_blo_p_hotel input:radio").filter(":checked").val();
		hisel_0=$("#ti_blo_p_hotel input:radio:eq(0)").val();
		
		if(sel){
			if(sel==hisel_0) {
				var hotel_date=$("#hotel_date").val();
				
				$("#div_p_hotel").css("display", "block" );
					if(hotel_date==1) {
						date_v(1);
						$("#ti_blo_day_hotel_start option").attr("disabled","disabled");
						$("#ti_blo_day_hotel_finish option").attr("disabled","disabled");
						$(".hotmin").css("display","none");
						$("#ti_blo_day_hotel_start").css({"border":"0","height":"1px","min-height":"0px","margin":"0","padding":"0"});
						$("#ti_blo_day_hotel_finish").css({"border":"0","height":"1px","min-height":"0px","margin":"0","padding":"0"});
						
						
					}
					f_vp_sc_fly(1);
			}
			else {
				$("#div_p_hotel").css("display", "none" );
				
				var fly_date=$("#fly_date").val();
				if(fly_date==1) {

				$("#div_p_fly_0").css('display', 'none');
			$("#div_p_fly_1 label").click();	
				}				
				
			}
			//f_vp_sc_fly(1);
		}
	}
//	sen_por_day_hotel_start();
}

// доп обработка поля Отель
function sen_por_hotel(sp,hp) {
	//var sp=$("#ti_blo_hotel #sel_hotel option:selected").val();
	//var hp="";
	//if(sp) hp=$("#ti_blo_hotel #sel_hotel option:selected").html();
	
	$("#ti_blo_hotel input:text:eq(0)").val(hp);
	$("#ti_blo_hotel input:text:eq(1)").val(sp);
}

// доп обработка поля Номер
function sen_por_nomer(sp,hp) {
	//var sp=$("#ti_blo_nomer #sel_nomer option:selected").val();
	//var hp="";
	//if(sp) hp=$("#ti_blo_nomer #sel_nomer option:selected").html();
	$("#ti_blo_nomer input:text:eq(0)").val(hp);
	$("#ti_blo_nomer input:text:eq(1)").val(sp);
}

// доп обработка поля Дата начала проживания
function sen_por_day_hotel_start(t,n) {
		var b_d=$("#ti_blo_day_hotel_start #b_d_day_hotel_start .coon_t").attr("value");
		var b_m=$("#ti_blo_day_hotel_start #b_m_day_hotel_start .coon_t").attr("value");
		var b_y=$("#ti_blo_day_hotel_start #b_y_day_hotel_start .coon_t").attr("value");
		//alert(b_d+"|"+b_m+"|"+b_y);
		switch(n) {
			case 1:	b_d=t;break;
			case 2:	b_m=t;break;
			case 3:	b_y=t;break;
		}
	var b_v=f_dmy(b_d,b_m,b_y);
		var ip=$("#ti_blo_day_hotel_start input:text:eq(0)");
		ip.val(b_v);
		pro_po(ip);
		f_add_day_hotel();
}

// доп обработка поля Дата окончания проживания
function sen_por_day_hotel_finish(t,n) {
	    var b_d=$("#ti_blo_day_hotel_finish #b_d_day_hotel_finish .coon_t").attr("value");
		var b_m=$("#ti_blo_day_hotel_finish #b_m_day_hotel_finish .coon_t").attr("value");
		var b_y=$("#ti_blo_day_hotel_finish #b_y_day_hotel_finish .coon_t").attr("value");
		switch(n) {
			case 1:	b_d=t;break;
			case 2:	b_m=t;break;
			case 3:	b_y=t;break;
		}
	var b_v=f_dmy(b_d,b_m,b_y);
		var ip=$("#ti_blo_day_hotel_finish input:text:eq(0)");
		ip.val(b_v);
		pro_po(ip);
		f_add_day_hotel();
}





	
// Копирование данных участника в данные пользователя
function plachu_sam() {
	sel=$("#tipl").val();
		
	if(sel==0) {
		var pc=$("#ti_blo_kem_priglashen_chk input").val();
		var pn=$("#ti_blo_kem_priglashen_name input").val();
		var pf=$("#ti_blo_kem_priglashen_family input").val();
	}
	else {
		var pc=$("#ti_blo_chk input").val();
		var pn=$("#ti_blo_name input").val();
		var pf=$("#ti_blo_family input").val();	
	}
	$("#ti_blo_pl_chk input").val(pc);
	$("#ti_blo_pl_name input").val(pn);
	$("#ti_blo_pl_family input").val(pf);
}

// Функция построения даты
function f_dmy(b_d,b_m,b_y) {
	if(b_d && b_d<10) b_d="0"+b_d;
	if(b_m && b_m<10) b_m="0"+b_m;
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

// Функция добавления дней проживания
function f_add_day_hotel() {
	var ry=f_d_sf("day_hotel_start","day_hotel_finish");
	var ip_1=$("#ti_blo_day_hotel_start input:text:eq(0)");
	var ip_2=$("#ti_blo_day_hotel_finish input:text:eq(0)");
		if(ip_1.val()!="" && ip_2.val()!="")	{
			$("#ti_blo_day_hotel input:text:eq(0)").val(ry);
			$("#dpo").html(": "+ry);
			pro_po("#ti_blo_day_hotel input:text:eq(0)");
			
			
		} 
	//alert(1);
	//f_vp_sc_hotel(1);
	f_vp_sc_fly(1);
}

//// Добавление рекомендуемых дат проживания из комментария в поля
function date_v(n) {
		var ds=$.trim($("#pdp_s_"+n).html());
		var df=$.trim($("#pdp_f_"+n).html());

$("#ti_blo_day_hotel_start  input:text:eq(0)").val(ds);
$("#ti_blo_day_hotel_finish  input:text:eq(0)").val(df);
f_add_day_hotel();

var ds_ard=ds.split(".");

if(ds_ard[0][0]=="0") ds_ard[0]=ds_ard[0][1];
//$("#ti_blo_day_hotel_start #b_d_day_hotel_start [value="+ds_ard[0]+"]").attr("selected", "selected");
$("#ti_blo_day_hotel_start #b_d_day_hotel_start .coon_t").html(ds_ard[0]);
$("#ti_blo_day_hotel_start #b_d_day_hotel_start .coon_t").attr("value",ds_ard[0]);

if(ds_ard[1][0]=="0") ds_ard[1]=ds_ard[1][1];
//$("#ti_blo_day_hotel_start #b_m_day_hotel_start [value="+ds_ard[1]+"]").attr("selected", "selected");
var mos=$("#ti_blo_day_hotel_start #b_m_day_hotel_start .coon_s div[value="+ds_ard[1]+"]").html();
$("#ti_blo_day_hotel_start #b_m_day_hotel_start .coon_t").html(mos);
$("#ti_blo_day_hotel_start #b_m_day_hotel_start .coon_t").attr("value",ds_ard[1]);

//$("#ti_blo_day_hotel_start #b_y_day_hotel_start [value="+ds_ard[2]+"]").attr("selected", "selected");
$("#ti_blo_day_hotel_start #b_y_day_hotel_start .coon_t").html(ds_ard[2]);
$("#ti_blo_day_hotel_start #b_y_day_hotel_start .coon_t").attr("value",ds_ard[2]);


var df_ard=df.split(".");

if(df_ard[0][0]=="0") df_ard[0]=df_ard[0][1];
//$("#ti_blo_day_hotel_finish #b_d_day_hotel_finish [value="+df_ard[0]+"]").attr("selected", "selected");
$("#ti_blo_day_hotel_finish #b_d_day_hotel_finish .coon_t").html(df_ard[0]);
$("#ti_blo_day_hotel_finish #b_d_day_hotel_finish .coon_t").attr("value",df_ard[0]);

if(df_ard[1][0]=="0") df_ard[1]=df_ard[1][1];
//$("#ti_blo_day_hotel_finish #b_m_day_hotel_finish [value="+df_ard[1]+"]").attr("selected", "selected");
var mof=$("#ti_blo_day_hotel_finish #b_m_day_hotel_finish .coon_s div[value="+ds_ard[1]+"]").html();
$("#ti_blo_day_hotel_finish #b_m_day_hotel_finish .coon_t").html(mof);
$("#ti_blo_day_hotel_finish #b_m_day_hotel_finish .coon_t").attr("value",ds_ard[1]);

//$("#ti_blo_day_hotel_finish #b_y_day_hotel_finish [value="+df_ard[2]+"]").attr("selected", "selected");
$("#ti_blo_day_hotel_finish #b_y_day_hotel_finish .coon_t").html(df_ard[2]);
$("#ti_blo_day_hotel_finish #b_y_day_hotel_finish .coon_t").attr("value",df_ard[2]);

}

/*
// Сброс дат проживания
function date_0() {
	$("#ti_blo_day_hotel_start  input:text:eq(0)").val('');
	$("#ti_blo_day_hotel_finish  input:text:eq(0)").val('');
	$("#ti_blo_day_hotel input:text:eq(0)").val('');
	$("#dpo").html('');
	
	$("#ti_blo_day_hotel_start option").removeAttr("selected");
	
	$("#ti_blo_day_hotel_start #b_d_day_hotel_start-button span").html("---");
	
	$("#ti_blo_day_hotel_start #b_m_day_hotel_start-button span").html("---");
	
	$("#ti_blo_day_hotel_start #b_y_day_hotel_start-button span").html("---");
	
	$("#ti_blo_day_hotel_finish option").removeAttr("selected");
	
	$("#ti_blo_day_hotel_finish #b_d_day_hotel_finish-button span").html("---");
	
	$("#ti_blo_day_hotel_finish #b_m_day_hotel_finish-button span").html("---");
	
	$("#ti_blo_day_hotel_finish #b_y_day_hotel_finish-button span").html("---");
	
	
}
*/

// Доп. обработка полей вариантов перелёта от рекомендуемых дат.
function f_vp_sc_fly(n) {
	var fly_date=$("#fly_date").val();
	//alert(fly_date);
	if(fly_date==1) {
		var dvs=$("#ti_blo_day_hotel_start  input:text:eq(0)").val();
		var dvf=$("#ti_blo_day_hotel_finish  input:text:eq(0)").val();
		var ds=$.trim($("#pdp_s_"+n).html());
		var df=$.trim($("#pdp_f_"+n).html());
		if(dvs==ds && dvf==df) {
			$("#div_p_fly_0").css('display', 'inline-block');
		}	else {
			$("#div_p_fly_0").css('display', 'none');
			$("#div_p_fly_1 label").click();
		}
	}
	else {$("#div_p_fly_0 label").click();}

	sen_por_p_fly();
}
/*
// Доп. обработка полей вариантов проживания от рекомендуемых дат.
function f_vp_sc_hotel(n) {
	var hotel_date=$("#hotel_date").val();
	if(hotel_date==1) {
		var dvs=$("#ti_blo_day_hotel_start  input:text:eq(0)").val();
		var dvf=$("#ti_blo_day_hotel_finish  input:text:eq(0)").val();
		var ds=$.trim($("#pdp_s_"+n).html());
		var df=$.trim($("#pdp_f_"+n).html());
		if(dvs==ds && dvf==df) {
			$("#div_p_hotel_0").css('display', 'inline-block');
		}	
		else {
			$("#div_p_hotel_0").css('display', 'none');
			$("#div_p_hotel_1 label").click();
			
		}
	}
	else {$("#div_p_hotel_0 label").click();}
	sen_por_p_hotel();
}
*/
