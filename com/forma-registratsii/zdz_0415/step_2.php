<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заявка");
?>
<?global $t_step // Шаг регистрации?>
<?$t_step=2;?>
<link href="/com/forma-registratsii/zdz_0415/css/style_form.css" type="text/css"  rel="stylesheet" />
<script type="text/javascript" src="/com/forma-registratsii/zdz_0415/js_script.js"></script>

<? include "var_config.php"; ?>
<? if(!$_SESSION["f_lang"]) $_SESSION["f_lang"]="ru"?>
<?if($_POST['forpa']<>1):?>
<meta http-equiv="Refresh" content="0; URL=<?=$dir_event?>step_1.php">
<?else:?>

<?$APPLICATION->IncludeComponent("bitrix:form.result.new", $code_m."_step_2", array(
	"WEB_FORM_ID" => $form_m,
	"IGNORE_CUSTOM_TEMPLATE" => "Y",
	"USE_EXTENDED_ERRORS" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/test/",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"LIST_URL" => "step_3.php",
	"EDIT_URL" => "",
	"SUCCESS_URL" => "",
	"CHAIN_ITEM_TEXT" => "",
	"CHAIN_ITEM_LINK" => "",
	"VARIABLE_ALIASES" => array(
		"WEB_FORM_ID" => "WEB_FORM_ID",
		"RESULT_ID" => "RESULT_ID",
	)
	),
	false
);?>
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>