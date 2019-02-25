<?//define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Многосайтовость bitrix");
?>
<style>
.demo_extension i {
	font-size:90%;
	color:rgba(0, 0, 0, 0.6);
}
.demo_extension pre {
	font-size:120%;
	color:#623790;
	margin-left:20px;
	cursor:pointer;
}
</style>
<div class="demo_extension">
	Многосайтовость по второму способу. Разные домены на одном сервере. Доступ к ядру по символическим ссылкам.
	<ul>
		<li>
			Установить битрикс на одном сайте (сайт-1). Здесь будет ядро.
			<br /><br />
		</li>
		<li>
			Установить битрикс на другом сайте (сайт-2). Удалить папки /bitrix, /upload и /local. Эти папки будут общими.
			<br /><br />
		</li>
		<li>
			В корень сайта-2 закачать по ftp файл <a href="./symlink.zip" download title="файл для создания символических ссылок">symlink.php</a>. После запуска указать путь к корневой папке сайта-1.  
			<br /><br />
		</li>
		<li>
			В админке настроить каждый сайт. В поле "Путь к корневой папке веб-сервера для этого сайта" обязательно указать путь на сервере к корневой папке каждого сайта.
			<br /><br />
		</li>
	</ul>
	<a href="./symlink.zip" download title="файл для создания символических ссылок">скачать файл symlink.php (в архиве)</a>

	<p style="display:none;">
	<b>Как создать символьную ссылку в Windows.</b><br /><br />
	<i>В командной строке (Win+R, набрать в поле 'cmd', [OK]) ввести команду</i><br /><br />
	mklink /j "D:\OSPanel\domains\site_2\bitrix" "D:\OSPanel\domains\site_1\bitrix"<br /><br />
	<i>
	где /j -атрибут каталога, нужен, если ссылка на папку<br />
	"D:\OSPanel\domains\site_1\bitrix" - путь к исходной папке	<br />
	"D:\OSPanel\domains\site_2\bitrix" - путь к ссылке на исходную папку
</i>	
	</p>
	</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>