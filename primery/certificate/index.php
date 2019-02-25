<?define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Создать сертификат");
global $USER;

$login_user=$USER->GetLogin(); // Логин пользователя
$fio_s=$USER->GetFullName(); // ФИО пользователя

$fontsize=45; //исходный размер шрифта
$xsize=200;  // исходная координата по оси X
?>

<link rel="stylesheet" type="text/css" href="/css/private_office.css" />
<div class="image">
<?

/*
$fontsize=45; //исходный размер шрифта
$xsize=200;  // исходная координата по оси X

	
	if(isset($_POST["fio_s"]) && $_POST["fio_s"]) $fio_s=$_POST["fio_s"];
	else $fio_s=$USER->GetFullName();
	
	if($_POST['t_res']) {
		if(isset($_POST['t_min'])) $f=$_GET['f']-5;
		if(isset($_POST['t_max'])) $f=$_GET['f']+5;
		if(isset($_POST['t_left'])) $x=$_GET['x']-10;
		if(isset($_POST['t_right'])) $x=$_GET['x']+10;
	}
	else {
		$f=$fontsize;
		$x=$xsize;
	}
	//echo"<pre>";print_r($_POST);echo"</pre>";
	class watermark1
	{
	  function create_watermark( $main_img_obj, $text, $r = 0, $g = 0, $b = 0, $alpha_level = 100, $f, $x)
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
	$c_m = imagecolorallocate ($main_img_obj, 82, 37, 128);
	   imagettftext($main_img_obj,$f ,$angle, $x, 850, $c_m, $font1, $text);
	   
	  
	   
	   return $main_img_obj;
	  }
	}
	$watermark = new watermark1();
	$img = imagecreatefromjpeg("CC_Megafon_certificate-00.jpg");
	$yo=array("Ё","ё");$e=array("Е","е");
	$text = str_replace($yo,$e,$fio_s);
	$im=$watermark->create_watermark($img,$text, 99,99,99,10,$f,$x);

	imagejpeg($im,"result/result_".$USER->GetLogin().".jpg");
	*/
	?>
</div>
<style>
.form_red_fio {
	display:block;
}
.form_red_text, .form_red_fio {
	border:solid 1px #caac70;
	text-align:center;
	color:#ad8e4d;
}
.form_red_text button{
	margin:5px;
	border:solid 1px #caac70;
	color:#ad8e4d;
	width:70px;
	border-radius:8px;
}
.form_red_fio input, .form_red_fio button, .a_download{
	margin:5px;
	padding-left:5px;
	border:solid 1px #caac70;
	color:#ad8e4d;
	width:170px;
	border-radius:8px;
}
.private_office .right .image {
	box-sizing: border-box;
	width:650px;
	height:920px;
	position:relative;
	background-color:#fff;
	background-position:center;
	background-repeat:no-repeat;
	background-image:url('/images/preloader_64.gif');

}
.private_office .right .image .result {
	box-sizing: border-box;
	width:650px;
	height:920px;
	position:absolute;
	top:0px;
	left:0px;
	background-color:transparent;
	background-position:center;
	background-repeat:no-repeat;
	background-size:contain;
}
</style>

