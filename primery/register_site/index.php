<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludePublicLangFile(__FILE__);
global $USER;

$APPLICATION->SetTitle(GetMessage('register_site'));
    header("Location: reglament.php");// переадресация на шаблоны шапок
?> 
<style>
.tuu {
margin: 20px;
padding:20px;
border:solid 1px #a2a2a2;
  -moz-border-radius: 10px; /* Firefox */
  -webkit-border-radius: 10px; /* Safari, Chrome */
  -khtml-border-radius: 10x; /* KHTML */
  border-radius: 10px; /* CSS3 */
        -moz-box-shadow: 0 0 15px #a2a2a2; /* Firefox */
    -webkit-box-shadow: 0 0 15px #a2a2a2; /* Safari, Chrome */
    box-shadow: 0 0 15px #a2a2a2; /* CSS3 */
}
.tuu p{
text-indent: 20px;
}
.tuu h2, .tuu h3{
text-align: center;
}
.tuu .pli {
text-decoration: underline;
}
.tuu .plib {
text-decoration: underline;
font-weight: bold;
}
.tuu .plc {
font-style: italic;
}
.tuu .plb {
font-weight: bold;
}
.tuu li{
list-style-type: disc;
margin: 20px;
}
.tuu #a_pero, .tuu #ia_pero{
display:none;
}

</style>





<Br><br>
<h1><?$APPLICATION->ShowTitle();?></h1>

<div class="border-top"></div>
	<div class="left" style="width:230px;">
		<?
		// включаемая область для раздела
		$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."/../user/sect_inc.php", Array(), Array(
			"MODE"      => "html",                                           // будет редактировать в веб-редакторе
			"NAME"      => "Редактирование включаемой области раздела",      // текст всплывающей подсказки на иконке
			"TEMPLATE"  => "sect_inc.php"                    // имя шаблона для нового файла
			));
		?>
	</div>
	
	<div class="right" style="width:650px; overflow:auto; min-height:350px;">







<div class="tuu">
<h2><?=GetMessage('str_1')?></h2><br/>
<br />

<p><?=GetMessage('str_2')?> </p>

<p><?=GetMessage('str_3')?></p>

<br/>
<ul  style="list-style-type: decimal;">
<li>
<p><?=GetMessage('str_4')?>http://coral-club.com/<?=$_lang?>/register_site/reglament.php <?=GetMessage('str_38')?></p>
</li>
 
<li>
<p><?=GetMessage('str_5')?></p>
</li>
 
<li>
<p><?=GetMessage('str_6')?><br/>
<?=GetMessage('str_7')?><br/>
<?=GetMessage('str_8')?><br/>
<?=GetMessage('str_9')?> <br/>
<?=GetMessage('str_10')?></p>
</li>
 
<li>
<p><?=GetMessage('str_11')?></p>
<p><?=GetMessage('str_12')?><br/>
<?=GetMessage('str_13')?><br/>
<?=GetMessage('str_14')?><br/>
<?=GetMessage('str_15')?> <br/>
<?=GetMessage('str_16')?></p>
</li>
 
<li>
<p><?=GetMessage('str_17')?> (http://coral-club.com/<?=$_lang?>/register_site/step_1.php) <?=GetMessage('str_39')?></p>
</li>
 
<li>
<p><?=GetMessage('str_18')?></p>
</li>
 
<li>
<p><?=GetMessage('str_19')?></p>
</li>
 
<li>
<p><?=GetMessage('str_20')?></p>
</li>
 
<li>
<p><?=GetMessage('str_21')?> </p>
</li>
 
<li>
<p><?=GetMessage('str_22')?></p>
</li>
 
<li>
<p><?=GetMessage('str_23')?></p>
</li>
 
<li>
<p><?=GetMessage('str_24')?></p>
</li>
 
<li>
<p><?=GetMessage('str_25')?></p>
</li>
 
<li>
<p><?=GetMessage('str_26')?></p>
</li>
 
<li>
<p><?=GetMessage('str_27')?></p>
</li>
 
<li>
<p><?=GetMessage('str_28')?></p>
</li>
 
<li>
<p><?=GetMessage('str_29')?></p>
</li>
 
<li>
<p><?=GetMessage('str_30')?></p>
</li>
 
<li>
<p><?=GetMessage('str_31')?> </p>
</li>
 
<li>
<p><?=GetMessage('str_32')?></p>
</li>
 
<li>
<p><?=GetMessage('str_33')?></p>
</li>
 
<li>
<p><?=GetMessage('str_34')?> </p>
</li>
 
<li>
<p><?=GetMessage('str_35')?></p>
</li>
 
<li>
<p><?=GetMessage('str_36')?></p>
 </li>
 </ul>
<br></br>

<p align="center"><label for="pero" onclick="f_pch()"><span class="plb"><?=GetMessage('str_37')?></span></label> <input id="pero" type="checkbox" onclick="f_pch()" /><br/><br/><a id="a_pero" href="<?=$dir_event?>step_1.php?pravila=1"><img id="ia_pero" src="/images/register_site/button_reestr.png"></a><img id="i_pero" src="/images/register_site/button_reestr1.png"></p>
</div>

<br/><br/><br/><br/>
<script>
function f_pch() {
if($("#pero").prop("checked")) {$("#ia_pero").css("display","inline");$("#a_pero").css("display","inline");$("#i_pero").css("display","none");}
else {$("#ia_pero").css("display","none");$("#a_pero").css("display","none");$("#i_pero").css("display","inline");}
}
</script>







</div>
 <div class="clear-all"></div>
<br /><br />
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>