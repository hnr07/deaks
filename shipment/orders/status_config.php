<?php
// наименования и цвета статусов
$ar_status=array(
	"N"=>array("Принят, ожидается оплата","#1b949c"), // Принят, ожидается оплата
	"NP"=>array("Принят, формируется отправка","#00803f"), // Принят, формируется отправка
	"P"=>array("Оплачен, формируется отправка","#808000"), // Оплачен, формируется отправка
	"DF"=>array("Отгружен, выполняется доставка","#8A2BE2"), // Отгружен
	"F"=>array("Выполнен","#006400"),  // Выполнен
	"C"=>array("Отменён","#c2bf9a") // Отменён
);

$ar_not_pay=array(1); // массив id служб доставки без предоплаты
?>