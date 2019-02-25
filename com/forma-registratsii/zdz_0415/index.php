<?define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Условия участия в мероприятии \"Форум - 2015\"");
global $USER;

?> 
<!--<meta http-equiv="Refresh" content="0; URL=<?=$dir_event?>step_1.php">-->
<link href="/com/forma-registratsii/zdz_0415/css/style_index.css" type="text/css"  rel="stylesheet" />
<? include "var_config.php"; ?>


<?
$ds_s=explode(".",$d_reg_s);
$ds=(int)($ds_s[2].$ds_s[1].$ds_s[0]);
$df_s=explode(".",$d_reg_f);
$df=(int)($df_s[2].$df_s[1].$df_s[0]);

if(date("Ymd")>=$ds && date("Ymd")<=$df) $registration=1;
else $registration=0;
?>

<?if(in_array($USER->GetID(), $ar_manager)) $registration=1;?>

  <?if(!$registration):?>
<br/><br/><h2>
Регистрация на конференцию закрыта!<br/>
The registrtration for the conference is closed!
</h2> 
<? else:?>
<div class="tuu">
<script>document.documentElement.id = "pjs";</script>
<style>
#pjs #vkjs {display:none;}
</style>
<?//include "index_lang/index_".$_SESSION["f_lang"].".php"?>
	<div id="vkjs" style="font-size:16pt;color:red;margin:100px;">Для регистрации на мероприятие вам необходимо включить поддержку "JavaScript" вашим браузером или выбрать другой браузер с включённой поддержкой этой функции!</div>

	<div id="uvk" style="display:none;">
		<a href="javascript:history.back()"> <?=getMessage("GER_VER")?></a>  
	 <br />
		 <p class="pfl" align="right">
		 <?foreach($ar_lang_form as $l){?>
			<?if(LANGUAGE_ID!=$l){?>
				<a href="/<?=$l?>/forma-registratsii/zdz_0415/" ><img src="/images/flags/<?=$l?>_1.png" alt="<?=$l?>"  /> <span style="text-transform:uppercase;"><?=$l?></span></a>
			<?}?>
		 <?}?>
		 </p>
		 
		 
		  <br />

		<?include "usloviya.php"?>

	</div>
	<script>
	
	$("#vkjs").css("display","none");
	$("#uvk").css("display","block");
	
	</script>
  </div>
  <?endif;?>
<br />
 
<br />
 
<br />
 
<br />
 
<script>
function f_pch() {
if($("#pero").prop("checked")) {$("#ia_pero").css("display","inline");$("#a_pero").css("display","inline");$("#i_pero").css("display","none");}
else {$("#ia_pero").css("display","none");$("#a_pero").css("display","none");$("#i_pero").css("display","inline");}
}
</script>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>