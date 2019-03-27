<?
global $USER;
$APPLICATION->SetTitle($arParams["arFormInfo"]["NAME"]);
 // echo "<pre>"; print_r($arParams); echo "</pre>";
 // echo "<pre>"; print_r($arResult); echo "</pre>";
 // echo "<pre>"; print_r($_REQUEST); echo "</pre>";
?>
<style>
body {
	background:#fff;
}
#container{
	width:100%;
}
table {
	border-spacing:0px;
}
</style>
<?
echo implode("<br />",$arResult["FORM_ERROR"]);
?>

 <div id="admin_list">
 <input type="hidden" id="templatefolder" value="<?=$templateFolder?>">
<?if($_REQUEST["print"]!="Y") {?>
<h2><?$APPLICATION->ShowTitle();?></h2>

<div class="top">
	

	<div class="but_top_1"><a href="#" onclick='window.open("<?=$templateFolder?>/help/<?=LANGUAGE_ID?>/help.php", "help", "menubar=0,location=0,resizable=yes,scrollbars=yes,location=0,status=0,height=600, width=800,left=100,top=100")'><img class="open_faq" src="<?=$templateFolder?>/images/help.png" title="<?=GetMessage("FORM_HELP")?>"></a></div>
	
	<?if($arParams["NEW_URL"]!="") {?>
	<div class="but_top_1"><a href="<?=$arParams["NEW_URL"]?>?WEB_FORM_ID=<?=$arParams["WEB_FORM_ID"]?>"><img class="add_new" id="add_new" src="<?=$templateFolder?>/images/page_add.png" title="<?=GetMessage("FORM_ADD_RESULT")?>"></a></div>
	<?}?>
	
	<div class="but_top_1"><img class="open_tool" id="open_tool" src="<?=$templateFolder?>/images/tools.png" title="<?=GetMessage("FORM_TOOLS")?>"></div>
	
	<div class="but_top_1"><img class="open_filter" id="open_filter" src="<?=$templateFolder?>/images/<?=(isset($_REQUEST["install_filter"]))?"filter_1.png":"filter_0.png"?>" title="<?=GetMessage("FORM_FILTER")?> <?=(isset($_REQUEST["install_filter"]))?GetMessage("FORM_INSTALLED"):GetMessage("FORM_NOT_INSTALLED")?>"></div>
	
	<div class="but_top_1"><a id="a_print" href="http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?><?=(strpos($_SERVER['REQUEST_URI'],"?"))?"&print=Y":"?print=Y"?>"><img class="open_print" src="<?=$templateFolder?>/images/doc_print.png" title="<?=GetMessage("FORM_PRINT")?>"></a></div>
	
	<?if($arParams["ENABLE_STAT_VIEW"]=="Y" AND $arParams["STAT_URL"]!="") {?>
	<div class="but_top_1"><a href="<?=$arParams["STAT_URL"]?>?WEB_FORM_ID=<?=$arParams["WEB_FORM_ID"]?>"><img class="open_stat" id="open_stat" src="<?=$templateFolder?>/images/stat.png" title="<?=GetMessage("FORM_STAT")?>"></a></div>
	<?}?>
	
	<?if($arParams["STICKER"]) {?>
	<div class="but_top_1"><img class="open_sticker" id="open_sticker" src="<?=$templateFolder?>/images/page_attach.png" title="<?=GetMessage("FORM_OPEN_STICKER")?>"></div>
	<?}?>
	
	<div class="but_top_bp"><input type="text" id="tqs" name="tqs" oninput="f_quick_search(<?=$arParams["WEB_FORM_ID"]?>,'<?=$arResult["QUICK_SEARCH_ID_STR"]?>','<?=$arParams["STR_STATUS_DEFAULT"]?>','<?=$arParams["EDIT_URL"]?>')" value="<?=(isset($_REQUEST["result_view"]))?$_REQUEST["result_view"]:""?>" title="<?=GetMessage("FORM_QUICK_SEARCH")?> <?=(($arResult["QUICK_SEARCH_TITLE"])?GetMessage("FORM_QUICK_SEARCH_OR")." '".$arResult["QUICK_SEARCH_TITLE"]."'":"")?>">
	<?if(isset($_REQUEST["result_view"])) {?>
	<a href="?remove_qs=1" title="<?=GetMessage("FORM_QUICK_SEARCH_CLOSE")?>"><img align="top" src="<?=$templateFolder?>/images/cross_circle.png"></a>
	<?
	}
	else
	{
	?>
	<img align="top" src="<?=$templateFolder?>/images/search.png">
	<?}?>
	</div>
</div>
	<?if($arResult["NAV_STRING"] AND $arParams["DISPLAY_TOP_PAGER"]=="Y") {?>
		<div class="nav_string"><?=$arResult["NAV_STRING"]?></div>
	<?}?>
<?}?>
<div class="clear-all"></div>

