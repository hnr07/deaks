<?$FORM_ID=$form_m;?>
<?
if (CForm::GetDataByID($FORM_ID, 
    $form, 
    $questions, 
    $answers, 
    $dropdown, 
    $multiselect))
{
/*
    echo "<pre>";
        //print_r($form);
       //print_r($questions);
       // print_r($answers);
       // print_r($dropdown);
       // print_r($multiselect);
    echo "</pre>";
	*/
}
?>

	<?
	foreach($answers as $k=>$v) {
		echo "<div>";
		echo $questions[$k]["TITLE"]." - ".$k."<br />";
			foreach($v as $i=>$f){
				switch($f["FIELD_TYPE"]) {
					case "radio":
					?>
					<input id="fld_<?=$k."_".$i?>" name="<?=fGetName($k,$i)?>" value="<?=fGetValue($k,$i)?>" type="radio" <?if(fGetResultValues($k)==fGetValue($k,$i)) echo "checked";?> >		
					<?		
								break;
					case "text":
					?>
					<input id="fld_<?=$k?>" name="<?=fGetName($k,$i)?>" value="<?=fGetResultValues($k,$i)?>" type="text">		
					<?		
								break;
					case "email":
					?>
					<input id="fld_<?=$k?>" name="<?=fGetName($k,$i)?>" value="<?=fGetResultValues($k,$i)?>" type="email">		
					<?		
								break;
					case "textarea":
					?>
					<textarea id="fld_<?=$k?>" name="<?=fGetName($k,$i)?>"><?=fGetResultValues($k,$i);?></textarea>
					<?		
								break;
					case "file":
					?>
					<?=fGetHTML($k)?>
					<?		
								break;
				}
			}
		echo "</div> ///////////////////";
	}
	?>
