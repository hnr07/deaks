<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Анализ страницы видео пользователя YouTube");
$_SESSION["c_ts"]=10; // количество страниц для обработки
$c_ts=$_SESSION["c_ts"];
$ar_nt=array();
$sort=array();
for($jc=0;$jc<$c_ts;$jc++) {
	$ar_nt_i[$jc]="info_prosmotr"; // сортировать по полю просмотры
	$sort_i[$jc]="desc";  // сортировать по убыванию
}
	//функция перевода текста - когда загружено видео, в примерное количество дней
	function text_day($txt_d) {
		if(stripos($txt_d, "час")!==false) {$day=0;}
		else {
			if(stripos($txt_d, "еде")!==false) {
				$ar_dt=explode(" ",$txt_d);
				$day=$ar_dt[0]*7;
				if($day==0) $day=7;
			}
			else {
				if(stripos($txt_d, "еся")!==false) {
					$ar_dt=explode(" ",$txt_d);
					$day=$ar_dt[0]*30;
					if($day==0) $day=30;
				}
				else {
					if(stripos($txt_d, "од")!==false) {
						$ar_dt=explode(" ",$txt_d);
						$day=$ar_dt[0]*365;
						if($day==0) $day=365;
					}
					else {
						if(stripos($txt_d, "лет")!==false) {
						$ar_dt=explode(" ",$txt_d);
						$day=$ar_dt[0]*365;
						if($day==0) $day=365;
						}
						else {
							$ar_dt=explode(" ",$txt_d);
							$day=$ar_dt[0]*1;
							if($day==0) $day=1;
						}
					}
				}
			}
		}
		return $day;
	}
		
	function file_get_contents_curl($url) {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Устанавливаем параметр, чтобы curl возвращал данные, вместо того, чтобы выводить их в браузер.
		curl_setopt($ch, CURLOPT_URL, $url);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}
	
	function pars_ar($pa_url,$np) {
		$pa_url=str_replace("flow=grid","flow=list",$pa_url);
		if(stripos($pa_url, "flow=list")===false) {
			if(stripos($pa_url, "?")===false) $pa_url.="?flow=list";
			else $pa_url.="&flow=list";
		}
		$get_html=$pa_url;
		$_SESSION['get_html_'.$np]=$get_html;
		
			$html_curl = file_get_contents_curl($get_html);
			
			$html= str_get_html($html_curl);


		$i=0;
		foreach($html->find('.yt-lockup-title a') as $element) {
			$a_href=trim($element->href);
			$ar_a_href=explode("=",$a_href);
			$ar_el[$i]["a_code"]=$ar_a_href[1];
			$ar_el[$i]["href"]="https://www.youtube.com".$a_href;
			$ar_el[$i]["a_text"]=trim($element->innertext);
			$i++;
		}
		$i=0;
		foreach($html->find('.yt-lockup-meta-info') as $element) {
			$e_0=$element->children(0);
			$e_1=$element->children(1);
			$vv=$e_1->plaintext;
			$ar_vv=explode(" ",$vv);
			$txt_d=trim($e_0->plaintext);
			
			$day=text_day($txt_d);
			
			$ar_el[$i]["info_kogda"]=$txt_d;
			$ar_el[$i]["info_kogda_day"]=$day;
			$ar_el[$i]["info_prosmotr"]=preg_replace('!\s++!u', '', $ar_vv[0]);
			$i++;
			
		}	
		$i=0;
		foreach($html->find('.yt-lockup-description') as $element) {

			$ar_el[$i]["description"]=trim($element->innertext);
			$i++;
		}
		$i=0;
	$i=0;
		foreach($html->find('.video-time span') as $element) {
			
			$ar_el[$i]["video_time"]=trim($element->innertext);
			$i++;
		}
		$element=$html->find('.branded-page-header-title-link');
		$ar_el["title"]=$element[0]->innertext;

		$html->clear(); // подчищаем за собой
		 unset($html);
		 
		 foreach($ar_el as $k=>$v) {
			 if($k!=="title") {
				if($v["info_kogda_day"]) $ar_el[$k]["k_prosmotr"]=round($v["info_prosmotr"]/$v["info_kogda_day"],0);
				else $ar_el[$k]["k_prosmotr"]=$v["info_prosmotr"];
				$ar_tti=explode(":",$v["video_time"]);
				$ar_ttr=array_reverse($ar_tti, false);
				$ts=$ar_ttr[0]+$ar_ttr[1]*60+$ar_ttr[2]*3600;
				$ar_el[$k]["video_time_s"]=$ts;
				if($v["info_kogda_day"]) $ar_el[$k]["t_prosmotr"]=round((($v["info_prosmotr"]/$v["info_kogda_day"])/$ts)*10,0);
				else $ar_el[$k]["t_prosmotr"]=round(($v["info_prosmotr"]/$ts)*10,0);
			 }
			/* else {
				 $ar_el[$k]["k_prosmotr"]=0;
				 $ar_el[$k]["video_time_s"]=0;
				 $ar_el[$k]["t_prosmotr"]=0;
			 }*/
		}
		return $ar_el;
	}
	
