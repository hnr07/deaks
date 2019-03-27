<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
global $ar_fres;
//echo "<pre>";print_r($arResult["ITEMS"]);echo "</pre>";
foreach($arResult["ITEMS"] as $arItem){
	$k=$arItem["PROPERTIES"]["status"]["VALUE_XML_ID"];
	$ar_fres[$k][$arItem["ID"]]["ID"]=$arItem["ID"];
	$ar_fres[$k][$arItem["ID"]]["IBLOCK_ID"]=$arItem["IBLOCK_ID"];
	$ar_fres[$k][$arItem["ID"]]["NAME"]=$arItem["NAME"];
	$ar_fres[$k][$arItem["ID"]]["PREVIEW_TEXT"]=$arItem["PREVIEW_TEXT"];
	$ar_fres[$k][$arItem["ID"]]["PREVIEW_PICTURE"]=$arItem["PREVIEW_PICTURE"]["SRC"];
	$ar_fres[$k][$arItem["ID"]]["site"]=$arItem["PROPERTIES"]["site"]["VALUE"];
	$ar_fres[$k][$arItem["ID"]]["primer"]=$arItem["PROPERTIES"]["primer"]["VALUE"];
	$ar_fres[$k][$arItem["ID"]]["ID"]=$arItem["ID"];
}
//echo "<pre>";print_r($ar_fres);echo "</pre>";
?>