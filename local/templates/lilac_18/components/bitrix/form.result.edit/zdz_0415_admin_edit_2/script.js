		//Проверка подключения jQuery
	/*
	if (window.jQuery) alert("Библиотека jQuery подключена");
    else alert("Библиотека jQuery не подключена");
  */
function vi_status() {
var sel=$("#ti_blo_status input:radio").filter(":checked").val();
var hisel=$("#ti_blo_status input:hidden:eq(0)").val();
//document.getElementById('tr').innerHTML = sel;
if(sel==hisel) {$("#sipo_1").css("display", "block" );$("#sipo_0").css("display", "none" );$("#ti_blo_2").css("display", "none" );}
else {$("#sipo_0").css("display", "block" );$("#sipo_1").css("display", "none" );$("#ti_blo_2").css("display", "block" );}
sub_but();
}
function pro_su() {
//регулярные выражения
var reg_chk = /^[0-9]{6,7}$/;   //  номер - только 6-7 цифр 
var reg_fio = /^[a-zA-Zа-яА-Я-Ёё]+$/;   // только буквы и дефис - кирилица, латынь
//var reg_mail = /^[a-zA-Z0-9][-\._a-zA-Z0-9]+@(?:[a-zA-Z0-9][-a-zA-Z0-9]+\.)+[a-zA-Z]{2,6}$/; // електронная почта 
var reg_mail =/^[a-zA-Z0-9][-\._a-zA-Z0-9]+@[\w-\._]+\.\w{2,4}$/i;//var reg_mail =/^\w+@\w+\.\w{2,4}$/i;
var reg_phone = /^[0-9-)(+ ]+$/;  // телефон - цифры скобки плюс дефис пробел

var po=0; // индикатор ошибок
var po_tx=""; // текст ошибок

		// проверка поля E-mail
		if(document.getElementById('ti_blo_email'))
		{
		var nf=$("#ti_blo_email input:text:eq(0)").val();
			if(reg_mail.test(nf)) oker("email",1);
			else {oker("email",0);po+=1;po_tx+=erp("email")+"\r\n <br>";}
		}
		//////////////////////////////////////////
		
			// проверка поля Телефон
		if(document.getElementById('ti_blo_tel'))
		{
		var nf=$("#ti_blo_tel input:text:eq(0)").val();
			if(reg_phone.test(nf)) oker("tel",1);
			else {oker("tel",0);po+=1;po_tx+=erp("tel")+"\r\n <br>";}
		}
		//////////////////////////////////////////
			// проверка поля Доп. Телефон
		if(document.getElementById('ti_blo_tel_2'))
		{
		var nf=$("#ti_blo_tel_2 input:text:eq(0)").val();
			if(reg_phone.test(nf) || nf=="") oker("tel_2",1);
			else {oker("tel_2",0);po+=1;po_tx+=erp("tel_2")+"\r\n <br>";}
		}
		//////////////////////////////////////////
		// проверка поля Skype
		var pre=$("#pvs input:radio").filter(":checked").val();
		var hipre=$("#ti_blo_skype input:hidden:eq(0)").val();
			if(pre==hipre)	
			{
			var ska=$("#ti_blo_skype input:text:eq(0)").val();
				if(ska) {oker("skype",1);}
				else {oker("skype",0);po+=1;po_tx+=erp("skype")+"\r\n <br>";}
			}
			else	
			{
			{oker("skype",1);}
			}
//////////////////////////////////////////

	// проверка поля Пол
   var sxq=$("#ti_blo_sex input:radio").filter(":checked").val();
	if(sxq) {oker("sex",1);}
	else {oker("sex",0);po+=1;po_tx+=erp("sex")+"\r\n <br>";}
//////////////////////////////////////////

          // проверка поля Город проживания
		if(document.getElementById('ti_blo_city'))
		{
		var nf=$("#ti_blo_city input:text:eq(0)").val();
			if(nf) oker("city",1);
			else {oker("city",0);po+=1;po_tx+=erp("city")+"\r\n <br>";}
		}
		//////////////////////////////////////////

		// проверка поля Дата рождения
		if(document.getElementById('ti_blo_birthday'))
		{
		var nf=$("#ti_blo_birthday input:text:eq(0)").val();
			if(nf) oker("birthday",1);
			else {oker("birthday",0);po+=1;po_tx+=erp("birthday")+"\r\n <br>";}
		}
		//////////////////////////////////////////

		// проверка поля Форма оплаты
if(document.getElementById('ti_blo_oplata'))
{
var fop=$("#ti_blo_oplata input:radio").filter(":checked").val();
var hifop=$("#ti_blo_oplata input:hidden:eq(0)").val();
if(fop!=undefined){
	if(fop==hifop) 
		{
		$("#pl_div").css("display", "block" );
		$("#op_div").css("display", "none" );
		}
	else
		{
		$("#op_div").css("display", "block" );
		$("#pl_div").css("display", "none" );
		}
	if(fop) {oker("oplata",1);}
	else {oker("oplata",0);po_tx+=erp("oplata")+"\r\n <br>";}	
	}
else {oker("oplata",0);po_tx+=erp("oplata")+"\r\n <br>";}	
}
//////////////////////////////////////////

		// проверка поля Наличие загранпаспорта
if(document.getElementById('ti_blo_p_nal'))
{
var fop=$("#ti_blo_p_nal input:radio").filter(":checked").val();
var hifop=$("#ti_blo_p_nal input:hidden:eq(0)").val();

if(fop!=undefined){
	if(fop==hifop) 
		{
		$("#p_nal_ok").css("display", "block" );
		$("#p_nal_not").css("display", "none" );
		}
	else
		{
		$("#p_nal_not").css("display", "block" );
		$("#p_nal_ok").css("display", "none" );
		}
	if(fop) {oker("p_nal",1);}
	else {oker("p_nal",0);po_tx+=erp("p_nal")+"\r\n <br>";}	
	}
else {oker("p_nal",0);po_tx+=erp("p_nal")+"\r\n <br>";}	
}
//////////////////////////////////////////
// Имя по загранпаспорту //
		if(document.getElementById('ti_blo_p_name'))
		{
		var ff=$("#ti_blo_p_name input:text:eq(0)").val();
		var fop=$("#ti_blo_p_nal input:radio").filter(":checked").val();
		var hifop=$("#ti_blo_p_nal input:hidden:eq(0)").val();
		if(fop==hifop) 
			{
			if(reg_fio.test(ff)) oker("p_name",1);
			else {oker("p_name",0);po+=1;po_tx+=erp("p_name")+"\r\n <br>";}
			}
		else {oker("p_name",1);}
		}
		//////////////////////////////////////////
		
// Фамилия по загранпаспорту //
		if(document.getElementById('ti_blo_p_family'))
		{
		var ff=$("#ti_blo_p_family input:text:eq(0)").val();
		var fop=$("#ti_blo_p_nal input:radio").filter(":checked").val();
		var hifop=$("#ti_blo_p_nal input:hidden:eq(0)").val();
		if(fop==hifop) 
			{
			if(reg_fio.test(ff)) oker("p_family",1);
			else {oker("p_family",0);po+=1;po_tx+=erp("p_family")+"\r\n <br>";}
			}
		else {oker("p_family",1);}			
		}
		//////////////////////////////////////////
		
// Действие загранпаспорта //
		if(document.getElementById('ti_blo_p_due_date'))
		{
		var ff=$("#ti_blo_p_due_date input:text:eq(0)").val();
		var fop=$("#ti_blo_p_nal input:radio").filter(":checked").val();
		var hifop=$("#ti_blo_p_nal input:hidden:eq(0)").val();
		if(fop==hifop) 
			{
			if(ff) oker("p_due_date",1);
			else {oker("p_due_date",0);po+=1;po_tx+=erp("p_due_date")+"\r\n <br>";}
			}
		else {oker("p_due_date",1);}			
		}
		//////////////////////////////////////////
		
// Дата выдачи загранпаспорта //
		if(document.getElementById('ti_blo_p_date'))
		{
		var ff=$("#ti_blo_p_date input:text:eq(0)").val();
		var fop=$("#ti_blo_p_nal input:radio").filter(":checked").val();
		var hifop=$("#ti_blo_p_nal input:hidden:eq(0)").val();
		if(fop==hifop) 
			{
			if(ff) oker("p_date",1);
			else {oker("p_date",0);po+=1;po_tx+=erp("p_date")+"\r\n <br>";}
			}
		else {oker("p_date",1);}			
		}
		//////////////////////////////////////////
		
// Серия и номер загранпаспорта //
		if(document.getElementById('ti_blo_p_sn'))
		{
		var ff=$("#ti_blo_p_sn input:text:eq(0)").val();
		var fop=$("#ti_blo_p_nal input:radio").filter(":checked").val();
		var hifop=$("#ti_blo_p_nal input:hidden:eq(0)").val();
		if(fop==hifop) 
			{
			if(ff) oker("p_sn",1);
			else {oker("p_sn",0);po+=1;po_tx+=erp("p_sn")+"\r\n <br>";}
			}
		else {oker("p_sn",1);}			
		}
		//////////////////////////////////////////
		
// Нет паспорта? Укажите дату //
		if(document.getElementById('p_ready'))
		{
		var ff=$("#p_ready input:text:eq(0)").val();
		var fop=$("#ti_blo_p_nal input:radio").filter(":checked").val();
		var hifop=$("#ti_blo_p_nal input:hidden:eq(0)").val();
		if(fop==hifop) {oker("p_ready",1);}
		else {
			if(ff) oker("p_ready",1);
			else {oker("p_ready",0);po+=1;po_tx+=erp("p_ready")+"\r\n <br>";}
			}			
		}
		//////////////////////////////////////////

// проверка поля Оформление визы
if(document.getElementById('ti_blo_p_viza'))
{
var fop=$("#ti_blo_p_viza input:radio").filter(":checked").val();
if(fop) {oker("p_viza",1);}
else {oker("p_viza",0);po+=1;po_tx+=erp("p_viza")+"\r\n <br>";}	
}
//////////////////////////////////////////
		
// проверка поля Вариант перелёта
if(document.getElementById('ti_blo_p_fly'))
{
var fop=$("#ti_blo_p_fly input:radio").filter(":checked").val();
if(fop) {oker("p_fly",1);}
else {oker("p_fly",0);po+=1;po_tx+=erp("p_fly")+"\r\n <br>";}	
}
//////////////////////////////////////////

// проверка поля Перелет туда
if(document.getElementById('ti_blo_fly_1'))
{
var fop=$("#ti_blo_p_fly input:radio").filter(":checked").val();
var hifop=$("#ti_blo_p_fly input:hidden:eq(0)").val();
var fop=$("#ti_blo_fly_1 input:radio").filter(":checked").val();
if(fop==hifop) {
	if(fop) {oker("fly_1",1);}
	else {oker("fly_1",0);po+=1;po_tx+=erp("fly_1")+"\r\n <br>";}	
	}
	else {oker("fly_1",1);}
}
//////////////////////////////////////////

// проверка поля Перелет обратно
if(document.getElementById('ti_blo_fly_2'))
{
var fop=$("#ti_blo_p_fly input:radio").filter(":checked").val();
var hifop=$("#ti_blo_p_fly input:hidden:eq(0)").val();
var fop=$("#ti_blo_fly_2 input:radio").filter(":checked").val();
if(fop==hifop) {
	if(fop) {oker("fly_2",1);}
	else {oker("fly_2",0);po+=1;po_tx+=erp("fly_2")+"\r\n <br>";}	
	}
	else {oker("fly_2",1);}
}
//////////////////////////////////////////

// проверка поля Транcфер
if(document.getElementById('ti_blo_p_transfer'))
{
var fop=$("#ti_blo_p_transfer input:radio").filter(":checked").val();
if(fop) {oker("p_transfer",1);}
else {oker("p_transfer",0);po+=1;po_tx+=erp("p_transfer")+"\r\n <br>";}	
}
//////////////////////////////////////////

// проверка поля Вариант проживания
if(document.getElementById('ti_blo_p_hotel'))
{
var fop=$("#ti_blo_p_hotel input:radio").filter(":checked").val();
if(fop) {oker("p_hotel",1);}
else {oker("p_hotel",0);po+=1;po_tx+=erp("p_hotel")+"\r\n <br>";}	
}
//////////////////////////////////////////

	// проверка поля Дата начала проживания
		if(document.getElementById('ti_blo_day_hotel_start'))
		{
		var hop=$("#ti_blo_p_hotel input:radio").filter(":checked").val();
		var hihop=$("#ti_blo_p_hotel input:hidden:eq(0)").val();
		var ff=$("#ti_blo_day_hotel_start input:text:eq(0)").val();
		if(hop==hihop) {
			if(ff) oker("day_hotel_start",1);
			else {oker("day_hotel_start",0);po+=1;po_tx+=erp("day_hotel_start")+"\r\n <br>";}	
			}
		else {oker("day_hotel_start",1);}
		}
		//////////////////////////////////////////
		
	// проверка поля Дата окончания проживания
		if(document.getElementById('ti_blo_day_hotel_finish'))
		{
		var hop=$("#ti_blo_p_hotel input:radio").filter(":checked").val();
		var hihop=$("#ti_blo_p_hotel input:hidden:eq(0)").val();
		var ff=$("#ti_blo_day_hotel_finish input:text:eq(0)").val();
		if(hop==hihop) {
			if(ff) oker("day_hotel_finish",1);
			else {oker("day_hotel_finish",0);po+=1;po_tx+=erp("day_hotel_finish")+"\r\n <br>";}	
			}
		else {oker("day_hotel_finish",1);}
		}
		//////////////////////////////////////////

// проверка поля Отель
if(document.getElementById('ti_blo_hotel'))
{
var hop=$("#ti_blo_p_hotel input:radio").filter(":checked").val();
var hihop=$("#ti_blo_p_hotel input:hidden:eq(0)").val();
var fop=$("#ti_blo_hotel input:radio").filter(":checked").val();
if(hop==hihop) {
	if(fop) {oker("hotel",1);}
	else {oker("hotel",0);po+=1;po_tx+=erp("hotel")+"\r\n <br>";}	
	}
	else {oker("hotel",1);}
}
//////////////////////////////////////////

// проверка поля Номер
if(document.getElementById('ti_blo_nomer'))
{
var hop=$("#ti_blo_p_hotel input:radio").filter(":checked").val();
var hihop=$("#ti_blo_p_hotel input:hidden:eq(0)").val();
var fop=$("#ti_blo_nomer input:radio").filter(":checked").val();

if(hop==hihop) {
	if(fop) {oker("nomer",1);}
	else {oker("nomer",0);po+=1;po_tx+=erp("nomer")+"\r\n <br>";}	
	}
	else {oker("nomer",1);}
}
//////////////////////////////////////////

// проверка поля Участие в конференции
if(document.getElementById('ti_blo_d_konf'))
{
var fop=$("#ti_blo_d_konf input:radio").filter(":checked").val();
if(fop) {oker("d_konf",1);}
else {oker("d_konf",0);po+=1;po_tx+=erp("d_konf")+"\r\n <br>";}	
}
//////////////////////////////////////////

// проверка поля Участие в гала ужине
if(document.getElementById('ti_blo_d_ujin'))
{
var fop=$("#ti_blo_d_ujin input:radio").filter(":checked").val();
if(fop) {oker("d_ujin",1);}
else {oker("d_ujin",0);po+=1;po_tx+=erp("d_ujin")+"\r\n <br>";}	
}
//////////////////////////////////////////

// проверка поля Питание в гостинице
if(document.getElementById('ti_blo_d_eat_1'))
{
var fop=$("#ti_blo_d_eat_1 input:radio").filter(":checked").val();
if(fop) {oker("d_eat_1",1);}
else {oker("d_eat_1",0);po+=1;po_tx+=erp("d_eat_1")+"\r\n <br>";}	
}
//////////////////////////////////////////

// проверка поля Питание на конференции
if(document.getElementById('ti_blo_d_eat_2'))
{
var fop=$("#ti_blo_d_eat_2 input:radio").filter(":checked").val();
if(fop) {oker("d_eat_2",1);}
else {oker("d_eat_2",0);po+=1;po_tx+=erp("d_eat_2")+"\r\n <br>";}	
}
//////////////////////////////////////////

// проверка поля Участие в экскурсии 1
if(document.getElementById('ti_blo_tour_1'))
{
var fop=$("#ti_blo_tour_1 input:radio").filter(":checked").val();
if(fop) {oker("tour_1",1);}
else {oker("tour_1",0);po+=1;po_tx+=erp("tour_1")+"\r\n <br>";}	
}
//////////////////////////////////////////

// проверка поля Участие в экскурсии 2
if(document.getElementById('ti_blo_tour_2'))
{
var fop=$("#ti_blo_tour_2 input:radio").filter(":checked").val();
if(fop) {oker("tour_2",1);}
else {oker("tour_2",0);po+=1;po_tx+=erp("tour_2")+"\r\n <br>";}	
}
//////////////////////////////////////////

// проверка поля Участие в экскурсии 3
if(document.getElementById('ti_blo_tour_3'))
{
var fop=$("#ti_blo_tour_3 input:radio").filter(":checked").val();
if(fop) {oker("tour_3",1);}
else {oker("tour_3",0);po+=1;po_tx+=erp("tour_3")+"\r\n <br>";}	
}
//////////////////////////////////////////

// проверка поля Размер футболки
if(document.getElementById('ti_blo_d_futbolka'))
{
var fop=$("#ti_blo_d_futbolka input:radio").filter(":checked").val();
if(fop) {oker("d_futbolka",1);}
else {oker("d_futbolka",0);po+=1;po_tx+=erp("d_futbolka")+"\r\n <br>";}	
}
//////////////////////////////////////////

return po_tx;

}

