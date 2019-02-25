<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYBdT1kApBqs5Wx6k148DD9Ua7J7vhZNQ&signed_in=true&language=ru"></script>
<div class="block-place">
	<div class="center-wrapper">
		<div class="place-content">
			<div class="clearfix">
				<a name="mesto_provedeniya"></a>
				<div class="place-descr">
					<div class="cont">
						<div ><br /><br /><br /><br /><h2>19-27 февраля 2016<br /><br /><span style="font-size:35px;font-family:'romul';">Место проведения</h2><br /><br />
						<!--<h3>Место проведения</h3>-->
						<p style="font-size:25px;letter-spacing:2px;line-height: 48px;">INTERCONTINENTAL CARLTON CANNES<br />58, La Croisette<br />06414 Cannes Cedex - France</p></div>
						<div class="place-map-trigger" data-offtext="На карте" data-ontext="Обратно" onclick="f_tmap()">
						<!--<img src="/images/ico-place.png" class="ico">-->
						<span class="text">На карте</span>
						</div>
						<br /><br />
						</div>
				</div>
				<div class="place-map" id="placeMapCont"></div>                                    
				<script type="text/javascript">
				
				//initializePlaceMap();
					//google.maps.event.addDomListener(window, 'load', initializePlaceMap);
					
			
				</script>
				<script>

	$(document).ready(function() {
			setTimeout(function(){initializeMap();}, 1000);
		});
			function initializeMap() {//alert(11);
			 var latlng = new google.maps.LatLng(43.549518, 7.027051);
						var mapOptions = {
							zoom: 17,
							center: latlng,//(55.695548, 37.39054),
							mapTypeId: google.maps.MapTypeId.ROADMAP,
							scrollwheel: false,
							  disableDefaultUI: true,
							  panControl: false,
							  zoomControl: true,
							  scaleControl: false,
							  zoomControlOptions: {
								style: google.maps.ZoomControlStyle.LARGE,
								position: google.maps.ControlPosition.RIGHT_TOP
							}
						}
						var map = new google.maps.Map(document.getElementById("placeMapCont"),
						mapOptions);

						var image = '/images/map-pin.png';
						var myLatLng = new google.maps.LatLng(43.549518, 7.027051);//(55.695548, 37.39054);
						var beachMarker = new google.maps.Marker({
							position: myLatLng,
							map: map,
							icon: image
						});

					}
				
</script>			
							
			</div>
		</div>
	</div>
</div>