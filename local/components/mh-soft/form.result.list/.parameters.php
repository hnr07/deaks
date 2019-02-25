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
			"NAME" => GetMessage("T_IBLOCK_DESC_PAGER_SETTINGS"),
		);

		$arTemplateInfo = CComponentUtil::GetTemplatesList('bitrix:system.pagenavigation');
		if (empty($arTemplateInfo))
		{
			$arComponentParameters["PARAMETERS"]["PAGER_TEMPLATE"] = Array(
				"PARENT" => "PAGER_SETTINGS",
				"NAME" => GetMessage("T_IBLOCK_DESC_PAGER_TEMPLATE"),
				"TYPE" => "STRING",
				"DEFAULT" => "",
			);
		}
		else
		{
			sortByColumn($arTemplateInfo, array('TEMPLATE' => SORT_ASC, 'NAME' => SORT_ASC));
			$arTemplateList = array();
			$arSiteTemplateList = array(
				'.default' => GetMessage('T_IBLOCK_DESC_PAGER_TEMPLATE_SITE_DEFAULT')
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
				"NAME" => GetMessage("T_IBLOCK_DESC_PAGER_TEMPLATE_EXT"),
				"TYPE" => "LIST",
				"VALUES" => $arTemplateList,
				"DEFAULT" => ".default",
				"ADDITIONAL_VALUES" => "Y"
			);
		}

		$arComponentParameters["PARAMETERS"]["DISPLAY_TOP_PAGER"] = Array(
			"PARENT" => "PAGER_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_TOP_PAGER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		);
		$arComponentParameters["PARAMETERS"]["DISPLAY_BOTTOM_PAGER"] = Array(
			"PARENT" => "PAGER_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_BOTTOM_PAGER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		);
		$arComponentParameters["PARAMETERS"]["PAGER_TITLE"] = Array(
			"PARENT" => "PAGER_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_PAGER_TITLE"),
			"TYPE" => "STRING",
			"DEFAULT" => $pager_title,
		);
		$arComponentParameters["PARAMETERS"]["PAGER_SHOW_ALWAYS"] = Array(
			"PARENT" => "PAGER_SETTINGS",
			"NAME" => GetMessage("T_IBLOCK_DESC_PAGER_SHOW_ALWAYS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		);

		if($bDescNumbering)
		{
			$arComponentParameters["PARAMETERS"]["PAGER_DESC_NUMBERING"] = Array(
				"PARENT" => "PAGER_SETTINGS",
				"NAME" => GetMessage("T_IBLOCK_DESC_PAGER_DESC_NUMBERING"),
				"TYPE" => "CHECKBOX",
				"DEFAULT" => "N",
			);
			$arComponentParameters["PARAMETERS"]["PAGER_DESC_NUMBERING_CACHE_TIME"] = Array(
				"PARENT" => "PAGER_SETTINGS",
				"NAME" => GetMessage("T_IBLOCK_DESC_PAGER_DESC_NUMBERING_CACHE_TIME"),
				"TYPE" => "STRING",
				"DEFAULT" => "36000",
			);
		}

		if($bShowAllParam)
		{
			$arComponentParameters["PARAMETERS"]["PAGER_SHOW_ALL"] = Array(
				"PARENT" => "PAGER_SETTINGS",
				"NAME" => GetMessage("T_IBLOCK_DESC_SHOW_ALL"),
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
	$rsFieldList = CFormField::GetList(intval($arCurrentValues["WEB_FORM_ID"]), "ALL", $by="s_sort", $order="asc", array(), $is_filtered);
	$arFieldList = array();
	while ($arField = $rsFieldList->GetNext())
	{
		$arFieldList[$arField["SID"]] = "[".$arField["SID"]."] ".$arField["TITLE"];
	}
	$arFieldList[0]=GetMessage("UNSPECIFIED");
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
	$arStatusList_edit[0]=GetMessage("UNCHANGED");
}
else
{
	$show_list_status = false;
}

$arYesNo = array("Y" => GetMessage("FORM_COMP_VALUE_YES"), "N" => GetMessage("FORM_COMP_VALUE_NO"));

$arComponentParameters = array(
	"GROUPS" => array(
		"FORM_PARAMS" => array(
			"NAME" => GetMessage("COMP_FORM_GROUP_PARAMS")
		),
	),	

	"PARAMETERS" => array(
		"VARIABLE_ALIASES" => Array(
		),
		"SEF_MODE" => Array(
		), 		

		"WEB_FORM_ID" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_WEB_FORM_ID"), 
			"TYPE" => "LIST",
			"VALUES" => $arrForms,
			"REFRESH" => "Y",
			"ADDITIONAL_VALUES"	=> "Y",
			"DEFAULT" => "={\$_REQUEST[WEB_FORM_ID]}",
			"PARENT" => "DATA_SOURCE",
		),
		"ENABLE_RESULT_VIEW" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_ENABLE_RESULT_VIEW"), 
			"TYPE" => "CHECKBOX",
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "Y",
			"PARENT" => "FORM_PARAMS",
		),
		"ENABLE_STATUS_EDIT" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_ENABLE_STATUS_EDIT"), 
			"TYPE" => "CHECKBOX",
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "Y",
			"PARENT" => "FORM_PARAMS",
		),
		"ENABLE_RESULT_EDIT" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_ENABLE_RESULT_EDIT"), 
			"TYPE" => "CHECKBOX",
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "Y",
			"PARENT" => "FORM_PARAMS",
		),
		"ENABLE_RESULT_COPY" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_ENABLE_RESULT_COPY"), 
			"TYPE" => "CHECKBOX",
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "Y",
			"PARENT" => "FORM_PARAMS",
		),	
		"ENABLE_RESULT_DEL" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_ENABLE_RESULT_DEL"), 
			"TYPE" => "CHECKBOX",
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "Y",
			"PARENT" => "FORM_PARAMS",
		),
		"ENABLE_STAT_VIEW" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_ENABLE_STAT_VIEW"), 
			"TYPE" => "CHECKBOX",
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "Y",
			"PARENT" => "FORM_PARAMS",
		),	
	
		"OLD_RESULT_STATUS" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_OLD_RESULT_STATUS"), 
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"VALUES" => $arStatusList_edit,
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "",
			"PARENT" => "FORM_PARAMS",
		),
		"NEW_RESULT_STATUS" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_NEW_RESULT_STATUS"), 
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"VALUES" => $arStatusList_edit,
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "",
			"PARENT" => "FORM_PARAMS",
		),
	
		"VIEW_URL" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_VIEW_URL"), 
			"TYPE" => "STRING",
			"DEFAULT" => "result_view.php",
			"PARENT" => "FORM_PARAMS",
		),
		
		"EDIT_URL" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_EDIT_URL"), 
			"TYPE" => "STRING",
			"DEFAULT" => "result_edit.php",
			"PARENT" => "FORM_PARAMS",
		),

		"NEW_URL" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_NEW_URL"), 
			"TYPE" => "STRING",
			"DEFAULT" => "result_new.php",
			"PARENT" => "FORM_PARAMS",
		),
		"COPY_URL" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_COPY_URL"), 
			"TYPE" => "STRING",
			"DEFAULT" => "",
			"PARENT" => "FORM_PARAMS",
		),
		"STAT_URL" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_STAT_URL"), 
			"TYPE" => "STRING",
			"DEFAULT" => "stat_view.php",
			"PARENT" => "FORM_PARAMS",
		),
		
		"SHOW_FILTER_STATUS" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_SHOW_FILTER_STATUS"), 
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arStatusList,
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "",
			"PARENT" => "FORM_PARAMS",
		),
		"FIELD_QUICK_SEARCH" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_FIELD_QUICK_SEARCH"), 
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"VALUES" => $arFieldList,
			"ADDITIONAL_VALUES" => "N",
			"DEFAULT" => "",
			"PARENT" => "FORM_PARAMS",
		),
	
		"CHAIN_ITEM_TEXT" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_CHAIN_ITEM_TEXT"), 
			"TYPE" => "STRING",
			"DEFAULT" => "",
			"PARENT" => "FORM_PARAMS",
		),

		"CHAIN_ITEM_LINK" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_CHAIN_ITEM_LINK"), 
			"TYPE" => "STRING",
			"DEFAULT" => "",
			"PARENT" => "FORM_PARAMS",
		),
		
		"PAGE_SIZE" => array(
			"NAME" => GetMessage("COMP_FORM_PARAMS_PAGE_SIZE"), 
			"TYPE" => "STRING",
			"DEFAULT" => "20",
			"PARENT" => "FORM_PARAMS",
		),

	),
	
);

AddPagerSettings($arComponentParameters, GetMessage("T_IBLOCK_DESC_PAGER_RESULT_LIST"), false, false);
?>