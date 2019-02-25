<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
global $USER;
$numeric = str_replace(array("+","-","(",")"," "),"",$_POST["PHONE"]); 

//$numeric = "web";
$rsUser = CUser::GetByLogin($numeric); 
if($arUser = $rsUser->Fetch()){
	//echo "<pre>"; print_r($arUser); echo "</pre>";
	$UID=$arUser["ID"];
}
else {
	$new_user = new CUser;
	$arFields = Array(
	  "NAME"              => $_POST["FIO"],
	  "LAST_NAME"         => "",
	  "EMAIL"             => $numeric."@cargo.com",
	  "LOGIN"             => $numeric,
	  "LID"               => "ru",
	  "ACTIVE"            => "Y",
	  "GROUP_ID"          => array(2),
	  "PASSWORD"          => $numeric,
	  "CONFIRM_PASSWORD"  => $numeric,
	  "PERSONAL_PHONE"    => $_POST["PHONE"]
	);

	$UID = $new_user->Add($arFields);	
}
if (intval($UID) > 0) $USER->Authorize(intval($UID)); // авторизуем
//echo $UID;
//echo "<pre>";print_r($_POST);echo "</pre>";

//echo $numeric;
$pc=1;

if($_POST["captcha_code"]) {
	if(!$APPLICATION->CaptchaCheckCode($_POST["captcha_word"], $_POST["captcha_code"])) $pc=0;
	else $pc=1;
}

if($pc) {
	CModule::IncludeModule('iblock'); 
	$el = new CIBlockElement;

	$PROP = array();
	$PROP["FIO"] = $_POST["FIO"]; 
	$PROP["PHONE"] = $_POST["PHONE"]; 
	$PROP["FIO_2"] = $_POST["FIO_2"]; 
	$PROP["PHONE_2"] = $_POST["PHONE"]; 
	$PROP["TO_ADR"] = $_POST["TO_ADR"]; 
	$PROP["TO_ADR_COORDS"] = $_POST["TO_ADR_COORDS"]; 
	$PROP["NOTE"] = $_POST["NOTE"]; 
	$PROP["WHAT_CARRING"] = $_POST["WHAT_CARRING"]; 
	$PROP["WHEN"] = $_POST["WHEN"];
	$PROP["PERIOD"] = $_POST["PERIOD"];
	$PROP["NUMERIC"] = $numeric; 
	$PROP["STATUS"] = array("VALUE" => 25);
	$PROP["TO_MAP"] = array("VALUE"=>$_POST["TO_ADR_COORDS"]); 
	$PROP["QUANTITY"] = $_POST["QUANTITY"];
	$PROP["ID_PAY"] = $_POST["ID_PAY"];
	$PROP["PAY_TEXT"] = $_POST["PAY_TEXT"];

	$arLoadProductArray = array(
	  "MODIFIED_BY"    => $UID, // элемент изменен текущим пользователем
	  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
	  "IBLOCK_ID"      => 5,
	  "PROPERTY_VALUES"=> $PROP,
	  "NAME"           => date("d.m.Y")." ".$_POST["FIO"],
	  "ACTIVE"         => "Y",            // активен
	  "PREVIEW_TEXT"   => "",
	  "PREVIEW_TEXT_TYPE" => "text",
	  "DETAIL_TEXT"    => "",
	  );
	
	if($ORDER_ID = $el->Add($arLoadProductArray))  {
		// Массив данных для шаблона
		$arFields_add_order = array(
			"IBLOCK_ID"      => $IBLOCK_ID,
			"IBLOCK_TYPE" => "taxi",
			"ID" => $ORDER_ID,            // ID заявки
			"FIO" => $_POST["FIO"],     //ФИО заказчик
			"PHONE" => $_POST["PHONE"], // телефон заказчик
			"FIO_2" => $_POST["FIO_2"],     //ФИО получатель
			"PHONE_2" => $_POST["PHONE_2"], // телефон получатель
			"TO_ADR" => $_POST["TO_ADR"], // Куда везём
			"TO_ADR_COORDS" => $_POST["TO_ADR_COORDS"], // Куда везём
			"NOTE" => $_POST["NOTE"], // Комментарий
			"WHAT_CARRING" => $_POST["WHAT_CARRING"], // что везём - id
			"WHAT_CARRING_TEXT" => $_POST["WHAT_CARRING_TEXT"], // что везём - текст
			"WHEN" => $_POST["WHEN"], // когда везём
			"PERIOD" => $_POST["PERIOD"], // в какое время
			"QUANTITY"  =>  $_POST["QUANTITY"], // Сколько везём
			"PAY_TEXT" => $_POST["PAY_TEXT"], // оплата текст
			"DATE"  => date("d.m.Y")   // дата
		);
		//CEvent::Send("WF_NEW_IBLOCK_ELEMENT", array("s1"), $arFields_add_order, "N", 83); // в очередь на отправку сообщения
		
		$_SESSION["PHONE"]=$_POST["PHONE"];
		echo $ORDER_ID;
	}
	else echo 0;
	 // echo "Error: ".$el->LAST_ERROR;
	

}
else echo -1;

?>

<?require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php";?>