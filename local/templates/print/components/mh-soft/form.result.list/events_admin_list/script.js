		//Проверка подключения jQuery
	/*
	if (window.jQuery) alert("Библиотека jQuery подключена");
    else alert("Библиотека jQuery не подключена");
  */
 
$(document).ready(function(){

    $(".div_act img").click(function(event) {
		$(".c_menu").css("display", "none");
        $(this).prev(".c_menu").fadeIn(500).delay(3000).fadeOut(200);
    });
	
	
	$(".inf_edit_status").delay(3000).fadeOut(200);

	$(".columns_tool #close").click(function(){$(".columns_tool").fadeOut(500);});
	$("#open_tool").click(function(){$(".columns_tool").fadeIn(500);$(".columns_tool input:eq(0)").focus();});
	$("#but_reset").click(function(){
		var t=$("#form_tool input:text").val("");
		$("#form_tool textarea").html("");
		$("#form_tool input:checkbox").attr('checked', false);
		$(".columns_tool input[type=submit]").focus();
	});
	
	$(".div_filter #close").click(function(){$(".div_filter").fadeOut(500);});
	$("#open_filter").click(function(){$(".div_filter").fadeIn(500);$(".div_filter input:eq(0)").focus();});
	
	$(".box_sticker #close").click(function(){$(".box_sticker").fadeOut(500);});
	$("#open_sticker").click(function(){$(".box_sticker").fadeIn(500);});
	
	$(".box_status #close").click(function(){$(".box_status").fadeOut(500);});
	
	$("#sticker_not_text").click(function(){$(".div_sticker textarea").html("");$(".columns_tool input[type=submit]").focus();});
	
	$(".tr_res").dblclick( function () { $(this).find(".res_edit a span").trigger('click');$(".c_menu").css("display", "none"); });
	
	$(".box_copy #close").click(function(){$(".box_copy").fadeOut(500);});
	$(".box_copy .but_reset_copy").click(function(){$(".box_copy").fadeOut(500);});
	
	$(".box_copy input:submit").click(function(){$(".box_copy").fadeOut(500);$(".box_indicator").fadeIn(100);});
	
	$(".res_edit a").click(function(){$(".box_indicator").fadeIn(100);});
	$(".res_view a").click(function(){$(".box_indicator").fadeIn(100);});
	$("#a_print").click(function(){$(".box_indicator").fadeIn(100);});
	
	$(".box_qs #close").click(function(){$(".box_qs").fadeOut(500);});
	
	$("#edit_status_id").change(function(){$(".box_status input[type=submit]").focus();});
	
});

function f_edit_status(n,s,t) {
$("#nom").html(n);
$("#sta").html(t);
$("#res_id_s").val(n);
	var dh=$("#default_status_id").html();
	$("#edit_status_id").html(dh);
	$("#o_"+s).remove();
	$(".box_status").fadeIn(500);
	$(".box_status input[type=submit]").focus();
}
function f_copy(n,f) {
$("#nom_copy").html(n);
$("#copy_id").val(n);
$("#WEB_FORM_ID").val(f);

	$(".box_copy").fadeIn(500);
}

function f_quick_search(form_id,answer_id,sts,url_edit) {
var tqs=$("#tqs").val();
var templatefolder=$("#templatefolder").val();
var QS_NOTHING=$("#QS_NOTHING").val();
var QS_NOT_PARAMETRS=$("#QS_NOT_PARAMETRS").val();
var QS_CHANGE=$("#QS_CHANGE").val();
var QS_SELECT=$("#QS_SELECT").val();
  $.ajax({ 
				type: "POST",			
                url: templatefolder+"/quick_search.php",
				data: "tqs="+tqs+"&form_id="+form_id+"&answer_id="+answer_id+"&sts="+sts+"&url_edit="+url_edit+"&templatefolder="+templatefolder+"&QS_NOTHING="+QS_NOTHING+"&QS_NOT_PARAMETRS="+QS_NOT_PARAMETRS+"&QS_CHANGE="+QS_CHANGE+"&QS_SELECT="+QS_SELECT,   
                cache: false,  
                success: function(html){  
                    $("#result_quick_search").html(html);  
                }  
            });
	$(".box_qs").fadeIn(500);
}