function sub_form() {

if(pro_su() !="") {
	//alert(pro_su());
	//$("#err_p").css("display","block");
	$("#err_p_t").html(pro_su());
	$("#err_p_b").click();
	return false;
	}
	else return true;

 }
 
function sub_but() {

if(pro_su() !="") {

	$(".but_bot_3_a").css("display","none");
	$(".but_bot_3").css("display","block");
	}
	else {

	$(".but_bot_3").css("display","none");
	$(".but_bot_3_a").css("display","block");
	}
if($("#hiscer").val()=="0") {
	$("#sx_2").css("display","none");
	$("#sx_3").css("display","none");
	$("#sx_4").css("display","none");
	}
if($("#hiscer").val()=="1") {
	$("#sx_2").css("display","block");
	$("#sx_3").css("display","block");
	$("#sx_4").css("display","block");
	}
var fop=$("#ti_blo_p_fly input:radio").filter(":checked").val();
var hifop=$("#ti_blo_p_fly input:hidden:eq(0)").val();
if(fop==hifop) 	{$("#fly_to").css("display", "block" );}
else {$("#fly_to").css("display", "none" );}

var hop=$("#ti_blo_p_hotel input:radio").filter(":checked").val();
var hihop=$("#ti_blo_p_hotel input:hidden:eq(0)").val();
if(hop==hihop) 	{$("#hotel_to").css("display", "block" );}
else {$("#hotel_to").css("display", "none" );}
 }