<script>
$(document).ready(function(){
	/*
	$('#form_edit').submit(function(){
		var s=$(window).scrollTop();
		$("#w_scroll").val(s);
	 // alert(s);
	  return true;
	});

	$(window).scrollTop($("#w_scroll").val());
	*/
	edit_img("fio_s");
	$('#form_edit button').on("click", function(){
		edit_img($(this).val());
	});
	function edit_img(event) {
		//alert(event);
		var login_user=$("input[name=login_user]").val();
		var fio_s=$("input[name=fio_s]").val();
		var fontsize=$("input[name=fontsize]").val()*1;
		var xsize=$("input[name=xsize]").val()*1;
		if(event!="fio_s") {
			switch(event) {
				case "t_min":if(fontsize>20){fontsize-=5;$("input[name=fontsize]").val(fontsize);}break;
				case "t_max":if(fontsize<110){fontsize+=5;$("input[name=fontsize]").val(fontsize);}break;
				case "t_left":if(xsize>50){xsize-=10;$("input[name=xsize]").val(xsize);}break;
				case "t_right":if(xsize<1000){xsize+=10;$("input[name=xsize]").val(xsize);}break;
			}
		}
		//alert(fontsize);
		var data="login_user="+login_user+"&fio_s="+fio_s+"&fontsize="+fontsize+"&xsize="+xsize;
		//alert(data);
		var url="./image.php";
		$.ajax({  
			type: "POST",
			url: url,  
			data: data, 
			cache: false,  
			success: function(html){ 
				//$("#res_ajax").html(html);
				$(".private_office .right .image .result").animate({opacity: '0'},400).animate({opacity: '100'},400);
				setTimeout(function(){$(".private_office .right .image").html('<div class="result" style="background-image:url('+html+');"></div>');},400);
				//$(".private_office .right .image .result").animate({opacity: '100'},400);
			} 
		});
	}
});
</script>

	<br><br>
<h1><?=$fio_s;?> - <?//$APPLICATION->ShowTitle();?>сертификат <img src="megafon.png" width="200" align="middle" style="margin-bottom:18px;"></h1>
<div id="res_ajax"></div>
<div class="border-top"></div>
<div class="private_office">
	<div class="left" style="width:200px;">
		<div style="width:200px;position:fixed;">
			<!--<form id="form_edit" action="?f=<?=$f?>&x=<?=$x?>" method="POST">
			<input type="hidden" value="<?=$_POST['w_scroll']?>" name="w_scroll" id="w_scroll">
				<div class="form_red_fio">
					<div>Изменить Ф.И.О</div>
					<input type="text" name="fio_s" value="<?=$fio_s?>">
					<input type="submit" value="Изменить">	
				</div>	
					<br />
				<div class="form_red_text">
					<div>Настроить</div>
					<input type="hidden" name="t_res" value="1">
					<input type="submit" name="t_min" value="меньше" title="Шрифт ФИО меньше"> <input type="submit" name="t_max" value="больше" title="Шрифт ФИО больше"><br />
					<input type="submit" name="t_left" value="влево" title="Сдвинуть ФИО влево"> <input type="submit" name="t_right" value="вправо" title="Сдвинуть ФИО вправо">	
				</div>
			</form>-->
			<div id="form_edit" action="#" method="POST">
			
				<div class="form_red_fio">
					<div>Изменить Ф.И.О</div>
					<input type="text" name="fio_s" value="<?=$fio_s?>">
					<button type="button" value="fio_s" class="">Изменить</button>	
				</div>	
					<br />
				<div class="form_red_text">
					<div>Настроить</div>
					<input type="hidden" name="login_user" value="<?=$login_user?>"><input type="hidden" name="fontsize" value="<?=$fontsize?>"><input type="hidden" name="xsize" value="<?=$xsize?>">
					<button type="button" value="t_min" title="Шрифт ФИО меньше">меньше</button> <button type="button" value="t_max" title="Шрифт ФИО больше">больше</button><br />
					<button type="button" value="t_left" title="Сдвинуть ФИО влево">влево</button> <button type="button" value="t_right" title="Сдвинуть ФИО вправо">вправо</button>	
				</div>
			</div>
			<br />
			<a href="result/result_<?=$USER->GetLogin()?>.jpg"  download><button class="a_download">Скачать сертификат</button></a>
			<br /><br />
			<!--
				<ul class="content-menu-left">
					<li style="height:70px"><a href="Coral_club_full_new.pdf">Тарифный план "МегаФон Онлайн корпоративный для Coral Club"</a></li>
					<li><a href="new_Coral.pdf">Тарифный план "Генеральный"</a></li>
				</ul>
			-->
		</div>	
	</div>
	
	
	
	<div class="right" style="margin-left:210px;">
	<?//include "image.php";?>
		<!--<img src="result/result_<?=$USER->GetLogin()?>.jpg?d=<?=date("His")?>" width="650" align="top">-->
		<div class="image"></div>
	</div>

</div>
	

<div class="clear-all"></div>
<br /><br /><br /><br />
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>