<? 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?php
if(isset($_POST['vcountry'])) $val_country=$_POST['vcountry'];
else $val_country="";
if(isset($_POST['vcity'])) $val_city=$_POST['vcity'];
else $val_city="";
if(isset($_POST['vnof'])) $val_nof=$_POST['vnof'];
else $val_nof="";

	
	if($val_country) {
		foreach($_SESSION["AR_OP"] as $k=>$v) {
			if(strtolower($v["country"])==strtolower($val_country)) {$ar_city_p[]=$v["city"];}

		}
		$ar_city_u=array_unique($ar_city_p);
		sort($ar_city_u);
		$coc=count($ar_city_u);
		echo $ar_city_u[0]."^";
		for($i=0;$i<$coc;$i++) {
			echo "<option";
			if(strtolower($_SESSION["passport_member"]["op_city"])==strtolower($ar_city_u[$i])) echo " selected";
			echo ">".$ar_city_u[$i]."</option>";
		}
	}

	//echo "<pre>";print_r($ar_city_u);echo "</pre>";

	if($val_city) {
		foreach($_SESSION["AR_OP"] as $k=>$v) {
		 if($v["city"]==$val_city) {$ar_nop[]=$k;}
		 }
		 $coc=count($ar_nop);
		 echo $ar_nop[0]."^";
		for($i=0;$i<$coc;$i++) {
			echo "<option";
			if($_SESSION["passport_member"]["op_nof"]==$ar_nop[$i]) echo " selected";
			echo ">".$ar_nop[$i]."</option>";
		}

	}

//echo "<pre>";print_r($ar_nop);echo "</pre>";
	if($val_nof) {
		echo $_SESSION["AR_OP"][$val_nof]["cur_id"]."^".$_SESSION["AR_OP"][$val_nof]["cur_sid"];
	}


//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>