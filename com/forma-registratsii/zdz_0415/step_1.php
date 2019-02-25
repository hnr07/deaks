<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заявка");

?>

<?global $t_step // Шаг регистрации?>
<?$t_step=1;?>
<link href="/com/forma-registratsii/zdz_0415/css/style_form.css" type="text/css"  rel="stylesheet" />
<script type="text/javascript" src="/com/forma-registratsii/zdz_0415/js_script.js"></script>
<? include "var_config.php"; ?>

<? if(!$_SESSION["f_lang"]) $_SESSION["f_lang"]="ru"?>
<?
$ds_s=explode(".",$d_reg_s);
$ds=(int)($ds_s[2].$ds_s[1].$ds_s[0]);
$df_s=explode(".",$d_reg_f);
$df=(int)($df_s[2].$df_s[1].$df_s[0]);

if(date("Ymd")>=$ds && date("Ymd")<=$df) $registration=1;
else $registration=0;
?>
<?//$registration=1;$_GET['pravila']=1;?>

<?if(in_array($USER->GetID(), $ar_manager)) $registration=1;?>
<?if($_GET['pravila']<>1 || !$registration):?>
<meta http-equiv="Refresh" content="0; URL=<?=$dir_event?>index.php">
<?else:?>


<?$APPLICATION->IncludeComponent("bitrix:form.result.new", $code_m."_step_1", array(
	"WEB_FORM_ID" => $form_m,
	"IGNORE_CUSTOM_TEMPLATE" => "Y",
	"USE_EXTENDED_ERRORS" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/test/",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"LIST_URL" => "step_2.php",
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