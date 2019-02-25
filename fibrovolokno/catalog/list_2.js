function f_start() {
alert(11);
	$(".table_elo").on("click", ".ah_shop", function(){
		$(this).blur();
		var elo = $(this).closest(".elo");
		var in_cart=$(this).attr("in_cart");
		if(in_cart=="N") {
			var name_el = elo.children(".name").html();
			var price_el = elo.children(".price_packing").attr("price_packing");
			if(!$.isNumeric(price_el)) price_el=elo.children(".price").attr("price");
			var elo = $(this).closest(".elo");	
			var id_el = elo.attr("id_elem");
						
			//elo.find(".cart").removeClass("cart").addClass("chek");
			elo.find("[in_cart]").attr("in_cart","Y").removeClass("visible").addClass("hidden");
			
			elo.removeClass("def").addClass("add");
			elo.find(".calc_el").removeClass("none").addClass("block");
			d_sum(id_el,"N","N");
		}
		
		
	});
	$("body").on("click", "#show_mod_po", function(){
		$(".str_po .mod_po .note_ok").css({"display":"none"});
		$(".str_po .mod_po .mod_form").css({"display":"block"});
		$(".str_po").css({"display":"block"});
		$("html").css({"overflow": "hidden"});
		var itogo=$(".mod_po .listel [name=itogo]").val();
		var itogo_weight=$(".mod_po .listel [name=itogo_weight]").val();
		var itogo_qty=$(".mod_po .listel [name=itogo_qty]").val();
		var l_url="/fibrovolokno/orders/show_order.php";
		var l_data="show=Y&itogo="+itogo+"&itogo_weight="+itogo_weight+"&itogo_qty="+itogo_qty;
		$.ajax({  
			type: "POST",
			url: l_url,  
			data: l_data, 
			cache: false,  
			success: function(html){ 
				$("#elem_table").html(html);
				//alert(23);
			} 
		});
	});
	
	$("body").on("click", ".close, .d_carry", function(){
		$(".str_po").css({"display":"none"});
		$("html").css({"overflow": "auto"});
	});
	$("body").on("click", ".str_po .mod_po", function(){
		//e.stopPropagation();
	});
	
	
	$(".str_po .mod_po").on("change keyup input click", "input[name=phone_user]", function(){
		var a=$(this).val();
		$(this).val(a.replace(/[^0-9()+-]/g, ''));
	});
	$(".str_po .mod_po").on("click", "#new_capcha", function(){
		var s_url="/fibrovolokno/orders/new_capcha.php";
		$.ajax({  
                type: "POST",
                url: s_url,  
				data: "", 
                cache: false,  
                success: function(html){ 
					$(".div_capcha").html(html);
                } 
            });
	});
	
	$(".calc_el .calc_qty").on("click", ".plus", function(){
		var calc_el = $(this).closest(".calc_el");
		var id_el = calc_el.find("[name=id_elem]").val();
		var qty = calc_el.find("[name=qty]").val()*1;
		var price_packing = calc_el.find("[name=price_packing]").val()*1;
		calc_el.find("[name=qty]").val(qty+1);
		calc_el.find(".calc_qty input").val(qty+1).click();

		d_sum(id_el,"N","N");
	});
	$(".calc_el .calc_qty").on("click", ".minus", function(){
		var calc_el = $(this).closest(".calc_el");
		var id_el = calc_el.find("[name=id_elem]").val();
		var qty = calc_el.find("[name=qty]").val()*1;
		var price_packing = calc_el.find("[name=price_packing]").val()*1;
		if(qty>1) {
			calc_el.find("[name=qty]").val(qty-1);
			calc_el.find(".calc_qty input").val(qty-1).click();
		}
		else {
			calc_el.find("[name=qty]").val(1);
			calc_el.find(".calc_qty input").val(1).click();
		}

		d_sum(id_el,"N","N");
	});
	$(".calc_el").on("click", ".del", function(){
		var calc_el = $(this).closest(".calc_el");
		var id_el = calc_el.find("[name=id_elem]").val();
		calc_el.find("[name=qty]").val(1);
		calc_el.find(".calc_qty input").val(1);

		var elo = $(this).closest(".elo");
		//elo.find(".chek").removeClass("chek").addClass("cart");
		elo.find("[in_cart]").attr("in_cart","N").removeClass("hidden").addClass("visible");
		elo.removeClass("add").addClass("def");
		elo.find(".calc_el").removeClass("block").addClass("none");
			
		d_sum(id_el,"Y","N");
	});
	
	$(".calc_el .calc_qty").on("change keyup input click", "input", function(){
		var a=$(this).val();
		if(a=="0" || a=="") a="1";
		$(this).val(a.replace(/[^0-9]/g, ''));
		var calc_el = $(this).closest(".calc_el");
		var id_el = calc_el.find("[name=id_elem]").val();
		calc_el.find("[name=qty]").val(a.replace(/[^0-9]/g, ''));
		d_sum(id_el,"N","N");
		tin(id_el);	
	});
	
	
	
	var scrolled = false;
	var  pe=$(".mod_calc").offset();
	$(window).scroll(function() { 
		var scrollTop = $(window).scrollTop();
		
		if (scrollTop > pe.top){
			if(!scrolled) {
				$(".mod_calc").css({"position":"fixed", "left":pe.left}).addClass("box_shadow");
				$(".mod_calc .sel").addClass("box_shadow");
				scrolled = true;
			}
		}
		else {
			if(scrolled) {
				$(".mod_calc").css({"position":"absolute","left":""}).removeClass("box_shadow");
				$(".mod_calc .sel").removeClass("box_shadow");
				scrolled = false;
			}
		}

	});
	
	$(".dibox_in").on("focus", function() {
		$('.pos_a').each(function(i,elem) {
			if($(elem).next("input").val()=="") {$(this).removeClass("pos_a").addClass("pos_i");}
		});
		$(this).prev(".dibox_name").removeClass("pos_i").addClass("pos_a");
	});
	$(".dibox_in").on("blur", function() {
		if($(this).val()=="") {$(this).prev(".dibox_name").removeClass("pos_a").addClass("pos_i");}
		var polto_name=$(this).attr("name");
		polto( polto_name);
	});
}