include_once('simple_html_dom.php');

if(isset($_GET["save_snimok"]) && $_GET["save_snimok"]==1) {
	$str_df="";
	for($jc=0;$jc<$c_ts;$jc++) {
		$str_df.=$_GET["pa_url_".$jc]."|".$_GET["b_info_".$jc]."\r\n";
	}
	if($_GET["name_sf"]) $name_sf=$_GET["name_sf"];
	else  $name_sf="snimok";
	$prfd=date("Y-m-d-H-i-s");
	$fp = fopen("snimok/".$name_sf.".txt", "w"); // Открываем файл в режиме записи
		fwrite($fp, $str_df); // Запись в файл
		fclose($fp); //Закрытие файла
		//$rqu= str_replace("save_snimok=1","save_snimok=0",$_SERVER["REQUEST_URI"]);
	//header ("location: ".$rqu);
}

if(isset($_GET["load_snimok"])) {
	$fp = fopen("snimok/".$_GET["load_snimok"], "r"); // Открываем файл
		if ($fp){
			$i=0;$fdp=0;
			while (!feof($fp))
			{
				$i_str= trim(fgets($fp, 999));
				$ar_i_str=explode("|",$i_str);
				$_GET["pa_url_".$i]=$ar_i_str[0];
				$_GET["b_info_".$i]=$ar_i_str[1];
				if($_GET["pa_url_".$i] && $i>=5) $fdp=1;
				unset($_SESSION["get_html_".$i]);
				$i++;
			}
		}
		fclose($fp); //Закрытие файла
}
if($_GET["cls"]=="Y") {
	for($jc=0;$jc<$c_ts;$jc++) {
		unset($_SESSION["get_html_".$jc]);
	}
}

