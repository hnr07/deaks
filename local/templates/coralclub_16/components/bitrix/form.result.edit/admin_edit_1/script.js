		//Проверка подключения jQuery
	
	//if (window.jQuery) alert("Библиотека jQuery подключена");
   // else alert("Библиотека jQuery не подключена");
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
	
	//"ip_sp",						// Серия Удостоверения личности
	//"ip_np",						// Номер Удостоверения личности
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
	"d_futbolka",					// Размер футболки
	"interpretation",  	 			// Синхронный перевод
	"interpretation_lang",  		// Выберите язык для синхронного перевода
	//"second_interpretation_lang", 	// Дополнительный язык для синхронного перевода
	"mesto",						// Место
	"d_vopros_1",					// Один запасной вопрос
	"venue",					    // Площадка
	//"id_venue",					    // ID площадки
	"currency_id",            		//ID валюты
	"currency"            	    	//SID валюты
	
];
$(document).ready(function(){
	
	$(".zkl_t").eq(3).addClass("active");
	$(".zkl_d").eq(3).show();
		$(".zkl_b .zkl_t").click(function(){
		$(this).next(".zkl_d").slideToggle("slow")
		.siblings(".zkl_d:visible").slideUp("slow");
		
		$(this).toggleClass("active");
		$(this).siblings(".zkl_t").removeClass("active");
		

	});


	
	$("form input").change(function(){sen_por(); /*pro_po(this);*/});
	
		
	$("#opl_1").click(function(){f_click_country("");$("#sel_op_country .coon_t").html("");});
	
	//$("#ti_blo_birthday input").onblur(function(){sen_por_birthday();alert(1);});
	
});
	// функция дополнительных обработок полей
function sen_por() {

		// доп обработка поля Статус
//	sen_por_status();
	
		// доп обработка поля Оплата
	sen_por_oplata();
		
		// доп обработка поля Нуждаюсь в синхронном переводе
//	sen_por_interpretation();
	
		// доп обработка поля Наличие загранпаспорта
	sen_por_p_nal();
	
		// доп обработка поля Вариант перелета
	sen_por_p_fly();
	
		// доп обработка поля Вариант проживания
	sen_por_p_hotel();

	// доп обработка поля Удостоверение личности
	//sen_por_ip_passport();
	
	// доп обработка поля Дата рождения
	sen_por_birthday();
		
}
	
	// доп обработка поля Оплата
function sen_por_oplata() {
	var sel;var hisel_0;
	//if(far_epo("oplata")) {
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
				check_chk_ajax();
			}
			else {
				$("#op_div").css("display", "block" );
				$("#pl_div").css("display", "none" );
				$("#pl_div  input:text").val("");
				$("#pl_div  input:radio:eq(0)").attr("checked","checked");	
				$("#op_div input:text").prop("disabled",false);
				f_chang_country();
			}
		}
	//}
}
		
