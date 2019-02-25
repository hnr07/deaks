<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Иконки средством CSS");
?>
<h3>font-awesome</h3>
<p>Привязать стили к сайту одним из вариантов:</p>
<p>1. Ссылка на стили: <br />
$APPLICATION->SetAdditionalCSS("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
</p>
<p>2. Подключить файл: <a href="font-awesome.css" download>"font-awesome.css"</a> или файл <a href="font-awesome.min.css" download>"font-awesome.min.css"</a>. В подключенном файле изменить путь к <a href="fonts-awesome.zip" download>папке с шрифтами</a> на реальный. </p>
<p>
Выбрать класс только для тега &lt;i&gt;: 
<br /><i class="fa fa-star"></i> - &lt;i class="fa fa-star"&gt;&lt;/i&gt; 
<br /><i class="fa fa-star-half-o"></i> - &lt;i class="fa fa-star-half-o"&gt;&lt;/i&gt; 
<br /><i class="fa fa-star-o"></i> - &lt;i class="fa fa-star-o"&gt;&lt;/i&gt; 
</p>
<p>Взято отсюда <a href="https://fontawesome.ru/" target="_blank">https://fontawesome.ru/</a></p>
<p>
Все иконки <a href="https://fontawesome.ru/all-icons/" target="_blank">https://fontawesome.ru/all-icons/</a>
 <iframe src="https://fontawesome.ru/all-icons/" style="width:99%;height:600px;border:solid 1px #b2b2b2;">
    Ваш браузер не поддерживает плавающие фреймы!
 </iframe>
 </p>
 <p>
Примеры <a href="https://fontawesome.ru/examples/" target="_blank">https://fontawesome.ru/examples/</a>
 <iframe src="https://fontawesome.ru/examples/" style="width:99%;height:600px;border:solid 1px #b2b2b2;">
    Ваш браузер не поддерживает плавающие фреймы!
 </iframe>
 </p>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>