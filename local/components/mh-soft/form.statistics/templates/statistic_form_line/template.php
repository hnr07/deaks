<?
$APPLICATION->SetTitle($arParams["arFormInfo"]["NAME"]);
?>
<?
echo implode("<br />",$arResult["FORM_ERROR"]);
?>

<?
	//echo "<pre>";print_r($arParams);echo "</pre>";
	//echo "<pre>";print_r($arResult);echo "</pre>";
	
	$cjr=count($arResult["RESULT"]);
	$wb=600; // длина блока для 100%
?>


<div class="stat_box">
<?if($_REQUEST["print"]!="Y") {?>
	<div class="img_print"><a id="a_print" href="http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?><?=(strpos($_SERVER['REQUEST_URI'],"?"))?"&print=Y":"?print=Y"?>"><img class="open_print" src="<?=$templateFolder?>/images/doc_print.png" title="<?=GetMessage("FORM_PRINT")?>"></a></div>
<?}?>
<br /><br />
<h2><?=GetMessage("FORM_STAT_TITLE")?> "<?=$arParams['arFormInfo']['NAME']?>"</h2>
<div class="box_info">
	<div class="info"><?=GetMessage("COUNT_QUESTION_TITLE")?> - <?=$arResult['COUNT_QUESTION']?></div>
	<div class="info"><?=GetMessage("COUNT_RESULT_TITLE")?> - <?=$arResult['COUNT_RESULT']?></div>
</div>
<?if($_REQUEST["print"]!="Y") {?>
	<div class="box_url">
		<?if(trim($arParams["VIEW_URL"])!="") {?>
			<a href="<?=$arParams["VIEW_URL"]?>"><button type="button"><?=GetMessage("LIST_RESULT_ALL")?></button></a>
		<?}?>
		<?if(trim($arParams["NEW_URL"])!="") {?>
			<a href="<?=$arParams["NEW_URL"]?>"><button type="button"><?=GetMessage("NEW_RESULT")?></button></a>
		<?}?>
	</div>
	<div class="clear-all"></div>
<?}?>

<?if($_REQUEST["print"]!="Y") {?>
	<div class="box_filter">
	<div class="box_filter_title"><?=GetMessage("FORM_STATUS_RESULT")?></div>
		<form action="" method="GET">
		<div class="sebu">
			
				<select name="find_status_id[]" multiple size="2">
					<option value="" <?=($_REQUEST["find_status_id"])?"":"selected"?>><?=GetMessage("FORM_ALL")?></option>
						<?foreach($arResult["STATUS"] as $val) {?>
					<option value="<?=$val["ID"]?>" <?=(in_array($val["ID"],$_REQUEST["find_status_id"]))?"selected":""?>><?=$val["TITLE"]?>(<?=$val["RESULTS"]?>)</option>
					<?}?>
				</select> 
			
				<button type="submit"><?=GetMessage("BUTTON_STATUS_SELECT")?></button>
			
			</div>
		</form>
	</div>
<?}?>


<div class="clear-all"></div>
<?if($cjr AND $arResult['COUNT_RESULT']) {?>
<?if($_REQUEST["print"]!="Y" AND $arParams['DISPLAY_TOP_PAGER']=="Y") {?>
<div class="nav_string"><?=$arResult["NAV_STRING"]?></div>
<?}?>
<table class="table_result">
	<tbody>
		
		<?
		
		for($i=0;$i<$cjr;$i++) {
			if($arResult["RESULT"][$i]["QUESTION"]["ID"]) {
		?>
				<tr>
					<th colspan="3"><?=$arResult["RESULT"][$i]["QUESTION"]["TITLE"]?></th>
				</tr>
				
				
				
				<?
				$j=0;
				foreach($arResult["RESULT"][$i]["ANSWER"] as $var) {
					$w=round(($var["PERCENT"]*$wb/100),0);
				?>
					
					<tr>
					<td><?=$var["MESSAGE"]?></td>
					<td><?=($var["SUM"])?$var["SUM"]:0;?> [<?=$var["PERCENT"]?>%]</td>
					<td>
						<div class="dista dista_col_<?=$i?>_<?=$j?>" style="width:<?=$w?>px;"><div>
					</td>
					</tr>
					
				<?
					unset($w);
					$j++;
				}
				?>
				
				
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








