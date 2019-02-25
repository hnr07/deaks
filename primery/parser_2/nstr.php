<?
$ar_nstr_a=explode("^",$_GET['ar_str']);
$tit=urldecode($_GET['tit']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
 <html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Настройка таблицы <?=$tit?></title>
<link rel="stylesheet" type="text/css" href="parser.css" />
 </head>
 <body>
 <div class="box_nstr">
			<form method="GET" action="index.php">
			<h3>Настройка таблицы <?=$tit?></h3>
			<table class="table_itog">
				<tr valign="bottom">
					<th></th>
					<th>№<br />п/п</th>
					<th>Видео</th>
					<th>Наименование</th>
					<th>Время</th>
					<th>Просмотры</th>
					<th>Описание</th>
					<th>Загружено<br />тому дней</th>
					<th>Просмотров<br />за день</th>
					<th>Коэффициент<br />времени видео</th>
					<th>Выводить заголовок<br />на печать</th>
					<th>Выводить имена колонок<br />на печать</th>
				</tr>
				<tr>
					<th>Показать в таблице</th>
					<td><input type="checkbox" name="nstr_activ_npp" <?=($ar_nstr_a[0])?'checked="checked"':''?> value="1" /></td>
					<td><input type="checkbox" name="nstr_activ_href" <?=($ar_nstr_a[1])?'checked="checked"':''?> value="1" /></td>
					<td><input type="checkbox" name="nstr_activ_a_text" <?=($ar_nstr_a[2])?'checked="checked"':''?> value="1" /></td>
					<td><input type="checkbox" name="nstr_activ_video_time" <?=($ar_nstr_a[3])?'checked="checked"':''?> value="1" /></td>
					<td><input type="checkbox" name="nstr_activ_info_prosmotr" <?=($ar_nstr_a[4])?'checked="checked"':''?> value="1" /></td>
					<td><input type="checkbox" name="nstr_activ_description" <?=($ar_nstr_a[5])?'checked="checked"':''?> value="1" /></td>
					<td><input type="checkbox" name="nstr_activ_info_kogda_day" <?=($ar_nstr_a[6])?'checked="checked"':''?> value="1" /></td>
					<td><input type="checkbox" name="nstr_activ_k_prosmotr" <?=($ar_nstr_a[7])?'checked="checked"':''?> value="1" /></td>
					<td><input type="checkbox" name="nstr_activ_t_prosmotr" <?=($ar_nstr_a[8])?'checked="checked"':''?> value="1" /></td>
					<td><input type="checkbox" name="nstr_activ_print_title" <?=($ar_nstr_a[9])?'checked="checked"':''?> value="1" /></td>
					<td><input type="checkbox" name="nstr_activ_print_ncol" <?=($ar_nstr_a[10])?'checked="checked"':''?> value="1" /></td>
				</tr>
			</table>
			<br />
				<input type="submit" name="nstr_<?=$_GET['jc']?>" value="сохранить">
			</form>
		</div>
 </body>
</html>