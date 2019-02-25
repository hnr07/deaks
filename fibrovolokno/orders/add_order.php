<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
global $USER;
//echo "<pre>";print_r($_POST);echo "</pre>";
//echo "<pre>";print_r($_SESSION["order"]["add_elem"]);echo "</pre>";
$are["order"]=$_SESSION["order"]["add_elem"];
$are["name_user"]=$_POST["name_user"];
$are["phone_user"]=$_POST["phone_user"];
$are["email_user"]=$_POST["email_user"];
$are["address_user"]=$_POST["address_user"];
$are["itogo_qty"]=$_POST["itogo_qty"];
$are["itogo_weight"]=$_POST["itogo_weight"];
$are["itogo"]=$_POST["itogo"];
$str_json=\Bitrix\Main\Web\Json::encode($are); // данные заказа в json

$text_user='';
$table_h=$_POST["name_user"].'<br />телефон: '.$_POST["phone_user"].'<br />e-mail: '.$_POST["email_user"].'<br />Адрес: '.$_POST["address_user"].'<br /><br /><table cellpadding="10" cellspacing="0" border="1"><tr><th colspan="2">&nbsp;</th><th>Количество</th><th>Цена</th><th>Стоимость</th></tr>';
$table_f='<tr><th colspan="2">Итого: </th><th>'.$_POST["itogo_qty"].'</th><th colspan="2">'.$_POST["itogo"].' руб.<br /><span style="font-size:80%;">'.$_POST["itogo_weight"].' кг</span></th></tr></table><br /><br />'.$_POST["comment_user"];
foreach($_SESSION["order"]["add_elem"] as $id=>$ar_el) {
	$ar_id[]=$id;
	$text_user.='<tr><td><img src="http://'.SITE_SERVER_NAME.$ar_el["src_elem"].'" width="100" height="100"></td><td>'.$ar_el["name_before_elem"].'<br /><b>'.$ar_el["name_elem"].'</b><br /><span style="font-size:80%;">'.$ar_el["size_elem"].' мм</span></td><td>'.$ar_el["qty"].'</td><td><b>'.$ar_el["price"].' руб./кг</b><br /><span style="font-size:80%;">'.$ar_el["price_packing"].' руб./уп.</span></td><td><b>'.$ar_el["sum"].' руб.</b><br /><span style="font-size:80%;">'.$ar_el["weight"].' кг</span></td></tr>';
}

$pc=1;
if (!$USER->IsAuthorized()) {
	if($_POST["captcha_code"]) {
		if(!$APPLICATION->CaptchaCheckCode($_POST["captcha_word"], $_POST["captcha_code"])) $pc=0;
		else $pc=1;
	}
	else $pc=1;
}
if($pc) {
	CModule::IncludeModule('iblock'); 
	$el = new CIBlockElement;

	$PROP = array();
	$PROP["name_user"] = $_POST["name_user"]; 
	$PROP["phone_user"] = $_POST["phone_user"]; 
	$PROP["email_user"] = $_POST["email_user"]; 
	$PROP["address_user"] = $_POST["address_user"]; 
	$PROP["order_quantity"] = $_POST["itogo_qty"]; 
	$PROP["order_weight"] = $_POST["itogo_weight"]; 
	$PROP["element_product"] = $ar_id; 
	$PROP["order_price"] = $_POST["itogo"]; 
	$PROP["comment_user"] = Array("VALUE" => Array ("TEXT" => $_POST["comment_user"], "TYPE" => "text"));  
	$PROP["order_json"] = $str_json; 
	

	$arLoadProductArray = Array(
	  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
	  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
	  "IBLOCK_ID"      => 18,
	  "PROPERTY_VALUES"=> $PROP,
	  "NAME"           => $_POST["name_user"]." ".$_POST["phone_user"],
	  "ACTIVE"         => "Y",            // активен
	  "PREVIEW_TEXT"   => $table_h.$text_user.$table_f,
	  "PREVIEW_TEXT_TYPE" => 'html',
	  "DETAIL_TEXT"    => "",
	  );
	
	if($ORDER_ID = $el->Add($arLoadProductArray))  {
		// Массив данных для шаблона
		$arFields_add_order = array(
			"ORDER_ID" => $ORDER_ID,            // ID заявки
			"NAME_USER" => $_POST["name_user"],
			"EMAIL_USER" => $_POST["email_user"], // email для отправки
			"TEXT" =>$table_h.$text_user.$table_f,                     // текст сообщения
		);
		//CEvent::Send("WF_NEW_IBLOCK_ELEMENT", array("s1"), $arFields_add_order, "N", 11); // в очередь на отправку сообщения
		//CEvent::Send("WF_NEW_IBLOCK_ELEMENT", array("s1"), $arFields_add_order, "N", 12); // в очередь на отправку сообщения
		
		unset($_SESSION["order"]["add_elem"]);
		
		echo $ORDER_ID;
	}
	else echo 0;
	 // echo "Error: ".$el->LAST_ERROR;
	

}
else echo -1;
?>

<?require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php";?>