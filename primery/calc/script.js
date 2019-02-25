	$(document).ready(function() {
		
		init_calc();
		 
		$('#field_area').live('keydown', function(e){
			e = e || window.event;
			// alert(e);
	        if (e.keyCode === 13) {
				 $(".itog").focus();
	            itog_table();
				y_probel();
	        }
		});
		$(".box_calc .calc_2 .itog").click(function(){ 
			itog_table();
		});
	});
	
	function itog_table() {
		var sr=0;
		$('.box_calc .calc_2 #field_area .add').each(function(i,elem) {
			var tpor='';
			tpor=$(elem).children(".aap").val()+$(elem).children(".bbp").val()+$(elem).children(".ssp").val();
			//alert(tpor);
			if(tpor=='') {
				//var id=$(elem).attr("id");
				//alert(id);
				//$('.box_calc .calc_2 #'+id).remove();
				//if(i>0) 
					$(elem).remove();
			}
			else {sr++;}
			
		});
		//alert(sr);
		if(sr==0) add_div_1();
		edit_id();
		
			var sn=$('.box_calc .calc_2 #field_area input[type=tel]').size();
			//alert(sn);
			var fg=0; var f_focus='';
				$('.box_calc .calc_2 #field_area input[type=tel]').each(function(i,elem) {
					if ($(elem).val()=="" || n_probel($(elem).val())*1==0) {
						$(elem).addClass("input_err");
						if(f_focus=='') {$(elem).focus();f_focus="Y";}
						}
					else {
						fg++;
						$(elem).removeClass("input_err");
					}
				});
			if(fg < sn) {/*alert($("#err_pole").val());*/}
			else {sum_ajax_2();}
	}
	function init_calc() {
		$(".box_calc .calc_2 .add input").bind("change keyup input click", function() {
			var input=$(this);y_probel();
			if (this.value.match(/[^0-9]/g)) {
				var et=this.value.replace(/[^0-9]/g, '');
				this.value = et;
			}
			var a=$(this).val();
			$(this).val(a.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));
		});
		$(".box_calc .calc_2 .add input").bind("blur", function() {
			y_probel();
		});
		
		
		$(".aap").focus(function(){
			remove_class_img();;
			$(".box_calc .calc_2 .div_img").addClass("div_img_a");
		});

		$(".bbp").focus(function(){
			remove_class_img();
			$(".box_calc .calc_2 .div_img").addClass("div_img_b");
		});
		$(".ssp").focus(function(){
			remove_class_img();
			var f=$(this).parent(".add").children(".but_ukladka").children("input").val();
			var st="div_img_k";
			if(f=="T") st="div_img_t";
			$(".box_calc .calc_2 .div_img").addClass(st);
		});
		/*
		$(".ku").hover(function(){
			$(".box_calc .calc_2 .l_box").addClass("plitka_k");
		},function(){
			$(".box_calc .calc_2 .l_box").removeClass("plitka_k");
		});
		$(".tu").hover(function(){
			$(".box_calc .calc_2 .l_box").addClass("plitka_t");
		},function(){
			$(".box_calc .calc_2 .l_box").removeClass("plitka_t");
		});
		*/
		$(".ku").click(function(){
			//alert("K");
			remove_class_img();
			$(".box_calc .calc_2 .div_img").addClass("div_img_k");
			$(this).parent(".but_ukladka").children("input").val("K");
			$(this).removeClass("ku_p");
			$(this).addClass("ku_a");
			$(this).next(".tu").removeClass("tu_a");
			$(this).next(".tu").addClass("tu_p");
			//timeout_ku = setTimeout(function(){$(".box_calc .calc_2 .div_img").removeClass("div_img_k");},3000);
		});
		$(".tu").click(function(){
			//alert("T");
			remove_class_img();
			$(".box_calc .calc_2 .div_img").addClass("div_img_t");
	
			$(this).parent(".but_ukladka").children("input").val("T");
			$(this).removeClass("tu_p");
			$(this).addClass("tu_a");
			$(this).prev(".ku").removeClass("ku_a");
			$(this).prev(".ku").addClass("ku_p");
			//timeout_tu = setTimeout(function(){$(".box_calc .calc_2 .div_img").removeClass("div_img_t");},3000);
		});
	}
	function remove_class_img() {
		var doc=$(".box_calc .calc_2 .div_img");
		doc.removeClass("div_img_a");
		doc.removeClass("div_img_b");
		doc.removeClass("div_img_k");
		doc.removeClass("div_img_t");
	}
	function edit_id() {
		$('.box_calc .calc_2 #field_area .add').each(function(i,elem) {
			l=i+1;
			$(elem).attr("id","add"+l);
			$(elem).children(".npc").html(l);
			if(l==1) {$(elem).children(".deletebutton").remove();}
			else {$(elem).children(".deletebutton").attr("onclick","delete_div_2("+l+");");}
		});
	}
	function add_div_1() {
		telnum=1;
		remove_class_img();
		$('.box_calc .calc_2 #field_area').append('<div id="add'+telnum+'" class="add"><div class="npc">'+telnum+'</div><div class="but_ukladka"><input type="hidden" value="K"><div class="ku ku_a"></div><div class="tu tu_p"></div></div><input type="tel" class="aap" maxlength="3"><input type="tel" class="bbp" maxlength="3"><input type="tel" class="ssp" maxlength="8"></div>');
		init_calc();
	}
	function add_div_2() {
		remove_class_img();
		var telnum = parseInt($('.box_calc .calc_2 #field_area').find('.add:last').attr('id').slice(3))+1;
		var u_flag = $('.box_calc .calc_2 #field_area').find('.add:last').children(".but_ukladka").children("input").val();
		var ku_class = $('.box_calc .calc_2 #field_area').find('.add:last').children(".but_ukladka").children(".ku").attr('class');
		var tu_class = $('.box_calc .calc_2 #field_area').find('.add:last').children(".but_ukladka").children(".tu").attr('class');
		$('.box_calc .calc_2 #field_area').append('<div id="add'+telnum+'" class="add"><div class="npc">'+telnum+'</div><div class="but_ukladka"><input type="hidden" value="'+u_flag+'"><div class="'+ku_class+'"></div><div class="'+tu_class+'"></div></div><input type="tel" class="aap" maxlength="3"><input type="tel" class="bbp" maxlength="3"><input type="tel" class="ssp" maxlength="8"><div class="deletebutton" onclick="delete_div_2('+telnum+');"></div></div>');
		init_calc();
	}
	
	function delete_div_2(id) {
		remove_class_img();
		$('.box_calc .calc_2 #add'+id).remove();
		edit_id();
	}
	function y_probel() {
		$('.box_calc .calc_2 #field_area .add').each(function(i,elem) {
			var a=($(elem).children(".aap").val()).replace(/^0+/, '');
			$(elem).children(".aap").val(a.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));
			var b=($(elem).children(".bbp").val()).replace(/^0+/, '');
			$(elem).children(".bbp").val(b.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));
			var s=($(elem).children(".ssp").val()).replace(/^0+/, '');
			$(elem).children(".ssp").val(s.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));
		});
		
	}
	function n_probel(t) {
		return t.replace(/\s+/g, '');
	}
	function sum_ajax_2() {
		remove_class_img();
	var sno=0;
	var sp=0;
	var ar_d=new Array();
	var ar_da={};
	ar_da["row"]=[];
	var ik=0;
	$('.box_calc .calc_2 #field_area .add').each(function(i,elem) {
		var f=$(elem).children(".but_ukladka").children("input").val();
		
		var a=n_probel($(elem).children(".aap").val())/100; // Размер стороны А в метрах
		var b=n_probel($(elem).children(".bbp").val())/100; // Размер стороны В в метрах
		var s=n_probel($(elem).children(".ssp").val())*1; // Площадь в кв. метрах
		var itg=Math.ceil(Math.sqrt(s)/a+Math.sqrt(s)/b+1/a/b*s); // Необходимый расход основ
		if(f=="T") itg=itg*2; // для Т-образной укладки расход больше
		sno+=itg; // Весь расход 
		sp+=s; // Вся площадь
		//alert(f);
		//alert(a+" "+b+" "+s+"="+itg);
		ar_d[ik]=f+") A:"+a+" B:"+b+" S:"+s+" ="+itg; // Данные для логирования
		ar_da["row"][ik] = {"type": f, "A": a, "B": b, "S":s, "itg": itg}; // Создаём 
		
		ik++;
	});
	ar_da["sno"]=sno;
	var LANGUAGE_ID=$("#LANGUAGE_ID").val(); // языковая папка
	//var s_url="/com/calc/list_itog.php"; // файл пересчёта
	var s_url="/"+LANGUAGE_ID+"/calc/list_itog_ep.php"; // файл пересчёта
	var ar_dj=JSON.stringify(ar_da);
	var s_data="sno="+sno+"&sp="+sp+"&ar_d="+ar_d+"&ar_dj="+ar_dj;  // строка данных
	// обработка результата
			$.ajax({  
                type: "POST",
                url: s_url,  
				data: s_data, 
                cache: false,  
                success: function(html){ 
					
				$(".list_itog_box").html(html);
					
                } 
            });
}