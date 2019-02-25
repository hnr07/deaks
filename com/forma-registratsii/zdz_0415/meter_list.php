<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Статистика по остаткам мест");
?>
<style>
#t_fly td{
border:solid 1px green;
padding:10px 30px;
}
#t_fly th{
background-color:green;
border:solid 1px green;
padding:10px 30px;
color:#fff;
}
#t_fly th.bob{
border-color:green #fff green green;
}
</style>
<? include "var_config.php"; ?>
<? include "meter_fly.php"; ?>
<? include "meter_hotel.php"; ?>
<? //include "meter_hotel_ls.php"; ?>
<br/>
<?//echo"<pre>";print_r($ar_kfly_1);echo"</pre>";?>
<h3>Текущий остаток мест на перелёт - <? echo date("d.m.Y H:i:s");?></h3>
<br/>
<table id="t_fly">
<tr><th class="bob">Вариант</th><th class="bob">Лимит</th><th class="bob">Бронь</th><th>Остаток</th></tr>
<tr>
<tr><td colspan="4"><b><i>Туда</i></b></td></tr>
<?

$itt=count($ar_kfly_1);
for($i=1;$i<$itt;$i++) {
echo "<tr><td>".$ar_reys_t_mes[$i]."</td><td>".$ar_kfly_1[$i]."</td><td>".$ar_bron_1[$i]."</td><td>".($ar_os_t[$i])."</td></tr>";
}
?>
<tr><td colspan="4"><b><i>Обратно</i></b></td></tr>
<?
$ito=count($ar_kfly_2);
for($i=1;$i<$ito;$i++) {
echo "<tr><td>".$ar_reys_o_mes[$i]."</td><td>".$ar_kfly_2[$i]."</td><td>".$ar_bron_2[$i]."</td><td>".($ar_os_o[$i])."</td></tr>";
}
?>
</table>
<br/>
<table id="t_fly">
<tr><th class="bob">По дате</th><th class="bob">Лимит</th><th class="bob">Бронь</th><th>Остаток</th></tr>
<tr>
<tr><td colspan="4"><b><i>Туда</i></b></td></tr>
<td>Москва - Шарм Эль Шейх‎ 18.04.2015</td><td><?echo ($ar_kfly_1[1]+$ar_kfly_1[2]+$ar_kfly_1[4]+$ar_kfly_1[5])?></td><td><?echo ($ar_bron_1[1]+$ar_bron_1[2]+$ar_bron_1[4]+$ar_bron_1[5])?></td><td><?echo ($ar_os_t[1]+$ar_os_t[2]+$ar_os_t[4]+$ar_os_t[5])?></td>
</tr><tr>
<td>Киев - Шарм Эль Шейх‎ 18.04.2015</td><td><?echo ($ar_kfly_1[3])?></td><td><?echo ($ar_bron_1[3])?></td><td><?echo ($ar_os_t[3])?></td>
</tr><tr>
<td>Екатеринбург - Шарм Эль Шейх‎ 18.04.2015</td><td><?echo ($ar_kfly_1[6])?></td><td><?echo ($ar_bron_1[6])?></td><td><?echo ($ar_os_t[6])?></td>
</tr><tr>
<td>Краснодар - Шарм Эль Шейх‎ 18.04.2015</td><td><?echo ($ar_kfly_1[7])?></td><td><?echo ($ar_bron_1[7])?></td><td><?echo ($ar_os_t[7])?></td>
</tr><tr>
<td>С.- Петербург - Шарм Эль Шейх‎ 18.04.2015</td><td><?echo ($ar_kfly_1[8])?></td><td><?echo ($ar_bron_1[8])?></td><td><?echo ($ar_os_t[8])?></td>
</tr>
<tr><td colspan="4"><b><i>Обратно</i></b></td></tr>
<tr>
<td>Шарм Эль Шейх‎ - Москва 25.04.2015</td><td><?echo ($ar_kfly_2[1]+$ar_kfly_2[2]+$ar_kfly_2[4]+$ar_kfly_2[5])?></td><td><?echo ($ar_bron_2[1]+$ar_bron_2[2]+$ar_bron_2[4]+$ar_bron_2[5])?></td><td><?echo ($ar_os_o[1]+$ar_os_o[2]+$ar_os_o[4]+$ar_os_o[5])?></td>
</tr><tr>
<td>Шарм Эль Шейх‎ - Киев 25.04.2015</td><td><?echo ($ar_kfly_2[3])?></td><td><?echo ($ar_bron_2[3])?></td><td><?echo ($ar_os_o[3])?></td>
</tr><tr>
<td>Шарм Эль Шейх‎ - Екатеринбург 25.04.2015</td><td><?echo ($ar_kfly_2[6])?></td><td><?echo ($ar_bron_2[6])?></td><td><?echo ($ar_os_o[6])?></td>
</tr><tr>
<td>Шарм Эль Шейх -‎ Краснодар 25.04.2015</td><td><?echo ($ar_kfly_2[7])?></td><td><?echo ($ar_bron_2[7])?></td><td><?echo ($ar_os_o[7])?></td>
</tr><tr>
<td>Шарм Эль Шейх - С.- Петербург‎ 25.04.2015</td><td><?echo ($ar_kfly_2[8])?></td><td><?echo ($ar_bron_2[8])?></td><td><?echo ($ar_os_o[8])?></td>
</tr>
</table>

