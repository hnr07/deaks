<div class="block-place">
	<div class="center-wrapper">
		<div class="place-content">
			<div class="clearfix">
				<a name="mesto_provedeniya"></a>
				<div class="place-descr">
					<div class="cont">
						<div ><h2>19-27 февраля<br />МАСТЕРСКИЕ КАНИКУЛЫ</h2>
						<h3>Место проведения</h3>
						<p>CARLTON INTERCONTINENTAL CANNES<br />58, La Croisette<br />06414 Cannes Cedex - France</p></div>
						<div class="place-map-trigger" data-offtext="На карте" data-ontext="Обратно">
						<img src="/images/ico-place.png" class="ico"><span class="text">На карте</span>
						</div>
					</div>
				</div>
				<div class="place-map" id="placeMapCont"></div>                                    
				<script type="text/javascript">
					function initializePlaceMap() {
						var mapOptions = {
						zoom: 17,
						center: new google.maps.LatLng(43.549518, 7.027051),//(55.695548, 37.39054),
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
					google.maps.event.addDomListener(window, 'load', initializePlaceMap);
				</script>
			</div>
		</div>
	</div>
</div>