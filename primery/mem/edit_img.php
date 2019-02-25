<?define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Домохозяйки правят миром.");
if(!$_REQUEST["id_img"]) $_REQUEST["id_img"]=1;
$id_img=$_REQUEST["id_img"]; // код картинки

global $USER;
$login_user=$USER->GetLogin(); // Логин пользователя
//$fio_s=$USER->GetFullName(); // ФИО пользователя
include "config.php";

?>
<link rel="stylesheet" type="text/css" href="/css/private_office.css" />
<link rel="stylesheet" type="text/css" href="./style.css" />
<?

	
$iv_img=$ar_img[$id_img]; // исходная картинка
$res_file_tmp=$ar_file[$id_img]["tmp"]; // временный путь к файлу
$fontsize_1=$fontsize[$id_img]; //исходный размер шрифта для 1 строки
$fontsize_2=$fontsize[$id_img]; //исходный размер шрифта для 2 строки
$xsize_1=$xsize[$id_img];  // исходная координата по оси X для 1 строки
$xsize_2=$xsize[$id_img];  // исходная координата по оси X для 2 строки
$ysize_1=$ysize_1[$id_img];  // исходная координата по оси Y для 1 строки
$ysize_2=$ysize_2[$id_img];  // исходная координата по оси Y для 2 строки


/*
function HEXNaRGB($cvet) {
  // Ищем шарп # в начале строки: 
  if ($cvet[0] == '#') {
    $cvet = substr($cvet, 1);
  }
  // Разбираем строку: 
  if (strlen($cvet) == 6) {
    list( $r, $g, $b ) = array(
      $cvet[0]. $cvet[1],
      $cvet[2]. $cvet[3],
      $cvet[4]. $cvet[5]
    );
  } elseif (strlen($cvet) == 3) {
    list( $r, $g, $b ) = array(
      $cvet[0]. $cvet[0],
      $cvet[1]. $cvet[1],
      $cvet[2]. $cvet[2]
    );
  } else {
    return false;
  }
  $r = hexdec($r); // - красный цвет.
  $g = hexdec($g); // - зеленый цвет.
  $b = hexdec($b); // - синий/голубой цвет.
  return array('red' => $r, 'green' => $g, 'blue' => $b);
}

	
	if(!isset($_POST["color"])) $_POST["color"]="#d04f78";
	
	if(isset($_POST["str_1"])) $str_1=$_POST["str_1"];
	else $str_1="Строка 1";
	if(isset($_POST["str_2"])) $str_2=$_POST["str_2"];
	else $str_2="Строка 2";
	
	if($_POST['t_res_1']) {
		if(isset($_POST['t_min_1'])) $f_1=$_GET['f_1']-5;
		if(isset($_POST['t_max_1'])) $f_1=$_GET['f_1']+5;
		if(isset($_POST['t_left_1'])) $x_1=$_GET['x_1']-20;
		if(isset($_POST['t_right_1'])) $x_1=$_GET['x_1']+20;
		if(isset($_POST['t_bottom_1'])) $y_1=$_GET['y_1']+10;
		if(isset($_POST['t_top_1'])) $y_1=$_GET['y_1']-10;
	}
	else {
		$f_1=$fontsize;
		$x_1=$xsize;
		$y_1=$ysize_1;
	}
	
	if($_POST['t_res_2']) {
		if(isset($_POST['t_min_2'])) $f_2=$_GET['f_2']-5;
		if(isset($_POST['t_max_2'])) $f_2=$_GET['f_2']+5;
		if(isset($_POST['t_left_2'])) $x_2=$_GET['x_2']-20;
		if(isset($_POST['t_right_2'])) $x_2=$_GET['x_2']+20;
		if(isset($_POST['t_bottom_2'])) $y_2=$_GET['y_2']+10;
		if(isset($_POST['t_top_2'])) $y_2=$_GET['y_2']-10;
	}
	else {
		$f_2=$fontsize;
		$x_2=$xsize;
		$y_2=$ysize_2;
	}
//	echo"<pre>";print_r($_POST);echo"</pre>";
	class watermark1
	{
	  function create_watermark( $main_img_obj, $text_1,$text_2, $r = 208, $g = 79, $b = 120, $alpha_level = 100, $f_1, $f_2, $x_1, $x_2, $y_1, $y_2)
	  {
		$font1 = "HelveticaLight.ttf";
		$font2 = "HelveticaMedium.ttf";
		
		
	   $width = imagesx($main_img_obj);
	   $height = imagesy($main_img_obj);
	 
		$angle = 0;
		// $text = " ".$text." ";

		$c = imagecolorallocatealpha($main_img_obj, $r, $g, $b, $alpha_level);
		$black = imagecolorallocate ($main_img_obj, 0, 0, 0);
		$white = imagecolorallocate ($main_img_obj, 255, 255, 255);
		$c_m = imagecolorallocate ($main_img_obj, $r, $g, $b);
		imagettftext($main_img_obj,$f_1 ,$angle, $x_1, $y_1, $c_m, $font2, $text_1);
		imagettftext($main_img_obj,$f_2 ,$angle, $x_2, $y_2, $c, $font1, $text_2);
	   
	  
	   
	   return $main_img_obj;
	  }
	}
	$watermark = new watermark1();
	$img = imagecreatefromjpeg($iv_img);
	$yo=array("Ё","ё");$e=array("Е","е");
	$text_1 = str_replace($yo,$e,$str_1);
	$text_2 = str_replace($yo,$e,$str_2);
	$rgb=HEXNaRGB($_POST['color']);
	$r=(int)$rgb["red"];
	$g=(int)$rgb["green"];
	$b=(int)$rgb["blue"];
	//echo"<pre>";print_r($rgb);echo"</pre>";
	$im=$watermark->create_watermark($img,$text_1,$text_2, $r,$g,$b,10,$f_1,$f_2,$x_1,$x_2,$y_1,$y_2);

	imagejpeg($im, $res_file_tmp);
	
	//header('Content-type: image/jpeg');
	//imagejpeg($im);
	//imagedestroy($im);
	*/
	?>
