<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
global $USER;
// Подключаем капчу
$bc="Y";// Капча будет - Y, нет - N
if($USER->IsAuthorized()){
	$bc="N"; // для авторизованного капчи нет
	 $rsUser = CUser::GetByID($USER->GetID()); //$USER->GetID() - получаем ID авторизованного пользователя  и сразу же - его поля
  $arUser = $rsUser->Fetch();
  $user_name=$arUser["NAME"];
  $user_phone=$arUser["PERSONAL_PHONE"];
  if($arUser["EMAIL"]!=$arUser["LOGIN"]."@not.real")  $user_email=$arUser["EMAIL"];
  else $user_email='';
}
if($bc=="Y") {
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

$available = array('FIO'=>array('title'=>'Имя','value'=>$user_name),'PHONE'=>array('title'=>'Телефон','value'=>$user_phone),'EMAIL'=>array('title'=>'E-mail','value'=>$user_email)); 

?>
<style>
	body {max-width:800px;}
</style>
<div class="box_content">
<div class="tifo">Контакты</div>
	
	<p><b>Телефон:</b> +7(***) ***-**-**<br>
	<b>Адрес:</b> г. ******, ул. **********, д. **</p>
	<!--<iframe width="640" height="490" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.ru/maps?f=q&amp;source=s_q&amp;hl=ru&amp;geocode=&amp;q=%D0%B3.+%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0,+%D1%83%D0%BB.+2-%D1%8F+%D0%A5%D1%83%D1%82%D0%BE%D1%80%D1%81%D0%BA%D0%B0%D1%8F,+%D0%B4.+38%D0%90&amp;aq=&amp;sll=55,103&amp;sspn=90.84699,270.527344&amp;t=m&amp;ie=UTF8&amp;hq=&amp;hnear=2-%D1%8F+%D0%A5%D1%83%D1%82%D0%BE%D1%80%D1%81%D0%BA%D0%B0%D1%8F+%D1%83%D0%BB.,+38,+%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0,+127287&amp;ll=55.805478,37.569551&amp;spn=0.023154,0.054932&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="https://maps.google.ru/maps?f=q&amp;source=embed&amp;hl=ru&amp;geocode=&amp;q=%D0%B3.+%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0,+%D1%83%D0%BB.+2-%D1%8F+%D0%A5%D1%83%D1%82%D0%BE%D1%80%D1%81%D0%BA%D0%B0%D1%8F,+%D0%B4.+38%D0%90&amp;aq=&amp;sll=55,103&amp;sspn=90.84699,270.527344&amp;t=m&amp;ie=UTF8&amp;hq=&amp;hnear=2-%D1%8F+%D0%A5%D1%83%D1%82%D0%BE%D1%80%D1%81%D0%BA%D0%B0%D1%8F+%D1%83%D0%BB.,+38,+%D0%9C%D0%BE%D1%81%D0%BA%D0%B2%D0%B0,+127287&amp;ll=55.805478,37.569551&amp;spn=0.023154,0.054932&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left">Просмотреть увеличенную карту</a></small>-->
	<div class="tifo">Задать вопрос</div>
	<b>Внимание!</b> Это форма для примера! Обратная связь сайта deaks.ru <a href="/contacts.php">здесь >>></a>
	<form id="form_ask_question" class="b_shadow">
		
			<?foreach($available as $code=>$uform) {?>
				<div class="row">
					<div class="title"><?=$uform['title']?></div>
					<input type="text" name="<?=$code?>" value="<?=$uform['value']?>" placeholder="<?//=$title?>" class="pof" />	
				</div>
			<?}?>
			<div class="row">
				<div class="title">Вопрос</div>
				<textarea name="QUESTION" class="pof"></textarea>	
			</div>
		
		<?if($bc=="Y") {?>
			<div class="capcha_box">
				<span>Проверочный код</span>
				<div class="div_capcha">
					<input name="captcha_code" value="<?=htmlspecialchars($cpt->GetCodeCrypt());?>" type="hidden">
					<img src="/bitrix/tools/captcha.php?captcha_code=<?=htmlspecialchars($cpt->GetCodeCrypt());?>" title="Введите проверочный код">
					<div id="new_capcha" title="Обновить код"></div>
					<input id="captcha_word" name="captcha_word" type="text" placeholder="" title="Введите проверочный код" class="pof">
				</div>
			</div>
		<?}?>
		<div class="err"></div>
		<button type="submit" class="obutton quest">Спросить</button>
		<div class="ok_quest" title="Ещё спросить">
			Ваш вопрос принят!<br />
			В ближайшее время с Вами свяжется оператор.
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
	$('#form_ask_question').on("submit", function(){
		if(erpo()==true) {
			var data=$(this).serialize();
			//alert(data);
			var url="/contacts/add_ask_question.php";
			$.ajax({  
				type: "POST",
				url: url,  
				data: data, 
				cache: false,  
				success: function(html){ 
					//$("#res_ajax").html(html);
					if(html>0) {
						$("#form_ask_question .ok_quest").slideDown();
						$("#form_ask_question .err").slideUp(); 
					}
					else {
						$("#form_ask_question .err").slideDown();
						if(html<0) $("#form_ask_question .err").html("Ошибка проверочного кода!");
						else $("#form_ask_question .err").html("Ошибка сохранения! Попробуйте позже.");
					}
				} 
			});
		}
		return false;
	});
	
	function erpo(){
		var ke=0;
		 $("#form_ask_question .pof").each(function(){
		 var str=$.trim($(this).val());
			if(str=="") {
				$(this).css({"background-color":"#f9b5b6"});ke++;
			}
			else {
				$(this).css({"background-color":"solid 1px #fff"});
			}		
		});
		
		if(ke>0) {
			$("#form_ask_question .err").html("Заполните, пожалуйста, поля формы!");
			$("#form_ask_question .err").slideDown(); 
			return false;
		}
		else {
			$("#form_ask_question .err").slideUp(); 
			return true;
		}
	}
	
	$('#form_ask_question .ok_quest').on("click", function(){
		$(this).slideUp();
		$("#form_ask_question .capcha_box .div_capcha #new_capcha").click();
	});
});


</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>