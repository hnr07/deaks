<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
global $USER;
$NUMERIC = str_replace(array("+","-","(",")"," "),"",$_POST["PHONE"]);  // код из номера телефона без лишних символов

//$NUMERIC = "web";
$rsUser = CUser::GetByLogin($NUMERIC);  // ищем пользователя в базе по коду
if($arUser = $rsUser->Fetch()){
	//echo "<pre>"; print_r($arUser); echo "</pre>";
	$UID=$arUser["ID"];
}
else { // если пользователь не найден создаём нового, где логин и пароль - это код
	$new_user = new CUser;
	$arFields_user = Array(
	  "NAME"              => $_POST["FIO"],
	  "LAST_NAME"         => "",
	  "EMAIL"             => $NUMERIC."@cargo.com",
	  "LOGIN"             => $NUMERIC,
	  "LID"               => "s1",
	  "ACTIVE"            => "Y",
	  "GROUP_ID"          => array(6),
	  "PASSWORD"          => $NUMERIC,
	  "CONFIRM_PASSWORD"  => $NUMERIC,
	  "PERSONAL_PHONE"    => $_POST["PHONE"]
	);

	$UID = $new_user->Add($arFields_user);	
}
if (intval($UID) > 0) $USER->Authorize(intval($UID)); // авторизуем пользователя
//echo $UID;
//echo "<pre>";print_r($_POST);echo "</pre>";
//echo $NUMERIC;
$_SESSION["PHONE"]=$_POST["PHONE"];

$pc=1;

if($_POST["captcha_code"]) {  // если капча пришла - проверяем
	if(!$APPLICATION->CaptchaCheckCode($_POST["captcha_word"], $_POST["captcha_code"])) $pc=0;
	else $pc=1;
}