<script type="text/javascript">
$(document).ready(function(){
	$('#form_red').on("submit", function(){
			var data=$(this).serialize();
			//alert(data);
			
			var url="./add_img.php";
			$.ajax({  
			type: "POST",
			url: url,  
			data: data, 
			cache: false,  
			success: function(html){ 
				//$("#res_ajax").html(html);
				$(".t_edit .image .result").animate({opacity: '0'},400).animate({opacity: '100'},400);
				setTimeout(function(){$(".t_edit .image").html('<div class="result" style="background-image:url('+html+');"></div>');},400);
				//$(".private_office .right .image .result").animate({opacity: '100'},400);
			} 
		});
			
		
		return false;
	});
	
	$("#form_red button").on("click", function(){
		var event=$(this).val();
		var fontsize=$(this).siblings("input:eq(0)").val()*1;
		var xsize=$(this).siblings("input:eq(1)").val()*1;
		var ysize=$(this).siblings("input:eq(2)").val()*1;
		
		var f_min=$("#f_min").val()*1;
		var f_max=$("#f_max").val()*1;
		var f_step=$("#f_step").val()*1;
		var p_step=$("#p_step").val()*1;
		
		switch(event) {
				case "t_min":if(fontsize>f_min){fontsize-=f_step;$(this).siblings("input:eq(0)").val(fontsize);}break;
				case "t_max":if(fontsize<f_max){fontsize+=f_step;$(this).siblings("input:eq(0)").val(fontsize);}break;
				case "t_left":xsize-=p_step;$(this).siblings("input:eq(1)").val(xsize);break;
				case "t_right":xsize+=p_step;$(this).siblings("input:eq(1)").val(xsize);break;
				case "t_top":ysize-=p_step;$(this).siblings("input:eq(2)").val(ysize);break;
				case "t_bottom":ysize+=p_step;$(this).siblings("input:eq(2)").val(ysize);break;
			}
		$('#form_red').submit();
	});
	
	$('#form_red').submit();
});
</script>
	<br><br><div id="res_ajax"></div>
	<input type="hidden" id="f_min" value="<?=$f_min?>">
	<input type="hidden" id="f_max" value="<?=$f_max?>">
	<input type="hidden" id="f_step" value="<?=$f_step?>">
	<input type="hidden" id="p_step" value="<?=$p_step?>">
<h1 id="top"><?$APPLICATION->ShowTitle();?> Страница создания мема</h1><a name="top"></a>

