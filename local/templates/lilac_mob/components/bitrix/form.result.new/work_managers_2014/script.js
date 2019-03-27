		//Проверка подключения jQuery
	/*
	if (window.jQuery) alert("Библиотека jQuery подключена");
    else alert("Библиотека jQuery не подключена");
  */
$(document).ready(function(){
	
	$("#but_submit").click(function () {
		var er=0;
		
		var t=$(".div_select input:text").length;
		for(var i=0;i<t;i++){
			var tt=$.trim($('.div_select input:text:eq('+i+')').val());
			$('.div_select input:text:eq('+i+')').val(tt);
			if (tt=="") {
			$('.div_select input:text:eq('+i+')').css({"border-color":"red"});
			er++;
			}
			else {
			$('.div_select input:text:eq('+i+')').css({"border-color":"#d0d0d0"});
			}
			
		}
		
		var l= $(".plt").length;
		for(var i=0;i<l;i++){
			if (!$('.plt:eq('+i+') input:radio').is(':checked')) {
			$('.plt:eq('+i+')').find(".zap").css({"border-color":"red"});
			er++;
			}
			else {
			$('.plt:eq('+i+')').find(".zap").css({"border-color":"#d0d0d0"});
			}
			
		}
		
	  
	  if(er) alert('Пожалуйста заполните все необходимые поля и дайте варианты ответов всем вопросам.');
	  else $('#but_submit_form').click();
    });
    

});
  

