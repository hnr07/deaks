<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>

<?
include "../in_json/i_code.php";
?>
<h3>Исходная строка JSON</h3>
<div style="width:900px;overflow: auto;">
<?
$obj_json=json_decode($new);
echo $new;
?>
</div>
<br /><br />
<hr>
<br /><br />
<h3>Результат - объект PHP</h3>
<div style="width:900px;height:400px;overflow: auto;">
<?echo "<pre>";print_r($obj_json);echo "</pre>";?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>