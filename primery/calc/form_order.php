<?
IncludePublicLangFile(__FILE__);
$IBLOCK_ID=5;
  $arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID, 'GLOBAL_ACTIVE'=>'Y', 'DEPTH_LEVEL'=>'1', 'CHECK_PERMISSIONS'=>'N');
  $db_list = CIBlockSection::GetList(Array("sort"=>"asc"), $arFilter,false, Array('UF_CODE_TEL','UF_EMAIL_CURATOR','UF_MASK_TEL'));
 
  while($ar_result = $db_list->GetNext())
  {
	 // echo"<pre>";print_r($ar_result);echo"</pre>";

	 if($ar_result['UF_CODE_TEL']) {
		 $ar_code_tel[$ar_result['CODE']]['CODE']=$ar_result['CODE'];
		$ar_code_tel[$ar_result['CODE']]['NAME']=$ar_result['NAME'];
		$ar_code_tel[$ar_result['CODE']]['CODE_TEL']=$ar_result['UF_CODE_TEL'];
		$ar_code_tel[$ar_result['CODE']]['MASK_TEL']=$ar_result['UF_MASK_TEL'];
		$ar_code_tel[$ar_result['CODE']]['EMAIL_CURATOR']=$ar_result['UF_EMAIL_CURATOR'];
		$ar_code_tel[$ar_result['CODE']]['SRC']=CFile::GetPath($ar_result['PICTURE']);
		$res = CIBlockElement::GetList(Array(), Array('IBLOCK_ID'=>$IBLOCK_ID, "CODE"=>$ar_result['CODE']), false, false, Array("IBLOCK_ID", "ID", "PROPERTY_NAME_".strtoupper($_SESSION['s_lang_dir']))); 
		$res_elem = $res->GetNextElement();
		$fields = $res_elem->fields;
		$ar_code_tel[$ar_result['CODE']]['NAME_LANG']=$fields["PROPERTY_NAME_".strtoupper($_SESSION['s_lang_dir'])."_VALUE"];
	 }
  }
  $ar_code_tel_top=array_reverse($ar_code_tel);
 // echo"<pre>";print_r($ar_code_tel);echo"</pre>";
  if($_SESSION['ar_geoip']['country']) $cip=strtolower($_SESSION['ar_geoip']['country']);
  else $cip=$_SESSION['s_lang_dir'];
?>

<div class="div_order"><div class="close">&#215;</div>
<div class="tr"></div>
	<div class="tab_order">
		<div class="div_tr">
			<div class="poleo"><input type="text" name="user_name" class="user_name polto" value="" placeholder="<?=GetMessage("user_name")?>"></div>
			<div class="poleo" style="position:relative;">
				<div class="potl"><div class="simi">&#9660;</div><div class="simi div_none">&#9650;</div>
					<input type="text" id="code_tel" name="code_tel" class="code_tel polto" value="<?=$ar_code_tel[$cip]['CODE_TEL']?>" placeholder="<?=GetMessage("code_tel")?>" readonly>
					<input type="hidden" class="sid_c" value="<?=$ar_code_tel[$cip]['NAME']."(".$cip.")"?>"><input type="hidden" class="email_curator" value="<?=$ar_code_tel[$cip]['EMAIL_CURATOR']?>"><input type="hidden" class="mask_tel" value="<?=$ar_code_tel[$cip]['MASK_TEL']?>">
				</div>
					<div class="potr"><input type="tel" name="tel" class="tel polto" value="" placeholder="<?=GetMessage("tel")?>"></div>
					<div class="list_code list_code_bottom div_none">
						<?foreach($ar_code_tel as $k=>$val) {?>
							<div class="li_code li_code_bottom" style="background-image:url('<?=$val['SRC']?>');" sid_c="<?=$k?>" name_c="<?=$val['NAME']?>" email_curator="<?=$val['EMAIL_CURATOR']?>" mask_tel="<?=$val['MASK_TEL']?>" title="<?=$val['NAME_LANG']?>"><?=$val['CODE_TEL']?></div>
						<?}?>
						<?foreach($ar_code_tel_top as $k=>$val) {?>
							<div class="li_code li_code_top" style="background-image:url('<?=$val['SRC']?>');" sid_c="<?=$k?>" name_c="<?=$val['NAME']?>" email_curator="<?=$val['EMAIL_CURATOR']?>" mask_tel="<?=$val['MASK_TEL']?>" title="<?=$val['NAME_LANG']?>"><?=$val['CODE_TEL']?></div>
						<?}?>
					</div>
				
			</div>
		</div>
		<div class="div_tr">
			<div class="poleo" style="height:60px;"><textarea class="comment" placeholder="<?=GetMessage("comment")?>"></textarea></div>
			<div class="poleo"><input type="text" name="email" class="email polto" value="" placeholder="<?=GetMessage("email")?>"></div>
			<button type="button"  class="but_order"><?=GetMessage("add_order")?></button>
		</div>
		
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$(".list_itog .add_order, .div_order .close").click(function () {
			add_order_form();
		});
		
		$(".div_order .tab_order .code_tel").click(function () {
			list_code();
		});
		
		//f_mask_tel();
		
		$(".div_order .list_code .li_code").click(function () {
			var code=$(this).html();
			var sid_c=$(this).attr("sid_c");
			var name_c=$(this).attr("name_c");
			var email_curator=$(this).attr("email_curator");
			var mask_tel=$(this).attr("mask_tel");
			//alert(code+" "+sid_c+" "+name_c);
			$(".div_order .code_tel").val(code);
			$(".div_order .sid_c").val(name_c+"("+sid_c+")");
			$(".div_order .email_curator").val(email_curator);
			$(".div_order .mask_tel").val(mask_tel);
			//f_mask_tel();
			list_code();
		});
		
		$(".div_order .but_order").click(function () {
			polto();
		});
		
		$(".div_order .tab_order .tel").bind("change keyup input click", function() {
			var input=$(this);
			if (this.value.match(/[^0-9()-]/g)) {
				var et=this.value.replace(/[^0-9()-]/g, '');
				this.value = et;
			}
			//var a=$(this).val();
			//$(this).val(a.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));
		});
		
	});
	
