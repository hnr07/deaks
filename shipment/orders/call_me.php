<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//IncludeTemplateLangFile(SITE_TEMPLATE_PATH.'/header.php');

//--------------настройки начало-------------------//
$bc_call_me="Y";// Капча будет - Y, нет - N для обратного звонка
$available = array('PHONE'=>'Телефон', 'FIO'=>'Имя'); 
//--------------настройки конец-------------------//

// Подключаем капчу
if($bc_call_me!="N") {
	include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
	$cpt = new CCaptcha();
	$captchaPass = COption::GetOptionString("main", "captcha_password", "");
	if(strlen($captchaPass) <= 0)
	{
	   $captchaPass = randString(10);
	   COption::SetOptionString("main", "captcha_password", $captchaPass);
	}
	$cpt->SetCodeCrypt($captchaPass);
}

?>
<div class="box_order call_me">
	<form id="form_call_me">
		<div class="row">
		<div class="title">Пользователь</div>
			<?foreach($available as $code=>$title) {?>
				<input type="text" name="<?=$code?>" value="" placeholder="<?=$title?>" />	
			<?}?>
		</div>
		<?if($bc_call_me!="N") {?>
			<div class="capcha_box">
				<span>Проверочный код</span>
				<div class="div_capcha">
					<input name="captcha_code" value="<?=htmlspecialchars($cpt->GetCodeCrypt());?>" type="hidden">
					<img src="/bitrix/tools/captcha.php?captcha_code=<?=htmlspecialchars($cpt->GetCodeCrypt());?>" title="Введите проверочный код">
					<div id="new_capcha" title="Обновить код"></div>
					<input id="captcha_word" name="captcha_word" type="text" placeholder="" title="Введите проверочный код">
				</div>
			</div>
		<?}?>
		<div class="err"></div>
		<div class="loader"><img src="/shipment/images/loader_35.gif" /></div>
		<button type="submit" class="obutton cellme">Перезвонить</button>
		<div class="ok_order" title="Ещё заказать звонок">
			Ваше обращение принято!<br />
			Но это пример и Вам никто не перезвонит.
		</div>
	</form>
	
</div>
<script type="text/javascript">
$(document).ready(function(){

	$("input[name=PHONE]").bind("change keyup input click", function() {
		var input=$(this);
		if (this.value.match(/[^0-9]/g)) {
			var et=this.value.replace(/[^0-9+)(-]/g, '');
			this.value = et;
		}
	});
	$('#form_call_me').on("submit", function(){
		if(erpo()==true) {
			$(".box_order .cellme").css({"display":"none"});
			var data=$(this).serialize();
			//alert(data);
			var url="orders/add_call_me.php";
			$.ajax({  
				type: "POST",
				url: url,  
				data: data, 
				cache: false,  
				success: function(html){ 
					//$("#res_ajax").html(html);
					if(html>0) {
						$("#form_call_me .ok_order").slideDown();
						$("#form_call_me .err").slideUp(); 
					}
					else {
						$("#form_call_me .err").slideDown();
						if(html<0) $("#form_call_me .err").html("Ошибка проверочного кода!");
						else $("#form_call_me .err").html("Ошибка сохранения! Попробуйте позже.");
					}
					$(".box_order .cellme").css({"display":"block"});
				} 
			});
		}
		return false;
	});
	
	function erpo(){
		var ke=0;
		 $("#form_call_me input").each(function(){
		 var str=$.trim($(this).val());
			if(str=="") {
				$(this).css({"background-color":"#f9b5b6"});ke++;
			}
			else {
				$(this).css({"background-color":"solid 1px #fff"});
			}		
		});
		if(ke>0) {
			$("#form_call_me .err").html("Заполните, пожалуйста, поля формы!");
			$("#form_call_me .err").slideDown(); 
			return false;
		}
		else {
			$("#form_call_me .err").slideUp(); 
			return true;
		}
	}
	
	$('#form_call_me .ok_order').on("click", function(){
		$(this).slideUp();
		$("#form_call_me .capcha_box .div_capcha #new_capcha").click();
	});
});


</script>