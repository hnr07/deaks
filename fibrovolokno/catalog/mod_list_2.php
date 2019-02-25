<?
global $USER;
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

<div class="mod_calc hidden">
<div class="sel aaj" SELECTION="Y" PAGEN_1="0">Ваш выбор <sup>0</sup> - <span></span></div>
	
	<div class="weight" title="0 кг">0 <span class="weight_nt">кг</span></div>	
	<div class="itogo" title="0 руб">0 <div class="rur">q</div></div>
	<button type="button" id="show_mod_po" class="d_go_shop">Купить <div class="cart"></div></button>
</div>

<div class="str_po">
	<div class="mod_po">
		<div class="d_carry" title="Вернуться к выбору"></div>
				
		<div class="note_ok">Заказ успешно оформлен!<br />В ближайшее время наш менеджер свяжется с вами.</div>
		
		<div class="mod_form">
			<div class="title_form">Контактная информация</div>

			<div class="col">
			
				<div class="dibox_name <?=($USER->GetFullName())?"pos_a":"pos_i"?>">Имя</div>
				<input type="text" class="dibox_in" name="name_user" value="<?=$USER->GetFullName()?>">
			
				<div class="dibox_name pos_i">Телефон</div>
				<input type="text" class="dibox_in" name="phone_user" value="">
				
			</div>
			<div class="col">
			
				<div class="dibox_name pos_i">Адрес</div>
				<input type="text" class="dibox_in" name="address_user" value="">
			
				<div class="dibox_name <?=($USER->GetEmail())?"pos_a":"pos_i"?>">e-mail</div>
				<input type="text" class="dibox_in" name="email_user" value="<?=$USER->GetEmail()?>">
				
			</div>
			<div class="table_order">
				<div class="head_table"><div class="logo"></div><div class="tit_sum">Стоимость</div><div class="tit_price">Цена</div><div class="tit_qty">Количество</div></div>
				<div class="elem_table" id="elem_table"></div>
				
			</div>
			
		</div>
		<div class="listel">
			<input type="hidden" name="itogo_weight" value="">
			<input type="hidden" name="itogo" value="">
			<input type="hidden" name="itogo_qty" value="">
		</div>

	</div>
	
</div>