<div class="border-top"></div>
<div class="private_office">
	<div class="left" style="width:200px;">
		 <?	 include "sect_inc.php";?>
	</div>
	
	<div class="right" style="">
		<table class="t_edit">
			<tr>
				<td>
				<div class="image"></div>
				<!--<img src="<?=$res_file_tmp?>?d=<?=date("His")?>" width="480" align="top"><br />-->
				</td>
				<td>
					
					<form id="form_red" action="#" method="POST">
						<input type="hidden" name="id_img" value="<?=$id_img?>">
						<input type="hidden" name="iv_img" value="<?=$iv_img?>">
						<input type="hidden" name="login_user" value="<?=$login_user?>">
						<input type="hidden" name="res_file_tmp" value="<?=$res_file_tmp?>">
						<div class="form_red_fio">
							<div>Изменить текст</div>
							<input type="text" name="str_1" value="Строка 1">
							<input type="text" name="str_2" value="Строка 2">
							<div class="div_color" title="Цвет шрифта">
						
							<table><tr>
								<td><div style="background-color:#333333"><input type="radio" id="color_1" name="color" value="<?="#333333"?>" checked></div></td>
								<td><div style="background-color:#d04f78"><input type="radio" id="color_2" name="color" value="<?="#d04f78"?>" ></div></td>
								<td><div style="background-color:#742ea0"><input type="radio" id="color_3" name="color" value="<?="#742ea0"?>" ></div></td>
								<td><div style="background-color:#ff5d00"><input type="radio" id="color_4" name="color" value="<?="#ff5d00"?>" ></div></td>
								<td><div style="background-color:#32b823"><input type="radio" id="color_5" name="color" value="<?="#32b823"?>" ></div></td>
								<td><div style="background-color:#064ee0"><input type="radio" id="color_6" name="color" value="<?="#064ee0"?>" ></div></td>
								<td><div style="background-color:#f01869"><input type="radio" id="color_7" name="color" value="<?="#f01869"?>" ></div></td>
								<!--<td><div style="background-color:#b2b2b2"><input type="radio" id="color_8" name="color" value="<?="#b2b2b2"?>" <?=($_POST["color"]=="#b2b2b2")?"checked":""?>></div></td>-->
							</tr></table>
							</div>
							<input id="submit_form" type="submit" value="Изменить">	
						</div>	
							<br />
						<div class="form_red_text">
							<div>Настроить строку 1</div>
							<input type="hidden" name="fontsize_1" value="<?=$fontsize_1?>"><input type="hidden" name="xsize_1" value="<?=$xsize_1?>"><input type="hidden" name="ysize_1" value="<?=$ysize_1?>">
							<button type="button" value="t_min" name="t_min_1" title="Шрифт меньше">меньше</button> <button type="button" value="t_max" name="t_max_1" title="Шрифт больше">больше</button><br />
							<button type="button" value="t_left" name="t_left_1" title="Сдвинуть влево">влево</button> <button type="button" value="t_right" name="t_right_1" title="Сдвинуть вправо">вправо</button><br />
							<button type="button" value="t_bottom" name="t_bottom_1" title="Сдвинуть вниз">вниз</button> <button type="button" value="t_top" name="t_top_1" title="Сдвинуть вверх">вверх</button>
						</div>
						<br />
						<div class="form_red_text">
							<div>Настроить строку 2</div>
							<input type="hidden" name="fontsize_2" value="<?=$fontsize_2?>"><input type="hidden" name="xsize_2" value="<?=$xsize_2?>"><input type="hidden" name="ysize_2" value="<?=$ysize_2?>">
							<button type="button" value="t_min" name="t_min_2" title="Шрифт меньше">меньше</button> <button type="button" value="t_max" name="t_max_2" title="Шрифт больше">больше</button><br />
							<button type="button" value="t_left" name="t_left_2" title="Сдвинуть влево">влево</button> <button type="button" value="t_right" name="t_right_2" title="Сдвинуть вправо">вправо</button><br />
							<button type="button" value="t_bottom" name="t_bottom_2" title="Сдвинуть вниз">вниз</button> <button type="button" value="t_top" name="t_top_2" title="Сдвинуть вверх">вверх</button>
						</div>
					</form>
					<br />
					<a href="index.php?tmp=<?=$id_img?>"><button class="a_download">Сохранить</button></a>
					<br /><br />
					
				</td>
			</tr>
		</table>	

	</div>

</div>
	
	
	<?
?>
<Div class="clear-all"></div>
<br /><br /><br /><br />
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>