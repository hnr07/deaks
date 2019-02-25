<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
echo "<pre>";print_r($_SESSION);echo "</pre>";

if(session_is_registered("test")) echo 1;
else echo 0;
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>