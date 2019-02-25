<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludePublicLangFile(__FILE__);
include "var_config.php"; // Конфигурация мероприятия

$APPLICATION->SetTitle(GetMessage('event_name')." \"".$title_m."\"");?>
<link rel="stylesheet" type="text/css" href="/com/registration_event/css/style_form.css" media="all">
<script charset="utf-8" type="text/javascript" src="/com/registration_event/js/script_form.js"></script>
<script charset="utf-8" type="text/javascript" src="/com/registration_event/js/script_ajax.js"></script>

<?global $t_step // Шаг регистрации?>
<?$t_step=1;?>
<?
$ds_s=explode(".",$d_reg_s);
$ds=(int)($ds_s[2].$ds_s[1].$ds_s[0]);
$df_s=explode(".",$d_reg_f);
$df=(int)($df_s[2].$df_s[1].$df_s[0]);

if(date("Ymd")>=$ds && date("Ymd")<=$df) $registration=1;
else $registration=0;

?>
<?//if(in_array($USER->GetID(), $ar_manager)) $registration=1;?>
<?if(CSite::InGroup (array($group_id))) $registration=1;?>
<?if($_GET['pravila']<>1 || !$registration):?>
<meta http-equiv="Refresh" content="0; URL=<?="/".LANGUAGE_ID.$dir_event?>index.php">
<?else:?>
<? if($_SERVER['REMOTE_ADDR'] == "91.210.229.73" or 1 == 1) { ?>
<? $APPLICATION->IncludeComponent("bitrix:form.result.new", "reg_step_1", array(
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
<? } else {?>
<div class="tuu" style="    margin: 20px;
    padding: 20px 40px;
    background-color: #fff;
    border: solid 0px #a2a2a2;
    -moz-border-radius: 0px;
    -webkit-border-radius: 0px;
    -khtml-border-radius: 0x;
    border-radius: 0px;
    -moz-box-shadow: 0 0 15px #000;
    -webkit-box-shadow: 0 0 15px #000;
    box-shadow: 0 0 15px #000;">
Уважаемые дистрибьюторы!<br><br>Сегодня, 18 ноября 2015 года, форма регистрации будет недоступна в период с 10:30 (UTC +3 часа) до 12:30 (UTC +3 часа) в связи с проведением технических работ. <br><br>Приносим свои извинения за доставленные неудобства!
</div>
<? } ?>
<?endif;?>
<br /><br />
<script type="text/javascript">
	$(document).ready(function() {
		$("a.gallery").fancybox();
		
		$("#dn_step_1").css({"background-color":"#28d8b2","color":"#fff"});
	});
	
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>