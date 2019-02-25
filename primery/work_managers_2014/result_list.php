<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Опрос: \"Работа менеджеров-2014\"");
?> 
<div class="clear-all"></div>
 <?
global $USER;
$ar_gr=$USER->GetUserGroupArray();

$ar_us=array(10972,1530);

//if(in_array(1, $ar_gr) || in_array($USER->GetID(), $ar_us)) {
	if(true) {
?>
<br />
 <? //echo "<pre>"; print_r($_REQUEST); echo "</pre>";?>
<br />
 <?$APPLICATION->IncludeComponent(
	"mh-soft:form.result.list",
	"templates_admin_list",
	Array(
		"SEF_MODE" => "N",
		"WEB_FORM_ID" => $_REQUEST["WEB_FORM_ID"],
		"ENABLE_RESULT_VIEW" => "N",
		"ENABLE_STATUS_EDIT" => "N",
		"ENABLE_RESULT_EDIT" => "N",
		"ENABLE_RESULT_COPY" => "N",
		"ENABLE_STAT_VIEW" => "Y",
		"OLD_RESULT_STATUS" => "0",
		"NEW_RESULT_STATUS" => "0",
		"VIEW_URL" => "result_view.php",
		"EDIT_URL" => "result_edit.php",
		"NEW_URL" => "index.php",
		"COPY_URL" => "result_copy.php",
		"STAT_URL" => "stat_view.php",
		"SHOW_FILTER_STATUS" => array(),
		"FIELD_QUICK_SEARCH" => "user",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"PAGE_SIZE" => "20",
		"PAGER_TEMPLATE" => "navigation_events_list",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Результат",
		"PAGER_SHOW_ALWAYS" => "N"
	)
);?> 
<?
}
else {
?>
<div class="">У Вас недостаточно прав для просмотра результатов.</div>
<?}?>
<br />
 
<br />
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>