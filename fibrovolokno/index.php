<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Фиброволокно");

if($_GET['unset']=='Y') {unset($_SESSION["ELEM_F"]);} // Удаление сессионной переменной по параметру в строке unset=Y
$IBLOCK_ID_R=22; // ID инфоблока Рекламный блок
$IBLOCK_ID_P=23; // ID инфоблока Продукция
$icp=10; // Кол-во элементов на странице, если = 0 - все
?>
<script>

$(document).ready(function() {

	$(".page_home").on("click", ".aaj", function(){
		 var PAGEN_1=$(this).attr("PAGEN_1");
		 if(PAGEN_1==0) {
			var PARENT_ID=$(this).attr("PARENT_ID");
			var SECTION_ID=$(this).attr("SECTION_ID");
			$("#PARENT_ID").val(PARENT_ID);
			$("#SECTION_ID").val(SECTION_ID);
		}
		else {
			var PARENT_ID=$("#PARENT_ID").val();
			var SECTION_ID=$("#SECTION_ID").val();
			
		}
		var SELECTION=$(this).attr("SELECTION");
		var s_url="/fibrovolokno/catalog/list_2.php";
		s_data="PARENT_ID="+PARENT_ID+"&SECTION_ID="+SECTION_ID+"&SELECTION="+SELECTION+"&PAGEN_1="+PAGEN_1;
		//alert(PARENT_ID+" "+SECTION_ID);
		$.ajax({  
			type: "POST",
			url: s_url,  
			data: s_data, 
			cache: false,  
			success: function(html){ 
				$(".table_elo_row").animate({opacity: "0"},{queue:true, duration:300});
				setTimeout(function(){$(".table_elo_row").html(html);},300);
				$(".table_elo_row").animate({opacity: "1"},{queue:true, duration:300});	
			} 
		});
		$(".page_home .aaj").removeClass("active");
		$(this).addClass("active");
	});

	$(".table_elo").on("click", ".elo .name, .elo .img", function(){
		var obj_c = $('.content');
		var offset_c = obj_c.offset();
		var leftOffset_c = offset_c.left;
		var wb_c=obj_c.innerWidth();
		
		var obj_e = $(this).parent(".elo");
		var offset_e = obj_e.offset();
		var leftOffset_e = offset_e.left;
		
		var obj_d = obj_e.children(".detail_box");

		
		obj_d.css({"width":wb_c+"px", "left":(leftOffset_c-leftOffset_e)+"px"});
		if(obj_d.is(':hidden')) {
			$(".img").animate({height: "150px"},{queue:false, duration:500});
			obj_e.children(".img").animate({height: "330px"},{queue:false, duration:500});
			$(".elo").css({"margin-bottom":"30px"});
			$(".detail_box").css({"display":"none"});
			var hb_d=obj_d.innerHeight();
			obj_e.css({"margin-bottom":hb_d+"px"});
			obj_d.slideDown(500);
			
		}
		else  {
			obj_d.slideUp(500,function(){obj_e.css({"margin-bottom":"30px"});});
			obj_e.children(".img").animate({height: "150px"},500);
		}
		
		//obj_e.children(".img").css({"height":"100%"});
		//obj_e.children(".img").animate({height: "100%"},500);
		
	});
	
	$(".str_po .mod_po").on("click",".d_add", function(){
	
		$(this).blur();
		
		if(polto("all")) {
			var s_url="/fibrovolokno/orders/add_order.php";
			var s_data="";
			$(".str_po .mod_po input").each(function(i,elem) {
				s_data+=$(this).attr("name")+"="+$(this).val()+"&";
			});
			//alert(s_data);
			
			$.ajax({  
                type: "POST",
                url: s_url,  
				data: s_data, 
                cache: false,  
                success: function(html){ 
					//$("#res_ajax").html(html);
					if(html>0) {
						$(".str_po .mod_po .note_ok").css({"display":"block"});
						$(".str_po .mod_po .mod_form").css({"display":"none"});
						$(".calc_el .del").click();
						
					}
					else {
						if(html<0) alert("Ошибка проверочного кода");
						else alert("Ошибка сохранения заказа! Попробуйте позже.");
					}
                } 
            });
		}
	});
	
});
</script>
<?

