<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Шрифты и подключение");
?>
<style>
pre {
	font-size:10pt;
}
table td {
	border-bottom:dotted 1px #000;
}
textarea {
	font-size:14pt;
	font-weight: normal;
    font-style: normal;
	width:250px;
	height:250px;
}
</style>


<?CModule::IncludeModule("iblock");
$ptx="qwertyuiopasdf\nghjklzxcvbnm\nQWERTYUIOPASDF\nGHJKLZXCVBNM\n1234567890\nйцукенгшщзфыва\nпролдячсмитьё\nЙЦУКЕНГШЩЗФЫВА\nПРОЛДЖЯЧСМИТЬЁ";
$i=0;
$res = CIBlockElement::GetList(array("SORT"=>"ASC"), array('IBLOCK_CODE' => 'fonts_css', 'ACTIVE' => 'Y'), false, false, /*Array("nPageSize"=>10),*/ $arSelect);
while($ob = $res->GetNextElement()) {

	$arFields = $ob->GetFields();
	 $arProps = $ob->GetProperties();
	 $ar_vlm[$i]["IBLOCK_ID"]=$arFields["IBLOCK_ID"];
	 $ar_vlm[$i]["ID"]=$arFields["ID"];
	 $ar_vlm[$i]["type"]=$arFields["IBLOCK_NAME"];
	 $ar_vlm[$i]["NAME"]=$arFields["NAME"];
	 $ar_vlm[$i]["CODE"]=$arFields["CODE"];
	 
	 $vs=$arProps["font_face"]["VALUE"]["TEXT"];
	 if (preg_match('/font-family:(.*);/', $vs, $arr)) $ts = "\n.".$arFields["CODE"]." {\n".$arr[0]."\n}";
	 else $ts='';
	 $ar_vlm[$i]["font_face"]=$vs.$ts;
	 $ar_vlm[$i]["font_file"]=$arProps["font_file"]["VALUE"];
	 	 
	 $ar_style[$i]=$vs.$ts;
	 
	 $i++;
	 //echo"<pre>";print_r($arFields);echo"</pre>";
	 //echo"<pre>";print_r($arProps);echo"</pre>";
	 
}

//echo"<pre>";print_r($ar_vlm);echo"</pre>";
?>
<style>
<?foreach($ar_style as $i_style) {
	//if(substr(trim($i_style),0,10)=="@font-face") {
?>
<?=$i_style?>
	<?//}?>
<?}?>
</style>
<table>
<?foreach($ar_vlm as $item) {?>
	<tr>
		<td>
			<b><?=$item["NAME"]?></b>
			<textarea class="<?=$item["CODE"]?>"><?=$ptx?></textarea>
		</td>
		<td>
			<a href="<?=$item["font_file"]?>" download title="скачать"><img src="/images/shrift_ico.png"></a>
		</td>
		<td>
<pre>
<?=$item["font_face"]?>
</pre>
		</td>
		
	</tr>
<?}?>
</table>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>