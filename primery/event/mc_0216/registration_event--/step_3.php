<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludePublicLangFile(__FILE__);
include "var_config.php"; // Конфигурация мероприятия

$APPLICATION->SetTitle(GetMessage('event_name')." \"".$title_m."\"");?>
<link rel="stylesheet" type="text/css" href="/com/registration_event/css/style_form.css" media="all">
<script charset="utf-8" type="text/javascript" src="/com/registration_event/js/script_form.js"></script>
<?global $t_step // Шаг регистрации?>
<?$t_step=3;?>
<?$APPLICATION->IncludeComponent("bitrix:form.result.edit", "reg_step_3", array(
	"RESULT_ID" => $_REQUEST["RESULT_ID"],
	"IGNORE_CUSTOM_TEMPLATE" => "N",
	"USE_EXTENDED_ERRORS" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/test/",
	"EDIT_ADDITIONAL" => "N",
	"EDIT_STATUS" => "N",
	"LIST_URL" => "result.php",
	"VIEW_URL" => "result_view.php",
	"CHAIN_ITEM_TEXT" => "",
	"CHAIN_ITEM_LINK" => ""
	),
	false
);?>
<br /><br />
<script type="text/javascript">
	$(document).ready(function() {
		$("a.gallery").fancybox();
		$("#dn_step_1").html("&#10004;");
		$("#dn_step_1").css({"background-color":"#28d8b2","color":"#fff"});
		$("#dn_step_2").html("&#10004;");
		$("#dn_step_2").css({"background-color":"#28d8b2","color":"#fff"});
		$("#dn_step_3").css({"background-color":"#28d8b2","color":"#fff"});
	});
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>