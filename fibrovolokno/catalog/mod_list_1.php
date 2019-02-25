<?

   $arCalcConfig = array(
			'list_1' => array(
				'js' => SITE_DIR.'catalog/list_1.js',
				'css' => SITE_DIR.'catalog/list_1.css',//если требуется подтянуть еще и CSS
			),
		);
		foreach ($arCalcConfig as $ext => $arExt) {
			CJSCore::RegisterExt($ext, $arExt);
		}

CJSCore::Init (array('list_1'));

// Подключаем капчу
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
$cpt = new CCaptcha();
$captchaPass = COption::GetOptionString("main", "captcha_password", "");
if(strlen($captchaPass) <= 0)
{
   $captchaPass = randString(10);
   COption::SetOptionString("main", "captcha_password", $captchaPass);
}
$cpt->SetCodeCrypt($captchaPass);
?>
<div id="res_ajax"></div>
<div class="str_po">
	<div class="mod_po">
		<div class="note_error err_form">Заполните правильно обязательные поля!</div>
		<div class="note_error err_capcha">Ошибка проверочного кода!<div id="new_capcha">Обновить код >>></div></div>
		<div class="note_error err_add">Ошибка сохранения заказа! Попробуйте позже.</div>
		<div class="mod_calc">
			<div class="listel">

			</div>
						
			<div class="itogo">К оплате: <input type="text" name="itogo" value="0" readonly title=""><div class="rur">q</div></div>
		</div>
		<div class="mod_form">
			
			<div class="row" title="Ваше имя"><input type="text" name="name_user" placeholder="Ваше имя"></div>
			<div class="row" title="Ваш телефон"><input type="text" name="phone_user" placeholder="Ваш телефон"></div>
			<div class="row" title="Ваша эл. почта"><input type="text" name="email_user" placeholder="Ваша эл. почта"></div>
			<div class="row" title="Комментарий"><textarea name="comment_user" placeholder="Комментарий"></textarea></div>
			
			<div class="row div_capcha" title="Проверочный код">
			<input name="captcha_code" value="<?=htmlspecialchars($cpt->GetCodeCrypt());?>" type="hidden">
			<input id="captcha_word" name="captcha_word" type="text" placeholder="Проверочный код">
			<img src="/bitrix/tools/captcha.php?captcha_code=<?=htmlspecialchars($cpt->GetCodeCrypt());?>" style="">
			</div>
			
			
		</div>
		<button type="button" class="d_carry">Продолжить выбор <div></div></button>
		<button type="button" class="d_add">Оформить <div></div></button>
		<div class="note_ok">Заказ успешно оформлен!<br />В ближайшее время наш менеджер свяжется с вами.</div>
	</div>
	
</div>

