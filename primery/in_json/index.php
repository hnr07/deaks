<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>

<?
include "i_code.php";
?>
<h3>Исходный массив PHP</h3>
<div style="width:900px;height:200px;overflow: auto;">
<?
echo "<pre>";print_r($ar_ri);echo "</pre>";
?>
</div>
<br /><br />
<hr>
<br /><br />
<h3>Результат - строка JSON</h3>
<div style="width:900px;overflow: auto;">
<?echo $new;?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>