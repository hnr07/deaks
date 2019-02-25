<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Изменение площадки");?> 
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
<?$APPLICATION->IncludeComponent("bitrix:form.result.edit","",Array(
        "SEF_MODE" => "Y", 
        "RESULT_ID" => $_REQUEST["RESULT_ID"], 
        "EDIT_ADDITIONAL" => "N", 
        "EDIT_STATUS" => "Y", 
        "LIST_URL" => "index.php", 
        "VIEW_URL" => "result_view.php", 
        "CHAIN_ITEM_TEXT" => "", 
        "CHAIN_ITEM_LINK" => "", 
        "IGNORE_CUSTOM_TEMPLATE" => "N", 
        "USE_EXTENDED_ERRORS" => "Y", 
        "SEF_FOLDER" => "", 
        "SEF_URL_TEMPLATES" => Array(
            "edit" => "#RESULT_ID#/"
        ),
        "VARIABLE_ALIASES" => Array(
            "view" => Array(),
            "edit" => Array(),
        )
    )
);?>
<div><a href="index.php">Список >>></a></div>
</div>
<script>
var sid_event=$("#dse input").val();

$("#dse span").html(sid_event);
</script>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>