<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?

//echo "<pre>";print_r($_POST);echo "</pre>";

//echo "<pre>";print_r($_SESSION["order"]["add_elem"]);echo "</pre>";
$itogo=0;$itogo_weight=0;$itogo_qty=0;
$c_elem=count($_SESSION["order"]["add_elem"]);
if($c_elem>0) {
	foreach($_SESSION["order"]["add_elem"] as $ear) {
		$itogo+=$ear["sum"];
		$itogo_weight+=$ear["weight"];
		$itogo_qty+=$ear["qty"];
	}
}
$_SESSION["order"]["itogo"]=$itogo;
$_SESSION["order"]["itogo_weight"]=$itogo_weight;
$_SESSION["order"]["itogo_qty"]=$itogo_qty;
echo $itogo."|".$itogo_weight."|".$itogo_qty."|".$c_elem;
?>

<?require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php";?>