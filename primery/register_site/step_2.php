<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludePublicLangFile(__FILE__);
$APPLICATION->SetTitle(GetMessage('register_site'));
 header("Location: reglament.php");// переадресация на шаблоны шапок
?> 


<Br><br>
<h1><?$APPLICATION->ShowTitle();?></h1>

<div class="border-top"></div>
	<div class="left" style="width:230px;">
		<?
		// включаемая область для раздела
		$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."/../user/sect_inc.php", Array(), Array(
			"MODE"      => "html",                                           // будет редактировать в веб-редакторе
			"NAME"      => "Редактирование включаемой области раздела",      // текст всплывающей подсказки на иконке
			"TEMPLATE"  => "sect_inc.php"                    // имя шаблона для нового файла
			));
		?>
	</div>
	
	<div class="right" style="width:650px; overflow:auto; min-height:350px;">




<?if(isset($_POST["ok"]) && $_POST["ok"]!="ok"){?>
<meta http-equiv="Refresh" content="0; URL=step_1.php">
<?}?>
<script type="text/javascript" src="/js/validate/jquery.validate.min.js"></script>
<link rel="stylesheet" href="/css/register_site.css" />
<div id="form_register">
<br/>
<h2><?$APPLICATION->ShowTitle();?></h2>
<div class="shkala"><div class="ts_1_a" onclick="window.location.replace('step_1.php')"><?=GetMessage('step_1')?></div><div class="ts_2_a"><?=GetMessage('step_2')?></div>
<div class="nich"></div>
<div class="img"><img src="/images/register_site/shkala_2.png"></div>
</div>

 <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"register_site_15",
	Array(
		"SEF_MODE" => "N",
		"WEB_FORM_ID" => "9",
		"LIST_URL" => "",
		"EDIT_URL" => "result_edit.php",
		"SUCCESS_URL" => "",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"VARIABLE_ALIASES" => Array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID"
		)
	),
false
);?>
</div>
<br/><br/>



</div>
 <div class="clear-all"></div>
<br /><br />
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>