if(!isset($_SESSION["ELEM_F"])){ 
	if(CModule::IncludeModule("iblock")){
		
		 $arFilter = Array('IBLOCK_ID'=>$IBLOCK_ID_P, 'GLOBAL_ACTIVE'=>'Y', 'CNT_ACTIVE'=>'Y');
		  $db_list = CIBlockSection::GetList(Array("sort"=>"asc"), $arFilter, true);
			$i=0;
		  while($ar_result = $db_list->GetNext())
		  {
			if($ar_result["IBLOCK_SECTION_ID"]) $k=$ar_result["IBLOCK_SECTION_ID"];
			else $k=0;
				$_SESSION["ELEM_F"]["menu"][$k][$i]["ID"]=$ar_result["ID"];
				$_SESSION["ELEM_F"]["menu"][$k][$i]["NAME"]=$ar_result["NAME"];
				$_SESSION["ELEM_F"]["menu"][$k][$i]["ELEMENT_CNT"]=$ar_result["ELEMENT_CNT"];
				$i++; 
							  
			 // echo "<pre>";print_r($ar_result[ELEMENT_CNT]);echo "</pre>";
			//echo $ar_result['ID'].' '.$ar_result['NAME'].': '.$ar_result['ELEMENT_CNT'].'<br>';
			$arSelect = array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "DETAIL_TEXT", "PROPERTY_name_before", "PROPERTY_name_after", "PROPERTY_size", "PROPERTY_features", "PROPERTY_forms_application", "PROPERTY_specification", "PROPERTY_price", "PROPERTY_in_stock", "PROPERTY_unit", "PROPERTY_logo", "PROPERTY_packing", "PROPERTY_price_packing");
			$arFilter = array(
				"IBLOCK_ID" => $IBLOCK_ID_P,
				"SECTION_ID" => $ar_result["ID"],
				"ACTIVE" => "Y",
			);
			$res = CIBlockElement::GetList(Array("property_in_stock"=>"asc,nulls","sort"=>"asc"), $arFilter, false, Array(), $arSelect); //
			while($ob = $res->GetNextElement()){ 
				 $arFields = $ob->GetFields();  
				//echo "<pre>";print_r($arFields);echo "</pre>";
				 $arProps = $ob->GetProperties();
				//echo "<pre>";print_r($arProps["in_stock"]);echo "</pre>";
				//$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]=$arFields;
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["ID"]=$arFields["ID"];
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["NAME"]=$arFields["NAME"];
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["PREVIEW_PICTURE"]=$arFields["PREVIEW_PICTURE"];
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["PREVIEW_PICTURE_SRC"]=CFile::GetPath($arFields["PREVIEW_PICTURE"]);
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["PREVIEW_TEXT"]=$arFields["PREVIEW_TEXT"];
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["DETAIL_TEXT"]=$arFields["~DETAIL_TEXT"];
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["PROPERTY_NAME_BEFORE_VALUE"]=$arFields["PROPERTY_NAME_BEFORE_VALUE"];
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["PROPERTY_NAME_AFTER_VALUE"]=$arFields["PROPERTY_NAME_AFTER_VALUE"];
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["PROPERTY_SIZE_VALUE"]=$arFields["PROPERTY_SIZE_VALUE"];
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["PROPERTY_FEATURES_VALUE"]=$arFields["~PROPERTY_FEATURES_VALUE"];
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["PROPERTY_FORMS_APPLICATION_VALUE"]=$arFields["~PROPERTY_FORMS_APPLICATION_VALUE"];
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["PROPERTY_SPECIFICATION_VALUE"]=$arFields["PROPERTY_SPECIFICATION_VALUE"];
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["PROPERTY_LOGO_VALUE"]=$arFields["PROPERTY_LOGO_VALUE"];
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["PROPERTY_PRICE_VALUE"]=str_replace(",",".",$arFields["PROPERTY_PRICE_VALUE"]);
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["PROPERTY_IN_STOCK_VALUE"]=$arFields["PROPERTY_IN_STOCK_VALUE"];
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["PROPERTY_UNIT_VALUE"]=$arFields["PROPERTY_UNIT_VALUE"];
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["PROPERTY_PACKING_VALUE"]=str_replace(",",".",$arFields["PROPERTY_PACKING_VALUE"]);
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["PROPERTY_PRICE_PACKING_VALUE"]=str_replace(",",".",$arFields["PROPERTY_PRICE_PACKING_VALUE"]);
				$_SESSION["ELEM_F"]["tov"][$ar_result["ID"]][$arFields["ID"]]["section_0"]=$k;
				
			}
		  }
		  		  
		
		//$arSelect = array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_to_section", "PROPERTY_url");
		$arSelect=Array();
		$arFilter = array("IBLOCK_ID" => $IBLOCK_ID_R, "ACTIVE" => "Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
		while($ob = $res->GetNextElement()){ 
			//$_SESSION["ELEM_F"]["ad_unit"]
			 $arFields = $ob->GetFields();  
			//echo "<pre>";print_r($arFields);echo "</pre>";
			 $arProps = $ob->GetProperties();
			//echo "<pre>";print_r($arProps);echo "</pre>";
			$_SESSION["ELEM_F"]["ad_unit"][$arFields["ID"]]["NAME"]=$arFields["NAME"];
			$_SESSION["ELEM_F"]["ad_unit"][$arFields["ID"]]["PREVIEW_TEXT"]=$arFields["PREVIEW_TEXT"];
			$_SESSION["ELEM_F"]["ad_unit"][$arFields["ID"]]["PREVIEW_PICTURE_SRC"]=CFile::GetPath($arFields["PREVIEW_PICTURE"]);
			$_SESSION["ELEM_F"]["ad_unit"][$arFields["ID"]]["to_section"]=$arProps["to_section"]["VALUE"];
			$_SESSION["ELEM_F"]["ad_unit"][$arFields["ID"]]["url"]=$arProps["url"]["VALUE"];
		}
	}
	$_SESSION["page_nav"]["countOnPage"]=$icp;
	$_SESSION["page_nav"]["index_ad_unit"]=6;
	$_SESSION["page_nav"]["add_anchor"]="#box_top";
}
 //echo "<pre>";print_r($_SESSION["ELEM_F"]["ad_unit"]);echo "</pre>";	
	
	//echo "<pre>";print_r($_SESSION["ELEM_F"]);echo "</pre>";	
