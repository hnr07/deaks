<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("История заказов");

include("./status_config.php");
?>
<style>
	body {max-width:800px;}

</style>
<div class="box_content box_history">
<div class="tifo"><?=$_GET["my_phone"]?> - история заказов</div>
	<?
global $USER;

$NUMERIC=str_replace(array("+","-","(",")"," "),"",$_GET["my_phone"]);

if($NUMERIC!=$USER->GetLogin()) {
	$rsUser = CUser::GetByLogin($NUMERIC);  // ищем пользователя в базе по коду
	if($arUser = $rsUser->Fetch()){
		//echo "<pre>"; print_r($arUser); echo "</pre>";
		$UID=$arUser["ID"];
	}
}
else $UID=$USER->GetID();

if($UID) {
		CModule::IncludeModule("sale");
	$arFilter = Array("USER_ID" => $UID, "CANCELED" => "N", "STATUS_ID"=>array("F"));
	$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($ar_sales = $db_sales->Fetch())
	{
	   //echo "<pre>"; print_r($ar_sales); echo "</pre>";
	   $ar_orders_a[$ar_sales["ID"]]["ID"]=$ar_sales["ID"];
	   $ar_orders_a[$ar_sales["ID"]]["STATUS_ID"]=$ar_sales["STATUS_ID"]; // 'N'-Принят, ожидается оплата,'P'-Оплачен, формируется к отправке
	  // $ar_orders_a[$ar_sales["ID"]]["LOCK_STATUS"]=$ar_sales["LOCK_STATUS"];
	   $ar_orders_a[$ar_sales["ID"]]["PAY_SYSTEM_ID"]=$ar_sales["PAY_SYSTEM_ID"];// ID оплаты
	   $ar_orders_a[$ar_sales["ID"]]["PAYED"]=$ar_sales["PAYED"]; // 'Y'-Оплачен,'N'-Не оплачен
	   $ar_orders_a[$ar_sales["ID"]]["DEDUCTED"]=$ar_sales["DEDUCTED"]; // 'Y'-Отгружено,'N'-Не отгружено
	   $ar_orders_a[$ar_sales["ID"]]["CANCELED"]=$ar_sales["CANCELED"]; // 'Y'-Отменён,'N'-Не отменён
	   $arStatus = CSaleStatus::GetByID($ar_sales["STATUS_ID"]);
		//echo "<pre>";print_r($arStatus);echo "</pre>";
		$ar_orders_a[$ar_sales["ID"]]["STATUS_NAME"]=$arStatus["NAME"];
	   $dbOrderProps = CSaleOrderPropsValue::GetList(
			array("SORT" => "ASC"),
			array("ORDER_ID" => $ar_sales["ID"], "CODE"=>array("FIO","PHONE","RECIPIENT_NAME","RECIPIENT_PHONE","ADDRESS","COORDS","DATE_DELIVERY","PERIOD_DELIVERY","SHIPMENT","SHIPMENT_COORDS"))
		);
		while ($arOrderProps = $dbOrderProps->GetNext()){
				//echo "<pre>"; print_r($arOrderProps); echo "</pre>";
			   $ar_orders_a[$ar_sales["ID"]][$arOrderProps["CODE"]]=$arOrderProps["VALUE"];
		}
		$dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => $ar_sales["ID"]));
		
		 while ($arItems = $dbItemsInOrder->GetNext()){
			   // echo "<pre>"; print_r($arItems); echo "</pre>";
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"]["ID"]=$arItems["PRODUCT_ID"];
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"]["NAME"]=$arItems["NAME"]; 
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"]["QUANTITY"]=$arItems["QUANTITY"];  
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"]["MEASURE"]=$arItems["MEASURE_NAME"]; 
		}
	}

	$arFilter = Array("USER_ID" => $UID, "CANCELED" => "Y");
	$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($ar_sales = $db_sales->Fetch())
	{
	  // echo "<pre>"; print_r($ar_sales); echo "</pre>";
	   $ar_orders_a[$ar_sales["ID"]]["ID"]=$ar_sales["ID"];
	   $ar_orders_a[$ar_sales["ID"]]["STATUS_ID"]=$ar_sales["STATUS_ID"]; // 'N'-Принят, ожидается оплата,'P'-Оплачен, формируется к отправке
	  // $ar_orders_a[$ar_sales["ID"]]["LOCK_STATUS"]=$ar_sales["LOCK_STATUS"];
	   $ar_orders_a[$ar_sales["ID"]]["PAY_SYSTEM_ID"]=$ar_sales["PAY_SYSTEM_ID"];// ID оплаты
	   $ar_orders_a[$ar_sales["ID"]]["PAYED"]=$ar_sales["PAYED"]; // 'Y'-Оплачен,'N'-Не оплачен
	   $ar_orders_a[$ar_sales["ID"]]["DEDUCTED"]=$ar_sales["DEDUCTED"]; // 'Y'-Отгружено,'N'-Не отгружено
	   $ar_orders_a[$ar_sales["ID"]]["CANCELED"]=$ar_sales["CANCELED"]; // 'Y'-Отменён,'N'-Не отменён
	   $ar_orders_a[$ar_sales["ID"]]["PRICE"]=$ar_sales["PRICE"]; // стоимость
	   $arStatus = CSaleStatus::GetByID($ar_sales["STATUS_ID"]);
		//echo "<pre>";print_r($arStatus);echo "</pre>";
		$ar_orders_a[$ar_sales["ID"]]["STATUS_NAME"]=$arStatus["NAME"];
	   $dbOrderProps = CSaleOrderPropsValue::GetList(
			array("SORT" => "ASC"),
			array("ORDER_ID" => $ar_sales["ID"], "CODE"=>array("FIO","PHONE","RECIPIENT_NAME","RECIPIENT_PHONE","ADDRESS","COORDS","DATE_DELIVERY","PERIOD_DELIVERY","SHIPMENT","SHIPMENT_COORDS"))
		);
		while ($arOrderProps = $dbOrderProps->GetNext()){
				//echo "<pre>"; print_r($arOrderProps); echo "</pre>";
			   $ar_orders_a[$ar_sales["ID"]][$arOrderProps["CODE"]]=$arOrderProps["VALUE"];
		}
		$dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => $ar_sales["ID"]));
		
		 while ($arItems = $dbItemsInOrder->GetNext()){
			   // echo "<pre>"; print_r($arItems); echo "</pre>";
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"]["ID"]=$arItems["PRODUCT_ID"];
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"]["NAME"]=$arItems["NAME"]; 
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"]["QUANTITY"]=$arItems["QUANTITY"];  
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"]["MEASURE"]=$arItems["MEASURE_NAME"]; 
		}
	}
	//echo "<pre>";print_r($ar_orders_a);echo "</pre>";
			/*
			CModule::IncludeModule('iblock'); 
			$arSelect = Array("IBLOCK_ID", "ID", "PROPERTY_NUMERIC", "PROPERTY_STATUS", "PROPERTY_WHAT_CARRING", "PROPERTY_TO_ADR", "PROPERTY_TO_ADR_COORDS", "PROPERTY_FIO", "PROPERTY_PHONE", "PROPERTY_SINCE", "PROPERTY_WHEN", "PROPERTY_NOTE", "PROPERTY_PHONE");
			$arFilter = Array("IBLOCK_ID"=>5, "ACTIVE"=>"Y", "PROPERTY_NUMERIC"=>$NUMERIC);
			$res = CIBlockElement::GetList(Array("created"=>"asc"), $arFilter, false, Array("nPageSize"=>5000), $arSelect);
			while($ob = $res->GetNextElement())
			{
				 $arFields = $ob->GetFields();
				// echo"<pre>";print_r($arFields);echo"</pre>";
				 $arProps = $ob->GetProperties();
				//echo"<pre>";print_r($arProps);echo"</pre>";
					
				 
				$TOVAR_ID = $arFields["PROPERTY_WHAT_CARRING_VALUE"];
				$el_res= CIBlockElement::GetByID( $TOVAR_ID );
				if ( $el_arr= $el_res->GetNext() ) {
					//echo "<pre>";print_r($el_arr["NAME"]);echo "</pre>";
				}
				$SINCE_ID = $arFields["PROPERTY_SINCE_VALUE"];
				if($SINCE_ID) {
					$since_res= CIBlockElement::GetByID( $SINCE_ID );
					$since_ob = $since_res->GetNextElement();
					$since_el= $since_ob->GetFields();
					$since_prop = $since_ob->GetProperties();
				}
				*/
				 ?>
			<?if(count($ar_orders_a)>0) {?>
				 <?foreach($ar_orders_a as $id=>$val) {?>
				 <?	
					$LOCK_I='';
					if($val["DEDUCTED"]=="Y") $LOCK_I="DF";
					else {
						if($val["STATUS_ID"]=="N" && in_array($val["PAY_SYSTEM_ID"],$ar_not_pay)) $LOCK_I="NP";
						else $LOCK_I=$val["STATUS_ID"];
					}
					if($val["CANCELED"]=="Y") $LOCK_I="C";
					$price_format=number_format($val["PRICE"],0,',',' ')." &#8381;";
					$str_tov='';
					$str_tov.=$val["PRODUCT"]["NAME"]."-".$val["PRODUCT"]["QUANTITY"]." ".str_replace("3","<sup>3</sup>",$val["PRODUCT"]["MEASURE"])." ";
					$str_tov.=$val["DATE_DELIVERY"]." (".$val["PERIOD_DELIVERY"].")";
					$str_tov.=" - <b><nobr>".$price_format."</nobr></b>";
				 ?>
				 <form class="row_list" action="/shipment/" method="POST" style="border-color:<?=($LOCK_I!='')?$ar_status[$LOCK_I][1]:"#d8d8d8"?>;">
					<div class="status" style="background-color:<?=($LOCK_I!='')?$ar_status[$LOCK_I][1]:"#d8d8d8"?>;">
						№ <b><?=$id?></b> &nbsp;&nbsp;<?=$ar_status[$LOCK_I][0]?>
						<button type="submit" name="repetition">повторить</button>
					</div>
					<div class="to_adr"><?=$val["ADDRESS"]?></div>
					<div class="gruz"><?=$str_tov?></div>
					<input name="FIO" type="hidden" value="<?=$val["FIO"]?>">
					<input name="PHONE" type="hidden" value="<?=$val["PHONE"]?>">
					<input name="TO_ADR" type="hidden" value="<?=$val["ADDRESS"]?>">
					<input name="TO_ADR_COORDS" type="hidden" value="<?=$val["COORDS"]?>">
					<input name="WHAT_CARRING" type="hidden" value="<?=$val["PRODUCT"]["ID"]?>">
					<input name="QUANTITY" type="hidden" value="<?=$val["PRODUCT"]["QUANTITY"]?>">
					<input name="ID_PAY" type="hidden" value="<?=$val["PAY_SYSTEM_ID"]?>">
					<input name="FIO_2" type="hidden" value="<?=$val["RECIPIENT_NAME"]?>">
					<input name="PHONE_2" type="hidden" value="<?=$val["RECIPIENT_PHONE"]?>">
				 </form>
				 <?unset($ar_orders_a);?>
				<?}?>
			<?} else {?>
				<b style="font-size:15px;letter-spacing:2px;">Заказы не найдены.</b>
			<?}?>
<?} else {?>
	<b style="font-size:15px;letter-spacing:2px;">Пользователь не найден.</b>
	<form class="form_hp" action="./history_orders.php" method="GET">
		<input type="text" name="my_phone" value="<?=$_GET["my_phone"]?>"><button type="submit">изменить</button>
	</form>
<?}?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>