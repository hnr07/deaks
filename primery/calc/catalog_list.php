<?
if($_POST["cur"]) $_SESSION['code_currency']=$_POST["cur"];

CModule::IncludeModule("catalog");
$dbPriceType = CCatalogGroup::GetList(
        array("SORT" => "ASC"),
        array()
    );
while ($arPriceType = $dbPriceType->Fetch())
{
  // echo"<pre>";print_r($arPriceType);echo"</pre>";
   $ar_prace_id[$arPriceType["NAME"]]=$arPriceType["ID"];
}
 //echo"<pre>";print_r($ar_prace_id);echo"</pre>";
 $prace_id=$ar_prace_id[$_SESSION['code_currency']];

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE","CATALOG_GROUP_".$prace_id, "PROPERTY_UPAKOVKA", "PROPERTY_CML2_ARTICLE");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
$arFilter = Array("IBLOCK_CODE"=>"catalog_dls", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement()){ 
 $arFields = $ob->GetFields();  
//echo"<pre>";print_r($arFields);echo"</pre>";
 //$arProps = $ob->GetProperties();
//echo"<pre>";print_r($arProps);echo"</pre>";


	$ar_code=explode("_",$arFields["CODE"]);
	$code=$ar_code[0];
	$offers=$arFields["PROPERTY_UPAKOVKA_VALUE"];

	$ar_pit[$code]["CODE"]=$code;
	$ar_pit[$code]["NAME"]=$code; 
	$ar_pit[$code]["IBLOCK_ID"]=$arFields["IBLOCK_ID"];
 
	$ar_pit[$code]["PICTURE"]='<img src="/images/dls/'.$code.'dls.png" align="top">';
	$ar_pit[$code]["SRC"]="/images/dls/".$code."dls.svg";
	
		if($offers>0) {
		$ar_pit[$code]["FLAG_OFFERS"]="Y";
		
			$ar_pit[$code]["OFFERS"][$offers]["ID"]=$arFields["ID"];
			$ar_pit[$code]["OFFERS"][$offers]["CODE"]=$arFields["CODE"];
			$ar_pit[$code]["OFFERS"][$offers]["NAME"]=$code."_".$offers;
			$ar_pit[$code]["OFFERS"][$offers]["CATALOG_PRICE_1"]=$arFields["CATALOG_PRICE_".$prace_id];
			$ar_pit[$code]["OFFERS"][$offers]["CATALOG_CURRENCY_1"]=$_SESSION['code_currency'];
			$ar_pit[$code]["OFFERS"][$offers]["ARTNUMBER"]=$arFields["PROPERTY_CML2_ARTICLE_VALUE"];
			$ar_pit[$code]["OFFERS"][$offers]["UPAKOVKA"]=$offers;
			$ar_tp=explode(".",$ar_pit[$code]["OFFERS"][$offers]["CATALOG_PRICE_1"]);
			$ar_pit[$code]["OFFERS"][$offers]["PRICES"]["TEXT"]=$ar_tp[0].(($ar_tp[1]>0)?",<span>".$ar_tp[1]."</span>":"");
			$ar_pit[$code]["OFFERS"][$offers]["CENA"]=round($ar_pit[$code]["OFFERS"][$offers]["CATALOG_PRICE_1"]/$offers,2);
	}
	else {
		$ar_pit[$code]["ID"]=$arFields["ID"];
		$ar_pit[$code]["FLAG_OFFERS"]="N";
		$ar_pit[$code]["CATALOG_PRICE_1"]=$arFields["CATALOG_PRICE_".$prace_id];
		$ar_pit[$code]["CATALOG_CURRENCY_1"]=$_SESSION['code_currency'];
		$ar_tp=explode(".",$ar_pit[$code]["CATALOG_PRICE_1"]);
		$ar_pit[$code]["PRICES"]["TEXT"]=$ar_tp[0].(($ar_tp[1]>0)?",<span>".$ar_tp[1]."</span>":"");
		$ar_pit[$code]["ARTNUMBER"]=$arFields["PROPERTY_CML2_ARTICLE_VALUE"];
	}
}

$_SESSION["ar_pit"]=$ar_pit;

?>