function polto() {
	var reg_mail =/^[a-zA-Z0-9][-\._a-zA-Z0-9]+@[\w-\._]+\.\w{2,4}$/i;//var reg_mail =/^\w+@\w+\.\w{2,4}$/i;
	//var reg_phone = /^[0-9-)(+ ]+$/;  // телефон - цифры скобки плюс дефис пробел
	var f_er=0;
	var name_user=$(".str_po .mod_po input[name=name_user]");
	var phone_user=$(".str_po .mod_po input[name=phone_user]");
	var email_user=$(".str_po .mod_po input[name=email_user]");
	
	if(name_user.val()=="") {name_user.addClass("error");f_er++;}
	else {name_user.removeClass("error");}
	if(phone_user.val()=="") {phone_user.addClass("error");f_er++;}
	else {phone_user.removeClass("error");}
	if(!reg_mail.test(email_user.val())) {email_user.addClass("error");f_er++;}
	else {email_user.removeClass("error");}
	$(".str_po .mod_po .listel .price").each(function(i,elem) {
		var pr=$(this).val()*1;
		if(pr<=0) {$(this).parent(".addel").addClass("error");f_er++;}
		else {$(this).parent(".addel").removeClass("error");}
	});
	if(f_er) {$(".str_po .mod_po .err_form").css({"display":"block"});return false;}
	else {$(".str_po .mod_po .err_form").css({"display":"none"});return true;}
}

function d_sum(id) {
	//alert(id);
	var el=$(".addel[id_elem="+id+"]");
	var co=el.children(".qty").val()*1;
	var cn=el.children(".cena").val()*1;
	if(co>1) el.children(".minus").removeClass("hid");
	else el.children(".minus").addClass("hid");
	var sum_el=co*cn;
	el.children(".price").val(sum_el);
	d_itogo();
}

function d_itogo() {
	var sum=0;
	$(".str_po .mod_po .listel .price").each(function(i,elem) {
		sum+=$(this).val()*1;
	});
	$(".itogo input").val(sum);
}