
function f_ps(d) {$("#"+d).fadeIn(500);}
function f_us(d) {$("#"+d).fadeOut(800);}
function f_sz() {$("#sz").fadeIn(5000);}//.css("display","block");}

function f_base_currency(name_c) {
if(confirm("Использовать валюту \n\r"+name_c+"\n\rв качестве базовой валюты\n\rтекущего мероприятия?")) return true;
else return false;
}

function f_course_currency() {
var ert="";
var reg_course = /^[0-9]{0,}\.?[0-9]{1,}$/;  // только цифры и точка
var cf=$("#cur_course").val();
var df=$("#cur_date").val();
var nf=$("#cur_name option:selected").html();

if(!reg_course.test(cf) || !cf) {ert+="Ошибка заполнения поля 'Значение курса'\r\n";}
if(!df) {ert+="Ошибка заполнения поля 'Дата активности'\r\n";}
else {
		var d=new Date();
		var curr_date = new String(d.getDate());
		var curr_month = new String(d.getMonth() + 1);
		var curr_year = new String(d.getFullYear());
		var ds=curr_year+curr_month+curr_date;
		var str2=df.split(".");
		var stm;
		if(str2[1][0]==0) {stm=str2[1][1];}
		else stm=str2[1];
			var str=str2[2] + stm + str2[0];
			var du=str*1;
			var rd=du-ds;
			var z=new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
			var z_date = new String(z.getDate());
			var z_month = new String(z.getMonth() + 1);
			var z_year = new String(z.getFullYear());
			if (z_month<10) z_month="0"+z_month;
		if(rd<1)  {ert+="Ближайшая возможная 'Дата активности': "+z_date+"."+z_month+"."+z_year+"\r\n";}
}
	if(ert) {
	alert(ert);
	return false;
	}
	else {
	if(cf[0]==".") cf="0"+cf;
	if(confirm("Новый курс "+cf+"\n\rдля "+nf+"\n\rот "+df+"\n\rбудет добавлен\n\rв базу данных текущего мероприятия")) return true;
	else return false;
	}
}
function edit_ar(t) {
var ot=$(".pismo textarea").val();
var nt=ot+t;
//alert(nt);
$(".pismo textarea").val(nt);
$(".pismo textarea").focus();
}
