document.write('<div id="cc_head_div"><div class="cc_head">');
document.write('<div class="cc_logo"><div class="cc_logo_img"></div></div>');
document.write('<div class="cc_but_boss"><a href="http://coral-club.com" target="_blank"><div class="cc_but_boss_img"></div></a><div class="cc_plashka"></div></div>');
document.write('<div class="cc_but_user"><a href="#" id="i_my_href"><div class="cc_but_user_img"></div></a></div>');
document.write('</div></div>');
var mopr_82=document.getElementById("cc_my_href").innerHTML;
mopr_82 = mopr_82.replace(/^\s+/, '');  // Убрать пробелы в начале строки
mopr_82 = mopr_82.replace(/\s+$/, ''); // Убрать пробелы в конце строки
if(mopr_82) document.getElementById("i_my_href").setAttribute("href",mopr_82);
