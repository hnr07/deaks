<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Редактирование заявки");

include "../var_config.php";
global $USER;
if(!in_array($group_id, $USER->GetUserGroupArray())) echo "<meta http-equiv=\"refresh\" content=\"0;url=/\" />";
?>
<!--
<script src="/js/textchange/jquery.textchange.min.js"></script>
<link rel="stylesheet" href="/js/jquery_mobile/themes/сс_16/cc_16.min.css" />
<link rel="stylesheet" href="/js/jquery_mobile/themes/сс_16/jquery.mobile.icons.min.css" />
 <link rel="stylesheet" href="/js/jquery_mobile/themes/сс_16/structure.css" /> 
  <script src="/js/jquery_mobile/jquery.mobile-1.4.5.js"></script>
  <script src="../../js/script_form.js"></script>
   <script src="script_ajax_edit.js"></script>
  <script src="../../js/jquery_mobile/script_ajax.js"></script>
  <link rel="stylesheet" href="../../css/style_form.css" /> 
  -->


<?$APPLICATION->IncludeComponent("bitrix:form.result.edit", "admin_edit_2", array(
	"RESULT_ID" => $_REQUEST[RESULT_ID],
	"IGNORE_CUSTOM_TEMPLATE" => "N",
	"USE_EXTENDED_ERRORS" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => $dir_event,
	"EDIT_ADDITIONAL" => "N",
	"EDIT_STATUS" => "Y",
	"LIST_URL" => "index.php",
	"VIEW_URL" => "result_view.php",
	"CHAIN_ITEM_TEXT" => "",
	"CHAIN_ITEM_LINK" => ""
	),
	false
);?>

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>