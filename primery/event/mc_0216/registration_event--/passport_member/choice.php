<?IncludePublicLangFile(__FILE__);?>
<div class="pas_par">
	<?include "array.php";?>

	<?if($cp) {?>
		<div id="povipat"><img src="/images/registration_event/info_24.png" align="left">
		 <div class="div_text" style="display:inline-block;width:500px;"><?=GetMessage("choice_info")?>:</div>
			<div class="div_select" style="display:inline-block;">
			
				<div class="po_div">
					<div class="po_t"><?=($_SESSION["passport_member"]["title"])?$_SESSION["passport_member"]["title"]:getMessage("do_not_use")?></div><div class="po"></div>
					<div class="po_s">
					<div value=""><?=getMessage("do_not_use")?></div>
						<?for($i=0;$i<$cp;$i++) {?>
						<div value="<?=$ar_id_p[$i]?>"><?=$ar_title_p[$i]?></div>
						<!--<div class="vipat" id="pt_<?=$ar_id_p[$i]?>"><div class="vitit" ><?=$ar_title_p[$i]?></div></div>-->
						<?}?>
					</div>
				</div>
				
			</div>
		</div>
	<?}?>

</div>
<script>
$(document).ready(function(){
	
    $('.po_div .po').click(function(event) {
        $(this).next(".po_s").fadeIn();
    });
	
   $(document).click( function(event){
      if( $(event.target).closest(".po").length ) 
        return;
      $(".po_s").fadeOut("slow");
      event.stopPropagation();
    });
	
	$('.po_s div').mousedown(function(event) {
		var t=$(this).html();
		var v=$(this).attr('value');
		sel_ses(v);
		$(this).parent().parent().children(".po_t").html(t);
	});
});

function sel_ses(v) {
//var pm_id=$("#povipat select option:selected").val();
$.ajax({  
			type: "POST",
			url: "../../../com/registration_event/passport_member/session.php",  
			data: "passport_member_id="+v, 
			cache: false,  
			success: function(html){ 
				//$("#tr").html(html);
				window.location.reload(true);
			} 
		
		});
}

function psel_selected() {
	
}

</script>
<?//echo "<pre>"; print_r($_SESSION["test"]); echo "</pre>";?>
<?//echo "<pre>"; print_r($_SESSION["passport_member"]); echo "</pre>";?>