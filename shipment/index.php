<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Битрикс и Яндекс-карты");
//$APPLICATION->SetPageProperty("MAIN_INDEX_PAGE", "YES");
?>

<script type="text/javascript">
		$(document).ready(function(){
			 var myMap;
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
					var gruz = $("#WHAT_CARRING option:selected").text();
					var quan = $("#QUANTITY").val();
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
								balloonContent: address+"<div style='text-align:center;'>Везём сюда "+gruz+" - "+quan+" м<sup>3</sup></div>"
							});
						$("#TO_ADR").val(address);
						$("#control_adr").val(address);	// контрольное поле с адресом					
						$("#TO_ADR_COORDS").val(coords);
						calc_delivery(coords);
						
								

					});
				}
				
				
				// Определяем координаты по адресу (прямое геокодирование).
				function getPos(coords,apos) {
					var gruz = $("#WHAT_CARRING option:selected").text();
					var quan = $("#QUANTITY").val();
					$("#control_adr").val(apos);	// контрольное поле с адресом
					myPlacemark.properties.set('iconCaption', 'поиск...');
					myPlacemark.properties
						.set({
							// Формируем строку с данными об объекте.
							iconCaption: apos,
							balloonContent: apos+"<div style='text-align:center;'>Везём сюда "+gruz+" - "+quan+" м<sup>3</sup></div>"
						});	
					myMap.setCenter(coords);
					// Сдвинем карту на 160 пикселей вправо
					var position = myMap.getGlobalPixelCenter();
					myMap.setGlobalPixelCenter([ position[0] - 160, position[1] ]);
					$("#TO_ADR_COORDS").val(coords);
					calc_delivery(coords);
				}
				
				
				
				function calc_delivery(coords) {
					var str_shipment=$("#WHAT_CARRING option:selected").attr("str_shipment");
					var price_km=$("#WHAT_CARRING option:selected").attr("price_km")*1;
					var price_km_min=$("#WHAT_CARRING option:selected").attr("price_km_min")*1;
					var capacity=$("#WHAT_CARRING option:selected").attr("capacity")*1;
					if(str_shipment!="") {
						var ar_shipment=str_shipment.split("|");
						//alert(ar_shipment.length);
						var arr=[];
						var val=[];
						var min=0;
						var il=0;
						$.each(ar_shipment,function(index,value){
							//alert(">>> "+index);
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
										var c_car=$("#COUNT_CAR").val();
										$("#COUNT_CAR").attr("price_delivery",price_delivery);
										$("#COUNT_CAR").next(".dinput").html(c_car+" &#215; "+number_format(price_delivery,0,"."," ")+" &#8381;");
										var sum_delivery=price_delivery*c_car;
										$("#PRICE_DELIVERY").val(sum_delivery);
										$("#PRICE_DELIVERY").next(".dinput").children("span").html(number_format(sum_delivery,0,"."," "));
										var p_elm=$("#PRICE").val()*1;
										var ps=p_elm+sum_delivery*1;
										$("#SUM").val(ps);
										$("#SUM").next(".dinput").children("span").html(number_format(ps,0,"."," "));
										$("#FROM_ADR_COORDS").val(val[ar_kmj[1]]);
										$("#DISTANCE").val(km);
									}
									il++;								
								}
								
							);
						});
							
						
					}
					else return 0;
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
				
				$("#form_order #WHAT_CARRING, #form_order #QUANTITY, #form_order .box_quantiti").on("change click input oninput blur",function(){
				if($("#TO_ADR_COORDS").val()!="") {
					var address=$("#TO_ADR").val();
					var gruz = $("#WHAT_CARRING option:selected").text();
					var quan = $("#QUANTITY").val();
					myPlacemark.properties
						.set({
							balloonContent: address+"<div style='text-align:center;'>Везём сюда "+gruz+" - "+quan+" м<sup>3</sup></div>"
						});	
					
					calc_delivery($("#TO_ADR_COORDS").val());
				}
				});

			});

		});
				
    </script>

      

				<div id="myMap"></div>
				<div class="order-form b_shadow">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "orders/order.php"), false);?>
				</div>

    
	<?if(isset($_POST["repetition"])) {?>

<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>