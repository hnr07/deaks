<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?

//echo "<pre>";print_r($_POST);echo "</pre>";
if($_POST["del"]=="Y") {
	unset($_SESSION["order"]["add_elem"][$_POST["id"]]);
}
else {
	$_SESSION["order"]["add_elem"][$_POST["id"]]["id"]=$_POST["id"];
	$_SESSION["order"]["add_elem"][$_POST["id"]]["name_before_elem"]=$_POST["name_before_elem"];
	$_SESSION["order"]["add_elem"][$_POST["id"]]["name_elem"]=$_POST["name_elem"];
	$_SESSION["order"]["add_elem"][$_POST["id"]]["size_elem"]=$_POST["size_elem"];
	$_SESSION["order"]["add_elem"][$_POST["id"]]["src_elem"]=$_POST["src_elem"];
	$_SESSION["order"]["add_elem"][$_POST["id"]]["qty"]=$_POST["qty"];
	$_SESSION["order"]["add_elem"][$_POST["id"]]["price_packing"]=$_POST["price_packing"];
	$_SESSION["order"]["add_elem"][$_POST["id"]]["price"]=$_POST["price"];
	$_SESSION["order"]["add_elem"][$_POST["id"]]["packing"]=$_POST["packing"];
	$_SESSION["order"]["add_elem"][$_POST["id"]]["unit_elem"]=$_POST["unit_elem"];
	$_SESSION["order"]["add_elem"][$_POST["id"]]["sum"]=$_POST["sum"];
	$_SESSION["order"]["add_elem"][$_POST["id"]]["weight"]=$_POST["weight"];
}
//echo "<pre>";print_r($_SESSION["order"]["add_elem"]);echo "</pre>";
/*
if(count($_SESSION["order"]["add_elem"])>0) {
	$itogo=0;$itogo_weight=0;
	foreach($_SESSION["order"]["add_elem"] as $ear) {
		$itogo+=$ear["sum"];
		$itogo_weight+=$ear["weight"];
	}
	$_SESSION["order"]["itogo"]=$itogo;
	$_SESSION["order"]["itogo_weight"]=$itogo_weight;
}
else {
	$_SESSION["order"]["itogo"]=0;
	$_SESSION["order"]["itogo_weight"]=0;
}
*/
?>

<?require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php";?>