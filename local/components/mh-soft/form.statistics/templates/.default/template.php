<?
$APPLICATION->SetTitle($arParams["arFormInfo"]["NAME"]);
?>
<?
echo implode("<br />",$arResult["FORM_ERROR"]);
?>

<?
	//echo "<pre>";print_r($arParams);echo "</pre>";
	//echo "<pre>";print_r($arResult);echo "</pre>";
?>


<div class="stat_box">
<br /><br />
<h3><?=GetMessage("FORM_STAT_TITLE")?></h3> <h2><?=$arParams['arFormInfo']['NAME']?></h2>
<div class="info"><?=GetMessage("COUNT_QUESTION_TITLE")?> - <?=$arResult['COUNT_QUESTION']?></div>
<div class="info"><?=GetMessage("COUNT_RESULT_TITLE")?> - <?=$arResult['COUNT_RESULT']?></div>
<br /><br />
<?if($_REQUEST["print"]!="Y") {?>
	<form action="" method="GET">
		<?=GetMessage("FORM_STATUS_RESULT")?> &nbsp;&nbsp;&nbsp;
		<select name="find_status_id[]" multiple size="2">
			<option value="" <?=($_REQUEST["find_status_id"])?"":"selected"?>><?=GetMessage("FORM_ALL")?></option>
				<?foreach($arResult["STATUS"] as $val) {?>
			<option value="<?=$val["ID"]?>" <?=(in_array($val["ID"],$_REQUEST["find_status_id"]))?"selected":""?>><?=$val["TITLE"]?>(<?=$val["RESULTS"]?>)</option>
			<?}?>
		</select> &nbsp;&nbsp;&nbsp;
		<input type="submit" name="install_filter" value="<?=GetMessage("BUTTON_STATUS_SELECT")?>">
	</form>
	<div align="right">
	<?if(trim($arParams["~VIEW_URL"])!="") {?>
		<a href="<?=$arParams["~VIEW_URL"]?>"><?=GetMessage("LIST_RESULT_ALL")?></a>
	<?}?>
	<?if(trim($arParams["~NEW_URL"])!="") {?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?=$arParams["~NEW_URL"]?>"><?=GetMessage("NEW_RESULT")?></a>
	<?}?>
	</div>
	<br />
<?}?>
<?$cjr=count($arResult["RESULT"]);?>
<?if($cjr AND $arResult['COUNT_RESULT']) {?>
<?if($_REQUEST["print"]!="Y" AND $arParams['DISPLAY_TOP_PAGER']=="Y") {?>
<div class="nav_string"><?=$arResult["NAV_STRING"]?></div>
<?}?>
<table class="table_result">
	<tbody>
		<tr>
			<th>&nbsp;</th><th><?=GetMessage("QUESTION_TITLE")?></th><th><?=GetMessage("ANSWER_TITLE")?></th>
		</tr>
		<?
		
		for($i=0;$i<$cjr;$i++) {
			if($arResult["RESULT"][$i]["QUESTION"]["ID"]) {
		?>
				<tr>
				<td><?=$i+1?></td>
				<td><?=$arResult["RESULT"][$i]["QUESTION"]["TITLE"]?></td>
				<td><table>
				<?foreach($arResult["RESULT"][$i]["ANSWER"] as $var) {?>
					
					<tr><td><?=$var["MESSAGE"]?></td><td><?=($var["SUM"])?$var["SUM"]:0;?></td><td><?=$var["PERCENT"]?>%</td></tr>
					
				<?}?>
				</table></td>
				</tr>
			<?}?>
		<?		
		}
		?>
		
		
	</tbody>
</table>
<?if($_REQUEST["print"]!="Y" AND $arParams['DISPLAY_BOTTOM_PAGER']=="Y") {?>
<div class="nav_string"><?=$arResult["NAV_STRING"]?></div>
<?}?>
<?} else {?>
	<div class="not_result"><?=GetMessage("FORM_QS_SELECT");?></div>
<?}?>
<div class="clear-all"></div>

</div>
<br /><br /><br /><br />








