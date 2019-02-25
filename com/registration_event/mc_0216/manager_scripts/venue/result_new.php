<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавление площадки");?> 
<? include "../../var_config.php"; // Конфигурация мероприятия?>
<style>
#div_new_volna {
	margin:20px 40px;
}
#div_new_volna td{
	padding:5px 20px;
}

#div_new_volna input{
	border:solid 1px #b2b2b2;
	width:300px;
}

#div_new_volna textarea{
	border:solid 1px #b2b2b2;
	width:300px;
}
#div_new_volna select{
	border:solid 1px #b2b2b2;
	width:300px;
}
#div_new_volna input[type=submit], #div_new_volna input[type=reset]{
	margin-top:20px;
	border:solid 1px #b2b2b2;
	width:120px;
	height:30px;
}
#div_new_volna #dse input {
	border:0;
}
</style>

<div id="div_new_volna">
<input type="hidden" id="sid_event" value="<?=$code_m?>">
<?$APPLICATION->IncludeComponent("bitrix:form.result.new","",Array(
        "SEF_MODE" => "Y", 
        "WEB_FORM_ID" => $_REQUEST["WEB_FORM_ID"], 
        "LIST_URL" => "index.php", 
        "EDIT_URL" => "result_edit.php", 
        "SUCCESS_URL" => "", 
        "CHAIN_ITEM_TEXT" => "", 
        "CHAIN_ITEM_LINK" => "", 
        "IGNORE_CUSTOM_TEMPLATE" => "N", 
        "USE_EXTENDED_ERRORS" => "Y", 
        "CACHE_TYPE" => "A", 
        "CACHE_TIME" => "3600", 
        "SEF_FOLDER" => "", 
        "VARIABLE_ALIASES" => Array(
        )
    )
);?>

<div><a href="index.php">Список >>></a></div>
</div>
<script>
var sid_event=$("#sid_event").val();

$("#dse input").val(sid_event);
$("#dse span").html(sid_event);
</script>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>