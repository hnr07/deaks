<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<? include "var_config.php"; ?>
<?// include "venue_array.php"; ?>
<?// include "hotel_array.php"; ?>
<?
global $USER;
if(!in_array($group_id, $USER->GetUserGroupArray())) echo "<meta http-equiv=\"refresh\" content=\"0;url=/\" />";
?>
<?$APPLICATION->SetTitle("Статистика мероприятия \"".$title_m."\"");?>
<?  CModule::IncludeModule('form'); // подключаем модуль форма ?>
<?if($_GET['print']!="Y") {?>
<style>
.meter_list {
	padding:20px;
	background-color:#fff;
		-moz-box-shadow:0px 0px 10px #000;
	-webkit-box-shadow:0px 0px 10px #000;
	box-shadow: 0px 0px 10px #000;
}
</style>
<?}?>
<style>
.meter_list .tidi{
	background-image: linear-gradient(to right, #b2b2b2, #fff 800px);
	color:#fff;
	padding-left:30px;
}
.meter_list table {
	border-collapse: collapse;
}
.meter_list table tr:first-child{
	background:#b2b2b2;
	color:#fff;
}
.meter_list table td,.meter_list table th{
	padding:10px;
	border:solid 1px #b2b2b2;
	
}
</style>
<br>
<div class="meter_list">

<? include "meter_hotel.php"; ?>
<?if($_GET['print']!="Y") {?>
<div style="float:left;"><h3><?$APPLICATION->ShowTitle();?></h3></div>
<div style="float:right;"><a href=<?=($_GET['print']=="Y")?"javascript:print();":"?print=Y";?>><img src="/images/priner_ico.png" alt="печать" title="печать"></a></div>
<?}?>
<div style="clear: both;"></div>
<div class="tidi">Статистика по отелям</div>
<?
foreach($sum_nom_os as $k_venue => $val_venue) {?>
<h3><?=$ar_vlm[$k_venue]["name"]?></h3>
<table>
<tr><td>Отель</td><td>По типам номеров</td><td>количество номеров</td><td>бронь</td><td>Номеров занято</td><td>Номеров свободно</td></tr>
	<?
	asort($val_venue);
	
	foreach($val_venue as $k_hotel => $val_hotel) {?>
		<tr><th><?=$ar_hot[$k_venue]["hotel"][$k_hotel]["name"]?> (<?=$ar_ven_sum[$k_venue][$k_hotel]?>)</th><td>
		<?
		asort($val_hotel);
		//echo "<pre>"; print_r($val_hotel); echo "</pre>";
		foreach($ar_ven[$k_venue][$k_hotel] as $k_nomer => $val_nomer) {?>
		<?//$sum_nom+=ceil($ar_ven_nom[$k_venue][$k_hotel][$k_nomer])?>
			<?=$ar_hot[$k_venue]["nomer"][$k_nomer]["note"];?>: <b><?=$val_nomer?>/<?=ceil($ar_ven_nom[$k_venue][$k_hotel][$k_nomer])?></b> <br />
		<?}?>
		
		
		</td>
		<td><?=$ar_knora[$k_venue]["hotel"][$k_hotel]["quantity"]?></td><td><?=$ar_bron[$k_venue]["hotel"][$k_hotel]["reserv"]?></td><td><?=$sum_nom[$k_venue][$k_hotel]?></td><td><?=$sum_nom_os[$k_venue][$k_hotel]?></td>
		</tr>
	<?}?>
</table>
<?	
}

?>


<br /><br /> 
<? include "meter_fly.php"; ?>
<div class="tidi">Статистика по перелётам</div>

<?
foreach($sum_fly_os as $k_venue => $val_venue) {?>
<h3><?=$ar_vlm[$k_venue]["name"]?></h3>
<table>
<tr><td>Маршрут</td><td>количество мест</td><td>бронь</td><td>Мест занято</td><td>Мест свободно</td></tr>
	<?
	ksort($val_venue);
	foreach($val_venue as $k_nap => $val_fly) {?>
		<?
		ksort($val_fly);
		//$sum_nom=0;
		foreach($val_fly as $k_fly => $val_m) {?>
		<tr>
		<?//$sum_nom+=ceil($ar_ven_nom[$k_venue][$k_hotel][$k_nomer])?>
			<th><?=$ar_fly[$k_venue][$k_nap][$k_fly]["name"];?>:</th>
			<td><?=$ar_fly[$k_venue][$k_nap][$k_fly]["quantity"]?></td>
			<td><?=$ar_fly[$k_venue][$k_nap][$k_fly]["reserv"]?></td>
			<td><?=$sum_fly[$k_venue][$k_nap][$k_fly]?></td>
			<td><?=$sum_fly_os[$k_venue][$k_nap][$k_fly]?></td>
		</tr>	
		<?}?>
		
		
	
	<?}?>
</table>
<?	
}

?>


</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>