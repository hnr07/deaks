<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>


<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="">
<meta name="keywords" content="Мастерские каникулы">
<title>Мастерские каникулы</title>



	<link rel="icon" type="/image/vnd.microsoft.icon" href="/favicon.ico">



<link rel="stylesheet" type="text/css" href="/css/template-style48e0e.css?v=8" media="all">


 <script charset="utf-8" type="text/javascript" src="/js/jquery/jquery-1.9.1.js"></script>

  <script type="text/javascript" src="/js/fancybox/jquery.fancybox.js"></script>
	<link rel="stylesheet" href="/js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />

<script type="text/javascript">
                    var jQ = $.noConflict();
					var endDate = new Date("February 19, 2020 9:00:00"); // дата-время для таймера
					
</script>
		

		
				<link type="text/css" rel="stylesheet" href="/js/jquery/fancybox/jquery.fancybox-1.3.4c552.css?22663" />
				
		<script type="text/javascript" src="-/flowplay/flowplayer-3.2.2.min.js"></script>
		
		
		
		
		
				
				<script type="text/javascript" src="/js/event/jquery.colorbox.min.js"></script>
				<script type="text/javascript" src="/js/event/jquery.fancybox.js"></script>
				<script type="text/javascript" src="/js/event/jquery.jcarousel.min.js"></script>
				<script type="text/javascript" src="/js/event/masked.input.js"></script>
				<script type="text/javascript" src="/js/event/jquery.transit.min.js"></script>
				<script type="text/javascript" src="/js/event/jquery.countdown.min.js"></script>
				<script type="text/javascript" src="/js/event/jquery.countdown-ru.js"></script>
			
				
				<script type="text/javascript" src="/js/event/template-scripts_10.js"></script>
				<script type="text/javascript" charset="utf-8" src="/js/event/jquery/jqueryc552.js?22663"></script>
				
				
				
				
				
	
				
				
</head>
<body>
<?

include "registration_event/var_config.php";
//$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "registration_event/var_config.php"), false);
$ds_s=explode(".",$d_reg_s);
$ds=(int)($ds_s[2].$ds_s[1].$ds_s[0]);
$df_s=explode(".",$d_reg_f);
$df=(int)($df_s[2].$df_s[1].$df_s[0]);
$td=date("Ymd");

if($td>=$ds && $td<=$df){ 
	$registration=1;  // Разрешить регистрацию
	$registration_s=0;
	$registration_f=0;
}
else {
	$registration=0;  // Запретить регистрацию
	if($td<$ds) $registration_s=1;   // Регистрация не начата
	if($td>$df) $registration_f=1;  // Регистрация закончена
}

//$registration=0; $registration_s=1;
?>
<span id="lang" data-lang=""></span>

<div class="top-wrap">
	<div class="top-main">
	
<?//include "fonts.php"; // Примеры подключеных шрифтов ?>

		<?include "menu.php";  // меню?>

		<?include "header.php"; // верхний блок?>
		
		<div class="body">
		
			<?include "main-slider.php";  // верхний слайдер?>
			
			<?//include "logos-slider.php";   // слайдер логотипов?>
			
			<?include "block-countdown.php"; // до мероприятия осталось...?>
			
			<?//include "speakers.php"; // фото выступающих?>
			
			<?include "block-what.php"; // Что такое?>
			
			<?//include "block-stats.php"; // график-статистика?>

			<?include "block-who.php"; // Для кого?>
			
			<?//include "block-leaders.php"; // Лидеры о ...?>
			
			<?include "block-targets.php"; // Цели?>
			
			<?include "web_camera.php"; // Тем временем?>
			
			<?include "block-program.php"; // Программа?>

			<?//include "block-prices.php"; // Стоимость?>
			
			<?//include "block-results.php"; // Результаты?>
			
			<?//include "block-reviews.php"; // Отзывы участников?>
			
			<?//include "block-employer.php"; // оглашение результатов?>
			
			<?include "block-place.php"; // Место проведения?>

			<?//include "block-partners.php"; // Партнёры?>

			<?//include "block-press.php"; // Архив новостей?>	

			<?include "block-contacts.php"; //Контакты?>
			
			<?//include "conditions.php"; //Условия участия?>
			
			<?include "conditions_list.php"; //Условия участия?>

		</div>
	</div>
</div>

<?include "footer.php";?>



</body>

<!-- Mirrored from winningthehearts.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Jul 2015 10:49:28 GMT -->
</html>
