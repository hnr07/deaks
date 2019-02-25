<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?> 
<? include "../../var_config.php"; // Конфигурация мероприятия?>
<?global $code_m;?>
 <?$APPLICATION->IncludeComponent(
	"mh-soft:form.result.list",
	"volna_admin_list",
	Array(
		"SEF_MODE" => "N",
		"WEB_FORM_ID" => "35",
		"ENABLE_RESULT_VIEW" => "Y",
		"ENABLE_STATUS_EDIT" => "Y",
		"ENABLE_RESULT_EDIT" => "Y",
		"ENABLE_RESULT_COPY" => "Y",
		"ENABLE_STAT_VIEW" => "N",
		"OLD_RESULT_STATUS" => "0",
		"NEW_RESULT_STATUS" => "0",
		"VIEW_URL" => "result_view.php",
		"EDIT_URL" => "result_edit.php",
		"NEW_URL" => "result_new.php",
		"COPY_URL" => "result_copy.php",
		"STAT_URL" => "stat_view.php",
		"SHOW_FILTER_STATUS" => array("149", "150"),
		"FIELD_QUICK_SEARCH" => "mesto",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"PAGE_SIZE" => "50",
		"PAGER_TEMPLATE" => "navigation_events_list",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Результат",
		"PAGER_SHOW_ALWAYS" => "N"
	)
);?> 
<br />
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>