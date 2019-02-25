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
        array("ORDER_ID" => $ar_sales["ID"], "CODE"=>array("FIO","ADDRESS","COORDS","DATE_DELIVERY","PERIOD_DELIVERY","SHIPMENT","SHIPMENT_COORDS"))
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
	$pay_sistem=CSalePaySystem::GetByID($ar_sales["PAY_SYSTEM_ID"]);
	$ar_orders_a[$ar_sales["ID"]]["PAY_SYSTEM_NAME"]=$pay_sistem["NAME"];// платежная система
}
//echo "<pre>"; print_r($ar_orders_a); echo "</pre>";
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
				$str_tov='';
				$str_tov.=$val["PRODUCT"]["NAME"]."-".$val["PRODUCT"]["QUANTITY"]." ".str_replace("3","<sup>3</sup>",$val["PRODUCT"]["MEASURE"])." ";
				$str_tov.=$val["DATE_DELIVERY"]." (".$val["PERIOD_DELIVERY"].")";
				$str_tov.=" - <b><nobr>".$price_format."</nobr></b>";
			?>
			 <div class="row_list" order_id="<?=$id?>" title="на карте" style="border-bottom-color:<?=($LOCK_I!='')?$ar_status[$LOCK_I][1]:"#d8d8d8"?>;">
				<div class="status" style="background-color:<?=($LOCK_I!='')?$ar_status[$LOCK_I][1]:"#d8d8d8"?>">№<b><?=$id?></b> &nbsp;&nbsp;<?=$ar_status[$LOCK_I][0]?></div>
				<?if($LOCK_I=="N") {?>
					<div class="" style="background-color:<?=($LOCK_I!='')?$ar_status[$LOCK_I][1]:"#d8d8d8"?>;"><button type="button" class="pay" title="<?=$val["PAY_SYSTEM_NAME"]?>" onclick="go_pay(<?=$id?>)">Оплатить <b><?=$price_format?></b></button></div>
				<?}?>
				<div class="to_adr"><?=$val["ADDRESS"]?></div><div class="gruz">Везём: <?=$str_tov?></div>
				<input class="fio" type="hidden" value="<?=$val["FIO"]?>">
				<input class="to_adr_coords" type="hidden" value="<?=$val["COORDS"]?>">
				<input class="since_coords" type="hidden" value="<?=$val["SHIPMENT_COORDS"]?>">
				<input class="since_name" type="hidden" value="<?=$val["SHIPMENT"]?>">
				<input class="color_icon" type="hidden" value="<?=($LOCK_I!='')?$ar_status[$LOCK_I][1]:"#d8d8d8"?>">
				<input class="route_flag" type="hidden" value="<?=($LOCK_I=="DF")?'1':'0'?>">
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