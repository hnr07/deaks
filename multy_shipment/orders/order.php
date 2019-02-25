<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//IncludeTemplateLangFile(SITE_TEMPLATE_PATH.'/header.php');

\Bitrix\Main\Loader::includeModule('iblock');
\Bitrix\Main\Loader::includeModule('catalog');
\Bitrix\Main\Loader::includeModule('sale');
unset($_SESSION["SHIPMENT"]);
//--------------настройки начало-------------------//
include("config_form.php");
//--------------настройки конец-------------------//
 // echo "<pre>"; print_r($_POST);echo "</pre>";
 
 //  массив полей формы заказа (ключ - имя поля, в значении наименование поля и тип)
//$available = array('WHAT_CARRING'=>'Что везём', 'QUANTITY'=>'', 'TO_ADR'=>'Куда', 'TO_ADR_COORDS'=>'', 'FROM_ADR_COORDS'=>'', 'DISTANCE'=>'', 'PRICE'=>'Груз', 'COUNT_CAR'=>'Сколько авто', 'PRICE_DELIVERY'=>'Доставка', 'SUM'=>'Сумма', 'WHEN'=>'Когда', 'PERIOD'=>'', 'FIO'=>'Имя', 'PHONE'=>'Телефон', 'FIO_2'=>'Имя', 'PHONE_2'=>'Телефон', 'ID_PAY'=>'Оплата'/*,'TIME_1'=>'','TIME_2'=>''*/, 'NOTE'=>'Комментарий');

$available = array(
	
	'TO_ADR'=>array('Куда','text'), 
	'TO_ADR_COORDS'=>array('Куда координаты','hidden'), 
	'FROM_ADR_COORDS'=>array('Откуда координаты','hidden'), 
	'DISTANCE'=>array('Расстояние','hidden'), 
	'WHAT_CARRING'=>array('Что везём','text'),
	'WHAT_CARRING_ID'=>array('ID товара','hidden'),	
	'QUANTITY'=>array('Количество','text'), 
	'PRICE'=>array('Груз','hidden'),
	'PRICE_DELIVERY'=>array('Доставка','hidden'), 
	'COUNT_CAR'=>array('Сколько авто','hidden'),  
	'PRICE_MEASURE'=>array('Цена за 1','hidden'), 
	'SUM'=>array('Стоимость','hidden'), 
	'ID_PAY'=>array('Способ оплаты','select'), 
	'TO_PAY'=>array('К оплате','hidden'), 
	'TO_PAY_DELIVERY'=>array('Доставка к оплате','hidden'),
	'WHEN'=>array('Когда','text'), 
	'PERIOD'=>array('','select'), 
	'FIO'=>array('Имя','text'), 
	'PHONE'=>array('Телефон (от 6 цифр)','text'), 
	'FIO_2'=>array('Имя','text'), 
	'PHONE_2'=>array('Телефон (от 6 цифр)','text'), 
	'TYPE_PAYER'=>array('Тип плательщика','hidden'), 
	'COMPANY'=>array('Название компании','text'), 
	'COMPANY_ADR'=>array('Юридический адрес','text'), 
	'INN'=>array('ИНН','text'), 
	'KPP'=>array('КПП','text'),
	'NOTE'=>array('Комментарий','text'),	
);

// Подключаем капчу
if($bc_order!="N") {
	include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
	$cpt = new CCaptcha();
	$captchaPass = COption::GetOptionString("main", "captcha_password", "");
	if(strlen($captchaPass) <= 0)
	{
	   $captchaPass = randString(10);
	   COption::SetOptionString("main", "captcha_password", $captchaPass);
	}
	$cpt->SetCodeCrypt($captchaPass);
}

// для сброса сессионных куков добавить параметр unset=Y
if($_GET["unset"]=="Y") {unset($_SESSION["SHIPMENT"]);} 

if(!isset($_SESSION["SHIPMENT"]["ptype"])) {
	$db_ptype = CSalePaySystem::GetList($arOrder = Array("SORT"=>"ASC", "PSA_NAME"=>"ASC"), Array("LID"=>SITE_ID, "CURRENCY"=>"RUB", "ACTIVE"=>"Y"));
	$bFirst = True;
	while ($ptype = $db_ptype->Fetch())
	{
		$ar_pay[]=$ptype; // Массив платёжных систем
		//echo "<pre>"; print_r($ptype);echo "</pre>";
	}
	$_SESSION["SHIPMENT"]["ptype"]=$ar_pay;
}

if(!isset($_SESSION["SHIPMENT"]["measure"])) {
	$ar_measure=array();// Массив единиц измерения
	$res_measure = CCatalogMeasure::getList();
        while($measure = $res_measure->Fetch()) {
         //  echo "<pre>"; print_r($measure);echo "</pre>";
		   $ar_measure[$measure["ID"]]=$measure;
        }
	$_SESSION["SHIPMENT"]["measure"]=$ar_measure;
}
if(!isset($_SESSION["SHIPMENT"]["ar_shipment"])) {	
	
	$ar_shipment=array();	// массив мест отгрузок
	$sh_arSelect=array("ID","IBLOCK_ID","PROPERTY_ON_MAP");
	$sh_arFilter = array("IBLOCK_ID"=>IntVal($IBLOCK_ID_SHIPMENT), "ACTIVE"=>"Y");	
	$sh_res = CIBlockElement::GetList(array("SORT"=>"ASC","NAME"=>"ASC"), $sh_arFilter, false, Array("nPageSize"=>1000), $sh_arSelect);	
	while($sh_ob = $sh_res->GetNextElement()){
		$sh_arFields = $sh_ob->GetFields();
		 // $sh_arProps = $sh_ob->GetProperties();
		 //echo "<pre>"; print_r($sh_arFields);echo "</pre>";
		$ar_shipment[$sh_arFields["ID"]]["ID"]=$sh_arFields["ID"];
		$ar_shipment[$sh_arFields["ID"]]["NAME"]=$sh_arFields["NAME"];
		$ar_shipment[$sh_arFields["ID"]]["COORDS"]=$sh_arFields["PROPERTY_ON_MAP_VALUE"];
		$ar_shipment_name[$sh_arFields["PROPERTY_ON_MAP_VALUE"]]=$sh_arFields["NAME"];
		$ar_shipment_id[$sh_arFields["PROPERTY_ON_MAP_VALUE"]]=$sh_arFields["ID"];
	}
	/* вариант для складов
	$dbResult_Store = CCatalogStore::GetList(
	   array('PRODUCT_ID'=>'ASC','ID' => 'ASC'),
	   array('ACTIVE' => 'Y','SHIPPING_CENTER'=>'Y'),
	   false,
	   false,
	   array("ID","TITLE","GPS_N","GPS_S","PRODUCT_AMOUNT")
	);
	while($store = $dbResult_Store->Fetch()) {
		echo "<pre>"; print_r($store);echo "</pre>";
		$ar_shipment[$store["ID"]]["ID"]=$store["ID"];
		$ar_shipment[$store["ID"]]["NAME"]=$store["TITLE"];
		$ar_shipment[$store["ID"]]["COORDS"]=$store["GPS_N"].",".$store["GPS_S"];
	}
	*/
	$_SESSION["SHIPMENT"]["ar_shipment"]=$ar_shipment;
	$_SESSION["SHIPMENT"]["ar_shipment_name"]=$ar_shipment_name;
	$_SESSION["SHIPMENT"]["ar_shipment_id"]=$ar_shipment_id;
}