<!-- Таблица результатов начало -->
<table class="result_table">
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
			<?
			$ct_menu="";
			if($arParams["ACTION"]=="Y" && $_REQUEST["print"]!="Y") {
				
				
			?>
				<td><div class="div_act">
					<div class="c_menu">
						<?if($arParams["ENABLE_RESULT_VIEW"]=="Y" AND $arParams["VIEW_URL"]!="") {?>
							<div class='div_c_menu res_view'><div><a href='<?=$arParams["VIEW_URL"]?>?RESULT_ID=<?=$key?>&WEB_FORM_ID=<?=$arParams["WEB_FORM_ID"]?>'><span><?=GetMessage("FORM_TABLE_VIEW")?></span></a></div></div>
						<?}?>
					
						<?if($arParams["ENABLE_RESULT_EDIT"]=="Y" AND $arParams["EDIT_URL"]!="") {?>
							<div class='div_c_menu res_edit'><div><a href='<?=$arParams["EDIT_URL"]?>?RESULT_ID=<?=$key?>&WEB_FORM_ID=<?=$arParams["WEB_FORM_ID"]?>'><span><?=GetMessage("FORM_TABLE_EDIT")?></span></a></div></div>
						<?}?>
						<?if($arParams["ENABLE_RESULT_COPY"]=="Y" AND $arParams["COPY_URL"]!="") {?>
							<div class='div_c_menu'><div onclick="f_copy(<?=$key?>,<?=$arParams["WEB_FORM_ID"]?>)"><?=GetMessage("FORM_TABLE_COPY")?></div></div>
						<?}?>
						<?if($arParams["ENABLE_STATUS_EDIT"]=="Y") {?>
							<div class='div_c_menu'><div onclick="f_edit_status(<?=$key?>,<?=$res["STATUS_RESULT"]["STATUS_ID"]?>,'<?=$res["STATUS_RESULT"]["STATUS_TITLE"]?>')"><?=GetMessage("FORM_TABLE_STATUS")?></div></div>
						<?}?>
					</div>
				<img class="open_act" id="open_tool" src="<?=$templateFolder?>/images/list.png" title="<?=GetMessage("FORM_TABLE_ACTIONS")?>"></div></td>
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
	<?if($arResult["NAV_STRING"] AND $arParams["DISPLAY_BOTTOM_PAGER"]=="Y") {?>
		<div class="nav_string"><?=$arResult["NAV_STRING"]?></div>
	<?}?>
<?}?>

<br /><br /><br /><br />

<!-- Блок фильтра начало -->
<div class="div_filter"><img class="close" id="close" src="<?=$templateFolder?>/images/close.png">
<h3><?=GetMessage("FORM_FILTER_TITLE")?></h3><br /><br />
<form action="" method="GET">
<table>
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
<div class="columns_tool"><img class="close" id="close" src="<?=$templateFolder?>/images/close.png">
<h3><?=GetMessage("FORM_TOOLS_TITLE")?></h3><br /><br />
<form id="form_tool" name="form_tool" method="POST">

<div class="div_pstr"><b><?=GetMessage("FORM_TOOLS_RESULTS_STR")?></b> <input class="no_col" name="pstr" type="text" value="<?=$arParams["PAGE_SIZE"]?>"></div>
<div class="div_sticker"><b><?=GetMessage("FORM_TOOLS_STICKER")?>:</b><div id="sticker_not_text" title="<?=GetMessage("FORM_TOOLS_ERASE_STICKER")?>">&#10005;</div> <textarea name="sticker"><?=$arParams["STICKER"]?></textarea></div>
<div class="but_tool"><input type="button" id="but_reset" class="but_r" value="<?=GetMessage("FORM_TOOLS_RESET")?>"><input type="submit" class="but_t" name="but_s" value="<?=GetMessage("FORM_TOOLS_SAVE")?>"></div>
<div style="clear:both"></div>
<br />
<div style="clear:both"></div>
<b><?=GetMessage("FORM_TOOLS_TITLE_RES")?></b>
<div class="list_c">
	<?foreach($arResult["ARRAY_COL"] as $val){?>
		<div class="l_col"> <input class="no_filter" type="checkbox" name="no_filter_<?=$val["SID"]?>" value="<?=$val["SID"]?>" <?=(in_array($val["SID"],$arResult["ARRAY_FINAL_FILTER"])?"checked":"")?> title="<?=GetMessage("FORM_TOOLS_MARK_FILTER")?>"> <input type="text" class="no_col" name="no_col_<?=$val["SID"]?>" value="<?=(in_array($val["SID"],$arResult["ARRAY_FINAL_COL"]))?(array_search($val["SID"],$arResult["ARRAY_FINAL_COL"])+1)*10:""?>" title="<?=GetMessage("FORM_TOOLS_NUMBER_FIELD")?>"><?=$val["TITLE"]?></div>
	<?}?>
</div>
	</form>
</div>
<!-- Блок настроек конец -->