for($jc=0;$jc<$c_ts;$jc++) {
	if(isset($_GET["sbros_".$jc])) {
		unset($_SESSION["get_html_".$jc]);
		unset($_SESSION["ar_elements_".$jc]);
		unset($_SESSION["ar_elements"]);
		$_GET["pa_url_".$jc]="";
		}
	else {
		if(!$_GET["pa_url_".$jc]) $_GET["pa_url_".$jc]=$_SESSION["get_html_".$jc];
		if($_GET["pa_url_".$jc]) {
			$ar_elements[$jc]=pars_ar($_GET["pa_url_".$jc],$jc);
		}
	}
	//echo "<pre>";print_r($ar_ttr);echo "</pre>";
	// echo "<pre>";print_r($ar_elements);echo "</pre>";
		
		 
	  if(isset($_GET["info_".$jc])) {
		 $ar_info[$jc]=explode("^",$_GET["info_".$jc]);
		 $ar_nt[$jc]=$ar_info[$jc][0];
		 $sort[$jc]=$ar_info[$jc][1];
	  }
	  else {
		  if($_GET["b_info_".$jc]) {
			 $ar_info[$jc]=explode("^",$_GET["b_info_".$jc]);
			 $ar_nt[$jc]=$ar_info[$jc][0];
			 $sort[$jc]=$ar_info[$jc][1];
		  }
		  else {
			$ar_nt[$jc]=$ar_nt_i[$jc];
			 $sort[$jc]=$sort_i[$jc];  
		  }
	  }
	  if($ar_elements[$jc]) {
		$ar_elements_sort[$jc] = array();
		foreach($ar_elements[$jc] as &$ar_item)
		{
			$ar_elements_sort[$jc][] = $ar_item[$ar_nt[$jc]];//Выбираем поле, по которому будем сортировать массив
		}
	   if($sort[$jc]=="desc") array_multisort($ar_elements_sort[$jc], SORT_DESC, $ar_elements[$jc]);
	   else  array_multisort($ar_elements_sort[$jc], SORT_ASC, $ar_elements[$jc]);
	   $_SESSION["ar_elements_".$jc]=$ar_elements[$jc];
	  }
	if(isset($_GET["nstr_".$jc])) {
		// echo "<pre>";print_r($_GET["nstr_activ_href"]);echo "</pre>";
		 if($_GET["nstr_activ_npp"]) $nstr_activ_npp[$jc]=1;
		 else $nstr_activ_npp[$jc]=0;
		 if($_GET["nstr_activ_href"]) $nstr_activ_href[$jc]=1;
		 else $nstr_activ_href[$jc]=0;
		 if($_GET["nstr_activ_a_text"]) $nstr_activ_a_text[$jc]=1;
		 else $nstr_activ_a_text[$jc]=0;
		 if($_GET["nstr_activ_video_time"]) $nstr_activ_video_time[$jc]=1;
		 else $nstr_activ_video_time[$jc]=0;
		 if($_GET["nstr_activ_info_prosmotr"]) $nstr_activ_prosmotr[$jc]=1;
		 else $nstr_activ_prosmotr[$jc]=0;
		 if($_GET["nstr_activ_description"]) $nstr_activ_description[$jc]=1;
		 else $nstr_activ_description[$jc]=0;
		 if($_GET["nstr_activ_info_kogda_day"]) $nstr_activ_info_kogda_day[$jc]=1;
		 else $nstr_activ_info_kogda_day[$jc]=0;
		 if($_GET["nstr_activ_k_prosmotr"]) $nstr_activ_k_prosmotr[$jc]=1;
		 else $nstr_activ_k_prosmotr[$jc]=0;
		 if($_GET["nstr_activ_t_prosmotr"]) $nstr_activ_t_prosmotr[$jc]=1;
		 else $nstr_activ_t_prosmotr[$jc]=0;
		 if($_GET["nstr_activ_print_title"]) $nstr_activ_print_title[$jc]=1;
		 else $nstr_activ_print_title[$jc]=0;
		 if($_GET["nstr_activ_print_ncol"]) $nstr_activ_print_ncol[$jc]=1;
		 else $nstr_activ_print_ncol[$jc]=0;
		 
		 $nstr_text[$jc] = $nstr_activ_npp[$jc]."^".$nstr_activ_href[$jc]."^".$nstr_activ_a_text[$jc]."^".$nstr_activ_video_time[$jc]."^".$nstr_activ_prosmotr[$jc]."^".$nstr_activ_description[$jc]."^".$nstr_activ_info_kogda_day[$jc]."^".$nstr_activ_k_prosmotr[$jc]."^".$nstr_activ_t_prosmotr[$jc]."^".$nstr_activ_print_title[$jc]."^".$nstr_activ_print_ncol[$jc]."^"; // Исходная строка $nstr_activ_print_title
		 
		$fp = fopen("nstr_".$jc.".txt", "r+"); // Открываем файл в режиме записи
		fwrite($fp, $nstr_text[$jc]); // Запись в файл

		fclose($fp); //Закрытие файла
	}
	if (!file_exists("nstr_".$jc.".txt")) {
		$fp = fopen("nstr_".$jc.".txt", "w"); // Открываем файл в режиме записи
		fwrite($fp, "1^1^1^1^1^1^1^1^1^1^1^"); // Запись в файл
		fclose($fp); //Закрытие файла
	} 
		$fp = fopen("nstr_".$jc.".txt", "r"); // Открываем файл в режиме чтения
		if ($fp){
			while (!feof($fp))
			{
			$ar_str[$jc][] = fgets($fp, 999);
			}
		}
		fclose($fp); //Закрытие файла
		
		$ar_nstr_a[$jc]=explode("^",$ar_str[$jc][0]);
		$_SESSION["ar_nstr_a_".$jc]=$ar_nstr_a[$jc];
}
 //echo "<pre>";print_r($ar_elements);echo "</pre>";
