<?//define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Продление демо-версии bitrix");
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
	За контроль демо-версии bitrix отвечают хэшированные значения дат в базе данных и в одном файле.
	<ul>
		<li>
			Ставим на локалке новый битрикс <br />или разворачиваем его здесь: <a href="https://www.1c-bitrix.ru/products/cms/demo.php#lab2" target="_blank">https://www.1c-bitrix.ru/products/cms/demo.php#lab2</a>
			<br /><br />
		</li>
		<li>
			Вытаскиваем из таблицы b_option значение NAME<br />
			&nbsp;&nbsp;&nbsp;<i>Настройки > Инструменты > SQL запрос</i><br /><br />
				
			Запрос для выбора значения записи admin_passwordh:
			<pre id="zapros1" title="скопировать в буфер">SELECT * FROM b_option WHERE `NAME`='admin_passwordh'</pre>
			Обновляем запись в своём битриксе
			<pre id="zapros2" title="скопировать в буфер">UPDATE b_option SET `VALUE` = '***********' WHERE `NAME`='admin_passwordh'</pre>
			Вместо *********** необходимо подставить результат предыдущего запроса
			<br /><br />
		</li 
		<li>
			Открыть файл <i>/bitrix/modules/main/admin/define.php</i><br />
			Заменить запись в файле в битриксе с истекшей лицензией записью из нового.
			<br /><br />
		</li>
		<li>
			Обязательно надо очистить папку <i>/bitrix/managed_cache/</i>
			<br /><br />
		</li>
	</ul>
	Можно продолжать работать над проектом ещё 30 дней.<br /><br />
	<a href="./demo_extension.txt" download title="скачать инструкцию">demo_extension.txt</a>
</div>
<script>

$(document).ready(function() {
	$("pre").on("click", function(){
		//var text=
		selectText(this.id);
    document.execCommand("copy");
	alert("Запрс\n\n"+$(this).text()+"\n\nскопирован в буфер обмена");
	});
	
	
});
function selectText(elementId) {
    var doc = document,
        text = doc.getElementById(elementId),
        range,
        selection;
        
    if (doc.body.createTextRange) {
        range = document.body.createTextRange();
        range.moveToElementText(text);
        range.select();
    } else if (window.getSelection) {
        selection = window.getSelection();        
        range = document.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
    }
}
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>