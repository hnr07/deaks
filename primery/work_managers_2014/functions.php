<?
global $arR;
global $arQ;
$arR = $arResult;
$arQ = $arResult["QUESTIONS"];
//echo"<pre>";echo print_r($arR);echo"</pre>";
//echo"<pre>";echo print_r($arQ);echo"</pre>";
?>

<?
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



?>