
 <?
$dir='';
$token = '1906409005.4d4cec6.f8a94ddca5414ae58bb0849040cd7da6';
$user_id = '1906409005';
$instagram_cnct = curl_init(); // инициализация cURL подключения

curl_setopt( $instagram_cnct, CURLOPT_URL, "https://api.instagram.com/v1/users/" . $user_id . "/media/recent?access_token=" . $token ); // подключаемся
curl_setopt( $instagram_cnct, CURLOPT_RETURNTRANSFER, 1 ); // просим вернуть результат
curl_setopt( $instagram_cnct, CURLOPT_TIMEOUT, 15 );
$media = json_decode( curl_exec( $instagram_cnct ) ); // получаем и декодируем данные из JSON
curl_close( $instagram_cnct ); // закрываем соединение

//echo "<pre>";print_r($media);echo "</pre>";
$limit = 20;
$size = 200;

foreach(array_slice($media->data, 0, $limit) as $data) {
	$ar_files[]=$data->images->low_resolution->url;
	echo '<a href="' . $data->link . '" target="_blank">';
	echo '<img src="'. $data->images->low_resolution->url . '" height="'.$size.'" width="'.$size.'"/>';
	echo '</a>';
}
if(!count($ar_files)) { 
	$dir = './images/inst_foto/';
	$ar_files = scandir($dir);

	if(($key = array_search('.',$ar_files)) !== FALSE){
		 unset($ar_files[$key]);
	}
	if(($key = array_search('..',$ar_files)) !== FALSE){
		 unset($ar_files[$key]);
	}
	//echo "<pre>";print_r($ar_files);echo "</pre>";
	}
?>

<div class="inst_slider_box">
	
	<div id="inst_slider" class="owl-carousel" style="">
		<?foreach($ar_files as $src) { ?>
			<a href="#"  title="     Это - пример. &#013;Ссылка отключена."><div class="item" style="background-image:url('<?=$dir.$src?>');width:205px;height:205px;"></div></a>
		 <?}?>	  
	</div>
	
</div>
			
			    <script>
				
    $(document).ready(function() {
      $("#inst_slider").owlCarousel({
        autoPlay : 3000,
        stopOnHover : true,
        navigation:true,
        items : 5,
      itemsDesktop : [1200,4], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,3], // betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0
      itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
        transitionStyle:"fade"
      });
    });
    </script>
</div>