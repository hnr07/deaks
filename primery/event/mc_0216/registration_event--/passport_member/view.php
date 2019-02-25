<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?IncludePublicLangFile(__FILE__);?>
<?include "array.php";?>

<div id="may_p" class="may_p" style="">
<img src="/images/registration_event/info_24.png" align="left">
<div style="float:left;width:250px;margin:0 30px;">

<?=GetMessage("new_passport_info")?>
</div>
<div style="display:inline-block;width:700px;">
	<?for($i=0;$i<$cp;$i++) {?>

		<div class="dop" id="pu_<?=$ar_id_p[$i]?>"><div class="tit"><?=$ar_title_p[$i]?></div><div class="del" onclick="f_del_p(<?=$ar_id_p[$i]?>,'<?=$ar_title_p[$i]?>')"><img src="/images/registration_event/delete_24.png" width="24" height="24" alt="<?=GetMessage("del")?>" title="<?=GetMessage("del")?>"></div></div>

	<?}?>
	<?//if($cp<$lim) {?>
		<div class="dop dop_n" style="display:<?=($cp<$lim)?"block":"none"?>"><div class="inp"><input type="text" placeholder="<?=GetMessage("enter_new_name")?>" value="" maxlength="50" title="<?=GetMessage("enter_new_name")?>"></div><div class="add" onclick="f_add_p(<?=$_GET["WEB_FORM_ID"]?>,<?=$_GET["RESULT_ID"]?>)"><img src="/images/registration_event/add_24.png" width="24" height="24" alt="<?=GetMessage("add_ku")?>" title="<?=GetMessage("add_ku")?>"></div></div>
	<?
	//}
	//else
	//{
	?>
	<div class="ine" style="display:<?=($cp<$lim)?"none":"block"?>"><?=GetMessage("limit_cards")?></div>
	<?//}?>
</div>
</div>
<input id="p_tit" type="hidden" value="<?=GetMessage("enter_new_name")?>">
<input id="card_party" type="hidden" value="<?=GetMessage("card_party")?>">
<input id="successfully_created" type="hidden" value="<?=GetMessage("successfully_created")?>">
<input id="error_creating_card" type="hidden" value="<?=GetMessage("error_creating_card")?>">
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
				url: "../../../com/registration_event/passport_member/add.php",  
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
			url: "../../../com/registration_event/passport_member/del.php",  
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