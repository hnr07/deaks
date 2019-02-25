<?define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Битрикс и Яндекс-карты");
?>
<style>
.aui {
	display:inline-block;
	float:left;
	width:300px;
	text-align:center;
	text-decoration:none;
	padding:10px;
	margin:10px;
	-moz-box-shadow: 0px 0px 5px #623790;
-webkit-box-shadow: 0px 0px 5px #623790;
box-shadow: 0px 0px 5px #623790;
}
p {text-align:justify;text-indent:30px;line-height:20px;}
</style>
<p>
Взаимодействи API Битрикс и сервиса <a href="https://tech.yandex.ru/maps/" target="_blank">API Яндекс.Карт</a> на примере сайта доставки сыпучих строительных материалов. 
</p>
<a class="aui" href="/shipment/" target="_blank">
<p>
Простой вариант для одного товара. Товар может иметь несколько мест отгрузки. Расчёт доставки от ближайшего к месту доставки места отгрузки.
</p>
<img src="shipment.jpg">

</a>
<a class="aui" href="/multy_shipment/" target="_blank">
<p>

Вариант для нескольких товаров, разных типов плательщиков. Каждый товар может иметь несколько мест отгрузки. Расчёт доставки по каждому товару от ближайшего к месту доставки места отгрузки. Адаптирован для смартфона.
<br />
</p>
<img src="multy_shipment.jpg">

</a>
<div class="clear-all"></div>
<br /><br /><br /><br /> <br /><br /><br /><br />
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
