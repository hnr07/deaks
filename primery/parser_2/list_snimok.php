 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
 <html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Выбор снимка</title>
<link rel="stylesheet" type="text/css" href="parser.css" />
 </head>
 <body>
 <h2>Сохранённые снимки</h2>
 <?
 if($_GET["f_del"]==100 && $_GET["nf"]) {
	 unlink("./snimok/".$_GET["nf"]);
 }
 $f_del=$_GET["f_del"];
 $files = scandir("snimok");
$array = array_flip($files); //Меняем местами ключи и значения
unset ($array[".."]) ; //Удаляем элемент массива
unset ($array["."]) ; //Удаляем элемент массива
$files = array_flip($array); //Меняем местами ключи и значения
sort($files); // сортировка массива
$c=count($files);
 //echo"<pre>";print_r($files);echo"</pre>";
 for($i=0;$i<$c;$i++) {?>
	 <div class="div_df">
		<a href="./?load_snimok=<?=$files[$i]?>" title="открыть снимок"><?=$files[$i]?></a>
		<?if($f_del==100) {?><a href="?f_del=100&nf=<?=$files[$i]?>"><div class="del" title="удалить снимок">&#10006;</div></a><?}?>
	 </div>
<? } ?>
  </body>
</html>