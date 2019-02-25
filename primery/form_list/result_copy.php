<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Редактирование заявки");
?>
<style>
.box_info {
	border:solid 1px #b2b2b2;
	width:300px;
	margin:auto;
	padding:10px;
	  -moz-box-shadow: 0 0 5px #000; /* Firefox */
    -webkit-box-shadow: 0 0 5px #000; /* Safari, Chrome */
    box-shadow: 0 0 5px #000; /* CSS3 */
}
</style>
<br /><br />
<div class="box_info">
Страница копирования результата <?=$_GET['RESULT_ID']?><br />
Для примера компонент отключён.<br /><br />
<a href="./">Вернуться >>></a>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>