<?
global $USER;
global $strError;
$APPLICATION->SetTitle($arParams["arFormInfo"]["NAME"]);
 //echo "<pre>"; print_r($arParams); echo "</pre>";
 //echo "<pre>"; print_r($arResult["QUICK_SEARCH_ID_STR"]); echo "</pre>";

?>
<?
echo implode("<br />",$arResult["FORM_ERROR"]);
?>
<script>
function f_copy(n,f,s) {
document.getElementById("nom_copy").innerHTML=n;
document.getElementById("copy_id").value=n;
document.getElementById("WEB_FORM_ID").value=f;
document.getElementById("copy_status").value=s;
class_replace("box_copy");
}
function f_del(n) {
document.getElementById("nom_del").innerHTML=n;
document.getElementById("del_id").value=n;
class_replace("box_del");
}
function f_edit_status(n,s,t) {
document.getElementById("nom").innerHTML=n;
document.getElementById("sta").innerHTML=t;
document.getElementById("res_id_s").value=n;
	var dh=document.getElementById("default_status_id").innerHTML;
	document.getElementById("edit_status_id").innerHTML=dh;
	var elem=document.getElementById("o_"+s);
	elem.parentNode.removeChild(elem);
	class_replace("box_status");
	document.getElementById("but_edit_status").focus();
}

function f_quick_search(form_id,answer_id,sts,url_edit) {
var tqs=document.getElementById("tqs").value;
var templatefolder=document.getElementById("templatefolder").value;
var QS_NOTHING=document.getElementById("QS_NOTHING").value;
var QS_NOT_PARAMETRS=document.getElementById("QS_NOT_PARAMETRS").value;
var QS_CHANGE=document.getElementById("QS_CHANGE").value;
var QS_SELECT=document.getElementById("QS_SELECT").value;
  $.ajax({ 
				type: "POST",			
                url: templatefolder+"/quick_search.php",
				data: "tqs="+tqs+"&form_id="+form_id+"&answer_id="+answer_id+"&sts="+sts+"&url_edit="+url_edit+"&templatefolder="+templatefolder+"&QS_NOTHING="+QS_NOTHING+"&QS_NOT_PARAMETRS="+QS_NOT_PARAMETRS+"&QS_CHANGE="+QS_CHANGE+"&QS_SELECT="+QS_SELECT,  
                cache: false,  
                success: function(html){  
                    document.getElementById("result_quick_search").innerHTML=html;  
                }  
            });
	var id="box_qs";
	var elements = document.getElementById(id).className;
	var show=elements.indexOf('div_show');
	var none=elements.indexOf('div_none');
	if(show==-1)
	{
		if(none==-1) document.getElementById(id).className += ' div_show';
		else document.getElementById(id).className = elements.replace('div_none', 'div_show');
	}
	
}

function class_replace(id){

	var elements = document.getElementById(id).className;

	var show=elements.indexOf('div_show');
	var none=elements.indexOf('div_none');

	if(show==-1)
	{
		if(none==-1) document.getElementById(id).className += ' div_show';
		else document.getElementById(id).className = elements.replace('div_none', 'div_show');
	}
	else
	{
	document.getElementById(id).className = elements.replace('div_show', 'div_none');
	}
	
}

</script>
<div id="list_result_form">

 <input type="hidden" id="templatefolder" value="<?=$templateFolder?>">