function polto(obj) {
	var reg_mail =/^[a-zA-Z0-9][-\._a-zA-Z0-9]+@[\w-\._]+\.\w{2,4}$/i;//var reg_mail =/^\w+@\w+\.\w{2,4}$/i;
	//var reg_phone = /^[0-9-)(+ ]+$/;  // телефон - цифры скобки плюс дефис пробел
	var f_er=0;
	var name_user=$(".str_po .mod_po input[name=name_user]");
	var phone_user=$(".str_po .mod_po input[name=phone_user]");
	var email_user=$(".str_po .mod_po input[name=email_user]");
	var address_user=$(".str_po .mod_po input[name=address_user]");
	if(obj=="all" || obj=="name_user") {
		if(name_user.val()=="") {name_user.removeClass("galka_green").addClass("galka_red");f_er++;}
		else {name_user.removeClass("galka_red").addClass("galka_green");}
	}
	if(obj=="all" || obj=="phone_user") {
		if(phone_user.val()=="") {phone_user.removeClass("galka_green").addClass("galka_red");f_er++;}
		else {phone_user.removeClass("galka_red").addClass("galka_green");}
	}
	if(obj=="all" || obj=="address_user") {
		if(address_user.val()=="") {address_user.removeClass("galka_green").addClass("galka_red");f_er++;}
		else {address_user.removeClass("galka_red").addClass("galka_green");}
	}
	if(obj=="all" || obj=="email_user") {
		if(!reg_mail.test(email_user.val())) {email_user.removeClass("galka_green").addClass("galka_red");f_er++;}
		else {email_user.removeClass("galka_red").addClass("galka_green");}
	}
	//alert(f_er);
	if(obj=="all") {
		if(f_er) {alert('Заполните правильно все поля\nблока "Контактная информация"');return false;}
		else {return true;}
	}

}