function erp(n) {
var ty =$("#erp_"+n).html();
return ty;
}

function oker(n,s) {
/*
if(s) {$("#ti_blo_"+n+" .ti_di").css({"border-color": color_ok,"background-color":color_ok});$("#ti_blo_"+n+" .ti_pol").css({"border-color": color_ok});}
else {$("#ti_blo_"+n+" .ti_di").css({"border-color": color_er,"background-color":color_er});$("#ti_blo_"+n+" .ti_pol").css({"border-color": color_er});}
*/
}

function f_nas_country(zcity,znof) {
var y=document.getElementById('sel_op_country').options[document.getElementById('sel_op_country').selectedIndex].value;
  $.ajax({ 
				type: "POST",			
                url: "vop2.php",
				data: "vcountry="+y+"&zcity="+zcity,  
                cache: false,  
                success: function(html){  
                    $("#soc").html(html);  
                }  
            });
		setTimeout("f_nas_city('"+znof+"')",500);
		//setTimeout("f_jq_select()",1000);
		setTimeout("sub_but()",500);
}

function f_nas_city(znof) {
var y=document.getElementById('sel_op_city').options[document.getElementById('sel_op_city').selectedIndex].value;
  $.ajax({ 
				type: "POST",			
                url: "vop2.php",
				data: "vcity="+y+"&znof="+znof,  
                cache: false,  
                success: function(html){  
                    $("#sos").html(html);  
                }  
            });
		setTimeout("f_nas_nof()",1000);
		setTimeout("f_jq_select()",500);
		setTimeout("sub_but()",500);
}

