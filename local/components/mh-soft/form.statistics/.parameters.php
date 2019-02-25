<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!CModule::IncludeModule("form")) return;
////////////////////////////////
function AddPagerSettings(&$arComponentParameters, $pager_title, $bDescNumbering=true, $bShowAllParam=false)
	{
		$arHiddenTemplates = array(
			'js' => true
		);
		if (!isset($arComponentParameters['GROUPS']))
			$arComponentParameters['GROUPS'] = array();
		$arComponentParameters["GROUPS"]["PAGER_SETTINGS"] = array(
			"NAME" => GetMessage("T_IBLOCK_DESC_PAGER_SETTINGS"), // Настройки постраничной навигации
		);

		$arTemplateInfo = CComponentUtil::GetTemplatesList('bitrix:system.pagenavigation');
		if (empty($arTemplateInfo))
		{
			$arComponentParameters["PARAMETERS"]["PAGER_TEMPLATE"] = Array(
				"PARENT" => "PAGER_SETTINGS",
				"NAME" => GetMessage("T_IBLOCK_DESC_PAGER_TEMPLATE"), // Название шаблона
				"TYPE" => "STRING",
				"DEFAULT" => "",
			);
		}
		else
		{
			sortByColumn($arTemplateInfo, array('TEMPLATE' => SORT_ASC, 'NAME' => SORT_ASC));
			$arTemplateList = array();
			$arSiteTemplateList = array(
				'.default' => GetMessage('T_IBLOCK_DESC_PAGER_TEMPLATE_SITE_DEFAULT') //
			);
			$arTemplateID = array();
			foreach ($arTemplateInfo as &$template)
			{
				if ('' != $template["TEMPLATE"] && '.default' != $template["TEMPLATE"])
					$arTemplateID[] = $template["TEMPLATE"];
				if (!isset($template['TITLE']))
					$template['TITLE'] = $template['NAME'];
			}
			unset($template);

			if (!empty($arTemplateID))
			{
				$rsSiteTemplates = CSiteTemplate::GetList(
					array(),
					array("ID"=>$arTemplateID),
					array()
				);
				while ($arSitetemplate = $rsSiteTemplates->Fetch())
				{
					$arSiteTemplateList[$arSitetemplate['ID']] = $arSitetemplate['NAME'];
				}
			}

			foreach ($arTemplateInfo as &$template)
			{
				if (isset($arHiddenTemplates[$template['NAME']]))
					continue;
				$strDescr = $template["TITLE"].' ('.('' != $template["TEMPLATE"] && '' != $arSiteTemplateList[$template["TEMPLATE"]] ? $arSiteTemplateList[$template["TEMPLATE"]] : GetMessage("T_IBLOCK_DESC_PAGER_TEMPLATE_SYSTEM")).')';
				$arTemplateList[$template['NAME']] = $strDescr;
			}
			unset($template);
			$arComponentParameters["PARAMETERS"]["PAGER_TEMPLATE"] = array(
				"PARENT" => "PAGER_SETTINGS",
				"NAME" => GetMessage("T_IBLOCK_DESC_PAGER_TEMPLATE_EXT"), // Шаблон постраничной навигации
				"TYPE" => "LIST",
				"VALUES" => $arTemplateList,
				"DEFAULT" => ".default",
				"ADDITIONAL_VALUES" => "Y"
			);
		}

		$arComponentParameters["PARAMETERS"]["DISPLAY_TOP_PAGER"] = Array(
			"PARENT" => "PAGER_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_TOP_PAGER"), //Выводить над списком
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		);
		$arComponentParameters["PARAMETERS"]["DISPLAY_BOTTOM_PAGER"] = Array(
			"PARENT" => "PAGER_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_BOTTOM_PAGER"), // Выводить под списком
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		);
		$arComponentParameters["PARAMETERS"]["PAGER_TITLE"] = Array(
			"PARENT" => "PAGER_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_PAGER_TITLE"), // Название категорий
			"TYPE" => "STRING",
			"DEFAULT" => $pager_title,
		);
		$arComponentParameters["PARAMETERS"]["PAGER_SHOW_ALWAYS"] = Array(
			"PARENT" => "PAGER_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_PAGER_SHOW_ALWAYS"), // Выводить всегда
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		);

		if($bDescNumbering)
		{
			$arComponentParameters["PARAMETERS"]["PAGER_DESC_NUMBERING"] = Array(
				"PARENT" => "PAGER_SETTINGS",
				"NAME" => GetMessage("T_IBLOCK_DESC_PAGER_DESC_NUMBERING"), // Использовать обратную навигацию
				"TYPE" => "CHECKBOX",
				"DEFAULT" => "N",
			);
			$arComponentParameters["PARAMETERS"]["PAGER_DESC_NUMBERING_CACHE_TIME"] = Array(
				"PARENT" => "PAGER_SETTINGS",
				"NAME" => GetMessage("T_IBLOCK_DESC_PAGER_DESC_NUMBERING_CACHE_TIME"), // Время кеширования страниц для обратной навигации
				"TYPE" => "STRING",
				"DEFAULT" => "36000",
			);
		}

		if($bShowAllParam)
		{
			$arComponentParameters["PARAMETERS"]["PAGER_SHOW_ALL"] = Array(
				"PARENT" => "PAGER_SETTINGS",
				"NAME" => GetMessage("T_IBLOCK_DESC_SHOW_ALL"), // Показывать ссылку \"Все\"
				"TYPE" => "CHECKBOX",
				"DEFAULT" => "Y"
			);
		}
	}