<br/><br/>
<h3>Текущий остаток номеров - <? echo date("d.m.Y H:i:s");?></h3>
<br/>
<table id="t_fly">
<tr><th class="bob">Отель</th><th class="bob">Лимит</th><th class="bob">Бронь</th><th>Остаток</th></tr>
<tr>
<?
$feo=count($ar_hot_mes);
for($i=0;$i<$feo;$i++){
echo "<tr><td>".$ar_hot_mes[$i]."</td><td>".$ar_knora[$i]."</td><td>".$ar_bron[$i]."</td><td>".$ar_onor[$i]."</td></tr>";
}

$feo=count($ar_hot_mes_ls);
for($i=0;$i<$feo;$i++){
echo "<tr><td>".$ar_hot_mes_ls[$i]."</td><td>".$ar_knora_ls[$i]."</td><td>".$ar_bron_ls[$i]."</td><td>".$ar_onor_ls[$i]."</td></tr>";
}


?>
</table><br/>
<br/>
<table id="t_fly">
<tr><th>Варианты размещения</th></tr>
<tr><td>
<?

$canm=count($ar_nora_mes);
for($i=0;$i<$canm;$i++){
echo $ar_nora_mes[$i]." &#8801; <b>  [V".($i+1)."]</b><br />";
}
//echo "<tr><td>".$ar_nora_mes[0]." [V1]<br />".$ar_nora_mes[1]." [V2]<br/>".$ar_nora_mes[2]." [V3]<br/>".$ar_nora_mes[3]." [V4]<br/>".$ar_nora_mes[4]." [V5]<br/>".$ar_nora_mes[5]." [V6]<br/>".$ar_nora_mes[6]." [V7]<br/>".$ar_nora_mes[7];
//." [V8]<br/>".$ar_nora_mes[8]." [V9]<br/>".$ar_nora_mes[9]." [V10]<br/>".$ar_nora_mes[10]." [V11]
//echo "</td>";
//echo "<td>Остаток = Лимит - Бронь - (V1+V2/2+V3/2+V4/2+V5/3+V6/3+V7/4+V8/4";
//+V9/3+V10/4+V11/4
//echo ")  </td></tr>";
//echo "<tr><td>".$ar_nora[3]." [V4]<br/>".$ar_nora[4]." [V5]<br/>".$ar_nora[5]." [V6]<br/>".$ar_nora[6]." [V7]<br/>".$ar_nora[7]." [V8]<br/>".$ar_nora[8]." [V9]</td><td>".$ar_knora[1]."<br/>[L2]</td><td>".$ar_bron[1]."<br/>[B1]</td><td>".$ar_onor[1]."<br/>[&#931;2]</td><td><nobr>&#931;2=L2-B2-(V4/3+V5/3+V6/2+V7/3+V8/3+V9/3)</nobr></td></tr>";

?>
</td>
</tr>
<tr><th>Формула расчёта</th></tr>
<tr>
<td>Остаток = Лимит - Бронь - (V1+V2/2+V3/2+V4/3+V5/3+V6/3+V7/2+V8/3+V9/3+V10/4+V11/4+V12/4+V13/3+V14/4+V15/4)</td></tr>
</table><br/><br/><br/><br/>
 <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>