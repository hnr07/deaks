<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?

include("./status_config.php");

global $USER;

$NUMERIC=str_replace(array("+","-","(",")"," "),"",$_POST["my_phone"]);
if($NUMERIC!=$USER->GetLogin()) {
	$rsUser = CUser::GetByLogin($NUMERIC);  // ищем пользователя в базе по коду
	if($arUser = $rsUser->Fetch()){
		//echo "<pre>"; print_r($arUser); echo "</pre>";
		$UID=$arUser["ID"];
		$USER->Authorize(intval($UID)); // авторизуем пользователя
	}
	
}
else $UID=$USER->GetID();

if($UID) {
	CModule::IncludeModule("sale");
	$arFilter = Array("USER_ID" => $UID, "CANCELED" => "N", "STATUS_ID"=>array("N","P"));

$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
while ($ar_sales = $db_sales->Fetch())
{
   //echo "<pre>"; print_r($ar_sales); echo "</pre>";
   $ar_orders_a[$ar_sales["ID"]]["ID"]=$ar_sales["ID"];
   $ar_orders_a[$ar_sales["ID"]]["PERSON_TYPE_ID"]=$ar_sales["PERSON_TYPE_ID"];
   $ar_orders_a[$ar_sales["ID"]]["STATUS_ID"]=$ar_sales["STATUS_ID"]; // 'N'-Принят, ожидается оплата,'P'-Оплачен, формируется к отправке
  // $ar_orders_a[$ar_sales["ID"]]["LOCK_STATUS"]=$ar_sales["LOCK_STATUS"];
   $ar_orders_a[$ar_sales["ID"]]["PAY_SYSTEM_ID"]=$ar_sales["PAY_SYSTEM_ID"];// ID платежной системы
   $ar_orders_a[$ar_sales["ID"]]["PAYED"]=$ar_sales["PAYED"]; // 'Y'-Оплачен,'N'-Не оплачен
   $ar_orders_a[$ar_sales["ID"]]["DEDUCTED"]=$ar_sales["DEDUCTED"]; // 'Y'-Отгружено,'N'-Не отгружено
   $ar_orders_a[$ar_sales["ID"]]["PRICE"]=$ar_sales["PRICE"]; // стоимость
   $arStatus = CSaleStatus::GetByID($ar_sales["STATUS_ID"]);
	//echo "<pre>";print_r($arStatus);echo "</pre>";
	$ar_orders_a[$ar_sales["ID"]]["STATUS_NAME"]=$arStatus["NAME"];
   $dbOrderProps = CSaleOrderPropsValue::GetList(
        array("SORT" => "ASC"),
        array("ORDER_ID" => $ar_sales["ID"], "CODE"=>array("FIO","CONTACT_PERSON","ADDRESS","COORDS","DATE_DELIVERY","PERIOD_DELIVERY","SHIPMENT_ARRAY"))
    );
    while ($arOrderProps = $dbOrderProps->GetNext()){
            //echo "<pre>"; print_r($arOrderProps); echo "</pre>";
		   $ar_orders_a[$ar_sales["ID"]][$arOrderProps["CODE"]]=$arOrderProps["VALUE_ORIG"]; //$arOrderProps["VALUE"];
    }
	$dbItemsInOrder = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => $ar_sales["ID"]));
	
	 while ($arItems = $dbItemsInOrder->GetNext()){
           // echo "<pre>"; print_r($arItems); echo "</pre>";
		$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["ID"]=$arItems["PRODUCT_ID"];
		$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["NAME"]=$arItems["NAME"]; 
		$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["QUANTITY"]=$arItems["QUANTITY"];  
		$m_n=$arItems["MEASURE_NAME"];
		$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["MEASURE_0"]=$m_n;
		switch($m_n) {
			case "м3":$m_n=substr($m_n,0,1)."<sup>".substr($m_n,-1)."</sup>";break;
		}
		$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$arItems["PRODUCT_ID"]]["MEASURE"]=$m_n; 
    }
	$pay_sistem=CSalePaySystem::GetByID($ar_sales["PAY_SYSTEM_ID"]);
	$ar_orders_a[$ar_sales["ID"]]["PAY_SYSTEM_NAME"]=$pay_sistem["NAME"];// платежная система
	
	if($show_shipment=="Y") {
		foreach($ar_orders_a[$ar_sales["ID"]]["SHIPMENT_ARRAY"] as $date_s) {
			
			preg_match_all($pattern, $date_s, $date);
			//echo"<pre>";print_r($date);echo"</pre>";
			$ar_orders_a[$ar_sales["ID"]]["SHIPMENT"][$date[1][5]]["ID_SH"]=$date[1][5];
			$ar_orders_a[$ar_sales["ID"]]["SHIPMENT"][$date[1][5]]["NAME_SH"]=$date[1][4];
			$ar_orders_a[$ar_sales["ID"]]["SHIPMENT"][$date[1][5]]["COORDS_SH"]=$date[1][6];
			$ar_orders_a[$ar_sales["ID"]]["SHIPMENT"][$date[1][5]]["DISTANCE_SH"]=$date[1][7];
			$ar_orders_a[$ar_sales["ID"]]["SHIPMENT"][$date[1][5]]["PRODUCT_SH"][$date[1][1]]["ID_PR"]=$date[1][1];
			$ar_orders_a[$ar_sales["ID"]]["SHIPMENT"][$date[1][5]]["PRODUCT_SH"][$date[1][1]]["NAME_PR"]=$date[1][0];
			$ar_orders_a[$ar_sales["ID"]]["SHIPMENT"][$date[1][5]]["PRODUCT_SH"][$date[1][1]]["QUANT_PR"]=$date[1][2];
			$ar_orders_a[$ar_sales["ID"]]["SHIPMENT"][$date[1][5]]["PRODUCT_SH"][$date[1][1]]["QUANT_AVTO"]=$date[1][3];
			$ar_orders_a[$ar_sales["ID"]]["SHIPMENT"][$date[1][5]]["PRODUCT_SH"][$date[1][1]]["MEASURE_PR"]=$ar_orders_a[$ar_sales["ID"]]["PRODUCT"][$date[1][1]]["MEASURE"];
		}
	}
	
	
}
//echo "<pre>"; print_r($ar_orders_a[65][SHIPMENT]); echo "</pre>";


