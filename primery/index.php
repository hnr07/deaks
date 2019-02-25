<?
//define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Примеры");
global $USER;
?>
 <style>
.list_a {

}
.p_text {

	width:95%;
	border:solid 1px #b3b3b3;
	margin-bottom:20px;
	margin-left:10px;
	padding:10px;
	font-size:12pt;
	box-sizing: border-box;
	-moz-box-shadow:0px 0px 5px #623790;
	-webkit-box-shadow:0px 0px 5px #623790;
	box-shadow: 0px 0px 5px #623790;
	background:#fff;
	-webkit-transition: all 0.3s ease-out 0s;
     -moz-transition: all 0.3s ease-out 0s;
     -o-transition: all 0.3s ease-out 0s;
     transition: all 0.3s ease-out 0s;
}
.p_text:hover {
	background-color:#faf6fe;
	-webkit-transition: all 0.3s ease-out 0s;
     -moz-transition: all 0.3s ease-out 0s;
     -o-transition: all 0.3s ease-out 0s;
     transition: all 0.3s ease-out 0s;
}
.p_text button{
	height:24px;
	font-size:8pt;
	margin-top:5px;
	border:solid 2px #623790;
	background-color:#623790;
	color:#fff;
	cursor:pointer;
	transition: all 0.3s ease-out 0s;
}
.p_text button:hover{
	background-color:#fff;
	color:#623790;
	-moz-box-shadow:0px 0px 2px #623790;
	-webkit-box-shadow:0px 0px 2px #623790;
	box-shadow: 0px 0px 2px #623790;
	transition: all 0.3s ease-out 0s;
}
.p_text b {
	font-size:11pt;
}
.p_text a {
	color:#623790;
}
.p_text hr {
	background-color:#623790;
	color:#623790;
	border:0;
}
</style><br>
 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"primery_18",
	Array(
		"IBLOCK_TYPE" => "working",
		"IBLOCK_ID" => "5",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array("","undefined",""),
		"PROPERTY_CODE" => array("new_win","example_link","undefined",""),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N"
	)
);?><br>

 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>