<?define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Компонент \"Список результатов формы\"");
global $USER;

?>
<h4>Параметры компонента "Список результатов формы"</h4>
<a class="fancybox" href="/images/form_list/par_com_1.jpg" data-fancybox-group="gallery" title="Параметры компонента"><img src="/images/form_list/par_com_1_m.jpg" alt="" /></a>
<a class="fancybox" href="/images/form_list/par_com_2.jpg" data-fancybox-group="gallery" title="Параметры компонента"><img src="/images/form_list/par_com_2_m.jpg" alt="" /></a>
<a class="fancybox" href="/images/form_list/par_com_3.jpg" data-fancybox-group="gallery" title="Параметры компонента"><img src="/images/form_list/par_com_3_m.jpg" alt="" /></a>
<div style="font-style:italic;">Подробное описание в разделе компонента "Помощь" (иконка <img src="/local/templates/lilac_18/components/mh-soft/form.result.list/event_14_list/images/help.png" style="vertical-align:middle;width:16px;height:16px;" />)</div>
<?

$APPLICATION->IncludeComponent(
	"mh-soft:form.result.list", 
	"event_14_list", 
	array(
		"WEB_FORM_ID" => "1",
		"SEF_MODE" => "N",
		"ENABLE_RESULT_VIEW" => "Y",
		"ENABLE_STATUS_EDIT" => "Y",
		"ENABLE_RESULT_EDIT" => "Y",
		"ENABLE_RESULT_COPY" => "Y",
		"ENABLE_STAT_VIEW" => "Y",
		"OLD_RESULT_STATUS" => "0",
		"NEW_RESULT_STATUS" => "1",
		"VIEW_URL" => "",
		"EDIT_URL" => "result_edit.php",
		"NEW_URL" => "/ru/forma-registratsii/zdz_0415/",
		"COPY_URL" => "",
		"STAT_URL" => "stat_form.php",
		"SHOW_FILTER_STATUS" => array(
		),
		"FIELD_QUICK_SEARCH" => "family",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"PAGE_SIZE" => "20",
		"PAGER_TEMPLATE" => "navigation_events_list",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Результат",
		"PAGER_SHOW_ALWAYS" => "N",
		"SEF_FOLDER" => "/primery/form_list/",
		"ENABLE_RESULT_DEL" => "Y"
	),
	false
);

?>
<script type="text/javascript">
	$(document).ready(function() {
		$('.fancybox').fancybox({
			openEffect : 'elastic',
			openSpeed  : 150,

			closeEffect : 'elastic',
			closeSpeed  : 150,
			
			prevEffect : 'fade',
			nextEffect : 'fade',
		});
	});
	</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>