<?if($_REQUEST["print"]!="Y") {?>
<h2><?$APPLICATION->ShowTitle();?></h2>
<br />
<div class="top">
	<?if(isset($_REQUEST["result_view"])) {?>
		<a href="?remove_qs=1" title="<?=GetMessage("FORM_QUICK_SEARCH_CLOSE")?>"><b>&#10006;</b></a>
	<?}?>
	<input type="text" id="tqs" name="tqs" oninput="f_quick_search(<?=$arParams["WEB_FORM_ID"]?>,'<?=$arResult["QUICK_SEARCH_ID_STR"]?>','<?=$arParams["STR_STATUS_DEFAULT"]?>','<?=$arParams["EDIT_URL"]?>')" title="<?=GetMessage("FORM_QUICK_SEARCH")?> <?=(($arResult["QUICK_SEARCH_TITLE"])?GetMessage("FORM_QUICK_SEARCH_OR")." '".$arResult["QUICK_SEARCH_TITLE"]."'":"")?>"> | 
	
	<?if($arParams["STICKER"]) {?>
	<a href="#" onclick="class_replace('box_sticker')"><?=GetMessage("FORM_STICKER")?></a> | 
	<?}?>
	<?if($arParams["ENABLE_STAT_VIEW"]=="Y" AND $arParams["STAT_URL"]!="") {?>
	<a href="<?=$arParams["STAT_URL"]?>?WEB_FORM_ID=<?=$arParams["WEB_FORM_ID"]?>"><?=GetMessage("FORM_STAT")?></a> | 
	<?}?>
	<a href="#" onclick="class_replace('div_filter')"><?=GetMessage("FORM_FILTER")?></a> | 
	<a href="#" onclick="class_replace('columns_tool')"><?=GetMessage("FORM_TOOLS")?></a> | 
	<?if($arParams["NEW_URL"]!="") {?>
	<a href='<?=$arParams["NEW_URL"]?>?WEB_FORM_ID=<?=$arParams["WEB_FORM_ID"]?>'><?=GetMessage("FORM_ADD_RESULT")?></a> | 
	<?}?>
	<a href="http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?><?=(strpos($_SERVER['REQUEST_URI'],"?"))?"&print=Y":"?print=Y"?>"><?=GetMessage("FORM_PRINT")?></a> | 
	<a href="<?=$templateFolder?>/help/<?=LANGUAGE_ID?>/help.php" target="_blank"><?=GetMessage("FORM_HELP")?></a>

</div>
<br />
<div class="clear-all"></div>

<!-- Блок фильтра начало -->
<div id="div_filter" class="div_filter">
<h3><?=GetMessage("FORM_FILTER_TITLE")?></h3><a href="#" onclick="class_replace('div_filter')"><?=GetMessage("FORM_HIDE")?></a><br />
<form action="" method="GET">
<table class="form-filter-table">
<tr><td><?=GetMessage("FORM_ID_RESULT")?></td><td><?=$arResult["ID_RESULT_TEXT_FILTER"]?></td></tr>
<tr><td><?=GetMessage("FORM_STATUS_RESULT")?></td><td>
<select name="find_status_id[]" multiple>
<option value="" <?=($_REQUEST["find_status_id"])?"":"selected"?>><?=GetMessage("FORM_ALL")?></option>
<?foreach($arResult["STATUS"] as $val) {?>
<option value="<?=$val["ID"]?>" <?=(in_array($val["ID"],$_REQUEST["find_status_id"]))?"selected":""?>><?=$val["TITLE"]?>(<?=$val["RESULTS"]?>)</option>
<?}?>
</select>
</td></tr>

<?
foreach($arResult["ARRAY_COL_FILTER"] as $val) 
{
?>
	<tr><td><?=$val["TITLE"]?></td><td><?=$val["TEXT_FILTER"]?></td></tr>
<?}?>

<tr><td><a href="?remove_filter=1"><input type="button" value="<?=GetMessage("FORM_FILTER_RESET")?>"></a></td>
<td><input type="submit" name="install_filter" value="<?=GetMessage("FORM_FILTER_INSTALL")?>"></td></tr>
</table>

</form>
</div>
<!-- Блок фильтра конец -->

<!-- Блок настроек начало -->
<div id="columns_tool" class="columns_tool">
<h3><?=GetMessage("FORM_TOOLS_TITLE")?></h3><a href="#" onclick="class_replace('columns_tool')"><?=GetMessage("FORM_HIDE")?></a><br /><br />
<form id="form_tool" name="form_tool" method="POST">
<table class="form-filter-table">
	<tr>
		<td>
		<b><?=GetMessage("FORM_TOOLS_TITLE_RES")?></b>
		<div class="list_c">
			<?foreach($arResult["ARRAY_COL"] as $val){?>
				<div class="l_col"> <input class="no_filter" type="checkbox" name="no_filter_<?=$val["SID"]?>" value="<?=$val["SID"]?>" <?=(in_array($val["SID"],$arResult["ARRAY_FINAL_FILTER"])?"checked":"")?> title="<?=GetMessage("FORM_TOOLS_MARK_FILTER")?>"> <input type="text" class="no_col" name="no_col_<?=$val["SID"]?>" value="<?=(in_array($val["SID"],$arResult["ARRAY_FINAL_COL"]))?(array_search($val["SID"],$arResult["ARRAY_FINAL_COL"])+1)*10:""?>" title="<?=GetMessage("FORM_TOOLS_NUMBER_FIELD")?>"><?=$val["TITLE"]?></div>
			<?}?>
		</div>
		</td>
		
		<td>
		<div class="div_pstr"><b><?=GetMessage("FORM_TOOLS_RESULTS_STR")?></b> <input class="no_col" name="pstr" type="text" value="<?=$arParams["PAGE_SIZE"]?>"></div>
		<br /><br />
		<div class="div_sticker"><b><?=GetMessage("FORM_TOOLS_STICKER")?>:</b><div id="sticker_not_text" title="<?=GetMessage("FORM_TOOLS_ERASE_STICKER")?>" onclick="document.getElementById('sticker').value=''"><?=GetMessage("FORM_TOOLS_ERASE_STICKER")?></div> <textarea id="sticker" name="sticker"><?=$arParams["STICKER"]?></textarea></div>
		<br /><br />
		<div class="but_tool"><input type="button" id="but_reset" class="but_r" value="<?=GetMessage("FORM_TOOLS_RESET")?>"> <input type="submit" class="but_t" name="but_s" value="<?=GetMessage("FORM_TOOLS_SAVE")?>"></div>
		</td>
			
	</tr>
</table>
	</form>
</div>
<!-- Блок настроек конец -->

<!-- Блок копирования начало -->
<?if(isset($_REQUEST["copy_new"])) {?>
	<div class='inf_copy_result' onclick="this.className='div_none'"><?=GetMessage("RESULT_CREATED", Array ("#ID_NEW_RESULT#" => $_REQUEST["copy_new"]))?></div>
<?}?>
<?if(isset($_REQUEST["copy_error"])) {?>
	<div class='inf_copy_result' onclick="this.className='div_none'"><?=GetMessage("ERROR_CREATED")?> <?=$_REQUEST["copy_old"]?></div>
<?}?>
<div id="box_copy" class="box_copy">
 <a href="#" onclick="class_replace('box_copy')"><?=GetMessage("FORM_HIDE")?></a><br /><br />

	<form id="" action="action="<?=($arParams["COPY_URL"]!="")?$arParams["COPY_URL"]:$templateFolder."/copy_result.php"?>" name="" method="GET">
		<h3><?=GetMessage("FORM_ID_RESULT")?> <span id="nom_copy"></span>.<br /><?=GetMessage("FORM_COPY_STATUS_AFTER")?> <?=($arParams["OLD_RESULT_STATUS_TITLE"])?$arParams["OLD_RESULT_STATUS_TITLE"]:GetMessage("FORM_COPY_UNCHANGED")?><br /><?=GetMessage("FORM_COPY_STATUS_NEW")?> <?=($arParams["NEW_RESULT_STATUS_TITLE"])?$arParams["NEW_RESULT_STATUS_TITLE"]:GetMessage("FORM_COPY_UNCHANGED")?><br /><?=GetMessage("FORM_COPY_NOTE")?></h3>
		<input id="copy_id" type="hidden" name="copy_id" value="">
		<input id="WEB_FORM_ID" type="hidden" name="WEB_FORM_ID" value="">
		<input id="copy_status" type="hidden" name="copy_status" value="">
		<input type="hidden" name="OLD_RESULT_STATUS" value="<?=$arParams["OLD_RESULT_STATUS"]?>">
		<input type="hidden" name="OLD_RESULT_STATUS_TITLE" value="<?=$arParams["OLD_RESULT_STATUS_TITLE"]?>">
		<input type="hidden" name="NEW_RESULT_STATUS" value="<?=$arParams["NEW_RESULT_STATUS"]?>">
		<input type="hidden" name="NEW_RESULT_STATUS_TITLE" value="<?=$arParams["NEW_RESULT_STATUS_TITLE"]?>">
		<br /><br />
		<input type="reset" value="<?=GetMessage("FORM_COPY_CANCEL")?>" class="but_reset_copy" onclick="class_replace('box_copy')"> <input type="submit" name="but_copy" value="<?=GetMessage("FORM_COPY_SUBMIT")?>">
	</form>
<br />
</div>
<!-- Блок копирования конец -->

<!-- Блок удаления начало -->
<?if(isset($_REQUEST["but_del"])) {?>
	<div class='inf_copy_result' onclick="this.className='div_none'"><?=GetMessage("RESULT_DEL", Array ("#ID_DEL_RESULT#" => $_REQUEST["del_id"]))?></div>
<?}?>
<div class="box_del"><img class="close" id="close" src="<?=$templateFolder?>/images/close.png">
<a href="#" onclick="class_replace('box_copy')"><?=GetMessage("FORM_HIDE")?></a><br /><br />
	<form id="" action="" name="" method="GET">
		<h3><?=GetMessage("FORM_RESULT_ID")?> <span id="nom_del"></span> <?=GetMessage("FORM_BE_DEL")?>.<br /><?=GetMessage("FORM_DEL_NOTE")?></h3>
		<input id="del_id" type="hidden" name="del_id" value="">
		<br /><br />
		<input type="reset" value="<?=GetMessage("FORM_DEL_CANCEL")?>" class="but_reset_del"><input type="submit" name="but_del" value="<?=GetMessage("FORM_DEL_SUBMIT")?>">
	</form>

</div>
<!-- Блок удаления конец -->

<!-- Блок изменения статуса начало -->
<?if(isset($_REQUEST["but_edit_status"])) {?>
<div class='inf_edit_status' onclick="this.className='div_none'"><?=GetMessage("FORM_STATUS_ID_RESULT")?><?=$_REQUEST["res_id_s"]?> <?=GetMessage("FORM_STATUS_CHANGED_HIT")?></div>
<?}?>
<div id="box_status" class="box_status">
<a href="#" onclick="class_replace('box_status')"><?=GetMessage("FORM_HIDE")?></a><br /><br />
	<form id="" name="" method="POST">
		<h3><?=GetMessage("FORM_RESULT_ID")?> <span id="nom"></span><br /><?=GetMessage("FORM_STATUS_STATUS")?> <span id="sta"></span></h3>
		<input id="res_id_s" type="hidden" name="res_id_s" value="">
	<br />
	<?=GetMessage("FORM_STATUS_CHANGE_TO")?>
		<select id="edit_status_id" name="edit_status_id">

		</select><br /><br />
		<input type="submit" id="but_edit_status" name="but_edit_status" value="<?=GetMessage("FORM_STATUS_CHANGE")?>">
	</form>
	<div style="display:none">
		<select id="default_status_id">
			<?foreach($arResult["STATUS"] as $val) {?>
			<option id="o_<?=$val["ID"]?>" value="<?=$val["ID"]?>"><?=$val["TITLE"]?>&nbsp;</option>
			<?}?>
		</select>
	</div>
	<br />
</div>
<!-- Блок изменения статуса конец -->

<!-- Блок быстрого поиска начало -->
<div id="box_qs" class="box_qs"><a href="#" onclick="class_replace('box_qs')"><?=GetMessage("FORM_HIDE")?></a><br /><br />
	<div id="result_quick_search"></div>
<input type="hidden" id="QS_NOTHING" value="<?=GetMessage("FORM_QS_NOTHING")?>">
<input type="hidden" id="QS_NOT_PARAMETRS" value="<?=GetMessage("FORM_QS_NOT_PARAMETRS")?>">
<input type="hidden" id="QS_CHANGE" value="<?=GetMessage("FORM_QS_CHANGE")?>">
<input type="hidden" id="QS_SELECT" value="<?=GetMessage("FORM_QS_SELECT")?>">
</div>
<!-- Блок быстрого поиска конец -->

<!-- Блок стикер начало -->

<div id="box_sticker" class="box_sticker">
<a href="#" onclick="class_replace('box_sticker')"><?=GetMessage("FORM_HIDE")?></a><br /><br />
	<?=str_replace("\n","<br />",$arParams["STICKER"]);$_SESSION["show_sticker_".$FORM_ID]=1;?>
</div>
<!-- Блок стикер конец -->

<div class="clear-all"></div>

<div class="nav_string"><?=$arResult["NAV_STRING"]?></div>
<?}?>
<div class="clear-all"></div>

