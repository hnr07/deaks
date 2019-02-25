<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
global $USER;
if(!$USER->IsAuthorized()) {$authorize=$USER->Authorize(4);header("Location: ".$_SERVER["REQUEST_URI"]);}
$APPLICATION->SetTitle("");?><h4>Параметры компонента "Статитика результатов формы"</h4>
 <a class="fancybox" href="/images/form_stat/par_stat_form_1.jpg" data-fancybox-group="gallery" title="Параметры компонента"><img alt="" src="/images/form_stat/par_stat_form_1_m.jpg"></a> <a class="fancybox" href="/images/form_stat/par_stat_form_2.jpg" data-fancybox-group="gallery" title="Параметры компонента"><img alt="" src="/images/form_stat/par_stat_form_2_m.jpg"></a>
<?$APPLICATION->IncludeComponent(
	"mh-soft:form.statistics", 
	"statistic_form_line", 
	array(
		"SEF_MODE" => "N",
		"WEB_FORM_ID" => "3",
		"VIEW_URL" => "../work_managers_2014/result_list.php?WEB_FORM_ID=#WEB_FORM_ID#",
		"NEW_URL" => "../work_managers_2014/",
		"SHOW_FILTER_STATUS" => array(
		),
		"EXCLUDED_FROM_PROCESSING" => array(
		),
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"PAGE_SIZE" => "10",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Результат",
		"PAGER_SHOW_ALWAYS" => "N",
		"SEF_FOLDER" => "/ru/primery/form_stat/",
		"COMPONENT_TEMPLATE" => "statistic_form_line"
	),
	false
);?>
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
</script><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>