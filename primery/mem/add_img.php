<?
function HEXNaRGB($cvet) {
  /* Ищем шарп # в начале строки: */
  if ($cvet[0] == '#') {
    $cvet = substr($cvet, 1);
  }
  /* Разбираем строку: */
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

//echo"<pre>";print_r($_POST);echo"</pre>";
$iv_img=$_POST["iv_img"];
$id_img=$_POST["id_img"];
$res_file_tmp=$_POST["res_file_tmp"]; // временный файл
$str_1=$_POST["str_1"];
$str_2=$_POST["str_2"];
$f_1=$_POST["fontsize_1"];
$x_1=$_POST["xsize_1"];
$y_1=$_POST["ysize_1"];
$f_2=$_POST["fontsize_2"];
$x_2=$_POST["xsize_2"];
$y_2=$_POST["ysize_2"];

	class watermark1
	{
	  function create_watermark( $main_img_obj, $text_1,$text_2, $r = 208, $g = 79, $b = 120, $alpha_level = 100, $f_1, $f_2, $x_1, $x_2, $y_1, $y_2)
	  {
		$font1 = "./HelveticaLight.ttf";
		$font2 = "./HelveticaMedium.ttf";
		
		
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

	//imagejpeg($im, $res_file_tmp);
	if(imagejpeg($im, $res_file_tmp)) echo $res_file_tmp."?d=".date("His");
	//header('Content-type: image/jpeg');
	//imagejpeg($im);
	//imagedestroy($im);
	?>
