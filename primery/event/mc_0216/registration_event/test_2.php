<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
$_SESSION["test"]="1234567";
echo "<pre>";print_r($_SESSION);echo "</pre>";
echo session_name()."<br>";
$path=session_save_path();
echo $path;
phpinfo();
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>