<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск переводов");
?>
<script src="/js/portamento/portamento.js"></script>
<?
//echo "<pre>";print_r($_POST);echo "</pre>";
?>
<?
if($_POST["posubmit"]) {
	if($_POST["toch"]) $sp="";
	else $sp="%";

	if($_POST["potype"]=="c") $fn_potext=$sp.$_POST["potext"].$sp;
	else $fn_potext="";
	
	if($_POST["potype"]=="t") $ft_potext=$sp.$_POST["potext"].$sp;
	else $ft_potext="";
	
			$arSort=array();
			
			$arFilter=array("IBLOCK_CODE"=>'translation', "ACTIVE"=>"Y", "NAME"=>$fn_potext,'PROPERTY_translation'=>$ft_potext, "PROPERTY_lang_VALUE"=>"");
			
			$res_translation = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);

			while($ob_translation = $res_translation->GetNextElement()) {

		$arFields_translation = $ob_translation->GetFields();
		 $arProps_translation = $ob_translation->GetProperties();
	$translation[$arFields_translation["~NAME"]][$arProps_translation["lang"]["~VALUE"]]=$arProps_translation["translation"]["~VALUE"];

		// echo"<pre>";print_r($arFields_translation);echo"</pre>";
		// echo"<pre>";print_r($arProps_translation);echo"</pre>";
	}
	//echo"<pre>";print_r($translation);echo"</pre>";
	$ct=count($translation);
}
?>
<style>
#poform   {
	background-color:#f2f2f2;
	border:solid 1px #b9b9b9;
	z-index:1000;
	width:1140px;
	}
#poform td  {
	padding:10px;
	}
#poform input[type=text], #poform input[type=submit] {
	border:solid 1px #b2b2b2;
	vertical-align:top;
	width:160px;
	}
#poform select  {
	border:solid 1px #b2b2b2;
	vertical-align:top;
	}
	
#potable .po_result{
	margin:10px 0px;
	padding:10px;
	border:solid 1px #b9b9b9;
	width:1120px;
}
#potable .po_result .code{
	width:250px;
	height:100%;
	display:inline-block;
	margin-right:20px;
	vertical-align: top;
}
#potable .po_result .trans{
	width:650px;
	display:inline-block;
}
#potable .po_result .trans .st_r, #potable .po_result .ires .st_r{
	margin-bottom:5px;
}

#potable .po_result .ires{
	/*border-top:solid 1px #d5d5d5;*/
	margin-top:10px;
	padding-top:10px;
	display:block;
}

#potable .po_result .trans .st_r div, #potable .po_result .ires .st_r div{
	display:inline-block;
	border:solid 1px #969696;
	background-color:#969696;
	border-radius:10px;
	color:#fff;
	width:15px;
	text-align:center;
	padding:2px;
}

	#portamento_container #poform.fixed {position:fixed;} 
		
</style>
<script>
/*
$(document).ready(function(){
	$('#poform').submit(function(){
		if($("#potext").val()) {return true;}
		else {
		  alert('Не заполнено поле "Что ищем?"');
		  return false;
		}
	});
});
*/
</script>
<div id="po_content">

<form method="POST" id="poform">
	<table>
		<tr><td>Что ищем?</td><td>Где ищем?</td><td>Точно</td><td>Ключ для массива</td><td>&nbsp;</td></tr>
		<tr>
			<td>
				<input type="text" name="potext" id="potext" value="<?=$_POST["potext"]?>">
			</td><td>
				<select name="potype">
					<option value="t" <?=($_POST["potype"]=="t")?"selected":""?>>Перевод</option>
					<option value="c" <?=($_POST["potype"]=="c")?"selected":""?>>Код перевода &nbsp;</option>
				</select>
			</td><td>
				<input type="checkbox" name="toch" value="1" <?=($_POST["toch"])?"checked":""?>>
			</td><td>
				<input type="text" name="ncode" value="<?=$_POST["ncode"]?>">
			</td>
			<td>
				<input type="submit" value=" выбрать " name="posubmit">
			</td>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;<?=($ct)?"Найдено:  <b>".$ct:"</b>"?>
			</td>
		</tr>
	</table>
</form>

<?if($ct) {?>
<div id="potable">
	<?foreach($translation as $c=>$lt) {
		if($_POST["ncode"]) $ncode=$_POST["ncode"];
		else $ncode=$c;
		?>
	<div class="po_result">
		<div class="code"><b><?=$c?></b></div>
		<div class="trans">
		<?foreach($lt as $l=>$t) {?>
		<?$ar_pp[$l]="GetMessage('".$ncode."')"." | "."\$MESS ['".$ncode."'] = '".$t."';"?>
		<div class="st_r"><div><?=$l?></div> - <?=$t?></div>
		<?}?>
		</div>
		<hr>
	
	<div class="ires">
		<?foreach($ar_pp as $l=>$t) {?>
			<div class="st_r"><div><?=$l?></div> - <?=$t?></div>
		<?}?>
		<?unset($ar_pp);?>
	</div>
	</div>
	<?}?>
</div>
<?}?>
<?if($_POST["posubmit"] && !$ct) {?> <br />Ничего не найдено. <?}?>
</div>
<script>
			$('#poform').portamento({wrapper: $('#po_content')});	// set #wrapper as the visual coundary of the panel
			
		</script>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>