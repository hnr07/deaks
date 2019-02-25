
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
					url: "../../filter/filter_check_chk.php",  
					data: "p_chk="+p_chk+"&p_family="+p_family+"&p_name="+p_name+"&stts="+stts+"&br="+br+"&gr_chk="+gr_chk+"&gr_family="+gr_family+"&gr_name="+gr_name+"&code_m="+code_m, 
					cache: false,  
					success: function(html){ 
						$("#tr").html(html);
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
							
						}
						
						$(".div_pl_error").html(ar_h[0]);
						$("#loading").css("display", "none");
						
					}	
				}); 
	
}


 // функция построения списка городов по выбранной стране
 function f_chang_country() {
	var y=$("#sel_op_country option:selected").val();
	var i_city=$("#fld_op_city").val();  
	$("#ti_blo_op_country input").val(y);
	$("#sel_op_country-button span").html(y);
	$("#sel_op_city").html(""); 
	
			$.ajax({ 
				type: "POST",			
                url: "../../vop_edit.php",
				data: "vcountry="+y+"&i_city="+i_city,  
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
	var i_nof=$("#fld_op_nof").val(); 
	var y=$("#sel_op_city option:selected").val();
	$("#ti_blo_op_city input").val(y);
	$("#sel_op_city-button span").html(y);
	$("#sel_op_nof").html("");
			$.ajax({ 
				type: "POST",			
                url: "../../vop_edit.php",
				data: "vcity="+y+"&i_nof="+i_nof,  
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
                url: "../../vop_edit.php",
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