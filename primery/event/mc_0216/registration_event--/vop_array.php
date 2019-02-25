<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");?>
<?IncludePublicLangFile(__FILE__);?>
<?
//require("filter/GetBranch.php");	
	 

// массив отделов продаж

$ar_op[100]=array("country"=>GetMessage("rossiya"), "city"=>GetMessage("moskva"));
$ar_op[102]=array("country"=>GetMessage("rossiya"), "city"=>GetMessage("moskva"));
$ar_op[101]=array("country"=>GetMessage("ukraina"), "city"=>GetMessage("odessa"));
$ar_op[103]=array("country"=>GetMessage("rossiya"), "city"=>GetMessage("tumen"));
$ar_op[105]=array("country"=>GetMessage("rossiya"), "city"=>GetMessage("surgut"));

///////////////// это для тестирования! Убрать при реальном обмене! ////////////////////
$_SESSION["AR_OP"]=$ar_op; 
$_SESSION["AR_OP"][100]["cur_id"]=810; $_SESSION["AR_OP"][100]["cur_sid"]="RUR";
$_SESSION["AR_OP"][101]["cur_id"]=980; $_SESSION["AR_OP"][101]["cur_sid"]="UAH";
//////////////////////////////////////////////////////////////////////////////////////


//echo"<pre>";print_r($ar_op);echo"</pre>";

// Замена наименований на текущий язык
foreach($_SESSION["AR_OP"] as $k=>$v) {
		if($ar_op[$k]["country"]) $_SESSION["AR_OP"][$k]["country"]=$ar_op[$k]["country"];
		if($ar_op[$k]["city"]) $_SESSION["AR_OP"][$k]["city"]=$ar_op[$k]["city"];
	}
	
//echo "<pre>";print_r($_SESSION["AR_OP"]);echo "</pre>";
	foreach($_SESSION["AR_OP"] as $k=>$v) {
		$ar_country_p[]=$v["country"];
	}
	$ar_country_u=array_unique($ar_country_p);
	sort($ar_country_u);
	//echo "<pre>";print_r($ar_country_u);echo "</pre>";
?>	