/*	
	CModule::IncludeModule('iblock'); 
	$arSelect = Array("IBLOCK_ID", "ID", "PROPERTY_NUMERIC", "PROPERTY_STATUS", "PROPERTY_WHAT_CARRING", "PROPERTY_TO_ADR", "PROPERTY_TO_ADR_COORDS", "PROPERTY_FIO", "PROPERTY_PHONE", "PROPERTY_SINCE", "PROPERTY_WHEN", "PROPERTY_NOTE");
	$arFilter = Array("IBLOCK_ID"=>5, "ACTIVE"=>"Y", "PROPERTY_NUMERIC"=>$NUMERIC, "PROPERTY_STATUS_VALUE"=>array("Принят","Подтверждён","Формирование","Доставка"));
	$res = CIBlockElement::GetList(Array("created"=>"asc"), $arFilter, false, Array("nPageSize"=>5000,"nTopCount" => 4), $arSelect);
	while($ob = $res->GetNextElement())
	{
		 $arFields = $ob->GetFields();
		 //echo"<pre>";print_r($arFields);echo"</pre>";
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
				$price_format=number_format($val["PRICE"],0,',',' ')." &#8381;";
				$str_dat=$val["DATE_DELIVERY"]." (".$val["PERIOD_DELIVERY"].")"."<br />";
				$str_tov=$str_dat;
				foreach($val["PRODUCT"] as $product) {
					$str_tov.=$product["NAME"]."-".$product["QUANTITY"]." ".$product["MEASURE"]."<br />";
				}
				
			?>
			 <div class="row_list" order_id="<?=$id?>" title="на карте" style="border-bottom-color:<?=($LOCK_I!='')?$ar_status[$LOCK_I][1]:"#d8d8d8"?>;">
				<div class="status" style="background-color:<?=($LOCK_I!='')?$ar_status[$LOCK_I][1]:"#d8d8d8"?>">№<b><?=$id?></b> &nbsp;&nbsp;<?=$ar_status[$LOCK_I][0]?></div>
				<?if($LOCK_I=="N") {?>
					<div class="pay_n" style="background-color:<?=($LOCK_I!='')?$ar_status[$LOCK_I][1]:"#d8d8d8"?>;"><button type="button" class="pay" title="<?=$val["PAY_SYSTEM_NAME"]?>" onclick="go_pay(<?=$id?>)">Оплатить <b><?=$price_format?></b></button></div>
				<?} else {?>
					<div class="pay_y" style="background-color:<?=($LOCK_I!='')?$ar_status[$LOCK_I][1]:"#d8d8d8"?>;"><?=$price_format?></div>
				<?}?>
				<div class="to_adr"><?=$val["ADDRESS"]?></div><div class="gruz">Везём: <?=$str_tov?></div>
				<input class="fio" type="hidden" value="<?=($val["PERSON_TYPE_ID"]==1)?$val["FIO"]:$val["CONTACT_PERSON"]?>">
				<input class="to_adr_coords" type="hidden" value="<?=$val["COORDS"]?>">
				<?foreach($val["SHIPMENT"] as $ist=>$vst) {?>
					<div class="box_sh">
					<input class="since_coords" type="hidden" value="<?=$vst["COORDS_SH"]?>">
					<input class="since_name" type="hidden" value="<?=$vst["NAME_SH"]?>">
					<div class="gruz_sh" style="display:none;">
						Везём: <?=$str_dat;?>
						<?foreach($vst["PRODUCT_SH"] as $psh){?>
							<?echo $psh["NAME_PR"]."-".$psh["QUANT_PR"]." ".$psh["MEASURE_PR"]."<br />"?>
						<?}?>
					</div>
					
					</div>
				<?}?>
				<input class="color_icon" type="hidden" value="<?=($LOCK_I!='')?$ar_status[$LOCK_I][1]:"#d8d8d8"?>">
				<input class="route_flag" type="hidden" value="<?=($LOCK_I=="DF")?'1':'0'?>">
				<input class="show_shipment" type="hidden" value="<?=$show_shipment?>">
			 </div>
			 <?unset($ar_orders_a);?>
		 
		<?}?>
	<?} else {?>
				<b style="font-size:15px;letter-spacing:2px;">Заказы не найдены.</b>
			<?}?>
<?} else {?>
	<b style="font-size:15px;letter-spacing:2px;">Пользователь не найден.</b>
<?}?>
<script></script>