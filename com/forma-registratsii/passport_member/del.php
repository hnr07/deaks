<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?  CModule::IncludeModule('form'); // подключаем модуль форма ?>
<?
function ft($n) {
global $array_form_translation;
	if($array_form_translation[$n]) return $array_form_translation[$n];
	else return t($n);
}
$RESULT_ID=$_POST["result_id"];
$title=$_POST["title"];
if (CFormResult::Delete($RESULT_ID))
{
    echo "1^<div class='tit'>".$title."</div>";
}
else // ошибка
{
    echo "0^ERROR / ОШИБКА  \"".$title."\".";
}
?>

<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>