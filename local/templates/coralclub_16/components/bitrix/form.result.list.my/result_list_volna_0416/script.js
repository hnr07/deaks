function f_del_p(i,d) {
if(i) {
document.getElementById("img_"+d).style.display="block";
document.getElementById("but_del_"+d).className="but_del_n";
}
else {
document.getElementById("img_"+d).style.display="none";
document.getElementById("but_del_"+d).className="but_del";
}
}
function f_tc(i,d) {
if(i) {
document.getElementById("text_calc_"+d).style.display="block";

}
else {
document.getElementById("text_calc_"+d).style.display="none";

}
}
