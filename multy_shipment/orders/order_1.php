<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//IncludeTemplateLangFile(SITE_TEMPLATE_PATH.'/header.php');

\Bitrix\Main\Loader::includeModule('iblock');
\Bitrix\Main\Loader::includeModule('catalog');
\Bitrix\Main\Loader::includeModule('sale');

//--------------настройки начало-------------------//
include("config_form.php");
//--------------настройки конец-------------------//

 //  массив полей формы заказа
$available = array('WHAT_CARRING'=>'Что везём', 'QUANTITY'=>'', 'TO_ADR'=>'Куда', 'TO_ADR_COORDS'=>'', 'FROM_ADR_COORDS'=>'', 'DISTANCE'=>'', 'PRICE'=>'Груз', 'COUNT_CAR'=>'Сколько авто', 'PRICE_DELIVERY'=>'Доставка', 'SUM'=>'Сумма', 'WHEN'=>'Когда', 'PERIOD'=>'', 'FIO'=>'Имя', 'PHONE'=>'Телефон', 'FIO_2'=>'Имя', 'PHONE_2'=>'Телефон', 'ID_PAY'=>'Оплата'/*,'TIME_1'=>'','TIME_2'=>''*/, 'NOTE'=>'Комментарий');


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
}

//echo "<pre>"; print_r($_SESSION["SHIPMENT"]["ar_shipment"]);echo "</pre>";


