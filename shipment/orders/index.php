<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои заказы");
?>

<div class="my_orders">
<div id="myMap"></div>
	<div class="box_order box_list_orders b_shadow">
		<div class="title">Мои заказы</div>
		<div class="my_orders_list">

		</div>
		<div class="my_auth">
			<div class="row">
				<span>Ваш номер телефона</span>
				<input type="text" id="my_phone" value="<?=$_SESSION["PHONE"]?>" />
				<div class="loader loader_orders"><img src="/shipment/images/loader_35.gif" /></div>
				<button type="button" class="obutton history">История</button><button type="button" class="obutton active_orders">Выбрать</button>
			</div>
		</div>
		
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){

	var myMap;
	var myPlacemark_f;
	var myPlacemark_s;
	var multiRoute;
	ymaps.ready(function () {

		  //geolocation = ymaps.geolocation,
						  // coords = [geolocation.latitude, geolocation.longitude],
							//alert(geolocation.latitude);
							myMap = new ymaps.Map("myMap", {
								//center: [geolocation.latitude, geolocation.longitude],
								center: [55.753215,37.622504], // Москва
								zoom: 10,
								controls: ['smallMapDefaultSet','zoomControl', 'searchControl', 'typeSelector',  'fullscreenControl']
							}, {
								searchControlProvider: 'yandex#search',
								suppressMapOpenBlock:true, 
								geolocationControlFloat: 'right',
								searchControlFloat: 'right',
								zoomControlFloat: 'none',
								zoomControlPosition: {bottom: '50px', right: '30px'}
							});
							// Отступ слева.
							myMap.margin.addArea({
								left: 0,
								top: 0,
								width: "320px",
								height: "100%"
							});
								
							// Сдвинем карту на 160 пикселей вправо
							var position = myMap.getGlobalPixelCenter();
							myMap.setGlobalPixelCenter([ position[0] - 160, position[1] ]);	
							/*
							 geolocation.get({
								provider: 'yandex',
								//mapStateAutoApply: true
							}).then(function (result) {
								//myMap.geoObjects.add(result.geoObjects);
								//alert(result.geoObjects.get(0).geometry.getCoordinates()[0]);
								myMap.setCenter(result.geoObjects.get(0).geometry.getCoordinates());
							});
							*/
					myMap.controls.add('zoomControl');
					
					
					$(".my_orders_list").on("click",".row_list", function(){
						var order_id=$(this).attr("order_id");
						var fio=$(this).children(".fio").val();
						var address_f=$(this).children(".to_adr").html();
						var gruz=$(this).children(".gruz").html();
						var str_coords_f=$(this).children(".to_adr_coords").val();
						var arr_coords_f=str_coords_f.split(",");
						var address_s=$(this).children(".since_name").val();
						var str_coords_s=$(this).children(".since_coords").val();
						var arr_coords_s=str_coords_s.split(",");
						var color_icon=$(this).children(".color_icon").val();
						var route_flag=$(this).children(".route_flag").val();
						//alert(arr_coords[0]+"\n"+arr_coords[1]);
						
						myMap.geoObjects.removeAll();
						
							myPlacemark_f = new ymaps.Placemark([arr_coords_f[0],arr_coords_f[1]], {
								
								iconCaption: 'поиск...'
							}, {
								draggable: false,
								//preset: 'islands#violetDotIconWithCaption',
								//preset: 'islands#violetDeliveryIcon',
								preset: 'islands#grayHomeIcon',
								iconColor: color_icon,
							});
							myMap.geoObjects.add(myPlacemark_f);
						
						
						myPlacemark_f.properties
								.set({
									// Формируем строку с данными об объекте.
									iconCaption: fio+" заказ:"+order_id,
									// В качестве контента балуна задаем строку с адресом объекта.
									balloonContent: address_f+"<div style='text-align:center;'>"+gruz+"</div>",
									
								});
						
						if(str_coords_s!='') {
							
						
								myPlacemark_s = new ymaps.Placemark([arr_coords_s[0],arr_coords_s[1]], {
								
								iconCaption: 'поиск...'
								}, {
									draggable: false,
									//preset: 'islands#violetDotIconWithCaption',
									preset: 'islands#grayDeliveryIcon',
									iconColor: color_icon,
									//preset: 'islands#violetHomeIcon',
								});
									myMap.geoObjects.add(myPlacemark_s);
							
							myPlacemark_s.properties
								.set({
									// Формируем строку с данными об объекте.
									iconCaption: address_s,
									// В качестве контента балуна задаем строку с адресом объекта.
									balloonContent: gruz
								});
							myMap.geoObjects.add(myPlacemark_s);
							
									//маршрут
								if(route_flag=="1") {	
									multiRoute = new ymaps.multiRouter.MultiRoute({
										// Описание опорных точек мультимаршрута.
										referencePoints: [
											[arr_coords_s[0],arr_coords_s[1]],
											[arr_coords_f[0],arr_coords_f[1]]
										],
										// Параметры маршрутизации.
										params: {
											// Ограничение на максимальное количество маршрутов, возвращаемое маршрутизатором.
											results: 1
										}
									}, {
										// Автоматически устанавливать границы карты так, чтобы маршрут был виден целиком.
										boundsAutoApply: true,
										wayPointVisible:false,
										balloonLayout: false,
										balloonPanelMaxMapArea: 0,
										// Внешний вид линии маршрута.
										routeActiveStrokeWidth: 4,
										routeActiveStrokeColor: color_icon,
									});
									// Добавляем мультимаршрут на карту.
									myMap.geoObjects.add(multiRoute);
								}
								else {
									myMap.setBounds(myMap.geoObjects.getBounds());
									var position = myMap.getGlobalPixelCenter();
									myMap.setGlobalPixelCenter([ position[0] - 160, position[1] ]);
								}
						}
						else {
						 
							//myMap.geoObjects.remove(myPlacemark_s);
							//myMap.geoObjects.remove(multiRoute);
							// Точку куда в центр
							myMap.setCenter([arr_coords_f[0],arr_coords_f[1]]);
							// Сдвинем карту на 160 пикселей вправо
							var position = myMap.getGlobalPixelCenter();
							myMap.setGlobalPixelCenter([ position[0] - 160, position[1] ]);
						}
						
						//myMap.geoObjects.remove(multiRoute);
					});
					
					

	});

	$('.my_auth').on("click", ".active_orders", function(){
		var my_phone=$("#my_phone").val();
		if(my_phone!="") {
			$(".box_order .active_orders").css({"display":"none"});
			$("#my_phone").css({"background-color":"#fff"});
			var but=$(this);
			var data="my_phone="+my_phone;
			var url="/shipment/orders/list_orders.php";
			$.ajax({  
				type: "POST",
				url: url,  
				data: data, 
				cache: false,  
				success: function(html){ 
					//$("#res_ajax").html(html);
					
					if(html!="") {
						myMap.geoObjects.removeAll();
						$(".box_list_orders .my_orders_list").html(html);
						but.html("Обновить");
						
					}
					else {
						$(".box_list_orders .my_orders_list").html("<span style='color:#f37741'>Заказы не найдены</span>");
						but.html("Выбрать");
					}
					$(".box_order .active_orders").css({"display":"block"});
				} 
			});
		}
		else {$("#my_phone").css({"background-color":"#f9b5b6"});}
		
		return false;
	});
		
	$('.my_auth').on("click", ".history", function(){
		var my_phone=$("#my_phone").val();
		if(my_phone!="") {
			window.location.href = "/shipment/orders/history_orders.php?my_phone="+my_phone;
		}
		else {$("#my_phone").css({"background-color":"#f9b5b6"});}
	});
		
	$("#my_phone").bind("change keyup input click", function() {
		var input=$(this);
		if (this.value.match(/[^0-9]/g)) {
			var et=this.value.replace(/[^0-9+)(-]/g, '');
			this.value = et;
		}
	});
	
	
	
});

</script>
<?if($_SESSION["PHONE"]!="") {?>
	<script type="text/javascript">setTimeout(function(){$('.my_auth .active_orders').click();},1000);</script>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>