<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

    if(CModule::IncludeModule("iblock")){

		$IBLOCK_ID = 5;        // указываем из акого инфоблока берем элементы

		$arOrder = Array("SORT"=>"ASC","ID"=>"ASC");    // сортируем по свойству SORT по возрастанию
		$arSelect = Array("ID", "NAME", "IBLOCK_ID", "PROPERTY_EXAMPLE_LINK", "PROPERTY_NEW_WIN");
		$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);

		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();     
				//echo '<pre style="font-size:8px;">';print_r($arFields);echo '</pre>';        
			if($arFields["PROPERTY_NEW_WIN_VALUE"]=="да") $target="_blank";
			else $target="_self";
			// начинаем наполнять массив aMenuLinksExt нужными данными
			if($arFields["PROPERTY_EXAMPLE_LINK_VALUE"]) {
				$aMenuLinksExt[] = Array(
					$arFields['NAME'],
					$arFields["PROPERTY_EXAMPLE_LINK_VALUE"],
					Array(),
					Array("target"=>$target), 
					""
				);
			
			}       
			
		}  
	}
   //echo "<br>Массив <b>aMenuLinksExt</b> - дополнительный";
    //echo '<pre>'; print_r($aMenuLinksExt); echo '</pre>';    

 $aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);

?>