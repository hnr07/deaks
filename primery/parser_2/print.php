<?
session_start();
$c_ts=$_SESSION["c_ts"];
$ar_elements=array();
if(isset($_GET["jc"])) {
	$jc=$_GET["jc"];
	$ar_elements[$jc]=$_SESSION["ar_elements_".$jc];
	$ar_nstr_a[$jc]=$_SESSION["ar_nstr_a_".$jc];
}
else {
	for($jc=0;$jc<$c_ts;$jc++) {
		if($_SESSION["ar_elements_".$jc]) $ar_elements[$jc]=$_SESSION["ar_elements_".$jc];
		$ar_nstr_a[$jc]=$_SESSION["ar_nstr_a_".$jc];
	}
}
//echo "<pre>";print_r($ar_elements);echo "</pre>";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
 <html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Печать таблицы</title>
<link rel="stylesheet" type="text/css" href="parser.css" />
 </head>
 <body>
  <table><tr valign="top">
	 
	<?for($jc=0;$jc<$c_ts;$jc++) {?>
		<?if($ar_elements[$jc]) {?>
			 <td>
				<?if($ar_nstr_a[$jc][9]) {?><div class="tit_tab"><?=$ar_elements[$jc]["title"]?></div><?}?>
				<table class="table_itog">
		<?if($ar_nstr_a[$jc][10]) {?>
			<tr valign="bottom">
				<?if($ar_nstr_a[$jc][0]) {?><th>№<br />п/п</th><?}?>
				<?if($ar_nstr_a[$jc][1]) {?><th>Ссылка</th><?}?>
				<?if($ar_nstr_a[$jc][2]) {?><th>Наименование</th><?}?>
				<?if($ar_nstr_a[$jc][3]) {?><th>Время</th><?}?>
				<?if($ar_nstr_a[$jc][4]) {?><th>Просмотры</th><?}?>
				<?if($ar_nstr_a[$jc][5]) {?><th>Описание</th><?}?>
				<?if($ar_nstr_a[$jc][6]) {?><th>Загружено<br />тому дней</th><?}?>
				<?if($ar_nstr_a[$jc][7]) {?><th>Просмотров<br />за день</th><?}?>
				<?if($ar_nstr_a[$jc][8]) {?><th>Коэффициент<br /><nobr>времени видео</nobr></th><?}?>
			</tr>
		<?}?>
		<?if($ar_elements) {?>
			<?foreach($ar_elements[$jc] as $k=> $el) {?>
				<?if($k!=="title") {?>
					<tr valign="top">
						<?if($ar_nstr_a[$jc][0]) {?><td><?=$k+1?> </td><?}?>
						<?if($ar_nstr_a[$jc][1]) {?><td><div class="a_img"><img src="https://i.ytimg.com/vi/<?=$el["a_code"]?>/hqdefault.jpg" width="60"></div></td><?}?>
						<?if($ar_nstr_a[$jc][2]) {?><td><?=$el["a_text"]?></td><?}?>
						<?if($ar_nstr_a[$jc][3]) {?><td class="text_r"><?=$el["video_time"]?></td><?}?>
						<?if($ar_nstr_a[$jc][4]) {?><td class="text_r"><?=number_format($el["info_prosmotr"], 0, ',', ' ');?></td><?}?>
						<?if($ar_nstr_a[$jc][5]) {?><td><?=$el["description"]?></td><?}?>
						<?if($ar_nstr_a[$jc][6]) {?><td class="text_r"><?=number_format($el["info_kogda_day"], 0, ',', ' ');?></td><?}?>
						<?if($ar_nstr_a[$jc][7]) {?><td class="text_r"><?=number_format($el["k_prosmotr"], 0, ',', ' ');?></td><?}?>
						<?if($ar_nstr_a[$jc][8]) {?><td class="text_r"><?=number_format($el["t_prosmotr"], 0, ',', ' ');?></td><?}?>
						
					</tr>
				<?}?>
			<?}?> 
		<?}?> 
				</table></td>
		<?}?>
	 <?}?>
	 </tr></table>
<script type="text/javascript">
	setTimeout(print(), 2000);
</script>
 </body>
</html>