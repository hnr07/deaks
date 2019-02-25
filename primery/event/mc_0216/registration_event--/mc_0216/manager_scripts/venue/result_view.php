<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Просмотр площадки");?> 

<?$APPLICATION->IncludeComponent("bitrix:form.result.view","",Array(
        "SEF_MODE" => "Y", 
        "RESULT_ID" => $_REQUEST["RESULT_ID"], 
        "SHOW_ADDITIONAL" => "Y", 
        "SHOW_ANSWER_VALUE" => "Y", 
        "SHOW_STATUS" => "Y", 
        "EDIT_URL" => "result_edit.php?RESULT_ID=".$_REQUEST["RESULT_ID"], 
        "CHAIN_ITEM_TEXT" => "", 
        "CHAIN_ITEM_LINK" => "", 
        "SEF_FOLDER" => "", 
        "SEF_URL_TEMPLATES" => Array(
            "view" => "#RESULT_ID#/"
        ),
        "VARIABLE_ALIASES" => Array(
            "view" => Array(),
        )
    )
);?>

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>