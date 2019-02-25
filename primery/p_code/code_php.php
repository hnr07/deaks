&lt;?

require_once($_SERVER["DOCUMENT_ROOT"]."/ccws/sum_models/class_event.php");
global $ccws;
$ccws= new ccws_event();


global $arR;
global $arQ;
$arR = $arResult;
$arQ = $arResult["QUESTIONS"];
//echo"&lt;pre&gt;";echo print_r($arR);echo"&lt;/pre&gt;";
//echo"&lt;pre&gt;";echo print_r($arQ);echo"&lt;/pre&gt;";

?&gt;
&lt;?
function fGetResultValues($sFieldName, $item = 0)
{
	global $arR;
	global $arV;
	$arV = $arR[arrVALUES];
return $arV[fGetName($sFieldName, $item)];

}
function fGetValue($sFieldName, $item = 0)
{
	global $arR;
	
	$arQ = $arR["QUESTIONS"];
	$fieldType = $arQ[$sFieldName]["STRUCTURE"][$item]["FIELD_TYPE"];
	if($fieldType == "checkbox" || $fieldType == "radio" || $fieldType == "dropdown"){
		$ret = $arQ[$sFieldName]["STRUCTURE"][$item]["ID"];
	}
	else{
		$ret = $_REQUEST[fGetName($sFieldName)];
	}
	return $ret;
}

function fGetName($sFieldName, $item = 0)
{
	global $arR;
	
	$arQ = $arR["QUESTIONS"];
	$fieldType = $arQ[$sFieldName]["STRUCTURE"][$item]["FIELD_TYPE"];
	$ret = "form_";
	if($fieldType == "checkbox" || $fieldType == "radio" || $fieldType == "dropdown"){
		$ret .= $fieldType."_".$sFieldName;
	}
	else{
		$ret .= $fieldType."_".$arQ[$sFieldName]["STRUCTURE"][$item]["ID"];
	}
	if($fieldType == "checkbox"){
		$ret .= "[]";
	}
	return $ret;
}

function fGetQuestion($sFieldName)
{
	global $arR;
	return $arR["arQuestions"][$sFieldName]["TITLE"];
}

function fGetAnswer($sFieldName, $item = 0)
{
	global $arR;
	return $arR["arAnswers"][$sFieldName][$item]["MESSAGE"];
}
function fGetAnswerCode($sFieldName, $item = 0)
{
	global $arR;
	return $arR["arAnswers"][$sFieldName][$item]["VALUE"];
}

function fGetActive($sFieldName)
{
	global $arR;
	$arQ = $arR["QUESTIONS"];
	if($arQ[$sFieldName]) return true;
	else return false;
}

function fGetComments($sFieldName)
{
	global $arR;
	return $arR["arQuestions"][$sFieldName]["COMMENTS"];
}

function SelectLang($sFieldName,$separator="~")
{
	global $lang_form;
	$ar_str	=explode($separator,$sFieldName);
	return($ar_str[$lang_form]);
}
function fGetHTML($sFieldName) 
{
global $arQ;
	return $arQ[$sFieldName]["HTML_CODE"];
}

// функция принудительного выбора языка перевода
/*
function ft($n,$l) {
	if($n) {
		$ar_ft_filter=array("SECTION_CODE"=&gt;"registration_form", "INCLUDE_SUBSECTIONS"=&gt;"Y", "ACTIVE"=&gt;"Y", "NAME"=&gt;$n, "PROPERTY_lang_VALUE"=&gt;$l);
			$res=CIBlockElement::GetList(array(), $ar_ft_filter);
			$ob=$res-&gt;GetNextElement();
			if($ob && $l) {
			$prop=$ob-&gt;GetProperties();
			return $prop["translation"]["~VALUE"];
			}
			else return t($n);
	}
}
*/
function ft($n) {
global $array_form_translation;
	if($array_form_translation[$n]) return $array_form_translation[$n];
	else return t($n);
}

function date_in_int($std) {
$ar_d=explode(".", $std);
return $ar_d[2].$ar_d[1].$ar_d[0];
}

?&gt;