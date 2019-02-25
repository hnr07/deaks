<?
	//echo"<pre>";print_r($_POST);echo"</pre>";
	$fio_s=$_POST["fio_s"];
	$f=$_POST["fontsize"];
	$x=$_POST["xsize"];
	class watermark1
	{
	  function create_watermark( $main_img_obj, $text, $r = 0, $g = 0, $b = 0, $alpha_level = 0, $f, $x)
	  {
		$font1 = "./HelveticaLight.ttf";
		$font2 = "./HelveticaMedium.ttf";
		
	//echo $font1;	
	   $width = imagesx($main_img_obj);
	   $height = imagesy($main_img_obj);
	 
		$angle = 0;
	  // $text = " ".$text." ";

	   $c = imagecolorallocatealpha($main_img_obj, $r, $g, $b, $alpha_level);
		$black = imagecolorallocate ($main_img_obj, 0, 0, 0);
		$white = imagecolorallocate ($main_img_obj, 255, 255, 255);
		$c_m = imagecolorallocate ($main_img_obj, 82, 37, 128);
	   imagettftext($main_img_obj,$f ,$angle, $x, 850, $c_m, $font1, $text);
	   
	  
	   
	   return $main_img_obj;
	  }
	}
	$watermark = new watermark1();
	$img = imagecreatefromjpeg("CC_Megafon_certificate-00.jpg");
	//$yo=array("Ё","ё");$e=array("Е","е");
	//$text = str_replace($yo,$e,$fio_s); // Замена ё на е
	$text=$fio_s; // Без замен
	$im=$watermark->create_watermark($img,$text, 99,99,99,0,$f,$x);

	if(imagejpeg($im,"result/result_".$_POST['login_user'].".jpg")) echo "result/result_".$_POST['login_user'].".jpg?d=".date("His");
	?>
