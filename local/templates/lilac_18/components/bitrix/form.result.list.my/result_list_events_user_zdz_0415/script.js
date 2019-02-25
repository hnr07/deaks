function f_del_p(i,d) {
if(i) {
//document.getElementById("img_"+d).style.display="block";
//document.getElementById("but_del_"+d).className="but_del_n";
$("#but_del_"+d).html("&#10062");
}
else {
//document.getElementById("img_"+d).style.display="none";
//document.getElementById("but_del_"+d).className="but_del";
$("#but_del_"+d).html("&#10006");
}
}
function f_tc(d) {
	var title='';
	$("#text_calc_"+d).parent().toggleClass("dinet");
	
		if ( $("#text_calc_"+d).parent().hasClass("dinet") ) {
		$("#but_razvorot_"+d).html("&#9660;");
		title=$("#open_d").val();
		
		}
		else {
		$("#but_razvorot_"+d).html("&#9650;");
		title=$("#open_c").val();
		}

	$("#but_razvorot_"+d).attr('title', title);
	//$("#text_calc_"+d).parents(".vurad").toggleClass("vurad_a");
}