function f_nas_nof() {
var y=document.getElementById('sel_op_nof').options[document.getElementById('sel_op_nof').selectedIndex].value;
  $.ajax({ 
				type: "POST",			
                url: "vop2.php",
				data: "vnof="+y,  
                cache: false,  
                success: function(html){ 
				//$("#tr").html(html);
				var ar_h=html.split("^");
                 document.getElementById('currency_id').value=ar_h[0];
				document.getElementById('currency').value=ar_h[1];				 
                }  
            });

		setTimeout("f_jq_select()",500);
		setTimeout("sub_but()",500);
}

 function show_check()  
        {  
		var p_chk="";
		var p_fio="";
		var p_name="";
		var stts="";
	var cop0=$("#ti_blo_pl_ok input:hidden:eq(0)").val();
	var cop1=$("#ti_blo_pl_ok input:hidden:eq(1)").val();
	var cop2=$("#ti_blo_pl_ok input:hidden:eq(2)").val();
	var cop3=$("#ti_blo_pl_ok input:hidden:eq(3)").val();
	var chk=$("#chk").val();

		p_chk=$("#ti_blo_pl_chk input:text:eq(0)").val();
		p_fio=$("#ti_blo_pl_family input:text:eq(0)").val();
		p_name=$("#ti_blo_pl_name input:text:eq(0)").val();
		if(p_chk == chk) stts="o_0";
		else stts="o_1";

		            $.ajax({  
                type: "POST",
                url: "check_chk_13.php",  
				data: "p_chk="+p_chk+"&p_fio="+p_fio+"&p_name="+p_name+"&stts="+stts, 
                cache: false,  
                success: function(html){ 
				$("#tr").html(html);
				var ar_h=html.split("^");
				$("#promotion_3").val(ar_h[3]);
				if(ar_h[3]=="1" || ar_h[3]=="0"){
				if(ar_h[3]=="1") {$("#pl_ok").val(cop2);$("#pl_ok_id").val("2");show_hsh("div_er_pro2");}
					if(ar_h[3]=="0") {$("#pl_ok").val(cop3);$("#pl_ok_id").val("3");show_hsh("div_er_pro3");}
					}
				else {
					$("#pl_ok").val(cop0);
					$("#pl_ok_id").val("0");
					show_hsh("div_er_pro0");
					}
				sub_but();	
                }  
            });  
        } 
		
 function show_check_gr()  
        {  
		var p_chk="";
		var p_fio="";
		var p_name="";
		var stts="gr";
		var cop0=$("#ti_blo_garant_ok input:hidden:eq(0)").val();
		var cop1=$("#ti_blo_garant_ok input:hidden:eq(1)").val();
		var cop2=$("#ti_blo_garant_ok input:hidden:eq(2)").val();
			p_chk=$("#ti_blo_garant_chk input:text:eq(0)").val();
		p_fio=$("#ti_blo_garant_family input:text:eq(1)").val();
		p_name=$("#ti_blo_garant_name input:text:eq(1)").val();
		        $.ajax({  
                type: "POST",
                url: "check_chk_13.php",  
				data: "p_chk="+p_chk+"&p_fio="+p_fio+"&p_name="+p_name+"&stts="+stts, 
                cache: false,  
                success: function(html){  
				$("#tr").html(html);
				var ar_h=html.split("^");
				
				if(ar_h[0]=="1"){
				$("#promotion_3").val("2");
				$("#garant_ok").val(cop2);
				$("#garant_ok_id").val("2");
				show_hsh("div_er_pro4");
					}
				else {
					show_hsh("div_er_pro5");
					$("#garant_ok").val(cop0);
					$("#garant_ok_id").val("0");
					}
				sub_but();	
                }  
            });  
        } 
		
