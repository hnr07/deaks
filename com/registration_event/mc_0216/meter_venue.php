<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Статистика по площадкам");
?>
<?

include "meter_vm.php";
global $USER;
if(!in_array($group_id, $USER->GetUserGroupArray())) echo "<meta http-equiv=\"refresh\" content=\"0;url=/\" />"; 
?>
<style>
.meter_list {
	padding:20px 0px;
	font-size:90%;
}
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
.meter_list .osc{
	font-size:16pt;
}
</style>
<br/>
<div class="meter_list">
<div align="right"><a href=<?=($_GET['print']=="Y")?"javascript:print();":"?print=Y";?>><img src="/images/priner_ico.png" alt="печать" title="печать"></a></div>
<div class="tidi">Статистика наличия мест по площадкам - <? echo date("d.m.Y H:i:s");?></div>

<i>Обработаны статусы: "Подтверждена", "Ожидает промоушен", "Ожидает оплаты", "Истёк срок оплаты", "Резерв".</i>
<table>
<tr><th>ID площадки</th><th>Площадка</th><th>Статусы</th><th>Всего зарегистрировано</th><th>Мест в наличии</th><th>Бронь</th><th>Остаток мест</th></tr>
<?
$ia=count($ar_venue_mesto);
$obs=0;
$ar_obs=array();
foreach ($ar_venue_mesto as $k_vm => $v_vm) {
	?>
<tr><td><?=$k_vm?></td><td><b><?=$v_vm["name"]?></b></td><td>
<?	

	foreach($v_vm["status"] as $k=>$val) {
		
		echo $k." &#8212; ";
		echo "<b>".$val."</b><br />";
		$ar_obs[$k]+=$val;
		//unset($astatus);

	}
	
?>
</td><td class="osc"><?=$v_vm["reg"]?></td>
<td class="osc"><?=$v_vm["mesto"]?></td>
<td class="osc"><?=$v_vm["bron"]?></td>
<td class="osc"><?=$v_vm["ostatok"]?></td>
</tr>
<?
$obs+=$v_vm["reg"];

	
	
}

?>

<tr><th colspan="2">Все площадки</th><th>
<?
foreach($ar_obs as $v_k=>$v_val) {
	echo $v_k." &#8212; ";
		echo "<b>".$v_val."</b><br />";
}
?>
</th><th class="osc"><?=$obs?></th>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

</table>
</div>
<?//echo "<pre>";print_r($ar_venue_mesto);echo "</pre>";?>
<br/><br/><br/><br/>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>