?>

<div class="page_home">

	<div class="box_top"><a name="box_top"></a>
		<input type="hidden" id="PARENT_ID" value=""><input type="hidden" id="SECTION_ID" value="">
		<div class="logo"></div>
		<?foreach($_SESSION["ELEM_F"]["menu"][0] as $key_0 => $val_0) {?>
			<div class="menu job">
				<div class="menu_vu"><div class="gfel aaj" PARENT_ID="<?=$val_0["ID"]?>" SECTION_ID="0" PAGEN_1="0"><?=$val_0["NAME"]?> <sup><?=$val_0["ELEMENT_CNT"]?></sup></div></div>
				<?foreach($_SESSION["ELEM_F"]["menu"][$val_0["ID"]] as $key => $val) {?>
					<div class="pfel aaj" PARENT_ID="<?=$val_0["ID"]?>" SECTION_ID="<?=$val["ID"]?>" PAGEN_1="0"><?=$val["NAME"]?> <sup><?=$val["ELEMENT_CNT"]?></sup></div>
				<?}?>
			</div>
		<?}?>

	</div>
	<div class="both"></div>
	
	<div class="table_elo">	
		<? 
		// Подключаем модальное окно и js-скрипт каталога list_1.php
		$APPLICATION->IncludeFile(
			SITE_DIR."fibrovolokno/catalog/mod_list_2.php",
			Array(),
			Array("MODE"=>"html")
		);
		?>
		<div class="table_elo_row">
			<? // Подключаем каталог
			$APPLICATION->IncludeFile(
				SITE_DIR."fibrovolokno/catalog/list_2.php",
				Array(),
				Array("MODE"=>"html")
			);
			?>
		</div>
	</div>
	<div class="both"></div>
	<br />
	<? // Подключаем слайдер инстаграмм
	$APPLICATION->IncludeFile(
		SITE_DIR."fibrovolokno/include/inst_slider.php",
		Array(),
		Array("MODE"=>"html")
	);
	?>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>