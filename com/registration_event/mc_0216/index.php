<?//define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludePublicLangFile(__FILE__);
$APPLICATION->SetTitle("");

//include "var_config.php";
$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => "var_config.php"), false);
//$APPLICATION->SetTitle(GetMessage("title_1")." \"".$title_m."\"");
?><!--<meta http-equiv="Refresh" content="0; URL=<?=$dir_event?>step_1.php">--> 

<link href="/com/registration_event/css/style_index.css" type="text/css"  rel="stylesheet" />

<?
//global $USER;

/*

$ds_s=explode(".",$d_reg_s);
$ds=(int)($ds_s[2].$ds_s[1].$ds_s[0]);
$df_s=explode(".",$d_reg_f);
$df=(int)($df_s[2].$df_s[1].$df_s[0]);
$td=date("Ymd");
if($td>=$ds && $td<=$df){ $registration=1;} // Разрешить регистрацию
else {
	$registration=0;  // Запретить регистрацию
	$registration_s=0;
	$registration_f=0;
	if($td<$ds) $registration_s=1;   // Регистрация не начата
	if($td>$df) $registration_f=1;  // Регистрация закончена
}
if(in_array($group_id, $USER->GetUserGroupArray())) $registration=1; // Разрешить регистрацию, если пользователь в группе $group_id
*/
$registration=1;
?> <br>
<div class="tuu">
	 <?if(!$registration):?>
	<h2>
	<?if($registration_s) echo GetMessage("note_3").$d_reg_s?> <?=($registration_f)?GetMessage("note_1"):"";?> </h2>
	 <? else:?>
	<div id="vkjs" style="font-size:16pt;color:red;margin:100px;">
		 <?=GetMessage("note_2")?>
	</div>
	<div id="uvk">
 <br>
 <a href="javascript:history.back()"> <?=GetMessage("history_back")?> &gt;&gt;&gt; </a>
		
		
	<?=GetMessage("oll_text")?>
		
			<br />
			<br />
		
		<p align="right">
 <a id="a_pero" href="step_1.php?pravila=1"><button class="but_gfg_a"><?=GetMessage("podat")?></button></a><button id="i_pero" class="but_gfg"><?=GetMessage("podat")?></button><br>
 <label for="pero" onclick="f_pch()"><span class="plb"><?=GetMessage("oznakomlen")?></span></label> <input id="pero" onclick="f_pch()" type="checkbox">
		</p>
	</div>
	 <script>
	$("#vkjs").css("display","none");
	$("#uvk").css("display","block");
	</script> <?endif;?>
</div>
 <br>
 <br>
 <br>
 <br>
<script>
function f_pch() {
if($("#pero").prop("checked")) {$("#ia_pero").css("display","inline");$("#a_pero").css("display","inline");$("#i_pero").css("display","none");}
else {$("#ia_pero").css("display","none");$("#a_pero").css("display","none");$("#i_pero").css("display","inline");}
}
</script><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>