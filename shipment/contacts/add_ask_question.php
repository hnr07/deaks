<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
$IBLOCK_ID=13; // ID инфоблока "Задать вопрос"
//echo "<pre>";print_r($_POST);echo "</pre>";

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
	$PROP["EMAIL"] = $_POST["EMAIL"]; 
	

	$arLoadProductArray = Array(
	  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
	  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
	  "IBLOCK_ID"      => $IBLOCK_ID,
	  "PROPERTY_VALUES"=> $PROP,
	  "NAME"           => date("d.m.Y")." ".$_POST["FIO"],
	  "ACTIVE"         => "Y",            // активен
	  "PREVIEW_TEXT"   => $_POST["QUESTION"],
	  "PREVIEW_TEXT_TYPE" => "text",
	  "DETAIL_TEXT"    => "",
	  );
	
	if($ORDER_ID = $el->Add($arLoadProductArray))  {
		// Массив данных для шаблона
		$arFields_add_order = array(
			"IBLOCK_ID" => $IBLOCK_ID, // ID инфоблока "Задать вопрос"
			"ORDER_ID" => $ORDER_ID,            // ID заявки
			"FIO" => $_POST["FIO"],     //ФИО
			"PHONE" => $_POST["PHONE"], // телефон
			"EMAIL" => $_POST["EMAIL"], // e-mail
			"QUESTION" => $_POST["QUESTION"], // вопрос
			"DATE"  => date("d.m.Y")   // дата
		);
		//CEvent::Send("WF_NEW_IBLOCK_ELEMENT", array("s1"), $arFields_add_order, "N", 85); // в очередь на отправку сообщения
		
		echo $ORDER_ID;
	}
	else echo 0;
	 // echo "Error: ".$el->LAST_ERROR;
	

}
else echo -1;

?>

<?require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php";?>