<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?

//echo "<pre>"; print_r($_POST); echo "</pre>";
global $USER;
$NUMERIC = str_replace(array("+","-","(",")"," "),"",$_POST["PHONE"]);  // код из номера телефона без лишних символов

//$NUMERIC = "web";
$rsUser = CUser::GetByLogin($NUMERIC);  // ищем пользователя в базе по коду
if($arUser = $rsUser->Fetch()){
	
	if($arUser["ID"]!=$USER->GetID()) {
		CModule::IncludeModule("sale");
		$UID=$arUser["ID"];
		$arFilter = Array("USER_ID" => $UID, "CANCELED" => "N", "STATUS_ID"=>array("F"));
		$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
		echo $db_sales->SelectedRowsCount();
	}
}

?>
<?require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php";?>