<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludePublicLangFile(__FILE__);
global $USER;

$APPLICATION->SetTitle(GetMessage('rules'));
?>
<script src="/js/zclip/jquery.zclip.min.js" type="text/javascript" rel="javascript" language="javascript"></script>
<link rel="stylesheet" href="/css/register_site.css" />

<script src="/js/mobilyslider/mobilyslider.js" type="text/javascript" rel="javascript" language="javascript"></script>
<link rel="stylesheet" href="/js/mobilyslider/mobilyslider_reglament.css" />

<script type="text/javascript">

function f_s_html(n) {
var ti=$("#parag_i").val();
var t="<span id='cc_my_href'>"+ti+"</span>";
var ts='<link rel="stylesheet" type="text/css" href="http://deaks.ru/primery/register_site/css/thema_'+n+'.css" />';
var s=$("#script").html();
$("#hep_"+n+" textarea").html(t+ts+s);
$(".hep_html textarea").css("display","none");
$("#hep_"+n+" textarea").css("display","block");
}
function f_p_html() {
var ti=$("#parag_i").val();
var t="<span id='cc_my_href'>"+ti+"</span>";
for(i=1;i<=11;i++){
	var ts='<link rel="stylesheet" type="text/css" href="http://deaks.ru/primery/register_site/css/thema_'+i+'.css" />';
	var s=$("#script").html();
	$("#hep_"+i+" textarea").html(t+ts+s);
}

}
$(function(){
	
	$('.slider1').mobilyslider();
	
	$('.slider2').mobilyslider({
		transition: 'vertical',
		animationSpeed: 500,
		autoplay: true,
		autoplaySpeed: 3000,
		pauseOnHover: true,
		bullets: false
	});
	
	$('.slider3').mobilyslider({
		transition: 'fade',
		animationSpeed: 800,
		bullets: true,
		arrowsHide: false
	});
	
	
});


$(document).ready(function() {
			$("textarea").focus(function(){ 
	       $(this).select();
	    });
});
</script>
<style>
.hep_html textarea {
display:block;
border:0;
margin-top:5px;
}



</style>

</br></br>
<textarea id="script" style="display:none;" ><script src="http://deaks.ru/primery/register_site/js/thema.js" type="text/javascript" rel="javascript" language="javascript"></script></textarea>
<!--<h2><?$APPLICATION->ShowTitle();?></h2>
<div class="border-top"></div>
-->
<?=GetMessage('str_1')?><br/><br/>
<a href="11_02_14_prilozhenie_k_p2.1(shapki)_<?=$_lang?>.pdf" style="text-decoration:none;">
<div class="but_bao">
<?=GetMessage('str_2')?>
</div></a>
</br>
<h3><?=GetMessage('str_3')?></h3>
<br/>
<table><tr><td width="50%">
<div class="parag"><b><?=GetMessage('str_4')?> <img src="/images/register_site/but_i_20.png">,<br/><?=GetMessage('str_5')?></b></div>
</br>
<div class="parag_p"><input type="text" id="parag_i" placeholder="Введите адрес страницы" onkeyup="f_p_html()"></div>
</br>
</td><td>
<b><?=GetMessage('str_6')?></b><br/><br/><i style="color:#b2b2b2;"><?=GetMessage('str_7')?></i>
</br>
</td></tr></table>
<br/>
<!--<div class="parag">Шаблоны:</div>-->

<div class="ekip">
	<div class="slider slider1" style="height:200px;">
		<div class="sliderContent" style="height:200px;border-radius: 5px;">

			<?for($i=1;$i<=11;$i++) {?>
				<div class="item">

				<div class="hep" id="hep_<?=$i?>">
				<div class="hep_img"><img src="/images/register_site/theme/prev_<?=$i?>.png" ></div>
				<div class="hep_html">
				<textarea>
				</textarea></div>
				</div>

				</div>
			<?}?>

		</div>
	</div>
</div>
<style>
a.return {color:#1ab4d6;}
a.return:hover {text-decoration:underline;}
</style>
<script>f_p_html();</script>
<br/>
<!--<a class="return" href="javascript:javascript:history.go(-1)"><?=GetMessage('str_8')?></a>-->
</br></br></br></br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>