<!-- Блок изменения статуса начало -->
<?if(isset($_REQUEST["but_edit_status"])) {?>
<div class='inf_edit_status'><?=GetMessage("FORM_STATUS_ID_RESULT")?><?=$_REQUEST["res_id_s"]?> <?=GetMessage("FORM_STATUS_CHANGED_HIT")?></div>
<?}?>
<div class="box_status"><img class="close" id="close" src="<?=$templateFolder?>/images/close.png">
	<form id="" name="" method="POST">
		<h3><?=GetMessage("FORM_RESULT_ID")?> <span id="nom"></span><br /><?=GetMessage("FORM_STATUS_STATUS")?> <span id="sta"></span></h3>
		<input id="res_id_s" type="hidden" name="res_id_s" value="">
	<br />
	<?=GetMessage("FORM_STATUS_CHANGE_TO")?>
		<select id="edit_status_id" name="edit_status_id">

		</select><br /><br />
		<input type="submit" name="but_edit_status" value="<?=GetMessage("FORM_STATUS_CHANGE")?>">
	</form>
	<div style="display:none">
		<select id="default_status_id">
			<?foreach($arResult["STATUS"] as $val) {?>
			<option id="o_<?=$val["ID"]?>" value="<?=$val["ID"]?>"><?=$val["TITLE"]?>&nbsp;</option>
			<?}?>
		</select>
	</div>
</div>
<!-- Блок изменения статуса конец -->

<!-- Блок копирования начало -->
<div class="box_copy"><img class="close" id="close" src="<?=$templateFolder?>/images/close.png">

	<form id="" action="<?=$arParams["COPY_URL"]?>" name="" method="GET">
		<h3><?=GetMessage("FORM_RESULT_ID")?> <span id="nom_copy"></span>.<br /><?=GetMessage("FORM_COPY_STATUS_AFTER")?> <?=($arParams["OLD_RESULT_STATUS_TITLE"])?$arParams["OLD_RESULT_STATUS_TITLE"]:GetMessage("FORM_COPY_UNCHANGED")?><br /><?=GetMessage("FORM_COPY_STATUS_NEW")?> <?=($arParams["NEW_RESULT_STATUS_TITLE"])?$arParams["NEW_RESULT_STATUS_TITLE"]:GetMessage("FORM_COPY_UNCHANGED")?><br />Операция копирования не имеет обратного действия.<br />Вы должны понимать, последствия этого изменения.</h3>
		<input id="copy_id" type="hidden" name="copy_id" value="">
		<input id="WEB_FORM_ID" type="hidden" name="WEB_FORM_ID" value="">
		<input type="hidden" name="OLD_RESULT_STATUS" value="<?=$arParams["OLD_RESULT_STATUS"]?>">
		<input type="hidden" name="OLD_RESULT_STATUS_TITLE" value="<?=$arParams["OLD_RESULT_STATUS_TITLE"]?>">
		<input type="hidden" name="NEW_RESULT_STATUS" value="<?=$arParams["NEW_RESULT_STATUS"]?>">
		<input type="hidden" name="NEW_RESULT_STATUS_TITLE" value="<?=$arParams["NEW_RESULT_STATUS_TITLE"]?>">
		<br /><br />
		<input type="reset" value="<?=GetMessage("FORM_COPY_CANCEL")?>" class="but_reset_copy"><input type="submit" name="but_copy" value="<?=GetMessage("FORM_COPY_SUBMIT")?>">
	</form>

</div>
<!-- Блок копирования конец -->

<!-- Блок стикер начало -->
<?
if($_SESSION["show_sticker_".$FORM_ID]) {
$style_box_sticker="none";
}
else {
	if($arParams["STICKER"]) $style_box_sticker="block";
	else $style_box_sticker="none";
}

?>
<div class="box_sticker" style="display:<?=$style_box_sticker?>"><img class="close" id="close" src="<?=$templateFolder?>/images/close.png">
	<?=str_replace("\n","<br />",$arParams["STICKER"]);$_SESSION["show_sticker_".$FORM_ID]=1;?>
</div>
<!-- Блок стикер конец -->

<!-- Блок индикатора начало -->
<div class="box_indicator">
	<img src="<?=$templateFolder?>/images/proc_3.gif">
</div>
<!-- Блок индикатора конец -->

<!-- Блок быстрого поиска начало -->
<div class="box_qs"><img class="close" id="close" src="<?=$templateFolder?>/images/close.png">
	<div id="result_quick_search"></div>
	<input type="-hidden" id="QS_NOTHING" value="<?=GetMessage("FORM_QS_NOTHING")?>">
	<input type="-hidden" id="QS_NOT_PARAMETRS" value="<?=GetMessage("FORM_QS_NOT_PARAMETRS")?>">
	<input type="-hidden" id="QS_CHANGE" value="<?=GetMessage("FORM_QS_CHANGE")?>">
	<input type="-hidden" id="QS_SELECT" value="<?=GetMessage("FORM_QS_SELECT")?>">
</div>
<!-- Блок быстрого поиска конец -->

</div>


