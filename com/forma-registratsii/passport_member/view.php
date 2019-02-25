<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?include "array.php";?>

<div id="may_p" class="may_p" style="">
<?=getMessage("new_passport_info")?>
	<?for($i=0;$i<$cp;$i++) {?>

		<div class="dop" id="pu_<?=$ar_id_p[$i]?>"><div class="tit"><?=$ar_title_p[$i]?></div><div class="del" onclick="f_del_p(<?=$ar_id_p[$i]?>,'<?=$ar_title_p[$i]?>')"><img src="/images/registration_event/del_cr_red.png" width="24" height="24" alt="<?=getMessage("del")?>" title="<?=getMessage("del")?>"></div></div>

	<?}?>
	<?//if($cp<$lim) {?>
		<div class="dop dop_n" style="display:<?=($cp<$lim)?"block":"none"?>"><div class="inp"><input type="text" placeholder="<?=getMessage("enter_new_name")?>" value="" maxlength="50" title="<?=getMessage("enter_new_name")?>"></div><div class="add" onclick="f_add_p(<?=$_GET["WEB_FORM_ID"]?>,<?=$_GET["RESULT_ID"]?>)"><img src="/images/registration_event/add_cr_green.png" width="24" height="24" alt="Добавить" title="Добавить"></div></div>
	<?
	//}
	//else
	//{
	?>
	<div class="ine" style="display:<?=($cp<$lim)?"none":"block"?>"><?=getMessage("limit_cards")?></div>
	<?//}?>
</div>
<input id="p_tit" type="hidden" value="<?=getMessage("enter_new_name")?>">
<input id="card_party" type="hidden" value="<?=getMessage("card_party")?>">
<input id="successfully_created" type="hidden" value="<?=getMessage("successfully_created")?>">
<input id="error_creating_card" type="hidden" value="<?=getMessage("error_creating_card")?>">
<script>
	function f_add_p(wf,id) {
		var tp=$("#may_p .inp input").val();
		var t=$.trim(tp);
		var p_tit=$("#p_tit").val();
		var card_party=$("#card_party").val();
		var successfully_created=$("#successfully_created").val();
		var error_creating_card=$("#error_creating_card").val();
		if(t) {
			$.ajax({  
				type: "POST",
				url: "../passport_member/add.php",  
				data: "web_form_id="+wf+"&result_id="+id+"&title="+t, 
				cache: false,  
				success: function(html){ 
					//$("#tr").html(html);
					var ar_h=html.split("^");
					if($.trim(ar_h[0])=="1"){
						var istr="<div class='p_ok'>"+card_party+" \""+ar_h[1]+"\" "+successfully_created+"</div>";
					}
					else {
						var istr="<div class='p_er'>"+error_creating_card+"</div>";
					}
					$("#may_p").html(istr);
				} 
			
			}); 
		}
		else alert(p_tit);
	}
	
	function f_del_p(id_p,t_p) {
	//$(".inp").attr("style","");
//$(".inp").css("display","block");

		$.ajax({  
			type: "POST",
			url: "../passport_member/del.php",  
			data: "result_id="+id_p+"&title="+t_p, 
			cache: false,  
			success: function(html){ 
				//$("#tr").html(html);
				var ar_h=html.split("^");
				
				if($.trim(ar_h[0])=="1"){
					$("#pu_"+id_p).html(ar_h[1]);
					$("#pu_"+id_p+" .tit").css("text-decoration","line-through");
					$(".dop_n").css("display","block");
					$(".ine").css("display","none");
				}
				else {
					$(".dop_n").css("display","none");
					$(".ine").css("display","block");
				}
			} 
		
		}); 
		
	}
	//$(".inp").css("display","block");
</script>
<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>