if($pc) {
	
	CModule::IncludeModule("sale");
	CModule::IncludeModule("catalog");
	
	// Удаляем из корзины существующие записи;
	CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
	
	$arFields = array(
	   "LID" => "s1",
	   "PERSON_TYPE_ID" => 1,
	   "PAYED" => "N",
	   "CANCELED" => "N",
	   "STATUS_ID" => "N",
	   "PRICE" => $_POST["PRICE"],
	   "CURRENCY" => "RUB",
	   "USER_ID" => IntVal($USER->GetID()),
	   
	   "PAY_SYSTEM_ID" => $_POST["ID_PAY"],
	   "PRICE_DELIVERY" => $_POST["PRICE_DELIVERY"],
	   "DELIVERY_ID" => 2,
	   "ALLOW_DELIVERY" => "N",

	   "DISCOUNT_VALUE" => 0,
	   "TAX_VALUE" => 0, 
	   "USER_DESCRIPTION" => $_POST["NOTE"],
	   "ADDITIONAL_INFO" => "",
	   "COMMENTS" => ""
   
	);

	if($ORDER_ID = CSaleOrder::Add($arFields)) {
	
		$id_c=Add2BasketByProductID(
						$_POST["WHAT_CARRING"], // ID товара
						$_POST["QUANTITY"], // количество товара
						array("LID"=>"s1", "DELAY"=>"N", "CAN_BUY"=>"Y",
						 "ORDER_ID"=>$ORDER_ID
						),
						array(
							//array("NAME"=>"Упаковка","CODE" => "UPAKOVKA", "VALUE" => "100")	
						)
					);

		if(CSaleBasket::OrderBasket($ORDER_ID, $_SESSION["SALE_USER_ID"], "s1")) {

			foreach($_SESSION["SHIPMENT"]["ar_shipment"] as $vash) {
				if($vash["COORDS"]==$_POST["FROM_ADR_COORDS"]) {
					$SHIPMENT_NAME=$vash["NAME"];break;
				}
			}
			$arFieldsPHONE = array(
			   "ORDER_ID" => $ORDER_ID,
			   "ORDER_PROPS_ID" => 1,
			   "NAME" => "Ф.И.О.",
			   "CODE" => "FIO",
			   "VALUE" => $_POST["FIO"]
			   );
			CSaleOrderPropsValue::Add($arFieldsPHONE);

			$arFieldsPHONE = array(
			   "ORDER_ID" => $ORDER_ID,
			   "ORDER_PROPS_ID" => 3,
			   "NAME" => "Телефон",
			   "CODE" => "PHONE",
			   "VALUE" => $_POST["PHONE"]
			   );
			CSaleOrderPropsValue::Add($arFieldsPHONE);

			$arFieldsADDRESS = array(
			   "ORDER_ID" => $ORDER_ID,
			   "ORDER_PROPS_ID" => 7,
			   "NAME" => "Адрес доставки",
			   "CODE" => "ADDRESS",
			   "VALUE" => $_POST["TO_ADR"]
			   );
			CSaleOrderPropsValue::Add($arFieldsADDRESS);

			$arFieldsCOORDS = array(
			   "ORDER_ID" => $ORDER_ID,
			   "ORDER_PROPS_ID" => 20,
			   "NAME" => "Координаты доставки",
			   "CODE" => "COORDS",
			   "VALUE" => $_POST["TO_ADR_COORDS"]
			   );
			CSaleOrderPropsValue::Add($arFieldsCOORDS);

			$arFieldsDATE = array(
			   "ORDER_ID" => $ORDER_ID,
			   "ORDER_PROPS_ID" => 21,
			   "NAME" => "Дата доставки",
			   "CODE" => "DATE_DELIVERY",
			   "VALUE" => $_POST["WHEN"]
			   );
			CSaleOrderPropsValue::Add($arFieldsDATE);

			$arFieldsPERIOD = array(
			   "ORDER_ID" => $ORDER_ID,
			   "ORDER_PROPS_ID" => 22,
			   "NAME" => "Период доставки",
			   "CODE" => "PERIOD_DELIVERY",
			   "VALUE" => $_POST["PERIOD"]
			   );
			CSaleOrderPropsValue::Add($arFieldsPERIOD);

			$arFieldsRECIPIENTN = array(
			   "ORDER_ID" => $ORDER_ID,
			   "ORDER_PROPS_ID" => 23,
			   "NAME" => "Получатель - имя",
			   "CODE" => "RECIPIENT_NAME",
			   "VALUE" => $_POST["FIO_2"]
			   );
			CSaleOrderPropsValue::Add($arFieldsRECIPIENTN);

			$arFieldsRECIPIENTP = array(
			   "ORDER_ID" => $ORDER_ID,
			   "ORDER_PROPS_ID" => 24,
			   "NAME" => "Получатель - телефон",
			   "CODE" => "RECIPIENT_PHONE",
			   "VALUE" => $_POST["PHONE_2"]
			   );
			CSaleOrderPropsValue::Add($arFieldsRECIPIENTP);

			$arFieldsSHIPMENTN = array(
			   "ORDER_ID" => $ORDER_ID,
			   "ORDER_PROPS_ID" => 25,
			   "NAME" => "Место отгрузки",
			   "CODE" => "SHIPMENT",
			   "VALUE" => $SHIPMENT_NAME
			   );
			CSaleOrderPropsValue::Add($arFieldsSHIPMENTN);

			$arFieldsSHIPMENTC = array(
			   "ORDER_ID" => $ORDER_ID,
			   "ORDER_PROPS_ID" => 26,
			   "NAME" => "Координаты отгрузки",
			   "CODE" => "SHIPMENT_COORDS",
			   "VALUE" => $_POST["FROM_ADR_COORDS"]
			   );
			CSaleOrderPropsValue::Add($arFieldsSHIPMENTC);

			$arFieldsDISTANCE = array(
			   "ORDER_ID" => $ORDER_ID,
			   "ORDER_PROPS_ID" => 27,
			   "NAME" => "Расстояние",
			   "CODE" => "DISTANCE",
			   "VALUE" => $_POST["DISTANCE"]
			   );
			CSaleOrderPropsValue::Add($arFieldsDISTANCE);
			
			$arFieldsCOUNT_CAR = array(
			   "ORDER_ID" => $ORDER_ID,
			   "ORDER_PROPS_ID" => 28,
			   "NAME" => "Сколько авто",
			   "CODE" => "COUNT_CAR",
			   "VALUE" => $_POST["COUNT_CAR"]
			   );
			CSaleOrderPropsValue::Add($arFieldsCOUNT_CAR);
		}
		// Массив данных для шаблона
		$arFields_add_order = array(
			
			"ORDER_ID" => $ORDER_ID,            // ID заявки
			"FIO" => $_POST["FIO"],     //ФИО заказчик
			"PHONE" => $_POST["PHONE"], // телефон заказчик
			"FIO_2" => $_POST["FIO_2"],     //ФИО получатель
			"PHONE_2" => $_POST["PHONE_2"], // телефон получатель
			"TO_ADR" => $_POST["TO_ADR"], // Куда везём
			"TO_ADR_COORDS" => $_POST["TO_ADR_COORDS"], // Куда везём координаты
			"NOTE" => $_POST["NOTE"], // Комментарий
			"WHAT_CARRING" => $_POST["WHAT_CARRING"], // что везём - id
			"WHAT_CARRING_TEXT" => $_POST["WHAT_CARRING_TEXT"], // что везём - текст
			"WHEN" => $_POST["WHEN"], // когда везём
			"PERIOD" => $_POST["PERIOD"], // в какое время
			"QUANTITY"  =>  $_POST["QUANTITY"], // Сколько везём
			"PAY_TEXT" => $_POST["PAY_TEXT"], // оплата текст
			"ORDER_DATE"  => date("d.m.Y"),   // дата
			"PRICE"  => $_POST["PRICE"],   // стоимость заказа
			"PRICE_DELIVERY"  => $_POST["PRICE_DELIVERY"],   // стоимость доставки
			"SUM"  => $_POST["SUM"],   // итого заказа
			"FROM_ADR" => $SHIPMENT_NAME, // Откуда везём
			"FROM_ADR_COORDS" => $_POST["FROM_ADR_COORDS"], // Откуда везём координаты
			"DISTANCE" => $_POST["DISTANCE"], // расстояние
			"COUNT_CAR" => $_POST["COUNT_CAR"], // Сколько авто
		);
		CEvent::Send("SALE_NEW_ORDER", array("s1"), $arFields_add_order, "N", 84); // в очередь на отправку сообщения
		echo $ORDER_ID;
	}
	else echo 0;
}
else echo -1;

?>

<?require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php";?>