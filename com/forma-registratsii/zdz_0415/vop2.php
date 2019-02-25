<? 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>

<?php

if(isset($_POST['vcountry'])) $val_country=$_POST['vcountry'];
else $val_country=0;
if(isset($_POST['vcity'])) $val_city=$_POST['vcity'];
else $val_city=0;
if(isset($_POST['vnof'])) $val_nof=$_POST['vnof'];
else $val_nof=0;

//echo iconv ('utf-8', 'windows-1251',$val_city);
$xml = simplexml_load_file("../branch/branch.xml");
$tew=count($xml->i);	
if($val_country) {
			for($i=0;$i<$tew;$i++) {
		$tc=((string)$xml->i[$i]['b']);
		//$tc=iconv ('utf-8', 'windows-1251',((string)$xml->i[$i]['b']));
		//echo $val_country." >> ".$tc."<br/>";
			if($val_country==$tc) { 
			$ar_vop_cy[$i]=(string)$xml->i[$i]['c'];
			//$ar_vop_cy[$i]=iconv ('utf-8', 'windows-1251',((string)$xml->i[$i]['c']));
			}
		}
		//echo $ar_vop_cy;
	$ar_vop_cyu=array_unique($ar_vop_cy);
	$coc=count($ar_vop_cyu);
	sort($ar_vop_cyu,SORT_STRING);
	//$vcity=$_POST['vcity'];
	//$vcity=iconv ('utf-8', 'windows-1251',$_POST['vcity']);
	//echo $ncity;
	echo "<select  id='sel_op_city' name='".$_POST['zcity']."' onChange=\"f_nas_city('".$_POST['znof']."')\">";
	for($i=0;$i<$coc;$i++) {
	echo "<option";
		//if($vcity==$ar_vop_cyu[$i]) echo " selected";
		echo ">".$ar_vop_cyu[$i]."</option>";
	}
	echo "</select>";
}
if($val_city) {
			for($i=0;$i<$tew;$i++) {
		$tc=((string)$xml->i[$i]['c']);
		//$tc=iconv ('utf-8', 'windows-1251',((string)$xml->i[$i]['c']));
		//echo $val_country." >> ".$tc."<br/>";
			if($val_city==$tc) { 
			$ar_vop_cy[$i]=(string)$xml->i[$i]['a'];
			//$ar_vop_cy[$i]=iconv ('utf-8', 'windows-1251',((string)$xml->i[$i]['PersonId']));
			}
		}
		//echo $ar_vop_cy;
	$ar_vop_cyu=array_unique($ar_vop_cy);
	$coc=count($ar_vop_cyu);
	sort($ar_vop_cyu,SORT_STRING);

	echo "<select  id='sel_op_nof' name='".$_POST['znof']."'  onchange=\"pro_su()\">";
	for($i=0;$i<$coc;$i++) {
	echo "<option value=\"".$ar_vop_cyu[$i]."\"";
		//if($vcity==$ar_vop_cyu[$i]) echo " selected";
		echo ">".$ar_vop_cyu[$i]."</option>";
	}
	echo "</select>";
}
if($val_nof) {
	for($i=0;$i<$tew;$i++) {
		$tc=((string)$xml->i[$i]['a']);
		//$tc=iconv ('utf-8', 'windows-1251',((string)$xml->i[$i]['b']));
		//echo $val_country." >> ".$tc."<br/>";
			if($val_nof==$tc) { 
			$cur=trim((string)$xml->i[$i]['d']);
			//$cur=iconv ('utf-8', 'windows-1251',(trim((string)$xml->i[$i]['d'])));
			}
		}
		///////////// массив обозначений валют ////////////
 //include "../config/exchange.php"; 
 $za="SELECT `currency_number` FROM currency_list WHERE `code`='".$cur."'";
		if(!($z=mysql_query($za))) {$error="";}
		else{ 
		$pa=mysql_fetch_array($z);
		$currency_id=$pa['currency_number'];
		}
 	//echo  array_search($cur,$ar_textcur)."^".$cur;
	echo $currency_id."^".$cur;
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>