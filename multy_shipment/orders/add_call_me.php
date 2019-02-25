<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
$IBLOCK_ID=6; // ID инфоблока "Запросить звонок"
//echo "<pre>";print_r($_POST);echo "</pre>";

$text_user='';
$table_h=$_POST["name_user"].'<br />телефон: '.$_POST["phone_user"].'<br />e-mail: '.$_POST["email_user"].'<br />Адрес: '.$_POST["address_user"].'<br /><br /><table cellpadding="10" cellspacing="0" border="1"><tr><th colspan="2">&nbsp;</th><th>Количество</th><th>Цена</th><th>Стоимость</th></tr>';
$table_f='<tr><th colspan="2">Итого: </th><th>'.$_POST["itogo_qty"].'</th><th colspan="2">'.$_POST["itogo"].' руб.<br /><span style="font-size:80%;">'.$_POST["itogo_weight"].' кг</span></th></tr></table><br /><br />'.$_POST["comment_user"];
foreach($_SESSION["order"]["add_elem"] as $id=>$ar_el) {
	$ar_id[]=$id;
	$text_user.='<tr><td><img src="http://'.SITE_SERVER_NAME.$ar_el["src_elem"].'" width="100" height="100"></td><td>'.$ar_el["name_before_elem"].'<br /><b>'.$ar_el["name_elem"].'</b><br /><span style="font-size:80%;">'.$ar_el["size_elem"].' мм</span></td><td>'.$ar_el["qty"].'</td><td><b>'.$ar_el["price"].' руб./кг</b><br /><span style="font-size:80%;">'.$ar_el["price_packing"].' руб./уп.</span></td><td><b>'.$ar_el["sum"].' руб.</b><br /><span style="font-size:80%;">'.$ar_el["weight"].' кг</span></td></tr>';
}

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
	

	$arLoadProductArray = Array(
	  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
	  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
	  "IBLOCK_ID"      => $IBLOCK_ID,
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
			"IBLOCK_ID" => $IBLOCK_ID, // ID инфоблока "Запросить звонок"
			"ORDER_ID" => $ORDER_ID,            // ID заявки
			"FIO" => $_POST["FIO"],     //ФИО
			"PHONE" => $_POST["PHONE"], // телефон
			"DATE"  => date("d.m.Y")   // дата
		);
		CEvent::Send("WF_NEW_IBLOCK_ELEMENT", array("s1"), $arFields_add_order, "N", 82); // в очередь на отправку сообщения
		
		echo $ORDER_ID;
	}
	else echo 0;
	 // echo "Error: ".$el->LAST_ERROR;
	

}
else echo -1;

?>

<?require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php";?>