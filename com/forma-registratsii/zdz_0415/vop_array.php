<?
//unset($_SESSION["AR_OP"]);
if(!isset($_SESSION["AR_OP"])) {
	 $za="SELECT `currency_number`,`code` FROM currency_list";
			
	$res = $DB->Query($za);
	while ($pa = $res->Fetch())
	{
		$ar_currency_id[$pa['code']]=$pa['currency_number'];
	//echo "<pre>";print_r($pa);echo "</pre>";
	}

	$xml = simplexml_load_file("../branch/branch.xml");
	$tew=count($xml->i);

	for($j=0;$j<$tew;$j++) {
		$n=(string)$xml->i[$j]["a"];
		$country=(string)$xml->i[$j]["b"];
		$city=(string)$xml->i[$j]["c"];
		$cur_sid=(string)$xml->i[$j]["d"];

		$ar_op[$n]["country"]=$country;
		$ar_op[$n]["city"]=$city;
		$ar_op[$n]["cur_sid"]=$cur_sid;
		$ar_op[$n]["cur_id"]=$ar_currency_id[$cur_sid];
		//echo $ar_op[$n];
	}

	
	 $_SESSION["AR_OP"]=$ar_op;
}
//echo "<pre>";print_r($_SESSION["AR_OP"]);echo "</pre>";
	foreach($_SESSION["AR_OP"] as $k=>$v) {
		$ar_country_p[]=$v["country"];
	}
	$ar_country_u=array_unique($ar_country_p);
	sort($ar_country_u);
	//echo "<pre>";print_r($ar_country_u);echo "</pre>";
?>	