function show_hsh(nid) {

 var n=$("#"+nid).html();
 $("#note").html(n);
 if(n) {
		$("#leb_2").addClass("leb_r");
		$("#leb_2 legend").addClass("lg_r");
		}
}
function unshow_hsh() {
$("#note").html("");
$("#leb_2").removeClass("leb_r");
$("#leb_2 legend").removeClass("lg_r");
}

function pro_pl() {
$("#pl_ok").val("");
$("#pl_ok_id").val("1");
$("#garant_ok").val("");
$("#garant_ok_id").val("1");
sub_but();
}
function pro_gr() {
if($("#promotion_3").val()==2) $("#promotion_3").val("1");
$("#garant_ok").val("");
$("#garant_ok_id").val("1");
sub_but();
}
function p_pe(p,v,o) 
	{
	$("#ti_blo_"+p+" .ti_dis").css({"display": "none"}); 
	$("#ti_blo_"+v+" .ti_dis").css({"display": "none"});
	$("#ti_blo_"+p+" .ti_dis:eq("+o+")").css({"display": "block"});
	$("#ti_blo_"+v+" .ti_dis:eq("+o+")").css({"display": "block"});
	}
	
function p_pes(b,c)
	{
	f_nochev(b);
		if($("#ti_blo_"+c+" input:radio").filter(":checked").val()==undefined)
		{
		$("#ti_blo_"+b+" .ti_dis").css({"display": "block"});
		$("#ti_blo_"+c+" .ti_dis").css({"display": "block"});
		}
	}
// Сброс радиоточек //////////////////
function f_nochev(n) {
$("#ti_blo_"+n+" input:radio").filter(":checked").attr ("checked", false);
}
///////////////////////////////////////////////////

// Сброс радиоточек //////////////////
function f_nochev(n) {
$("#ti_blo_"+n+" input:radio").filter(":checked").attr ("checked", false);
}
///////////////////////////////////////////////////