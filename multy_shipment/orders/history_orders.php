<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("История заказов");
CModule::IncludeModule("iblock");
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
	$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "DESC"), $arFilter);
	while ($ar_sales = $db_sales->Fetch())
	{
	   // echo "<pre>"; print_r($ar_sales); echo "</pre>";
	   $ar_orders_a[$ar_sales["ID"]]["ID"]=$ar_sales["ID"];
	   $ar_orders_a[$ar_sales["ID"]]["PERSON_TYPE_ID"]=$ar_sales["PERSON_TYPE_ID"]; // тип плательщика
	   $ar_orders_a[$ar_sales["ID"]]["STATUS_ID"]=$ar_sales["STATUS_ID"]; // 'N'-Принят, ожидается оплата,'P'-Оплачен, формируется к отправке
	   $ar_orders_a[$ar_sales["ID"]]["DATE_STATUS"]=$ar_sales["DATE_STATUS"]; // Дата изменения статуса заказа.
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
			array("ORDER_ID" => $ar_sales["ID"], "CODE"=>array("FIO","PHONE","RECIPIENT_NAME","RECIPIENT_PHONE","ADDRESS","COORDS","DATE_DELIVERY","PERIOD_DELIVERY","SHIPMENT","SHIPMENT_COORDS","COMPANY","COMPANY_ADR","INN","KPP","CONTACT_PERSON"))
		);
		while ($arOrderProps = $dbOrderProps->GetNext()){
				// echo "<pre>"; print_r($arOrderProps); echo "</pre>";
			   $ar_orders_a[$ar_sales["ID"]][$arOrderProps["CODE"]]=$arOrderProps["VALUE"];
		}
		$dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => $ar_sales["ID"]));
		
		 while ($arItems = $dbItemsInOrder->GetNext()){
			     // echo "<pre>"; print_r($arItems); echo "</pre>";
				 $res = CIBlockElement::GetByID($arItems["PRODUCT_ID"]);
				if($ar_res = $res->GetNext())
				  // echo "<pre>"; print_r($ar_res); echo "</pre>";
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["SECTION_ID"]=$ar_res["IBLOCK_SECTION_ID"];
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["ID"]=$arItems["PRODUCT_ID"];
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["NAME"]=$arItems["NAME"]; 
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["QUANTITY"]=$arItems["QUANTITY"]; 
$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["ACTIVE"]=$ar_res["ACTIVE"]; 			
			$m_n=$arItems["MEASURE_NAME"];
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["MEASURE_0"]=$m_n;
			switch($m_n) {
				case "м3":$m_n=substr($m_n,0,1)."<sup>".substr($m_n,-1)."</sup>";break;
			}
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["MEASURE"]=$m_n; 
		}
	}

	$arFilter = Array("USER_ID" => $UID, "CANCELED" => "Y");
	$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
	while ($ar_sales = $db_sales->Fetch())
	{
	  // echo "<pre>"; print_r($ar_sales); echo "</pre>";
	   $ar_orders_a[$ar_sales["ID"]]["ID"]=$ar_sales["ID"];
	   $ar_orders_a[$ar_sales["ID"]]["PERSON_TYPE_ID"]=$ar_sales["PERSON_TYPE_ID"]; // тип плательщика
	   $ar_orders_a[$ar_sales["ID"]]["STATUS_ID"]=$ar_sales["STATUS_ID"]; // 'N'-Принят, ожидается оплата,'P'-Оплачен, формируется к отправке
	   $ar_orders_a[$ar_sales["ID"]]["DATE_STATUS"]=$ar_sales["DATE_STATUS"]; // Дата изменения статуса заказа.
	  // $ar_orders_a[$ar_sales["ID"]]["LOCK_STATUS"]=$ar_sales["LOCK_STATUS"];
	   $ar_orders_a[$ar_sales["ID"]]["PAY_SYSTEM_ID"]=$ar_sales["PAY_SYSTEM_ID"];// ID оплаты
	   $ar_orders_a[$ar_sales["ID"]]["PAYED"]=$ar_sales["PAYED"]; // 'Y'-Оплачен,'N'-Не оплачен
	   $ar_orders_a[$ar_sales["ID"]]["DEDUCTED"]=$ar_sales["DEDUCTED"]; // 'Y'-Отгружено,'N'-Не отгружено
	   $ar_orders_a[$ar_sales["ID"]]["CANCELED"]=$ar_sales["CANCELED"]; // 'Y'-Отменён,'N'-Не отменён
	   //$ar_orders_a[$ar_sales["ID"]]["PRICE"]=$ar_sales["PRICE"]; // стоимость
	   $arStatus = CSaleStatus::GetByID($ar_sales["STATUS_ID"]);
		//echo "<pre>";print_r($arStatus);echo "</pre>";
		$ar_orders_a[$ar_sales["ID"]]["STATUS_NAME"]=$arStatus["NAME"];
	   $dbOrderProps = CSaleOrderPropsValue::GetList(
			array("SORT" => "DESC"),
			array("ORDER_ID" => $ar_sales["ID"], "CODE"=>array("FIO","PHONE","RECIPIENT_NAME","RECIPIENT_PHONE","ADDRESS","COORDS","DATE_DELIVERY","PERIOD_DELIVERY","SHIPMENT","SHIPMENT_COORDS","COMPANY","COMPANY_ADR","INN","KPP","CONTACT_PERSON"))
		);
		while ($arOrderProps = $dbOrderProps->GetNext()){
				//echo "<pre>"; print_r($arOrderProps); echo "</pre>";
			   $ar_orders_a[$ar_sales["ID"]][$arOrderProps["CODE"]]=$arOrderProps["VALUE"];
		}
		$dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => $ar_sales["ID"]));
		
		 while ($arItems = $dbItemsInOrder->GetNext()){
			  // echo "<pre>"; print_r($arItems); echo "</pre>";
			  $res = CIBlockElement::GetByID($arItems["PRODUCT_ID"]);
				if($ar_res = $res->GetNext())
				   // echo "<pre>"; print_r($ar_res); echo "</pre>";
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["SECTION_ID"]=$ar_res["IBLOCK_SECTION_ID"];
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["ID"]=$arItems["PRODUCT_ID"];
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["NAME"]=$arItems["NAME"]; 
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["QUANTITY"]=$arItems["QUANTITY"];  
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["ACTIVE"]=$ar_res["ACTIVE"]; 
			$m_n=$arItems["MEASURE_NAME"];
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["MEASURE_0"]=$m_n;
			switch($m_n) {
				case "м3":$m_n=substr($m_n,0,1)."<sup>".substr($m_n,-1)."</sup>";break;
			}
			$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["MEASURE"]=$m_n; 
			}
	}
	// echo "<pre>";print_r($ar_orders_a);echo "</pre>";
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
					if($val["PRICE"]>0) $price_format=number_format($val["PRICE"],0,',',' ')." &#8381;";
					else $price_format='';
					$str_tov='';$input_tov='';$i=0;
					$fl_po=true;
					foreach($val["PRODUCT"] as $prod) {
						if($prod["ACTIVE"]!="Y") $fl_po=false;
						$input_tov.='<input name="WHAT_CARRING_ID['.$prod["ID"].']" type="hidden" value="'.$prod["NAME"].'">';
						$input_tov.='<input name="QUANTITY['.$prod["ID"].']" type="hidden" value="'.$prod["QUANTITY"].'">';
						//$input_tov.='<input name="MEASURE['.$prod["ID"].']" type="hidden" value="'.$prod["MEASURE_0"].'">';
						$input_tov.='<input name="SECTION_ID['.$prod["ID"].']" type="hidden" value="'.$prod["SECTION_ID"].'">';
						$i++;
						$str_tov.="<br />".$i.") <b>".$prod["NAME"]."</b> - ".$prod["QUANTITY"]." ".$prod["MEASURE"]." ";
					}
					
				 ?>
				 <form class="row_list" action="/multy_shipment/" method="POST" style="border-color:<?=($LOCK_I!='')?$ar_status[$LOCK_I][1]:"#d8d8d8"?>;">
					<div class="status" style="background-color:<?=($LOCK_I!='')?$ar_status[$LOCK_I][1]:"#d8d8d8"?>;">
						№ <b><?=$id?></b> &nbsp;&nbsp;<?=$ar_status[$LOCK_I][0]?>
						&nbsp;&nbsp; <nobr><?=$val["DATE_STATUS"]?></nobr>
						&nbsp;&nbsp; <b><nobr><?=$price_format?></nobr></b>
						<?if($fl_po){?>
							<button type="submit" name="repetition" value="Y">повторить</button>
						<?}?>
					</div>
					<div class="to_adr"><?=$val["ADDRESS"]?></div>
					<div class="gruz"><?=$str_tov?></div>
					
					<input name="PERSON_TYPE_ID" type="hidden" value="<?=$val["PERSON_TYPE_ID"]?>">
					<input name="FIO" type="hidden" value="<?=($val["PERSON_TYPE_ID"]==1)?$val["FIO"]:$val["CONTACT_PERSON"]?>">
					<input name="PHONE" type="hidden" value="<?=$val["PHONE"]?>">
					<input name="TO_ADR" type="hidden" value="<?=$val["ADDRESS"]?>">
					<input name="TO_ADR_COORDS" type="hidden" value="<?=$val["COORDS"]?>">
					<input name="COMPANY" type="hidden" value="<?=$val["COMPANY"]?>">
					<input name="COMPANY_ADR" type="hidden" value="<?=$val["COMPANY_ADR"]?>">
					<input name="INN" type="hidden" value="<?=$val["INN"]?>">
					<input name="KPP" type="hidden" value="<?=$val["KPP"]?>">
					<input name="ID_PAY" type="hidden" value="<?=$val["PAY_SYSTEM_ID"]?>">
					<input name="FIO_2" type="hidden" value="<?=$val["RECIPIENT_NAME"]?>">
					<input name="PHONE_2" type="hidden" value="<?=$val["RECIPIENT_PHONE"]?>">
					<?=$input_tov?>
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