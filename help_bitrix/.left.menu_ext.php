<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
/*
$aMenuLinksExt=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
	"IS_SEF" => "Y",
	"SEF_BASE_URL" => "/help_bitrix/",
	"SECTION_PAGE_URL" => "#SECTION_ID#/",
	"DETAIL_PAGE_URL" => "#SECTION_ID#/#ELEMENT_ID#",
	//"IBLOCK_TYPE" => "help_bitrix",
	"IBLOCK_ID" => "6",
	"DEPTH_LEVEL" => "1",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600"
	),
	false
);
*/
/*
$IBLOCK_ID = 25;        // указываем из акого инфоблока берем элементы

$arOrder = Array("SORT"=>"ASC");    // сортируем по свойству SORT по возрастанию
$arSelect = Array("ID", "NAME", "IBLOCK_ID", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);

    while($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();            // берем поля

		// начинаем наполнять массив aMenuLinksExt нужными данными
		$aMenuLinksExt[] = Array(
			$arFields['NAME'],
			$arFields['DETAIL_PAGE_URL'],
			Array(),
			Array(),
			""
		);
    }       
   
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
*/
?>