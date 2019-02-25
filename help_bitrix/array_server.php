<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пример суперглобального массива \$_SERVER для этой страницы");
?>
<link rel="stylesheet" type="text/css" href="/css/help_bitrix.css" />
<!--<h3>Пример суперглобального массива $_SERVER для этой страницы</h3>-->

<pre style="font-size:10pt;"><?print_r($_SERVER);?></pre>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>