var ff_order=true;
	
function add_order_form() {
	if(ff_order) {
		ff_order=false;
		$('.div_order').fadeIn(500);
		$(".list_itog .add_order span").html("&#9650;");
	}
	else {
		ff_order=true;
		$('.div_order').fadeOut(500);
		$(".list_itog .add_order span").html("&#9660;");
		setTimeout(function(){$(".div_order .tr").html("");$(".div_order .tab_order").css({"display":"table"});},500);
	}
}
function list_code() {
	var h_win=$(window).height();// высота окна браузера
	var ar_tel_pos=document.getElementById("code_tel").getBoundingClientRect();// массив координат позиции блока на экране
	//alert(h_win+" "+ar_tel_pos.top);
	if(ar_tel_pos.top>(h_win/2)) {
		$(".div_order .tab_order .list_code").removeClass("list_code_bottom");
		$(".div_order .tab_order .list_code").addClass("list_code_top");
		$(".div_order .tab_order .list_code .li_code_bottom").css({"display":"none"});
		$(".div_order .tab_order .list_code .li_code_top").css({"display":"block"});
	}
	else {
		$(".div_order .tab_order .list_code").removeClass("list_code_top");
		$(".div_order .tab_order .list_code").addClass("list_code_bottom");
		$(".div_order .tab_order .list_code .li_code_top").css({"display":"none"});
		$(".div_order .tab_order .list_code .li_code_bottom").css({"display":"block"});
	}
	
	$(".div_order .tab_order .list_code").toggleClass("div_none");
	$(".div_order .tab_order .simi").toggleClass("div_none");
}
function polto() {
	var reg_mail =/^[a-zA-Z0-9][-\._a-zA-Z0-9]+@[\w-\._]+\.\w{2,4}$/i;//var reg_mail =/^\w+@\w+\.\w{2,4}$/i;
	var reg_phone = /^[0-9-)(+ ]+$/;  // телефон - цифры скобки плюс дефис пробел
	var ao=0;
	$(".div_order .tab_order .polto").each(function(i,elem) {
		
		var tp=$.trim($(this).val());
		//var pl=$(this).attr("placeholder");
		var nm=$(this).attr("name");
		switch(nm) {
			case "email":{
				if(tp) {var reg=!reg_mail.test(tp);} // проверка поля с применением регулярного выражения, если поле заполнено
				else {var reg=false;tp=1;}           // проверка не нужна, если поле не заполнено
				break;
			}
			case "tel":var reg=!reg_phone.test(tp);break; // проверка поля с применением регулярного выражения
			default:var reg=false;
		}

		$(this).parents(".poleo").removeClass("div_error");
		if(tp=="" || reg) {$(this).parents(".poleo").addClass("div_error"); ao++;}
		
	});
	if(ao==0) add_order();
}

function add_order() {
	var LANGUAGE_ID=$("#LANGUAGE_ID").val(); // языковая папка
	var s_url="/"+LANGUAGE_ID+"/calc/add_form_order.php";
	var user_name=$(".div_order .tab_order .user_name").val();
	var sid_c=$(".div_order .tab_order .sid_c").val();
	var email_curator=$(".div_order .tab_order .email_curator").val();
	var code_tel=$(".div_order .tab_order .code_tel").val();
	var tel=$(".div_order .tab_order .tel").val();
	var email=$(".div_order .tab_order .email").val();
	var comment=$(".div_order .tab_order .comment").val();
	var data_par=json_order();
	var calc_par=json_calc();
	var s_data="user_name="+user_name+"&sid_c="+sid_c+"&email_curator="+email_curator+"&code_tel="+code_tel+"&tel="+tel+"&email="+email+"&comment="+comment+"&data_par="+data_par+"&calc_par="+calc_par;
	//alert(calc_par);
	$.ajax({
		type: "POST",
		url: s_url,
		data: s_data,
		cache: false,
		success: function(html){
			//$(".note_add_order").removeClass("div_none");
			$(".div_order .tr").html(html);
			$(".div_order .tab_order").css({"display":"none"});
			//$(".tab_order").addClass("div_none");
			//if(html==0) 
			//setTimeout(function(){$(".note_add_order").addClass("div_none");}, 10000);	
		}
	});
}
function f_mask_tel() {
	var mt=$(".div_order .mask_tel").val();
	if(mt.trim()=='') mt="9999999999";
	$(".div_order .tab_order .tel").mask(mt);
}
</script>