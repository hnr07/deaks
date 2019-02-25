<div class="pas_par">
	<?include "../passport_member/array.php";?>

	<?if($cp) {?>
		<div id="povipat"><img src="/images/registration_event/info_48.png" align="left">
		 <div class="div_text"><?=getMessage("choice_info")?>:</div>
			<div class="div_select">
				<select onchange="sel_ses()">
					<option value="0"><?=getMessage("do_not_use")?></option>
					<?for($i=0;$i<$cp;$i++) {?>
						<option value="<?=$ar_id_p[$i]?>" <?if($ar_title_p[$i]==$_SESSION["passport_member"]["title"]) echo "selected"?>><?=$ar_title_p[$i]?></option>
						<!--<div class="vipat" id="pt_<?=$ar_id_p[$i]?>"><div class="vitit" ><?=$ar_title_p[$i]?></div></div>-->

					<?}?>
				</select>
			</div>
		</div>
	<?}?>

</div>
<script>
function sel_ses() {
var pm_id=$("#povipat select option:selected").val();
$.ajax({  
			type: "POST",
			url: "../passport_member/session.php",  
			data: "passport_member_id="+pm_id, 
			cache: false,  
			success: function(html){ 
				//$("#tr").html(html);
				window.location.reload(true);
			} 
		
		});
}
</script>
<?//echo "<pre>"; print_r($_SESSION["test"]); echo "</pre>";?>
<?//echo "<pre>"; print_r($_SESSION["passport_member"]); echo "</pre>";?>