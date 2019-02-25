<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Стартовая страница для веб-окружения");
?>
<style>
.s_img {
	width:400px;
	height:300px;
	float:left;
	border:solid 1px #b2b2b2;
	margin-bottom:60px;
}
</style>
<script>
	$(document).ready(function() {
		$('.fancybox').fancybox();	
	});
	</script>
<h2><?$APPLICATION->ShowTitle();?></h2>
<p>
Эта страница, установленная в <a href="http://www.1c-bitrix.ru/download/vmbitrix.php#tab-env-link" target="_blank">«Битрикс: Веб-окружение»</a>, позволяет создавать неограниченное количество локальных версии сайтов, одновременно открывать и управлять ими.
После создания сайта необходимо перезапустить <a href="http://www.1c-bitrix.ru/download/vmbitrix.php#tab-env-link" target="_blank">«Битрикс: Веб-окружение»</a>, чтобы сайт "прописался" на локальном хостинге и можно загружать в папку нового сайта необходимые файлы. Также при помощи этой страницы можно создавать базы данных для локальных сайтов. 
</p>
<div class="s_img" style="margin-right:50px;">
<a class="fancybox" data-fancybox-group="gallery" href="/images/start_web/www_1.jpg"><img src="/images/start_web/www_1_m.jpg"></a>
</div>
<div class="s_img">
<a class="fancybox" data-fancybox-group="gallery" href="/images/start_web/www_2.jpg"><img src="/images/start_web/www_2_m.jpg"></a>
</div>

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>