// функция построения списка городов по выбранной стране
 function f_chang_country() {
	var y=$("#sel_op_country option:selected").val();
	var iyc=$("#fld_op_city").val();
	var iyn=$("#fld_op_nof").val();
	//alert(iyc);
	$("#sel_op_city").html(""); 
	
			$.ajax({ 
				type: "POST",			
                url: "../../vop_edit.php",
				data: "vcountry="+y+"&i_city="+iyc+"&i_nof="+iyn,  
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
	var iyc=$("#fld_op_city").val();
	var iyn=$("#fld_op_nof").val();

	$("#sel_op_nof").html("");
			$.ajax({ 
				type: "POST",			
                url: "../../vop_edit.php",
				data: "vcity="+y+"&i_city="+iyc+"&i_nof="+iyn,  
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
	var iyc=$("#fld_op_city").val();
	var iyn=$("#fld_op_nof").val();
	var code_m=$("#fld_code_m").val(); //код мероприятия
	 $.ajax({ 
				type: "POST",			
                url: "../../vop_edit.php",
				data: "vnof="+y+"&i_city="+iyc+"&i_nof="+iyn,  
                cache: false,  
                success: function(html){  
					var ar_h = html.split("^");
					//$("#tr").html(html);
					$("#currency_id").val(ar_h[0]);
					$("#currency").val(ar_h[1]);
					check_course_ajax(code_m, ar_h[0],ar_h[1]); // функция выбора курса
                }  
            });
	//setTimeout("sub_but()",1000);
	//sub_but();
 }

// функция проверки плательщика
function check_chk_ajax() {
	//$("#loading").css("display", "block");
	$("#loading").fadeIn("slow");
	var fop=$("#ti_blo_oplata input:radio").filter(":checked").val();//какой способ оплаты выбран
	var hifop=$("#ti_blo_oplata input:radio:eq(0)").val();  // первый способ оплпты для сравнения 
	var gn=$("#ti_blo_time_money_chk input:radio").filter(":checked").val(); //какая  выбрана рассрочка
	var gnh=$("#ti_blo_time_money_chk input:radio:eq(0)").val(); // первый тип рассрочки для сравнения 
		
		var p_chk=$("#ti_blo_pl_chk input:text:eq(0)").val();  //№ ЧК плательщика 
		var p_family=$("#ti_blo_pl_family input:text:eq(0)").val();  //Фамилия плательщика 
		var p_name=$("#ti_blo_pl_name input:text:eq(0)").val(); //Имя плательщика 
		var gr_chk=$("#ti_blo_garant_chk input:text:eq(0)").val(); // № ЧК гаранта
		var gr_family=$("#ti_blo_garant_family input:text:eq(0)").val(); // Фамилия гаранта
		var gr_name=$("#ti_blo_garant_name input:text:eq(0)").val();  // Имя гаранта
		var chk=$("#ti_blo_chk input:text:eq(0)").val();    //№ ЧК 
		var code_m=$("#fld_code_m").val(); //код мероприятия
		var stts="";
		var br="";
				// Проверка если плательщик и заявитель одно лицо 
				if(p_chk == chk) stts=1;   //Если № ЧК равен № ЧК плательщика
				else stts=0;   //Если № ЧК не равен № ЧК плательщика
				if(gn == gnh) br=1; // Если оплата без рассрочки
				else br=0; // Если оплата с рассрочкой
				
				$.ajax({  
					type: "POST",
					url: "../../filter/filter_check_chk.php",  
					data: "p_chk="+p_chk+"&p_family="+p_family+"&p_name="+p_name+"&stts="+stts+"&br="+br+"&gr_chk="+gr_chk+"&gr_family="+gr_family+"&gr_name="+gr_name+"&code_m="+code_m, 
					cache: false,  
					success: function(html){ 
						//$("#tr").html(html);
						var ar_h=html.split("^");
						//ar_h[0] - текст ошибки
						//ar_h[1] - id валюты
						//ar_h[2] - символьный код валюты
						//ar_h[3] - возвращаемый проверкой плательщика параметр
						//ar_h[4] - e-mail плательщика
						//ar_h[5] - код необходимости гаранта 1-нужен, 0 - не нужен
						//ar_h[6] - код ошибки
						
						//ar_h[6]=0; // игнорировать ошибки

						var pf=0;  // флаг перехода на следующий шаг
						if(ar_h[6]==0) // Ошибки нет
						{
						pf=1;
						}
						else  // Ошибка есть
						{
							pf=0;
								if((ar_h[6]==2 || ar_h[6]==5))	{// ошибка проверки гаранта
									if(ar_h[5]) {// гарант нужен
											if(gn==gnh) {	//если без рассрочки гарант не нужен
											$("#garant_div").css("display","none");
											pf=1;
											}									
											else { // если есть рассрочка гарант нужен
											$("#garant_div").css("display","block");
											
											}
									}
									else pf=1; // гарант не нужен
								}
								
						}
						if(pf) {
							$("#currency_id").val(ar_h[1]); // В поле ID валюты - ID валюты
							$("#currency").val(ar_h[2]);// В поле валюта - символьный код валюты
							$("#promotion_3").val(ar_h[3]); // В поле промоушен оплата -  - возвращаемый проверкой плательщика параметр
							
							$(".div_pro_ok").css({"display":"block"});
							//$("#ti_but_proverka_check").css({"display":"none"});
							$("#but_plachu_sam").css({"display":"none"});
							$(".div_oplata_ok input").attr("readonly","readonly");
							var ig=$("#ti_blo_oplata input:radio").filter(":checked").attr("id");
							$("#ti_blo_oplata input").parent("div").css({"display":"none"});
							$("#ti_blo_oplata input[id='"+ig+"']").parent("div").css({"display":"block"});
							var ig=$("#ti_blo_time_money_chk input:radio").filter(":checked").attr("id");
							$("#ti_blo_time_money_chk input").parent("div").css({"display":"none"});
							$("#ti_blo_time_money_chk input[id='"+ig+"']").parent("div").css({"display":"block"});	
							$(".b2").css({"display":"block"});
							$(".div_pl_error").html("Проверка пройдена.");
							check_course_ajax(code_m, ar_h[1],ar_h[2]); // функция выбора курса
							
						}
						else {
							$("#currency_id").val(""); // В поле ID валюты - ID валюты
							$("#currency").val("");// В поле валюта - символьный код валюты
							$("#promotion_3").val(""); // В поле промоушен оплата -  - возвращаемый проверкой плательщика параметр
							$(".div_pl_error").html(ar_h[0]);
						}
						
						
						$("#loading").css("display", "none");
						
					}	
				}); 
	
}
// функция выбора курса
function check_course_ajax(code_m, nc_id,v) {
	//var nc_id=$("#currency_id").val(); // id нового курса
	//var code_m=$("#fld_code_m").val(); //код мероприятия
	$("#ti_blo_m_course #sid_c").html(v);
	var vi=$("#currency").val();
	$("#loading").fadeIn("slow");
	$.ajax({  
		type: "POST",
		url: "../../filter/filter_course.php",  
		data: "nc_id="+nc_id+"&code_m="+code_m, 
		cache: false,  
		success: function(html){ 
			//$("#tr").html(html);
			$("#m_course").html(html);
		}	
	});
	if(vi!=v) alert("Внимание! \n\nВыбранный курс не соответствует валюте заявки!");
}

 //// Добавление рекомендуемых дат проживания из комментария в поля
function date_v(n) {
    var d_s = $("#pdp_s_" + n).html();
   var d_f = $("#pdp_f_" + n).html();
  // alert(d_s);
    var ds_ard = d_s.split(".");
    if (ds_ard[0][0] == "0") ds_ard[0] = ds_ard[0][1];
	if (ds_ard[1][0] == "0") ds_ard[1] = ds_ard[1][1];
    $("#ti_blo_day_hotel_start #b_d_day_hotel_start [value=" + ds_ard[0] + "]").attr("selected", "selected");
	$("#ti_blo_day_hotel_start #b_m_day_hotel_start [value=" + ds_ard[1] + "]").attr("selected", "selected");
	$("#ti_blo_day_hotel_start #b_y_day_hotel_start [value=" + ds_ard[2] + "]").attr("selected", "selected");
    
	var df_ard = d_f.split(".");
    if (df_ard[0][0] == "0") df_ard[0] = df_ard[0][1];
	if (df_ard[1][0] == "0") df_ard[1] = df_ard[1][1];
    $("#ti_blo_day_hotel_finish #b_d_day_hotel_finish [value=" + df_ard[0] + "]").attr("selected", "selected");
	$("#ti_blo_day_hotel_finish #b_m_day_hotel_finish [value=" + df_ard[1] + "]").attr("selected", "selected");
	$("#ti_blo_day_hotel_finish #b_y_day_hotel_finish [value=" + df_ard[2] + "]").attr("selected", "selected");

    $("#ti_blo_day_hotel_start #day_hotel_start").val(d_s);
    $("#ti_blo_day_hotel_finish #day_hotel_finish").val(d_f);

f_add_day_hotel();
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
			//$("#dpo").html(": "+ry);
			//pro_po("#ti_blo_day_hotel input:text:eq(0)");
			
			
		} 
	//alert(1);
	//f_vp_sc_hotel(1);
	//f_vp_sc_fly(1);
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
function f_chang_hotel() {
	var sp=$("#ti_blo_hotel option:selected").val();
	var hsp=$("#ti_blo_hotel option:selected").html();
	$("#id_hotel").val(sp);
	$("#hotel").val(hsp);
}

function f_chang_nomer() {
	var sp=$("#ti_blo_nomer option:selected").val();
	var hsp=$("#ti_blo_nomer option:selected").html();
	$("#id_nomer").val(sp);
	$("#nomer").val(hsp);
}

function f_chang_fly_0() {
	var sp=$("#sel_fly_0 option:selected").val();
	var hsp=$("#sel_fly_0 option:selected").html();
	var ar_hsp=hsp.split(" | ");
	$("#t_fly_1").val(ar_hsp[0]);
	$("#idt_fly_1").val(sp);
	$("#t_fly_2").val(ar_hsp[1]);
	$("#idt_fly_2").val(sp);
}
function f_chang_fly_1() {
	var sp=$("#sel_fly_1 option:selected").val();
	var hsp=$("#sel_fly_1 option:selected").html();
	$("#t_fly_1").val(hsp);
	$("#idt_fly_1").val(sp);
}
function f_chang_fly_2() {
	var sp=$("#sel_fly_2 option:selected").val();
	var hsp=$("#sel_fly_2 option:selected").html();
	$("#t_fly_2").val(hsp);
	$("#idt_fly_2").val(sp);
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
// функция проверки полей с учётом условий
function pro_po(ip) {
	var at=$(ip).parents(".ti_blo").attr("id").replace("ti_blo_",""); // символьный код блока
//alert (at);

//var io=$("#ti_blo_"+at+" .in_er");
var io=$("#ti_blo_"+at);

	//регулярные выражения
	var reg_chk = /^[0-9]{6,7}$/;   //  номер - только 6-7 цифр 
	var reg_fio = /^[a-zA-Zа-яА-Я-_Ёё ]+$/;   // только буквы, пробел и дефис - кирилица, латынь
	var reg_mail =/^[a-zA-Z0-9][-\._a-zA-Z0-9]+@[\w-\._]+\.\w{2,4}$/i;//var reg_mail =/^\w+@\w+\.\w{2,4}$/i;
	var reg_phone = /^[0-9-)(+ ]+$/;  // телефон - цифры скобки плюс дефис пробел

	if(far_epo(at)) {

		switch($("#ti_blo_"+at+" input").attr("reg")) {
			case "reg_chk":var reg=!reg_chk.test(polto_rth(at));break; // проверка поля с применением регулярного выражения
			case "reg_fio":var reg=!reg_fio.test(polto_rth(at));break; // проверка поля с применением регулярного выражения
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

		//if(reg) {io.css({"display":"block"});return 1;}
		//else {io.css({"display":"none"});return 0;}
		if(reg) {io.css({"border":"solid 1px red"});return 1;}
		else {io.css({"border":"0"}).css({"border-bottom":"solid 1px #d9d9d9"});return 0;}
	}
	else return 0;

}
// Функция проверки всех полей на странице
function res_pro(sid_bp) {
	$(".zkl_d").css("display","block");
	var kb=$('.ti_blo:visible').length;
//alert(kb);
	var so=0;
	for(var i=0;i<kb;i++) {
		so=so+pro_po($(".ti_blo:visible:eq("+i+") input"));
	}

	if(so) { 
		alert("Ошибок: "+so);
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
// доп обработка поля Вариант перелета
function sen_por_p_fly() {
	var sel;var hisel_0;
	if(far_epo("p_fly")) {
		sel=$("#ti_blo_p_fly input:radio").filter(":checked").val();
		hisel_0=$("#ti_blo_p_fly input:radio:eq(0)").val();
		
		if(sel){
			if(sel==hisel_0) {
				$("#div_p_fly").css("display", "block" );
			}
			else {
				$("#div_p_fly").css("display", "none" );	
			}
		}
	}
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

// доп обработка поля Дата рождения
function sen_por_birthday() {
	if(far_epo("birthday")) {
		
	
		var b_v=$("#date_birthday").val();
		//alert(b_v);
		var ar_d=b_v.split(".");
	//alert(ar_d[1]*1);
		
		var mydate = new Date();
		mydate.setFullYear(ar_d[2]*1, ar_d[1]*1-1, ar_d[0]*1);
		var currdate = new Date();
		currdate.setFullYear(currdate.getFullYear());
		var ry=new Date();
		ry=currdate.getFullYear()- mydate.getFullYear();
		if(currdate.getMonth() < mydate.getMonth()) ry=ry-1;
		if(currdate.getMonth() == mydate.getMonth()) {
			if(currdate.getDate() < mydate.getDate()) ry=ry-1;
		}
		//alert(ry);
		if(b_v!="")	$("#age").val(ry);
		
	}
}

function list_viza_info() {
	$(".list_viza_info").slideToggle("slow");
}
