// функция проверки ЧК
function filter_chk_ajax() {
	//$("#loading").css("display", "block");
	$("#loading").fadeIn("slow");
	sel=$("#ti_blo_status input:radio").filter(":checked").val(); // выбран статус
		hisel_0=$("#stat_0").val(); // статус участник
		hisel_1=$("#stat_1").val(); // статус приглашённый ЧК
		hisel_2=$("#stat_2").val(); // статус приглашённый родственник
		//alert(sel);
		var chk=$("#ti_blo_chk input:text").val(); //ЧК
		var name=$("#ti_blo_name input:text").val(); //имя ЧК
		var family=$("#ti_blo_family input:text").val(); // фамилия ЧК
		var kem_priglashen_chk=$("#ti_blo_kem_priglashen_chk input:text").val(); //кем приглашён ЧК
		var kem_priglashen_name=$("#ti_blo_kem_priglashen_name input:text").val(); //кем приглашён имя
		var kem_priglashen_family=$("#ti_blo_kem_priglashen_family input:text").val(); //кем приглашён фамилия
		var code_m=$("#code_m").val(); //код мероприятия
		var not_filter_pl_member=$("#not_filter_pl_member").val(); //проверять оплату для участника
		var not_filter_pl_guest_chk=$("#not_filter_pl_guest_chk").val(); //проверять оплату для приглашённого ЧК
		var not_filter_pl_guest=$("#not_filter_pl_guest").val(); //проверять оплату для приглашённого родственника
		var currency_id_not=$("#currency_id_not").val(); //id валюты, если без проверки
		var currency_not=$("#currency_not").val(); //символьный код валюты, если без проверки
		
		
		var fv=1; // флаг необходимости проверки данных для оплаты
		if(sel) {
			//выбор файла скрипта для проверки по статусу
			switch(sel) {
				case hisel_1:
					var s_url="filter/filter_guest_chk.php"; // файл проверки приглашённого ЧК
					var s_data="chk="+chk+"&family="+family+"&name="+name+"&kem_priglashen_chk="+kem_priglashen_chk+"&kem_priglashen_family="+kem_priglashen_family+"&kem_priglashen_name="+kem_priglashen_name+"&code_m="+code_m;
					fv=not_filter_pl_guest_chk; // необходимость проверки данных для оплаты для приглашённого ЧК
				break;
				case hisel_2:
					var s_url="filter/filter_guest.php"; // файл проверки  приглашённого родственника
					var s_data="kem_priglashen_chk="+kem_priglashen_chk+"&kem_priglashen_family="+kem_priglashen_family+"&kem_priglashen_name="+kem_priglashen_name+"&code_m="+code_m;
					fv=not_filter_pl_guest; // необходимость проверки данных для оплаты для  приглашённого родственника
				break;
				default:
					var s_url="filter/filter_chk.php"; // файл проверки участника
					var s_data="chk="+chk+"&family="+family+"&name="+name+"&code_m="+code_m;
					fv=not_filter_pl_member; // необходимость проверки данных для оплаты для участника
				break;
			}
			
			// обработка результата
			$.ajax({  
                type: "POST",
                url: s_url,  
				data: s_data, 
                cache: false,  
                success: function(html){ 
					//$("#tr").html(html);
					var ar_h=html.split("^");
					$(".div_pro_error").html(ar_h[0]);
					//alert(ar_h[1]);
					
					if(ar_h[1]==1) {
						if(fv==1) { // показать поле проверки оплаты
							$(".div_oplata_ok").css({"display":"block"});
						}
						else { // не показывать поле проверки оплаты
							$("#currency_id").val(currency_id_not); // В поле ID валюты - ID валюты
							$("#currency").val(currency_not);// В поле валюта - символьный код валюты
							$(".div_pro_ok").css({"display":"block"});
						}
							$("#ti_but_proverka").css({"display":"none"});
							var ig=$("#ti_blo_status input:radio").filter(":checked").attr("id");
							$("#ti_blo_status input").parent("div").css({"display":"none"});
							$("#ti_blo_status input[id='"+ig+"']").parent("div").css({"display":"block"});
							$("#sipo_0 input").attr("readonly","readonly");
							$("#sipo_1 input").attr("readonly","readonly");
							$("#sipo_2 input").attr("readonly","readonly");
							$("#slide_venue").attr("block","N");
							$(".b1").css({"display":"block"});
							
							$("#promotion_1").val(ar_h[2]);
							$("#promotion_2").val(ar_h[3]);
							$("#em_bd").val(ar_h[4]);
						
					}
					else {
						$(".div_oplata_ok").css({"display":"none"});
						$(".div_pro_ok").css({"display":"none"});
						$("#ti_but_proverka").css({"display":"block"});
						$("#slide_venue").attr("block","Y");
						$(".b1").css({"display":"none"});
					}
					$("#loading").css("display", "none");
					
					
                } 
            }); 	
		}
	
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
		var code_m=$("#code_m").val(); //код мероприятия
		var stts="";
		var br="";
				// Проверка если плательщик и заявитель одно лицо 
				if(p_chk == chk) stts=1;   //Если № ЧК равен № ЧК плательщика
				else stts=0;   //Если № ЧК не равен № ЧК плательщика
				if(gn == gnh) br=1; // Если оплата без рассрочки
				else br=0; // Если оплата с рассрочкой
			
				$.ajax({  
					type: "POST",
					url: "filter/filter_check_chk.php",  
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
							$("#ti_but_proverka_check").css({"display":"none"});
							$("#but_plachu_sam").css({"display":"none"});
							$(".div_oplata_ok input").attr("readonly","readonly");
							var ig=$("#ti_blo_oplata input:radio").filter(":checked").attr("id");
							$("#ti_blo_oplata input").parent("div").css({"display":"none"});
							$("#ti_blo_oplata input[id='"+ig+"']").parent("div").css({"display":"block"});
							var ig=$("#ti_blo_time_money_chk input:radio").filter(":checked").attr("id");
							$("#ti_blo_time_money_chk input").parent("div").css({"display":"none"});
							$("#ti_blo_time_money_chk input[id='"+ig+"']").parent("div").css({"display":"block"});	
							$(".b2").css({"display":"block"});
							
						}
						
						$(".div_pl_error").html(ar_h[0]);
						$("#loading").css("display", "none");
						
					}	
				}); 
	
}


 // функция построения списка городов по выбранной стране
 function f_chang_country() {
	var y=$("#sel_op_country option:selected").val();
	$("#ti_blo_op_country input").val(y);
	$("#sel_op_country-button span").html(y);
	$("#sel_op_city").html(""); 
	
			$.ajax({ 
				type: "POST",			
                url: "vop.php",
				data: "vcountry="+y,  
                cache: false,  
                success: function(html){  
				//$("#tr").html(html);
				var ar_h=html.split("^");
			//	$("#sel_op_city-button span").html(ar_h[0]);
                    $("#sel_op_city").html(ar_h[1]); 
						
					f_chang_city();
					//setTimeout("f_chang_city()", 1000);
                }  
            });
	//setTimeout("f_chang_city()", 1000);
	//f_chang_city();
			
 }
 
  // функция построения списка ОП по выбранному городу
  function f_chang_city() {
	  
	var y=$("#sel_op_city option:selected").val();
	$("#ti_blo_op_city input").val(y);
	$("#sel_op_city-button span").html(y);
	$("#sel_op_nof").html("");
			$.ajax({ 
				type: "POST",			
                url: "vop.php",
				data: "vcity="+y,  
                cache: false,  
                success: function(html){ 
				//$("#tr").html(html);
					var ar_h=html.split("^");
					//$("#sel_op_nof-button span").html(ar_h[0]);					
                    $("#sel_op_nof").html(ar_h[1]); 
					
					f_chang_nof();
					//setTimeout("f_chang_nof()", 1000);
                }  
            });
			
	//setTimeout("f_chang_nof()", 1000);
	//f_chang_nof();
	
 }
 // функция передачи в поля формы id и кода валюты ОП	
 function f_chang_nof() {
	 
	var y=$("#sel_op_nof option:selected").val();
	$("#ti_blo_op_nof input").val(y);
	$("#sel_op_nof-button span").html(y);
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
	
 }
 
  // функция построения списка городов по выбранной стране
 function f_click_country(y) {//alert(gf);
	//alert(y);
	$("#ti_blo_op_country input[type=text]").val(y);
	var h=$("#sel_op_city .coon_t").html();
	//alert(h+" "+gf_1);
			$.ajax({ 
				type: "POST",			
                url: "vop_c.php",
				data: "vcountry="+y,  
                cache: false,  
                success: function(html){  
				//$("#tr").html(html);
				var ar_h=html.split("^");
			//	$("#sel_op_city-button span").html(ar_h[0]);
                    $("#sel_op_city .coon_s").html(ar_h[1]); 
					if(gf_1==1) var v_ci=h.replace(/[\r\n]/g,'');
					else var v_ci=ar_h[0].replace(/[\r\n]/g,'');
					//alert(v_ci+" "+gf_1);
					f_click_city(v_ci);
					window.gf_1=0;
					//setTimeout(f_click_city(v_ci), 1500);
                }  
            });
	//setTimeout("f_chang_city()", 1000);
	//f_chang_city();
			
 }
   // функция построения списка ОП по выбранному городу
  function f_click_city(y) { // alert(">> "+y);
	$("#ti_blo_op_city input[type=text]").val(y);
	$("#sel_op_city .coon_t").html(y);
	var h=$("#sel_op_nof .coon_t").html();
			$.ajax({ 
				type: "POST",			
                url: "vop_c.php",
				data: "vcity="+y,  
                cache: false,  
                success: function(html){ 
				//$("#tr").html(html);
					var ar_h=html.split("^");
					//$("#sel_op_nof-button span").html(ar_h[0]);					
                    $("#sel_op_nof .coon_s").html(ar_h[1]); 
					if(gf_2==1) var v_no=h.replace(/[\r\n]/g,'');
					else var v_no=ar_h[0].replace(/[\r\n]/g,'');
					//alert(ar_h[0]);
					f_click_nof(v_no);
					window.gf_2=0;
					//setTimeout(f_click_nof(v_no), 1500);
                }  
            });
			
	//setTimeout("f_chang_nof()", 1000);
	//f_chang_nof();
	
 }
 // функция передачи в поля формы id и кода валюты ОП	
 function f_click_nof(y) {//alert(y);

	$("#ti_blo_op_nof input[type=text]").val(y);
	$("#sel_op_nof .coon_t").html(y);
	 $.ajax({ 
				type: "POST",			
                url: "vop_c.php",
				data: "vnof="+y,  
                cache: false,  
                success: function(html){  
					var ar_h = html.split("^");
					//$("#tr").html(html);
					$("#currency_id").val(ar_h[0]);
					$("#currency").val(ar_h[1]);
                }  
            });
	
 }