//echo "<pre>"; print_r($_SESSION["SHIPMENT"]["ar_shipment_name"]);echo "</pre>";

if(!isset($_SESSION["SHIPMENT"]["ar_sections"])) {	
$arFilter_s = Array('IBLOCK_ID'=>$IBLOCK_ID_CATALOG, 'GLOBAL_ACTIVE'=>'Y');
  $db_list = CIBlockSection::GetList(Array("SORT"=>"ASC","NAME"=>"ASC"), $arFilter_s, true);
    
  while($ar_result = $db_list->GetNext())
  {
	$ar_sections[$ar_result['ID']]["ID"]=$ar_result['ID'];
	$ar_sections[$ar_result['ID']]["NAME"]=$ar_result['NAME'];
	$ar_sections[$ar_result['ID']]["ELEMENT_CNT"]=$ar_result['ELEMENT_CNT'];
  }
  $_SESSION["SHIPMENT"]["ar_sections"]=$ar_sections;
 // echo "<pre>"; print_r($ar_sections);echo "</pre>";
}
  
if(!isset($_SESSION["SHIPMENT"]["ar_catalog"])) {	
	// Каталог
	$ar_catalog=array();
	$arSelect = Array("ID","IBLOCK_ID", "NAME", "CATALOG_GROUP_1", "IBLOCK_SECTION_ID");
	
	$arFilter = Array("IBLOCK_ID"=>IntVal($IBLOCK_ID_CATALOG), "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array("SORT"=>"ASC","NAME"=>"ASC"), $arFilter, false, Array("nPageSize"=>1000), $arSelect);
	//$i=0;
	while($ob = $res->GetNextElement()){
	 $arFields = $ob->GetFields();
	 //echo "<pre>"; print_r($arFields);echo "</pre>";
	  $arProps = $ob->GetProperties();
	 //echo "<pre>"; print_r($arProps);echo "</pre>";
	 $is=$arFields["IBLOCK_SECTION_ID"];
	 $i=$arFields["ID"];
	 
	 $_SESSION["SHIPMENT"]["ar_product_id"][]=$arFields["ID"];
	 $ar_catalog[$is][$i]["ID"]=$arFields["ID"];
	 $ar_catalog[$is][$i]["IBLOCK_ID"]=$arFields["IBLOCK_ID"];
	 $ar_catalog[$is][$i]["NAME"]=$arFields["NAME"];
	
	 if($arFields["CATALOG_QUANTITY_FROM_1"]=="") $gk=0;
	 else $gk=$arFields["CATALOG_QUANTITY_FROM_1"];
	 $ar_catalog[$is][$i]["PRICE"][$gk]=ceil($arFields["CATALOG_PRICE_1"]);
	//$ar_catalog[$is][$i]["PRICE_FORMAT"]=number_format($arFields["CATALOG_PRICE_1"],0,',',' ');
	 $ar_catalog[$is][$i]["CURRENCY"]=$arFields["CATALOG_CURRENCY_1"];
	 $ar_catalog[$is][$i]["MEASURE"]=$_SESSION["SHIPMENT"]["measure"][$arFields["CATALOG_MEASURE"]]["SYMBOL"];
	 $el_shipment=array();
	 foreach($arProps["PLACE_SHIPMENT"]["VALUE"] as $val) {
		 $el_shipment[]=$_SESSION["SHIPMENT"]["ar_shipment"][$val]["COORDS"];
	 }
	 $ar_catalog[$is][$i]["STR_SHIPMENT"]=implode("|",$el_shipment);
	 if($arProps["CAPACITY"]["VALUE"]>0) $ar_catalog[$is][$i]["CAPACITY"]=$arProps["CAPACITY"]["VALUE"]; //  вместительность одного автомобиля
	 else $ar_catalog[$is][$i]["CAPACITY"]=20; //  вместительность одного автомобиля, если не задано
	 $ar_catalog[$is][$i]["PRICE_KM"]=$arProps["PRICE_KM"]["VALUE"]; //  Цена км
	 $ar_catalog[$is][$i]["PRICE_KM_MIN"]=$arProps["PRICE_KM_MIN"]["VALUE"]; //  Цена км минимальная
	 
	// $i++;
	}	
	foreach($ar_catalog as $ids=>$vars) {
		foreach($vars as $ide=>$var) {
			ksort($var["PRICE"]);
			//echo "<pre>"; print_r($var["PRICE"]);echo "</pre>";
			foreach($var["PRICE"] as $m3=>$tp) {
				$ar_vdp[]=$m3."-".$tp;
			}
			$ar_catalog[$ids][$ide]["PRICE_DISCOUNT"]=implode("|",$ar_vdp);
			unset($ar_vdp);
		}
	}
	$_SESSION["SHIPMENT"]["ar_catalog"]=$ar_catalog;
	// echo "<pre>"; print_r($ar_catalog);echo "</pre>";
}

$tewd=(int)date("w"); // день недели сегодня (0-воскресенье)
$tewd1=($tewd+1)%7; //  день недели завтра (0-воскресенье)
$tewd2=($tewd+2)%7; //  день недели послезавтра (0-воскресенье)

$ps=0;
if (in_array($tewd1, $ar_hwd)) $ps++;
if (in_array($tewd2, $ar_hwd)) $ps++;
$teta=(int)date("G"); //  текущий час без учёта минут
if($teta>($mft)) {$ps++;} // начало календаря перенесём на следующий день


$teda=date("d.m.Y",time()+($ps*24*60*60));

?>
<?
if($_POST["PERSON_TYPE_ID"]) $type_payer=$_POST["PERSON_TYPE_ID"];
else $type_payer=1;

?>

	<?$t_box_1='';$t_box_2='';$t_box_3='';$t_ur='';$ipbox='';$izbox='<div class="elem_box">';?>
		<?foreach($available as $code=>$title) {?>
			<?//if($code!="TO_ADR_COORDS" && $code!="FROM_ADR_COORDS" && $code!="DISTANCE"){?>
					
				<?switch($code) {
					
					case 'TO_ADR':
					$t_box_1.= '<div class="row">';
							
							$t_box_1.= '<div class="title">'.$title[0].'<div class="bobuda bomym"><button type="button" class="buda mym">мои места</button></div></div>';
							$t_box_1.= '<input type="'.$title[1].'" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" x-webkit-speech erpo/>';
						$t_box_1.= '</div>';
						break;
					case 'TO_ADR_COORDS':
						$t_box_1.= '<input type="'.$title[1].'" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" erpo/>';
						break;
					
					/*	
					case 'WHAT_CARRING':
						$izbox.= '<div class="row">';
							$izbox.= '<div class="title">'.$title[0].'</div>';
							$izbox.= '<select class="'.$code.'" name="'.$code.'[]">';
							foreach($_SESSION["SHIPMENT"]["ar_catalog"] as $el) {
								//if($_POST[$code] == $el["ID"]){$selected = "selected";}else{$selected = "";}
								$izbox.= '<option value="'.$el["ID"].'" price_discount="'.$el["PRICE_DISCOUNT"].'" measure="'.$el["MEASURE"].'" str_shipment="'.$el["STR_SHIPMENT"].'" price_km="'.$el["PRICE_KM"].'" price_km_min="'.$el["PRICE_KM_MIN"].'" capacity="'.$el["CAPACITY"].'" repetition="'.$el["ID"].'" prod_id="'.$el["ID"].'">'.$el["NAME"].'</option>'; // - '.$el["PRICE_FORMAT"].' &#8381;
							}
							$izbox.= '</select>';
							
						break;
					*/	
					
					case 'WHAT_CARRING':
					$izbox.= '<div class="row">';
							$izbox.= '<div class="title">'.$title[0].'</div>';
							$izbox.= '<input type="'.$title[1].'" class="'.$code.'" name="'.$code.'[]" erpo value="" placeholder="в ы б р а т ь" readonly price_discount="" measure="" str_shipment="" price_km="" price_km_min="" capacity="" prod_id="" />';
							$izbox.= '<div class="list_catalog hid">';
							foreach($_SESSION["SHIPMENT"]["ar_sections"] as $sec) {
								if($sec["ELEMENT_CNT"]>0) {
									$izbox.= '<div class="name_section show">'.$sec["NAME"].'</div>';
									$izbox.= '<div class="list_section hid">';
									foreach($_SESSION["SHIPMENT"]["ar_catalog"][$sec["ID"]] as $el) {
										$izbox.= '<div class="el_catalog" el_value="'.$el["ID"].'" el_price_discount="'.$el["PRICE_DISCOUNT"].'" el_measure="'.$el["MEASURE"].'" el_str_shipment="'.$el["STR_SHIPMENT"].'" el_price_km="'.$el["PRICE_KM"].'" el_price_km_min="'.$el["PRICE_KM_MIN"].'" el_capacity="'.$el["CAPACITY"].'" repetition="'.$el["ID"].'" el_prod_id="'.$el["ID"].'">'.$el["NAME"].'</div>'; // - '.$el["PRICE_FORMAT"].' &#8381;
									}
									$izbox.= '</div>';
								}
							}
							$izbox.= '</div>';
						break;
						
					case 'QUANTITY':
					
						$izbox.= '<div class="box_quantiti"><div class="minus">-</div><input type="'.$title[1].'" class="'.$code.'" name="'.$code.'[]" value="';
						$izbox.= '#Q#';
						//if($_POST[$code]) $izbox.= $_POST[$code];
						//else $izbox.= ($step_q>0)?$step_q:1;
						$izbox.= '" maxlength="5" erpo/><div class="plus">+</div><div class="measure">'.$_SESSION["SHIPMENT"]["ar_catalog"][0]["MEASURE"].'</div></div>';
						$izbox.= '</div>';
						break;
					case 'PRICE':
						
						$izbox.= '<input type="'.$title[1].'" class="'.$code.'" name="'.$code.'[]" value="" />';
						break;
					
					case 'WHAT_CARRING_ID':
							$izbox.= '<input type="'.$title[1].'" class="'.$code.'" name="'.$code.'[]" value="" />';
						break;	
					case 'PRICE_DELIVERY':
							$izbox.= '<input type="'.$title[1].'" class="'.$code.'" name="'.$code.'[]" value="" />';
						break;
					case 'FROM_ADR_COORDS':
						$izbox.= '<input type="'.$title[1].'" class="'.$code.'" name="'.$code.'[]" value="" />';
						break;
					case 'DISTANCE':
						$izbox.= '<input type="'.$title[1].'" class="'.$code.'" name="'.$code.'[]" value="" />';
						break;
					case 'COUNT_CAR':
						
								$izbox.= '<div class="title">'.$title[0].': ';
								$izbox.= '<input type="'.$title[1].'" class="'.$code.'" name="'.$code.'[]" value="1" price_delivery="0"/>';
								$izbox.= '<span class="dinput"></span>';
								//$izbox.= '<marquee class="dinput" direction="right"></marquee>';
							$izbox.= '</div>';
						
						break;
					case 'PRICE_MEASURE':
						$izbox.= '<div class="row">';
							$izbox.= '<div class="p_box">';
								$izbox.= '<div class="title">'.$title[0].' <span class="measure">'.$_SESSION["SHIPMENT"]["ar_catalog"][0]["MEASURE"].'</span></div>';
								$izbox.= '<input type="'.$title[1].'" class="'.$code.'" name="'.$code.'[]" value="" />';
								$izbox.= '<div class="dinput"><span>0</span> &#8381;</div>';
							$izbox.= '</div>';
						break;
						
					case 'SUM':
							$izbox.= '<div class="p_box">';
								$izbox.= '<div class="title">'.$title[0].'</div>';
								$izbox.= '<input type="'.$title[1].'" class="'.$code.'" name="'.$code.'[]" value="" />';
								$izbox.= '<div class="dinput"><span>0</span> &#8381;</div>';
							$izbox.= '</div>';
						$izbox.= '</div>';
						break;
						
					case 'ID_PAY':
						$t_box_3.= '<div class="row">';
							$t_box_3.= '<span class="title">'.$title[0].'</span>';
							$t_box_3.= '<select id="'.$code.'" name="'.$code.'">';
							foreach($_SESSION["SHIPMENT"]["ptype"] as $el) {
								if($_POST[$code] == $el["ID"]){$selected = "selected";}else{$selected = "";}
								$t_box_3.= '<option value="'.$el["ID"].'" title="'.$el["DESCRIPTION"].'" '.$selected;
								if($el["ID"]==1) $t_box_3.='style="display:none;"';
								$t_box_3.= '>'.$el["NAME"].'</option>';
							}
							$t_box_3.= '</select>';
						$t_box_3.= '</div>';
						break;	
					case 'TO_PAY':
							$ipbox.= '<div class="ip_box">';
								//$ipbox.= '<div class="title">'.$title[0].'</div>';
								$ipbox.= '<input type="'.$title[1].'" name="'.$code.'" value="'.$_POST[$code].'" />';
								$ipbox.= '<div class="dinput"><span>0</span> &#8381;</div>';
							$ipbox.= '</div>';
						
						break;
					case 'TO_PAY_DELIVERY':
							$ipbox.= '<input type="'.$title[1].'" name="'.$code.'" value="'.$_POST[$code].'" />';
						break;
					
					case 'WHEN':
						$t_box_2.= '<div class="row">';
							$t_box_2.= '<div class="title">'.$title[0].' <div class="bobuda">';
							if (!in_array($tewd, $ar_hwd)) {
								if($teta<=$mft) {
									$t_box_2.= '<button type="button" class="buda dat" poda="'.date("d.m.Y").'" pot1="'.date("H:i").'" pot2="20:00">сегодня</button>';
								}
							}
							if (!in_array($tewd1, $ar_hwd)) {
								$t_box_2.= '<button type="button" class="buda dat" poda="'.date("d.m.Y", strtotime("+1 days")).'" pot1="10:00" pot2="20:00">завтра</button>';
							}
							if (!in_array($tewd2, $ar_hwd)) {
								$t_box_2.= '<button type="button" class="buda dat" poda="'.date("d.m.Y", strtotime("+2 days")).'" pot1="10:00" pot2="20:00">послезавтра</button>';
							}
							$t_box_2.= '</div></div>';
							$t_box_2.= '<input type="'.$title[1].'" id="'.$code.'" name="'.$code.'" class="datetimepicker" value="'.$teda.'" placeholder="дд.мм.гггг" erpo/>';
							break;	
					case 'PERIOD':
						$t_box_2.= '<select id="'.$code.'" name="'.$code.'">';
							foreach ($ar_period as $v=>$t) {
								if($t["time_action"]>$teta) $dcs= "block";
								else $dcs="none";
								$t_box_2.= '<option value="'.$t["title"].'" time_action="'.$t["time_action"].'" style="display:'.$dcs.';">'.$t["title"].'</option>';
							}
						$t_box_2.= '</select>';
						$t_box_2.= '</div>';
						break;
					case 'FIO':
						$t_box_2.= '<div class="row">';
						$t_box_2.= '<div class="title">Заказчик<div class="bobuda"><button type="button" class="buda lico" lico="1"><div class="ico_check dico dico_check_8';
						if($type_payer!=1) $t_box_2.= ' not_img';
						$t_box_2.= '"></div>Физ. лицо</button><button type="button" class="buda lico" lico="2"><div class="ico_check dico dico_check_8';
						if($type_payer==1) $t_box_2.=' not_img';
						$t_box_2.= '"></div>Юр. лицо</button></div></div>';
						$t_box_2.= '<input type="'.$title[1].'" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" placeholder="'.$title[0].'" erpo/>';
						break;
					
					case 'PHONE':
						
						$t_box_2.= '<input type="'.$title[1].'" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" placeholder="'.$title[0].'" erpo/>';
						$t_box_2.= '</div>';
						break;
					
						
					case 'FIO_2':
						$t_box_2.= '<div class="row">';
						$t_box_2.= '<div class="title">Получатель<div class="bobuda"><button type="button" class="buda nap">тот же, что и заказчик</button></div></div>';
						$t_box_2.= '<input type="'.$title[1].'" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" placeholder="'.$title[0].'" erpo/>';
						break;
					case 'PHONE_2':
						
						$t_box_2.= '<input type="'.$title[1].'" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" placeholder="'.$title[0].'" erpo/>';
						$t_box_2.= '</div>';
						break;
					
					case 'COMPANY':
						$t_ur.= '<div class="row">';
							$t_ur.= '<div class="title">'.$title[0].'</div>';
							$t_ur.= '<input type="'.$title[1].'" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'"/>';
						$t_ur.= '</div>';
						break;
					case 'COMPANY_ADR':
						$t_ur.= '<div class="row">';
							$t_ur.= '<div class="title">'.$title[0].'</div>';
							$t_ur.= '<input type="'.$title[1].'" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" />';
						$t_ur.= '</div>';
						break;
					case 'INN':
						$t_ur.= '<div class="row" style="display:inline-block;">';
							$t_ur.= '<div class="title">'.$title[0].'</div>';
							$t_ur.= '<input type="'.$title[1].'" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" />';
						$t_ur.= '</div>';
						break;
					case 'KPP':
						$t_ur.= '<div class="row" style="display:inline-block;float:right;">';
							$t_ur.= '<div class="title">'.$title[0].'</div>';
							$t_ur.= '<input type="'.$title[1].'" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" />';
						$t_ur.= '</div>';
						break;
					
					case 'NOTE':
						$t_box_3.= '<div class="row">';
							$t_box_3.= '<div class="title">'.$title[0].'</div>';
							$t_box_3.= '<input type="'.$title[1].'" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" />';
						$t_box_3.= '</div>';
						break;
					case 'TYPE_PAYER':
							$t_box_2.= '<input type="'.$title[1].'" id="'.$code.'" name="'.$code.'" value="'.$type_payer.'" />';
						break;
					
				}?>
					
		
		<?}?>
		<?$izbox.='</div>';?>
<style>
	@import "<?=SITE_TEMPLATE_PATH?>/style_hid.css"; 
</style>
<div class="box_order order b_shadow">

<div class="izbox" style="display:none;">

<?echo str_replace("#Q#",$step_q,$izbox);?>
</div>

<input type="hidden" id="add_start_date" value="<?=$ps?>">
<input type="hidden" id="step_q" value="<?=($step_q>0)?$step_q:1?>">
<input type="hidden" id="start_w" value="<?=$start_w?>">
<input type="hidden" id="hwd" value="<?=implode("",$ar_hwd)?>">
<input type="hidden" id="control_adr" value="">
	<form id="form_order" name="form_order">
	
	<div class="container_elem">
		<!--<div class="reglin min"><div class="reglin_but up-down evd dico dico_up-chevron_8" title="свернуть"></div></div>-->
		<?
		if($_POST["repetition"]=="Y") {
			$f1=false;
			foreach($_POST["WHAT_CARRING_ID"] as $ia=>$vtv) {?>
			<?$elar=$_SESSION["SHIPMENT"]["ar_catalog"][$_POST["SECTION_ID"][$ia]];?>
				
				<div class="reglin info">
				<?if($f1) {?>
					<div class="reglin_but close evd dico dico_cancel-circle_8" title="убрать из заказа"></div>
				<?} $f1=true;?>	
					<div class="reglin_but up-down evu dico dico_up-chevron_8" title="свернуть"></div>
				<div class="v_info"><?=$elar[$ia]["NAME"]?> <?=$_POST["QUANTITY"][$ia]?> <?=str_replace("м3","м<sup>3</sup>",$elar[$ia]["MEASURE"]);?></div>
				</div>
				
					<?
					$str_0=Array(
						'value="" placeholder="в ы б р а т ь"', 
						'price_discount=""', 
						'measure=""', 
						'str_shipment=""', 
						'price_km=""', 
						'price_km_min=""', 
						'capacity=""', 
						'prod_id=""',
						'#Q#'
					);
					
					$str_post=Array(
						'value="'.$elar[$ia]["NAME"].'" placeholder="в ы б р а т ь"', 
						'price_discount="'.$elar[$ia]["PRICE_DISCOUNT"].'"', 
						'measure="'.$elar[$ia]["MEASURE"].'"', 
						'str_shipment="'.$elar[$ia]["STR_SHIPMENT"].'"', 
						'price_km="'.$elar[$ia]["PRICE_KM"].'"', 
						'price_km_min="'.$elar[$ia]["PRICE_KM_MIN"].'"', 
						'capacity="'.$elar[$ia]["CAPACITY"].'"', 
						'prod_id="'.$ia.'"',
						$_POST["QUANTITY"][$ia]
					);
					?>
				<? echo str_replace($str_0, $str_post,$izbox);?>
				
			<?}?>
			 <script>$(".container_elem .elem_box").css({"display":"none"});</script>
		<?}
		else {?>
			<div class="reglin min"><div class="reglin_but up-down evd dico dico_up-chevron_8" title="свернуть"></div></div>
			<?echo str_replace("#Q#",$step_q,$izbox);?>
			
		<?}?>
	</div>
	<div class="reglin min"><div class="add_fe dico dico_delivery-truck_8" title="выбрать ещё">+</div></div>
		<!--<div class="add_fe dico dico_delivery-truck_8" title="выбрать ещё">+</div>-->
	
	<?echo $t_box_1;?>
	
	<?echo $ipbox;?>
	
	<div class="container_user">
		<div class="reglin min"><div class="reglin_but up-down evd dico dico_up-chevron_8" title="свернуть"></div></div>
		<div class="user_box">
			<?echo $t_box_2;?>
			<div class="ur_box <?=($type_payer==1)?"not_display":""?>">
				<?echo $t_ur;?>
			</div>
			<?echo $t_box_3;?>
		</div>
	</div>
		<?if($bc_order!="N") {?>
			<div class="capcha_box">
				<span>Проверочный код</span>
				<div class="div_capcha">
					<input name="captcha_code" value="<?=htmlspecialchars($cpt->GetCodeCrypt());?>" type="hidden">
					<img src="/bitrix/tools/captcha.php?captcha_code=<?=htmlspecialchars($cpt->GetCodeCrypt());?>" title="Введите проверочный код">
					<div id="new_capcha" title="Обновить код"></div>
					<input id="captcha_word" name="captcha_word" type="text" placeholder="" title="Введите проверочный код">
				</div>
			</div>
		<?}?>
		<div class="err"></div>
		<div class="loader loader_order"><img src="/images/shipment/loader_35.gif"/></div>
		<button type="submit" class="obutton order">Заказать</button>
		
		<div class="ok_order" title="Ещё заказать товар">
			Ваш заказ принят!<br />
			В ближайшее время с Вами свяжется оператор.
		</div>
	</form>

</div>


<script type="text/javascript">
// if (document.createElement('input').webkitSpeech === undefined) {
 // alert("Не поддерживается");
// } else {
 // alert("Поддерживается!");
// }

 

  $(document).ready(function(){
				

	$("input[name=PHONE], input[name=PHONE_2]").bind("change keyup input click", function() {
		var input=$(this);
		if (this.value.match(/[^0-9+)(-]/g)) {
			var et=this.value.replace(/[^0-9+)(-]/g, '');
			this.value = et;
		}
	});
	
	$("select.WHAT_CARRING").bind("change", function() {
		var t=$(this).closest(".elem_box");
		calc(t);
		//show_measure($(this));
	});
	/*
	$("input[name=WHEN]").bind("change keyup input click", function() {
		var input=$(this);
		if (this.value.match(/[^0-9]/g)) {
			var et=this.value.replace(/[^0-9.]/g, '');
			this.value = et;
		}
	});
	*/
	$(".add_fe").bind("click", function() {
		$('<div class="reglin min"><div class="reglin_but up-down evd dico dico_up-chevron_8" title="свернуть"></div><div class="reglin_but close evd dico dico_cancel-circle_8" title="убрать из заказа"></div></div>').appendTo(".container_elem");
		var clone=$(".izbox .elem_box").clone(true).appendTo(".container_elem");
		//calc(clone);
		calc_delivery_all($("#TO_ADR_COORDS").val());
		height_map();
	});
	
	$(".box_quantiti .minus").on("click", function(){
		var t=$(this).closest(".elem_box");
		var step_q=$("#step_q").val()*1;
		var iq=t.find("input.QUANTITY").val()*1;
		if(iq>step_q) iq=iq-step_q;
		
		t.find(".QUANTITY").val(iq);
		calc(t);
	});
	$(".box_quantiti .plus").on("click", function(){
		var t=$(this).closest(".elem_box");
		var step_q=$("#step_q").val()*1;
		var iq=t.find("input.QUANTITY").val()*1;
		iq=iq+step_q;
		
		t.find(".QUANTITY").val(iq);
		calc(t);
	});
	$("input.QUANTITY").bind("change keyup input click", function() {
		var input=$(this);
		
		var et=this.value.replace(/[^0-9]/g, '');
		this.value = et;
		if(this.value==0)this.value = '';
	});
	$("input.QUANTITY").bind("blur", function() {
		var step_q=$("#step_q").val()*1;
		var et=$(this).val()*1;
		if(et==0) {et=1;$(this).val(et);}
		
		var t=$(this).closest(".elem_box");
		var oq=et%step_q;
		if(oq>0) et=et-oq+step_q;
		this.value = et;
		calc(t);
	});

	$('#form_order').on("submit", function(){
		if(erpo()==true) {
			$(".box_order .order").css({"display":"none"});
			var data=$(this).serialize();
			//alert(data);
			
			data+="&PAY_TEXT="+$("#form_order select[name=ID_PAY] option:selected").text();
			var url="/multy_shipment/orders/add_order.php";
			$.ajax({  
				type: "POST",
				url: url,  
				data: data, 
				cache: false,  
				success: function(html){ 
					//$("#res_ajax").html(html);
					if(html>0) {
						$("#form_order .ok_order").slideDown();
						$("#form_order .err").slideUp();
						var id_pay=$("#form_order select[name=ID_PAY] option:selected").val();	
						if(id_pay>1) go_pay(html);	
												
					}
					else {
						$("#form_order .err").slideDown();
						if(html<0) $("#form_order .err").html("Ошибка проверочного кода!");
						else $("#form_order .err").html("Ошибка сохранения! Попробуйте позже.");
						$("#form_order .capcha_box .div_capcha #new_capcha").click();
					}
					$(".box_order .order").css({"display":"block"});
				} 
			});
		}
		return false;
	});
	
	$(".container_elem").on("click", ".reglin .v_info", function(){
		$(this).prev(".reglin .reglin_but.up-down").click();
	});
	$(".container_elem").on("click", ".reglin .reglin_but.up-down", function(){
		
		var lic=$(this).parent(".reglin").next(".elem_box");
		var hlic=lic.outerHeight();
		var hmap=$("#myMap").outerHeight();
		var mi=hmap-hlic;
		var ma=hmap+hlic;
		//alert(hmap+" "+hlic+" "+" "+mi+" "+ma);
		var wc=lic.find(".WHAT_CARRING").val();
		if($(this).hasClass("evd")) {
			
			var qw=lic.find(".QUANTITY").val();
			var me=lic.find(".measure").html();
			if(wc=='') {
				qw='';me='';
				wc=lic.find(".WHAT_CARRING").attr("placeholder");
			}
			
			$(this).after('<div class="v_info">'+wc+' '+qw+' '+me+'</div>');
			$(this).removeClass("evd").addClass("evu");
			lic.slideUp(500,function(){height_map();});
			//$("#myMap").animate({"height": mi+"px"},500);
			//myMap.container.fitToViewport();
			//$("#myMap").css({"height": mi+"px"});
			
			$(this).parent(".reglin").removeClass("min").addClass("info");
			$(this).attr("title", "развернуть");
		}
		else {
			$(this).next(".v_info").remove();
			$(this).removeClass("evu").addClass("evd");
			lic.slideDown(500,function(){height_map();});
			//$("#myMap").animate({"height": ma+"px"},500);
			//myMap.container.fitToViewport();
			//$("#myMap").css({"height": ma+"px"});
			//height_map(500);
			$(this).parent(".reglin").removeClass("info").addClass("min");
			$(this).attr("title", "свернуть");
			if(wc=='') {
				 if(lic.find(".WHAT_CARRING").next(".list_catalog").hasClass("hid")) lic.find(".WHAT_CARRING").click();
			}
		}
		
		//$(this).parent(".reglin").next(".elem_box").slideToggle(500);
	});
	$(".container_user").on("click", ".reglin .reglin_but.up-down", function(){
		
		var lic=$(this).parent(".reglin").next(".user_box");
		if($(this).hasClass("evd")) {
			var dp=lic.find("[name=PERIOD] option:selected").text();
			var dw=lic.find("[name=WHEN]").val();
						
			$(this).after('<div class="v_info">'+dw+' &nbsp;&nbsp; '+dp+'</div>');
			$(this).removeClass("evd").addClass("evu");
			lic.slideUp(500,function(){height_map();});
			$(this).parent(".reglin").removeClass("min").addClass("info");
			$(this).attr("title", "развернуть");
		}
		else {
			$(this).next(".v_info").remove();
			$(this).removeClass("evu").addClass("evd");
			lic.slideDown(500,function(){height_map();});
			$(this).parent(".reglin").removeClass("info").addClass("min");
			$(this).attr("title", "свернуть");
		}
		//$(this).parent(".reglin").next(".elem_box").slideToggle(500);
		
	});
	
	$(".container_elem").on("click", ".reglin .reglin_but.close", function(){
		//alert(111);
		$(this).parent(".reglin").next(".elem_box").remove();
		$(this).parent(".reglin").remove();
		to_pay();
		height_map();
	});
	
	$("body").on("blur", "#FIO, #PHONE", function(){
		var phone=$("#PHONE").val();
		var min_phone=phone.replace(/[-+() ]/g,'');
		var fio=$("#FIO").val();
		if(min_phone.length>=6 && fio!='') {
			var data="PHONE="+phone+"&FIO="+fio;
			var url="/multy_shipment/orders/user_orders.php";
			
			$.ajax({  
				type: "POST",
				url: url,  
				data: data, 
				cache: false,  
				success: function(html){ 
				
					//$("#res_ajax").html(html);
					var ar_html=html.split('||');
					if(ar_html[0]>0) {
						$("#ID_PAY option[value=1]").css({"display":"block"});
						$(".bomym").css({"display":"block"});
						var list_mym='';
						$.each(ar_html,function(index,value){
							if(index>0) {
								ar_val=value.split('|');
								list_mym+='<div class="el_mym" title="выбрать" coords="'+ar_val[1]+'">'+ar_val[0]+'</div>';
							}
						});
						$(".window_100 .window_mym").html(list_mym);
					}
					else {
						$("#ID_PAY option[value=1]").css({"display":"none"}).prop('selected', false);
						$(".bomym").css({"display":"none"});
						}
				} 
			});
		}
	});
	
	
	$(".container_elem").on("click", ".WHAT_CARRING", function(){
		var list=$(this).next(".list_catalog");
		if(list.hasClass("hid")) {
			list.removeClass("hid").addClass("show");
			list.children(".name_section").removeClass("hid").addClass("show");
			list.children(".list_section").removeClass("show").addClass("hid");
		}
		else {
			list.removeClass("show").addClass("hid");
		}
	});
	
	$(".container_elem").on("click", ".name_section", function(){
		if($(this).next(".list_section").hasClass("hid")) {
			$(this).closest(".list_catalog").children(".list_section").removeClass("show").addClass("hid");
			$(this).next(".list_section").removeClass("hid").addClass("show");
		}
	});
	
	$(".container_elem").on("click", ".el_catalog", function(){
		var input=$(this).closest(".list_catalog").prev("input");
		input.val($(this).text());
		input.attr("price_discount",$(this).attr("el_price_discount"));
		input.attr("measure",$(this).attr("el_measure"));
		input.attr("str_shipment",$(this).attr("el_str_shipment"));
		input.attr("price_km",$(this).attr("el_price_km"));
		input.attr("price_km_min",$(this).attr("el_price_km_min"));
		input.attr("capacity",$(this).attr("el_capacity"));
		input.attr("prod_id",$(this).attr("el_prod_id"));
		
		$(this).closest(".list_catalog").removeClass("show").addClass("hid");
		var t=$(this).closest(".elem_box");
		var coords=$("#TO_ADR_COORDS").val();
		calc_delivery(coords,t);
		calc(t);
	});

calc_all();	
//show_measure();

	function calc(t) {
		var el=0;
		var eld=t.find(".WHAT_CARRING").attr("price_discount");
		var capacity=t.find(".WHAT_CARRING").attr("capacity")*1;
		var prod_id=t.find(".WHAT_CARRING").attr("prod_id");
		var q=t.find(".QUANTITY").val()*1;
		var eld1=eld.split("|");
		$.each(eld1, function(key, value) {
		  var eld2=value.split("-");
		  if(q>=eld2[0]*1) {el=eld2[1];}	 
		});
		
		var p=el*q;
		
		t.find(".PRICE").val(p);
		//t.find("[name=PRICE]").next(".dinput").children("span").html(number_format(p,0,"."," "));
		if(capacity>0) var c_car=Math.ceil(q/capacity);
		else c_car=0;
		t.find(".COUNT_CAR").val(c_car);
		
		var price_delivery=t.find(".COUNT_CAR").attr("price_delivery")*1;
		var strd="";
		
		//if(price_delivery>0) strd=" &#215; "+number_format(price_delivery,0,"."," ")+" &#8381;";
		for(i=0;i<c_car;i++) {
			strd+="<div class='ico_car dico dico_delivery-truck_8'></div>";
		}
		
		//t.find("[name=COUNT_CAR]").next(".dinput").html("[<b>"+c_car+"</b>]"+strd);
		t.find(".COUNT_CAR").next(".dinput").html("[<b>"+c_car+"</b>] <marquee direction='right' scrollamount='3'>"+strd+"</marquee>");
		var p_dlv=c_car*price_delivery;
		t.find(".PRICE_DELIVERY").val(p_dlv);
		//$("[name=PRICE_DELIVERY]").next(".dinput").children("span").html(number_format(p_dlv,0,"."," "));
		var ps=p+p_dlv;
		
		t.find(".SUM").val(ps);
		t.find(".SUM").next(".dinput").children("span").html(number_format(ps,0,"."," "));
		
		var pm=Math.round(ps/q);
		
		t.find(".PRICE_MEASURE").val(pm);
		t.find(".PRICE_MEASURE").next(".dinput").children("span").html(number_format(pm,0,"."," "));
		
		show_measure(t);
		
		t.find(".WHAT_CARRING_ID").val(prod_id);
		
		var itogo=$("[name=TO_PAY]").val();
		itogo+=ps;
		//alert(itogo);
		//$("[name=TO_PAY]").val();
		/*
		var to_addr=$("#TO_ADR_COORDS").val();
		if(to_addr !="") {
			calc_delivery(to_addr,t);
		}
		*/
		to_pay();
	}
	function calc_all() {
		$(".container_elem .elem_box").each(function(){
			calc($(this));
		});
	}
	function erpo(){
		
		var ke=0;
		 $("#form_order input[erpo]").each(function(){
			var bu=$(this).parent(".row").parent("div").prev(".reglin");
			var name=$(this).attr("name");
			//alert(name);
			var step_q=$("#step_q").val();
			var control_adr=$("#control_adr").val();
			$("[name=TO_ADR]").val(control_adr);
			//if(name=="QUANTITY" && ($(this).val()==''||$(this).val()==0)) {$(this).val(step_q);calc();}
			if(name!="NOTE") {
			
				var str=$.trim($(this).val());
				
				if(str=="" || str==0) {
					$(this).css({"background-color":"#f9b5b6"});ke++;
					if(name=="TO_ADR_COORDS") {$("[name=TO_ADR]").css({"background-color":"#f9b5b6"});}
					if(name=="FIO" || name=="FIO_2" || name=="PHONE" || name=="PHONE_2") {
						if(bu.hasClass("info")) {
							bu.children(".reglin_but.up-down").click();
						}
					}
				}
				else {
					
					if($(this).attr("name")=="PHONE" || $(this).attr("name")=="PHONE_2") {
						var min_phone=str.replace(/[-+() ]/g,'');
						//alert(min_phone);
						if(min_phone=='' || min_phone.length<6) {$(this).css({"background-color":"#f9b5b6"});ke++;}
						else {$(this).css({"background-color":"#fff"});}
					}
					else {$(this).css({"background-color":"#fff"});}
					
					
				}	
			}			
		});
		if(ke>0) {
			$("#form_order .err").html("Заполните, пожалуйста, поля формы!");
			$("#form_order .err").slideDown(); 
			return false;
		}
		else {
			$("#form_order .err").slideUp(); 
			return true;
		}
	}
	
	// функция проверка даты в формате 'дд.мм.гггг' или 'д.м.гггг'
	function date_ret(strd) {
		if(strd!="") {
			var dateRegex = /^(?=\d)(?:(?:31(?!.(?:0?[2469]|11))|(?:30|29)(?!.0?2)|29(?=.0?2.(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(?:\x20|$))|(?:2[0-8]|1\d|0?[1-9]))([-.\/])(?:1[012]|0?[1-9])\1(?:1[6-9]|[2-9]\d)?\d\d(?:(?=\x20\d)\x20|$))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\x20[AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/;
			var drt=dateRegex.test(strd);
			if(drt) {
				var cur_date= new Date();
				var ar_d=strd.split('.');
				var tmp_date= new Date(ar_d[2]*1,ar_d[1]*1-1,ar_d[0],23,59,59);
				if(Date.parse(tmp_date) < Date.parse(cur_date)) return false; // дата меньше текущей
				else return true;
			}
			else return false; // неверный формат
		}
		else return false; // пустая строка
	}
	
	$('#form_order .ok_order').on("click", function(){
		$(this).slideUp();
		$("#form_order .capcha_box .div_capcha #new_capcha").click();
	});
	
	$('.box_order .row .dat').on("click", function(){
		$(this).parents(".bobuda").parents(".title").next("input").val($(this).attr("poda"));
		fchd();
		//$(this).parents("span").next("input").next("div").next("input").val($(this).attr("pot1"));
		//$(this).parents("span").next("input").next("div").next("input").next("div").next("input").val($(this).attr("pot2"));
		
	});
	
	$('.box_order .row .mym').on("click", function(){
		$(".window_100").css({"display":"block"});
		$(".window_100 .window_item").css({"display":"block"});
		$(".window_100 .window_mym").css({"display":"block"});
		$(".window_100 .window_pay").css({"display":"none"});
	});
	
	$('.box_order .row .nap').on("click", function(){
		var fio=$("#FIO").val();
		$("#FIO_2").val(fio);
		var phone=$("#PHONE").val();
		$("#PHONE_2").val(phone);
		
	});
	
	$('.box_order .row').on("click", ".lico", function(){
		var type_payer=$(this).attr("lico");
		//alert(type_payer);
		$("#TYPE_PAYER").val(type_payer);
		$(".ico_check").addClass("not_img");
		$(this).children(".ico_check").removeClass("not_img");
		if(type_payer=="1") {
			$(".ur_box").addClass("not_display");
			$(".ur_box input").removeAttr("erpo");
		}
		else {
			$(".ur_box").removeClass("not_display");
			$(".ur_box input").attr("erpo","");
		}
		height_map();
		
	});
	
	$("input[name=WHEN]").bind("change", function() {
		var input=$(this);
		fchd();
	});
	
	
});
function fchd() {
	var vd=$("input[name=WHEN]").val();
	var ar_vd=vd.split('.');
	var DT= new Date();
	var hD= DT.getHours()*1;
	if(ar_vd[0]==DT.getDate() && ar_vd[1]==DT.getMonth()+1 && ar_vd[2]==DT.getFullYear()) {
		//alert(hD);
		var fs=0;
		$("select[name=PERIOD] option").each(function(){
			var time_action=$(this).attr("time_action")*1;
			//alert(time_action+" "+hD);
			
			if(time_action<hD){
				$(this).css({"display":"none"});
				if(this.selected==true) {fs=1;}
				}
			else {$(this).css({"display":"block"});}
		});
		//alert(fs);
		if(fs==1) {$("select[name=PERIOD] option:visible").filter(":first").prop("selected", true);}
		
	}
	else {$("select[name=PERIOD] option").css({"display":"block"});}
	//alert(hD);
}
/*
$('.datetimepicker[name=WHEN]').datepicker({
	//inline: true
	 closeText: 'Закрыть',
                prevText: 'назад',
				nextText: 'вперёд',
                currentText: 'Сегодня',
                monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
                    'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
                monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
                    'Июл','Авг','Сен','Окт','Ноя','Дек'],
                dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
                dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
                dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
                weekHeader: 'Не',
               // dateFormat: 'dd.mm.yy',
			   dateFormat: 'h:i',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: '',
	minDate:new Date(),
	maxDate: "+1m",
});

*/

	$.datetimepicker.setLocale('ru');
	
	var add_start_date=$("#add_start_date").val()*1;

	var startDate= new Date();
	var finishDate=new Date();
	finishDate.setMonth(finishDate.getMonth() + 1);
	startDate.setDate(startDate.getDate() + add_start_date);
	finishDate.setDate(finishDate.getDate() + add_start_date);
	
	var start_w=$("#start_w").val();
	var str_hwd=$("#hwd").val();
	var ar_hwd_S=str_hwd.split('');
	var ar_hwd_N= [];
	for (var i = 0; i < ar_hwd_S.length; i++) {
	  ar_hwd_N[i]=Number(ar_hwd_S[i]);
	}
	
	
	$('.datetimepicker[name=WHEN]').datetimepicker({
		dayOfWeekStart : start_w, // начало недели 1-понедельник
		lang:'ru', // язык вывода дней и месяцев ru, en, de
		//format:'d M Y H:i', // формат даты времени
		format:'d.m.Y', // формат даты времени
		//disabledDates:['2018/09/21','2018/09/29'], // неактивные даты
		startDate: 0,
		step:30, // интервал времени в минутах
		minDate:startDate, // нижняя граница выбора даты
		maxDate:finishDate, // верхняя граница выбора даты
		formatDate:'d.m.Y',// служебный формат даты времени нужен для minDate maxDate
		yearStart: startDate.getFullYear(),
		yearEnd: finishDate.getFullYear(),
		
		//allowTimes:['10:00', '12:00', '14:00', '16:00', '18:00'], // доступное для выбора время
		timepicker:false,  // выбор времени
		disabledWeekDays: ar_hwd_N, // неактивные дни недели 0-воскресенье, 6-суббота
	
	});
	
	/*
	$('.datetimepicker[name=TIME_1]').datetimepicker({
		lang:'ru',
		datepicker: false,
		timepicker:true,  // выбор времени
		format:'H:i',
		
		allowTimes:['10:00', '12:00', '14:00', '16:00', '18:00'],
		//onShow:function( ct ){
		//    this.setOptions({
			//minTime:jQuery('.datetimepicker[name=TIME_2]').val()?jQuery('.datetimepicker[name=TIME_2]').val():false
			//minTime:0
		//	maxTime:'24:00',
		 //  })
		//},
		formatTime:'H:i',
	});
	$('.datetimepicker[name=TIME_2]').datetimepicker({
		lang:'ru',
		datepicker: false,
		timepicker:true,  // выбор времени
		format:'H:i',
		
		allowTimes:['12:00', '14:00', '16:00', '18:00','20:00'],
		//onShow:function( ct ){
		 //  this.setOptions({
		//	minTime:jQuery('.datetimepicker[name=TIME_1]').val()?jQuery('.datetimepicker[name=TIME_1]').val():false
		  // })
		//},
		
		formatTime:'H:i',
	});
	*/
	
	function number_format(number, decimals, dec_point, thousands_sep) {
	/***
	number - исходное число
	decimals - количество знаков после разделителя
	dec_point - символ разделителя
	thousands_sep - разделитель тысячных
	***/
  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}


	function show_measure(t){
		var measure=t.find(".WHAT_CARRING").attr("measure");
		var text_m=measure;
		if(measure=="м3") text_m=measure[0]+"<sup>"+measure[1]+"</sup>";
		t.find(".measure").html(text_m);
	}
</script>