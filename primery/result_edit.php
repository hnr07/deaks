<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Редактирование результата формы");
?>
<br /><br /><br /><br />
Страница редактирования результата <?=$_GET["RESULT_ID"]?>, формы ID=<?=$_GET["WEB_FORM_ID"]?>
<br /><br />
<a href="#" onclick="history.back();">Вернуться</a>
<br /><br /><br /><br /><br /><br />
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>