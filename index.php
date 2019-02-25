<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
global $link_start; 

header('Location: '.$link_start);
//header('Location: /primery/');
//header('Location: /about/');
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>