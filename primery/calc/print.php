<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludePublicLangFile(__FILE__);?>
<p>

<img src="/images/dls/dlslogo.svg" class="logo" width="120" height="30" align="top"><span>https://4dls.pro/</span>
<button type="button" id="but_print" onclick="print_doc()"><?=GetMessage("print");?></button>
</p>
<?
$ar_calc=(array)json_decode($_GET["calc_par"]);
$ar_date=(array)json_decode($_GET["data_par"]);

//echo "<pre>";print_r($ar_calc);"</pre>";
//echo "<pre>";print_r($ar_date);"</pre>";
?>

<style>
button {
	border:solid 2px #000;
	background-color:#fff;
	color:#000;
	height:30px;
	width:230px;
	margin-left:50px;
	cursor:pointer;
}
.logo {
	width:120px;
	height:30px;
	margin-right:30px;
}
p {

	padding:0px 10px;	
}
p span {
	font-size:20px;;	
}
table {
	border-collapse: collapse;
}
table td, table th{
	border:solid 1px #000;
	padding:5px 10px;
	border-collapse: collapse;
}
table td{
	text-align:right;
}
</style>
<script>
	function print_doc() {
		document.getElementById("but_print").style.display='none';
		print();
	}
</script>
<?if($_GET["calc_par"]) {?>
<p>
<span><?=GetMessage("calc_DLS");?></span>
<table>
			<tr><td></td><th><?=GetMessage("sposob");?><br /><?=GetMessage("ukladki");?></th><th><?=GetMessage("razmer");?><br /><?=GetMessage("plitki");?>(<?=GetMessage("sm");?>)</th><th><?=GetMessage("ploschad");?><br />(<?=GetMessage("m");?><sup>2</sup>)</th><th><?=GetMessage("kolvo");?><br /><?=GetMessage("plitki");?>(<?=GetMessage("sht");?>)</th></tr>
			<?
			$s2=0;
			foreach($ar_calc["row"] as $k => $val) {
				$s2+=$val->S;	
			?>
				<tr><td><?=$k+1?></td><th style="text-align:center;padding:0px;"><img src="/images/calc/<?=$val->type?>-uk.png" align="bottom" height="20" width="20"></th><td><?=($val->A)*100?> x <?=($val->B)*100?></td><td><?=number_format($val->S, 0, '.', ' ')?></td><td><?=number_format($val->itg, 0, '.', ' ')?></td></tr>
			<?}?>
			<tr><th colspan="3" style="text-align:right;border:0;"><?=GetMessage("vsego");?>:</th><td><?=$s2?></td><td><?=number_format($ar_calc["sno"], 0, '.', ' ')?></td></tr>
		</table>
</p>

<?}?>
<p>
<span><?=GetMessage("zakaz");?></span>
<table>
			<tr><td></td><th><?=GetMessage("element_dls");?></th><th><?=GetMessage("upakovka");?></th><th><?=GetMessage("cena");?>(<?=$ar_date["code_currency"]?>)</th><th><?=GetMessage("kolvo");?></th><th><?=GetMessage("summa");?>(<?=$ar_date["code_currency"]?>)</th></tr>
			<?foreach($ar_date["order_list"] as $k => $val) {?>
				<tr><td><?=$k+1?></td><td><?=$val->name?></td><td><?=$val->upak?></td><td><?=number_format($val->price, 2, '.', ' ')?></td><td><?=$val->show?></td><td><?=number_format($val->sum, 2, '.', ' ')?></td></tr>
			<?}?>
			<tr><th colspan="5" style="text-align:right;border:0;"><?=GetMessage("itogo");?>:</th><td><b><?=number_format($ar_date["itogo"], 2, '.', ' ')?></b></td></tr>
		</table>
</p>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>