<script>
$(document).ready(function() {
	
	$(".table_elo").on("click", ".elo .name, .elo .img", function(){
		var obj_c = $('.content');
		var offset_c = obj_c.offset();
		var leftOffset_c = offset_c.left;
		var wb_c=obj_c.innerWidth();
		
		var obj_e = $(this).parent(".elo");
		var offset_e = obj_e.offset();
		var leftOffset_e = offset_e.left;
		
		var obj_d = obj_e.children(".detail_box");

		
		obj_d.css({"width":wb_c+"px", "left":(leftOffset_c-leftOffset_e)+"px"});
		if(obj_d.is(':hidden')) {
			$(".img").animate({height: "150px"},{queue:false, duration:500});
			obj_e.children(".img").animate({height: "100%"},{queue:false, duration:500});
			$(".elo").css({"margin-bottom":"30px"});
			$(".detail_box").css({"display":"none"});
			var hb_d=obj_d.innerHeight();
			obj_e.css({"margin-bottom":hb_d+"px"});
			obj_d.slideDown(500);
			
		}
		else  {
			obj_d.slideUp(500,function(){obj_e.css({"margin-bottom":"30px"});});
			obj_e.children(".img").animate({height: "150px"},500);
		}
		
		//obj_e.children(".img").css({"height":"100%"});
		//obj_e.children(".img").animate({height: "100%"},500);
		
	});
	
	$(".page_home").on("click", ".aaj", function(){
		 var PAGEN_1=$(this).attr("PAGEN_1");
		 if(PAGEN_1==0) {
			var PARENT_ID=$(this).attr("PARENT_ID");
			var SECTION_ID=$(this).attr("SECTION_ID");
			$("#PARENT_ID").val(PARENT_ID);
			$("#SECTION_ID").val(SECTION_ID);
		}
		else {
			var PARENT_ID=$("#PARENT_ID").val();
			var SECTION_ID=$("#SECTION_ID").val();
			
		}
		var s_url="/catalog/list_1.php";
		s_data="PARENT_ID="+PARENT_ID+"&SECTION_ID="+SECTION_ID+"&PAGEN_1="+PAGEN_1;
		//alert(PARENT_ID+" "+SECTION_ID);
		$.ajax({  
                type: "POST",
                url: s_url,  
				data: s_data, 
                cache: false,  
                success: function(html){ 
					$(".table_elo").animate({opacity: "0"},{queue:true, duration:300});
					setTimeout(function(){$(".table_elo").html(html);},300);
					$(".table_elo").animate({opacity: "1"},{queue:true, duration:300});	
                } 
            });
	});
	
	$(".table_elo").on("click", ".ah_shop", function(){
		var elo = $(this).closest(".elo");
		var in_cart=$(this).attr("in_cart");
		if(in_cart=="N") {
			var elo = $(this).closest(".elo");
			var name_el = elo.children(".name").html();
			var price_el = elo.children(".price_packing").attr("price_packing");
			if(!$.isNumeric(price_el)) price_el=elo.children(".price").attr("price");
			var elo = $(this).closest(".elo");	
			var id_el = elo.attr("id_elem");
			var add_text='<div class="row addel" id_elem="'+id_el+'"><div class="buq del" title="удалить"></div><input class="product" type="text" name="product_name['+id_el+']" value="'+name_el+'" readonly title=""><div class="buq minus hid" title="меньше"></div><input class="qty" type="text" name="product_qty['+id_el+']" value="1"><div class="buq plus" title="больше"></div><input class="price" type="text" name="product_price['+id_el+']" value="" readonly><div class="rur drub">q</div><input type="hidden" class="cena" name="cena" value="'+price_el+'"></div>';
			$(".mod_calc .listel").append(add_text);
			
			elo.find(".cart").removeClass("cart").addClass("chek");
			elo.find("[in_cart]").attr("in_cart","Y");
			d_sum(id_el);
		}
		$(".str_po .mod_po .note_ok").css({"display":"none"});
		$(".str_po .mod_po .mod_form").css({"display":"block"});
		$(".str_po").css({"display":"block"});
		
	});
	$("body").on("click", ".str_po, .d_carry", function(){
		$(".str_po").css({"display":"none"});
	});
	$("body").on("click", ".str_po .mod_po", function(){
		e.stopPropagation();
	});
	$(".str_po .mod_po").on("click", ".d_add", function(){
		$(this).blur();
		if(polto()) {
			var s_url="/orders/add_order.php";
			var s_data="";
			$(".str_po .mod_po input").each(function(i,elem) {
				s_data+=$(this).attr("name")+"="+$(this).val()+"&";
			});
			s_data+=$(".str_po .mod_po textarea").attr("name")+"="+$(".str_po .mod_po textarea").val();
			alert(s_data);
			$.ajax({  
                type: "POST",
                url: s_url,  
				data: s_data, 
                cache: false,  
                success: function(html){ 
					$("#res_ajax").html(html);
					if(html>0) {
						$(".str_po .mod_po .note_ok").css({"display":"block"});
						$(".str_po .mod_po .mod_form").css({"display":"none"});
						$(".str_po .mod_po .err_capcha").css({"display":"none"});
						
					}
					else {
						if(html<0) $(".str_po .mod_po .err_capcha").css({"display":"block"});
						else $(".str_po .mod_po .err_add").css({"display":"block"});
					}
                } 
            });
		}
		
	});
	$(".str_po .mod_po").on("change keyup input click", "input[name=phone_user]", function(){
		var a=$(this).val();
		$(this).val(a.replace(/[^0-9()-+]/g, ''));
	});
	$(".str_po .mod_po").on("click", "#new_capcha", function(){
		var s_url="/orders/new_capcha.php";
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
	
	$(".str_po .mod_po").on("click", ".plus", function(){
		var elo = $(this).closest(".addel");
		var id_el = elo.attr("id_elem");
		var qty = elo.children(".qty").val()*1;
		elo.children(".qty").val(qty+1);
		d_sum(id_el);
	});
	$(".str_po .mod_po").on("click", ".minus", function(){
		var elo = $(this).closest(".addel");
		var id_el = elo.attr("id_elem");
		var qty = elo.children(".qty").val()*1;
		if(qty>1) elo.children(".qty").val(qty-1);
		else elo.children(".qty").val(1);
		d_sum(id_el);
	});
	
	$(".str_po .mod_po").on("change keyup input click", ".qty", function(){
		var a=$(this).val();
		$(this).val(a.replace(/[^0-9()-+]/g, ''));
		var elo = $(this).closest(".addel");
		var id_el = elo.attr("id_elem");
		//alert(id_el);
		d_sum(id_el);
	});
	$(".str_po .mod_po").on("click", ".del", function(){
		var id_elem=$(this).closest(".addel").attr("id_elem");
		$(".elo[id_elem="+id_elem+"]").find("[in_cart]").attr("in_cart","N");
		$(".elo[id_elem="+id_elem+"]").find(".chek").removeClass("chek").addClass("cart");
		$(this).closest(".addel").remove();
		var ce=$(".addel").length;
		if(ce==0) $(".str_po").css({"display":"none"});
		d_itogo();
	});
});

</script>