///////////////////////////////
$arrForms = array();
$rsForm = CForm::GetList($by='s_sort', $order='asc', !empty($_REQUEST["site"]) ? array("SITE" => $_REQUEST["site"]) : array(), $v3);
while ($arForm = $rsForm->Fetch())
{
	$arrForms[$arForm["ID"]] = "[".$arForm["ID"]."] ".$arForm["NAME"];
}

if (intval($arCurrentValues["WEB_FORM_ID"]) > 0)
{
	$arFieldList = array();
	//$arFieldList[0]=GetMessage("UNSPECIFIED");

	CForm::GetDataByID($arCurrentValues["WEB_FORM_ID"], 
		$form, 
		$questions, 
		$answers, 
		$dropdown, 
		$multiselect);

	
	foreach($answers as $key => $val) {
		$field_type=$val[0]['FIELD_TYPE'];
		if($field_type=="dropdown" OR $field_type=="multiselect" OR $field_type=="radio" OR $field_type=="checkbox") {

				$arFieldList[$questions[$key]["SID"]] = "[".$questions[$key]["SID"]."] ".$questions[$key]["TITLE"];
			
		}
	}
	
}
if (intval($arCurrentValues["WEB_FORM_ID"]) > 0)
{
	$show_list_status = true;
	 // получим список всех статусов формы, соответствующих фильтру
	$rsStatuses = CFormStatus::GetList(
		$arCurrentValues["WEB_FORM_ID"], 
		$by="s_id", 
		$order="desc", 
		$arFilter, 
		$is_filtered
		);
	while ($arStatus = $rsStatuses->Fetch())
	{
		$arStatusList[$arStatus["ID"]] = "[".$arStatus["ID"]."] ".$arStatus["TITLE"];
	}
	$arStatusList_edit=$arStatusList;
	$arStatusList_edit[0]=GetMessage("UNCHANGED"); // Без изменений
}
else
{
	$show_list_status = false;
}

$arComponentParameters = array(
"GROUPS" => array(
		"FORM_PARAMS" => array(
			"NAME" => GetMessage("COMP_FORM_GROUP_PARAMS") // Параметры компонента
		),
	),	

	"PARAMETERS" => array(
	"VARIABLE_ALIASES" => Array(
		),
		"SEF_MODE" => Array(
		), 
	
		"WEB_FORM_ID" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_WEB_FORM_ID"), // ID веб-формы
			"TYPE" => "LIST",
			"VALUES" => $arrForms,
			"REFRESH" => "Y",
			"ADDITIONAL_VALUES"	=> "Y",
			"DEFAULT" => "={\$_REQUEST[WEB_FORM_ID]}",
			"PARENT" => "DATA_SOURCE",
		),
		
		"VIEW_URL" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_VIEW_URL"),  // Страница просмотра результата
			"TYPE" => "STRING",
			"DEFAULT" => "results_view.php",
			"PARENT" => "FORM_PARAMS",
		),
		
		"NEW_URL" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_NEW_URL"),  // Страница добавления результата
			"TYPE" => "STRING",
			"DEFAULT" => "result_new.php",
			"PARENT" => "FORM_PARAMS",
		),
		
		"SHOW_FILTER_STATUS" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_SHOW_FILTER_STATUS"),  // ID статусов результата применяемых в построении списка
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arStatusList,
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "",
			"PARENT" => "FORM_PARAMS",
		),
		
		"EXCLUDED_FROM_PROCESSING" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_EXCLUDED_FROM_PROCESSING"),  // Исключить поле из обработки
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arFieldList,
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "",
			"PARENT" => "FORM_PARAMS",
		),
		
		"CHAIN_ITEM_TEXT" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_CHAIN_ITEM_TEXT"),  // Название дополнительного пункта в навигационной цепочке
			"TYPE" => "STRING",
			"DEFAULT" => "",
			"PARENT" => "FORM_PARAMS",
		),

		"CHAIN_ITEM_LINK" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_CHAIN_ITEM_LINK"),  // Ссылка на дополнительном пункте в навигационной цепочке
			"TYPE" => "STRING",
			"DEFAULT" => "",
			"PARENT" => "FORM_PARAMS",
		),
		
		"PAGE_SIZE" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_PAGE_SIZE"),  // Результатов на странице по умолчанию
			"TYPE" => "STRING",
			"DEFAULT" => "20",
			"PARENT" => "FORM_PARAMS",
		),
	),
	

);

AddPagerSettings($arComponentParameters, GetMessage("T_IBLOCK_DESC_PAGER_RESULT_LIST"), false, false); // Результат
?>