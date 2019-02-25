<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("#ЯВЕЗУ / +7926 222 8 999 / ДОСТАВКА #ЯПЕСОК  #ЯЩЕБЕНЬ  #ЯГРУНТ");
//$APPLICATION->SetPageProperty("MAIN_INDEX_PAGE", "YES");
?>

<script type="text/javascript">
var myMap;
		$(document).ready(function(){
			
			//var myMap;
            //var geolocation;
			var myPlacemark;
			
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
						myMap.container.fitToViewport();
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
				
				var suggestView = new ymaps.SuggestView('TO_ADR',{boundedBy: [[56.751308, 35.534150], [54.223057, 40.495152]]});
				$('#TO_ADR').on( 'focus', function() {suggestView.options.set({results:15});});
				$('#TO_ADR').on( 'blur', function() {suggestView.options.set({results:-1});});
				suggestView.options.set({results:15});
				suggestView.events.add('select', function (event) {
										
					var apos=event.get('item').value;
					var myGeocoder = ymaps.geocode(apos);
					
					var coords;
					myGeocoder.then(
						function (res) {
							coords=res.geoObjects.get(0).geometry.getCoordinates();
							//alert(coords);
							myMap.geoObjects.removeAll();
								myPlacemark = createPlacemark(coords);
								myMap.geoObjects.add(myPlacemark);
								getPos(coords,apos);
								// Слушаем событие окончания перетаскивания на метке.
							myPlacemark.events.add('dragend', function () {
									//var coords = e.get('coords');
									var coords=myPlacemark.geometry.getCoordinates();
									getAddress(coords);
								});
						}
					);	
											
				});
				

				// Слушаем клик на карте.
				myMap.events.add('click', function (e) {
					var coords = e.get('coords');

					// Если метка уже создана – просто передвигаем ее.
					if (myPlacemark) {
						myPlacemark.geometry.setCoordinates(coords);
					}
					// Если нет – создаем.
					else {
						myPlacemark = createPlacemark(coords);
						myMap.geoObjects.add(myPlacemark);
						// Слушаем событие окончания перетаскивания на метке.
						myPlacemark.events.add('dragend', function () {
							getAddress(myPlacemark.geometry.getCoordinates());
						});
					}
					getAddress(coords);
				});
				
		
					 // Создание метки.
				function createPlacemark(coords) {
					return new ymaps.Placemark(coords, {
						
						iconCaption: 'поиск...'
					}, {
						preset: 'islands#violetDotIconWithCaption',
						draggable: true
					});
				}

				// Определяем адрес по координатам (обратное геокодирование).
				
				function getAddress(coords) {
					
					var ggt='';
					$(".container_elem .elem_box").each(function(){
						var gruz = $(this).find(".WHAT_CARRING").val();
						var quan = $(this).find(".QUANTITY").val();
						ggt+="&bull; "+gruz+"("+quan+"м<sup>3</sup>) ";
					});
					myPlacemark.properties.set('iconCaption', 'поиск...');
					ymaps.geocode(coords).then(function (res) {
						var firstGeoObject = res.geoObjects.get(0);
						var address=firstGeoObject.getAddressLine();
						//alert(address);
						myPlacemark.properties
							.set({
								// Формируем строку с данными об объекте.
								iconCaption: [
									// Название населенного пункта или вышестоящее административно-территориальное образование.
									firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
									// Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
									firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
								].filter(Boolean).join(', '),
								// В качестве контента балуна задаем строку с адресом объекта.
								balloonContent: address+"<div style='text-align:center;'>Везём сюда "+ggt+"</div>"
							});
						$("#TO_ADR").val(address);
						$("#control_adr").val(address);	// контрольное поле с адресом					
						$("#TO_ADR_COORDS").val(coords);
						calc_delivery_all(coords);
						
								

					});
				}
				
				
				// Определяем координаты по адресу (прямое геокодирование).
				function getPos(coords,apos) {
					var ggt='';
					$(".container_elem .elem_box").each(function(){
						var gruz = $(this).find(".WHAT_CARRING").val();
						var quan = $(this).find(".QUANTITY").val();
						ggt+="&bull; "+gruz+"("+quan+"м<sup>3</sup>) ";
					});
					$("#control_adr").val(apos);	// контрольное поле с адресом
					myPlacemark.properties.set('iconCaption', 'поиск...');
					myPlacemark.properties
						.set({
							// Формируем строку с данными об объекте.
							iconCaption: apos,
							balloonContent: apos+"<div style='text-align:center;'>Везём сюда "+ggt+"</div>"
						});	
					myMap.setCenter(coords);
					// Сдвинем карту на 160 пикселей вправо
					var position = myMap.getGlobalPixelCenter();
					myMap.setGlobalPixelCenter([ position[0] - 160, position[1] ]);
					$("#TO_ADR_COORDS").val(coords);
					calc_delivery_all(coords);
				}
				
				
				
				
				
				setTimeout(repetition_create(),1000);
				function repetition_create() {
					var str_coords=$("#TO_ADR_COORDS").val();
					
					if(str_coords!='') {
						var arr_coords=str_coords.split(",");
						var apos=$("#TO_ADR").val();
						myPlacemark = createPlacemark([arr_coords[0],arr_coords[1]]);
						myMap.geoObjects.add(myPlacemark);
						getPos([arr_coords[0],arr_coords[1]],apos);
					}
					
				}
				
				$(".window_100 .window_mym").on("click", ".el_mym", function(){
					var addr=$(this).text();
					var coords=$(this).attr("coords");
					$("#TO_ADR").val(addr);
					$("#control_adr").val(addr);
					$("#TO_ADR_COORDS").val(coords);
					myMap.geoObjects.removeAll();
					repetition_create();
					window_close();
				});
				
				$("#form_order").on("change click input oninput blur", ".WHAT_CARRING, .QUANTITY, .box_quantiti",function(){
				
					if($("#TO_ADR_COORDS").val()!="") {
						var address=$("#TO_ADR").val();
						var ggt='';
						$(".container_elem .elem_box").each(function(){
							var gruz = $(this).find(".WHAT_CARRING").val();
							var quan = $(this).find(".QUANTITY").val();
							ggt+="&bull; "+gruz+"("+quan+"м<sup>3</sup>) ";
						});
						myPlacemark.properties
							.set({
								balloonContent: address+"<div style='text-align:center;'>Везём сюда "+ggt+"</div>"
							});	
						
						calc_delivery_all($("#TO_ADR_COORDS").val());
					}
					
				});
				
				// подгоняем карту при изменении окна
				$(window).resize(function(){
					var hw=$(window).height();
					var ww=$(window).width();
					//alert(hw);
					$("#myMap").css({"height":hw+"px","width":ww+"px"});
					myMap.container.fitToViewport();
				});
				
				
				//getPos([55.753215,37.622504],"aaa");
			});
			
			// подгоняем карту, если страница больше окна
			var hw=$(window).height();
			var blockHeight = $('.order-form').outerHeight()+120;
			
			if(hw>blockHeight) {blockHeight=hw;}
			$("#myMap").css({"height":blockHeight+"px"});

		});
		
	// подгоняем карту при изменении размера формы заказа	
	function height_map() {
		var hw=$(window).height();
		var blockHeight = $('.order-form').outerHeight()+120;
		if(hw>blockHeight) {blockHeight=hw;}
		$("#myMap").css({"height":blockHeight+"px"});
		myMap.container.fitToViewport();
	}
	
	// расчёт перевозки отдельной позиции
	function calc_delivery(coords,t) {
				
		var str_shipment=t.find(".WHAT_CARRING").attr("str_shipment");
		var price_km=t.find(".WHAT_CARRING").attr("price_km")*1;
		var price_km_min=t.find(".WHAT_CARRING").attr("price_km_min")*1;
		var capacity=t.find(".WHAT_CARRING").attr("capacity")*1;
		var q = t.find(".QUANTITY").val();
		
		if(str_shipment!="") {
			var ar_shipment=str_shipment.split("|");
			
			var arr=[];
			var val=[];
			var min=0;
			var il=0;
			$.each(ar_shipment,function(index,value){
				//alert(">>> "+index);
					//alert(coords+" | "+value);
				ymaps.route([coords, value]).then(
					function (route) {
					  //  myMap.geoObjects.add(route);
						var routeLength = route.getLength()/1000; // Длина маршрута
										//alert(routeLength);
						arr[index]=Math.ceil(routeLength);	
						val[index]=value;
						//alert(">>> "+arr[index]);	
						//alert(il);	
						if(il==ar_shipment.length-1) {
							var kmj=getMinValue(arr);
							//alert(kmj);
							var ar_kmj=kmj.split("|");
							var km=ar_kmj[0]*1;
							var price_delivery=price_km*km;
							//alert(price_km+" "+getMinValue(arr));
							if(price_delivery<price_km_min) price_delivery=price_km_min;
							var c_car=t.find(".COUNT_CAR").val();
							t.find(".COUNT_CAR").attr("price_delivery",price_delivery);
							//$(this).find("[name=COUNT_CAR]).next(".dinput").html(c_car+" &#215; "+number_format(price_delivery,0,"."," ")+" &#8381;");
							var sum_delivery=price_delivery*c_car;
							t.find(".PRICE_DELIVERY").val(sum_delivery);
							//$(this).find("[name=PRICE_DELIVERY]").next(".dinput").children("span").html(number_format(sum_delivery,0,"."," "));
							var p_elm=t.find(".PRICE").val()*1;
							var ps=p_elm+sum_delivery*1;
							t.find(".SUM").val(ps);
							t.find(".SUM").next(".dinput").children("span").html(number_format(ps,0,"."," "));
							var pm=Math.round(ps/q);
							
							t.find(".PRICE_MEASURE").val(pm);
							t.find(".PRICE_MEASURE").next(".dinput").children("span").html(number_format(pm,0,"."," "));
							t.find(".FROM_ADR_COORDS").val(val[ar_kmj[1]]);
							t.find(".DISTANCE").val(km);
							
							//to_pay();
						}
						il++;	
							to_pay();								
					}
					
				);
				
			});
				
				
		}
					
				
	}
	
	// расчёт перевозки всех позиций
	function calc_delivery_all(coords) {
		$(".container_elem .elem_box").each(function(){
			calc_delivery(coords,$(this));
		});
	}
	// получение минимального элемента массива
	function getMinValue(array){
		var min = array[0];
		var j=0;
		for (var i = 0; i < array.length; i++) {
			if (min > array[i]) {min = array[i];j=i;}
		}
		//alert(min);
		return min+"|"+j;
	}	
	// расчёт суммы к оплате
	function to_pay() {
		var tp=0;var tpd=0;
		$(".container_elem .elem_box").each(function(){
			var s=$(this).find(".SUM").val()*1;
			tp+=s;
			var pd=$(this).find(".PRICE_DELIVERY").val()*1;
			tpd+=pd;
		});
		$("[name=TO_PAY_DELIVERY]").val(tpd);
		$("[name=TO_PAY]").val(tp);
		$("[name=TO_PAY]").next(".dinput").children("span").html("<b>"+number_format(tp,0,"."," ")+"</b>");
	}
	
</script>

      

				<div id="myMap"></div>
				
				<div class="order-form">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "orders/order.php"), false);?>
				</div>

    
	<?if(isset($_POST["repetition"])) {?>

<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>