<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
IncludeTemplateLangFile(__FILE__);
$curPage = $APPLICATION->GetCurPage(true);
?><!DOCTYPE html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?$APPLICATION->ShowTitle();?></title>
    <?
	$APPLICATION->ShowHead();
	//$APPLICATION->ShowCSS();
	//$APPLICATION->ShowHeadStrings();
	//$APPLICATION->ShowHeadScripts();
	//$APPLICATION->ShowMeta('keywords');
	//$APPLICATION->ShowMeta('description');
	?>
<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
    <meta charset="utf-8">
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/style.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/dico.css" type="text/css" media="screen">
	
    <!--<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/superfish.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/grid.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/colorbox.css" />-->
	

	
	
	
  <!--  <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/jquery-ui-1.9.2.custom.css" type="text/css" media="screen">-->
    <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.min.js"></script>

   <!-- <script src="<?=SITE_TEMPLATE_PATH?>/js/hoverIntent.js" type="text/javascript"></script>-->
   <!-- <script src="<?=SITE_TEMPLATE_PATH?>/js/superfish.js" type="text/javascript"></script>-->

    <!-- <script src="https://api-maps.yandex.ru/2.1/?load=package.standard,package.route&lang=ru-RU" type="text/javascript"></script>-->
	<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <!--<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>-->
	<!-- Замена шрифта
    <script src="<?=SITE_TEMPLATE_PATH?>/js/cufon-yui.js" type="text/javascript"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/js/cufon-replace.js" type="text/javascript"></script>
	-->
   <!-- <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.colorbox.js" type="text/javascript"></script>-->
	
<link type="text/css" href="<?=SITE_TEMPLATE_PATH?>/js/datetimepicker/jquery.datetimepicker.css" rel="Stylesheet" />
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/datetimepicker/jquery.datetimepicker.full.js"></script>

    <script type="text/javascript">
	
        $(document).ready(function(){
			
		var bw=$(window).width();
			var bh=$(window).height();
			
			$("#myMap").css({"width":bw+"px","height":bh+"px"});
			/*
            $('ul.sf-menu').superfish({
                delay:       800,
                animation:   {height:'show'},
                speed:       'normal',
                autoArrows:  false,
                dropShadows: false,
                disableHI: true
            });
			*/
            //$(".call-me").colorbox({iframe:true, width:"500px", height:"420px"});
			
			$(".call-center").click(function(){
				$(".w_menu, .order-form, .box_list_orders").css({"display":"none"});	
				$(".call-form").slideToggle(300,function(){if($(".call-form").is(':hidden') && $(".w_menu").is(':hidden')) {$(".order-form, .box_list_orders").slideToggle();}});	
				$(".capcha_box .div_capcha #new_capcha").click();
			});

			$(".capcha_box").on("click", ".div_capcha #new_capcha", function(){
				var form=$(this).parents(".capcha_box");
				var s_url="/multy_shipment/orders/new_capcha.php";
				$.ajax({  
					type: "POST",
					url: s_url,  
					data: "", 
					cache: false,  
					success: function(html){ 
						//$(".div_capcha").html(html);
						form.find(".div_capcha input[name=captcha_word]").val("").focus();
						form.find(".div_capcha input[name=captcha_code]").val(html);
						form.find(".div_capcha img").attr("src","/bitrix/tools/captcha.php?captcha_code="+html);
					} 
				});
			});	

				$(function() {
					$(window).scroll(function() {
						if($(this).scrollTop() >300) {
							$('#to_top').fadeIn();
						} else {
							$('#to_top').fadeOut();
						}
					});
					 
					$('#to_top').click(function() {
						$('body,html').animate({scrollTop:0},800);
					});
				});	
			$('.buda_form.form_hid').on("click", function(){
				$(".order-form,.row-3,.w_menu,.call-form").addClass("hid");
				$(".form_back").removeClass("hid");
			});
			$('.form_back').on("click", function(){
				$(this).addClass("hid");
				$(".order-form,.row-3,.w_menu,.call-form").removeClass("hid");
			});
        });
		
		function window_close() {
			$(".window_100").css({"display":"none"});
			$(".window_100 .window_item").css({"display":"none"});
		}
		function go_pay(order_id) {
			$.ajax({  
				type: "POST",
				url: "/multy_shipment/orders/payment/index.php",  
				data: "ORDER_ID="+order_id+"PAYMENT_ID="+order_id+"/1", 
				cache: false,  
				success: function(html){ 
					//$("#res_ajax").html(html);
					
					$(".window_100").css({"display":"block"});
					$(".window_100 .window_item").css({"display":"block"});
					$(".window_100 .window_pay").html(html);
				} 
			});
		}
    </script>

</head>

<body>
<div id="panel" data-site="<?=SITE_DIR;?>"><?//$APPLICATION->ShowPanel();?></div>
<div class="window_100"><div class="window_item"><div class="window_close dico dico_cross_8" onclick="window_close()"></div><div class="window_pay"></div></div></div>


		<div class="row-3">
			<div class="box_call-center">
				<div class="call-center b_shadow">
					<div class="dico dico_headset_8"></div>
					<div class="text-1"><div class="call-me"><?php echo GetMessage("CALL_ORDER");?></div></div>
					<strong class="text-2"> 
						<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_TEMPLATE_PATH."/include/phone.php"), false);?>
					</strong>
				</div>
				<div class="call-form b_shadow">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "/multy_shipment/orders/call_me.php"), false);?>
				</div>
			</div>
			<div class="box_menu b_shadow">
				<?$APPLICATION->IncludeComponent("bitrix:menu", "min_menu", array(
						"ROOT_MENU_TYPE" => "top",
						"MENU_CACHE_TYPE" => "Y",
						"MENU_CACHE_TIME" => "36000000",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(
						),
						"MAX_LEVEL" => "2",
						"CHILD_MENU_TYPE" => "left",
						"USE_EXT" => "N",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N"
					),
					false
				);
				?>
			</div>
			<div class="form_back b_shadow hid" title="показать форму"><div class="dico dico_r-indent_8"></div></div>
			<div class="buda_form b_shadow form_hid" title="скрыть форму"><div class="dico dico_l-indent_8"></div></div>
		</div>
   
    

<!--==============================content================================-->
<div id="res_ajax"></div>
<section id="content">
   
	<div class="wrapper">
  

    <!--==============================End content================================-->