//echo "<pre>";print_r($_SESSION);echo "</pre>";
 ?>

<link rel="stylesheet" type="text/css" href="parser.css" /></link>

 <h2>Анализ страницы видео пользователя YouTube <span style="font-size:70%;color:#b2b2b2;"><?echo date("d.m.Y H:i:s");?><div style="font-size:14px;color:#b2b2b2;">по шаблону адреса: https://www.youtube.com/user/ПОЛЬЗОВАТЕЛЬ/videos</div></h2>
Например:<br /> https://www.youtube.com/user/remontkvpro/videos <br /> https://www.youtube.com/user/videobonapp/videos
 <form id="f_table" method="GET">
	 <p>
	
	 <table>
	 <tr valign="top">
	 <td>
	
	<?for($jc=0;$jc<$c_ts;$jc++) {?>
		<?if($jc==5) {?> <button class="but_bome" id="but_bome_1" type="button" title="больше" onclick="f_bome(1)">&#9660;</button><button class="but_bome" id="but_bome_0" type="button" title="скрыть" onclick="f_bome(0)">&#9650;</button><div style="clear:both;"></div><div id="bome"><?}?>
		<div style="margin-top:5px;"><div class="notc"><?=$jc+1;?>)</div> <input type="text" name="pa_url_<?=$jc?>" value="<?=$_GET["pa_url_".$jc]?>"> <input type="submit" name="sbros_<?=$jc?>" value="сброс"></div>
		
	<?}?>
	<?if($jc>=5) {?></div><?}?>
	
	</td>
	<td>
	
	<fieldset><legend>снимок экрана</legend>
	 <input type="text" name="name_sf" value="<?//=$_GET["name_sf"]?>" placeholder="имя файла" title="имя файла, до 10 символов" style="width:130px;"maxlength="10"><button type="submit" name="save_snimok" value="1" title="Сохранение страницы в файл 'имя_файла.txt'">сохранить</button><br />
	 <a href="list_snimok.php"><button type="button" style="margin-top:5px;width:220px;">выбрать снимок</button></a>
	 </fieldset><br />
	 <fieldset><legend>страница</legend>
	 <button type="submit" name="save_snimok" class="g_sub">обновить</button>
	 <a href="./?cls=Y"><button type="button" class="g_sub">сброс</button></a>&nbsp;
	 <a href="print.php" target="_blank" title="печатать все таблицы"><div class="print_all_ico"></div></a>
	 </fieldset>
	
	
	</td>
	</tr>
	</table>
	 </p>

	 <table><tr valign="top">
	 
	<?for($jc=0;$jc<$c_ts;$jc++) {?>
		<?if($ar_elements[$jc]) {?>
			 <td>
				<div class="tit_tab"><div class="notc" style="top:-5px;"><?=$jc+1;?>)&nbsp;&nbsp;&nbsp;</div> <a href="nstr.php?jc=<?=$jc?>&tit=<?=urlencode($ar_elements[$jc]["title"])?>&ar_str=<?=$ar_str[$jc][0]?>" title="настроить таблицу"><div class="setting_ico"></div></a> <a href="print.php?jc=<?=$jc?>" target="_blank" title="печатать таблицу <?=$ar_elements[$jc]["title"]?>"><div class="print_table_ico"></div></a> &nbsp;&nbsp;&nbsp;<?=$ar_elements[$jc]["title"]?></div>
				<table class="table_itog">
					<tr valign="bottom">
						<?if($ar_nstr_a[$jc][0]) {?><th>№<input type="hidden" name="b_info_<?=$jc?>" value="<?=$ar_nt[$jc]?>^<?=$sort[$jc]?>"></th><?}?>
						<?if($ar_nstr_a[$jc][1]) {?><th>Видео</th><?}?>
						<?if($ar_nstr_a[$jc][2]) {?><th><button type="submit" name="info_<?=$jc?>" value="a_text^asc" title="по возрастанию" class="<?=($ar_nt[$jc]=="a_text" && $sort[$jc]=="asc")?"but_a":""?>">&#9660;</button> <button type="submit" name="info_<?=$jc?>" value="a_text^desc" title="по убыванию" class="<?=($ar_nt[$jc]=="a_text" && $sort[$jc]=="desc")?"but_a":""?>">&#9650;</button><br /><br />Наименование</th><?}?>
						<?if($ar_nstr_a[$jc][3]) {?><th style="min-width:60px;"><button type="submit" name="info_<?=$jc?>" value="video_time^asc" title="по возрастанию" class="<?=($ar_nt[$jc]=="video_time" && $sort[$jc]=="asc")?"but_a":""?>">&#9660;</button> <button type="submit" name="info_<?=$jc?>" value="video_time^desc" title="по убыванию" class="<?=($ar_nt[$jc]=="video_time" && $sort[$jc]=="desc")?"but_a":""?>">&#9650;</button><br /><br />Время</th><?}?>
						<?if($ar_nstr_a[$jc][4]) {?><th><button type="submit" name="info_<?=$jc?>" value="info_prosmotr^asc" title="по возрастанию" class="<?=($ar_nt[$jc]=="info_prosmotr" && $sort[$jc]=="asc")?"but_a":""?>">&#9660;</button> <button type="submit" name="info_<?=$jc?>" value="info_prosmotr^desc" title="по убыванию" class="<?=($ar_nt[$jc]=="info_prosmotr" && $sort[$jc]=="desc")?"but_a":""?>">&#9650;</button><br /><br />Просмотры</th><?}?>
						<?if($ar_nstr_a[$jc][5]) {?><th>Описание</th><?}?>
						<?if($ar_nstr_a[$jc][6]) {?><th><button type="submit" name="info_<?=$jc?>" value="info_kogda_day^asc" title="по возрастанию" class="<?=($ar_nt[$jc]=="info_kogda_day" && $sort[$jc]=="asc")?"but_a":""?>">&#9660;</button> <button type="submit" name="info_<?=$jc?>" value="info_kogda_day^desc" title="по убыванию" class="<?=($ar_nt[$jc]=="info_kogda_day" && $sort[$jc]=="desc")?"but_a":""?>">&#9650;</button><br />Загружено<br />тому дней</th><?}?>
						<?if($ar_nstr_a[$jc][7]) {?><th><button type="submit" name="info_<?=$jc?>" value="k_prosmotr^asc" title="по возрастанию" class="<?=($ar_nt[$jc]=="k_prosmotr" && $sort[$jc]=="asc")?"but_a":""?>">&#9660;</button> <button type="submit" name="info_<?=$jc?>" value="k_prosmotr^desc" title="по убыванию" class="<?=($ar_nt[$jc]=="k_prosmotr" && $sort[$jc]=="desc")?"but_a":""?>">&#9650;</button><br />Просмотров<br />за день</th><?}?>
						<?if($ar_nstr_a[$jc][8]) {?><th style="min-width:80px;"><button type="submit" name="info_<?=$jc?>" value="t_prosmotr^asc" title="по возрастанию" class="<?=($ar_nt[$jc]=="t_prosmotr" && $sort[$jc]=="asc")?"but_a":""?>">&#9660;</button> <button type="submit" name="info_<?=$jc?>" value="t_prosmotr^desc" title="по убыванию" class="<?=($ar_nt[$jc]=="t_prosmotr" && $sort[$jc]=="desc")?"but_a":""?>">&#9650;</button><br />Коэффициент<br /><nobr>времени видео</nobr></th><?}?>
					</tr>
				<?//if($ar_elements[$jc]) {?>
					<?foreach($ar_elements[$jc] as $k=> $el) {?>
						<?if($k!=="title") {?>
						<?//echo "<pre>";print_r($el);echo "</pre>";?>
							<tr valign="top">
								<?if($ar_nstr_a[$jc][0]) {?><td><?=$k+1?> </td><?}?>
								<?if($ar_nstr_a[$jc][1]) {?><td><a href="<?=$el["href"]?>" target="_blank"><div class="a_img" style="background-image:url('https://i.ytimg.com/vi/<?=$el["a_code"]?>/hqdefault.jpg')" onmouseover="f_mover(this,1)" onmouseout="f_mover(this,0)"><div class="d_img" id="bm_<?=$k?>_<?=$k+1?>"><img src="https://i.ytimg.com/vi/<?=$el["a_code"]?>/hqdefault.jpg"></div></div></a></td><?}?>
								<?if($ar_nstr_a[$jc][2]) {?><td><?=$el["a_text"]?></td><?}?>
								<?if($ar_nstr_a[$jc][3]) {?><td class="text_r"><?=$el["video_time"]?></td><?}?>
								<?if($ar_nstr_a[$jc][4]) {?><td class="text_r"><?=number_format($el["info_prosmotr"], 0, ',', ' ');?></td><?}?>
								<?if($ar_nstr_a[$jc][5]) {?><td><?=$el["description"]?></td><?}?>
								<?if($ar_nstr_a[$jc][6]) {?><td class="text_r" title="<?=$el["info_kogda"]?>"><?=number_format($el["info_kogda_day"], 0, ',', ' ');?></td><?}?>
								<?if($ar_nstr_a[$jc][7]) {?><td class="text_r"><?=number_format($el["k_prosmotr"], 0, ',', ' ');?></td><?}?>
								<?if($ar_nstr_a[$jc][8]) {?><td class="text_r"><?=number_format($el["t_prosmotr"], 0, ',', ' ');?></td><?}?>
								
							</tr>
						<?}?>
					<?}?> 
				<?//}?> 
			</table></td>
		<?}?>
	 <?}?>
	 </tr></table>
 </form>
 
 <script type="text/javascript">
	function f_mover(t,p) {
		if(p) t.firstChild.style.display='block';
		else t.firstChild.style.display='none';
	}
	function f_bome(b) {
		if(b) {
			document.getElementById("but_bome_1").style.display='none';
			document.getElementById("but_bome_0").style.display='block';
			document.getElementById("bome").style.display='block';
			document.cookie = "bome=1";
		}
		else {
			document.getElementById("but_bome_1").style.display='block';
			document.getElementById("but_bome_0").style.display='none';
			document.getElementById("bome").style.display='none';
			document.cookie = "bome=0";
		}
	}
	

function getCookie(name) {
  var cookie = " " + document.cookie;
  var search = " " + name + "=";
  var setStr = null;
  var offset = 0;
  var end = 0;
  if (cookie.length > 0) {
    offset = cookie.indexOf(search);
    if (offset != -1) {
      offset += search.length;
      end = cookie.indexOf(";", offset)
      if (end == -1) {
        end = cookie.length;
      }
      setStr = unescape(cookie.substring(offset, end));
    }
  }
  return(setStr);
}
f_bome(getCookie("bome")*1);

	//alert(document.cookie);
</script>
<?if($fdp===1) {?> <script type="text/javascript">f_bome(1);</script><?}?>
<?if($fdp===0) {?> <script type="text/javascript">f_bome(0);</script><?}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>