function d_sum(id, del, load) {

	if($(".dha").is("[id_elem="+id+"]")) {
		var el=$(".dha[id_elem="+id+"]");
		var name_before_elem=el.children("[name=name_before_elem]").val();
		var name_elem=el.children("[name=name_elem]").val();
		var size_elem=el.children("[name=size_elem]").val();
		var src_elem=el.children("[name=src_elem]").val();
		var unit_elem=el.children("[name=unit_elem]").val();
		var qty=el.children("[name=qty]").val()*1;
		var price_packing=el.children("[name=price_packing]").val()*1;
		var price=el.children("[name=price]").val()*1;
		var packing=el.children("[name=packing]").val()*1;
		var sum=qty*price_packing;
		var weight=qty*packing;
		//alert(sum);
		sum=sum.toFixed(2);
		el.children("[name=sum]").val(sum);
		var sum_t = sum.replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 ");
		var ar_sum=sum_t.split('.');
		
		el.closest(".calc_el").find(".prec").html(ar_sum[0]+"."+'<span class="fs_ump">'+ar_sum[1]+'</span>');
		//el.closest(".calc_el").find(".prec").html(sum);
		switch(sum_t.length) {
				case 9:pcs=24;break;
				case 10:pcs=23;break;
				case 11:pcs=22;break;
				case 12:pcs=21;break;
				case 13:pcs=20;break;
				case 14:pcs=19;break;
				case 15:pcs=18;break;
				case 16:pcs=17;break;
				default:pcs=25;
			}
			el.closest(".calc_el").find(".prel").css({"font-size":pcs+"px"});
		el.children("[name=weight]").val(weight);
		
		
		var e_url="/fibrovolokno/orders/add_elem.php";
		var e_data="id="+id+"&name_before_elem="+name_before_elem+"&name_elem="+name_elem+"&size_elem="+size_elem+"&src_elem="+src_elem+"&del="+del+"&qty="+qty+"&price_packing="+price_packing+"&price="+price+"&packing="+packing+"&sum="+sum+"&weight="+weight+"&unit_elem="+unit_elem;
		if(load=="N") {
			$.ajax({  
				type: "POST",
				url: e_url,  
				data: e_data, 
				cache: false,  
				success: function(html){ 
					//$("#res_ajax").html(html);
					d_itogo();
				} 
			});
		}
	}
}

function d_itogo() {
	
	var s_url="/fibrovolokno/orders/sum_elem.php";
	var s_data="";
	$.ajax({  
		type: "POST",
		url: s_url,  
		data: s_data, 
		cache: false,  
		success: function(html){ 
			//$("#res_ajax").html(html);
			var arr=html.split("|");
			var sum=arr["0"]*1;
			var weight=arr["1"]*1;
			var qty=arr["2"]*1;
			var c_elem=arr["3"]*1;
			var pcs=25;
			
			weight=weight.toFixed(3);
			sum=sum.toFixed(2);
			//alert(sum);
			if(sum>0) $(".mod_calc").removeClass("hidden").addClass("visible");
			else  $(".mod_calc").removeClass("visible").addClass("hidden");
			$(".mod_po .listel [name=itogo]").val(sum);
			$(".mod_po .listel [name=itogo_weight]").val(weight);
			$(".mod_po .listel [name=itogo_qty]").val(qty);
			
			var weight_t = weight.replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 ");
			var sum_t = sum.replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1 ");
			//alert(weight_t.length);
			switch(sum_t.length) {
				case 8:pcs=23;break;
				case 9:pcs=20;break;
				case 10:pcs=18;break;
				case 11:pcs=17;break;
				case 12:pcs=16;break;
				case 13:pcs=14;break;
				case 14:pcs=12;break;
				case 15:pcs=11;break;
				case 16:pcs=10;break;
				default:pcs=25;
			}
			$(".mod_calc .itogo").css({"font-size":pcs+"px"});
			
			switch(weight_t.length) {
				case 7:pcs=23;break;
				case 8:pcs=20;break;
				case 9:pcs=18;break;
				case 10:pcs=17;break;
				case 11:pcs=16;break;
				case 12:pcs=14;break;
				case 13:pcs=12;break;
				case 14:pcs=11;break;
				case 15:pcs=10;break;
				default:pcs=25;
			}
			$(".mod_calc .weight").css({"font-size":pcs+"px"});
			
			var ar_sum=sum_t.split('.');
			$(".mod_calc .itogo").html(ar_sum[0]+"."+'<span class="fs_ump">'+ar_sum[1]+'</span> <div class="rur">q</div>').attr("title",sum+' руб');
			var ar_weight=weight_t.split('.');
			$(".mod_calc .weight").html(ar_weight[0]+"."+'<span class="fs_ump">'+ar_weight[1]+'</span> <span>кг</span>').attr("title",weight+' кг');
			//alert(qty);
			$(".mod_calc .sel sup").html(c_elem);
			$(".mod_calc .sel span").html(qty+" уп.");
		}
	});
}

function tin(id) {
	if($(".dha").is("[id_elem="+id+"]")) {
		var tin=$("[id_elem="+id+"]").find(".qty_text").children("input");
		tin.next(".input_buf").text(tin.val());
		tin.width(tin.next(".input_buf").width());
	}
}
