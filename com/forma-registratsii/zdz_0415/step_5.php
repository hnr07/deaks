<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заявка");
?>
<?global $t_step // Шаг регистрации?>
<?$t_step=5;?>
<link href="/com/forma-registratsii/zdz_0415/css/style_form.css" type="text/css"  rel="stylesheet" />
<script type="text/javascript" src="/com/forma-registratsii/zdz_0415/js_script.js"></script>
<? include "var_config.php"; ?>
<? if(!$_SESSION["f_lang"]) $_SESSION["f_lang"]="ru"?>
<?$APPLICATION->IncludeComponent("bitrix:form.result.edit", $code_m."_step_5", array(
	"RESULT_ID" => $_REQUEST[RESULT_ID],
	"IGNORE_CUSTOM_TEMPLATE" => "N",
	"USE_EXTENDED_ERRORS" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/test/",
	"EDIT_ADDITIONAL" => "N",
	"EDIT_STATUS" => "N",
	"LIST_URL" => "step_6.php",
	"VIEW_URL" => "result_view.php",
	"CHAIN_ITEM_TEXT" => "",
	"CHAIN_ITEM_LINK" => ""
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>