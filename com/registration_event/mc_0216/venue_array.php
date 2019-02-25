<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludePublicLangFile(__FILE__);
global $lang;
// массив площадок мероприятия

$ar_vlm["v1"]=array(
	"name"=>GetMessage("v1_name"), // Наименование площадки
	"datemin"=>GetMessage("v1_datemin"), // Даты проведения 
	"text"=>GetMessage("v1_text"), // Описание
	"img"=>"/images/registration_event/venue/".$code_m."/".GetMessage("v1_img"), // Фото
	"info_print"=>"/com/registration_event/".$code_m."/files/".$lang."/".GetMessage("v1_print"), // Файл 
	"mesto"=>400, // Доступно мест
	"bron"=>10, //  Забронировано мест
	"door"=>1   // Открыть - 1, закрыть -0 площадку
);

$ar_vlm["v2"]=array(
	"name"=>GetMessage("v2_name"), // Наименование площадки
	"datemin"=>GetMessage("v2_datemin"), // Даты проведения 
	"text"=>GetMessage("v2_text"), // Описание
	"img"=>"/images/registration_event/venue/".$code_m."/".GetMessage("v2_img"), // Фото
	"info_print"=>"/com/registration_event/".$code_m."/files/".$lang."/".GetMessage("v2_print"), // Файл 
	"mesto"=>500, // Доступно мест
	"bron"=>10, //  Забронировано мест
	"door"=>1   // Открыть - 1, закрыть -0 площадку
);
/*
$ar_vlm["v3"]=array(
	"name"=>GetMessage("v3_name"), // Наименование площадки
	"datemin"=>GetMessage("v3_datemin"), // Даты проведения 
	"text"=>GetMessage("v3_text"), // Описание
	"img"=>"/images/registration_event/venue/".$code_m."/".GetMessage("v3_img"), // Фото
	"info_print"=>"/com/registration_event/".$code_m."/files/".$lang."/".GetMessage("v3_print"), // Файл 
	"mesto"=>300, // Доступно мест
	"bron"=>10, //  Забронировано мест
	"door"=>0   // Открыть - 1, закрыть -0 площадку
);
*/

//echo"<pre>";print_r($ar_vlm);echo"</pre>";
?>