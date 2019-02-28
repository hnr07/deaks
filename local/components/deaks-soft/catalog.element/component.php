<?
use Bitrix\Main\Context,
	Bitrix\Main\Loader,
	Bitrix\Main\Type\Collection,
	Bitrix\Main\Type\DateTime,
	Bitrix\Main,
	Bitrix\Currency,
	Bitrix\Catalog,
	Bitrix\Iblock;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */
/** @global CCacheManager $CACHE_MANAGER */
global $CACHE_MANAGER;

/*************************************************************************
	Processing of received parameters
*************************************************************************/
if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
$arParams["SECTION_ID"] = intval($arParams["SECTION_ID"]);
$arParams['SECTION_CODE'] = trim($arParams['SECTION_CODE']);

$arParams["ELEMENT_ID"] = intval($arParams["~ELEMENT_ID"]);

if($arParams["ELEMENT_ID"] > 0 && $arParams["ELEMENT_ID"]."" != $arParams["~ELEMENT_ID"])
{
	if (Loader::includeModule('iblock'))
	{
		\Bitrix\Iblock\Component\Tools::process404(
			trim($arParams["MESSAGE_404"]) ?: GetMessage("CATALOG_ELEMENT_NOT_FOUND")
			,true
			,$arParams["SET_STATUS_404"] === "Y"
			,$arParams["SHOW_404"] === "Y"
			,$arParams["FILE_404"]
		);
	}
	return;
}
echo $arParams["ELEMENT_ID"];


//$arSelect=array_merge(array("IBLOCK_ID", "ID"), $ar_prop);
$arFilter = array(
   //"IBLOCK_ID" => $arParams["IBLOCK_ID"],
   "ID" => $arParams["ELEMENT_ID"],
   "IBLOCK_LID" => SITE_ID,
   "ACTIVE" => "Y",
   ); 
$res_elem = CIBlockElement::GetList(array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
	while($ob = $res_elem ->GetNextElement()){ 
		 $arFields = $ob->GetFields();  
		//print_r($arFields);
		 $arProps = $ob->GetProperties();
		//print_r($arProps);
	}
	
$arResult["ELEMENT"]=$arFields;
$arResult["ELEMENT"]["PREVIEW_PICTURE_SRC"]=CFile::GetPath($arFields["PREVIEW_PICTURE"]);
$arResult["ELEMENT"]["DETAIL_PICTURE_SRC"]=CFile::GetPath($arFields["DETAIL_PICTURE"]);
//if($arFields["PREVIEW_PICTURE"]) $arResult["ELEMENT"]["PICTURE"][]=$arResult["ELEMENT"]["PREVIEW_PICTURE_SRC"];
if($arFields["DETAIL_PICTURE"]) $arResult["ELEMENT"]["PICTURE"][]=$arResult["ELEMENT"]["DETAIL_PICTURE_SRC"];

foreach($arParams["PROPERTY_CODE_SPETIFIC"] as $code_prop) {
	if($code_prop) $arResult["PROPERTIES"]["SPETIFIC"][$code_prop]=$arProps[$code_prop];
}
foreach($arParams["PROPERTY_CODE_COLUMN"] as $code_prop) {
	if($code_prop) $arResult["PROPERTIES"]["COLUMN"][$code_prop]=$arProps[$code_prop];
}
foreach($arParams["PROPERTY_CODE_PHOTO"] as $code_prop) {
	if($code_prop) {
		if($arProps[$code_prop]["PROPERTY_TYPE"]=="F" || $arProps[$code_prop]["USER_TYPE"]=="video") {
			$arResult["PROPERTIES"]["PHOTO"][$code_prop]=$arProps[$code_prop];
			/*if($code_prop]["MULTIPLE"]=="Y"){
				foreach() {
					
				}
			}
			else {
				
			}*/
			$arResult["PROPERTIES"]["PHOTO"][$code_prop]=$arProps[$code_prop];
		}
	}
}
$arResult["DISPLAY_PROPERTIES"] = array();
			$propertyList = array();
			if (!empty($arParams['PROPERTY_CODE_PHOTO']))
			{
				$selectProperties = array_fill_keys($arParams['PROPERTY_CODE_PHOTO'], true);
				$propertyIterator = Iblock\PropertyTable::getList(array(
					'select' => array('ID', 'CODE'),
					'filter' => array('=IBLOCK_ID' => $arParams['IBLOCK_ID'], '=ACTIVE' => 'Y'),
					'order' => array('SORT' => 'ASC', 'ID' => 'ASC')
				));
				while ($property = $propertyIterator->fetch())
				{
					$code = (string)$property['CODE'];
					if ($code == '')
						$code = $property['ID'];
					if (!isset($selectProperties[$code]))
						continue;
					$propertyList[] = $code;
					unset($code);
				}
				unset($property, $propertyIterator);
				unset($selectProperties);
			}
			echo "ff<pre>";print_r($propertyList);echo "</pre>";
			if (!empty($propertyList))
			{
				foreach ($propertyList as $pid)
				{
					//if (!isset($arResult["PROPERTY_CODE_PHOTO"][$pid]))	continue;
					//$prop = $arResult["PROPERTY_CODE_PHOTO"][$pid];
					//$boolArr = is_array($prop);
					//echo $prop["VALUE"];
					//if (
					//		($boolArr && !empty($prop["VALUE"]))
					//		|| (!$boolArr && (string)$prop["VALUE"] !== '')
					//)
					//{
						$arResult["DISPLAY_PROPERTIES"][$pid] = CIBlockFormatProperties::GetDisplayValue($arResult, $arResult[PROPERTIES][PHOTO][$pid], "catalog_out");
					//}
					//unset($prop);
					echo ">><pre>"; print_r($arResult[PROPERTIES][PHOTO][$pid]); echo "</pre>";
				}
				unset($pid);
			}
			unset($propertyList);
//$arResult["DISPLAY_PROPERTIES"]=CIBlockFormatProperties::GetDisplayValue($arResult["ELEMENT"], $arParams["PROPERTY_CODE_PHOTO"][MORE_PHOTO]);
//echo "^^^^^^^^^^^<pre>";print_r($arResult["DISPLAY_PROPERTIES"]);echo "</pre>";

if(isset($arResult["ELEMENT"]))
{
echo $arResult["ELEMENT"]["ELEMENT_ID"];
// check form params
		$arParams["USER_ID"] = $USER->GetID();
		$this->IncludeComponentTemplate();
	return $arResult["ID"];
}
else
{
	return 0;
}