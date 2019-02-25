<?
IncludePublicLangFile(__FILE__);
global $_lang_dir;
?>
<div class="form_not_fon" style="qdisplay:none;">

	<div class="form_not">
	<div class="note"><?=GetMessage('str_1')?><br> <?=GetMessage('str_2')?></div>
	<div class="hr"></div>
	
	<div class="ap">
	<a href="<?=$_lang_dir?>"><?=GetMessage('str_3')?></a>
	<br/><br/>
	<a href="../scope/register/rules.php"><?=GetMessage('str_4')?></a>
	</div>
	<br/><br/>
	<br/><br/>
	<br/><br/>
		<div class="abut">
	<input type="button" value="<?=GetMessage('str_5')?>" onclick="window.location.replace('step_1.php?pravila=1')">
	<div class="esli"><?=GetMessage('str_6')?></div>
	</div>
	<br/><br/>
	</div>
	
</div>