if(!isset($_SESSION["SHIPMENT"]["ar_catalog"])) {	
	// Каталог
	$ar_catalog=array();
	$arSelect = Array("ID","IBLOCK_ID", "NAME", "CATALOG_GROUP_1");
	
	$arFilter = Array("IBLOCK_ID"=>IntVal($IBLOCK_ID_CATALOG), "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array("SORT"=>"ASC","NAME"=>"ASC"), $arFilter, false, Array("nPageSize"=>1000), $arSelect);
	//$i=0;
	while($ob = $res->GetNextElement()){
	 $arFields = $ob->GetFields();
	// echo "<pre>"; print_r($arFields);echo "</pre>";
	  $arProps = $ob->GetProperties();
	 //echo "<pre>"; print_r($arProps);echo "</pre>";
	 $i=$arFields["ID"];
	 $_SESSION["SHIPMENT"]["ar_product_id"][]=$arFields["ID"];
	 $ar_catalog[$i]["ID"]=$arFields["ID"];
	 $ar_catalog[$i]["IBLOCK_ID"]=$arFields["IBLOCK_ID"];
	 $ar_catalog[$i]["NAME"]=$arFields["NAME"];
	
	 if($arFields["CATALOG_QUANTITY_FROM_1"]=="") $gk=0;
	 else $gk=$arFields["CATALOG_QUANTITY_FROM_1"];
	 $ar_catalog[$i]["PRICE"][$gk]=ceil($arFields["CATALOG_PRICE_1"]);
	//$ar_catalog[$i]["PRICE_FORMAT"]=number_format($arFields["CATALOG_PRICE_1"],0,',',' ');
	 $ar_catalog[$i]["CURRENCY"]=$arFields["CATALOG_CURRENCY_1"];
	 $ar_catalog[$i]["MEASURE"]=$_SESSION["SHIPMENT"]["measure"][$arFields["CATALOG_MEASURE"]]["SYMBOL"];
	 $el_shipment=array();
	 foreach($arProps["PLACE_SHIPMENT"]["VALUE"] as $val) {
		 $el_shipment[]=$_SESSION["SHIPMENT"]["ar_shipment"][$val]["COORDS"];;
	 }
	 $ar_catalog[$i]["STR_SHIPMENT"]=implode("|",$el_shipment);
	 if($arProps["CAPACITY"]["VALUE"]>0) $ar_catalog[$i]["CAPACITY"]=$arProps["CAPACITY"]["VALUE"]; //  вместительность одного автомобиля
	 else $ar_catalog[$i]["CAPACITY"]=20; //  вместительность одного автомобиля, если не задано
	 $ar_catalog[$i]["PRICE_KM"]=$arProps["PRICE_KM"]["VALUE"]; //  Цена км
	 $ar_catalog[$i]["PRICE_KM_MIN"]=$arProps["PRICE_KM_MIN"]["VALUE"]; //  Цена км минимальная
	 
	// $i++;
	}	
	foreach($ar_catalog as $ide=>$var) {
		ksort($var["PRICE"]);
		//echo "<pre>"; print_r($var["PRICE"]);echo "</pre>";
		foreach($var["PRICE"] as $m3=>$tp) {
			$ar_vdp[]=$m3."-".$tp;
		}
		$ar_catalog[$ide]["PRICE_DISCOUNT"]=implode("|",$ar_vdp);
		unset($ar_vdp);
	}
	$_SESSION["SHIPMENT"]["ar_catalog"]=$ar_catalog;
	//echo "<pre>"; print_r($ar_catalog);echo "</pre>";
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
<div class="box_order order">
<input type="hidden" id="add_start_date" value="<?=$ps?>">
<input type="hidden" id="step_q" value="<?=($step_q>0)?$step_q:1?>">
<input type="hidden" id="start_w" value="<?=$start_w?>">
<input type="hidden" id="hwd" value="<?=implode("",$ar_hwd)?>">
<input type="hidden" id="control_adr" value="">
	<form id="form_order" name="form_order">
		<?foreach($available as $code=>$title) {?>
			<?if($code!="TO_ADR_COORDS" && $code!="FROM_ADR_COORDS" && $code!="DISTANCE"){?>
					
				<?switch($code) {
					case 'ID_PAY':
						echo '<div class="row">';
							echo '<div class="title">'.$title.'</div>';
							echo '<select id="'.$code.'" name="'.$code.'">';
							foreach($_SESSION["SHIPMENT"]["ptype"] as $el) {
								if($_POST[$code] == $el["ID"]){$selected = "selected";}else{$selected = "";}
								echo '<option value="'.$el["ID"].'" title="'.$el["DESCRIPTION"].'" '.$selected.'>'.$el["NAME"].'</option>';
							}
							echo '</select>';
						echo '</div>';
						break;
						
					case 'WHAT_CARRING':
						echo '<div class="row">';
							echo '<div class="title">'.$title.'</div>';
							echo '<select id="'.$code.'" name="'.$code.'">';
							foreach($_SESSION["SHIPMENT"]["ar_catalog"] as $el) {
								if($_POST[$code] == $el["ID"]){$selected = "selected";}else{$selected = "";}
								echo '<option value="'.$el["ID"].'" price_discount="'.$el["PRICE_DISCOUNT"].'" measure="'.$el["MEASURE"].'" str_shipment="'.$el["STR_SHIPMENT"].'" price_km="'.$el["PRICE_KM"].'" price_km_min="'.$el["PRICE_KM_MIN"].'" capacity="'.$el["CAPACITY"].'" '.$selected.'>'.$el["NAME"].'</option>'; // - '.$el["PRICE_FORMAT"].' &#8381;
							}
							echo '</select>';
						
						break;
						
					case 'QUANTITY':
					
						echo '<div class="box_quantiti"><div class="minus">-</div><input type="text" id="'.$code.'" name="'.$code.'" value="';
						if($_POST[$code]) echo $_POST[$code];
						else echo ($step_q>0)?$step_q:1;
						echo '" /><div class="plus">+</div><div class="measure">'.$_SESSION["SHIPMENT"]["ar_catalog"][0]["MEASURE"].'</div></div>';
						echo '</div>';
						break;
						
					case 'WHEN':
						echo '<div class="row">';
							echo '<div class="title">'.$title.' <div class="bobuda">';
							if (!in_array($tewd, $ar_hwd)) {
								if($teta<=$mft) {
									echo '<button type="button" class="buda dat" poda="'.date("d.m.Y").'" pot1="'.date("H:i").'" pot2="20:00">сегодня</button>';
								}
							}
							if (!in_array($tewd1, $ar_hwd)) {
								echo '<button type="button" class="buda dat" poda="'.date("d.m.Y", strtotime("+1 days")).'" pot1="10:00" pot2="20:00">завтра</button>';
							}
							if (!in_array($tewd2, $ar_hwd)) {
								echo '<button type="button" class="buda dat" poda="'.date("d.m.Y", strtotime("+2 days")).'" pot1="10:00" pot2="20:00">послезавтра</button>';
							}
							echo '</div></div>';
							echo '<input type="text" id="'.$code.'" name="'.$code.'" class="datetimepicker" value="'.$teda.'" placeholder="дд.мм.гггг"/>';
							break;	
					case 'PERIOD':
						echo '<select id="'.$code.'" name="'.$code.'">';
							foreach ($ar_period as $v=>$t) {
								if($t["time_action"]>$teta) $dcs= "block";
								else $dcs="none";
								echo '<option value="'.$t["title"].'" time_action="'.$t["time_action"].'" style="display:'.$dcs.';">'.$t["title"].'</option>';
							}
						echo '</select>';
						echo '</div>';
						break;
					case 'FIO':
						echo '<div class="row">';
						echo '<div class="title">Заказчик</div>';
						echo '<input type="text" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" placeholder="'.$title.'" />';
						break;
					case 'PHONE':
						
						echo '<input type="text" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" placeholder="'.$title.'" />';
						echo '</div>';
						break;
						
					case 'FIO_2':
						echo '<div class="row">';
						echo '<div class="title">Получатель<div class="bobuda"><button type="button" class="buda nap">тот же, что и заказчик</button></div></div>';
						echo '<input type="text" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" placeholder="'.$title.'" />';
						break;
					case 'PHONE_2':
						
						echo '<input type="text" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" placeholder="'.$title.'" />';
						echo '</div>';
						break;
					case 'PRICE':
						echo '<div class="row">';
							echo '<div class="p_box">';
								echo '<div class="title">'.$title.'</div>';
								echo '<input type="hidden" id="'.$code.'" name="'.$code.'" value="0" />';
								echo '<div class="dinput"><span>0</span> &#8381;</div>';
							echo '</div>';
						break;
					case 'COUNT_CAR':
						
							echo '<div class="p_box">';
								echo '<div class="title">'.$title.'</div>';
								echo '<input type="hidden" id="'.$code.'" name="'.$code.'" value="1" price_delivery="0"/>';
								echo '<div class="dinput"><span>1</span></div>';
							echo '</div>';
						
						break;
					case 'PRICE_DELIVERY':
							echo '<div class="p_box">';
								echo '<div class="title">'.$title.'</div>';
								echo '<input type="hidden" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" />';
								echo '<div class="dinput"><span>0</span> &#8381;</div>';
							echo '</div>';
						break;
					case 'SUM':
							echo '<div class="p_box">';
								echo '<div class="title">'.$title.'</div>';
								echo '<input type="hidden" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" />';
								echo '<div class="dinput"><span>0</span> &#8381;</div>';
							echo '</div>';
						echo '</div>';
						break;
	
					default:
						echo '<div class="row">';
							echo '<span>'.$title.'</span>';
							echo '<input type="text" id="'.$code.'" name="'.$code.'" value="'.$_POST[$code].'" />';
						echo '</div>';
				}?>
					
			<?} else {?>
				<input type="hidden" id="<?=$code?>" name="<?=$code?>" value="<?=$_POST[$code]?>" />
			<?}?>
		<?}?>
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
		<div class="loader"><img src="/images/loader_35.gif" /></div>
		<button type="submit" class="obutton order">Заказать</button>
		
		<div class="ok_order" title="Ещё заказать товар">
			Ваш заказ принят!<br />
			В ближайшее время с Вами свяжется оператор.
		</div>
	</form>

</div>


<script type="text/javascript">
$(document).ready(function(){

	$("input[name=PHONE], input[name=PHONE_2]").bind("change keyup input click", function() {
		var input=$(this);
		if (this.value.match(/[^0-9+)(-]/g)) {
			var et=this.value.replace(/[^0-9+)(-]/g, '');
			this.value = et;
		}
	});
	
	$("select[name=WHAT_CARRING]").bind("change", function() {
		calc();
		show_measure();
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
	$(".box_quantiti .minus").on("click", function(){
		var step_q=$("#step_q").val()*1;
		var iq=$("input[name=QUANTITY]").val()*1;
		if(iq>step_q) iq=iq-step_q;
		$("[name=QUANTITY]").val(iq);
		calc();
	});
	$(".box_quantiti .plus").on("click", function(){
		var step_q=$("#step_q").val()*1;
		var iq=$("input[name=QUANTITY]").val()*1;
		iq=iq+step_q;
		$("[name=QUANTITY]").val(iq);
		calc();
	});
	$("input[name=QUANTITY]").bind("change keyup input click", function() {
		var input=$(this);
		var et=this.value.replace(/[^0-9]/g, '');
		this.value = et;
		if(this.value==0)this.value = '';
	});
	$("input[name=QUANTITY]").bind("blur", function() {
		var step_q=$("#step_q").val()*1;
		var et=$(this).val()*1;
		var oq=et%step_q;
		if(oq>0) et=et-oq+step_q;
		this.value = et;
		calc();
	});

	$('#form_order').on("submit", function(){
		if(erpo()==true) {
			$(".box_order .order").css({"display":"none"});
			var data=$(this).serialize();
			//alert(data);
			data+="&WHAT_CARRING_TEXT="+$("#form_order select[name=WHAT_CARRING] option:selected").text();
			data+="&PAY_TEXT="+$("#form_order select[name=ID_PAY] option:selected").text();
			var url="/orders/add_order.php";
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
	
	
	
calc();	
show_measure();

	function calc() {
		var el=0;
		var eld=$("#WHAT_CARRING option:selected").attr("price_discount");
		var capacity=$("#WHAT_CARRING option:selected").attr("capacity")*1;
		
		var q=$("#QUANTITY").val()*1;
		var eld1=eld.split("|");
		$.each(eld1, function(key, value) {
		  var eld2=value.split("-");
		  if(q>=eld2[0]*1) {el=eld2[1];}	 
		});
		//alert(el);
		var p=el*q;
		
		$("#PRICE").val(p);
		$("#PRICE").next(".dinput").children("span").html(number_format(p,0,"."," "));
		var c_car=Math.ceil(q/capacity);
		
		$("#COUNT_CAR").val(c_car);
		
		var price_delivery=$("#COUNT_CAR").attr("price_delivery")*1;
		var strd="";
		if(price_delivery>0) strd=" &#215; "+number_format(price_delivery,0,"."," ")+" &#8381;";
		$("#COUNT_CAR").next(".dinput").html(c_car+strd);
		var p_dlv=c_car*price_delivery;
		$("#PRICE_DELIVERY").val(p_dlv);
		$("#PRICE_DELIVERY").next(".dinput").children("span").html(number_format(p_dlv,0,"."," "));
		var ps=p+p_dlv;
		$("#SUM").val(ps);
		$("#SUM").next(".dinput").children("span").html(number_format(ps,0,"."," "));
	}
	
	
	
	function erpo(){
		
		var ke=0;
		 $("#form_order input").each(function(){
			var name=$(this).attr("name");
			var step_q=$("#step_q").val();
			var control_adr=$("#control_adr").val();
			$("[name=TO_ADR]").val(control_adr);
			if(name=="QUANTITY" && ($(this).val()==''||$(this).val()==0)) {$(this).val(step_q);calc();}
			if(name!="NOTE") {
			
				var str=$.trim($(this).val());
				
				if(str=="") {
					$(this).css({"background-color":"#f9b5b6"});ke++;
					if(name=="TO_ADR_COORDS") {$("[name=TO_ADR]").css({"background-color":"#f9b5b6"});}
				}
				else {
					/*
					if($(this).attr("name")=="WHEN") {
						//var dt=dateRegex.test(str);
						if(!date_ret(str)) {$(this).css({"background-color":"#f9b5b6"});ke++;}
						else {$(this).css({"background-color":"solid 1px #fff"});}
					}
					else {$(this).css({"background-color":"solid 1px #fff"});}
					*/
					$(this).css({"background-color":"#fff"});
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
	$('.box_order .row .nap').on("click", function(){
		var fio=$("#FIO").val();
		$("#FIO_2").val(fio);
		var phone=$("#PHONE").val();
		$("#PHONE_2").val(phone);
		
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
	function show_measure(){
		var measure=$("#WHAT_CARRING option:selected").attr("measure");
		$(".measure").html(measure[0]+"<sup>"+measure[1]+"</sup>");
	}
</script>