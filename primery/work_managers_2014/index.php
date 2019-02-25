<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Опрос: \"Работа менеджеров-2014\"");
?>
<!--<br>
 <br>
<h2><?=$APPLICATION->GetTitle();?></h2>
 <br>
 <br>-->
 <?
global $USER;
$ar_gr=$USER->GetUserGroupArray();
//if(in_array(14, $ar_gr) || in_array(1, $ar_gr)) {
if(true) {
?>
<p style="display: none;">
 <b>Опрос завершён. Спасибо за участие!</b>
</p>
<div id="opros" style="display: block;" onkeypress="if(event.keyCode == 13) return false;">
	 <?
if($RESULT_ID) {

?>
	<p style="color: green; font-size: 14pt;">
		 Благодарим Вас за отзыв!
	</p>
	 <?}else{?>
	<h2>Уважаемые руководители офисов продаж!</h2>
	<p>
		 Пожалуйста, уделите немного времени данной анкете – это поможет сделать нашу с вами работу еще эффективнее.
	</p>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"work_managers_2014",
	Array(
		"SEF_MODE" => "N",
		"WEB_FORM_ID" => "5",
		"LIST_URL" => "",
		"EDIT_URL" => "",
		"SUCCESS_URL" => "",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_NOTES" => "",
		"VARIABLE_ALIASES" => Array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID")
	)
);?> <?}?>
</div>
 <?
}
else {
?>
<div>
	 У Вас недостаточно прав для участия в опросе. Обратитесь к менеджеру, курирующему ваш офис.
</div>
 <?}?>
<div class="clear-all">
</div>
 <br>
 <br>
 <br>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>