<!-- Таблица результатов начало -->
<table class="form-table">
	<thead>
		<tr>
		<?if($arParams["ACTION"]=="Y" && $_REQUEST["print"]!="Y") {?>
			<th>&nbsp;</th>
		<?}?>
		<th><?=GetMessage("FORM_TABLE_RESULT")?>(<?=$arResult["COUNT_RESULT"]?>)</th>
			<?foreach($arResult["TABLE_HEAD_TITLE"] as $val){
				echo "<th>".$val."</th>";
			}?>
		</tr>
	</thead>
	<tbody>
	
	<?if($arResult["RESULT_KEY_ID"]) {?>
		<?foreach($arResult["RESULT_KEY_ID"] as $key => $res){?>
		<tr class="tr_res">
			<?if($arParams["ACTION"]=="Y" && $_REQUEST["print"]!="Y") {?>
				<td><div class="div_act">
					<div class="c_menu">
						<?if($arParams["ENABLE_RESULT_VIEW"]=="Y" AND $arParams["VIEW_URL"]!="") {?>
							<a href='<?=$arParams["VIEW_URL"]?>?RESULT_ID=<?=$key?>&WEB_FORM_ID=<?=$arParams["WEB_FORM_ID"]?>'><?=GetMessage("FORM_TABLE_VIEW")?></a><br/>
						<?}?>
						
						<?if($arParams["ENABLE_RESULT_EDIT"]=="Y" AND $arParams["EDIT_URL"]!="") {?>
							<a href='<?=$arParams["EDIT_URL"]?>?RESULT_ID=<?=$key?>&WEB_FORM_ID=<?=$arParams["WEB_FORM_ID"]?>'><?=GetMessage("FORM_TABLE_EDIT")?></a><br/>
						<?}?>
						
						<?if($arParams["ENABLE_RESULT_COPY"]=="Y") {?>
							<a href="#" onclick="f_copy(<?=$key?>, <?=$arParams["WEB_FORM_ID"]?>,<?=$res["STATUS_RESULT"]["STATUS_ID"]?>)"><?=GetMessage("FORM_TABLE_COPY")?></a><br/>
						<?}?>
						
						<?if($arParams["ENABLE_RESULT_DEL"]=="Y") {?>
							<a href="#"  onclick="f_del(<?=$key?>)"><?=GetMessage("FORM_TABLE_DEL")?></a></br>
						<?}?>
						
						<?if($arParams["ENABLE_STATUS_EDIT"]=="Y") {?>
							<a href="#" onclick="f_edit_status(<?=$key?>,<?=$res["STATUS_RESULT"]["STATUS_ID"]?>,'<?=$res["STATUS_RESULT"]["STATUS_TITLE"]?>')"><?=GetMessage("FORM_TABLE_STATUS")?></a><br/>
						<?}?>
					</div>
				</td>
			<?}?>
			
				<td title="<?=GetMessage("FORM_TABLE_USER")?>: <?=$res["STATUS_RESULT"]["FULL_NAME"]?> <?=$res["STATUS_RESULT"]["DATE_CREATE"]?>"><div><b><?=$key?></b></div><div><?=$res["STATUS_RESULT"]["STATUS_TITLE"]?></div></td>
				<?foreach($res["QUESTION"] as $k=> $val){?>
					 <td title='#<?=$key?>: <?=$val["TITLE"]?>'><?=$val["TEXT"]?></td>
				<?}?>
			</tr>
		<?}?>
	<?}?>
	</tbody>

</table>

<!-- Таблица результатов конец -->

<div class="clear-all"></div>
<?if($_REQUEST["print"]!="Y") {?>
<div class="nav_string"><?=$arResult["NAV_STRING"]?></div>
<?}?>

</div>
<br /><br /><br /><br />








